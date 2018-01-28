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
	include dirname(dirname(dirname(dirname(__FILE__)))).'/includes/404.php';
}

/**
 * Forum_message_inc
 *
 * Работа с сообщениями в модулей "Форум"
 */
class Forum_message_inc extends Model
{
	/**
	 * @var object основной объект системы
	 */
	protected $diafan;

	/**
	 * @var array сгенерированные в моделе данные, передаваемые в шаблон
	 */
	protected $result;

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
	}

	/**
	 * Генерирует список сообщений и форму добавления сообщений
	 * 
	 * @param integer $element_id номер категории форума
	 * @return string
	 */
	public function show($element_id = 0)
	{
		if (! $element_id)
		{
			$element_id = $this->diafan->show;
		}
		$this->result["close"] = DB::query_result("SELECT close FROM {forum_category} WHERE id=%d LIMIT 1", $element_id);
		$this->result["hash"]          = $this->diafan->_user->get_hash();

		$result = DB::query("SELECT * FROM {forum} WHERE cat_id='%d' AND trash='0'"
		                    .(! $this->moderator
		                      ? " AND (act='1' OR author=".$this->diafan->_user->id.")"
		                        ." AND (del='0' OR author=".$this->diafan->_user->id.")"
		                      : '')
		                    ." ORDER BY created ASC", $element_id);
		$rows = array();
		$count = DB::num_rows($result);
		while ($row = DB::fetch_array($result))
		{
			$row["access_edit_delete"] = $this->diafan->_user->id
			                             && ($row["author"] == $this->diafan->_user->id || $this->moderator)
			                             && ! $this->result["close"] ? true : false;
			$row["access_block"]       = $this->moderator ? true : false;
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
			if($row["author"])
			{
				$row["author"] = $this->get_author($row["author"]);
			}
			else
			{
				$row["author"] = $row["name"];
			}
			if ($row["del"])
			{
				$row["text"] = $this->diafan->short_text($row["text"], 50);
			}

			$row["attachments"] = array();
			if ($this->diafan->configmodules("attachments"))
			{
				$row["attachments"]["rows"] = $this->diafan->_attachments->get($row["id"], 'forum');
				$row["attachments"]["access"] = $row["access_edit_delete"];
				$row["attachments"]["use_animation"] = $this->diafan->configmodules("use_animation", "forum");
			}

			if ($this->diafan->_user->id)
			{
				if ($row["show"] = DB::query_result("SELECT id FROM {forum_show} WHERE element_id='%d' AND table_name='forum'"
				                                   ." AND user_id=%d LIMIT 1", $row["id"], $this->diafan->_user->id))
				{
					DB::query("DELETE FROM {forum_show} WHERE user_id=%d AND element_id=%d AND table_name='forum'", $this->diafan->_user->id, $row["id"]);
				}
			}
			else
			{
				$row["show"] = false;
			}
			$row["form"] = $this->get_form($count, $row["id"]);
			$row["hash"] = $this->result["hash"];
			$rows[$row["parent_id"]][] = $row;
		}
		$this->result["form"] = $this->get_form($count);

		if ($this->diafan->_user->id)
		{
			DB::query("DELETE FROM {forum_show} WHERE user_id=%d AND element_id=%d AND table_name='forum_category'", $this->diafan->_user->id, $element_id);
		}
		$this->result["rows"]          = $this->build_tree($rows);

		$text = $this->diafan->_tpl->get('get', 'forum_message', $this->result);

		return $text;
	}

	/**
	 * Формирует дерево сообщений из полученного массива
	 *
	 * @param array $rows все сообщения
	 * @param integer $parent_id номер текущего сообщения-родителя
	 * @param integer $level уровень
	 * @return string
	 */
	private function build_tree($rows, $parent_id = 0, $level = 1)
	{
		$result = array();
		$count_level = $this->diafan->configmodules("count_level", "forum");

		if($count_level && $level > $count_level)
			return $result;

		if (! empty($rows[$parent_id]))
		{
			foreach ($rows[$parent_id] as $row)
			{
				$row["children"] = $this->build_tree($rows, $row["id"], $level+1);
				if($level == $count_level)
				{
					$row["form"] = false;
				}
				$result[] = $row;
			}
		}
		return $result;
	}
	
	/*
	 * Формирует данные для формы
	 * 
	 * @param integer $count количество сообщений
	 * @param integer $parent_id номер сообщения-родителя
	 * @return array
	 */
	public function get_form($count, $parent_id = 0)
	{
		if($this->diafan->configmodules("max_count", "forum") && $this->diafan->configmodules("max_count", "forum") <= $count)
		{
			return false;
		}
		if ($this->diafan->configmodules('only_user', 'forum') && ! $this->diafan->_user->id || $this->result["close"])
		{
			return false;
		}
		$form["field_name"] = $this->diafan->_user->id ? false : true;
		$form["parent_id"] = $parent_id;
		$form["captcha"] = '';
		if ($this->diafan->configmodules('captcha', 'forum'))
		{
			$form["captcha"] = $this->diafan->_captcha->get("forum_message".$parent_id, $this->get_error("forum_message".$parent_id, "captcha"));
		}
		$form["premoderation"]     = $this->diafan->configmodules('premoderation_message', "forum") && ! $this->moderator;
		$form["hash"]              = $this->result["hash"] ? $this->result["hash"] : $this->diafan->_user->get_hash();
		$form["error"]             = $this->get_error("forum_messages".$parent_id);
		$form["error_message"]     = $this->get_error("forum_messages".$parent_id, 'message');
		$form["error_name"]        = $this->get_error("forum_messages".$parent_id, 'name');
		$form["error_attachments"] = $this->get_error("forum_messages".$parent_id, 'attachments');
		if ($this->diafan->configmodules("attachments", "forum"))
		{
			$form["add_attachments"]       = true;
			$form["max_count_attachments"] = $this->diafan->configmodules("max_count_attachments", "forum");
			$form["attachment_extensions"] = $this->diafan->configmodules("attachment_extensions", "forum");
		}
		else
		{
			$form["add_attachments"] = false;
		}
		return $form;
	}

	/**
	 * Генерирует данные о количестве сообщений в категории форума
	 * 
	 * @param integer $element_id номер категории форума
	 * @return integer
	 */
	public function count($element_id = 0)
	{
		if (!$element_id)
		{
			$element_id = $this->diafan->show;
		}

		$count = DB::query_result("SELECT COUNT(id) FROM {forum} WHERE cat_id='%d' AND trash='0'"
		                          .(! $this->moderator
		                            ? " AND (act='1' OR author=".$this->diafan->_user->id.")"
		                              ." AND (del='0' OR author=".$this->diafan->_user->id.")"
		                            : ''), $element_id);
		if ($count)
		{
			$count--;
		}
		return $count;
	}

	/**
	 * Генерирует данные о количестве новых сообщений в категории форума
	 * 
	 * @param integer $element_id номер категории форума
	 * @param boolean $parent является ли категория форума каталогом для тем
	 * @return integer
	 */
	public function count_new($element_id = 0, $parent = false)
	{
		if (! $element_id)
		{
			$element_id = $this->diafan->show;
		}

		$count = DB::query_result("SELECT COUNT(m.id) FROM {forum} as m"
		                          ." INNER JOIN {forum_show} as n ON n.element_id=m.id"
		                          .($parent ? " INNER JOIN {forum_category} as c ON c.id=m.cat_id" : '')
		                          ." WHERE n.user_id=%d AND n.table_name='forum' AND m.trash='0'"
		                          .($parent ? " AND (c.id='".$element_id."' OR c.parent_id='".$element_id."')" : " AND m.cat_id='".$element_id."'")
		                          .(! $this->moderator
		                            ? " AND (m.act='1' OR m.author=".$this->diafan->_user->id.")"
		                              ." AND (m.del='0' OR m.author=".$this->diafan->_user->id.")"
		                            : ''),
		                          $this->diafan->_user->id);
		if ($count)
		{
			$count--;
		}
		return $count;
	}

	/**
	 * Генерирует данные о последнем пользователе, написавшем в категории форума
	 * 
	 * @param integer $element_id номер категории форума
	 * @return string
	 */
	public function last_user($element_id = 0)
	{
		if (! $element_id)
		{
			$element_id = $this->diafan->show;
		}

		$row = DB::fetch_array(DB::query("SELECT created, author FROM {forum} WHERE cat_id='%d' AND trash='0'"
		                                 .(! $this->moderator
		                                   ? " AND (act='1' OR author=".$this->diafan->_user->id.")"
		                                   ." AND (del='0' OR author=".$this->diafan->_user->id.")"
		                                   : '')
		                                 ." ORDER BY created DESC LIMIT 1", $element_id));
		if (! $row)
			return '';

		$this->result["author"]  = $this->get_author($row["author"]);
		$this->result["created"] = $this->format_date($row["created"]);
		return $this->result;
	}

	/**
	 * Удаляет сообщения, прикрепленные к категории форума
	 *
	 * @param integer $element_id номер категории форума
	 * @return boolean true
	 */
	public function delete($element_id = 0)
	{
		if (! $element_id)
		{
			$element_id = $this->diafan->del;
		}

		$result = DB::query("SELECT id FROM {forum} WHERE cat_id='%d'", $element_id);
		while ($row = DB::fetch_array($result))
		{
			$this->diafan->attachments->delete($row["id"], "forum");
			DB::query("DELETE FROM {forum_show} WHERE element_id=%d AND table_name='forum'", $row["id"]);
		}
		DB::query("DELETE FROM {forum} WHERE cat_id='%d'", $element_id);

		return true;
	}
}