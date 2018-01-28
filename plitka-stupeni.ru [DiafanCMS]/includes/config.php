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
 * Config
 * Набор функций для работы c параметрами сайта
 */
class Config
{
	/**
	 * Сохраняет параметры сайта
	 *
	 * @param array $new_values новые значения параметров сайта
	 * @param array $languages языки сайта
	 * @return boolean true
	 */
	static public function save($new_values, $languages)
	{
		$fields = array(
			'DB_URL',
			'DB_PREFIX',
			'DB_CHARSET',
			'EMAIL_CONFIG', 
			'USERFILES',
			'VERSION_CMS',
			'DATE_UPDATE',
			'DIAFAN_CODE',
			'ADMIN_FOLDER',
			'USERADMIN',
			'MOD_DEVELOPER',
			'MOD_DEVELOPER_CACHE',
			'MOD_DEVELOPER_PROFILING',
			'MOD_DEVELOPER_TECH',
			'FTP_HOST',
			'FTP_DIR',
			'FTP_LOGIN',
			'FTP_PASSWORD',
			'SMTP_MAIL',
			'SMTP_HOST',
			'SMTP_LOGIN',
			'SMTP_PASSWORD',
			'SMTP_PORT',
			'CACHE_MEMCACHED',
			'CACHE_MEMCACHED_HOST',
			'CACHE_MEMCACHED_PORT',
			'ROUTE_END', 
			'ROUTE_AUTO_MODULE',
			'TIMEZONE',
			'RECAPTCHA',
			'RECAPTCHA_PUBLIC_KEY',
			'RECAPTCHA_PRIVATE_KEY',
			'SMS',
			'SMS_KEY',
			'SMS_ID',
			'SMS_SIGNATURE',
			'LAST_1C_EXPORT',
			);
		foreach ($languages as $language)
		{
			$fields[] = 'TIT'.$language["id"];
		}
		foreach ($fields as $field)
		{
			if (! isset($new_values[$field]))
			{
				$new_values[$field] = defined($field) ? constant($field): '';
			}
		}
		$text = '<?php
/**
 * Файл конфигурации
 *
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined(\'DIAFAN\'))
{
	include dirname(__FILE__).\'/includes/404.php\';
}

//папка, в которой лежит сайт. Для корня домена оставьте пустым
define("REVATIVE_PATH", "'.REVATIVE_PATH.'");
';
		foreach ($languages as $language)
		{
			$text .= '
//название сайта, добавляется к тегу title в конце через дефис
define("TIT'.$language["id"].'", "'.$new_values["TIT".$language["id"]].'");
';
		}
		$text.='
//параметры подключения к БД
define("DB_URL", "'.$new_values["DB_URL"].'");

//префикс таблиц сайта в БД
define("DB_PREFIX", "'.$new_values["DB_PREFIX"].'");

//кодировка БД
define("DB_CHARSET", "'.$new_values["DB_CHARSET"].'");

//главный ящик администратора, владельца сайта, используется по умолчанию во всех уведомлениях
define("EMAIL_CONFIG", "'.$new_values["EMAIL_CONFIG"].'");

//название папки с визуальным редактором
define("USERFILES", "'.$new_values["USERFILES"].'");

//версия diafan.CMS
define("VERSION_CMS", "'.$new_values["VERSION_CMS"].'");

//дата последнего автообновления в UNIX-формате
define("DATE_UPDATE", "'.$new_values["DATE_UPDATE"].'");

//код обновления
define("DIAFAN_CODE", "'.$new_values["DIAFAN_CODE"].'");

//ЧПУ папки панели администрирования
define("ADMIN_FOLDER", "'.str_replace("/", "", $new_values["ADMIN_FOLDER"]).'");

//использовать редактирование сайта с пользовательской части true/false (да/нет)
define("USERADMIN", '.($new_values["USERADMIN"] ? 'true' : 'false').');

//включить режим разработки, когда на сайт выводятся все возможные ошибки true/false (да/нет)
define("MOD_DEVELOPER", '.($new_values["MOD_DEVELOPER"] ? 'true' : 'false').');

//включить режим технического обслуживания сайта, сайт станет недоступен для пользователей (шаблон оформления сообщения в /themes/503.php) true/false (да/нет)
define("MOD_DEVELOPER_TECH", '.($new_values["MOD_DEVELOPER_TECH"] ? 'true' : 'false').');

//отключить кеширование true/false (да/нет)
define("MOD_DEVELOPER_CACHE", '.($new_values["MOD_DEVELOPER_CACHE"] ? 'true' : 'false').');

//выводить запросы к БД на сайте true/false (да/нет)
define("MOD_DEVELOPER_PROFILING", '.($new_values["MOD_DEVELOPER_PROFILING"] ? 'true' : 'false').');



//адрес ftp текущего сайта
define("FTP_HOST", "'.$new_values["FTP_HOST"].'");

//путь к diafan.CMS, после входа ftp-пользователя, например, www/site.ru/docs/
define("FTP_DIR", "'.$new_values["FTP_DIR"].'");

//имя ftp-пользователя
define("FTP_LOGIN", "'.$new_values["FTP_LOGIN"].'");

//пароль ftp-пользователя
define("FTP_PASSWORD", "'.$new_values["FTP_PASSWORD"].'");

//использовать smtp-авторизацию при отправке почтовых сообщений true/false (да/нет)
define("SMTP_MAIL", '.($new_values["SMTP_MAIL"] ? 'true' : 'false').');

//url почтового сервера (например, smtp.mail.ru)
define("SMTP_HOST", "'.$new_values["SMTP_HOST"].'");

//логин почты
define("SMTP_LOGIN", "'.$new_values["SMTP_LOGIN"].'");

//пароль к почте
define("SMTP_PASSWORD", "'.$new_values["SMTP_PASSWORD"].'");

//порт (по умолчанию 25)
define("SMTP_PORT", "'.$new_values["SMTP_PORT"].'");

//использовать Memcached сервер для кэширования
define("CACHE_MEMCACHED", '.($new_values["CACHE_MEMCACHED"] ? 'true' : 'false').');

//хост сервера Memcached
define("CACHE_MEMCACHED_HOST", "'.$new_values["CACHE_MEMCACHED_HOST"].'");

//порт сервера Memcached
define("CACHE_MEMCACHED_PORT", "'.$new_values["CACHE_MEMCACHED_PORT"].'");

//часовой пояс сайта, в формате http://www.php.net/manual/en/timezones.php
define("TIMEZONE", "'.($new_values["TIMEZONE"] ? $new_values["TIMEZONE"] : 'Europe/Moscow').'");

//конец строки ЧПУ, по умолчанию "/". Можно ввести ".htm"
define("ROUTE_END", "'.$new_values["ROUTE_END"].'");

//использовать автоматическое формирование ЧПУ для модулей true/false (да/нет)
define("ROUTE_AUTO_MODULE", '.($new_values["ROUTE_AUTO_MODULE"] ? 'true' : 'false').');

//использовать сервис reCAPTCHA (http://www.google.com/recaptcha) true/false (да/нет)
define("RECAPTCHA", '.($new_values["RECAPTCHA"] ? 'true' : 'false').');

//Public Key длс сервиса reCAPTCHA
define("RECAPTCHA_PUBLIC_KEY", "'.$new_values["RECAPTCHA_PUBLIC_KEY"].'");

//Private Key длс сервиса reCAPTCHA
define("RECAPTCHA_PRIVATE_KEY", "'.$new_values["RECAPTCHA_PRIVATE_KEY"].'");

//подключить SMS-уведомления true/false (да/нет)
define("SMS", '.($new_values["SMS"] ? 'true' : 'false').');

// ключ для сервиса byteHand
define("SMS_KEY", "'.$new_values["SMS_KEY"].'");

// id в системе byteHand
define("SMS_ID", "'.$new_values["SMS_ID"].'");

// подпись для уведомлений
define("SMS_SIGNATURE", "'.$new_values["SMS_SIGNATURE"].'");

//дата последнего экспорта заказов в систему 1С:Предприятие
define("LAST_1C_EXPORT", "'.$new_values["LAST_1C_EXPORT"].'");
';
		Customization::inc('includes/files.php');
		Files::save_file($text, "config.php");
		return true;
	}
}