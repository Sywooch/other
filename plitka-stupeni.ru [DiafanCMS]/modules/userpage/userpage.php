<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Userpage
 *
 * Модуль "Страница пользователя"
 */
class Userpage extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$model = new Userpage_model($this->diafan);
		$this->result = $model->show();
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show_module()
	{
		$this->diafan->_tpl->get('show', 'userpage', $this->result);
	}
}
