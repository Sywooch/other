<?php

class PrivateOffice extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'maininfo'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/privateoffice/';

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
    }

    protected function setVars()
    {
        global $otapilib;
        if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData'])||!$_SESSION[CFG_SITE_NAME.'loginUserData']['IsAuthenticated'])
            header('Location: index.php?p=login');

        $error = '';

        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];

        if(@$_POST['action'] == 'personal_account_pay'){
            $salesId = $_POST['salesId'];
            $amount = $_POST['amount'];

            $res = $otapilib->PaymentPersonalAccount($sid, $salesId, $amount);
            if($res === false) {
                show_error();
            } else {
                $accountinfo = $otapilib->GetAccountInfo($_SESSION[CFG_SITE_NAME.'loginUserData']['sid']);
                self::sendEmail($salesId, $amount, $accountinfo['currencysign']);
                //header('Location: '.$_SERVER['REQUEST_URI']);
                header('Location: index.php?p=privateoffice');
            }
        }

        if(isset($_GET['orderstate'])){
            $this->_orders($_GET['orderstate']);
        }

        if(isset($_GET['cancelorder'])){

            $this->_cancelOrder($sid, $_GET['cancelorder']);

            header('Location:index.php?p=privateoffice');

        } elseif(isset($_GET['closelorder'])) {

            $this->_closeOrder($sid, $_GET['closelorder']);

            header('Location:index.php?p=privateoffice');

        }elseif(isset($_GET['moneyinfo'])) {

            $this->_moneyInfo($sid);

        } elseif(isset($_GET['orderid']) && !isset($_GET['pay'])) {

            $this->_showOrderDetails($sid);

        } elseif(isset($_GET['pay'])) {

            if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData'])){
                header('Location: index.php?p=login');
            }

            if( isset($_GET['deposit']) ){
                $GLOBALS['title'] = Lang::get('payments');
            }

            $this->_pay();
        } else {
            $this->_mainInfo($sid);
            if(isset($_GET['message'])){
                $this->tpl->assign('message', $_GET['message']);
            }
            if(isset($_GET['error'])){
                $this->tpl->assign('error', $_GET['error']);
            }
            if(isset($_GET['success'])){
                $this->tpl->assign('success', $_GET['success']);
            }
        }
    }

    private function _orders($order = 1)
    {

    }

    private function _cancelOrder($sid, $id)
    {
        global $otapilib;

        $res = $otapilib->CancelSalesOrder($sid, $id);

    }

    private function _closeOrder($sid, $id)
    {
        global $otapilib;
        $res = $otapilib->CloseOrder($sid, $id);
    }

    private function _mainInfo($sid)
    {
        global $otapilib;
        $this->_template = 'maininfo';
        if (CFG_MULTI_CURL)
        {
            // С мультипотоками

            // Инициализируем
            $otapilib->InitMulti();

            $orders = $otapilib->GetSalesOrdersList($sid, 0);
            $accountinfo = $otapilib->GetAccountInfo($sid);
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
            }
            if(CMS::IsFeatureEnabled('Discount'))
                $userdiscount = $otapilib->GetDiscountGroup($sid);
            $ticketlist = $otapilib->GetTicketInfoList($sid, 'In');

            // Делаем запросы
            $otapilib->MultiDo();

            $orders = $otapilib->GetSalesOrdersList($sid, 0);
            $accountinfo = $otapilib->GetAccountInfo($sid);
            //var_dump($accountinfo);
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
                $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
            }
            if(CMS::IsFeatureEnabled('Discount'))
                $userdiscount = $otapilib->GetDiscountGroup($sid);
            $ticketlist = $otapilib->GetTicketInfoList($sid, 'In');

            // Сбрасываем
            $otapilib->StopMulti();
        } else {
            // По старому
            $orders = $otapilib->GetSalesOrdersList($sid, 0);
            $accountinfo = $otapilib->GetAccountInfo($sid);
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
                $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
            }
            if(CMS::IsFeatureEnabled('Discount'))
                $userdiscount = $otapilib->GetDiscountGroup($sid);
            $ticketlist = $otapilib->GetTicketInfoList($sid, 'In');
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

        if ($otapilib->error_message == 'SessionExpired')
        {
            Users::Logout();
            header('Location: index.php?p=login');
        }
        $user = array();

        foreach($userinfo as $key=>$value){
            $key = strtolower((string)$key);
            if(!isset($user[$key]))  $user[$key] = (string)$value;
        }
        unset($user['isemailverified']);
        unset($user['id']);
        unset($user['isactive']);
        unset($user['password']);
        unset($user['login']);

        $this->tpl->assign('orders', $orders);
        $this->tpl->assign('orders_active', $orders_active);
        $this->tpl->assign('orders_complited', $orders_complited);
        $this->tpl->assign('orders_canceled', $orders_canceled);
        $this->tpl->assign('orders_waited', $orders_waited);
        $this->tpl->assign('pay_info', false);
        if(CMS::IsFeatureEnabled('Discount'))
            $this->tpl->assign('userdiscount', $userdiscount);
        $this->tpl->assign('userinfo', $user);
        $this->tpl->assign('accountinfo', $accountinfo);
        $this->tpl->assign('ticketlist', $ticketlist);

    }

    private function _moneyInfo($sid)
    {
        global $otapilib;

        $this->_template = 'moneyinfo';

        $result = Plugins::onRenderMoneyInfo($sid);
        if($result){
            if(is_array($result))
                foreach($result as $k=>$v){
                    $this->tpl->assign($k, $v);
                }
            return ;
        }

        if (!isset($_POST['fromdate'])) {
            $_POST['fromdate'] = date('m/d/Y', time() - 30*24*3600);
        }
        if (!isset($_POST['todate'])) {
            $_POST['todate'] = date('m/d/Y', time());
        }

        $fromdate = $this->_formateDate($_POST['fromdate']);
        $todate = $this->_formateDate($_POST['todate']);

        if (CFG_MULTI_CURL)
        {
            // С мультипотоками

            // Инициализируем
            $otapilib->InitMulti();
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
            }
            $accountinfo = $otapilib->GetAccountInfo($sid);
            $moneyhistory = $otapilib->GetStatement($sid, $fromdate, $todate);
            // Делаем запросы
            $otapilib->MultiDo();
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
                $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
            }
            $accountinfo = $otapilib->GetAccountInfo($sid);
            $moneyhistory = $otapilib->GetStatement($sid, $fromdate, $todate);
            // Сбрасываем
            $otapilib->StopMulti();
        } else {
            // По старому
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
                $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
            }
            $accountinfo = $otapilib->GetAccountInfo($sid);
            $moneyhistory = $otapilib->GetStatement($sid, $fromdate, $todate);
        }
        //var_dump($moneyhistory); echo 'error='.$otapilib->error_message;
        $this->tpl->assign('userinfo', $userinfo);
        $this->tpl->assign('accountinfo', $accountinfo);
        $this->tpl->assign('moneyhistory', $moneyhistory);
    }

    private function _showOrderDetails($sid)
    {
        global $otapilib;

        if(!isset($_GET['orderid']))
        {
            header('Location:index.php?p=privateoffice');
        }

        $order = $_GET['orderid'];

        $this->_template = 'order';

        if (CFG_MULTI_CURL)
        {
            // С мультипотоками

            // Инициализируем
            $otapilib->InitMulti();
            $order_info = $otapilib->GetSalesOrderDetails($sid, $order);
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
            }
            $accountinfo = $otapilib->GetAccountInfo($sid);
            $shippinginfo = $otapilib->GetSalesOrderShippings($sid, $order);
            // Делаем запросы
            $otapilib->MultiDo();
            $order_info = $otapilib->GetSalesOrderDetails($sid, $order);
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
                $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
            }
            $accountinfo = $otapilib->GetAccountInfo($sid);
            $shippinginfo = $otapilib->GetSalesOrderShippings($sid, $order);
            // Сбрасываем
            $otapilib->StopMulti();
        } else {
            // По старому
            $order_info = $otapilib->GetSalesOrderDetails($sid, $order);
            if (isset($GLOBALS['$otapilib->GetUserInfo']))
            {
                $userinfo = $GLOBALS['$otapilib->GetUserInfo'];
            } else {
                $userinfo = $otapilib->GetUserInfo($sid);
                $GLOBALS['$otapilib->GetUserInfo'] = $userinfo;
            }
            $accountinfo = $otapilib->GetAccountInfo($sid);
            $shippinginfo = $otapilib->GetSalesOrderShippings($sid, $order);
        }

        $user = array();

        foreach($userinfo as $key=>$value){
            $key = strtolower((string)$key);
            if(!isset($user[$key]))  $user[$key] = (string)$value;
        }

        $GLOBALS['amount'] = (string)$order_info['salesorderinfo']['remainamount'];
        $Pay = new Pay();
        $P = $Pay->Generate();
        $this->tpl->assign('Pay', $P);

        unset($user['isemailverified']);
        unset($user['id']);
        unset($user['isactive']);
        unset($user['password']);
        unset($user['login']);

        $StatusList = array(
            Lang::get('ordered_goods'),
            Lang::get('goods_in_handling'),
            Lang::get('cancelled_goods'),
            Lang::get('goods_with_questions')
        );
        $order_info['saleslineslist'] = $this->_filterGoods($order_info['saleslineslist'],$StatusList);
        $this->tpl->assign('StatusList', $StatusList);
        $this->tpl->assign('accountinfo', $accountinfo);
        $this->tpl->assign('shippinginfo', $shippinginfo);
        $this->tpl->assign('orderid', $order);
        $this->tpl->assign('user_info', $user);
        if (defined('CFG_WEBPHOTO'))
        {
            //
            foreach($order_info['saleslineslist'] as &$item)
            {
                $g = glob('files/ItemCam/thumbs/'.$order.'-'.$item['id'].'*.jpg');
                if(!$g) $g = array();
                $names = array();
                for($i=0,$z=count($g);$i<$z;$i++)
                {
                    $path = explode('/',$g[$i]);
                    $names[$i] = array_pop($path);
                }
                $item['operatorimages'] = $names;
                //print_r($item['operatorimages']);
            }
        }
        $this->tpl->assign('order_info', $order_info);
    }

    private function _filterGoods($goodsList,$filterTerms) {
        if (!isset($_GET['filter']['state'])||empty($_GET['filter']['state']))
            return $goodsList;
        $result = array();
        foreach ($goodsList as $good){
            if ($_GET['filter']['state']==$filterTerms[0]){
                if ($good['StatusId']==4)
                    $result[] = $good;
            }
            elseif ($_GET['filter']['state']==$filterTerms[1]){
                if ($good['StatusId']==2)
                    $result[] = $good;
            }
            elseif ($_GET['filter']['state']==$filterTerms[2]){
                if ($good['StatusId']==13)
                    $result[] = $good;
            }
            elseif ($_GET['filter']['state']==$filterTerms[3]){
                if ($good['StatusId']==3||$good['StatusId']==5||$good['StatusId']==12)
                    $result[] = $good;
            }
        }
        return $result;
    }

    private function _pay()
    {
        $this->_template = 'pay';
        $Pay = new Pay();
        $P = $Pay->Generate();
        $this->tpl->assign('Pay', $P);
    }

    private function _formateDate($date)
    {
        $date_array = explode('/', $date);
        return $date_array[1].'.'.$date_array[0].'.'.$date_array[2];
    }

    static function createTicket($otapilib, $fields)
    {
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];

        $reg = $otapilib->CreateTicket($sid, $fields['SalesId'], $fields['CategoryId'], $fields['Subject'], $fields['Text']);

        return $reg;

    }

    static function sendEmail ($order_id, $pay, $sign = '') {
        $cms = new CMS();
        $cms->Check();
        $r = $cms->getSiteConfig();
        if ($r[0] && isset($r[1]['notification_email']) && $r[1]['notification_email']) {
            $email = str_replace(" ", "", $r[1]['notification_email']);
            $email = explode(';', $email);
            
            foreach ($email as $item) {
                if (filter_var($item, FILTER_VALIDATE_EMAIL)) {
                    $to = $item;
                    $subject  = Lang::get('made_payment').' '.$order_id;
                    $message  = $subject. '. '. Lang::get('made_payment_value').' '.$pay.' '.$sign;

                    $from = General::$siteConf['site_email'] ? General::$siteConf['site_email'] :
                        'orders@'.preg_replace('/^www\./','',$_SERVER['HTTP_HOST']);
                    self::mail_utf8($to, 'Order paid', $from, $subject, $message);
                }
            } 
        }
    }

    public static function mail_utf8($to, $from_user, $from_email, $subject = '(No subject)', $message = '')
    {
        $from_user = "=?UTF-8?B?".base64_encode($from_user)."?=";
        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";

        $headers = "From: $from_user <$from_email>\r\n".
            "MIME-Version: 1.0" . "\r\n" .
            "Content-type: text/html; charset=UTF-8" . "\r\n";

        return mail($to, $subject, $message, $headers);
    }}

?>