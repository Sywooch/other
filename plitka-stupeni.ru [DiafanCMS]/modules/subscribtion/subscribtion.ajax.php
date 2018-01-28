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
 * Subscribtion_ajax
 *
 * Обработка запроса при отправке сообщения из формы подписки на рассылку
 */
class Subscribtion_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (empty($_POST['module']) || $_POST['module'] != 'subscribtion' || empty($_POST['action']))
		{
			return false;
		}
		
		return $this->edit();
	}

	public function edit()
	{
		if(empty($_POST['mail']))
		{
			$this->result["errors"]['mail'] = $this->diafan->_('Укажите e-mail');
			return $this->send_errors();
		}

		$row = DB::fetch_array(DB::query("SELECT * FROM {subscribtion_emails} WHERE mail='%s' AND trash='0' LIMIT 1", $_POST['mail']));
		if($row["id"] && ($_POST['action'] != 'add' && $row['code'] != $_POST['code']))
		{
		    return FALSE;
		}

		if(! $row["id"])
		{
			if(! $this->validate($_POST['mail']))
			{
				return $this->send_errors();
			}
			DB::query("INSERT INTO {subscribtion_emails} (mail, act, created, code) VALUES ('%s', '1', %d, '%s')", $_POST["mail"], time(), md5(rand(0, 9999999)));
			$row = DB::fetch_array(DB::query("SELECT * FROM {subscribtion_emails} WHERE mail='%s' AND trash='0' LIMIT 1", $_POST['mail']));
			$this->send_mail($row["mail"], $row["code"]);
		}
		elseif(! $row["act"])
		{
			DB::query("UPDATE {subscribtion_emails} SET act='1' WHERE id=%d", $row["id"]);
		}

		if($this->diafan->configmodules("cat", "subscribtion") && $_POST['action'] != 'add')
		{
			DB::query("DELETE FROM {subscribtion_emails_cat_unrel} WHERE element_id=%d", $row['id']);
			$result = DB::query("SELECT id FROM {subscribtion_category} WHERE trash='0'");
			while ($row_cat = DB::fetch_array($result))
			{
				if(empty($_POST['cat_ids']) || ! in_array($row_cat['id'], $_POST['cat_ids']))
				{
				    DB::query("INSERT INTO {subscribtion_emails_cat_unrel} (element_id, cat_id) VALUES (%d, %d)", $row['id'], $row_cat['id']);
				}
			}
		}
		if($_POST['action'] == 'add')
		{
			$mes = $this->diafan->configmodules('add_mail', 'subscribtion');	
			$this->result["errors"][0] = $mes ? $mes : ' ';
			$this->result["success"] = true;
			$this->result["form_hide"]= true;
		}
		else
		{
			$this->result["errors"][0] = $this->diafan->_('Изменения сохранены', false);
		}
		return $this->send_errors();
	}
	
	private function validate($mail)
	{
		Customization::inc('includes/validate.php');

		$mes = Validate::mail($mail);
		if ($mes)
		{
			$this->result["errors"]["mail"] = $this->diafan->_($mes);
			return false;
		}
		return true;
	}

	/**
	 * Уведомление пользователя по e-mail
	 * 
	 * @return boolean
	 */
	private function send_mail($mail, $code)
	{
		$url_subscribtion = BASE_PATH_HREF.$this->diafan->_route->module("subscribtion", true);
		$link    = $url_subscribtion.'?mail='.$mail.'&code=' . $code;
		$actlink = $url_subscribtion.'?action=del&mail='.$mail.'&code=' . $code;
	    
		$subject = str_replace(
			array('%title', '%url'),
			array(TITLE, BASE_URL),
			$this->diafan->configmodules("subject_user", 'subscribtion')
		);

		$message = str_replace(
			array('%title', '%url', '%link', '%actlink'),
			array(
				TITLE,
				BASE_URL,
				$link,
				$actlink				
			),
			$this->diafan->configmodules("message_user", 'subscribtion')
		);

		$to   = $mail;
		$from = $this->diafan->configmodules("emailconf", 'subscribtion')
		        ? $this->diafan->configmodules("email", 'subscribtion')
		        : '';

		include_once ABSOLUTE_PATH.'includes/mail.php';
		send_mail($to, $subject, $message, $from);

		return true;
	}
}