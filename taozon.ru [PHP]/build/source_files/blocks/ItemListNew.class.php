<?php

class ItemListNew extends GenerateBlock {

    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'itemlistnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct() {

        parent::__construct(true);
    }

    private function clearUrl(){
        unset($_GET['rating'], $_GET['cost'], $_GET['count'], $_GET['filters'], $_GET['clear'], $_GET['script_name'],
        $_GET['ignorefilters']);
    }

    private function checkClear(){
        if (!isset($_GET['clear'])) return ;
        if(in_array('Seo2', General::$enabledFeatures)){
            $url = $_SERVER['REQUEST_URI'];
            header('Location: ' . current(explode('?', $url)));
            return ;
        }

        $url = $_SERVER['REQUEST_URI'];
        $currentQuery = $_SERVER['QUERY_STRING'];
        $this->clearUrl();
        $newQuery = http_build_query($_GET);
        header('Location: ' . str_replace($currentQuery, $newQuery, $url));
    }

    public static function getArrayValueByKeys($array, $keys){
        $tmp = $array;
        foreach($keys->request as $k){
            $tmp = $tmp[(string)$k];
        }
        return $tmp;
    }

    public static function getXmlParameter($requestType, $requestKeys, $xmlKey, &$xmlElement){
        switch($requestType){
            case 'get':
                $value = @self::getArrayValueByKeys($_GET, $requestKeys);
                if($value)
                    $xmlElement->addChild($xmlKey, htmlspecialchars($value));
                break;
            case 'post_or_get':
                $valuePost = @self::getArrayValueByKeys($_POST, $requestKeys);
                $valueGet = @self::getArrayValueByKeys($_GET, $requestKeys);
                if($valuePost)
                    $xmlElement->addChild($xmlKey, htmlspecialchars($valuePost));
                elseif($valueGet)
                    $xmlElement->addChild($xmlKey, htmlspecialchars($valueGet));
                break;
        }
    }

    public static function prepareFiltersXml(&$xmlElement){
        if (isset($_GET['filters'])) {
            $configuratorsXml = $xmlElement->addChild('Configurators');
            foreach ($_GET['filters'] as $pid => $vid) {
                if ($vid && $pid!='StuffStatus'){
                    $el = $configuratorsXml->addChild('Configurator');
                    $el->addAttribute('Pid', $pid);
                    $el->addAttribute('Vid', $vid);
                }
                elseif($pid=='StuffStatus' && $vid){
                    $xmlElement->addChild('StuffStatus', $vid);
                }
            }
        }
    }

    private function searchParamsAddited($oldxml){
        $N_search = new SimpleXMLElement($oldxml);
        if (General::getSiteConfig('min_rating_goods')) {
            if ($N_search->MinVendorRating<General::getSiteConfig('min_rating_goods')) {
                $N_search->MinVendorRating = General::getSiteConfig('min_rating_goods');
            }
            if (!isset($N_search->MaxVendorRating)) {
                $N_search->MaxVendorRating = '20';
            }
            if ($N_search->MaxVendorRating<General::getSiteConfig('min_rating_goods')) {
                $N_search->MaxVendorRating = General::getSiteConfig('min_rating_goods');
            }
        }
        if (General::getSiteConfig('min_cost_goods')) {
            if ($N_search->MinPrice<General::getSiteConfig('min_cost_goods')) {
                $N_search->MinPrice = General::getSiteConfig('min_cost_goods');
            }
            if ((isset($N_search->MaxPrice)) and ($N_search->MaxPrice<General::getSiteConfig('min_cost_goods'))) {
                $N_search->MaxPrice = General::getSiteConfig('min_cost_goods');
            }
        }
        if (General::getSiteConfig('hide_bu_goods')) {
            $N_search->StuffStatus = 'New';
        }
        return $N_search->asXML();
    }

    private function searchParams(){
        $xmlParams = new SimpleXMLElement('<SearchItemsParameters></SearchItemsParameters>');

        $xmlSearchConfig = simplexml_load_file(CFG_APP_ROOT.'/config/request2xml.search.xml');
        foreach($xmlSearchConfig->predefined_paramters->parameter as $c)
            $xmlParams->addChild((string)$c['name'], (string)$c[0]);

        foreach($xmlSearchConfig->parameter as $c)
            self::getXmlParameter((string)$c['request_type'],$c->children(),(string)$c['name'],$xmlParams);

        self::prepareFiltersXml($xmlParams);

        return $xmlParams->asXML();
    }

    private function post2get(&$url, $key) {
        if(!isset($_POST[$key])) return ;
        if (isset($_GET[$key])) {
            $url = str_replace('&'.$key.'='. $_GET[$key], '', $url);
        }
        $url .= '&'.$key.'=' . $_POST[$key];
        $_GET[$key] = $_POST[$key];
    }

    public function checkGetRequestForSorting() {
				
		//Будем тут чистить массив
		//Array ( [p] => category [cid] => 50010850 [cost] => Array ( [from] => 0 [to] => 0 ) [count] => Array ( [from] => 0 [to] => 0 ) [rating] => Array ( [from] => 4 [to] => 13 ) [filters] => Array ( [StuffStatus] => ) [per_page] => 128 [from] => 128 [tmall] => )
		
		$default_perpage = (isset(General::$siteConf['default_perpage'])) ? General::$siteConf['default_perpage'] : 16;
		
		if (!is_numeric(@$_GET['cost']['from'])) $_GET['cost']['from'] = 0;
		if (!is_numeric(@$_GET['cost']['to'])) $_GET['cost']['to'] = 0;
		if (!is_numeric(@$_GET['rating']['from'])) $_GET['rating']['from'] = 0;
		if (!is_numeric(@$_GET['rating']['to'])) $_GET['rating']['to'] = 0;
		if (!is_numeric(@$_GET['from'])) $_GET['from'] = 0;
		if (!is_numeric(@$_GET['per_page'])) $_GET['per_page'] = $default_perpage;
		if (!is_numeric(@$_GET['count']['from'])) $_GET['count']['from'] = 0;
		if (!is_numeric(@$_GET['count']['to'])) $_GET['count']['to'] = 0;
				
        $cid = RequestWrapper::getValueSafe('cid');
        $from = isset($_GET['from']) ? $_GET['from'] : 0;
        $tmall = (isset($_GET['tmall']) && ($_GET['tmall'] == 'true')) ? $_GET['tmall'] : '';
        $default_perpage = (isset(General::$siteConf['default_perpage'])) ? General::$siteConf['default_perpage'] : 16;
        $perpage = (isset($_SESSION['perpage']) && !empty($_SESSION['perpage'])) ? $_SESSION['perpage'] : $default_perpage;
        if (isset($_GET['per_page'])) $perpage = $_GET['per_page'];
        if (isset($_POST['per_page'])) $perpage = $_POST['per_page'];
//        $_SESSION['perpage'] = $perpage;

        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace('&from=' . $from, '', $url);
        $url = str_replace('&tmall=' . $tmall, '', $url);
        $url = str_replace('&new_prod=', '', $url);
        if(@$_GET['p_ajax']){
            $url = str_replace('&p='.$_GET['p'], '&p='.$_GET['p_ajax'], $url);
            $url = str_replace('&p_ajax='.$_GET['p_ajax'], '', $url);
        }

        $GLOBALS['url'] = $url;
        if (!isset($_GET['sort_by'])){
            if (isset($_SESSION['sort_by']) && !empty($_SESSION['sort_by']))
                $_GET['sort_by'] = $_SESSION['sort_by'];
        } else {
            $_SESSION['sort_by'] = $_GET['sort_by'];
        }

        $this->post2get($url, 'sort_by');
        $this->post2get($url, 'per_page');

        if (!empty($_POST)){
            header('Location: ' . $url);
            return array(0,0,0);
        }
        $this->tpl->assign('cid', $cid);
        $this->tpl->assign('from', $from);
        $this->tpl->assign('tmall', $tmall);
        $this->tpl->assign('perpage', $perpage);
        return array($from, $tmall, $perpage);
    }

    private function assignGlobals($foundAll){
        $GLOBALS['rootpath'] = is_array($foundAll['RootPath']) ? array_reverse($foundAll['RootPath']) : array();
        if(count(@$foundAll['Items']['Categories']) > 1){
            $GLOBALS['cats'] = @$foundAll['Items']['Categories'];
            $this->tpl->assign('subcats',@$foundAll['Items']['Categories']);
        }
    }

    private function prepareSubCategories($foundAll){
        if ($_GET['p'] == 'subcategory') {
            $subcats = $foundAll['SubCategories'];

            if(in_array('Seo2', General::$enabledFeatures)){
                $cms = new SafedCMS();
                if(is_array($subcats))
                    foreach($subcats as &$c){
                        $c['alias'] = $cms->getCategoryAlias(@$c['Id'], true, @$c['Name']);
                    }
            }

            $GLOBALS['cats'] = $subcats;
            $this->tpl->assign('subcats', $subcats);
        }
    }

    private function prepareItemList($foundAll){
        $itemlist = $foundAll['Items']['Items'];
        if (count(@$itemlist['data']) == 1)
            header('Location: index.php?p=item&id='.$itemlist['data'][0]['id']);
        $this->tpl->assign('itemlist', $itemlist['data']);
        $this->tpl->assign('totalcount', $itemlist['totalcount']);
        $this->tpl->assign('count', $itemlist['totalcount'] > 10000 ? 10000 : $itemlist['totalcount']);
    }

    private function prepareSearchProp($foundAll){
        $GLOBALS['searchprop'] = @$foundAll['SearchProperties'];
        $SP = new SearchPropNew();
        $searchProp = $SP->Generate();
        $this->tpl->assign('SearchProp', $searchProp);
    }

    private function prepareHintCats(){
        global $otapilib;

        if(!RequestWrapper::getValueSafe('search'))
            $this->tpl->assign('hintcats', array());
        else{
            $categoriesResult = $otapilib->FindHintCategoryInfoList(RequestWrapper::getValueSafe('search'));
            if (!is_array($categoriesResult))
                $categoriesResult = array();
            $this->tpl->assign('hintcats',$categoriesResult);
        }
    }

    private function preparePageUrl($from, $tmall){
        $url = $_SERVER['REQUEST_URI'];
        if(@$_GET['p_ajax']){
            $url = str_replace('&p='.$_GET['p'], '&p='.$_GET['p_ajax'], $url);
            $url = str_replace('?p='.$_GET['p'], '?p='.$_GET['p_ajax'], $url);
            $url = str_replace('&p_ajax='.$_GET['p_ajax'], '', $url);
        }
        $url = str_replace('&from=' . $from, '', $url);
        $url = str_replace('&tmall=' . $tmall, '', $url);
        $this->tpl->assign('pageurl', $url);
    }

    protected function setVars() {
        global $otapilib;


        $this->checkClear();
        list($from, $tmall, $perpage) = $this->checkGetRequestForSorting();
        if(!$from && !$tmall && !$perpage) return;

        if($_GET['p'] != 'item_list_ajax' && defined('CFG_AJAX_ITEM_LIST')){
            $this->_template = 'itemlistnew_ajax';
            return ;
        }

        $categoryItemFilter = $this->searchParams();
        //echo $categoryItemFilter;
        //Скорректировать categoryItemFilter
        $categoryItemFilter = $this->searchParamsAddited($categoryItemFilter);
        //echo $categoryItemFilter;
        //------------------------Кэширование здесь ------------------------------------
        //------------------------------------------------------------
        //------------------------------------------------------------
        $DBCacheList = new DBCache();	
				
        $cid = RequestWrapper::getValueSafe('cid');
		
		if ($DBCacheList->CheckCacheEl('catsearchprop:'.$cid)) {
			//Есть кэш и живой
			$blockList = 'SubCategories,Vendor,RootPath';
			$db_caching = false;
		} else {
			//Нету и надо создать новый
			$blockList = 'SubCategories,SearchProperties,Vendor,RootPath';
			$db_caching = true;
			
		}
		
        if ($DBCacheList->CheckCacheEl('catsearchprop:'.$cid)) {
            //Есть кэш и живой
            $blockList = 'SubCategories,Vendor,RootPath';
            $db_caching = false;
        } else {
            //Нету и надо создать новый
            $blockList = 'SubCategories,SearchProperties,Vendor,RootPath';
            $db_caching = true;

        }

        if ($cid=="") {
            $blockList = 'SubCategories,SearchProperties,Vendor,RootPath';
        }
        //------------------------------------------------------------
        //------------------------------------------------------------
        //$blockList = 'SubCategories,SearchProperties,Vendor,RootPath';


        if(RequestWrapper::getValueSafe('brand'))
            $blockList .= ',Brand';
        $foundAll = $otapilib->BatchSearchItemsFrame(session_id(), $categoryItemFilter, $from, $perpage, $blockList);

        //------------------------------------------------------------
        //------------------------------------------------------------
        if ($cid<>"") {
            if (!$db_caching) {
                //Получаем список фильтров из кэша                
                $foundAll['SearchProperties'] = array();
				$foundAll['SearchProperties'] = unserialize($DBCacheList->GetCacheEl('catsearchprop:'.$cid));
                
            } else {
                //Создаем кэш 
                $DBCacheList->AddCacheEl('catsearchprop:'.$cid,21600,serialize($foundAll['SearchProperties']));
            }
        }
        //------------------------------------------------------------
        //------------------------------------------------------------

        if(RequestWrapper::getValueSafe('brand'))
            $GLOBALS['brandinfo'] = $foundAll['Brand'];
        $this->assignGlobals($foundAll);

        $this->prepareSubCategories($foundAll);
        $this->prepareItemList($foundAll);
        $this->prepareSearchProp($foundAll);
        $this->prepareHintCats();
        $this->preparePageUrl($from, $tmall);
    }

}

?>