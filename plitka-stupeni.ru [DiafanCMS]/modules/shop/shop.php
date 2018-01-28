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
 * Shop
 *
 * Контроллер модуля "Магазин"
 */
class Shop extends Controller
{
	/**
	 * Инициализация модуля
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->rewrite_variable_names = array('page', 'show', 'cat', 'sort', 'param');
		$this->diafan->rewrite_variable_names = $this->rewrite_variable_names;

		$model = new Shop_model($this->diafan);

		if ($this->diafan->show)
		{
			$model->id();
		}
		elseif ($this->diafan->param)
		{
			$model->list_param();
		}
		elseif(isset($_GET["action"]) && $_GET["action"] === 'search')
		{
			$model->list_search();
		}
		elseif(isset($_GET["action"]) && $_GET["action"] === 'compare')
		{
			$model->compare();
		}
		elseif(isset($_GET["action"]) && $_GET["action"] === 'file' && isset($_GET["code"]))
		{
			$model->file_get();
		}
		elseif (! $this->diafan->configmodules("cat"))
		{
			$model->list_();
		}
		elseif (! $this->diafan->cat)
		{
			$model->first_page();
		}
		else
		{
			$model->list_category();
		}

		$this->result = $model->get_result();
		$this->get_global_variables();
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
		$this->diafan->_tpl->get($this->view, 'shop', $this->result);
	}

	/**
	 * Блок товаров
	 *
	 * Шаблонный тег <insert name="show_block" module="shop" [count="количество"]
	 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
	 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
	 * [sort="порядок_вывода"] [param="дополнительные_условия"]
	 * [hits_only="только_хиты"] [action_only="только акции"] [new_only="только_новинки"]
	 * [only_shop="выводить_только_на_странице_модуля"] [template="шаблон"]>:
	 * блок товаров
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'only_shop', 'count', 'cat_id', 'site_id', 'images', 'images_variation', 'sort', 'param', 'template',
		'hits_only', 'action_only', 'new_only');
		
		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;
		$cat_ids  = explode(",", $attributes["cat_id"]);
		$site_ids = explode(",", $attributes["site_id"]);
		$images  = intval($attributes["images"]);
		$images_variation = $attributes["images_variation"] ? strval($attributes["images_variation"]) : 'medium';
		$param   = $attributes["param"];
		$sort    = in_array($attributes["sort"], array("date", "rand", "price", "sale")) ? $attributes["sort"] : "";
		$only_shop = $attributes["only_shop"];
		$hits_only = (bool) $attributes["hits_only"];
		$action_only  = (bool) $attributes["action_only"];
		$new_only   = (bool) $attributes["new_only"];

		if ($only_shop && ($this->diafan->module != "shop" || in_array($this->diafan->cid, $site_ids)))
			return;

		Customization::inc('modules/shop/shop.model.php');
		$model = new Shop_model($this->diafan);
		$model->show_block($count, $cat_ids, $site_ids, $sort, $images, $images_variation, $param, $hits_only,
		$action_only, $new_only);
		$result = $model->get_result();
	//	print_r($result);
		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_'.$attributes["template"], 'shop', $result))
		{
			$this->diafan->_tpl->get('show_block', 'shop', $result);
		}
	}

	/**
	 * Блок похожих товаров
	 *
	 * Шаблонный тег <insert name="show_block_rel" module="shop" [count="количество"]
	 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
	 * [template="шаблон"]>:
	 * блок похожих товаров
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

		if ($this->diafan->module != "shop" || ! $this->diafan->show)
			return false;

		Customization::inc('modules/shop/shop.model.php');
		$model = new Shop_model($this->diafan);
		$model->show_block_rel($count, $images, $images_variation);
		$result = $model->get_result();

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_rel_'.$attributes["template"], 'shop', $result))
		{
			$this->diafan->_tpl->get('show_block_rel', 'shop', $result);
		}
	}

	/**
	 * Блок товаров, которые обычно покупают с текущим товаром
	 *
	 * Шаблонный тег <insert name="show_block" module="shop" [count="количество"]
	 * [images="количество_изображений"] [images_variation="тег_размера_изображений"]
	 * [template="шаблон"]>:
	 * блок товаров, которые обычно покупают с текущим товаром
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_block_order_rel($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'count', 'images', 'images_variation', 'template');

		$count   = $attributes["count"] ? intval($attributes["count"]) : 3;
		$images  = intval($attributes["images"]);
		$images_variation = $attributes["images_variation"] ? strval($attributes["images_variation"]) : 'medium';

		if ($this->diafan->module != "shop" || ! $this->diafan->show)
			return false;

		Customization::inc('modules/shop/shop.model.php');
		$model = new Shop_model($this->diafan);
		$model->show_block_order_rel($count, $images, $images_variation);
		$result = $model->get_result();

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_block_order_rel_'.$attributes["template"], 'shop', $result))
		{
			$this->diafan->_tpl->get('show_block_order_rel', 'shop', $result);
		}
	}

	/**
	 * Форма поиска по товарам
	 *
	 * Шаблонный тег <insert name="show_search" module="shop" [ajax="подгружать_результаты"]
	 * [cat_id="категория"] [site_id="страница_с_прикрепленным_модулем"]
	 * [only_shop="выводить_только_на_странице_модуля"] [template="шаблон"]>:
	 * форма поиска по товарам
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_search($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'only_shop', 'cat_id', 'site_id', 'template', 'ajax');

		$only_shop = $attributes["only_shop"];
		$cat_ids   = $attributes["cat_id"] === 'current' || $attributes["cat_id"] === 'all' ? $attributes["cat_id"] : explode(",", $attributes["cat_id"]);
		$site_ids  = explode(",", $attributes["site_id"]);
		$ajax      = $attributes["ajax"] == "true" ? true : false;

		if ($cat_ids === 'current')
		{
			if($this->diafan->cat && $this->diafan->module == "shop" && (count($site_ids) == 1 && $site_ids[0] == 0 || in_array($this->diafan->cid, $site_ids)))
			{
				$cat_ids  = array($this->diafan->cat);
				$site_ids = array($this->diafan->cid);
			}
			else
			{
				$cat_ids = array();
			}
		}

		if ($only_shop && ($this->diafan->module != "shop" || $site_ids && ! in_array($this->diafan->cid, $site_ids)))
			return;

		Customization::inc('modules/shop/shop.model.php');
		$model = new Shop_model($this->diafan);
		$result = $model->show_search($cat_ids, $site_ids, $ajax);

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_search_'.$attributes["template"], 'shop', $result))
		{
			$this->diafan->_tpl->get('show_search', 'shop', $result);
		}
	}

	/**
	 * Форма активации купона
	 * 
	 * Шаблонный тег <insert name="show_add_coupon" module="shop" [template="шаблон"]>:
	 * форма активации купона
	 * 
	 * @param array $attributes атрибуты шаблонного тега
	 * @return void
	 */
	public function show_add_coupon($attributes)
	{
		$attributes = $this->get_attributes($attributes, 'template');

		if (! $this->diafan->_user->id)
			return;

		Customization::inc('modules/shop/shop.model.php');
		$model = new Shop_model($this->diafan);
		$result = $model->show_add_coupon();

		// нельзя добавить два купона
		if ($result["count"])
			return;

		if (! $attributes["template"] || ! $this->diafan->_tpl->get('show_add_coupon_'.$attributes["template"], 'shop', $result))
		{
			$this->diafan->_tpl->get('show_add_coupon', 'shop', $result);
		}
	}
}