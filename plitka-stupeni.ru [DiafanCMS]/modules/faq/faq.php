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
 * Faq
 *
 * Контроллер модуля "Вопрос-Ответ"
 */
class Faq extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->rewrite_variable_names = array('page', 'show', 'cat');
		$this->diafan->rewrite_variable_names = $this->rewrite_variable_names;

		$model = new Faq_model($this->diafan);
		
		if ($this->diafan->show)
		{
			$this->result = $model->id();
		}
		elseif (! $this->diafan->configmodules("cat"))
		{
			$this->result = $model->list_();
		}
		elseif (! $this->diafan->cat)
		{
			$this->result = $model->first_page();
		}
		else
		{
			$this->result = $model->list_category();
		}
		$this->get_global_variables();
		$this->result["form"] = $model->form();
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show_module()
	{
		$this->diafan->_tpl->get($this->view, 'faq', $this->result);
	}

	/**
	 * Шаблонная функция: блок вопросов и ответов
	 *
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'cat_id', 'sort', 'site_id', 'often', 'template');
		
		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;
		$cat_ids  = explode(",", $attributes["cat_id"]);
		$site_ids = explode(",", $attributes["site_id"]);
		$sort    = $attributes["sort"] == "date" || $attributes["sort"] == "rand" ? $attributes["sort"] : "date";
		$often   = $attributes["often"] ? true : false;

		Customization::inc('modules/faq/faq.model.php');
		$model = new Faq_model($this->diafan);
		$result = $model->show_block($count, $cat_ids, $site_ids, $often, $sort);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'faq', $result))
		{
			$this->diafan->_tpl->get('show_block', 'faq', $result);
		}
	}

	/**
	 * Шаблонная функция: блок связанных вопросов
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block_rel($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'template');

		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;

		if ($this->diafan->module != "faq" || ! $this->diafan->show)
			return;

		Customization::inc('modules/faq/faq.model.php');
		$model = new Faq_model($this->diafan);
		$result = $model->show_block_rel($count);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_rel_'.$attributes["template"], 'faq', $result))
		{
			$this->diafan->_tpl->get('show_block_rel', 'faq', $result);
		}
	}

	/**
	 * Шаблонная функция: форма добавления вопроса
	 *
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_form($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'cat_id', 'site_id', 'template');

		$cat_id  = intval($attributes["cat_id"]);
		$site_id = intval($attributes["site_id"]);

		include_once ABSOLUTE_PATH.'modules/faq/faq.model.php';
		$model = new Faq_model($this->diafan);
		$result = $model->form($site_id, $cat_id, true);
		if (! empty($result))
		{
			if (! $attributes["template"] || ! $this->diafan->_tpl->get('form_'.$attributes["template"], 'faq', $result))
			{
				$this->diafan->_tpl->get('form', 'faq', $result);
			}
		}
	}
}