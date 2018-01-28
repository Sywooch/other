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
define('DB_NAME', 'u563763035_re');

/** Имя пользователя MySQL */
define('DB_USER', 'u563763035_re');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '31Z2kcnoA6');

/** Имя сервера MySQL  127.0.0.1 */
define('DB_HOST', '127.0.0.1');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');





define('PORTFOLIO_WP_CATEGORY_PROJECTS_ID', "9");//список проектов
define('PORTFOLIO_WP_CATEGORY_OTHER_ID', 50);//прочее (мелкие правки, один из первых проектов)
define('PORTFOLIO_WP_CATEGORY_SKILLS_ID', 2);//навыки
define('PORTFOLIO_WP_CATEGORY_SERTIFICATES_ID', 54);//сертификаты
define('PORTFOLIO_WP_CATEGORY_IDE_ID', 75);//инструментарий


define('PORTFOLIO_WP_CATEGORY_SKILLS_environment_ID', 8);//навыки - окружение
define('PORTFOLIO_WP_CATEGORY_SKILLS_tools_ID', 7);//навыки - инструментарий
define('PORTFOLIO_WP_CATEGORY_SKILLS_cms_ID', 6);//навыки - cms
define('PORTFOLIO_WP_CATEGORY_SKILLS_frontend_ID', 5);//навыки - frontend
define('PORTFOLIO_WP_CATEGORY_SKILLS_backendframework_ID', 4);//навыки - backendframework
define('PORTFOLIO_WP_CATEGORY_SKILLS_base_ID', 3);//навыки - base

define('PORTFOLIO_WP_CATEGORY_SKILLS_RANDOM_COLORS_ID', 53);//навыки - base
define('PORTFOLIO_WP_CATEGORY_LINKS_ID', 55);//ссылки

define('PORTFOLIO_WP_UPLOAD_DIR_URL', "http://portfolio.resident234.xyz/wp-content/uploads/");
//путь к папки с изображенияпи у portfolio.resident234.xyz


define('PORTFOLIO_WP_URL', "http://portfolio.resident234.xyz");
define('PERSONAL_WP_HCODE_URL', "http://resident234.h1n.ru");
define('PERSONAL_WP_HCODE_DEFAULT_IMAGE_URL',
    "http://resident234.h1n.ru/h-code/wp-content/uploads/2016/05/wp-logo-white.png");

define('PERSONAL_WP_TEMPLATE_FOLDER', "/wp-content/themes/twentyseventeen_custom");


define('PORTFOLIO_WP_BEST_PROJECTS_LABEL_ID', 56);//id метки "Лучшие проекты"
define('PORTFOLIO_WP_EPISODIC_PARTICIPATION_LABEL_ID', 51);//id метки "Эпизодическое участие"
define('PORTFOLIO_WP_FIRST_PROJECT_LABEL_ID', 52);//id метки "Один из первых проектов"

define('PORTFOLIO_WP_CATEGORY_SITES_ID', 57);// категории сайтов


define('PORTFOLIO_WP_TEXT_1_ID', 74);// произвольный текст 1
define('PORTFOLIO_WP_STOCK_FOTOS_ID', 73);// стоковые фото
define('PORTFOLIO_WP_STOCK_FOTOS_DARK_ID', 77);// стоковые фото тёмные


define('PERSONAL_WP_GITHUB_AUTH_TOKEN', "9db1e2267a570e867b9611c9982ecb4d1a923848");//
define('PERSONAL_WP_GITHUB_PORTFOLIO_REPO', "PORTFOLIO");//


/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'u1Y`nVNW(}3%tJ40Mp8%!5=L;n^7Ya7^v}R,Ai-bopcSg>6az.%H]HO#!FVd9lGj');
define('SECURE_AUTH_KEY',  'md*[sbW!Q=LbE?d/ ?WROLQck.Nfyjpv9-tB8-)+^VL0T[cIW|T|+2IFplcR14g_');
define('LOGGED_IN_KEY',    ')nMOWN(wsz[bgxDV-PHC IyjM#mVL1L< !1tuZ%Ky9E+!mNcoB/C]?-Bd7X[_q/*');
define('NONCE_KEY',        'uHmQ[7{<2./9*b-%ia_&FB1Gxyu#<?X(<riosi|{is*eh~+*,!`~)V(E#F7rhIO>');
define('AUTH_SALT',        '.N#/vq7]eea[~Tsk~e7Mmzo>kdRFg86pT<O#IX_EZgK{-MjqNG$BS6WG}hiq8m[]');
define('SECURE_AUTH_SALT', '[~LBau8nuIG;`#vGE{.x/;CM<b#n%h+XwcGY@!:FT?SRwxeG)b#w6Z~ml}$s(RaR');
define('LOGGED_IN_SALT',   'm/un4W#-HYAN(^eI*l/p;3OD,6XV)#.8vYjm^{-%aATU/fLswecv[FsQqehP`*{u');
define('NONCE_SALT',       'p,O|^3;)M(]j04@SD;osTX*`?XU$$]%GB,rDOi1m:|?fa uX}IcdBt#x`zT?M]$I');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'personal_';

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
