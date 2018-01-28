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
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Ads_model
 *
 * Модель модуля "Объявления"
 */
class Ads_model extends Model
{
	/**
	 * Генерирует данные для списка объявлений, если отключены категории
	 * 
	 * @return array
	 */
	public function list_()
	{
		if ($this->diafan->cat)
		{
			include ABSOLUTE_PATH . 'includes/404.php';
		}
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$cache_meta = array(
			"name" => "list",
			"lang_id" => _LANG,
			"page" => $this->diafan->page > 1 ? $this->diafan->page : 1,
			"site_id" => $this->diafan->cid,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"time" => $time,
			"year" => $this->diafan->year,
			"month" => $this->diafan->month,
			"day" => $this->diafan->day,
		);
		//кеширование
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$this->result = array();

			if ($this->diafan->year || $this->diafan->month || $this->diafan->day)
			{
				if ($this->diafan->cat)
				{
					include ABSOLUTE_PATH . 'includes/404.php';
				}
				if (! $this->diafan->year || ! $this->diafan->month && $this->diafan->day)
				{
					include ABSOLUTE_PATH . 'includes/404.php';
				}
				if ($this->diafan->month)
				{
					$month_arr = array(
						'12' => $this->diafan->_('Декабрь', false),
						'11' => $this->diafan->_('Ноябрь', false),
						'10' => $this->diafan->_('Октябрь', false),
						'09' => $this->diafan->_('Сентябрь', false),
						'08' => $this->diafan->_('Август', false),
						'07' => $this->diafan->_('Июль', false),
						'06' => $this->diafan->_('Июнь', false),
						'05' => $this->diafan->_('Май', false),
						'04' => $this->diafan->_('Апрель', false),
						'03' => $this->diafan->_('Март', false),
						'02' => $this->diafan->_('Февраль', false),
						'01' => $this->diafan->_('Январь', false)
					);
					if ($this->diafan->day)
					{
						$this->result["titlemodule"] =
								sprintf(
								$this->diafan->_('Объявления за %s', false), $this->format_date(mktime(0, 0, 0, $this->diafan->month, $this->diafan->day, $this->diafan->year))
						);
					}
					else
					{
						$this->result["titlemodule"] =
								sprintf(
								$this->diafan->_('Объявления за %s %s года', false), $month_arr[$this->diafan->month], $this->diafan->year
						);
					}
				}
				else
				{
					$this->result["titlemodule"] =
							sprintf(
							$this->diafan->_('Объявления за %s год', false), $this->diafan->year
					);
				}

				$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));
				if($this->diafan->day)
				{
					$time1 = mktime(0, 0, 0, $this->diafan->month, $this->diafan->day, $this->diafan->year);
					$time2 = $time1 + 86400;
				}
				elseif($this->diafan->month)
				{
					$time1 = mktime(0, 0, 0, $this->diafan->month, 1, $this->diafan->year);
					$time2 = mktime(0, 0, 0, $this->diafan->month, date("t", $time1), $this->diafan->year) + 86400;
				}
				else
				{
					$time1 = mktime(0, 0, 0, 1, 1, $this->diafan->year);
					$time2 = mktime(0, 0, 0, 1, 1, $this->diafan->year + 1);
				}
				$time2 = $time2 < $time ? $time2 : $time;

				////navigation///
				$this->diafan->_paginator->page = $this->diafan->page;
				$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
				$this->diafan->_paginator->navlink_tpl = $this->diafan->_route->current_link("", array("page" => "%d"));
				
				$this->diafan->_paginator->nen = $this->list_date_query_count($time, $time1, $time2);
				$links = $this->diafan->_paginator->get();
				////navigation///

				$result = $this->list_date_query($time, $time1, $time2);
			}
			else
			{
				////navigation///
				$this->diafan->_paginator->page = $this->diafan->page;
				$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
				$this->diafan->_paginator->nen = $this->list_query_count($time);
				$links = $this->diafan->_paginator->get();
				////navigation///

				$result = $this->list_query($time);
			}
	
			$this->result["rows"] = $this->get_elements($result);

			$this->result["paginator"] = $links;

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);
			}
		}
		$this->theme_view();

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);

		return $this->result;
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
			"SELECT COUNT(DISTINCT e.id) FROM {ads} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
			." WHERE e.[act]='1' AND e.trash='0'"
			." AND e.site_id=%d AND e.created<%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")",
			$this->diafan->cid, $time, $time, $time
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
			"SELECT e.id, e.created, e.[name], e.[anons], e.timeedit, e.cat_id, e.site_id FROM {ads} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
			." WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d AND e.created<%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")"
			." GROUP BY e.id ORDER BY e.prior DESC, e.created DESC, e.id DESC",
			$this->diafan->cid, $time, $time, $time,
			$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);
		return $result;
	}

	/**
	 * Получает из базы данных общее количество элементов за определенный период, если не используются категории
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param integer $date_start начало периода в формате UNIX
	 * @param integer $date_finish конец периода в формате UNIX
	 * @return integer
	 */
	private function list_date_query_count($time, $date_start, $date_finish)
	{
		$count = DB::query_result(
			"SELECT COUNT(DISTINCT e.id) FROM {ads} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
			." WHERE e.[act]='1' AND e.trash='0'"
			." AND e.site_id=%d AND e.created>=%d AND e.created<%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")",
			$this->diafan->cid, $time1, $time2, $time, $time
		);
		return $count;
	}

	/**
	 * Получает из базы данных элементы на одной странице за определенный период, если не используются категории
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param integer $date_start начало периода в формате UNIX
	 * @param integer $date_finish конец периода в формате UNIX
	 * @return resource
	 */
	private function list_date_query($time, $date_start, $date_finish)
	{
		$result = DB::query_range(
			"SELECT e.id, e.created, e.[name], e.[anons], e.timeedit, e.cat_id, e.site_id FROM {ads} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
			." WHERE e.[act]='1'"
			." AND e.trash='0' AND e.site_id=%d AND e.created>=%d AND e.created<%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")"
			." GROUP BY e.id ORDER BY e.prior DESC, e.created DESC, e.id DESC",
			$this->diafan->cid, $time1, $time2, $time, $time,
			$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);
		return $result;
	}

	/**
	 * Генерирует данные для списка объявлений, найденных с помощью поиска
	 * 
	 * @return array
	 */
	public function list_search()
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$where_param = '';
		$where = '';
		$values = array();
		$getnav = '';

		$this->get_where($where, $where_param, $values, $getnav);

		$values[] = $time;
		$values[] = $time;

		////navigation//
		$this->diafan->_paginator->page = $this->diafan->page;
		$this->diafan->_paginator->get_nav = $getnav;
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->nen = $this->list_search_query_count($where_param, $where, $values);

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
		$this->result["path"] = $this->get_path('ads');
		$this->result["titlemodule"] = $this->diafan->_('Поиск по объявлениям', false);
		if ( ! $this->diafan->_paginator->nen)
		{
			$this->result["err"] = $this->diafan->_('Извините, ничего не найдено.', false);
			if (! empty($_GET["module_ajax"]) && $_GET["module_ajax"] == "ads")
			{
				header('Content-Type: text/html; charset=utf-8');
				echo $this->result["err"];
				exit;
			}
			return $this->result;
		}

		$result = $this->list_search_query($where_param, $where, $values);

		$this->result["rows"] = $this->get_elements($result);

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $links);

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);

				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);
			}
		}

		if (! empty($_GET["module_ajax"]) && $_GET["module_ajax"] == "ads")
		{
			header('Content-Type: text/html; charset=utf-8');
			$this->result["ajax"] = true;
			$GLOBALS["include_ads_js"] = true;
			$this->result = $this->get_result();
			$this->diafan->_tpl->get($this->result["view"], 'ads', $this->result);
			exit;
		}

		return $this->result;
	}
	/**
	 * Получает из базы данных общее количество найденных при помощи поиска элементов
	 * 
	 * @param string $where_param
	 * @param string $where
	 * @param array $values
	 * @return integer
	 */
	private function list_search_query_count($where_param, $where, $values)
	{
		$count = DB::query_result("SELECT COUNT(s.id) FROM {ads} AS s"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='ads'" : "")
		.$where_param
		." WHERE s.[act]='1' AND s.trash='0'"
		." AND (s.access='0'"
		.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		.")"
		.$where
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
		." GROUP BY s.id",
		$values);
		return $count;
	}

	/**
	 * Получает из базы данных найденных при помощи поиска элементы на одной странице
	 * 
	 * @param string $where_param
	 * @param string $where
	 * @param array $values
	 * @return resource
	 */
	private function list_search_query($where_param, $where, $values)
	{
		$result = DB::query_range("SELECT DISTINCT s.id, s.[name], s.timeedit, s.[anons], s.cat_id, s.site_id, s.created FROM {ads} AS s"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='ads'" : "")
		. $where_param
		. " WHERE s.[act]='1' AND s.trash='0'"
		. " AND (s.access='0'"
		. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		. ")"
		. $where
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
		. " GROUP BY s.id"
		. " ORDER BY created DESC",
		$values, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
		return $result;
	}

	/**
	 * Генерирует данные для списка объявлений, соответствующих значению доп. характеристики
	 * 
	 * @return array
	 */
	public function list_param()
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$cache_meta = array(
			"name" => "list_param",
			"lang_id" => _LANG,
			"page" => $this->diafan->page > 1 ? $this->diafan->page : 1,
			"site_id" => $this->diafan->cid,
			"param" => $this->diafan->param,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"time" => $time
		);
		//кеширование
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$param_value = DB::fetch_array(DB::query("SELECT param_id, [name] FROM {ads_param_select} WHERE id=%d LIMIT 1", $this->diafan->param));
			if ( ! $param_value = DB::fetch_array(DB::query("SELECT param_id, [name] FROM {ads_param_select} WHERE id=%d LIMIT 1", $this->diafan->param)))
			{
				include ABSOLUTE_PATH . 'includes/404.php';
			}
			if ( ! $param = DB::fetch_array(DB::query("SELECT [name] FROM {ads_param} WHERE id=%d LIMIT 1", $param_value["param_id"])))
			{
				include ABSOLUTE_PATH . 'includes/404.php';
			}
			////navigation//
			$this->diafan->_paginator->page = $this->diafan->page;
			$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");

			$this->diafan->_paginator->nen = $this->list_param_query_count($time, $param_value["param_id"]);
			$this->result["paginator"] = $this->diafan->_paginator->get();
			////navigation///

			$this->result["path"] = $this->get_path('ads');
			$this->result["titlemodule"] = $param["name"] . ': ' . $param_value["name"];

			$result = $this->list_param_query($time, $param_value["param_id"]);
			$this->result["rows"] = $this->get_elements($result);

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
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

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);

		return $this->result;
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
		$count = DB::query_result(
		"SELECT COUNT(DISTINCT s.id) FROM {ads} AS s "
		. " INNER JOIN {ads_param_element} AS e ON e.element_id=s.id"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='ads'" : "")
		. " WHERE s.[act]='1' AND s.trash='0' AND e.param_id=%d AND e.value".$this->diafan->language_base_site."=%d"
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)",
		$param_value["param_id"], $this->diafan->param, $time, $time);
		return $count;
	}

	/**
	 * Получает из базы данных элементы на одной странице, соответствующие значению доп. характеристики
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @param integer $param_id дополнительная характеристика
	 * @return resource
	 */
	private function list_param_query($time, $param_id)
	{
		$result = DB::query_range(
		"SELECT s.id, s.[name], s.timeedit, s.[anons], s.cat_id, s.site_id, s.created FROM {ads} AS s"
		. " INNER JOIN {ads_param_element} as e ON e.element_id=s.id"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='ads'" : "")
		. " WHERE s.[act]='1' AND s.trash='0' AND e.param_id=%d AND e.value".$this->diafan->language_base_site."=%d"
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
		. " AND (s.access='0'"
		. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		. ")"
		. " GROUP BY s.id"
		. " ORDER BY s.prior DESC, s.created DESC",
		$param_id, $this->diafan->param, $time, $time,
		$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);

		return $result;
	}

	/**
	 * Генерирует данные для списка объявлений текущего пользователя
	 * 
	 * @return array
	 */
	public function list_my()
	{
		if(! $this->diafan->_user->id)
		{
			include_once(ABSOLUTE_PATH.'includes/404.php');
		}
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		////navigation//
		$this->diafan->_paginator->page = $this->diafan->page;
		$this->diafan->_paginator->get_nav = '?action=my';
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->nen = $this->list_my_query_count($time);

		$links = $this->diafan->_paginator->get();
		////navigation///

		$this->result["path"] = $this->get_path('ads');

		$result = $this->list_my_query($time);

		$this->result["rows"] = $this->get_elements($result);

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $links);

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);

				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);
			}
		}
		if($this->diafan->configmodules("theme_list_my"))
		{
			$this->result["theme"] = $this->diafan->configmodules("theme_list_my");
		}
		if($this->diafan->configmodules("view_list_my"))
		{
			$this->result["view"] = $this->diafan->configmodules("view_list_my");
		}
		else
		{
			$this->result["view"] = 'list';
		}

		return $this->result;
	}

	/**
	 * Получает из базы данных общее количество элементов текущего пользователя
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return integer
	 */
	private function list_my_query_count($time)
	{
		$count = DB::query_result("SELECT COUNT(s.id) FROM {ads} AS s"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='ads'" : "")
		." WHERE s.[act]='1' AND s.trash='0'"
		." AND (s.access='0'"
		.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." AND s.site_id=%d AND s.user_id=%d"
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
		." GROUP BY s.id",
		$this->diafan->cid, $this->diafan->_user->id);
		return $count;
	}

	/**
	 * Получает из базы данных элементы текущего пользователяна одной странице
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return resource
	 */
	private function list_my_query($time)
	{
		$result = DB::query_range("SELECT DISTINCT s.id, s.[name], s.timeedit, s.[anons], s.cat_id, s.site_id, s.created FROM {ads} AS s"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='ads'" : "")
		." WHERE s.[act]='1' AND s.trash='0'"
		." AND (s.access='0'"
		.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		.")"
		." AND s.site_id=%d AND s.user_id=%d"
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
		." GROUP BY s.id"
		." ORDER BY s.prior DESC, s.created DESC",
		$this->diafan->cid, $this->diafan->_user->id,
		$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);

		return $result;
	}

	/**
	 * Генерирует данные для первой страницы модуля
	 * 
	 * @return boolean
	 */
	public function first_page()
	{
		if ($this->diafan->page)
		{
			include ABSOLUTE_PATH . 'includes/404.php';
		}
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
			"name" => "first_page",
			"lang_id" => _LANG,
			"site_id" => $this->diafan->cid,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
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
					$cat_ids = $this->diafan->get_children($row["id"], "ads_category");
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

				$cat["link_all"] = $this->diafan->_route->link($row["site_id"], 'ads', $row["id"]);

				if ($this->diafan->configmodules("images_cat") && $this->diafan->configmodules("list_img_cat"))
				{
					$cat["img"] =
					$this->diafan->_images->get(
						'medium', $row["id"], $this->diafan->module,
						$row["site_id"], $row["name"], 0, true,
						$this->diafan->configmodules("list_img_cat") == 1 ? 1 : 0,
						$cat["link_all"]
					);
				}
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

				$this->result["categories"][$cat]["name"] = $this->diafan->_useradmin->get($rows["name"], 'name', $rows["id"], 'ads_category', _LANG);
				$this->result["categories"][$cat]["anons"] = $this->diafan->_useradmin->get($rows["anons"], 'anons', $rows["id"], 'ads_category', _LANG);
				$this->result["categories"][$cat]["rating"] = $this->diafan->_rating->get($rows["id"], '', 0, true);
				foreach ($rows["children"] as $k => $row)
				{
					$this->result["categories"][$cat]["children"][$k]["name"] =
							$this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'ads_category', _LANG);

					$this->result["categories"][$cat]["children"][$k]["anons"] =
							$this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'ads_category', _LANG);
				}

				foreach ($rows["rows"] as $k => $row)
				{
					$this->useradmin($this->result["categories"][$cat]["rows"][$k]);
					$this->format_data($this->result["categories"][$cat]["rows"][$k]);

					$this->result["categories"][$cat]["rows"][$k]["tags"] =  $this->diafan->_tags->get($row["id"]);

					$this->result["categories"][$cat]["rows"][$k]["rating"] = $this->diafan->_rating->get($row["id"]);
				}
			}
		}
		$this->theme_view_first_page();
		return $this->result;
	}

	/**
	 * Получает из базы данных категории верхнего уровня для первой странице модуля, если категории используются
	 * 
	 * @return resource
	 */
	private function first_page_cats_query()
	{
		$result = DB::query(
		"SELECT c.id, c.[name], c.[anons], c.timeedit, c.site_id FROM {ads_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='ads'" : "")
		. " WHERE c.[act]='1' AND c.parent_id=0 AND c.trash='0' AND c.site_id=%d"
		. " AND (c.access='0'"
		. ($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		. ")"
		. " GROUP BY c.id ORDER by c.sort ASC, c.id ASC", $this->diafan->cid
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
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.site_id, e.created FROM {ads} AS e"
		. " INNER JOIN {ads_category_rel} AS r ON e.id=r.element_id"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
		. " WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		. ")"
		. " GROUP BY e.id ORDER BY e.prior DESC, e.created DESC",
		implode(',', $cat_ids), $time, $time,
		0, $this->diafan->configmodules("count_list")
		);
		return $result;
	}

	/**
	 * Генерирует данные для списка объявлений в категории
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
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"time" => $time
		);
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$result = $this->list_category_query();

			if ( ! $row = DB::fetch_array($result))
			{
				include_once ABSOLUTE_PATH . 'includes/404.php';
			}
			if (empty($row) || (!empty($row['access']) && !$this->access(0, $row['id'])))
			{
				include_once(ABSOLUTE_PATH.'includes/403.php');
			}

			$this->result = $row;

			$this->result["level"] = count($this->diafan->get_parents($this->diafan->cat, 'ads_category'));
			$this->result["path"] = $this->get_path('ads');

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
				$cat_ids = $this->diafan->get_children($this->diafan->cat, "ads_category");
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
			$this->result["paginator"] = $this->diafan->_paginator->get();
			////navigation///

			$result_elements = $this->list_category_elements_query($time, $cat_ids);
			$this->result["rows"] = $this->get_elements($result_elements);

			$this->meta_cat($row);
			$this->theme_view_cat($row);
			
			$this->list_category_previous_next($row["sort"], $row["parent_id"]);

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}

		$this->result["text"] = $this->diafan->_useradmin->get($this->result["text"], 'text', $this->diafan->cat, 'ads_category', _LANG);

		$this->result["comments"] = $this->diafan->_comments->get($this->diafan->cat, $this->diafan->module, $this->diafan->cid, true);
		$this->result["rating"] = $this->diafan->_rating->get($this->diafan->cat, $this->diafan->module, $this->diafan->cid, true);

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);

				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);
			}
			if ( ! empty($this->result["previous"]["text"]))
			{
				$this->result["previous"]["text"] =
						$this->diafan->_useradmin->get($this->result["previous"]["text"], 'name', $this->result["previous"]["id"], 'ads_category', _LANG);
			}
			if ( ! empty($this->result["next"]["text"]))
			{
				$this->result["next"]["text"] =
						$this->diafan->_useradmin->get($this->result["next"]["text"], 'name', $this->result["next"]["id"], 'ads_category', _LANG);
			}
			foreach ($this->result["children"] as $id => $row)
			{
				$this->result["children"][$id]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'ads_category', _LANG);
				$this->result["children"][$id]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'ads_category', _LANG);
			}
			foreach ($this->result["path"] as $k => $path)
			{
				if ($k == 0)
					continue;
				$this->result["path"][$k]["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $path["id"], 'ads_category', _LANG);
			}
		}

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);

		return $this->result;
	}

	/**
	 * Получает из базы данных данные о текущей категории для списка элементов в категории
	 * 
	 * @return resource
	 */
	private function list_category_query()
	{
		$result = DB::query("SELECT id, [name], [text], timeedit, [descr], [keywords], sort, parent_id, [title_meta], access, theme, view FROM {ads_category}"
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
		"SELECT COUNT(DISTINCT e.id) FROM {ads} AS e"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
		." INNER JOIN {ads_category_rel} AS r ON e.id=r.element_id"
		." WHERE e.[act]='1' AND e.trash='0'"
		." AND r.cat_id IN (%s)"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
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
		$result = DB::query_range(
		"SELECT s.id, s.[name], s.cat_id, s.timeedit, s.[anons], s.site_id, s.created FROM {ads} AS s"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='ads'" : "")
		." INNER JOIN {ads_category_rel} AS r ON s.id=r.element_id AND r.cat_id IN (%s)"
		." WHERE s.[act]='1' AND s.trash='0'"
		." AND s.date_start<=%d AND (s.date_finish=0 OR s.date_finish>=%d)"
		." AND (s.access='0'"
		.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		.")"
		." GROUP BY s.id ORDER BY s.prior DESC, s.created DESC", implode(',', $cat_ids), $time, $time,
		$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);
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
		"SELECT c.[name], c.id FROM {ads_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='ads'" : "")
		. " WHERE c.[act]='1' AND c.trash='0' AND c.site_id=%d"
		. " AND (c.sort<%d OR c.sort=%d AND c.id<%d) AND c.parent_id=%d"
		. " AND (c.access='0'"
		. ($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " ORDER BY c.sort DESC, c.id DESC LIMIT 1", $this->diafan->cid, $sort, $sort, $this->diafan->cat, $parent_id));
		if ($previous)
		{
			$this->result["previous"]["text"] = $previous["name"];
			$this->result["previous"]["id"]   = $previous["id"];
			$this->result["previous"]["link"] = $this->diafan->_route->link($this->diafan->cid, "ads", $previous["id"]);
		}
		$next = DB::fetch_array(DB::query(
		"SELECT c.[name], c.id FROM {ads_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='ads'" : "")
		. " WHERE c.[act]='1' AND c.trash='0' AND c.site_id=%d"
		. " AND (c.sort>%d OR c.sort=%d AND c.id>%d) AND c.parent_id=%d"
		. " AND (c.access='0'"
		. ($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		. ")"
		. " ORDER BY c.sort ASC, c.id ASC LIMIT 1", $this->diafan->cid, $sort, $sort, $this->diafan->cat, $parent_id));
		if ($next)
		{
			$this->result["next"]["text"] = $next["name"];
			$this->result["next"]["id"] = $next["id"];
			$this->result["next"]["link"] = $this->diafan->_route->link($this->diafan->cid, "ads", $next["id"]);
		}
	}

	/**
	 * Генерирует данные для страницы объявления
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
			"time" => $time
		);
		if ( ! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$row = $this->id_query($time);
			if (empty($row))
			{
				include ABSOLUTE_PATH . 'includes/404.php';
			}

			if ( ! $this->diafan->rewrite_module && ($this->diafan->configmodules("cat") && $this->diafan->cat != $row["cat_id"]
					|| ! $this->diafan->configmodules("cat") && $this->diafan->cat))
			{
				include ABSOLUTE_PATH . 'includes/404.php';
			}
			if ( ! empty($row['access']) && ! $this->access($row['id']))
			{
				include ABSOLUTE_PATH . 'includes/403.php';
			}
			$this->result = $row;
			if(! $this->diafan->configmodules("cat"))
			{
				$this->result["cat_id"] = 0;
			}
			$this->diafan->cat = $this->result["cat_id"];

			if ($this->diafan->configmodules("images"))
			{
				$this->result["img"] = $this->diafan->_images->get(
					'medium', $row["id"], $this->diafan->module,
					$this->diafan->cid, $row["name"], 0, false, 0, 'large'
				);
			}

			$this->meta($row);
			$this->theme_view_element($row);
			$this->result["date"] = $this->format_date($row['created']);
			$this->result["param"] = $this->get_param($row["id"], $this->diafan->cid);

			$this->id_previous_next($row["created"], $time);

			$this->result["path"] = $this->get_path('ads');

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}
		$this->diafan->cat = $this->result["cat_id"];

		if ( ! empty($this->result["previous"]["text"]))
		{
			$this->result["previous"]["text"] =
					$this->diafan->_useradmin->get($this->result["previous"]["text"], 'name', $this->result["previous"]["id"], 'ads', _LANG);
		}
		if ( ! empty($this->result["next"]["text"]))
		{
			$this->result["next"]["text"] =
					$this->diafan->_useradmin->get($this->result["next"]["text"], 'name', $this->result["next"]["id"], 'ads', _LANG);
		}
		foreach ($this->result["path"] as $k => $path)
		{
			if ($k == 0)
				continue;
			$this->result["path"][$k]["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $path["id"], 'ads_category', _LANG);
		}

		$this->counter_view();

		$this->useradmin($this->result);
		$this->format_data($this->result);

		$this->result["rating"] = $this->diafan->_rating->get();
		$this->result["comments"] = $this->diafan->_comments->get();
		$this->result["tags"] = $this->diafan->_tags->get();

		return $this->result;
	}

	/**
	 * Получает из базы данных данные о текущем элементе для страницы элемента
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return array
	 */
	private function id_query($time)
	{
		$row = DB::fetch_array(DB::query("SELECT id, [name], [anons], [text], timeedit, cat_id, [keywords],"
		." [descr], [title_meta], access, theme, view, created  FROM {ads}"
		." WHERE [act]='1' AND id = %d AND trash='0' AND site_id=%d"
		." AND date_start<=%d AND (date_finish=0 OR date_finish>=%d) LIMIT 1",
		$this->diafan->show, $this->diafan->cid, $time, $time));
		return $row;
	}

	/**
	 * Формирует ссылки на предыдущий и следующий элемент
	 * 
	 * @param integer $created время создания текущего элемента
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return void
	 */
	private function id_previous_next($created, $time)
	{
		$previous = DB::fetch_array(DB::query(
		"SELECT e.[name], e.id, e.cat_id FROM {ads} AS e"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
		. " WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
		. ($this->diafan->configmodules("cat") ? " AND e.cat_id='" . $this->diafan->cat . "'" : '')
		. " AND (e.created<%d OR e.created=%d AND e.id<%d)"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		. ")"
		. " ORDER BY e.prior DESC, e.created DESC LIMIT 1",
		$this->diafan->cid, $created, $created, $this->diafan->show, $time, $time
		));
		if ($previous)
		{
			$this->result["previous"]["text"] = $previous["name"];
			if ( ! $this->diafan->configmodules("cat"))
			{
				$previous["cat_id"] = 0;
			}
			$this->result["previous"]["id"] = $previous["id"];
			$this->result["previous"]["link"] = $this->diafan->_route->link($this->diafan->cid, "ads", $previous["cat_id"], $previous["id"]);
		}
		$next = DB::fetch_array(DB::query(
		"SELECT e.[name], e.id, e.cat_id FROM {ads} AS e"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
		. " WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
		. ($this->diafan->configmodules("cat") ? " AND e.cat_id='" . $this->diafan->cat . "'" : '')
		. " AND (e.created>%d OR e.created=%d AND e.id>%d)"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		. ")"
		. " ORDER BY e.prior ASC, e.created ASC, e.id ASC LIMIT 1",
		$this->diafan->cid, $created, $created, $this->diafan->show, $time, $time
		));
		if ($next)
		{
			$this->result["next"]["text"] = $next["name"];
			if ( ! $this->diafan->configmodules("cat"))
			{
				$next["cat_id"] = 0;
			}
			$this->result["next"]["id"] = $next["id"];
			$this->result["next"]["link"] = $this->diafan->_route->link($this->diafan->cid, "ads", $next["cat_id"], $next["id"]);
		}
	}

	/**
	 * Генерирует данные для шаблонной функции: блок объявлений
	 * 
	 * @param integer $count количество объявлений
	 * @param array $cat_ids категории
	 * @param array $site_ids страницы сайта
	 * @param string $sort сортировка default - по дате, rand - случайно
	 * @param integer $images количество изображений
	 * @param string $images_variation размер изображений
	 * @param string $param дополнительные параметры
	 * @return boolean
	 */
	public function show_block($count, $cat_ids, $site_ids, $sort, $images, $images_variation, $param)
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
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"time" => $time
		);

		if ($sort == "rand" || ! $this->result = $this->diafan->_cache->get($cache_meta, "ads"))
		{
			if(! $this->validate_attribute_site_cat('ads', $site_ids, $cat_ids))
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
					INNER JOIN {ads_param_element} AS pe" . $id . " ON pe" . $id . ".element_id=e.id AND pe" . $id . ".param_id='" . $id . "'"
							. " AND pe" . $id . ".trash='0' AND (";
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
						$where .= "pe" . $id . ".value".$this->diafan->language_base_site.$operators[$id][$i]."'%h'";
						$values[] = $val;
					}
					$where .= ")";
				}
				else
				{
					$where .= "
					INNER JOIN {ads_param_element} AS pe" . $id . " ON pe" . $id . ".element_id=e.id AND pe" . $id . ".param_id='" . $id . "'"
					. " AND pe" . $id . ".trash='0' AND pe" . $id . ".value".$this->diafan->language_base_site.$operators[$id]."'%h'";
					$values[] = $value;
				}
			}
			$values[] = $time;
			$values[] = $time;

			if ($sort == "rand")
			{
				$max_count = DB::query_result("SELECT COUNT(DISTINCT e.id) FROM {ads} as e"
				. ($cat_ids ? " INNER JOIN {ads_category_rel} as c ON c.element_id=e.id"
						. " AND c.cat_id IN (" . implode(',', $cat_ids) . ")" : ''
				)
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
				. $where
				. " WHERE e.[act]='1' AND e.trash='0'"
				. ($site_ids ? " AND e.site_id IN (".implode(",", $site_ids).")" : '')
				." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
				. " AND (e.access='0'"
				. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
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
				case 'rand':
					$order = '';
					break;

				default :
					$order = ' ORDER BY e.prior, e.created ASC';
			}

			foreach ($rands as $rand)
			{
				$result = DB::query("SELECT e.id, e.[name], e.[anons], e.cat_id, e.timeedit, e.site_id, e.created FROM {ads} AS e"
				. ($cat_ids ? " INNER JOIN {ads_category_rel} as c ON c.element_id=e.id"
						. " AND c.cat_id IN (" . implode(',', $cat_ids) . ")" : ''
				)
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
				. $where
				. " WHERE e.[act]='1' AND e.trash='0'"
				. ($site_ids ? " AND e.site_id IN (".implode(",", $site_ids).")" : '')
				." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
				. " AND (e.access='0'"
				. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
				. ")"
				. " GROUP BY e.id"
				. $order
				. ' LIMIT '
				. ($sort == "rand" ? $rand : 0) . ', '
				. ($sort == "rand" ? 1 : $count), $values);
				$rows = $this->get_elements($result, 'block', array("count" => $images, "variation" => $images_variation));
				$this->result["rows"] = array_merge($this->result["rows"], $rows);
			}

			// если категория только одна, задаем ссылку на нее
			if (!empty($this->result["rows"]) && count($cat_ids) == 1)
			{
				$cat = DB::fetch_array(DB::query("SELECT [name], site_id, id FROM {ads_category} WHERE id=%d LIMIT 1", $cat_ids[0]));

				$this->result["name"] = $cat["name"];
				$this->result["link_all"] = $this->diafan->_route->link($cat["site_id"], 'ads', $cat["id"]);
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
				$this->diafan->_cache->save($this->result, $cache_meta, "ads");
			}
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);
			}
		}

		return $this->result;
	}

	/**
	 * Генерирует данные для шаблонной функции: блок связанных объявлений
	 * 
	 * @param integer $count количество объявлений
	 * @param integer $images количество изображений
	 * @param string $images_variation размер изображений
	 * @return void
	 */
	public function show_block_rel($count, $images, $images_variation)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
			"name" => "block_rel",
			"count" => $count,
			"lang_id" => _LANG,
			"element_id" => $this->diafan->show,
			"images" => $images,
			"images_variation" => $images_variation,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"time" => $time
		);

		if (! $this->result = $this->diafan->_cache->get($cache_meta, "ads"))
		{
			$this->result["rows"] = array();

			$result = DB::query_range(
			"SELECT e.id, e.[name], e.[anons], e.cat_id, e.timeedit, e.site_id, e.created FROM {ads} AS e"
			. " INNER JOIN {ads_rel} AS r ON e.id=r.rel_element_id AND r.element_id=%d"
			.($this->diafan->configmodules("rel_two_sided") ? " OR e.id=r.element_id AND r.rel_element_id=".$this->diafan->show : '')
			. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
			. " WHERE e.[act]='1' AND e.trash='0'"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			. " AND (e.access='0'"
			. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
			. ")"
			. " GROUP BY e.id"
			. ' ORDER BY e.prior DESC, e.created DESC',
			$this->diafan->show, $time, $time, 0, $count
			);
			$this->result["rows"] = $this->get_elements($result, 'block', array("count" => $images, "variation" => $images_variation));
			$this->diafan->_cache->save($this->result, $cache_meta, "ads");
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->useradmin($this->result["rows"][$i]);
				$this->format_data($this->result["rows"][$i]);
			}
		}
		return $this->result;
	}


	/**
	 * Генерирует контент для шаблонной функции: форма поиска по объявлениям
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

		if (! $result_content = $this->diafan->_cache->get($cache_meta, "ads"))
		{
			if($cat_ids === 'all')
			{
				$cat_ids = array();
				$cat_ids_all = true;
			}
			if(! $this->validate_attribute_site_cat('ads', $site_ids, $cat_ids))
			{
				return false;
			}
			$result_content["cat_ids"] = array();
			if(count($cat_ids) > 1 || ! empty($cat_ids_all))
			{
				if(empty($cat_ids_all))
				{
					$result = DB::query("SELECT id, [name], site_id, parent_id FROM {ads_category} WHERE id IN (%s) ORDER BY sort ASC", implode(',', $cat_ids));
				}
				else
				{
					$result = DB::query("SELECT c.id, c.[name], c.site_id, c.parent_id FROM {ads_category} AS c"
					. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='ads'" : "")
					. " WHERE c.[act]='1' AND c.trash='0' AND c.site_id IN (%s)"
					. " AND (c.access='0'"
					. ($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
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
				$result_content["site_ids"][] = array("path" => $this->diafan->_route->link($site_ids[0]));
			}

			if ($this->diafan->configmodules("search_name", "ads", $site_ids[0]))
			{
				$result_content["name"] = array(
					"name" => 1,
					"value" => ''
				);
			}
	
			if ($this->diafan->configmodules("search_text", "ads", $site_ids[0]))
			{
				$result_content["text"] = array(
					"name" => 1,
					"value" => ''
				);
			}
	
			$result_content["rows"] = array();
			$result = DB::query("SELECT p.id, p.type, p.[name], GROUP_CONCAT(c.cat_id SEPARATOR ',') as cat_ids FROM {ads_param} as p "
					." INNER JOIN {ads_param_category_rel} AS c ON p.id=c.element_id AND "
					.($cat_ids ? "(c.cat_id IN (".implode(',', $cat_ids).") OR c.cat_id=0)" : "c.cat_id=0")
					." WHERE p.search='1' AND p.trash='0' GROUP BY p.id ORDER BY p.sort ASC");
	
			while ($row = DB::fetch_array($result))
			{
				if ($row["type"] == 'select' || $row["type"] == 'multiple')
				{
					$result_select = DB::query(
						"SELECT p.[name], p.id FROM {ads_param_select} AS p"
						// выводим значения, только есть объявления, чтобы поиск не давал пустых результатов
						." INNER JOIN {ads_param_element} AS e ON p.param_id=e.param_id AND e.value1=p.id"
						." INNER JOIN {ads} AS s ON e.element_id=s.id AND s.[act]='1' AND s.trash='0'"
						.($cat_ids ? " INNER JOIN {ads_category_rel} AS c ON c.element_id=s.id AND c.cat_id IN (".implode(",", $cat_ids).")" : '')
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

		if($this->diafan->module == 'ads' && in_array($this->diafan->cid, $site_ids))
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
		if($this->diafan->module == 'ads' && in_array($this->diafan->cat, $cat_ids))
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
	 * Генерирует данные для формы добавления объявления
	 * 
	 * @param array|string $cat_ids номера категорий
	 * @param array $site_ids страницы сайта
	 * @param boolean $insert_form форма выводится с помощью шаблонного тэга
	 * @return array|boolean false
	 */
	public function form($site_ids = array(), $cat_ids = array(), $insert_form = false)
	{
		if (! $insert_form)
		{
			$site_ids = array($this->diafan->cid);
			$cat_ids = array($this->diafan->cat);
		}
		//кеширование
		$cache_meta = array(
			"name" => "show_form",
			"lang_id" => _LANG,
			"cat_ids" => $cat_ids,
			"site_ids" => $site_ids,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
		);

		if ($this->diafan->configmodules('only_user', 'ads', $site_ids[0]) && ! $this->diafan->_user->id)
		{
			return false;
		}

		if (! $result_content = $this->diafan->_cache->get($cache_meta, "ads"))
		{
			if(! $this->validate_attribute_site_cat('ads', $site_ids, $cat_ids))
			{
				return false;
			}
			$result_content["cat_ids"] = array();
			if(count($cat_ids) == 1)
			{
				$result_content["cat_ids"][] = array("id" => $cat_ids[0]);
			}
			else
			{
				if(! empty($cat_ids))
				{
					$result = DB::query("SELECT id, [name], site_id, parent_id FROM {ads_category} WHERE id IN (%s) ORDER BY sort ASC", implode(',', $cat_ids));
				}
				else
				{
					$result = DB::query("SELECT c.id, c.[name], c.site_id, c.parent_id FROM {ads_category} AS c"
					. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='ads'" : "")
					. " WHERE c.[act]='1' AND c.trash='0' AND c.site_id IN (%s)"
					. " AND (c.access='0'"
					. ($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
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
				$result_content["site_ids"][] = array("path" => $this->diafan->_route->link($site_ids[0]));
			}

			$result_content["rows"] = array();
			$result = DB::query("SELECT p.id, p.type, p.[name], GROUP_CONCAT(c.cat_id SEPARATOR ',') as cat_ids, p.required, p.[text], p.config FROM {ads_param} as p "
					." INNER JOIN {ads_param_category_rel} AS c ON p.id=c.element_id AND "
					.($cat_ids ? "(c.cat_id IN (".implode(',', $cat_ids).") OR c.cat_id=0)" : "c.cat_id=0")
					." WHERE p.trash='0' GROUP BY p.id ORDER BY p.sort ASC");
	
			while ($row = DB::fetch_array($result))
			{
				if ($row["type"] == 'select' || $row["type"] == 'multiple')
				{
					$result_select = DB::query(
						"SELECT [name], id FROM {ads_param_select}"
						." WHERE param_id=%d ORDER BY sort ASC", $row["id"]);
					while ($row_select = DB::fetch_array($result_select))
					{
						$row["select_array"][] = $row_select;
					}
					if(empty($row["select_array"]))
						continue;
				}
				if($row["type"] == 'attachments')
				{
					$config = unserialize($row["config"]);
					$row["max_count_attachments"] = ! empty($config["max_count_attachments"]) ? $config["max_count_attachments"] : 0;
					$row["attachments_access_admin"] = ! empty($config["attachments_access_admin"]) ? $config["attachments_access_admin"] : 0;
					$row["attachment_extensions"] = ! empty($config["attachment_extensions"]) ? $config["attachment_extensions"] : '';
					$row["use_animation"] = ! empty($config["use_animation"]) ? true : false;
				}
				$result_content["rows"][] = $row;
			}
		}

		$result_content['error_site_id'] = $this->get_error("ads", 'site_id');
		$result_content['error_cat_id'] = $this->get_error("ads", 'cat_id');
		$result_content['error_name'] = $this->get_error("ads", 'name');
		$result_content['error_anons'] = $this->get_error("ads", 'anons');
		$result_content['error_text'] = $this->get_error("ads", 'text');
		//$result_content['error_date_finish'] = $this->get_error("ads", 'date_finish');

		$result_content["captcha"] = '';
		if ($this->diafan->configmodules('captcha', "ads", $site_ids[0]))
		{
			$result_content["captcha"] = $this->diafan->_captcha->get("ads", $this->get_error("ads", "captcha"));
		}

		foreach ($result_content["rows"] as $row)
		{
			$result_content['error_p'.$row["id"]] = $this->get_error("ads", 'p'.$row["id"]);
		}

		$result_content["error"]  = $this->get_error("ads");

		if($this->diafan->module == 'ads' && in_array($this->diafan->cid, $site_ids))
		{
			$result_content["site_id"] = $this->diafan->cid;
		}
		else
		{
			$result_content["site_id"] = $result_content["site_ids"][0]["id"];
		}

		if($this->diafan->module == 'ads' && in_array($this->diafan->cat, $cat_ids))
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

		return $result_content;
	}

	/**
	 * Формирует дерево категорий для поиска или формы
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
	 * Форматирует данные об объявлении для списка объявлений
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
			if ( ! $this->diafan->configmodules("cat", "ads", $row["site_id"]))
			{
				$row["cat_id"] = 0;
			}
			if ($row["timeedit"] < $this->result["timeedit"])
			{
				$this->result["timeedit"] = $row["timeedit"];
			}
			unset($row["timeedit"]);

			$row["link"] = $this->diafan->_route->link($row["site_id"], "ads", $row["cat_id"], $row["id"]);

			if ($this->diafan->configmodules("images", "ads", $row["site_id"]))
			{
				if (is_array($images_config) && $images_config["count"] > 0)
				{
					$row["img"]  = $this->diafan->_images->get(
						$images_config["variation"], $row["id"], 'ads',
						$row["site_id"], $row["name"], 0, false,
						$images_config["count"], $row["link"]
					);
				}
				elseif($this->diafan->configmodules("list_img", "ads", $row["site_id"]))
				{
					$row["img"]  = $this->diafan->_images->get(
						'medium', $row["id"], 'ads', $row["site_id"], $row["name"], 0, false,
						$this->diafan->configmodules("list_img", "ads", $row["site_id"]) == 1 ? 1 : 0,
						$row["link"]
					);
				}
			}

			$row["param"] = $this->get_param($row["id"], $row["site_id"], $function);
			$row["date"] = $this->format_date($row['created'], "ads", $row["site_id"]);
			unset($row["created"]);

			$rows[] = $row;
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
		"SELECT c.id, c.[name], c.[anons], c.site_id FROM {ads_category} AS c"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='ads'" : "")
		." WHERE c.[act]='1' AND c.parent_id=%d AND c.trash='0' AND c.site_id=%d"
		." AND (c.access='0'"
		.($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY c.id ORDER BY c.sort ASC, c.id ASC", $parent_id, $this->diafan->cid
		);

		while ($child = DB::fetch_array($result_children))
		{
			$child["link"] = $this->diafan->_route->link($child["site_id"], 'ads', $child["id"]);
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
					$cat_ids = $this->diafan->get_children($child["id"], "ads_category");
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
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.site_id, e.created FROM {ads} AS e"
		. " INNER JOIN {ads_category_rel} AS r ON e.id=r.element_id"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='ads'" : "")
		. " WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		. " AND (e.access='0'"
		. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
		. ")"
		. " GROUP BY e.id ORDER BY e.prior DESC, e.created DESC",
		implode(',', $cat_ids), $time, $time,
		0, $this->diafan->configmodules("count_child_list")
		);
		return $result;
	}

	/**
	 * Получает дополнительные характеристики объявлений
	 * 
	 * @param integer $id номер объявления
	 * @param integer $site_id номер страницы, к которой прикреплено объявление
	 * @param string $function функция, для которой выбираются параметры
	 * @return array
	 */
	private function get_param($id, $site_id, $function = "id")
	{
		global $param_select, $param_select_page;
		$values = array();
		$rvalues = array();
		$result_el = DB::query("SELECT e.value".$this->diafan->language_base_site." as rvalue, e.[value], e.param_id, e.id FROM {ads_param_element} as e"
		. " LEFT JOIN {ads_param_select} as s ON e.param_id=s.param_id AND e.param_id=s.id"
		. " WHERE e.element_id=%d GROUP BY e.id ORDER BY s.sort ASC", $id);
		while ($row_el = DB::fetch_array($result_el))
		{
			$values[$row_el["param_id"]][] = $row_el;
		}
		$result = DB::query("SELECT p.id, p.[name], p.type, p.page, p.[measure_unit], p.config FROM {ads_param} as p "
		. ($this->diafan->configmodules("cat", "ads", $site_id) ? " INNER JOIN {ads_category_rel} as c ON c.element_id=" . $id : "")
		. " INNER JOIN {ads_param_category_rel} as cp ON cp.element_id=p.id "
		. ($this->diafan->configmodules("cat", "ads", $site_id) ?
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
							$param_select[$row["id"]][$value] = DB::query_result("SELECT [name] FROM {ads_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $values[$row["id"]][0]["rvalue"], $row["id"]);
						}
						if ($row["page"])
						{
							if (empty($param_select_page[$row["id"]][$value]))
							{
								$param_select_page[$row["id"]][$value] = $this->diafan->_route->link($site_id, "ads", 0, 0, $value);
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
										DB::query_result("SELECT [name] FROM {ads_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $val["rvalue"], $row["id"]);
							}
							if ($row["page"])
							{
								if ($this->diafan->module == 'ads' && $this->diafan->param == $val["rvalue"])
								{
									$link = '';
								}
								else
								{
									if (empty($param_select_page[$row["id"]][$val["rvalue"]]))
									{
										$param_select_page[$row["id"]][$val["rvalue"]] = $this->diafan->_route->link($site_id, "ads", 0, 0, $val["rvalue"]);
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
								DB::query_result("SELECT [name] FROM {ads_param_select} WHERE value=%d AND param_id=%d LIMIT 1", $value, $row["id"]);
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
					$value = $this->diafan->_images->get('large', $id, "ads", 0, '', $row["id"]);
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

					$value = $this->diafan->_attachments->get($id, "ads", 0, $row["id"]);
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
	 * @param array $row данные об объявлении
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
	 * Получает дополнительные характеристики объявлений для формы добавления
	 *
	 * @param integer $site_id страница сайта
	 * @param integer $cat_id категория
	 * @param boolean $use_cat категории используются
	 * @return array
	 */
	public function get_param_form($site_id, $cat_id, $use_cat)
	{
		$cache_meta = array(
			"name" => "ads_param",
			"lang_id" => _LANG,
			"cat_id" => $cat_id,
			"site_id" => $site_id
		);
		if (! $rows_param = $this->diafan->_cache->get($cache_meta, 'ads'))
		{
			if(! $use_cat)
			{
				$where = ' AND r.cat_id = 0';
			}
			elseif($cat_id)
			{
				$where = " AND (r.cat_id=%d OR r.cat_id=0)";
			}
			else
			{
				$where = " INNER JOIN {ads_category} AS c ON c.site_id=%d AND (c.id=r.cat_id OR r.cat_id=0)";
			}
			$rows_param = array();
			$result = DB::query(
					"SELECT p.id, p.[name], p.type, p.required, p.[text], p.config,"
					." GROUP_CONCAT(r.cat_id SEPARATOR ',') AS cats FROM {ads_param} AS p"
					." INNER JOIN {ads_param_category_rel} AS r ON r.element_id=p.id"
					.$where
					." WHERE p.trash='0' GROUP BY p.id ORDER BY p.sort ASC", ($cat_id ? $cat_id : $site_id));
	
			while ($row = DB::fetch_array($result))
			{
				$row["cats"] = array_unique(explode(',', $row["cats"]));
				if ($row["type"] == 'select' || $row["type"] == 'multiple' || $row["type"] == 'checkbox')
				{
					$result_select = DB::query("SELECT [name], id, value FROM {ads_param_select} WHERE param_id=%d"
					                           ." ORDER BY sort ASC", $row["id"]);
					while ($row_select = DB::fetch_array($result_select))
					{
						$row["select_array"][] = $row_select;
						$row["select_values"][$row["type"] == 'checkbox' ? $row_select["value"] : $row_select["id"]] = $row_select["name"];
					}
				}
				if($row["type"] == 'attachments')
				{
					$config = unserialize($row["config"]);
					$row["max_count_attachments"] = ! empty($config["max_count_attachments"]) ? $config["max_count_attachments"] : 0;
					$row["attachments_access_admin"] = ! empty($config["attachments_access_admin"]) ? $config["attachments_access_admin"] : 0;
					$row["attachment_extensions"] = ! empty($config["attachment_extensions"]) ? $config["attachment_extensions"] : '';
					$row["use_animation"] = ! empty($config["use_animation"]) ? true : false;
				}
				$rows_param[] = $row;
			}
			//сохранение кеша
			$this->diafan->_cache->save($rows_param, $cache_meta, 'ads');
		}
		return $rows_param;
	}

	/**
	 * Формирует SQL-запрос при поиске по объявлениям
	 *
	 * @return void
	 */
	private function get_where(&$where, &$where_param, &$values, &$getnav)
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
				$children = $this->diafan->get_children($this->diafan->cat, "ads_category");
				$children[] = $this->diafan->cat;
				$where_param .= " INNER JOIN {ads_category_rel} AS c ON s.id=c.element_id AND c.cat_id IN (".implode(',', $children).")";
			}
		}

		if (!empty($_GET["n"]) && $this->diafan->configmodules("search_name"))
		{
			$where .= " AND s.name"._LANG." LIKE '%%%h%%'";
			$_GET["n"] = trim($this->diafan->get_param($_GET, "n", '', 1));
			$values[] = $_GET["n"];
			$getnav .= '&n='.$_GET["n"];
		}
	
		if (!empty($_GET["d"]) && $this->diafan->configmodules("search_text"))
		{
			$where .= " AND s.text"._LANG." LIKE '%%%h%%'";
			$_GET["d"] = trim($this->diafan->get_param($_GET, "d", '', 1));
			$values[] = $_GET["d"];
			$getnav .= '&d='.$_GET["d"];
		}
		$result = DB::query("SELECT DISTINCT(p.id), p.type, p.required FROM {ads_param} as p "
				." INNER JOIN {ads_param_category_rel} AS c ON p.id=c.element_id "
				.($this->diafan->configmodules("cat") ? " AND (c.cat_id=%d OR c.cat_id=0)" : "")
				." WHERE p.search='1' AND p.trash='0' ORDER BY p.sort ASC", $this->diafan->cat);
		while ($row = DB::fetch_array($result))
		{
			if (($row["type"] == 'text' || $row["type"] == 'textarea' || $row["type"] == 'editor') && !empty($_GET["p".$row["id"]]))
			{
				$val = trim($this->diafan->get_param($_GET, "p".$row["id"], '', 1));
				$where_param .= "
							INNER JOIN {ads_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
					." AND pe".$row["id"].".trash='0' AND pe".$row["id"].".value"._LANG." LIKE '%%%h%%'";
				$values_param[] = $row["id"];
				$values_param[] = $val;
				$getnav .= '&p'.$row["id"].'='.$val;
			}
			elseif ($row["type"] == 'date' && (!empty($_GET["p".$row["id"]."_1"]) || !empty($_GET["p".$row["id"]."_2"])))
			{
				$where_param .= "
							INNER JOIN {ads_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
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
				$where_param .= "
							INNER JOIN {ads_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
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
				$where_param .= "
							INNER JOIN {ads_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
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
				$where_param .= "
							INNER JOIN {ads_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
					." AND pe".$row["id"].".trash='0' AND pe".$row["id"].".value".$this->diafan->language_base_site."='1'";
				$values_param[] = $row["id"];
				$getnav .= '&p'.$row["id"].'=1';
			}
			elseif (($row["type"] == 'select' || $row["type"] == 'multiple') && !empty($_GET["p".$row["id"]]))
			{
				if (!is_array($_GET["p".$row["id"]]))
				{
					$val = (int) $this->diafan->get_param($_GET, "p".$row["id"], '', 2);
					if ((!empty($_GET["pr1"]) || !empty($_GET["pr2"])) && $row["required"])
					{
						$where .= " AND prp.param_id=".$row["id"]." AND prp.param_value".$this->diafan->language_base_site."='".$val."'";
					}
					else
					{
						$where_param .= "
						INNER JOIN {ads_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
						." AND pe".$row["id"].".trash='0' AND pe".$row["id"].".value".$this->diafan->language_base_site."='%d'";
						$values_param[] = $row["id"];
						$values_param[] = $val;
					}
					$getnav .= '&p'.$row["id"].'='.$val;
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
					if (!empty($vals))
					{
						$where_param .= " INNER JOIN {ads_param_element} AS pe".$row["id"]." ON pe".$row["id"].".element_id=s.id AND pe".$row["id"].".param_id='%d'"
						." AND pe".$row["id"].".trash='0' AND pe".$row["id"].".value".$this->diafan->language_base_site." IN (".implode(", ", $vals).")";
						$values_param[] = $row["id"];
					}
				}
			}
		}

		$values = array_merge($values_param, $values);
	}

	/**
	 * Генерирует ссылки на форму редактирования
	 *
	 * @param array $row данные о товаре
	 * @return void
	 */
	private function useradmin(&$row)
	{
		if ( ! empty($row["name"]))
		{
			$row["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'ads', _LANG);
		}
		if ( ! empty($row["text"]))
		{
			$row["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $row["id"], 'ads', _LANG);
		}
		if ( ! empty($row["anons"]))
		{
			$row["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'ads', _LANG);
		}
		if ( ! empty($row["param"]))
		{
			foreach ($row["param"] as $k => $param)
			{
				$row["param"][$k]["name"] = $this->diafan->_useradmin->get($param["name"], 'name', $param["id"], 'ads_param');
				if ( ! empty($param["value_id"]))
				{
					$lang = in_array($param["type"], array('text', 'textarea', 'editor')) ? _LANG : '';
					$row["param"][$k]["value"] = $this->diafan->_useradmin->get($param["value"], 'value', $param["value_id"], 'ads_param_element', $lang, $param["type"]);
				}
			}
		}
	}
}