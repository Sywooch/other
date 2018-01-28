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
 * Frame_admin
 *
 * Каркас административной части
 */
class Frame_admin extends Diafan
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table;

	/**
	 * @var array настройки отображения
	 */
	public $config = array();

	/**
	 * @var array варианты значений переменной с типом список, которые берутся из таблицы
	 */
	public $select;

	/**
	 * @var array варианты значений переменной с типом список
	 */
	public $select_arr;

	/**
	 * @var array категории
	 */
	public $categories;

	/**
	 * @var boolean существуют категории
	 */
	public $not_empty_categories;

	/**
	 * @var array разделы сайта, к которым прикреплен модуль
	 */
	public $sites;

	/**
	 * @var boolean разделов сайта больше одного
	 */
	public $not_empty_site;

	/**
	 * @var array поля таблицы
	 */
	public $variables;

	/**
	 * @var string SQL-условия для списка
	 */
	public $where;

	/**
	 * @var string контент, сформированный модулем
	 */
	public $module_contents;

	/**
	 * @var array параметры, переданные методом GET
	 */
	public $get_nav_params;

	/**
	 * @var string параметры, переданные методом GET
	 */
	public $get_nav;

	/**
	 * @var integer общее количество элементов
	 */
	public $count;

	/**
	 * @var object экземпляр класса действия
	 */
	private $action_object;

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'name',
		'text' => ''
	);

	/**
	 * @var object экземпляр класса представления
	 */
	private $_theme;

	/**
	 * Возвращает переменные, определенные в файлах действий
	 *
	 * @return mixed
	 */
	public function __get($name)
	{
		return $this->action_object->$name;
	}

	/**
	 * Вызывает методы, определенные в файлах действий
	 *
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		if (is_callable(array(&$this->action_object, $name)))
		{
			return call_user_func_array(array(&$this->action_object, $name), $arguments);
		}
		if (is_callable(array(&$this->_theme, $name)))
		{
			return call_user_func_array(array(&$this->_theme, $name), $arguments);
		}
		return 'fail_function';
	}

	/**
	 * Инициализация модуля
	 *
	 * @return void
	 */
	public function init()
	{
		Customization::inc("adm/includes/theme.php");

		$this->diafan->prepare_config();
		$this->diafan->set_get_nav();
		if(! empty($_POST["group_action"]) && ! empty($_POST["action"]))
		{
			$_SESSION["group_action"][$this->diafan->rewrite] = $_POST["action"];
		}

		if (!empty( $_REQUEST["action"] ))
		{
			// подключаем обработчик запросов модуля
			if (!empty( $_REQUEST["module"] ))
			{
				$module = preg_replace('/[^a-z0-9_]+/', '', $_REQUEST["module"]);
				if (file_exists(ABSOLUTE_PATH . 'modules/' . $module . '/admin/' . $module . '.admin.ajax.php'))
				{
					Customization::inc("adm/includes/ajax.php");

					Customization::inc('modules/' . $module . '/admin/' . $module . '.admin.ajax.php');
					$this->diafan->include_class = ucfirst($module) . '_admin_ajax';
					$this->action_object = new Ajax_admin($this->diafan);
					$this->diafan->ajax();
					exit;
				}
			}
			switch ($_REQUEST["action"])
			{
				case 'trash':
				case 'delete':
					Customization::inc("adm/includes/del.php");
					$this->action_object = new Del_admin($this->diafan);
					$this->diafan->del();
					return;

				case 'restore':
					Customization::inc("adm/includes/del.php");
					$this->action_object = new Del_admin($this->diafan);
					$this->diafan->restore();
					return;

				case 'unblock':
				case 'block':
					Customization::inc("adm/includes/act.php");
					$this->action_object = new Act_admin($this->diafan);
					$this->act();
					return;

				case 'move':
					Customization::inc("adm/includes/move.php");
					$this->action_object = new Move_admin($this->diafan);
					$this->move();
					return;

				case 'move_parent':
					Customization::inc("adm/includes/move.php");
					$this->action_object = new Move_admin($this->diafan);
					$this->move_parent();
					return;

				case 'move_page':
					Customization::inc("adm/includes/move.php");
					$this->action_object = new Move_admin($this->diafan);
					$this->move_page();
					return;

				case 'sort':
					Customization::inc("adm/includes/ajax.php");
					$this->action_object = new Ajax_admin($this->diafan);
					$this->sort();
					return;

				case 'parent':
					Customization::inc("adm/includes/ajax.php");
					$this->action_object = new Ajax_admin($this->diafan);
					$this->parent_id();
					return;

				case 'element':
					Customization::inc("/adm/includes/ajax.php");
					$this->action_object = new Ajax_admin($this->diafan);
					$this->group_cat_id();
					return;

				case 'change_theme':
					Customization::inc("adm/includes/ajax.php");
					$this->action_object = new Ajax_admin($this->diafan);
					$this->change_theme();
					return;

				case 'change_nastr':
					Customization::inc("adm/includes/ajax.php");
					$this->action_object = new Ajax_admin($this->diafan);
					$this->change_nastr();
					return;

				case 'fast_save':
					Customization::inc("adm/includes/ajax.php");
					$this->action_object = new Ajax_admin($this->diafan);
					$this->fast_save();
					return;

				case 'validate':
					Customization::inc("adm/includes/validate.php");
					$this->action_object = new Validate_admin($this->diafan);
					$this->validate();
					return;

				case 'show_rel_elements':
					$this->_theme = new Theme_admin($this->diafan);
				case 'rel_elements':
				case 'delete_rel_element':
					Customization::inc("adm/includes/rel_elements.php");
					$this->action_object = new Rel_elements_admin($this->diafan);
					$this->ajax();
			}
		}

		if ($this->diafan->save || $this->diafan->savenew)
		{
			Customization::inc("adm/includes/save.php");
			$this->action_object = new Save_admin($this->diafan);
			if(!empty( $_POST["id"]))
			{
				$this->diafan->save = $this->diafan->get_param($_POST, "id", 0, 2);
				$this->diafan->savenew = 0;
			}
			if($this->diafan->savenew)
			{
				$this->diafan->save_new();
			}
			else
			{
				$this->diafan->save();
			}
			return;
		}
		$this->_theme = new Theme_admin($this->diafan);

		// если конфигурация, то открывается форма редактирования
		$this->diafan->config("only_edit", $this->diafan->config("config") || $this->diafan->config("only_edit"));

		if ($this->diafan->edit || $this->diafan->addnew || $this->diafan->config("only_edit"))
		{
			if (! $this->diafan->edit)
			{
				$this->diafan->edit = 1;
			}
			Customization::inc("adm/includes/edit.php");
			$this->action_object = new Edit_admin($this->diafan);
			ob_start();
			$this->edit();
			$this->module_contents = ob_get_contents();
			ob_end_clean();
		}
		else
		{
			Customization::inc("adm/includes/show.php");
			$this->action_object = new Show_admin($this->diafan);
			if($this->diafan->_user->id)
			{
				if ($this->diafan->ajax && $this->diafan->ajax == 'expand')
				{
					$this->ajax_expand();
				}
				ob_start();
				$this->prepare_variables();
				$this->show();
				$this->module_contents = ob_get_contents();
				ob_end_clean();
			}
		}
		$this->show_theme();
	}

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config(){}

	/**
	 * Возвращает, назначает информацию о поле
	 *
	 * @param string $key название переменной
	 * @param string $type_info тип информации
	 * @param mixed $value
	 * @return mixed
	 */
	public function variable($key = '', $type_info = 'type', $value = NULL)
	{
		$key = $key ? $key : $this->diafan->key;

		foreach ($this->variables as $title => $arr)
		{
			if (! empty($this->variables[$title][$key]))
			{
				$res = $arr[$key];
				if(is_array($res))
				{
					if($value !== NULL)
					{
						$this->variables[$title][$key][$type_info] = $value;
						return;
					}
					return ! empty($res[$type_info]) ? $res[$type_info] : false;
				}
				else
				{
					if($value !== NULL)
					{
						$this->variables[$title][$key]['type'] = $value;
						return;
					}
					if($type_info == 'type')
					{
						return $res;
					}
					else
					{
						return false;
					}
				}
				break;
			}
		}
		return NULL;
	}

	/**
	 * Удаляет переменную из списка полей
	 *
	 * @return void
	 */
	public function variable_unset($key)
	{
		foreach ($this->variables as $title => $arr)
		{
			if (! empty($this->variables[$title][$key]))
			{
				unset($this->variables[$title][$key]);
			}
		}
	}

	/**
	 * Возвращает название поля
	 *
	 * @param string $key название переменной
	 * @return string
	 */
	public function variable_name($key = '')
	{
		$key = $key ? $key : $this->diafan->key;

		foreach ($this->variables as $title => $arr)
		{
			if (! empty($this->variables[$title][$key]))
			{
				$res = $arr[$key];
				if(is_array($res) && ! empty($res["name"]))
				{
					return $this->diafan->_($res["name"]);
				}
				break;
			}
		}
		return '';
	}

	/**
	 * Определяет является ли поле мультиязычным
	 *
	 * @param string $key название переменной
	 * @return boolean
	 */
	public function variable_multilang($key = '')
	{
		if(empty($this->variables))
		{
			return false;
		}
		$key = ($key ? $key : $this->diafan->key);
		foreach ($this->variables as $title => $arr)
		{
			if (! empty($arr[$key]))
			{
				$res = $arr[$key];
				if(is_array($res) && ! empty($res["multilang"]))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		return false;
	}

	/**
	 * Возвращает, назначает атрибут disabled для переменной
	 *
	 * @param string $key название переменной
	 * @param boolean $value значение атрибута
	 * @return boolean
	 */
	public function variable_disabled($key = '', $value = NULL)
	{
		if(empty($this->variables))
		{
			return false;
		}
		$key = ($key ? $key : $this->diafan->key);
		foreach ($this->variables as $title => $arr)
		{
			if (! empty($arr[$key]))
			{
				$res = $arr[$key];
				if(is_array($res) && ! empty($res["disabled"]))
				{
					if($value === false)
					{
						$this->variables[$title][$key]['disabled'] = false;
					}
					return true;
				}
				else
				{
					if($value === true)
					{
						$this->variables[$title][$key]['disabled'] = true;
					}
					return false;
				}
			}
		}
		return false;
	}

	/**
	 * Возвращает определена ли переменная в списке полей
	 *
	 * @param string $key название переменной
	 * @return boolean
	 */
	public function is_variable($key)
	{
		if(! empty($this->variables))
		{
			foreach ($this->variables as $title => $arr)
			{
				if (! empty($this->variables[$title][$key]))
				{
					return true;
				}
			}
		}
		return false;
	}

	/**
	 * Определяет включена ли настройка отображения модуля или включает/выключает настройку
	 *
	 * @param string $name название настройки
	 * @param boolean $value настройка включена/выключена
	 * @return boolean
	 */
	public function config($key, $value = NULL)
	{
		if($value !== NULL)
		{
			if($value)
			{
				$this->config[] = $key;
			}
			elseif (in_array($key, $this->config))
			{
				unset($this->config[array_search($key, $this->config)]);
			}
			return true;
		}
		if (in_array($key, $this->config))
		{
			return true;
		}
		return false;
	}

	/**
	 * Возвращает список значений или определяет его
	 *
	 * @param string $name название поля
	 * @param string|array|boolean false $key ключ значения, массив значений или флаг удаления списка значений
	 * @param string|boolean false $value значение или флаг удаления значения
	 * @return mixed
	 */
	public function select_arr($name, $key = 'NULL', $value = NULL)
	{
		if($key !== 'NULL')
		{
			$select_arr = $this->diafan->select_arr;
			if($key === false)
			{
				if(isset($select_arr[$name]))
				{
					unset($select_arr[$name]);
				}
			}
			elseif(is_array($key))
			{
				$select_arr[$name] = $key;
			}
			elseif($value)
			{
				if($key === "-")
				{
					$key = "";
				}
				$select_arr[$name][$key] = $value;
			}
			$this->diafan->select_arr = $select_arr;
		}
		if($key !== 'NULL')
		{
			if($key === "-")
			{
				$key = "";
			}
			if(! empty($this->diafan->select_arr[$name][$key]))
			{
				return $this->diafan->select_arr[$name][$key];
			}
			else
			{
				return false;
			}
		}
		else
		{
			if(! empty($this->diafan->select_arr[$name]))
			{
				return $this->diafan->select_arr[$name];
			}
			else
			{
				return false;
			}
		}
		return false;
	}

	/**
	 * Определяет строку с GET переменными
	 *
	 * @return void
	 */
	public function set_get_nav()
	{
		$get_nav_params = $this->diafan->get_nav_params;
		if (!empty( $_GET["search_name"] ))
		{
			$get_nav_params["search_name"] = $this->diafan->get_param($_GET, "search_name", '', 1);
			$this->diafan->get_nav .= ( $this->diafan->get_nav ? '&amp;' : '?' ) . 'search_name=' . $get_nav_params["search_name"];
			$this->diafan->where .= " AND ".($this->diafan->variable_multilang("name") ? "[name]" : "name")." LIKE '%%" . str_replace(array("'", "%"), array("\\'", "%%"), $get_nav_params["search_name"]) . "%%'";
		}
		$this->diafan->get_nav_params = $get_nav_params;
	}
}