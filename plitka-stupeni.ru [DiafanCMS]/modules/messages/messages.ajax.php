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
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

class Messages_ajax extends Ajax
{

    public function ajax_request()
    {
		if (! $this->diafan->_user->id)
		{
			return false;
		}

		if (empty($_POST['module']) || $_POST['module'] != 'messages')
		{
			return false;
		}

		$this->valid_text();

		if ($this->send_errors())
			return true;

		$this->result['success'] = false;

		if (!DB::query("INSERT INTO {messages} (created, author, to_user, text) VALUES ('%d', %d, %d, '%s')", time(), $this->diafan->_user->id, $_POST['to'], $_POST["message"]))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}
	
		if (DB::query_result("SELECT id FROM {messages_user} WHERE user_id=%d AND contact_user_id=%d LIMIT 1", $this->diafan->_user->id, $_POST['to']))
		{
			// обновляем информацию о контакте: дата обновления, количество сообщений и пометка "непрочитанный" у контакта получателя
			DB::query("UPDATE {messages_user} SET date_update=%d, count_message=count_message+1 WHERE user_id=%d AND contact_user_id=%d", time(), $this->diafan->_user->id, $_POST['to']);
			DB::query("UPDATE {messages_user} SET date_update=%d, count_message=count_message+1, readed='0' WHERE contact_user_id=%d AND user_id=%d", time(), $this->diafan->_user->id, $_POST['to']);
		}
		else
		{
			// добавляем контакт автору и получателю
			DB::query("INSERT INTO {messages_user} (date_update, count_message, user_id, contact_user_id, readed) VALUES (%d, '1', %d, %d, '1')", time(), $this->diafan->_user->id, $_POST['to']);
			DB::query("INSERT INTO {messages_user} (date_update, count_message, user_id, contact_user_id) VALUES (%d, '1', %d, %d)", time(), $_POST['to'], $this->diafan->_user->id);
		}
	
		$this->result['success'] = true;
	
		if(empty($_POST['redirect']))
		{
			$this->result['redirect'] = BASE_PATH_HREF.$this->diafan->_route->module('messages').'show'.intval($_POST['to']).'/';
		}
		else
		{
			$this->result['redirect'] = BASE_PATH_HREF.$this->diafan->_route->current_link("page");
		}

		$this->send_errors();
		return true;
    }

    /**
     * Проверяет валидность сообщения
     * 
     * @return boolean true
     */
    private function valid_text()
    {
		if (empty($_POST['to']) || $_POST['to'] == $this->diafan->_user->id)
		{
			$this->result["errors"][0] = 'ERROR';
			return false;
		}
		if (!empty($this->diafan->show))
		{
			$_POST['to'] = $this->diafan->show;
		}
		if (! $_POST["message"])
		{
			$this->result["errors"][0] = $this->diafan->_('Заполните поле сообщение', false);
			return false;
		}
		$_POST["message"] = $this->diafan->_bbcode->replace($_POST["message"]);

		return true;
    }
}
