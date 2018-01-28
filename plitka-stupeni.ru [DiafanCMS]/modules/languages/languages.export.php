<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Languages_export
 *
 * Экспорт языкового файла
 */

if(! $this->diafan->_user->roles("init", "languages", array(), 'admin'))
{
	include ABSOLUTE_PATH.'includes/404.php';
}
$row = DB::fetch_array(DB::query("SELECT * FROM {languages} WHERE shortname='%h' LIMIT 1", $_GET["rewrite"]));
if(! $row)
{
	include ABSOLUTE_PATH.'includes/404.php';
}
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: max-age=86400');
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=".$row["shortname"]);
header('Content-transfer-encoding: binary');
header("Connection: close");

$result = DB::query("SELECT * FROM {languages_translate} WHERE lang_id=%d ORDER BY type DESC, module_name ASC", $row["id"]);
while($row = DB::fetch_array($result))
{
	if(! isset($module_name) || $module_name != $row["module_name"])
	{
		$module_name = $row["module_name"];
		echo "module_name=".$module_name."\n";
	}
	if(! isset($type) || $type != $row["type"])
	{
		$type = $row["type"];
		echo "type=".$type."\n";
	}
	echo str_replace("\n", "", $row["text"]);
	echo "\n";
	echo str_replace("\n", "", $row["text_translate"]);
	echo "\n";
}
exit;