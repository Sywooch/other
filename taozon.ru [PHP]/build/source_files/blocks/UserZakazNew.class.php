<?php

/*
 * Шаги при оформлении заказа
 * 
 * step1 - назначение веса для товара
 * step2 - выбор заказа: новый заказ или дозаказ
 * step3 - выбор подходящей модели доставки
 * step4 - все данные для оформления заказа
 */

class UserZakazNew extends GenerateBlock {

    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'userzakaznew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/order/';

    public function __construct() {
        parent::__construct(true);
    }

    protected function setVars() {
        global $otapilib;
        
        if (isset($_SESSION[CFG_SITE_NAME . 'loginUserData']))
            $sid = $_SESSION[CFG_SITE_NAME . 'loginUserData']['sid'];
        else
            $sid = session_id();
		
		
		
		
        if (isset($_GET['step1'])) {
            if (!isset($_SESSION[CFG_SITE_NAME . 'loginUserData'])) {
                header('Location: index.php?p=login');
            }
			if (General::getSiteConfig('hide_step_weight_order')) {
				$this->_step2($sid);
			} else {				
				$this->_template = 'step1new';
            	$basket = $otapilib->BatchGetUserData(Session::getUserSession(), 'Basket');
            	$items = $basket['Basket']['Elements'];
            	$this->tpl->assign('list', $items);
			}
            
        } elseif (isset($_GET['step2'])) {
			
            if (!isset($_SESSION[CFG_SITE_NAME . 'loginUserData'])) {
                header('Location: index.php?p=login');
            }
            $this->_step2($sid); 
        } elseif (isset($_GET['step3'])) {

            if (!isset($_SESSION[CFG_SITE_NAME . 'loginUserData'])) {
                header('Location: index.php?p=login');
            }
            $this->_step3($sid);
        } elseif (isset($_GET['step4'])) {

            if (!isset($_SESSION[CFG_SITE_NAME . 'loginUserData'])) {
                header('Location: index.php?p=login');
            }
            $this->_step4($sid);
        } elseif (isset($_GET['createorder'])) {

            if (!isset($_SESSION[CFG_SITE_NAME . 'loginUserData'])) {
                header('Location: index.php?p=login');
            }
            $this->_createOrder($sid);
        }
    }

    public static function createOrder(){
        global $otapilib;

        if (isset($_SESSION[CFG_SITE_NAME . 'loginUserData']))
            $sid = $_SESSION[CFG_SITE_NAME . 'loginUserData']['sid'];
        else
            $sid = session_id();

        $model = @$_POST['model'];
        $comment = @(string)$_POST['comment']." \r\n ".Plugins::invokeEvent('onOrderGetDomainName');
        $weight = @$_POST['total_weight'];
        $order = (isset($_POST['order'])) ? $_POST['order'] : 'new';

        $otapilib->curl_timeout = 180;
        if ($order == 'new') {
            $r = Plugins::onCreateOrder($sid, $model);
            if($r === false)
                $r = $otapilib->CreateSalesOrder($sid, $model, $comment, $weight);
        } else {
            $r = $otapilib->RecreateSalesOrder($sid, $order, $weight);
        }
        $message = $otapilib->error_message;

        if (!$r) {
            $basket = $otapilib->GetBasket($sid);
            if(count($basket) > 0)
                return array(0, @$otapilib->error_code, @$message ? $message : Lang::get('unknown_order_process_error'));
            else
                return array(1);
        } else {
            return array(1);
        }
    }

    protected function CreateZakaz() {
        $zakaz = new Zakaz();
        $sid = session_id();
        $message = $zakaz->CreateOrderFromBasket($sid);
        $this->tpl->assign('message', $message);
    }

    protected function GetZakaz($data) {
        $zakaz = new Zakaz();
        $order = $zakaz->GetOrder($data);
        return $order;
    }

    private function _step2($sid) {
        global $otapilib;
        
		$allBasket = $otapilib->BatchGetUserData($sid,'Basket');
		$GLOBALS['Basket'] = $allBasket['Basket']['Elements'];
        $items = $GLOBALS['Basket'];
        $weight = $this->_getWeight($items);
        $_SESSION['order_weight'] = $weight;

        // 10 - заказы доступные для дозаказа
        $orders = $otapilib->GetSalesOrdersList($sid, 10);
        // если нет заказов или запрещен дозаказ, то переходим к шагу з
        if (!count($orders) || General::getSiteConfig('skip_reordering')) {
            if (strpos($_SERVER['HTTP_REFERER'], 'step3')) {
                header('Location:index.php?p=userorder&step1' );
            } else {
                header('Location:index.php?p=userorder&step3&order=new');
            }
        } else {
            $this->_template = 'step2new';
            $this->tpl->assign('orders', $orders);
            $this->tpl->assign('weight', $weight);
        }
    }

    private function _step3($sid) {
        global $otapilib;

        if (isset($_POST['total_weight']))
            $weight = $_POST['total_weight'];
        elseif (isset($_SESSION['order_weight'])) 
            $weight = $_SESSION['order_weight'];
        elseif (isset($_GET['weight']))
            $weight = $_GET['weight'];
        else {
            $items = $GLOBALS['Basket']['Elements'];
            $weight = $this->_getWeight($items);
        }

        if (isset($_POST['order']))
            $order = $_POST['order'];
        elseif (isset($_GET['order']))
            $order = $_GET['order'];
        else
            $order = 'new';
        
        if (!isset($_GET['order'])) {
            header('Location:index.php?p=userorder&step3&order='.$order);
        }

        // если у нас дозаказ
        if ($order != 'new') {
            $r = $otapilib->RecreateSalesOrder($sid, $order, $weight);
            if (!$r) {
                header('Location:index.php?p=privateoffice&message=error');
            } else {
                header('Location:index.php?p=privateoffice&message=success');
            }
        } else {
            $this->_template = 'step3new';
            
            $userData = $otapilib->GetUserInfo($sid);
            
            $countries = $otapilib->GetDeliveryCountryInfoList();
            
            $country = $userData['Country'] ? $userData['Country'] : 'Россия';
            foreach($countries as $c){
                if($c['Name'] == $country) $currentCountry = $c;
            }

            if(!isset($currentCountry)){
                $currentCountry = $countries[0];
            }

            $models = $otapilib->GetDeliveryModesWithPrice($currentCountry['Id'], $weight);

            $this->tpl->assign('countries', $countries);
            $this->tpl->assign('models', $models);
            $this->tpl->assign('weight', $weight);
            $this->tpl->assign('order', $order);


            if(is_array($userData))
            foreach ($userData as $k => $v) {
                $this->tpl->assign($k, $v);
            }
        }
    }

    private function _step4($sid) {
        global $otapilib;

        General::sessionExpiredHandle(false);
        
        if (isset($_POST['total_weight']))
            $weight = $_POST['total_weight'];
        elseif (isset($_SESSION['order_weight'])) 
            $weight = $_SESSION['order_weight'];
        elseif (isset($_GET['weight']))
            $weight = $_GET['weight'];
        else {
            $items = $GLOBALS['Basket'];
            $weight = $this->_getWeight($items);
        }

        if (isset($_POST['order']))
            $order = $_POST['order'];
        elseif (isset($_GET['order']))
            $order = $_GET['order'];
        else
            $order = 'new';

        $country = @$_POST['user']['Country'] ? @$_POST['user']['Country'] : @$_GET['country'];
        if(!$country){
            header('Location: Location:index.php?p=userorder&step3&order='.$order);
            die();
        }

        $countries = $otapilib->GetCountryInfoList();
		
        foreach($countries as $c){
            if($c['Id'] == $country) $currentCountry = $c;
        }
        if(!isset($currentCountry)){
            throw new Exception('Country '.$country.' does not exist');
        }

        if (isset($_POST['model']))
            $model_id = $_POST['model'];
        elseif (isset($_GET['model']))
            $model_id = $_GET['model'];
        else
            $model_id = '';
        
        if (isset($_POST['user'])) {
            list($success, $error) = $this->_saveProfile($_POST['user']);
            if(!$_POST['user']['RecipientLastName']){
                header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.Lang::get('no_full_name'));
                die();
            }
            if(!$_POST['user']['RecipientMiddleName']){
                header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.Lang::get('no_middlename'));
                die();
            }
            if(!$_POST['user']['RecipientFirstName']){
                header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.Lang::get('no_name'));
                die();
            }
            if(!$_POST['user']['Address']){
                header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.Lang::get('no_address'));
                die();
            }
            if(!$_POST['user']['PostalCode']){
                header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.Lang::get('no_postalcode'));
                die();
            }
            if(!$_POST['user']['City']){
                header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.Lang::get('no_city'));
                die();
            }
            if(!$_POST['user']['Phone']){
                header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.Lang::get('no_phone'));
                die();
            }
            if (!$success) {
                header('Location:index.php?p=userorder&step3&order=' . $order . '&error=' . $error);
            }
        }

        if ($model_id == '') {
            header('Location:index.php?p=userorder&step3&order=' . $order);
        }

        if (!isset($_GET['model'])) {
            header('Location:index.php?p=userorder&step4&order=' . $order . '&model=' . $model_id . '&country='.$country);
        }

        $this->_template = 'step4new';

        $basket = $otapilib->BatchGetUserData(Session::getUserSession(), 'Basket');
        $items = $basket['Basket']['Elements'];
        $models = $otapilib->GetDeliveryModesWithPrice($currentCountry['Id'], $weight);
		$userdiscount = $otapilib->GetDiscountGroup($sid);
        $model_info = array();

        foreach ($models as $model) {
            if ($model['id'] == $model_id)
                $model_info = $model;
        }

        $userinfo = $otapilib->GetUserInfo($sid);
        $userinfo = array_filter($userinfo);

        $user = array();

        foreach ($userinfo as $key => $value) {
            $key = strtolower((string) $key);
            if (!isset($user[$key]))
                $user[$key] = (string) $value;
        }
        
        /** */
        $cms = new CMS();
        $cms->Check();
        $r = $cms->getSiteConfig();
        $origin_package = false;
        if ($r[0] && isset($r[1]['origin_package'])) {
            $origin_package = true;
        }
        $order_insurance = 0;
        if ($r[0] && isset($r[1]['order_insurance_percent']) && defined('CFG_INSURANCE')) {
            $order_insurance = $r[1]['order_insurance_percent'];
        }
        unset($user['isemailverified']);
        unset($user['id']);
        unset($user['isactive']);
        unset($user['password']);
        unset($user['login']);

        $this->tpl->assign('list', $items);
        $this->tpl->assign('order', $order);
        $this->tpl->assign('weight', $weight);
        $this->tpl->assign('model_info', $model_info);
        $this->tpl->assign('userdiscount', $userdiscount);
        $this->tpl->assign('user_info', $user);
        $this->tpl->assign('origin_package', $origin_package);
        $this->tpl->assign('order_insurance', $order_insurance);

        $modes = $otapilib->GetDeliveryModesWithPrice($currentCountry['Id'], $weight);
        $O = new Step4OrderSummary($modes, $basket, $this->_getWeight($items));
        $this->tpl->assign('OrderSummary', $O->Generate());
    }

    private function _createOrder($sid) {
        global $otapilib;

        $model = @$_POST['model'];
        $comment = @(string)$_POST['comment']." \r\n ".Plugins::invokeEvent('onOrderGetDomainName');
        if (isset($_POST['origin_package'])) {
            $comment .= '  ' . Lang::get('save_origin_package');
        }
        if (isset($_POST['order_insurance'])) {
            $cms = new CMS();
            $cms->Check();
            $r = $cms->getSiteConfig();
            $order_insurance = 0;
            if ($r[0] && isset($r[1]['order_insurance_percent'])) {
                $order_insurance = $r[1]['order_insurance_percent'];
            }
            if ($order_insurance>0) $comment .= '  (INSURANCE:+'.$order_insurance.'%)';
        }
        $weight = @$_POST['total_weight'];
        $order = (isset($_POST['order'])) ? $_POST['order'] : 'new';

        $this->_template = 'order_processing';

        if ($order == 'new') {
            $r = Plugins::onCreateOrder($sid, $model);
            if($r === 0)
                $r = $otapilib->CreateSalesOrder($sid, $model, $comment, $weight);
        } else {
            $r = $otapilib->RecreateSalesOrder($sid, $order, $weight);
        }
        
        if ($r === false) {
            $message = $otapilib->error_message;
            @header('Location: index.php?p=privateoffice&errmessage='.$message);
        } else {
            Cache_my::DelCacheBatchGetUserData($sid);
			if (General::getSiteConfig('mail_new_order')) {
            	Notifier::notifyAdminOnSuccessOrder($r);
			}
            Notifier::notifyUserOnSuccessOrder($r);
            $message = 'success';
            @header('Location: index.php?p=privateoffice&message=' . $message);
        }

        die();
    }

    private function _getWeight($items) {
        $weight = 0;

        foreach ($items as $item) {
            foreach($item['Fields'] as $field){
                $paramName = (string)$field['Name'];
                $$paramName = (string)$field['Value'];
            }
            $weight += (float)@$Weight*@$item['Quantity'];
        }

        return round($weight, 2);
    }

    private function _saveProfile($fields) {

        global $otapilib;

        $xmlParams = str_replace('<?xml version="1.0"?>', '', $this->_xmlParams($fields));
        $sid = $_SESSION[CFG_SITE_NAME . 'loginUserData']['sid'];
        $reg = $otapilib->UpdateUser($sid, $xmlParams);

        if ($reg === false){
            throw new Exception('User cannot be saved: ' . $otapilib->error_message);
        }

        return array(true, 'Данные успешно обновлены');
    }

    private function _xmlParams($fields) {
        $xml = new SimpleXMLElement('<UserUpdateData></UserUpdateData>');
        $xml->addChild('Email', htmlspecialchars($fields['Email']));
        $xml->addChild('FirstName', htmlspecialchars($fields['FirstName']));
        $xml->addChild('LastName', htmlspecialchars($fields['LastName']));
        $xml->addChild('MiddleName', htmlspecialchars($fields['MiddleName']));
        $xml->addChild('Sex', htmlspecialchars($fields['Sex'] ? $fields['Sex'] : 'Male'));

        $xml->addChild('CountryCode', htmlspecialchars($fields['Country']));
        $xml->addChild('City', htmlspecialchars($fields['City']));
        $xml->addChild('Address', htmlspecialchars($fields['Address']));
        $xml->addChild('Phone', htmlspecialchars($fields['Phone']));
        $xml->addChild('PostalCode', htmlspecialchars($fields['PostalCode']));
        $xml->addChild('Region', htmlspecialchars($fields['Region']));

        $xml->addChild('RecipientFirstName', htmlspecialchars($fields['RecipientFirstName']));
        $xml->addChild('RecipientLastName', htmlspecialchars($fields['RecipientLastName']));
        $xml->addChild('RecipientMiddleName', htmlspecialchars($fields['RecipientMiddleName']));

        return $xml->asXML();
    }

}

?>