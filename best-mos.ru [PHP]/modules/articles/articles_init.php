<?php
#
#        »нициализаци€ класса ArticlesClass
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) Ђћастерска€ ¬одопь€новаї
#


require('articles_main.php');                // модуль вывода статей
require(TEMPLATES_PATH.'/articles_t_config.php');  // файл шаблонов



$lastarticles                        = '';
$articles                                = '';


define('TABLE_NEWS_CATEGORIES', TABLENAME_PREFIX.'articles_cats');

$articles_body = ''; // текст страницы статей

$articles_html = ''; // эту переменную вставить в шаблон новостной страницы
$arrows_articles;

$articles_calendar = ''; // эту переменную вставить в шаблон в месте где выводитс€ календарь

$articles_calendar_css = 'calendar-blue'; // css календар€

$articles_categories_menu = ''; // меню категорий
$articles_years_menu = ''; // меню по годам


?>
