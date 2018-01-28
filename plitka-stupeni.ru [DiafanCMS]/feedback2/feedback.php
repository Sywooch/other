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
 * Feedback
 *
 * Контроллер модуля "Обратная связь"
 */
class Feedback extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$model = new Feedback_model($this->diafan);
		$this->result = $model->form();
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return boolean true
	 */
	public function show_module()
	{
		if (! empty($this->result["text"]))
		{
			echo $this->result["text"];
			return true;
		}
		$this->diafan->_tpl->get('form', 'feedback', $this->result);
		return true;
	}

	/**
	 * Шаблонная функция: форма добавления сообщения
	 *
	 * @param array $attributes атрибуты шаблонного тега
	 * @return boolean
	 */
	public function show_form($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'site_id', 'template');

		$site_id = intval($attributes["site_id"]);

		Customization::inc('modules/feedback/feedback.model.php');
		$model = new Feedback_model($this->diafan);
		$result = $model->form($site_id, true);
		if ($result)
		{
			if (! $attributes["template"] || ! $this->diafan->_tpl->get('form_'.$attributes["template"], 'feedback', $result))
			{
				$this->diafan->_tpl->get('form', 'feedback', $result);
			}
		}
		return true;
	}
}