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
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/g/gsu123ln/portfolio.resident234.xyz/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'gsu123ln_re');

/** Имя пользователя MySQL */
define('DB_USER', 'gsu123ln_re');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '31Z2kcnoA6');

/** Имя сервера MySQL */
//define('DB_HOST', 'localhost');
define('DB_HOST', '127.0.0.1');


/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');



/** Добавленные константы */
define('WP_CATEGORY_PROJECTS_ID', "9");//список проектов
define('WP_CATEGORY_OTHER_ID', 50);//прочее (мелкие правки, один из первых проектов)
define('WP_CATEGORY_SKILLS_ID', 2);//навыки
define('WP_CATEGORY_SERTIFICATES_ID', 54);//сертификаты


define('WP_CATEGORY_SKILLS_environment_ID', 8);//навыки - окружение
define('WP_CATEGORY_SKILLS_tools_ID', 7);//навыки - инструментарий
define('WP_CATEGORY_SKILLS_cms_ID', 6);//навыки - cms
define('WP_CATEGORY_SKILLS_frontend_ID', 5);//навыки - frontend
define('WP_CATEGORY_SKILLS_backendframework_ID', 4);//навыки - backendframework
define('WP_CATEGORY_SKILLS_base_ID', 3);//навыки - base

define('WP_CATEGORY_SKILLS_RANDOM_COLORS_ID', 53);//навыки - base
define('WP_CATEGORY_LINKS_ID', 55);//ссылки


define('WP_Ilovepdf_project_public', "project_public_58fdee98139025d49f1d815fefe5a124_JSvrkf9db4b6e8314265990ad9fbaac8f8ac6");//
define('WP_Ilovepdf_secret_key', "secret_key_27295e1b3b4c8a2771cea75b06536079_uEvbt803084131f93bcc3295feddad73cd90d");//




/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         's%eE|.UANxvqYQd!#&=1|J6q$#Aep+ofR2~V##=GoxW3-VQrQhqArcsRV.6hc< 0');
define('SECURE_AUTH_KEY',  '_K@&-00I- 1uT(MjJ3V*uj.q :T4Nw6XOF+ ~EJ<d~3f@zUgyG3D=hqH5`=,GMj;');
define('LOGGED_IN_KEY',    'aAZ(x$nzz-uxK#tC?V@Kd%c%lJB0@A1qh-@}!k-x<R@V0*}JWJX/w7}V7w~n?nh:');
define('NONCE_KEY',        'k>+vsJ(#$F@q(%w~}#}2GBnal}W*f~@z s=Od>lEDLk@#$nH]fe~nCT}@6/Jn#Gx');
define('AUTH_SALT',        'r8yn2vZv?C|BifpOt0c|rv-:y9e[Ztss?j[]pF[B+k4pFVTa;C?Ke3,#RyVUXWh/');
define('SECURE_AUTH_SALT', '#uESx086s7wli*ed[NGBK+[d`WTV;a_l3.l9$DbmndAa{R,FD?E2lyr9a<X4#*w5');
define('LOGGED_IN_SALT',   'TVz[WcS;z)PQxMT|~UI5I{(lzpU6 ZY)oc7_%0~q&[WpHxaBRfn-Tmo&B`c}2/+6');
define('NONCE_SALT',       '~)p(ndggy~#[~%@))x4eYd69HEVjW$?RcVTb*GQ,brs7M5ub9L wfFE/sXB%iSy{');

define('UPLOAD_MAX_FILESIZE', '200MB');
define('POST_MAX_SIZE', '200MB');
/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'portfolio_';

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
