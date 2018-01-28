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
 * Ads_ajax
 *
 * Обработка запроса на добавление объявления
 */
class Ads_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (! empty($_POST['module']) && $_POST['module'] == 'ads' && ! empty($_POST["site_id"]))
		{
			if (! $this->site_id = DB::query_result(
						"SELECT s.id FROM {site} AS s"
						.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
						." WHERE s.id=%d AND s.module_name='ads' AND s.trash='0' AND s.block='0'"
						." AND (s.access='0'"
						.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						.") LIMIT 1", $_POST["site_id"]
				))
			{
				return false;
			}
			$use_cat = $this->diafan->configmodules('cat', "ads", $this->site_id);
			if (empty($_POST["cat_id"]))
			{
				if($use_cat)
				{
					return false;
				}
				else
				{
					$cat_id = 0;
				}
			}
			else
			{
				$cat_id = $_POST["cat_id"];
			}
			if ($this->diafan->configmodules('only_user', "ads", $this->site_id) && ! $this->diafan->_user->id)
			{
				return false;
			}
			$this->module = "ads";
			$this->tag = "ads";

			$this->check_captcha();

			$this->validate();

			Customization::inc('modules/ads/ads.model.php');
			$model = new Ads_model($this->diafan);
			$params = $model->get_param_form($this->site_id, $cat_id, $use_cat);

			$this->empty_required_field(array("params" => $params));

			if ($this->send_errors())
				return true;

			DB::query(
				"INSERT INTO {ads} ([name], [anons], [text], "
				//."date_finish, "
				."[act], user_id, created, site_id, cat_id)"
				." VALUES ('%s', '%s', '%s', "
				//."%d, "
				."'%d', %d, %d, %d, %d)",
				nl2br(htmlspecialchars($_POST["name"])),
				nl2br(htmlspecialchars($_POST["anons"])),
				nl2br(htmlspecialchars($_POST["text"])),
				//$this->diafan->unixdate($_POST["date_finish"]),
				$this->diafan->configmodules('premoderation', "ads", $this->site_id) ? 0 : 1,
				$this->diafan->_user->id,
				time(),
				$this->site_id,
				$cat_id
			);
			$save = DB::last_id("ads");
			if($cat_id)
			{
				DB::query("INSERT INTO {ads_category_rel} (element_id, cat_id) VALUES (%d, %d)", $save, $cat_id);
			}
			if(! $this->diafan->configmodules('premoderation', "ads", $this->site_id))
			{
				$this->diafan->_cache->delete('', 'ads');
			}
			if(ROUTE_AUTO_MODULE)
			{
				Customization::inc('adm/includes/save_functions.php');
				$save_functions = new Save_functions_admin($this->diafan);
				$rewrite = $save_functions->generate_rewrite($_POST["name"]);
				if($cat_id)
				{
					$rewrite_parent = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='ads' AND cat_id=%d LIMIT 1", $cat_id);
				}
				if(empty($rewrite_parent))
				{
					$rewrite_parent = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->site_id);
				}
				if(! empty($rewrite_parent))
				{
					$rewrite = $rewrite_parent.'/'.$rewrite;
				}
				DB::query("INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('%h', 'ads', %d, %d)", $rewrite, $save, $this->site_id);
			}

			$this->insert_values(array("id" => $save, "table" => "ads", "params" => $params, "multilang" => true));

			if ($this->send_errors())
				return true;

			$this->send_mail();
			$this->send_sms();

			$mes = $this->diafan->configmodules('add_message', 'ads', $this->site_id, _LANG);
			$this->result["errors"][0] = $mes ? $mes : ' ';
			$this->result["success"] = true;
			$this->result["form_hide"]= true;
			return $this->send_errors();
		}
		return false;
	}

	/**
	 * Проверяет валидность введенных данных
	 * 
	 * @return void
	 */
	private function validate()
	{
		Customization::inc('includes/validate.php');
		if(empty($_POST["name"]))
		{
			$mes = 'Пожалуйста, введите заголовок';
		}
		else
		{
			$mes = Validate::text($_POST["name"]);
		}
		if ($mes)
		{
			$this->result["errors"]["name"] = $this->diafan->_($mes);
		}
		if(empty($_POST["anons"]))
		{
			$mes = 'Пожалуйста, введите краткое содержание';
		}
		else
		{
			$mes = Validate::text($_POST["anons"]);
		}
		if ($mes)
		{
			$this->result["errors"]["anons"] = $this->diafan->_($mes);
		}
		if(empty($_POST["text"]))
		{
			$mes = 'Пожалуйста, введите полное содержание';
		}
		else
		{
			$mes = Validate::text($_POST["text"]);
		}
		if ($mes)
		{
			$this->result["errors"]["text"] = $this->diafan->_($mes);
		}
		/*if(empty($_POST["date_finish"]))
		{
			$mes = 'Пожалуйста, введите дату';
		}
		else
		{
			$mes = Validate::date($_POST["date_finish"]);
		}
		if ($mes)
		{
			$this->result["errors"]["date_finish"] = $this->diafan->_($mes);
		}*/
	}

	/**
	 * Уведомление администратора по e-mail
	 * 
	 * @return void
	 */
	private function send_mail()
	{
		if (! $this->diafan->configmodules("sendmailadmin", 'ads', $this->site_id))
			return false;

		$subject = str_replace(
			array('%title', '%url'),
			array(TITLE, BASE_URL),
			$this->diafan->configmodules("subject_admin", 'ads', $this->site_id)
		);

		$mes = $this->diafan->_('Заголовок', false).': '.$this->diafan->get_param($_POST, "name", '', 1)
		.'<br>'.$this->diafan->_('Краткое содержание', false).': '.$this->diafan->get_param($_POST, "anons", '', 1)
		.'<br>'.$this->diafan->_('Полное содержание', false).': '.$this->diafan->get_param($_POST, "text", '', 1)
		.($this->message_admin_param ? '<br>'.$this->message_admin_param : '');

		$message = str_replace(
			array('%title', '%url', '%message'),
			array(
				TITLE,
				BASE_URL,
				$mes
			),
			$this->diafan->configmodules("message_admin", 'ads', $this->site_id)
		);

		$to   = $this->diafan->configmodules("emailconfadmin", 'ads', $this->site_id)
		        ? $this->diafan->configmodules("email_admin", 'ads', $this->site_id)
		        : EMAIL_CONFIG;
		$from = $this->diafan->configmodules("emailconf", 'ads', $this->site_id)
		        ? $this->diafan->configmodules("email", 'ads', $this->site_id)
		        : '';

		include_once ABSOLUTE_PATH.'includes/mail.php';
		send_mail($to, $subject, $message, $from);
	}

	/**
	 * Уведомляет администратора по SMS
	 * 
	 * @return void
	 */
	private function send_sms()
	{
		if (! $this->diafan->configmodules("sendsmsadmin", 'ads', $this->site_id))
			return false;
			
		$message = $this->diafan->configmodules("sms_message_admin", 'ads', $this->site_id);

		$to   = $this->diafan->configmodules("sms_admin", 'ads', $this->site_id);

		include_once ABSOLUTE_PATH.'includes/sms.php';
		Sms::send($message, $to);
	}
}