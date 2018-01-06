<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'u133840767_re2');

/** Имя пользователя MySQL */
define('DB_USER', 'u133840767_re2');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'BViPhm6WsM');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'LIo.7O=%w<K%&_M<HP06WmYw#Qx0DO8ryz`[84;%g|z${(0w+rfV1<j6yado}>(6');
define('SECURE_AUTH_KEY',  '&}E40/MZw03ODMst!i&Xx2Ld{!:[E5%VlIusRwva(b^b?oy.lQWH^JT:)ht:V[Wh');
define('LOGGED_IN_KEY',    '?Z4UICBbw&Cav[Q3-)4m=lbHCu&(x;O.RUF6CJo!9-*m+_ZB2974wRbk-J5OJ2`0');
define('NONCE_KEY',        'eV1N?hZ_(q`xv.932`U]vXwNauk }&Eu|snur59Toh&`qD-I>iY@xO-Y)d{TMr!W');
define('AUTH_SALT',        'NDsr-gXg#cJVZ:4=1bNK8FvTySvMF`IEGS<bx6.U=myS. p:2=,|K$qT&mn,}9.=');
define('SECURE_AUTH_SALT', 'W|euKp /!fv*Kp`}f L{`IW@9{*p:a0.]CsJ{x~~W|pL}Bc|V+InXQ+PO+axn-s=');
define('LOGGED_IN_SALT',   'eX/Ab@OZYUN r->.eXYclr!+)a3 )2XLI%A$i3?D9[|Hy.+r1}*`;o[,`{C<8Qrm');
define('NONCE_SALT',       'aAzo6g[Cl^D9rr3s!5}mob@Fw(8zNq(#r/[U$9:Q0K9U:1WwZ!+eF359vxkZ.}(`');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'am_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
