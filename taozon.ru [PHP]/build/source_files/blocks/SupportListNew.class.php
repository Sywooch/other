<?php

class SupportListNew extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'supportlistnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;
		
		
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();
		
		$allNote = $otapilib->BatchGetUserData($sid,'Note');		
		$GLOBALS['Note'] = $allNote['Note']['Elements'];
		
        if(isset($_GET['del'])){
            // удалить файл кеша корзины и избранного
            Cache_my::DelCacheBatchGetUserData($sid);

            $isdeleted = $otapilib->RemoveItemFromNote($sid, $_GET['del']);
            if ($isdeleted) {
                foreach ($GLOBALS['Note'] as $i=>$item) {
                    if ((string)$item['id'] == $_GET['del']) {
                        unset($GLOBALS['Note'][$i]);
                        break;
                    }
                }
            }
        } 
		if(isset($_GET['delGroup'])){
            // удалить файл кеша корзины и избранного
            Cache_my::DelCacheBatchGetUserData($sid);
			//Цикл
            $itms = explode("|", $_GET['delGroup']);			
			foreach ($itms as $key => $value) {
            	$isdeleted = $otapilib->RemoveItemFromNote($sid, $value);
				//echo $value; echo " ";
				if ($isdeleted) {
                	foreach ($GLOBALS['Note'] as $i=>$item) {
                    	if ((string)$item['id'] == $value) {
                        	unset($GLOBALS['Note'][$i]);
                        	break;
                    	}
                	}
            	}
			
			}
			header('Location: index.php?p=supportlist');
			
			
        }  
		
        if(isset($_GET['clear'])){
            // удалить файл кеша корзины и избранного
            Cache_my::DelCacheBatchGetUserData($sid);

            $isdeleted = $otapilib->ClearNote($sid);
            if ($isdeleted) {
                $GLOBALS['Note'] = array();
            }
        }
        
        $items = $GLOBALS['Note'];
        if ($items === false) show_error($otapilib->error_message);
        $this->tpl->assign('list', $items);
    }
    
    static function AddItemToNote($otapilib1, $id, $quantity)
    {
        global $otapilib;

        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();

        // удалить файл кеша корзины и избранного
        Cache_my::DelCacheBatchGetUserData($sid);

        return $otapilib->AddItemToNote(
            $sid, $id, $quantity,
            $_GET['itemTitle'], $_GET['configurationId'], @$_GET['promoId'], $_GET['categoryId'], $_GET['categoryName'],
            $_GET['price'], $_GET['currencyName'],
            '', $_GET['pictureURL'], $_GET['vendorId'],
            $_GET['itemConfiguration'], $_GET['weight']);
    }

    /**
     * @param RequestWrapper $request
     */
    public function addAction($request){
        global $otapilib;
        $otapilib->setErrorsAsExceptionsOn();

        try{
            $res = $otapilib->AddItemToNote(
                Session::getUserOrGuestSession(),
                $request->getValue('id'),
                $request->getValue('quantity'),
                $request->getValue('itemTitle'),
                $request->getValue('configurationId'),
                $request->getValue('promoId'),
                $request->getValue('categoryId'),
                $request->getValue('categoryName'),
                $request->getValue('price'),
                $request->getValue('currencyName'),
                $request->getValue('externalURL'),
                $request->getValue('pictureURL'),
                $request->getValue('vendorId'),
                $request->getValue('itemConfiguration'),
                $request->getValue('weight')
            );

            $items = $otapilib->GetNote(Session::getUserOrGuestSession());

            Cache_my::DeleteMethodCacheById('BatchGetUserData', Session::getUserOrGuestSession());

            print json_encode(array('Success'=>'Ok', 'Count' => count($items), 'itemId' => $res));
        }
        catch(ServiceException $e){
            header('HTTP/1.1 500 ' . $e->getErrorCode());
            die($e->getMessage());
        }
        catch(Exception $e){
            header('HTTP/1.1 500 ' . $e->getCode());
            die($e->getMessage());
        }
    }
    
    static function removeItem($otapilib, $id){
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();

        // удалить файл кеша корзины и избранного
        Cache_my::DelCacheBatchGetUserData($sid);

        $otapilib->RemoveItemFromNote($sid, $id);
    }
    
    static function editItemQuantity($otapilib, $id, $quantity){

        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();

        // удалить файл кеша корзины и избранного
        Cache_my::DelCacheBatchGetUserData($sid);

        $res = $otapilib->EditNoteItemQuantity($sid, $id, $quantity);
        if($res){
            print json_encode($otapilib->GetNote($sid));
        }
    }
    
    static function editItemComment($otapilib, $id, $comment){

        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();

        // удалить файл кеша корзины и избранного
        Cache_my::DelCacheBatchGetUserData($sid);

        $fields = '<Fields><FieldInfo Name="Comment" Value="'.$comment.'"/></Fields>';

        return $otapilib->EditNoteItemFields($sid, $id, $fields);
    }

    static function moveToBasket($id){
        global $otapilib;
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();

        // удалить файл кеша корзины и избранного
        Cache_my::DelCacheBatchGetUserData($sid);

        $otapilib->MoveItemFromNoteToBasket($sid, $id);
        return true;
    }
}

?>