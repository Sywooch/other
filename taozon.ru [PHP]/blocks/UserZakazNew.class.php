<?php

/*
 * Шаги при оформлении заказа
 *
 * step1 - назначение веса для товара
 * step2 - выбор заказа: новый заказ или дозаказ
 * step3 - выбор подходящей модели доставки
 * step4 - все данные для оформления заказа
 */

OTBase::import('system.lib.service.*');
OTBase::import('system.lib.startup_scripts.UsersVisits');

class UserZakazNew extends GenerateBlock {

    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'userzakaznew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/order/';
    private $isInternalDeliveryFixed;

    const MAX_USER_PROFILES_COUNT   = 3;

    /**
    *
    */
    private $items = array();
    /**
    *
    */
    private $basket = array();
    /**
    *
    */
    private $basketRecord = array();

    public function __construct() {
        parent::__construct(true);
        $this->isInternalDeliveryFixed = defined('CFG_INTERNAL_DELIVERY_FIXED') && CFG_INTERNAL_DELIVERY_FIXED;
    }

    protected function setVars()
    {
        $sid = Session::getUserOrGuestSession();
        $type = $this->request->getValue('type', 'taobao');
        $this->tpl->assign('type', $type);

        if (! Session::getUserData() && ! General::getConfigValue('simplified_registration')) {
            header('Location: index.php?p=login');
        }

        $basket = $this->otapilib->GetBasket(Session::getUserOrGuestSession());
        $record = new BasketRecord($basket);
        $items = $type == 'warehouse' ? $record->getWhItems() : $record->getTaoItems();

        $this->items = $items;
        $this->basket = $basket;
        $this->basketRecord = $record;

        if (! count($items )) {
            header('Location: index.php?p=basket');

        } elseif (isset($_GET['step1'])) {
            if (General::getConfigValue('hide_step_weight_order')) {
                $this->_step2($sid);
            } else {
                $this->_template = 'step1new';
                $this->tpl->assign('list', $items);
            }

        } elseif (isset($_GET['step2'])) {
            $this->_step2($sid);

        } elseif (isset($_GET['step3'])) {
            $this->_step3($sid);

        } elseif (isset($_GET['step4'])) {
            $this->_step4($sid);

        } elseif (isset($_GET['createorder'])) {
            $this->_createOrder($sid);

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

    private function _step2($sid)
    {
        $type = $this->request->getValue('type', 'taobao');
        $this->tpl->assign('type', $type);

        $weight = $this->_getWeight($this->items);
        Session::set('order_weight', $weight);

        // 10 - заказы доступные для дозаказа
        if (defined('CFG_DISCOUNTER_REORDER')) {
            $orders = $this->otapilib->GetSalesOrdersList($sid, 3);
        } else {
            $orders = $this->otapilib->GetSalesOrdersList($sid, 10);
        }

        // если нет заказов или запрещен дозаказ, то переходим к шагу з
        if (empty($orders) || General::getConfigValue('skip_reordering')) {
            if (strpos($_SERVER['HTTP_REFERER'], 'step3')) {
                header('Location:index.php?p=userorder&step1&type='.$type);
            } else {
                header('Location:index.php?p=userorder&step3&order=new&type='.$type);
            }
        } else {
            if (is_array($orders)) {
                if ($type == 'warehouse') {
                    $orders = array_filter($orders, create_function('$a', 'return $a["ProviderTypeEnum"] == "Warehouse";'));
                } else {
                    $orders = array_filter($orders, create_function('$a', 'return $a["ProviderTypeEnum"] != "Warehouse";'));
                }
            }
            $this->_template = 'step2new';
            $this->tpl->assign('orders', $orders);
            $this->tpl->assign('weight', $weight);
        }
    }

    private function _step3($sid)
    {
        $type = $this->request->getValue('type', 'taobao');
        $this->tpl->assign('type', $type);

        $this->otapilib->setErrorsAsExceptionsOn();

        $this->_template = 'step3new';

        $items = $this->items;

        $weight = $this->_getWeight($items);

        if ($this->request->getValue('order')) {
            $order = $this->request->getValue('order');
        } else {
            $order = 'new';
        }

        if (! $this->request->getValue('order')) {
            header('Location:index.php?p=userorder&step3&order='.$order.'&type='.$type);
        }

        if (defined('CFG_DISCOUNTER_REORDER') && $order != 'new')
        {
            Session::set('DISCOUNTER_REORDER', $order);
            $order = 'new';
            $userData = $this->otapilib->GetUserInfo($sid);
            $country = $userData['Country'] ? $userData['Country'] : 'Россия';
            $countries = $this->otapilib->GetDeliveryCountryInfoList();
            $country = $userData['Country'] ? $userData['Country'] : 'Россия';
            foreach($countries as $c){
                if($c['Name'] == $country) $currentCountry = $c;
            }
            if(!isset($currentCountry)){
                $currentCountry = $countries[0];
            }
            $models = $this->otapilib->GetDeliveryModesWithPrice($currentCountry['Id'], 0);
            $model_id = $models[0]['id'];
            header('Location:index.php?p=userorder&step4&order=' . $order . '&model=' . $model_id . '&country='.$currentCountry['Id'].'&type='.$type);
        } else {
            if (isset($_SESSION['DISCOUNTER_REORDER'])) unset($_SESSION['DISCOUNTER_REORDER']);
        }

        try {
            // если у нас дозаказ
            if ($order != 'new') {
                $ids = array();
                foreach ($items as $item) {
                    $ids[] = $item['id'];
                }


                $r = $this->otapilib->RecreateOrder($sid, $this->_xmlRecreateOrder($order, $weight, $ids));
                if (!$r) {
                    header('Location:index.php?p=privateoffice&message=error');
                } else {
                    $data['orderId'] = OrdersProxy::normalizeOrderId((string)$order);
                    $data['amount'] = '';
                    $data['url'] = OrdersProxy::originOrderId((string)$order);
                    $data['with_order'] = '';

                    $title = Lang::get('new_reorder', array(
                        'orderId' => OrdersProxy::normalizeOrderId((string)$order)));

                    Notifier::generalNotification('success_reorder', $title, $data);

                    $this->fileMysqlMemoryCache->DelCacheEl('BatchGetUserData:' . Session::getUserOrGuestSession());
                    header('Location:index.php?p=privateoffice&message=success');
                }
            } else {
                $countries = $this->otapilib->GetDeliveryCountryInfoList();
                $profiles = array();
                if (Session::getUserData()) {
                    $profiles = $this->otapilib->GetUserProfileInfoList($sid);
                } else {
                    if ($this->fileMysqlMemoryCache->Exists('userTempProfile:'.Session::getUserOrGuestSession())){
                        $xmlProfile = new SimpleXMLElement(unserialize($this->fileMysqlMemoryCache->GetCacheEl('userTempProfile:'.Session::getUserOrGuestSession())));
                        $profileTmp['id'] = 'temp';
                        $profileTmp['Id'] = 'temp';
                        $profileTmp['PostalCode'] = (string)$xmlProfile->PostalCode;
                        $profileTmp['Region'] = (string)$xmlProfile->Region;
                        $profileTmp['City'] = (string)$xmlProfile->City;
                        $profileTmp['Address'] = (string)$xmlProfile->Address;
                        $profileTmp['FirstName'] = (string)$xmlProfile->FirstName;
                        $profileTmp['MiddleName'] = (string)$xmlProfile->MiddleName;
                        $profileTmp['LastName'] = (string)$xmlProfile->LastName;
                        $profileTmp['Phone'] = (string)$xmlProfile->Phone;
                        $profileTmp['CountryCode'] = (string)$xmlProfile->CountryCode;
                        $profileTmp['PassportNumber'] = isset($xmlProfile->PassportNumber) ? (string)$xmlProfile->PassportNumber : '';
                        $profileTmp['RegistrationAddress'] = isset($xmlProfile->RegistrationAddress) ? (string)$xmlProfile->RegistrationAddress : '';
                        $profiles[] = $profileTmp;
                    }
                }
                $country = '';

                if (count($profiles)) {
                    foreach ($profiles as $profile) {
                        $country = $profile['CountryCode'];
                        break;
                    }
                }

                foreach ($countries as $c){
                    if($c['Id'] == $country) {
                        $currentCountry = $c;
                    }
                }

                if(! isset($currentCountry)) {
                    $currentCountry['Id'] = false;
                }

                $models = array();
                if (isset($currentCountry['Id']) && $currentCountry['Id']) {
                    $models = $this->otapilib->GetDeliveryModesWithPrice($currentCountry['Id'], $weight);
                }
                
                $this->tpl->assign('profiles', $profiles);
                $this->tpl->assign('countries', $countries);
                $this->tpl->assign('models', $models);
                $this->tpl->assign('weight', $weight);
                $this->tpl->assign('order', $order);

            }
        } catch(ServiceException $e) {
            Session::setError($e->getMessage(), $e->getErrorCode());
            if ($e->getErrorCode() == 'SessionExpired') {
                header('Location:index.php?p=login');
                die();
            }

            if ($e->getErrorCode() == 'InternalError') {
                show_error($e->getMessage());
            } else {
                $error = $e->getMessage();

                if ($e->getErrorCode() == 'NotAvailable') {
                    $error = Lang::get('NotAvailable');
                } elseif (strripos($error, 'There is no delivery') !== false) {
                    $error = Lang::get('no_deliver_error');
                }
                $this->tpl->assign('error', $error);
            }

            if (isset($profiles)) $this->tpl->assign('profiles', $profiles);
            if (isset($countries)) $this->tpl->assign('countries', $countries);
            if (isset($models)) $this->tpl->assign('models', $models);
            if (isset($weight)) $this->tpl->assign('weight', $weight);
            if (isset($order)) $this->tpl->assign('order', $order);

        } catch(Exception $e){
            header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.$e->getMessage());
            die();
        }
    }

    private function _step4($sid)
    {
        $this->otapilib->setErrorsAsExceptionsOn();
        $type = $this->request->getValue('type', 'taobao');
        $this->tpl->assign('type', $type);

        $allBasket = $this->basket;
        $basketRecord = $this->basketRecord;
        $items = $this->items;

        if ($this->request->getValue('total_weight')) {
            $weight = $this->request->getValue('total_weight');
        } elseif (Session::get('order_weight')) {
            $weight = Session::get('order_weight');
        } elseif ($this->request->getValue('weight')) {
            $weight = $this->request->getValue('weight');
        } else {
            $weight = $this->_getWeight($items);
        }

        if ($this->request->getValue('order')) {
            $order = $this->request->getValue('order');
        } else {
            $order = 'new';
        }

        $profile_info = $this->request->getValue('Profile');

        if (isset($profile_info['New'])) {
            $delivery_profile_id = '';
        } else {
            $delivery_profile_id = ($profile_info['Id'] and $profile_info['Id'] != 'temp') ? $profile_info['Id'] : $this->request->getValue('profile');
        }
        $country = $profile_info['CountryCode'] ? $profile_info['CountryCode'] : $this->request->getValue('country');
        if(!$country){
            header('Location: index.php?p=userorder&step3&order='.$order.'&type='.$type);
            die();
        }

        if ($this->request->getValue('model')) {
            $model_id = $this->request->getValue('model');
        } else {
            $model_id = '';
        }

        try {

            if ($profile_info) {
                if (! General::getConfigValue('simplified_registration')) {
                    try{
                        list($success, $delivery_profile_id) = $this->_saveDeliveryProfile($profile_info);
                    }
                    catch(ServiceException $e){
                        header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.$e->getMessage().'&type='.$type);
                        die();
                    }
                    Plugins::invokeEvent('onUpdateUserStep4');
                } else {
                    $this->_saveTmpDeliveryProfile($profile_info);
                }

            }

            if ($model_id == '') {
                header('Location:index.php?p=userorder&step3&order=' . $order.'&type='.$type);
            }

            $this->_template = 'step4new';
            $deliveryModes = $this->otapilib->GetDeliveryModesWithPrice($country, $weight);
            $userdiscount = false;
            if (Session::getUserData()) {
                $userdiscount = $this->otapilib->GetDiscountGroup($sid);
            }
            $model_info = array();
            foreach ($deliveryModes as $model) {
                if ($model['id'] == $model_id)
                    $model_info = $model;
            }

            if (Session::getUserData()) {
                $userinfo = $this->otapilib->GetUserInfo($sid);
                $userinfo = array_filter($userinfo);

                $user = array();

                foreach ($userinfo as $key => $value) {
                    $key = strtolower((string) $key);
                    if (!isset($user[$key]))
                        $user[$key] = (string) $value;
                }

                /** профиль доставки пользователя */
                $profiles = $this->otapilib->GetUserProfileInfoList($sid);
                $profile = '';
                foreach ($profiles as $item) {
                    if ($item['Id'] == $delivery_profile_id) {
                        $profile = $item;
                    }
                }
                unset($user['isemailverified']);
                unset($user['id']);
                unset($user['isactive']);
                unset($user['password']);
                unset($user['login']);
            } else {
                $user = false;
                $profile = array();
                if ($this->fileMysqlMemoryCache->Exists('userTempProfile:'.Session::getUserOrGuestSession())){
                    $xmlProfile = new SimpleXMLElement(unserialize($this->fileMysqlMemoryCache->GetCacheEl('userTempProfile:'.Session::getUserOrGuestSession())));
                    $profile['postalcode'] = (string)$xmlProfile->PostalCode;
                    $profile['region'] = (string)$xmlProfile->Region;
                    $profile['city'] = (string)$xmlProfile->City;
                    $profile['address'] = (string)$xmlProfile->Address;
                    $profile['firstname'] = (string)$xmlProfile->FirstName;
                    $profile['middlename'] = (string)$xmlProfile->MiddleName;
                    $profile['lastname'] = (string)$xmlProfile->LastName;
                    $profile['phone'] = (string)$xmlProfile->Phone;
                } else {
                    header('Location:index.php?p=userorder&step3&order=new&type='.$this->request->getValue('type', 'taobao'));
                    die();
                }
            }
            /** определение страны доставки по ее коду */
            $countries = $this->otapilib->GetDeliveryCountryInfoList();
            foreach($countries as $c){
                if($c['Id'] == $country) $profile['country'] = $c['Name'];
            }

            /** */
            if (General::getConfigValue('origin_package')) {
                $origin_package = true;
            } else {
                $origin_package = false;
            }
            $order_insurance = 0;
            if (General::getConfigValue('order_insurance_percent')) {
                $order_insurance = General::getConfigValue('order_insurance_percent');
            }


            if ($this->isAdditionalPriceIncludeInternalDeliveryPerVendor($allBasket)) {
                $this->setTemplate('step4new_for_fixed_internal_delivery');
            }

            $this->tpl->assign('allBasket', $allBasket);
            $this->tpl->assign('profile', $profile);
            $this->tpl->assign('basket', $basketRecord->asArray());
            $this->tpl->assign('list', $items);
            $this->tpl->assign('order', $order);
            $this->tpl->assign('weight', $weight);
            $this->tpl->assign('model_info', $model_info);
            $this->tpl->assign('userdiscount', $userdiscount);
            $this->tpl->assign('user_info', $user);
            $this->tpl->assign('origin_package', General::getConfigValue('origin_package'));
            $this->tpl->assign('country', $country);
            $orderComment = Session::get('orderComment');
            $orderComment = !empty($orderComment) ? $orderComment : '';
            $this->tpl->assign('order_comment', $orderComment);

            $page = $this->cms->GetPageByAlias('main_user_agreement');
            $userAgreement = ($page) ? $page['text'] : Lang::get('empty_page_msg');
            $this->tpl->assign('userAgreement', $userAgreement);

            $O = new Step4OrderSummary($deliveryModes, $basketRecord, $this->_getWeight($items), $type, $allBasket);
            $this->tpl->assign('OrderSummary', $O->Generate());
        } catch(ServiceException $e) {
            Session::setError($e->getMessage(), $e->getErrorCode());
            if ($e->getErrorCode()=='SessionExpired') {
                header('Location:index.php?p=login');
                die();
            }
            header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.$e->getMessage().'&type='.$type);
            die();
        } catch(Exception $e){
            header('Location:index.php?p=userorder&step3&order=' . $order . '&error='.$e->getMessage().'&type='.$type);
            die();
        }
    }

    private function isAdditionalPriceIncludeInternalDeliveryPerVendor($allBasket)
    {
        if (isset($allBasket['CollectionSummaries']) && isset($allBasket['CollectionSummaries']['Taobao'])
            && isset($allBasket['CollectionSummaries']['Taobao']['AdditionalPriceInfoList']['Elements'])) {
            foreach ($allBasket['CollectionSummaries']['Taobao']['AdditionalPriceInfoList']['Elements'] as $additionalPriceInfo) {
                if ((isset($additionalPriceInfo['Type'])) && ($additionalPriceInfo['Type'] == 'InternalDeliveryPerVendor')) {
                    return true;
                }
            }
        }
        return false;
    }

    private function _createOrder($sid)
    {

        $unUserSid = Session::getUserOrGuestSession();

        try {
            Session::set('orderComment', $this->request->getValue('comment'));
            Session::set('orderOriginPackage', $this->request->getValue('origin_package', false));
            Session::set('orderInsurance', $this->request->getValue('order_insurance', false));
            $this->otapilib->setErrorsAsExceptionsOn();
            $this->_loginOrRegisterIfNeed();
        } catch (ServiceException $e){
            Session::setError($e->getErrorMessage(), $e->getErrorCode());
            header('Location:index.php?p=userorder&step4&order=new'
                    . '&model=' . $this->request->getValue('model')
                    . '&country=' . $this->request->getValue('country', 'RU')
                    . '&type=' . $this->request->getValue('type', 'taobao'));
            die();
        }
        Session::clear('orderComment');
        Session::clear('orderOriginPackage');
        Session::clear('orderInsurance');

        $type = $this->request->getValue('type', 'taobao');
        $this->tpl->assign('type', $type);

        $items = $this->items;

        $weight = $this->_getWeight($items);

        $deliveryModeId = $this->request->getValue('model');

        $sid = Session::getUserSession();
        $deliveryProfileId = $this->request->getValue('profile');
        if($this->fileMysqlMemoryCache->Exists('userTempProfile:'.$unUserSid)) {
            $profiles = $this->otapilib->GetUserProfileInfoList($sid);
            $xmlProfile = unserialize($this->fileMysqlMemoryCache->GetCacheEl('userTempProfile:'.$unUserSid));
            if (count($profiles) == self::MAX_USER_PROFILES_COUNT) {
                foreach ($profiles as $p) {
                    $deliveryProfileId = $p['id'];
                }
                $xmlProfile = new SimpleXMLElement($xmlProfile);
                $paramsProfile['PostalCode'] = (string)$xmlProfile->PostalCode;
                $paramsProfile['Region'] = (string)$xmlProfile->Region;
                $paramsProfile['City'] = (string)$xmlProfile->City;
                $paramsProfile['Address'] = (string)$xmlProfile->Address;
                $paramsProfile['FirstName'] = (string)$xmlProfile->FirstName;
                $paramsProfile['MiddleName'] = (string)$xmlProfile->MiddleName;
                $paramsProfile['LastName'] = (string)$xmlProfile->LastName;
                $paramsProfile['Phone'] = (string)$xmlProfile->Phone;
                $paramsProfile['CountryCode'] = (string)$xmlProfile->CountryCode; 
                $paramsProfile['Id'] = $deliveryProfileId;

                $profile = new Profile();
                $paramsProfile = array('Profile' => $paramsProfile);
                list($success, $data) = $profile->saveDeliveryProfile($paramsProfile);
            } else {
                $deliveryProfileId = $this->otapilib->CreateUserProfile($sid, $xmlProfile);
            }
        }
        $comment = htmlspecialchars((string)$this->request->getValue('comment'))." \r\n ".Plugins::invokeEvent('onOrderGetDomainName');
        if ($this->request->getValue('origin_package')) {
            $comment .= '  ' . Lang::get('save_origin_package');
        }
        if ($this->request->getValue('order_insurance')) {
            $order_insurance = 0;
            if (General::getConfigValue('order_insurance_percent')) {
                $order_insurance = General::getConfigValue('order_insurance_percent');
            }
            if ($order_insurance>0) $comment .= '  (INSURANCE:+'.$order_insurance.'%)';
        }
        if (defined('CFG_DISCOUNTER_REORDER') && Session::get('DISCOUNTER_REORDER'))
        {
            $comment = 'НЕОБХОДИМО ОБЪЕДЕНИТЬ С № '.Session::get('DISCOUNTER_REORDER')."\r\n".$comment;
        }

        $order = ($this->request->getValue('order')) ? $this->request->getValue('order') : 'new';

        $this->_template = 'order_processing';

        $ids = array();
        foreach ($items as $item) {
            $ids[] = $item['id'];
        }

        try{
            $this->otapilib->setErrorsAsExceptionsOn();
            if ($order == 'new') {

                $orderInfo = Plugins::onCreateOrder($sid, $deliveryModeId);
                $xmlParams = str_replace('<?xml version="1.0"?>', '', $this->_xmlNewOrder($deliveryModeId, $comment, $weight, $deliveryProfileId, $ids));
                if ($orderInfo === 0) {
                    $orderInfo = $this->ordersProxy->CreateOrder($sid, $xmlParams);
                }
            } else {
                $orderInfo = $this->otapilib->RecreateOrder($sid, $this->_xmlRecreateOrder($order, $weight, $ids));
            }
        }
        catch(ServiceException $e){
            $country = $this->request->getValue('country', 'RU');
            Session::setError($e->getErrorMessage(), $e->getErrorCode());
            header('Location:index.php?p=userorder&step4&order=' . $order
                    . '&model=' . $deliveryModeId
                    . '&country=' . $country
                    . '&profile=' . $deliveryProfileId
                    . '&type=' . $type);
            die();
        }

        if(isset($orderInfo->Result)) {
            $newRedirect =  Plugins::invokeEvent('onNewAfterOrderRedirect', array('delivery' => (string)$orderInfo->Result->DeliveryModeId, 'orderInfo' => $orderInfo));
            $order_array['Id'] = $order_array['id'] = (string)$orderInfo->Result->Id;
            $order_array['TotalAmount'] = (string)$orderInfo->Result->TotalAmount;
            $orderInfo = $order_array;
        }

        $this->fileMysqlMemoryCache->DelCacheEl('BatchGetUserData:' . Session::getUserOrGuestSession());
        if ($orderInfo['Id'])
        {
            $data = array();
            $data['orderId']=(string)$orderInfo['id'];
            $data['amount']=(string)$orderInfo['TotalAmount'];
            $data['url']=OrdersProxy::originOrderId((string)$orderInfo['id']);

            UsersVisits::saveUserPurchase((string)$orderInfo['id'], (string)$orderInfo['TotalAmount']);

            if ($order == 'new') {

                Notifier::generalNotification('success_order',Lang::get('new_order', array('orderId' => OrdersProxy::normalizeOrderId((string)$orderInfo['id']))),$data);

                if (defined('CFG_DISCOUNTER_REORDER') && Session::get('DISCOUNTER_REORDER'))
                {
                    $data['with_order']=Session::get('DISCOUNTER_REORDER');
                    Notifier::generalNotification('success_reorder','Новый заказ! Важно! Необходимо объединить заказы!',$data);
                }
            } else {
                $data['with_order']='';
                Notifier::generalNotification('success_reorder',Lang::get('new_reorder'),$data);
            }
            $profiles = $this->otapilib->GetUserProfileInfoList($sid);
            $profile = array();

            foreach ($profiles as $p) {
                if ($p['id'] == $deliveryProfileId) {
                    $profile = $p;
                    break;
                }
            }

            Notifier::notifyUserOnSuccessOrder($orderInfo, $profile);
        }

        $newRedirect = $newRedirect ? $newRedirect : UrlGenerator::generateOrderDetailsUrl($orderInfo['Id'], array('tab' => 3, 'newOrderId' => (string)$orderInfo['id']));
        header('Location: ' . $newRedirect);
        die();
    }

    private function _getWeight($items) {
        $weight = 0;

        foreach ($items as $item) {
            $weight += isset($item['Weight']) ? (float)$item['Weight']*$item['Quantity'] : 0;
        }

        return round($weight, 2);
    }

    private function _saveProfile($fields) {

        $xmlParams = str_replace('<?xml version="1.0"?>', '', $this->_xmlParams($fields));
        $sid = Session::getUserSession();
        $reg = $this->otapilib->UpdateUser($sid, $xmlParams);

        if ($reg === false){
            if ($this->otapilib->error_code=='NotAvailable') {
                $error =  Lang::get('NotAvailable');
            } else {
                $error =  $this->otapilib->error_message;
            }
            throw new Exception('User cannot be saved: '.$error);
        }

        return array(true, 'Данные успешно обновлены');
    }

    private function _saveDeliveryProfile($fields) {
        $profile = new Profile();
        $params = array('Profile' => $fields);
        if (isset($fields['Id'])) {
            $profile_id = $fields['Id'];
            list($success, $data) = $profile->saveDeliveryProfile($params);
        } else {
            $sid = Session::getUserSession();
            $xmlParams = str_replace('<?xml version="1.0"?>', '', $profile->xmlParamsDeliveryProfile($fields));
            $profile_id = $this->otapilib->CreateUserProfile($sid, $xmlParams);
            return array(true, $profile_id);
        }

        if ($success === false) {
            throw new Exception('User cannot be saved: '.$data);
        }

        return array(true, $profile_id);
    }

    private function _saveTmpDeliveryProfile($fields) {
        $profile = new Profile();
        $sid = Session::getUserOrGuestSession();
        $deliveryProfile = $profile->xmlParamsDeliveryProfile($fields);
        $this->fileMysqlMemoryCache->AddCacheEl('userTempProfile:'.$sid, 600, serialize($deliveryProfile));
        return array(true, 1);
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
        if(!General::getConfigValue('hide_middlename'))
            $xml->addChild('RecipientMiddleName', htmlspecialchars($fields['RecipientMiddleName']));

        return $xml->asXML();
    }


    private function _xmlNewOrder($model, $comment, $weight, $profile, $ids) {
        $xml = new SimpleXMLElement('<OrderCreateData></OrderCreateData>');
        $xml->addChild('DeliveryModeId', htmlspecialchars($model));
        $xml->addChild('Weight', htmlspecialchars($weight));
        $xml->addChild('Comment', htmlspecialchars($comment));
        $xml->addChild('UserProfileId', htmlspecialchars($profile));
        $xml->addChild('Elements');
        foreach ($ids as $id) {
            $xml->Elements->addChild('Id', $id);
        }

        return str_replace('<?xml version="1.0"?>', '', $xml->asXML());
    }

    private function _xmlRecreateOrder($orderId, $weight, $ids)
    {
        $xml = new SimpleXMLElement('<OrderRecreateData></OrderRecreateData>');
        $xml->addChild('OrderId', htmlspecialchars($orderId));
        $xml->addChild('Weight', htmlspecialchars($weight));
        $xml->addChild('Elements');
        foreach ($ids as $id) {
            $xml->Elements->addChild('Id', $id);
        }

        return trim(str_replace('<?xml version="1.0"?>', '', $xml->asXML()));
    }

    private function _loginOrRegisterIfNeed()
    {
        if (! Session::getUserData()) {
            $actions = false;
            $login = $this->request->getValue('username');
            $register = $this->request->getValue('email');
            if (! empty($login)) {
                $actions = true;
                $userStatus = Users::Login($this->request->getAll());
            }
            if (! empty($register) && ! $actions) {
                $xml = new SimpleXMLElement('<UserRegistrationData></UserRegistrationData>');
                $xml->addChild('Email', htmlspecialchars($this->request->getValue('email')));
                $xml->addChild('Password', htmlspecialchars($this->request->getValue('password_to_registration')));
                $xml->addChild('Login', htmlspecialchars($this->request->getValue('email')));
                $xmlParams = str_replace('<?xml version="1.0"?>', '', $xml->asXML());
                $result = $this->otapilib->RegisterUser($xmlParams);
                if ($result['IsEmailVerificationUsed'] == 'true') {
                    $isRegistrationError = 'need_confirm_email';
                    $data['username'] = $this->request->getValue('email');
                    $data['code'] = $result['EmailConfirmationCode'];
                    Notifier::notifyUserOnRegister($this->request->getValue('email'), $this->request->getValue('email'), $this->request->getValue('password_to_registration'));
                    Notifier::generalUserNotification($this->request->getValue('email'), 'email_confirm', Lang::get('Account_activation'), $data);

                } else {
                    Notifier::notifyUserOnRegister($this->request->getValue('email'), $this->request->getValue('email'), $this->request->getValue('password_to_registration'));
                }
                Users::Login(array(
                    'username' => $this->request->getValue('email'),
                    'password' => $this->request->getValue('password_to_registration')
                ));
            }
            if (empty($login) && empty($register)) {
                header('Location:index.php?p=userorder&step4&order=new'
                    . '&model=' . $this->request->getValue('model')
                    . '&country=' . $this->request->getValue('country', 'RU')
                    . '&type=' . $this->request->getValue('type', 'taobao')
                    . '&noAuth=1');
                die();
            }
        }
    }

}

?>