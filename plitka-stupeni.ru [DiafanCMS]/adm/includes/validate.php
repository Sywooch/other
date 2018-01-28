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
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Validate_admin
 *
 * Валидация данных перед сохранением
 */
class Validate_admin extends Diafan
{
	/**
	 * @var Validate_functions_admin функции валидации полей
	 */
	public $_functions;

	/**
	 * @var array массив результатов валидации
	 */
	public $result;

	/**
	 * Вызывает функции валидации полей
	 *
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		if(! $this->_functions)
		{
			Customization::inc("adm/includes/validate_functions.php");
			$this->_functions = new Validate_functions_admin($this->diafan);
		}

		if (is_callable(array(&$this->_functions, $name)))
		{
			return call_user_func_array(array(&$this->_functions, $name), $arguments);
		}
		else
		{
			return 'fail_function';
		}
	}

	/**
	 * Проверяет данные
	 *
	 * @return void
	 */
	public function validate()
	{
		// Проверяет, пришел ли запрос из формы добавления/редактирования
		if (empty( $_POST["save_post"] ))
		{
			echo 'ERROR_POST';
			return;
		}

		// Проверка прав на сохранение
		if (! $this->diafan->_user->roles('edit', $this->diafan->rewrite))
		{
			echo 'ERROR_ROLES';
			return;
		}
		if (!$this->diafan->_user->checked)
		{
			echo 'ERROR_HASH';
			return;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();

		Customization::inc('includes/validate.php');
		foreach ($this->diafan->variables as $title => $variable_table)
		{
			foreach ($variable_table as $key => $type_value)
			{
				if(is_array($type_value))
				{
					if(! empty($type_value["disabled"]))
					{
						continue;
					}
					$type_value = $type_value["type"];
				}
				else
				{
					$type_value = $type_value;
				}
	
				$func = 'validate'. ( $this->diafan->config("config") ? '_config' : '' ).'_variable_' . str_replace('-', '_', $key);
				if (call_user_func_array (array(&$this->diafan, $func), array()) !== 'fail_function')
				{
					continue;
				}
				$this->diafan->validate_variable($key, $type_value);
			}
		}

		if(empty($this->result["errors"]))
		{
			$this->result["success"] = true;
		}

		include_once ABSOLUTE_PATH . 'plugins/json.php';
		echo to_json($this->result);
		exit;
	}

	/**
	 * Подготавливает новые значения для сохранения
	 *
	 * @return boolean true
	 */
	public function validate_variable($key, $type)
	{
		if(empty($_POST[$key]))
			return;

		switch($type)
		{
			case 'module':
				if (file_exists(ABSOLUTE_PATH . 'modules/' . $key . '/admin/' . $key . '.admin.inc.php'))
				{
					Customization::inc('modules/' . $key . '/admin/' . $key . '.admin.inc.php');
					$func = 'validate' . ( $this->diafan->config("config") ? '_config' : '' );
					$class = ucfirst($key) . '_admin_inc';
					if (method_exists($class, $func))
					{
						$module_class = new $class($this->diafan);
						call_user_func_array (array(&$module_class, $func), array());
					}
				}
				break;

			case 'password':
				$this->diafan->set_error($key, Validate::password($_POST[$key]));
				break;

			case 'email':
				$this->diafan->set_error($key, Validate::mail($_POST[$key]));
				break;

			case 'date':
				$this->diafan->set_error($key, Validate::date($_POST[$key]));
				break;

			case 'datetime':
				$this->diafan->set_error($key, Validate::datetime($_POST[$key]));
				break;

			case 'floattext':
				$this->diafan->set_error($key, Validate::floattext($_POST[$key]));
				break;

			case 'numtext':
				$this->diafan->set_error($key, Validate::numtext($_POST[$key]));
				break;
		}
	}

	/**
	 * Запоминает найденную ошибку
	 *
	 * @return void
	 */
	public function set_error($key, $value)
	{
		if($value)
		{
			$this->result["errors"][$key] = $this->diafan->_($value);
		}
	}
}