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
 * Reminding_model
 *
 * Модель модуля "Восстановление пароля"
 */
class Reminding_model extends Model
{
	/**
	 * Генерирует данные для формы запроса ссылки на форму восстановления пароля
	 * 
	 * @return array
	 */
	public function form_mail()
	{
		if ($this->diafan->_user->id)
		{
			$this->diafan->redirect(BASE_PATH_HREF);
		}
		$this->result["captcha"] = '';
		if ($this->diafan->configmodules('captcha', "users"))
		{
			$this->result["captcha"] = $this->diafan->_captcha->get("reminding", $this->get_error("reminding", "captcha"));
		}
		$this->result["action"] = ! empty($_GET["diafan"]) ? '<input type="hidden" name="diafan" value="true">' : '';
		$this->result["error"]          = $this->get_error("reminding");
		$this->result["error_mail"]     = $this->get_error("reminding", 'mail');
		return $this->result;
	}

	/**
	 * Генерирует данные для формы смены пароля
	 * 
	 * @return array
	 */
	public function form_change_password()
	{
		if ($this->diafan->_user->id || empty($_GET["user_id"]) || empty($_GET["code"]))
		{
			$this->diafan->redirect(BASE_PATH_HREF);
		}
		$actlink = DB::fetch_array(DB::query("SELECT user_id, created, link FROM {users_actlink} WHERE link='%h' AND user_id=%d LIMIT 1", $_GET["code"], $_GET["user_id"]));
		$user = DB::fetch_array(DB::query("SELECT id, act FROM {users} WHERE id=%d LIMIT 1", $_GET["user_id"]));
		if (! $actlink || ! $user)
		{
			$this->result["result"] = "incorrect";
		}
		elseif($user["id"] && ! $user["act"])
		{
			$this->result["result"] = "block";
		}
		elseif ($actlink["created"] < time())
		{
			$this->result["result"] = "old";
		}
		else
		{
			$this->result["action"] = ! empty($_GET["diafan"]) ? '<input type="hidden" name="diafan" value="true">' : '';
			$this->result["result"] = "success";
			$this->result["user_id"] = $actlink["user_id"];
			$this->result["code"] = $actlink["link"];
			$this->result["error"]          = $this->get_error("reminding");
			$this->result["error_password"] = $this->get_error("reminding", 'password');
		}
		return $this->result;
	}

	/**
	 * Страница успешной смены пароля
	 * 
	 * @return array
	 */
	public function success()
	{
		if (! $this->diafan->_user->id)
		{
			include ABSOLUTE_PATH.'includes/404.php';
		}
		return true;
	}
}