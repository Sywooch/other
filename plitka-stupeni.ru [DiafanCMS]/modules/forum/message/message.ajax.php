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
 * Forum_message_ajax
 *
 * Обработка Ajax-запроса
 */
class Forum_message_ajax extends Ajax
{
	/**
	 * @var array
	 */
	private $config;

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
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		$this->module = 'forum';
		$this->tag = 'forum_message';
		if (! $this->diafan->_user->id && $this->diafan->configmodules("only_user", "forum"))
		{
			return false;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();
		if (! empty($_POST["action"]))
		{
			if ($_POST["action"] == "upload_message")
			{
				return $this->upload_message();
			}
			elseif ($_POST["action"] == "save_message")
			{
				return $this->save_message();
			}
			elseif ($_POST["action"] == "delete_message")
			{
				return $this->delete_message();
			}
			elseif ($_POST["action"] == "edit_message")
			{
				return $this->edit_message();
			}
			elseif ($_POST["action"] == "block_message")
			{
				return $this->block_message();
			}
			elseif ($_POST["action"] == "delete_attachment")
			{
				return $this->delete_attachment();
			}
		}
		return false;
	}

	/**
	 * Добавляет новое сообщение
	 *
	 * @return boolean
	 */
	private function upload_message()
	{
		$element_id = $this->diafan->show;

		//доступ на добавление только для зарегистрированных
		if ($this->diafan->configmodules("only_user", "forum") && ! $this->diafan->_user->id)
		{
			$this->result["errors"][0] = $this->diafan->_('Добавлять сообщения могут только зарегистрированные пользователи!', false);
			return $this->send_errors();
		}

		$parent_id = $this->diafan->get_param($_POST, "parent_id", 0, 2);
		if ($parent_id && ! DB::query_result("SELECT id FROM {forum} WHERE id=%d AND trash='0' AND act='1' LIMIT 1", $parent_id))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();	
		}
		
		$count = 0;
		if ($this->diafan->configmodules("max_count", "forum"))
		{
			$count = DB::query_result("SELECT COUNT(*) FROM {forum} WHERE trash='0' AND act='1' AND cat_id=%d", $element_id);

			if($this->diafan->configmodules("max_count", "forum") <= $count)
			{
				$this->result["form_hide"] = true;
				$this->result["target_hide"] = ".forum_message_show_form, .forum_message_block_form";
				$this->result["errors"][0] = $this->diafan->_('Максимально допустимое количество сообщений превышено', false);
				return $this->send_errors();
			}
			if($this->diafan->configmodules("max_count", "forum") == $count + 1)
			{
				$this->result["form_hide"] = true;
				$this->result["target_hide"] = ".forum_message_show_form, .forum_message_block_form, #forum_messages";
			}
		}

		$this->tag = "forum_message".$parent_id;

		$this->check_captcha();

		if ($this->send_errors())
			return true;

		if (! DB::query_result("SELECT id FROM {forum_category} WHERE id=%d AND act='1' AND trash='0' LIMIT 1", $this->diafan->show))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		//тема закрыта
		if (DB::query_result("SELECT close FROM {forum_category} WHERE id=%d LIMIT 1", $this->diafan->show))
		{
			$this->result["errors"][0] = $this->diafan->_('Тема закрыта', false);
			return $this->send_errors();
		}
		if (! $_POST["message"])
		{
			$this->result["errors"][0] = $this->diafan->_('Вы не можете добавить пустое сообщение', false);
			return $this->send_errors();
		}
		//максимальное количество уровней вложенности
		if($parent_id)
		{
			$parents = $this->diafan->get_parents($parent_id, "forum");
			$level = count($parents) + 2;
		}
		else
		{
			$parents = array();
			$level = 1;
		}
		if ($this->diafan->configmodules("count_level", "forum") && $level > $this->diafan->configmodules("count_level", "forum"))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();	
		}

		$message = $this->diafan->_bbcode->replace($_POST["message"]);
		if (empty($_POST["message"]))
		{
			$this->result["errors"][0] = $this->diafan->_('Вы не можете добавить пустое сообщение', false);
			return $this->send_errors();
		}
		if (! $this->diafan->_user->id && empty($_POST['name']))
		{
			$this->result["errors"]["name"] = $this->diafan->_('Пожалуйста, введите имя', false);
			return $this->send_errors();
		}

		if (DB::query("INSERT INTO {forum} (created, name, cat_id, author, text, parent_id, act) VALUES (%d, '%h', %d, %d, '%s', %d, '%d')",
		             time(),
					 $this->diafan->_user->id ? '' : $_POST['name'],
		             $element_id,
		             $this->diafan->_user->id,
		             $message,
		             $parent_id,
		             $this->diafan->configmodules('premoderation_message', "forum") && ! $this->moderator ? 0 : 1
		            )
		   )
		{
			$result["id"] = DB::last_id("forum");
			if ($parent_id)
			{
				$parents[] = $parent_id;
				foreach ($parents as $p_id)
				{
					DB::query("INSERT INTO {forum_parents} (element_id, parent_id) VALUES (%d, %d)", $result["id"], $p_id);
					DB::query("UPDATE {forum} SET count_children=count_children+1 WHERE id=%d", $p_id);
				}
			}
			if ($this->diafan->configmodules("attachments", "forum"))
			{
				$config = array('site_id' => $this->diafan->cid, 'type' => 'configmodules');
				$result_upload = $this->diafan->_attachments->save($result["id"], 'forum', $config);
				if ($result_upload != 'empty' && $result_upload != 'success')
				{
					$this->result["errors"]['attachments'] = $result_upload;
					return $this->send_errors();
				}
			}
			$this->save_news($result["id"]);
			DB::query("UPDATE {forum_category} SET message_update='%d' WHERE id=%d", time(), $element_id);

			$result['created']            = $this->diafan->_('добавлено', false);
			$result["author"]             = $this->diafan->_user->id ? $this->get_author($this->diafan->_user->id) : strip_tags($_POST['name']);
			$result["text"]               = $message;
			$result["access_edit_delete"] = $this->diafan->_user->id ? true : false;
			$result["access_block"]       = $this->moderator ? true : false;
			$result["children"]           = array();
			$result["show"]               = 0;
			$result["act"]                = $this->diafan->configmodules('premoderation_message', "forum") && ! $this->moderator ? 0 : 1;
			$result["del"]                = 0;

			$result["attachments"] = array();
			if ($this->diafan->configmodules("attachments"))
			{
				$result["attachments"]["rows"] = $this->diafan->_attachments->get($result["id"], 'forum');
				$result["attachments"]["access"] = true;
				$result["attachments"]["use_animation"] = $this->diafan->configmodules("use_animation", "forum");
			}
			if(! $this->diafan->configmodules("count_level", "forum") || $level < $this->diafan->configmodules("count_level", "forum"))
			{
				$forum_message_inc = new Forum_message_inc($this->diafan);
				$result["form"] = empty($this->result["target"]) ? $forum_message_inc->get_form($count, $result["id"]) : false;
				$result["hash"] = $result["form"]["hash"];
			}
			else
			{
				$result["hash"] = $this->result["hash"];
				$result["form"] = false;
			}

			if(empty($this->result["target"]))
			{
				$this->result["form_hide"] = 1;
				$this->result["target_hide"]    = '.forum_message'.$parent_id.'_block_form';
			}
			$this->result["add"]       = $this->diafan->_tpl->get('id', 'forum_message', $result);
			$this->result["success"]   = 1;
			return $this->send_errors();
		}
		return false;
	}

	/**
	 * Редактирует сообщение
	 *
	 * @return boolean
	 */
	private function edit_message()
	{
		//тема закрыта
		if (DB::query_result("SELECT close FROM {forum_category} WHERE id=%d LIMIT 1", $this->diafan->show))
		{
			$this->result["errors"][0] = $this->diafan->_('Тема закрыта', false);
			return $this->send_errors();
		}

		$element_id = $this->diafan->show;
		if (! $this->diafan->_user->id)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		$row = DB::fetch_array(DB::query("SELECT author, text, name FROM {forum} WHERE cat_id=%d AND id=%d LIMIT 1", $element_id, $_POST["id"]));
		if (! $row)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		if ($this->diafan->_user->id != $row["author"] && ! $this->moderator)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		$edit_id = (int)$this->diafan->get_param($_POST, "id", '', 2);

		$result["id"]            = $edit_id;
		$result["attachments"] = array();
		if ($this->diafan->configmodules("attachments"))
		{
			$result["attachments"]["rows"] = $this->diafan->_attachments->get($result["id"], 'forum');
			$result["attachments"]["access"] = true;
			$result["attachments"]["use_animation"] = $this->diafan->configmodules("use_animation", "forum");
			$result["attachments"]["max_count_attachments"] = $this->diafan->configmodules("max_count_attachments", "forum");
			$result["attachments"]["attachment_extensions"] = $this->diafan->configmodules("attachment_extensions", "forum");
		}
		$result["name"]          = $row["name"];
		$result["field_name"]    = $row["author"] ? false : true;
		$result["text"]          = $this->diafan->_bbcode->add($row["text"]);
		$result["premoderation"] = $this->diafan->configmodules('premoderation_message', "forum") && ! $this->moderator;
		$result["access_add"]    = true;
		$result["hash"]          = $this->result["hash"];

		$this->result["data"]    = $this->diafan->_tpl->get('edit', 'forum_message', $result);
		$this->result["target"]  = ".forum_message".$edit_id;
		return $this->send_errors();
	}

	/**
	 * Сохраняет редактируемое сообщение
	 *
	 * @return boolean
	 */
	private function save_message()
	{
		//тема закрыта
		if (DB::query_result("SELECT close FROM {forum_category} WHERE id=%d LIMIT 1", $this->diafan->show))
		{
			$this->result["errors"][0] = $this->diafan->_('Тема закрыта', false);
			return $this->send_errors();
		}

		if (! $this->diafan->_user->id)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		$element_id = $this->diafan->show;

		$result = DB::fetch_array(DB::query("SELECT * FROM {forum} WHERE cat_id=%d AND id=%d LIMIT 1",
						 $element_id, $_POST["save_id"]));
		if (! $result)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		if ($this->diafan->_user->id != $result["author"] && ! $this->moderator)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		if (! $result["author"] && empty($_POST['name']))
		{
			$this->result["errors"]["name"] = $this->diafan->_('Пожалуйста, введите имя', false);
			return $this->send_errors();
		}

		$edit = 'no';
		if ($this->diafan->configmodules("attachments", "forum"))
		{
			$config = array('site_id' => $this->diafan->cid, 'type' => 'configmodules');
			$result_upload = $this->diafan->_attachments->save($result["id"], 'forum', $config);
			if ($result_upload != 'empty' && $result_upload != 'success')
			{
				$this->result["errors"]['attachments'] = $result_upload;
				return $this->send_errors();
			}
			if ($result_upload == 'success')
			{
				$edit = 'yes';
			}
		}

		if (! $_POST["message"])
		{
			$this->result["errors"][0] = $this->diafan->_('Вы не можете добавить пустое сообщение', false);
			return $this->send_errors();
		}
		$message = $this->diafan->_bbcode->replace($_POST["message"]);
		$name = $this->diafan->get_param($_POST, "name", '', 1);

		if ($edit == 'yes' || $result["text"] != $message || $result["name"] != $name)
		{
			DB::query("UPDATE {forum} SET text='%s', name='%h', date_update=%d, user_update=%d, act='%d' WHERE id=%d",
			          $message,
					  $name,
			          time(),
			          //модератор,
			          $result["author"] != $this->diafan->_user->id ? $this->diafan->_user->id : '',
			          $this->diafan->configmodules('premoderation_message', "forum") && ! $this->moderator ? 0 : 1,
			          $_POST["save_id"]
			         );
			DB::query("UPDATE {forum_category} SET message_update=%d WHERE id=%d", time(), $result["cat_id"]);
			$this->save_news($result["id"]);
		}

		$result["text"]               = $message;
		$result["access_edit_delete"] = true;
		$result["access_block"]       = $this->moderator ? 1 : 0;
		$result["act"]                = $this->diafan->configmodules('premoderation_message', "forum") && ! $this->moderator ? 0 : 1;
		$result["created"]            = $this->format_date($result["created"]);
		if ($result["date_update"])
		{
			$result["date_update"] = $this->format_date($result["date_update"]);
		}
		if($result["user_update"] == $result["author"] || ! $result["user_update"])
		{
			$result["user_update"] = 0;
		}
		else
		{
			$result["user_update"] = $this->get_author($result["user_update"]);
		}
		$result["author"]          = $result["author"] ? $this->get_author($result["author"]) : $result["name"];
		$result["show"]            = 0;

		$result["attachments"] = array();
		if ($this->diafan->configmodules("attachments"))
		{
			$result["attachments"]["rows"] = $this->diafan->_attachments->get($result["id"], 'forum');
			$result["attachments"]["access"] = true;
			$result["attachments"]["use_animation"] = $this->diafan->configmodules("use_animation", "forum");
		}
		$result["hash"] = $this->result["hash"];

		$this->result["data"]   = $this->diafan->_tpl->get('id_message', 'forum_message', $result);
		$this->result["target"]  = ".forum_message".$_POST["save_id"];
		return $this->send_errors();
	}

	/**
	 * Блокирует|разблокирует сообщение
	 *
	 * @return boolean
	 */
	private function block_message()
	{
		if (empty($_POST["id"]))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		if (! $this->moderator)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		$result = DB::fetch_array(DB::query("SELECT * FROM {forum} WHERE id=%d LIMIT 1", $_POST["id"]));
		if (! $result)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		DB::query("UPDATE {forum} SET act='%d' WHERE id=%d", $result["act"] ? 0 : 1, $_POST["id"]);

		if ($result["act"])
		{
			DB::query("DELETE FROM {forum_show} WHERE element_id='%d' AND table_name='forum'", $_POST["id"]);
		}

		$result["access_edit_delete"] = true;
		$result["access_block"]       = true;
		$result["act"]                = $result["act"] ? false : true;
		$result["created"]            = $this->format_date($result["created"]);
		if ($result["date_update"])
		{
			$result["date_update"] = $this->format_date($result["date_update"]);
		}
		if($result["user_update"] == $result["author"] || ! $result["user_update"])
		{
			$result["user_update"] = 0;
		}
		else
		{
			$result["user_update"] = $this->get_author($result["user_update"]);
		}
		$result["author"]          = $result["author"] ? $this->get_author($result["author"]) : $result["name"];
		$result["show"]            = 0;

		$result["attachments"] = array();
		if ($this->diafan->configmodules("attachments"))
		{
			$result["attachments"]["rows"] = $this->diafan->_attachments->get($result["id"], 'forum');
			$result["attachments"]["access"] = true;
			$result["attachments"]["use_animation"] = $this->diafan->configmodules("use_animation", "forum");
		}
		$result["hash"] = $this->result["hash"];

		$this->result["data"]    = $this->diafan->_tpl->get('id_message', 'forum_message', $result);
		$this->result["target"]  = ".forum_message".$_POST["id"];
		return $this->send_errors();
	}

	/**
	 * Удяет сообщение
	 *
	 * @return boolean
	 */
	private function delete_message()
	{
		if (empty($_POST["id"]))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		if (! $this->diafan->_user->id)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		$result = DB::fetch_array(DB::query("SELECT * FROM {forum} WHERE id=%d LIMIT 1", $_POST["id"]));

		if ($this->diafan->_user->id == $result["author"] && DB::query_result("SELECT id FROM {forum} WHERE parent_id=%d AND trash<>'1' AND del<>'1' LIMIT 1", $_POST["id"]))
		{
			$this->result["errors"][0] = $this->diafan->_('Удалить сообщение нельзя, потому что на него кто-то ответил', false);
			return $this->send_errors();
		}

		//модератор
		if ($this->diafan->_user->id != $result["author"] && $this->moderator)
		{
			$this->save_news($_POST["id"], $result["author"]);

			$this->diafan->_attachments->delete($_POST["id"], "forum");
			DB::query("UPDATE {forum} SET del='1', act='0', user_update='%d', date_update=%d WHERE id=%d", $this->diafan->_user->id, time(), $_POST["id"]);
			$result["del"]  = 1;
			$result["text"] = $this->diafan->short_text($result["text"], 50);
			$result["access_edit_delete"] = false;
			$result["access_block"]       = false;
			$result["show"]               = false;
			$result["user_update"]        = $this->get_author($this->diafan->_user->id);
			$result["hash"]            = $this->diafan->_user->get_hash();
			$this->result["data"]      = $this->diafan->_tpl->get('id_message', 'forum_message', $result);
			$this->result["target"]  = ".forum_message".$_POST["id"];
		}
		//чужой комментарий
		elseif ($this->diafan->_user->id != $result["author"])
		{
			$this->result["errors"][0] = $this->diafan->_('Зачем Вы пытаетесь удалить чужое сообщение?', false);
			return $this->send_errors();
		}
		//автор
		else
		{
			$this->diafan->_attachments->delete($_POST["id"], "forum");
			DB::query("DELETE FROM {forum} WHERE id=%d", $_POST["id"]);
			if ($result["parent_id"])
			{
				DB::query("DELETE FROM {forum_parents} WHERE element_id=%d", $_POST["id"]);
				$parents = $this->diafan->get_parents($result["parent_id"], "forum");
				$parents[] = $result["parent_id"];
				DB::query("UPDATE {forum} SET count_children=count_children-1 WHERE id IN (%s)", implode(',', $parents));
			}
			$this->result["form_hide"] = true;
			$this->result["target_hide"]  = ".forum_message".$_POST["id"];
		}

		DB::query("DELETE FROM {forum_show} WHERE element_id='%d' AND table_name='forum'", $_POST["id"]);

		return $this->send_errors();
	}

	/**
	 * Удаляет прикрепленный файл
	 * 
	 * @return boolean
	 */
	private function delete_attachment()
	{
		if (empty($_POST["del_id"]))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		$row = DB::fetch_array(DB::query("SELECT element_id, id FROM {attachments} WHERE module_name='forum' AND id=%d LIMIT 1", $_POST["del_id"]));
		if (! $row)
		{
			$this->result["errors"][0] = 'ERROR';
		}
		if (! $this->moderator && DB::query_result("SELECT `author` FROM {forum} WHERE id=%d LIMIT 1", $row["element_id"]) != $this->diafan->_user->id)
		{
			$this->result["errors"][0] = 'ERROR';
		}
		$this->diafan->_attachments->delete($row["element_id"], "forum", $_POST["del_id"]);

		$this->result["form_hide"] = 1;
		$this->result["target_hide"]    = "#attachment".$row["id"];

		return $this->send_errors();
	}

	/**
	 * Сохраняет изменения в новостях
	 *
	 * @param integer $save номер сообщения
	 * @param integer|string $del_author номер автора сообщения, если автор удаляет сообщение
	 * @return boolean true
	 */
	private function save_news($save, $del_author = 'no')
	{
		$count_days = $this->diafan->configmodules("news_count_days");

		DB::query("DELETE FROM {forum_show} WHERE created < %d", time() - 86400 * $count_days);
		DB::query("DELETE FROM {forum_show} WHERE element_id=%d AND table_name='forum'", $save);
		$result = DB::query("SELECT id FROM {users} WHERE act='1' AND trash='0' AND id<>'%d'"
				    .($del_author !== "no" ? " AND id='".$del_author."'" : ''),
				    $this->diafan->_user->id);
		while ($row = DB::fetch_array($result))
		{
			DB::query("INSERT INTO {forum_show} (element_id, user_id, table_name, created) VALUES ('%d','%d','forum', %d)", $save, $row["id"], time());
		}
		return true;
	}
}