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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Registration_model
 *
 * Модель модуля "Регистрация"
 */
class Registration_model extends Model
{
	/**
	 * Генерирует данные для формы регистрации
	 * 
	 * @return array
	 */
	public function form()
	{
		$this->result["captcha"] = '';
		if ($this->diafan->configmodules('captcha', "users"))
		{
			$this->result["captcha"] = $this->diafan->_captcha->get("registration", $this->get_error("registration", "captcha"));
		}
		$this->result["action"] = BASE_PATH_HREF.$this->diafan->_route->current_link();
		$this->result["error"] = $this->get_error("registration");
		$this->result["error_name"] = $this->get_error("registration", 'name');
		$this->result["error_fio"] = $this->get_error("registration", 'fio');
		$this->result["error_password"] = $this->get_error("registration", 'password');
		$this->result["error_password2"] = $this->get_error("registration", 'password2');
		$this->result["error_mail"] = $this->get_error("registration", 'mail');
		$this->result["user_id"] = $this->diafan->_user->id;
		$this->result["url"] = '';
		$this->result["use_name"] = ! $this->diafan->configmodules("mail_as_login", "users");
		$this->result["use_avatar"] = $this->diafan->configmodules("avatar", "users");
		if ($this->result["use_avatar"])
		{
			$this->result["avatar_width"] = $this->diafan->configmodules("avatar_width", "users");
			$this->result["avatar_height"] = $this->diafan->configmodules("avatar_height", "users");
			$this->result["error_avatar"] = $this->get_error("registration", 'avatar');
		}

		if (! $this->diafan->configmodules("act", "users"))
		{
			$this->result["url"] = $this->result["action"].'?action=success';
		}
		$where_param_role_rel = $this->get_where_param_role_rel();
		$where = "show_in_".($this->diafan->_user->id ? "form_auth" : "form_no_auth")."='1'".$where_param_role_rel;
		$this->result["rows_param"] = $this->get_params(array("module" => "users", "where" => $where));

		$param_types_array = array();
		foreach ($this->result["rows_param"] as $row)
		{
			$this->result['error_p'.$row["id"]] = $this->get_error("registration", 'p'.$row["id"]);
			$param_types_array[$row["id"]] = $row["type"];
		}

		$this->result['use_subscribtion'] =
			DB::query_result("SELECT id FROM {modules} WHERE module_name='subscribtion' LIMIT 1")
			&& $this->diafan->configmodules('subscribe_in_registration', 'subscribtion');

		return $this->result;
	}

	/**
	 * Получает условие для SQL-запроса: выбор полей с учетом роли пользователя
	 *
	 * @param integer $role_id номер роли пользователя
	 * @return string
	 */
	private function get_where_param_role_rel()
	{
		$param_ids = array();
		$param_role_rels = array();
		$result_roles = array();
		$result = DB::query("SELECT role_id, element_id FROM {users_param_role_rel} WHERE trash='0' AND role_id>0");
		while ($row = DB::fetch_array($result))
		{
			$param_role_rels[$row["element_id"]][] = $row["role_id"];
		}
		$roles = array();
		$result = DB::query("SELECT id, [name] FROM {users_role} WHERE registration='1' AND trash='0' ORDER BY id ASC");
		while ($row = DB::fetch_array($result))
		{
			$result_roles[] = $row;
			$roles[] = $row["id"];
		}
		if(count($result_roles) > 1)
		{
			$this->result["roles"] = $result_roles;
			$this->result["param_role_rels"] = $param_role_rels;
		}
		foreach($param_role_rels as $param_id => $rel_roles)
		{
			$in = false;
			foreach($roles as $role_id)
			{
				if(in_array($role_id, $rel_roles))
				{
					$in = true;
				}
			}
			if(! $in)
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
	 * Активация аккаунта
	 * 
	 * @return array
	 */
	public function act()
	{
		if(empty($_GET["code"]) || empty($_GET["user_id"]) || $this->diafan->configmodules("act", "users") != 1)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$actlink = DB::fetch_array(DB::query("SELECT user_id, created FROM {users_actlink} WHERE link='%h' AND user_id=%d LIMIT 1", $_GET["code"], $_GET["user_id"]));
		$user = DB::fetch_array(DB::query("SELECT id, act FROM {users} WHERE id=%d LIMIT 1", $_GET["user_id"]));
		if (empty($user["id"]) || ! $user["act"] && ! $actlink)
		{
			$this->result["text"] = $this->diafan->_('Извините, вы не можете воспользоваться этой ссылкой.', false);
		}
		else
		{
			if (! $user["act"] && $actlink["created"] < time())
			{
			$this->result["text"] = $this->diafan->_('Извините, время действия ссылки закончилось.', false);
			}
			else
			{
			DB::query("UPDATE {users} SET act='1' WHERE id=%d", $actlink["user_id"]);
			DB::query("DELETE FROM {users_actlink} WHERE link='%h' AND user_id='%d'", $_GET["code"], $actlink["user_id"]);
			$this->result["show_login"] = array('user'   => 0, 'error'  => '', 'action' => BASE_PATH_HREF, 'hide'   => true);
			$this->result["text"] = $this->diafan->_('Регистрация успешно активирована! Вы можете зайти в личный кабинет используя логин и пароль.', false);
			}
		}
		return $this->result;
	}

	/**
	 * Страница успешной регистрации
	 * 
	 * @return array
	 */
	public function success()
	{
		$this->result["text"] = $this->diafan->configmodules('mes', "users");
		return $this->result;
	}

	/**
	 * Генерирует данные для формы авторизации
	 * 
	 * @return array|boolean false
	 */
	public function show_login()
	{
		$result["user"] = $this->diafan->_user->id;
		if (!$result["user"])
		{
			$result["registration"] = $this->diafan->_route->module("registration", true);
			if($result["registration"] !== false)
			{
				$result["registration"] = BASE_PATH_HREF.$result["registration"];
			}
			switch ($this->diafan->_user->errauth)
			{
				case 'wrong_login_or_pass':
					$result["error"] = $this->diafan->_('Неверный логин или пароль.', false);
					break;

				case 'blocked_30_min':
					$result["error"] = $this->diafan->_('Вы превысили количество попыток, поэтому будете заблокированы на 30 минут', false);
					break;

				case 'blocked':
					$result["error"] = $this->diafan->_('Логин не активирован или заблокирован.', false);
					break;

				default:
					$result["error"] = '';
			}
			$result["reminding"] = $this->diafan->_route->module("reminding",true);
			if($result["reminding"] !== false)
			{
				$result["reminding"] = BASE_PATH_HREF.$result["reminding"];
			}
			$result["action"]    = $this->diafan->module == "registration" ? BASE_PATH_HREF : '';
			$result["use_loginza"] = $this->diafan->configmodules("loginza", "users");
		}
		else
		{

			$result["fio"] = $this->diafan->_user->fio;
			$result["usersettings"] = $this->diafan->_route->module("usersettings", true);
			if($result["usersettings"] !== false)
			{
				$result["usersettings"] = BASE_PATH_HREF.$result["usersettings"];
			}

			$result["userpage"] = $this->diafan->_route->module("userpage", true);
			if (!empty($result["userpage"]))
			{
				$result["userpage"] = BASE_PATH_HREF.$result["userpage"].'?'.$this->diafan->_user->name;
			}

			if ($message_site_id = $this->diafan->_route->id_module("messages", 0, false))
			{
				$result['messages']   = BASE_PATH.$this->diafan->_route->link($message_site_id);
				$result['messages_unread'] = DB::query_result("SELECT id FROM {messages} WHERE to_user=%d AND readed='0' LIMIT 1", $this->diafan->_user->id);
				$result['messages_name']   = DB::title("site", $message_site_id, "[name]");
			}
			if ($this->diafan->configmodules("avatar", "users"))
			{
				$result["avatar"]        = file_exists(ABSOLUTE_PATH.USERFILES.'/avatar/'.$this->diafan->_user->name.'.png');
				$result["avatar_width"]  = $this->diafan->configmodules("avatar_width", "users");
				$result["avatar_height"] = $this->diafan->configmodules("avatar_height", "users");
				$result["name"]          = $this->diafan->_user->name;
			}
		}
		return $result;
	}
}