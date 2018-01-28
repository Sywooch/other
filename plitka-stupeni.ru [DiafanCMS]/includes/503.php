<?php
/**
 * Ошибка 503. Сервис недоступен
 * 
 * Модель страницы, выводимой на сайте для всех посетителей, когда включен параметр "Сайт на техобслуживании".
 * Оформление страницы в файле шаблона: /themes/tech.php
 * Администратор при этом может ходить по сайту как обычно.
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

global $diafan;
Customization::inc('includes/parser_theme.php');
$diafan->theme = '503.php';

header('HTTP/1.0 503 Service Unavailable');
header('Content-Type: text/html; charset=utf-8');
$parser = new Parser_theme($diafan);
$parser->show_theme(new stdClass());

exit;