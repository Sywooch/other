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
 * Forum_model
 *
 * Модель модуля "Форум"
 */
class Forum_model extends Model
{
	/**
	 * @var array сгенерированные в моделе данные, передаваемые в шаблон
	 */
	protected $result;

	/**
	 * @var object основной объект системы
	 */
	protected $diafan;

	/**
	 * @var object работа с сообщениями
	 */
	protected $message;

	/**
	 * @var boolean пользователь является модератором
	 */
	private $moderator;

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct(&$diafan)
	{
		$this->diafan = &$diafan;
		
		$this->moderator = $this->diafan->_user->roles('moderator', 'forum', '', 'site');

		Customization::inc('modules/forum/message/message.inc.php');
		$this->message = new Forum_message_inc($diafan);
	}

	/**
	 * Первая страница форума
	 * 
	 * @return array
	 */
	public function first_page()
	{
		$this->result["access_add"] = ! $this->diafan->configmodules("only_user") || $this->diafan->_user->id;
		$this->result["cats"] = array();

		$result_cat = DB::query("SELECT name, id FROM {forum_category} WHERE trash='0'"
					.(! $this->moderator
					  ? " AND (act='1' OR author=".$this->diafan->_user->id.")"
					    ." AND (del='0' OR author=".$this->diafan->_user->id.")"
					  : '')
					." AND parent_id=0"
					." ORDER BY prior DESC, message_update DESC, created DESC");

		while ($cat = DB::fetch_array($result_cat))
		{
			$cat["rows"] = array();
			
			$result = DB::query("SELECT * FROM {forum_category} WHERE trash='0' AND act='1' AND del='0' AND parent_id=".$cat["id"]
					    ." ORDER BY prior DESC, message_update DESC, created DESC");
	
			while ($row = DB::fetch_array($result))
			{
				$row["count_caregory"] = DB::query_result("SELECT COUNT(*) FROM {forum_category} WHERE parent_id=%d AND trash='0'"
									  ." AND act='1' AND del='0'", $row["id"]);
				$row["theme_news"] = 0;
				if ($this->diafan->_user->id)
				{
					$row["theme_news"] = DB::query_result("SELECT COUNT(s.id) FROM {forum_show} as s"
							     ." INNER JOIN {forum_category} as c ON c.id=s.element_id AND"
							     ." (c.id=%d OR c.parent_id=%d) WHERE s.user_id=%d"
							     ." AND s.table_name='forum_category' AND c.trash='0' AND c.act='1' AND c.del='0'", $row["id"], $row["id"], $this->diafan->_user->id);
					if (! $row["theme_news"])
					{
						$row["theme_news"] = DB::query_result("SELECT COUNT(s.id) FROM {forum_show} as s"
								     ." INNER JOIN {forum_category} as c ON c.parent_id=%d"
								     ." INNER JOIN {forum} as f ON f.cat_id=c.id"
								     ." WHERE s.user_id=%d AND s.element_id=f.id AND c.trash='0' AND c.act='1' AND c.del='0'"
								     ." AND f.trash='0' AND f.act='1' AND f.del='0'"
								     ." AND s.table_name='forum'", $row["id"], $this->diafan->_user->id);
					}
				}
	
				$row["last_theme"] = DB::fetch_array(DB::query("SELECT id, name, message_update, created FROM {forum_category} WHERE parent_id=%d AND trash='0'"
									       ." AND act='1' AND del='0' ORDER BY message_update DESC, created DESC LIMIT 1",
									       $row["id"]));
				if ($row["last_theme"])
				{
					$row["last_theme"]["link"] = $this->diafan->_route->link($this->diafan->cid, "forum", 0, $row["last_theme"]["id"]);
					if ($row["last_theme"]["message_update"])
					{
						$row["last_theme"]["message_update"] = $this->format_date($row["last_theme"]["message_update"]);
					}
					else
					{
						$row["last_theme"]["message_update"] = $this->format_date($row["last_theme"]["created"]);	
					}
				}

				$row["link"]   = $this->diafan->_route->link($this->diafan->cid, "forum", $row["id"]);
				$cat["rows"][] = $row;
			}
			$this->result["cats"][] = $cat;
		}
		if ($this->diafan->_user->id)
		{
			$this->result["new_message"] = DB::query_result("SELECT COUNT(DISTINCT element_id) FROM {forum_show} WHERE table_name='forum' AND user_id=%d", $this->diafan->_user->id);
		}
		$this->result["action"] = $this->diafan->_route->link($this->diafan->cid);

		return $this->result;
	}

	/**
	 * Генерирует список категорий форума
	 * 
	 * @return array
	 */
	public function list_category()
	{
		$row = DB::fetch_array(DB::query("SELECT parent_id, name FROM {forum_category} WHERE id=%d AND trash='0' AND act='1' AND del='0' LIMIT 1",
						 $this->diafan->cat));

		if (empty($row) || ! $row["parent_id"])
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		if (DB::query_result("SELECT parent_id FROM {forum_category} WHERE id=%d LIMIT 1", $row["parent_id"]))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		if(empty($_SESSION["forum_view"][$this->diafan->cat]))
		{
			$_SESSION["forum_view"][$this->diafan->cat] = true;
			DB::query("UPDATE {forum_category} SET counter_view=counter_view+1 WHERE id=%d", $this->diafan->cat);
		}
		$this->diafan->titlemodule = $row["name"];

		////navigation//
		$this->diafan->_paginator->page    = $this->diafan->page;
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->nen = DB::query_result("SELECT COUNT(*) FROM {forum_category} WHERE trash='0'"
								  .(! $this->moderator
								    ? " AND (act='1' OR author=".$this->diafan->_user->id.")"
								      ." AND (del='0' OR author=".$this->diafan->_user->id.")"
								    : '')
								  ." AND parent_id=%d", $this->diafan->cat
								 );
		$links = $this->diafan->_paginator->get();
		////navigation///

		$result = DB::query_range("SELECT * FROM {forum_category} WHERE trash='0'"
					 .(! $this->moderator
					   ? " AND (act='1' OR author=".$this->diafan->_user->id.")"
					     ." AND (del='0' OR author=".$this->diafan->_user->id.")"
					   : '')
					 ." AND parent_id=%d"
					 ." ORDER BY prior DESC, message_update DESC, created DESC",
					 $this->diafan->cat, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);

		$this->result["access_add"] = ! $this->diafan->configmodules("only_user") || $this->diafan->_user->id;
		$this->result["link_add"] = $this->diafan->_route->link($this->diafan->cid, "forum", $this->diafan->cat).'add1/';
		$this->result["rows"] = array();

		while ($row = DB::fetch_array($result))
		{
			$this->result["rows"][] = $this->list_id_category($row);
		}

		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid), "name" => $this->diafan->name);

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $links);
		$this->result["hash"]      = $this->diafan->_user->get_hash();
		$this->result["action"]    = $this->diafan->_route->link($this->diafan->cid);
		return $this->result;
	}

	/**
	 * Генерирует данные о теме форума
	 *
	 * @param array $row исходные данные о теме форума
	 * @return array
	 */
	public function list_id_category($row)
	{
		$row["access_edit_delete"] = ! $row["del"] && $this->diafan->_user->id && ($row["author"] == $this->diafan->_user->id || $this->moderator) ? true : false;
		$row["access_block"] = (! $row["del"] && $this->moderator) ? true : false;
		$row["created"] = $this->format_date($row["created"]);
		if ($row["date_update"])
		{
			$row["date_update"] = $this->format_date($row["date_update"]);
		}
		if($row["user_update"] == $row["author"] || ! $row["user_update"])
		{
			$row["user_update"] = 0;
		}
		else
		{
			$row["user_update"] = $this->get_author($row["user_update"]);
		}
		$row["author"]        = $this->get_author($row["author"]);
		$row["name"]          = $this->diafan->short_text($row["name"], 300);

		$row["messages"]      = $this->message->count($row["id"]);
		$row["messages_new"]  = $this->message->count_new($row["id"]);

		$row["theme_news"] = 0;
		if ($this->diafan->_user->id)
		{
			$row["theme_news"] = DB::query_result("SELECT COUNT(*) FROM {forum_show} WHERE user_id=%d AND element_id=%d AND table_name='forum_category'", $this->diafan->_user->id, $row["id"]);
			if (! $row["theme_news"])
			{
				$row["theme_news"] = DB::query_result("SELECT COUNT(s.id) FROM {forum_show} as s INNER JOIN {forum} as f ON s.element_id=f.id"
								      ." WHERE s.user_id=%d AND s.table_name='forum' AND f.cat_id=%d"
								      ." AND f.trash='0' AND f.act='1' AND f.del='0'",
								      $this->diafan->_user->id, $row["id"]);
			}
		}

		$row["last_user"] = $this->message->last_user($row["id"]);

		$row["link"]       = $this->diafan->_route->link($this->diafan->cid, "forum", 0, $row["id"]);
		$row["link_edit"]  = $this->diafan->_route->link($this->diafan->cid, "forum").'edit'.$row["id"].'/';
		return $row;
	}

	/**
	 * Генерирует список найденных сообщений
	 * 
	 * @return array
	 */
	public function list_search()
	{
		$search = '';
		if (isset($_GET["searchword"]))
		{
			if (is_array($_GET["searchword"]))
			{
				$_GET["searchword"] = '';
			}
			$search = DB::escape_string(htmlspecialchars(stripslashes($_GET["searchword"])));
		}
		$this->result["value"] = $search;

		////navigation//
		$this->diafan->_paginator->page    = $this->diafan->page;
		$this->diafan->_paginator->get_nav = '?searchword='.$search;
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->nen = DB::query_result("SELECT COUNT(*) FROM {forum} WHERE trash='0'"
								  ." AND act='1' AND del='0' AND text LIKE '%%%h%%'", $search);

		$this->diafan->_paginator->nen += DB::query_result("SELECT COUNT(*) FROM {forum_category} WHERE trash='0'"
								   ." AND act='1' AND del='0' AND parent_id > 0 AND name LIKE '%%%h%%'", $search);
		$links = $this->diafan->_paginator->get();
		////navigation///

		$result = DB::query_range("SELECT id, created, date_update, author, '' as name, text, cat_id, 'message' as type FROM {forum} WHERE trash='0'"
					  ." AND act='1' AND del='0' AND text LIKE '%%%h%%'"
					  ." UNION SELECT id, created, message_update as date_update, author, name, '' as text, '' as cat_id, 'category' as type FROM {forum_category} WHERE trash='0'"
					  ." AND act='1' AND del='0' AND parent_id > 0 AND name LIKE '%%%h%%'"
					  ." ORDER BY created DESC",
					  $search, $search, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);

		$this->result["rows"] = array();
		$this->result["count-page"] = DB::num_rows($result);

		while ($row = DB::fetch_array($result))
		{
			if ($row["date_update"])
			{
				$row["created"] = $this->format_date($row["date_update"]);
			}
			else
			{
				$row["created"] = $this->format_date($row["created"]);
			}
			
			$row["author"] = $this->get_author($row["author"]);

			if ($row["type"] == "message")
			{
				if (empty($themes[$row["cat_id"]]))
				{
					$themes[$row["cat_id"]] = DB::query_result("SELECT name FROM {forum_category} WHERE id=%d LIMIT 1", $row["cat_id"]);
				}
				$row["theme"] = $themes[$row["cat_id"]];
				$row["link"]  = $this->diafan->_route->link($this->diafan->cid, "forum", 0, $row["cat_id"]).'#'.$row["id"];
			}
			else
			{
				$row["theme"] = $row["name"];
				$row["link"]  = $this->diafan->_route->link($this->diafan->cid, "forum", 0, $row["id"]);
			}

			$this->result["rows"][] = $row;
		}
		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid), "name" => $this->diafan->name);

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $links);
		$this->result["count"]     = $this->diafan->_paginator->nen;
		$this->result["action"]    = $this->diafan->_route->link($this->diafan->cid);

		return $this->result;
	}

	/**
	 * Генерирует список новых сообщений
	 * 
	 * @return array
	 */
	public function list_new()
	{
		////navigation//
		$this->diafan->_paginator->page    = $this->diafan->page;
		$this->diafan->_paginator->get_nav = '?new=1';
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->nen =
		DB::query_result("SELECT COUNT(*) FROM {forum} as f INNER JOIN {forum_show} AS s ON s.element_id=f.id"
				 ." WHERE f.trash='0' AND f.act='1' AND f.del='0' AND s.table_name='forum' AND s.user_id=%d", $this->diafan->_user->id);

		$links = $this->diafan->_paginator->get();
		////navigation///
		$this->diafan->titlemodule = $this->diafan->_('Непрочитанные сообщения', false);

		$result = DB::query_range("SELECT f.id, f.created, f.date_update, f.author, f.text, f.cat_id FROM {forum} as f"
					  ." INNER JOIN {forum_show} AS s ON s.element_id=f.id"
					  ." WHERE f.trash='0' AND f.act='1' AND f.del='0' AND s.table_name='forum' AND s.user_id=%d"
					  ." ORDER BY created DESC",
					  $this->diafan->_user->id, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr
		);

		$this->result["rows"] = array();

		while ($row = DB::fetch_array($result))
		{
			if ($row["date_update"])
			{
				$row["created"] = $this->format_date($row["date_update"]);
			}
			else
			{
				$row["created"] = $this->format_date($row["created"]);
			}
			
			$row["author"] = $this->get_author($row["author"]);

			if (empty($themes[$row["cat_id"]]))
			{
				$themes[$row["cat_id"]] = DB::query_result("SELECT name FROM {forum_category} WHERE id=%d LIMIT 1", $row["cat_id"]);
			}
			$row["theme"] = $themes[$row["cat_id"]];
			$row["link"]  = $this->diafan->_route->link($this->diafan->cid, "forum", 0, $row["cat_id"]).'#'.$row["id"];

			$this->result["rows"][] = $row;
		}
		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid), "name" => $this->diafan->name);

		$this->result["paginator"] = $this->diafan->_tpl->get('get', 'paginator', $links);
		$this->result["count"]     = $this->diafan->_paginator->nen;
		$this->result["action"]    = $this->diafan->_route->link($this->diafan->cid);

		return $this->result;
	}

	/**
	 * Генерирует страницу категории форума
	 * 
	 * @return array
	 */
	public function id()
	{
		$row = DB::fetch_array(DB::query("SELECT id, name, author, created, date_update, parent_id FROM {forum_category}"
						 ." WHERE id=%d AND act='1' AND del='0' AND trash='0' LIMIT 1", $this->diafan->show));
		if (empty($row))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		$parent = DB::fetch_array(DB::query("SELECT name FROM {forum_category} WHERE id=%d AND act='1' AND del='0' AND trash='0' AND parent_id<>0 LIMIT 1", $row["parent_id"]));
		if (empty($parent))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$this->diafan->access = $this->diafan->_user->id == $row["author"];

		$row["created"] = $this->format_date($row["created"], $row["date_update"]);
		$row["author"]  = $this->get_author($row["author"]);
		$this->result   = $row;

		$this->result["messages"] = $this->message->show();
		if(empty($_SESSION["forum_view"][$row["id"]]))
		{
			$_SESSION["forum_view"][$row["id"]] = true;
			DB::query("UPDATE {forum_category} SET counter_view=counter_view+1 WHERE id=%d", $row["id"]);
		}

		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid), "name" => $this->diafan->name);
		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid, "forum", $row["parent_id"]), "name" => $parent["name"]);
		$this->diafan->titlemodule = $row["name"];
		$this->diafan->cat = $row["parent_id"];

		return $this->result;
	}

	/**
	 * Генерирует страницу редактирования категории форума
	 * 
	 * @return array
	 */
	public function edit()
	{
		//редактирование разрешено только пользователям:
		if (! $this->diafan->_user->id)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$row = DB::fetch_array(DB::query("SELECT name, author, parent_id, act FROM {forum_category} WHERE id = %d AND del='0' AND trash='0' LIMIT 1", $this->diafan->edit));

		//автору или модератору
		if (empty($row) || ! $this->moderator && ($row["author"] != $this->diafan->_user->id || ! $row["act"]))
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$this->result = $row;
		$this->result["action"]  = 'save-category';
		$this->result["id"]      = $this->diafan->edit;
		$this->result["hash"]    = $this->diafan->_user->get_hash();
		$this->result["captcha"] = '';
		$this->result["premoderation"] = $this->diafan->configmodules('premoderation_theme') && ! $this->moderator;
		$this->result["error"] = $this->get_error("forum");
		$this->result["error_name"] = $this->get_error("forum", 'name');
		$parent_name = DB::title("forum_category", $row["parent_id"], "name");

		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid), "name" => $this->diafan->name);
		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid, "forum", $row["parent_id"]), "name" => $parent_name);
		$this->diafan->titlemodule = $this->diafan->_('редакция', false).': '.$row["name"];

		return $this->result;
	}

	/**
	 * Генерирует страницу добавления категории форума
	 * 
	 * @return array
	 */
	public function add()
	{
		if (! $this->diafan->cat)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		$this->result["name"]   = '';
		$this->result["action"] = 'savenew-category';
		$this->result["id"]     = '';
		$this->result["parent_id"] = $this->diafan->cat;
		$this->result["hash"]      = $this->diafan->_user->get_hash();

		$this->result["premoderation"] = $this->diafan->configmodules('premoderation_theme') && ! $this->moderator;
		$this->result["captcha"] = '';

		//доступ на добавление только для зарегистрированных
		if ($this->diafan->configmodules("only_user") && !$this->diafan->_user->id)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		//доступ на добавление по каптче
		elseif ($this->diafan->configmodules("captcha") && !$this->diafan->_user->id)
		{
			$this->result["captcha"] = $this->diafan->_captcha->get("forum", $this->get_error("forum", "captcha"));
		}
		$this->result["error"] = $this->get_error("forum");
		$this->result["error_name"] = $this->get_error("forum", 'name');
		$parent_name = DB::title("forum_category", $this->diafan->cat, "name");

		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid), "name" => $this->diafan->name);
		$this->diafan->path[] = array("link" => $this->diafan->_route->link($this->diafan->cid, "forum", $this->diafan->cat), "name" => $parent_name);
		$this->diafan->name = $this->diafan->_('Новая тема для обсуждения', false);

		return $this->result;
	}

	/**
	 * Шаблонная функция: блок тем
	 *
	 * @param integer $count количество тем
	 * @param string $cat_id категория
	 * @return array
	 */
	public function show_block($count, $cat_id)
	{
		if(! $site_id = $this->diafan->_route->id_module("forum", 0, false))
		{
			return false;
		}

		if($cat_id)
		{
			$cats = array();
			// если указан раздел первого уровня, то ищем во всех категориях
			if(! DB::query_result("SELECT parent_id FROM {forum_category} WHERE trash='0' AND act='1' AND id=%d LIMIT 1", $cat_id))
			{
				$result = DB::query("SELECT id FROM {forum_category} WHERE parent_id=%d AND trash='0' AND act='1'", $cat_id);
				while($row = DB::fetch_array($result))
				{
					$cats[] = $row["id"];
				}
				$cats = implode(",", $cats);
			}
			else
			{
				$cats = $cat_id;
			}
		}
		else
		{
			$cats = DB::query_result(
					"SELECT GROUP_CONCAT(c.id SEPARATOR ',') FROM {forum_category} as c"
					." INNER JOIN {forum_category} as p ON p.parent_id=0 AND p.id=c.parent_id"
					." WHERE c.trash='0' AND c.act='1' AND c.del='0'"
				);
		}

		$result = DB::query_range(
				"SELECT id, name, parent_id FROM {forum_category} WHERE trash='0' AND act='1' AND del='0'"
				.($cats ? " AND parent_id IN (".$cats.")" : '')
				." ORDER BY message_update DESC, created DESC",
				0, $count
			);

		$this->result["rows"] = array();

		while ($row = DB::fetch_array($result))
		{
			$row["link"] = $this->diafan->_route->link($site_id, "forum", 0, $row["id"]);
			$this->result["rows"][] = $row;
		}
		return $this->result;
	}

	/**
	 * Шаблонная функция: блок похожих тем
	 *
	 * @param integer $count количество тем
	 * @param string $cat_id искать в текущей категории(current) или по всему форуму(all)
	 * @return array
	 */
	public function show_block_rel($count, $cat_id)
	{
		if($this->diafan->titlemodule)
		{
			$title = $this->diafan->titlemodule;
		}
		else
		{
			$title = $this->diafan->name;
		}

		$names = $this->diafan->_search->prepare($title);
		if(empty($names))
		{
			return false;
		}
		if($cat_id == "all")
		{
			$parents = DB::query_result(
					"SELECT GROUP_CONCAT(c.id SEPARATOR ',') FROM {forum_category} as c"
					." INNER JOIN {forum_category} as p ON p.parent_id=0 AND p.id=c.parent_id"
					." WHERE c.trash='0' AND c.act='1' AND c.del='0'"
				);
		}

		$where = "";
		foreach($names as $name)
		{
			$where .= ($where ? " OR ": "")."name LIKE '%%".$name."%%'";
		}

		$result = DB::query_range(
				"SELECT id, name, parent_id FROM {forum_category} WHERE trash='0' AND act='1' AND del='0'"
				.($cat_id == "current" ? " AND parent_id=".$this->diafan->cat : ' AND parent_id IN ('.$parents.')')
				." AND id<>%d"
				." AND (".$where.")"
				." ORDER BY message_update DESC, created DESC",
				$this->diafan->show, 0, $count
			);

		$this->result["rows"] = array();

		while ($row = DB::fetch_array($result))
		{
			$row["link"] = $this->diafan->_route->link($this->diafan->cid, "forum", 0, $row["id"]);
			$this->result["rows"][] = $row;
		}
		return $this->result;
	}

	/**
	 * Сохраняет историю изменений для пользователей
	 * 
	 * @return array
	 */
	private function save_news($save)
	{
		$result = DB::query("SELECT id FROM {users} WHERE act='1' AND trash='0' AND id<>'%d'", $this->diafan->_user->id);
		while ($row = DB::fetch_array($result))
		{
			DB::query("INSERT INTO {forum_show} (element_id, user_id, table_name, created) VALUES ('%d', '%d', 'forum_category', %d)", $save, $row["id"], time());
		}
	}
}