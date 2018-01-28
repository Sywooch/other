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
 * Ads
 *
 * Контроллер модуля "Объявления"
 */
class Ads extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->rewrite_variable_names = array('page', 'show', 'cat', 'year', 'month', 'day', 'param');
		$this->diafan->rewrite_variable_names = $this->rewrite_variable_names;

		$model = new Ads_model($this->diafan);

		if ($this->diafan->show)
		{
			$this->result = $model->id();
		}
		elseif ($this->diafan->param)
		{
			$this->result = $model->list_param();
		}
		elseif(isset($_GET["action"]) && $_GET["action"] === 'search')
		{
			$this->result = $model->list_search();
		}
		elseif(isset($_GET["action"]) && $_GET["action"] === 'my')
		{
			$this->result = $model->list_my();
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
		if (! empty($this->result["err"]))
		{
			echo $this->result["err"];
			return;
		}
		$this->diafan->_tpl->get($this->view, 'ads', $this->result);
	}

	/**
	 * Шаблонная функция: блок товаров
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'only_ads', 'count', 'cat_id', 'site_id', 'images', 'images_variation', 'sort', 'param', 'template');

		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;
		$cat_ids  = explode(",", $attributes["cat_id"]);
		$site_ids = explode(",", $attributes["site_id"]);
		$images  = intval($attributes["images"]);
		$images_variation = $attributes["images_variation"] ? strval($attributes["images_variation"]) : 'medium';
		$param   = $attributes["param"];
		$sort    = in_array($attributes["sort"], array("date", "rand")) ? $attributes["sort"] : "date";
		$only_ads = $attributes["only_ads"];

		if ($only_ads && ($this->diafan->module != "ads" || ! in_array($this->diafan->cid, $site_ids)))
			return;

		Customization::inc('modules/ads/ads.model.php');
		$model = new Ads_model($this->diafan);
		$result = $model->show_block($count, $cat_ids, $site_ids, $sort, $images, $images_variation, $param);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'ads', $result))
		{
			$this->diafan->_tpl->get('show_block', 'ads', $result);
		}
	}

	/**
	 * Шаблонная функция: блок связанных объявлений
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

		if ($this->diafan->module != "ads" || ! $this->diafan->show)
			return false;

		Customization::inc('modules/ads/ads.model.php');
		$model = new Ads_model($this->diafan);
		$result = $model->show_block_rel($count, $images, $images_variation);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_rel_'.$attributes["template"], 'ads', $result))
		{
			$this->diafan->_tpl->get('show_block_rel', 'ads', $result);
		}
	}

	/**
	 * Шаблонная функция: форма поиска объявлений
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_search($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'only_ads', 'cat_id', 'site_id', 'template', 'ajax');

		$only_ads = $attributes["only_ads"];
		$cat_ids   = $attributes["cat_id"] === 'current' || $attributes["cat_id"] === 'all' ? $attributes["cat_id"] : explode(",", $attributes["cat_id"]);
		$site_ids  = explode(",", $attributes["site_id"]);
		$ajax     = $attributes["ajax"] == "true" ? true : false;

		if ($cat_ids === 'current')
		{
			if($this->diafan->cat && $this->diafan->module == "ads" && (count($site_ids) == 1 && $site_ids[0] == 0 || in_array($this->diafan->cid, $site_ids)))
			{
				$cat_ids  = array($this->diafan->cat);
				$site_ids = array($this->diafan->cid);
			}
			else
			{
				$cat_ids = array();
			}
		}

		if ($only_ads && ($this->diafan->module != "ads" || $site_ids && ! in_array($this->diafan->cid, $site_ids)))
			return;

		Customization::inc('modules/ads/ads.model.php');
		$model = new Ads_model($this->diafan);
		$result = $model->show_search($cat_ids, $site_ids, $ajax);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_search_'.$attributes["template"], 'ads', $result))
		{
			$this->diafan->_tpl->get('show_search', 'ads', $result);
		}
	}

	/**
	 * Шаблонная функция: форма добавления объявления
	 *
	 * @param array $attributes атрибуты шаблонного тега
	 * @return boolean
	 */
	public function show_form($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'only_ads', 'site_id', 'cat_id', 'template');

		$only_ads = $attributes["only_ads"];
		$cat_ids   = $attributes["cat_id"] === 'current' ? $attributes["cat_id"] : explode(",", $attributes["cat_id"]);
		$site_ids  = explode(",", $attributes["site_id"]);


		if ($only_ads && ($this->diafan->module != "ads" || $site_ids && ! in_array($this->diafan->cid, $site_ids)))
			return;

		if ($cat_ids === 'current')
		{
			if($this->diafan->cat && $this->diafan->module == "ads" && (count($site_ids) == 1 && $site_ids[0] == 0 || in_array($this->diafan->cid, $site_ids)))
			{
				$cat_ids  = array($this->diafan->cat);
				$site_ids = array($this->diafan->cid);
			}
			else
			{
				$cat_ids = array();
			}
		}

		Customization::inc('modules/ads/ads.model.php');
		$model = new Ads_model($this->diafan);
		$result = $model->form($site_ids, $cat_ids, true);
		if ($result)
		{
			if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_form_'.$attributes["template"], 'ads', $result))
			{
				$this->diafan->_tpl->get('form', 'ads', $result);
			}
		}
		return true;
	}
}