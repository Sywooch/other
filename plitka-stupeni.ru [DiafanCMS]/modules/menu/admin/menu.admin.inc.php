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
 * Menu_admin_inc
 * 
 * Подключение модуля "Меню" к другим модулям для административной части
 */
class Menu_admin_inc extends Diafan
{
	/**
	 * Редактирование поля "Показывать в меню"
	 * 
	 * @return void
	 */
	public function edit()
	{
		$show_in_menu = array();
		if (! $this->diafan->addnew)
		{
			if ($this->diafan->module == 'site')
			{
				$name_menu = 'site_id';
			}
			elseif ($this->diafan->config("category"))
			{
				$name_menu = 'module_cat_id';
			}
			else
			{
				$name_menu = 'element_id';
			}
			$result = DB::query("SELECT cat_id FROM {menu} WHERE module_name='%h' AND ".$name_menu."=%d AND trash='0' AND [act]='1'", $this->diafan->module, $this->diafan->edit);
			while ($row = DB::fetch_array($result))
			{
				$show_in_menu[] = $row["cat_id"];
			}
		}

		echo '
		<tr valign="top">
			<td class="td_first">'.$this->diafan->variable_name().'</td>
			<td>';
			$result = DB::query("SELECT id, [name] FROM {menu_category} WHERE trash='0' ORDER BY id ASC");
			while ($row = DB::fetch_array($result))
			{
				echo '<input type="checkbox" name="menu_cat_ids[]" value="'.$row["id"].'"'.(in_array($row["id"], $show_in_menu) ? ' checked' : '').'> '.$row["name"].'<br>';
			}
			echo $this->diafan->help().'
			</td>
		</tr>';
	}

	/**
	 * Сохранение поля "Показывать в меню"
	 * 
	 * @return void
	 */
	public function save()
	{
		if (! $this->diafan->save_site_id)
		{
			$this->diafan->get_site_id();
		}
		if (! $this->diafan->save_sort)
		{
			$this->diafan->get_sort();
		}
		$save = array(
			"id" => $this->diafan->save,
			"module" => $this->diafan->module, 
			"is_category" => $this->diafan->config("category"), 
			"site_id" => $this->diafan->save_site_id,
			"is_new" => $this->diafan->savenew,
			"parent_id" => ! empty($_POST["parent_id"]) ? $_POST["parent_id"] : '',
			"name" => $_POST["name"],
			"old_name" => ! empty($this->diafan->oldrow['name'._LANG]) ? $this->diafan->oldrow['name'._LANG] : '',
			"access" => ! empty($_POST["access"]) ? 1 : 0,
			"old_access" => isset($this->diafan->oldrow["access"]) ? $this->diafan->oldrow["access"] : (empty($_POST["access"]) ? 1 : 0),
			"sort" => $this->diafan->save_sort,
			"act" => ! empty($_POST["act"]) || ! $this->diafan->is_variable('act') ? 1 : 0,
			"old_act" => ! empty($this->diafan->oldrow['act'._LANG]) ? 1 : 0,
			"cat_id" => ! empty($_POST["cat_id"]) ? $_POST["cat_id"] : 0,
			"date_start" => ! empty($_POST["date_start"]) ? $this->diafan->unixdate($_POST["date_start"]) : 0,
			"old_date_start" => isset($this->diafan->oldrow["date_start"]) ? $this->diafan->oldrow["date_start"] : 0,
			"date_finish" => ! empty($_POST["date_finish"]) ? $this->diafan->unixdate($_POST["date_finish"]) : 0,
			"old_date_finish" => isset($this->diafan->oldrow["date_finish"]) ? $this->diafan->oldrow["date_finish"] : 0
		);
		$menu_cat_ids = ! empty($_POST["menu_cat_ids"]) && empty($_POST["block"]) ? $_POST["menu_cat_ids"] : array();

		$this->save_menu($save, $menu_cat_ids);
	}

	/**
	 * Сохранение пункта в меню
	 * 
	 * @param array $save данные об элементе
	 * @param array $menu_cat_ids категории меню, в которых нужно отображить пункт
	 * @return boolean true
	 */
	public function save_menu($save, $menu_cat_ids)
	{
		$edit_menu = false;
		if ($save["module"] == 'site')
		{
			$name_menu = 'site_id';
		}
		else
		{
			if ($save["is_category"])
			{
				$name_menu = 'module_cat_id';
			}
			else
			{
				$name_menu = 'element_id';
			}
		}

		$show_in_menu = array();
		if (! $save["is_new"])
		{
			$result = DB::query("SELECT cat_id FROM {menu} WHERE module_name='%h' AND ".$name_menu."=%d AND trash='0'", $save["module"], $save["id"]);
			while ($row = DB::fetch_array($result))
			{
				$show_in_menu[] = $row["cat_id"];
			}

		}
		if (! $menu_cat_ids)
		{
			if ($show_in_menu)
			{
				foreach ($show_in_menu as $menu_cat_id)
				{
					$edit_menu = true;
					$id = DB::query_result("SELECT id FROM {menu} WHERE module_name='%h' AND ".$name_menu."=%d AND cat_id=%d AND trash='0' LIMIT 1", $save["module"], $save["id"], $menu_cat_id);
					$children = $this->diafan->get_children($id, "menu", true);
					$children[] = $id;
					DB::query("DELETE FROM {menu_parents} WHERE parent_id IN (%s)", implode(',', $children));
					DB::query("DELETE FROM {menu_parents} WHERE element_id IN (%s)", implode(',', $children));
					DB::query("DELETE FROM {menu} WHERE id IN (%s)", implode(',', $children));

					if($row["module"] == 'site')
					{
						DB::query("UPDATE {site} SET is_menu='0' WHERE id=%d",$save["id"]);
					}

					// пересчитываем поле count_children
					$result = DB::query("SELECT id FROM {menu} WHERE cat_id=%d AND trash='0'", $menu_cat_id); 
					while ($row = DB::fetch_array($result))
					{
						$count = DB::query_result("SELECT COUNT(*) FROM  {menu_parents} WHERE parent_id=%d AND trash='0'", $row["id"]);
						DB::query("UPDATE {menu} SET count_children=%d WHERE id=%d", $count, $row["id"]);
					}
				}
			}
		}
		else
		{
			foreach ($menu_cat_ids as $menu_cat_id)
			{
				if (! in_array($menu_cat_id, $show_in_menu))
				{
					$edit_menu = true;
					$parent_id = 0;
					if ($save["parent_id"])
					{
						$parent_id = DB::query_result("SELECT id FROM {menu} WHERE module_name='%h' AND ".$name_menu."=%d AND cat_id=%d AND trash='0' LIMIT 1", $save["module"], $save["parent_id"], $menu_cat_id);
					}
					if ($save["module"] == 'site')
					{
						DB::query("INSERT INTO {menu} ([name], module_name, site_id, cat_id, parent_id, access, date_start, date_finish, sort, [act])"
								  ." VALUES ('%h', 'site', %d, %d, %d, '%d', %d, %d, %d, '%d')",
								  $save["name"],
								  $save["id"],
								  $menu_cat_id,
								  $parent_id,
								  $save["access"],
								  $save["date_start"],
								  $save["date_finish"],
								  $save["sort"],
								  $save["act"] || $save["id"] == 1 ? 1 : 0
								);
						DB::query("UPDATE {site} SET is_menu='1' WHERE id=%d", $save["id"]);
					}
					else
					{
						if (! $save["parent_id"] && $save["cat_id"])
						{
							$parent_id = DB::query_result("SELECT id FROM {menu} WHERE module_name='%h' AND module_cat_id=%d AND cat_id=%d AND trash='0' LIMIT 1", $save["module"], $save["cat_id"], $menu_cat_id);
						}
						if (! $parent_id && $save["site_id"])
						{
							$parent_id = DB::query_result("SELECT id FROM {menu} WHERE module_name='site' AND site_id=%d AND cat_id=%d AND trash='0' LIMIT 1", $save["site_id"], $menu_cat_id);
						}
						DB::query("INSERT INTO {menu} ([name], module_name, site_id, ".$name_menu.", cat_id, parent_id, access, date_start, date_finish, sort, [act])"
								  ." VALUES ('%h', '%h', %d, %d, %d, %d, '%d', %d, %d, %d, '%d')",
								  $save["name"],
								  $save["module"],
								  $save["site_id"],
								  $save["id"],
								  $menu_cat_id,
								  $parent_id,
								  $save["access"],
								  $save["date_start"],
								  $save["date_finish"],
								  $save["sort"],
								  $save["act"]
								  );
						//DB::query("UPDATE {site} SET is_menu='1' WHERE id=%d", $save["site_id"]);
					}
					$new_menu_id = DB::last_id("menu");
					$table = $save["module"];
					if ($save["is_category"])
					{
						$table .= '_category';
					}
					foreach ($this->diafan->languages as $language)
					{
						if ($language["id"] != _LANG)
						{
							$element = DB::fetch_array(DB::query("SELECT name".$language["id"]." AS name, act".$language["id"]." AS act FROM {%h} WHERE id=%d LIMIT 1", $table, $save["id"]));
							DB::query("UPDATE {menu} SET act".$language["id"]."='%d', name".$language["id"]."='%h' WHERE id=%d", $element["act"], $element["name"], $new_menu_id);
						}
					}
					if ($parent_id)
					{
						$parents = $this->diafan->get_parents($parent_id, "menu");
						$parents[] = $parent_id;
						foreach ($parents as $parent_id)
						{
							DB::query("INSERT INTO {menu_parents} (element_id, parent_id) VALUES (%d, %d)", $new_menu_id, $parent_id);
						}
						DB::query("UPDATE {menu} SET count_children=count_children+1 WHERE id IN (%s)", implode(',', $parents));
					}
					if (! $save["sort"])
					{
						DB::query("UPDATE {menu} SET sort=id WHERE id=%d", $new_menu_id);
					}
				}
			}
			foreach ($show_in_menu as $menu_cat_id)
			{
				if (! in_array($menu_cat_id, $menu_cat_ids))
				{
					$edit_menu = true;
					$id = DB::query_result("SELECT id FROM {menu} WHERE module_name='%h' AND ".$name_menu."=%d AND cat_id=%d AND trash='0' LIMIT 1", $save["module"], $save["id"], $menu_cat_id);
					$children = $this->diafan->get_children($id, "menu", true);
					$children[] = $id;
					DB::query("DELETE FROM {menu_parents} WHERE parent_id IN (%s)", implode(',', $children));
					DB::query("DELETE FROM {menu_parents} WHERE element_id IN (%s)", implode(',', $children));
					DB::query("DELETE FROM {menu} WHERE id IN (%s)", implode(',', $children));

					// пересчитываем поле count_children
					$result = DB::query("SELECT id FROM {menu} WHERE cat_id=%d AND trash='0'", $menu_cat_id); 
					while ($row = DB::fetch_array($result))
					{
						$count = DB::query_result("SELECT COUNT(*) FROM  {menu_parents} WHERE parent_id=%d", $row["id"]);
						DB::query("UPDATE {menu} SET count_children=%d WHERE id=%d", $count, $row["id"]);
					}
				}
				else
				{
					// если изменилось имя (совпадает старое имя) или доступ для элемента/категории,
					// то делаем соответствующие изменения пункта меню
					$result = DB::query("SELECT id, [name], [act] FROM {menu} WHERE module_name='%h' AND ".$name_menu."=%d AND cat_id=%d AND trash='0'", $save["module"], $save["id"], $menu_cat_id);
					while ($row = DB::fetch_array($result))
					{
						if ($row["name"] == $save['old_name'] || $save["act"] != $save["old_act"])
						{
							$edit_menu = true;
							DB::query("UPDATE {menu} SET [name]='%h', [act]='%d' WHERE id=%d", $save["name"], $save["act"], $row["id"]);
						}
						if ($save["access"] && ! $save["old_access"] || ! $save["access"] && $save["old_access"])
						{
							$edit_menu = true;
							DB::query("UPDATE {menu} SET access='%d' WHERE id=%d", $save["access"], $row["id"]);
						}
						if ($save["date_start"] != $save["old_date_start"])
						{
							$edit_menu = true;
							DB::query("UPDATE {menu} SET date_start=%d WHERE id=%d", $save["date_start"], $row["id"]);
						}
						if ($save["date_finish"] != $save["old_date_finish"])
						{
							$edit_menu = true;
							DB::query("UPDATE {menu} SET date_finish=%d WHERE id=%d", $save["date_finish"], $row["id"]);
						}
					}
				}
			}
		}
		if($edit_menu)
		{
			$this->diafan->_cache->delete("", "menu");
		}
		return $edit_menu;
	}

	/**
	 * Помечает пункты меню на удаление или удаляет пункты меню
	 * 
	 * @param string $module_name название модуля, к которому прикреплены пункты меню
	 * @param integer $element_id номер элемента, к которому прикреплены пункты меню
	 * @param integer $trash_id номер записи в корзине, с которой связано удаление
	 * @param integer $is_category удаляемый элемент - категория
	 * @return void
	 */
	public function delete($module_name, $element_id, $trash_id = 0, $is_category = false)
	{
		$del_ids = array();
		if ($module_name == "site")
		{
			$result = DB::query("SELECT id, count_children FROM {menu} WHERE site_id='%d' AND module_name='%h'", $element_id, $module_name);
		}
		elseif ($is_category)
		{
			$result = DB::query("SELECT id, count_children FROM {menu} WHERE module_cat_id='%d' AND module_name='%h'", $element_id, $module_name);
		}
		else
		{
			$result = DB::query("SELECT id, count_children FROM {menu} WHERE element_id='%d' AND module_name='%h'", $element_id, $module_name);
		}
		while ($row = DB::fetch_array($result))
		{
			$children = array();
			if ($row["count_children"])
			{
				$children = $this->diafan->get_children($row["id"], "menu");
			}
			$children[] = $row["id"];
			foreach ($children as $id)
			{
				if (! in_array($id, $del_ids))
				{
					$del_ids[] = $id;
				}
			}
		} 
		if ($del_ids)
		{
			$this->diafan->del_or_trash_where("menu_parents", "element_id IN (".implode(",", $del_ids).")", $trash_id);
			$result = DB::query("SELECT parent_id FROM {menu} WHERE id IN (".implode(",", $del_ids).")");
			while ($row = DB::fetch_array($result))
			{
				if ($row["parent_id"])
				{
					$count = DB::query_result("SELECT COUNT(*) FROM {menu_parents} WHERE trash='0' AND parent_id=%d LIMIT 1", $row["parent_id"]);
					DB::query("UPDATE {menu} SET count_children=%d WHERE trash='0' AND id=%d", $count, $row["parent_id"]);
				}
			}
			$this->diafan->del_or_trash_where("menu", "id IN (".implode(",", $del_ids).")", $trash_id);
			$this->diafan->diafan->_cache->delete("", "menu");
		}   
	}

	/**
	 * Блокирует/разблокирует пункты меню
	 * 
	 * @param string $table таблица
	 * @param array $element_ids номера элементов, к которым прикреплены теги
	 * @param integer $act блокировать/разблокировать
	 * @return void
	 */
	public function act($table, $element_ids, $act)
	{
		if ($table == "menu" && $act)
		{
			if (! $this->diafan->save)
			{
				foreach ($element_ids as $element_id)
				{
					$row = DB::fetch_array(DB::query("SELECT * FROM {menu} WHERE id=%d LIMIT 1", $element_id));
					$table = $row["module_name"];
					if ($row["module_name"] == 'site')
					{
						$id = $row["site_id"];
					}
					elseif ($row["module_name"])
					{
						if ($row["module_cat_id"])
						{
							$id = $row["module_cat_id"];
							$table .= '_category';
						}
						else
						{
							$id = $row["element_id"];
						}
					}
					if (! DB::query_result("SELECT [act] FROM {".$table."} WHERE id=%d LIMIT 1", $id))
					{
						DB::query("UPDATE {".$table."} SET [act]='1' WHERE id=%d", $id);
						$this->diafan->_cache->delete("", $row["module_name"]);
					}
				}
			}
			else
			{
				if ($_POST["module_name"] == 'site')
				{
					if (! DB::query("SELECT [act] FROM {site} WHERE id=%d", $_POST["site_id"]))
					{
						DB::query("UPDATE {site} SET [act]='1' WHERE id=%d", $_POST["site_id"]);
						$this->diafan->_cache->delete("", "site");
					}
				}
				elseif ($_POST["module_name"])
				{
					$table = $_POST["module_name"];
					if ($_POST["module_cat_id"])
					{
						$id = $_POST["module_cat_id"];
						$table .= '_category';
					}
					else
					{
						$id = $_POST["element_id"];
					}
					if (! DB::query("SELECT [act] FROM {%h} WHERE id=%d", $table, $id))
					{
						DB::query("UPDATE {%h} SET [act]='1' WHERE id=%d", $table, $id);
						$this->diafan->_cache->delete("", $_POST["module_name"]);
					}
				}
				
			}
		}
		if (! $this->diafan->config("menu"))
		{
			return;
		}
		if ($this->diafan->config('category'))
		{
			$table = str_replace('_category', '', $table);
			DB::query("UPDATE {menu} SET [act]='%d' WHERE module_name='%h' AND module_cat_id IN (%h)", $act, $table, implode(',', $element_ids));
			$result = DB::query("SELECT id FROM {".$table."} WHERE cat_id IN (%h)", implode(',', $element_ids));
			$element_ids = array();
			while ($row = DB::fetch_array($result))
			{
				$element_ids[] = $row["id"];
			}
			if ($element_ids)
			{
				DB::query("UPDATE {menu} SET [act]='%d' WHERE module_name='%h' AND element_id IN (%h)", $act, $table, implode(',', $element_ids));
			}
		}
		elseif ($table == "site")
		{
			DB::query("UPDATE {menu} SET [act]='%d' WHERE module_name='%h' AND site_id IN (%h)", $act, $table, implode(',', $element_ids));
		}
		else
		{
			DB::query("UPDATE {menu} SET [act]='%d' WHERE module_name='%h' AND element_id IN (%h)", $act, $table, implode(',', $element_ids));
		}
		$this->diafan->_cache->delete("", "menu");
	}
}