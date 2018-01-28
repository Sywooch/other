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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * Session
 * 
 * Работа с сессиями в пользовательской части
 */
class Session
{
	/**
	 * Стартует сессию
	 * 
	 * @return boolean true
	 */
	public static function init()
	{
		session_cache_limiter('private_no_expire');
		session_name('SESS'. md5($_SERVER['HTTP_HOST']));
		session_set_save_handler(array('Session', 'open'), array('Session', 'close'), array('Session', 'read'),
		                         array('Session', 'write'), array('Session', 'destroy'), array('Session', 'gc'));
		session_start();
		return true;
	}

	/**
	 * Открывает сессию
	 * 
	 * @param string $save_path
	 * @param string $session_name
	 * @return boolean true
	 */
	public static function open($save_path, $session_name)
	{		
		return true;
	}

	/**
	 * Закрывает сессию освобождает ресурсы
	 * 
	 * @return boolean true
	 */
	public static function close()
	{
		return true;
	}

	/**
	 * Читает сессию
	 * 
	 * @param string $key идентификатор сессии
	 * @return string серилизованные данные сессии
	 */
	public static function read($key)
	{
		global $diafan;
		register_shutdown_function('session_write_close');

		if (! isset($_COOKIE[session_name()]))
		{
			return '';
		}
		$user = DB::fetch_object(DB::query("SELECT u.*, s.* FROM {users} u INNER JOIN {sessions} s ON u.id = s.user_id"
		                                   ." WHERE s.session_id = '%s' AND s.hostname='%s' AND s.user_agent='%s'",
		                                   $key, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));


		if ($user && $user->id > 0)
		{
			$diafan->_user->set($user);
			return $user->session;
		}
		else
		{
			$session = DB::query_result("SELECT session FROM {sessions} WHERE session_id = '%s' AND hostname='%s' AND user_agent='%s' LIMIT 1",
			                            $key, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
			$diafan->_user->anonymous($session);
			return $session;
		}
	}

	/**
	 * Записывает данные в сессию
	 * 
	 * @param string $key идентификатор сессии
	 * @param string $value серилизованные данные сессии
	 * @return boolean true
	 */
	public static function write($key, $value)
	{
		global $diafan;
		$result = DB::query("SELECT session_id FROM {sessions} WHERE session_id = '%s' AND hostname='%s' AND user_agent='%s'",
		                    $key, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);

		if (! DB::num_rows($result))
		{
			if ($diafan->_user->id || $value || count($_COOKIE))
			{
				if (DB::query_result("SELECT COUNT(*) FROM {sessions} WHERE session_id='%h' LIMIT 1", $key))
				{
					DB::query("DELETE FROM {sessions} WHERE session_id='%h'", $key);
				}
				DB::query("INSERT INTO {sessions} (session_id, user_id, hostname, user_agent, session, timestamp)"
				          ." VALUES ('%s', %d, '%s', '%s', '%s', %d)",
				          $key, $diafan->_user->id, $_SERVER["REMOTE_ADDR"], $_SERVER['HTTP_USER_AGENT'], $value, time());
			}
		}
		else
		{
			DB::query("UPDATE {sessions} SET user_id = %d, session = '%s', timestamp = %d WHERE session_id = '%s'",
			          $diafan->_user->id, $value, time(), $key);
		}
		return true;
	}

	/**
	 * Чистит мусор - удаляет сессии старше $lifetime
	 * @param integer $lifetime время хранения сессии в секундах
	 * @return boolean true
	 */
	public static function gc($lifetime = 1209600) // 2 weeks
	{
		DB::query("DELETE FROM {sessions} WHERE timestamp < %d", time() - $lifetime);
		return true;
	}

	/**
	 * Удаляет ссессию
	 * @param string $key идентификатор сессии
	 * @return boolean true
	 */
	public static function destroy($key)
	{
		DB::query("DELETE FROM {sessions} WHERE session_id = '%s' AND hostname='%s' AND user_agent='%s'",
		          $key, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
		return true;
	}

	/**
	 * Определяет продолжительность сессии
	 * 
	 * @return boolean true
	 */
	public static function duration()
	{
		if(! empty($_POST['not_my_computer']))
		{
			$duration = 0;
		}
		else
		{
			$duration = 1209600;
		}
		$params = session_get_cookie_params();
		if($params['lifetime'] != $duration)
		{
			session_set_cookie_params($duration);
			session_regenerate_id(false);
		}
		return true;
	}

	public static function prepare($config)
	{
		if(isset($config))
		{
			self::$config;
		}
	}
}