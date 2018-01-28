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
 * Reminding
 *
 * Контроллер модуля "Восстановление пароля"
 */
class Reminding extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$model = new Reminding_model($this->diafan);
		if(! empty($_GET["action"]))
		{
			switch($_GET["action"])
			{
				case "change_password":
					$this->result = $model->form_change_password();
					break;
				case "success":
					$this->result = $model->success();
					break;
				default:
					include ABSOLUTE_PATH.'includes/404.php';
			}
		}
		else
		{
			$this->result = $model->form_mail();
		}
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return boolean
	 */
	public function show_module()
	{
		if(! empty($_GET["action"]))
		{
			switch($_GET["action"])
			{
				case "change_password":
					$this->diafan->_tpl->get('form_change_password', 'reminding', $this->result);
					break;
				case "success":
					$this->diafan->_tpl->get('success', 'reminding', $this->result);
					break;
			}
		}
		else
		{
			$this->diafan->_tpl->get('form_mail', 'reminding', $this->result);
		}

		return true;
	}
}