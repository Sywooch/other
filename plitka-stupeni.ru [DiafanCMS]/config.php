<?php
/**
 * Файл конфигурации
 *
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(__FILE__).'/includes/404.php';
}

//папка, в которой лежит сайт. Для корня домена оставьте пустым
define("REVATIVE_PATH", "");

//название сайта, добавляется к тегу title в конце через дефис
define("TIT1", "Плитка и Ступени ");

//параметры подключения к БД
define("DB_URL", "mysqli://u266638_site:LesSli.Er73E.Y@u266638.mysql.masterhost.ru/u266638_2");

//префикс таблиц сайта в БД
define("DB_PREFIX", "diafan_");

//кодировка БД
define("DB_CHARSET", "utf8");

//главный ящик администратора, владельца сайта, используется по умолчанию во всех уведомлениях
define("EMAIL_CONFIG", "support@idecision.ru");

//название папки с визуальным редактором
define("USERFILES", "userfiles");

//версия diafan.CMS
define("VERSION_CMS", "5.2");

//дата последнего автообновления в UNIX-формате
define("DATE_UPDATE", "1373004480");

//код обновления
define("DIAFAN_CODE", "");

//ЧПУ папки панели администрирования
define("ADMIN_FOLDER", "psadmin");

//использовать редактирование сайта с пользовательской части true/false (да/нет)
define("USERADMIN", true);

//включить режим разработки, когда на сайт выводятся все возможные ошибки true/false (да/нет)
define("MOD_DEVELOPER", false);

//включить режим технического обслуживания сайта, сайт станет недоступен для пользователей (шаблон оформления сообщения в /themes/503.php) true/false (да/нет)
define("MOD_DEVELOPER_TECH", false);

//отключить кеширование true/false (да/нет)
define("MOD_DEVELOPER_CACHE", true);

//выводить запросы к БД на сайте true/false (да/нет)
define("MOD_DEVELOPER_PROFILING", false);



//адрес ftp текущего сайта
define("FTP_HOST", "");

//путь к diafan.CMS, после входа ftp-пользователя, например, www/site.ru/docs/
define("FTP_DIR", "");

//имя ftp-пользователя
define("FTP_LOGIN", "");

//пароль ftp-пользователя
define("FTP_PASSWORD", "");

//использовать smtp-авторизацию при отправке почтовых сообщений true/false (да/нет)
define("SMTP_MAIL", false);

//url почтового сервера (например, smtp.mail.ru)
define("SMTP_HOST", "");

//логин почты
define("SMTP_LOGIN", "");

//пароль к почте
define("SMTP_PASSWORD", "");

//порт (по умолчанию 25)
define("SMTP_PORT", "");

//использовать Memcached сервер для кэширования
define("CACHE_MEMCACHED", false);

//хост сервера Memcached
define("CACHE_MEMCACHED_HOST", "");

//порт сервера Memcached
define("CACHE_MEMCACHED_PORT", "");

//часовой пояс сайта, в формате http://www.php.net/manual/en/timezones.php
define("TIMEZONE", "Europe/Moscow");

//конец строки ЧПУ, по умолчанию "/". Можно ввести ".htm"
define("ROUTE_END", "/");

//использовать автоматическое формирование ЧПУ для модулей true/false (да/нет)
define("ROUTE_AUTO_MODULE", true);

//использовать сервис reCAPTCHA (http://www.google.com/recaptcha) true/false (да/нет)
define("RECAPTCHA", false);

//Public Key длс сервиса reCAPTCHA
define("RECAPTCHA_PUBLIC_KEY", "");

//Private Key длс сервиса reCAPTCHA
define("RECAPTCHA_PRIVATE_KEY", "");

//подключить SMS-уведомления true/false (да/нет)
define("SMS", false);

// ключ для сервиса byteHand
define("SMS_KEY", "");

// id в системе byteHand
define("SMS_ID", "");

// подпись для уведомлений
define("SMS_SIGNATURE", "");

//дата последнего экспорта заказов в систему 1С:Предприятие
define("LAST_1C_EXPORT", "");
