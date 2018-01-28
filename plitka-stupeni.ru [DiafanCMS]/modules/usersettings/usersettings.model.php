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
 * Usersettings_model
 *
 * Модель модуля "Настройки аккаунта"
 */
class Usersettings_model extends Model
{
	/**
	 * Генерирует данные для формы регистрации
	 * 
	 * @return array
	 */
	public function form()
	{
		$this->result["captcha"] = '';
		if ($this->diafan->configmodules('captcha', "users") && !$this->diafan->_user->id)
		{
			$this->result["captcha"] = $this->diafan->_captcha->get("registration", $this->get_error("registration", "captcha"));
		}

		$this->result["fio"] = $this->diafan->_user->fio;
		$this->result["hash"] = $this->diafan->_user->get_hash();
		$this->result["mail"] = $this->diafan->_user->mail;
		$this->result["name"] = $this->diafan->_user->name;
		$this->result["use_name"] = ! $this->diafan->configmodules("mail_as_login", "users");

		if (count($this->diafan->languages) > 1)
		{
			foreach ($this->diafan->languages as $language)
			{
				$this->result["languages"][] = array(
					"value"    => $language["id"],
					"selected" => ($language["id"] == $this->diafan->_user->lang_id ? ' selected' : ''),
					"name"     => $language["name"]
				);
			}
		}

		$this->get_shop_order_param();

		$this->result["action"] = BASE_PATH_HREF.$this->diafan->_route->current_link();
		$this->result["error"] = $this->get_error("registration");
		$this->result["error_name"] = $this->get_error("registration", 'name');
		$this->result["error_fio"] = $this->get_error("registration", 'fio');
		$this->result["error_password"] = $this->get_error("registration", 'password');
		$this->result["error_password2"] = $this->get_error("registration", 'password2');
		$this->result["error_mail"] = $this->get_error("registration", 'mail');
		$this->result["user_id"] = $this->diafan->_user->id;
		$this->result["url"] = '';
		$this->result["use_avatar"] = $this->diafan->configmodules("avatar", "users");
		if ($this->result["use_avatar"])
		{
			$this->result["avatar"] = file_exists(ABSOLUTE_PATH.USERFILES.'/avatar/'.$this->diafan->_user->name.'.png');
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
			if($row["type"] == 'attachments' && ! $row["attachments_access_admin"])
			{
				$this->result['attachments'][$row["id"]] = $this->diafan->_attachments->get($this->diafan->_user->id, 'users', 0, $row["id"]);
			}
			if($row["type"] == 'images')
			{
				$this->result['images'][$row["id"]] = $this->diafan->_images->get('large', $this->diafan->_user->id, 'users', 0, '', $row["id"]);
			}
		}

		$result = DB::query("SELECT value, param_id FROM {users_param_element} WHERE trash='0' AND element_id=%d", $this->diafan->_user->id);
		while ($row = DB::fetch_array($result))
		{
			if(empty($param_types_array[$row["param_id"]]))
				continue;

			switch ($param_types_array[$row["param_id"]])
			{
				case 'multiple':
					$this->result["user"]['p'.$row["param_id"]][] = $row["value"];
					break;

				case 'date':
					$this->result["user"]['p'.$row["param_id"]] = $this->diafan->formate_from_date($row["value"]);
					break;

				case 'datetime':
					$this->result["user"]['p'.$row["param_id"]] = $this->diafan->formate_from_datetime($row["value"]);
					break;

				default:
					$this->result["user"]['p'.$row["param_id"]] = $row["value"];
			}
		}

		if($this->diafan->_route->id_module('subscribtion'))
		{
			$this->result['link_subscribtion'] = BASE_PATH_HREF.$this->diafan->_route->module("subscribtion", true).'?action=edit&mail='.$this->diafan->_user->mail;
			if($code = DB::query_result("SELECT code FROM {subscribtion_emails} WHERE mail='%s' AND trash='0'", $this->diafan->_user->mail))
			{
				$this->result['link_subscribtion'] .= '&code='.$code;
			}
		}
		else
		{
			if(DB::query_result("SELECT id FROM {modules} WHERE module_name='subscribtion' LIMIT 1"))
			{
				$this->result['use_subscribtion'] = $this->diafan->configmodules('subscribe_in_registration', 'subscribtion');
				$this->result["is_subscribe"] = DB::query_result("SELECT id FROM {subscribtion_emails} WHERE mail='%s' AND trash='0' AND act='1' LIMIT 1", $this->diafan->_user->mail);
			}
		}

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
		$roles = array($this->diafan->_user->role_id);
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
	 * Формирует поля формы "Оформление заказа", доступные для внешнего редактирования
	 * @return boolean
	 */
	private function get_shop_order_param()
	{
		if(! $this->diafan->_route->id_module('cart'))
			return false;

		if (empty($this->diafan->_user->id))
			return false;

		$result = DB::query("SELECT value, param_id FROM {shop_order_param_user} WHERE trash='0' AND user_id=%d", $this->diafan->_user->id);
		while ($row = DB::fetch_array($result))
		{
			$values[$row["param_id"]] = $row["value"];
		}

		$this->result["dop_rows_param"] = $this->get_params(array("module" => "shop", "table" => "shop_order", "where" => "show_in_form_register='1'"));
		foreach($this->result["dop_rows_param"] as $i => $row)
		{
			if($row["type"] == "attachments" || $row["type"] == "images")
			{
				unset($this->result["dop_rows_param"][$i]);
				continue;
			}
			if(! empty($values[$row["id"]]))
			{
				$row["value"] = $values[$row["id"]];
			}
			$row["required"] = false;
			$this->result["dop_rows_param"][$i] = $row;
			$this->result['error_dop_p'.$row["id"]] = $this->get_error("registartion", 'dop_p'.$row["id"]);
		}
		return true;
	}

	/**
	 * Формирует список заказов пользователя
	 * @return array
	 */
	public function order()
	{
		if(! $this->diafan->_route->id_module('cart'))
			return $this->result;

		$result = DB::query("SELECT id, [name] FROM {shop_order_status} ORDER BY sort ASC");
		while($row = DB::fetch_array($result))
		{
			$status[$row["id"]] = $row["name"];
		}

		$result = DB::query("SELECT id, status, status_id, summ, created FROM {shop_order} WHERE trash='0' AND user_id='%d' ORDER by created DESC", $this->diafan->_user->id);

		$itogo = 0;
		while ($row = DB::fetch_array($result))
		{
			$order = array(
				'status'  => $row['status'],
				'status_name'  => $status[$row['status_id']],
				'summ'    => $this->diafan->_shop->price_format($row["summ"]).' '.$this->diafan->configmodules("currency", "shop"),
				'created' => $this->format_date($row['created'], $this->diafan->module),
				'id'      => $row['id']);

			if ($row["status"] == '3')
			{
				$itogo = $itogo + $row["summ"];
			}

			$good_ids = array();
			$r  = DB::query("SELECT good_id FROM {shop_order_goods} WHERE trash='0' AND order_id='%d'", $row['id']);
			while ($r2 = DB::fetch_array($r))
			{
				$good_ids[] = $r2['good_id'];
			}

			if (!empty($good_ids))
			{
				$r  = DB::query("SELECT id, site_id, cat_id, [name] FROM {shop} WHERE trash='0' AND id IN (%h)", implode(",", $good_ids));
				while ($r2 = DB::fetch_array($r))
				{
					$order['goods'][] = '<a href="'.BASE_PATH_HREF.$this->diafan->_route->link($r2['site_id'], 'shop', $r2['cat_id'], $r2['id']).'">'.$r2['name'].'</a>';
				}
			}

			$this->result['order'][] = $order;
		}

		$this->result['itogo'] = $this->diafan->_shop->price_format($itogo).' '.$this->diafan->configmodules("currency", "shop");

		return $this->result;
	}
}