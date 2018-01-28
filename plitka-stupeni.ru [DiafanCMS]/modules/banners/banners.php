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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Banners
 *
 * Контроллер модуля "Баннеры"
 */
class Banners extends Controller
{
	/**
	 * Шаблонная функция: блок баннера
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return boolean
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'id', 'count', 'sort', 'cat_id', 'template');
		
		$id   = intval($attributes["id"]);
		$sort = ($attributes["sort"] ? $attributes["sort"] : 'date');
		if($attributes["count"] === "all")
		{
			$count = "all";
		}
		else
		{
			$count   = intval($attributes["count"]);
			if($count < 1)
			{
				$count = 1;
			}
		}
		$cat_id  = intval($attributes["cat_id"]);

		Customization::inc('modules/banners/banners.model.php');
		$model = new Banners_model($this->diafan);
		$result = $model->show_block($id, $count, $sort, $cat_id);
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'banners', $result))
		{
			$this->diafan->_tpl->get('show_block', 'banners', $result);
		}
		return true;
	}
}