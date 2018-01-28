<?php
/**
 * Ошибка 404. Страница не найдена
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if(! defined('DIAFAN'))
{
	$_GET["rewrite"] = 'includes/404.php';
	include_once dirname(dirname(__FILE__)).'/index.php';
}
else
{
	global $diafan;
	Customization::inc('includes/function.php');
	Customization::inc('includes/parser_theme.php');
	$diafan->theme = '404.php';

	header('HTTP/1.0 404 Not Found');
	header('Content-Type: text/html; charset=utf-8');
	$parser = new Parser_theme($diafan);
	$parser->show_theme(new stdClass());
}

exit;