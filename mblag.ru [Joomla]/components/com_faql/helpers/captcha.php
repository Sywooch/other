<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');

class faqlsHelperCaptcha
{
	function image()
	{
		$kcaptcha = JPATH_COMPONENT.DS.'kcaptcha'.DS.'kcaptcha.php';

		if (is_file($kcaptcha)) {
			if (!class_exists('KCAPTCHA')) {
				require_once($kcaptcha);
			}
			$captcha = new KCAPTCHA();
			$_SESSION['captcha-code'] = $captcha->getKeyString();
			$_SESSION['captcha-attempts'] = 1;
		} 
		exit;
	}
}
?>
