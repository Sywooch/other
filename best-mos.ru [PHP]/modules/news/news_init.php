<?php
#
#        »нициализаци€ класса NewsClass
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) Ђћастерска€ ¬одопь€новаї
#



require('news_main.php');                // модуль вывода новостей
require(TEMPLATES_PATH.'/news_t_config.php');  // файл шаблонов



$lastnews                        = '';
$news                                = '';


define('TABLE_NEWS_CATEGORIES', TABLENAME_PREFIX.'news_cats');

$news_body = ''; // текст страницы новостей

$news_html = ''; // эту переменную вставить в шаблон новостной страницы
$arrows_news;

$news_calendar = ''; // эту переменную вставить в шаблон в месте где выводитс€ календарь

$news_calendar_css = 'calendar-blue'; // css календар€

$news_categories_menu = ''; // меню категорий
$news_years_menu = ''; // меню по годам


?>
