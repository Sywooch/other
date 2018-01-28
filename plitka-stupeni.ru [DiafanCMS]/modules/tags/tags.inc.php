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
 * Tags_inc
 *
 * Работа с тэгами
 */
class Tags_inc extends Model
{
	/**
	 * @var array имена тэгов
	 */
	public $cache;

	/**
	 * @var integer номер страницы тэгов
	 */
	public $site_id;

	/*
	 * @var boolean модуль "Теги" установлен
	 */
	private $installed = 'no_check';

	/**
	 * Выводит подключенные к элементу тэги
	 *
	 * @param integer $element_id номер элемента, к котором прикреплены теги
	 * @param strint $module_name название модуля
	 * @param integer $site_id страница сайта, к которой прикреплен элемент
	 * @return string|boolean false
	 */
	public function get($element_id = 0, $module_name = '', $site_id = 0)
	{
		if($this->installed === 'no_check')
		{
			$this->site_id = DB::query_result("SELECT id FROM {site} WHERE module_name='tags' AND [act]='1' AND block='0' LIMIT 1");
			if(! $this->site_id)
			{
				$this->installed = false;
			}
		}
		if(! $this->installed)
			return false;

		$module_name = ! $module_name ? $this->diafan->module : $module_name;
		$site_id = ! $site_id ? $this->diafan->cid : $site_id;
		$element_id = ! $element_id ? ($this->diafan->show ? $this->diafan->show : $this->diafan->cat) : $element_id;

		if (! $this->diafan->configmodules("tags", $module_name, $site_id) || ! $element_id)
			return false;
	
		$result = DB::query("SELECT n.[name], n.id FROM {tags_name} AS n"
		                    ." INNER JOIN {tags} AS t ON t.tags_name_id=n.id"
		                    ." WHERE t.module_name='%h' AND t.element_id='%d'"
		                    ." AND n.trash='0' AND t.trash='0'"
		                    ." GROUP BY n.id ORDER BY n.sort ASC",
		                    $module_name, $element_id);
		$rows = array();
		
		while ($row = DB::fetch_array($result))
		{
			$row["link"] = $this->diafan->_route->link($this->site_id, "tags", 0, $row["id"]);
			$rows[] = $row;
		}
		return $this->diafan->_tpl->get('get', 'tags', $rows);
	}
}