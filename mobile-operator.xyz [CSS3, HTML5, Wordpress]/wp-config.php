<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'cr32287_base');

/** Имя пользователя MySQL */
define('DB_USER', 'cr32287_base');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'YX9sLJqp');

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
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'bZnpC7dv%BfRzI*sZ4luD01znU1FA%QTgh9b8YFX1~1Wm*@nK/d@o&bb/eO;<fu6');
define('SECURE_AUTH_KEY',  ')TnS3gpNJ+i K=T e`;u:yoVeCvEnR~HAQqSup.2#0/0k#>#o^9%`fnL(Z_ n;d_');
define('LOGGED_IN_KEY',    '71A|C>2hmy)PC7Y-YPs8ps|($Ryc.n0-c?9_cNxN#hd-&[oT)y1Av4iF=^Vh;4N9');
define('NONCE_KEY',        '&X6WV+Mhj{K/CL#BU[8yqZ~& z2/~ECUG4Nj>5,(ix.B1x+s8]--kQiq25A%j)/a');
define('AUTH_SALT',        '&bO#tou(errT ]GroD%uGcN%|&Y*~Gi|<o/1~fq>]1%Z(F0w.a3^$s^haJ}ppOvg');
define('SECURE_AUTH_SALT', ' H i%1jAthSgwY@Sf`eKEjdiE)#oikj u#@Z>u#M5NY^xto0[i&>Vb:;UTcwo]RB');
define('LOGGED_IN_SALT',   'f|^%#y%i=:`UIy8<Mob9X70i7tmgyZw_z+uvL#`HvuO]|MAhfcf!FpwL1|x>r}9/');
define('NONCE_SALT',       'Z=Pi[oS.*hpPy:qA$OvYuUa^8=>o -RQ:9aD2<RHm ~_]-`~*N=>LTpFqK-w+|{y');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
