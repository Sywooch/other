<?php
/**
 * Установка модулей
 *
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

class Install
{
	/**
	 * @var integer номер страницы сайта с прикрепленным модулем
	 **/
	private $site_id = 0;

	/**
	 * @var string название текущиего модуля
	 **/
	private $module;

	/**
	 * Конструктор класса
	 *
	 * @param array $langs массив языков сайта
	 * @return void
	 */
	public function __construct($langs)
	{
		$this->lang_ids = array();
		foreach($langs as $lang)
		{
			if(is_array($lang))
			{
				$this->lang_ids[] = $lang["id"];
			}
			else
			{
				$this->lang_ids[] = $lang;
			}
		}
		global $lang_ids;
		$lang_ids = $this->lang_ids;
	}

	/**
	 * Устанавливаем модуль
	 *
	 * @param string $module название модуля
	 * @param boolean $install_example установить примеры
	 * @return void
	 */
	public function install($module, $install_example)
	{
		$this->module = $module;
		if($module == 'core')
		{
			include_once ABSOLUTE_PATH."installation/core.php";
		}
		else
		{
			include_once ABSOLUTE_PATH."modules/".$module.'/'.$module.".install.php";
		}
		if(! empty($db["tables"]))
		{
			$this->tables($db["tables"]);
		}
		if(! empty($db["modules"]))
		{
			$this->modules($db["modules"]);
		}
		if(! empty($db["adminsites"]))
		{
			$this->adminsites($db["adminsites"]);
		}
		if(! empty($db["sites"]))
		{
			$this->sites($db["sites"]);
		}
		if(! empty($db["config"]))
		{
			$this->config($db["config"]);
		}
		if(! empty($db["sql"]))
		{
			$this->sql($db["sql"]);
		}
		$func = 'module_basic_'.$module;
		if (function_exists($func))
		{
			$func();
		}
		if($install_example)
		{
			if(! empty($example))
			{
				$this->sql($example);
			}
			$func = 'module_example_'.$module;
			if (function_exists($func))
			{
				$func();
			}
		}
	}

	/**
	 * Добавляет таблицы
	 *
	 * @param array $array таблицы
	 * @return void
	 */
	private function tables($array)
	{
		foreach($array as $row)
		{
			$query = "CREATE TABLE {".$row["name"]."} (";
			foreach($row["fields"] as $field)
			{
				if(empty($field["multilang"]))
				{
					$query .= "\n".'`'.$field["name"].'` '.$field["type"].',';
				}
				else
				{
					foreach($this->lang_ids as $lang_id)
					{
						$query .= "\n".'`'.$field["name"].$lang_id.'` '.$field["type"].',';
					}
				}
			}
			if(! empty($row["keys"]))
			{
				$query .= "\n".implode(',', $row["keys"]);
			}
			$query .= "\n) CHARSET=utf8";
			DB::query($query);
		}
	}

	/**
	 * Добавляет запись в таблицу {modules}
	 *
	 * @param array $array
	 * @return void
	 */
	private function modules($array)
	{
		foreach($array as $row)
		{
			DB::query("INSERT INTO {modules} (name, module_name, title, admin, site, site_page) VALUES ('%h', '%h', '%h', '%d', '%d', '%d')",
				  $row["name"], $row["module_name"], $row["title"],
				  (! empty($row["admin"]) ? 1 : 0), (! empty($row["site"]) ? 1 : 0), (! empty($row["site_page"]) ? 1 : 0));
		}
	}
	
	/**
	 * Добавляет записи о модуле в таблицу {adminsite} - страницы админки
	 *
	 * @param array $array
	 * @param integer $parent_id номер страницы админки - родителя
	 * @param array $parent значения полей для родителя
	 * @return void
	 */
	private function adminsites($array, $parent_id = 0, $parent = array())
	{
		foreach($array as $values)
		{
			if(empty($values["sort"]))
			{
				$values["sort"] = 0;
			}
			if(empty($values["docs"]))
			{
				if(! empty($parent["docs"]))
				{
					$values["docs"] = $parent["docs"];
				}
				else
				{
					$values["docs"] = '';
				}
			}
			if(empty($values["group_id"]))
			{
				if(! empty($parent["group_id"]))
				{
					$values["group_id"] = $parent["group_id"];
				}
				else
				{
					$values["group_id"] = '1';
				}
			}
		
			if (!empty($parent_id)) 
			{
				DB::query("UPDATE {adminsite} SET count_children=count_children+1 WHERE id=%d", $parent_id);
			}
			if(empty($values['act']))
			{
				$values['act'] = 0;
			}
			else
			{
				$values['act'] = 1;
			}
		
			if (empty($parent_id))
			{
				DB::query("INSERT INTO {adminsite} (group_id, name, rewrite, act, sort, docs) VALUES ('%s', '%s', '%s', '%s', %d, '%s')", $values['group_id'], $values['name'], $values['rewrite'], $values['act'], $values['sort'], $values["docs"]);
				$last_id = DB::last_id("adminsite");
			}
			else 
			{
				DB::query("INSERT INTO {adminsite} (parent_id, group_id, name, rewrite, act, sort, docs) VALUES (%d, %d, '%s', '%s', '%s', %d, '%s')", $parent_id, $values['group_id'], $values['name'], $values['rewrite'], $values['act'], $values['sort'], $values["docs"]);
				$last_id = DB::last_id("adminsite");
				DB::query("INSERT INTO {adminsite_parents} (element_id, parent_id) VALUES (%d, %d)", $last_id, $parent_id);
			}
	
			if(!empty($values['children']))
			{
				$this->adminsites($values['children'], $last_id, $values);
			}
		}
	}

	/**
	 * Добавляет страницы сайта
	 *
	 * @param array $array
	 * @return void
	 */
	private function sites($array)
	{
		foreach($array as $row)
		{
			DB::query("INSERT INTO {site} (name".$this->lang_ids[0].", act".$this->lang_ids[0].", sort, timeedit, module_name) VALUES ('%h', '1', '%d', '%d', '%h')",
				  (is_array($row["name"]) ? $row["name"][0] : $row["name"]), $row["sort"], time(), $row["module_name"]);
			$site_id = DB::last_id("site");
			if(! empty($row["menu"]))
			{
				DB::query("INSERT INTO {menu} (
					name".$this->lang_ids[0].", act".$this->lang_ids[0].",
					site_id,
					cat_id,
					sort,
					module_name
				) VALUES (
					'%h', '1',
					%d,
					%d,
					%d,
					'site'
				);", (is_array($row["name"]) ? $row["name"][0] : $row["name"]), $site_id, $row["menu"]["cat_id"], $row["menu"]["sort"]);
				$menu_id = DB::last_id("menu");
			}
			if($row["module_name"] == $this->module)
			{
				$this->site_id = $site_id;
			}
			if(count($this->lang_ids) > 1)
			{
				foreach($this->lang_ids as $i => $lang_id)
				{
					if(! $i)
						continue;
					if(is_array($row["name"]))
					{
						if(! empty($row["name"][$i]))
						{
							$name = $row["name"][$i];
						}
						else
						{
							$name = $row["name"][0];
						}
					}
					else
					{
						$name = $row["name"];
					}
					DB::query("UPDATE {site} SET act".$lang_id."='1', name".$lang_id."='%h' WHERE id=%d", $name, $site_id);
					if(! empty($row["menu"]))
					{
						DB::query("UPDATE {menu} SET act".$lang_id."='1', name".$lang_id."='%h' WHERE id=%d", $name, $menu_id);
					}
				}
			}
			DB::query("INSERT INTO {rewrite} (rewrite, module_name, site_id) VALUES ('%h', 'site', %d)", $row["rewrite"], $site_id);
		}
	}

	/**
	 * Добавляет запись в таблицу {config}
	 *
	 * @param array $array
	 * @return void
	 */
	private function config($array)
	{
		foreach($array as $row)
		{
			if($row["check_module"] && empty($_POST[$row["module_name"]]))
			{
				continue;
			}
			if(empty($row["module_name"]))
			{
				$row["module_name"] = $this->module;
			}
			if(is_array($row["value"]))
			{
				foreach($row["value"] as $i => $value)
				{
					if(empty($this->lang_ids[$i]))
						continue;

					DB::query("INSERT INTO {config} (name, module_name, value, lang_id) VALUES ('%h', '%h', '%s', %d)",
					$row["name"], $row["module_name"], $value, ($i ? $this->lang_ids[$i] : 0));
				}
			}
			else
			{
				DB::query("INSERT INTO {config} (name, module_name, value) VALUES ('%h', '%h', '%s')",
				  $row["name"], $row["module_name"], $row["value"]);
			}
		}
	}

	/**
	 * Выполняет SQL-запросы
	 *
	 * @param array $array
	 * @return void
	 */
	private function sql($array)
	{
		foreach($array as $query)
		{
			$query = str_replace('MODULE_SITE_ID', $this->site_id, $query);
			DB::query($query);
		}
	}

	/**
	 * Удаляет модуль
	 *
	 * @param string $module название модуля
	 * @return void
	 */
	public function uninstall($module)
	{
		$this->module = $module;
		if($module == 'core')
		{
			include_once ABSOLUTE_PATH."installation/core.php";
		}
		else
		{
			include_once ABSOLUTE_PATH."modules/".$module.'/'.$module.".install.php";
		}
		$func = 'module_basic_uninstall_'.$module;
		if (function_exists($func))
		{
			$func();
		}
		global $diafan;
		$diafan->_cache->delete('', $module);
		$diafan->_cache->delete('', "menu");
		
		foreach($db["tables"] as $row)
		{
			DB::query("DROP TABLE {".$row["name"]."};");
		}
		
		$modules = array();
		foreach($db["modules"] as $row)
		{
			if(! empty($row["site_page"]))
			{
				$modules[] = $row["name"];
			}
		}
		if($modules)
		{
			$site_ids = DB::query_result("SELECT GROUP_CONCAT(id SEPARATOR ',') FROM {site} WHERE module_name IN ('".implode("','", $modules)."')");
			if ($site_ids)
			{
				if($site_ids2 = DB::query_result("SELECT GROUP_CONCAT(element_id SEPARATOR ',') FROM {site_parents} WHERE parent_id IN (".$site_ids.")"))
				{
					$site_ids .= ",".$site_ids2;
				}
				DB::query("DELETE FROM {site} WHERE id IN (".$site_ids.")");
				DB::query("DELETE FROM {site_parents} WHERE element_id IN (".$site_ids.")");
				DB::query("DELETE FROM {rewrite} WHERE site_id IN (".$site_ids.");");
				$menu_ids = DB::query_result("SELECT GROUP_CONCAT(id SEPARATOR ',') FROM {menu} WHERE site_id IN ('".$site_ids."') OR module_name IN ('".implode("','", $modules)."')");
				if ($menu_ids)
				{
					DB::query("DELETE FROM {menu} WHERE id IN (".$menu_ids.")");
					$menu_child_ids = DB::query_result("SELECT GROUP_CONCAT(element_id SEPARATOR ',') FROM {menu_parents} WHERE parent_id IN (".$menu_ids.")");
					if ($menu_child_ids)
					{
						DB::query("DELETE FROM {menu_parents} WHERE element_id IN (".$menu_child_ids.")");
						DB::query("DELETE FROM {menu} WHERE id IN (".$menu_child_ids.")");
					}
					DB::query("DELETE FROM {menu_parents} WHERE element_id IN (".$menu_ids.")");
				}
			}
			DB::query("DELETE FROM {rewrite} WHERE module_name IN ('".implode("','", $modules)."')");
		}
		DB::query("DELETE FROM {modules} WHERE module_name='%h'", $module);
		$adminsites = array();
		if(! empty($db["adminsites"]))
		{
			foreach($db["adminsites"] as $row)
			{
				$adminsites[] = $row["rewrite"];
				if(! empty($row["children"]))
				{
					foreach($row["children"] as $r)
					{
						$adminsites[] = $r["rewrite"];
					}
				}
			}
			$admin_ids = DB::query_result("SELECT GROUP_CONCAT(id SEPARATOR ',') FROM {adminsite} WHERE rewrite IN ('".implode("','", $adminsites)."')");
			DB::query("DELETE FROM {adminsite} WHERE id IN (".$admin_ids.")");
			DB::query("DELETE FROM {adminsite_parents} WHERE element_id IN (".$admin_ids.")");
			DB::query("DELETE FROM {users_role_perm} WHERE rewrite IN ('".implode("','", $adminsites)."')");
		}
		DB::query("DELETE FROM {config} WHERE module_name='".$module."'");
		DB::query("DELETE FROM {config} WHERE name='".$module."'");
		DB::query("DELETE FROM {attachments} WHERE module_name='".$module."'");
		if(DB::query_result("SELECT id FROM {modules} WHERE module_name='rating' LIMIT 1"))
		{
			DB::query("DELETE FROM {rating} WHERE module_name='".$module."';");
		}
		if(DB::query_result("SELECT id FROM {modules} WHERE module_name='comments' LIMIT 1"))
		{
			DB::query("DELETE FROM {comments} WHERE module_name='".$module."' OR module_name='".$module."_category'");
		}
		if(DB::query_result("SELECT id FROM {modules} WHERE module_name='tags' LIMIT 1"))
		{
			DB::query("DELETE FROM {tags} WHERE module_name='".$module."'");
		}
		DB::query("DELETE FROM {log_note} WHERE module_name='".$module."'");

		$trash_ids = DB::query_result("SELECT GROUP_CONCAT(id SEPARATOR ',') FROM {trash} WHERE module_name='".$module."'");
		if ($trash_ids)
		{
			DB::query("DELETE FROM {trash} WHERE id IN (".$trash_ids.")");
			$trash_child_ids = DB::query_result("SELECT GROUP_CONCAT(element_id SEPARATOR ',') FROM {trash_parents} WHERE parent_id IN (".$trash_ids.")");
			if ($trash_child_ids)
			{
				DB::query("DELETE FROM {trash_parents} WHERE element_id IN (".$trash_child_ids.")");
			}
			DB::query("DELETE FROM {trash_parents} WHERE element_id IN (".$trash_ids.")");
		}
		Customization::inc('includes/files.php');
		$result = DB::query("SELECT name FROM {images} WHERE module_name='".$module."' OR  module_name='".$module."cat'");
		while($row = DB::fetch_array($result))
		{
			Files::delete_file(USERFILES.'/original/'.$row["name"]);
			Files::delete_file(USERFILES.'/small/'.$row["name"]);
		}
		DB::query("DELETE FROM {images} WHERE module_name='".$module."' OR  module_name='".$module."cat'");
		if(is_dir(ABSOLUTE_PATH.USERFILES.'/'.$module))
		{
			Files::delete_dir(USERFILES.'/'.$module);
		}
	}
}

/**
 * Адаптирует SQL запрос под текущее количество языковых версий сата
 *
 * @param string $str часть SQL-запроса
 * @return string
 */
function multilang($str)
{
	global $lang_ids;

	if(! $lang_ids)
		return;

	$result = '';

	$arg = func_get_args();
	$i = 0;

	foreach($lang_ids as $lang)
	{
		if (! isset($arg[$i]))
		{
			$arg[$i] = $arg[$i - 1];
		}
		$str = $arg[$i];
		$result .= str_replace('LANG', $lang, $str).' ';
		$i++;
	}
	return $result;
}