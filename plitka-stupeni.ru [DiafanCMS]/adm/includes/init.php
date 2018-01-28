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

class Init_admin extends Core
{
	/**
	 * @var integer переменная, передаваемая в URL: номер редактируемого элемента
	 */
	public $edit;

	/**
	 * @var integer переменная, передаваемая в URL: номер сохраняемого элемента
	 */
	public $save;

	/**
	 * @var integer переменная, передаваемая в URL: сохранить новый элемент (1)
	 */
	public $savenew;

	/**
	 * @var integer переменная, передаваемая в URL: номер элемента раскрытия каталога вложенности
	 */
	public $parent;

	/**
	 * @var integer переменная, передаваемая в URL: номер системного сообщения
	 */
	public $error;

	/**
	 * @var integer переменная, передаваемая в URL: добавление элемента (1)
	 */
	public $addnew;

	/**
	 * @var integer переменная, передаваемая в URL: номер категории
	 */
	public $cat;

	/**
	 * @var integer переменная, передаваемая в URL: номер страницы
	 */
	public $site;

	/**
	 * @var integer номер страницы
	 */
	public $page;

	/**
	 * @var string ЧПУ текущей страницы
	 */
	public $rewrite;

	/**
	 * @var string модуль текущей страницы
	 */
	public $module;

	/**
	 * @var string название подключаемой функции
	 */
	public $action;

	/**
	 * @var string подключаемый класс
	 */
	public $include_class;

	/**
	 * @var integer номер ошибки
	 */
	public $err;

	/**
	 * @var integer номер
	 */
	public $done;

	/**
	 * @var integer номер
	 */
	public $success;

	/**
	 * @var array переменные, передаваемые в URL
	 */
	public $rewrite_variable_names = array ( 'edit', 'savenew', 'save', 'addnew', 'site', 'cat', 'parent', 'page', 'error', 'success' );
	public $ajax;

	/**
	 * @var integer номер текущей страницы
	 */
	public $cid;

	/**
	 * @var string заголовок текущей страницы
	 */
	public $name;

	/**
	 * @var string ссылка на документацию для текущей страницы
	 */
	public $docs;

	/**
	 * @var integer номер страницы-родителя
	 */
	public $parent_id;

	/**
	 * @var array модуль текущего исполняемого файла
	 */
	public $current_module;

	/**
	 * @var User работа с пользователями
	 */
	public $_user;

	/**
	 * @var Cache кэширование
	 */
	public $_cache;

	/**
	 * @var Route ЧПУ
	 */
	public $_route;

	/**
	 * @var Template шаблоны
	 */
	public $_tpl;

	/**
	 * @var Frame_admin каркас
	 */
	public $_frame;

	/**
	 * @var array объекты модулей
	 */
	private $_objects;

	/**
	 * Подключает вспомогательные модули, если они не подключены
	 *
	 * @return boolean true
	 */
	public function __get($name)
	{
		if (!isset( $this->_objects[$name] ))
		{
			// подключаем обработчик запросов модуля
			if (substr($name, 0, 1) == '_')
			{
				$module = substr($name, 1);
				if (file_exists(ABSOLUTE_PATH . 'modules/' . $module . '/' . $module . '.inc.php'))
				{
					Customization::inc('includes/model.php');
					Customization::inc('modules/' . $module . '/' . $module . '.inc.php');
					$class = ucfirst($module) . '_inc';
					$this->_objects[$name] = new $class( $this );
				}
			}
			else
			{
				return $this->_frame->$name;
			}
		}
		return $this->_objects[$name];
	}

	/**
	 * Вызывает методы, определенные в файлах действий
	 *
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		return call_user_func_array(array(&$this->_frame, $name), $arguments);
	}

	/**
	 * Инициализирует генерирование страницы
	 *
	 * @return boolean true
	 */
	public function init()
	{
		Customization::inc('includes/session.php');
		Session::prepare();

		Customization::inc('includes/user.php');
		$this->_user = new User();

		Customization::inc('includes/route.php');
		$this->_route = new Route( $this );

		Customization::inc('includes/template.php');
		$this->_tpl = new Template( $this );

		Dev::set_profiling();

		Session::init();

		$this->include_other_file();

		Customization::inc('includes/cache.php');
		$this->_cache = new Cache;
		$this->magic_quote_off();

		define( 'BASE_PATH', "http://" . $_SERVER["HTTP_HOST"] . "/" . ( REVATIVE_PATH ? REVATIVE_PATH . '/' : '' ) );

		require_once(ABSOLUTE_PATH.'plugins/IDNA.php');
		$IDN = new idna_convert(array('idn_version' => '2008')); 
		$domain = $IDN->decode($_SERVER["HTTP_HOST"]);
		define('BASE_URL', ($domain ? $domain : $_SERVER["HTTP_HOST"]) . ( REVATIVE_PATH ? '/' . REVATIVE_PATH : '' ) );

		$this->get_languages_array();
		$this->get_user();

		//Gzip::init_gzip();

		$this->prepare_rewrite();

		$this->get_page_in_site();

		$this->get_headers();
		$this->get_module();

		Dev::get_profiling();
		//Gzip::do_gzip();
		return true;
	}

	/**
	 * Подключает файлы для решения нестандартых задач (вывод каптчи...)
	 *
	 * @return void
	 */
	private function include_other_file()
	{
		if (!empty( $_GET["rewrite"] ))
		{
			$rewrite_array = explode("/", $_GET["rewrite"]);
			if (count($rewrite_array) > 1 && !in_array($rewrite_array[1], array ( 'model', 'view', 'admin', 'inc', 'ajax' )) && file_exists(ABSOLUTE_PATH . 'modules/' . $rewrite_array[0] . '/' . $rewrite_array[0] . '.' . $rewrite_array[1] . '.php'))
			{
				$path = ABSOLUTE_PATH . 'modules/' . $rewrite_array[0] . '/' . $rewrite_array[0] . '.' . $rewrite_array[1] . '.php';
				unset( $rewrite_array[0] );
				unset( $rewrite_array[1] );
				$_GET["rewrite"] = implode('/', $rewrite_array);
				include_once $path;
			}
		}
	}

	/**
	 * Записывает данные о языках сата
	 *
	 * @return void
	 */
	private function get_languages_array()
	{
		unset( $_lang );
		$this->get_languages();

		if ($_GET["rewrite"])
		{
			$rew = explode('/', $_GET["rewrite"], 2);
			foreach ($this->languages as $row)
			{
				if ($rew[0] == $row["shortname"] && ! $row["base_admin"])
				{
					$_GET["rewrite"] = preg_replace('/^' . $rew[0] . '(\/)*/', '', $_GET["rewrite"]);
					define( '_LANG', $row["id"]);
					define( '_SHORTNAME', $row["shortname"] . '/' );
					define( 'TITLE', ( defined('TIT' . $row["id"]) ? constant('TIT' . $row["id"]) : '' ) );
					define( 'BASE_PATH_HREF', "http://" . $_SERVER["HTTP_HOST"] . "/" . ( REVATIVE_PATH ? REVATIVE_PATH . '/' : '' ) . ADMIN_FOLDER . '/' . $row["shortname"] . '/' );
					break;
				}
			}
		}
		if (!defined('_LANG'))
		{
			foreach ($this->languages as $row)
			{
				if ($row["base_admin"])
				{
					define( '_LANG', $row["id"]);
					define( '_SHORTNAME',  '' );
					define( 'TITLE', ( defined('TIT' . $row["id"]) ? constant('TIT' . $row["id"]) : '' ) );
			define( 'BASE_PATH_HREF', "http://" . $_SERVER["HTTP_HOST"] . "/" . ( REVATIVE_PATH ? REVATIVE_PATH . '/' : '' ) . ADMIN_FOLDER . '/' );
					break;
				}
			}
		}
	}

	/**
	 * Инициирует авторизацию или выход пользователя из системы
	 *
	 * @return void
	 */
	private function get_user()
	{
		if (!empty( $_POST['action'] ) && $_POST['action'] == 'auth')
		{
			$this->_user->auth($_POST);
		}
		elseif (strpos($_GET["rewrite"], "logout") !== false)
		{
			$this->_user->logout();
		}
	}

	/**
	 * Подготавливает запрос для идентифицикации страницы в таблице {site} по rewrite или по id,
	 * удаляет из строки запроса $_GET[rewrite] переданные переменные
	 *
	 * @return boolean true
	 */
	private function prepare_rewrite()
	{
		if ($_GET["rewrite"])
		{
			$rewrite_array = explode("/", $_GET["rewrite"]);

			foreach ($rewrite_array as $key => $ra)
			{

				foreach ($this->rewrite_variable_names as $name)
				{
					if (preg_match('/' . $name . '([0-9]+)/', $ra, $result))
					{
						$this->$name = $result[1];
						unset( $rewrite_array[$key] );
					}
				}
			}
			$this->rewrite = implode("/", $rewrite_array);
		}
		if (!$this->rewrite)
		{
			if ($this->_user->roles('init', 'site') || !$this->_user->id)
			{
				$this->rewrite = 'site';
			}
			else
			{
				$result = DB::query("SELECT id, rewrite FROM {adminsite} WHERE act='1' ORDER BY id ASC");
				while ($row = DB::fetch_array($result))
				{
					if ($this->_user->roles('init', $row["rewrite"]))
					{
						$this->rewrite = $row["rewrite"];
						break;
					}
				}
			}
		}
		return true;
	}

	/**
	 * Идентифицирует страницу, задает параметры страницы
	 *
	 * @return boolean true
	 */
	private function get_page_in_site()
	{
		if ($this->rewrite)
		{
			$row = DB::fetch_array(DB::query("SELECT id, name, parent_id, docs FROM {adminsite} WHERE rewrite='%h' LIMIT 1", $this->rewrite));
		}

		if (empty( $row ))
		{
			include ABSOLUTE_PATH . 'includes/404.php';
		}

		$this->cid = $row["id"];
		$this->name = $row['name'];
		$this->docs = $row['docs'];
		$this->parent_id = $row['parent_id'];

		return true;
	}

	/**
	 * Отдает браузеру заголовки страницы
	 *
	 * @return boolean true
	 */
	private function get_headers()
	{
		if(! $this->_user->id)
		{
			header('HTTP/1.0 404 Not Found');
		}
		else
		{
			header("Expires: " . date("r"));
			header("Cache-Control: no-store, no-cache, must-revalidate");
			header("Pragma: no-cache");
			header("Cache-Control: post-check=0, pre-check=0", false);
		}
		header('Content-Type: text/html; charset=utf-8');

		return true;
	}

	/**
	 * Подключает модуль
	 *
	 * @return boolean true
	 */
	private function get_module()
	{
		if (! $this->_user->roles('init', $this->rewrite) && $this->_user->id)
		{
			include ABSOLUTE_PATH . 'includes/404.php';
		}

		define( 'URL', $this->get_admin_url());

		Customization::inc("adm/includes/frame.php");

		if (!empty( $_POST['ajax'] ) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			$this->ajax = $_POST['ajax'];
		}

		if (strpos($this->rewrite, '/') !== false)
		{
			$rew = explode('/', $this->rewrite);
			foreach ($rew as $k => $v)
			{
				$v = preg_replace('/[^A-Za-z0-9-]+/', '', $v);
				if ($k == 0)
				{
					$rewrite = $v;
					$module = $v . '.admin';
				}
				else
				{
					$module .= '.' . $v;
				}
			}
		}
		else
		{
			$rewrite = preg_replace('/[^A-Za-z0-9-]+/', '', $this->rewrite);
			$module = $rewrite . '.admin';
		}

		if (file_exists(ABSOLUTE_PATH . 'modules/' . $rewrite . '/admin/' . $module . '.php') && $this->_user->id)
		{
			if (!empty( $_GET["parent"] ))
			{
				$this->parent = preg_replace('/[^0-9]+/', '', $_GET["parent"]);
			}

			Customization::inc('modules/' . $rewrite . '/admin/' . $module . '.php');
		}
		$this->module = $rewrite;
		$name_class_module = str_replace('.', '_', ucfirst($module));
		$name_func_module = 'inc_file_' . $rewrite;

		if (function_exists($name_func_module))
		{
			$name_class_module = $name_func_module($this);
		}

		if (in_array($name_class_module, get_declared_classes()))
		{
			$this->_frame = new $name_class_module( $this );
		}
		else
		{
			$this->_frame = new Frame_admin( $this );
		}

		if ($this->parent && $this->_frame->config("parent") && !DB::query_result("SELECT id FROM {" . $this->_frame->table . "} WHERE id=%d LIMIT 1", $this->parent))
		{
			if (!DB::query_result("SELECT id FROM {" . $this->_frame->table . "_category} WHERE id=%d LIMIT 1", $this->parent))
			{
				$this->redirect($this->get_admin_url('parent'));
				exit;
			}
		}

		if ($this->site && $this->_frame->config("element_site") && !DB::query_result("SELECT id FROM {site} WHERE id=%d LIMIT 1", $this->site))
		{
			$this->redirect(BASE_PATH_HREF . $this->rewrite . '/');
			exit;
		}

		$this->_frame->init();

		return true;
	}

	/**
	 * Борьба с магическими кавычками
	 *
	 * @return boolean true
	 */
	private function magic_quote_off()
	{
		if (get_magic_quotes_gpc())
		{
			$_GET = $this->stripslashes_array($_GET);
			$_POST = $this->stripslashes_array($_POST);
		}
		return true;
	}

	/**
	 * Вырезает магические кавычки из массива
	 *
	 * @return array
	 */
	private function stripslashes_array($array)
	{
		if (is_array($array))
		{
			foreach ($array as $key => $value)
			{
				$array[$key] = $this->stripslashes_array($value);
			}
			return $array;
		}
		else
		{
			return stripslashes($array);
		}
	}

	/**
	 * Возвращает текущий адрес страницы без указанных в аргументах переменных, передаваемых в URL
	 *
	 * @return string
	 */
	public function get_admin_url()
	{
		$args = func_get_args();
		return BASE_PATH_HREF
		.($this->rewrite ? $this->rewrite."/" : "")
		.($this->page && ! in_array('page', $args) ? "page".$this->page."/" : "")
		.($this->parent && ! in_array('parent', $args) ? "parent".$this->parent."/" : "")
		.($this->cat && ! in_array('cat', $args) ? "cat".$this->cat."/" : "")
		.($this->site && ! in_array('site', $args) ? "site".$this->site."/" : "");
	}

	/**
	 * Отдает значение перевода строки
	 *
	 * @param string $name текст для перевода
	 * @return string
	 */
	public function _($name)
	{
		$args = func_get_args();
		unset($args[0]);
		return $this->_languages->get($name, $this->current_module, false, $args);
	}
}