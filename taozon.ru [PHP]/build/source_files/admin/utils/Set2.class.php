<?php
/**
 * User: dima
 * Date: 08.12.12
 * Time: 9:42
 * Новый блок подборок товаров, продавцов, брендов и категорий
 */
class Set2 extends GeneralUtil{

    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'index'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = 'set2/'; //- путь к шаблону
    protected $tpl;

    public function __construct(){
        global $otapilib;
        $otapilib->setErrorsAsExceptionsOn();

        parent::__construct();
        @define('NO_DEBUG', 1);
    }

    /**
     * Вывод главной страницы подборок
     * Сейчас на ней вывод избранных товаров
     * @param RequestWrapper|bool $request
     */
    public function defaultAction($request = false){
        print $this->fetchTemplate();
    }

    /**
     * Вывод подборок товаров
     * @param RequestWrapper|bool $request
     */
    public function showItemSetAction($request){
        $this->_template = $request->getValue('contentType');
        $itemSet = $this->getItemsSet($request->getValue('type'), $request->getValue('contentType'),
            $request->getValue('categoryId'));
        $this->tpl->assign('items', $itemSet);
        $this->tpl->assign('itemRatingTypeId', $request->getValue('type'));


        //Получение катеогрий - можно отказаться так как все катеогрии и так в БД, но если нам надо знать сколько элементов в категории то получаем
        $categories = $this->getSetCategories('Item', $request->getValue('type'));
        $this->tpl->assign('categories', $categories);
		
		$hierarchy = Plugins::invokeEvent('onGetHierarchyCats', array('tpe' => $request->getValue('type'),'cats' => $categories));        
        $this->tpl->assign('hierarchy', $hierarchy);
		
		//Получаем SEO категории
		$Cats_Seo = Plugins::invokeEvent('HierarchyGetSeoTexts', array('CType' => "Item",'RatingTypeId' => "Best", 'catId' => $request->getValue('categoryId')));
		$this->tpl->assign('Cats_Seo', $Cats_Seo);
		

        $this->tpl->assign('activeCategory', $request->getValue('categoryId'));
        print $this->fetchTemplate();
    }


    
    

    /**
     * Удаление элемента из подборки
     * @param RequestWrapper|bool $request
     */
    public function deleteFromRatingListAction($request){
		$AntiSpecSymbName = str_replace("-and-", "&", $request->getValue('categoryId'));
		Plugins::invokeEvent('onDelHierarchyCat', array('fields' => $request)); 		
        

        $this->deleteFromItemSet(
            $request->getValue('itemRatingTypeId'),
            $request->getValue('contentType'),
            $AntiSpecSymbName,
            $request->getValue('itemList')
        );

        $C = new Control();
        $C->clearCacheAction();
    }

    /**
     * Добавление элемента в подборку
     * @param RequestWrapper|bool $request
     */
    public function addToRatingListAction($request){
		$itemList = $request->getValue('ItemList');
		$itemListArray = explode(';', $itemList);
        $method = "prepare".$request->getValue('contentType')."Ids";
        $this->$method($itemListArray);
        $itemListArray = array_filter($itemListArray);

		Plugins::invokeEvent('onAddHierarchyCat', array('fields' => $request)); 
        
        $this->addToItemSet(
            'Best',
            $request->getValue('contentType'),
            $request->getValue('categoryId') === '' ?
                $request->getValue('currentCategory') : $request->getValue('categoryId'),
            implode(';', $itemListArray)
        );
				
        $method = "afterAdd".$request->getValue('contentType');
        if(function_exists($this, $method)){
            $this->$method($request);
        }

        $C = new Control();
        $C->clearCacheAction();
    }

    /**
     * @param RequestWrapper|bool $request
     * @return bool
     */
    public function getItemInfoAction($request){
        global $otapilib;
        try{
            $item = array();

            $itemInfo = $otapilib->GetItemFullInfo($request->get('id'));
            $item['Title'] = $itemInfo['Title'];

            $itemDescription = $otapilib->GetItemDescription($request->get('id'));
            $item['Description'] = (string)$itemDescription;

            print json_encode( $item );
        }
        catch(ServiceException $e){
            $this->throwAjaxError($e);
        }

        return false;
    }

    /**
     * @param RequestWrapper|bool $request
     * @throws DBException
     * @return bool
     */
    public function getVendorInfoAction($request){
        try{
            $item = array();

            $this->cms->Check();
            $q = mysql_query('SELECT * FROM `site_vendors_images`
                WHERE `vendor_id`="'.mysql_real_escape_string($request->get('id')).'"');
            if(!$q)
                throw new DBException(mysql_error(), mysql_errno());

            $row = mysql_fetch_assoc($q);
            $item['Title'] = $row['vendor_name'];

            print json_encode( $item );
        }
        catch(DBException $e){
            $this->throwAjaxError($e);
        }

        return false;
    }

    /**
     * @param RequestWrapper|bool $request
     */
    public function saveItemInfoAction($request){
        global $otapilib;
        try{
            $sid = Session::get('sid');

            $key = "taobao:Item:Title";
            $otapilib->EditTranslateByKey($sid, $request->post('ItemTitle'), $key, $request->post('ItemId'), 'ru');

            $key = "taobao:Item:Description";
            $otapilib->EditTranslateByKey($sid, $request->post('ItemDescription'), $key, $request->post('ItemId'), 'ru');

            $C = new Control();
            $C->clearCacheAction();
        }
        catch(ServiceException $e){
            $this->throwAjaxError($e);
        }
    }

    /**
     * Получает подборку товаров
     * @param string $type Best|Popular|Last
     * @param $contentType
     * @param int $category
     * @return array
     */
    public function getItemsSet($type, $contentType, $category = 0){
        global $otapilib;
        try{
            $method = "Get{$contentType}RatingList";
            return $otapilib->$method($type, 2000, $category);
        }
        catch(ServiceException $e){
            $this->throwAjaxError($e);
        }

        return false;
    }

    /**
     * Получение списка категорий для требуемой подборки
     * @param string $contentType       Item|Brand|Vendor|Category
     * @param string $itemRatingTypeId  Best|Popular|Last
     * @return array
     */
    public function getSetCategories($contentType, $itemRatingTypeId){
        global $otapilib;
        try{
            $resultCategories = array();
            $sets = $otapilib->GetRatingCollectionsByContent($contentType);
            foreach($sets as $itemSet){
                if($itemSet['ItemRatingTypeName'] == $itemRatingTypeId && $itemSet['ContentTypeName'] == $contentType) {
                    $CatName = $itemSet['CategoryId'];
                    $resultCategories[$CatName] = $itemSet['Count'];
                }
            }

            return $resultCategories;
        }
        catch(ServiceException $e){
            $this->throwAjaxError($e);
        }
        return array();
    }

    /**
     * Удаляет элементы из подборки
     * @param string $itemRatingTypeId  Best|Popular|Last
     * @param string $contentType       Item|Vendor|Category|Brand
     * @param string $categoryId
     * @param string $itemList          Список id товаров, разделенных ;
     */
    public function deleteFromItemSet($itemRatingTypeId, $contentType, $categoryId, $itemList){
        global $otapilib;
        try{
            $sid = Session::get('sid');
            $otapilib->RemoveElementsSetRatingList($sid, $itemRatingTypeId, $contentType, $categoryId, $itemList);
            if($contentType == 'Item' && $itemRatingTypeId != 'Best'){
                $otapilib->AddBlackListContents($sid, $this->addItemToBlackListXML($itemList));
            }
        }
        catch(ServiceException $e){
            $this->throwAjaxError($e);
        }
    }

    public function addToItemSet($itemRatingTypeId, $contentType, $categoryId, $itemList){
        global $otapilib;
        try{
            $sid = Session::get('sid');
            $otapilib->AddElementsSetToRatingList($sid, $itemRatingTypeId, $contentType, $categoryId, $itemList);
            if(!$this->checkAddToRatingListSuccess($itemRatingTypeId, $contentType, $categoryId, $itemList))
                throw new ServiceException('Item was not added', 'InternalError');
        }
        catch(ServiceException $e){
            $this->throwAjaxError($e);
        }
    }

    /**
     * Формирует xml для добаления удаленных товаров их подборок Popular, Last в черный список
     * @param $itemList     Список id товаров, разделенных ;
     * @return string       XML
     */
    private function addItemToBlackListXML($itemList){
        $xml = new SimpleXMLElement('<ArrayOfContentList></ArrayOfContentList>');
        $contentList = $xml->addChild('ContentList');
        $contentList->addAttribute('ContentType', 'Item');

        $itemList = explode(';', $itemList);
        foreach($itemList as $itemId){
            $contentList->addChild('Content', htmlspecialchars($itemId));
        }

        return $xml->asXML();
    }

    /**
     * Переводит ссылки на товары в id
     * @param array $itemListArray
     */
    private function prepareItemIds(&$itemListArray){
        foreach($itemListArray as &$data){
            if(preg_match( '/(http)/i', $data )) {
                $urlComponents = parse_url($data);
                parse_str($urlComponents['query'], $queryArray);
                $data = isset($queryArray['id']) && preg_match('/^\d+$/', $queryArray['id']) ? $queryArray['id']:false;
            }
            else{
                $data = intval($data);
            }
        }
    }

    /**
     * Переводит ссылки на товары в id
     * @param array $itemListArray
     */
    private function prepareVendorIds(&$itemListArray){
        foreach($itemListArray as &$data){
            if(preg_match( '/(http)/i', $data )) {
                $urlComponents = parse_url($data);
                parse_str($urlComponents['query'], $queryArray);
                $data = isset($queryArray['id']) ? $queryArray['id']:false;
            }
            else{
                $data = $data;
            }
        }
    }

    /**
     * Переводит ссылки на бренды в id
     * @param array $itemListArray
     */
    private function prepareBrandIds(&$itemListArray){
        foreach($itemListArray as &$data){
            if(preg_match( '/(http)/i', $data )) {
                $urlComponents = parse_url($data);
                parse_str($urlComponents['query'], $queryArray);
                $data = isset($queryArray['brand']) ? $queryArray['brand']:false;
            }
            else{
                $data = $data;
            }
        }
    }

    /**
     * @param RequestWrapper $request
     */
    private function afterAddVendor($request){
        $this->cms->Check();
        $request->getValue('');
    }

    /**
     * Проверяет наличие всех добавляемых элементов из $itemList в подборку
     * @param $itemRatingTypeId
     * @param $contentType
     * @param $categoryId
     * @param $itemList
     * @return bool успех
     */
    private function checkAddToRatingListSuccess($itemRatingTypeId, $contentType, $categoryId, $itemList){
        global $otapilib;
        $method = "Get{$contentType}RatingList";
        $elements = $otapilib->$method($itemRatingTypeId, 2000, $categoryId);
        $itemListIds = explode(';', $itemList);
        foreach($elements as $e){
            $key = array_search((string)$e['Id'], $itemListIds);
            if($key !== false) unset($itemListIds[$key]);
        }

        return !count($itemListIds);
    }
	
	public function EditCatAction(){	
		//Пишем это деол в отапи
		global $otapilib;
		try{
            $sid = Session::get('sid');
            $otapilib->UpdateItemRatingCategoryId($sid, $_POST['RatingTypeId'], $_POST['contentType'], $_POST['catId'], $_POST['name']);    	
			Plugins::invokeEvent('HierarchySetSeoTexts', array('input' => $_POST));             
        }
        catch(ServiceException $e){
            $this->throwAjaxError($e);
        }         
		header('Location: index.php?cmd=Set2');
    }
	
	
	public function addFileToRatingListAction(){
		//А Если грузить через файл				
		if (is_uploaded_file($_FILES['filedata']['tmp_name'])) {
			$fp = fopen($_FILES['filedata']['tmp_name'], 'r');
			$itemList = fread($fp,filesize($_FILES['filedata']['tmp_name']));
			fclose($fp); 			 
    		$itemList = str_replace("\r\n",';',$itemList);
			$itemList = str_replace("\n",';',$itemList);			
		
        	$itemListArray = explode(';', $itemList);
			
        
			$method = "prepare".$_POST['contentType']."Ids";
        	$this->$method($itemListArray);
        	$itemListArray = array_filter($itemListArray);
			//print_r($itemListArray);
		        
        	$this->addToItemSet(
            	'Best',
            	$_POST['contentType'],
            	$_POST['currentCategory'],
            	implode(';', $itemListArray)
        	);
			

        	$C = new Control();
        	$C->clearCacheAction();
			header('Location: index.php?cmd=Set2');
			
		}
		
    }
	
}

