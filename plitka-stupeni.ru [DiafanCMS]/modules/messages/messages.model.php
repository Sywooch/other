<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

class Messages_model extends Model
{
    /**
     * Генерирует список
     *
     * @return array
     */
    public function list_()
    {
		$this->diafan->_paginator->page = $this->diafan->page;
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->navlink_tpl = $this->diafan->_route->current_link("", array("page" => "%d"));
		$this->diafan->_paginator->nen = DB::query_result("SELECT COUNT(id) FROM {messages_user} WHERE user_id=%d", $this->diafan->_user->id);

		if ($this->diafan->_paginator->nen == 0)
		{
			return $this->result;
		}
		$this->result["paginator"] = $this->diafan->_paginator->get();

		$this->result["rows"] = array();

		$result = DB::query_range("SELECT id, contact_user_id, date_update, readed, count_message FROM {messages_user} WHERE user_id=%d ORDER BY date_update DESC", $this->diafan->_user->id, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
		while ($row = DB::fetch_array($result))
		{
			$row['date_update'] = $this->format_date($row['date_update']);
			$row['user'] = $this->get_author($row['contact_user_id']);
			$row['last_message'] = DB::fetch_array(DB::query("SELECT text, created FROM {messages} WHERE author=%d AND to_user=%d OR author=%d AND to_user=%d ORDER BY created DESC LIMIT 1", $this->diafan->_user->id, $row["contact_user_id"], $row["contact_user_id"], $this->diafan->_user->id));
			$row['last_message']['created'] = $this->format_date($row['last_message']['created']);
			$row['link'] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->cid, "messages", 0, $row["contact_user_id"]);
			$this->result["rows"][] = $row;
		}

		return $this->result;
    }

    /**
     * Генерирует данные для страницы переписки с пользователем
     *
     * @return array
     */
    public function id()
    {
		$this->diafan->path[] = array('name' => $this->diafan->name, 'link' => $this->diafan->_route->current_link("show"));
		$this->result['user'] = $this->get_author($this->diafan->show);
		$this->diafan->titlemodule = $this->diafan->_('Переписка с пользователем', false).' '.$this->result['user']["fio"].' ('.$this->result['user']["name"].')';
		$this->result["title"] = $this->diafan->titlemodule;

		////navigation//
		$this->diafan->_paginator->page = $this->diafan->page;
		$this->diafan->_paginator->navlink = $this->diafan->_route->current_link("page");
		$this->diafan->_paginator->navlink_tpl = $this->diafan->_route->current_link("", array("page" => "%d"));
		$this->diafan->_paginator->nen = DB::query_result("SELECT COUNT(id) FROM {messages} WHERE author=%d AND to_user=%d OR author=%d AND to_user=%d", $this->diafan->_user->id, $this->diafan->show, $this->diafan->show, $this->diafan->_user->id);
		$links = $this->diafan->_paginator->get();
		////navigation///
		if (!$this->diafan->_paginator->nen && $this->diafan->page)
		{
			include_once(ABOLUTE_PATH.'includes/404.php');
		}

		$this->result["paginator"] = $links;
		$this->result["rows"] = array();

		$update_readed = array();
		$result = DB::query_range("SELECT id,author,created,text,readed FROM {messages} WHERE author=%d AND to_user=%d OR author=%d AND to_user=%d ORDER BY created DESC", $this->diafan->_user->id,$this->diafan->show, $this->diafan->show, $this->diafan->_user->id, $this->diafan->_paginator->polog, $this->diafan->_paginator->nastr);
		while ($row = DB::fetch_array($result))
		{
			if ($row["author"] != $this->diafan->_user->id && !$row["readed"])
			{
				$update_readed[] = $row["id"];
			}
			else
			{
				$row["readed"] = 1;
			}

			$row['created'] = $this->format_date($row['created']);
			$row['name'] = $this->get_author($row['author']);
			$this->result["rows"][] = $row;
		}
		if (!empty($update_readed))
		{
			DB::query("UPDATE {messages} SET readed='1' WHERE id IN (%s)", implode(',', $update_readed));
		}

		if(! DB::query_result("SELECT id FROM {messages} WHERE readed='0' AND author=%d AND to_user=%d LIMIT 1",$this->diafan->show, $this->diafan->_user->id))
			DB::query("UPDATE {messages_user} SET readed='1' WHERE user_id=%d AND contact_user_id=%d", $this->diafan->_user->id, $this->diafan->show);
	

		return $this->result;
    }

}
