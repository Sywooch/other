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
 * Registration
 *
 * Контроллер модуля "Регистрация"
 */
class Registration extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		if($this->diafan->_user->id)
		{
			$this->diafan->redirect();
		}
		$model = new Registration_model($this->diafan);
		if(! empty($_GET["action"]))
		{
			switch($_GET["action"])
			{
				case "act":
					$this->result = $model->act();
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
			$this->result = $model->form();
		}
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return boolean
	 */
	function show_module()
	{
		if(! empty($_GET["action"]))
		{
			switch($_GET["action"])
			{
				case "act":
					$this->diafan->_tpl->get('act', 'registration', $this->result);
					break;
				case "success":
					$this->diafan->_tpl->get('success', 'registration', $this->result);
					break;
			}
		}
		else
		{
			$this->diafan->_tpl->get('form', 'registration', $this->result);
		}
		return true;
	}

	/**
	 * Шаблонная функция: форма авторизации
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return boolean
	 */
	function show_login($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/registration/registration.model.php');
		$model = new Registration_model($this->diafan);
		$result = $model->show_login();

		if($attributes["template"])
		{
			$text = $this->diafan->_tpl->get('show_login_'.$attributes["template"], 'registration', $result);
			if($text)
			{
				echo $text;
			}
			else
			{
				echo $this->diafan->_tpl->get('show_login', 'registration', $result);
			}
		}
		else
		{
			echo $this->diafan->_tpl->get('show_login', 'registration', $result);
		}
		return true;
	}  	
}