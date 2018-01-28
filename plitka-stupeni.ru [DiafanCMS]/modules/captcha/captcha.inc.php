<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Captcha_inc
 * 
 * Работа с каптчей
 */

class Captcha_inc extends Model
{
	/**
	 * Выводит каптчу
	 * 
	 * @param string $modules метка каптчи
	 * @param string $error ошибка ввода кода, если запрос передан не через Ajax
	 * @param boolean $is_update каптча генерируется для обновления
	 * @return string
	 */
	public function get($modules = "modules", $error = "", $is_update = false)
	{
		if(defined('RECAPTCHA') && RECAPTCHA)
		{
			if(isset($_POST["recaptcha_challenge_field"]))
			{
				unset($_POST["recaptcha_challenge_field"]);
				return "recaptcha";
			}
			else
			{
				$result["public_key"] = RECAPTCHA_PUBLIC_KEY;
				$result["error"] = $error;
				$result["modules"] = $modules;
				return $this->diafan->_tpl->get('get_recaptcha', 'captcha', $result);
			}
		}
		else
		{
			return $this->diafan->_tpl->get('get', 'captcha', array("modules" => $modules, "error" => $error, "update" => $is_update));
		}
	}

	/**
	 * Проверяет правильность ввода каптчи
	 * 
	 * @param string $modules метка каптчи
	 * @return string|boolean false
	 */
	public function is_right($modules = "modules")
	{
		if(defined('RECAPTCHA') && RECAPTCHA)
		{
			if(empty($_POST["recaptcha_challenge_field"]))
			{
				$_POST["recaptcha_challenge_field"] = '';
			}
			if(empty($_POST["recaptcha_response_field"]))
			{
				$_POST["recaptcha_response_field"] = '';
			}
			$fp = fsockopen('www.google.com', 80);
			if($fp)
			{
				$param = "privatekey=".urlencode(RECAPTCHA_PRIVATE_KEY)."&"
				."remoteip=".urlencode($_SERVER['REMOTE_ADDR'])."&"
				."challenge=".urlencode($_POST["recaptcha_challenge_field"])."&"
				."response=".urlencode($_POST["recaptcha_response_field"]);
				$size = strlen($param);

				fputs($fp, "POST http://www.google.com/recaptcha/api/verify HTTP/1.1\r\n"
				."Host: www.google.com\r\n"
				."Content-type: application/x-www-form-urlencoded\r\n"
				."Content-Length: ".$size."\r\n"
				."Connection: Close\r\n\r\n"
				.$param);

				$result = false;
				$resultstr = '';
				while(!feof($fp))
				{
					$response = fgets($fp);
					if($result)
					{
						$resultstr .= $response;
					}
					if(strpos($response, "Connection: close") !== false)
					{
						$result = true;
					}
				}
				fclose($fp);
				if(strpos($resultstr, 'true') !== false && strpos($resultstr, 'success'))
				{
					return false;
				}
				else
				{
					if(MOD_DEVELOPER && strpos($resultstr, 'invalid-site-private-key') !== false)
					{
						return $this->diafan->_('Провертьте Rrivate Key для сервиса reCAPTCHA', false);
					}
					else
					{
						return $this->diafan->_('Не правильно введен защитный код', false);
					}
				}
			}
			else
			{
				return $this->diafan->_('Не возможно подключиться к северу reCAPTCHA', false);
			}

			return false;
		}
		else
		{
			//Защитный код не введен
			if (empty($_POST['captcha']) || empty($_POST['captchaint']))
				return $this->diafan->_('Введите защитный код', false);
	
			//В сессии не записан код с данным идентификатором captchaint
			if (! isset($_SESSION['captcha'][$modules][$_POST['captchaint']])
			||
			//код из сессии не соответствует введенному. регистр не учитывается
			strtoupper($_SESSION['captcha'][$modules][$_POST['captchaint']]) != strtoupper($_POST['captcha']))
				return $this->diafan->_('Не правильно введен защитный код', false);
	
			//очищаем из сессии запись с данным идентификатором
			unset($_SESSION['captcha'][$modules][$_POST['captchaint']]);
			return false;
		}
	}
}