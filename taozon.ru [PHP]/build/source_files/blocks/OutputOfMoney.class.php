<?php

class OutputOfMoney extends GenerateBlock {

	protected	$_template = 'outputofmoney';
	protected	$_template_path = '/privateoffice/';
	private		$_account_info;

	public function __construct() {
		parent::__construct(true);
	}

	protected function setVars() {
        if(!isset($_SESSION[CFG_SITE_NAME.'loginUserData']))
            header('Location: index.php');

		$this->_account_info = $this->_getUserData();
		if (!$this->_account_info)
			header('Location: index.php');

		$this->tpl->assign('amount', $this->_account_info['availableamount']);
		$this->tpl->assign('comment', isset($_POST['comment']) ? $_POST['comment'] : '');
		$this->tpl->assign('success', isset($_GET['success']) ? 'Запрос успешно отправлен' : '');
		$this->tpl->assign('error', isset($_GET['error']) ? 'Ошибка! Попробуйте еще раз.' : '');
		if ($_POST) {
			if ($this->_sendMail()) {
				header('Location: index.php?p=outputofmoney&success');
			} else {
				header('Location: index.php?p=outputofmoney&error');
			}
		}
	}

	private function _getUserData()
	{
		global $otapilib;
		global $accountinfo;
		$sid = $_SESSION[CFG_SITE_NAME.'loginUserData']['sid'];
		$data = array();
		$user_info = $otapilib->GetUserInfo($sid);
		if ($user_info) {
			$data = array_merge($data, $user_info);
		}
		if (@$accountinfo) {
			$data = array_merge($data, $accountinfo);
		}
        return $data;
	}

	private function _validate()
	{
		$valid = $this->_account_info['availableamount']>= $_POST['amount'];
		return $valid && @$this->_account_info['email'];
	}

	private function _sendMail()
	{
		if (!$this->_validate())
			return false;
		try {
            require dirname(dirname(__FILE__)) . '/lib/phpmailer/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->AddAddress($this->_getEmailFrom());
            $mail->Subject = Lang::get('Withdrawals');
            $mail->From = 'admin@' . $_SERVER['HTTP_HOST'];
            $mail->FromName = CFG_SITE_NAME;
            $mail->IsHTML();
            $mail->CharSet = 'utf-8';
            $mail->Body = $this->_getMessage();
			$mail->Send();
			return true;
        }
        catch (phpmailerException $e) {
			return false;
        }
	}

	private function _getMessage()
	{
        $text = '';
        $text .= Lang::get('user').' ';
        $text .= $this->_getUserFIO();
        $text .= @$this->_account_info['login'];
        $text .= '(' . $this->_account_info['email'] . ') ' . Lang::get('ask_withdrawals') . PHP_EOL;
        $text .= Lang::get('Available').': <b>' . @$this->_account_info['availableamount'] .
                ' ' . @$this->_account_info['currencysign'].'</b>' . PHP_EOL;
        $text .= Lang::get('Ask to withdraw').': <b>' . $_POST['amount'] .
                ' ' . @$this->_account_info['currencysign'].'</b>' . PHP_EOL;
        $text .= Lang::get('comment').'<hr><u>:</u>' . PHP_EOL ;
        $text .= $_POST['comment'] ? $_POST['comment'] : '';
        return nl2br($text);
	}

	private function _getEmailFrom()
	{
		
                $email_cfg = General::$siteConf['site_admin_email'];
		return $email_cfg ? $email_cfg : 'noreply@'.preg_replace('/^www\./','',$_SERVER['HTTP_HOST']);
	}

	private function _getUserFIO()
	{
		$fio = array();
		$fio[] = $this->_account_info['firstname'];
		$fio[] = $this->_account_info['middlename'];
		$fio[] = $this->_account_info['lastname'];
		return trim(implode(' ', $fio));
	}

}
