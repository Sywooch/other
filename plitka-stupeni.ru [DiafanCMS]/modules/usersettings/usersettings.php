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
 * Usersettings
 *
 * Контроллер модуля "Настройки аккаунта"
 */
class Usersettings extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		if(! $this->diafan->_user->id)
		{
			include_once(ABSOLUTE_PATH.'includes/403.php');
		}
		$model = new Usersettings_model($this->diafan);
		$this->result = $model->form();
		$this->result = $model->order();
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	function show_module()
	{
		$this->diafan->_tpl->get('form', 'usersettings', $this->result);

		$this->diafan->_tpl->get('order', 'usersettings', $this->result);
	}	
}