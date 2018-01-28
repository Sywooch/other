<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if ( ! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Shop_model
 *
 * Модель модуля "Магазин"
 */
class Shop_model extends Model
{
	/**
	 * @var array значения параметров, влияющих на цену
	 */
	private $depends;

	/**
	 * @var boolean false|integer сумма всех покупок текущего пользователя
	 */
	private $order_summ = 0;

	/**
	 * @var boolean false|integer стоимость товаров в корзине без учета скидок
	 */
	private $cart_summ = 0;

	/**
	 * @var bool  выводить ли все записи?
	 */
	private $view_all_records = false;

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct(&$diafan)
	{
		
		$this->diafan = &$diafan;

		$this->cart_summ = $this->diafan->_shop->price_get_cart_summ();

		if($this->diafan->_user->id)
		{
			$this->order_summ = $this->diafan->_shop->price_get_order_summ($this->diafan->_user->id);
		}

		$this->sort_config = $this->expand_sort_with_params();

		if ($this->diafan->sort > count($this->sort_config['sort_directions']))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		if(isset($_GET['view']) && $_GET['view']=="all")
		{
			//echo $_GET['view'];
			$this->view_all_records = true;
		}
	}

	/**
	 * Генерирует данные для списка товаров, если не используются категории
	 * 
	 * @return boolean
	 */
	public function list_()
	{

		if ($this->diafan->cat)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$cache_meta = array(
			"name" => "list",
			"lang_id" => _LANG,
			"page" => $this->diafan->page > 1 ? $this->diafan->page : 1,
			"site_id" => $this->diafan->cid,
			"sort" => $this->diafan->sort,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"discounts" => $this->get_tag_cache_discounts(),
			"time" => $time
		);
		//кеширование
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			////navigation//
			$this->diafan->_paginator->page = $this->diafan->page;
			$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
			$this->diafan->_paginator->navlink_tpl = $this->diafan->_route->current_link("", array("page" => "%d"));
			$this->diafan->_paginator->nen = $this->list_query_count($time);
			$links = $this->diafan->_paginator->get();
			////navigation///

			$result = $this->list_query($time);
			//	print_r($result );
			$this->result["rows"] = $this->get_elements($result);

			$this->result["paginator"] = $links;

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}
//print_r($this->result);
		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->select_price($this->result["rows"][$i]);
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);

				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);
			}
		}
		$this->theme_view();

		$this->result["link_sort"] = $this->get_sort_links($this->sort_config['sort_directions']);

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);

		$this->result['shop_link']=$this->diafan->_route->module($this->diafan->module,true);

		$this->result['sort_config'] = $this->sort_config;

		return true;
	}

	/**
	 * Получает из базы данных общее количество элементов, если не используются категории
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return integer
	 */
	private function list_query_count($time)
	{

		$count = DB::query_result(
			"SELECT COUNT(DISTINCT e.id) FROM {shop} AS e"
			. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
			. " WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d AND e.cat_id != '8'"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			. " AND (e.access='0'"
			. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			. ")", $this->diafan->cid, $time, $time
		);
		return $count;
	}

	/**
	 * Получает из базы данных элементы на одной странице, если не используются категории
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return resource
	 */
	private function list_query($time)
	{
		
		$result = DB::query_range(
			"SELECT s.id, s.[name], s.[anons], s.timeedit, s.cat_id, s.site_id, s.no_buy, s.article, s.hit, s.new, s.action, s.is_file FROM {shop} AS s"
			. ($this->diafan->sort == 1 || $this->diafan->sort == 2 ?
				" LEFT JOIN {shop_price} AS pr ON pr.good_id=s.id AND pr.trash='0'"
				." AND pr.date_start<=".$time." AND (pr.date_finish=0 OR pr.date_finish>=".$time.")"
				." AND pr.currency_id=0"
				." AND pr.role_id".($this->diafan->_user->role_id ? " IN (0,".$this->diafan->_user->role_id.")" : "=0")
				." AND pr.user_id".($this->diafan->_user->id ? " IN (0,".$this->diafan->_user->id.")" : "=0")
				." AND pr.threshold <= ".$this->cart_summ
				." AND pr.threshold_cumulative <= ".$this->order_summ
				: '')
			. " LEFT JOIN {images} i ON i.module_name = 'shop' AND i.element_id = s.id"
			. ($this->sort_config['use_params_for_sort'] ? " LEFT JOIN {shop_param_element} AS sp ON sp.element_id=s.id AND sp.trash='0' AND sp.param_id=".$this->sort_config['param_ids'][$this->diafan->sort] : '')
			. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='shop'" : "")
			. " WHERE s.[act]='1' AND s.trash='0' AND s.site_id=%d AND s.cat_id != '8'"
			." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
			. " AND (s.access='0'"
			. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			. ")"
			. " GROUP BY s.id ORDER BY ".($this->diafan->sort ? $this->sort_config['sort_directions'][$this->diafan->sort].',' : '')
			. " IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC,"
			. " s.no_buy ASC, s.sort ASC, s.id ASC",
			$this->diafan->cid, $time, $time,
			$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);
		
		//echo "22222222222222222";
		return $result;
	}

	/**
	 * Генерирует данные для списка товаров, найденных при помощи поиска
	 * 
	 * @return boolean
	 */
	public function list_search()
	{
		
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$where_param = '';
		$where = '';
		$values = array();
		$getnav = '';
		$group = '';

		$this->get_where($where, $where_param, $values, $getnav, $group);

		$values[] = $time;
		$values[] = $time;

		////navigation//
		$this->diafan->_paginator->page = $this->diafan->page;
		$this->diafan->_paginator->get_nav = $getnav;
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->nen = $this->list_search_query_count($where_param, $where, $group, $values);

		$links = $this->diafan->_paginator->get();
		////navigation///

		if($this->diafan->configmodules("theme_list_search"))
		{
			$this->result["theme"] = $this->diafan->configmodules("theme_list_search");
		}
		if($this->diafan->configmodules("view_list_search"))
		{
			$this->result["view"] = $this->diafan->configmodules("view_list_search");
		}
		else
		{
			$this->result["view"] = 'list';
		}
		$this->result["path"] = $this->get_path('shop');
		$this->result["titlemodule"] = $this->diafan->_('Поиск по товарам', false);
		if ( ! $this->diafan->_paginator->nen)
		{
			$this->result["err"] = $this->diafan->_('Извините, ничего не найдено.', false);
			if (! empty($_GET["module_ajax"]) && $_GET["module_ajax"] == "shop")
			{
				header('Content-Type: text/html; charset=utf-8');
				echo $this->result["err"];
				exit;
			}
			return $this->result;
		}

		$result = $this->list_search_query($where_param, $where, $group, $values);

		$this->result["rows"] = $this->get_elements($result);

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $links);

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->select_price($this->result["rows"][$i]);

				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);

				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);
			}
		}

		$this->result["link_sort"] = $this->get_sort_links($this->sort_config['sort_directions']);

		$this->result['sort_config'] = $this->sort_config;

		$this->result['shop_link'] = $this->diafan->_route->module($this->diafan->module, true);

		if (! empty($_GET["module_ajax"]) && $_GET["module_ajax"] == "shop")
		{
			header('Content-Type: text/html; charset=utf-8');
			$this->result["ajax"] = true;
			//$GLOBALS["include_shop_js"] = true;
			$this->result = $this->get_result();
			$this->diafan->_tpl->get($this->result["view"], 'shop', $this->result);
			exit;
		}

		return true;
	}

	/**
	 * Получает из базы данных общее количество найденных при помощи поиска элементов
	 * 
	 * @param string $where_param
	 * @param string $where
	 * @param string $group
	 * @param array $values
	 * @return integer
	 */
	private function list_search_query_count($where_param, $where, $group, $values)
	{
		$result = DB::query("SELECT ".($group ? "DISTINCT s.id" : "COUNT(s.id)")." FROM {shop} AS s"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='shop'" : "")
		.$where_param
		.($this->sort_config['use_params_for_sort'] ? " LEFT JOIN {shop_param_element} AS sp  ON sp.element_id=s.id AND sp.trash='0' AND sp.param_id=".$this->sort_config['param_ids'][$this->diafan->sort] : '')
		." WHERE s.[act]='1' AND s.trash='0' AND s.cat_id != '8'"
		." AND (s.access='0'"
		.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		.$where
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
		." GROUP BY s.id".$group,
		$values);
		if($group)
		{
			$count = DB::num_rows($result);
		}
		else
		{
			$count = DB::result($result);
		}
		return $count;
	}

	/**
	 * Получает из базы данных найденных при помощи поиска элементы на одной странице
	 * 
	 * @param string $where_param
	 * @param string $where
	 * @param string $group
	 * @param array $values
	 * @return resource
	 */
	private function list_search_query($where_param, $where, $group, $values)
	{

		$result = DB::query_range("SELECT DISTINCT s.id, s.[name], s.timeedit, s.[anons], s.cat_id, s.site_id, s.no_buy, s.article,"
		."s.hit, s.new, s.action, s.is_file FROM {shop} AS s"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='shop'" : "")
		.$where_param
		.($this->sort_config['use_params_for_sort'] ? " LEFT JOIN {shop_param_element} AS sp  ON sp.element_id=s.id AND sp.trash='0' AND sp.param_id=".$this->sort_config['param_ids'][$this->diafan->sort] : '')
		." WHERE s.[act]='1' AND s.trash='0' AND s.cat_id != '8'"
		." AND (s.access='0'"
		.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		.$where
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
		." GROUP BY s.id".$group
		." ORDER BY ".($this->diafan->sort ? $this->sort_config['sort_directions'][$this->diafan->sort].',' : '')
		." s.no_buy ASC, s.sort ASC, s.id ASC", $values, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
		return $result;
	}

	/**
	 * Генерирует данные для списка товаров, соответствующих значению доп. характеристики
	 * 
	 * @return boolean
	 */
	public function list_param()
	{

		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$cache_meta = array(
			"name" => "list_param",
			"lang_id" => _LANG,
			"page" => $this->diafan->page > 1 ? $this->diafan->page : 1,
			"site_id" => $this->diafan->cid,
			"sort" => $this->diafan->sort,
			"param" => $this->diafan->param,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"discounts" => $this->get_tag_cache_discounts(),
			"time" => $time
		);
		//кеширование
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			if ( ! $param_value = DB::fetch_array(DB::query("SELECT param_id, [name] FROM {shop_param_select} WHERE id=%d LIMIT 1", $this->diafan->param)))
			{
				include ABSOLUTE_PATH.'includes/404.php';
			}
			if ( ! $param = DB::fetch_array(DB::query("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $param_value["param_id"])))
			{
				include ABSOLUTE_PATH.'includes/404.php';
			}
			////navigation//
			$this->diafan->_paginator->page = $this->diafan->page;
			$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");

			$this->diafan->_paginator->nen = $this->list_param_query_count($time, $param_value["param_id"]);

			$this->result["paginator"] = $this->diafan->_paginator->get();
			////navigation///

			$this->result["path"] = $this->get_path('shop');
			$this->result["titlemodule"] = $param["name"].': '.$param_value["name"];

			$result = $this->list_param_query($time, $param_value["param_id"]);

			$this->result["rows"] = $this->get_elements($result);
			$this->result["param_id"] = $param_value["param_id"];
			$this->result["di_param"] = $this->diafan->param;

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->select_price($this->result["rows"][$i]);

				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);

				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);
			}
		}
		if($this->diafan->configmodules("theme_list_param"))
		{
			$this->result["theme"] = $this->diafan->configmodules("theme_list_param");
		}
		if($this->diafan->configmodules("view_list_param"))
		{
			$this->result["view"] = $this->diafan->configmodules("view_list_param");
		}
		else
		{
			$this->result["view"] = 'list';
		}

		$this->result["link_sort"] = $this->get_sort_links($this->sort_config['sort_directions']);

		$this->result['sort_config'] = $this->sort_config;

		$this->result['shop_link']=$this->diafan->_route->module($this->diafan->module,true);

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);
		return true;
	}

	/**
	 * Получает из базы данных общее количество элементов, соответствующих значению доп. характеристики
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param integer $param_id дополнительная характеристика
	 * @return integer
	 */
	private function list_param_query_count($time, $param_id)
	{
		if($param_id != 3)
		{
			$count = DB::query_result(
				"SELECT COUNT(DISTINCT s.id) FROM {shop} AS s "
				. " INNER JOIN {shop_param_element} AS e ON e.element_id=s.id"
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='shop'" : "")
				. " WHERE s.[act]='1' AND s.trash='0' AND e.param_id=%d AND e.value".$this->diafan->language_base_site."=%d"
				." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)",
				$param_id, $this->diafan->param, $time, $time
				);
		} else {
			$query = DB::query('SELECT s.id FROM diafan_shop_param_element spe 
											LEFT JOIN diafan_shop_rel AS sr ON sr.rel_element_id = spe.element_id
											LEFT JOIN diafan_shop AS s ON s.id = sr.element_id
										WHERE spe.param_id = "'.$param_id.'" AND spe.value1 = "'.$this->diafan->param.'" AND s.act1 = "1" AND s.trash = "0" GROUP BY s.id');
			$count = DB::num_rows($query);
		}
		return $count;
	}

	/**
	 * Получает из базы данных элементы на одной странице, соответствующие значению доп. характеристики
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param integer $param_id дополнительная характеристика
	 * @return resource
	 */
	public function list_param_query($time, $param_id)
	{
		
		if($param_id != 3)
		{
			if($this->diafan->sort != 1 )
			{
				$result = DB::query_range(
				"SELECT s.id, s.[name], s.timeedit, s.[anons], s.cat_id, s.site_id, s.no_buy,  s.article, s.is_file, i.id AS img_id FROM {shop} AS s"
				. " LEFT JOIN {images} i ON i.module_name = 'shop' AND i.element_id = s.id"
				. " INNER JOIN {shop_param_element} as e ON e.element_id=s.id"
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='shop'" : "")
				. ($this->sort_config['use_params_for_sort'] ? " LEFT JOIN {shop_param_element} AS sp  ON sp.element_id=s.id AND sp.trash='0'"
				. " AND sp.param_id=".$this->sort_config['param_ids'][$this->diafan->sort] : '')
				. " WHERE s.[act]='1' AND s.trash='0' AND e.param_id=%d AND e.value".$this->diafan->language_base_site."=%d"
				." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
				. " AND (s.access='0'"
				. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				. ")"
				. " GROUP BY s.id"
				. " ORDER BY ".($this->diafan->sort ? $this->sort_config['sort_directions'][$this->diafan->sort].',' : '')
				. " IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC,"
				. " s.no_buy ASC, s.sort ASC, s.id ASC",
				$param_id, $this->diafan->param, $time, $time,
				($this->view_all_records ? 0 : $this->diafan->_paginator->polog),
				($this->view_all_records ? $this->list_param_query_count($time, $param_id) : $this->diafan->_paginator->nastr));
			}
			else
			{	
					$result = DB::query_range(
					"SELECT spe.value1, s.id, s.[name], s.timeedit, s.[anons], s.cat_id, s.site_id, s.no_buy, s.article, s.is_file, i.id AS img_id FROM {shop_param_element} as spe"
					." LEFT JOIN {shop} AS s ON  s.id = spe.element_id"
					." LEFT JOIN {images} i ON i.module_name = 'shop' AND i.element_id = s.id"
					." WHERE spe.param_id='8' AND spe.element_id IN 
						(SELECT 
							s.id FROM {shop} AS s 
						INNER JOIN 
							{shop_param_element} as e ON e.element_id=s.id "
						. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='shop'" : "")
						. ($this->sort_config['use_params_for_sort'] ? " LEFT JOIN {shop_param_element} AS sp  ON sp.element_id=s.id AND sp.trash='0'"
						. " AND sp.param_id=".$this->sort_config['param_ids'][$this->diafan->sort] : '')
						. " WHERE s.[act]='1' AND s.trash='0' AND e.param_id='".$param_id."' AND e.value".$this->diafan->language_base_site."='".$this->diafan->param."'"
						." AND s.date_start<='".$time."' AND (s.date_finish=0 OR s.date_finish>='".$time."')"
						. " AND (s.access='0'"
						. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						. ")"
						. " GROUP BY s.id)"
					." GROUP BY s.id ORDER BY " 
					.($this->diafan->sort ? $this->sort_config['sort_directions'][$this->diafan->sort] : ''),
					($this->view_all_records ? 0 : $this->diafan->_paginator->polog),
					($this->view_all_records ? $this->list_param_query_count($time, $param_id) : $this->diafan->_paginator->nastr));
			}
		} else {
				if($this->diafan->sort != 1)
				{
					$result = DB::query_range('SELECT s.id, s.[name], s.timeedit, s.[anons], s.cat_id, s.site_id, s.no_buy,  s.article, s.is_file 
												FROM {shop_param_element} spe 
												LEFT JOIN diafan_shop_rel AS sr ON sr.rel_element_id = spe.element_id
												LEFT JOIN diafan_shop AS s ON s.id = sr.element_id
												LEFT JOIN {images} i ON i.module_name = "shop" AND i.element_id = s.id
											WHERE spe.param_id = "'.$param_id.'" AND spe.value1 = "'.$this->diafan->param.'" AND s.act1 = "1" AND s.trash = "0" 
											GROUP BY s.id
											ORDER BY '
											.($this->diafan->sort ? $this->sort_config['sort_directions'][$this->diafan->sort].',' : '')
											.'IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC',
						($this->view_all_records ? 0 : $this->diafan->_paginator->polog),
						($this->view_all_records ? $this->list_param_query_count($time, $param_id) : $this->diafan->_paginator->nastr));
				}
				else
				{
						$results=DB::query('SELECT s.id FROM {shop_param_element} spe 
													LEFT JOIN {shop_rel} AS sr ON sr.rel_element_id = spe.element_id
													LEFT JOIN {shop} AS s ON s.id = sr.element_id
													WHERE spe.param_id = "'.$param_id.'" AND spe.value1 = "'.$this->diafan->param.'" AND s.act1 = "1" AND s.trash = "0" 
													GROUP BY s.id');
				/*echo 'SELECT s.id FROM {shop_param_element} spe 
													LEFT JOIN {shop_rel} AS sr ON sr.rel_element_id = spe.element_id
													LEFT JOIN {shop} AS s ON s.id = sr.element_id
													WHERE spe.param_id = "'.$param_id.'" AND spe.value1 = "'.$this->diafan->param.'" AND s.act1 = "1" AND s.trash = "0" 
													GROUP BY s.id';*/
				
				$sss=array();
				while ($row = DB::fetch_array($results)){
					$sss[]=$row['id'];
				}
				$results_impl=implode(",", $sss);
						//echo $results_impl;
				
					$result = DB::query_range('SELECT spe.value1, s.id, s.[name], s.timeedit, s.[anons], s.cat_id, s.site_id, s.no_buy,  s.article, s.is_file 
												FROM {shop} s 
												LEFT JOIN {shop_param_element} AS spe ON s.id = spe.element_id
												LEFT JOIN {shop_rel} AS sr ON sr.rel_element_id = spe.element_id
												LEFT JOIN {images} i ON i.module_name = "shop" AND i.element_id = s.id
												WHERE spe.param_id = "8" AND spe.element_id IN ('.$results_impl.')
												GROUP BY s.id
												ORDER BY '
												.($this->diafan->sort ? $this->sort_config['sort_directions'][$this->diafan->sort].',' : '')
												.'IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC',
												($this->view_all_records ? 0 : $this->diafan->_paginator->polog),
												($this->view_all_records ? $this->list_param_query_count($time, $param_id) : $this->diafan->_paginator->nastr));
				
				//print_r(DB::fetch_array($result));
				}
		}
		//print_r($resul);
		
		return $result;
	}

	/**
	 * Генерирует данные для первой страницы магазина
	 * 
	 * @return boolean
	 */
	public function first_page()
	{
		if ($this->diafan->page)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
			"name" => "first_page",
			"lang_id" => _LANG,
			"site_id" => $this->diafan->cid,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"discounts" => $this->get_tag_cache_discounts(),
			"time" => $time
		);
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$result = $this->first_page_cats_query();
			while ($row = DB::fetch_array($result))
			{
				$cat = array();
				$cat["name"] = $row["name"];
				$cat["anons"] = $row["anons"];
				$cat["id"] = $row["id"];

				if (empty($this->result["timeedit"]) || $row["timeedit"] > $this->result["timeedit"])
				{
					$this->result["timeedit"] = $row["timeedit"];
				}

				$cat["children"] = $this->get_children_category($row["id"], $time);

				if ($this->diafan->configmodules("children_elements"))
				{
					$cat_ids = $this->diafan->get_children($row["id"], "shop_category");
					$cat_ids[] = $row["id"];
				}
				else
				{
					$cat_ids = array($row["id"]);
				}

				$cat["rows"] = array();
				if($this->diafan->configmodules("count_list"))
				{
					$result_elements = $this->first_page_elements_query($time, $cat_ids);
					$cat["rows"] = $this->get_elements($result_elements);
				}

				$cat["link_all"] = $this->diafan->_route->link($row["site_id"], 'shop', $row["id"]);

				# if ($this->diafan->configmodules("images_cat") && $this->diafan->configmodules("list_img_cat"))
				# {
					$cat["img"] =
					$this->diafan->_images->get(
						'medium', $row["id"], $this->diafan->module,
						$row["site_id"], $row["name"], 0, true,
						$this->diafan->configmodules("list_img_cat") == 1 ? 1 : 0,
						$cat["link_all"]
					);
				# }
				$this->result["categories"][] = $cat;
			}

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}

		if ( ! empty($this->result["categories"]))
		{
			foreach ($this->result["categories"] as $cat => $rows)
			{
				if ( ! $rows)
					continue;

				$this->result["categories"][$cat]["name"] = $this->diafan->_useradmin->get($rows["name"], 'name', $rows["id"], 'shop_category', _LANG);
				$this->result["categories"][$cat]["anons"] = $this->diafan->_useradmin->get($rows["anons"], 'anons', $rows["id"], 'shop_category', _LANG);
				$this->result["categories"][$cat]["rating"] = $this->diafan->_rating->get($rows["id"], '', 0, true);
				foreach ($rows["children"] as $k => $row)
				{
					$this->result["categories"][$cat]["children"][$k]["name"] =
							$this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'shop_category', _LANG);

					$this->result["categories"][$cat]["children"][$k]["anons"] =
							$this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'shop_category', _LANG);
				}

				foreach ($rows["rows"] as $k => $row)
				{
					$this->select_price($this->result["categories"][$cat]["rows"][$k]);

					$this->useradmin($this->result["categories"][$cat]["rows"][$k]);
					$this->format_data($this->result["categories"][$cat]["rows"][$k]);

					$this->result["categories"][$cat]["rows"][$k]["tags"] =  $this->diafan->_tags->get($row["id"]);

					$this->result["categories"][$cat]["rows"][$k]["rating"] = $this->diafan->_rating->get($row["id"]);
				}
			}
		}
		$this->theme_view_first_page();
		return true;
	}

	/**
	 * Получает из базы данных категории верхнего уровня для первой странице модуля, если категории используются
	 * 
	 * @return resource
	 */
	private function first_page_cats_query()
	{
		$result = DB::query(
		"SELECT c.id, c.[name], c.[anons], c.timeedit, c.site_id FROM {shop_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='shop'" : "")
		. " WHERE c.[act]='1' AND c.parent_id=0 AND c.trash='0' AND c.site_id=%d AND c.id != '8'"
		. " AND (c.access='0'"
		. ($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " GROUP BY c.id ORDER by c.[name]", $this->diafan->cid
		);
		return $result;
	}

	/**
	 * Получает из базы данных элементы для первой страницы модуля, если категории используются
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param array $cat_ids номера категорий, элементы из которых выбираются
	 * @return resource
	 */
	private function first_page_elements_query($time, $cat_ids)
	{
		$result = DB::query_range(
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.site_id, e.no_buy, e.article, e.hit,"
		. " e.new, e.action, e.is_file FROM {shop} AS e"
		. " INNER JOIN {shop_category_rel} AS r ON e.id=r.element_id"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
		. " WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0' AND e.cat_id != '8'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " GROUP BY e.id ORDER BY e.no_buy ASC, e.sort ASC, e.id ASC",
		implode(',', $cat_ids), $time, $time,
		0, $this->diafan->configmodules("count_list")
		);
		return $result;
	}

	/**
	 * Генерирует данные для списка товаров в группе
	 * 
	 * @return boolean
	 */
	public function list_category()
	{

		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));
		//кеширование
		$cache_meta = array(
			"name" => "list",
			"cat_id" => $this->diafan->cat,
			"lang_id" => _LANG,
			"page" => $this->diafan->page > 1 ? $this->diafan->page : 1,
			"site_id" => $this->diafan->cid,
			"sort" => $this->diafan->sort,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"discounts" => $this->get_tag_cache_discounts(),
			"time" => $time
		);
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$result = $this->list_category_query();

			if ( ! $row = DB::fetch_array($result))
			{
				include_once ABSOLUTE_PATH.'includes/404.php';
			}
			if (empty($row) || (!empty($row['access']) && !$this->access(0, $row['id'])))
			{
				include_once(ABSOLUTE_PATH.'includes/403.php');
			}
			$this->result = $row;

			$this->result["level"] = count($this->diafan->get_parents($this->diafan->cat, 'shop_category'));
			$this->result["path"] = $this->get_path('shop');

			if ($this->diafan->configmodules("images_cat"))
			{
				$this->result["img"] = $this->diafan->_images->get(
						'medium', $row["id"], $this->diafan->module,
						$this->diafan->cid, $row["name"], 0, true, 0, 'large'
					);
			}

			$this->result["children"] = $this->get_children_category($row["id"], $time);

			if ($this->diafan->configmodules("children_elements"))
			{
				// echo $this->diafan->cat.'<br>';
				$cat_ids = $this->diafan->get_children($this->diafan->cat, "shop_category");
				$cat_ids[] = $this->diafan->cat;
			}
			else
			{
				$cat_ids = array($this->diafan->cat);
			}

			////navigation//
			$this->diafan->_paginator->page = $this->diafan->page;
			$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
			$this->diafan->_paginator->navlink_tpl = $this->diafan->_route->current_link("", array("page" => "%d"));
			$this->diafan->_paginator->nen = $this->list_category_elements_query_count($time, $cat_ids);
			$links = $this->diafan->_paginator->get();
			////navigation///

			$result_elements = $this->list_category_elements_query($time, $cat_ids);
			$this->result["rows"]    = $this->get_elements($result_elements);
			$this->result["cat_ids"] = urlencode(implode(',', $cat_ids));
			$this->result["paginator"] = $links;

			$this->meta_cat($row);
			$this->theme_view_cat($row);
			
			$this->list_category_previous_next($row["sort"], $row["parent_id"]);

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}

		$this->result["text"] = $this->diafan->_useradmin->get($this->result["text"], 'text', $this->diafan->cat, 'shop_category', _LANG);

		$this->result["comments"] = $this->diafan->_comments->get($this->diafan->cat, $this->diafan->module, $this->diafan->cid, true);
		$this->result["rating"] = $this->diafan->_rating->get($this->diafan->cat, $this->diafan->module, $this->diafan->cid, true);

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->select_price($this->result["rows"][$i]);

				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);

				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);
			}
			if ( ! empty($this->result["previous"]["text"]))
			{
				$this->result["previous"]["text"] =
						$this->diafan->_useradmin->get($this->result["previous"]["text"], 'name', $this->result["previous"]["id"], 'shop_category', _LANG);
			}
			if ( ! empty($this->result["next"]["text"]))
			{
				$this->result["next"]["text"] =
						$this->diafan->_useradmin->get($this->result["next"]["text"], 'name', $this->result["next"]["id"], 'shop_category', _LANG);
			}
			foreach ($this->result["children"] as $id => $row)
			{
				$this->result["children"][$id]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'shop_category', _LANG);
				$this->result["children"][$id]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'shop_category', _LANG);
			}
			foreach ($this->result["path"] as $k => $path)
			{
				if ($k == 0)
					continue;
				$this->result["path"][$k]["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $path["id"], 'shop_category', _LANG);
			}
		}

		$this->result["link_sort"] = $this->get_sort_links($this->sort_config['sort_directions']);
		$this->result["sort_config"] = $this->sort_config;

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);
		$this->result['shop_link'] = $this->diafan->_route->module($this->diafan->module,true);

		
		
		return true;
	}

	/**
	 * Получает из базы данных данные о текущей категории для списка элементов в категории
	 * 
	 * @return resource
	 */
	private function list_category_query()
	{
		$result = DB::query("SELECT id, [name], [anons], [text], timeedit, [descr], [keywords], sort, parent_id, [title_meta], access, theme, view FROM {shop_category}"
		." WHERE [act]='1' and id=%d AND trash='0' AND site_id=%d"
		." ORDER BY sort ASC, id ASC", $this->diafan->cat, $this->diafan->cid);
		return $result;
	}

	/**
	 * Получает из базы данных количество элементов в категории
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param array $cat_ids номера категорий, элементы из которых выбираются
	 * @return integer
	 */
	private function list_category_elements_query_count($time, $cat_ids)
	{
		$count = DB::query_result(
		"SELECT COUNT(DISTINCT e.id) FROM {shop} AS e"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
		." INNER JOIN {shop_category_rel} AS r ON e.id=r.element_id"
		." WHERE e.[act]='1' AND e.trash='0' AND e.cat_id != '8'"
		." AND r.cat_id IN (%s)"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")", implode(',', $cat_ids), $time, $time
		);
		return $count;
	}

	/**
	 * Получает из базы данных элементы для списка элементов в категории
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param array $cat_ids номера категорий, элементы из которых выбираются
	 * @return resource
	 */
	private function list_category_elements_query($time, $cat_ids)
	{

		if($this->diafan->sort != 1)
		{
			$result = DB::query_range(
				"SELECT s.id, s.[name], s.cat_id, s.timeedit, s.[anons], s.site_id, s.no_buy, s.article,"
				. " s.hit, s.new, s.action, s.is_file FROM {shop} AS s"
				. " LEFT JOIN {images} i ON i.module_name = 'shop' AND i.element_id = s.id"
				. ($this->sort_config['use_params_for_sort'] ? " LEFT JOIN {shop_param_element} AS sp  ON sp.element_id=s.id AND sp.trash='0' AND sp.param_id=".$this->sort_config['param_ids'][$this->diafan->sort] : '')
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='shop'" : "")
				. " INNER JOIN {shop_category_rel} AS r ON s.id=r.element_id AND r.cat_id IN (%s)"
				. " WHERE s.[act]='1' AND s.trash='0' AND s.cat_id != '8'"
				." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
				. " AND (s.access='0'"
				. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				. ")"
				. " GROUP BY s.id ORDER BY "
				. ($this->diafan->sort ? $this->sort_config['sort_directions'][$this->diafan->sort].',' : '')
				. " IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC,"
				. " s.no_buy ASC, s.sort ASC, s.id ASC", implode(',', $cat_ids), $time, $time,
				($this->view_all_records ? 0 : $this->diafan->_paginator->polog),
				($this->view_all_records ? $this->list_category_elements_query_count($time, $cat_ids) : $this->diafan->_paginator->nastr));
		}
		else
		{
			$result = DB::query_range(
				"SELECT spe.value1, s.id, s.[name], s.cat_id, s.timeedit, s.[anons], s.site_id, s.no_buy, s.article,"
				. " s.hit, s.new, s.action, s.is_file FROM {shop} AS s"
				. " LEFT JOIN {images} i ON i.module_name = 'shop' AND i.element_id = s.id"
				. " LEFT JOIN {shop_param_element} AS spe ON spe.element_id=s.id AND spe.trash='0' AND spe.param_id='8'"
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='shop'" : "")
				. " INNER JOIN {shop_category_rel} AS r ON s.id=r.element_id AND r.cat_id IN (%s)"
				. " WHERE s.[act]='1' AND s.trash='0' AND s.cat_id != '8'"
				." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
				. " AND (s.access='0'"
				. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				. ")"
				. " GROUP BY s.id ORDER BY "
				. ($this->diafan->sort ? $this->sort_config['sort_directions'][$this->diafan->sort].',' : '')
				. " IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC,"
				. " s.no_buy ASC, s.sort ASC, s.id ASC", implode(',', $cat_ids), $time, $time,
				($this->view_all_records ? 0 : $this->diafan->_paginator->polog),
				($this->view_all_records ? $this->list_category_elements_query_count($time, $cat_ids) : $this->diafan->_paginator->nastr));
		}
	
		return $result;
	}

	/**
	 * Формирует ссылки на предыдущую и следующую категории
	 * 
	 * @param integer $sort номер для сортировки текущей категории
	 * @param integer $parent_id номер категории-родителя
	 * @return void
	 */
	private function list_category_previous_next($sort, $parent_id)
	{
		$previous = DB::fetch_array(DB::query(
		"SELECT c.[name], c.id FROM {shop_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='shop'" : "")
		. " WHERE c.[act]='1' AND c.trash='0' AND c.site_id=%d AND c.id != '8'"
		. " AND (c.sort<%d OR c.sort=%d AND c.id<%d) AND c.parent_id=%d"
		. " AND (c.access='0'"
		. ($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " ORDER BY c.sort DESC, c.id DESC LIMIT 1", $this->diafan->cid, $sort, $sort, $this->diafan->cat, $parent_id));
		if ($previous)
		{
			$this->result["previous"]["text"] = $previous["name"];
			$this->result["previous"]["id"]   = $previous["id"];
			$this->result["previous"]["link"] = $this->diafan->_route->link($this->diafan->cid, "shop", $previous["id"]);
		}
		$next = DB::fetch_array(DB::query(
		"SELECT c.[name], c.id FROM {shop_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='shop'" : "")
		. " WHERE c.[act]='1' AND c.trash='0' AND c.site_id=%d AND c.id != '8'"
		. " AND (c.sort>%d OR c.sort=%d AND c.id>%d) AND c.parent_id=%d"
		. " AND (c.access='0'"
		. ($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " ORDER BY c.sort ASC, c.id ASC LIMIT 1", $this->diafan->cid, $sort, $sort, $this->diafan->cat, $parent_id));
		if ($next)
		{
			$this->result["next"]["text"] = $next["name"];
			$this->result["next"]["id"] = $next["id"];
			$this->result["next"]["link"] = $this->diafan->_route->link($this->diafan->cid, "shop", $next["id"]);
		}
	}

	/**
	 * Генерирует данные для страницы товара
	 * 
	 * @return boolean
	 */
	public function id()
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
			"name" => "show",
			"cat_id" => $this->diafan->cat,
			"show" => $this->diafan->show,
			"lang_id" => _LANG,
			"site_id" => $this->diafan->cid,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"discounts" => $this->get_tag_cache_discounts(),
			"time" => $time
		);
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$row = $this->id_query($time);
			if (empty($row))
			{
				include ABSOLUTE_PATH.'includes/404.php';
				return false;
			}

			if ( ! $this->diafan->rewrite_module && ($this->diafan->configmodules("cat") && $this->diafan->cat != $row["cat_id"]
					|| ! $this->diafan->configmodules("cat") && $this->diafan->cat))
			{
				include ABSOLUTE_PATH.'includes/404.php';
				return false;
			}
			if ( ! empty($row['access']) && ! $this->access($row['id']))
			{
				include ABSOLUTE_PATH.'includes/403.php';
				return false;
			}
			$this->diafan->cat = $this->diafan->configmodules("cat") ? $row["cat_id"] : 0;
			$row["cat_id"] = $this->diafan->configmodules("cat") ? $row["cat_id"] : 0;

			$row["is_file"] = $this->diafan->configmodules("use_non_material_goods") ? $row["is_file"] : 0;
			if ($this->diafan->configmodules("images"))
			{
				$row["img"] = $this->diafan->_images->get(
						'medium', $row["id"], $this->diafan->module,
						$this->diafan->cid, $row["name"], 0, false, 0, 'large'
					);
			}
			$this->get_price($row);
			foreach ($row as $id => $value)
			{
				$this->result[$id] = $value;
			}
			$this->result["currency"] = $this->diafan->configmodules("currency");
			$this->result["param"] = $this->get_param($row["id"], $this->diafan->cid);

			$this->meta($row);
			$this->theme_view_element($row);

			$this->id_previous_next($row["sort"], $time);

			$this->result["path"] = $this->get_path('shop');

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}
		$this->diafan->cat = $this->result["cat_id"];

		if ( ! empty($this->result["previous"]["text"]))
		{
			$this->result["previous"]["text"] =
					$this->diafan->_useradmin->get($this->result["previous"]["text"], 'name', $this->result["previous"]["id"], 'shop', _LANG);
		}
		if ( ! empty($this->result["next"]["text"]))
		{
			$this->result["next"]["text"] =
					$this->diafan->_useradmin->get($this->result["next"]["text"], 'name', $this->result["next"]["id"], 'shop', _LANG);
		}
		foreach ($this->result["path"] as $k => $path)
		{
			if ($k == 0)
				continue;
			$this->result["path"][$k]["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $path["id"], 'shop_category', _LANG);
		}

		$this->counter_view();

		$this->select_price($this->result);
		$this->useradmin($this->result);
		$this->format_data($this->result);

		$this->result["rating"] = $this->diafan->_rating->get();
		$this->result["comments"] = $this->diafan->_comments->get();
		$this->result["tags"] = $this->diafan->_tags->get();

		return true;
	}

	/**
	 * Получает из базы данных данные о текущем элементе для страницы элемента
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return array
	 */
	private function id_query($time)
	{
		$row = DB::fetch_array(DB::query("SELECT id, [name], [anons], [text], timeedit, cat_id,"
		." [keywords], [descr], sort, [title_meta], hit, new, action, is_file,"
		." no_buy, article, access, theme, view FROM {shop}"
		." WHERE [act]='1' AND id = %d AND trash='0' AND site_id=%d"
		." AND date_start<=%d AND (date_finish=0 OR date_finish>=%d) LIMIT 1",
		$this->diafan->show, $this->diafan->cid, $time, $time));
		return $row;
	}

	/**
	 * Формирует ссылки на предыдущий и следующий элемент
	 * 
	 * @param integer $sort номер для сортировки текущего элемента
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return void
	 */
	private function id_previous_next($sort, $time)
	{
		$previous = DB::fetch_array(DB::query(
		"SELECT e.[name], e.id, e.cat_id FROM {shop} AS e"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
		. " WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
		. ($this->diafan->configmodules("cat") ? " AND e.cat_id='".$this->diafan->cat."'" : '')
		. " AND (e.sort<%d OR e.sort=%d AND e.id<%d)"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " ORDER BY e.no_buy DESC, e.sort DESC, e.id DESC LIMIT 1",
		$this->diafan->cid, $sort, $sort, $this->diafan->show, $time, $time
		));
		if ($previous)
		{
			$this->result["previous"]["text"] = $previous["name"];
			if ( ! $this->diafan->configmodules("cat"))
			{
				$previous["cat_id"] = 0;
			}
			$this->result["previous"]["id"] = $previous["id"];
			$this->result["previous"]["link"] = $this->diafan->_route->link($this->diafan->cid, "shop", $previous["cat_id"], $previous["id"]);
		}
		$next = DB::fetch_array(DB::query(
		"SELECT e.[name], e.id, e.cat_id FROM {shop} AS e"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
		. " WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
		. ($this->diafan->configmodules("cat") ? " AND e.cat_id='".$this->diafan->cat."'" : '')
		. " AND (e.sort>%d OR e.sort=%d AND e.id>%d)"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " ORDER BY e.no_buy ASC, e.sort ASC, e.id ASC LIMIT 1",
		$this->diafan->cid, $sort, $sort, $this->diafan->show, $time, $time
		));
		if ($next)
		{
			$this->result["next"]["text"] = $next["name"];
			if ( ! $this->diafan->configmodules("cat"))
			{
				$next["cat_id"] = 0;
			}
			$this->result["next"]["id"] = $next["id"];
			$this->result["next"]["link"] = $this->diafan->_route->link($this->diafan->cid, "shop", $next["cat_id"], $next["id"]);
		}
	}

	/**
	 * Генерирует данные для шаблонной функции: блок товаров
	 * 
	 * @param integer $count количество файлов
	 * @param array $cat_ids категории
	 * @param array $site_ids страницы сайта
	 * @param string $sort сортировка date - по дате, rand - случайно, price - по цене, sale - по количеству продаж
	 * @param integer $images количество изображений
	 * @param string $images_variation размер изображений
	 * @param string $param дополнительные параметры
	 * @return boolean
	 */
	public function show_block($count, $cat_ids, $site_ids, $sort, $images, $images_variation, $param, $hits_only, $action_only, $new_only)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

	
		//кеширование
		$cache_meta = array(
			"name" => "block",
			"cat_ids" => $cat_ids,
			"site_ids" => $site_ids,
			"count" => $count,
			"lang_id" => _LANG,
			"images" => $images,
			"images_variation" => $images_variation,
			"param" => $param,
			"sort" => $sort,
			"hits_only" => (int) $hits_only,
			"action_only" => (int) $action_only,
			"new_only" => (int) $new_only,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"discounts" => ($sort == "rand" || $sort == "sale" ? "" : $this->get_tag_cache_discounts()),
			"time" => $time
		);

		if ($sort == "rand" || $sort == "sale" || ! $this->result = $this->diafan->_cache->get($cache_meta, "shop"))
		{
			if(! $this->validate_attribute_site_cat('shop', $site_ids, $cat_ids))
			{
				return false;
			}
			$params = array();
			if ($param)
			{
				$param = explode('&', $param);
				foreach ($param as $p)
				{
					if(strpos($p, '>=') !== false)
					{
						$operator = '>=';
					}
					elseif(strpos($p, '<=') !== false)
					{
						$operator = '<=';
					}
					elseif(strpos($p, '<>') !== false)
					{
						$operator = '<>';
					}
					elseif(strpos($p, '>') !== false)
					{
						$operator = '>';
					}
					elseif(strpos($p, '<') !== false)
					{
						$operator = '<';
					}
					else
					{
						$operator = '=';
					}
					list($id, $value) = explode($operator, $p, 2);
					$id = preg_replace('/[^0-9]+/', '', $id);
					if ( ! empty($params[$id]))
					{
						if (is_array($params[$id]))
						{
							$params[$id][] = $value;
							$operators[$id][] = $operator;
						}
						else
						{
							$params[$id] = array($params[$id], $value);
							$operators[$id] = array($operators[$id], $operator);
						}
					}
					else
					{
						$params[$id] = $value;
						$operators[$id] = $operator;
					}
				}
			}
			$where = '';
			$values = array();
			foreach ($params as $id => $value)
			{
				if (is_array($value))
				{
					$where .= "
					INNER JOIN {shop_param_element} AS pe".$id." ON pe".$id.".element_id=e.id AND pe".$id.".param_id='".$id."'"
							. " AND pe".$id.".trash='0' AND (";
					foreach ($value as $i => $val)
					{
						if ($value[0] != $val)
						{
							if(in_array($operators[$id][$i], array('>', '<', '>=', '<=')))
							{
								$where .= " AND ";
							}
							else
							{
								$where .= " OR ";
							}
						}
						$where .= "pe".$id.".value".$this->diafan->language_base_site.$operators[$id][$i]."'%h'";
						$values[] = $val;
					}
					$where .= ")";
				}
				else
				{
					$where .= "
					INNER JOIN {shop_param_element} AS pe".$id." ON pe".$id.".element_id=e.id AND pe".$id.".param_id='".$id."'"
					. " AND pe".$id.".trash='0' AND pe".$id.".value".$this->diafan->language_base_site.$operators[$id]."'%h'";
					$values[] = $value;
				}
			}
			$values[] = $time;
			$values[] = $time;

			if ($sort == "rand")
			{
				$max_count = DB::query_result("SELECT COUNT(DISTINCT e.id) FROM {shop} as e"
				. ($cat_ids ? " INNER JOIN {shop_category_rel} as c ON c.element_id=e.id"
						. " AND c.cat_id IN (".implode(',', $cat_ids).")" : ''
				)
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
				. $where
				. " WHERE e.[act]='1' AND e.trash='0'"
				. ($hits_only ? " AND hit='1' " : "")
				. ($action_only ? " AND action='1' " : "")
				. ($new_only ? " AND new='1' " : "")
				. ($site_ids ? " AND e.site_id IN (".implode(",", $site_ids).")" : '')
				." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
				. " AND (e.access='0'"
				. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				. ")", $values
				);
				$rands = array();
				for ($i = 1; $i <= min($max_count, $count); $i ++ )
				{
					do
					{
						$rand = mt_rand(0, $max_count - 1);
					}
					while (in_array($rand, $rands));
					$rands[] = $rand;
				}
			}
			else
			{
				$rands[0] = 1;
			}
			$this->result["rows"] = array();
			
			switch($sort)
			{
				case 'price':
					$order = ' ORDER BY MIN(pr.price) ASC';
					break;

				case 'sale':
					$order = ' ORDER BY count_sale DESC';
					break;

				case 'date':
					$order = ' ORDER BY e.id DESC';
					break;

				case 'rand':
					$order = '';
					break;

				default :
					$order = ' ORDER BY e.sort ASC';
			}

			foreach ($rands as $rand)
			{
				$result = DB::query("SELECT e.id, e.[name], e.[anons], e.cat_id, e.timeedit, e.site_id, e.no_buy, e.article,
				e.hit, e.new, e.action, e.is_file".($sort == "sale" ? ", COUNT(g.id) AS count_sale" : "")."
				FROM {shop} AS e"
				. ($sort == "sale" ? " INNER JOIN {shop_order_goods} AS g ON g.good_id=e.id AND g.trash='0'" : '')
				. ($sort == "price" ? " INNER JOIN {shop_price} AS pr ON pr.good_id=e.id AND pr.trash='0'"
				." AND pr.date_start<=".time()." AND (pr.date_start=0 OR pr.date_finish>=".time().")"
				." AND pr.currency_id=0"
				." AND pr.role_id".($this->diafan->_user->role_id ? " IN (0,".$this->diafan->_user->role_id.")" : "=0")
				." AND pr.user_id".($this->diafan->_user->id ? " IN (0,".$this->diafan->_user->id.")" : "=0")
				." AND pr.threshold <= ".$this->cart_summ
				." AND pr.threshold_cumulative <= ".$this->order_summ
				: '')
				. ($cat_ids ? " INNER JOIN {shop_category_rel} as c ON c.element_id=e.id"
						. " AND c.cat_id IN (".implode(',', $cat_ids).")" : ''
				)
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
				. $where
				. " WHERE e.[act]='1' AND e.trash='0'"
				. ($hits_only ? " AND hit='1' " : "")
				. ($action_only ? " AND action='1' " : "")
				. ($new_only ? " AND new='1' " : "")
				. ($site_ids ? " AND e.site_id IN (".implode(",", $site_ids).")" : '')
				." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
				. " AND (e.access='0'"
				. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				. ")"
				. " GROUP BY e.id"
				. $order
				. ' LIMIT '
				. ($sort == "rand" ? $rand : 0).', '
				. ($sort == "rand" ? 1 : $count), $values);
				$rows = $this->get_elements($result, 'block', array("count" => $images, "variation" => $images_variation));
				$this->result["rows"] = array_merge($this->result["rows"], $rows);
			}

			// если категория только одна, задаем ссылку на нее
			if (!empty($this->result["rows"]) && count($cat_ids) == 1)
			{
				$cat = DB::fetch_array(DB::query("SELECT [name], site_id, id FROM {shop_category} WHERE id=%d LIMIT 1", $cat_ids[0]));

				$this->result["name"] = $cat["name"];
				$this->result["link_all"] = $this->diafan->_route->link($cat["site_id"], 'shop', $cat["id"]);
				$this->result["category"] = true;
			}
			// если раздел сайта только один, то задаем ссылку на него
			elseif (!empty($this->result["rows"]) && count($site_ids) == 1)
			{
				$this->result["name"] = DB::query_result("SELECT [name] FROM {site} WHERE id=%d LIMIT 1", $site_ids[0]);
				$this->result["link_all"] = $this->diafan->_route->link($site_ids[0]);
				$this->result["category"] = false;
			}

			//сохранение кеша
			if ($sort != "rand")
			{
				$this->diafan->_cache->save($this->result, $cache_meta, "shop");
			}
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->select_price($this->result["rows"][$i]);
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);
			}
		}

		return true;
	}

	/**
	 * Генерирует данные для шаблонной функции: блок связанных товаров
	 * 
	 * @param integer $count количество товаров
	 * @param integer $images количество изображений
	 * @param string $images_variation размер изображений
	 * @return void
	 */
	public function show_block_rel2($count, $images, $images_variation)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
			"name" => "block_rel",
			"count" => $count,
			"lang_id" => _LANG,
			"good_id" => $this->diafan->show,
			"images" => $images,
			"images_variation" => $images_variation,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"discounts" => $this->get_tag_cache_discounts(),
			"time" => $time
		);

		if (! $this->result = $this->diafan->_cache->get($cache_meta, "shop"))
		{
			$this->result["rows"] = array();

			$result = DB::query_range(
			"SELECT e.id, e.[name], e.[anons], e.cat_id, e.timeedit, e.site_id, e.no_buy, e.article,"
			." e.hit, e.new, e.action, e.is_file FROM {shop} AS e"
			. " INNER JOIN {shop_rel} AS r ON e.id=r.rel_element_id AND r.element_id=%d"
			.($this->diafan->configmodules("rel_two_sided") ? " OR e.id=r.element_id AND r.rel_element_id=".$this->diafan->show : '')
			. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
			. " WHERE e.[act]='1' AND e.trash='0'"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			. " AND (e.access='0'"
			. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			. ")"
			. " GROUP BY e.id"
			. ' ORDER BY e.id DESC',
			$this->diafan->show, $time, $time, 0, $count
			);
			$this->result["rows"] = $this->get_elements($result, 'block', array("count" => $images, "variation" => $images_variation));
			$this->diafan->_cache->save($this->result, $cache_meta, "shop");
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->select_price($this->result["rows"][$i]);
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);
			}
		}
	}

	/**
	 * Генерирует данные для шаблонной функции: блок товаров, которые обычно покупают с текущим
	 * 
	 * @param integer $count количество товаров
	 * @param integer $images количество изображений
	 * @param string $images_variation размер изображений
	 * @return void
	 */
	public function show_block_order_rel($count, $images, $images_variation)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$this->result["rows"] = array();

		$result = DB::query_range(
		"SELECT e.id, e.[name], e.[anons], e.cat_id, e.timeedit, e.site_id, e.no_buy, e.article,"
		." e.hit, e.new, e.action, e.is_file, COUNT(g.good_id) AS count_good FROM {shop} AS e"
		. " INNER JOIN {shop_order_goods} AS g ON g.good_id=e.id AND g.good_id<>%d"
		. " INNER JOIN {shop_order_goods} AS eg ON eg.order_id=g.order_id AND eg.good_id=%d"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
		. " WHERE e.[act]='1' AND e.trash='0'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " GROUP BY e.id"
		. ' ORDER BY count_good DESC',
		$this->diafan->show, $this->diafan->show, $time, $time, 0, $count
		);
		$this->result["rows"] = $this->get_elements($result, 'block', array("count" => $images, "variation" => $images_variation));

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->select_price($this->result["rows"][$i]);
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);
			}
		}
	}

	/**
	 * Генерирует данные для вывода тегов
	 * 
	 * @param integer $element_id  номер товара
	 * @return array
	 */
	public function tags($element_id)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$result = DB::query("SELECT e.id, e.[name], e.[anons], e.cat_id, e.timeedit, e.site_id, e.no_buy, e.article, e.is_file FROM {shop} AS e"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
		. " WHERE e.[act]='1' AND e.trash='0' AND e.id=%d"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")", $element_id, $time, $time);
		$this->result["rows"] = $this->get_elements($result, "list", "block");

		if ( ! $this->result["rows"])
		{
			return false;
		}
		for ($i = 0; $i < count($this->result["rows"]); $i ++ )
		{
			$this->result["rows"][$i]["hide_compare"] = true;
			$this->select_price($this->result["rows"][$i]);
			$this->format_data($this->result["rows"][$i]);
		}

		return $this->get_result();
	}

	/**
	 * Генерирует контент для шаблонной функции: форма поиска по товарам
	 *
	 * @param array|string $cat_ids номера категорий
	 * @param array $site_ids страницы сайта
	 * @param string $ajax подгружать результаты поиска Ajax-запросом
	 * @return array
	 */
	public function show_search($cat_ids, $site_ids, $ajax)
	{
		//кеширование
		$cache_meta = array(
			"name" => "show_search",
			"lang_id" => _LANG,
			"cat_ids" => $cat_ids,
			"site_ids" => $site_ids,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
		);

		if (! $result_content = $this->diafan->_cache->get($cache_meta, "shop"))
		{
			if($cat_ids === 'all')
			{
				$cat_ids = array();
				$cat_ids_all = true;
			}
			if(! $this->validate_attribute_site_cat('shop', $site_ids, $cat_ids))
			{
				return false;
			}
			$result_content["cat_ids"] = array();
			if(count($cat_ids) > 1 || ! empty($cat_ids_all))
			{
				if(empty($cat_ids_all))
				{
					$result = DB::query("SELECT id, [name], site_id, parent_id FROM {shop_category} WHERE id IN (%s) AND id != '8' ORDER BY sort ASC", implode(',', $cat_ids));
				}
				else
				{
					$result = DB::query("SELECT c.id, c.[name], c.site_id, c.parent_id FROM {shop_category} AS c"
					.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='shop'" : "")
					." WHERE c.[act]='1' AND c.trash='0' AND c.site_id IN (%s) AND c.id != '8'"
					." AND (c.access='0'"
					.($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
					.")"
					." GROUP BY c.id ORDER BY c.sort ASC", implode(',', $site_ids));
				}
				$cat_ids = array();
				$cats = array();
				while($row = DB::fetch_array($result))
				{
					$row["level"] = 0;
					$cats[] = $row;
					$cat_ids[] = $row["id"];
					$parents[$row["id"]] = $row["parent_id"];
				}
				foreach($cats as $i => $cat)
				{
					$parent = $cat["id"];
					$level = 0;
					while($parent)
					{
						if(! empty($parents[$parent]))
						{
							$parent = $parents[$parent];
							$level++;
						}
						else
						{
							$parent = 0;
						}
					}
					$cat["level"] = $level;
					$cats_h[$level ? $cat["parent_id"] : 0][] = $cat;
				}
				$result_content["cat_ids"] = array();
				if($cats)
				{
					$this->list_cats_hierarhy($result_content["cat_ids"], $cats_h);
				}
			}
			elseif(count($cat_ids) == 1)
			{
				$result_content["cat_ids"][] = array("id" => $cat_ids[0]);
			}
			if(count($site_ids) > 1)
			{
				$result = DB::query("SELECT id, [name] FROM {site} WHERE id IN (%s) ORDER BY sort ASC", implode(',', $site_ids));
				while($row = DB::fetch_array($result))
				{
					$row["path"] = $this->diafan->_route->link($row["id"]);
					$result_content["site_ids"][] = $row;
				}
			}
			else
			{
				$result_content["site_ids"][] = array(
						"id" => $site_ids[0],
						"path" => $this->diafan->_route->link($site_ids[0])
					);
			}

			if ($this->diafan->configmodules("search_name", "shop", $site_ids[0]))
			{
				$result_content["name"] = array(
					"name" => 1,
					"value" => ''
				);
			}
	
			if ($this->diafan->configmodules("search_article", "shop", $site_ids[0]))
			{
				$result_content["article"] = array(
					"article" => 1,
					"value" => ''
				);
			}
	
			if ($this->diafan->configmodules("search_text", "shop", $site_ids[0]))
			{
				$result_content["text"] = array(
					"name" => 1,
					"value" => ''
				);
			}
	
			if ($this->diafan->configmodules("search_price", "shop", $site_ids[0]))
			{
				$result_content["price"] = array(
					"name" => 1,
					"value1" => 0,
					"value2" => 0
				);
			}
	
			if ($this->diafan->configmodules("search_action", "shop", $site_ids[0]))
			{
				$result_content["action"] = array(
					"name" => 1,
					"value" => false
				);
			}
	
			if ($this->diafan->configmodules("search_hit", "shop", $site_ids[0]))
			{
				$result_content["hit"] = array(
					"name" => 1,
					"value" => false
				);
			}
	
			if ($this->diafan->configmodules("search_new", "shop", $site_ids[0]))
			{
				$result_content["new"] = array(
					"name" => 1,
					"value" => false
				);
			}
	
			$result_content["rows"] = array();
			$result = DB::query("SELECT p.id, p.type, p.[name], GROUP_CONCAT(c.cat_id SEPARATOR ',') as cat_ids FROM {shop_param} as p "
					." INNER JOIN {shop_param_category_rel} AS c ON p.id=c.element_id AND "
					.($cat_ids ? "(c.cat_id IN (".implode(',', $cat_ids).") OR c.cat_id=0)" : "c.cat_id=0")
					." WHERE p.search='1' AND p.trash='0' GROUP BY p.id ORDER BY p.sort ASC");
	
			while ($row = DB::fetch_array($result))
			{
				if ($row["type"] == 'select' || $row["type"] == 'multiple')
				{
					$result_select = DB::query(
						"SELECT p.[name], p.id FROM {shop_param_select} AS p"
						// выводим значения, только есть товары, чтобы поиск не давал пустых результатов
						." INNER JOIN {shop_param_element} AS e ON p.param_id=e.param_id AND e.value1=p.id"
						." INNER JOIN {shop} AS s ON e.element_id=s.id AND s.[act]='1' AND s.trash='0'"
						.($cat_ids ? " INNER JOIN {shop_category_rel} AS c ON c.element_id=s.id AND c.cat_id IN (".implode(",", $cat_ids).")" : '')
						." WHERE p.param_id=%d GROUP BY p.id ORDER BY p.sort ASC", $row["id"]);
					while ($row_select = DB::fetch_array($result_select))
					{
						$row["select_array"][$row_select["id"]] = $row_select["name"];
					}
					if(empty($row["select_array"]))
						continue;
				}
				$result_content["rows"][] = $row;
			}
		}

		if (! empty($result_content["name"]))
		{
			$result_content["name"]["value"] = ! empty($_GET["n"]) ? trim(htmlspecialchars(stripslashes($_GET["n"]))) : '';
		}

		if (! empty($result_content["article"]))
		{
			$result_content["article"]["value"] = ! empty($_GET["a"]) ? trim(htmlspecialchars(stripslashes($_GET["a"]))) : '';
		}

		if (! empty($result_content["text"]))
		{
			$result_content["text"]["value"] = ! empty($_GET["d"]) ? trim(htmlspecialchars(stripslashes($_GET["d"]))) : '';
		}

		if (! empty($result_content["price"]))
		{
			$result_content["price"]["value1"] = $this->diafan->get_param($_GET, "pr1", '', 2);
			$result_content["price"]["value2"] = $this->diafan->get_param($_GET, "pr2", '', 2);
		}

		if (! empty($result_content["action"]) && ! empty($_GET["ac"]))
		{
			$result_content["action"]["value"] = true;
		}

		if (! empty($result_content["hit"]) && ! empty($_GET["hi"]))
		{
			$result_content["hit"]["value"] = true;
		}

		if (! empty($result_content["new"]) && ! empty($_GET["ne"]))
		{
			$result_content["new"]["value"] = true;
		}
		
		foreach($result_content["rows"] as $i => $row)
		{
			if ($row["type"] == 'text' || $row["type"] == 'textarea' || $row["type"] == 'editor')
			{
				$row["value"] = ! empty($_GET["p".$row["id"]]) ? trim(htmlspecialchars(stripslashes($_GET["p".$row["id"]]))) : '';
			}
			elseif ($row["type"] == 'date' || $row["type"] == 'datetime')
			{
				$row["value1"] = $this->diafan->get_param($_GET, "p".$row["id"]."_1", '', 1);
				$row["value2"] = $this->diafan->get_param($_GET, "p".$row["id"]."_2", '', 1);
			}
			elseif ($row["type"] == 'numtext')
			{
				$row["value1"] = $this->diafan->get_param($_GET, "p".$row["id"]."_1", '', 2);
				$row["value2"] = $this->diafan->get_param($_GET, "p".$row["id"]."_2", '', 2);
			}
			elseif ($row["type"] == 'checkbox')
			{
				$row["value"] = $this->diafan->get_param($_GET, "p".$row["id"], '', 2);
			}
			elseif ($row["type"] == 'select' || $row["type"] == 'multiple')
			{
				if ( ! empty($_GET["p".$row["id"]]) && ! is_array($_GET["p".$row["id"]]))
				{
					$row["value"][] = $this->diafan->get_param($_GET, "p".$row["id"], 0, 2);
				}
				elseif ( ! empty($_GET["p".$row["id"]]) && is_array($_GET["p".$row["id"]]))
				{
					foreach ($_GET["p".$row["id"]] as $val)
					{
						$row["value"][] = intval($val);
					}
				}
				else
				{
					$row["value"] = array();
				}
			}
			$result_content["rows"][$i] = $row;
		}

		if($this->diafan->module == 'shop' && in_array($this->diafan->cid, $site_ids))
		{
			$result_content["site_id"] = $this->diafan->cid;
			foreach($result_content["site_ids"] as $row)
			{
				if($row["id"] == $this->diafan->cid)
				{
					$result_content["path"] = $row["path"];
				}
			}
		}
		else
		{
			$result_content["site_id"] = $result_content["site_ids"][0]["id"];
			$result_content["path"]    = $result_content["site_ids"][0]["path"];
		}
		if($this->diafan->module == 'shop' && in_array($this->diafan->cat, $cat_ids))
		{
			$result_content["cat_id"] = $this->diafan->cat;
		}
		elseif(! empty($result_content["cat_ids"][0]["id"]))
		{
			$result_content["cat_id"] = $result_content["cat_ids"][0]["id"];
		}
		else
		{
			$result_content["cat_id"] = 0;
		}
		$result_content["send_ajax"] = $ajax;
		return $result_content;
	}

	/**
	 * Формирует дерево категорий для поиска
	 * 
	 * @return void
	 */
	private function list_cats_hierarhy(&$result, $cats, $parent = 0)
	{
		if(empty($cats[$parent]))
			return;

		foreach($cats[$parent] as $cat)
		{
			$result[] = $cat;
			$this->list_cats_hierarhy($result, $cats, $cat["id"]);
		}
	}

	/**
	 * Шаблонная функция: форма активации купона
	 * 
	 * @return boolean
	 */
	public function show_add_coupon()
	{
		$result["error"] = $this->get_error("shop");
		$result["count"] = DB::query_result("SELECT COUNT(*) FROM {shop_discount} WHERE coupon<>'' AND user_id=%d AND trash='0' AND act='1'", $this->diafan->_user->id);
		return $result;
	}

	/**
	 * Форматирует данные о товаре для списка товаров
	 *
	 * @param resource $result результат выполнения SQL-запроса
	 * @param string $function функция, для которой генерируется список товаров
	 * @param string $images_config настройки отображения изображений
	 * @return array
	 */
	public function get_elements($result, $function = 'list', $images_config = '')
	{
		if (empty($this->result["timeedit"]))
		{
			$this->result["timeedit"] = '';
		}
		$rows = array();
		while ($row = DB::fetch_array($result))
		{
			if ( ! $this->diafan->configmodules("cat", "shop", $row["site_id"]))
			{
				$row["cat_id"] = 0;
			}
			if ($row["timeedit"] < $this->result["timeedit"])
			{
				$this->result["timeedit"] = $row["timeedit"];
			}
			unset($row["timeedit"]);

			$row["link"] = $this->diafan->_route->link($row["site_id"], "shop", $row["cat_id"], $row["id"]);
			$this->get_price($row);

			if ($this->diafan->configmodules("images", "shop", $row["site_id"]))
			{
				if (is_array($images_config) && $images_config["count"] > 0)
				{
					$row["img"]  = $this->diafan->_images->get(
							$images_config["variation"], $row["id"], 'shop',
							$row["site_id"], $row["name"], 0, false,
							$images_config["count"], $row["link"]
						);
				}
				elseif($this->diafan->configmodules("list_img", "shop", $row["site_id"]))
				{
					if($this->diafan->configmodules("list_img", "shop", $row["site_id"]) == 1)
					{
						$image_ids = array();
						foreach($row["price_arr"] as $price)
						{
							if(! empty($price["image_rel"]))
							{
								$image_ids[] = $price["image_rel"];
							}
						}
						if($image_ids)
						{
							$count = $image_ids;
						}
						else
						{
							$count = 1;
						}
					}
					else
					{
						$count = 0;
					}
					$row["img"]  = $this->diafan->_images->get(
						'medium', $row["id"], 'shop', $row["site_id"], $row["name"], 0, false,
						$count,
						$row["link"]
					);
				}
			}

			$row["param"] = $this->get_param($row["id"], $row["site_id"], $function);
			$row["is_file"] = $this->diafan->configmodules("use_non_material_goods", "shop") ? $row["is_file"] : 0;

			$rows[] = $row;
		}
		if(! isset($this->result["currency"]))
		{
			$this->result["currency"] = $this->diafan->configmodules("currency", "shop");
		}
		return $rows;
	}
	
	/**
	 * Формирует данные о вложенных категориях
	 *
	 * @param integer $parent_id номер категории-родителя
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return array
	 */
	private function get_children_category($parent_id, $time)
	{
		$children = array();
		$result_children = DB::query(
		"SELECT c.id, c.[name], c.[anons], c.site_id FROM {shop_category} AS c"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='shop'" : "")
		." WHERE c.[act]='1' AND c.parent_id=%d AND c.trash='0' AND c.site_id=%d AND c.id != '8'"
		." AND (c.access='0'"
		.($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY c.id ORDER BY  c.[name] ASC", $parent_id, $this->diafan->cid
		);

		while ($child = DB::fetch_array($result_children))
		{
			$child["link"] = $this->diafan->_route->link($child["site_id"], 'shop', $child["id"]);
			if ($this->diafan->configmodules("images_cat") && $this->diafan->configmodules("list_img_cat"))
			{
				$child["img"] = $this->diafan->_images->get(
					'medium', $child["id"], $this->diafan->module, $child["site_id"],
					$child["name"], 0, true, $this->diafan->configmodules("list_img_cat") == 1 ? 1 : 0,
					$child["link"]);
			}
			$child["rows"] = array();
			if($this->diafan->configmodules("count_child_list"))
			{
				if ($this->diafan->configmodules("children_elements"))
				{
					$cat_ids = $this->diafan->get_children($child["id"], "shop_category");
					$cat_ids[] = $child["id"];
				}
				else
				{
					$cat_ids = array($child["id"]);
				}
				$result_elements = $this->get_children_category_elements_query($time, $cat_ids);
				$child["rows"] = $this->get_elements($result_elements);
			}
			unset($child["site_id"]);
			$children[] = $child;
		}
		return $children;
	}

	/**
	 * Получает из базы данных элементы вложенных категорий
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param array $cat_ids номера категорий, элементы из которых выбираются
	 * @return resource
	 */
	private function get_children_category_elements_query($time, $cat_ids)
	{
		$result = DB::query_range(
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.site_id, e.no_buy, e.article, e.hit,"
		. " e.new, e.action, e.is_file FROM {shop} AS e"
		. " INNER JOIN {shop_category_rel} AS r ON e.id=r.element_id"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='shop'" : "")
		. " WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0' AND e.cat_id != '8'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " GROUP BY e.id ORDER BY e.sort ASC, e.id ASC",
		implode(',', $cat_ids), $time, $time,
		0, $this->diafan->configmodules("count_child_list")
		);
		return $result;
	}

	/**
	 * Формирует данные о цене товара
	 *
	 * @param array $row данные о товаре
	 * @return void
	 */
	private function get_price(&$row)
	{
		// массив всех характеристик, доступных к выбору при заказе
		if (! isset($this->result["depends_param"]))
		{
			$this->result["depends_param"] = array();
			$result = DB::query("SELECT id, [name] FROM {shop_param} WHERE `type`='multiple' AND required='1' AND trash='0' ORDER BY sort ASC");
			while ($row_param = DB::fetch_array($result))
			{
				$row_param["values"] = array();
				$result_value = DB::query("SELECT id, [name] FROM {shop_param_select} WHERE param_id=%d AND trash='0' ORDER BY sort ASC", $row_param["id"]);
				while ($row_value = DB::fetch_array($result_value))
				{
					$row_param["values"][] = $row_value;
				}
				$this->result["depends_param"][] = $row_param;
			}
		}

		$price = array();
		$count = 0;
		$row["param_multiple"] = array();
		$rows = $this->diafan->_shop->price_get_all($row["id"], $this->diafan->_user->id);
		foreach($rows as $row_price)
		{
			$empty_param = array();
			$row_price["param"] = array();
			$result_param = DB::query("SELECT param_id, param_value FROM {shop_price_param} WHERE price_id=%d", $row_price["price_id"]);
			while ($row_param = DB::fetch_array($result_param))
			{
				if(! empty($row_param["param_value"]))
				{
					$row["param_multiple"][$row_param["param_id"]][$row_param["param_value"]] = 'depend';
					$row_price["param"][] = array("id" => $row_param["param_id"], "value" => $row_param["param_value"]);
				}
				else
				{
					$empty_param[] = $row_param["param_id"];
				}
			}
			if(! empty($empty_param))
			{
				$result_param = DB::query("SELECT param_id, value".$this->diafan->language_base_site." AS value FROM {shop_param_element} WHERE element_id=%d AND param_id IN (%s)", $row["id"], implode(",", $empty_param));
				while ($row_param = DB::fetch_array($result_param))
				{
					$row["param_multiple"][$row_param["param_id"]][$row_param["value"]] = 'select';
				}
			}
			$count += $row_price["count_goods"];
			$row_price["count"] = $this->diafan->configmodules("use_count_goods", "shop") ? $row_price["count_goods"] : true;
			$row_price["image_rel"] = DB::query_result("SELECT image_id FROM {shop_price_image_rel} WHERE price_id=%d LIMIT 1", $row_price["price_id"]);
			$price[] = $row_price;
		}
		$row["price_arr"] = $price;
		$row["count"] = $this->diafan->configmodules("use_count_goods", "shop") ? $count : true;
		$row["price"] = !empty($price[0]) ? $price[0]["price"] : 0;
		$row["old_price"] = !empty($price[0]) ? $price[0]["old_price"] : 0;
		$row["discount"] = !empty($price[0]) ? $price[0]["discount"] : 0;
		$row["discount_finish"] = !empty($price[0]["date_finish"]) ? $this->format_date($price[0]["date_finish"], "shop") : '';
	}

	/**
	 * Формирует метку кэша на основе данные о скидках
	 * 
	 * @return string
	 */
	private function get_tag_cache_discounts()
	{
		$discounts = array();
		$min = round(date("i")/5)*5;
		$time = mktime(date("H"), $min, 0);
		$result = DB::query("SELECT id FROM {shop_discount} WHERE trash='0' AND act='1'"
				." AND threshold<=%d AND threshold_cumulative<=%d"
				." AND role_id".($this->diafan->_user->role_id ? " IN (0,".$this->diafan->_user->role_id.")" : "=0")
				." AND ".($this->diafan->_user->id ? " (user_id=".$this->diafan->_user->id." OR user_id=0 AND coupon='')" : "user_id=0 AND coupon=''")
				." AND date_start<=%d AND (date_finish=0 OR date_finish>=%d)"
				." ORDER BY id ASC", $this->cart_summ, $this->order_summ, $time, $time);
		while ($dis = DB::fetch_array($result))
		{
			$discounts[] = $dis["id"];
		}
		return implode(",", $discounts);
	}

	/**
	 * Возвращает результаты, сформированные в моделе
	 * 
	 * @return void
	 */
	public function get_result()
	{
		
		$this->result["cart_link"] = $this->diafan->_route->module("cart",true);
		$this->result["wishlist_link"] = $this->diafan->_route->module("wishlist",true);
		$this->result["buy"] =  ! $this->diafan->configmodules('not_buy', "shop") && (! $this->diafan->configmodules('security_user', "shop") || $this->diafan->_user->id) ? true : false;
		
		return $this->result;
	}

	/**
	 * Задает выделение параметров, учитываемый при покупке товара
	 *
	 * @param array $row данные о товаре
	 * @return boolean true
	 */
	private function select_price(&$row)
	{
		$row["count_in_cart"] = $this->diafan->_cart->get($row["id"], false, "count");
		if ( ! empty($row["price_arr"]))
		{
			$new_params = array();
			foreach ($row["price_arr"] as $id => $price)
			{
				$row["price_arr"][$id]["count_in_cart"] = $this->diafan->_cart->get($row["id"], $price["price_id"], "count");
				$row["price_arr"][$id]["price"] = $this->diafan->_shop->price_format($row["price_arr"][$id]["price"]);
				if(! empty($row["price_arr"][$id]["old_price"]))
				{
					$row["price_arr"][$id]["old_price"] = $this->diafan->_shop->price_format($row["price_arr"][$id]["old_price"]);
				}
			}
		}
		else
		{
			if(! empty($row["price"]))
			{
				$row["price"] = $this->diafan->_shop->price_format($row["price"]);
			}
			if(! empty($row["old_price"]))
			{
				$row["old_price"] = $this->diafan->_shop->price_format($row["old_price"]);
			}
		}

		return true;
	}

	/**
	 * Получает дополнительные характеристики товара
	 * 
	 * @param integer $id номер товара
	 * @param integer $site_id номер страницы, к которой прикреплен товар
	 * @param string $function функция, для которой выбираются параметры
	 * @return array
	 */
	public function get_param($id, $site_id, $function = "id")
	{
		global $param_select, $param_select_page;
		$values = array();
		$rvalues = array();
		$result_el = DB::query("SELECT e.value".$this->diafan->language_base_site." as rvalue, e.[value], e.param_id, e.id FROM {shop_param_element} as e"
		. " LEFT JOIN {shop_param_select} as s ON e.param_id=s.param_id AND e.param_id=s.id"
		. " WHERE e.element_id=%d GROUP BY e.id ORDER BY s.sort ASC", $id);
		while ($row_el = DB::fetch_array($result_el))
		{
			$values[$row_el["param_id"]][] = $row_el;
		}
		$result = DB::query("SELECT p.id, p.[name], p.type, p.page, p.[measure_unit], p.config FROM {shop_param} as p "
		. ($this->diafan->configmodules("cat", "shop", $site_id) ? " INNER JOIN {shop_category_rel} as c ON c.element_id=".$id : "")
		. " INNER JOIN {shop_param_category_rel} as cp ON cp.element_id=p.id "
		. ($this->diafan->configmodules("cat", "shop", $site_id) ?
				" AND (cp.cat_id=c.cat_id OR cp.cat_id=0) " : "")
		. " WHERE p.trash='0' "
		. ($function == "block" ? " AND p.block='1'" : '')
		. ($function == "list" ? " AND p.list='1'" : '')
		. " GROUP BY p.id ORDER BY p.sort ASC"
		);

		$param = array();
		while ($row = DB::fetch_array($result))
		{
			switch ($row["type"])
			{
				case "text":
				case "textarea":
				case "editor":
					if ( ! empty($values[$row["id"]][0]["value"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["value"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "date":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $this->diafan->formate_from_date($values[$row["id"]][0]["rvalue"]),
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "datetime":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $this->diafan->formate_from_datetime($values[$row["id"]][0]["rvalue"]),
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "select":
					$value = ! empty($values[$row["id"]][0]["rvalue"]) ? $values[$row["id"]][0]["rvalue"] : '';
					if ($value)
					{
						if (empty($param_select[$row["id"]][$value]))
						{
							$param_select[$row["id"]][$value] = DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $values[$row["id"]][0]["rvalue"], $row["id"]);
						}
						if ($row["page"])
						{
							if (empty($param_select_page[$row["id"]][$value]))
							{
								$param_select_page[$row["id"]][$value] = $this->diafan->_route->link($site_id, "shop", 0, 0, $value);
							}
							$link = $param_select_page[$row["id"]][$value];
							$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value], "link" => $link);
						}
						else
						{
							$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value]);
						}
					}
					break;
				case "multiple":
					if ( ! empty($values[$row["id"]]))
					{
						$value = array();
						foreach ($values[$row["id"]] as $val)
						{
							if (empty($param_select[$row["id"]][$val["rvalue"]]))
							{
								$param_select[$row["id"]][$val["rvalue"]] =
										DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $val["rvalue"], $row["id"]);
							}
							if ($row["page"])
							{
								if ($this->diafan->module == 'shop' && $this->diafan->param == $val["rvalue"])
								{
									$link = '';
								}
								else
								{
									if (empty($param_select_page[$row["id"]][$val["rvalue"]]))
									{
										$param_select_page[$row["id"]][$val["rvalue"]] = $this->diafan->_route->link($site_id, "shop", 0, 0, $val["rvalue"]);
									}
									$link = $param_select_page[$row["id"]][$val["rvalue"]];
								}
								$value[] = array("id" => $row["id"], "name" => $param_select[$row["id"]][$val["rvalue"]], "link" => $link);
							}
							else
							{
								$value[] = $param_select[$row["id"]][$val["rvalue"]];
							}
						}
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $value);
					}
					break;
				case "checkbox":
					$value = ! empty($values[$row["id"]][0]["rvalue"]) ? 1 : 0;
					if ( ! isset($param_select[$row["id"]][$value]))
					{
						$param_select[$row["id"]][$value] =
								DB::query_result("SELECT [name] FROM {shop_param_select} WHERE value=%d AND param_id=%d LIMIT 1", $value, $row["id"]);
					}
					if ( ! $param_select[$row["id"]][$value] && $value == 1)
					{
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => '');
					}
					else
					{
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value]);
					}
					break;
				case "title":
					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => ''
					);
					break;
				case "numtext":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["rvalue"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"],
							"measure_unit" => $row["measure_unit"]
						);
					}
					break;
				case "images":
					$value = $this->diafan->_images->get('large', $id, "shop", 0, '', $row["id"]);
					if(! $value)
						continue 2;

					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => $value
					);
					break;
				case "attachments":
					$config = unserialize($row["config"]);
					if($config["attachments_access_admin"])
						continue 2;

					$value = $this->diafan->_attachments->get($id, "shop", 0, $row["id"]);
					if(! $value)
						continue 2;

					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => $value,
						"use_animation" => ! empty($config["use_animation"]) ? true : false
					);
					break;
				default:
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["rvalue"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
			}
		}
		return $param;
	}

	/**
	 * Представляет данные в разных форматах, удобных для использования в шаблоне
	 *
	 * @param array $row данные о товаре
	 * @return void
	 */
	private function format_data(&$row)
	{
		foreach($row["param"] as $param)
		{
			$row["ids_param"][$param["id"]] = $param;
			$row["names_param"][strip_tags($param["name"])] = $param;
		}
	}

	/**
	 * Формирует SQL-запрос при поиске по товарам
	 * 
	 * @return boolean true
	 */
	private function get_where(&$where, &$where_param, &$values, &$getnav, &$group)
	{
		$where = ' AND s.site_id=%d';
		$values[] = $this->diafan->cid;
		$values_param = array();

		$getnav = '?action=search';
		if (!empty($_GET["cat_id"]))
		{
			$this->diafan->cat = (int) preg_replace("/\D/", '', $_GET['cat_id']);
			$catarr = array(0);
			$getnav .='&cat_id='.$this->diafan->cat;
			if ($this->diafan->cat)
			{
				$children = $this->diafan->get_children($this->diafan->cat, "shop_category");
				$children[] = $this->diafan->cat;
				$where_param .= " INNER JOIN {shop_category_rel} AS c ON s.id=c.element_id AND c.cat_id IN (".implode(',', $children).")";
			}
		}

		if (!empty($_GET["n"]) && $this->diafan->configmodules("search_name"))
		{
			$where .= " AND s.name"._LANG." LIKE '%%%h%%'";
			$_GET["n"] = trim($this->diafan->get_param($_GET, "n", '', 1));
			$values[] = $_GET["n"];
			$getnav .= '&n='.$_GET["n"];
		}

		if (!empty($_GET["a"]) && $this->diafan->configmodules("search_article"))
		{
			$where .= " AND REPLACE(REPLACE(s.article, ' ', ''), '-', '')='%h'";
			$_GET["a"] = trim($this->diafan->get_param($_GET, "a", '', 1));
			$values[] = $_GET["a"];
			$getnav .= '&a='.$_GET["a"];
		}
	
		if (!empty($_GET["d"]) && $this->diafan->configmodules("search_text"))
		{
			$where .= " AND s.text"._LANG." LIKE '%%%h%%'";
			$_GET["d"] = trim($this->diafan->get_param($_GET, "d", '', 1));
			$values[] = $_GET["d"];
			$getnav .= '&d='.$_GET["d"];
		}
	
		if (!empty($_GET["ac"]) && $this->diafan->configmodules("search_action"))
		{
			$where .= " AND s.action='1'";
			$getnav .= '&action=1';
		}
	
		if (!empty($_GET["hi"]) && $this->diafan->configmodules("search_hit"))
		{
			$where .= " AND s.hit='1'";
			$getnav .= '&hit=1';
		}
	
		if (!empty($_GET["ne"]) && $this->diafan->configmodules("search_new"))
		{
			$where .= " AND s.new='1'";
			$getnav .= '&ne=1';
		}
	
		if (!empty($_GET["pr1"]) || !empty($_GET["pr2"]))
		{
			if (!empty($_GET["pr1"]))
			{
				$pr1 = (int) $this->diafan->get_param($_GET, "pr1", '', 2);
				$getnav .= '&pr1='.$pr1;
			}
			if (!empty($_GET["pr2"]))
			{
				$pr2 = (int) $this->diafan->get_param($_GET, "pr2", '', 2);
				$getnav .= '&pr2='.$pr2;
			}
			$where_param .= " INNER JOIN {shop_price} AS pr ON pr.good_id=s.id AND pr.trash='0'"
				." AND pr.date_start<=".time()." AND (pr.date_start=0 OR pr.date_finish>=".time().")"
				." AND pr.currency_id=0"
				." AND pr.role_id".($this->diafan->_user->role_id ? " IN (0,".$this->diafan->_user->role_id.")" : "=0")
				." AND pr.user_id".($this->diafan->_user->id ? " IN (0,".$this->diafan->_user->id.")" : "=0")
				." AND pr.threshold <= ".$this->cart_summ
				." AND pr.threshold_cumulative <= ".$this->order_summ;
			$group = ", pr.price_id HAVING"
				.(!empty($_GET["pr1"]) ? " MIN(pr.price)>=".$pr1 : '')
				.(!empty($_GET["pr2"]) ? (!empty($_GET["pr1"]) ? " AND" : "")." MIN(pr.price)<=".$pr2 : '');
		}
		else
		{
			$where_param .= " LEFT JOIN {shop_price} AS pr ON pr.good_id=s.id AND pr.trash='0'"
				." AND pr.date_start<=".time()." AND (pr.date_start=0 OR pr.date_finish>=".time().")"
				." AND pr.currency_id=0"
				." AND pr.role_id".($this->diafan->_user->role_id ? " IN (0,".$this->diafan->_user->role_id.")" : "=0")
				." AND pr.user_id".($this->diafan->_user->id ? " IN (0,".$this->diafan->_user->id.")" : "=0")
				." AND pr.threshold <= ".$this->cart_summ
				." AND pr.threshold_cumulative <= ".$this->order_summ;
		}
		$result = DB::query("SELECT DISTINCT(p.id), p.type, p.required FROM {shop_param} as p "
				." INNER JOIN {shop_param_category_rel} AS c ON p.id=c.element_id "
				.($this->diafan->configmodules("cat") ? " AND (c.cat_id=%d OR c.cat_id=0)" : "")
				." WHERE p.search='1' AND p.trash='0' ORDER BY p.sort ASC", $this->diafan->cat);
		while ($row = DB::fetch_array($result))
		{
			if (($row["type"] == 'text' || $row["type"] == 'textarea' || $row["type"] == 'editor') && !empty($_GET["p".$row["id"]]))
			{
				$val = trim($this->diafan->get_param($_GET, "p".$row["id"], '', 1));
				$where_param .= "
							INNER JOIN {shop_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
					." AND pe".$row["id"].".trash='0' AND pe".$row["id"].".value"._LANG." LIKE '%%%h%%'";
				$values_param[] = $row["id"];
				$values_param[] = $val;
				$getnav .= '&p'.$row["id"].'='.$val;
			}
			elseif ($row["type"] == 'date' && (!empty($_GET["p".$row["id"]."_1"]) || !empty($_GET["p".$row["id"]."_2"])))
			{
				$where_param .= " INNER JOIN {shop_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
					." AND pe".$row["id"].".trash='0'";
				$values_param[] = $row["id"];
				if (!empty($_GET["p".$row["id"]."_1"]))
				{
					$where_param .= " AND pe".$row["id"].".value".$this->diafan->language_base_site.">='%s'";
					$values_param[] = $this->diafan->formate_in_date($_GET["p".$row["id"]."_1"]);
					$getnav .= '&p'.$row["id"].'_1='.trim($this->diafan->get_param($_GET, "p".$row["id"]."_1", '', 1));
				}
				if (!empty($_GET["p".$row["id"]."_2"]))
				{
					$where_param .= " AND pe".$row["id"].".value".$this->diafan->language_base_site."<='%s'";
					$values_param[] = $this->diafan->formate_in_date($_GET["p".$row["id"]."_2"]);
					$getnav .= '&p'.$row["id"].'_2='.trim($this->diafan->get_param($_GET, "p".$row["id"]."_2", '', 1));
				}
			}
			elseif ($row["type"] == 'datetime' && (!empty($_GET["p".$row["id"]."_1"]) || !empty($_GET["p".$row["id"]."_2"])))
			{
				$where_param .= " INNER JOIN {shop_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
					." AND pe".$row["id"].".trash='0'";
				$values_param[] = $row["id"];
				if (!empty($_GET["p".$row["id"]."_1"]))
				{
					$where_param .= " AND pe".$row["id"].".value".$this->diafan->language_base_site.">='%s'";
					$values_param[] = $this->diafan->formate_in_datetime($_GET["p".$row["id"]."_1"]);
					$getnav .= '&p'.$row["id"].'_1='.trim($this->diafan->get_param($_GET, "p".$row["id"]."_1", '', 1));
				}
				if (!empty($_GET["p".$row["id"]."_2"]))
				{
					$where_param .= " AND pe".$row["id"].".value".$this->diafan->language_base_site."<='%s'";
					$values_param[] = $this->diafan->formate_in_datetime($_GET["p".$row["id"]."_2"]);
					$getnav .= '&p'.$row["id"].'_2='.trim($this->diafan->get_param($_GET, "p".$row["id"]."_2", '', 1));
				}
			}
			elseif ($row["type"] == 'numtext' && (!empty($_GET["p".$row["id"]."_2"]) || !empty($_GET["p".$row["id"]."_1"])))
			{
				$val1 = (int) $this->diafan->get_param($_GET, "p".$row["id"]."_1", '', 2);
				$val2 = (int) $this->diafan->get_param($_GET, "p".$row["id"]."_2", '', 2);
				$where_param .= " INNER JOIN {shop_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
					." AND pe".$row["id"].".trash='0'"
					.($val1 ? " AND pe".$row["id"].".value".$this->diafan->language_base_site.">=%d" : '')
					.($val2 ? " AND pe".$row["id"].".value".$this->diafan->language_base_site."<=%d" : '')
				;
				$values_param[] = $row["id"];
				if ($val1)
				{
					$values_param[] = $val1;
					$getnav .= '&p'.$row["id"].'_1='.$val1;
				}
				if ($val2)
				{
					$values_param[] = $val2;
					$getnav .= '&p'.$row["id"].'_2='.$val2;
				}
			}
			elseif ($row["type"] == 'checkbox' && !empty($_GET["p".$row["id"]]))
			{
				$where_param .= " INNER JOIN {shop_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
					." AND pe".$row["id"].".trash='0' AND pe".$row["id"].".value".$this->diafan->language_base_site."='1'";
				$values_param[] = $row["id"];
				$getnav .= '&p'.$row["id"].'=1';
			}
			elseif (($row["type"] == 'select' || $row["type"] == 'multiple') && !empty($_GET["p".$row["id"]]))
			{
				if (!is_array($_GET["p".$row["id"]]))
				{
					$val = (int) $this->diafan->get_param($_GET, "p".$row["id"], '', 2);
					$getnav .= '&p'.$row["id"].'='.$val;
					$vals = array($val);
				}
				else
				{
					$vals = array();
					foreach ($_GET["p".$row["id"]] as $val)
					{
						if ($val)
						{
							$val = intval($val);
							$vals[] = $val;
							$getnav .= '&p'.$row["id"].'[]='.$val;
						}
					}
				}
				if (!empty($vals))
				{
					if ($row["required"])
					{
						$where_param .= " INNER JOIN {shop_price_param} AS prp".$row["id"]." ON prp".$row["id"].".price_id=pr.price_id";
						$where .= " AND prp".$row["id"].".param_id=".$row["id"]." AND prp".$row["id"].".param_value IN (".implode(", ", $vals).",0) AND pe".$row["id"].".param_id=".$row["id"];
						if(empty($first_required_param))
						{
							$first_required_param = " AND prp".$row["id"].".price_id=";
						}
						else
						{
							$where .= $first_required_param."prp".$row["id"].".price_id";
						}
					}
					$where_param .= " ".($row["required"] ? "LEFT" : "INNER")." JOIN {shop_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
					." AND pe".$row["id"].".trash='0' AND pe".$row["id"].".value".$this->diafan->language_base_site." IN (".implode(", ", $vals).")";
					$values_param[] = $row["id"];
				}
			}
		}
	
		$values = array_merge($values_param, $values);
		return true;
	}

	/**
	 * Генерирует ссылки на форму редактирования
	 *
	 * @param array $row данные о товаре
	 * @return boolean true
	 */
	private function useradmin(&$row)
	{
		if(! empty($row["price_arr"]))
		{
			foreach($row["price_arr"] as $i => $price)
			{
				if ( ! empty($row['discount']))
				{
					$row["price_arr"][$i]["old_price"] = $this->diafan->_useradmin->get($row["price_arr"][$i]["old_price"], 'price', $row["price_arr"][$i]["price_id"], 'shop_price', '', 'text');
				}
				else
				{
					$row["price_arr"][$i]["price"] = $this->diafan->_useradmin->get($row["price_arr"][$i]["price"], 'price', $row["price_arr"][$i]["price_id"], 'shop_price', '', 'text');
				}
			}
		}
		elseif(! empty($row["price"]))
		{
			if ( ! empty($row['discount']))
			{
				$row["old_price"] = $this->diafan->_useradmin->get($row["old_price"], 'price', $row["price_id"], 'shop_price', '', 'text');
			}
			else
			{
				$row["price"] = $this->diafan->_useradmin->get($row["price"], 'price', $row["price_id"], 'shop_price', '', 'text');
			}
		}

		if ( ! empty($row["name"]))
		{
			$row["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'shop', _LANG);
		}
		if ( ! empty($row["article"]))
		{
			$row["article"] = $this->diafan->_useradmin->get($row["article"], 'article', $row["id"], 'shop', '', 'text');
		}
		if ( ! empty($row["text"]))
		{
			$row["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $row["id"], 'shop', _LANG);
		}

		if ( ! empty($row["anons"]))
		{
			$row["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'shop', _LANG);
		}

		if ( ! empty($row["param"]))
		{
			foreach ($row["param"] as $k => $param)
			{
				$row["param"][$k]["name"] = $this->diafan->_useradmin->get($param["name"], 'name', $param["id"], 'shop_param');
				if ( ! empty($param["value_id"]))
				{
					$lang = in_array($param["type"], array('text', 'textarea', 'editor')) ? _LANG : '';
					$row["param"][$k]["value"] = $this->diafan->_useradmin->get($param["value"], 'value', $param["value_id"], 'shop_param_element', $lang, $param["type"]);
				}
			}
		}

		return true;
	}

	/**
	 * Генерирует данные для страницы сравнения товаров
	 *
	 * @return boolean true
	 */
	public function compare()
	{
		if($this->diafan->configmodules("theme_list_compare"))
		{
			$this->result["theme"] = $this->diafan->configmodules("theme_list_compare");
		}
		if($this->diafan->configmodules("view_compare"))
		{
			$this->result["view"] = $this->diafan->configmodules("view_compare");
		}
		else
		{
			$this->result["view"] = 'compare';
		}

		if (empty($_GET['ids']) || ! is_array($_GET['ids']))
		{
			return $this->result;
		}

		foreach ($_GET['ids'] as &$value)
		{
			$value = intval($value);
		}

		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$result = DB::query("SELECT id, [name], cat_id, timeedit, site_id, no_buy, article, is_file
		FROM {shop} WHERE id IN (".implode(',', $_GET['ids']).") AND site_id=%d AND
		[act]='1' AND trash='0'"
		." AND date_start<=%d AND (date_finish=0 OR date_finish>=%d)", $this->diafan->cid, $time, $time);

		if ( ! (DB::num_rows($result) > 0))
		{
			return false;
		}

		$this->result["rows"] = $this->get_elements($result, 'id');

		$param_ids = array();
		foreach ($this->result["rows"] as $i => $row)
		{
			$params = array();
			foreach($row['param'] as $p)
			{
				if(! in_array($p["id"], $param_ids))
				{
					$param_ids[] = $p['id'];
				}
				$params[$p["id"]] = $p;
			}
			$row['param'] = $params;
			$this->result["rows"][$i] = $row;
		}

		$this->result["existed_params"] = array();
		if($param_ids)
		{
			$existed_params_result = DB::query("SELECT id, [name] FROM {shop_param} WHERE trash='0' AND id IN(".implode(', ', $param_ids).") ORDER BY sort ASC");

			while ($row = DB::fetch_array($existed_params_result))
			{
				$this->result["existed_params"][] = $row;
			}
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->select_price($this->result["rows"][$i]);
			}
		}

		$this->result["param_differences"] = $this->compare_get_param_difference($this->result["rows"], $this->result["existed_params"]);
		return $this->result;
	}

	/**
	 * Находит отличающиеся характеристики у сравниваемых товаров
	 *
	 * @param array $goods товары
	 * @param array $existed_params характеристики товаров
	 * @return array
	 */
	private function compare_get_param_difference(&$goods, &$existed_params)
	{
		if (empty($goods) || empty($existed_params))
		{
			return array();
		}
		$param_differences = array();
		$param_values = array();
		$existed_params_ids = array();

		foreach ($existed_params as $param)
		{
			$existed_params_ids[] = $param['id'];
		}

		foreach ($goods as $good)
		{
			$this->_compare_get_param_difference($good["param"], $param_differences, $param_values, $existed_params_ids);
		}

		return $param_differences;
	}

	/**
	 * Проходит по всем характеристикам товара и находит отличащиеся от общих значения
	 *
	 * @param array $params характеристики текущего товара
	 * @param array $param_differences отличающиеся характеристики, найденные до текущей итерации
	 * @param array $param_values значения характерстик, общие для всех товаров
	 * @param array $existed_params_ids все характеристики выбранных товаров
	 * @return void
	 */
	private function _compare_get_param_difference(&$params, &$param_differences, &$param_values, &$existed_params_ids)
	{
		$ids = array();

		foreach ($params as $param)
		{
			if (in_array($param['id'], $param_differences))
			{
				continue;
			}
			if (isset($param_values[$param['id']]) && $param_values[$param['id']] != $param["value"])
			{
				$param_differences[] = $param['id'];
				continue;
			}

			$param_values[$param['id']] = $param["value"];
			$ids[] = $param['id'];
		}

		foreach ($existed_params_ids as $id)
		{
			if ( ! in_array($id, $ids) && ! in_array($id, $param_differences))
			{
				$param_differences[] = $id;
			}
		}
	}

	/**
	 * Отдает купленный товар-файл
	 * 
	 * @return void
	 */
	public function file_get()
	{
		$date = date('Y-m-d H:i');

		if ( ! $row = DB::fetch_array(DB::query("SELECT a.id, a.name, a.extension, a.size,
			a.module_name
			FROM {shop_files_codes} as c INNER JOIN {attachments} AS a 
			ON a.element_id=c.shop_id AND a.module_name='%s'
			WHERE code='%s' AND date_finish>='%s' LIMIT 1", $this->diafan->module, $_GET["code"], $date)))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Cache-Control: max-age=86400');
		if ($row["extension"])
		{
			header("Content-type: ".$row["extension"]);
		}

		if ($row["size"] > 0)
		{
			header("Content-length: ".$row["size"]);
		}

		header("Content-Disposition: attachment; filename=".$row["name"]);
		header('Content-transfer-encoding: binary');
		header("Connection: close");

		$file_path = ABSOLUTE_PATH.USERFILES."/".$row["module_name"]."/files/".$row["id"];

		$handle = fopen($file_path, "r");

		echo fread($handle, $row["size"]);
		exit;
	}

	/**
	 * Позволяет добавлять характеристики товара  для сортировки
	 * 
	 * @return array $params_for_sort
	 */
	private function expand_sort_with_params()
	{
		$sort_fields_names = array(1 => $this->diafan->_('Цена', false), 3 => $this->diafan->_('Наименование товара', false));

		$sort_directions = array(
			1 => 'CAST(`spe`.`value1` AS SIGNED) ASC',
			2 => 's.name'._LANG.' ASC'
		);

		$param_ids = array();

		$result = DB::query("SELECT p.id, p.[name], p.type FROM {shop_param} AS p "
		. " INNER JOIN {shop_param_category_rel} AS cr ON cr.element_id=p.id AND cr.trash='0' "
		. ($this->diafan->cat ? " AND (cr.cat_id=%d OR cr.cat_id=0)" : "")
		. " WHERE p.trash='0' AND p.display_in_sort='1' AND p.type IN
		('text', 'numtext', 'date', 'datetime', 'checkbox') GROUP BY p.id ORDER BY p.sort", $this->diafan->cat);

		while ($row = DB::fetch_array($result))
		{
			switch($row["type"])
			{
				case 'text':
					$name = 'sp.[value]';
					break;
				case 'numtext':
					$name = 'CAST(sp.value'.$this->diafan->language_base_site.' AS SIGNED)';
					break;
				case 'date':
				case 'datetime':
				case 'checkbox':
					$name = 'sp.value'.$this->diafan->language_base_site;
					break;
			}
			$sort_directions[] = ' '.$name.' ASC ';
			$param_ids[count($sort_directions)] = $row['id'];
			$sort_fields_names[count($sort_directions)] = $row['name'];

			$sort_directions[] = ' '.$name.' DESC ';
			$param_ids[count($sort_directions)] = $row['id'];
		}

		$use_params_for_sort = $this->diafan->sort > 4 ? true : false;

		return array('sort_fields_names' => $sort_fields_names, 'sort_directions' => $sort_directions,
			'param_ids' => $param_ids, 'use_params_for_sort' => $use_params_for_sort);
	}

	/**
	 * Формирует список характеристик, которые могут быть выбраны для сортировки
	 * 
	 * @return array
	 */
	private function get_sort_links()
	{
		$result = array();

		$search_param = $this->get_url_search_param();
		if(!empty($search_param)) $search_param='?action=search&'.$search_param;

		foreach ($this->sort_config['sort_directions'] as $key => $value)
		{
			$result[$key] = ($this->diafan->sort != $key ? $this->diafan->_route->current_link(array("page"), array('sort' => $key)).$search_param.
			($this->view_all_records ? '?view=all': '') : '');
		}

		return $result;
	}

	/**
	 * Получает параметры поиска из URL
	 *
	 * @return string
	 */
	private function get_url_search_param()
	{
		$param = array();
		if (!empty($_GET['action']) && $_GET['action'] == "search")
		{
			foreach ($_GET as $k => $v)
			{
				switch ($k)
				{
					case 'rewrite':
					case 'action':
					case 'module_ajax':
						continue 2;

					case 'a':
					case 'n':
					case 'd':
						//TODO: добавить нужные параметры в которые при поиске не преобразуются в числа
						$v = htmlspecialchars(strip_tags($v));
						break;

					default:
						if(is_array($v))
						{
							foreach($v as $vv)
							{
								$vv= (int)preg_replace("/\D/", '', $vv);
								$param[] = $k.'[]='.$vv;
							}
							continue 2;
						}
						$v = (int)preg_replace("/\D/", '', $v);
				}
				$param[] = $k.'='.$v;
			}
			return implode('&', $param);
		}
		return '';
	}
}