<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Useradmin_inc
 *
 * Подключение модуля "Редактирование из пользовательской части"
 */
class Useradmin_inc extends Model
{
	/**
	 * Генерирует ссылку на форму редактирования
	 *
	 * @param string $text значение переменной
	 * @param string $name название переменной
	 * @param integer $element_id номер элемента
	 * @param string $table_name таблица
	 * @param integer $lang_id номер языка
	 * @param string $type тип данных
	 * @return string
	 */
	public function get($text, $name, $element_id, $table_name, $lang_id = 0, $type = '')
	{
		if (!$text)
		{
			return $text;
		}
		list($module_name) = explode('_', $table_name);

		if (! USERADMIN ||  ! $this->diafan->_user->roles('edit', 'useradmin', $this->diafan->_user->module_roles) || ! $this->diafan->_user->roles('edit', $module_name))
		{
			return $text;
		}

		$result["text"] = $text;
		$result["name"] = $name;
		$result["element_id"] = $element_id;
		$result["module_name"] = $table_name;
		$result["is_lang"] = false;
		if ($type)
		{
			$result["type"] = $type;
		}
		else
		{
			$result["type"] = $this->type($name);
		}

		$result["lang_id"] = $lang_id;
		$text = $this->diafan->_tpl->get('get', 'useradmin', $result);
		return $text;
	}

	/**
	 * Генерирует ссылку на форму редактирования перевода
	 *
	 * @param string $value текущий перевод
	 * @param string $name строка для перевода
	 * @param string $module_name модуль
	 * @return string
	 */
	public function get_lang($value, $name, $module_name)
	{
		if (IS_ADMIN || ! USERADMIN || !$this->diafan->_user->roles('edit', "languages"))
		{
			return $value;
		}
		$result["name"] = urlencode($name);
		$result["text"] = $value;
		$result["element_id"] = 0;
		$result["lang_module_name"] = $module_name;
		$result["module_name"] = "languages";
		$result["is_lang"] = true;
		$result["type"] = "text";
		$result["lang_id"] = _LANG;
		$text = $this->diafan->_tpl->get('get', 'useradmin', $result);
		return $text;
	}

	/**
	 * Генерирует ссылку на форму редактирования meta-данных
	 *
	 * @param string $name название переменной
	 * @param integer $element_id номер элемента
	 * @param string $module_name модуль
	 * @return string
	 */
	public function get_meta($name, $element_id, $module_name)
	{
		if (! USERADMIN ||  ! $this->diafan->_user->roles('edit', 'useradmin', $this->diafan->_user->module_roles) || ! $this->diafan->_user->roles('edit', $module_name))
		{
			return '';
		}

		return BASE_PATH
		.'useradmin/edit/?module_name='.$module_name
		.'&amp;name='.$name
		.'&amp;element_id='.$element_id
		.'&amp;lang_id='._LANG
		.'&amp;type='.($name == 'title_meta' ? 'text' : 'textarea')
		.'&amp;iframe=true'
		.'&amp;width=800&amp;height=400'
		.'&amp;rand='.rand(0, 999);
	}

	/**
	 * Генерирует данные для формы редактирования
	 *
	 * @return boolean
	 */
	public function edit()
	{
		if (! USERADMIN || empty($_GET["module_name"]) || empty($_GET["name"]))
		{
			include ABSOLUTE_PATH.'includes/404.php';
			return false;
		}
		if (empty($_GET["is_lang"]) && empty($_GET["element_id"]))
		{
			include ABSOLUTE_PATH.'includes/404.php';
			return false;
		}
		list($module_name) = explode('_', $_GET["module_name"]);
		if (! $this->diafan->_user->roles('edit', 'useradmin', $this->diafan->_user->module_roles)
		    || ! $this->diafan->_user->roles('edit', $module_name))
		{
			include ABSOLUTE_PATH.'includes/404.php';
			return false;
		}
		$result["name"] = $this->diafan->get_param($_GET, "name", "", 1);
		$result["module_name"] = $this->diafan->get_param($_GET, "module_name", "", 1);
		$result["lang_id"] = $this->diafan->get_param($_GET, "lang_id", "", 2);
		$result["is_lang"] = ! empty($_GET["is_lang"]) ? true : false;
		$result["lang_module_name"] = $this->diafan->get_param($_GET, "lang_module_name", "", 1);
		$result["error"] = false;
		if ($result["is_lang"])
		{
			$result["type"] = "text";
			$result["element_id"] = 0;
			$result["name"] = $result["name"];
			$result["text"] = str_replace('"', '&quot;', $this->diafan->_languages->get(urldecode($result["name"]), $result["lang_module_name"]));
		}
		else
		{
			$result["type"] = !empty($_GET["type"]) ? $_GET["type"] : $this->type($_GET["name"]);
			$result["element_id"] = (int) $this->diafan->get_param($_GET, "element_id", "", 2);
			$result["text"] = DB::query_result("SELECT %h".($result["lang_id"] ? $result["lang_id"] : '')." FROM {%h} WHERE id=%d LIMIT 1", $result["name"], $result["module_name"], $result["element_id"]);
		}
		$user_id = DB::query_result("SELECT user_id FROM {sessions} WHERE session_id='%h' LIMIT 1", session_id());
		$pass = DB::query_result("SELECT password FROM {users} WHERE id=%d LIMIT 1", $user_id);
		$result["hash"] = md5(substr($pass, mt_rand(0, 32), mt_rand(0, 32)).mt_rand(23, 567).substr($pass, mt_rand(0, 32), mt_rand(0, 32)));

		DB::query("INSERT INTO {sessions_hash} (user_id, created, hash) VALUES (%d, %d, '%h')", $user_id, time(), $result["hash"]);

		header('Content-Type: text/html; charset=utf-8');
		$this->diafan->_tpl->get('edit', 'useradmin', $result);
		return true;
	}

	/**
	 * Возвращает тип данных по имени переменной
	 *
	 * @param string $name имя редактируемой переменной
	 * @return string
	 */
	public function type($name)
	{
		switch ($name)
		{
			case 'created':
				$type = 'date';
				break;
			case 'name':
				$type = 'text';
				break;
			default:
				$type = 'editor';
				break;
		}
		return $type;
	}
}