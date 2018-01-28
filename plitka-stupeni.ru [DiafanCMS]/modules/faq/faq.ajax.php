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
 * Faq_ajax
 *
 * Обработка запроса при отправки сообщения из формы "Задайте вопрос"
 */
class Faq_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (! empty($_POST['module']) && $_POST['module'] == 'faq' && ! empty($_POST["site_id"]) && (! $this->diafan->configmodules('only_user', 'faq', $_POST["site_id"]) || $this->diafan->_user->id))
		{
			if (! $this->site_id = DB::query_result(
						"SELECT s.id FROM {site} AS s"
						.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
						." WHERE s.id=%d AND s.module_name='faq' AND s.trash='0' AND s.block='0'"
						." AND (s.access='0'"
						.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						.") LIMIT 1", $_POST["site_id"]
				))
			{
				return false;
			}

			if (! empty($_POST["cat_id"]) && ! DB::query_result("SELECT id FROM {faq_category} WHERE id=%d AND trash='0' AND [act]='1' LIMIT 1", $_POST["cat_id"]))
			{
				return false;
			}
			$this->module = "faq";
			$this->tag = "faq".$this->site_id;

			$this->check_captcha();
			$this->empty_field();
			$this->valid_email($_POST['email'], "email");

			if ($this->send_errors())
				return true;

			if ($this->error_insert())
				return true;

			if (! DB::query("INSERT INTO {faq} (created, mail, [anons], [name], cat_id, site_id) VALUES (%d, '%h', '%h', '%h', %d, %d)",
			               time(), $_POST["email"], $_POST["question"], $_POST["name"], $_POST["cat_id"], $this->site_id))
			{
				$mes = $this->diafan->configmodules('error_add_message', 'faq', $this->site_id);
				$this->result["errors"][0] = $mes ? $mes : ' ';
				return $this->send_errors();
			}
			$save = DB::last_id("faq");

			$err = '';
			$this->result["files"] = '';
			$config = array('site_id' => $this->site_id, 'type' => 'configmodules');
			$result_upload = $this->diafan->_attachments->save($save, "faq", $config);
			if ($result_upload == 'success')
			{
				$attachs = $this->diafan->_attachments->get($save, "faq");
				foreach($attachs as $a)
				{
					if ($a["is_image"])
					{
						$this->result["files"] .= ' <a href="'.$a["link"].'">'.$a["name"].'</a> <a href="'.$a["link"].'"><img src="'.$a["link_preview"].'"></a>';
					}
					else
					{
						$this->result["files"] .= ' <a href="'.$a["link"].'">'.$a["name"].'</a>';
					}
				}
				if($this->diafan->configmodules("attachments_access_admin", 'faq', $this->site_id))
				{
					$this->result["files"] .= '<br>'.$this->diafan->_('Для просмотра файлов авторизуйтесь на сайте как администратор.', false);
				}
			}
			elseif ($result_upload != 'empty')
			{
				DB::query("DELETE FROM {faq} WHERE id=%d", $save);
				$this->diafan->_attachments->delete($save, 'faq');
				$this->result["errors"]["attachments"] = $result_upload;
				unset($this->result["altnames"]);
				return $this->send_errors();
			}

			$this->send_mail();
			$this->send_sms();
			unset($this->result["files"]);

			$mes = $this->diafan->configmodules('add_message', 'faq', $this->site_id);
			$this->result["errors"][0] = $mes ? $mes : ' ';
			$this->result["success"] = true;
			$this->result["form_hide"] = true;


			return $this->send_errors();
		}
	}

	/**
	 * Проверяет на заполнение обязательных полей
	 * 
	 * @return boolean true
	 */
	private function empty_field()
	{
		if (empty($_POST['name']))
		{
			$this->result["errors"]["name"] = $this->diafan->_('Пожалуйста, введите имя', false);
		}
		if (empty($_POST['question']))
		{
			$this->result["errors"]["question"] = $this->diafan->_('Пожалуйста, введите вопрос', false);
		}
		return true;
	}

	/**
	 * Проверяет на попытку отправить сообщение повторно
	 * 
	 * @return boolean
	 */
	private function error_insert()
	{
		$mes = '';
		$num = DB::query_result("SELECT COUNT(id) FROM {faq} where mail='%h' AND anons".$this->diafan->language_base_site."='%h'", $_POST["email"], $_POST["question"]);
		if ($num > 0)
		{ 
			$mes = $this->diafan->configmodules('error_insert_message', 'faq', $this->site_id);
			$this->result["errors"][0] = $mes ? $mes : ' ';
		}
		return $this->send_errors();
	}

	/**
	 * Уведомляет администратора по e-mail
	 * 
	 * @return void
	 */
	private function send_mail()
	{
		if (! $this->diafan->configmodules("sendmailadmin", 'faq', $this->site_id))
			return false;
			
		$subject = str_replace(
			array('%title', '%url'),
			array(TITLE, BASE_URL),
			$this->diafan->configmodules("subject_admin", 'faq', $this->site_id)
		);
			
		$message = str_replace(
			array('%name', '%title', '%url', '%question', '%email', '%files'),
			array(
				$this->diafan->get_param($_POST, "name", '', 1),
				TITLE,
				BASE_URL,
				$this->diafan->get_param($_POST, "question", '', 1),
				$this->diafan->get_param($_POST, "email", '', 1),
				($this->result["files"] ? $this->result["files"] : '-')
			),
			$this->diafan->configmodules("message_admin", 'faq', $this->site_id)
		);

		$to   = $this->diafan->configmodules("emailconfadmin", 'faq', $this->site_id)
		        ? $this->diafan->configmodules("email_admin", 'faq', $this->site_id)
		        : EMAIL_CONFIG;
		$from = $this->diafan->configmodules("emailconf", 'faq', $this->site_id)
		        ? $this->diafan->configmodules("email", 'faq', $this->site_id)
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
		if (! $this->diafan->configmodules("sendsmsadmin", 'faq', $this->site_id))
			return false;
			
		$message = $this->diafan->configmodules("sms_message_admin", 'faq', $this->site_id);

		$to   = $this->diafan->configmodules("sms_admin", 'faq', $this->site_id);

		include_once ABSOLUTE_PATH.'includes/sms.php';
		Sms::send($message, $to);
	}
}