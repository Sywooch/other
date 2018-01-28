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
 * Menu_admin_ajax
 * 
 * Обработка Ajax-запросов при работе с меню в административной части
 */
class Menu_admin_ajax extends Frame_admin
{
	/**
	 * @var array результаты, передаваемы Ajaxом
	 */
	private $result;

	/**
	 * Вызывает обработку Ajax-запросов
	 * 
	 * @return void
	 */
	public function ajax()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->result["error"] = 'ERROR';
			$this->send_json();
		}

		$this->result["hash"] = $this->diafan->_user->get_hash();

		if (! empty($_POST["action"]))
		{
			switch($_POST["action"])
			{
				case 'group_menu':
					$this->group_menu();
					break;
			}
		}
	}

	/**
	 * Сохраняет ссылки на элементы в меню при групповом выделение в списке
	 * 
	 * @return void
	 */
	private function group_menu()
	{
		Customization::inc('modules/menu/admin/menu.admin.inc.php');

		$prows = array();
		$rows = array();
		print_r($_POST)
		$_POST['ids'] = array_reverse($_POST['ids']);
		foreach($_POST['ids'] as $id)
		{
			$row = DB::fetch_array(DB::query("SELECT * FROM {%h} WHERE id=%d LIMIT 1", $this->diafan->table, $id));
			if(! $row)
				continue;
			$module = str_replace('_category', '', $this->diafan->table);
			$save = array(
				"id" => $row["id"],
				"module" => $module, 
				"is_category" => strpos($this->diafan->table, '_category') !== false,
				"site_id" => ! empty($row["site_id"]) ? $row["site_id"] : 0,
				"is_new" => false,
				"parent_id" => ! empty($row["parent_id"]) ? $row["parent_id"] : '',
				"name" => $row["name"._LANG],
				"old_name" => $row["name"._LANG],
				"access" => $row["access"],
				"old_access" => $row["access"],
				"sort" => ! empty($row["sort"]) ? $row["sort"] : 0,
				"act" => $row["act"._LANG],
				"cat_id" => ! empty($row["cat_id"]) ? $row["cat_id"] : 0,
				"date_start" => ! empty($row["date_start"]) ? $row["date_start"] : 0,
				"old_date_start" => ! empty($row["date_start"]) ? $row["date_start"] : 0,
				"date_finish" => ! empty($row["date_finish"]) ? $row["date_finish"] : 0,
				"old_date_finish" => ! empty($row["date_finish"]) ? $row["date_finish"] : 0
			);
			$menu_cat_ids = ! empty($_POST["menu_cat_ids"]) ? $_POST["menu_cat_ids"] : array();
			$menu_inc = new Menu_admin_inc($this->diafan);
			$menu_inc->save_menu($save, $menu_cat_ids);
		}

		$this->result["redirect"] = URL;
		$this->send_json();
	}
	

	/**
	 * Отправляет результат
	 *
	 * @return boolean
	 */
	private function send_json()
	{
		if (! empty($this->result["errors"]) || ! empty($this->result["data"]) || ! empty($this->result["redirect"]))
		{
			include_once ABSOLUTE_PATH.'plugins/json.php';
			echo to_json($this->result);
			return true;
		}
		return false;
	}
}