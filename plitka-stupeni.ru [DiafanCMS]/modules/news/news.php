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
 * News
 *
 * Контроллер модуля "Новости"
 */
class News extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->rewrite_variable_names = array('page', 'show', 'cat', 'year', 'month', 'day');
		$this->diafan->rewrite_variable_names = $this->rewrite_variable_names;
		
		$model = new News_model($this->diafan);
		
		if ($this->diafan->show)
		{
			$this->result = $model->id();
		}
		elseif (! $this->diafan->configmodules("cat") || $this->diafan->year || $this->diafan->month)
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
		$this->diafan->_tpl->get($this->view, 'news', $this->result);
	}

	/**
	 * Шаблонная функция: блок новостей
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'cat_id', 'images', 'images_variation', 'site_id', 'template');
		
		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;
		$cat_ids  = explode(",", $attributes["cat_id"]);
		$site_ids = explode(",", $attributes["site_id"]);
		$images   = intval($attributes["images"]);
		$images_variation = $attributes["images_variation"] ? strval($attributes["images_variation"]) : 'medium';

		Customization::inc('modules/news/news.model.php');
		$model = new News_model($this->diafan);
		$result = $model->show_block($count, $cat_ids, $site_ids, $images, $images_variation);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'news', $result))
		{
			$this->diafan->_tpl->get('show_block', 'news', $result);
		}
	}

	/**
	 * Шаблонная функция: блок связанных новостей
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

		if ($this->diafan->module != "news" || ! $this->diafan->show)
			return;

		Customization::inc('modules/news/news.model.php');
		$model = new News_model($this->diafan);
		$result = $model->show_block_rel($count, $images, $images_variation);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_rel_'.$attributes["template"], 'news', $result))
		{
			$this->diafan->_tpl->get('show_block_rel', 'news', $result);
		}
	}

	/**
	 * Шаблонная функция: календарь архива новостей
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_calendar($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'only_news', 'detail', 'site_id', 'cat_id', 'template');

		$cat_id  = $attributes["cat_id"];
		$site_id = $attributes["site_id"];
		$detail = in_array($attributes["detail"], array("day", "month", "year")) ? $attributes["detail"] : "month";
		$template = $attributes["template"];

		if ($attributes["only_news"] && ($site_id && $this->diafan->cid != $site_id || $this->diafan->module != "news"))
		{
			return false;
		}

		Customization::inc('modules/news/news.model.php');
		$model  = new News_model($this->diafan);
		$result = $model->show_calendar($detail, $site_id, $cat_id, $template);
		if (! $result)
		{
			return;
		}

		if (! $attributes["template"] || ! $text = $this->diafan->_tpl->get('show_calendar_'.($detail == "day" ? '_day' : '').$attributes["template"], 'news', $result))
		{
			$text = $this->diafan->_tpl->get('show_calendar'.($detail == "day" ? '_day' : ''), 'news', $result);
		}
		if($detail == "day")
		{
			echo $text;
		}
	}
}