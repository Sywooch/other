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
 * Route
 * Набор функций для работы с ЧПУ
 */
class Route extends Diafan
{
	/**
	 * @var array кэш класса
	 */
	private $cache;

	/**
	 * Генерирует ссылку
	 *
	 * @param integer $site_id номер страницы сайта
	 * @param string $module_name модуль
	 * @param integer $cat_id номер категории
	 * @param integer $element_id номер элемента модуля
	 * @param integer $param_id номер параметра
	 * @param boolean $insert_route_end добавлять окончание ЧПУ в конце ссылки
	 * @return string
	 */
	public function link($site_id, $module_name = '', $cat_id = 0, $element_id = 0, $param_id = 0, $insert_route_end = true)
	{
		$route_end = $insert_route_end ? ROUTE_END : 'ROUTE_END';
		$link = '';
		if ($param_id)
		{
			if ($this->get_rewrite($module_name, $param_id, "param"))
			{
				$link = $this->get_rewrite($module_name, $param_id, "param").$route_end;
			}
			else
			{
				$link = ($this->get_rewrite("site", $site_id) ? $this->get_rewrite("site", $site_id).'/' : '')
				        .'param'.$param_id.'/';
			}
		}
		elseif ($element_id)
		{
			if ($this->get_rewrite($module_name, $element_id, "element"))
			{
				$link = $this->get_rewrite($module_name, $element_id, "element").$route_end;
			}
			elseif ($cat_id && $this->get_rewrite($module_name, $cat_id, "cat"))
			{
				$link = $this->get_rewrite($module_name, $cat_id, "cat").'/show'.$element_id.'/';
			}
			else
			{
				$link = ($this->get_rewrite("site", $site_id) ? $this->get_rewrite("site", $site_id).'/' : '')
				        .($cat_id ? 'cat'.$cat_id.'/' : '')
				        .'show'.$element_id.'/';
			}
		}
		elseif ($cat_id)
		{
			if ($this->get_rewrite($module_name, $cat_id, "cat"))
			{
				$link = $this->get_rewrite($module_name, $cat_id, "cat").$route_end;
			}
			else
			{
				$link = ($this->get_rewrite("site", $site_id) ? $this->get_rewrite("site", $site_id).'/' : '')
				        .'cat'.$cat_id.'/';
			}
		}
		else
		{
			$link = $this->get_rewrite("site", $site_id) ? $this->get_rewrite("site", $site_id).($module_name ? '/' : $route_end) : '';
		}
		return $link;
	}

	/**
	 * Получает ЧПУ страницы сайта по названию модуля
	 * 
	 * @param string $module_name название модуля
	 * @param boolean $route_end выводить окончание
	 * @return string|boolean false
	 */
	public function module($module_name, $route_end = false)
	{
		$key = "page_module_name".($route_end ? '_end' : '');
		if (! isset($this->cache[$key][$module_name]))
		{
			$site_id = DB::query_result(
				"SELECT s.id FROM {site} AS s"
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
				. " WHERE s.module_name='%s' AND s.trash='0' AND s.[act]='1' AND s.block='0'"
				. " AND (s.access='0'"
				. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
				. ") LIMIT 1", $module_name
			);
			if(! $site_id)
			{
				$this->cache[$key][$module_name] = false;
			}
			else
			{
				$this->cache[$key][$module_name] = $this->link($site_id, $route_end ? '' : $module_name);
			}
		}
		return $this->cache[$key][$module_name];
	}

	/**
	 * Определяет номер страницы, к которой прикреплен модуль, доступной текущему пользователю
	 * 
	 * @param string $module_name название модуля
	 * @param mixed $site_id номер страницы (если задан, определяет прикреплен ли модуль, есть ли доступ)
	 * @param boolean $return_array вернуть массив (или один номер)
	 * @return mixed
	 */
	public function id_module($module_name, $site_id = 0, $return_array = true)
	{
		// можно задать номер страницы в виде числа, массива чисел или строки чисел, разделенных запятой
		if($site_id)
		{
			if(! is_array($site_id))
			{
				$site_id = explode(",", $site_id);
			}
			$site_ids = array();
			foreach($site_id as $s)
			{
				$s = intval($s);
				if($s)
				{
					$site_ids[] = $s;
				}
			}
		}
		// если задан номер страницы, то проверяем доступ и прикреплен ли модуль
		if(! empty($site_ids))
		{
			$new_site_id = array();
			$result = DB::query("SELECT id, access FROM {site} WHERE id IN (%h) AND module_name='%h' AND [act]='1' AND trash='0'", implode(",", $site_id), $module_name);
			while($row = DB::fetch_array($result))
			{
				if($row["access"])
				{
					if(! $this->access($site_id, 0, "site"))
						continue;
				}
				$new_site_id[] = $row["id"];
			}
			if($new_site_id)
			{
				// возвращаем номера страницы, к которым есть доступ и прикреплен модуль
				return $new_site_id;
			}
			else
			{
				return false;
			}
		}
		if (! isset($this->cache["page_module_name_id"][$module_name]))
		{
			$result = DB::query(
				"SELECT s.id FROM {site} AS s"
				. ($this->diafan->_user->id ? " LEFT JOIN {access} AS a ON a.element_id=s.id AND a.module_name='site'" : "")
				. " WHERE s.module_name='%s' AND s.trash='0' AND s.[act]='1' AND s.block='0'"
				. " AND (s.access='0'"
				. ($this->diafan->_user->id ? " OR s.access='1' AND a.role_id=" . $this->diafan->_user->role_id : '')
				. ")", $module_name
			);
			while($row = DB::fetch_array($result))
			{
				$this->cache["page_module_name_id"][$module_name][] = $row["id"];
			}
		}
		if(! empty($this->cache["page_module_name_id"][$module_name]))
		{
			if($return_array)
			{
				return $this->cache["page_module_name_id"][$module_name];
			}
			else
			{
				return $this->cache["page_module_name_id"][$module_name][0];
			}	
		}
		else
		{
			return false;
		}
	}

	/**
	 * Выдает URL текущей страницы с включенными или исключенными переменными
	 * 
	 * @param string|array $exclude исключенные переменные
	 * @param array $include включенные переменные
	 * @return string
	 */
	public function current_link($exclude = '', $include = array())
	{
		switch($this->diafan->theme)
		{
			case '403.php':
			case '404.php':
			case '503.php':
				return $this->diafan->theme;
		}
		if (! is_array($exclude))
		{
			$exclude = array($exclude);
		}
		$args = array();
		$keys = array();
		foreach ($this->diafan->rewrite_variable_names_all as $arg)
		{
			if (in_array($arg, array_keys($include)))
			{
				$args[] = array($arg => $include[$arg]);
				$keys[] = $arg;
			}
			elseif (! in_array($arg, $exclude))
			{
				if (! empty($this->diafan->$arg) && ($arg != "page" || $this->diafan->page != 1) && ($arg != "comments" || $this->diafan->comments != 1))
				{
					$args[] = array($arg => $this->diafan->$arg);
					$keys[] = $arg;
				}
			}
		}
		if (! $args)
		{
			$link = $this->link($this->diafan->cid);
		}
		elseif (in_array('show', $keys) && $this->get_rewrite($this->diafan->module, $this->diafan->show, "element"))
		{
			foreach ($args as $i => $array)
			{
				if (! empty($array["show"]) || ! empty($array["cat"]))
				{
					unset($args[$i]);
				}
			}
			if (! $args)
			{
				$link = $this->get_rewrite($this->diafan->module, $this->diafan->show, "element").ROUTE_END;
			}
			else
			{
				$link = $this->get_rewrite($this->diafan->module, $this->diafan->show, "element").'/';
			}
		}
		elseif (in_array('cat', $keys) && $this->get_rewrite($this->diafan->module, $this->diafan->cat, "cat"))
		{
			foreach ($args as $i => $array)
			{
				if (! empty($array["cat"]))
				{
					unset($args[$i]);
				}
			}
			if (! $args)
			{
				$link = $this->get_rewrite($this->diafan->module, $this->diafan->cat, "cat").ROUTE_END;
			}
			else
			{
				$link = $this->get_rewrite($this->diafan->module, $this->diafan->cat, "cat").'/';
			}
		}
		elseif (in_array('param', $keys) && $this->get_rewrite($this->diafan->module, $this->diafan->param, "param"))
		{
			foreach ($args as $i => $array)
			{
				if (! empty($array["param"]))
				{
					unset($args[$i]);
				}
			}
			if (! $args)
			{
				$link = $this->get_rewrite($this->diafan->module, $this->diafan->param, "param").ROUTE_END;
			}
			else
			{
				$link = $this->get_rewrite($this->diafan->module, $this->diafan->param, "param").'/';
			}
		}
		else
		{
			$link = $this->get_rewrite("site", $this->diafan->cid) ? $this->get_rewrite("site", $this->diafan->cid).'/' : '';
		}
		foreach ($args as $array)
		{
			foreach ($array as $name => $value)
			{
				$link .= $name.$value.'/';
			}
		}
		return $link;
	}

	/**
	 * Выдает URL текущей страницы административной части с включенными переменными
	 * 
	 * @param string|array $exclude исключенные переменные
	 * @return string
	 */
	public function current_admin_link($exclude = '')
	{
		$key = serialize($exclude);
		if (! empty($this->cache[$key]))
		{
			return $this->cache[$key];
		}
		if (! is_array($exclude))
		{
			$exclude = array($exclude);
		}
		$args = array();
		foreach ($this->diafan->rewrite_variable_names as $arg)
		{
			if (! in_array($arg, $exclude))
			{
				if (! empty($this->diafan->$arg) && ($arg != "page" || $this->diafan->page != 1))
				{
					$args[] = array($arg => $this->diafan->$arg);
				}
			}
		}
		$link = BASE_PATH_HREF.($this->diafan->rewrite ? $this->diafan->rewrite.'/' : '');
		foreach ($args as $array)
		{
			foreach ($array as $name => $value)
			{
				$link .= $name.$value.'/';
			}
		}
		$this->cache[$key] = $link;
		return $link;
	}

	/**
	 * Ищет псевдоссылку в базе данных
	 *
	 * @param string $rewrite текущая псевдоссылка
	 * @param boolean $arguments_in_url в URL переданы аргументы
	 * @return array|boolean false
	 */
	public function search($rewrite, $arguments_in_url = false)
	{
		if (ROUTE_END != "/" && ! $arguments_in_url && $rewrite)
		{
			if (preg_match('/(.*)'.ROUTE_END.'$/', $rewrite, $match))
			{
				$rewrite = $match[1];
			}
			else
			{
				return false;
			}
		}
		if ($row = DB::fetch_array(DB::query("SELECT site_id, module_name, cat_id, element_id, param_id, rewrite FROM {rewrite} WHERE trash='0' AND rewrite='%h' LIMIT 1", $rewrite)))
		{
			return $row;
		}
		return false;
	}

	/**
	 * Заменяет ссылки на идентификаторы
	 *
	 * @param string $text исходный текст
	 * @return string
	 */
	public function replace_link_to_id($text)
	{
		if (!$text)
		{
			return $text;
		}
		if(preg_match_all('/href\=\"('.str_replace('/', '\\/', BASE_PATH).'|\/)([^"]+)(\/'.(ROUTE_END != '/' ? '|'.str_replace('.', '\\.', ROUTE_END) : '').')\"/', $text, $matches))
		{
			foreach($matches[0] as $i => $m)
			{
				if(isset($this->cache["replace_link"][$matches[2][$i]]))
				{
					$replace = $this->cache["replace_link"][$matches[2][$i]];
				}
				else
				{
					$replace = '';
					$lang_id = $this->diafan->language_base_site;
					foreach($this->diafan->languages as $lang)
					{
						if(preg_match('/^'.$lang["shortname"].'/', $matches[2][$i]))
						{
							$lang_id = $lang["id"];
							$matches[2][$i] = preg_match('/^'.$lang["shortname"].'\//', '', $matches[2][$i]);
						}
					}
					if($row = $this->diafan->_route->search($matches[2][$i]))
					{
						$replace = 'href="map:'
						.'lang_id='.$lang_id.';'
						.($row["module_name"] ? 'module_name='.$row["module_name"].';' : '')
						.($row["site_id"] ? 'site_id='.$row["site_id"].';' : '')
						.($row["cat_id"] ? 'cat_id='.$row["cat_id"].';' : '')
						.($row["element_id"] ? 'element_id='.$row["element_id"].';' : '')
						.($row["param_id"] ? 'param_id='.$row["param_id"].';' : '')
						.'"';
					}
					$this->cache["replace_link"][$matches[2][$i]] = $replace;
				}
				if($replace)
				{
					$text = str_replace($m, $replace, $text);
				}
			}
		}
		$text = str_replace('src="'.BASE_PATH, 'src="BASE_PATH', $text);
		$text = str_replace('href="'.BASE_PATH, 'href="BASE_PATH', $text);
		return $text;
	}

	/**
	 * Заменяет идентификаторы ссылки на ЧПУ
	 *
	 * @param string $text исходный текст
	 * @return string
	 */
	public function replace_id_to_link($text)
	{
		if (!$text)
		{
			return $text;
		}
		if(preg_match_all('/href="map:([^"]+)"/', $text, $matches))
		{
			foreach($matches[0] as $i => $m)
			{
				if(isset($this->cache["replace_id"][$matches[1][$i]]))
				{
					$replace = $this->cache["replace_id"][$matches[1][$i]];
				}
				else
				{
					$replace = '';
					$params = array(
							"lang_id" => 0,
							"module_name" => '',
							"site_id" => 0,
							"cat_id" => 0,
							"element_id" => 0,
							"param_id" => 0,
						);
					$params_ = explode(';', $matches[1][$i]);
					foreach($params_ as $p)
					{
						if($p)
						{
							list($name, $value) = explode('=', $p);
							$params[$name] = $value;
						}
					}
					if($params["lang_id"] != $this->diafan->language_base_site)
					{
						foreach($this->diafan->languages as $lang)
						{
							if($lang["id"] == $params["lang_id"])
							{
								$replace .= $lang["shortname"].'/';
							}
						}
					}
					if($params["module_name"] == 'site')
					{
						$replace .= $this->diafan->_route->link($params["site_id"]);
					}
					else
					{
						$replace .= $this->diafan->_route->link($params["site_id"], $params["module_name"], $params["cat_id"], $params["element_id"], $params["param_id"]);
					}
					$this->cache["replace_id"][$matches[1][$i]] = $replace;
				}
				$text = str_replace($m, 'href="'.BASE_PATH.$replace.'"', $text);
			}
		}
		$text = str_replace('src="BASE_PATH', 'src="'.BASE_PATH, $text);
		$text = str_replace('href="BASE_PATH', 'href="'.BASE_PATH, $text);
		return $text;
	}

	/**
	 * Получает ЧПУ по тегу
	 *
	 * @param string $module_name модуль
	 * @param integer $id номер элемента
	 * @param string $tag тег
	 * @return boolean true
	 */
	private function get_rewrite($module_name, $id, $tag = "")
	{
		if ((! IS_ADMIN || ! $this->diafan->save) &&  isset($this->cache["rewrites"][$module_name.'_'.$tag.$id]))
		{
			return $this->cache["rewrites"][$module_name.'_'.$tag.$id];
		}
		if ($module_name == 'site')
		{
			$where = "site_id=%d";
		}
		else
		{
			switch($tag)
			{
				case 'param':
					$where = "param_id=%d";
					break;
				case 'cat':
					$where = "cat_id=%d";
					break;
				default:
					$where = "element_id=%d";
					break;
			}
		}
		$this->cache["rewrites"][$module_name.'_'.$tag.$id] = DB::query_result("SELECT rewrite FROM {rewrite} WHERE trash='0' AND module_name='%h' AND ".$where." LIMIT 1", $module_name, $id);

		return $this->cache["rewrites"][$module_name.'_'.$tag.$id];
	}
}