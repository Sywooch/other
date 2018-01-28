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
 * DB_mysql
 * 
 * Работа с базой данных с помощью расширения ext/mysql
 */
class DB_mysql
{
	/**
	 * @var resource подключение к базе данных
	 */
	private $connect;

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct()
	{}

	/**
	 * Пробует подключится к базе данных
	 *
	 * @param array $url доступ к базе данных
	 * @return boolean
	 */
	public function connect($url)
	{
		$this->connection = mysql_connect($url['host'].(! empty($url['port']) ? ':'.$url['port'] : ''), $url['user'], $url['pass'], true, 2);

		if (! $this->connection)
		{
			return false;
		}

		if (! mysql_select_db($url['path']))
		{
			return false;
		}

		return true;
	}

	/**
	 * Получает результирующие данные
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @param integer $row номер получаемого ряда из результата
	 * @return mixed
	 */
	public function result($result, $row = 0)
	{
		return mysql_result($result, $row);
	}

	/**
	 * Извлекает результирующий ряд как объект
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return object
	 */
	public function fetch_object($result)
	{
		return mysql_fetch_object($result);
	}

	/**
	 * Извлекает результирующий ряд как массив
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return array
	 */
	public function fetch_array($result)
	{
		return mysql_fetch_assoc($result);
	}

	/**
	 * Получает количество рядов в результате
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return integer
	 */
	public function num_rows($result)
	{
		return mysql_num_rows($result);
	}

	/**
	 * Посылает запрос MySQL
	 * 
	 * @param string $query текст запроса
	 * @return resource
	 */
	public function query($query)
	{
		return mysql_query($query, $this->connection);
	}

	/**
	 * Возвращает текст ошибки выполнения последней операции с MySQL
	 * 
	 * @return integer
	 */
	public function error()
	{
		return mysql_error($this->connection);
	}

	/**
	 * Мнемонизирует специальные символы в строке для использования в операторе SQL с учётом текущего набора символов/charset соединения
	 *
	 * @param string $str исходная строка
	 * @return string
	 */
	public function escape_string($str)
	{
	    return mysql_real_escape_string($str,$this->connection);
	}
}