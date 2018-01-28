<?php
/**
 * Экспорт ключевых слов
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if(! $this->diafan->_user->roles("init", "keywords", array(), 'admin'))
{
	include ABSOLUTE_PATH.'includes/404.php';
}
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: max-age=86400');
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=keywords.txt");
header('Content-transfer-encoding: binary');
header("Connection: close");

$result = DB::query("SELECT * FROM {keywords} WHERE trash='0' ORDER BY id ASC");
while($row = DB::fetch_array($result))
{
	echo str_replace("\n", "", $row["text"]);
	echo "\n";
	echo str_replace("\n", "", $row["link"]);
	echo "\n";
}
exit;