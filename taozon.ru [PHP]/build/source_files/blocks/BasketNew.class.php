<?php

class BasketNew extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'basketnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;

        Session::checkErrors();

        $loggedIn = false;
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData']) && $_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated']) {
            $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
            $loggedIn = true;
        }
        else $sid = session_id();
        
		$allBasket = $otapilib->BatchGetUserData($sid,'Basket');		
		$GLOBALS['Basket'] = $allBasket['Basket']['Elements'];
		$GLOBALS['BasketFull'] = $allBasket['Basket'];
		
        if(isset($_GET['del'])){
            // удалить файл кеша корзины и избранного
            Cache_my::DelCacheBatchGetUserData($sid);

            $isDeleted = $otapilib->RemoveItemFromBasket($sid, $_GET['del']);
            if($isDeleted === false){
                show_error();
            }
            else{
                header('Location: '.$_SERVER['HTTP_REFERER']);
                return ;
            }
        }
		
		if(isset($_POST['setconfig'])){
            // удалить файл кеша корзины и избранного
            Cache_my::DelCacheBatchGetUserData($sid);

            $isDeleted = $otapilib->RemoveItemFromBasket($sid, $_POST['setconfig']);
            if($isDeleted === false){
                show_error();
            }      
			$request = new RequestWrapper();
			
			$otapilib->setErrorsAsExceptionsOn();
        	try{
            	$res = $otapilib->AddItemToBasket(
               	 	Session::getUserOrGuestSession(),
                	$request->getValue('item_id'),
                	$request->getValue('quantity'),
               		$request->getValue('itemTitle'),
                	$request->getValue('newconfig'),
                	$request->getValue('promoId'),
                	$request->getValue('categoryId'),
                	$request->getValue('categoryName'),
                	$request->getValue('price'),
                	$request->getValue('currencyName'),
                	$request->getValue('externalURL'),
                	$request->getValue('pictureURL'),
               		$request->getValue('vendorId'),
                	$request->getValue('itemConfiguration'),
                	$request->getValue('itemConfigurationChina'),
                	'',
                	$request->getValue('weight')
            	);
            	           
        	}
        	catch(ServiceException $e){
            	header('HTTP/1.1 500 ' . $e->getErrorCode());
            	die($e->getMessage());
       		 }
        	catch(Exception $e){
           		header('HTTP/1.1 500 ' . $e->getCode());
            	die($e->getMessage());
        	}
			header('Location: ' . General::generateUrl('content', 'basket'));
			
        }
        
        if(isset($_GET['clear'])){
            // удалить файл кеша корзины и избранного
            Cache_my::DelCacheBatchGetUserData($sid);

            $isdeleted = $otapilib->ClearBasket($sid);
            if ($isdeleted) {
                $GLOBALS['Basket'] = array();
                header('Location: ' . General::generateUrl('content', 'basket'));
            }
        }

        $items = $GLOBALS['Basket'];
        $userdiscount = $otapilib->GetDiscountGroup($sid);
        if ($items === false)
            show_error($otapilib->error_message);
        $this->tpl->assign('loggedIn', $loggedIn);
        $this->tpl->assign('userdiscount', $userdiscount);
        $this->tpl->assign('list', $items);
    }
    
    /**
     * @param RequestWrapper $request
     */
    public function addAction($request){
        global $otapilib;
        $otapilib->setErrorsAsExceptionsOn();

        try{
            $res = $otapilib->AddItemToBasket(
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
                $request->getValue('itemConfigurationChina'),
                '',
                $request->getValue('weight')
            );

            $items = $otapilib->GetBasket(Session::getUserOrGuestSession());

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

    static function editItemQuantity($otapilib, $id, $quantity){
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();

        // удалить файл кеша корзины и избранного
        Cache_my::DelCacheBatchGetUserData($sid);

        $res = $otapilib->EditBasketItemQuantity($sid, $id, $quantity);
        $error = ($res === false) ? (string)$otapilib->error_message : '';

        $basket = $otapilib->BatchGetUserData($sid, 'Basket');
        $basket['error'] = $error;
        @define('NO_DEBUG', 1);
        print json_encode($basket);
    }
    
    static function editItemComment($otapilib, $id, $comment){
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();

        // удалить файл кеша корзины и избранного
        Cache_my::DelCacheBatchGetUserData($sid);

        $fields = '<Fields><FieldInfo Name="Comment" Value="'.$comment.'"/></Fields>';
        return $otapilib->EditBasketItemFields($sid, $id, $fields);
    }
    
    
    static function editItemWeight($otapilib, $id, $weight){
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();

        // удалить файл кеша корзины и избранного
        Cache_my::DelCacheBatchGetUserData($sid);

        $fields = '<Fields><FieldInfo Name="Weight" Value="'.$weight.'"/></Fields>';
        $otapilib->EditBasketItemFields($sid, $id, $fields);
        print json_encode($otapilib->GetBasket($sid));
    }

    public function moveToFavouritesAction($id){
        global $otapilib;
        $otapilib->setErrorsAsExceptionsOn();

        try{
            $sid = Session::getUserSession();
            Cache_my::DelCacheBatchGetUserData($sid);
            $otapilib->MoveItemFromCartToNote($sid, $id);
        }
        catch(ServiceException $e){
            Session::setError($e->getMessage(), $e->getErrorCode());
        }
        catch(Exception $e){
            Session::setError($e->getMessage(), $e->getCode());
        }

        header('Location: ' . General::generateUrl('content', 'basket'));
    }
}

?>