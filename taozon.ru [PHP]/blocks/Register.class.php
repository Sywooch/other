<?php

OTBase::import('system.lib.referral_system.ReferalSystem');
OTBase::import('system.lib.referral_system.lib.*');

class Register extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'register';
    protected $_template_path = '/users/';

    protected $cms;

    const PASSWORD_MIN_LENGHT = 6;

    public function __construct()
    {
        parent::__construct(true);
        $this->otapilib->setErrorsAsExceptionsOn();
        $this->cms = new CMS();
    }

    private function xmlParams($fields)
    {
        $xml = new SimpleXMLElement('<UserRegistrationData></UserRegistrationData>');
        $xml->addChild('Email', htmlspecialchars($fields['email']));
        $xml->addChild('Password', htmlspecialchars($fields['password']));
        $xml->addChild('Login', htmlspecialchars($fields['username']));

        return $xml->asXML();
    }

    private function validateFields($fields)
    {
        if (! $fields['username']) {
            throw new Exception(Lang::get('not_entered_login'));
        }
        if (! isset($fields['agree'])) {
            throw new Exception(Lang::get('not_agree_with_user_agreement'));
        }
        if (! $fields['email']) {
            throw new Exception(Lang::get('not_entered_email'));
        }
        if (! filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception(Lang::get('incorrect_email'));
        }
        if (! $fields['password']) {
            throw new Exception(Lang::get('not_entered_password'));
        }
        if (strlen($fields['password']) < self::PASSWORD_MIN_LENGHT) {
            throw new Exception(Lang::get('pass_min_len'));
        }
    }

    private function checkCaptcha($fields)
    {
        if (defined('CFG_NO_CAPTCHA') || OTBase::isTest()) return false;

        $captchapath = dirname(dirname(__FILE__)).'/lib/securimage/securimage.php';
        require_once $captchapath;
        $securimage = new Securimage();

        if ($securimage->check($fields['ct_captcha']) == false) {
            throw new Exception(Lang::get('not_entered_code'));
        }
    }

    private function processReg($fields)
    {
        $this->otapilib->setErrorsAsExceptionsOn();
        try {
            $this->validateFields($fields);
            $this->checkCaptcha($fields);
            $xmlParams = str_replace('<?xml version="1.0"?>', '', $this->xmlParams($fields));
            $result = $this->otapilib->RegisterUser($xmlParams);
            $this->cms->SetSubscribe($fields['username'], $fields['email']);
            return array(true, $result, Lang::get('reg_success'), '');
        }
        catch (ServiceException $e) {

            if ((string)$e->getErrorCode() == 'AlreadyExists') {
                if (strpos((string)$e->getErrorMessage(), 'Login') !== false) {
                    Session::setError(Lang::get('login_username').' '.$fields['username'].' '.Lang::get('is_used_already'));
                    return array(false, array(), '', '');
                } elseif (strpos($e->getErrorMessage(), 'Email') !== false) {
                    Session::setError(Lang::get('Email').' '.$fields['email'].' '.Lang::get('is_used_already'));
                    return array(false, array(), '', '');
                } else {
                    Session::setError($e->getErrorMessage());
                    return array(false, array(), $e->getErrorMessage(), '');
                }
            } else {
                if ($e->getErrorCode() == 'NotAvailable') {
                    return array(false, array(), Lang::get('NotAvailable'), '');
                } else {
                    return array(false, array(), $e->getMessage(), '');
                }
            }
        }
        catch (Exception $e) {
            Session::setError($e->getMessage(), $e->getCode());
            return array(false, array(), $e->getMessage(), '');
        }
    }

    private function _registerFriend()
    {
        $parent = trim((string) RequestWrapper::post('parent'));

        if ($this->cms->Check()) {
            $this->cms->checkTable('site_referrals');
            $user       = $this->cms->GetUserByLogin($parent);
            $parent_id  = !empty($user['id']) ? $user['id'] : 0;

            $user = $this->otapilib->GetUserInfo(Session::getUserSession());
            return $this->cms->AddUser($user, RequestWrapper::post('email'), $parent_id);
        }
        return false;
    }

    private function sendCongratulate()
    {
    }

    protected function setVars()
    {
        if (Session::isAuthenticated()) {
            $this->request->LocationRedirect(UrlGenerator::generatePrivateOfficeUrl());
        }
        $refId = '';
        if (RequestWrapper::getValueSafe('activation')) {
            try {
                $result = $this->otapilib->ConfirmEmail(RequestWrapper::getValueSafe('activation'));
                //http://otapi/?p=register&activation=4e45f422-59ef-4d53-8b8a-1eec1920663f

                $sid = (string)$result->SessionId->Value;
                if ($sid) {
                    $userInfo = $this->otapilib->GetUserInfo($sid);
                    Session::setUserData(array(
                        'sid' => $sid,
                        'username' => $userInfo['Login'],
                        'IsAuthenticated' => true
                    ));
                    $this->_afterRegister($userInfo);
                    header('Location: index.php?p=content&mode=reg_success');
                } else {
                    header('Location: index.php?p=login&reg_success=1');
                }
            } catch (ServiceException $e) {
                Session::setError($e->getErrorMessage(), $e->getErrorCode());
                header('Location: index.php?p=content&mode=confirm_email_fail');
            }
        }
        if ($_POST) {
            list($success, $registerResult, $error, $errorcaptcha) = $this->processReg($_POST);
            if (! $success) {
                $this->tpl->assign('username', RequestWrapper::post('username'));
                $this->tpl->assign('email', RequestWrapper::post('email'));
                $refId = RequestWrapper::post('parent');
                $this->tpl->assign('errorcaptcha', $errorcaptcha);
            } else {
                if ($registerResult['IsEmailVerificationUsed'] == 'true') {
                    $data['username'] = RequestWrapper::post('username');
                    $data['code'] = $registerResult['EmailConfirmationCode'];
                    Notifier::notifyUserOnRegister(RequestWrapper::post('email'), RequestWrapper::post('username'), RequestWrapper::post('password'));
                    Notifier::generalUserNotification(RequestWrapper::post('email'), 'email_confirm', Lang::get('Account_activation'), $data);
                    header('Location: index.php?p=content&mode=need_confirm_email');
                } else {
                    Notifier::notifyUserOnRegister(RequestWrapper::post('email'), RequestWrapper::post('username'), RequestWrapper::post('password'));
                    Users::Login($_POST + array('remember' => 'true'));
                    $userInfo = $this->otapilib->GetUserInfo(Session::getUserSession());
                    $userInfo['username'] = RequestWrapper::post('username');
                    $userInfo['parent'] = RequestWrapper::post('parent');
                    $this->_afterRegister($userInfo);
                    header('Location: index.php?p=content&mode=reg_success');
                }
            }
        }

        $page = $this->cms->GetPageByAlias('main_user_agreement');
        $userAgreement = ($page) ? $page['text'] : Lang::get('empty_page_msg');
        $this->tpl->assign('userAgreement', $userAgreement);

        $this->tpl->assign('hideCaptcha', (defined('CFG_NO_CAPTCHA') || OTBase::isTest()));

        // TODO: Избавиться от прямого использования $_SERVER и подавления ошибок @
        if (@$_SERVER['HTTP_REFERER'] != $_SERVER['REQUEST_URI']) {
            Session::set('register_from', @$_SERVER['HTTP_REFERER']);
        }
    }

    private function _afterRegister($userInfo)
    {
        if (CMS::IsFeatureEnabled('Newsletter'))
            Subscribe::SetSubscribe();

        if (! empty($userInfo['id'])) {
            if(CMS::IsFeatureEnabled('ReferralProgram')){
                ReferalSystem::onUserRegister($_POST + array('id' => $userInfo['id']));
            }
            Plugins::invokeEvent('onUserRegister', array('userInfo' => $_POST + array('id' => $userInfo['id'])));
        }
        // старая рефералка
        if (defined('KEY_REFERRAL_SYSTEM')) {
            if ($this->_registerFriend()) {
                $this->sendCongratulate();
            }
        }
    }

}
