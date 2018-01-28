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
 * Menu
 *
 * Контроллер модуля "Меню"
 */
class Menu extends Controller
{
	/**
	 * Выводит контент модуля
	 * 
	 * @return boolean true
	 */
	public function show_module()
	{
		return true;
	}

	/**
	 * Шаблонная функция: блок меню
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes(
			$attributes, 'id', 'template',
			'tag_start_1', 'tag_end_1', 'tag_active_start_1', 'tag_active_end_1', 'tag_level_start_1',
			'tag_level_end_1', 'tag_active_child_start_1', 'tag_active_child_end_1', 'separator_1',
			'count_level'
		);

		$id = intval($attributes["id"]);

		Customization::inc('modules/menu/menu.model.php');
		$model = new Menu_model($this->diafan);
		$result = $model->show_block($id);
		if (! $result)
		{
			return false;
		}
		
		$result["attributes"] = $attributes;

		if ($attributes["template"] === "default")
		{
			$this->diafan->_tpl->get('show_block', 'menu', $result);
		}
		if ($attributes["template"] === "select" && !empty($result['menu_template']))
		{
			$this->diafan->_tpl->get($result['menu_template'], 'menu', $result);
		}
		elseif ($attributes["template"])
		{
			$this->diafan->_tpl->get('show_block_'.$attributes["template"], 'menu', $result);
		}
		else
		{
			$this->diafan->_tpl->get('show_menu', 'menu', $result);
		}
	}
}