<?php

class Recovery extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'recovery'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/users/';
    
    private $_errors;

    public function __construct()
    {
        parent::__construct(true);
        $this->errors = array(
            'AccountIsBanned' => Lang::get('account_is_banned'),
            'LoginFailed' => Lang::get('login_failed')
        );
    }

    private function recover($userid){
        global $otapilib;
        $res = $otapilib->RequestPasswordRecovery($userid);
        if(!$res)
            return array(false, Lang::get('user_not_exist'));
        return array(true, $res['ConfirmationCode'], $res['Email']);
    }
    
    
    
    protected function setVars()
    {
        global $otapilib;
        if(isset($_POST['recovery'])){
            $res = $this->recover($_POST['userid']);
            $this->tpl->assign('show_recovery', '1');
            if(!$res[0]){
                $this->tpl->assign('error_recovery', $res[1]);
            }
            else{				
                Notifier::notifyUserOnRecovery($res[2], $res[1], '', '');
                $this->tpl->assign('success_recovery', Lang::get('recovery_sent'));
            }

            return ;
        }
        if(isset($_GET['code'])){
            $res = $otapilib->ConfirmPasswordRecovery($_POST['code']);
            $this->tpl->assign('show_recovery', '1');
            if(!$res){
                $this->tpl->assign('error_recovery', Lang::get('recovery_password_expired'));
            }
            else{
                Notifier::notifyUserOnRecovery($res['Email'], '', $res['Login'], $res['Password']);
                $this->tpl->assign('success_recovery', Lang::get('new_login_send'));
            }

            return ;
        }

        if (Session::getUserData()) {
            $this->request->LocationRedirect(UrlGenerator::generatePrivateOfficeUrl());
        }
    }
}

?>