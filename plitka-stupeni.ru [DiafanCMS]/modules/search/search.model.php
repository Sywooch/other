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
 * Search_model
 *
 * Модель модуля "Поиск по сайту"
 */
class Search_model extends Model
{
	/**
	 * Генерирует список найденных страниц
	 * 
	 * @return array
	 */
	public function show_module()
	{
		$search = '';
		if (isset($_GET["searchword"]))
		{
			if (is_array($_GET["searchword"]))
			{
				$_GET["searchword"] = '';
			}
			$search = trim(htmlspecialchars(stripslashes($_GET["searchword"])));
			if(empty($_SESSION["search"]) || ! in_array($_GET["searchword"], $_SESSION["search"]))
			{
				$_SESSION["search"][] = $_GET["searchword"];
				if($count = $this->diafan->configmodules("count_history"))
				{
					DB::query("INSERT INTO {search_history} (created, name) VALUES (%d, '%h')", time(), $_GET["searchword"]);
					if(DB::query_result("SELECT COUNT(*) FROM {search_history}") > $count)
					{
						DB::query("DELETE FROM {search_history} ORDER BY created  ASC LIMIT 1");
					}
				}
			}
		}
		$this->result = array();

		if (! empty($search))
		{
			$search_words = $this->diafan->_search->prepare($search);

			$keys = array();
			$result = DB::query("SELECT id FROM {search_keywords} WHERE keyword IN ('".implode("', '", $search_words)."')");
			while ($row = DB::fetch_array($result))
			{
				$keys[] = $row["id"];
			}
			if($this->diafan->configmodules("search_all_word", "search"))
			{
				// обязательны все слова
				$where = "";
				foreach($keys as $k => $key)
				{
					$where .= " INNER JOIN {search_index} AS i".$k." ON r.id=i".$k.".result_id AND i".$k.".keyword_id=".$key;
				}
			}
			else
			{
				// ищет хотя бы одно слово, сортировка по количеству найденных
				$where = "INNER JOIN {search_index} AS i ON r.id=i.result_id AND i.keyword_id IN ('".implode("', '", $keys)."')";
			}

			$nen = DB::query_result("SELECT COUNT(DISTINCT r.id) FROM {search_results} as r ".$where." WHERE r.lang_id=%d", _LANG);

			////navigation//
			if ($nastr = $this->diafan->configmodules("nastr", "search"))
			{
				$this->diafan->_paginator->nastr = $nastr;
			}
			$this->diafan->_paginator->page    = $this->diafan->page;
			$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
			$this->diafan->_paginator->get_nav = '?searchword='.$search;
			$this->diafan->_paginator->nen     = $nen;
			$links = $this->diafan->_paginator->get();
			////navigation///

			$k = ! $this->diafan->page ? 1 : ($this->diafan->page - 1) * $this->diafan->_paginator->nastr + 1;

			$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $links);

			$count = 0;
			$result = DB::query_range("
				SELECT r.name, r.url, r.snippet, COUNT(r.id) as c, r.element_id, r.table_name FROM {search_results} as r ".$where."
				WHERE r.lang_id=%d GROUP BY r.id".(! $this->diafan->configmodules("search_all_word", "search") ? " ORDER BY c DESC" : ""),
				_LANG, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
			while ($row = DB::fetch_array($result))
			{
				$row["link"] = BASE_PATH_HREF.str_replace('ROUTE_END', ROUTE_END, $row["url"]);
				$this->result["rows"][] = $row;
				$count++;
			}

			$this->result["count"] = $this->diafan->_paginator->nen;
			$this->result["count_start"] = $this->result["count"] ? ($this->diafan->_paginator->page - 1) * $this->diafan->_paginator->nastr + 1 : 0;
			$this->result["count_finish"] = $this->result["count"] ? $this->result["count_start"] - 1 + $count : 0;
			$this->result["count_page"] =
				$this->diafan->_paginator->nen > $this->diafan->_paginator->nastr ? 
				$this->diafan->_paginator->nastr : $this->diafan->_paginator->nen;
		}
		$this->result["value"] = $search;
		$this->result["action"] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->cid);
		$this->result["button"] = 'Найти';

		return $this->result;
	}

	/**
	 * Генерирует контент для шаблонной функции: форма поиска по сайту
	 * 
	 * @return array
	 */
	public function show_search($button)
	{
		$result["value"] = '';
		if (isset($_GET["searchword"]))
		{
			if (is_array($_GET["searchword"]))
			{
				$_GET["searchword"] = '';
			}
			$result["value"] = trim(htmlspecialchars(stripslashes($_GET["searchword"])));
		}
		$result["action"] = BASE_PATH_HREF.$this->diafan->_route->module('search', true);
		$result["button"] = $button;
		return $result;
	}
}