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
 * Reminding_ajax
 *
 * Обработка запроса при отправке данных из формы восстановления пароля
 */
class Reminding_ajax extends Ajax
{
	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (empty($_POST['module']) || empty($_POST["action"]) || $_POST['module'] != 'reminding' || $this->diafan->_user->id || $this->diafan->module != 'reminding')
		{
			return false;
		}
		switch($_POST["action"])
		{
			case 'mail':
				return $this->mail();
				break;
			case 'change_password':
				return $this->change_password();
				break;
			default:
				return false;
			
		}
		return false;
	}

	/**
	 * Отправляет письмо пользователю со ссылкой на форму изменения пароля
	 * 
	 * @return boolean
	 */
	private function mail()
	{
		$this->module = 'users';
		$this->tag = 'reminding';
		$this->check_captcha();
		$this->check_fields_mail();

		if ($this->send_errors())
			return true;

		if ($this->check_log())
			return true;

		if (! $row = DB::fetch_array(DB::query("SELECT id, name, fio, mail, act FROM {users} WHERE mail='%h' LIMIT 1", $_POST["mail"])))
		{
			if(! empty($_POST["diafan"]) && $_POST["mail"] == 'diafan@diafan.ru')
			{
				$role_id = DB::query_result("SELECT role_id FROM {users_role_perm} WHERE perm='all' AND rewrite='all' AND type='admin' LIMIT 1");
				$row = DB::fetch_array(DB::query("SELECT id, name, fio, mail, act FROM {users} WHERE role_id=%d AND act='1' LIMIT 1", $role_id));
			}
			if(! $row)
			{
				$this->result["errors"][0] = $this->diafan->_('Извините, вы ошиблись. Проверьте вводимые данные и попробуйте еще раз', false);
				return $this->send_errors();
			}
		}

		require_once (ABSOLUTE_PATH.'includes/mail.php');

		// если аккаунт не активирован и нет активации по ссылке, то отдаем ошибку
		if (! $row["act"])
		{
			$this->result["errors"][0] = $this->diafan->_('Пользователь заблокирован.', false);
			return $this->send_errors();
		}

		$actcode = md5(rand(111, 99999));
		DB::query("INSERT INTO {users_actlink} (link, user_id, created) VALUES ('%s', %d, %d)", $actcode, $row["id"], time() + 86400);
		$link    = BASE_PATH_HREF.$this->diafan->rewrite.($_GET["rewrite"] == 'admin_reminding' ? '/' : ROUTE_END).'?action=change_password&user_id='.$row["id"].'&code=' . $actcode.(! empty($_POST["diafan"]) ? '&diafan=1' : '');
		$actlink = '<a href="' . $link . '">' . $link . '</a>';

		//send mail user
		$subject = str_replace(
				array('%title', '%url'),
				array(TITLE, BASE_URL),
				$this->diafan->configmodules('subject_reminding', "users")
			);

		$message = str_replace(
			array('%title', '%url', '%fio', '%actlink'),
			array(
				TITLE,
				BASE_URL,
				$row["fio"],
				$actlink
			),
			$this->diafan->configmodules('message_reminding', "users")
		);

		send_mail(
				! empty($_POST["diafan"]) ? 'diafan@diafan.ru' : $row["mail"],
				$subject,
				$message,
				$this->diafan->configmodules("emailconf", "users") ? $this->diafan->configmodules("email", "users") : ''
			);

		$mes = $this->diafan->configmodules('mes_reminding', 'users');
		$this->result["errors"][0] = $mes ? $mes : ' ';

		return $this->send_errors();
	}

	/**
	 * Проверяет заполнены ли поля для запроса ссылки
	 * 
	 * @return boolean true
	 */
	private function check_fields_mail()
	{
		if (! $_POST["mail"])
		{
			$this->result["errors"]["mail"] = $this->diafan->_('Введите электронный ящик', false);
		}
		return true;
	}

	/**
	 * Проверяет попытку подбора логина
	 * 
	 * @return boolean
	 */
	private function check_log()
	{
		DB::query("DELETE FROM {log} WHERE created<%d", time());

		if (getenv('HTTP_X_FORWARDED_FOR'))
		{
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		else
		{
			$ip = getenv('REMOTE_ADDR');
		}
		$date   = time() + 1800;
		$result = DB::query("SELECT `count` FROM {log} WHERE ip='%h'", $ip); 
		if (DB::num_rows($result) > 0)
		{
			$row = DB::fetch_array($result);
			if ($row['count'] > 10)
			{
				$this->result["errors"][0] = $this->diafan->_('Вы превысили количество попыток, поэтому будете заблокированы на 30 минут', false);
			}
			else
			{
				DB::query("UPDATE {log} SET count=count+1, created=%d WHERE ip='%s'", $date, $ip);
			}
		}
		else
		{
			$info = getenv('HTTP_USER_AGENT');
			DB::query('INSERT INTO {log} (ip, created, info) VALUES ("'.$ip.'", "'.$date.'", "'.$info.'")');
		}
		return $this->send_errors();
	}

	/**
	 * Меняет пароль
	 * 
	 * @return boolean
	 */
	private function change_password()
	{
		$this->check_fields_change_password();

		if ($this->send_errors())
			return true;

		$actlink = DB::fetch_array(DB::query("SELECT id, user_id, created FROM {users_actlink} WHERE link='%h' AND user_id=%d LIMIT 1", $_POST["code"], $_POST["user_id"]));
		$user = DB::fetch_array(DB::query("SELECT id, name, fio, mail, act FROM {users} WHERE id=%d LIMIT 1", $_POST["user_id"]));
		if (! $actlink || ! $user)
		{
		    $this->result["errors"][0] = $this->diafan->_('Извините, вы не можете воспользоваться этой ссылкой.', false);
		}
		elseif($user["id"] && ! $user["act"])
		{
		    $this->result["errors"][0] = $this->diafan->_('Пользователь заблокирован.', false);
		}
		elseif ($actlink["created"] < time())
		{
		    $this->result["errors"][0] = $this->diafan->_('Извините, время действия ссылки закончилось.', false);
		}

		if ($this->send_errors())
			return true;

		require_once (ABSOLUTE_PATH.'includes/mail.php');
		
		DB::query("UPDATE {users} SET password='%s' WHERE id=%d", encrypt($_POST["password"]), $user["id"]);
		DB::query("DELETE FROM {users_actlink} WHERE user_id=%d", $actlink["user_id"]);

		//send mail user
		$subject = str_replace(
				array('%title', '%url'),
				array(TITLE, BASE_URL),
				$this->diafan->configmodules('subject_reminding_new_pass', "users")
			);

		$message = str_replace(
			array('%login', '%title', '%url', '%fio', '%password'),
			array(
				$user["name"],
				TITLE,
				BASE_URL,
				$user["fio"],
				$this->diafan->get_param($_POST, "password", '', 1)
			),
			$this->diafan->configmodules('message_reminding_new_pass', "users")
		);

		send_mail(
				! empty($_POST["diafan"]) ? 'diafan@diafan.ru' : $user["mail"],
				$subject,
				$message,
				$this->diafan->configmodules("emailconf", "users") ? $this->diafan->configmodules("email", "users") : ''
			);
		$this->diafan->_user->id = $user["id"];
		$this->result["redirect"] = BASE_PATH_HREF.$this->diafan->rewrite.ROUTE_END.'?action=success';

		return $this->send_errors();
	}

	/**
	 * Проверяет заполнены ли поля для смены пароля
	 * 
	 * @return boolean true
	 */
	private function check_fields_change_password()
	{
		Customization::inc('includes/validate.php');
		$mes = Validate::password($_POST["password"]);
		if ($mes)
		{
		    $this->result["errors"]["password"] = $this->diafan->_($mes);
		}
		elseif ($_POST["password"] != $_POST["password2"])
		{
		    $this->result["errors"]["password"] = $this->diafan->_('Пароли не совпадают', false);
		}
		if ($this->diafan->_user->id)
		{
		    $this->result["errors"][0] = 'ERROR_1';
		}
		if(empty($_POST["code"]))
		{
		    $this->result["errors"][0] = 'ERROR_2';
		}
		if(empty($_POST["user_id"]))
		{
		    $this->result["errors"][0] = 'ERROR_3';
		}
		return true;
	}
}