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
 * Menu_model
 *
 * Модель модуля "Меню"
 */
class Menu_model extends Model
{
	/**
	 * Генерирует данные для шаблонной функции: блок меню
	 *
	 * @param integer $id номер меню
	 * @return array
	 */
	public function show_block($id)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
				"name"    => "block",
				"id"      => $id,
				"lang_id" => _LANG,
				"time"    => $time,
				"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
			);

		if (! $this->result = $this->diafan->_cache->get($cache_meta, "menu"))
		{
			if (! $id)
			{
				$id = 1;
			}
			$row_menu = DB::fetch_array(DB::query(
					"SELECT m.[name], m.show_all_level, m.hide_parent_link, m.show_title, m.current_link, m.only_image, m.menu_template FROM {menu_category} AS m"
					.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=m.id AND a.module_name='menu'" : "")
					." WHERE m.id=%d AND m.[act]='1' AND m.trash='0'"
					." AND (m.access='0'"
					.($this->diafan->_user->id ? " OR m.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
					.") LIMIT 1",
					$id
				));
			
			$row_menu_category_site_rel = DB::query("SELECT site_id FROM {menu_category_site_rel} WHERE element_id=%d", $id);
			while($row = DB::fetch_array($row_menu_category_site_rel))
			{
			    $this->result['menu_category_site_rel'][] = $row['site_id'];
			}
			if (! $row_menu)
			{
				return false;
			}
			if ($row_menu["show_title"])
			{
				$this->result["name"] = $row_menu["name"];
			}
			$this->result["show_all_level"]   = $row_menu["show_all_level"];
			$this->result["hide_parent_link"] = $row_menu["hide_parent_link"];
			$this->result["current_link"]     = $row_menu["current_link"];
			$this->result["only_image"]     = $row_menu["only_image"];
			$this->result["menu_template"]     = $row_menu["menu_template"];
			$this->result["rows"] = array();

			$result = DB::query(
					"SELECT m.id, m.[name], m.module_name, m.site_id, m.module_cat_id, m.element_id, m.parent_id, m.othurl FROM {menu} AS m"
					.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON (a.element_id > 0 AND a.element_id=m.element_id OR a.element_id=0 AND a.cat_id > 0 AND a.cat_id=m.module_cat_id OR a.module_name='site' AND a.element_id=m.site_id) AND a.module_name=m.module_name" : "")
					." WHERE m.cat_id=%d AND m.[act]='1' AND m.trash='0'"
					." AND m.date_start<=%d AND (m.date_finish=0 OR m.date_finish>=%d)"
					." AND (m.access='0'"
					.($this->diafan->_user->id ? " OR m.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
					.")"
					." ORDER BY m.sort ASC", 
					$id, $time, $time
				);
			while ($row = DB::fetch_array($result))
			{
				if ($row["module_name"] == "site")
				{
					$row["link"] = $this->diafan->_route->link($row["site_id"]);
				}
				else
				{
					if ($row["module_cat_id"] && ! $this->diafan->configmodules("cat", $row["module_name"], $row["site_id"]))
					{
						continue;
					}
					$row["link"] = $this->diafan->_route->link($row["site_id"], $row["module_name"], $row["module_cat_id"], $row["element_id"]);
				}
				if($this->diafan->configmodules("images", "menu"))
				{
					$images = $this->diafan->_images->get('large', $row["id"], 'menu', 0, $row["name"], 0, false, 1);
					$row["img"] = $images ? $images[0] : '';
				}
				
				if(!empty($row['img']) && !empty($this->result["only_image"]))
				{
				    $row['name'] = '';
				}
				$row["active"] = false;
				$row["active_child"] = false;
				$this->result["rows"][$row["parent_id"]][] = $row;
			}
			$this->diafan->_cache->save($this->result, $cache_meta, "menu");
		}

		if(!empty($this->result['menu_category_site_rel']) && ! in_array($this->diafan->cid, $this->result['menu_category_site_rel']))
		{
		    return false;
		}
		$this->result["parent_id"] = 0;
		$this->result["level"] = 1;

		$this->menu_active_chain();

		return $this->result;
	}

	/**
	 * Выделяет пункты меню активной цепи (текущая страница и ее родители)
	 *
	 * @return boolean true
	 */
	private function menu_active_chain()
	{
		$current_link = $this->diafan->_route->current_link(array('page'));
		$current_link_find = false;
		$parents = array();
		foreach ($this->result["rows"] as $parent_id => $rows)
		{
			foreach ($rows as $i => $row)
			{
				$this->result["rows"][$parent_id][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'menu', _LANG);
				if (empty($row["othurl"]) && $row["link"] == $current_link)
				{
					$this->result["rows"][$parent_id][$i]["active"] = true;
					$current_link_find = $row["id"];
				}
				$parents[$row["id"]] = $row["parent_id"];
			}
		}
		if (! $current_link_find)
		{
			foreach ($this->result["rows"] as $parent_id => $rows)
			{
				foreach ($rows as $i => $row)
				{
					if ($row["element_id"] && $row["site_id"] == $this->diafan->cid && $row["element_id"] == $this->diafan->show)
					{
						$this->result["rows"][$parent_id][$i]["active_child"] = true;
						$current_link_find = $row["id"];
						continue;
					}
				}
				if ($current_link_find)
					continue;
			}
		}
		if (! $current_link_find)
		{
			foreach ($this->result["rows"] as $parent_id => $rows)
			{
				foreach ($rows as $i => $row)
				{
					if (! $row["element_id"] && $row["module_cat_id"] && $row["site_id"] == $this->diafan->cid && $row["module_cat_id"] == $this->diafan->cat)
					{
						$this->result["rows"][$parent_id][$i]["active_child"] = true;
						$current_link_find = $row["id"];
						continue;
					}
				}
				if ($current_link_find)
					continue;
			}
		}
		if (! $current_link_find)
		{
			foreach ($this->result["rows"] as $parent_id => $rows)
			{
				foreach ($rows as $i => $row)
				{
					if ($row["module_name"] == 'site' && $row["site_id"] == $this->diafan->cid)
					{
						$this->result["rows"][$parent_id][$i]["active_child"] = true;
						$current_link_find = $row["id"];
						continue;
					}
				}
				if ($current_link_find)
					continue;
			}
		}
		if ($current_link_find)
		{
			$parent_id = $parents[$current_link_find];
			while ($parent_id > 0)
			{
				$id = $parent_id;
				$parent_id = 0; 
				if(array_key_exists($id,$parents)) {
				    $parent_id = $parents[$id];
				    foreach ($this->result["rows"][$parent_id] as $i => $row)
				    {
					    if ($row["id"] == $id)
					    {
						    $this->result["rows"][$parent_id][$i]["active_child"] = true;
						    continue;
					    }
				    }
				}
				
			}
		}
		return true;
	}
}
