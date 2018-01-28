<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * News_model
 *
 * Модель модуля "Новости"
 */
class News_model extends Model
{
	/**
	 * Генерирует данные для списка всех новостей без деления на категории
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
			"time" => $time,
			"year" => $this->diafan->year,
			"month" => $this->diafan->month,
			"day" => $this->diafan->day,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
		);

		//кеширование
		if (!$this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
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
								$this->diafan->_('Новости за %s', false), $this->format_date(mktime(0, 0, 0, $this->diafan->month, $this->diafan->day, $this->diafan->year))
						);
					}
					else
					{
						$this->result["titlemodule"] =
								sprintf(
								$this->diafan->_('Новости за %s %s года', false), $month_arr[$this->diafan->month], $this->diafan->year
						);
					}
				}
				else
				{
					$this->result["titlemodule"] =
							sprintf(
							$this->diafan->_('Новости за %s год', false), $this->diafan->year
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
			$this->result["path"] = $this->get_path('news');

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

				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'news');
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
			"SELECT COUNT(DISTINCT e.id) FROM {news} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
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
		$result =  DB::query_range(
			"SELECT e.id, e.created, e.[name], e.[anons], e.timeedit, e.cat_id, e.site_id FROM {news} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
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
			"SELECT COUNT(DISTINCT e.id) FROM {news} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
			." WHERE e.[act]='1' AND e.trash='0'"
			." AND e.site_id=%d AND e.created>=%d AND e.created<%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")",
			$this->diafan->cid, $date_start, $date_finish, $time, $time
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
		$result =  DB::query_range(
			"SELECT e.id, e.created, e.[name], e.[anons], e.timeedit, e.cat_id, e.site_id FROM {news} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
			." WHERE e.[act]='1'"
			." AND e.trash='0' AND e.site_id=%d AND e.created>=%d AND e.created<%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")"
			." GROUP BY e.id ORDER BY e.prior DESC, e.created DESC, e.id DESC",
			$this->diafan->cid, $date_start, $date_finish, $time, $time,
			$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);
		return $result;
	}

	/**
	 * Генерирует данные для первой страницы новостей
	 *
	 * @return array
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
			"page" => $this->diafan->page > 1 ? $this->diafan->page : 1,
			"time" => $time,
			"site_id" => $this->diafan->cid,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
		);
		if (!$this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$this->result = array();
			if(! $this->diafan->page)
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
						$cat_ids = $this->diafan->get_children($row["id"], "news_category");
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
	
					$cat["link_all"] = $this->diafan->_route->link($row["site_id"], 'news', $row["id"]);
	
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
			}

			////navigation///
			$this->diafan->_paginator->page = $this->diafan->page;
			$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
			$this->diafan->_paginator->nen = $this->first_page_list_elements_query_count($time);
			$this->result["paginator"] = $this->diafan->_paginator->get();
			////navigation///

			$result = $this->first_page_list_elements_query($time);

			$this->result["rows"] = $this->get_elements($result);

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}
		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);

		if (!empty($this->result["categories"]))
		{
			foreach ($this->result["categories"] as $cat => $rows)
			{
				if (!$rows)
					continue;

				$this->result["categories"][$cat]["name"] = $this->diafan->_useradmin->get($rows["name"], 'name', $rows["id"], 'news_category', _LANG);

				$this->result["categories"][$cat]["anons"] = $this->diafan->_useradmin->get($rows["anons"], 'anons', $rows["id"], 'news_category', _LANG);
				$this->result["categories"][$cat]["rating"] = $this->diafan->_rating->get($rows["id"], '', 0, true);
				foreach ($rows["children"] as $k => $row)
				{
					$this->result["categories"][$cat]["children"][$k]["name"] =
							$this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'news_category', _LANG);

					$this->result["categories"][$cat]["children"][$k]["anons"] =
							$this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'news_category', _LANG);
				}

				foreach ($rows["rows"] as $k => $row)
				{
					$this->result["categories"][$cat]["rows"][$k]["tags"] = $this->diafan->_tags->get($row["id"]);

					$this->result["categories"][$cat]["rows"][$k]["rating"] = $this->diafan->_rating->get($row["id"]);

					$this->result["categories"][$cat]["rows"][$k]["name"] =
							$this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'news', _LANG);

					$this->result["categories"][$cat]["rows"][$k]["anons"] =
							$this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'news', _LANG);

					$this->result["categories"][$cat]["rows"][$k]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'news');
				}
			}
		}
		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);

				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'news');
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
		"SELECT c.id, c.[name], c.[anons], c.timeedit, c.site_id FROM {news_category} AS c"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='news'" : "")
		." WHERE c.[act]='1' AND c.parent_id=0 AND c.trash='0' AND c.site_id=%d"
		." AND (c.access='0'"
		.($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY c.id ORDER by c.sort ASC, c.id ASC",
		$this->diafan->cid
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
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.site_id, e.created FROM {news} AS e"
		." INNER JOIN {news_category_rel} AS r ON e.id=r.element_id"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
		." WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0' AND e.created<'%d'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY e.id ORDER BY e.prior DESC, e.created DESC, e.id DESC",
		implode(',', $cat_ids), $time, $time, $time, 0, $this->diafan->configmodules("count_list")
		);
		return $result;
	}

	/**
	 * Получает из базы данных элементы для первой страницы модуля, если категории не используются
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return integer
	 */
	private function first_page_list_elements_query_count($time)
	{
		$count = DB::query_result(
		"SELECT COUNT(DISTINCT e.id) FROM {news} AS e"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
		." WHERE e.[act]='1' AND e.trash='0'"
		." AND e.cat_id=0"
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
	 * Получает из базы данных элементы для первой страницы модуля, если категории не используются
	 * 
	 * @param integer $time текущее время, округленное до минут, в формате UNIX
	 * @return integer
	 */
	private function first_page_list_elements_query($time)
	{
		$result = DB::query_range(
		"SELECT e.id, e.created, e.[name], e.[anons], e.timeedit, e.cat_id, e.site_id FROM {news} AS e"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
		." WHERE e.[act]='1' AND e.trash='0'"
		." AND e.cat_id=0"
		." AND e.site_id=%d AND e.created<%d"
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
	 * Генерирует данные для списка новостей в категории
	 *
	 * @return array
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
			"time" => $time,
			"site_id" => $this->diafan->cid,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
		);

		if (!$this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$result = $this->list_category_query();
			if (! $row = DB::fetch_array($result))
			{
				include_once ABSOLUTE_PATH.'includes/404.php';
			}
			if (empty($row) || (!empty($row['access']) && !$this->access(0, $row['id'])))
			{
				include_once(ABSOLUTE_PATH.'includes/403.php');
			}

			$this->result = $row;

			$this->result["level"] = count($this->diafan->get_parents($this->diafan->cat, 'news_category'));
			$this->result["path"] = $this->get_path('news');

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
				$cat_ids = $this->diafan->get_children($this->diafan->cat, "news_category");
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
		$this->result["text"] = $this->diafan->_useradmin->get($this->result["text"], 'text', $this->diafan->cat, 'news_category', _LANG);

		$this->result["comments"] = $this->diafan->_comments->get(0, '', 0, true);
		$this->result["rating"] = $this->diafan->_rating->get(0, '', 0, true);

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);

				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'news');
			}
			if (!empty($this->result["previous"]["text"]))
			{
				$this->result["previous"]["text"] =
						$this->diafan->_useradmin->get($this->result["previous"]["text"], 'name', $this->result["previous"]["id"], 'news_category', _LANG);
			}
			if (!empty($this->result["next"]["text"]))
			{
				$this->result["next"]["text"] =
						$this->diafan->_useradmin->get($this->result["next"]["text"], 'name', $this->result["next"]["id"], 'news_category', _LANG);
			}
			foreach ($this->result["children"] as $id => $row)
			{
				$this->result["children"][$id]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'news_category', _LANG);
				$this->result["children"][$id]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'news_category', _LANG);
			}
			foreach ($this->result["path"] as $k => $path)
			{
				if ($k == 0)
					continue;
				$this->result["path"][$k]["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $path["id"], 'news_category', _LANG);
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
		$result = DB::query(
		"SELECT id, [name], [text], timeedit, [descr], [keywords], sort, parent_id, [title_meta], access, theme, view FROM {news_category}"
		." WHERE [act]='1' and id=%d AND trash='0' AND site_id=%d"
		." ORDER BY sort ASC, id ASC",
		$this->diafan->cat, $this->diafan->cid
		);
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
		"SELECT COUNT(DISTINCT e.id) FROM {news} AS e"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
		." INNER JOIN {news_category_rel} AS r ON e.id=r.element_id"
		." AND e.id=r.element_id AND r.cat_id IN (%s)"
		." WHERE e.[act]='1' AND e.trash='0' AND e.created<%d"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")",
		implode(',', $cat_ids), $time, $time, $time
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
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.site_id, e.created FROM {news} AS e"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
		." INNER JOIN {news_category_rel} AS r ON e.id=r.element_id AND r.cat_id IN (%s)"
		." WHERE e.[act]='1' AND e.trash='0' AND e.created<%d"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY e.id ORDER BY e.prior DESC, e.created DESC, e.id DESC",
		implode(',', $cat_ids), $time, $time, $time,
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
		"SELECT c.[name], c.id FROM {news_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='news'" : "")
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
			$this->result["previous"]["link"] = $this->diafan->_route->link($this->diafan->cid, "news", $previous["id"]);
		}
		$next = DB::fetch_array(DB::query(
		"SELECT c.[name], c.id FROM {news_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='news'" : "")
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
			$this->result["next"]["link"] = $this->diafan->_route->link($this->diafan->cid, "news", $next["id"]);
		}
	}

	/**
	 * Генерирует данные для страницы новости
	 *
	 * @return array|boolean false
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
			"time"    => $time
		);
		if (! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$row = $this->id_query($time);
			if (empty($row))
			{
				include ABSOLUTE_PATH.'includes/404.php';
			}

			if (! $this->diafan->rewrite_module && ($this->diafan->configmodules("cat") && $this->diafan->cat != $row["cat_id"]
			  || ! $this->diafan->configmodules("cat") && $this->diafan->cat))
			{
				include ABSOLUTE_PATH.'includes/404.php';
			}
			if (!empty($row['access']) && !$this->access($row['id']))
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

			if ($this->result["cat_id"])
			{
				$this->result["allnews"]["link"] = $this->diafan->_route->link($row["site_id"], "news", $row["cat_id"]);
			}
			else
			{
				$this->result["allnews"]["link"] = $this->diafan->_route->link($row["site_id"]);
			}
			$this->id_previous_next($row["created"], $time);

			$this->result["date"] = $this->format_date($row['created']);

			$this->meta($row);
			$this->theme_view_element($row);

			$this->result["path"] = $this->get_path('news');

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}
		$this->diafan->cat = $this->result["cat_id"];
		$this->result["text"]  = $this->diafan->_useradmin->get($this->result["text"], 'text', $this->diafan->show, 'news', _LANG);
		$this->result["anons"] = $this->diafan->_useradmin->get($this->result["anons"], 'anons', $this->diafan->show, 'news', _LANG);
		$month = date('n', $this->result["created"]);
		$month_array = array("1"=>"Январь","2"=>"Февраль","3"=>"Март","4"=>"Апрель","5"=>"Май", "6"=>"Июнь", "7"=>"Июль","8"=>"Август","9"=>"Сентябрь","10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
		$this->result["date"] = date('j', $this->result["created"]).' '.$month_array[$month].' '.date('Y', $this->result["created"]);
		# $this->result["date"] = $this->diafan->_useradmin->get($this->result["date"], 'created', $this->diafan->show, 'news');

		if (!empty($this->result["previous"]["text"]))
		{
			$this->result["previous"]["text"] =
					$this->diafan->_useradmin->get($this->result["previous"]["text"], 'name', $this->result["previous"]["id"], 'news', _LANG);
		}
		if (!empty($this->result["next"]["text"]))
		{
			$this->result["next"]["text"] =
					$this->diafan->_useradmin->get($this->result["next"]["text"], 'name', $this->result["next"]["id"], 'news', _LANG);
		}
		foreach ($this->result["path"] as $k => $path)
		{
			if ($k == 0)
				continue;
			$this->result["path"][$k]["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $path["id"], 'news_category', _LANG);
		}

		$this->counter_view();

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
		$row = DB::fetch_array(DB::query(
		"SELECT id, [name], [anons], [text], timeedit, created, cat_id, [keywords], [descr], site_id, [title_meta], access, theme, view FROM {news}"
		." WHERE [act]='1' AND id=%d AND trash='0' AND site_id=%d AND created<%d"
		." AND date_start<=%d AND (date_finish=0 OR date_finish>=%d) LIMIT 1",
		$this->diafan->show, $this->diafan->cid, $time, $time, $time
		));
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
				"SELECT e.[name], e.id, e.cat_id FROM {news} AS e"
				.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
				." WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
				.($this->diafan->configmodules("cat") ? " AND e.cat_id='" . $this->diafan->cat . "'" : '')
				." AND (e.created<%d OR e.created=%d AND e.id<%d)"
				." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
				." AND (e.access='0'"
				.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				.")"
				." ORDER BY e.prior DESC, e.created DESC, e.id DESC LIMIT 1",
				$this->diafan->cid, $created, $created, $this->diafan->show, $time, $time
			));
		if ($previous)
		{
			$this->result["previous"]["text"] = $previous["name"];
			if (!$this->diafan->configmodules("cat"))
			{
				$previous["cat_id"] = 0;
			}
			$this->result["previous"]["id"] = $previous["id"];
			$this->result["previous"]["link"] = $this->diafan->_route->link($this->diafan->cid, "news", $previous["cat_id"], $previous["id"]);
		}
		$next = DB::fetch_array(DB::query(
				"SELECT e.[name], e.id, e.cat_id FROM {news} AS e"
				.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
				." WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
				.($this->diafan->configmodules("cat") ? " AND e.cat_id='" . $this->diafan->cat . "'" : '')
				." AND e.created<%d AND (e.created>%d OR e.created=%d AND e.id>%d)"
				." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
				." AND (e.access='0'"
				.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				.")"
				." ORDER BY e.prior ASC, e.created ASC, e.id ASC LIMIT 1",
				$this->diafan->cid, $time, $created, $created, $this->diafan->show, $time, $time
			));
		if ($next)
		{
			$this->result["next"]["text"] = $next["name"];
			if (! $this->diafan->configmodules("cat"))
			{
				$next["cat_id"] = 0;
			}
			$this->result["next"]["id"] = $next["id"];
			$this->result["next"]["link"] = $this->diafan->_route->link($this->diafan->cid, "news", $next["cat_id"], $next["id"]);
		}
	}

	/**
	 * Генерирует данные для шаблонной функции: блок новостей
	 *
	 * @param integer $count количество новостей
	 * @param array $cat_ids категории
	 * @param array $site_ids страницы сайта
	 * @param integer $images количество изображений
	 * @param string $images_variation размер изображений
	 * @return array
	 */
	public function show_block($count, $cat_ids, $site_ids, $images, $images_variation)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
			"name" => "block",
			"cat_ids" => $cat_ids,
			"site_ids" => $site_ids,
			"count" => $count,
			"lang_id" => _LANG,
			"time" => $time,
			"images"   => $images,
			"images_variation" => $images_variation,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
		);

		if (!$this->result = $this->diafan->_cache->get($cache_meta, "news"))
		{
			if(! $this->validate_attribute_site_cat('news', $site_ids, $cat_ids))
			{
				return false;
			}
			$this->result["rows"] = array();

			$result = DB::query_range(
					"SELECT e.id, e.[name],e.[anons], e.cat_id, e.timeedit, e.site_id, e.created FROM {news} AS e"
					.($cat_ids
					  ? " INNER JOIN {news_category_rel} as r ON r.element_id=e.id"
					    ." AND r.cat_id IN (" . implode(',', $cat_ids) . ")"
					  : ''
					 )
					.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
					." WHERE e.[act]='1' AND e.trash='0' AND e.created<%d"
					." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
					.($site_ids ? " AND e.site_id IN (".implode(",", $site_ids).")" : '')
					." AND (e.access='0'"
					.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
					.")"
					." GROUP BY e.id ORDER BY e.prior DESC, e.created DESC, e.id DESC",
					$time, $time, $time, 0, $count
				);
			$rows = $this->get_elements($result, array("count" => $images, "variation" => $images_variation));
			$this->result["rows"] = array_merge($this->result["rows"], $rows);

			// если категория только одна, задаем ссылку на нее
			if (!empty($this->result["rows"]) && count($cat_ids) == 1)
			{
				$cat = DB::fetch_array(DB::query("SELECT [name], site_id, id FROM {news_category} WHERE id=%d LIMIT 1", $cat_ids[0]));

				$this->result["name"] = $cat["name"];
				$this->result["link_all"] = $this->diafan->_route->link($cat["site_id"], 'news', $cat["id"]);
				$this->result["category"] = true;
			}
			// если раздел сайта только один, то задаем ссылку на него
			elseif (!empty($this->result["rows"]) && count($site_ids) == 1)
			{
				$this->result["name"] = DB::query_result("SELECT [name] FROM {site} WHERE id=%d LIMIT 1", $site_ids[0]);
				$this->result["link_all"] = $this->diafan->_route->link($site_ids[0]);
				$this->result["category"] = false;
			}
			$this->diafan->_cache->save($this->result, $cache_meta, "news");
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'news', _LANG);
				
				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'news', _LANG);
			}
		}

		return $this->result;
	}

	/**
	 * Генерирует данные для шаблонной функции: блок связанных новостей
	 * 
	 * @param integer $count количество новостей
	 * @param integer $images количество изображений
	 * @param string $images_variation размер изображений
	 * @return array
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

		if (! $this->result = $this->diafan->_cache->get($cache_meta, "news"))
		{
			$this->result["rows"] = array();

			$result = DB::query_range(
			"SELECT e.id, e.[name], e.[anons], e.cat_id, e.created, e.timeedit, e.site_id FROM {news} AS e"
			. " INNER JOIN {news_rel} AS r ON e.id=r.rel_element_id AND r.element_id=%d"
			.($this->diafan->configmodules("rel_two_sided") ? " OR e.id=r.element_id AND r.rel_element_id=".$this->diafan->show : '')
			. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
			. " WHERE e.[act]='1' AND e.trash='0' AND e.created<%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			. " AND (e.access='0'"
			. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
			. ")"
			. " GROUP BY e.id"
			. ' ORDER BY e.created DESC',
			$this->diafan->show, $time, $time, $time, 0, $count
			);
			$this->result["rows"] = $this->get_elements($result, array("count" => $images, "variation" => $images_variation));
			$this->diafan->_cache->save($this->result, $cache_meta, "news");
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'news', _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'news');
			}
		}
		return $this->result;
	}

	/**
	 * Генерирует данные для шаблонной функции: календарь архива новостей
	 *
	 * @param string $detail детализация: год, месяц, день
	 * @param integer $site_id страница сайта
	 * @param integer $cat_id категория новостей
	 * @param string $template шаблон
	 * @param integer $month_current выбранный месяц
	 * @param integer $year_current выбранный год
	 * @return array
	 */
	public function show_calendar($detail, $site_id, $cat_id, $template = '', $month_current = 0, $year_current = 0)
	{
		$day_current = 0;
		if (! $year_current && ! $month_current && $this->diafan->module == "news" && $site_id == $this->diafan->cid && $cat_id == $this->diafan->cat)
		{
			$year_current = $this->diafan->year;
			$month_current = $this->diafan->month;
			$day_current = $this->diafan->day;
		}
		if (! $year_current && $detail == 'day')
		{
			$year_current = date("Y");
		}
		if (! $month_current && $detail == 'day')
		{
			$month_current = date("m");
		}

		$day_current = 0;
		if (! $year_current && ! $month_current && $this->diafan->module == "news" && $site_id == $this->diafan->cid)
		{
			$year_current = $this->diafan->year;
			$month_current = $this->diafan->month;
			$day_current = $this->diafan->day;
		}
		if (! $year_current && $detail == 'day')
		{
			$year_current = date("Y");
		}
		if (! $month_current && $detail == 'day')
		{
			$month_current = date("m");
		}

		//кеширование
		$cache_meta = array(
			"name" => "calendar",
			"detail" => $detail,
			"perior" => $detail == 'day' ? $year_current."_".$month_current : 0,
			"lang_id" => _LANG,
			"site_id" => $site_id,
			"cat_id" => $cat_id,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
		);
		if (! $result = $this->diafan->_cache->get($cache_meta, "news"))
		{
			$cat_ids = array($cat_id);
			$site_ids = array($site_id);
			if(! $this->validate_attribute_site_cat('news', $site_ids, $cat_ids))
			{
				return false;
			}
			$site_id = $site_ids[0];

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

			if($detail == 'day')
			{
				$month_current = $month_current < 10 ? '0'.intval($month_current) : $month_current;

				$week = array();
				$news_list = array();

				$day_count = date("t", mktime(0, 0, 0, $month_current, 1, $year_current));

				$time_start = mktime(0, 0, 0,$month_current, 1, $year_current);
				$time_end = mktime(0, 0, 0, $month_current, $day_count, $year_current) + 86400;

				$rows = DB::query(
						"SELECT e.created FROM {news} AS e"
						.($cat_ids ? "INNER JOIN {news_category_rel} as r ON r.element_id=e.id" : "")
						.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
						." WHERE e.[act]='1' AND e.site_id=%d" . ($cat_ids ? " AND r.cat_id IN (".implode(",", $cat_ids).")" : "")
						." AND (e.access='0'"
						.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						.") AND e.created>=%d AND e.created<=%d", $site_id, $time_start, $time_end
					);

				while ($row = DB::fetch_array($rows))
				{
					$day = date("j", $row["created"]);

					if (isset($news_list[$day]))
					{
						$news_list[$day]++;
					}
					else
					{
						$news_list[$day] = 1;
					}

				}

				$day = 1;
				$num = 0;
				for($i = 0; $i < 7; $i++)
				{
					$dayofweek = date('w', mktime(0, 0, 0, $month_current, $day, $year_current));
					$dayofweek = $dayofweek - 1;
					if($dayofweek == -1)
					{
						$dayofweek = 6;
					}
					if($dayofweek == $i)
					{
						$result["week"][$num][$i] = array(
							"day" => $day,
							"link" => $this->diafan->_route->link($site_id, "news") . 'year'.$year_current.'/month'.$month_current .'/day'.$day.'/',
							"count" => array_key_exists($day, $news_list) ? $news_list[$day] : 0
						);
						$day++;
					}
					else
					{
						$week[$num][$i] = "";
					}
				}

				while(true)
				{
					$num++;
					for($i = 0; $i < 7; $i++)
					{
						$result["week"][$num][$i] = array(
							"day" => $day,
							"link" => $this->diafan->_route->link($site_id, "news") . 'year'.$year_current.'/month'.$month_current .'/day'.$day.'/',
							"count" => array_key_exists($day, $news_list) ? $news_list[$day] : 0
						);
						$day++;
						if($day > $day_count)
						{
							break;
						}
					}
					if($day > $day_count)
					{
						break;
					}
				}
				$result['month_name'] = $month_arr[$month_current];
				$result["site_id"] = $site_id;
				$result["cat_id"] = $cat_id;
			}
			else
			{
				$d = DB::query_result(
						"SELECT e.created FROM {news} AS e"
						.($cat_ids ? "INNER JOIN {news_category_rel} as r ON r.element_id=e.id" : "")
						.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
						." WHERE e.[act]='1' AND e.site_id=%d" . ($cat_ids ? " AND r.cat_id IN (".implode(",", $cat_ids).")" : "")
						." AND (e.access='0'"
						.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						.")"
						." ORDER BY e.created ASC LIMIT 1", $site_id
					);
				$nyear = 2008;

				if ($d > 0)
				{
					$nyear = date("Y", $d);
				}

				if (date("Y") - $nyear > 10)
				{
					$nyear = 2008;
				}

				for ($Ye = date("Y"); $Ye >= $nyear; $Ye--)
				{
					$result["rows"][$Ye]["year"]["link"] = $this->diafan->_route->link($site_id, "news") . 'year' . $Ye . '/';
					$result["rows"][$Ye]["year"]["name"] = $Ye;

					if ($detail != "year")
					{
						for ($num = 12; $num > 0; $num--)
						{
							if ($Ye != date("Y") || $num <= date("m"))
							{
								if ($num < 10)
								{
									$num = '0' . $num;
								}

								$val = $month_arr[$num];
								$count_news = DB::query_result(
										"SELECT COUNT(DISTINCT e.id) FROM {news} AS e"
										.($cat_ids ? "INNER JOIN {news_category_rel} as r ON r.element_id=e.id" : "")
										.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
										." WHERE e.[act]='1' AND e.trash='0' AND e.created>%d AND e.created<=%d AND e.site_id=%d"
										." AND (e.access='0'"
										.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
										.")"
										.($cat_ids ? " AND r.cat_id IN (".implode(",", $cat_ids).")" : ""),
										mktime(0, 0, 0, $num, 1, $Ye),
										mktime(0, 0, 0, $num, 31, $Ye),
										$site_id
									);
								$result["rows"][$Ye]["months"][$num] = array(
									"link" => $count_news ? $this->diafan->_route->link($site_id, "news") . 'year' . $Ye . '/month' . $num . '/' : '',
									"name" => $val
								);
							}
						}
					}
				}
			}

			$result["link"] = $this->diafan->_route->link($site_id);

			//сохранение кеша
			$this->diafan->_cache->save($result, $cache_meta, "news");
		}

		$result["template"] = $template;
		$result["day"] = $day_current;
		$result["year"] = $year_current;
		$result["month"] = $month_current;

		if($detail == 'day')
		{
			for($i = 0; $i < count($result['week']); $i++)
			{
				for($j = 0; $j < 7; $j++)
				{
					$result['week'][$i][$j]["today"] = ($result["month"] == date("m") && $result["year"] == date("Y") && ! empty($result['week'][$i][$j]["day"]) && $result['week'][$i][$j]["day"] == date("d") ? true : false);
				}
			}
		}
		return $result;
	}

	/**
	 * Форматирует данные о новостях для списка новостей
	 *
	 * @param resource $result результат выполнения SQL-запроса
	 * @param string $images_config настройки отображения изображений
	 * @return array
	 */
	public function get_elements($result, $images_config = '')
	{
		if (empty($this->result["timeedit"]))
		{
			$this->result["timeedit"] = '';
		}
		$rows = array();
		while ($row = DB::fetch_array($result))
		{
			if (!$this->diafan->configmodules("cat", "news", $row["site_id"]))
			{
				$row["cat_id"] = 0;
			}

			if ($row["timeedit"] < $this->result["timeedit"])
			{
				$this->result["timeedit"] = $row["timeedit"];
			}
			unset($row["timeedit"]);

			$row["link"] = $this->diafan->_route->link($row["site_id"], "news", $row["cat_id"], $row["id"]);
			unset($row["cat_id"]);

			if ($this->diafan->configmodules("images", "news", $row["site_id"]))
			{
				if (is_array($images_config) && $images_config["count"] > 0)
				{
					$row["img"]  = $this->diafan->_images->get(
							$images_config["variation"], $row["id"], 'news',
							$row["site_id"], $row["name"], 0, false,
							$images_config["count"], $row["link"]
						);
				}
				elseif($this->diafan->configmodules("list_img", "news", $row["site_id"]))
				{
					$row["img"]  = $this->diafan->_images->get(
						'medium', $row["id"], 'news', $row["site_id"], $row["name"], 0, false,
					        $this->diafan->configmodules("list_img", "news", $row["site_id"]) == 1 ? 1 : 0,
					        $row["link"]
						);
				}
			}
			# $row["date"] = $this->format_date($row['created'], "news", $row["site_id"]);
			$month = date('n', $row['created']);
			$month_array = array("1"=>"Январь","2"=>"Февраль","3"=>"Март","4"=>"Апрель","5"=>"Май", "6"=>"Июнь", "7"=>"Июль","8"=>"Август","9"=>"Сентябрь","10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
			$row["date"] = date('j', $row['created']).' '.$month_array[$month].' '.date('Y', $row['created']);

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
		"SELECT c.id, c.[name], c.[anons], c.site_id FROM {news_category} AS c"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='news'" : "")
		." WHERE c.[act]='1' AND c.parent_id=%d AND c.trash='0' AND c.site_id=%d"
		." AND (c.access='0'"
		.($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY c.id ORDER BY c.sort ASC, c.id ASC", $parent_id, $this->diafan->cid
		);

		while ($child = DB::fetch_array($result_children))
		{
			$child["link"] = $this->diafan->_route->link($child["site_id"], 'news', $child["id"]);
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
					$cat_ids = $this->diafan->get_children($child["id"], "news_category");
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
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.site_id, e.created FROM {news} AS e"
		." INNER JOIN {news_category_rel} AS r ON e.id=r.element_id"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='news'" : "")
		." WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0' AND e.created<'%d'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY e.id ORDER BY e.prior DESC, e.created DESC, e.id DESC",
		implode(',', $cat_ids), $time, $time, $time, 0, $this->diafan->configmodules("count_child_list")
		);
		return $result;
	}
}