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
 * Feedback_ajax
 *
 * Обработка запроса при отправке сообщения из формы обратной связи
 */
class Feedback_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (! empty($_POST['module']) && $_POST['module'] == 'feedback' && ! empty($_POST["site_id"]))
		{
			if (! $this->site_id = DB::query_result(
						"SELECT s.id FROM {site} AS s"
						.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
						." WHERE s.id=%d AND s.module_name='feedback' AND s.trash='0' AND s.block='0'"
						." AND (s.access='0'"
						.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						.") LIMIT 1", $_POST["site_id"]
				))
			{
				return false;
			}
			$this->module = "feedback";
			$this->tag = "feedback".$this->site_id;

			$this->check_captcha();
			$params = $this->get_params(array("module" => "feedback", "where" => "site_id=".$this->site_id));
			$this->empty_required_field(array("params" => $params));

			if ($this->send_errors())
				return true;

			if (! DB::query("INSERT INTO {feedback} (created, site_id, lang_id) VALUES (%d, %d, %d)", time(), $this->site_id, _LANG))
			{
				$this->result["errors"][0] = 'ERROR';
				return $this->send_errors();
			}
			$save = DB::last_id("feedback");

			$this->insert_values(array("id" => $save, "table" => "feedback", "params" => $params));

			if ($this->send_errors())
				return true;

			$this->send_mail();
			$this->send_sms();

			$mes = $this->diafan->configmodules('add_message', 'feedback', $this->site_id, _LANG);
			$this->result["errors"][0] = $mes ? $mes : ' ';
			$this->result["success"] = true;
			$this->result["form_hide"]= true;
			return $this->send_errors();
		}
		return false;
	}

	/**
	 * Уведомление администратора по e-mail
	 * 
	 * @return boolean
	 */
	private function send_mail()
	{
		if (! $this->diafan->configmodules("sendmailadmin", 'feedback', $this->site_id))
			return false;

		$subject = str_replace(
			array('%title', '%url'),
			array(TITLE, BASE_URL),
			$this->diafan->configmodules("subject_admin", 'feedback', $this->site_id)
		);

		$message = str_replace(
			array('%title', '%url', '%message'),
			array(
				TITLE,
				BASE_URL,
				$this->message_admin_param
			),
			$this->diafan->configmodules("message_admin", 'feedback', $this->site_id)
		);

		$to   = $this->diafan->configmodules("emailconfadmin", 'feedback', $this->site_id)
		        ? $this->diafan->configmodules("email_admin", 'feedback', $this->site_id)
		        : EMAIL_CONFIG;
		$from = $this->diafan->configmodules("emailconf", 'feedback', $this->site_id)
		        ? $this->diafan->configmodules("email", 'feedback', $this->site_id)
		        : '';

		include_once ABSOLUTE_PATH.'includes/mail.php';
		send_mail($to, $subject, $message, $from);

		return true;
	}

	/**
	 * Уведомляет администратора по sms
	 * 
	 * @return void
	 */
	private function send_sms()
	{
		if (! $this->diafan->configmodules("sendsmsadmin", 'feedback', $this->site_id))
			return false;
			
		$message = $this->diafan->configmodules("sms_message_admin", 'feedback', $this->site_id);

		$to   = $this->diafan->configmodules("sms_admin", 'feedback', $this->site_id);

		include_once ABSOLUTE_PATH.'includes/sms.php';
		Sms::send($message, $to);
	}
}