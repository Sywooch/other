<?php
/**
 * Ошибка 403. Доступ запрещен
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
$diafan->theme = '403.php';

header('HTTP/1.0 403 Forbidden');
header('Content-Type: text/html; charset=utf-8');
$parser = new Parser_theme($diafan);
$parser->show_theme(new stdClass());

exit;