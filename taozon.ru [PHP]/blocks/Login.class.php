<?php

class Login extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'login'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/users/';

    protected $max_failed_logins = 5; //- количество неудачных логинов, после которых показываем капчу

    public function __construct()
    {
        parent::__construct(true);
        $this->otapilib->setErrorsAsExceptionsOn();
    }

    private function processLogin()
    {
        if (!$this->request->getValue('username'))
            throw new Exception(Lang::get('not_entered_login'));

        if (!$this->request->getValue('password'))
            throw new Exception(Lang::get('not_entered_password'));

        return Users::Login($this->request->getAll());
    }

    private function checkCaptcha()
    {
        $captchaPath = dirname(dirname(__FILE__)).'/lib/securimage/securimage.php';
        require_once $captchaPath;

        $secureImage = new Securimage();
        return $secureImage->check($this->request->getValue('ct_captcha'));
    }

    private function recover($userId)
    {
        return $this->otapilib->RequestPasswordRecovery($userId);
    }


    protected function setVars()
    {
        if ( $this->request->valueExists('code')) {
            try{
                $res = $this->otapilib->ConfirmPasswordRecovery($this->request->getValue('code'));
                Notifier::notifyUserOnRecovery($res['Email'], '', $res['Login'], $res['Password']);
                $this->tpl->assign('successRecovery', Lang::get('recovery_data_to_email'));
            }
            catch(Exception $e){
                Session::setError(Lang::get('recovery_password_expired'));
            }
            return true;
        }

        if (Session::getUserData()) {
            $this->request->LocationRedirect(UrlGenerator::generatePrivateOfficeUrl());
        }

        if (Session::getErrorCode() == 'incorrect_code' || Session::get('failed_logins') > $this->max_failed_logins) {
            $this->tpl->assign('captcha', true);
        }

        if ($this->request->getMethod() == 'POST') {
            if ($this->request->valueExists('ct_captcha') && !$this->checkCaptcha()) {
                Session::setError(Lang::get('incorrect_code'), 'incorrect_code');
                $this->request->LocationRedirect(UrlGenerator::generateContentUrl('login'));
            }

            if ($this->request->valueExists('recovery')) {
                try{
                    $this->tpl->assign('show_recovery', '1');
                    $recoverResult = $this->recover($this->request->getValue('userid'));
					Notifier::notifyUserOnRecovery($recoverResult['Email'], $recoverResult['ConfirmationCode'], '', '');                    
                    Session::set('success_recovery', 'На Ваш email высланы дальнейшие инструкции');
                }
                catch(ServiceException $e){
                    General::sessionExpiredHandle(false);
                    Session::set('error_recovery', Lang::get('user_not_exist'));
                }
                $this->request->LocationRedirect(UrlGenerator::generateContentUrl('login'));
            }

            try {
                $this->processLogin();
                Session::set('failed_logins', 0);
                Session::set('login_from', Session::get('login_from') ? Session::get('login_from') : 'index.php');
                $this->request->LocationRedirect(Session::get('login_from'));
            } catch(ServiceException $e) {
                Session::setError($e->getErrorMessage(), $e->getErrorCode());
                Session::set('failed_logins', ((int)Session::get('failed_logins')) + 1);
                $this->request->LocationRedirect(UrlGenerator::generateContentUrl('login'));
            } catch(Exception $e) {
                Session::setError($e->getMessage(), $e->getCode());
                Session::set('failed_logins', ((int)Session::get('failed_logins')) + 1);
                $this->request->LocationRedirect(UrlGenerator::generateContentUrl('login'));
            }
        }

        $referrer = new UrlWrapper();
        $referrer->Set(@$_SERVER['HTTP_REFERER']);
        if (@$_SERVER['HTTP_REFERER'] != $_SERVER['REQUEST_URI'] && @$_SERVER['HTTP_REFERER'] && $referrer->GetAction() != 'login') {
            Session::set('login_from', General::getConfigValue('auth_to_private_office') ?
                UrlGenerator::generateContentUrl('privateoffice') : @$_SERVER['HTTP_REFERER']);
        }
        // если станица вызывается не с сайта
        if (isset($_SERVER['HTTP_REFERER']) &&
                (stristr($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) === false)) {
            Session::set('login_from', UrlGenerator::generateContentUrl('privateoffice'));
        }
    }
}

?>