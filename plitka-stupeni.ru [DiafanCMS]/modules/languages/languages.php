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
 * Languages
 *
 * Контроллер модуля "Языки сайта"
 */
class Languages extends Controller
{
	/**
	 * Шаблонная функция: Выводит блок ссылок на альтернативные языковые версии сайта
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/languages/languages.model.php');
		$model = new Languages_model($this->diafan);
		$result = $model->show_block();
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'languages', $result))
		{
			$this->diafan->_tpl->get('show_block', 'languages', $result);
		}
	}
}