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
 * Files
 *
 * Контроллер модуля "Файловый архив"
 */
class Files extends Controller
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
		
		$model = new Files_model($this->diafan);
		
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
	}

	/**
	 * Выводит контент модуля
	 * 
	 * @return void
	 */
	public function show_module()
	{
		$this->diafan->_tpl->get($this->view, 'files', $this->result);
	}

	/**
	 * Шаблонная функция: блок файлов
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'cat_id', 'images', 'images_variation', 'sort', 'site_id', 'template');

		$count      = $attributes["count"] ? intval($attributes["count"]) : 3;
		$cat_ids    = explode(",", $attributes["cat_id"]);
		$site_ids   = explode(",", $attributes["site_id"]);
		$sort       = $attributes["sort"] == "date" || $attributes["sort"] == "rand" ? $attributes["sort"] : "";
		$images      = intval($attributes["images"]);
		$images_variation = $attributes["images_variation"] ? strval($attributes["images_variation"]) : 'medium';

		Customization::inc('modules/files/files.model.php');
		$model = new Files_model($this->diafan);
		$result = $model->show_block($count, $cat_ids, $site_ids, $images, $images_variation, $sort);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'files', $result))
		{
			$this->diafan->_tpl->get('show_block', 'files', $result);
		}
	}

	/**
	 * Шаблонная функция: блок связанных файлов
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block_rel($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'images', 'images_variation', 'template');

		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;
		$images  = intval($attributes["images"]);
		$images_variation = $attributes["images_variation"] ? strval($attributes["images_variation"]) : 'medium';

		if ($this->diafan->module != "files" || ! $this->diafan->show)
			return;

		Customization::inc('modules/files/files.model.php');
		$model = new Files_model($this->diafan);
		$result = $model->show_block_rel($count, $images, $images_variation);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_rel_'.$attributes["template"], 'files', $result))
		{
			$this->diafan->_tpl->get('show_block_rel', 'files', $result);
		}
	}
}