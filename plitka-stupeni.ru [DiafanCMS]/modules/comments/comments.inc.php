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
 * Сomments_inc
 *
 * Подключение модуля "Комментарии"
 */
class Comments_inc extends Model
{
	/**
	 * Показывает комментарии, прикрепленные к элементу, и форму добавления комментария
	 *
	 * @param integer $element_id номер элемента
	 * @param string $module_name модуль
	 * @param integer $site_id страница сайта, к которой прикреплен элемент
	 * @param boolean $is_category это категория
	 * @return string
	 */
	public function get($element_id = 0, $module_name = '', $site_id = 0, $is_category = false)
	{
		$module_name = ! $module_name ? $this->diafan->module : $module_name;
		$site_id = ! $site_id ? $this->diafan->cid : $site_id;
		$element_id = ! $element_id ? ($is_category ? $this->diafan->cat : $this->diafan->show) : $element_id;

		if(! $this->diafan->configmodules("comments".($is_category ? "_cat" : ""), $module_name, $site_id))
		{
			return false;
		}

		$module_name = $module_name.($is_category ? "_category" : "");

		$where_form = "(module_name='".$module_name."' OR module_name='') AND show_in_"
					  .($this->diafan->_user->id ? "form_auth" : "form_no_auth")."='1'";
		$where_list = "(module_name='".$module_name."' OR module_name='') AND show_in_list='1'";

		$params_form = $this->get_params(array("module" => "comments", "where" => $where_form));
		$params_list = $this->get_params(array("module" => "comments", "where" => $where_list));

		$result_sql = DB::query(
				"SELECT created, user_id, text, id, parent_id FROM {comments}"
				." WHERE module_name='%h' AND element_id='%d'"
				." AND act='1' AND trash='0' ORDER BY created ASC",
				$module_name, $element_id
			);
		$rows = array();
		$count = DB::num_rows($result_sql);
		while ($row = DB::fetch_array($result_sql))
		{
			if($this->diafan->timeedit < $row['created'])
			{
				$this->diafan->timeedit = $row['created'];
			}
			$row['date'] = $this->diafan->_useradmin->get($this->format_date($row['created'], "comments"), 'created', $row["id"], 'comments');

			if ($this->diafan->configmodules('user_name', 'comments') && $row["user_id"])
			{
				$row["name"] = $this->get_author($row["user_id"]);
			}

			$row["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $row["id"], 'comments');

			$row["params"] = $this->get_param_values($row["id"], $params_list);
			$row["form"] = $this->get_form($params_form, $count, $row["id"]);

			$rows[$row["parent_id"]][] = $row;
		}
		$result["rows"] = $this->build_tree($rows);
		$result["form"] = $this->get_form($params_form, $count);
		$result["register_to_comment"] = $this->diafan->configmodules('only_user', 'comments') && ! $this->diafan->_user->id && ($count < $this->diafan->configmodules("max_count", "comments") || ! $this->diafan->configmodules("max_count", "comments"));

		$text = $this->diafan->_tpl->get('get', 'comments', $result);
		return $text;
	}

	/**
	 * Формирует дерево сообщений из полученного массива
	 *
	 * @param array $rows все сообщения
	 * @param integer $parent_id номер текущего сообщения-родителя
	 * @param integer $level уровень
	 * @return string
	 */
	private function build_tree($rows, $parent_id = 0, $level = 0)
	{
		$result = array();
		$count_level = $this->diafan->configmodules("count_level", "comments");

		if($count_level && $level >= $count_level)
			return $result;

		if (! empty($rows[$parent_id]))
		{
			foreach ($rows[$parent_id] as $row)
			{
				$row["children"] = $this->build_tree($rows, $row["id"], $level+1);
				$row["level"] = $level;
				if($level+2 == $count_level)
				{
					$row["form"] = false;
				}
				$result[] = $row;
			}
		}
		return $result;
	}

	/**
	 * Получает дополнительные поля комментариев
	 * 
	 * @param integer $id номер комментария
	 * @param array $params поля комментариев
	 * @return array
	 */
	public function get_param_values($id, $params)
	{
		if(! $params)
		{
			return array();
		}
		$values    = array();
		$result_el = DB::query("SELECT id, value, param_id FROM {comments_param_element} WHERE element_id=%d", $id);
		while ($row_el = DB::fetch_array($result_el))
		{
			$values[$row_el["param_id"]][]  = $row_el;
		}
		$param = array();
		foreach($params as $row)
		{
			switch ($row["type"])
			{
				case "text":
				case "editor":
					if (! empty($values[$row["id"]][0]["value"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["value"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "textarea":
					if (! empty($values[$row["id"]][0]["value"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["value"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "date":
					if (! empty($values[$row["id"]][0]["value"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $this->diafan->formate_from_date($values[$row["id"]][0]["value"]),
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "datetime":
					if (! empty($values[$row["id"]][0]["value"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $this->diafan->formate_from_datetime($values[$row["id"]][0]["value"]),
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "select":
					$value = ! empty($values[$row["id"]][0]["value"]) ? $values[$row["id"]][0]["value"] : '';
					if ($value)
					{	
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $row["select_values"][$value]);
						
					}
					break;
				case "multiple":
					if (! empty($values[$row["id"]]))
					{
						$value = array();
						foreach ($values[$row["id"]] as $val)
						{
							$value[] = $row["select_values"][$val["value"]];
							
						}
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $value);
					}
					break;
				case "checkbox":
					$value = ! empty($values[$row["id"]][0]["value"]) ? 1 : 0;
					if (! empty($row["select_values"][$value]))
					{
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $row["select_values"][$value]);
					}
					elseif($value == 1)
					{
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => '');
					}
					break;
				case "title":
					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => ''
					);
					break;
				case "images":
					$value = $this->diafan->_images->get('large', $id, "comments", 0, '', $row["id"]);
					if(! $value)
						continue 2;

					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => $value
					);
					break;
				case "attachments":
					$config = unserialize($row["config"]);
					if(! $config["attachments_access_admin"])
					{
						$attachments = $this->diafan->_attachments->get($id, "comments", 0, $row["id"]);
						if(! $attachments)
							break;
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"type" => $row["type"],
							"value" => $attachments,
							"use_animation" => ! empty($config["use_animation"]) ? true : false,
						);
					}
					break;
				default:
					if (! empty($values[$row["id"]][0]["value"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["value"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
			}
		}
		return $param;
	}
	
	/*
	 * Формирует данные для формы
	 * 
	 * @param integer $parent_id номер комментария-родителя
	 * @param integer $count количество комментариев на старнице
	 * @return array
	 */
	public function get_form($params, $count, $parent_id = 0)
	{
		if($this->diafan->configmodules("max_count", "comments") && $this->diafan->configmodules("max_count", "comments") <= $count)
		{
			return false;
		}
		// форма комментариев
		if (! $this->diafan->configmodules('only_user', 'comments') || $this->diafan->_user->id)
		{
			$form["parent_id"] = $parent_id;
			$form["captcha"] = '';
			if ($this->diafan->configmodules('captcha', 'comments'))
			{
				$form["captcha"] = $this->diafan->_captcha->get("comments".$parent_id, $this->get_error("comments".$parent_id, "captcha"));
			}
			$form['params'] = array();
			if($params)
			{
				foreach ($params as $row)
				{
					$form['error_p'.$row["id"]] = $this->get_error("comments".$parent_id, 'p'.$row["id"]);
					$form['params'][] = $row;
				}
			}
			$form["error"] = $this->get_error("comments".$parent_id);
			$form["bbcode"] = $this->diafan->configmodules('use_bbcode', 'comments');
		}
		else
		{
			$form = false;
		}
		return $form;
	}
}
