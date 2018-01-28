<?php
/**
 * Набор функций для работы с файлами и папками
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

class Files
{
	/**
	 * @var string ошибка операции
	 */
	private static $error;

	/**
	 * Проверяет существует ли файл
	 *
	 * @param string $file_path путь до файла относительно корня сайта
	 * @return boolean
	 */
	public static function check_file($file_path)
	{
		if(! file_exists(ABSOLUTE_PATH.$file_path))
		{
			throw new Exception('Ошибочный путь.');
			return false;
		}
		return true;
	}

	/**
	 * Загружает файл
	 *
	 * @param string $tmp_path путь, где храниться временный файл
	 * @param string $name имя файла
	 * @param string $path путь до папки, в которую будет загружен файл, относительно корня сайта
	 * @return void
	 */
	public static function upload_file($tmp_path, $name, $path)
	{
		$file_path = ($path ? $path.'/' : '').$name;
		if(self::is_writable($path) && copy($tmp_path, ABSOLUTE_PATH.$file_path))
		{
			chmod(ABSOLUTE_PATH.$file_path, 0777);	
		}
		else
		{
			$conn_id = self::connect_ftp();
			if($conn_id)
			{
				if (! ftp_put($conn_id, $file_path, $tmp_path))
				{
					unlink($tmp_path);
				throw new Exception('Не удалось сохранить файл. Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.($path ? $path : '/').'.');
				}	
				ftp_close($conn_id);
			}
			else
			{
				unlink($tmp_path);
				throw new Exception('Не удалось сохранить файл. '.self::$error.' Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.($path ? $path : '/').'.');
			}
		}
		unlink($tmp_path);
	}

	/**
	 * Сохраняет файл
	 *
	 * @param string $content содержание файла
	 * @param string $file_path путь до файла относительно корня сайта
	 * @return void
	 */
	public static function save_file($content, $file_path)
	{
		if(! file_exists(ABSOLUTE_PATH.$file_path))
		{
			$arr = explode("/", $file_path);
			unset($arr[count($arr)-1]);
			$path = implode("/", $file_path);
			if(self::is_writable($path))
			{
				if($fp = fopen(ABSOLUTE_PATH.$file_path, "w"))
				{
					fwrite($fp, $content);
					fclose($fp);
					return;
				}
			}
		}
		elseif(self::is_writable($file_path))
		{
			if($fp = fopen(ABSOLUTE_PATH.$file_path, "w"))
			{
				fwrite($fp, $content);
				fclose($fp);
				return;
			}
		}
		$tmp_path = ABSOLUTE_PATH.'cache/'.md5('files'.mt_rand(0, 99999999));
		if(! $fp = fopen($tmp_path, "w"))
		{
			throw new Exception('Установите права на запись (777) для папки cache.');
		}
		fwrite($fp, $content);
		fclose($fp);

		$conn_id = self::connect_ftp();
		if($conn_id)
		{
			if (! ftp_put($conn_id, $file_path, $tmp_path))
			{
				unlink($tmp_path);
				throw new Exception('Не удалось сохранить файл. Проверьте данные для подключения по FTP или установите права на запись (777) для файла '.$file_path.'.');
			}	
			ftp_close($conn_id);
		}
		else
		{
			unlink($tmp_path);
			throw new Exception('Не удалось сохранить файл. '.self::$error.' Проверьте данные для подключения по FTP или установите права на запись (777) для файла '.$file_path.'.');
		}
	}

	/**
	 * Переименовывает файл
	 *
	 * @param string $name новое имя
	 * @param string $old_name старое имя
	 * @param string $path путь до папки, в которой лежит файл, относительно корня сайта
	 * @return  void
	 */
	public static function rename_file($name, $old_name, $path)
	{
		if(! self::is_writable(($path ? $path.'/' : '').$old_name) || ! rename(ABSOLUTE_PATH.($path ? $path.'/' : '').$old_name, ($path ? $path.'/' : '').$name))
		{
			$conn_id = self::connect_ftp();
			if($conn_id)
			{
				if (! ftp_rename($conn_id, ($path ? $path.'/' : '').$old_name, ($path ? $path.'/' : '').$name))
				{
					throw new Exception('Не удалось переименовать. Проверьте данные для подключения по FTP или установите права на запись (777) для файла '.($path ? $path.'/' : '').$old_name.'.');
				}	
				ftp_close($conn_id);
			}
			else
			{
				throw new Exception('Не удалось переименовать. '.self::$error.' Проверьте данные для подключения по FTP или установите права на запись (777) для файла '.($path ? $path.'/' : '').$old_name.'.');
			}
		}
	}

	/**
	 * Удаляет файл
	 *
	 * @param string $file_path путь до файла относительно корня сайта
	 * @return  void
	 */
	public static function delete_file($file_path)
	{
		if(! file_exists(ABSOLUTE_PATH.$file_path))
		{
			return;
		}
		if(self::is_writable($file_path))
		{
			if(unlink(ABSOLUTE_PATH.$file_path))
			{
				return;
			}
		}
		$conn_id = self::connect_ftp();
		if($conn_id)
		{
			if (! ftp_delete($conn_id, $file_path))
			{
				throw new Exception('Не удалось удалить. Проверьте данные для подключения по FTP или установите права на запись (777) для файла '.$file_path.'.');
			}	
			ftp_close($conn_id);
		}
		else
		{
			throw new Exception('Не удалось удалить. '.self::$error.' Проверьте данные для подключения по FTP или установите права на запись (777) для файла '.$file_path.'.');
		}
	}

	/**
	 * Проверяет существует ли папка
	 *
	 * @param string $dir_path путь до папки относительно корня сайта
	 * @return  void
	 */
	public static function check_dir($dir_path)
	{
		if(! is_dir(ABSOLUTE_PATH.$dir_path))
		{
			throw new Exception('Ошибочный путь.');
			return false;
		}
		return true;
	}

	/**
	 * Создает папку
	 *
	 * @param string $name имя новой папки
	 * @param string $path путь до папки-родителя относительно корня сайта
	 * @return  void
	 */
	public static function create_dir($name, $path)
	{
		if(self::is_writable($path) && mkdir(ABSOLUTE_PATH.($path ? $path.'/' : '').$name))
		{
			chmod(ABSOLUTE_PATH.($path ? $path.'/' : '').$name, 0777);
		}
		else
		{
			$conn_id = self::connect_ftp();
			if($conn_id)
			{
				if (! ftp_mkdir($conn_id, ($path ? $path.'/' : '').$name))
				{
					throw new Exception('Не удалось создать папку. Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.($path ? $path : '/').'.');
				}	
				ftp_close($conn_id);
			}
			else
			{
				throw new Exception('Не удалось создать папку. '.self::$error.' Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.($path ? $path : '/').'.');
			}
		}
	}

	/**
	 * Переименовывает папку
	 *
	 * @param string $name новое имя папки
	 * @param string $old_name старое имя папки
	 * @param string $path путь до папки-родителя относительно корня сайта
	 * @return  void
	 */
	public static function rename_dir($name, $old_name, $path)
	{
		if(! self::is_writable(($path ? $path.'/' : '').$old_name) || ! rename(ABSOLUTE_PATH.($path ? $path.'/' : '').$old_name, ($path ? $path.'/' : '').$name))
		{
			$conn_id = self::connect_ftp();
			if($conn_id)
			{
				if (! ftp_rename($conn_id, ($path ? $path.'/' : '').$old_name, ($path ? $path.'/' : '').$name))
				{
					throw new Exception('Не удалось переименовать. Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.($path ? $path.'/' : '').$old_name.'.');
				}	
				ftp_close($conn_id);
			}
			else
			{
				throw new Exception('Не удалось переименовать. '.self::$error.' Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.($path ? $path.'/' : '').$old_name.'.');
			}
		}
	}

	/**
	 * Удаляет папку
	 *
	 * @param string $dir_path путь до папки относительно корня сайта
	 * @return  void
	 */
	public static function delete_dir($dir_path)
	{
		if(! $dir_path)
		{
			throw new Exception('Нельзя удалить корневую директорию.');
		}
		if(self::is_writable($dir_path))
		{
			$conn_id = false;
			self::delete_recursive($dir_path, $conn_id);
		}
		else
		{
			$conn_id = self::connect_ftp();
			if($conn_id)
			{
				self::delete_recursive($dir_path, $conn_id);
			}
			else
			{
				throw new Exception('Не удалось удалить. '.self::$error.' Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.$dir_path.'.');
			}
		}
	}

	/**
	 * Удаляет папку рекурсивно
	 *
	 * @param string $dir_path путь до папки относительно корня сайта
	 * @return  void
	 */
	private static function delete_recursive($path, &$conn_id)
	{
		$dir = opendir(ABSOLUTE_PATH.$path);
		while (($file = readdir($dir)) !== false)
		{
			if($file == '.' || $file == '..')
				continue;

			if(is_dir(ABSOLUTE_PATH.$path.'/'.$file))
			{
				self::delete_recursive($path.'/'.$file, $conn_id);
			}
			else
			{
				if($conn_id)
				{
					if (! ftp_delete($conn_id, $path.'/'.$file))
					{
						ftp_close($conn_id);
						throw new Exception('Не удалось удалить. Проверьте данные для подключения по FTP или установите права на запись (777) для файла '.$path.'/'.$file.'.');
					}
				}
				else
				{
					if(! self::is_writable($path.'/'.$file) || ! unlink(ABSOLUTE_PATH.$path.'/'.$file))
					{
						throw new Exception('Не удалось удалить. Проверьте данные для подключения по FTP или установите права на запись (777) для файла '.$path.'/'.$file.'.');
					}
				}
			}
		}
		closedir($dir);
		if($conn_id)
		{
			if (! ftp_rmdir($conn_id, $path))
			{
				ftp_close($conn_id);
				throw new Exception('Не удалось удалить. Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.$path.'.');
			}
		}
		else
		{
			if(! self::is_writable($path) || ! rmdir(ABSOLUTE_PATH.$path))
			{
				throw new Exception('Не удалось удалить. Проверьте данные для подключения по FTP или установите права на запись (777) для папки '.$path.'.');
			}
		}
	}

	/**
	 * Пробует установить FTP-соединение
	 *
	 * @return resource идентификатор соединения с FTP сервером
	 */
	private static function connect_ftp()
	{
		self::$error = '';
		if(! defined('FTP_HOST') || ! defined('FTP_LOGIN') || ! defined('FTP_PASSWORD') || ! FTP_HOST || ! FTP_LOGIN || ! FTP_PASSWORD)
		{
			return false;
		}
		$host = FTP_HOST;
		$port = null;
		if(strpos($host, ':') !== false)
		{
			list($host, $port) = explode(':', FTP_HOST, 2);
		}
		if(! $conn_id = ftp_connect($host, $port))
		{
			self::$error = 'Ошибка подключения по FTP. Хост не найден.';
			return false;
		}
		if(! ftp_login($conn_id, FTP_LOGIN, FTP_PASSWORD))
		{
			ftp_close($conn_id);
			self::$error = 'Ошибка подключения по FTP. Указаны неверные данные для подлкючения.';
			return  false;
		}
		ftp_pasv($conn_id, true);
		if (! ftp_chdir($conn_id, FTP_DIR))
		{
			ftp_close($conn_id);
			self::$error = 'Не правильно задан относительный путь.';
			return  false;
		}
		return $conn_id;
	}

	/**
	 * Определяет, доступны ли файл или папка для записи
	 *
	 * @param string $path путь до файла или папки относительно корня сайта
	 * @param boolean $ftp учитывать возможность редактирования по FTP
	 * @return boolean
	 */
	public static function is_writable($path, $ftp = false)
	{
		if($ftp && FTP_HOST && FTP_LOGIN && FTP_PASSWORD)
		{
			return true;
		}
		/*if(is_file(ABSOLUTE_PATH.$path))
		{
			if(is_writable(ABSOLUTE_PATH.$path))
			{
				$path_dir = preg_replace('/(\/)([^\/]+)$/', '', ABSOLUTE_PATH.$path);
				return is_writable($path_dir);
			}
			else
			{
				return false;
			}
		}
		else
		{*/
			return is_writable(ABSOLUTE_PATH.$path);
		//}
	}
}