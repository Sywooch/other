<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'kafe');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+N%Gyt4<j!18EF.+U|c&Ipdc:bP;K<(<u~hI4ALsQ;(t|?b</bB--I;#J?-qy~Y+');
define('SECURE_AUTH_KEY',  '-DG-ffUI>>R+TH||.<_0j$&I0&eFMvLx-mJbE5IhT-o%~|5/+tu9sX,|u*WIxxa#');
define('LOGGED_IN_KEY',    'J1m0^CcAk6e:0Iy<x$o C.m~UOAvj3~txi!eNs[3z+ ]kG!X).>/8X}49&)XymcD');
define('NONCE_KEY',        'BHnjoGVBpj+9^m]NXkk!=z)hSX?AGfHD,Wn$c-zy:0EUw1O-}t[%AauS9K0Lu#sP');
define('AUTH_SALT',        '0DKNg2/1gtWp+t-a-JqvA#wkQ+]A,&a4]iF)!vMipL:6D!q%k 3=3?QT-}$8H5;K');
define('SECURE_AUTH_SALT', '|}R0vHr;QPISbN.jnTJ&&puRqPun};(!Ry kf)X{YPU)uj=FLIjQso<:Go/wcQ>[');
define('LOGGED_IN_SALT',   '$$j-WoTlKI&FwN01SHffhY`+B836u#{ruBVTRQA@})<i|oX&Y@Fw+J^3Qy*a%E;=');
define('NONCE_SALT',       'dGI$g+!)s-+etFgO9a884fT!nZ.3 /tq-B/g}sZ(+S~mS!CQWvQt>jyu8a!I;i_V');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
