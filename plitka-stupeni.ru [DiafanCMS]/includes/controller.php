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
 * Controller
 * 
 * Каркас для контроллера модулей
 */
class Controller extends Diafan
{
	/**
	 * @var array переменные, передаваемые в URL страницы
	 */
	public $rewrite_variable_names = array();

	/**
	 * @var array сгенерированные в модели данные, передаваемые в шаблон
	 */
	protected $result;

	/**
	 * @var string представление модуля для текущей страницы
	 */
	protected $view;

	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init(){}

	/**
	 * Выводит шаблон модуля
	 * 
	 * @return void
	 */
	public function show_module(){}

	/**
	 * Определяет свойства страницы, если они заданы в модуле
	 * 
	 * @return boolean true
	 */
	protected function get_global_variables()
	{
		$this->diafan->timeedit = ! empty($this->result["timeedit"]) && $this->diafan->timeedit < $this->result["timeedit"]
					  ? $this->result["timeedit"]
					  : $this->diafan->timeedit;
		if (! empty($this->result["path"]))
		{
			$this->diafan->path = $this->result["path"];
		}

		if (! empty($this->result["title_meta"]))
		{
			$this->diafan->titlemodule_meta = $this->result["title_meta"];
		}
		if (! empty($this->result["titlemodule"]))
		{
			$this->diafan->titlemodule = $this->result["titlemodule"];
		}
		if (! empty($this->result["edit_meta"]))
		{
			$this->diafan->edit_meta = $this->result["edit_meta"];
		}

		if (! empty($this->result["keywords"]))
		{
			$this->diafan->keywords = $this->result["keywords"];
		}
		if (! empty($this->result["descr"]))
		{
			$this->diafan->descr = $this->result["descr"];
		}
		if (! empty($this->result["theme"]))
		{
			$this->diafan->theme = $this->result["theme"];
		}
		if (! empty($this->result["view"]))
		{
			$this->view = $this->result["view"];
		}
		return true;
	}

	/**
	 * Задает неопределенным атрибутам шаблонного тега значение по умолчанию
	 * 
	 * @param array $attributes массив определенных атрибутов
	 * @return array
	 */
	protected function get_attributes($attributes)
	{
		$a = func_get_args();
		for ($i = 1; $i < count($a); $i++)
		{
			if (is_array($a[$i]))
			{
				$name = $a[$i][0];
				$value = $a[$i][1];
			}
			else
			{
				$name = $a[$i];
				$value = '';
			}
			if (empty($attributes[$name]))
			{
				$attributes[$name] = $value;
			}
		}
		return $attributes;
	}
}