<?php

class Login extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'login'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/users/';
    
    private $_errors;

    public function __construct()
    {
        parent::__construct(true);
        $this->_errors = array(
            'AccountIsBanned' => Lang::get('account_is_banned'),
            'LoginFailed' => Lang::get('login_failed')
        );
    }

    private function processLogin($fields){
        /**
         * Validation
         */
        if(!$fields['username'])
            return array(false, Lang::get('not_entered_login'));
        if(!$fields['password'])
            return array(false, Lang::get('not_entered_password'));
        
        return Users::Login($fields);
    }
    
    private function checkCaptcha($fields){
        $captchapath = dirname(dirname(__FILE__)).'/lib/securimage/securimage.php';
        require_once $captchapath;
        $securimage = new Securimage();

        if ($securimage->check($fields['ct_captcha']) == false) {
            return array(false, Lang::get('incorrect_code'));
        }
        
        return false;
    }
    
    private function recover($userid){
        global $otapilib;
        $res = $otapilib->RequestPasswordRecovery($userid);
        if(!$res)
            return array(false, Lang::get('user_not_exist'));
        return array(true, $res['ConfirmationCode'], $res['Email']);
    }
    
    private function sendEmail($email, $code, $username, $password){
        $from = 'noreply@'.preg_replace('/^www\./','',$_SERVER['HTTP_HOST']);
        $block = new RecoveryEmail();
        if($code){
            $Body = $block->Generate(array('code', $code));
        }
        else{
            $Body = $block->Generate(array('userdata', $username, $password));
        }
        General::mail_utf8($email, $from, $from, Lang::get('pass_recovery'), $Body);
    }
    
    protected function setVars()
    {
        global $otapilib;
        
        if( @$_SESSION['error'] ){
            $this->tpl->assign('error', $_SESSION['error']);
        }
        
        if(isset($_GET['code'])){
            $res = $otapilib->ConfirmPasswordRecovery($_GET['code']);
            $this->tpl->assign('show_recovery', '1');
            if(!$res){
                $this->tpl->assign('error_recovery', Lang::get('recovery_password_expired'));
            }
            else{
                $this->sendEmail($res['Email'], '', $res['Login'], $res['Password']);
                $this->tpl->assign('success_recovery', Lang::get('recovery_data_to_email'));
            }

            return ;
        }
        if($_POST){
            if(isset($_POST['ct_captcha'])){
                $res = $this->checkCaptcha($_POST);
                if($res){
                    $this->tpl->assign('error', Lang::get('wrong_code'));
                    $this->tpl->assign('captcha', true);
                    return ;
                }
            }
            
            if(isset($_POST['recovery'])){
                $res = $this->recover($_POST['userid']);
                $this->tpl->assign('show_recovery', '1');
                if(!$res[0]){
                    General::sessionExpiredHandle(false);
                    $this->tpl->assign('error_recovery', $res[1]);
                }
                else{
                    $this->sendEmail($res[2], $res[1], '', '');
                    $this->tpl->assign('success_recovery', 'На Ваш email высланы дальнейшие инструкции');
                }
                
                return ;
            }
            
            $result = $this->processLogin($_POST);
            
            if($result[0]){
                $_SESSION['failed_logins'] = 0;
                $_SESSION['login_from'] = @$_SESSION['login_from'] ? $_SESSION['login_from'] : 'index.php';
                $_SESSION['login_from'] = str_replace('?p=login', '', $_SESSION['login_from']);
                header('Location: '.$_SESSION['login_from']);
            }
            else{
                if(!isset($_SESSION['failed_logins']))
                    $_SESSION['failed_logins'] = 0;
                $_SESSION['failed_logins']++;
                
                if($_SESSION['failed_logins'] > 5)
                    $this->tpl->assign('captcha', true);
                else
                    $this->tpl->assign('captcha', false);
                
                if($otapilib->error_code == 'SessionExpired'){
                    $_SESSION['error'] = Lang::get('session_expired');
                    header('Location: index.php?p=login');
                    die();
                }
                
                $ec = (string)$otapilib->error_code;
                $errorMsg = @$this->_errors[$ec] ? $this->_errors[$ec] : $this->_errors['LoginFailed'];
                $this->tpl->assign('error', $errorMsg);
            }
        }
        if(@$_SERVER['HTTP_REFERER'] != $_SERVER['REQUEST_URI'] && @$_SERVER['HTTP_REFERER']){
            $_SESSION['login_from'] = @General::$siteConf['auth_to_private_office'] ?
                    UrlGenerator::generateContentUrl('privateoffice') : @$_SERVER['HTTP_REFERER'];
        }
    }
}

?>