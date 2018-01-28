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
 * Referals
 *
 * Контроллер модуля "Коды РК"
 */
class Referals extends Controller
{
	/**
	 * Шаблонный тег <insert name="show_block" module="referals"
	 * [show_referal_id="показывать код реферальной ссылки"] [template="шаблон"]>:
	 * выводит код реферальной ссылки
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'show_referal_id', 'template');

		$show_referal_id  = (bool)$attributes["show_referal_id"];

		Customization::inc('modules/referals/referals.model.php');
		$model = new Referals_model($this->diafan);
		$result = $model->show_block($show_referal_id);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'referals', $result))
		{
			$this->diafan->_tpl->get('show_block', 'referals', $result);
		}
	}
}