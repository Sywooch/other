<?php

class Profile extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'profile'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/users/';

    public function __construct()
    {
        parent::__construct(true);
    }

    private function xmlParams($fields){
        $xml = new SimpleXMLElement('<UserUpdateData></UserUpdateData>');
        $xml->addChild('Email', htmlspecialchars($fields['Email']));
        $xml->addChild('FirstName', htmlspecialchars($fields['FirstName']));
        $xml->addChild('LastName', htmlspecialchars($fields['LastName']));
        $xml->addChild('MiddleName', htmlspecialchars($fields['MiddleName']));
        $xml->addChild('Sex', htmlspecialchars($fields['Sex']));
        
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
    
    private function validateFields($fields){
        if(!$fields['RecipientFirstName'])
            return array(false, Lang::get('not_entered_required_data'));
        if(!$fields['RecipientLastName'])
            return array(false, Lang::get('not_entered_required_data'));
        if(!$fields['RecipientMiddleName'])
            return array(false, Lang::get('not_entered_required_data'));
        if(!$fields['City'])
            return array(false, Lang::get('not_entered_required_data'));
        if(!$fields['Address'])
            return array(false, Lang::get('not_entered_required_data'));
        if(!$fields['Phone'])
            return array(false, Lang::get('not_entered_required_data'));
        if(!filter_var($fields['Email'], FILTER_VALIDATE_EMAIL))
            return array(false, Lang::get('incorrect_email'));
        if(!$fields['PostalCode'])
            return array(false, Lang::get('not_entered_postalcode'));
        //if(!filter_var($fields['PostalCode'], FILTER_VALIDATE_INT))
            //return array(false, Lang::get('incorrect_postalcode'));
        return false;
    }
    
    private function save($fields){
        global $otapilib;
        
        $error = $this->validateFields($fields);
        if($error) return $error;
        
        $xmlParams = str_replace('<?xml version="1.0"?>', '', $this->xmlParams($fields));
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];

        $reg = $otapilib->UpdateUser($sid, $xmlParams);
        
        if(!$reg)
            return array(false, $otapilib->error_message);
        
        return array(true, Lang::get('data_updated_successfully'));
    }
    
    private function changePassword($fields){
        global $otapilib;
        
        if($fields['newPassword'] != $fields['newPasswordConfirm'])
            return array(false, Lang::get('confirm_pass_mismatch'));
        if(strlen($fields['newPassword'])<6)
            return array(false, Lang::get('min_pass_length'));
        
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        $res = $otapilib->ChangePassword($sid, $fields['currentPassword'], $fields['newPassword']);
        if(!$res)
            return array(false, Lang::get('current_password_incorrect'));
        
        return array(true, '');
    }
    
    private function changeEmail($fields){
        global $otapilib;
        
        if(!$fields['newEmail']) {
            return array(false, Lang::get('email_incorrect'));
        }
        
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        $res = $otapilib->ChangeEmail($sid, $fields['password'], $fields['newEmail']);
        if(!$res) {
            return array(false, $otapilib->error_message);
        }
        
        return array(true, '');
    }
    
    protected function setVars()
    {
        global $otapilib;
        if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData']))
            header('Location: index.php');
        
        $error = '';
        $sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
        $userData = $otapilib->GetUserInfo($sid);

        $countries = $otapilib->GetCountryInfoList();
        $this->tpl->assign('countries', $countries);
        
        if(isset($_GET['success_password']))
            $this->tpl->assign('success', Lang::get('password_successfully_changed'));
        if(isset($_GET['success_update']))
            $this->tpl->assign('success', Lang::get('data_updated_successfully'));
        
        foreach($userData as $k=>$v){
            $this->tpl->assign($k, $v);
        }
        
        if(@$_POST['change_email']) {
            list($success, $error) = $this->changeEmail($_POST);
            if(!$success){
                $this->tpl->assign('error_email', $error);
            }
            else{
                header('Location: index.php?p=profile&success_email');
            }
        } elseif (@$_POST['change_password']) {
            list($success, $error) = $this->changePassword($_POST);
            if(!$success){
                $this->tpl->assign('error_password', $error);
            }
            else{
                header('Location: index.php?p=profile&success_password');
            }
        } elseif ($_POST) {
            list($success, $error) = $this->save($_POST);
            if(!$success){
                foreach($userData as $k=>$v){
                    if (isset($_POST[$k])) $this->tpl->assign($k, $_POST[$k]);
                }
                
                $this->tpl->assign('error', $error);
            }
            else{
                header('Location: index.php?p=profile&success_update');
            }
        }
    }
}

?>