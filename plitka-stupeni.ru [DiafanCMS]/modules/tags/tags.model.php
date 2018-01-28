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
 * Tags_model
 *
 * Модель модуля "Теги"
 */
class Tags_model extends Model
{
	/**
	 * @var integer количество элементов, показанных на странице
	 */
	private $nastr = 10;

	/**
	 * Геренирует список элементов, к которым прикреплен тэг
	 * 
	 * @return array
	 */
	public function list_module()
	{
		$time = mktime(23, 59, 0, date("m"), date("d"), date("Y"));
		//кеширование
		$cache_meta = array(
				"name"     => "list",
				"show"     => $this->diafan->show,
				"lang_id" => _LANG,
				"time"     => $time,
				"page"     => $this->diafan->page > 1 ? $this->diafan->page : 1
			);
		if ($this->result = $this->diafan->_cache->get($cache_meta, $this->diafan->module))
		{
			$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);
			return $this->result;
		}
		$row = DB::fetch_array(DB::query("SELECT [name] FROM {tags_name} WHERE id=%d AND trash='0' LIMIT 1", $this->diafan->show));
		if (! $row)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		//заголовок
		$this->result["title"] = $this->diafan->name.': '.$row["name"];

		////navigation//
		if ($this->nastr)
		{
			$this->diafan->_paginator->nastr = $this->nastr;
		}
		$this->diafan->_paginator->page    = $this->diafan->page;
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->nen = DB::query_result("SELECT COUNT(*) FROM {tags} WHERE tags_name_id=%d AND [act]='1' AND trash='0' LIMIT 1", $this->diafan->show);
		$this->result["paginator"] = $this->diafan->_paginator->get();
		////navigation///

		$k = 0;
		$includes = array();

		$result = DB::query_range("SELECT * FROM {tags} WHERE tags_name_id=%d AND [act]='1' AND trash='0' ORDER BY id ASC",
		                          $this->diafan->show, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
		while ($row = DB::fetch_array($result))
		{
			$new_row = array();
			if ($row["module_name"] == "site")
			{
				$row_site = DB::fetch_array(DB::query("SELECT [name], [text], access FROM {".$row["module_name"]."} WHERE id=%d AND trash='0' AND [act]='1' LIMIT 1", $row["element_id"]));
				if($row_site["access"] && ! $this->access($row_site["id"], 0, "site"))
				{
					continue;
				}
				$new_row["link"] = $this->diafan->_route->link($row["element_id"]);
				$new_row["name"] = $this->diafan->short_text($row_site["name"], 20);
				$new_row["snippet"] = $this->diafan->short_text($row_site["text"], 100);
				$this->result["rows"][] = $new_row;
				continue;
			}
			if (! isset($includes[$row["module_name"]]))
			{
				$name = ucfirst($row["module_name"]);
				if (file_exists(ABSOLUTE_PATH.'modules/'.$row["module_name"].'/views/'.$row["module_name"].'.view.list_tags.php'))
				{
					$includes[$row["module_name"]]["view_class"] = $row["module_name"];
					$includes[$row["module_name"]]["view_func"] = 'list_tags';
				}
				else
				{
					$includes[$row["module_name"]]["view_class"] = $row["module_name"];
					$includes[$row["module_name"]]["view_func"] = 'list';
				}
				if (file_exists(ABSOLUTE_PATH.'modules/'.$row["module_name"].'/'.$row["module_name"].'.model.php'))
				{
					Customization::inc('modules/'.$row["module_name"].'/'.$row["module_name"].'.model.php');
					$class = $name.'_model';
					$func = 'tags';
					if (method_exists($class, $func))
					{
						$includes[$row["module_name"]]["model_class"] = new $class($this->diafan);
						$includes[$row["module_name"]]["model_func"] = $func;
					}
					else
					{
						$func = 'get_elements';
						if (method_exists($class, $func))
						{
							$includes[$row["module_name"]]["model_class"] = new $class($this->diafan);
							$includes[$row["module_name"]]["model_func"]  = $func;
						}
					}
				}
				if (empty($includes[$row["module_name"]]["view_func"]) || empty($includes[$row["module_name"]]["model_func"]))
				{
					$includes[$row["module_name"]] = false;
				}
			}
			if ($includes[$row["module_name"]])
			{
				$model = &$includes[$row["module_name"]]["model_class"];
				$func = $includes[$row["module_name"]]["model_func"];
				if ($func == 'get_elements')
				{
					$result_element = DB::query("SELECT *, [name], [anons] FROM {".$row["module_name"]."} WHERE id=%d AND trash='0' AND [act]='1'", $row["element_id"]);
					$new_row["result"]["rows"] = call_user_func_array (array(&$model, $func), array($result_element));
				}
				else
				{
					$new_row["result"] = call_user_func_array (array(&$model, $func), array($row["element_id"]));
				}
				$new_row["class"]  = $includes[$row["module_name"]]["view_class"];
				$new_row["func"]   = $includes[$row["module_name"]]["view_func"];
				$this->result["rows"][] = $new_row;
			}
		}
		$this->diafan->_cache->save($this->result, $cache_meta, $this->diafan->module);
		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $this->result["paginator"]);
		return $this->result;
	}

	/**
	 * Геренирует данные для облака тэгов
	 * 
	 * @param boolean $title_no_show скрывать заголовок H2
	 * @return array
	 */
	function show_block($title_no_show = false)
	{
		//кеширование
		$cache_meta = array(
				    "name"     => "block",
				    "lang_id" => _LANG
				    );
		if (! $result = $this->diafan->_cache->get($cache_meta, "tags"))
		{
			$site_id = DB::query_result("SELECT id FROM {site} WHERE module_name='tags' AND trash='0' AND [act]='1' AND block='0' LIMIT 1");
			if (! $site_id)
			{
				return false;
			}

			//максимальный и минимальный размеры текста в em
			$max = 3;
			$min = 0.9;
	
			$maxr = 0;
			$minr = 10;
			$result["rows"] = array();
	
			$res = DB::query("SELECT id, [name] FROM {tags_name} WHERE trash='0' ORDER BY sort ASC");
			while ($row = DB::fetch_array($res))
			{
				$row["size"] = DB::query_result("SELECT COUNT(*) FROM {tags} WHERE tags_name_id='%d' AND trash='0' AND [act]='1'", $row["id"]);
				if (! $row["size"])
				{
					continue;
				}
				$maxr = $maxr < $row["size"] ? $row["size"] : $maxr;
				$minr = $minr > $row["size"] ? $row["size"] : $minr;
	
				$row["link"] = $this->diafan->_route->link($site_id, "tags", 0, $row["id"]);

				$result["rows"][] = $row;
			}
	
			if ($result["rows"])
			{
				for ($i = 0; $i < count($result["rows"]); $i++)
				{
					$result["rows"][$i]["size"] = ($maxr - $minr < 1 ? $min
								       : ($max - $min) * ($result["rows"][$i]["size"] - $minr) / ($maxr - $minr) + $min);
					
				}
			}
			//сохранение кеша
			$this->diafan->_cache->save($result, $cache_meta, "tags");
		}
	
		if ($result["rows"])
		{
			for ($i = 0; $i < count($result["rows"]); $i++)
			{
				$result["rows"][$i]["selected"] = $this->diafan->module == "tags" && $this->diafan->show == $result["rows"][$i]["id"];
				$result["rows"][$i]["name"] = $this->diafan->_useradmin->get($result["rows"][$i]["name"], 'name', $result["rows"][$i]["id"], 'tags_name', _LANG);
			}
		}
		$result["title_no_show"] = $title_no_show;
		return $result;
	}
}