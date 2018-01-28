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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Languages_model
 *
 * Модель модуля "Языки сайта"
 */
class Languages_model extends Model
{
	/**
	 * Генерирует данные для шаблонной функции: блок ссылок на языковые версии сайта
	 *
	 * @return array
	 */
	public function show_block()
	{
		if (count($this->diafan->languages) < 2)
		{
			return false;
		}

		$result = array();

		foreach ($this->diafan->languages as $row)
		{
			if($row["id"] != _LANG)
			{
				$row["current"] = false;
				$row["link"] = BASE_PATH.(! $row["base_site"] ? $row["shortname"].'/' : '')
				//.($_GET["rewrite"]?$_GET["rewrite"].'/':'')
				;
			}
			else
			{
				$row["current"] = true;
				$row["link"] = '';
			}
			$row["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'languages');
			$result[] = $row;
		}

		return $result;
	}
}