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
 * SMS
 * Набор функций для отправки SMS
 */
class SMS
{
	/**
	 * Отправляет SMS
	 * @param string $text текст SMS
	 * @param string $to номер получателя
	 * @return void
	 */
	public static function send($text, $to)
	{
		if(! SMS)
		{
			return;
		}
		$to = preg_replace('/[^0-9]+/', '', $to);
		if($error = self::validate_to($to))
		{
			return $error;	
		}
		$text = urlencode(str_replace("\n", "%0D", substr($text, 0, 800)));
		$fp = fsockopen('bytehand.com', 3800);
		if($fp)
		{
			$result = file_get_contents("http://bytehand.com:3800/send?id=".urlencode(SMS_ID)."&key=".urlencode(SMS_KEY)."&to=".$to."&from=".urlencode(SMS_SIGNATURE)."&text=".$text);
		}
	}

	/**
	 * Валидация номера получателя
	 * @param string $to номер получателя
	 * @return string|boolean false
	 */
	public static function validate_to($to)
	{
		$to = preg_replace('/[^0-9]+/', '', $to);
		if(strlen($to) != 11)
		{
			return 'Некорректный номер';
		}
		return false;
	}
}