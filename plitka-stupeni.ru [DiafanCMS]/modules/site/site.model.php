<?php
/**
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Site_model
 *
 * Модель модуля "Страницы сайта"
 */
class Site_model extends Model
{
	/**
	 * Генерирует данные для
	 * шаблонного тега <insert name="show_block" module="site" id="номер_страницы" [template="шаблон"]>:
	 * выводит блок на сайте
	 * 
	 * @param integer $id номер блока на сайте
	 * @return array
	 */
	public function show_block($id)
	{
		$time = mktime(1, 0, 0);
		$row = DB::fetch_array(DB::query(
				"SELECT s.[text], s.[name], s.[text_niz], s.title_no_show FROM {site} AS s"
				.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
				." INNER JOIN {site_block_rel} AS r ON r.element_id=s.id AND (r.site_id=%d OR r.site_id=0)"
				." WHERE s.id=%d AND s.[act]='1' AND s.block='1' AND s.trash='0'"
				." AND s.date_start<=".$time." AND (s.date_finish=0 OR s.date_finish>=".$time.")"
				." AND (s.access='0'"
				.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
				.") LIMIT 1",
				$this->diafan->cid,
				$id
			));
			//print_r($row);
		if ($row["text"])
		{
			if(! $row["title_no_show"])
			{
				$result["name"] = $row["name"];
			}
			$result["text"] = $this->diafan->_useradmin->get($row["text"], 'text', $id, 'site', _LANG);
			if($id == 62 || $id == 63)
			{
				$result["text"] = preg_replace("/&nbsp;/", ' ', $result["text"]);
			}
			return $result;
		}
		return;
	}

	/**
	 * Генерирует данные для
	 * шаблонного тега <insert name="show_links" module="site" [template="шаблон"]>:
	 * выводит ссылки на страницы нижнего уровня, принадлежащие текущей странице
	 * 
	 * @return array
	 */
	public function show_links()
	{
		$cache_meta = array(
				"name"     => "page",
				"id"       => $this->diafan->cid,
				"lang_id" => _LANG,
				"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
			);
		$page = $this->diafan->_cache->get($cache_meta, 'site');
		if (! isset($page["links"]))
		{
			$page["links"] = array();
			$result = DB::query(
					"SELECT s.id, s.[name] FROM {site} AS s"
					.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
					." WHERE s.parent_id=%d AND s.trash='0' AND s.[act]='1' AND s.block='0' AND s.map_no_show='0'"
					." AND (s.access='0'"
					.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
					.")"
					." GROUP BY s.id ORDER BY s.sort ASC",
					$this->diafan->cid
				);
			while ($row = DB::fetch_array($result))
			{
				$row["link"] = $this->diafan->_route->link($row["id"]);
				$page["links"][] = $row;
			}
			//сохранение кеша
			$this->diafan->_cache->save($page, $cache_meta, 'site');
		}
		if ($page["links"])
		{
			foreach ($page["links"] as $i => $row)
			{
				$page["links"][$i]["name"] = $this->diafan->_useradmin->get($row["name"], 'name', $row["id"], 'site', _LANG);
			}
		}
		return $page["links"];
	}

	/**
	 * Генерирует данные для
	 * шаблонного тега <insert name="show_previous_next" module="site" [template="шаблон"]>:
	 * выводит ссылки на предыдующую и следующую страницы
	 * 
	 * @return array
	 */
	public function show_previous_next()
	{
		if ($this->diafan->hide_previous_next || $this->diafan->module && ($this->diafan->cat || $this->diafan->show) || $this->diafan->cid == 1)
		{
			return;
		}

		$cache_meta = array(
				"name"     => "page",
				"id"       => $this->diafan->cid,
				"lang_id" => _LANG,
				"role_id" => $this->diafan->_user->id ? $this->diafan->_user->role_id : 0
			);
		$page = $this->diafan->_cache->get($cache_meta, 'site');
		if (! isset($page["previous"]) && ! isset($page["next"]))
		{
			$page["previous"] = array();
			$page["next"]     = array();

			$sort = DB::query_result("SELECT sort FROM {site} WHERE id=%d LIMIT 1", $this->diafan->cid);
			$previous = DB::fetch_array(DB::query(
					"SELECT s.id, s.[name] FROM {site} AS s"
					.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
					." WHERE s.[act]='1' AND s.trash='0' AND s.block='0' AND s.id<>1 AND s.map_no_show='0'"
					." AND (s.access='0'"
					.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
					.")"
					." AND (s.sort<%d OR s.sort=%d AND s.id<%d) AND s.parent_id=%d ORDER BY s.sort DESC, id DESC LIMIT 1",
					$sort, $sort, $this->diafan->cid, $this->diafan->parent_id));

			$next = DB::fetch_array(DB::query(
					"SELECT s.id, s.[name] FROM {site} AS s"
					.($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
					." WHERE s.[act]='1' AND s.trash='0' AND s.block='0' AND s.id<>1 AND s.map_no_show"
					." AND (s.access='0'"
					.($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=".$this->diafan->_user->role_id : '')
					.")"
					." AND (s.sort>%d OR s.sort=%d AND s.id>%d) AND s.parent_id=%d ORDER BY s.sort ASC, id ASC LIMIT 1",
					$sort, $sort, $this->diafan->cid, $this->diafan->parent_id));
			
			if ($previous)
			{
				$previous["link"] = $this->diafan->_route->link($previous["id"]);
				$page["previous"] = $previous;
			}
			if ($next)
			{
				$next["link"] = $this->diafan->_route->link($next["id"]);
				$page["next"] = $next;
			}
			//сохранение кеша
			$this->diafan->_cache->save($page, $cache_meta, 'site');
		}
		if ($page["previous"])
		{
			$page["previous"]["name"] = $this->diafan->_useradmin->get($page["previous"]["name"], 'name', $page["previous"]["id"], 'site', _LANG);
		}
		if ($page["next"])
		{
			$page["next"]["name"] = $this->diafan->_useradmin->get($page["next"]["name"], 'name', $page["next"]["id"], 'site', _LANG);
		}
		$result["previous"] = $page["previous"];
		$result["next"] = $page["next"];
		return $result;
	}

	/**
	 * Генерирует данные для
	 * шаблонного тега <insert name="show_images" module="site" [template="шаблон"]>:
	 * выводит изображения, прикрепленные к странице сайта
	 * (если в конфигурации модуля «Страницы сайта» включен параметры «Использовать изображения»)
	 * 
	 * @return array
	 */
	public function show_images()
	{
		$result["id"] = $this->diafan->cid;
		$result["images"] = array();
		if ($this->diafan->configmodules('images', 'site'))
		{
			$cache_meta = array(
					"name"     => "page",
					"id"       => $this->diafan->cid,
					"lang_id"  => _LANG,
					"user_id"  => $this->diafan->_user->id ? true : false
				);
			$page = $this->diafan->_cache->get($cache_meta, 'site');
			if (! isset($page["images"]))
			{
				$result["images"] = $this->diafan->_images->get('medium', $this->diafan->cid, 'site', $this->diafan->cid, $this->diafan->name, 0, false, 0, 'large');
				//сохранение кеша
				$this->diafan->_cache->save($page, $cache_meta, 'site');
			}
			else
			{
				$result["images"] = $page["images"];
			}
		}
		return $result;
	}
}