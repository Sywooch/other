<?php
/**
 * Общие функции ядра
 *
 * @package    Diafan.CMS
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
 * Core
 *
 * Общие функции ядра
 */
abstract class Core
{
	/**
	 * @var array настройки модуля
	 */
	public $configmodules = array();

	/**
	 * @var array языки сайта
	 */
	public $languages = array();

	/**
	 * @var integer основной язык сайта
	 */
	public $language_base_site;

	/**
	 * @var integer основной язык для административной части
	 */
	public $language_base_admin;

	/**
	 * @var array кэш родителей
	 */
	private $get_parents_cache = array();

	/**
	 * Редирект
	 *
	 * @param string $url URL для редиректа
	 * @param integer $http_response_code статус-код
	 * @return void
	 */
	public function redirect($url = '', $http_response_code = 302)
	{
		if (strpos( $url, 'http') === false)
		{
			$url = BASE_PATH_HREF.$url;
		}
		$url = str_replace(array("\n", "\r", '&amp;'), array('', '', '&'), $url);
		session_write_close();
		header('Location: '.$url, true, $http_response_code);
		exit;
	}

	/**
	 * Редиректс помошью JavaScript
	 *
	 * @param string $url URL для редиректа
	 * @return void
	 */
	public function redirect_js($url = '')
	{
		if (strpos($url, 'http') === false)
		{
			$url = BASE_PATH_HREF.$url;
		}
		$url = str_replace(array("\n", "\r"), '', $url);
		echo '<script language="javascript" type="text/javascript">window.location.href=\''.$url.'\';</script>';
		exit;
	}

	/**
	 * Получает из массива переменную и приводя ее к типу в соответствии с маской
	 * (0 – вырезает все пробелы, 1 – вырезает тэги, 2 – оставляет только числа).
	 *
	 * @param array $array массив с переменной
	 * @param string $name имя переменной в массиве
	 * @param mixed $default значение по-умолчанию
	 * @param integer $mask тип преобразования
	 * @return mixed
	 */
	public function get_param($array, $name, $default = null, $mask = 0)
	{
		if (isset($array[$name]))
		{
			if (is_string($array[$name]))
			{
				switch($mask)
				{
					case 0:
						$array[$name] = trim($array[$name]);
						break;

					case 1:
						$array[$name] = str_replace('"','&quot;',strip_tags($array[$name]));
						break;

					case 2:
						$array[$name] = (int)preg_replace("/\D/", "", $array[$name]);
						break;
				}
				$array[$name] = addslashes($array[$name]);
			}
			return $array[$name];
		}
		else
		{
			return $default;
		}
	}

	/**
	 * Возвращает значение переменной $name в конфигурации модуля $module_name для языковой версии
	 * $lang_id и страницы $site_id. Если задано значение $value, функция записывает новое значение.
	 *
	 * @param string $name имя переменной в конфигурации
	 * @param string $module_name название модуля
	 * @param integer $site_id раздел сайта
	 * @param integer $lang_id номер языковой версии
	 * @param boolean $value новое значение
	 * @return mixed
	 */
	public function configmodules($name, $module_name = '', $site_id = '', $lang_id = _LANG, $value = false)
	{
		if (! $site_id && $value === false)
		{
			if (! IS_ADMIN)
			{
				$site_id = $this->cid;
			}
			elseif ($this->site)
			{
				$site_id = $this->site;
			}
			else
			{
				global $array;
				$site_id = $array["site_id"];
			}
			if (! $site_id)
			{
				$site_id = 0;
			}
		}
		if (! $module_name)
		{
			$module_name = $this->module;
		}
		if (! isset($this->configmodules[$module_name]))
		{
			$this->configmodules[$module_name] = array();
			$result = DB::query("SELECT * FROM {config} WHERE module_name='%h'", $module_name);
			while ($row = DB::fetch_array($result))
			{
				$this->configmodules[$module_name][$row["site_id"].$row["name"].$row["lang_id"]] = $row["value"];
			}
		}
		if($value !== false)
		{
			if(isset($this->configmodules[$module_name][$site_id.$name.$lang_id]))
			{
				if($this->configmodules[$module_name][$site_id.$name.$lang_id] != $value)
				{
					DB::query("UPDATE {config} SET value='%s' WHERE module_name='%h' AND site_id=%d AND name='%h' AND lang_id=%d", $value, $module_name, $site_id, $name, $lang_id);
				}
			}
			else
			{
				DB::query("INSERT INTO {config} (value, module_name, site_id, name, lang_id) VALUES ('%h', '%h', %d, '%h', %d)", $value, $module_name, $site_id, $name, $lang_id);
			}
			$this->configmodules[$module_name][$site_id.$name.$lang_id] = $value;
			return;
		}
		if (isset($this->configmodules[$module_name][$site_id.$name.$lang_id]))
		{
			return $this->configmodules[$module_name][$site_id.$name.$lang_id];
		}
		elseif ($lang_id && isset($this->configmodules[$module_name]['0'.$name.$lang_id]))
		{
			return $this->configmodules[$module_name]['0'.$name.$lang_id];
		}
		elseif (isset($this->configmodules[$module_name][$site_id.$name.'0']))
		{
			return $this->configmodules[$module_name][$site_id.$name.'0'];
		}
		elseif (isset($this->configmodules[$module_name]['0'.$name.'0']))
		{
			return $this->configmodules[$module_name]['0'.$name.'0'];
		}
	}

	/**
	 * Записывает в глобальную переменную $this->diafan->laguages массив языков сайта
	 *
	 * @return void
	 */
	public function get_languages()
	{
		if (!$this->languages)
		{
			$result = DB::query("SELECT * FROM {languages} ORDER BY base_site DESC, id ASC");
			while ($row = DB::fetch_array($result))
			{
				if($row["base_admin"])
				{
					if($this->language_base_admin)
					{
						$row["base_admin"] = false;
					}
					else
					{
						$this->language_base_admin = $row["id"];
					}
				}
				if($row["base_site"])
				{
					if($this->language_base_site)
					{
						$row["base_site"] = false;
					}
					else
					{
						$this->language_base_site = $row["id"];
					}
				}
				$this->languages[] = $row;
			}
			if(! $this->language_base_site)
			{
				$this->languages[0]["base_site"] = true;
				$this->language_base_site = $this->languages[0]["id"];
			}
			if(!$this->language_base_admin)
			{
				$this->languages[0]["base_admin"] = true;
				$this->language_base_admin = $this->languages[0]["id"];
			}
		}
	}

	/**
	 * Сокращает текст
	 *
	 * @param string $text исходный текст
	 * @param integer $length количество символов для сокращения
	 * @return string
	 */
	public function short_text($text, $length = 80)
	{
		$text = strip_tags($text);
		if (utf::strlen($text) > $length + 20)
		{
			$cut_point = utf::strlen($text) - utf::strlen(utf::stristr(utf::substr($text, $length), " "));
			$text = utf::substr($text, 0, $cut_point).'...';
		}
		return $text;
	}

	/**
	 * Подготавливает текст для отображения в XML-файле
	 *
	 * @param string $text исходный текст
	 * @return string
	 */
	public function prepare_xml($text)
	{
		$repl = array('&nbsp', '"','&','>','<',"'");
		$replm = array(' ', '&quot;', '&amp;', '&gt;', '&lt;', '&apos;');
		
		$text = str_replace($repl, $replm, strip_tags($text));
		return $text;
	}

	/**
	 * Конвертирует количество бит в байты, килобайты, мегабайты.
	 *
	 * @param integer $size размер в байтах
	 * @return string
	 */
	public function convert($size)
	{
		if (!$size)
		{
			return '';
		}
		$measure = array('b', 'Kb', 'Mb', 'Gb', 'Tb', 'Pb', 'Eb', 'Zb', 'Yb');
		return round($size / pow(1024, ($exp = floor(log($size, 1024)))), 2).' '.$measure[$exp];
	}

	/**
	 * Кодирует пароль.
	 *
	 * @param string $text исходный пароль
	 * @return string
	 */
	public function encrypt($text)
	{
		return md5($text);
	}

	/**
	 * Выдает массив номеров детей.
	 *
	 * @param integer $id номер исходного элемента
	 * @param string $table таблица
	 * @param boolean $trash не учитывать элементы, удаленные в корзину
	 * @return array
	 */
	public function get_children($id, $table, $trash = true)
	{
		$chidren = array();
		$result = DB::query("SELECT element_id FROM {".$table."_parents} WHERE parent_id=%d".(! in_array($table, array("trash", "adminsite")) ? " AND trash='0'": ''), $id);
		while ($row = DB::fetch_array($result))
		{
			$chidren[] = $row["element_id"];
		}
		return $chidren;
	}

	/**
	 * Выдает массив номеров родителей.
	 *
	 * @param integer $id номер исходного элемента
	 * @param string $table таблица
	 * @return array
	 */
	public function get_parents($id, $table)
	{
		$parents = array();
		$result = DB::query("SELECT parent_id FROM {".$table."_parents} WHERE element_id=%d".(! in_array($table, array("trash", "adminsite")) ? " AND trash='0'": ''), $id);
		while ($row = DB::fetch_array($result))
		{
			$parents[] = $row["parent_id"];
		}
		return $parents;
	}

	/**
	 * Переводит кириллицу в транслит для строки text.
	 *
	 * @param string $text исходный текст
	 * @return string
	 */
	public function translit($text)
	{
		$ru = array('а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ы', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ы', 'Э', 'Ю', 'Я', ' ');

		$tr = array('a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'ts', 'ch', 'sh', 'sch', 'y', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'YO', 'ZH', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'KH', 'TS', 'CH', 'SH', 'SCH', 'Y', 'E', 'YU', 'YA', '-');
		return preg_replace('/[^A-Za-z0-9-_\.\/]+/', '', str_replace($ru, $tr, $text));
	}

	/**
	 * Переводит дату из в формата гггг-мм-дд в формат дд.мм.гггг.
	 *
	 * @param string date дата в формате гггг-мм-дд
	 * @return string
	 */
	public function formate_from_date($date)
	{
		if(! preg_match('/^(\d{4})\-(\d{2})\-(\d{2})$/', trim($date), $matches))
		{
			return '00.00.0000';
		}
		list($dummy, $year, $month, $day) = $matches;
		if($day > 31)
		{
			$day = 31;
		}
		if($month > 12)
		{
			$month = 12;
		}
		$date = $day.'.'.$month.'.'.$year;
		return $date;
	}

	/**
	 * Переводит дату из в формата гггг-мм-дд чч:мм в формат дд.мм.гггг чч:мм.
	 *
	 * @param string date дата в формате гггг-мм-дд чч:мм
	 * @return string
	 */
	public function formate_from_datetime($date)
	{
		if(! preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s+(\d{2})\:(\d{2})$/', trim($date), $matches))
		{
			return '00.00.0000 00:00';
		}
		list($dummy, $year, $month, $day, $hour, $minutes) = $matches;
		if($day > 31)
		{
			$day = 31;
		}
		if($month > 12)
		{
			$month = 12;
		}
		if($hour > 23)
		{
			$hour = 23;
		}
		if($minutes > 59)
		{
			$minutes = 59;
		}
		$date = $day.'.'.$month.'.'.$year.' '.$hour.':'.$minutes;
		return $date;
	}

	/**
	 * Переводит дату из в формата дд.мм.гггг в формат гггг-мм-дд.
	 *
	 * @param string date дата в формате дд.мм.гггг
	 * @return string
	 */
	public function formate_in_date($date)
	{
		if(! preg_match('/^(\d{1,2})\.(\d{1,2})\.(\d{4})$/', trim($date), $matches))
		{
			return '0000-00-00';
		}
		list($dummy, $day, $month, $year) = $matches;
		if($day > 31)
		{
			$day = 31;
		}
		if($month > 12)
		{
			$month = 12;
		}
		$date = $year.'-'.$month.'-'.$day;
		return $date;
	}

	/**
	 * Переводит дату из в формата дд.мм.гггг чч:мм в формат гггг-мм-дд чч:мм.
	 *
	 * @param string date дата в формате дд.мм.гггг чч:мм
	 * @return string
	 */
	public function formate_in_datetime($date)
	{
		if(! preg_match('/^(\d{1,2})\.(\d{1,2})\.(\d{4})\s+(\d{1,2})\:(\d{1,2})$/', trim($date), $matches))
		{
			return '0000-00-00 00:00';
		}
		list($dummy, $day, $month, $year, $hour, $minutes) = $matches;
		if($day > 31)
		{
			$day = 31;
		}
		if($month > 12)
		{
			$month = 12;
		}
		if($hour > 23)
		{
			$hour = 23;
		}
		if($minutes > 59)
		{
			$minutes = 59;
		}
		$date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minutes;
		return $date;
	}

	/**
	 * Возвращает дату, переданную в формате dd.mm.yyyy hh:ii в виде даты в формате UNIX.
	 *
	 * @param $date дата в формате dd.mm.yyyy hh:ii
	 * @return integer
	 */
	public function unixdate($date)
	{
		if(! $date)
		{
			return 0;
		}
		$return = 0;
		if(preg_match('/^(\d{1,2})\.(\d{1,2})\.(\d{4})\s+(\d{1,2})\:(\d{1,2})$/', trim($date), $matches))
		{
			list($dummy, $day, $month, $year, $hour, $minutes) = $matches;
			if($day > 31)
			{
				$day = 31;
			}
			if($month > 12)
			{
				$month = 12;
			}
			if($hour > 23)
			{
				$hour = 23;
			}
			if($minutes > 59)
			{
				$minutes = 59;
			}
			$return = mktime($hour, $minutes, 0, $month, $day, $year);
		}
		elseif(preg_match('/^(\d{1,2})\.(\d{1,2})\.(\d{4})$/', trim($date), $matches))
		{
			list($dummy, $day, $month, $year) = $matches;
			if($day > 31)
			{
				$day = 31;
			}
			if($month > 12)
			{
				$month = 12;
			}
			$return = mktime(0, 0, 0, $month, $day, $year);
		}
		return $return;
	}
}
