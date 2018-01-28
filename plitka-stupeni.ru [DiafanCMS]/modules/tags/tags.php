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
 * Tags
 *
 * Контроллер модуля "Теги"
 */
class Tags extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$model = new Tags_model($this->diafan);
		$this->rewrite_variable_names = array('page', 'show');

		if (! $this->diafan->show)
		{
			$this->result = $model->show_block(true);
		}
		else
		{
			$this->result = $model->list_module();
		}

		if (! empty($this->result["title"]))
		{
			$this->diafan->name = $this->result["title"];
		}
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show_module()
	{
		if (! $this->diafan->show)
		{
			$this->diafan->_tpl->get('show_block', 'tags', $this->result);
		}
		else
		{
			$this->diafan->_tpl->get('list', 'tags', $this->result);
		}
	}

	/**
	 * Шаблонный тег <insert name="show_block" module="tags" [template="шаблон"]>:
	 * облако тегов
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		if ($this->diafan->module == "tags" && ! $this->diafan->show)
			return;

		$attributes = $this->get_attributes($attributes, 'template');

		Customization::inc('modules/tags/tags.model.php');
		$model = new Tags_model($this->diafan);
		$result = $model->show_block();

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'tags', $result))
		{
			$this->diafan->_tpl->get('show_block', 'tags', $result);
		}
	}
}