<?php
OTBase::import('system.lib.referral_system.ReferalSystem');
OTBase::import('system.lib.referral_system.lib.*');

class PrivateOffice extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'maininfo'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/privateoffice/';

    protected $request;
    protected $pristroy;
    protected $sid;

    // статусы заказа в ЛК пользователя
    const ORDER_WAITING             = 10;  // ожидает оплаты
    const ORDER_UNDER_CONSIDERATION = 20;  // на рассмотрении
    const ORDER_PROCESS             = 30;  // в обработке
    const ORDER_COMPLITE            = 40;  // завершено
    const ORDER_CANCEL              = 50;  // отменено

    // статусы товара
    const PRODUCT_IMPOSSIBLE_TO_PUT = 12;  // невозможно поставить
    const PRODUCT_UNDER_CONSIDERATION = 20;  // на рассмотрении

    public function __construct()
    {
        parent::__construct(true);
        $this->request = new RequestWrapper();
        $this->pristroy = new PristroyRepository(new CMS());

    }

    protected function setVars()
    {
        $this->otapilib->setErrorsAsExceptionsOn();
        if(! Session::isAuthenticated()){
            Users::Logout();
            header('Location: index.php?p=login');
            return ;
        }
        $this->sid = Session::getUserSession();
        if (CFG_MULTI_CURL)
        {
            // С мультипотоками
            // Инициализируем
            $this->otapilib->InitMulti();
            $orders = $this->otapilib->GetSalesOrdersList($this->sid, 0);
            $accountinfo = $this->otapilib->GetAccountInfo($this->sid);
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $this->otapilib->GetUserInfo($this->sid);
            }

            // Делаем запросы
            $this->otapilib->MultiDo();
            try{
                $orders = $this->otapilib->GetSalesOrdersList($this->sid, 0);
                $accountinfo = $this->otapilib->GetAccountInfo($this->sid);
                //var_dump($accountinfo);
                if (isset($GLOBALS['$otapilib->GetUserInfo']))
                {
                    $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
                } else {
                    $userinfo = $this->otapilib->GetUserInfo($this->sid);
                    $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
                }
            }
            catch(ServiceException $e){
                Session::setError($e->getMessage());
            }
            // Сбрасываем
            $this->otapilib->StopMulti();
        } else {
            // По старому
            try{
                $orders = $this->otapilib->GetSalesOrdersList($this->sid, 0);
                $accountinfo = $this->otapilib->GetAccountInfo($this->sid);
                if (isset($GLOBALS['$otapilib->GetUserInfo']))
                {
                    $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
                } else {
                    $userinfo = $this->otapilib->GetUserInfo($this->sid);
                    $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
                }
            }
            catch(ServiceException $e){
                Session::setError($e->getMessage());
            }
        }
        if($orders === false){
            show_error();
            $orders = array();
        }

        $orders  = array_reverse($orders);
        $orders_active = array();
        $orders_complited = array();
        $orders_canceled = array();
        $orders_waited = array();
        foreach ($orders as $order) {
            if ($order['statuscode'] == self::ORDER_COMPLITE) {
                $orders_complited[] = $order;
            } elseif($order['statuscode'] == self::ORDER_CANCEL) {
                $orders_canceled[] = $order;
            } elseif($order['statuscode'] == self::ORDER_WAITING) {
                $orders_waited[] = $order;
            } else {
                $orders_active[] = $order;
            }
        }



        $user = array();
        foreach($userinfo as $key=>$value){
            $key = strtolower((string)$key);
            if(!isset($user[$key]))  $user[$key] = (string)$value;
        }
        $Discount = new Discount();
        $userdiscount = $Discount->getDiscountData();
        // Товары пристроя.
        if (CMS::IsFeatureEnabled('FleaMarket')) {
            $this->getUserSellItems($userinfo{'id'});
        }
        //===========================
        //Гугл коммерция
        if (General::getConfigValue('google_commerce_account'))
            $this->setGoogleCommerce($orders);
        //===============
        unset($user['isemailverified']);
        unset($user['isactive']);
        unset($user['password']);
        $this->tpl->assign('orders', $orders);
        $this->tpl->assign('orders_active', $orders_active);
        $this->tpl->assign('orders_complited', $orders_complited);
        $this->tpl->assign('orders_canceled', $orders_canceled);
        $this->tpl->assign('orders_waited', $orders_waited);
        $this->tpl->assign('pay_info', false);
        $this->tpl->assign('userdiscount', $userdiscount);
        $this->tpl->assign('userinfo', $user);
        $this->tpl->assign('accountinfo', $accountinfo);

        if($this->request->valueExists('message')){
            $this->tpl->assign('message',$this->request->getValue('message') );
        }
        if($this->request->valueExists('error')){
            $this->tpl->assign('error',$this->request->getValue('error'));
        }
        if($this->request->valueExists('success')){
            $this->tpl->assign('success',$this->request->getValue('success'));
        }

    }

    public function PAPayAction () {
        $this->otapilib->setErrorsAsExceptionsOn();
        if(! Session::isAuthenticated()) {
            Users::Logout();
            header('Location: index.php?p=login');
            return ;
        }
        try {
            $this->otapilib->PaymentPersonalAccount(Session::getUserSession(), $this->request->getValue('salesId'), $this->request->getValue('amount'));
            $accountinfo = $this->otapilib->GetAccountInfo(Session::getUserSession());
            
            $data['orderid'] = $this->request->getValue('salesId');
            $data['amount'] = $this->request->getValue('amount');
            $data['currencysign'] = $accountinfo['currencysign'];
            $subject  = Lang::get('made_payment') . ' ' . OrdersProxy::normalizeOrderId($this->request->getValue('salesId'));
            Notifier::generalNotification('payment_from_account', $subject, $data);

            $userData = new UserData();
            $userData->ClearAccountInfoCache();
        } catch(ServiceException $e) {
            if (strpos((string)$e->getMessage(), 'Not enough') !== false) {
                Session::setError(Lang::get('Not_enoght_money_on_account') );
            } else {
                Session::setError($e->getMessage(), $e->getErrorCode());
            }
        }
        header('Location: index.php?p=privateoffice');
    }

    public function CancelOrderAction () {
            $this->otapilib->setErrorsAsExceptionsOn();
            if(! Session::isAuthenticated()){
                Users::Logout();
                header('Location: index.php?p=login');
                return ;
            }
            $this->sid = Session::getUserSession();
            try{
                $res = $this->otapilib->CancelSalesOrder($this->sid, $this->request->getValue('order_id'));
            }
            catch(ServiceException $e){
                Session::setError($e->getMessage());
            }
            header('Location:index.php?p=privateoffice');
    }

    public function ConfirmShipmentAction ()
    {
        $this->otapilib->setErrorsAsExceptionsOn();
        if(! Session::isAuthenticated())
        {
            Users::Logout();
            header('Location: index.php?p=login');
            return ;
        }
        $this->sid = Session::getUserSession();
        try{
            $res = $this->otapilib->ConfirmOrderPackaging($this->sid, $this->request->getValue('order_id'));
        }
        catch(ServiceException $e){
            Session::setError($e->getMessage());
        }
        header('Location:index.php?p=privateoffice');
    }

    public function CloselOrderAction () {
            $this->otapilib->setErrorsAsExceptionsOn();
            if(! Session::isAuthenticated()){
                Users::Logout();
                header('Location: index.php?p=login');
                return ;
            }
            $this->sid = Session::getUserSession();
            try{
                $res = $this->otapilib->CloseOrder($this->sid, $this->request->getValue('order_id'));
            }
            catch(ServiceException $e){
                Session::setError($e->getMessage());
            }
            header('Location:index.php?p=privateoffice');
    }

    /**
     * @param RequestWrapper $request
     */
    public function confirmNewItemPriceInOrderAction($request){
        $this->otapilib->setErrorsAsExceptionsOn();
        $itemId = RequestWrapper::get('itemid');
        $orderId = RequestWrapper::get('orderid');
        $sid = Session::getUserDataSid();
        try{
            $this->otapilib->ConfirmPriceLineSalesOrder($sid, $orderId, $itemId);
            Notifier::generalNotification('on_order_status_changed_to_admin', Lang::get('new_item_price_confirmed_subject', array(
                'orderId' => OrdersProxy::normalizeOrderId($orderId),
                'itemId' => $itemId,
            )), array(
                'username' => 'Admin',
                'orderid' => $orderId,
                'oldstatus' => Lang::get('awaiting_price_confirm'),
                'newstatus' => Lang::get('price_confirmed'),
                'item' => $itemId
            ));
        } catch (ServiceException $e) {
            $this->throwAjaxError($e);
        }
    }

    public static function createTicket($otapilib, $fields)
    {
        $sid = Session::getUserSession();
        $otapilib->setErrorsAsExceptionsOn();
        try{
            $reg = $otapilib->CreateTicket($sid, $fields['SalesId'], $fields['CategoryId'], $fields['Subject'], $fields['Text']);
        }
        catch(ServiceException $e){
            Session::setError($e->getMessage());
        }

        return $reg;

    }

    private function getUserSellItems($userId)
    {
        $user_items = $this->pristroy->getListByUserId($userId,null,'All');
        $SellingItems = array();
        foreach($user_items as $item){
            $tmp['Id'] = $item['item_id'];
            $tmp['id'] = $tmp['Id'];
            $tmp['Qty'] = $item['quantity'];
            $tmp['qty'] = $tmp['Qty'];
            $tmp['ItemImageURL'] = $item['images'][0];
            $tmp['itemimageurl'] = $tmp['ItemImageURL'];
            $item['created_at'] = strtotime($item['created_at']);
            $item['created_at'] = date('Y-m-d H:i:s', $item['created_at']);
            $tmp['pristroy'] = $item;
            $SellingItems[]=$tmp;
        }
        $this->tpl->assign('SellingItems', $SellingItems);
    }

    private function setGoogleCommerce($orders)
    {
        $orders_payed = array();
        $orders_transfer = array();
        $orders_transfer_js = array();
        foreach ($orders as $order) {
            if($order['statuscode'] == self::ORDER_UNDER_CONSIDERATION)
                $orders_payed[] = $order;
        }

        $GCR = new GoogleCommerceRepository(new CMS());
        $tmp = array();
        foreach($orders_payed as $order){
            if (!$GCR->CheckOrder($order['id'],(float)$order['totalamount'])) {
                $tmp[] = $order;
                $tmp_js['id'] = $order['id'];
                $tmp_js['amount'] = (float)$order['totalamount'];
                $orders_transfer_js[] = $tmp_js;
            }
        }

        if (CFG_MULTI_CURL) {
            $this->otapilib->InitMulti();
            foreach($tmp as $order){
                $order_info = $this->otapilib->GetSalesOrderDetails($this->sid, $order['id']);
            }
            $this->otapilib->MultiDo();
        }
        foreach($tmp as $order){
            $order_info = $this->otapilib->GetSalesOrderDetails($this->sid, $order['id']);
            $orders_transfer[] = $order_info;
        }
        if (CFG_MULTI_CURL)
            $this->otapilib->StopMulti();

        $this->tpl->assign('orders_transfer', $orders_transfer);
        $this->tpl->assign('orders_transfer_js', $orders_transfer_js);

    }
    
    public function setTransferedOrdersAction($request)
    {       
        $GCR = new GoogleCommerceRepository(new CMS());
        try {
            $GCR->checkAndSaveOrders($this->request->post('orders'));
        } catch (DBException $e) {
            Session::setError($e->getMessage(), 'DBError_GoogleCommerce');                
        }            
    }
    
}
