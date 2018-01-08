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
define('DB_NAME', 'u850716429_dig');

/** Имя пользователя MySQL */
define('DB_USER', 'u850716429_dig');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'PBJ8rj4VRz');

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
define('AUTH_KEY',         '4%o,N>0.A.,S!^+d<T*^R+LS6-rHT!DTQVylICGu@[u4zXV+<8:]^;9M/`1i}e~V');
define('SECURE_AUTH_KEY',  '}4XoIvekY%=PN&kx!m+Qw>MU/SH>#K}zYr2+AXxVd?)>(|Jva;-?P/ZkSQh5BXN6');
define('LOGGED_IN_KEY',    '[{bGB+@v8d;wq*|EA@E523QAWt?U3vXhPu *9wQHP`U:02#_dsBr<I]em~?.h-vU');
define('NONCE_KEY',        '8vLz-+}v ma[Kwd^5bwe![-E:|=]!}F<V8=Y/ql=1BDJt-YmF-&}c3lfLNK99^am');
define('AUTH_SALT',        '[[FEwVmM1ds>~,/.-P!0aQkt6UsWfSoN|YV;BZ!IX5,#IkGuW41|!8[^#uPo<@jG');
define('SECURE_AUTH_SALT', 'N0}E,) FVqT1R/p([*E*efGs8MYP$v1`oP3I?0-i4`e/=[nlm$T-0]JW`A)}B$&/');
define('LOGGED_IN_SALT',   'wj+XbN#{RDtXbA[;QAOj|@x-6H##o+v>i1}@g]/xbyZE89qBnG[P<q0%giULDEx|');
define('NONCE_SALT',       's`M~@8xy-;xn`@p+7smU`SYO=w*4|6YY+IAc2&GGwo%,TEda+DtsU-SR$w:z4,FM');

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
