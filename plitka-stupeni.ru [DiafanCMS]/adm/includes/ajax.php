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
 * Ajax_admin
 *
 * Обработка Ajax-запросов
 */
class Ajax_admin extends Theme_admin
{
	/**
	 * @var array результаты, передаваемы Ajaxом
	 */
	private $result;

	/**
	 * Подключает Ajax-обработку модуля
	 *
	 * @return void
	 */
	public function ajax()
	{
		if ($this->diafan->include_class)
		{
			$init = new $this->diafan->include_class( $this->diafan );
			$init->ajax();
		}
	}

	/**
	 * Обработчик функции быстрого сохранения полей
	 *
	 * @return void
	 */
	public function fast_save()
	{
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();

		$this->result["res"] = false;
		if(in_array($_POST['name'], array_keys($this->diafan->fast_edit_rows)))
		{
			$func = 'fast_save_' . preg_replace('/[^a-z_]+/', '', $_POST['name']);
			$this->result["res"] = call_user_func_array (array(&$this->diafan, $func), array());
			if ($this->result["res"] === 'fail_function')
			{
				$this->result["res"] = (bool)DB::query('UPDATE {' . $this->diafan->table . '} SET %h="' . ( (bool)$_POST['type'] ? '%h' : '%d' ) . '" WHERE id=%d LIMIT 1', $_POST['name'], $_POST['value'], $_POST['id']);
			}
		}
		$this->send_json();
	}

	/**
	 * Изменяет тему оформления
	 *
	 * @return void
	 */
	public function change_theme()
	{
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();


		$_POST['theme'] = preg_replace('/\W/', '', $_POST['theme']);
		if(file_exists(ABSOLUTE_PATH . 'adm/img/themes/'.$_POST['theme'].'.jpg'))
		{
			$img = $_POST['theme'].'.jpg';
			DB::query("UPDATE {users} SET background='%h' WHERE id=%d", $img, $this->diafan->_user->id);
 
			$this->result["background"] = BASE_PATH.'adm/img/themes/'.$img;
		}

		$this->send_json();
	}

	/**
	 * Изменяет количество элементов на странице
	 *
	 * @return void
	 */
	public function change_nastr()
	{
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();

		$nastr = $this->diafan->get_param($_POST, 'nastr', 0, 2);
		if($this->diafan->_user->admin_nastr != $nastr)
		{
			DB::query("UPDATE {users} SET admin_nastr=%d WHERE id=%d", $nastr, $this->diafan->_user->id);
		}
		$this->result["redirect"] = $this->diafan->get_admin_url('page');

		$this->send_json();
	}

	/**
	 * Подгружает список для сортировки элементов
	 *
	 * @return void
	 */
	public function sort()
	{
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();


		if(!empty($this->diafan->text_for_base_link["variable"]))
		{
			$list_name = $this->diafan->text_for_base_link["variable"];
		}
		else
		{
			$list_name = 'name';
		}
		$list_name = ($this->diafan->variable_multilang($list_name) ? $list_name._LANG : $list_name);

		$lang_act = ($this->diafan->variable_multilang("act") ? _LANG : '');

		$text = '<select name="sort">';

		$parent_id = $this->diafan->get_param($_POST, "parent_id", 0, 2);
		$cat_id = $this->diafan->get_param($_POST, "cat_id", 0, 2);
		$site_id = $this->diafan->get_param($_POST, "site_id", 0, 2);
		$sort = $this->diafan->get_param($_POST, "sort", 0, 2);

		//список элементов, которые при сортировке стоят перед редактируемым элементом
		$text .= $this->diafan->select_option("sort", $this->diafan->table, "id", $list_name, '',
		( isset( $_POST["parent_id"] ) ? "parent_id=".$parent_id." AND " : '' )
		. (isset( $_POST["cat_id"] ) ? "cat_id=".$cat_id." AND " : '' )
		. (isset( $_POST["site_id"] ) ? "site_id=".$site_id." AND " : '' )
		. "sort<=".$sort
		. ( $this->diafan->is_variable("act") ? " AND act".$lang_act."='1'" : '' )
		. " AND id<>'" . $this->diafan->edit . "'"
		. $this->diafan->where
		. ( $this->diafan->config("trash") ? " AND trash='0'" : '' ),
		'', '', '',
		( $this->diafan->is_variable("act") ? "act".$lang_act." DESC," : '' ). 'sort ASC, id ASC')

		. '<option value="' . $this->diafan->edit . '" selected>----' . ( $_POST["name"] ? $_POST["name"] : $this->diafan->edit ) . '---</option>'

		//список элементов, которые при сортировке стоят после редактируемого элемента
		. $this->diafan->select_option("sort", $this->diafan->table, "id", $list_name, '',
		( isset( $_POST["parent_id"] ) ? "parent_id=".$parent_id." AND " : '' )
		. (isset( $_POST["cat_id"] ) ? "cat_id=".$cat_id." AND " : '' )
		. (isset( $_POST["site_id"] ) ? "site_id=".$site_id." AND " : '' )
		. "sort>".$sort
		. ( $this->diafan->is_variable("act") ? " AND act".$lang_act."='1'" : '' )
		. " AND id<>'" . $this->diafan->edit . "'"
		. $this->diafan->where
		. ( $this->diafan->config("trash") ? " AND trash='0'" : '' ),
		'', '', '',
		( $this->diafan->is_variable("act") ? "act".$lang_act." DESC," : '' ). 'sort ASC, id ASC')
		. '<option value="down">----' . $this->diafan->_('Вниз') . '---</option></select>';

		$this->result["data"] = $text;
		$this->send_json();
	}

	/**
	 * Подгружает список родителей
	 *
	 * @return void
	 */
	public function parent_id()
	{
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();


		$_POST['parent_id'] = $this->diafan->get_param($_POST, 'parent_id', 0, 2);

		if(!empty($this->diafan->text_for_base_link["variable"]))
		{
			$list_name = $this->diafan->text_for_base_link["variable"];
		}
		else
		{
			$list_name = 'name';
		}

		$result = DB::query("SELECT id, ".($this->diafan->variable_multilang($list_name) ? '['.$list_name.']' : $list_name).", parent_id FROM {" . $this->diafan->table . "} WHERE id<>'%d'"
		.( $this->diafan->module == 'site' ? " AND id<>1" : '' )
		.($this->diafan->config('trash') ? " AND trash='0'" : '')
		." ORDER BY id ASC", $this->diafan->edit);

		while ($row = DB::fetch_array($result))
		{
			$row["name"] = $row[$list_name];
			$cats[$row["parent_id"]][] = $row;
		}
		$this->result["data"] = '<select name="parent_id" upload="1">
			<option value="">' . ( $this->diafan->module == 'site' ? $this->diafan->_('Главная') : '' ) . '</option>'
			.$this->diafan->get_options($cats, $cats[0], array ( $_POST["parent_id"] )) . '</select>';
		$this->send_json();
	}

	/**
	 * Перемещает элементы в категорию
	 *
	 * @return void
	 */
	public function group_cat_id()
	{
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();


		//проверка прав
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			$this->result["error"] = 'ROLES';
			$this->send_json();
			return false;
		}

		if (empty( $_POST['ids'] ) || (empty($_POST['cat_id']) && empty($_POST["site_id"])))
		{
			$this->result["error"] = $this->diafan->_('Выберите раздел или категорию для перемещения.');
			$this->send_json();
			return false;
		}

		$cat_id = $this->diafan->get_param($_POST, 'cat_id', 0, 2);
		$site_id = $this->diafan->get_param($_POST, 'site_id', 0, 2);
		foreach($_POST['ids'] as $id)
		{
			$id = intval($id);
			if ($this->diafan->config("element_multiple"))
			{
				DB::query("DELETE FROM {%s_category_rel} WHERE element_id=%d", $this->diafan->module, $id);
				DB::query("INSERT INTO {%s_category_rel} (element_id, cat_id) VALUES('%d', '%d')", $this->diafan->module, $id, $cat_id);

				if($this->diafan->config("element_site"))
				{
					$site_id = DB::query_result("SELECT site_id FROM {%s_category} WHERE id=%d LIMIT 1", $this->diafan->table, $cat_id);
				}
				else
				{
					$site_id = 0;
				}
				DB::query("UPDATE {%h} SET cat_id=%d".($site_id ? ", site_id=".$site_id : "")." WHERE id IN (%h)", $this->diafan->table, $cat_id, $id);
				if($site_id)
				{
					DB::query("UPDATE {rewrite} SET site_id=%d WHERE module_name='%s' AND element_id IN (%h)", $site_id, $this->diafan->module, $id);
				}

			}
			elseif ($site_id && $this->diafan->config("element_site") && DB::query_result("SELECT site_id FROM {%h} WHERE id=%d LIMIT 1", $this->diafan->table, $id) != $site_id)
			{
				$children = array($id);
				if($this->diafan->config("parent"))
				{
					$children = $this->diafan->get_children($id, $this->diafan->table);
					$children[] = $id;
				}
				DB::query("UPDATE {%h} SET site_id=%d WHERE id IN (%h)", $this->diafan->table, $site_id, implode(",", $children));
				DB::query("UPDATE {rewrite} SET site_id=%d WHERE module_name='%s' AND %s_id IN (%h)", $site_id, $this->diafan->module, $this->diafan->config('category') ? 'cat' : 'element', implode(",", $children));
				if($this->diafan->config('category'))
				{
					DB::query("UPDATE {%h} SET site_id=%d WHERE cat_id IN (%h)", str_replace('_category', '', $this->diafan->table), $site_id, implode(",", $children));
					DB::query("UPDATE {rewrite} SET site_id=%d WHERE module_name='%s' AND element_id IN (SELECT id FROM {%h} WHERE cat_id IN (%h))", $site_id, $this->diafan->module, str_replace('_category', '', $this->diafan->table), implode(",", $children));
				}
			}
			elseif ($cat_id && DB::query_result("SELECT cat_id FROM {%h} WHERE id=%d LIMIT 1", $this->diafan->table, $id) != $cat_id)
			{
				$children = array($id);
				if($this->diafan->config("parent"))
				{
					$children = $this->diafan->get_children($id, $this->diafan->table);
					$children[] = $id;
				}

				if($this->diafan->config("element_site"))
				{
					$site_id = DB::query_result("SELECT site_id FROM {%s_category} WHERE id=%d LIMIT 1", $this->diafan->table, $cat_id);
				}
				else
				{
					$site_id = 0;
				}
				DB::query("UPDATE {%h} SET cat_id=%d".($site_id ? ", site_id=".$site_id : "")." WHERE id IN (%h)", $this->diafan->table, $cat_id, implode(",", $children));
				if($site_id)
				{
					DB::query("UPDATE {rewrite} SET site_id=%d WHERE module_name='%s' AND %s_id IN (%h)", $site_id, $this->diafan->module, $this->diafan->config('category') ? 'cat' : 'element', implode(",", $children));
				}
			}
		}
		$this->result["status"] = true;
		//$this->result["redirect"] = "ssss";
		$this->result["redirect"] = URL;
		$this->send_json();
	}

	/**
	 * Отдает ответ Ajax
	 *
	 * @return void
	 */
	private function send_json()
	{
		if ($this->result)
		{
			include_once ABSOLUTE_PATH . 'plugins/json.php';
			echo to_json($this->result);
			exit;
		}
	}
}