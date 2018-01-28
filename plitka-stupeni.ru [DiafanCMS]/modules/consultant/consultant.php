<?php
/**
 * On-line консультант
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

class Consultant extends Controller
{
	/**
	 * Шаблонная функция: on-line консультант
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/consultant/consultant.model.php');
		$model = new Consultant_model($this->diafan);
		$result = $model->show_block();
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'consultant', $result))
		{
			$this->diafan->_tpl->get('show_block', 'consultant', $result);
		}
	}
}