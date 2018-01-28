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
	include(dirname(dirname(dirname(__FILE__))) . '/includes/404.php');
}

/**
 * Userpage_model
 *
 * Модель модуля "Страница пользователя"
 */
class Userpage_model extends Model
{
	/**
	 * Генерирует данные для страницы пользователя
	 * 
	 * @return array
	 */
	public function show()
	{
		$name = array_keys($_GET, null);
		if(empty($name) && ! $this->diafan->_user->id)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		if(empty($name))
		{
			$name = $this->diafan->_user->name;
		}
		else
		{
			$name = $name[0];
		}

		$this->result = DB::fetch_array(DB::query("SELECT id, fio, name, created FROM {users} WHERE name='%s' AND act='1' AND trash='0' LIMIT 1", $name));
		if(! $this->result)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		$this->result['created'] = $this->format_date($this->result['created']);

		if ($this->diafan->configmodules("avatar", "users"))
		{
			$this->result["avatar"] = file_exists(ABSOLUTE_PATH . USERFILES.'/avatar/' . $this->result['name'] . '.png');
			$this->result["avatar_width"] = $this->diafan->configmodules("avatar_width", "users");
			$this->result["avatar_height"] = $this->diafan->configmodules("avatar_height", "users");
		}

		$this->result['param'] = $this->get_params(array("module" => "users", "where" => "show_in_page='1'"));
		$param_types_array = array();
		foreach ($this->result["param"] as $i => $row)
		{
			if($row["type"] == "attachments")
			{
				$config = unserialize($row["config"]);
				if($config["attachments_access_admin"])
				{
					unset($this->result["param"][$i]);
					continue;
				}
				$this->result["param"][$i]["use_animation"] = ! empty($config["use_animation"]) ? true : false;
			}
			$param_types_array[$row["id"]] = $row;
		}

		$result = DB::query("SELECT value, param_id FROM {users_param_element} WHERE trash='0' AND element_id=%d", $this->result["id"]);
		while ($row = DB::fetch_array($result))
		{
			if(empty($param_types_array[$row["param_id"]]))
				continue;

			switch ($param_types_array[$row["param_id"]]["type"])
			{
				case 'multiple':
				case 'select':
					$user_param[$row["param_id"]][] = $param_types_array[$row["param_id"]]["select_values"][$row["value"]];
					break;
				case 'checkbox':
					$user_param[$row["param_id"]] = @$param_types_array[$row["param_id"]]["select_values"][$row["value"]];
					break;
				case 'date':
					$user_param[$row["param_id"]] = $this->diafan->formate_from_date($row["value"]);
					break;
				case 'datetime':
					$user_param[$row["param_id"]] = $this->diafan->formate_from_datetime($row["value"]);
					break;
				default:
					$user_param[$row["param_id"]] = $row["value"];
			}
		}
		foreach($this->result['param'] as $i => $row)
		{
			if($row["type"] == "attachments")
			{
				$row["value"] = $this->diafan->_attachments->get($this->result["id"], "users", 0, $row["id"]);
			}
			elseif($row["type"] == "images")
			{
				$row["value"] = $this->diafan->_images->get('large', $this->result["id"], "users", 0, '', $row["id"]);
			}
			else
			{
				$row["value"] = ! empty($user_param[$row["id"]]) ? $user_param[$row["id"]] : '';
			}
			if(! $row["value"] && $row["type"] == 'checkbox')
			{
				$row["value"] = @$row["select_values"][0];
			}
			$this->result['param'][$i] = $row;
		}

		$this->result['form_messages'] = $this->diafan->_user->id && $this->result["id"] != $this->diafan->_user->id && $this->diafan->_route->id_module("messages");

		return $this->result;
	}
}
