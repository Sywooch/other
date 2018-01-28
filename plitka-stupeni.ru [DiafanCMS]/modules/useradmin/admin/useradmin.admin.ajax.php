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
 * Useradmin_admin_ajax
 *
 * Обработка запроса на редактирование данных из пользовательской части
 */
class Useradmin_admin_ajax extends Diafan
{
	/**
	 * @var array результат выполенения
	 */
	private $result;

	/**
	 * Вызывает обработку Ajax-запросов
	 * 
	 * @return void
	 */
	public function ajax()
	{
		if (! empty($_POST['module']) && $_POST['module'] == 'useradmin')
		{
			if (empty($_POST["module_name"]) || empty($_POST["name"]))
			{
				$this->result["errors"][0] = 'ERROR';
				return $this->send_errors(true);
			}
			if ($_POST["module_name"] != "languages" && empty($_POST["element_id"]))
			{
				$this->result["errors"][0] = 'ERROR';
				return $this->send_errors(true);
			}
			if (! $this->diafan->_user->checked)
			{
				$this->result["errors"][0] = 'ERROR';
				return $this->send_errors(true);
			}
			list($module_name) = explode('_', $_POST["module_name"]);
			if (! $this->diafan->_user->roles('edit', 'useradmin', $this->diafan->_user->module_roles)
			    || ! $this->diafan->_user->roles('edit', $module_name))
			{
				$this->result["errors"][0] = 'ERROR';
				return $this->send_errors(true);
			}
			include_once ABSOLUTE_PATH.'includes/model.php';
			if (! empty($_POST["is_lang"]))
			{
				$lang_id = $this->diafan->get_param($_POST, "lang_id", "", 2);
				$name = trim(urldecode($_POST["name"]));
				$lang_module_name = $this->diafan->get_param($_POST, "lang_module_name", "", 1);
				if($id = DB::query_result("SELECT id FROM {languages_translate} WHERE text='%s' AND module_name='%h' AND type='site' AND lang_id=%d LIMIT 1", $name, $lang_module_name, $lang_id))
				{
					DB::query("UPDATE {languages_translate} SET text_translate='%s' WHERE id=%d", $_POST["value"], $id);
				}
				else
				{
					DB::query("INSERT INTO {languages_translate} (text, text_translate, module_name, lang_id, type) VALUES ('%s', '%s', '%h', %d, 'site')", $name, $_POST["value"], $lang_module_name, $lang_id);
				}
			}
			else
			{
				$type = ! empty($_POST["type"]) ? $_POST["type"] : $this->diafan->_useradmin->type($_POST["name"]);
				switch($type)
				{
					case 'editor':
						if(! empty($_POST["typograf"]))
						{
							include_once(ABSOLUTE_PATH."plugins/remotetypograf.php");

							$remoteTypograf = new RemoteTypograf();

							$remoteTypograf->htmlEntities();
							$remoteTypograf->br (false);
							$remoteTypograf->p (true);
							$remoteTypograf->nobr (3);
							$remoteTypograf->quotA ('laquo raquo');
							$remoteTypograf->quotB ('bdquo ldquo');

							$_POST["value"] = $remoteTypograf->processText ($_POST["value"]);
						}
						$mask = "'%s'";
						break;
					case 'date':
						$_POST["value"] = $this->diafan->unixdate($_POST["value"]);
						$mask = "'%d'";
						break;
					case 'text':
					case 'textarea':
						$mask = "'%h'";
						break;
					case 'numtext':
						$mask = "'%d'";
						break;
				}
				$lang_id = $this->diafan->get_param($_POST, "lang_id", "", 2);
	
				DB::query("UPDATE {%h} SET %h".($lang_id ? $lang_id : '')."=".$mask." WHERE id=%d",$_POST["module_name"],  $_POST["name"], $_POST["value"], $_POST["element_id"]);
				$module = explode('_', $_POST["module_name"]);
				$this->diafan->_cache->delete("", $module[0]);
			}

			$this->result["success"] = true;

			return $this->send_errors();
		}
		return false;
	}

	/**
	 * Отправляет результат
	 *
	 * @return boolean
	 */
	private function send_errors()
	{
		if (! empty($this->result["errors"]) || ! empty($this->result["success"]))
		{
			include_once ABSOLUTE_PATH.'plugins/json.php';
			echo to_json($this->result);
			return true;
		}
		return false;
	}
}