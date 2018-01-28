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
 * Кэширование в файлах
 */
class Cache_files
{
	/**
	 * @var array текущий кэш
	 */
	private $cache;

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct()
	{}

	/**
	 * Читает кэш модуля $module с меткой $name.
	 *
	 * @param string|array $name метка кэша
	 * @param string $module название модуля
	 * @return mixed
	 */
	public function get($name, $module)
	{
		if (empty($this->cache[$module][$name]))
		{
			$this->inc_cache_file($name, $module);
		}

		if (! isset($this->cache[$module][$name]))
		{
			return false;
		}
		return unserialize($this->cache[$module][$name]);
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
		$this->inc_cache_file($name, $module);

		$this->cache[$module][$name] = serialize($data);
		$this->write_cache($name, $module);
		return true;
	}

	/**
	 * Удаляет кэш для модуля $module с меткой $name. Если функция вызвана с пустой меткой, то удаляется весь кэш для модуля $module
	 *
	 * @param string $name метка кэша
	 * @param string $module название модуля
	 * @return void
	 */
	public function delete($name, $module)
	{
		if (! $module)
		{
			if(! $d = dir(ABSOLUTE_PATH.'cache'))
			{
				throw new Exception('Папка '.ABSOLUTE_PATH.'cache не существует. Создайте папку и установите права на запись (777).');
			}
			while ($entry = $d->read())
			{
				if ($entry != "." and $entry != ".." and $entry != ".htaccess")
				{
					if (is_dir(ABSOLUTE_PATH.'cache/'.$entry))
					{
						$module = $entry;
						$dm = dir(ABSOLUTE_PATH.'cache/'.$module);
						while ($entrym = $dm->read())
						{
							if ($entrym != "." and $entrym != "..")
							{
								if (! is_dir(ABSOLUTE_PATH.'cache/'.$module.'/'.$entrym))
								{
									$name = $entrym;
									$this->cache[$module][$name] = '';
									$this->write_cache($name, $module);
								}
							}
						}
						$dm->close();
					}
					else
					{
						if(! unlink(ABSOLUTE_PATH.'cache/'.$entry))
						{
							throw new Exception('Невозможно удалить файл '.ABSOLUTE_PATH.'cache/'.$entry.'. Проверьте права доступа (777) к файлу.');
						}
					}
				}
			}
			$d->close();
			return;
		}

		if (! $name)
		{
			if (is_dir(ABSOLUTE_PATH.'cache/'.$module))
			{
				$d = dir(ABSOLUTE_PATH.'cache/'.$module);
				while ($entry = $d->read())
				{
					if ($entry != "." and $entry != "..")
					{
						if (! is_dir(ABSOLUTE_PATH.'cache/'.$module.'/'.$entry))
						{
							$name = $entry;
							$this->cache[$module][$name] = '';
							$this->write_cache($name, $module);
						}
					}
				}
				$d->close();
			}
		}
		else
		{
			$this->cache[$module][$name] = '';
			$this->write_cache($name, $module);
		}
	}

	/**
	 * Подключает файл с кэшем модуля
	 *
	 * @param string $name метка кэша
	 * @param string $module название модуля
	 * @return void
	 */
	private function inc_cache_file($name, $module)
	{
		if (empty($this->cache[$module][$name]) && file_exists(ABSOLUTE_PATH.'cache/'.$module.'/'.$name))
		{
			$this->cache[$module][$name] = file_get_contents(ABSOLUTE_PATH.'cache/'.$module.'/'.$name);
		}
	}

	/**
	 * Записывает кэш в файл
	 *
	 * @param string $name метка кэша
	 * @param string $module название модуля
	 * @return void
	 */
	private function write_cache($name, $module)
	{
		if (empty($this->cache[$module][$name]))
		{
			$this->cache[$module][$name] = '';
		}

		if (! is_dir(ABSOLUTE_PATH."cache/".$module))
		{
			if(! mkdir(ABSOLUTE_PATH."cache/".$module, 0777))
			{
				throw new Exception('Невозможно создать папку '.ABSOLUTE_PATH."cache/".$module.'. Установите права на запись (777) для папки '.ABSOLUTE_PATH.'cache.');
			}
		}

		if(! $fp = fopen(ABSOLUTE_PATH."cache/".$module.'/'.$name, "w"))
		{
			throw new Exception('Невозможно записать файл '.ABSOLUTE_PATH."cache/".$module.'/'.$name.'. Установите права на запись (777) для на папку '.ABSOLUTE_PATH."cache/".$module.' и для файла '.ABSOLUTE_PATH."cache/".$module.'/'.$name.'.');
		}
		fwrite($fp, $this->cache[$module][$name]);
		fclose($fp);

		if (empty($this->cache[$module][$name]))
		{
			if(! unlink(ABSOLUTE_PATH.'cache/'.$module.'/'.$name))
			{
				throw new Exception('Невозможно удалить файл '.ABSOLUTE_PATH.'cache/'.$module.'/'.$name.'. Проверьте права (777) доступа к файлу.');
			}
		}
	}
}