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
define('DB_NAME', 'u4781254_11');

/** Имя пользователя MySQL */
define('DB_USER', 'u4781254_default');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '0mkUonCf');

/** Имя сервера MySQL */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'k])gsf~3dN`XX^gRdy4V+UNG3+~,ZegR|W($)oH`Q.U Qdxx! *Vb+G*B(RqV2kn');
define('SECURE_AUTH_KEY',  '+O@gR|<as`?U5rf7G8Tv<y9]d:m^r7R}0p&u|khddlBDAe|*%,^H{d<E}nw-Bk-L');
define('LOGGED_IN_KEY',    '(Eh8^^q3di&U$7JhH<>z$2yo`x6?maiN+hcC?^I5rS%@}*y{:{~_FM&?S25vs|Ab');
define('NONCE_KEY',        'f+=4VHNLokppBt2@X+W3|9^r|-5X]Py qQk-9]#j{ue!gbkZBMNo7U Fz.VFDOhX');
define('AUTH_SALT',        '|A-_Mq).utQ8$fY~|kl-px5Xxfhd|WJR80)?U<`uCT m|M;x}#USw,O-rcw3~e+V');
define('SECURE_AUTH_SALT', ':pCzZ){q#aB{,*6$mFfp9)&fEm^ea[_#tJ]-Fw+^wU!K&)j_^k)&)S7f`&#Z$ct>');
define('LOGGED_IN_SALT',   'A27 %Ua=N.<[t-fLz$FQ5tr{0n,?oJh:kS@|r<}`7#+M8J}U&}we<Hep_+8S|#J%');
define('NONCE_SALT',       '_+U& yZ`2UB*H|uUln|Y~2s/6vY6KK3K0PC-zEV fljwK&c-;?q|[LC|Qx`Lj6)^');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

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
