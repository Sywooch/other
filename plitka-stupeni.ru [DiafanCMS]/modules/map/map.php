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
 * Map
 *
 * Контроллер модуля "Карта сайта"
 */
class Map extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$model = new Map_model($this->diafan);
		$this->result = $model->show_list();
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return boolean true
	 */
	public function show_module()
	{
		$this->diafan->_tpl->get('list', 'map', $this->result);
		return true;
	}
}