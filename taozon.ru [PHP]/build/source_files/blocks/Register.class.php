<?php

class Register extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'register';
    protected $_template_path = '/users/';

    private  $cms;

    public function __construct()
    {
        parent::__construct(true);
        $this->cms = new CMS();
    }

    private function xmlParams($fields){
        $xml = new SimpleXMLElement('<UserRegistrationData></UserRegistrationData>');
        $xml->addChild('Email', htmlspecialchars($fields['email']));
        $xml->addChild('Password', $fields['password']);
        $xml->addChild('Login', $fields['username']);

        return $xml->asXML();
    }

    private function validateFields($fields){
        if(!$fields['username'])
            return array(false, Lang::get('not_entered_login'), '');
        if(!isset($fields['agree']))
            return array(false, Lang::get('not_agree_with_user_agreement'), '');
        if(!$fields['email'])
            return array(false, Lang::get('not_entered_email'), '');
        if(!filter_var($fields['email'], FILTER_VALIDATE_EMAIL))
            return array(false, Lang::get('incorrect_email'), '');
        if(!$fields['password'])
            return array(false, Lang::get('not_entered_password'), '');
        if(strlen($fields['password'])<6)
            return array(false, Lang::get('pass_min_len'), '');

        return false;
    }

    private function checkCaptcha($fields){
        if(defined('CFG_NO_CAPTCHA')) return false;

        $captchapath = dirname(dirname(__FILE__)).'/lib/securimage/securimage.php';
        require_once $captchapath;
        $securimage = new Securimage();

        if ($securimage->check($fields['ct_captcha']) == false) {
            return array(false, Lang::get('not_entered_code'), '');
        }

        return false;
    }

    private function processReg($fields){
        global $otapilib;

        $error = $this->validateFields($fields);
        if($error) return $error;

        $error = $this->checkCaptcha($fields);
        if($error) return $error;

        $xmlParams = str_replace('<?xml version="1.0"?>', '', $this->xmlParams($fields));
        $reg = $otapilib->RegisterUser($xmlParams);

        if($reg === false) {
            if((string)$otapilib->error_code == 'AlreadyExists') {
                if(strpos((string)$otapilib->error_message, 'Login') !== false) {
                    $error = Lang::get('login_username').' '.$fields['username'].' '.Lang::get('is_used_already');
                    return array(false, $error, '');
                } elseif(strpos((string)$otapilib->error_message, 'Email') !== false) {
                    $error = Lang::get('Email').' '.$fields['email'].' '.Lang::get('is_used_already');
                    return array(false, $error, '');
                } else {
                    return array(false, $otapilib->error_message, '');
                }
            } else {
                return array(false, $otapilib->error_message, '');
            }
        }

		$this->cms->SetSubscribe($fields['username'],$fields['email']);
        return array(true, Lang::get('reg_success'), '');
    }

	private function _registerFriend()
	{
        global $otapilib;
		$parent		= (!empty($_POST['parent'])) ? trim($_POST['parent']) : '';

		$cms = new CMS();
		if ($cms->Check()) {
			$cms->checkTable('site_referrals');
			$user		= $cms->GetUserByLogin($parent);
			$parent_id	= $user ? $user['id'] : 0;

            $user = $otapilib->GetUserInfo(Session::getUserSession());
			return $cms->AddUser($user, $_POST['email'], $parent_id);
		}
		return false;
	}

	private function sendCongratulate()
	{
		try {
			$mail = new PHPMailer();
			$mail->Subject	 = 'Сообщение с сайта ' . $_SERVER['HTTP_HOST'];
			$mail->From 	 = 'admin@' . $_SERVER['HTTP_HOST'];
			$mail->From_Name = 'admin';
            $mail->IsHTML(true);
            $mail->CharSet = 'utf-8';
			$mail->Body = 'Поздравляем с регистрацией на Velichina.com.ua!
							</br>Спешите оформить свой первый заказ и Вы официально будете являться участником нашего клуба,
							сможете получать подарки и стороить свой собственный бизнес с Velichina!';
			$mail->AddAddress(trim($_POST['email']));
			$mail->Send();
		} catch (phpmailerException $e) {

		}
	}


	private function sendEmail($email, $username, $password){
        $block = new RegisterEmail();
        General::mail_utf8(
            $email,
            @General::$siteConf['site_name'] ? @General::$siteConf['site_name'] : @CFG_SITE_NAME,
            'noreply@'.preg_replace('/^www\./','',$_SERVER['HTTP_HOST']),
            Lang::get('register_data'),
            $block->Generate(array($username, $password))
        );
    }

    protected function setVars()
    {
        $error = '';
		require dirname( dirname(__FILE__) ) . '/lib/phpmailer/class.phpmailer.php';
        if($_POST){
            list($success, $error, $errorcaptcha) = $this->processReg($_POST);
            if(!$success){
                $this->tpl->assign('username', $_POST['username']);
                $this->tpl->assign('email', $_POST['email']);

                $this->tpl->assign('error', $error);
                $this->tpl->assign('errorcaptcha', $errorcaptcha);
            }
            else{
                $this->sendEmail($_POST['email'], $_POST['username'], $_POST['password']);
                Users::Login($_POST);
		if (defined('KEY_REFERRAL_SYSTEM')) {
		    if ($this->_registerFriend())
			    $this->sendCongratulate();
		}
                header('Location: index.php?p=content&mode=reg_success');
            }
        }
        if(@$_SERVER['HTTP_REFERER'] != $_SERVER['REQUEST_URI']){
            $_SESSION['register_from'] = @$_SERVER['HTTP_REFERER'];
        }
    }
}

?>