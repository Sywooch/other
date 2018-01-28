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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * Отправляет электронное письмо
 *
 * @param string|array $recipient получатель/получатели
 * @param string $subject тема письма
 * @param string $body содержание письма
 * @param string $from адрес отправителя
 * @return boolean
 */
function send_mail($recipient, $subject, $body, $from = '')
{
	include_once ABSOLUTE_PATH.'plugins/class.phpmailer.php';

	$mail = new PHPMailer();

	if (defined('SMTP_MAIL') && SMTP_MAIL && SMTP_HOST && SMTP_LOGIN && SMTP_PASSWORD)
	{
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = SMTP_HOST;  // SMTP server
		$mail->SMTPDebug  = MOD_DEVELOPER ? 1 : 0; // enables SMTP debug information (for testing)
										           // 1 = errors and messages
										           // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		if (SMTP_PORT)
		{
			$mail->Port   = SMTP_PORT;          // set the SMTP port for the GMAIL server
		}
		$mail->Username   = SMTP_LOGIN;    // SMTP account username
		$mail->Password   = SMTP_PASSWORD; // SMTP account password
	}
	
	$mail->SetFrom($from ? $from : EMAIL_CONFIG, TITLE);
	$mail->Subject = $subject;
	$mail->MsgHTML($body);

	if (is_array($recipient))
	{
		foreach ($recipient as $to)
		{
			$mail->AddAddress($to);
		}
	}
	elseif (strpos($recipient, ',') !== false)
	{
		$recipients = explode(',', $recipient);
		foreach ($recipients as $r)
		{
			$mail->AddAddress(trim($r));
		}
	}
	else
	{
		$mail->AddAddress($recipient);
	}
	$mailssend = $mail->Send();
	
	return $mailssend;
}
