<?php

OTBase::import('system.lib.service.*');

class BasketNew extends GenerateBlock
{
    protected $_template = 'basketnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
    protected $defaultAction = 'list';
    private $baseUrl;

    /**
     * @var UrlWrapper
     */
    private $urlWithoutSearch;
    private $userData;

    public function __construct()
    {
        parent::__construct(true);
        $this->otapilib->setErrorsAsExceptionsOn();
        $this->baseUrl = new UrlWrapper();
        $this->baseUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $this->clearUrl = new UrlWrapper();
        $this->clearUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $this->userData = new UserData();
    }

    public function listAction($request)
    {
        Session::checkErrors();
        $perpage = $this->getAndAssignPerPageItemCount();
        $page = (int)$this->request->get('page', 1);
        $this->prepareBaseUrl();

        $sid = Session::getUserOrGuestSession();

        $this->otapilib->setErrorsAsExceptionsOn();
        try {  
            $loggedIn = false;
			if (Session::get(Session::getHttpHost() . 'isMayAuthenticated')) {
                //Считаем что авторизованы
                $allUserBasketData = $this->otapilib->BatchGetUserData($sid, 'UserStatus,Basket');                
                if ($allUserBasketData['Status']['IsSessionExpired'] == 'false') {
                    Session::set(Session::getHttpHost() . 'isMayAuthenticated', true);
                    $loggedIn = true;
                } else {
                    Session::clearUserData();
                    $loggedIn = false;
                }
                $allBasket = $allUserBasketData['Basket'];
            } else {
                //Неавторизованы или неизвестно (все равно вызовем просто GetBasket :) )
                $allBasket = $this->otapilib->GetBasket($sid);
            }			
            if ($this->isAdditionalPriceIncludeInternalDeliveryPerVendor($allBasket)) {
                $this->setTemplate('basket_for_fixed_internal_delivery');
                $perpage = 10000;
            }

            $GLOBALS['Basket'] = $allBasket;

            $basket = new BasketRecord($allBasket['Elements']);
            if ($loggedIn) {
                $this->tpl->assign('userdiscount', $this->otapilib->GetDiscountGroup($sid));
            }
            $this->tpl->assign('loggedIn', $loggedIn);
            $this->tpl->assign('from', ($page - 1) * $perpage);            
            $this->tpl->assign('taobaoItems', $basket->getTaoItems(($page - 1) * $perpage, $perpage));
            $this->tpl->assign('whItems', $basket->getWhItems(($page - 1) * $perpage, $perpage));
            $this->tpl->assign('basket', $basket);
            $this->tpl->assign('paginatorTao', new Paginator($basket->getTaoItemsCount(), $page, $perpage));
            $this->tpl->assign('paginatorWh', new Paginator($basket->getWhItemsCount(), $page, $perpage));
        }
        catch(ServiceException $e){
            Session::setError($e->getMessage(), $e->getErrorCode());
        }
        catch(Exception $e){
            Session::setError($e->getMessage(), $e->getCode());
        }
    }

    private function isAdditionalPriceIncludeInternalDeliveryPerVendor($allBasket)
    {
        if (isset($allBasket['CollectionSummaries']['Taobao']['AdditionalPriceInfoList']['Elements']) && isset($allBasket['CollectionSummaries']) && isset($allBasket['CollectionSummaries']['Taobao'])) {
            foreach ($allBasket['CollectionSummaries']['Taobao']['AdditionalPriceInfoList']['Elements'] as $additionalPriceInfo) {
                if ((isset($additionalPriceInfo['Type'])) && ($additionalPriceInfo['Type'] == 'InternalDeliveryPerVendor')) {
                    return true;
                }
            }
        }
        return false;
    }

    public function changeConfigAction($request)
    {
        $basketItemId = $request->getValue('setconfig');
        $sid = Session::getUserOrGuestSession();
        if (! empty($basketItemId)) {
            $isDeleted = $this->otapilib->RemoveItemFromBasket($sid, $basketItemId);
            if($isDeleted === false){
                show_error();
            }

            $quantity = ((int)$request->getValue('quantity') <= 0) ? 1 : (int)$request->getValue('quantity');
            $this->otapilib->setErrorsAsExceptionsOn();
            
            try{
                $res = $this->otapilib->AddItemToBasket(
                    $sid,
                    $request->getValue('item_id'),
                    $quantity,
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
                    $request->getValue('weight'),
                    $request->getValue('ItemURL')
                );

            } catch (Exception $e) {
                header('HTTP/1.1 500 ' . $e->getCode());
                die($e->getMessage());
            }
            header('Location: ' . General::generateUrl('content', 'basket'));
        }
    }

    private function getAndAssignPerPageItemCount()
    {
        $default_perpage = General::getConfigValue('default_perpage', 16);
        $perpage = $this->request->getValue('perpage', $default_perpage);
        $this->tpl->assign('perpage', $perpage);
        return $perpage;
    }

    private function prepareBaseUrl()
    {
        $this->clearUrl->DeleteKey('page');

        if ($this->request->post('perpage')) {
            $this->baseUrl->DeleteKey('perpage')->Add('perpage', $this->request->post('perpage'));
            $this->baseUrl->DeleteKey('page');
        }

        if ($this->request->getMethod() == 'POST') {
            $this->request->LocationRedirect($this->baseUrl->Get());
        }

        $this->baseUrl->DeleteKey('page');

        if (strpos($this->baseUrl->Get(),'?')) {
            $pageURL = $this->baseUrl->Get()."&";
        } else {
            $pageURL = $this->baseUrl->Get()."?";
        }

        $this->tpl->assign('pageUrl', $pageURL);
        $this->tpl->assign('clearUrl', $this->clearUrl->Get());
    }

    /**
     * @param RequestWrapper $request
     */
    public function addAction($request)
    {
        $quantity = ((int)$request->getValue('quantity') <= 0) ? 1 : (int)$request->getValue('quantity');
        $this->otapilib->setErrorsAsExceptionsOn();

        try {
            $res = $this->otapilib->AddItemToBasket(
                Session::getUserOrGuestSession(),
                $request->getValue('id'),
                $quantity,
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
                $request->getValue('weight'),
                $request->getValue('ItemURL')
            );

            $items = $this->otapilib->GetBasket(Session::getUserOrGuestSession());
            $this->userData->ClearUserDataCache();

            $count = 0;
            if (isset($items['Elements']) && is_array($items['Elements'])) {
                $count = count($items['Elements']);
            }
            print json_encode(array('Success'=>'Ok', 'Count' => $count, 'itemId' => $res));
        }
        catch (ServiceException $e) {
            header('HTTP/1.1 500 ' . $e->getErrorCode());
            if ($e->getErrorCode() == 'NotAvailable') {
                $error = Lang::get('NotAvailable');
            } else {
                $error = $e->getMessage();
            }
            die($error);
        }
        catch (Exception $e) {
            header('HTTP/1.1 500 ' . $e->getCode());
            die($e->getMessage());
        }
    }

    /**
     * @param RequestWrapper $request
     */
    public function deleteAction($request)
    {
        try{
            $this->otapilib->setErrorsAsExceptionsOn();
            $this->otapilib->RemoveItemFromBasket(Session::getUserOrGuestSession(), $request->getValue('del'));
            $this->userData->ClearUserDataCache();
        }
        catch(ServiceException $e){
            Session::setError($e->getMessage(), $e->getErrorCode());
        }
        header('Location: '.$request->RedirectToReferrer());
    }
    
    /**
     * @param RequestWrapper $request
     */
    public function deleteGroupAction($request)
    {
        try{
            $itms = explode("|", $this->request->get('delGroup'));
            foreach ($itms as $key => $value) {
               $this->otapilib->RemoveItemFromBasket(Session::getUserOrGuestSession(), $value);
            }
            $this->userData->ClearUserDataCache();
        }
        catch(ServiceException $e){
            Session::setError($e->getMessage(), $e->getErrorCode());
        }
        header('Location: '.$request->RedirectToReferrer());
    }

    /**
     * @param RequestWrapper $request
     */
    public function deleteAllAction($request)
    {
        try{
            $this->otapilib->setErrorsAsExceptionsOn();
            $this->otapilib->ClearBasket(Session::getUserOrGuestSession());
            $this->userData->ClearUserDataCache();
        }
        catch(ServiceException $e){
            Session::setError($e->getMessage(), $e->getErrorCode());
        }
        header('Location: '.$request->RedirectToReferrer());
    }

    public static function editItemQuantity($otapilib, $id, $quantity)
    {
        $sid = Session::getUserOrGuestSession();       
        $error = '';
        try {
            $res = $otapilib->EditBasketItemQuantity($sid, $id, $quantity);
        } catch (ServiceException $e) {
            $error = $e->getMessage();
        } catch (Exception $e) {
            $error = Lang::get('otapi_request_error');
        }
        if (! $error) {
            $error = ($res === false) ? (string)$otapilib->error_message : '';
        }
		
		$allBasket = $otapilib->GetBasket($sid);
        $basket['error'] = $error;
        $record = new BasketRecord($allBasket);
        $basket['Basket'] = $record->asArray();

        $elementsTotalCost = 0;
        foreach ($basket['Basket']['elements'] as $item) {
            $elementsTotalCost += $item['Cost'];
        }
        $basket['ElementsCost'] = $elementsTotalCost;

        @define('NO_DEBUG', 1);
        print json_encode($basket);
        die();
    }

    public static function editItemComment($otapilib, $id, $comment)
    {
        $sid = Session::getUserOrGuestSession();
        $fields = '<Fields><FieldInfo Name="Comment" Value="'.$comment.'"/></Fields>';
        return $otapilib->EditBasketItemFields($sid, $id, $fields);
    }


    public static function editItemWeight($otapilib, $id, $weight)
    {
        $sid = Session::getUserOrGuestSession();
        $fields = '<Fields><FieldInfo Name="Weight" Value="'.$weight.'"/></Fields>';
        $otapilib->EditBasketItemFields($sid, $id, $fields);
        print json_encode($otapilib->GetBasket($sid));
    }

    public function moveToFavouritesAction($id)
    {
        $this->otapilib->setErrorsAsExceptionsOn();

        try{
            $sid = Session::getUserOrGuestSession();            
            $this->otapilib->MoveItemFromCartToNote($sid, $id);
            $this->userData->ClearUserDataCache();
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
