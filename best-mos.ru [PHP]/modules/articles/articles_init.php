<?php
#
#        ������������� ������ ArticlesClass
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) ����������� �����������
#


require('articles_main.php');                // ������ ������ ������
require(TEMPLATES_PATH.'/articles_t_config.php');  // ���� ��������



$lastarticles                        = '';
$articles                                = '';


define('TABLE_NEWS_CATEGORIES', TABLENAME_PREFIX.'articles_cats');

$articles_body = ''; // ����� �������� ������

$articles_html = ''; // ��� ���������� �������� � ������ ��������� ��������
$arrows_articles;

$articles_calendar = ''; // ��� ���������� �������� � ������ � ����� ��� ��������� ���������

$articles_calendar_css = 'calendar-blue'; // css ���������

$articles_categories_menu = ''; // ���� ���������
$articles_years_menu = ''; // ���� �� �����


?>
