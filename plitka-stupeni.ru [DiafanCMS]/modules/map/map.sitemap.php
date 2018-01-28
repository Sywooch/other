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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * Map_sitemap
 * 
 * Карта сайта в xml формате
 */
class Map_sitemap extends Diafan
{
	/**
	 * @var array языковые версии сайта
	 */
	public $lang;

	/**
	 * @var string перечень всех полей, указывающих на активность элемента
	 */
	public $act;

	/**
	 * @var array ЧПУ
	 */
	public $rewrites;

	/**
	 * Инициирует создание карты сайта
	 * 
	 * @return void
	 */
	public function init()
	{
		$this->set_languages();
		$this->set_rewrites();

		header('Content-type: application/xml'); 
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$this->site_map();
		echo '</urlset>';
		
	}

	/**
	 * Записываем все языки сайта
	 * 
	 * @return void
	 */
	private function set_languages()
	{
		$result = DB::query("SELECT id, shortname, base_site FROM {languages} ORDER BY id ASC");
		while ($row = DB::fetch_array($result))
		{
			if(! empty($base_site))
			{
				$row["base_site"] = false;
				$base_site = true;
			}
			$rows[] = $row;
			$this->act .= ", act".$row["id"];
		}
		if(empty($base_site))
		{
			$rows[0]["base_site"] = true;
		}
		foreach($rows as $row)
		{
			$this->lang[] = array("name" => (! $row["base_site"] ? $row["shortname"].'/' : ''), "id" => $row["id"]);
		}
	}

	/**
	 * Записываем все ЧПУ
	 * 
	 * @return void
	 */
	private function set_rewrites()
	{
		$result = DB::query("SELECT * FROM {rewrite} WHERE trash='0'");
		while ($row = DB::fetch_array($result))
		{
			if($row["module_name"] == 'site')
			{
				$this->rewrites[$row["module_name"]][$row["site_id"]] = $row["rewrite"];
			}
			else
			{
				if(! empty($row["param_id"]))
				{
					$this->rewrites[$row["module_name"]]["params"][$row["param_id"]] = $row["rewrite"];
				}
				elseif(! empty($row["element_id"]))
				{
					$this->rewrites[$row["module_name"]]["elements"][$row["element_id"]] = $row["rewrite"];
				}
				else
				{
					$this->rewrites[$row["module_name"]]["cats"][$row["cat_id"]] = $row["rewrite"];
				}
			}
		}
	}

	/**
	 * Выводит URL страниц сайта
	 * 
	 * @return void
	 */
	private function site_map()
	{
		$result = DB::query("SELECT id, module_name, timeedit".$this->act.", changefreq, priority FROM {site} WHERE trash='0' AND access='0' AND map_no_show='0' AND block='0'");
		while ($row = DB::fetch_array($result))
		{
			foreach ($this->lang as $l)
			{
				if (! $row["act".$l["id"]])
					continue;

				if($row["id"] == 1)
				{
					$rewrite = '';
				}
				else
				{
					if(empty($this->rewrites["site"][$row["id"]]))
					{
						continue;
					}
					$rewrite = $this->rewrites["site"][$row["id"]];
				}
				if(ROUTE_END && $rewrite)
				{
					$rewrite .= ROUTE_END;
				}

				echo '<url>';
				echo '<loc>'. BASE_PATH.$l["name"].$rewrite.'</loc>';
				echo '<lastmod>'.date('Y-m-d', $row["timeedit"]).'</lastmod>';
				if($row["changefreq"])
				{
					echo '<changefreq>'.$row["changefreq"].'</changefreq>';
				}
				if($row["priority"])
				{
					echo '<priority>'.$row["priority"].'</priority>';
				}
				echo '</url>';
			}
			if ($row["module_name"] && file_exists(ABSOLUTE_PATH.'modules/'.$row["module_name"].'/'.$row["module_name"].'.sitemap.php'))
			{
				Customization::inc('modules/'.$row["module_name"].'/'.$row["module_name"].'.sitemap.php');
				$class_name = ucfirst($row["module_name"]).'_sitemap';
				$class = new $class_name($this->diafan);
				if(is_callable(array(&$class, 'config')))
				{
					$res = call_user_func_array(array(&$class, 'config'), array($row["id"], $row["timeedit"]));
					if(is_array($res))
					{
						$multilang = ! empty($res['multilang']);
						if(! empty($res["type"]))
						{
							if(in_array('element', $res["type"]))
							{
								$where =  ! empty($res['where']['element']) ? $res['where']['element'] : '';
								$this->element_map($row["module_name"], $row["id"], $row["timeedit"], $multilang, $where, in_array('category', $res["type"]));
							}
							if(in_array('category', $res["type"]))
							{
								$where =  ! empty($res['where']['category']) ? $res['where']['category'] : '';
								$this->category_map($row["module_name"], $row["id"], $row["timeedit"], $multilang, $where);
							}
						}
					}
				}
				elseif(is_callable(array(&$class, 'get')))
				{
					call_user_func_array(array(&$class, 'get'), array($row["id"], $row["timeedit"], $this->lang, $this->rewrites));
				}
			}
		}
	}
	
	/**
	 * Выводит URL категорий модулей
	 * 
	 * @param string $module название модуля
	 * @param integer $site_id страница сайта
	 * @param integer $timeedit время редактирования страницы сайта
	 * @param boolean $multilang страница может быть не активна на других страницах сайта
	 * @param string $where дополнительное условие отображения на сайте
	 * @return void
	 */
	public function category_map($module, $site_id, $timeedit, $multilang, $where)
	{
		$result = DB::query("SELECT * FROM {".$module."_category} WHERE trash='0' ". $where);
		while ($row = DB::fetch_array($result))
		{
			$count = DB::query_result("SELECT COUNT(*) FROM {".$module."_category_rel} WHERE cat_id=%d", $row["id"]);
			$nastr = $this->diafan->configmodules("nastr", $module, $site_id);
			if(! empty($this->rewrites[$module]["cats"][$row["id"]]))
			{
				$link  = $this->rewrites[$module]["cats"][$row["id"]];
				$link2 = $link.'/';
				$link .= ROUTE_END;
			}
			elseif(isset($this->rewrites["site"][$site_id]))
			{
				$link = ($this->rewrites["site"][$site_id] ? $this->rewrites["site"][$site_id].'/' : '').'cat'.$row["id"].'/';
				$link2 = $link;
			}
			else
			{
				return;
			}
			foreach ($this->lang as $l)
			{
				if ($multilang && ! $row["act".$l["id"]] || ! $multilang && empty($row["act"]))
					continue;

				echo '<url>';
				echo '<loc>'. BASE_PATH.$l["name"].$link.'</loc>';
				if(! empty($row["timeedit"]) && $row["timeedit"] > $timeedit)
				{
					echo '<lastmod>'.date('Y-m-d', $row["timeedit"]).'</lastmod>';
				}
				else
				{
					echo '<lastmod>'.date('Y-m-d', $timeedit).'</lastmod>';
				}
				if($row["changefreq"])
				{
					echo '<changefreq>'.$row["changefreq"].'</changefreq>';
				}
				if($row["priority"])
				{
					echo '<priority>'.$row["priority"].'</priority>';
				}
				echo '</url>';
				if ($count > $nastr)
				{
			
					for ($i = 2; $i <= ceil($count/$nastr); $i++)
					{
						echo '<url>';
						echo '<loc>'.BASE_PATH.$l["name"].$link2.'page'.$i.'/</loc>';
						if(! empty($row["timeedit"]) && $row["timeedit"] > $timeedit)
						{
							echo '<lastmod>'.date('Y-m-d', $row["timeedit"]).'</lastmod>';
						}
						else
						{
							echo '<lastmod>'.date('Y-m-d', $timeedit).'</lastmod>';
						}
						echo '</url>';
					}
					
				}
			}
		}
		return true;
	}
	
	/**
	 * Формирует URL элементов модулей, которые делятся категориями
	 * 
	 * @param boolean $multilang страница может быть не активна на других страницах сайта
	 * @param integer $site_id страница сайта
	 * @param integer $timeedit время редактирования страницы сайта
	 * @param string $where дополнительное условие отображения на сайте
	 * @param boolean $category используются категории
	 * @return void
	 */
	public function element_map($module, $site_id, $timeedit, $multilang, $where, $category)
	{
		$result = DB::query("SELECT * FROM {".$module."} WHERE trash='0' ", $where);
		while ($row = DB::fetch_array($result))
		{
			if(! empty($this->rewrites[$module]["elements"][$row["id"]]))
			{
				$link  = $this->rewrites[$module]["elements"][$row["id"]].ROUTE_END;
			}
			elseif($category && $row["cat_id"] && ! empty($this->rewrites[$module]["cats"][$row["cat_id"]]))
			{
				$link  = $this->rewrites[$module]["cats"][$row["cat_id"]].'/show'.$row["id"].'/';
			}
			elseif(isset($this->rewrites["site"][$site_id]))
			{
				$link = ($this->rewrites["site"][$site_id] ? $this->rewrites["site"][$site_id].'/' : '').($category && $row["cat_id"] ? 'cat'.$row["cat_id"].'/' : '').'show'.$row["id"].'/';
			}
			else
			{
				return;
			}
			
			foreach ($this->lang as $l)
			{
				if ($multilang && ! $row["act".$l["id"]] || ! $multilang && ! $row["act"])
					continue;

				echo '<url>';
				echo '<loc>'. BASE_PATH.$l["name"].$link.'</loc>';
				if(! empty($row["timeedit"]) && $row["timeedit"] > $timeedit)
				{
					echo '<lastmod>'.date('Y-m-d', $row["timeedit"]).'</lastmod>';
				}
				else
				{
					echo '<lastmod>'.date('Y-m-d', $timeedit).'</lastmod>';
				}
				if(! empty($row["changefreq"]))
				{
					echo '<changefreq>'.$row["changefreq"].'</changefreq>';
				}
				if(! empty($row["priority"]))
				{
					echo '<priority>'.$row["priority"].'</priority>';
				}
				echo '</url>';
			}
			
		}
		return true;
	}
}


$sitemap = new Map_sitemap($this);
$sitemap->init();
exit;