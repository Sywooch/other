<?php
/**
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	echo 'diafan.CMS version 5.2.1.9';
	exit;
}

/**
 * Init
 *
 * Основной класс системы
 */
class Init extends Core
{
	/**
	 * @var integer номер текущей страницы
	 */
	public $cid;

	/**
	 * @var string ЧПУ текущей страницы сайта
	 */
	public $rewrite;

	/**
	 * @var string ЧПУ текущей страницы, сгенерированный модулем
	 */
	public $rewrite_module;

	/**
	 * @var string название текущей страницы
	 */
	public $name;

	/**
	 * @var string заголовок текущей страницы для тега title
	 */
	public $title_meta;

	/**
	 * @var string JS код в шапку для текущей страницы
	 */
	public $js;

	/**
	 * @var string заголовок страницы, сформированный прикрепленным модулем
	 */
	public $titlemodule;

	/**
	 * @var array данные для редактирования meta-данных
	 */
	public $edit_meta;

	/**
	 * @var string заголовок текущей страницы для тега title, сформированный прикрепленным модулем
	 */
	public $titlemodule_meta;

	/**
	 * @var string ключевые слова текущей страницы
	 */
	public $keywords;

	/**
	 * @var string описание текущей страницы
	 */
	public $descr;

	/**
	 * @var string файл шаблона текущей страницы
	 */
	public $theme;

	/**
	 * @var string контент текущей страницы
	 */
	public $text;

	/**
	 * @var integer номер страницы-родителя
	 */
	public $parent_id;

	/**
	 * @var boolean спрятать ссылки на предыдущую, последующую страницы
	 */
	public $hide_previous_next;

	/**
	 * @var boolean не показывать заголовок h1 текущей страницы
	 */
	public $title_no_show;

	/**
	 * @var boolean не индексировать 
	 */
	public $noindex;

	/**
	 * @var integer время редактирования текущей страницы
	 */
	public $timeedit;

	/**
	 * @var string модуль, прикрепленный к текущей странице
	 */
	public $module;

	/**
	 * @var array часть навигации "Хлебные крошки", сформированная прикрепленным модулем
	 */
	public $path;

	/**
	 * @var array переменные, передаваемые в URL
	 */
	public $rewrite_variable_names_all = array('cat', 'param', 'show', 'page', 'year', 'month', 'day', 'step', 'sort', 'add', 'edit','vse');

	/**
	 * @var array переменные, прикрепленные к псевдоссылке текущей страницы
	 */
	public $rewrite_variable_in_page = array();

	/**
	 * @var array переменные, передаваемые в URL для текущего модуля
	 */
	public $rewrite_variable_names = array();

	/**
	 * @var integer номер страницы
	 */
	public $page;

	/**
	 * @var integer переменная, передаваемая в URL: номер элемента
	 */
	public $show;

	/**
	 * @var integer переменная, передаваемая в URL: номер параметра
	 */
	public $param;

	/**
	 * @var integer переменная, передаваемая в URL: номер категории
	 */
	public $cat;

	/**
	 * @var integer переменная, передаваемая в URL: год
	 */
	public $year;

	/**
	 * @var integer переменная, передаваемая в URL: месяц
	 */
	public $month;

	/**
	 * @var integer переменная, передаваемая в URL: день
	 */
	public $day;

	/**
	 * @var integer переменная, передаваемая в URL: номер шага
	 */
	public $step;

	/**
	 * @var integer переменная, передаваемая в URL: направление сортировки
	 */
	public $sort;

	/**
	 * @var integer переменная, передаваемая в URL: добавить элемент (1)
	 */
	public $add;

	/**
	 * @var integer переменная, передаваемая в URL: номер редактируемого элемента
	 */
	public $edit;

	/**
	 * @var object текущий объект
	 */
	public $diafan;

	/**
	 * @var array модуль текущего исполняемого файла
	 */
	public $current_module;

	/**
	 * @var string текущий шаблонный тег
	 */
	public $current_insert_tag;

	/**
	 * @var array установленные модули
	 */
	public $installed_modules;

	/**
	 * @var object пользователи
	 */
	public $_user;

	/**
	 * @var object кэширование
	 */
	public $_cache;

	/**
	 * @var object ЧПУ
	 */
	public $_route;

	/**
	 * @var object шаблоны
	 */
	public $_tpl;

	/**
	 * @var object парсер шаблонных функций
	 */
	public $_parser_theme;

	/**
	 * @var array объекты модулей
	 */
	private $_objects;

	/**
	 * Конструктор класса. Определяет свойства класса
	 *
	 * @return void
	 */
	public function __construct()
	{
		include_once ABSOLUTE_PATH.'plugins/encoding.php';

		Customization::inc('includes/database.php');
		DB::connect();

		Customization::inc('includes/function.php');

		Customization::inc('includes/controller.php');

		Customization::inc('includes/model.php');

		Customization::inc('includes/ajax.php');

		Customization::inc('includes/user.php');
		$this->_user = new User();

		Customization::inc('includes/cache.php');
		$this->_cache = new Cache;

		Customization::inc('includes/route.php');
		$this->_route = new Route($this);

		Customization::inc('includes/template.php');
		$this->_tpl = new Template($this);
	}

	/**
	 * Подключает вспомогательные модули, если они не подключены
	 *
	 * @return object|null
	 */
	public function __get($name)
	{
		if (! isset($this->_objects[$name]))
		{
			// подключаем обработчик запросов модуля
			if (substr($name, 0, 1) == '_')
			{
				$module = substr($name, 1);
				if(! in_array($module, $this->installed_modules))
				{
					$this->_objects[$name] = new Empty_inc();
				}
				else
				{
					if (file_exists(ABSOLUTE_PATH.'modules/'.$module.'/'.$module.'.inc.php'))
					{
						Customization::inc('modules/'.$module.'/'.$module.'.inc.php');
						$class = ucfirst($module).'_inc';
						$this->_objects[$name] = new $class($this, $module);
					}
				}
			}
			else
			{
				return null;
			}
		}
		return $this->_objects[$name];
	}

	/**
	 * Инициализирует генерирование страницы
	 *
	 * @return void
	 */
	public function start()
	{
		Dev::set_profiling();

		$this->get_redirect();

		Customization::inc('includes/session.php');
		Session::init();

		$this->get_languages();
		$this->magic_quote_off();
		$this->get_user();

		$this->get_language_site();

		$this->get_installed_modules();

		$this->include_other_file();

		$this->prepare_rewrite();
		$this->get_page_in_site();

		Customization::inc('includes/parser_theme.php');
		$this->_parser_theme = new Parser_theme($this);

		$module = $this->get_module();

		if (MOD_DEVELOPER_TECH && ! $this->_user->roles('init', $this->module ? $this->module : 'site'))
		{
			if(!  $this->module || ! $this->_user->roles('init', 'site')
			   || ! DB::query_result("SELECT id FROM {modules} WHERE name='%h' AND site='1' AND admin='0' LIMIT 1", $this->module))
			{
				include_once ABSOLUTE_PATH.'includes/503.php';
			}
		}

		$this->get_headers();
		$this->_parser_theme->show_theme($module);

		Dev::get_profiling();
	}

	/**
	 * Выполняет 301 редирект
	 *
	 * @return void
	 */
	private function get_redirect()
	{
		$url = $_SERVER['REQUEST_URI'];
		$url = preg_replace('/^\/'.(REVATIVE_PATH ? REVATIVE_PATH.'\/' : '').'/', '', $url);
		if($row = DB::fetch_array(DB::query("SELECT * FROM {redirect} WHERE redirect='%s' LIMIT 1", $url)))
		{
			if(! $row["code"])
			{
				$row["code"] = 301;
			}
			if($row["module_name"] == 'site')
			{
				$this->redirect(BASE_PATH.$this->_route->link($row["site_id"]));
			}
			else
			{
				$this->redirect(BASE_PATH.$this->_route->link($row["site_id"], $row["module_name"], $row["cat_id"], $row["element_id"]), $row["code"]);
			}
		}
		
	}

	/**
	 * Подключает файлы для решения нестандартых задач (вывод каптчи, вывод прикрепленных файлов...)
	 *
	 * @return boolean true
	 */
	private function include_other_file()
	{
		if (! empty($_GET["rewrite"]))
		{
			$rewrite_array = explode("/", $_GET["rewrite"]);
			if (count($rewrite_array) > 1 && ! in_array($rewrite_array[1], array('model', 'view', 'admin', 'inc', 'ajax', 'sitemap'))
			   && file_exists(ABSOLUTE_PATH.'modules/'.$rewrite_array[0].'/'.$rewrite_array[0].'.'.$rewrite_array[1].'.php'))
			{
				$this->diafan = $this;
				$path = ABSOLUTE_PATH.'modules/'.$rewrite_array[0].'/'.$rewrite_array[0].'.'.$rewrite_array[1].'.php';
				unset($rewrite_array[0]);
				unset($rewrite_array[1]);
				$_GET["rewrite"] = implode('/', $rewrite_array);
				include_once $path;
			}
		}

		if (strpos($_GET["rewrite"], 'sitemap.xml') !== false)
		{
		    include_once ABSOLUTE_PATH.'modules/map/map.sitemap.php';
		}
		return true;
	}

	/**
	 * Подготавливает запрос для идентифицикации страницы в таблице {site} по rewrite или по id,
	 * удаляет из строки запроса $_GET[rewrite] переданные переменные
	 *
	 * @return boolean true
	 */
	private function prepare_rewrite()
	{
		if($_GET["rewrite"] == 'admin_reminding')
		{
			$this->cid     = 1;
			$this->module  = 'reminding';
			$this->rewrite = $_GET["rewrite"];
			return true;
		}
		$arguments_in_url = false;
		if ($this->get_rewrite($_GET["rewrite"], $arguments_in_url))
		{
			return true;
		}
		if ($_GET["rewrite"])
		{
			$rewrite_array = explode("/",$_GET["rewrite"]);
			foreach ($this->rewrite_variable_names_all as $name)
			{
				$this->$name = 0;
			}

			foreach ($rewrite_array as $key => $ra)
			{
				foreach ($this->rewrite_variable_names_all as $name)
				{
					if (preg_match('/'.$name.'([0-9]+)/', $ra, $result))
					{
						$this->$name = $result[1];
						unset($rewrite_array[$key]);
						$arguments_in_url = true;
					}
				}
			}

			$_GET["rewrite"] = implode("/", $rewrite_array);
			if (! $this->get_rewrite($_GET["rewrite"], $arguments_in_url))
			{
				include ABSOLUTE_PATH.'includes/404.php';
			}
		}

		if (! $this->rewrite)
		{
			$this->cid = empty($_GET["url"]) ? 1 : intval($_GET["url"]);
		}
		return true;
	}

	/**
	 * Получаем страницу по псевдоссылке
	 *
	 * @param string $rewrite текущая псевдоссылка
	 * @param boolean $arguments_in_url в URL переданы аргументы
	 * @return boolean
	 */
	public function get_rewrite($rewrite, $arguments_in_url)
	{
		if ($row = $this->_route->search($rewrite, $arguments_in_url))
		{
			if (! $this->show && ! $this->cat)
			{
				$this->rewrite_module = $row["rewrite"];
			}
			if ($row["element_id"])
			{
				if ($this->show)
				{
					include ABSOLUTE_PATH.'includes/404.php';
				}
				$this->show =  $row["element_id"];
				$this->rewrite_variable_in_page[] = 'show';
			}
			if ($row["cat_id"])
			{
				if ($this->cat)
				{
					include ABSOLUTE_PATH.'includes/404.php';
				}
				$this->cat =  $row["cat_id"];
				$this->rewrite_variable_in_page[] = 'cat';
			}
			if ($row["param_id"])
			{
				if ($this->param)
				{
					include ABSOLUTE_PATH.'includes/404.php';
				}
				$this->param = $row["param_id"];
				$this->rewrite_variable_in_page[] = 'param';
			}
			$this->cid     = $row["site_id"];
			$this->module  = $row["module_name"] ? $row["module_name"] : $this->module;
			$this->rewrite = $row["rewrite"];
			return true;
		}
		return false;
	}

	/**
	 * Идентифицирует страницу сайта, задает параметры страницы
	 *
	 * @return boolean true
	 */
	private function get_page_in_site()
	{
		if ($this->cid)
		{
			$time = mktime(1, 0, 0);
			$current_page = DB::fetch_array(DB::query(
					"SELECT id, parent_id, [name], [title_meta], [name], [keywords], [descr],"
					." title_no_show, noindex, [text], js,"
					." timeedit, theme, module_name, sort, access FROM {site}"
					." WHERE [act]='1' AND trash='0' AND block='0'"
					." AND date_start<=".$time." AND (date_finish=0 OR date_finish>=".$time.")"
					." AND id=%d ORDER BY sort ASC, id ASC LIMIT 1", $this->cid
				));
			if (empty($current_page))
			{
				include ABSOLUTE_PATH.'includes/404.php';
			}
			if($current_page["access"] == '1')
			{
				if (! $this->_user->id)
				{
					include ABSOLUTE_PATH.'includes/403.php';
				}
				if(! DB::query_result("SELECT role_id FROM {access} WHERE element_id=%d AND module_name='site' AND role_id=%d LIMIT 1", $current_page["id"], $this->_user->role_id))
				{
					include ABSOLUTE_PATH.'includes/403.php';
				}
			}
			if (! $current_page["theme"])
			{
				$current_page["theme"] = 'site.php';
			}
		}
		else
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		$this->cid           = $current_page["id"];
		$this->name          = $current_page['name'];
		$this->keywords      = $current_page['keywords'];
		$this->descr         = $current_page['descr'];
		$this->parent_id     = $current_page['parent_id'];
		$this->title_no_show = $current_page['title_no_show'];
		$this->noindex       = $current_page['noindex'];
		$this->title_meta    = $current_page['title_meta'];
		$this->timeedit      = $current_page['timeedit'];
		$this->theme         = $current_page['theme'];
		$this->js            = $current_page['js'];
		if($this->module != "reminding")
		{
			$this->module        = $current_page["module_name"];
			$this->text          = $current_page['text'];
		}
		else
		{
			$this->theme         = 'site.php';
		}

		return true;
	}

	/**
	 * Отдает браузеру заголовки страницы
	 *
	 * @return boolean true
	 */
	private function get_headers()
	{
		if($this->rewrite == 'admin_reminding')
		{
			header('HTTP/1.0 404 Not Found');
		}
		// проверяем, отослал ли браузер заголовок If-Modified-Since 
		elseif (! empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $this->timeedit && $this->timeedit <= strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']))
		{
			header("HTTP/1.1 304 Not Modified");
			header("Last-Modified: ".gmdate("D, d M Y H:i:s", $this->timeedit) . " GMT");
			exit;
		}
		header("Expires: ".date("r"));
		header("Last-Modified: ".(! $this->timeedit ? gmdate("D, d M Y H:i:s") : gmdate("D, d M Y H:i:s", $this->timeedit)) . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header('Content-Type: text/html; charset=utf-8');
		return true;
	}

	/**
	 * Подключает модуль, прикрепленный к странице
	 *
	 * @return object
	 */
	private function get_module()
	{
		// подключаем обработчик запросов модуля
		if (! empty($_POST["module"]))
		{
			$module = preg_replace('/[^a-z0-9_]+/', '', $_POST["module"]);
			if (file_exists(ABSOLUTE_PATH.'modules/'.$module.'/'.$module.'.ajax.php'))
			{
				$this->current_module = $module;
				Customization::inc('modules/'.$module.'/'.$module.'.ajax.php');
				$class = ucfirst($module).'_ajax';
				$ajax = new $class($this, $module);
				if ($ajax->ajax_request())
				{
					exit;
				}
				$this->current_module = '';
			}
		}

		if ($this->module && file_exists(ABSOLUTE_PATH.'modules/'.$this->module.'/'.$this->module.'.php'))
		{
			Customization::inc('modules/'.$this->module.'/'.$this->module.'.php');
			if (file_exists(ABSOLUTE_PATH.'modules/'.$this->module.'/'.$this->module.'.model.php'))
			{
				Customization::inc('modules/'.$this->module.'/'.$this->module.'.model.php');
			}
			$this->current_module = $this->module;
			$name_class_module = ucfirst($this->module);
			$mod = new $name_class_module($this, $this->module);
			$mod->init();
			$this->current_module = '';

			foreach ($this->rewrite_variable_names_all as $name)
			{
				if ($this->$name && ! in_array($name, $mod->rewrite_variable_names))
				{
					include ABSOLUTE_PATH.'includes/404.php';
				}
			}
			return $mod;
		}
		else
		{
			foreach ($this->rewrite_variable_names_all as $name)
			{
				if ($this->$name)
				{
					include ABSOLUTE_PATH.'includes/404.php';
				}
			}
			$mod = new Controller($this);
			return $mod;
		}
	}

	/**
	 * Записывает данные о языках сайта
	 *
	 * @return boolean true
	 */
	private function get_language_site()
	{
		if ($_GET["rewrite"] || defined('_LANG') && _LANG)
		{
			$rew = explode('/', $_GET["rewrite"], 2);
			foreach ($this->languages as $language)
			{
				if (! defined('_LANG') && $rew[0] == $language["shortname"] || defined('_LANG') && $language["id"] == _LANG)
				{
					$_GET["rewrite"] = preg_replace('/^'.$rew[0].'(\/)*/', '', $_GET["rewrite"]);
					if (! defined('_LANG'))
					{
						define('_LANG', $language["id"]);
					}
					define('BASE_PATH_HREF', BASE_PATH.(! $language["base_site"] ? $language["shortname"].'/' : ''));

					require_once(ABSOLUTE_PATH.'plugins/IDNA.php');
					$IDN = new idna_convert(array('idn_version' => '2008'));
					$domain = $IDN->decode($_SERVER["HTTP_HOST"]);
					define('BASE_URL', ($domain ? $domain : $_SERVER["HTTP_HOST"]).(REVATIVE_PATH ? '/'.REVATIVE_PATH : '').(! $language["base_site"] ? '/'.$language["shortname"] : ''));
					if (defined('TIT'.$language["id"]))
					{
						define('TITLE', constant('TIT'.$language["id"]));
					}
					else
					{
						define('TITLE', '');
					}
					break;
				}
			}
		}

		if (! defined('_LANG'))
		{
			foreach ($this->languages as $row)
			{
				if ($row["base_site"])
				{
					define('_LANG', $row["id"]);
					define('TITLE', ( defined('TIT' . $row["id"]) ? constant('TIT' . $row["id"]) : '' ) );
					define('BASE_PATH_HREF', BASE_PATH);
					define('BASE_URL', $_SERVER["HTTP_HOST"].(REVATIVE_PATH ? '/'.REVATIVE_PATH : ''));
					break;
				}
			}
		}
		return true;
	}

	/**
	 * Формирует список установленных модулей, имеющих пользовательскую часть
	 *
	 * @return void
	 */
	private function get_installed_modules()
	{
		$result = DB::query("SELECT name FROM {modules} WHERE site='1'");
		while($row = DB::fetch_array($result))
		{
			$this->installed_modules[] = $row["name"];
		}
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
	 * Инициирует авторизацию или выход пользователя из системы
	 *
	 * @return boolean true
	 */
	private function get_user()
	{
		if (! empty($_POST['action']) && $_POST['action'] == 'auth')
		{
			$this->_user->auth($_POST);
		}
		elseif (! empty($_POST['token']))
		{
			$this->_user->auth_loginza();
		}
		elseif (strpos($_GET["rewrite"], "logout") !== false)
		{
			$this->_user->logout();
		}
		return true;
	}

	/**
	 * Отдает значение перевода строки
	 *
	 * @param string $name текст для перевода
	 * @param boolean $useradmin выдавать форму для редактирования
	 * @return string
	 */
	public function _($name, $useradmin = true)
	{
		$args = func_get_args();
		unset($args[0]);
		if(isset($args[1]))
		{
			unset($args[1]);
		}
		if(! empty($_POST["ajax"]))
		{
			$useradmin = false;
		}
		return $this->_languages->get($name, $this->current_module, $useradmin, $args);
	}
}

class Empty_inc
{
	public function __call($name, $args)
	{
		return false;
	}
}