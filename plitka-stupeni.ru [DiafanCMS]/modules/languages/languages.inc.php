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
 * Languages_inc
 *
 * Подключение модуля "Языки сайта"
 */
class Languages_inc extends Model
{
	/**
	 * @var array подключенные языковые файлы модулей
	 */
	private $modules;

	/**
	 * @var array перевод интерфейса, разбитый по модулям
	 **/
	private $languages_translate;

	/**
	 * @var boolean модуль прошел проверку является ли версия сайта русской и определен язык для перевода
	 **/
	private $check;

	/**
	 * @var boolean это русская версия сайта
	 **/
	private $is_ru = false;

	/**
	 * @var integer номер языка для перевода
	 **/
	private $lang_id;

	/**
	 * Отдает значение перевода строки
	 *
	 * @param string $name текст для перевода
	 * @param string $module_name модуль
	 * @param boolean $useradmin выдавать форму для редактирования
	 * @param array $args
	 * @return string
	 */
	public function get($name, $module_name = '', $useradmin = false, $args = array())
	{
		if (! $name)
		{
			return '';
		}

		if(! $module_name)
		{
			$module_name = $this->diafan->module;
		}

		$type = IS_ADMIN ? 'admin' : 'site';
		if($module_name == 'useradmin')
		{
			$type = 'admin';
		}

		if(empty($this->check[$type]))
		{
			foreach($this->diafan->languages as $language)
			{
				if($type == 'admin' && $language["base_admin"])
				{
					$this->lang_id = $language["id"];
				}
			}
			if($type == 'site')
			{
				$this->lang_id = _LANG;
			}
			elseif(! $this->lang_id)
			{
				$this->lang_id = $this->diafan->languages[0]["id"];
			}
			foreach($this->diafan->languages as $language)
			{
				if($language["id"] == $this->lang_id && in_array($language["shortname"], array('ru', 'rus')))
				{
					$this->is_ru = true;
				}
			}
			$this->check[$type] = true;
		}
		$value = '';

		if(! isset($this->languages_translate["common"]))
		{
			$this->languages_translate["common"] = array();
			$result = DB::query("SELECT text, text_translate FROM {languages_translate} WHERE module_name='' AND type='%s' AND lang_id=%d", $type, $this->lang_id);
			while ($row = DB::fetch_array($result))
			{
				$this->languages_translate["common"][$row["text"]] = $row["text_translate"];
			}
		}

		$prepare_name = trim($name);

		if($module_name && ! isset($this->languages_translate[$module_name]))
		{
			$this->languages_translate[$module_name] = array();
			$result = DB::query("SELECT text, text_translate FROM {languages_translate} WHERE module_name='%s' AND type='%s' AND lang_id=%d", $module_name, $type, $this->lang_id);
			while ($row = DB::fetch_array($result))
			{
				$this->languages_translate[$module_name][$row["text"]] = $row["text_translate"];
			}
		}

		if($module_name && isset($this->languages_translate[$module_name][$prepare_name]))
		{
			$value = $this->languages_translate[$module_name][$prepare_name];
		}
		elseif(isset($this->languages_translate["common"][$prepare_name]))
		{
			$value = $this->languages_translate["common"][$prepare_name];
		}
		else
		{
			if(! $this->is_ru)
			{
				$this->languages_translate[($module_name ? $module_name : "common")][$prepare_name] = '';
				DB::query("INSERT INTO {languages_translate} (text, text_translate, module_name, type, lang_id) VALUES ('%s', '', '%h', '%s', %d)", $prepare_name, $type == 'site' ? $module_name : '', $type, $this->lang_id);
			}
		}
		if(! $value)
		{
			$value = $name;
		}

		if(! empty($args))
		{
			$value = vsprintf($value, $args);
		}
		if ($useradmin)
		{
			$text = $this->diafan->_useradmin->get_lang($value, $name, $module_name);
		}
		else
		{
			$text = $value;
		}
		return $text;
	}
}