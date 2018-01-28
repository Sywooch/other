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
 * Config_admin
 *
 * Настройка параметров сайта
 */
class Config_admin extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'base' => array (
			'hr1' => 'hr',
			'db_host' => array(
				'type' => 'text',
				'name' => 'Host для базы данных',
				'help' => 'Узнайте на хостинге, у администратора вашего сервера',
			),
			'db_name' => array(
				'type' => 'text',
				'name' => 'База данных',
				'help' => 'Узнайте на хостинге, у администратора вашего сервера',
			),
			'db_user' => array(
				'type' => 'text',
				'name' => 'Пользователь базы данных',
				'help' => 'Узнайте на хостинге, у администратора вашего сервера',
			),
			'db_pass' => array(
				'type' => 'password',
				'name' => 'Пароль для базы данных',
				'help' => 'Узнайте на хостинге, у администратора вашего сервера',
			),
			'db_prefix' => array(
				'type' => 'text',
				'name' => 'Префикс (например, diafan_)',
				'help' => 'Символы, добавляемые к каждой таблице в базе данных, используемой CMS. Полезно, когда в одной базе данный MySQL имеются таблицы не только CMS. Префикс может быть пустым',
			),
			'db_charset' => array(
				'type' => 'text',
				'name' => 'Кодировка базы данных',
				'disabled' => true,
			),
			'hr2' => 'hr',
			'email' => array(
				'type' => 'email',
				'name' => 'E-mail администратора',
			),
			'userfiles' => array(
				'type' => 'text',
				'name' => 'Папка для хранения пользовательских файлов',
			),
			'admin_folder' => array(
				'type' => 'text',
				'name' => 'Папка административной части',
			),
			'useradmin' => array(
				'type' => 'checkbox',
				'name' => 'Подключить редактирование из пользовательской части',
			),
			'hr3' => 'hr',
			'route_method' => array(
				'type' => 'select',
				'name' => 'Вариант генерации ЧПУ',
			),
			'route_translit_from' => array(
				'type' => 'textarea',
				'name' => 'Способ преобразования',
			),
			'route_translit_to' => array(
				'type' => 'textarea',
			),
			'route_end' => array(
				'type' => 'text',
				'name' => 'ЧПУ оканчивается на',
			),
			'route_auto_module' => array(
				'type' => 'checkbox',
				'name' => 'Генерировать ЧПУ для модулей автоматически',
			),
			'hr4' => 'hr',
			'ftp_host' => array(
				'type' => 'text',
				'name' => 'FTP-хост',
			),
			'ftp_login' => array(
				'type' => 'text',
				'name' => 'FTP-логин',
			),
			'ftp_password' => array(
				'type' => 'password',
				'name' => 'FTP-пароль',
			),
			'ftp_dir' => array(
				'type' => 'text',
				'name' => 'Относительный путь до сайта',
				'help' => 'Нужен, если указанный FTP-пользователь после авторизации попадает не в корень сайта, а неколькими уровнями выше. Тогда нужно указать путь к корню сайта. Например, /www/site.ru/, узнайте на хостинге',
			),
			'hr5' => 'hr',
			'smtp_mail' => array(
				'type' => 'checkbox',
				'name' => 'Использовать SMTP-авторизацию при работе с почтой',
				'help' => 'Рекомендуется.',
			),
			'smtp_host' => array(
				'type' => 'text',
				'name' => 'SMTP-хост (например, smtp.mail.ru)',
			),
			'smtp_login' => array(
				'type' => 'text',
				'name' => 'SMTP-логин',
				'help' => 'Ваш почтовый логин, для входа в почту',
			),
			'smtp_password' => array(
				'type' => 'password',
				'name' => 'SMTP-пароль',
				'help' => 'Ваш почтовый пароль, для входа в почту',
			),
			'smtp_port' => array(
				'type' => 'numtext',
				'name' => 'SMTP-порт (по умолчанию 25)',
				'help' => 'В большинстве случаев можно не указывать',
			),
			'hr6' => 'hr',
			'cache_memcached' => array(
				'type' => 'checkbox',
				'name' => 'Кэширование Memcached',
			),
			'cache_memcached_host' => array(
				'type' => 'text',
				'name' => 'Xост сервера Memcached',
			),
			'cache_memcached_port' => array(
				'type' => 'numtext',
				'name' => 'Порт сервера Memcached',
			),
			'hr7' => 'hr',
			'sms' => array(
				'type' => 'checkbox',
				'name' => 'Подключить SMS-уведомления<br>(требуется <a href="http://www.bytehand.com/?r=c3c2c0125f667cb1" target="_blank">регистрация</a>).',
			),
			'sms_key' => array(
				'type' => 'text',
				'name' => 'Ключ',
			),
			'sms_id' => array(
				'type' => 'text',
				'name' => 'ID',
			),
			'sms_signature' => array(
				'type' => 'text',
				'name' => 'Подпись',
			),
			'hr8' => 'hr',
			'timezone' => array(
				'type' => 'text',
				'name' => 'Таймзона',
				'help' => 'Часовой пояс. По умолчанию: Europe/Moscow',
			),
			'hr9' => 'hr',
			'recaptcha' => array(
				'type' => 'checkbox',
				'name' => 'Подключить сервис <a href="http://www.google.com/recaptcha">reCAPTCHA</a>',
			),
			'recaptcha_public_key' => array(
				'type' => 'text',
				'name' => 'Public Key длс сервиса reCAPTCHA',
			),
			'recaptcha_private_key' => array(
				'type' => 'text',
				'name' => 'Private Key длс сервиса reCAPTCHA',
			),
		),
		'mod_developer_tab' => array (
			'mod_developer' => array(
				'type' => 'checkbox',
				'name' => 'Включить режим разработки',
				'help' => 'Внизу сайта будут выводиться все PHP-ошибки.',
			),
			'mod_developer_tech' => array(
				'type' => 'checkbox',
				'name' => 'Перевести сайт в режим обслуживания',
				'help' => 'Все остальные пользователи будут видеть только страницу <em>themes/503.php</em> &ndash; &laquo;Сайт в разработке, временно недоступен&raquo;.',
			),
			'mod_developer_cache' => array(
				'type' => 'checkbox',
				'name' => 'Отключить кэширование',
				'help' => 'Обязательно отключать при доработке скриптов и обязательно включать в штатном режиме работы сайта. Постоянно отключенное кэширование может замедлить работу системы.',
			),
			'mod_developer_delete_cache' => array(
				'type' => 'checkbox',
				'name' => 'Сбросить кэш',
				'help' => 'Если отметить и сохранить, кэш сбросится. Галка при этом не останется отмечена.',
			),
			'mod_developer_profiling' => array(
				'type' => 'checkbox',
				'name' => 'Включить профилирование SQL-запросов',
				'help' => 'Выводит внизу сайта все выполненные SQL-запросы и время их выполнения',
			),
		),
	);

	/**
	 * @var array названия табов
	 */
	public $tabs_name = array(
		'base' => 'Основные',
		'mod_developer_tab' =>'Режим разработки',
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'only_edit', // модуль состоит только из формы редактирования
		'tab_card', 
	);

	/**
	 * @var array зависимости между полями
	 */
	public $show_tr_click_checkbox = array(
		'smtp_mail' => array(
			'smtp_host',
			'smtp_login',
			'smtp_password',
			'smtp_port',
		),
		'cache_memcached' => array(
			'cache_memcached_host',
			'cache_memcached_port',
		),
		'sms' => array(
			'sms_key',
			'sms_id',
			'sms_signature',
		),
		'recaptcha' => array(
			'recaptcha_public_key',
			'recaptcha_private_key',
		),
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'route_method' => array(
			1 => 'транслит',
			2 => 'перевод на английский',
			3 => 'русская кириллица',
		),
	);

	/**
	 * Подготавливает конфигурацию модуля
	 * @return void
	 */
	public function prepare_config()
	{
		foreach ($this->diafan->languages as $language)
		{
			$base = $this->variables['base'];
			$this->variables['base'] = array();
			$this->variables['base']['title_'.$language["id"]] = array(
				'type' => 'text',
				'name' => $this->diafan->_('Название сайта').($language["shortname"] ? ' ('.$language["shortname"].')' : '')
			);
			foreach($base as $k => $v)
			{
				$this->variables['base'][$k] = $v;
			}
		}
	}

	/**
	 * Выводит форму редактирования параметров сайта
	 * @return boolean true
	 */
	public function edit()
	{
		if (file_exists(ABSOLUTE_PATH.'config.php') &&  ! is_writable(ABSOLUTE_PATH.'config.php'))
		{
			echo '<div class="error">'.$this->diafan->_('Установите права на запись (777) для файла конфигурации config.php').'</div>';
		}
		echo '<script type="text/javascript" src="'.BASE_PATH.'modules/config/admin/config.admin.js"></script>';
		parent::__call('edit', array());

		return true;
	}

	/**
	 * Задает значения полей для формы
	 * 
	 * @return array
	 */
	public function get_values()
	{
		$url = parse_url(DB_URL);

		$translit_array = explode('````', DB::query_result("SELECT value FROM {config} WHERE module_name='route' AND name='translit_array' LIMIT 1"), 2);
		$array = array(
			'db_host'                    => urldecode($url['host']),
			'db_user'                    => urldecode($url['user']),
			'db_pass'                    => isset($url['pass']) ? urldecode($url['pass']) : '',
			'db_name'                    => substr(urldecode($url['path']), 1),
			'db_prefix'                  => DB_PREFIX,
			'email'                      => EMAIL_CONFIG,
			'db_charset'                 => DB_CHARSET,
			'userfiles'                  => USERFILES,
			'admin_folder'               => ADMIN_FOLDER,
			'useradmin'                  => USERADMIN,
			'mod_developer'              => MOD_DEVELOPER,
			'mod_developer_tech'         => MOD_DEVELOPER_TECH,
			'mod_developer_profiling'    => MOD_DEVELOPER_PROFILING,
			'mod_developer_cache'        => MOD_DEVELOPER_CACHE,
			'mod_developer_delete_cache' => false,

			'route_method'               => DB::query_result("SELECT value FROM {config} WHERE module_name='route' AND name='method' LIMIT 1"),
			'route_translit_from'        => $translit_array[0],
			'route_translit_to'          => ! empty($translit_array[1]) ? $translit_array[1] : '',
			'route_end'                  => ROUTE_END,
			'route_auto_module'          => ROUTE_AUTO_MODULE,

			'ftp_host'                   => FTP_HOST,
			'ftp_login'                  => FTP_LOGIN,
			'ftp_password'               => FTP_PASSWORD,
			'ftp_dir'                    => FTP_DIR,
			
			'smtp_mail'                  => SMTP_MAIL,
			'smtp_host'                  => SMTP_HOST,
			'smtp_login'                 => SMTP_LOGIN,
			'smtp_password'              => SMTP_PASSWORD,
			'smtp_port'                  => SMTP_PORT,

			'cache_memcached'            => CACHE_MEMCACHED,
			'cache_memcached_host'       => CACHE_MEMCACHED_HOST,
			'cache_memcached_port'       => CACHE_MEMCACHED_PORT,

			'sms'                        => SMS,
			'sms_id'                     => SMS_ID,
			'sms_key'                    => SMS_KEY,
			'sms_signature'              => SMS_SIGNATURE,

			'timezone'                   => defined('TIMEZONE') ? TIMEZONE : '',
			
			'recaptcha'                  => RECAPTCHA,
			'recaptcha_public_key'       => RECAPTCHA_PUBLIC_KEY,
			'recaptcha_private_key'      => RECAPTCHA_PRIVATE_KEY,
		);

		foreach ($this->diafan->languages as $language)
		{
			$array['title_'.$language["id"]] = (defined('TIT'.$language["id"]) ? constant('TIT'.$language["id"]) : '');
		}

		return $array;
		
	}

	/**
	 * Проверка параметров подключения к Memcached
	 * 
	 * @return void
	 */
	public function validate_variable_cache_memcached()
	{
		if(! empty($_POST["cache_memcached"]))
		{
			if(! class_exists('Memcached'))
			{
				$this->diafan->set_error("cache_memcached", "Не установлен модуль Memcached для PHP");
			}
			elseif(empty($_POST["cache_memcached_host"]) || empty($_POST["cache_memcached_port"]))
			{
				$this->diafan->set_error("cache_memcached", "Укажите хост и порт сервера Memcached");
			}
			else
			{
				Customization::inc('includes/cache/cache.memcached.php');
				if(! Cache_memcached::check($_POST["cache_memcached_host"], $_POST["cache_memcached_port"]))
				{
					$this->diafan->set_error("cache_memcached", "Не верные параметры подключения");
				}
			}
		}
	}

	/**
	 * Валидация имени папки
	 * 
	 * @return void
	 */
	public function validate_variable_admin_folder()
	{
		if(strpos($_POST["admin_folder"], '/') !== false)
		{
			$this->diafan->set_error("admin_folder", "Символ / не доступстим в названии папки");
		}
	}

	/**
	 * Проверка параметров подключения к SMTP
	 * 
	 * @return void
	 */
	public function validate_variable_smtp_mail()
	{
		if(! empty($_POST["smtp_mail"]))
		{
			if(empty($_POST["smtp_host"]) || empty($_POST["smtp_login"]) || empty($_POST["smtp_password"]))
			{
				$this->diafan->set_error("smtp_mail", "Укажите хост, логин, пароль для SMTP-авторизации");
			}
		}
	}

	/**
	 * Сохраняет файл конфигурации
	 * 
	 * @return boolean
	 */
	public function save()
	{
		// Прошел ли пользователь проверку идентификационного хэша
		if (! $this->diafan->_user->checked)
		{
			$this->diafan->redirect(URL);
			return false;
		}

		//проверка прав на сохранение
		if (! $this->diafan->_user->roles('edit', 'config'))
		{
			$this->diafan->redirect(URL);
			return false;
		}

		$url = parse_url(DB_URL);
		$diafan_user = urldecode($url['user']);
		if (isset($url['pass']))
		{
			$diafan_pass = urldecode($url['pass']);
		}
		else
		{
			$diafan_pass = '';
		}
		$diafan_host = urldecode($url['host']);
		$diafan_dbname = substr(urldecode($url['path']), 1);

		$dir_url_path = '';

		if ($_SERVER['REQUEST_URI'] != "/".ADMIN_FOLDER."/config/save1/")
		{
			$dir_url_path = str_replace("/".ADMIN_FOLDER."/config/save1/", "", $_SERVER['REQUEST_URI']);
		}

		$admin_folder = substr($this->diafan->get_param($_POST, "admin_folder", ADMIN_FOLDER, 1), 0, 20);
		
		$sheme = extension_loaded('mysqli') ? 'mysqli' : 'mysql';

		$new_values = array(
				'DB_URL' => $sheme.'://'.str_replace('"', '&quot;', $this->diafan->get_param($_POST, "db_user", $diafan_user, 1))
				            .($_POST["db_pass"] ? ":".str_replace('"', '&quot;', $this->diafan->get_param($_POST, "db_pass_update", $diafan_pass, 1)) : '')
				            ."@".str_replace('"', '&quot;', $this->diafan->get_param($_POST, "db_host", $diafan_host, 1))
				            ."/".str_replace('"', '&quot;', $this->diafan->get_param($_POST, "db_name", $diafan_dbname, 1)),
				'DB_PREFIX' => str_replace('"','&quot;', $this->diafan->get_param($_POST, "db_prefix", DB_PREFIX, 1)),
				'EMAIL_CONFIG' => str_replace('"','&quot;', $this->diafan->get_param($_POST, "email", EMAIL_CONFIG, 1)),
				'USERFILES' => $this->diafan->get_param($_POST, "userfiles", USERFILES, 1),
				'ADMIN_FOLDER' => $admin_folder,
				'USERADMIN' => (! empty($_POST["useradmin"]) ? true : false),
				'MOD_DEVELOPER' => (! empty($_POST["mod_developer"]) ? true : false),
				'MOD_DEVELOPER_TECH' => (! empty($_POST["mod_developer_tech"]) ? true : false),
				'MOD_DEVELOPER_CACHE' => (! empty($_POST["mod_developer_cache"]) ? true : false),
				'MOD_DEVELOPER_PROFILING' => (! empty($_POST["mod_developer_profiling"]) ? true : false),
				'FTP_HOST' => $this->diafan->get_param($_POST, "ftp_host", FTP_HOST, 1),
				'FTP_DIR' => $this->diafan->get_param($_POST, "ftp_dir", FTP_DIR, 1),
				'FTP_LOGIN' => $this->diafan->get_param($_POST, "ftp_login", FTP_LOGIN, 1),
				'FTP_PASSWORD' => $this->diafan->get_param($_POST, "ftp_password", FTP_PASSWORD, 1),
				'SMTP_MAIL' => (! empty($_POST["smtp_mail"]) ? true : false),
				'SMTP_HOST' => $this->diafan->get_param($_POST, "smtp_host", "", 1),
				'SMTP_LOGIN' => $this->diafan->get_param($_POST, "smtp_login", "", 1),
				'SMTP_PASSWORD' => $this->diafan->get_param($_POST, "smtp_password", "", 1),
				'SMTP_PORT' => $this->diafan->get_param($_POST, "smtp_port", "", 1),
				'CACHE_MEMCACHED' => (class_exists('Memcached') && ! empty($_POST["cache_memcached"]) ? true : false),
				'CACHE_MEMCACHED_HOST' => $this->diafan->get_param($_POST, "cache_memcached_host", "", 1),
				'CACHE_MEMCACHED_PORT' => $this->diafan->get_param($_POST, "cache_memcached_port", "", 1),
				'TIMEZONE' => $this->diafan->get_param($_POST, "timezone", "", 1),
				'ROUTE_END' => $this->diafan->get_param($_POST, "route_end", "", 1),
				'ROUTE_AUTO_MODULE' => (! empty($_POST["route_auto_module"]) ? true : false),
				'SMS' => (! empty($_POST["sms"]) ? true : false),
				'SMS_ID' => $_POST["sms_id"],
				'SMS_KEY' => $_POST["sms_key"],
				'SMS_SIGNATURE' => $_POST["sms_signature"],
				'RECAPTCHA' => (! empty($_POST["recaptcha"]) ? true : false),
				'RECAPTCHA_PUBLIC_KEY' => $_POST["recaptcha_public_key"],
				'RECAPTCHA_PRIVATE_KEY' => $_POST["recaptcha_private_key"],
			);
		foreach ($this->diafan->languages as $language)
		{
			$new_values['TIT'.$language["id"]] = str_replace('"', '', htmlspecialchars(stripslashes($this->diafan->get_param($_POST, "title_".$language["id"], '', 1))));
		}
		$route_method = DB::fetch_array(DB::query("SELECT id, value FROM {config} WHERE module_name='route' AND name='method' LIMIT 1"));
		if(! $route_method)
		{
			DB::query("INSERT INTO {config} (module_name, name, value) VALUES ('route', 'method', '%d')", $_POST["route_method"]);
		}
		elseif($route_method["value"] != $_POST["route_method"])
		{
			DB::query("UPDATE {config} SET value='%d' WHERE module_name='route' AND name='method'", $_POST["route_method"]);
		}

		$route_translit_array = DB::fetch_array(DB::query("SELECT id, value FROM {config} WHERE module_name='route' AND name='translit_array' LIMIT 1"));
		if(! $route_translit_array)
		{
			DB::query("INSERT INTO {config} (module_name, name, value) VALUES ('route', 'translit_array', '%h')", $_POST["route_translit_from"]."````".$_POST["route_translit_to"]);
		}
		elseif($route_translit_array["value"] != $_POST["route_translit_from"]."````".$_POST["route_translit_to"])
		{
			DB::query("UPDATE {config} SET value='%h' WHERE module_name='route' AND name='translit_array'", $_POST["route_translit_from"]."````".$_POST["route_translit_to"]);
		}

		Customization::inc('includes/config.php');
		Config::save($new_values, $this->diafan->languages);

		if (! empty($_POST["mod_developer_delete_cache"]) || ROUTE_END != $this->diafan->get_param($_POST, "route_end", "", 1))
		{
			$this->diafan->_cache->delete("", array());
		}
		if ($admin_folder == ADMIN_FOLDER)
		{
			$this->diafan->redirect(URL.'success1/');
		}
		else
		{
			$this->diafan->redirect('http://'.BASE_URL.'/'.$admin_folder.'/config/success1/');
		}
		return true;
	}
}
