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
 * Search_admin
 *
 * Работа с поисковым индексом
 */
class Search_admin extends Frame_admin
{
	/**
	* Вывод списка модулей, готовых к поисковому индексированию.
	* 
	* @return void
	*/
	public function show()
	{
		if(! empty($_REQUEST['action']))
		{
			if(empty($_REQUEST['ids']))
			{
				$this->diafan->redirect_js(URL);
			}
			if(empty($_GET['start']))
			{
				$this->delete_index($_REQUEST['ids']);
			}

			if($_REQUEST['action'] == "create_index")
			{
				$this->create_index($_REQUEST['ids']);
			}
			$this->diafan->redirect_js(URL . 'success1/');
		}

		$modules = array();
		$dir = opendir(ABSOLUTE_PATH."modules");
		while (($file = readdir($dir)) !== false)
		{
			if (! $file != '.' && $file != '..' && file_exists(ABSOLUTE_PATH.'modules/'.$file.'/'.$file.'.search.php')
				&& ($file == "site" || $row = DB::fetch_array(DB::query("SELECT id, title FROM {modules} WHERE module_name='%h' LIMIT 1", $file))))
			{
				$name = $this->diafan->_($file == "site" ? "Страницы сайта": $row["title"]);
				if(! $name)
				{
					$name = $file;
				}

				$modules[] = array(
					'module_name' => $file,
					'name'   => $name,
				);
			}
		}
		closedir($dir);

		echo '<form method="get" action=""><ul class="list">';
		foreach ($modules as $row)
		{
			echo '<li class="level_0"><div class="table_wrap"><table width="100%"><tr>
			<td class="checkbox"><input type="checkbox" value="'.$row["module_name"].'" name="ids[]"><td class="name">'.$row["name"].'</td>
			<td class="action_separator"><span></span></td>
			<td class="action_icon">&nbsp;<a href="?action=create_index&ids[]='.$row["module_name"].'">'.$this->diafan->_('Индексировать').'</a>&nbsp;</td>
			<td class="action_separator"><span></span></td>
			<td class="action_icon">&nbsp;<a href="?action=delete_index&ids[]='.$row["module_name"].'">'.$this->diafan->_('Удалить&nbsp;индекс').'</a>&nbsp;</td>

			</td></tr></table>
			</div></li>';
		}
		echo '</ul>

		<div class="group_action no_move">

		<table><tr>
		<td><input type="checkbox" id="select_all"></td>
		<td><span class="select_all">'.$this->diafan->_('Отметить все').'</span></td>
		<td><select name="action"><option value="create_index">'.$this->diafan->_('Индексировать').'</option><option value="delete_index">'.$this->diafan->_('Удалить&nbsp;индекс').'</option></select></td>
		<td><input type="submit" class="button" value="'.$this->diafan->_('Применить').'" id="group_actions_search"></td>
		</tr>
</table>
		</div>
		</form>';
	}

	/**
	* Создание поискового индекса.
	* 
	* @param array $modules массив названий модулей
	* 
	* @return void
	*/
	public function create_index($modules)
	{
		foreach($modules as $module_name)
		{
			if($module_name == 'site')
			{
				$this->create_index_for_site_pages();
			}
			else
			{
				$this->create_index_for_module_pages($module_name);
			}
		}
	}

	/**
	* Создание поискового индекса для страниц сайта.
	* 
	* @return void
	*/
	public function create_index_for_site_pages()
	{
		$element_ids = array();
		$result = DB::query("SELECT id FROM {site} WHERE [act]='1' AND trash='0' AND block='0'");

		while($row = DB::fetch_array($result))
		{
			$element_ids[] = $row['id'];
		}
		if(! empty($element_ids))
		{
			$params = array();

			$params['module_name'] = 'site';
			$params['config_module']['category']  = 0;
			$params['site'] =  1;
			Customization::inc('modules/search/admin/search.admin.inc.php');
			$search_admin_inc = new Search_admin_inc($this->diafan);
			$search_admin_inc->act('site', $element_ids, 1, $params);
		}
	}

	/**
	 * Создание поискового индекса для модуля.
	 * 
	 * @param string $module название модуля
	 * @return void
	 */
	public function create_index_for_module_pages($module)
	{
		Customization::inc('modules/search/admin/search.admin.inc.php');
		$search_admin_inc = new Search_admin_inc($this->diafan);
		$lang = _LANG ? _LANG : 0;
		$start = $this->diafan->get_param($_GET, 'start', 0, 2);
		$count = 500;
		$count_index = 0;
		$result = DB::query("SELECT id FROM {site} WHERE [act]='1' AND trash='0' AND module_name='%s'", $module);

		while ($row = DB::fetch_array($result))
		{
			$element_ids = array();
			$params = array();
			$params['module_name'] = $module;
			$params['config_module']['category']  = 0;
			$params['site'] =  $row['id'];

			$elements_result = DB::query_range("SELECT id FROM {%s} WHERE [act]='1' AND trash='0' AND site_id=%d", $module, $row['id'], $start, $count);

			while($element_row = DB::fetch_array($elements_result))
			{
				$element_ids[] = $element_row['id'];
				$count_index++;
			}
			if(! empty($element_ids))
			{
				$search_admin_inc->act($module, $element_ids, 1, $params);
			}
			
			if($this->diafan->configmodules ('cat', $module, $row['id'], $lang))
			{
				$element_ids = array();
				$params['config_module']['category']  = 1;
	
				$categories_result = DB::query_range("SELECT id FROM {%s} WHERE [act]='1' AND trash='0' AND
											   site_id=%d", $module.'_category', $row['id'], $start, $count);
	
				while($categories_row = DB::fetch_array($categories_result))
				{
					$element_ids[] = $categories_row['id'];
					$count_index++;
				}
				if(! empty($element_ids))
				{
					$search_admin_inc->act($module.'_category', $element_ids, 1, $params);
				}
			}
		}
		if($count_index)
		{
			$this->diafan->redirect_js(URL.'?action=create_index&start='.($start+$count).'&ids[]='.implode('&ids[]=', $_REQUEST['ids']));
		}
	}

	/**
	 * Удаление поискового индекса для выбранных модулей.
	 * 
	 * @param array $modules массив названий модулей
	 * @return void
	 */
	public function delete_index($modules)
	{
		// если отмечены все модули, просто чистим таблицы
		$all_delete = true;
		$dir = opendir(ABSOLUTE_PATH."modules");
		while (($file = readdir($dir)) !== false)
		{
			if (! $file != '.' && $file != '..' && file_exists(ABSOLUTE_PATH.'modules/'.$file.'/'.$file.'.search.php'))
			{
				if(! in_array($file, $modules) && ($file == "site" || DB::query_result("SELECT id FROM {modules} WHERE module_name='%h' LIMIT 1", $file)))
				{
					$all_delete = false;
					break;
				}
			}
		}
		closedir($dir);
		if($all_delete)
		{
			DB::query("TRUNCATE TABLE {search_index}");
			DB::query("TRUNCATE TABLE {search_keywords}");
			DB::query("TRUNCATE TABLE {search_results}");
			return;
		}

		$lang = _LANG ? _LANG : 1;
		$results = array();
		$keys = array();
		foreach($modules as $module)
		{
				$result = DB::query("SELECT id FROM {search_results} WHERE (table_name='%s' OR table_name='%s') AND lang_id=%d", $module, $module.'_category', $lang);
				while($row = DB::fetch_array($result))
				{
					$results[] = $row["id"];
				}
		}
		if($results)
		{
			$result = DB::query("SELECT DISTINCT i.keyword_id FROM {search_index} as i"
					." INNER JOIN {search_index} AS i2 ON i.keyword_id=i2.keyword_id"
					." WHERE i.result_id IN (".implode(",", $results).") GROUP BY i.keyword_id HAVING count(i2.keyword_id)<2");
			while($row = DB::fetch_array($result))
			{
				$keys[] = $row["keyword_id"];
			}
			DB::query("DELETE FROM {search_index} WHERE result_id IN (".implode(",", $results).")");
			DB::query("DELETE FROM {search_results} WHERE id IN (".implode(",", $results).")");
		}
		if($keys)
		{
			$query = "";
			$k = 0;
			foreach ($keys as $key)
			{
					if(! $query)
					{
						$query = "DELETE FROM {search_keywords} WHERE id IN (".$key;
					}
					else
					{
						$query .= ", ".$key;
					}
					$k++;
					if($k == 100)
					{
						DB::query($query.")");
						$query = '';
						$k = 0;
					}
			}
			if($query)
			{
				DB::query($query.")");
			}
		}
	}
}