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
 * Faq_model
 *
 * Модель модуля "Вопрос-Ответ"
 */
class Faq_model extends Model
{
	/**
	 * Генерирует данные для списка всех вопросов без деления на категории
	 * 
	 * @return array
	 */
	public function list_()
	{
		if ($this->diafan->cat)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		$cache_meta = array(
				"name"     => "list",
				"lang_id"  => _LANG,
				"page"     => $this->diafan->page > 1 ? $this->diafan->page : 1,
				"site_id"  => $this->diafan->cid,
				"role_id"  => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
				"time"     => $time
			);

		//кеширование
		if (! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$this->result = array();

			////navigation//
			$this->diafan->_paginator->page    = $this->diafan->page;
			$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
			$this->diafan->_paginator->navlink_tpl = $this->diafan->_route->current_link("", array("page" => "%d"));
			$this->diafan->_paginator->nen = $this->list_query_count($time);
			$links = $this->diafan->_paginator->get();
			////navigation///

			$result = $this->list_query($time);

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

				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'faq', _LANG);

				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'faq',  _LANG);

				$this->result["rows"][$i]["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $row["id"], 'faq',  _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'faq');
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
			"SELECT COUNT(DISTINCT e.id) FROM {faq} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
			." WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")", 
			$this->diafan->cid, $time, $time
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
			"SELECT e.id, e.created, e.[name], e.[anons], e.[text], e.timeedit, e.cat_id, e.site_id FROM {faq} AS e"
			.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
			." WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			." AND (e.access='0'"
			.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
			.")"
			." GROUP BY e.id ORDER BY e.created DESC, e.id DESC",
			$this->diafan->cid, $time, $time,
			$this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);
		return $result;
	}

	/**
	 * Генерирует данные для первой страницы модуля "Вопрос-Ответ"
	 * 
	 * @return array
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
				"name"     => "first_page",
				"lang_id"  => _LANG,
				"site_id"  => $this->diafan->cid,
				"role_id"  => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
				"time"     => $time
			);
		if (! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$this->result = array();

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
					$cat_ids = $this->diafan->get_children($row["id"], "faq_category");
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

				$cat["link_all"] = $this->diafan->_route->link($row["site_id"], 'faq', $row["id"]);
				$this->result["categories"][] = $cat;
			}

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}

		if (! empty($this->result["categories"]))
		{
			foreach ($this->result["categories"] as $cat => $rows)
			{
				if (! $rows)
					continue;

				$this->result["categories"][$cat]["name"] = $this->diafan->_useradmin->get($rows["name"], 'name', $rows["id"], 'faq_category', _LANG);

				$this->result["categories"][$cat]["anons"] = $this->diafan->_useradmin->get($rows["anons"], 'anons', $rows["id"], 'faq_category', _LANG);
				$this->result["categories"][$cat]["rating"] = $this->diafan->_rating->get($rows["id"], '', 0, true);

				foreach ($rows["children"] as $k => $row)
				{
					$this->result["categories"][$cat]["children"][$k]["name"] =
						$this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'faq_category', _LANG);

					$this->result["categories"][$cat]["children"][$k]["anons"] =
						$this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'faq_category', _LANG);
				}

				foreach ($rows["rows"] as $k => $row)
				{
					$this->result["categories"][$cat]["rows"][$k]["tags"] = $this->diafan->_tags->get($row["id"]);

					$this->result["categories"][$cat]["rows"][$k]["rating"] = $this->diafan->_rating->get($row["id"]);

					$this->result["categories"][$cat]["rows"][$k]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'faq', _LANG);

					$this->result["categories"][$cat]["rows"][$k]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'faq', _LANG);

					$this->result["categories"][$cat]["rows"][$k]["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $row["id"], 'faq', _LANG);
		
					$this->result["categories"][$cat]["rows"][$k]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'faq');
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
		"SELECT c.id, c.[name], c.[anons], c.timeedit, c.site_id FROM {faq_category} AS c"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='faq'" : "")
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
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.[text], e.site_id, e.created FROM {faq} AS e"
		." INNER JOIN {faq_category_rel} AS r ON e.id=r.element_id"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
		." WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY e.id ORDER BY e.created DESC, e.id DESC",
		implode(',', $cat_ids), $time, $time, 0, $this->diafan->configmodules("count_list")
		);
		return $result;
	}

	/**
	 * Генерирует данные для списка вопросов в категории
	 * 
	 * @return array
	 */
	public function list_category()
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
				"name"     => "list",
				"cat_id"   => $this->diafan->cat,
				"lang_id"  => _LANG,
				"page"     => $this->diafan->page > 1 ? $this->diafan->page : 1,
				"site_id"  => $this->diafan->cid,
				"role_id"  => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
				"time"     => $time
			);
		if (! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
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

			$this->result["level"] = count($this->diafan->get_parents($this->diafan->cat, 'faq_category'));
			$this->result["path"] = $this->get_path('faq');

			$this->result["children"] = $this->get_children_category($row["id"], $time);

			if ($this->diafan->configmodules("children_elements"))
			{
				$cat_ids = $this->diafan->get_children($this->diafan->cat, "shop_category");
				$cat_ids[] = $this->diafan->cat;
			}
			else
			{
				$cat_ids = array($this->diafan->cat);
			}

			////navigation//
			$this->diafan->_paginator->page    = $this->diafan->page;
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
		$this->result["text"] = $this->diafan->_useradmin->get($this->result["text"], 'text', $this->diafan->cat, 'faq_category', _LANG);

		$this->result["comments"] = $this->diafan->_comments->get(0, '', 0, true);
		$this->result["rating"] = $this->diafan->_rating->get(0, '', 0, true);

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->result["rows"][$i]["tags"] = $this->diafan->_tags->get($row["id"]);

				$this->result["rows"][$i]["rating"] = $this->diafan->_rating->get($row["id"]);

				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'faq', _LANG);

				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'faq',  _LANG);

				$this->result["rows"][$i]["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $row["id"], 'faq',  _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'faq');
			}
			if (! empty($this->result["previous"]["text"]))
			{
				$this->result["previous"]["text"] =
					$this->diafan->_useradmin->get($this->result["previous"]["text"], 'name', $this->result["previous"]["id"], 'faq_category', _LANG);
			}
			if (! empty($this->result["next"]["text"]))
			{
				$this->result["next"]["text"] =
					$this->diafan->_useradmin->get($this->result["next"]["text"], 'name', $this->result["next"]["id"], 'faq_category', _LANG);
			}
			foreach ($this->result["children"] as $id => $row)
			{
				$this->result["children"][$id]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'faq_category', _LANG);
				$this->result["children"][$id]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'faq_category', _LANG);
			}
			foreach ($this->result["path"] as $k => $path)
			{
				if ($k == 0)
					continue;
				$this->result["path"][$k]["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $path["id"], 'faq_category', _LANG);
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
		$result = DB::query("SELECT id, [name], [text], timeedit, [descr], [keywords], sort, parent_id, [title_meta], access, theme, view FROM {faq_category}"
		." WHERE [act]='1' and id=%d AND trash='0' AND site_id=%d"
		." ORDER BY sort ASC, id ASC",
		$this->diafan->cat, $this->diafan->cid);
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
		"SELECT COUNT(DISTINCT e.id) FROM {faq} AS e"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
		." INNER JOIN {faq_category_rel} AS r ON e.id=r.element_id"
		." AND e.id=r.element_id AND r.cat_id IN (%s)"
		." WHERE e.[act]='1' AND e.trash='0'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")",
		implode(',', $cat_ids), $time, $time
		);;
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
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.[text], e.site_id, e.created FROM {faq} AS e"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
		." INNER JOIN {faq_category_rel} AS r ON e.id=r.element_id AND r.cat_id IN (%s)"
		." WHERE e.[act]='1' AND e.trash='0'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY e.id ORDER BY e.created DESC, e.id DESC",
		implode(',', $cat_ids), $time, $time,
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
		"SELECT c.[name], c.id FROM {faq_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='faq'" : "")
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
			$this->result["previous"]["link"] = $this->diafan->_route->link($this->diafan->cid, "faq", $previous["id"]);
		}
		$next = DB::fetch_array(DB::query(
		"SELECT c.[name], c.id FROM {faq_category} AS c"
		. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='faq'" : "")
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
			$this->result["next"]["link"] = $this->diafan->_route->link($this->diafan->cid, "faq", $next["id"]);
		}
	}

	/**
	 * Генерирует данные для страницы вопроса
	 * 
	 * @return array|boolean false
	 */
	public function id()
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
				"name"     => "show",
				"cat_id"   => $this->diafan->cat,
				"show"     => $this->diafan->show,
				"lang_id"  => _LANG,
				"site_id"  => $this->diafan->cid,
				"role_id"  => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
				"time"     => $time
			);
		if (! $this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$row = $this->id_query($time);
			if (empty($row))
			{
				include ABSOLUTE_PATH.'includes/404.php';
				return false;
			}

			if (! $this->diafan->rewrite_module && ($this->diafan->configmodules("cat") && $this->diafan->cat != $row["cat_id"]
			  || ! $this->diafan->configmodules("cat") && $this->diafan->cat))
			{
				include ABSOLUTE_PATH.'includes/404.php';
				return false;
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
			$this->result["attachments"]   = $this->diafan->_attachments->get($row["id"], 'faq');
			$this->result["use_animation"] = $this->diafan->configmodules("use_animation");

			if ($this->result["cat_id"])
			{
				$this->result["allfaq"]["link"] = $this->diafan->_route->link($this->diafan->cid, "faq", $row["cat_id"]);
			}
			else
			{
				$this->result["allfaq"]["link"] = $this->diafan->_route->link($this->diafan->cid);
			}
			$this->id_previous_next($row["created"], $time);

			$this->result["date"] = $this->format_date($row['created']);

			$row["name"] = $this->diafan->short_text($row["anons"], 100);
			$this->meta($row);
			$this->theme_view_element($row);
			
			$this->result["path"] = $this->get_path('faq');

			//сохранение кеша
			$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		}
		$this->diafan->cat = $this->result["cat_id"];

		$this->result["name"]  = $this->diafan->_useradmin->get($this->result["name"], 'name', $this->result["id"], 'faq', _LANG);
		$this->result["date"] = $this->diafan->_useradmin->get($this->result["date"], 'created', $this->result["id"], 'faq');
		$this->result["anons"] = $this->diafan->_useradmin->get($this->result["anons"], 'anons', $this->result["id"], 'faq', _LANG);
		$this->result["text"]  = $this->diafan->_useradmin->get($this->result["text"], 'text', $this->result["id"], 'faq', _LANG);

		if (! empty($this->result["previous"]["text"]))
		{
			$this->result["previous"]["text"] =
				$this->diafan->_useradmin->get($this->result["previous"]["text"], 'name', $this->result["previous"]["id"], 'faq', _LANG);
		}
		if (! empty($this->result["next"]["text"]))
		{
			$this->result["next"]["text"] =
				$this->diafan->_useradmin->get($this->result["next"]["text"], 'name', $this->result["next"]["id"], 'faq', _LANG);
		}
		foreach ($this->result["path"] as $k => $path)
		{
			if ($k == 0)
				continue;
			$this->result["path"][$k]["name"] = $this->diafan->_useradmin->get($path["name"], 'name', $path["id"], 'faq_category', _LANG);
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
		$row = DB::fetch_array(DB::query("SELECT id, [name], timeedit, created, cat_id, [keywords],"
		." [descr], [anons], [text], site_id, [title_meta], access, theme, view FROM {faq}"
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
				"SELECT e.[anons], e.id, e.cat_id FROM {faq} AS e"
				.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
				." WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
				.($this->diafan->configmodules("cat") ? " AND e.cat_id='" . $this->diafan->cat . "'" : '')
				." AND (e.created<%d OR e.created=%d AND e.id<%d)"
				." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
				." AND (e.access='0'"
				.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				.")"
				." ORDER BY e.created DESC, e.id DESC LIMIT 1",
				$this->diafan->cid, $created, $created, $this->diafan->show, $time, $time
			));
		if ($previous)
		{
			$this->result["previous"]["text"] = $this->diafan->short_text($previous["anons"]);
			if (! $this->diafan->configmodules("cat"))
			{
				$previous["cat_id"] = 0;
			}
			$this->result["previous"]["id"]   = $previous["id"];
			$this->result["previous"]["link"] = $this->diafan->_route->link($this->diafan->cid, "faq", $previous["cat_id"], $previous["id"]);
		}
		$next = DB::fetch_array(DB::query(
				"SELECT e.[anons], e.id, e.cat_id FROM {faq} AS e"
				.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
				." WHERE e.[act]='1' AND e.trash='0' AND e.site_id=%d"
				.($this->diafan->configmodules("cat") ? " AND e.cat_id='" . $this->diafan->cat . "'" : '')
				." AND (e.created>%d OR e.created=%d AND e.id>%d)"
				." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
				." AND (e.access='0'"
				.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				.")"
				." ORDER BY e.created ASC, e.id ASC LIMIT 1",
				$this->diafan->cid, $created, $created, $this->diafan->show, $time, $time
			));
		if ($next)
		{
			$this->result["next"]["text"] = $this->diafan->short_text($next["anons"]);
			if (! $this->diafan->configmodules("cat"))
			{
				$next["cat_id"] = 0;
			}
			$this->result["next"]["id"]   = $next["id"];
			$this->result["next"]["link"] = $this->diafan->_route->link($this->diafan->cid, "faq", $next["cat_id"], $next["id"]);
		}
	}

	/**
	 * Генерирует данные для формы добавления вопроса
	 *
	 * @param integer $site_id номер страницы
	 * @param integer $cat_id номер категории
	 * @param boolean $insert_form форма выводится с помощью шаблонного тэга
	 * @return array|boolean false
	 */
	public function form($site_id = 0, $cat_id = 0, $insert_form = false)
	{
		if (! $insert_form)
		{
			$site_id = $this->diafan->cid;
			$cat_id = $this->diafan->cat;
		}
		else
		{
			$cat_ids = array($cat_id);
			$site_ids = array($site_id);
			if(! $this->validate_attribute_site_cat('faq', $site_ids, $cat_ids))
			{
				return false;
			}
			$site_id = $site_ids[0];
			$cat_id = $cat_ids[0];
		}

		if (! $this->diafan->configmodules('only_user', 'faq', $site_id) || $this->diafan->_user->id)
		{
			$result["captcha"] = '';
			if ($this->diafan->configmodules('captcha', 'faq', $site_id))
			{
				$result["captcha"] = $this->diafan->_captcha->get("faq".$site_id, $this->get_error("faq".$site_id, "captcha"));
			}
			$result["site_id"] = $site_id;
			$result["cat_id"] = $cat_id;

			$result["attachments"] = false;
			if ($this->diafan->configmodules('attachments', 'faq', $site_id) && $this->diafan->configmodules("max_count_attachments", 'faq', $site_id))
			{
				$result["attachments"]           = true;
				$result["max_count_attachments"] = $this->diafan->configmodules("max_count_attachments", 'faq', $site_id);
				$result["attachment_extensions"] = $this->diafan->configmodules("attachment_extensions", 'faq', $site_id);
				$result["error_attachments"] = $this->get_error("faq".$site_id, 'attachments');
			}
			$result["error"]             = $this->get_error("faq".$site_id);
			$result["error_name"]        = $this->get_error("faq".$site_id, 'name');
			$result["error_question"]    = $this->get_error("faq".$site_id, 'question');
			$result["error_email"]       = $this->get_error("faq".$site_id, 'email');
		}
		return $result;
	}

	/**
	 * Генерирует данные для шаблонной функции: вопросов и ответов
	 * 
	 * @param integer $count количество статей
	 * @param array $cat_ids категории
	 * @param array $site_ids страницы сайта
	 * @param boolean $often часто задаваемые вопросы
	 * @param string $sort сортировка date - по дате, rand - случайно
	 * @return array
	 */
	public function show_block($count, $cat_ids, $site_ids, $often, $sort)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
				"name"     => "block",
				"cat_ids" => $cat_ids,
				"site_ids" => $site_ids,
				"count"    => $count,
				"lang_id" => _LANG,
				"sort"     => $sort,
				"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
				"time"     => $time
			);

		if ($sort == "rand" || ! $this->result = $this->diafan->_cache->get($cache_meta, "faq"))
		{
			if(! $this->validate_attribute_site_cat('faq', $site_ids, $cat_ids))
			{
				return false;
			}

			if ($sort == "rand")
			{
				$max_count = DB::query_result(
						"SELECT COUNT(DISTINCT e.id) FROM {faq} as e"
						.($cat_ids
						  ? " INNER JOIN {faq_category_rel} as c ON c.element_id=e.id"
							." AND c.cat_id IN (".implode(',', $cat_ids).")"
						  : ''
						 )
						.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
						." WHERE e.[act]='1' AND e.trash='0'"
						.($site_ids ? " AND e.site_id IN (".implode(",", $site_ids).")" : '')
						.($often ? " AND often='1'" : "")
						." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
						." AND (e.access='0'"
						.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						.")", $time, $time
					);
				$rands = array();
				for ($i = 1; $i <= min($max_count, $count); $i++)
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

			foreach ($rands as $rand)
			{
				$result = DB::query_range(
						"SELECT e.id, e.[name],e.[anons], e.[text], e.timeedit, e.cat_id, e.site_id, e.created FROM {faq} AS e"
						.($cat_ids
						? " INNER JOIN {faq_category_rel} as r ON r.element_id=e.id"
							." AND r.cat_id IN (" . implode(',', $cat_ids) . ")" 
						: ''
						)
						.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
						." WHERE e.[act]='1' AND e.trash='0'"
						.($site_ids ? " AND e.site_id IN (".implode(",", $site_ids).")" : '')
						.($often ? " AND often='1'" : "")
						." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
						." AND (e.access='0'"
						.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
						.")"
						." GROUP BY e.id"
						.($sort == "date" ? ' ORDER BY e.created DESC, e.id DESC' : ''),
						$time, $time,
						$sort == "rand" ? $rand : 0,
						$sort == "rand" ? 1     : $count
					);

				$this->result["rows"] = array_merge($this->result["rows"], $this->get_elements($result));
			}

			$this->result["name"] = $often ? $this->diafan->_('Часто задаваемые вопросы', false) : '';
			// если категория только одна, задаем ссылку на нее
			if (!empty($this->result["rows"]) && count($cat_ids) == 1)
			{
				$cat = DB::fetch_array(DB::query("SELECT [name], site_id, id FROM {faq_category} WHERE id=%d LIMIT 1", $cat_ids[0]));
				
				$this->result["name"]     = $often ? $this->result["name"] : $cat["name"];
				$this->result["link_all"] = $this->diafan->_route->link($cat["site_id"], 'faq', $cat_id);
				$this->result["category"] = true;
			}
			// если раздел сайта только один, то задаем ссылку на него
			elseif (!empty($this->result["rows"]) && count($site_ids) == 1)
			{
				$this->result["name"]     = $often ? $this->result["name"] : DB::query_result("SELECT [name] FROM {site} WHERE id=%d LIMIT 1", $site_ids[0]);
				$this->result["link_all"] = $this->diafan->_route->link($site_ids[0]);
				$this->result["category"] = false;
			}
			//сохранение кеша
			if ($sort != "rand")
			{
				$this->diafan->_cache->save($this->result, $cache_meta, "faq");
			}
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'faq', _LANG);

				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'faq', _LANG);

				$this->result["rows"][$i]["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $row["id"], 'faq', _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'faq');
			}
		}

		return $this->result;
	}

	/**
	 * Генерирует данные для шаблонной функции: блок связанных вопросов
	 * 
	 * @param integer $count количество вопросов
	 * @return array
	 */
	public function show_block_rel($count)
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));

		//кеширование
		$cache_meta = array(
			"name" => "block_rel",
			"count" => $count,
			"lang_id" => _LANG,
			"element_id" => $this->diafan->show,
			"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0,
			"time" => $time
		);

		if (! $this->result = $this->diafan->_cache->get($cache_meta, "faq"))
		{
			$this->result["rows"] = array();

			$result = DB::query_range(
			"SELECT e.id, e.[name], e.[anons], e.[text], e.cat_id, e.created, e.timeedit, e.site_id FROM {faq} AS e"
			. " INNER JOIN {faq_rel} AS r ON e.id=r.rel_element_id AND r.element_id=%d"
			.($this->diafan->configmodules("rel_two_sided") ? " OR e.id=r.element_id AND r.rel_element_id=".$this->diafan->show : '')
			. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
			. " WHERE e.[act]='1' AND e.trash='0'"
			." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
			. " AND (e.access='0'"
			. ($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
			. ")"
			. " GROUP BY e.id"
			. ' ORDER BY e.created DESC',
			$this->diafan->show, $time, $time, 0, $count
			);
			$this->result["rows"] = $this->get_elements($result);
			$this->diafan->_cache->save($this->result, $cache_meta, "faq");
		}

		if ($this->result["rows"])
		{
			foreach ($this->result["rows"] as $i => $row)
			{
				$this->result["rows"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'faq', _LANG);

				$this->result["rows"][$i]["anons"] = $this->diafan->_useradmin->get($row["anons"], 'anons', $row["id"], 'faq', _LANG);

				$this->result["rows"][$i]["date"] = $this->diafan->_useradmin->get($row["date"], 'created', $row["id"], 'faq');

				$this->result["rows"][$i]["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $row["id"], 'faq', _LANG);
			}
		}
		return $this->result;
	}

	/**
	 * Форматирует данные о вопросам и ответах для списка
	 *
	 * @param resource $result результат выполнения SQL-запроса
	 * @return array
	 */
	public function get_elements($result)
	{
		if (empty($this->result["timeedit"]))
		{
			$this->result["timeedit"] = '';
		}
		$rows = array();
		while ($row = DB::fetch_array($result))
		{
			if (! $this->diafan->configmodules("cat", "faq", $row["site_id"]))
			{
				$row["cat_id"] = 0;
			}
			if ($row["timeedit"] < $this->result["timeedit"])
			{
				$this->result["timeedit"] = $row["timeedit"];
			}
			unset($row["timeedit"]);

			$row["link"] = $this->diafan->_route->link($row["site_id"], "faq", $row["cat_id"], $row["id"]);
			unset($row["cat_id"]);

			$row["anons"] = $this->diafan->short_text($row["anons"], 160);
			$row["text"]  = ! empty($row["text"]) ? $this->diafan->short_text($row["text"], 160) : '';
			$row["date"]  = $this->format_date($row['created'], "faq", $row["site_id"]);
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
		"SELECT c.id, c.[name], c.[anons], c.site_id FROM {faq_category} AS c"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.cat_id=c.id AND a.module_name='faq'" : "")
		." WHERE c.[act]='1' AND c.parent_id=%d AND c.trash='0' AND c.site_id=%d"
		." AND (c.access='0'"
		.($this->diafan->_user->id ? " OR c.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY c.id ORDER BY c.sort ASC, c.id ASC", $parent_id, $this->diafan->cid
		);

		while ($child = DB::fetch_array($result_children))
		{
			$child["link"] = $this->diafan->_route->link($child["site_id"], 'faq', $child["id"]);
			$child["rows"] = array();
			if($this->diafan->configmodules("count_child_list"))
			{
				if ($this->diafan->configmodules("children_elements"))
				{
					$cat_ids = $this->diafan->get_children($child["id"], "faq_category");
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
		"SELECT e.id, e.[name], e.cat_id, e.timeedit, e.[anons], e.[text], e.site_id, e.created FROM {faq} AS e"
		." INNER JOIN {faq_category_rel} AS r ON e.id=r.element_id"
		.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=e.id AND a.module_name='faq'" : "")
		." WHERE r.cat_id IN (%s) AND e.[act]='1' AND e.trash='0'"
		." AND e.date_start<=%d AND (e.date_finish=0 OR e.date_finish>=%d)"
		." AND (e.access='0'"
		.($this->diafan->_user->id ? " OR e.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
		.")"
		." GROUP BY e.id ORDER BY e.created DESC, e.id DESC",
		implode(',', $cat_ids), $time, $time, 0, $this->diafan->configmodules("count_child_list")
		);
		return $result;
	}
}