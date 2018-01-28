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
 * Forum_ajax
 *
 * Обработка запроса
 */
class Forum_ajax extends Ajax
{
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
	public function __construct($diafan)
	{
		$this->diafan = &$diafan;

		$this->moderator = $this->diafan->_user->roles('moderator', 'forum', '', 'site');

		Customization::inc('modules/forum/message/message.inc.php');
		$this->message = new Forum_message_inc($diafan);
	}

	/**
	 * Обрабатывает запрос
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (empty($_POST["module"]) || $_POST["module"] != 'forum' || $this->diafan->module != 'forum' || empty($_POST["action"]))
		{
			return false;
		}
		if ($this->diafan->_user->id && ! $this->diafan->_user->checked)
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
		Customization::inc('modules/forum/message/message.ajax.php');
		$ajax = new Forum_message_ajax($this->diafan);
		if ($ajax->ajax_request())
		{
			return true;
		}
		$this->result["hash"] = $this->diafan->_user->get_hash();
		switch($_POST["action"])
		{
			case "save-category":
				return $this->save();

			case "savenew-category":
				return $this->savenew();

			case "delete-category":
				return $this->delete();

			case "block-category":
				return $this->block(true);

			case "unblock-category":
				return $this->block(false);

			case "close-category":
				return $this->close(true);

			case "open-category":
				return $this->close(false);

			case "prior-category":
				return $this->prior(true);

			case "unprior-category":
				return $this->prior(false);
		}
		return false;
	}

	/**
	 * Сохраняет новую категорию форума
	 * 
	 * @return boolean
	 */
	public function savenew()
	{
		//доступ на добавление только для зарегистрированных
		if ($this->diafan->configmodules("only_user") && ! $this->diafan->_user->id)
		{
			$this->result["errors"][0] = 'ERROR';
		}
		if (empty($_POST["parent_id"]) || ! DB::query_result("SELECT parent_id FROM {forum_category} WHERE id=%d AND trash='0' AND act='1' LIMIT 1", $_POST["parent_id"]))
		{
			$this->result["errors"][0] = 'ERROR';
		}
		if (empty($_POST["name"]))
		{
			$this->result["errors"][0] = $this->diafan->_('Введите название темы для обсуждения', false);
		}

		if(! $this->diafan->_user->id) 
		{
			$this->check_captcha();
			if($this->send_errors()) return true;
		}

		DB::query("INSERT INTO {forum_category} (name, author, created, message_update, act, parent_id) "
				  ." VALUES ('%h', %d, %d, %d, '%d', %d)", $_POST["name"], $this->diafan->_user->id,
				  time(), time(), $this->diafan->configmodules('premoderation_theme') && ! $this->moderator ? 0 : 1,
				  $_POST["parent_id"]
		);
		$save = DB::last_id("forum_category");

		$parents = $this->diafan->get_parents($_POST["parent_id"], "forum_category");
		$parents[] = $_POST["parent_id"];
		foreach ($parents as $parent_id)
		{
			DB::query("INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (%d, %d)", $save, $parent_id);
			DB::query("UPDATE {forum_category} SET count_children=count_children+1 WHERE id=%d", $parent_id);
		}
		// ЧПУ
		if(ROUTE_AUTO_MODULE)
		{
			Customization::inc('adm/includes/save_functions.php');
			$save_functions = new Save_functions_admin($this->diafan);
			$rewrite = $save_functions->generate_rewrite($_POST["name"]);

			$parent_rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='%s' AND cat_id=%d LIMIT 1", $this->diafan->module, $_POST["parent_id"]);

			if(! $parent_rewrite)
			{
				$parent_rewrite = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND site_id=%d LIMIT 1", $this->diafan->cid);
			}
			$rewrite = ($parent_rewrite ? $parent_rewrite.'/' : '').$rewrite;
		}
		//если такая псевдоссылка принадлежит другому элементу, добавляем номер id
		if (DB::query_result("SELECT id FROM {rewrite} WHERE rewrite='%s' LIMIT 1", $rewrite))
		{
			$rewrite .= $save;
		}
		DB::query("INSERT INTO {rewrite} (module_name, element_id, rewrite, site_id) VALUES ('forum', %d, '%h', %d)", $save, $rewrite, $this->diafan->cid);

		$this->save_news($save);
		if ($this->diafan->configmodules('premoderation_theme') && ! $this->moderator)
		{
			$this->result["success"] = 1;
			$this->result["errors"][0] = $this->diafan->_('Тема успешно добавлена.', false).' '.$this->diafan->_('Тема будет активирована на сайте после проверки модератором.', false);
		}
		else
		{
			
			$this->result["redirect"] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->cid, "forum", 0, $save);
		}
		return $this->send_errors();
	}

	/**
	 * Сохраняет редактируемую категорию форума
	 * 
	 * @return boolean
	 */
	public function save()
	{
		$row = DB::fetch_array(DB::query("SELECT id, author, parent_id, act FROM {forum_category} WHERE id=%d AND del='0' AND trash='0' LIMIT 1", $_POST["id"]));

		//редактирует только автор и модератор
		if (! $row || ! $this->moderator && ($row["author"] != $this->diafan->_user->id || ! $row["act"]))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		if (empty($row["parent_id"]) || ! DB::query_result("SELECT parent_id FROM {forum_category} WHERE id=%d AND trash='0' AND del='0' AND act='1' LIMIT 1", $row["parent_id"]))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();	
		}

		$edit_or_add = 2;
		if (DB::query_result("SELECT id FROM {forum_category} WHERE id='%d' AND name='%h' LIMIT 1", $_POST["id"], $_POST["name"]))
		{
			$edit_or_add = 0;
		}

		if ($edit_or_add)
		{
			DB::query("UPDATE {forum_category} SET name='%h', date_update='%d', message_update='%d', user_update='%d', act='%d' WHERE id=%d",
				  $_POST["name"], time(), time(),
				  //модератор
				  $row["author"] != $this->diafan->_user->id ? $this->diafan->_user->id : '',
				  $this->diafan->configmodules('premoderation_theme') && ! $this->moderator ? 0 : 1,
				  $_POST["id"]
			);
			$this->save_news($_POST["id"]);
		}

		if ($this->diafan->configmodules('premoderation_theme') && ! $this->moderator)
		{
			$this->result["errors"][0] = $this->diafan->_('Тема успешно изменена.', false).' '.$this->diafan->_('Тема будет активирована на сайте после проверки модератором.', false);
		}
		else
		{
			
			$this->result["redirect"] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->cid, "forum", 0, $_POST["id"]);
		}
		return $this->send_errors();
	}

	/**
	 * Удаляет категорию форума
	 * 
	 * @return boolean
	 */
	public function delete()
	{
		$row = DB::fetch_array(DB::query("SELECT * FROM {forum_category}  WHERE id=%d AND del='0' AND trash='0' LIMIT 1", $_POST["id"]));

		//удаляет только автор и модератор
		if (! $row || ($row["author"] != $this->diafan->_user->id && ! $this->moderator))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		//удаляет автор, если в теме нет сообщений от других пользователей
		if (! $this->moderator
		   && DB::result(DB::query("SELECT COUNT(*) FROM {forum} WHERE cat_id=%d AND author<>%d", $this->diafan->show, $this->diafan->_user->id)))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		//удаляют все сообщения в теме
		$this->message->delete();

		//модератор только помечает, что тема удалена
		if ($row["author"] != $this->diafan->_user->id)
		{
			DB::query("UPDATE {forum_category} SET del='1', user_update='%d', date_update=%d WHERE id='%d'",
					  $this->diafan->_user->id, time(), $_POST["id"]);
			$this->save_news($_POST["id"]);
			$row["del"] = '1';
			$row["user_update"] = $this->diafan->_user->id;
			$row["date_update"] = time();
			$this->show_category($row);
		}
		else
		{
			DB::query("DELETE FROM {forum_category} WHERE id=%d", $_POST["id"]);

			DB::query("DELETE FROM {forum_category_parents} WHERE element_id=%d", $_POST["id"]);
			$parents = $this->diafan->get_parents($row["parent_id"], "forum_category");
			$parents[] = $row["parent_id"];
			DB::query("UPDATE {forum_category} SET count_children=count_children-1 WHERE id IN (%s)", implode(',', $parents));

			DB::query("DELETE FROM {forum_show} WHERE element_id='%d' AND table_name='forum_category'", $_POST["id"]);
			$this->result["form_hide"] = true;
			$this->result["target_hide"] = '#forum_category-'.$row["id"];
		}
		return $this->send_errors();
	}

	/**
	 * Публикует/блокирует категорию форума
	 *
	 * @param boolean $block категория блокируется
	 * @return boolean
	 */
	public function block($block)
	{
		$row = DB::fetch_array(DB::query("SELECT * FROM {forum_category}  WHERE id=%d AND del='0' AND trash='0' LIMIT 1", $_POST["id"]));

		//блокировать/разблокировать может только модератор
		if (! $row || ! $this->moderator)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		if ($block)
		{
			DB::query("DELETE FROM {forum_show} WHERE element_id='%d' AND table_name='forum_category'", $_POST["id"]);
		}
		else
		{
			$this->save_news($_POST["id"]);
		}

		DB::query("UPDATE {forum_category} SET act='%d' WHERE id='%d'", $block ? 0 : 1, $_POST["id"]);
		$row["act"] = $block ? 0 : 1;

		$this->show_category($row);
		return $this->send_errors();
	}

	/**
	 * Закрывает категорию форума
	 * 
	 * @param boolean $close категория закрывается
	 * @return boolean
	 */
	public function close($close)
	{
		$row = DB::fetch_array(DB::query("SELECT * FROM {forum_category}  WHERE id=%d AND del='0' AND trash='0' LIMIT 1", $_POST["id"]));

		//закрывать тему может только модератор
		if (! $row || ! $this->moderator)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		DB::query("UPDATE {forum_category} SET close='%d' WHERE id='%d'", $close ? 1 : 0, $_POST["id"]);
		$row["close"] = $close ? 1 : 0;

		$this->show_category($row);
		return $this->send_errors();
	}

	/**
	 * Закрепляет/открепляет категорию форума
	 * 
	 * @param boolean $prior категория закрепляется
	 * @return boolean
	 */
	public function prior($prior)
	{
		$row = DB::fetch_array(DB::query("SELECT id FROM {forum_category}  WHERE id=%d AND del='0' AND trash='0' LIMIT 1", $_POST["id"]));

		//закреплять тему может только модератор
		if (! $row || ! $this->moderator)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}

		DB::query("UPDATE {forum_category} SET prior='%d' WHERE id='%d'", $prior ? 1 : 0, $_POST["id"]);
		$this->result["redirect"] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->cid, "forum", $this->diafan->cat).($this->diafan->page > 1 ? 'page'.$this->diafan->page.'/' : '');
		
		return $this->send_errors();
	}

	/**
	 * Сохраняет историю изменений для пользователей
	 * 
	 * @return boolean true
	 */
	private function save_news($save)
	{
		$result = DB::query("SELECT id FROM {users} WHERE act='1' AND trash='0' AND id<>'%d'", $this->diafan->_user->id);
		while ($row = DB::fetch_array($result))
		{
			DB::query("INSERT INTO {forum_show} (element_id, user_id, table_name, created) VALUES ('%d', '%d', 'forum_category', %d)", $save, $row["id"], time());
		}
		return true;
	}

	/**
	 * Формирует возвращаемую строку о категории
	 *
	 * @return boolean
	 */
	private function show_category($row = array())
	{
		if (! $row)
		{
			$row = DB::fetch_array(DB::query("SELECT * FROM {forum_category}  WHERE id=%d AND del='0' AND trash='0' AND act='1' LIMIT 1", $_POST["id"]));
		}
		Customization::inc('modules/forum/forum.model.php');
		$model = new Forum_model($this->diafan);
		$model_result = $model->list_id_category($row);
		$result["hash"] = $this->diafan->_user->get_hash();
		$result["row"]  = $model_result;
		$this->result["data"] = $this->diafan->_tpl->get('list_id_category', 'forum', $result);
		$this->result["target"] = '#forum_category_'.$row["id"];

		return true;
	}
}