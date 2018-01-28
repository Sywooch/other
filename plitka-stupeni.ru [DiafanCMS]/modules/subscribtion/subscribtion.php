<?php
/**
 * @package    Diafan.CMS
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
 * Subscribtion
 *
 * Контроллер модуля "Рассылки"
 */
class Subscribtion extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$model = new Subscribtion_model($this->diafan);
		if(empty($_GET["action"]))
		{
			$_GET["action"] = '';
		}
		switch($_GET["action"])
		{
			case "del":
				$this->result = $model->del();
				break;
			default:
				$this->result = $model->edit();
		}		
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	function show_module()
	{
		switch($this->result["action"])
		{
			case "error":
				$this->diafan->_tpl->get('error', 'subscribtion', $this->result);
				break;
			case "edit":
				$this->diafan->_tpl->get('edit', 'subscribtion', $this->result);
				break;
		}
	}

	/**
	 * Шаблонная функция: форма подписки на рассылки
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_form($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');		
		
		Customization::inc('modules/subscribtion/subscribtion.model.php');
		$model = new Subscribtion_model($this->diafan);
		$result = $model->form();
		
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('form_'.$attributes["template"], 'subscribtion', $result))
		{
			$this->diafan->_tpl->get('form', 'subscribtion', $result);
		}
	}
}