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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * User
 * 
 * Работа с пользователями в пользовательской части
 */
class User extends Core
{
	/**
	 * @var integer номер текущего пользователя
	 */
	public $id = 0;

	/**
	 * @var string данные, хранящиеся в сессии
	 */
	public $session;

	/**
	 * @var boolean пользователь проверен по идентификационному хэшу
	 */
	public $checked;

	/**
	 * @var string идентификационный хэш
	 */
	private $hash;

	/**
	 * @var boolean пользователь является администратором
	 */
	public $admin;

	/**
	 * @var array права доступа администратора
	 */
	public $roles = array();

	/**
	 * @var array права доступа для модулей
	 */
	public $module_roles = array();

	/**
	 * @var string ошибка авторизации
	 */
	public $errauth;

	/**
	 * @var array характеристики пользователя
	 */
	private $fields = array('name', 'fio', 'mail', 'created', 'role_id', 'lang_id', 'htmleditor', 'background', 'admin_nastr');

	/**
	 * @var array характеристики текущего пользователя
	 */
	private $user;

	/**
	 * Доступ к свойствам текущего пользователя
	 * 
	 * @return void
	 */
	public function __get($value)
	{
		if(in_array($value, $this->fields))
		{
			return ! empty($this->user->$value) ? $this->user->$value : '';
		}
	} 

	/**
	 * Определяет текущего пользователя
	 * 
	 * @param object $user данные о текущем пользователе
	 * @return boolean true
	 */
	public function set($user)
	{
		$this->user = $user;
		if (!empty($user->session))
		{
			$this->session = $user->session;
		}
		$this->id = $user->id;

		if (!empty($_POST["check_hash_user"]) && $this->id)
		{
			if ($id = DB::query_result("SELECT id FROM {sessions_hash} WHERE user_id=%d AND created>%d AND hash='%h' LIMIT 1", $this->id, time() - 7200, $_POST["check_hash_user"]))
			{
				register_shutdown_function(array($this, 'delete_session_hash'), $id);
				$this->checked = true;
			}
		}
		else
		{
			$this->checked = false;
		}

		$result = DB::query("SELECT rewrite, perm, type FROM {users_role_perm} WHERE role_id = %d", $this->role_id);

		while($row = DB::fetch_array($result))
		{
			switch($row['type'])
			{
				case 'admin':
					$this->roles[$row['rewrite']] = explode(',', $row['perm']);
					break;

				case 'site':
					$this->module_roles[$row['rewrite']] = explode(',', $row['perm']);
					break;
			}

			if(!empty($this->roles['all']) && $this->roles['all'][0] == 'all')
			{
				$this->admin = true;
			}
		}
		return true;
	}
	
	/**
	 * Удаляет уникальный хэш сессии
	 * 
	 * @param integer $id номер хэша
	 * @return void
	 */
	public function delete_session_hash($id)
	{
		//если вышла ошибка, то хэш не удаляем, чтобы можно было обновить страницу
		if (! Dev::$is_error)
		{
			DB::query("DELETE FROM {sessions_hash} WHERE id=%d", $id);
		}
	}

	/**
	 * Генерируем идентификационный пользовательский хэш
	 * 
	 * @return string
	 */
	public function get_hash()
	{
		if($this->hash)
		{
			return $this->hash;
		}
		if ($this->id)
		{
			$pass = DB::query_result("SELECT password FROM {users} WHERE id=%d LIMIT 1", $this->id);
			$this->hash = md5(substr($pass, mt_rand(0, 32), mt_rand(0, 32)).mt_rand(23, 567).substr($pass, mt_rand(0, 32), mt_rand(0, 32)));

			DB::query("INSERT INTO {sessions_hash} (user_id, created, hash) VALUES (%d, %d, '%h')", $this->id, time(), $this->hash);
			DB::query("DELETE FROM {sessions_hash} WHERE created<%d", time() - 7200);
			return $this->hash;
		}
		return '';
	}

	/**
	 * Определяет, что текущий пользователь не авторизован
	 * 
	 * @param string $session данные, записанные в сессии
	 * @return boolean true
	 */
	public function anonymous($session = '')
	{
		$this->session = $session;
		return true;
	}

	/**
	 * Очищает информацию о текущем пользователе
	 * 
	 * @return boolean true
	 */
	public function logout()
	{
		$this->anonymous();
		session_destroy();
		$lang = '';
		if($_GET["rewrite"]  != "logout")
		{
			$lang = str_replace('logout', '', $_GET["rewrite"]);
		}
		$this->redirect(BASE_PATH.$lang);
		return true;
	}

	/**
	 * Проверяет авторизован ли пользователь
	 * 
	 * @return boolean
	 */
	public function auth($form_values)
	{
		global $diafan;
		if (!$form_values['name'] || !$form_values['pass'])
		{
			$this->errauth = 'wrong_login_or_pass';
			return false;
		}
		$name = ($diafan->configmodules("mail_as_login", "users", 0, 0) ? "mail" : "name");

		if (DB::query_result("SELECT id FROM {users} WHERE trash='0' AND act='0' AND LOWER(".$name.")=LOWER('%s') LIMIT 1", trim($form_values['name'])))
		{
			$this->errauth = 'blocked';
			return false;
		}

		if ($this->_log())
		{
			$this->errauth = 'blocked_30_min';
			return false;
		}

		$result = DB::query("SELECT * FROM {users} u WHERE trash='0' AND act='1' AND LOWER(".$name.")=LOWER('%s') AND password='%s'", trim($form_values['name']), encrypt(trim($form_values['pass'])));

		if (DB::num_rows($result))
		{
			$user = DB::fetch_object($result);

			$this->set($user);
			
			$rew = '';
			$rewrite = ($_REQUEST["rewrite"] ? $_REQUEST["rewrite"]."/" : '');
			if ($this->lang_id)
			{
				foreach ($diafan->languages as $language)
				{
					if($diafan->language_base_site != $language["id"])
					{
						$rewrite = preg_replace('/^'.$language["shortname"].'(\/)*/', '', $rewrite);
					}
					if($diafan->language_base_site != $this->lang_id)
					{
						$rew = (! $laguage["base_site"]) ? $language["shortname"].'/' : '';
						break;
					}
				}
			}
			Session::duration();
			$this->redirect(BASE_PATH.$rew.$rewrite);
			return true;
		}
		else
		{
			$this->update_log();
			$this->errauth = 'wrong_login_or_pass';
			return false;
		}
	}

	/**
	 * Проверяет авторизован ли пользователь
	 * 
	 * @return boolean
	 */
	public function auth_loginza($form_values)
	{
		global $diafan;
		$profile = file_get_contents('http://loginza.ru/api/authinfo'
			.'?token='.$_POST['token']
			.'&id='.$diafan->configmodules('loginza_widget_id', 'users')
			.'&sig='.md5($_POST['token'].$diafan->configmodules('loginza_skey', 'users'))
		);
		$profile = json_decode($profile);
		
		// проверка на ошибки
		if (! is_object($profile) || !empty($profile->error_message) || !empty($profile->error_type)) {
			return;
		}
		if($diafan->_user->id)
		{
			DB::query("UPDATE {users} SET identity='%h' WHERE id=%d", $profile->identity, $diafan->_user->id);
			return;
		}
		if($profile->identity)
		{
			$result = DB::query("SELECT * FROM {users} u WHERE trash='0' AND act='1' AND identity='%h'", $profile->identity);
		}
		if(! DB::num_rows($result) && ! empty($profile->identities) && is_array($profile->identities))
		{
			foreach($profile->identities as $i)
			{
				if($i)
				{
					$result = DB::query("SELECT * FROM {users} u WHERE trash='0' AND act='1' AND identity='%h'", $i);
					if (DB::num_rows($result))
					{
						break;
					}
				}
			}
		}

		if (! DB::num_rows($result))
		{
			if ($profile->name->full_name)
			{
				$fio = $profile->name->full_name;
			}
			elseif ($profile->name->first_name || $profile->name->last_name)
			{
				$fio = trim($profile->name->first_name.' '.$profile->name->last_name);
			}
			if($profile->nickname)
			{
				$name = $profile->nickname;
			}
			elseif($profile->email)
			{
				list($name, ) = explode('@', $profile->email);
			}
			else
			{
				$name = rand(1, 9999);
			}
			while(DB::query_result("SELECT id FROM {users} WHERE trash='0' AND name='%h'", $name))
			{
				$name .= rand(1, 9999);
			}
			if (!empty($profile->photo))
			{
				$this->create_avatar($name, $profile->photo);
			}
			$role_id = DB::query_result("SELECT id FROM {users_role} WHERE registration='1' AND trash='0' LIMIT 1");
			DB::query("INSERT INTO {users} (name, fio, identity, mail, act, role_id, created) VALUES ('%h', '%h', '%h', '%h', '1', %d, %d)", $name, $fio, $profile->identity, $profile->email, $role_id, time());
			$result = DB::query("SELECT * FROM {users} u WHERE trash='0' AND act='1' AND identity='%h'", $profile->identity);
		}
		$user = DB::fetch_object($result);
		$this->set($user);
		Session::duration();
	}

	/**
	 * Загружает аватар
	 *
	 * @param string $name логин пользователь
	 * @param string $file файл аватара
	 * @return void
	 */
	private function create_avatar($name, $file)
	{
		global $diafan;
		if (! $diafan->configmodules("avatar", "users"))
		{
			return;
		}
		if ($file)
		{
			$tmp_name = ABSOLUTE_PATH.USERFILES.'/avatar/tmp_avatar';
			if(! copy($file, $tmp_name))
			{
				
			}
			list($width, $height) = getimagesize($tmp_name);
			if (! $width || ! $height)
			{
				unlink($tmp_name);
				return;
			}
			if ($width < $diafan->configmodules("avatar_width", "users") || $height < $diafan->configmodules("avatar_height", "users"))
			{
				unlink($tmp_name);
				return;
			}
			Customization::inc('includes/image.php');
			if (!Image::resize($tmp_name, $diafan->configmodules("avatar_width", "users"), $diafan->configmodules("avatar_height", "users"), $diafan->configmodules("avatar_quality", "users"), true, true))
			{
				unlink($tmp_name);
				return;
			}
			$dst_img  = imageCreateTrueColor($diafan->configmodules("avatar_width", "users"), $diafan->configmodules("avatar_height", "users"));
			$original = @imageCreateFromString(file_get_contents($tmp_name));
			imageCopy($dst_img, $original, 0, 0, 0, 0, $diafan->configmodules("avatar_width", "users"), $diafan->configmodules("avatar_height", "users"));
			imagePNG($dst_img, ABSOLUTE_PATH.USERFILES.'/avatar/'.$name.'.png');
			unlink($tmp_name);
		}
		return true;
	}

	/**
	 * Проверяет есть ли права у пользователя на действие для модуля
	 * 
	 * @param string $action действие
	 * @param string $module_name модуль
	 * @param array $roles права пользователя
	 * @param string $type часть сайта административная/пользовательская
	 * @return boolean
	 */
	public function roles($action, $module_name = '', $roles = array(), $type = 'admin')
	{
		if (! $roles)
		{
			$roles = $type == 'admin' ? $this->roles : $this->module_roles;
			if (empty($roles))
			{
				return false;
			}
		}
		if(! $module_name)
		{
			global $diafan;
			$module_name = $diafan->module;
		}

		if(! empty($roles['all']))
		{
			return true;
		}

		if (!empty($roles[$module_name]))
		{
			if ($roles[$module_name][0] == 'all' || in_array($action, $roles[$module_name]))
			{
				return true;
			}
		}
		return false;
	}

	/**
	 * Проверяет лог авторизации для блокировки попытки подбора паролей
	 * 
	 * @return boolean
	 */
	private function _log()
	{
		DB::query("DELETE FROM {log} WHERE created<'%d'", time());
		$ip = getenv('REMOTE_ADDR');
		$result = DB::query("SELECT `count` FROM {log} WHERE ip = '%h'", $ip);
		if (DB::num_rows($result) > 0)
		{
			$row = DB::fetch_array($result);
			if ($row['count'] > 4)
			{
				return true;
			}
		}
		return false;
	}

	/**
	 * Обновляет лог авторизации для блокировки попытки подбора паролей
	 * 
	 * @return boolean
	 */
	private function update_log()
	{
		$ip = getenv('REMOTE_ADDR');
		$date = time() + 1800;
		$result = DB::query("SELECT `count` FROM {log} WHERE ip = '%h'", $ip);
		if (DB::num_rows($result) > 0)
		{
			DB::query("UPDATE {log} SET `count` = `count` + 1, created = '%d' WHERE ip = '%h'", $date, $ip);
		}
		else
		{
			$info = getenv('HTTP_USER_AGENT');
			DB::query("INSERT INTO {log} (ip, created, info) VALUES ('%s', '%d', '%s')", $ip, $date, $info);
		}
		return false;
	}
}