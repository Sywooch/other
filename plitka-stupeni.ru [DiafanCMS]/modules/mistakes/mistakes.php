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
 * Mistakes
 *
 * Контроллер модуля "Ошибка на сайте"
 */
class Mistakes extends Controller
{
	/**
	 * Шаблонная функция: ошибка на сайте
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$this->diafan->_tpl->get('show_block', 'mistakes', array());
	}
}