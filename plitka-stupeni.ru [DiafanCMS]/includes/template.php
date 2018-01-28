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
 * Template
 * 
 * Представление в пользовательской части
 */
class Template extends Diafan
{
	/**
	 * @var array подключенные шаблоны модулей
	 */
	private $include_templates;

	/**
	 * Подключает шаблон
	 *
	 * @param string $name имя функции
	 * @param string $module название модуля
	 * @param mixed $result передаваемые в шаблон данные
	 * @return mixed
	 */
	public function get($name, $module, $result)
	{
		if (strpos($module, '_') !== false)
		{
			$m = explode('_', $module, 2);
		}
		$name = preg_replace('/[^a-z0-9_]+/', '', $name);

		$current_module = $this->diafan->current_module;
		if (! empty($m))
		{
			if(file_exists(ABSOLUTE_PATH.'modules/'.$m[0].'/'.$m[1].'/views/'.$m[1].'.view.'.$name.'.php'))
			{
				$this->diafan->current_module = $m[0];
				include(ABSOLUTE_PATH.'modules/'.$m[0].'/'.$m[1].'/views/'.$m[1].'.view.'.$name.'.php');
				$this->diafan->current_module = $current_module;
				if(isset($text))
				{
					return $text;
				}
				return true;
			}
		}
		else
		{
			if(file_exists(ABSOLUTE_PATH.'modules/'.$module.'/views/'.$module.'.view.'.$name.'.php'))
			{
				$this->diafan->current_module = $module;
				include(ABSOLUTE_PATH.'modules/'.$module.'/views/'.$module.'.view.'.$name.'.php');
				$this->diafan->current_module = $current_module;
				if(isset($text))
				{
					return $text;
				}
				return true;
			}
		}

		return false;
	}

	/**
	 * Заменяет шаблонные теги, ссылки в тексте
	 *
	 * @param string $text
	 * @return void
	 */
	private function htmleditor($text)
	{
		$text = $this->diafan->_route->replace_id_to_link($text);
		if($this->diafan->configmodules("keywords", $this->diafan->current_module))
		{
			$text = $this->diafan->_keywords->get($text);
		}
		$this->diafan->_parser_theme->get_function_in_theme($text);
	}
}