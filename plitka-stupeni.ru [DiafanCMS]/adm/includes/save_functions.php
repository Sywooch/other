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
 * Save_functions_admin
 *
 * Функции сохранения поля
 */
class Save_functions_admin extends Diafan
{
	/**
	 * Сохранение поля "Категория"
	 *
	 * @return void
	 */
	public function save_variable_cat_id()
	{
		$this->diafan->save_cat_id = $this->diafan->get_param($_POST, 'cat_id', 0, 2);

		$this->diafan->set_query("cat_id=%d");
		$this->diafan->set_value($this->diafan->save_cat_id);

		if ($this->diafan->config("element_multiple"))
		{
			DB::query("DELETE FROM {%s_category_rel} WHERE element_id=%d", $this->diafan->module, $this->diafan->save);
			DB::query("INSERT INTO {%s_category_rel} (element_id, cat_id) VALUES('%d', '%d')", $this->diafan->module, $this->diafan->save, $this->diafan->save_cat_id);

			if (!empty( $_POST["cat_ids"] ) && ! empty($_POST["user_additional_cat_id"]) && is_array($_POST["cat_ids"]))
			{
				foreach ($_POST["cat_ids"] as $cat_id)
				{
					if ($cat_id != $_POST["cat_id"])
					{
						DB::query("INSERT INTO {%s_category_rel} (element_id, cat_id) VALUES('%d', '%d')", $this->diafan->module, $this->diafan->save, $cat_id);
					}
				}
			}
		}
		elseif ($this->diafan->config("parent") && !$this->diafan->savenew && DB::query_result("SELECT cat_id FROM {%h} WHERE id=%d LIMIT 1", $this->diafan->table, $this->diafan->save) != $this->diafan->save_cat_id)
		{
			$children = $this->diafan->get_children($this->diafan->save, $this->diafan->table);
			if ($children)
			{
				DB::query("UPDATE {%h} SET cat_id=%d WHERE id IN (%h)", $this->diafan->table, $this->diafan->save_cat_id, implode(",", $children));
			}
		}
		return true;
	}

	/**
	 * Сохранение поля "Страница"
	 *
	 * @return void
	 */
	public function save_variable_site_id()
	{
		$this->diafan->set_query("site_id='%d'");
		if (!$this->diafan->save_site_id)
		{
			$this->diafan->get_site_id();
		}
		$this->diafan->set_value($this->diafan->save_site_id);
		if ($this->diafan->config("parent") && ! $this->diafan->savenew)
		{
			$children = $this->diafan->get_children($this->diafan->save, $this->diafan->table);
			if($children)
			{
				DB::query("UPDATE {".$this->diafan->table."} SET site_id=%d WHERE id IN (%h)", $this->diafan->save_site_id, implode(",", $children));
			}
		}
	}

	/**
	 * Сохранение поля "Страница"
	 *
	 * @return void
	 */
	public function get_site_id()
	{
		$this->diafan->save_site_id = $this->diafan->get_param($_POST, 'site_id', 0, 2);
		if ($this->diafan->config("element"))
		{
			$this->diafan->save_site_id = DB::query_result("SELECT site_id FROM {".$this->diafan->table."_category} WHERE id=%d LIMIT 1", $_POST["cat_id"]);
		}
		elseif ($this->diafan->config("category"))
		{
			if ($this->diafan->config("parent") && $_POST["parent_id"])
			{
				$this->diafan->save_site_id = DB::query_result("SELECT site_id FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $_POST["parent_id"]);
			}
			else
			{
				$this->diafan->save_site_id = $_POST["site_id"];
			}
		}
	}

	/**
	 * Сохранение поля "Расположение"
	 * @return void
	 */
	public function save_variable_site_ids()
	{
		$this->diafan->update_table_rel($this->diafan->table."_site_rel", "element_id", "site_id", ! empty($_POST['site_ids']) ? $_POST['site_ids'] : array(), $this->diafan->save, $this->diafan->savenew);
	}

	/**
	 * Сохранение поля "Сортировка"
	 * 
	 * @return void
	 */
	public function save_variable_sort()
	{
		$this->diafan->get_sort();
		$this->diafan->set_query("sort=%d");
		$this->diafan->set_value($this->diafan->save_sort);
	}

	/**
	 * Сохранение поля "Сортировка"
	 * 
	 * @return void
	 */
	public function get_sort()
	{
		if (! $this->diafan->config("order"))
		{
			return;
		}
		if ($this->diafan->save_sort)
		{
			return;
		}
		if ($this->diafan->savenew)
		{
			$this->diafan->save_sort = $this->diafan->save;
			return;
		}
		$sort_old = ! empty($this->diafan->oldrow["sort"]) ? $this->diafan->oldrow["sort"] : $this->diafan->save;

		$lang_act = ($this->diafan->variable_multilang("act") ? _LANG : '');

		//не сортируются неактивные элементы
		if ($this->diafan->is_variable("act") && (empty($this->diafan->oldrow["act".$lang_act]) || empty($_POST["act"])))
		{
			$this->diafan->save_sort = $sort_old;
			return;
		}

		//переменная $_POST["sort"] - id элемента, перед которым должен выводится редактируемый элемент
		if (empty($_POST["sort"]) || $_POST["sort"] == $this->diafan->save)
		{
			$this->diafan->save_sort = $sort_old;
			return;
		}

		$sort_new = '';
		//"down" - установить ниже всех
		if (! empty($_POST["sort"]) && $_POST["sort"] == "down")
		{
			$this->diafan->save_sort = DB::query_result("SELECT MAX(sort) FROM {".$this->diafan->table."}"
			." WHERE 1=1"
			.($this->diafan->config("parent") ? " AND parent_id='".$_POST["parent_id"]."'" : '')
			.($this->diafan->config("element") ? ' AND cat_id="'.$_POST["cat_id"].'"' : '')
			.($this->diafan->config("trash") ? " AND trash='0'" : '')
			.($this->diafan->is_variable("act") ? " AND act".$lang_act."='1'" : '')) + 1;
			return;
		}
		elseif (! empty($_POST["sort"]))
		{
			$this->diafan->save_sort = DB::query_result("SELECT sort FROM {".$this->diafan->table."} WHERE id=%d LIMIT 1", $_POST["sort"]);
			if(! $this->diafan->save_sort)
			{
				DB::query("UPDATE {".$this->diafan->table."} SET sort=sort+1");
				$this->diafan->save_sort = 1;
				$sort_old++;
			}
			elseif($this->diafan->save_sort == $sort_old)
			{
				DB::query("UPDATE {".$this->diafan->table."} SET sort=sort+1 WHERE sort>=%d AND id<>%d", $sort_old, $this->diafan->save);
				return;
			}
		}

		if ($sort_old > $this->diafan->save_sort)
		{
			DB::query("UPDATE {".$this->diafan->table."} SET sort=sort+1 WHERE sort>=%d AND id<>%d"
			.($this->diafan->config("parent") ? " AND parent_id='".$_POST["parent_id"]."'" : '')
			.($this->diafan->config("element") ? ' AND cat_id="'.$_POST["cat_id"].'"' : '')
			.($this->diafan->config("trash") ? " AND trash='0'" : '')
			.($this->diafan->is_variable("act") ? " AND act".$lang_act."='1'" : ''),
			$this->diafan->save_sort, $this->diafan->save);
		}
		else
		{
			$this->diafan->save_sort--;
			DB::query("UPDATE {".$this->diafan->table."} SET sort=sort-1 WHERE sort>%d AND sort<=%d AND id<>%d"
			.($this->diafan->config("parent") ? " AND parent_id='".$_POST["parent_id"]."'" : '')
			.($this->diafan->config("element") ? ' AND cat_id="'.$_POST["cat_id"].'"' : '')
			.($this->diafan->config("trash") ? " AND trash='0'" : '')
			.($this->diafan->is_variable("act") ? " AND act".$lang_act."='1'" : ''),
			$sort_old, $this->diafan->save_sort, $this->diafan->save);
		}
	}

	/**
	 * Сохранение поля "Псевдоссылка"
	 *
	 * @return void
	 */
	public function save_variable_rewrite()
	{
		if (! $this->diafan->is_save_rewrite)
		{
			$this->diafan->get_rewrite();
		}
	}

	/**
	 * Сохранение псевдоссылки
	 *
	 * @return void
	 */
	public function get_rewrite()
	{
		$this->diafan->is_save_rewrite = true;

		if (!$this->diafan->save_site_id)
		{
			$this->diafan->get_site_id();
		}
		$this->diafan->save_rewrite_redirect();
		if (isset($this->diafan->oldrow["site_id"]) && $this->diafan->save_site_id != $this->diafan->oldrow["site_id"])
		{
			DB::query("UPDATE {rewrite} SET site_id=%d WHERE module_name='%s' AND " . ( $this->diafan->config("category") ? "cat" : "element" ) . "_id=%d", $this->diafan->save_site_id, $this->diafan->module, $this->diafan->save);
			if ($this->diafan->config("category"))
			{
				$child = $this->diafan->get_children($this->diafan->save, $this->diafan->table);
				DB::query("UPDATE {rewrite} SET site_id=%d WHERE module_name='%s' AND cat_id IN (%s)", $this->diafan->save_site_id, $this->diafan->module, implode(",", $child));
				DB::query("UPDATE {" . str_replace("_category", "", $this->diafan->table) . "} SET site_id=%d WHERE cat_id IN (%s)", $this->diafan->save_site_id, implode(",", $child));
				DB::query("UPDATE {rewrite} SET site_id=%d WHERE module_name='%s' AND element_id IN" . " (SELECT id FROM {" . str_replace("_category", "", $this->diafan->table) . "} WHERE cat_id IN (%s))", $this->diafan->save_site_id, $this->diafan->module, $this->diafan->module, implode(",", $child));
			}
		}
		if (!$_POST["rewrite"] && !ROUTE_AUTO_MODULE)
		{
			DB::query("DELETE FROM {rewrite} WHERE module_name='%s' AND " . ( $this->diafan->config("category") ? "cat" : "element" ) . "_id=%d", $this->diafan->module, $this->diafan->save);
			return;
		}
		if (!$this->diafan->savenew)
		{
			$row = DB::fetch_array(DB::query("SELECT rewrite, id FROM {rewrite} WHERE module_name='%s' AND " . ( $this->diafan->config("category") ? "cat" : "element" ) . "_id=%d LIMIT 1", $this->diafan->module, $this->diafan->save));
		}
		$rewrite = !empty( $row["rewrite"] ) ? $row["rewrite"] : '';
		if (!empty( $row["id"] ))
		{
			DB::query("DELETE FROM {rewrite} WHERE module_name='%s' AND " . ( $this->diafan->config("category") ? "cat" : "element" ) . "_id=%d AND id<>%d", $this->diafan->module, $this->diafan->save, $row["id"]);
		}
		if ($_POST["rewrite"] && $_POST["rewrite"] == $rewrite)
		{
			return;
		}
		$rewrite_site = '';
		if (!$_POST["rewrite"] && ROUTE_AUTO_MODULE)
		{
			$_POST["rewrite"] = $this->generate_rewrite();
			if(! $_POST["rewrite"])
			{
				$_POST["rewrite"] = $this->diafan->save;
			}
			$rewrite = '';
		}
		if (!$rewrite)
		{
			if ($this->diafan->config("element") && ! empty( $_POST["cat_id"] ))
			{
				if (! $rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $_POST["cat_id"]))
				{
					$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->save_site_id);
				}
			}
			elseif ($this->diafan->config("category"))
			{
				if (!$_POST["parent_id"] || !$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $_POST["parent_id"]))
				{
					$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $_POST["site_id"]);
				}
			}
			else
			{
				$rewrite_site = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->save_site_id);
			}
		}
		//$new_rewrite = ($rewrite_site ? $rewrite_site.'/' : '').$this->diafan->translit($_POST["rewrite"]);
		$new_rewrite = ( $rewrite_site ? $rewrite_site . '/' : '' ) . $_POST["rewrite"];
		if (!empty( $row["id"] ))
		{
			DB::query("UPDATE {rewrite} SET rewrite='%h' WHERE id=%d", $new_rewrite, $row["id"]);
			$id = $row["id"];
		}
		else
		{
			DB::query("INSERT INTO {rewrite} (rewrite, module_name, " . ( $this->diafan->config("category") ? "cat" : "element" ) . "_id, site_id) VALUES ('%h', '%s', %d, %d)", $new_rewrite, $this->diafan->module, $this->diafan->save, $this->diafan->save_site_id);
			$id = DB::last_id("rewrite");
		}
		if (DB::query_result("SELECT COUNT(*) FROM {rewrite} WHERE rewrite='%h' AND id<>%d AND trash='0'", $new_rewrite, $id))
		{
			$new_rewrite .= $id;
			DB::query("UPDATE {rewrite} SET rewrite='%h' WHERE id=%d", $new_rewrite, $id);
		}
	}

	/**
	 * Сохранение редиректа
	 *
	 * @return void
	 */
	public function save_rewrite_redirect()
	{
		// если обновили раздел, то у редиректа элемента, вложенных элементов тоже обновляем раздел
		if (isset($this->diafan->oldrow["site_id"]) && $this->diafan->save_site_id != $this->diafan->oldrow["site_id"])
		{
			DB::query("UPDATE {redirect} SET site_id=%d WHERE module_name='%s' AND "
				.($this->diafan->config("category") ? "cat" : "element" )."_id=%d",
				$this->diafan->save_site_id, $this->diafan->module, $this->diafan->save);
			if ($this->diafan->config("category"))
			{
				$child = $this->diafan->get_children($this->diafan->save, $this->diafan->table);
				DB::query("UPDATE {redirect} SET site_id=%d WHERE module_name='%s' AND cat_id IN (%s)",
					$this->diafan->save_site_id, $this->diafan->module, implode(",", $child));
				DB::query("UPDATE {".str_replace("_category", "", $this->diafan->table)."}"
					." SET site_id=%d WHERE cat_id IN (%s)",
					$this->diafan->save_site_id, implode(",", $child));
				DB::query("UPDATE {redirect} SET site_id=%d WHERE module_name='%s' AND element_id IN"
					." (SELECT id FROM {".str_replace("_category", "", $this->diafan->table)
					."} WHERE cat_id IN (%s))",
					$this->diafan->save_site_id, $this->diafan->module,
					$this->diafan->module, implode(",", $child));
			}
		}
		// если редирект не прописан, удаляем запись о редиректе
		if (! $_POST["rewrite_redirect"])
		{
			DB::query("DELETE FROM {redirect} WHERE module_name='%s' AND "
				.( $this->diafan->config("category") ? "cat_id=%d AND element_id=0" : "element_id=%d" ),
				$this->diafan->module, $this->diafan->save);
			return;
		}
		// ищем есть ли запись о редиректе
		if (! $this->diafan->savenew)
		{
			$row = DB::fetch_array(DB::query("SELECT * FROM {redirect} WHERE module_name='%s' AND "
				.( $this->diafan->config("category") ? "cat_id=%d AND element_id=0" : "element_id=%d" )
				." LIMIT 1",
				$this->diafan->module, $this->diafan->save));
		}
		// если нашли, то обновляем
		if (! empty($row["id"]))
		{
			if($row["redirect"] == $_POST["rewrite_redirect"] && ($this->diafan->config("category") || $_POST["cat_id"] != $row["cat_id"]) && $row["code"] == $_POST["rewrite_code"])
				return;

			DB::query("UPDATE {redirect} SET redirect='%s', code=%d, cat_id=%d WHERE id=%d",
				$_POST["rewrite_redirect"], $_POST["rewrite_code"], ($this->diafan->config("category") ? $this->diafan->save : $_POST["cat_id"]), $row["id"]);
		}
		// иначе добавляем новую запись
		else
		{
			if($this->diafan->config("category"))
			{
				DB::query("INSERT INTO {redirect} (redirect, code, module_name, cat_id, site_id)"
					." VALUES ('%s', %d, '%s', %d, %d)",
					$_POST["rewrite_redirect"], $_POST["rewrite_code"], $this->diafan->module,
					$this->diafan->save, $this->diafan->save_site_id);
			}
			else
			{
				DB::query("INSERT INTO {redirect} (redirect, code, module_name, cat_id, element_id, site_id)"
					." VALUES ('%s', %d, '%s', %d, %d, %d)",
					$_POST["rewrite_redirect"], $_POST["rewrite_code"], $this->diafan->module, $_POST["cat_id"],
					$this->diafan->save, $this->diafan->save_site_id);
			}
		}
	}

	/**
	 * Генерирует псевдоссылку
	 *
	 * @return void
	 */
	public function generate_rewrite($name = '')
	{
		if(empty($name))
		{
			$name = ! empty($this->diafan->text_for_base_link["variable"]) ? $this->diafan->text_for_base_link["variable"] : 'name';

			//если псевдоссылка не задана, она генерируется из имени элемента/категории
			$name = $_POST[$name];
		}
		$rewrite = strip_tags($name);

		$route_method = DB::query_result("SELECT value FROM {config} WHERE module_name='route' AND name='method' LIMIT 1");
		switch ($route_method)
		{
			//перевод на английский
			case 2:
				$resp = file_get_contents('http://translate.yandex.net/api/v1/tr.json/translate?lang=ru-en&text='.urlencode($rewrite));
				if (preg_match('/"text":\["([^"]+)"\]}/', $resp, $match))
				{
					$rewrite = $match[1];
				}
				$rewrite = preg_replace('/[^A-Za-z0-9-_]+/', '', str_replace(' ', '-', $rewrite));
				//берутся первые 50 символов
				$rewrite = strtolower(substr($rewrite, 0, 50));
				break;
			//русская кириллица
			case 3:
				$rewrite = preg_replace('/[^A-Za-zабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0-9-_]+/', '', str_replace(' ', '-', $rewrite));
				//берутся первые 50 символов
				$rewrite = utf::strtolower(utf::substr($rewrite, 0, 50));
				break;
			//транскрипция
			default:
				$route_translit_array = DB::query_result("SELECT value FROM {config} WHERE module_name='route' AND name='translit_array' LIMIT 1");
				if ($route_translit_array)
				{
					list( $ru, $eng ) = explode('````', $route_translit_array, 2);
					$ru_arr = explode('|', $ru);
					$eng_arr = explode('|', $eng);
					$rewrite = str_replace($ru_arr, $eng_arr, $rewrite);
				}
				else
				{
					$rewrite = $this->diafan->translit($rewrite);
				}
				$rewrite = preg_replace('/[^A-Za-z0-9-_]+/', '', $rewrite);
				//берутся первые 50 символов
				$rewrite = strtolower(substr($rewrite, 0, 50));
				break;
		}
		return $rewrite;
	}

	/**
	 * Сохранение поля "Родитель"
	 *
	 * @return void
	 */
	public function save_variable_parent_id()
	{
		$this->diafan->save_parent_id = $this->diafan->get_param($_POST, 'parent_id', 0, 2);

		$this->diafan->set_query("parent_id='%d'");
		$this->diafan->set_value($_POST["parent_id"]);

		// если пункт новый, просто добавляем всех его родителей в table_parents и увеличиваем у родителей количество детей
		if ($this->diafan->savenew)
		{
			if ($_POST["parent_id"])
			{
				$parents = $this->diafan->get_parents($_POST["parent_id"], $this->diafan->table);
				$parents[] = $_POST["parent_id"];
				foreach ($parents as $parent_id)
				{
					DB::query("UPDATE {".$this->diafan->table."} SET count_children=count_children+1 WHERE id=%d", $parent_id);
					DB::query("INSERT INTO {".$this->diafan->table."_parents} (element_id, parent_id) VALUES (%d, %d)", $this->diafan->save, $parent_id);
				}
			}
			return;
		}
		// если родитель не изменился, уходим
		if ($this->diafan->oldrow["parent_id"] == $_POST["parent_id"])
		{
			return;
		}

		$children = $this->diafan->get_children($this->diafan->save, $this->diafan->table);
		$children[] = $this->diafan->save;
		$count_children = count($children);

		// если родитель был, у текущего элемента и его детей удаляем всех старых родителей, вышего текущего элемента
		// у старых родителей выше текущего элемента уменьшаем количество детей
		if ($this->diafan->oldrow["parent_id"])
		{
			$old_parents = $this->diafan->get_parents($this->diafan->save, $this->diafan->table);
			foreach ($old_parents as $parent_id)
			{
				DB::query("DELETE FROM {".$this->diafan->table."_parents} WHERE element_id IN (%h) AND parent_id=%d", implode(",", $children), $parent_id);
				DB::query("UPDATE {".$this->diafan->table."} SET count_children=count_children-%d WHERE id=%d", $count_children, $parent_id);
			}
		}
		// если новый родитель задан, то текущему элементу и его детям прибавляем новых родителей и увеличиваем у родителей количество детей
		if ($_POST["parent_id"])
		{
			$parents = $this->diafan->get_parents($_POST["parent_id"], $this->diafan->table);
			$parents[] = $_POST["parent_id"];
			foreach ($parents as $parent_id)
			{
				DB::query("UPDATE {".$this->diafan->table."} SET count_children=count_children+%d WHERE id=%d", $count_children, $parent_id);
				foreach ($children as $child)
				{
					DB::query("INSERT INTO {".$this->diafan->table."_parents} (element_id, parent_id) VALUES (%d, %d)", $child, $parent_id);
				}
			}
		}
	}

	/**
	 * Сохранение поля "Время редактирования"
	 *
	 * @return void
	 */
	public function save_variable_timeedit()
	{
		$this->diafan->set_query("timeedit='%s'");
		$this->diafan->set_value(time());
	}

	/**
	 * Сохранение поля "Показывать на сайте"
	 *
	 * @return void
	 */
	public function save_variable_act()
	{
		$lang = $this->diafan->variable_multilang("act") ? _LANG : '';

		$this->diafan->oldrow['act'] = ! empty($this->diafan->oldrow['act'.$lang]) ? '1' : '0';
		$_POST["act"] = ! empty($_POST["act"]) ? '1' : '0';

		if ($this->diafan->config("parent") && $this->diafan->oldrow['act'] != $_POST["act"])
		{
			$ids = $this->diafan->get_children($this->diafan->save, $this->diafan->table, array (), false);
		}
		$ids[] = $this->diafan->save;
		if ($ids)
		{
			DB::query("UPDATE {".$this->diafan->table."} SET act".$lang."='".( !empty( $_POST["act"] ) ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE id IN (".implode(',', $ids).")");
		}
		if ($this->diafan->config('category') && $this->diafan->oldrow['act'] != $_POST["act"])
		{
			DB::query("UPDATE {".str_replace('_category', '', $this->diafan->table)."} SET act".$lang."='".( !empty( $_POST["act"] ) ? "1".( $this->diafan->is_variable("timeedit") ? "', timeedit='".time() : '' ) : '0' )."' WHERE cat_id IN (".implode(',', $ids).")");
		}
		if (! $dirr = opendir(ABSOLUTE_PATH."modules"))
		{
			throw new Exception('Папка '.ABSOLUTE_PATH.'modules не существует.');
		}
		while (( $module = readdir($dirr) ) !== false)
		{
			if (file_exists(ABSOLUTE_PATH.'modules/'.$module.'/admin/'.$module.'.admin.act.php'))
			{
				Customization::inc('modules/'.$module.'/admin/'.$module.'.admin.act.php');
				$func = 'act';
				$class = ucfirst($module).'_admin_act';
				if (method_exists($class, 'act'))
				{
					$admin_act = new $class($this->diafan);
					$admin_act->act($this->diafan->table, $ids, !empty( $_POST["act"] ) ? 1 : 0);
				}
			}
		}
	}

	/**
	 * Сохранение поля "Доступ"
	 *
	 * @return void
	 */
	public function save_variable_access()
	{
		if ($this->diafan->config('category'))
		{
			$cat_id = $this->diafan->save;
			$element_id = 0;
		}
		else
		{
			$cat_id = 0;
			$element_id = $this->diafan->save;
		}

		$roles = array ();
		$old_roles = array ();
		$new_roles = array ();

		$result = DB::query("SELECT id FROM {users_role} WHERE trash='0'");
		while ($row = DB::fetch_array($result))
		{
			$roles[] = $row['id'];
		}
		if ($this->diafan->oldrow['access'])
		{
			$result = DB::query("SELECT role_id FROM {access} WHERE element_id=%d AND cat_id=%d AND module_name='%s'", $element_id, $cat_id, $this->diafan->module);
			while ($row = DB::fetch_array($result))
			{
				$old_roles[] = $row['role_id'];
			}
		}

		foreach ($_POST['access_role'] as $role_id)
		{
			$new_roles[] = intval($role_id);
		}
		// отмечены все роли
		if (empty( $_POST["access"]))
		{
			$new_roles = array ();
		}

		// изменений нет
		if (!array_diff($new_roles, $old_roles) && !array_diff($old_roles, $new_roles))
		{
			return true;
		}
		$this->diafan->set_query("access='%d'");
		$this->diafan->set_value($new_roles ? 1 : 0);

		// Роли, которым дан доступ
		$diff_new_roles = array_diff($new_roles, $old_roles);
		foreach ($diff_new_roles as $role_id)
		{
			DB::query("INSERT INTO {access} (element_id, cat_id, module_name, role_id) VALUES (%d, %d, '%s', %d)", $element_id, $cat_id, $this->diafan->module, $role_id);
		}
		// Роли, для которых теперь нет доступа
		$diff_old_roles = array_diff($old_roles, $new_roles);
		if ($diff_old_roles)
		{
			DB::query("DELETE FROM {access} WHERE element_id=%d AND cat_id=%d AND module_name='%s' AND role_id IN (%s)", $element_id, $cat_id, $this->diafan->module, implode(",", $diff_old_roles));
		}

		// для категории можем изменить доступ для вложенных категорий и элементов
		if ($this->diafan->config('category_rel'))
		{
			$result = DB::query("SELECT id, access FROM {".str_replace('_category', '', $this->diafan->table)."} WHERE cat_id=%d", $cat_id);
			while ($row = DB::fetch_array($result))
			{
				$old_roles_el = array ();
				if ($row["access"])
				{
					$result_a = DB::query("SELECT role_id FROM {access} WHERE element_id=%d AND module_name='%s'", $row["id"], $this->diafan->module);
					while ($row_a = DB::fetch_array($result_a))
					{
						$old_roles_el[] = $row_a['role_id'];
					}
				}
				// Если доступ полностью совпадает, то изменения синхронные
				if (!array_diff($old_roles_el, $old_roles) && !array_diff($old_roles, $old_roles_el))
				{
					foreach ($diff_new_roles as $role_id)
					{
						DB::query("INSERT INTO {access} (element_id, module_name, role_id) VALUES (%d, '%s', %d)", $row["id"], $this->diafan->module, $role_id);
					}
					if ($diff_old_roles)
					{
						DB::query("DELETE FROM {access} WHERE element_id=%d AND module_name='%s' AND role_id IN (%s)", $row["id"], $this->diafan->module, implode(",", $diff_old_roles));
					}
					if (!$new_roles && $row["access"] || $new_roles && !$row["access"])
					{
						DB::query("UPDATE {".str_replace('_category', '', $this->diafan->table)."} SET access='%d' WHERE id=%d", $row["access"] ? 0 : 1, $row["id"]);
					}
				}
				else
				{
					$diff_old_roles_el = array_diff($old_roles_el, $new_roles);
					foreach ($diff_new_roles_el as $role_id)
					{
						DB::query("DELETE FROM {access} WHERE element_id=%d AND module_name='%s' AND role_id=%d", $row["id"], $this->diafan->module, $role_id);
					}
				}
			}

			$children = $this->diafan->get_children($cat_id, $this->diafan->table);
			if ($children)
			{
				$result = DB::query("SELECT id, access FROM {".$this->diafan->table."} WHERE id IN (%s)", implode(",", $children));
				while ($row = DB::fetch_array($result))
				{
					$old_roles_el = array ();
					if ($row["access"])
					{
						$result_a = DB::query("SELECT role_id FROM {access} WHERE cat_id=%d AND module_name='%s'", $row["id"], $this->diafan->module);
						while ($row_a = DB::fetch_array($result_a))
						{
							$old_roles_el[] = $row_a['role_id'];
						}
					}
					// Если доступ полностью совпадает, то изменения синхронные
					if (!array_diff($old_roles_el, $old_roles) && !array_diff($old_roles, $old_roles_el))
					{
						foreach ($diff_new_roles as $role_id)
						{
							DB::query("INSERT INTO {access} (cat_id, module_name, role_id) VALUES (%d, '%s', %d)", $row["id"], $this->diafan->module, $role_id);
						}
						if ($diff_old_roles)
						{
							DB::query("DELETE FROM {access} WHERE cat_id=%d AND module_name='%s' AND role_id IN (%s)", $row["id"], $this->diafan->module, implode(",", $diff_old_roles));
						}
						if (!$new_roles && $row["access"] || $new_roles && !$row["access"])
						{
							DB::query("UPDATE {".$this->diafan->table."} SET access='%d' WHERE id=%d", $row["access"] ? 0 : 1, $row["id"]);
						}
					}
					else
					{
						$diff_old_roles_el = array_diff($old_roles_el, $new_roles);
						foreach ($diff_new_roles_el as $role_id)
						{
							DB::query("DELETE FROM {access} WHERE cat_id=%d AND module_name='%s' AND role_id=%d", $row["id"], $this->diafan->module, $role_id);
						}
					}
				}
			}
		}
	}

	/**
	 * Сохранение поля "Не показывать на карте сайта"
	 *
	 * @return void
	 */
	public function save_variable_map_no_show()
	{
		if ($this->diafan->config("parent"))
		{
			$ids = $this->diafan->get_children($this->diafan->save, $this->diafan->table, array (), false);
		}
		$ids[] = $this->diafan->save;
		if ($ids)
		{
			DB::query("UPDATE {".$this->diafan->table."} SET map_no_show='".( !empty( $_POST["map_no_show"] ) ? "1" : '0' )."' WHERE id IN (".implode(',', $ids).")");
		}
		if ($this->diafan->config('category'))
		{
			DB::query("UPDATE {".str_replace('_category', '', $this->diafan->table)."} SET map_no_show='".( !empty( $_POST["map_no_show"] ) ? "1" : '0' )."' WHERE cat_id IN (".implode(',', $ids).")");
		}
	}

	/**
	 * Сохранение поля "Номер страницы"
	 * @return void
	 */
	public function save_variable_number(){}

	/**
	 * Сохранение поля "Редактор"
	 * @return void
	 */
	public function save_variable_admin_id()
	{
		if(empty($this->diafan->oldrow["admin_id"]))
		{
			$this->diafan->set_query("admin_id=%d");
			$this->diafan->set_value($this->diafan->_user->id);
		}
	}

	/**
	 * Сохранение поля "Автор"
	 * @return void
	 */
	public function save_variable_user_id(){}

	/**
	 * Сохранение поля "Похожие элементы"
	 * @return void
	 */
	public function save_variable_rel_elements(){}

	/**
	 * Сохранение поля "Дополнительные параметры"
	 * 
	 * @return void
	 */
	public function save_variable_param($where = '')
	{
		$ids = array();
		$result = DB::query("SELECT id, type, config FROM {".$this->diafan->table."_param}"
		                    ." WHERE trash='0'".$where." ORDER BY sort ASC");

		while ($row = DB::fetch_array($result))
		{
			if($row["type"] == 'attachments')
			{
				Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
				$attachments = new Attachments_admin_inc($this->diafan);
				$attachments->save_param($row["id"], $row["config"]);
				continue;
			}

			if ($row["type"] == "multiple")
			{
				DB::query("DELETE FROM {".$this->diafan->table."_param_element} WHERE param_id=%d AND element_id=%d", $row["id"], $this->diafan->save);
				if (! empty($_POST['param'.$row["id"]]) && is_array($_POST['param'.$row["id"]]))
				{
					foreach ($_POST['param'.$row["id"]] as $v)
					{
						DB::query(
							"INSERT INTO {".$this->diafan->table."_param_element} (value, param_id, element_id) VALUES ('%s', %d, %d)",
							$v,
							$row["id"],
							$this->diafan->save
						);
					}
				}
				$ids[] = $row["id"];
			}
			elseif (! empty($_POST['param'.$row["id"]]))
			{
				$id = 0;
				if (! $this->diafan->savenew)
				{
					$id = DB::query_result("SELECT id FROM {".$this->diafan->table."_param_element} WHERE param_id=%d AND element_id=%d LIMIT 1", $row["id"], $this->diafan->save);
				}
				if ($row["type"] == "date")
                {
                    $_POST['param'.$row["id"]] = $this->diafan->formate_in_date($_POST['param'.$row["id"]]);
                }
                if ($row["type"] == "datetime")
                {
                    $_POST['param'.$row["id"]] = $this->diafan->formate_in_datetime($_POST['param'.$row["id"]]);
                }
				if ($row["type"] == "editor")
				{
					$_POST['param'.$row["id"]] = $this->diafan->save_field_editor('param'.$row["id"]);
				}
				if ($row["type"] == "numtext")
				{
					$_POST['param'.$row["id"]] = str_replace(',', '.', $_POST['param'.$row["id"]]);
				}
				$multilang = in_array($row["type"], array("text", "editor", "textarea")) && ($this->diafan->variable_multilang("name") || $this->diafan->variable_multilang("text"));
				if ($id)
				{
					DB::query(
						"UPDATE {".$this->diafan->table."_param_element} SET ".($multilang ? '[value]' : 'value')
						."='%s' WHERE id=%d",
						$_POST['param'.$row["id"]],
						$id
					);
					DB::query("DELETE FROM {".$this->diafan->table."_param_element} WHERE param_id=%d AND element_id=%d AND id<>%d", $row["id"], $this->diafan->save, $id);
				}
				else
				{
					DB::query(
						"INSERT INTO {".$this->diafan->table."_param_element} (".($multilang ? '[value]' : 'value')
						.", param_id, element_id) VALUES ('%s', %d, %d)",
						$_POST['param'.$row["id"]],
						$row["id"],
						$this->diafan->save
					);
				}
				$ids[] = $row["id"];
			}
		}
		DB::query("DELETE FROM {".$this->diafan->table."_param_element} WHERE".($ids ? " param_id NOT IN (".implode(", ", $ids).") AND" : "")." element_id=%d", $this->diafan->save);
	}

	/**
	 * Сохранение поля "Значения поля конструктора"
	 * @return void
	 */
	public function save_variable_param_select()
	{
		$name = $this->diafan->variable_multilang("name") ? '[name]' : 'name';
		if (($_POST["type"] == "select" || $_POST["type"] == "multiple") && ! empty($_POST["paramv"]))
		{
			$ids = array();
			foreach ($_POST["paramv"] as $key => $value)
			{
				$id = 0;
				if (! empty($_POST["param_id"][$key]))
				{
					$id = $_POST["param_id"][$key];
				}
				if ($id)
				{
					$sort = $_POST["param_sort"][$key];
					DB::query("UPDATE {".$this->diafan->table."_select} SET ".$name."='%h', sort=%d WHERE id=%d", $value, $sort, $id);
				}
				elseif ($value)
				{
					DB::query("INSERT INTO {".$this->diafan->table."_select} (param_id, ".$name.") VALUES (%d, '%h')", $this->diafan->save, $value);
					$id = DB::last_id($this->diafan->table."_select");
					DB::query("UPDATE {".$this->diafan->table."_select} SET sort=id WHERE id=%d", $id);
				}
				$ids[] = $id;
			}
			DB::query("DELETE FROM {".$this->diafan->table."_select} WHERE param_id=%d AND id NOT IN (%h)", $this->diafan->save, implode(",", $ids));
		}
		elseif ($_POST["type"] == "checkbox")
		{
			if ($this->diafan->oldrow["type"] == "checkbox" && ($_POST["paramk_check1"] || $_POST["paramk_check0"]))
			{
				$result = DB::query("SELECT id, value FROM {".$this->diafan->table."_select} WHERE param_id=%d", $this->diafan->save);
				while ($row = DB::fetch_array($result))
				{
					if ($row["value"] == 1)
					{
						DB::query("UPDATE {".$this->diafan->table."_select} SET ".$name."='%h' WHERE id=%d", $_POST["paramk_check1"], $row["id"]);
						$check1 = true;
					}
					elseif ($row["value"] == 0)
					{
						DB::query("UPDATE {".$this->diafan->table."_select} SET ".$name."='%h' WHERE id=%d", $_POST["paramk_check0"], $row["id"]);
						$check0 = true;
					}
				}
				DB::query("DELETE FROM {".$this->diafan->table."_select} WHERE param_id=%d AND value NOT IN (0,1)", $this->diafan->save);

			}
			else
			{
				DB::query("DELETE FROM {".$this->diafan->table."_select} WHERE param_id=%d", $this->diafan->save);
			}
			if (empty($check0) && $_POST["paramk_check0"])
			{
				DB::query("INSERT INTO {".$this->diafan->table."_select} (param_id, value, ".$name.") VALUES (%d, 0, '%h')", $this->diafan->save, $_POST["paramk_check0"]);
			}
			if (empty($check1) && $_POST["paramk_check1"])
			{
				DB::query("INSERT INTO {".$this->diafan->table."_select} (param_id, value, ".$name.") VALUES (%d, 1, '%h')", $this->diafan->save, $_POST["paramk_check1"]);
			}
		}
		else
		{
			DB::query("DELETE FROM {".$this->diafan->table."_select} WHERE param_id=%d", $this->diafan->save);
		}
		if($this->diafan->select_arr("type", "attachments"))
		{
			Customization::inc('modules/attachments/admin/attachments.admin.inc.php');
			$attachment = new Attachments_admin_inc($this->diafan);
			$attachment->save_config_param();
		}
		if($this->diafan->select_arr("type", "images"))
		{
			Customization::inc('modules/images/admin/images.admin.inc.php');
			$images = new Images_admin_inc($this->diafan);
			$images->save_config_param();
		}
	}

	/**
	 * Сохранение поля "Шаблон страницы для разных ситуаций"
	 * @return void
	 */
	public function save_config_variable_themes(){}

	/**
	 * Сохранение поля "Доступ к файлам только для администратора"
	 *  
	 * @return void
	 */
	public function save_config_variable_attachments_access_admin()
	{
		$this->diafan->set_query("attachments_access_admin='%d'");
		$this->diafan->set_value(1);
	}

	/**
	 * Сохранение поля "Электронный адрес администратора - другой" для конфигурации модуля
	 *
	 * @return void
	 */
	public function save_config_variable_email_admin()
	{
		if(! empty($_POST["email_admin"]))
		{
			if(is_array($_POST["email_admin"]))
			{
				$values = array();
				foreach($_POST["email_admin"] as $v)
				{
					if(trim($v))
					{
						$values[] = trim($v);
					}
				}
				$value = implode(',', $values);
			}
			else
			{
				$value = $_POST["email_admin"];
			}
			$this->diafan->set_query("email_admin='%s'");
			$this->diafan->set_value($value);
		}
	}
}