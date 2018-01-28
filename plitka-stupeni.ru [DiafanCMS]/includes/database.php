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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * DB
 * 
 * Работа с базой данных
 */
class DB
{
	const _QUERY_REGEXP = '/(%d|%s|%%|%f|%b|%h)/';

	/**
	 * @var object бэкэнд
	 */
	public static $backend;

	/**
	 * Подключается к базе данных
	 *
	 * @return boolean
	 */
	public static function connect($db_url = DB_URL)
	{
		$url = parse_url($db_url);

		switch($url["scheme"])
		{
			case 'mysql':
				Customization::inc('includes/database/database.mysql.php');
				self::$backend = new DB_mysql();
				break;

			case 'mysqli':
				Customization::inc('includes/database/database.mysqli.php');
				self::$backend = new DB_mysqli();
				break;

			default:
				if (defined('IS_INSTALL') && IS_INSTALL)
				{	
					return false;
				}
				else
				{
					echo 'Ошибка подключения к базе данных, возможно неправильные параметры подключения в config.php';
					exit;
				}
		}

		$url['user'] = urldecode($url['user']);
		
		if (isset($url['pass']))
		{
			$url['pass'] = urldecode($url['pass']);
		}
		else
		{
			$url['pass'] = '';
		}
		
		$url['host'] = urldecode($url['host']);
		$url['path'] = urldecode($url['path']);

		if (isset($url['port']))
		{
			$url['host'] = $url['host'].':'.$url['port'];
		}
		$url['path'] = substr($url['path'], 1);
		$result = self::$backend->connect($url);

		if (! $result)
		{
			if (defined('IS_INSTALL') && IS_INSTALL)
			{
				return false;
			}
			elseif (IS_ADMIN || ! empty($_GET["rewrite"]))
			{
				echo 'Ошибка подключения к базе данных, возможно неправильные параметры подключения в config.php';
			}
			else
			{
				echo file_get_contents(BASE_PATH.'index.html');
			}
			die();
		}
		if(defined('DB_CHARSET'))
		{
			self::$backend->query("SET NAMES '".DB_CHARSET."'");
		}

		return true;
	}

	/**
	 * Отправляет запрос к базе данных
	 * 
	 * @param string $query текст запроса
	 * @return resource
	 */
	public static function query($query)
	{
		$args = func_get_args();
		array_shift($args);
		$query = self::_prefix_tables($query);
		$query = self::_lang_fields($query);
		if (isset($args[0]) and is_array($args[0]))
		{
			$args = $args[0];
		}
		self::_query_callback($args, true);
		$query = preg_replace_callback(self::_QUERY_REGEXP, array('DB', '_query_callback'), $query);
		return self::_query($query);
	}

	/**
	 * Отправляет запрос к базе данных с лимитом на количество получаюмых в результате рядов
	 * 
	 * @param string $query текст запроса
	 * @return resource
	 */
	public static function query_range($query)
	{
		$args = func_get_args();
		$count = array_pop($args);
		$from = array_pop($args);
		array_shift($args);

		$query = self::_prefix_tables($query);
		$query = self::_lang_fields($query);
		if (isset($args[0]) && is_array($args[0]))
		{
			$args = $args[0];
		}
		self::_query_callback($args, true);
		$query = preg_replace_callback(self::_QUERY_REGEXP, array('DB', '_query_callback'), $query);
		$query .= ' LIMIT '.(int) $from.', '.(int) $count;
		return self::_query($query);
	}

	/**
	 * Получает результирующие данные
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @param integer $row номер получаемого ряда из результата
	 * @return mixed
	 */
	public static function result($result, $row = 0)
	{
		if ($result && self::$backend->num_rows($result) > $row)
		{
			return self::$backend->result($result, $row);
		}
		return false;
	}

	/**
	 * Извлекает результирующий ряд как объект
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return object
	 */
	public static function fetch_object($result)
	{
		if ($result)
		{
			return self::$backend->fetch_object($result);
		}
	}

	/**
	 * Извлекает результирующий ряд как массив
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return array
	 */
	public static function fetch_array($result)
	{
		if ($result)
		{
			return self::$backend->fetch_array($result);
		}
	}

	/**
	 * Получает количество рядов в результате
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return integer
	 */
	public static function num_rows($result)
	{
		if ($result)
		{
			return self::$backend->num_rows($result);
		}
	}

	/**
	 * Возвращает значение поля $param_name для таблицы $table и строки с номером $id
	 *
	 * @param string $table название таблицы без префикса
	 * @param integer $id идентификатор строки
	 * @param string $param_name название поля
	 * @return mixed
	 */
	public static function title($table, $id, $param_name)
	{
		return self::result(self::query("SELECT ".$param_name." FROM {".$table."} where id=%d LIMIT 1", $id));
	}

	/**
	 * Возвращает значение поля $param_name для таблицы $table и одной строки, соответствующей запросу $where
	 *
	 * @param string $table название таблицы без префикса
	 * @param string $where SQL-условие
	 * @param string $param_name название поля
	 * @return mixed
	 */
	public static function where($table, $where, $param_name)
	{
		return self::result(self::query("SELECT ".$param_name." FROM {".$table."} where ".$where." limit 1"));
	}

	/**
	 * Получает номер id для таблицы $table
	 *
	 * @param string $table название таблицы без префикса
	 * @return integer
	 */
	public static function last_id($table)
	{
		return self::result(self::query("SELECT max(id) FROM {".$table."} limit 1"));
	}

	/**
	 * Получает результирующие данные из SQL-запроса
	 * 
	 * @return mixed
	 */
	public static function query_result()
	{
		$query = func_get_args();
		if(strpos($query[0], "LIMIT 1") === false && strpos($query[0], "SELECT COUNT(") === false
		   && strpos($query[0], "SELECT GROUP_CONCAT(") === false)
		{
			$query[0] .= " LIMIT 1";
		}
		if (isset($query[1]))
		{
			$sql = $query[0];
			if (is_array($query[1]))
			{
				$arg = $query[1];
			}
			else
			{
				unset($query[0]);
				$arg = $query;
			}
			return self::result(self::query($sql, $arg));
		}
		else
		{
			return self::result(self::query($query[0]));
		}
	}

	/**
	 * Мнемонизирует специальные символы в строке для использования в операторе SQL с учётом текущего набора символов/charset соединения
	 *
	 * @param string $str исходная строка
	 * @return string
	 */
	public static function escape_string($str)
	{
	    return self::$backend->escape_string($str);
	}

	private static function _query($query)
	{
		if (substr($query, 0, 4) == 'DEV ')
		{
			$query = substr($query, 4);
			echo '<p>query: '.$query.'</p>';
			
		}
		$result = self::$backend->query($query);

		$error = self::$backend->error();

		if (! $error)
		{
			return $result;
		}
		else
		{
			if (MOD_DEVELOPER)
			{
				trigger_error(htmlspecialchars($error."\nquery: ".$query), E_USER_WARNING);
			}
			return false;
		}
	}

	public static function _lang_fields($query)
	{
		if (strpos($query, '[') !== false)
		{
			if (defined('_LANG') && _LANG)
			{
				$query = str_replace("\n", " ", $query);
				$query = preg_replace_callback('/SELECT(.*?)FROM/', array('DB', '_lang_select_callback'), $query);
				$query = preg_replace_callback('/\[([^\]]+)\]/', array('DB', '_lang_callback'), $query);
			}
			else
			{
				$query = str_replace(array('[', ']'), array('', ''), $query);
			}
		}
		return $query;
	}
public static function _lang_select_callback($R64B8E2B8C7ABE18309C106487717187A){return 'SELECT'.preg_replace_callback('/\[([^\]]+)\]/', array('DB', '_lang_as_callback'), $R64B8E2B8C7ABE18309C106487717187A[1]).'FROM';} public static function _lang_callback($R64B8E2B8C7ABE18309C106487717187A){return $R64B8E2B8C7ABE18309C106487717187A[1]._LANG;}public static function _lang_as_callback($R64B8E2B8C7ABE18309C106487717187A){return $R64B8E2B8C7ABE18309C106487717187A[1]._LANG.' AS '.$R64B8E2B8C7ABE18309C106487717187A[1];}public static function _query_callback($R64B8E2B8C7ABE18309C106487717187A, $R5875A5AF586E3482AE15888C305D0FDF = false){global $R9FE302BDF914868081913A22F58F9E7E;if ($R5875A5AF586E3482AE15888C305D0FDF){$R9FE302BDF914868081913A22F58F9E7E = $R64B8E2B8C7ABE18309C106487717187A;return;}switch ($R64B8E2B8C7ABE18309C106487717187A[1]){case '%d':return (int) array_shift($R9FE302BDF914868081913A22F58F9E7E);case '%s':return self::_escape_string(array_shift($R9FE302BDF914868081913A22F58F9E7E));case '%h':return self::_escape_string(htmlspecialchars(stripslashes(strip_tags(array_shift($R9FE302BDF914868081913A22F58F9E7E)))));case '%%':return '%';case '%f':return (float) array_shift($R9FE302BDF914868081913A22F58F9E7E);case '%b':return self::_encode_blob(array_shift($R9FE302BDF914868081913A22F58F9E7E));}}private static function _encode_blob($data){return "'".DB::escape_string($data)."'";}private static function _escape_string($text){if (! is_numeric($text)){if (preg_match("/\\'/", $text)){$text = DB::escape_string($text);}}return $text;}private static function _prefix_tables($R130D64A4AD653C91E0FD80DE8FEADC3A){return strtr($R130D64A4AD653C91E0FD80DE8FEADC3A, array('{'=>'`'.DB_PREFIX, '}'=>'`'));}private static function _escape_table($R8409EAA6EC0CE2EA307354B2E150F8C2){return preg_replace('/[^A-Za-z0-9_]+/', '', $R8409EAA6EC0CE2EA307354B2E150F8C2);}}