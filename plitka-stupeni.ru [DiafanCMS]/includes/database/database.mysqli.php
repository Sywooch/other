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
 * DB_mysqli
 * 
 * Работа с базой данных с помощью расширения ext/mysqli
 */
class DB_mysqli
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
		if(! empty($url['port']))
		{
			list($url['host']) = explode(':', $url['host']);
			$this->connection = mysqli_connect($url['host'], $url['user'], $url['pass'], $url['path'], $url['port']);
		}
		else
		{
			$this->connection = mysqli_connect($url['host'], $url['user'], $url['pass'], $url['path']);
		}

		if (! $this->connection)
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
	public function result($result, $ind = 0)
	{
		$row = mysqli_fetch_row($result);
		return $row[$ind];
	}

	/**
	 * Извлекает результирующий ряд как объект
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return object
	 */
	public function fetch_object($result)
	{
		return mysqli_fetch_object($result);
	}

	/**
	 * Извлекает результирующий ряд как массив
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return array
	 */
	public function fetch_array($result)
	{
		return mysqli_fetch_assoc($result);
	}

	/**
	 * Получает количество рядов в результате
	 * 
	 * @param resource $result обрабатываемый результат запроса
	 * @return integer
	 */
	public function num_rows($result)
	{
		return mysqli_num_rows($result);
	}

	/**
	 * Посылает запрос MySQL
	 * 
	 * @param string $query текст запроса
	 * @return resource
	 */
	public function query($query)
	{
		return mysqli_query($this->connection, $query);
	}

	/**
	 * Возвращает текста ошибки выполнения последней операции с MySQL
	 * 
	 * @return integer
	 */
	public function error()
	{
		return mysqli_error($this->connection);
	}

	/**
	 * Мнемонизирует специальные символы в строке для использования в операторе SQL с учётом текущего набора символов/charset соединения
	 *
	 * @param string $str исходная строка
	 * @return string
	 */
	public function escape_string($str)
	{
	    return mysqli_real_escape_string($this->connection,$str);
	}
}