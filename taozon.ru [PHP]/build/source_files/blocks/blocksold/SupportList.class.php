<?php

class SupportList extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'supportlist'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        global $otapilib;
        
        if (isset($_COOKIE['NoteSid'])){
            $sid = $_COOKIE['NoteSid'];
        } else {
            $sid = md5(session_id() . rand(0, 1000000));
            setcookie("NoteSid", $sid, time()+3600*24*365);
        }
        
        if(isset($_GET['del'])){
            $isdeleted = $otapilib->RemoveItemFromNote($sid, $_GET['del']);
        }   
        if(isset($_GET['clear'])){
            $isdeleted = $otapilib->ClearNote($sid);
        }
        
        $items = $otapilib->GetNote($sid);
        //if ($items === false) show_error(__FILE__.'  (line='.__LINE__.')');
        if ($items === false) show_error($otapilib->error_message);
        $this->tpl->assign('list', $items);
        //var_dump($items);
    }
    
    static function AddItemToNote($otapilib, $id, $quantity)
    {
        if (isset($_COOKIE['NoteSid'])){
            $sid = $_COOKIE['NoteSid'];
        } else {
            $sid = md5(session_id() . rand(0, 1000000));
            setcookie("NoteSid", $sid, time()+3600*24*365);
        }
        return $otapilib->AddItemToNote($sid, $id, $quantity, 
                $_GET['itemTitle'], $_GET['configurationId'], $_GET['price'], $_GET['currencyName'],
                $_GET['externalURL'], $_GET['pictureURL'], $_GET['vendorId'],
                $_GET['itemConfiguration'], $_GET['comment']); 
    }
    
    static function removeItem($otapilib, $id){
        if (isset($_COOKIE['NoteSid'])){
            $sid = $_COOKIE['NoteSid'];
        } else {
            $sid = md5(session_id() . rand(0, 1000000));
            setcookie("NoteSid", $sid, time()+3600*24*365);
        }

        $otapilib->RemoveItemFromNote($sid, $id);
    }
    
    static function editItemQuantity($otapilib, $id, $quantity){
        
        if (isset($_COOKIE['NoteSid'])){
            $sid = $_COOKIE['NoteSid'];
        } else {
            $sid = md5(session_id() . rand(0, 1000000));
            setcookie("NoteSid", $sid, time()+3600*24*365);
        }

        return $otapilib->EditNoteItemQuantity($sid, $id, $quantity);
    }
    
    static function editItemComment($otapilib, $id, $comment){
        
        if (isset($_COOKIE['NoteSid'])){
            $sid = $_COOKIE['NoteSid'];
        } else {
            $sid = md5(session_id() . rand(0, 1000000));
            setcookie("NoteSid", $sid, time()+3600*24*365);
        }
        
        $fields = '<Fields><FieldInfo Name="Comment" Value="'.$comment.'"/></Fields>';

        return $otapilib->EditNoteItemFields($sid, $id, $fields);
    }
}

?>