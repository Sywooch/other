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
 * Cache_memcached
 * 
 * Кэширование при помощи MemCache
 */
class Cache_memcached
{
	/**
	 * @var object объект MemCache
	 */
	private $memcached;

	/**
	 * @var string уникальны код - префикс
	 */
	private $ukey;

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct()
	{
		$this->memcached = new Memcached();
		$this->memcached->addServer(CACHE_MEMCACHED_HOST, CACHE_MEMCACHED_PORT);
		$this->ukey = md5(DB_PREFIX.DB_URL);
	}

	/**
	 * Проверяет параметры подключения
	 *
	 * @param string $host хост
	 * @param string $port порт
	 * @return boolean
	 */
	public static function check($host, $port)
	{
		$memcached = new Memcached();
		$memcached->addServer($host, $port);
		return $memcached ? true : false;
	}

	/**
	 * Читает кэш модуля $module с меткой $name.
	 *
	 * @param string|array $name метка кэша
	 * @param string $module название модуля
	 * @return mixed
	 */
	public function get($name, $module)
	{
		return $this->memcached->getByKey($this->ukey.$module, $name);
	}

	/**
	 * Сохраняет данные $data для модуля $module с меткой $name
	 *
	 * @param mixed $data данные, сохраняемые в кэше
	 * @param string|array $name метка кэша
	 * @param string $module название модуля
	 * @return boolean true
	 */
	public function save($data, $name, $module)
	{
		$this->memcached->setByKey($this->ukey.$module, $name, $data);
		return true;
	}

	/**
	 * Удаляет кэш для модуля $module с меткой $name. Если функция вызвана с пустой меткой, то удаляется весь кэш для модуля $module
	 *
	 * @param string $name метка кэша
	 * @param string $module название модуля
	 * @return boolean true
	 */
	public function delete($name, $module)
	{
		if ($name)
		{
			$this->memcached->deleteByKey($this->ukey.$module, $name);
		}
		elseif ($module)
		{
			if(! $this->memcached->deleteByKey($this->ukey.$module))
			{
				$this->memcached->flush();
			}
		}
		else
		{
			$this->memcached->flush();
		}
		return true;
	}
}