<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Registration_ajax
 *
 * Обработка запроса при регистрации пользователя
 */
class Registration_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (empty($_POST['module']) || $_POST['module'] != 'registration' || empty($_POST["action"]) || $this->diafan->_user->id)
		{
			return false;
		}

		$this->module = 'users';
		$this->tag = 'registration';

		switch($_POST["action"])
		{
			case 'addnew':
				return $this->addnew();
			case 'fast_validate':
				return $this->fast_validate();
		}
		return false;
	}

	/*
	 * Добавляет нового пользователя
	 * 
	 * @return boolean
	 */
	private function addnew()
	{
		$this->check_captcha();
		$this->validate();

		$role_id = $this->get_role_id();
		$where_param_role_rel = $this->get_where_param_role_rel($role_id);

		$params = $this->get_params(array("module" => "users", "where" => "show_in_form_no_auth='1'".$where_param_role_rel));

		$this->empty_required_field(array("params" => $params));

		if ($this->send_errors())
			return true;

		if($this->diafan->configmodules("mail_as_login", "users"))
		{
			list($_POST["name"],) = explode('@', $_POST["mail"]);
			while(DB::query_result("SELECT name FROM {users} WHERE name='%h' AND trash='0'",  $_POST["name"]))
			{
				$_POST["name"] = $_POST["name"].mt_rand(1, 99999);
			}
		}

		DB::query("INSERT INTO {users} (name, password, mail, created, lang_id, fio, act, role_id)"
				. " VALUES ('%h', '%h', '%h', '%d', '%d', '%h', '%d', %d)",
				$_POST["name"], encrypt($_POST["password"]), $_POST["mail"], time(),
				_LANG, $_POST["fio"], $this->diafan->configmodules("act", "users") ? 0 : 1,
				$role_id
		);
		$save_id = DB::last_id("users");

		$this->insert_values(array("id" => $save_id, "table" => "users", "params" => $params));

		if ($this->send_errors())
			return true;
		
		if(DB::query_result("SELECT id FROM {modules} WHERE module_name='subscribtion' LIMIT 1") && (! empty($_POST['subscribe']) || ! $this->diafan->configmodules('subscribe_in_registration', 'subscribtion')))
		{
			$email_id = DB::query_result("SELECT id FROM {subscribtion_emails} WHERE mail='%s' LIMIT 1", $_POST['mail']);
			
			if($email_id)
			{
				DB::query("UPDATE {subscribtion_emails} SET act='1', trash='0' WHERE id=%d LIMIT 1", $email_id);
			}
			else
			{
				$code = md5(rand(111, 99999));
				DB::query("INSERT INTO {subscribtion_emails} (created, mail, code, act) VALUES (%d, '%s', '%s', '1')", time(), $_POST['mail'], $code);
			}
		}

		$this->send_mails($save_id);

		$this->upload_avatar();

		if (!$this->diafan->configmodules("act", "users"))
		{
			$this->diafan->_user->id = $save_id;
			if ($_POST["url"])
			{
				$this->result["redirect"] = $_POST["url"];
				return $this->send_errors();
			}
		}
		if($this->diafan->configmodules("hide_register_form", "users"))
		{
			$this->result["form_hide"] = true;
		}

		$this->result["data"] = $this->diafan->configmodules('mes', "users");
		$this->result["target"] = ".registration_message";
		$this->result["success"] = true;

		return $this->send_errors();
	}

	/**
	 * Валидация данных "на лету"
	 * 
	 * @return void
	 */
	private function fast_validate()
	{
		Customization::inc('includes/validate.php');
		switch($_POST["name"])
		{
			case "name":
				if(! $this->diafan->configmodules("mail_as_login", "users") && $mes = Validate::login($_POST["value"]))
				{
					echo $this->diafan->_($mes, false);
				}
				break;
			case "mail":
				if(! $mes = Validate::mail($_POST["value"]))
				{
					$mes = Validate::mail_user($_POST["value"]);
				}
				if($mes)
				{
					echo $this->diafan->_($mes, false);
				}
				break;
			case "password":
				if($mes = Validate::password($_POST["value"], true))
				{
					echo $this->diafan->_($mes, false);
				}
				break;
			case "password2":
				if($_POST["value"] != $_POST["value2"])
				{
					echo $this->diafan->_('Пароли не совпадают', false);
				}
				break;
		}
		return true;
	}

	/**
	 * Проверяет валидность введенных при регистрации данных
	 * 
	 * @return void
	 */
	private function validate()
	{
		Customization::inc('includes/validate.php');
		if(! $this->diafan->configmodules("mail_as_login", "users"))
		{
			$mes = Validate::login($_POST["name"]);
			if ($mes)
			{
				$this->result["errors"]["name"] = $this->diafan->_($mes, false);
			}
		}
		$mes = Validate::mail($_POST["mail"]);
		if ($mes)
		{
			$this->result["errors"]["mail"] = $this->diafan->_($mes, false);
		}
		else
		{
			$mes = Validate::mail_user($_POST["mail"]);
			if ($mes)
			{
				$this->result["errors"]["mail"] = $this->diafan->_($mes, false);
			}
		}
		$mes = Validate::password($_POST["password"]);
		if ($mes)
		{
			$this->result["errors"]["password"] = $this->diafan->_($mes, false);
		}
		elseif ($_POST["password"] != $_POST["password2"])
		{
			$this->result["errors"]["password"] = $this->diafan->_('Пароли не совпадают', false);
		}

		if (!$_POST["fio"])
		{
			$this->result["errors"]["fio"] = $this->diafan->_('Заполните поле ФИО или название компании', false);
		}
	}

	/**
	 * Проверяет валидность заполнения роли пользователя, определяет роль для нового пользователя
	 * 
	 * @return boolean
	 */
	private function get_role_id()
	{
		$roles = array();
		$result = DB::query("SELECT id FROM {users_role} WHERE registration='1' AND trash='0'");
		while ($row = DB::fetch_array($result))
		{
			$roles[] = $row["id"];
		}
		if(! count($roles))
		{
			return 0;
		}
		if(count($roles) == 1)
		{
			return $roles[0];
		}

		if (empty($_POST["role_id"]) || !in_array($_POST["role_id"], $roles))
		{
			$this->result["errors"]["role_id"] = 'ERROR_ROLE_ID';
		}

		return $_POST["role_id"];
	}

	/**
	 * Получает условие для SQL-запроса: выбор полей с учетом роли пользователя
	 *
	 * @param integer $role_id номер роли пользователя
	 * @return string
	 */
	private function get_where_param_role_rel($role_id)
	{
		$param_ids = array();
		$param_role_rels = array();
		$result = DB::query("SELECT role_id, element_id FROM {users_param_role_rel} WHERE trash='0' AND role_id>0");
		while ($row = DB::fetch_array($result))
		{
			$param_role_rels[$row["element_id"]][] = $row["role_id"];
		}
		foreach($param_role_rels as $param_id => $roles)
		{
			if(! in_array($role_id, $roles))
			{
				$param_ids[] = $param_id;
			}
		}
		if($param_ids)
		{
			return " AND id NOT IN (".implode(",", $param_ids).")";
		}
		return '';
	}

	/**
	 * Отправляет письмо новому пользователю и администратору сайта
	 * 
	 * @return boolean true
	 */
	private function send_mails($save)
	{
		include_once ABSOLUTE_PATH . 'includes/mail.php';
		if ($this->diafan->configmodules("sendmailadmin", "users"))
		{
			$subject = str_replace(
					array('%title', '%url'), array(TITLE, BASE_URL), $this->diafan->configmodules('subject_admin', "users")
			);
			$message = str_replace(
					array('%login', '%title', '%url', '%fio', '%email', '%params'), array(
						$this->diafan->get_param($_POST, "name", '', 1),
						TITLE,
						BASE_URL,
						$this->diafan->get_param($_POST, "fio", '', 1),
						$this->diafan->get_param($_POST, "mail", '', 1),
						$this->message_admin_param,
					), $this->diafan->configmodules('message_admin', "users")
			);

			if ($message && $subject)
			{
				send_mail(
						$this->diafan->configmodules("emailconfadmin", "users") ? $this->diafan->configmodules("email_admin", "users") : EMAIL_CONFIG, $subject, $message, $this->diafan->configmodules("emailconf", "users") ? $this->diafan->configmodules("email", "users") : ''
				);
			}
		}

		//send mail user
		$subject = str_replace(
				array('%title', '%url'), array(TITLE, BASE_URL), $this->diafan->configmodules('subject', "users")
		);

		$actlink = '';
		if ($this->diafan->configmodules("act", "users") == 1)
		{
			$actcode = md5(rand(111, 99999));
			DB::query("INSERT INTO {users_actlink} (link, user_id, created) VALUES ('%s', '%d', '%d')", $actcode, $save, time() + 86400);
			$link    = BASE_PATH_HREF . $this->diafan->_route->link($this->diafan->cid) . '?action=act&user_id='.$save.'&code=' . $actcode;
			$actlink = '<a href="' . $link . '">' . $link . '</a>';
		}

		$message = str_replace(
				array('%login', '%title', '%url', '%fio', '%password', '%params', '%actlink'), array(
					$this->diafan->get_param($_POST, "name", '', 1),
					TITLE,
					BASE_URL,
					$this->diafan->get_param($_POST, "fio", '', 1),
					$this->diafan->get_param($_POST, "password", '', 1),
					$this->message_param,
					$actlink
				), $this->diafan->configmodules('message', "users")
		);

		if ($message && $subject)
		{
			send_mail(
					$_POST["mail"], $subject, $message, $this->diafan->configmodules("emailconf", "users") ? $this->diafan->configmodules("email", "users") : ''
			);
		}
		return true;
	}

	/**
	 * Загружает аватар
	 * 
	 * @return boolean
	 */
	private function upload_avatar()
	{
		if (!$this->diafan->configmodules("avatar", "users"))
		{
			return false;
		}
		if (isset($_FILES["avatar"]) && is_array($_FILES["avatar"]) && $_FILES["avatar"]['name'] != '')
		{
			list($width, $height) = getimagesize($_FILES["avatar"]['tmp_name']);
			if (!$width || !$height)
			{
				$this->result["errors"]["avatar"] = $this->diafan->_('Некорректный файл.', false);
				return $this->send_errors();
			}
			if ($width < $this->diafan->configmodules("avatar_width", "users") || $height < $this->diafan->configmodules("avatar_height", "users"))
			{
				$this->result["errors"]["avatar"] = $this->diafan->_('Размер изображения должен быть не меньше %spx X %spx.', false, $this->diafan->configmodules("avatar_width", "users"), $this->diafan->configmodules("avatar_height", "users"));
				return $this->send_errors();
			}
			Customization::inc('includes/image.php');
			if (!Image::resize($_FILES["avatar"]['tmp_name'], $this->diafan->configmodules("avatar_width", "users"), $this->diafan->configmodules("avatar_height", "users"), $this->diafan->configmodules("avatar_quality", "users"), true, true))
			{
				$this->result["errors"]["avatar"] = $this->diafan->_('Файл не загружен.', false);
				return $this->send_json();
			}
			$dst_img  = imageCreateTrueColor($this->diafan->configmodules("avatar_width", "users"), $this->diafan->configmodules("avatar_height", "users"));
			$original = @imageCreateFromString(file_get_contents($_FILES["avatar"]['tmp_name']));
			imageCopy($dst_img, $original, 0, 0, 0, 0, $this->diafan->configmodules("avatar_width", "users"), $this->diafan->configmodules("avatar_height", "users"));
			imagePNG($dst_img, ABSOLUTE_PATH . USERFILES . '/avatar/' . $_POST["name"] . '.png');
		}
		return true;
	}

}