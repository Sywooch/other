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
 * Photo
 *
 * Контроллер модуля "Фотогалерея"
 */
class Photo extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->rewrite_variable_names = array('page', 'cat');
		if ($this->diafan->configmodules('page_show'))
		{
			$this->rewrite_variable_names[] = 'show';
		}
		$this->diafan->rewrite_variable_names = $this->rewrite_variable_names;
		
		$model = new Photo_model($this->diafan);
		
		if ($this->diafan->show && $this->diafan->configmodules('page_show'))
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
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show_module()
	{
		$this->diafan->_tpl->get($this->view, 'photo', $this->result);
	}

	/**
	 * Шаблонная функция: блок фотографий
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'cat_id', 'sort', 'site_id', 'images_variation', 'template');

		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;
		$cat_ids  = explode(",", $attributes["cat_id"]);
		$site_ids = explode(",", $attributes["site_id"]);
		$sort    = $attributes["sort"] == "date" || $attributes["sort"] == "rand" ? $attributes["sort"] : "";
		$images_variation = $attributes["images_variation"] ? strval($attributes["images_variation"]) : 'medium';

		Customization::inc('modules/photo/photo.model.php');
		$model = new Photo_model($this->diafan);
		$result = $model->show_block($count, $cat_ids, $site_ids, $sort, $images_variation);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'photo', $result))
		{
			$this->diafan->_tpl->get('show_block', 'photo', $result);
		}
	}

	/**
	 * Шаблонная функция: блок связанных фотографий
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block_rel($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'images_variation', 'template');

		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;
		$images_variation = $attributes["images_variation"] ? strval($attributes["images_variation"]) : 'medium';

		if ($this->diafan->module != "photo" || ! $this->diafan->show)
			return;

		Customization::inc('modules/photo/photo.model.php');
		$model = new Photo_model($this->diafan);
		$result = $model->show_block_rel($count, $images_variation);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_rel_'.$attributes["template"], 'photo', $result))
		{
			$this->diafan->_tpl->get('show_block_rel', 'photo', $result);
		}
	}
}