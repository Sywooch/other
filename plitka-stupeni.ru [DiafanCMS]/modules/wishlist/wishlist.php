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
 * Wishlist
 *
 * Контроллер модуля "Лист пожеланий"
 */
class Wishlist extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->diafan->hide_previous_next = true;

		$model = new Wishlist_model($this->diafan);
		$this->result = $model->form();
		$this->diafan->timeedit = time();
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return boolean true
	 */
	public function show_module()
	{
		$this->diafan->_tpl->get('form', 'wishlist', $this->result);
		return true;
	}
}