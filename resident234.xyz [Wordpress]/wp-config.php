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
define('DB_NAME', 'resident_u56376u563763035_re');

/** Имя пользователя MySQL */
define('DB_USER', 'resident_u56376u563763035_re');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '7N8q7E7l');

/** Имя сервера MySQL */
//define('DB_HOST', 'localhost');
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '.iI=wh|}OXZWx-~]FvOx|S< u!Y{C?dIikPwXD!uH= Ls0<pD)uV|:PA!H8pQzvf');
define('SECURE_AUTH_KEY',  '(|{4@b6ti97hLLC*qG>Sd#3MFXNixl?BW^rvF})LeSe$h~s[cZRuPd}x(DHrO)!m');
define('LOGGED_IN_KEY',    'Y/<{3E2 ^oSX]H$FOWvqTEY{EX~G^^u/4c*Hlj;G^53&(L@EjdSPd6%3(x9G>JiF');
define('NONCE_KEY',        'ca$S8qn]:b.Qa<A(LQ42:F5<Qw,97Zt9z7u{WD~XTsHc#{Kz%,>{>sd#e(3^A^E3');
define('AUTH_SALT',        'OZe;2[[6@:}U/Raa5rQ7x.-%A<HsKYK/%5d=G=YK%}GO^pbgzQ4BMfEO5j:NN+b}');
define('SECURE_AUTH_SALT', '8/>%=+_(`zUjPFRW5cW9{@kTYkOk  OL2MG7T_4Yl*iNUtxP9{1?MZC(7_ZIvcF=');
define('LOGGED_IN_SALT',   'fSA]P3QkmRNGehc[I84pl6 zy;e0m<vxJc$-Sdin|L_Hz_D .V%puOu]eK3v{%3*');
define('NONCE_SALT',       '7B~e[uAf@CfqP6p,ilf0WhEyHOVUVdM3?rgTm!.5b83V*+]mrj>--E/ll{V,hV5r');

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
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);
error_reporting(E_ALL); 
ini_set('display_errors', 1);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
require_once(ABSPATH . 'helper_constants.php');
require_once(ABSPATH . 'helper_functions.php');

