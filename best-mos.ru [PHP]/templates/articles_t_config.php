<?

/***************************************************************************
*  Модуль «Статьи»                                                        *
*  Конфиг темплейтов статей                                              *
*  Version: 3.0                                                             *
*  Copyright: «Мастерская Водопьянова»                                                  *
***************************************************************************/

/*
 * Основной блок статей (анонсы всех статей с навигацией по страницам)
 *
 * Элементы блока статей
 * $_articles - контейнер для вывода одной статьи
 * $_articles_delimiter - разделитель между статьями
 *
 * Допустимые переменные
 * {DOCUMENTDATE(d F Y)} - дата в любом формате, поддерживаемом встроенной в PHP функцией date()
 * {ALIAS} - ссылка на статья
 * {SBODY} - анонс статьи
 */

$date_format = "d-m-Y";
$_date_format_cur['main'] = "d F Y H:i";
$_date_format_cur['last'] = "d F Y H:i";

$_articles['main']['begin'] = <<<EOF
	<h2>Статьи</h2>
	<div id="articles">
EOF;

		//<!--<td>{ARTICLES_IMAGE}</td>-->
$_articles['main']['item'] = <<<EOF
		<table>
		<tr>
        <td>{ARTICLES_IMAGE}</td>
		<td valign="top">
		
		<div class="date">{DATE}</div>
		<a href="{ALIAS}">{TITLE}</a>
		<div style="margin-top: 4px;">{SBODY}</div>
		</td>
		</tr>
		</table>			
		
EOF;

$_articles['main']['separator'] = <<<EOF
		<table border=0 cellpadding=0 cellspacing=0><td height="24"></td></table>
EOF;

$_articles['main']['end'] = <<<EOF
</div>
EOF;

/*
 * Блок последних статей (анонсы нескольких последних статей)
 * Элементы - аналогично основному блоку статей
 * Допустимые переменные - аналогично основному блоку статей
 */
$_articles['last']['begin'] = <<<EOF
	<h2>Статьи</h2>
		<div id="lastarticles">
EOF;

$_articles['last']['item'] = <<<EOF
		<div class="date">{DATE}</div>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<div class="header"><a href="{ALIAS}">{TITLE}</a></div>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
			<p class="ptext">{SBODY}</p>
			<table border="0" cellpadding="0" cellspacing="0"><tr><td height="4"></td></tr></table>
EOF;

$_articles['last']['separator'] = <<<EOF
EOF;

$_articles['last']['end'] = <<<EOF
	</div>
	<table border="0" cellpadding="0" cellspacing="0"><tr><td height="16"></td></tr></table>
	<div><a href="/articles/">Все статьи</a></div>
EOF;

// оформление картинки, выводимой для страницы статьи
// можно оформить так:
//<img src='{IMG_AV}'  align='left'> 
//<a href='{IMG_BIG}' target='new'><img src='{IMG}'  align='left'></a>
//<img src='{IMG_BIG}'  align='left'>
//$_articles_img = "<a target='_new' href='{IMG_BIG}'><img border='0' style=\"border:1px solid navy;margin:0px 10px 10px 0px;\" src='{IMG}' align='left'></a>";
//<img>  для большой картинки статьи
$_articles_img = "<img border='0' style=\"solid navy;margin:0px 10px 10px 0px; width:200px; float:left;\" src='{IMG}' >";
//<img>  для маленькой картинки статьи
$_articles_image = "<a href={ALIAS}><img style=\"margin: 3px 10px 10px 0px; width:90px; \" src='{IMG_AV}' align='left'></a>"; // вывод картинки в списке статей

/*
$_articles_cat = "<a href={ALIAS}>{TITLE}</a>";
$_articles_cat_delimeter = "<br>разделитель<br>";
*/

# меню категорий
$_articles_categories_menu['begin']      = "<h1>Категории</h1>
<div id=menu2><ul>
";
$_articles_categories_menu['allcats']   = "Все категории
";
$_articles_categories_menu['active']     = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_articles_categories_menu['inactive']   = "<li><a href='{ALIAS}'>{TITLE}</a></li>
";
$_articles_categories_menu['delimiter']  = "
";
$_articles_categories_menu['end']        = "</ul></div>
";

# меню по годам
$_articles_years_menu['begin']      = "<h1>Года</h1>
<div id=menu2><ul>
";
$_articles_years_menu['allyears']   = "Все года";
$_articles_years_menu['active']     = "<li><a href='{ALIAS}'>{YEAR}</a></li>";
$_articles_years_menu['inactive']   = "<li><a href='{ALIAS}'>{YEAR}</a></li>";
$_articles_years_menu['delimiter']  = "";
$_articles_years_menu['end']        = "</ul></div>";

# категории на странице конкретной статьи
$_articles_categories_current['title']      = "<b><a href='{ALIAS}'>{TITLE}</a></b>";
$_articles_categories_current['delimiter']  = "|";

?>