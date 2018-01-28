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
 * Usersettings_ajax
 *
 * Обработка запроса при изменении данных о пользователе
 */
class Usersettings_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (empty($_POST['module']) || $_POST['module'] != 'usersettings' || empty($_POST["action"]) || $this->diafan->module != 'usersettings' || ! $this->diafan->_user->id)
		{
			return false;
		}

		$this->module = 'users';
		$this->tag = 'usersettings';

		switch($_POST["action"])
		{
			case 'edit':
				return $this->edit();
			case 'delete_avatar':
				return $this->delete_avatar();
		}
		return false;
	}

	/*
	 * Редактирует данные пользователя
	 * 
	 * @return boolean
	 */
	private function edit()
	{
		if (!$this->diafan->_user->checked)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();

		if ($this->validate())
			return true;

		$where_param_role_rel = $this->get_where_param_role_rel($this->diafan->_user->role_id);
		$params = $this->get_params(array("module" => "users", "where" => "show_in_form_auth='1'".$where_param_role_rel));
		$this->empty_required_field(array("params" => $params));

		if($this->diafan->_route->id_module('cart'))
		{
			$order_params = $this->get_params(array("module" => "shop", "table" => "shop_order", "where" => "show_in_form_register='1'"));
			//$this->empty_required_field(array("params" => $order_params, "prefix" => "dop_"));
		}

		if ($this->send_errors())
			return true;

		if (!empty($_POST["lang_id"]) && !DB::query_result("SELECT id FROM {languages} WHERE id=%d LIMIT 1", $_POST["lang_id"]))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		$this->update_values(array("id" => $this->diafan->_user->id, "table" => "users", "params" => $params));

		if ($this->send_errors())
			return true;

		if(! empty($order_params))
		{
			$this->update_values(array("id" => $this->diafan->_user->id, "table" => "shop_order", "params" => $order_params, "prefix" => "dop_", "rel" => "user"));
		}

		if ($this->send_errors())
			return true;

		if($this->diafan->configmodules("mail_as_login", "users"))
		{
			if($this->diafan->_user->name)
			{
				$_POST["name"] = $this->diafan->_user->name;
			}
			else
			{
				list($_POST["name"],) = explode('@', $_POST["mail"]);
				while(DB::query_result("SELECT name FROM {users} WHERE name='%h' AND trash='0'",  $_POST["name"]))
				{
					$_POST["name"] = $_POST["name"].mt_rand(1, 99999);
				}
			}
		}

		DB::query("UPDATE {users} SET name='%h', mail='%h', lang_id=%d, fio='%h' WHERE id=%d",
			  $_POST["name"], $_POST["mail"], !empty($_POST["lang_id"]) ? $_POST["lang_id"] : 0,
			  $_POST["fio"], $this->diafan->_user->id
		);

		if(! $this->diafan->_route->id_module('subscribtion')
		   && DB::query_result("SELECT id FROM {modules} WHERE module_name='subscribtion' LIMIT 1")
		   && $this->diafan->configmodules('subscribe_in_registration', 'subscribtion'))
		{
			DB::query("UPDATE {subscribtion_emails} SET act='%d' WHERE mail='%s'", (empty($_POST['subscribe']) ? 0 : 1), $this->diafan->_user->mail);
		}
		// при смене e-mail, меняем его в списке рассылки
		if(DB::query_result("SELECT id FROM {modules} WHERE module_name='subscribtion' LIMIT 1"))
		{
			if($this->diafan->_user->mail != $_POST["mail"])
			{
				DB::query("UPDATE {subscribtion_emails} SET mail='%s' WHERE mail='%s'", $_POST['mail'], $this->diafan->_user->mail);
			}
		}

		if ($_POST["password"])
		{
			DB::query("UPDATE {users} SET password='%h' WHERE id=%d", encrypt($_POST["password"]), $this->diafan->_user->id);
		}

		$this->upload_avatar();

		$this->result["errors"][0] = $this->diafan->_('Изменения сохранены!', false);

		return $this->send_errors();
	}

	/*
	 * Удаляет аватар пользователя
	 * 
	 * @return boolean
	 */
	private function delete_avatar()
	{
		if ($this->diafan->configmodules("avatar", "users"))
		{
			unlink(ABSOLUTE_PATH . USERFILES.'/avatar/' . $this->diafan->_user->name . '.png');
			return true;
		}
		return false;
	}

	/**
	 * Проверяет валидность введенных данных
	 * 
	 * @return boolean
	 */
	private function validate()
	{
		Customization::inc('includes/validate.php');
		if (! $this->diafan->configmodules("mail_as_login", "users") &&  $_POST["name"] != $this->diafan->_user->name)
		{
			$mes = Validate::login($_POST["name"]);
			if ($mes)
			{
				$this->result["errors"]["name"] = $this->diafan->_($mes);
			}
		}
		$mes = Validate::mail($_POST["mail"]);
		if ($mes)
		{
			$this->result["errors"]["mail"] = $this->diafan->_($mes);
		}
		if ($_POST["mail"] != $this->diafan->_user->mail)
		{
			$mes = Validate::mail_user($_POST["mail"]);
			if ($mes)
			{
				$this->result["errors"]["mail"] = $this->diafan->_($mes);
			}
		}
		if ($_POST["password"])
		{
			$mes = Validate::password($_POST["password"]);
			if ($mes)
			{
				$this->result["errors"]["password"] = $this->diafan->_($mes);
			}
			elseif ($_POST["password"] != $_POST["password2"])
			{
				$this->result["errors"]["password"] = $this->diafan->_('Пароли не совпадают', false);
			}
		}

		if (empty($_POST["fio"]))
		{
			$this->result["errors"]["fio"] = $this->diafan->_('Заполните поле ФИО или название компании', false);
		}

		return $this->send_errors();
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
			imagePNG($dst_img, ABSOLUTE_PATH . USERFILES . '/avatar/'.$_POST["name"].'.png');
			$result["name"]          = $this->diafan->_user->name;
			$result["fio"]           = $this->diafan->_user->fio;
			$result["avatar_width"]  = $this->diafan->configmodules("avatar_width", "users");
			$result["avatar_height"] = $this->diafan->configmodules("avatar_height", "users");

			$this->result["data"] = $this->diafan->_tpl->get('avatar', 'usersettings', $result);
			$this->result["target"] = '.usersettings_avatar';
		}
		return true;
	}
}