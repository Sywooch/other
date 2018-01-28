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
 * Map_model
 *
 * Модель модуля "Карта сайта"
 */
class Map_model extends Model
{


	/**
	 * Генерирует данные для карты сайта
	 * 
	 * @return array
	 */
	public function show_list()
	{
		$this->map_parent_id();
		return $this->result;
	}

	/**
	* Формирует URL страниц сайта
	* 
	* @param integer $parent_id номер страницы-родителя
	* @param integer $margin отступ слева
	* @return boolean true
	*/
	private function map_parent_id($parent_id = 0, $margin = 0)
	{
		if ($parent_id != 0)
		{
			$margin += 10;
		}
		$result = DB::query(
				"SELECT s.id, s.[name], s.module_name FROM {site} AS s"
				.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
				." WHERE s.[act]='1' AND s.parent_id='%d' AND s.trash='0' AND s.map_no_show='0' AND s.block='0'"
				." AND (s.access='0'"
				.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				.")"
				." GROUP BY s.id ORDER BY s.sort ASC, s.id ASC",
				$parent_id
			);
		while ($row = DB::fetch_array($result))
		{ 
			$link = $this->diafan->_route->link($row["id"]);

			$this->result[] = array("margin" => $margin, "link" => $link, "name" => $row["name"]);
			if ($this->diafan->configmodules("cat", $row["module_name"], $row["id"]))
			{
				$this->map_module_category(0, $row["id"], $margin, $row["module_name"]);
			}
			else
			{
				//$this->map_module_element(0, $row["id"], $margin, $row["module_name"]);	
			}
			$this->map_parent_id($row["id"], $margin);
		}
		return true;
	}

	/**
	* Формирует URL страниц категорий модуля
	* 
	* @param integer $id номер родителя
	* @param integer $site_id номер страницы
	* @param integer $margin отступ слева
	* @param string $module название модуля
	* @return boolean true
	*/
	private function map_module_category($id, $site_id, $margin, $module)
	{
		$margin += 20;
		$result = DB::query(
			"SELECT c.id, c.[name], c.site_id FROM {".$module."_category} AS c"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='".$module."'" : "")
			." WHERE c.[act]='1' AND c.parent_id='%d' AND c.site_id=%d"
			." AND c.trash='0' AND c.map_no_show='0'"
			." AND (c.access='0'"
			.($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")"
			." GROUP BY c.id ORDER BY c.sort ASC, c.id ASC",
			$id, $site_id
		);
		if ($result)
		{
			while ($row = DB::fetch_array($result))
			{
				$link = $this->diafan->_route->link($row["site_id"], $module, $row["id"]);
				$this->result[] = array(
					"margin" => $margin,
					"link"   => $link,
					"name"   => $row["name"]
				);
				//$this->map_module_element($row["id"], $site_id, $margin, $module);
				$this->map_module_category($row["id"], $site_id, $margin, $module);
			}
		}
		return true;
	}

	/**
	* Формирует URL страниц элементов модуля
	* 
	* @param integer $id номер категории
	* @param integer $site_id номер страницы
	* @param integer $margin отступ слева
	* @param string $module название модуля
	* @return boolean true
	private function map_module_element($id, $site_id, $margin, $module)
	{
		$margin += 20;
		$cat_id = '';
		if ($this->diafan->configmodules("cat", $module, $site_id))
		{
			$cat_id = ", e.cat_id";
		}
		$result = DB::query(
			"SELECT e.id, e.[name], e.site_id".$cat_id." FROM {".$module."_category} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='".$module."'" : "")
			." WHERE e.[act]='1' AND e.site_id=%d".($id ? " AND cat_id='%d'" : "")
			." AND e.trash='0' AND e.map_no_show='0'"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")"
			." GROUP BY e.id ORDER BY e.sort ASC, e.id ASC",
			$site_id, $id
		);
		if ($result)
		{
			while ($row = DB::fetch_array($result))
			{
				if (empty($row["cat_id"]))
				{
					$row["cat_id"] = 0;
				}
				$link = $this->diafan->_route->link($row["site_id"], $module, $row["cat_id"], $row["id"]);
				$this->result[] = array(
					"margin" => $margin,
					"link"   => $link,
					"name"   => $row["name"]
				);
			}
		}
		return true;
	}
	*/
}