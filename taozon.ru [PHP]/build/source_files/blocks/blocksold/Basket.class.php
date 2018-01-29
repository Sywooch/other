<?php

class Basket extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'basket'; //- шаблон, на основе которого будем собирать блок
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
        
        if(isset($_GET['del'])){
            $isdeleted = $otapilib->RemoveItemFromBasket($sid, $_GET['del']);
        }   
        if(isset($_GET['clear'])){
            $isdeleted = $otapilib->ClearBasket($sid);
        }
        
        $items = $otapilib->GetBasket($sid);
        //var_dump($items);
        //if ($items === false) show_error(__FILE__.'  (line='.__LINE__.')');
        if ($items === false) show_error($otapilib->error_message);
        $this->tpl->assign('list', $items);
        //var_dump($items);
    }
    
    static function addToBasket($otapilib, $id, $quantity, $method = 'post')
    {
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();
        
        if($method == 'post') $params = $_POST;
        if($method == 'get')  $params = $_GET;

        return $otapilib->AddItemToBasket($sid, $id, $quantity, 
                $params['itemTitle'], $params['configurationId'], $params['price'], $params['currencyName'],
                $params['externalURL'], $params['pictureURL'], $params['vendorId'],
                $params['itemConfiguration'], $params['comment']); 
    }
    
    static function editItemQuantity($otapilib, $id, $quantity){
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();
        
        return $otapilib->EditBasketItemQuantity($sid, $id, $quantity);
    }
    
    static function editItemComment($otapilib, $id, $comment){
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();
        
        $fields = '<Fields><FieldInfo Name="Comment" Value="'.$comment.'"/></Fields>';
        return $otapilib->EditBasketItemFields($sid, $id, $fields);
    }
    
    
    static function editItemWeight($otapilib, $id, $weight){
        if(isset($_SESSION[CFG_SITE_NAME.'loginUserData'])) $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        else $sid = session_id();
        $fields = '<Fields><FieldInfo Name="Weight" Value="'.$weight.'"/></Fields>';
        return $otapilib->EditBasketItemFields($sid, $id, $fields);
    }
}

?>