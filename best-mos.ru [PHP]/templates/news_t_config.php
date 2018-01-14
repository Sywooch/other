<?

/***************************************************************************
*  Модуль «Новости»                                                        *
*  Конфиг темплейтов новостей                                              *
*  Version: 3.0                                                            *
*  Copyright: «Мастерская Водопьянова»                                                  *
***************************************************************************/

/*
 * Основной блок новостей (анонсы всех новостей с навигацией по страницам)
 *
 * Элементы блока новостей
 * $_news - контейнер для вывода одной новости
 * $_news_delimiter - разделитель между новостями
 *
 * Допустимые переменные
 * {DOCUMENTDATE(d F Y)} - дата в любом формате, поддерживаемом встроенной в PHP функцией date()
 * {ALIAS} - ссылка на новость
 * {SBODY} - анонс новости
 */

$date_format = "d-m-Y";
$_date_format_cur['main'] = "d F Y H:i";
$_date_format_cur['last'] = "d F Y H:i";

$_news['main']['begin'] = <<<EOF
	<h2>Новости</h2>
	<div id="news">
EOF;

$_news['main']['item'] = <<<EOF
		<div class="date">{DATE}</div>
		<a href="{ALIAS}">{TITLE}</a>
		<div style="margin-top: 4px;">{SBODY}</div>
EOF;

$_news['main']['separator'] = <<<EOF
		<table border=0 cellpadding=0 cellspacing=0><td height="24"></td></table>
EOF;

$_news['main']['end'] = <<<EOF
</div>
EOF;

/*
 * Блок последних новостей (анонсы нескольких последних новостей)
 * Элементы - аналогично основному блоку новостей
 * Допустимые переменные - аналогично основному блоку новостей
 */
$_news['last']['begin'] = <<<EOF
	<h2 style="color:#FF8A00;">Новости</h2>
		<div id="lastnews">
EOF;

$_news['last']['item'] = <<<EOF
		<div class="date">{DATE}</div>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<div class="header"><a href="{ALIAS}">{TITLE}</a></div>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<p class="ptext">{SBODY}</p>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
EOF;

$_news['last']['separator'] = <<<EOF
EOF;

$_news['last']['end'] = <<<EOF
	</div>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height="16"></td></tr></table>
	<div><a href="/news/">Все новости</a></div>
EOF;

// оформление картинки, выводимой для страницы новости
// можно оформить так:
// <img src='{IMG_AV}'  align='left'> {IMG_AV_WIDTH},{IMG_AV_HEIGHT},{FILE_AV_SIZE}<hr>
// <a href='{IMG_BIG}' target='new'><img src='{IMG}'  align='left'></a> {IMG_WIDTH},{IMG_HEIGHT},{FILE_SIZE}<hr>
// <img src='{IMG_BIG}'  align='left'> {IMG_BIG_WIDTH},{IMG_BIG_HEIGHT},{FILE_BIG_SIZE}
$_news_img = "<a target='_new' href='{IMG_BIG}'><img border='0' style=\"border:1px solid navy;margin:0px 10px 10px 0px;\" src='{IMG}' align='left'></a>";
$_news_image = "<img style=\"margin: 3px 10px 10px 0px;\" src='{IMG_AV}' align='left'>"; // вывод картинки в списке новостей

/*
$_news_cat = "<a href={ALIAS}>{TITLE}</a>";
$_news_cat_delimeter = "<br>разделитель<br>";
*/

# меню категорий
$_news_categories_menu['begin']      = "<h1>Категории</h1>
<div id=menu2><ul>
";
$_news_categories_menu['allcats']   = "Все категории
";
$_news_categories_menu['active']     = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_news_categories_menu['inactive']   = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_news_categories_menu['delimiter']  = "
";
$_news_categories_menu['end']        = "</ul></div>
";

# меню по годам
$_news_years_menu['begin']      = "<h1>Года</h1>
<div id=menu2><ul>
";
$_news_years_menu['allyears']   = "Все года";
$_news_years_menu['active']     = "<li><a href='{ALIAS}'>{YEAR}</a></li>";
$_news_years_menu['inactive']   = "<li><a href='{ALIAS}'>{YEAR}</a></li>";
$_news_years_menu['delimiter']  = "";
$_news_years_menu['end']        = "</ul></div>";

# категории на странице конкретной новости
$_news_categories_current['title']      = "<b><a href='{ALIAS}'>{TITLE}</a></b>";
$_news_categories_current['delimiter']  = "|";

?>