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
 * Cache
 * 
 * Кэширование
 */
class Cache
{
	/**
	 * @var object бэкэнд
	 */
	private $backend;

	/**
	 * @var name метка кэша
	 */
	private $name;

	/**
	 * @var string название модуля
	 */
	private $module;

	/**
	 * Конструктор класса
	 *
	 * @return \Cache
	 */
	public function __construct()
	{
		if(CACHE_MEMCACHED)
		{
			$backend = 'memcached';
		}
		else
		{
			$backend = 'files';
		}
		switch($backend)
		{
			case 'files':
				Customization::inc('includes/cache/cache.files.php');
				$this->backend = new Cache_files();
				break;
			
			case 'memcached':
				Customization::inc('includes/cache/cache.memcached.php');
				$this->backend = new Cache_memcached();
				break;
		}
	}

	/**
	 * Читает кэш модуля $module с меткой $name.
	 *
	 * @param string|array $name метка кэша
	 * @param string $module название модуля
	 * @param boolean $ignore_mod_dev_cache игнорировать отключение кэша в параметрах сайта
	 * @return mixed
	 */
	public function get($name, $module, $ignore_mod_dev_cache = false)
	{
		if (MOD_DEVELOPER_CACHE && ! $ignore_mod_dev_cache)
			return false;

		$this->transform_param($name, $module);

		return $this->backend->get($this->name, $this->module);
	}

	/**
	 * Сохраняет данные $data для модуля $module с меткой $name
	 *
	 * @param mixed $data данные, сохраняемые в кэше
	 * @param string|array $name метка кэша
	 * @param string $module название модуля
	 * @param boolean $ignore_mod_dev_cache игнорировать отключение кэша в параметрах сайта
	 * @return boolean
	 */
	public function save($data, $name, $module, $ignore_mod_dev_cache = false)
	{
		if (MOD_DEVELOPER_CACHE && ! $ignore_mod_dev_cache)
			return false;

		$this->transform_param($name, $module);

		return $this->backend->save($data, $this->name, $this->module);
	}

	/**
	 * Удаляет кэш для модуля $module с меткой $name. Если функция вызвана с пустой меткой, то удаляется весь кэш для модуля $module
	 *
	 * @param string|array $name метка кэша
	 * @param string $module название модуля
	 * @return boolean
	 */
	public function delete($name, $module = '')
	{
		$this->transform_param($name, $module);
		return $this->backend->delete($this->name, $this->module);
	}

	/**
	 * Преобразует метку и название модуля для работы с кэшем
	 *
	 * @param string|array $name метка кэша
	 * @param string $module название модуля
	 * @return boolean true
	 */
	private function transform_param($name, $module)
	{
		if($name)
		{
			if (! is_array($name))
			{
				$this->name = md5($name);
			}
			else
			{
				$this->name = md5(serialize($name));
			}
		}
		else
		{
			$this->name = '';
		}
		if($module)
		{
			$this->module = md5($module);
		}
		else
		{
			$this->module = '';
		}
		return true;
	}
}