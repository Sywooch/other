<?php
#
#        ������������� ������ NewsClass
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) ����������� �����������
#



require('news_main.php');                // ������ ������ ��������
require(TEMPLATES_PATH.'/news_t_config.php');  // ���� ��������



$lastnews                        = '';
$news                                = '';


define('TABLE_NEWS_CATEGORIES', TABLENAME_PREFIX.'news_cats');

$news_body = ''; // ����� �������� ��������

$news_html = ''; // ��� ���������� �������� � ������ ��������� ��������
$arrows_news;

$news_calendar = ''; // ��� ���������� �������� � ������ � ����� ��� ��������� ���������

$news_calendar_css = 'calendar-blue'; // css ���������

$news_categories_menu = ''; // ���� ���������
$news_years_menu = ''; // ���� �� �����


?>
