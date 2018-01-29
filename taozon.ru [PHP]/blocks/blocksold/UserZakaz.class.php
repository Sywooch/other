<?php
/*
 * Шаги при оформлении заказа
 * 
 * step1 - назначение веса для товара
 * step2 - выбор заказа: новый заказ или дозаказ
 * step3 - выбор подходящей модели доставки
 * step4 - все данные для оформления заказа
 */
class UserZakaz extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'userzakaz'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/order/';

    public function __construct()
    {
        parent::__construct(true);
    }

    
    protected function setVars()
    {
        global $otapilib;
        
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();
        
        if (isset($_GET['step1']))
        {
            $this->_template = 'step1';
            $items = $otapilib->GetBasket($sid);
            $this->tpl->assign('list', $items);
        }
        elseif (isset($_GET['step2']))
        {
            
            if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData'])){
                header('Location: index.php?p=login');
            }
            $this->_step2($sid);
        }
        elseif(isset($_GET['step3'])){
            
            if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData'])){
                header('Location: index.php?p=login');
            }
            $this->_step3($sid);
            
        }
        elseif (isset($_GET['step4']))
        {
            
            if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData'])){
                header('Location: index.php?p=login');
            }
            $this->_step4($sid);
        }
        elseif(isset($_GET['createorder']))
        {
            
            if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData'])){
                header('Location: index.php?p=login');
            }
            $this->_createOrder($sid);
        }
    }
    
    protected function CreateZakaz()
    {
        $zakaz = new Zakaz();
        $sid = session_id();
        $message = $zakaz->CreateOrderFromBasket($sid);
        $this->tpl->assign('message', $message);
        
    }
    
    protected function GetZakaz($data)
    {
        $zakaz = new Zakaz();
        $order = $zakaz->GetOrder($data);
        return $order;
    }
    
    
    private function _step2($sid)
    {
        global $otapilib;
        
        if(isset($_POST['total_weight']))
            $weight = $_POST['total_weight'];
        elseif(isset($_GET['weight']))
            $weight = $_GET['weight'];
        else
        {
            $items  = $otapilib->GetBasket($sid);
            $weight = $this->_getWeight($items);
        } 
        
        if(!isset($_GET['weight'])) 
            header('Location:index.php?p=userorder&step2&weight='.$weight);

        // 10 - заказы доступные для дозаказа
        $orders = $otapilib->GetSalesOrdersList($sid, 10);
        //var_dump($orders); echo '$otapilib = '.$otapilib->error_message;die;
        // если нет заказов, то переходим к шагу з
        if(!count($orders)) {

            header('Location:index.php?p=userorder&step3&order=new&weight='.$weight);
            
        }  else {
            $this->_template = 'step2';
            $this->tpl->assign('orders', $orders);
            $this->tpl->assign('weight', $weight);
        }
        
    }
    
    
    private function _step3($sid)
    {
        global $otapilib;
        
        if(isset($_POST['total_weight']))
            $weight = $_POST['total_weight'];
        elseif(isset($_GET['weight']))
            $weight = $_GET['weight'];
        else
        {
            $items  = $otapilib->GetBasket($sid);
            $weight = $this->_getWeight($items);
        } 
        
        if(isset($_POST['order']))
            $order = $_POST['order'];
        elseif(isset($_GET['order']))
            $order = $_GET['order'];
        else 
            $order = 'new';
        
        if(!isset($_GET['order'])){
            header('Location:index.php?p=userorder&step3&order='.$order.'&weight='.$weight);
        }

        // если у нас дозаказ
        if($order != 'new'){       
            $r = $otapilib->RecreateSalesOrder($sid, $order, $weight);
            if(!$r){
                header('Location:index.php?p=privateoffice&error='.$otapilib->error_message);
            } else {
                header('Location:index.php?p=privateoffice&success');
            }
        } else {
            $this->_template = 'step3';
            $models = $otapilib->GetDeliveryModesWithPrice('RU', $weight);
            $this->tpl->assign('models', $models);
            $this->tpl->assign('weight', $weight);
            $this->tpl->assign('order', $order);
                    
            $userData = $otapilib->GetUserInfo($sid);
            
            foreach($userData as $k=>$v){
                $this->tpl->assign($k, $v);
            }
        }
    }
    
    private function _step4($sid)
    {
        global $otapilib;
        
        if(isset($_POST['total_weight']))
            $weight = $_POST['total_weight'];
        elseif(isset($_GET['weight']))
            $weight = $_GET['weight'];
        else
        {
            $items = $otapilib->GetBasket($sid);
            $weight = $this->_getWeight($items);
        } 
        
        if(isset($_POST['order']))
            $order = $_POST['order'];
        elseif(isset($_GET['order']))
            $order = $_GET['order'];
        else 
            $order = 'new';
        
        if(isset($_POST['model']))
            $model_id = $_POST['model'];
        elseif(isset($_GET['model']))
            $model_id = $_GET['model'];
        else 
            $model_id = '';
        
        if(isset($_POST['user'])){
            list($success, $error) = $this->_saveProfile($_POST['user']);
            if(!$success){
                header('Location:index.php?p=userorder&step3&order='.$order.'&weight='.$weight.'&error='.$error);
            }
        }
        
        if($model_id == ''){
            header('Location:index.php?p=userorder&step3&order='.$order.'&weight='.$weight);
        }
        
        if(!isset($_GET['model'])){
            header('Location:index.php?p=userorder&step4&order='.$order.'&weight='.$weight.'&model='.$model_id);
        }

        $this->_template = 'step4';

        $items  = $otapilib->GetBasket($sid);
        $models = $otapilib->GetDeliveryModesWithPrice('RU', $weight);

        $model_info = array();

        foreach($models as $model){
            if($model['id'] == $model_id)  $model_info = $model;
        }
        
        $userinfo = $otapilib->GetUserInfo($sid);
        
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
        
        $this->tpl->assign('list', $items);
        $this->tpl->assign('order', $order);
        $this->tpl->assign('weight', $weight);
        $this->tpl->assign('model_info', $model_info);
        $this->tpl->assign('user_info', $user);
    }
    
    private function _createOrder($sid)
    {
        global $otapilib;
        
        $model   = @$_POST['model'];
        $comment = @$_POST['comment'];
        $weight  = @$_POST['total_weight'];
        $order = (isset($_POST['order'])) ? $_POST['order'] : 'new';

        if($order == 'new'){
            $r = $otapilib->CreateSalesOrder($sid, $model, $comment, $weight);
        }else {
            $r = $otapilib->RecreateSalesOrder($sid, $order, $weight);
        }
        
        if(!$r){
            $message = 'error' . $otapilib->error_message;
        } else {
            $message = 'success';
        }
        
        @header('Location:index.php?p=privateoffice&message='.$message);
        
    }
    
    private function _getWeight($items)
    {
        $weight = 0;
        
        foreach($items as $item){
            $weight += $item['Weight'];
        }
        
        return $weight;
    }
    
    private function _saveProfile($fields){
        
        global $otapilib;
        
        $xmlParams = str_replace('<?xml version="1.0"?>', '', $this->_xmlParams($fields));
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        $reg = $otapilib->UpdateUser($sid, $xmlParams);
        
        if(!$reg)
            return array(false, $otapilib->error_message);
        
        return array(true, 'Данные успешно обновлены');
    }
    
    private function _xmlParams($fields){
        $xml = new SimpleXMLElement('<UserUpdateData></UserUpdateData>');
        $xml->addChild('Email', htmlspecialchars($fields['Email']));
        $xml->addChild('FirstName', htmlspecialchars($fields['FirstName']));
        $xml->addChild('LastName', htmlspecialchars($fields['LastName']));
        $xml->addChild('MiddleName', htmlspecialchars($fields['MiddleName']));
        $xml->addChild('Sex', htmlspecialchars($fields['Sex'] ? $fields['Sex'] : 'Male'));
        
        $xml->addChild('Country', htmlspecialchars($fields['Country']));
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