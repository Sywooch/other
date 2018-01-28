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
 * Update_export
 *
 * Экспорт БД
 */

if(! $this->diafan->_user->roles("init", "update/importexport", array(), 'admin'))
{
	include ABSOLUTE_PATH.'includes/404.php';
}

header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: max-age=86400');
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=".DB_PREFIX."db.sql");
header('Content-transfer-encoding: binary');
header("Connection: close");

echo "-- diafan.CMS\n-- Datetime: ".date('Y-m-d H:i:s')."\n-- Site: ".BASE_PATH."\n\n";

$max = 838860;

$url = parse_url(DB_URL);
$dbname = substr($url['path'], 1);
$result = DB::query("SHOW TABLES FROM ".$dbname);
while($row = DB::fetch_array($result))
{
	if (preg_match('/^'.DB_PREFIX.'/', $row["Tables_in_".$dbname]))
	{
		// структура
		$result_s = DB::query("SHOW CREATE TABLE `".$row["Tables_in_".$dbname]."`");
		$row_s = DB::fetch_array($result_s);
		echo "DROP TABLE IF EXISTS `".$row["Tables_in_".$dbname]."`;\n".$row_s["Create Table"].";\n\n";

		// данные
		$exsql = '';
		$result_d = DB::query("SELECT * FROM `".$row["Tables_in_".$dbname]."`");
		while($row_d = DB::fetch_array($result_d))
		{
			$values = '';
			foreach($row_d as $v)
			{
				$values .= $values ? ',' : '';
				if (is_null($v))
				{
					$values .= "NULL";
				}
				else
				{
					$values .= "'".DB::escape_string($v)."'";
				}
			}
			$exsql .= ($exsql ? ',' : '')."(".$values.")";
			if (strlen($exsql) > $max)
			{
				echo "INSERT INTO `".$row["Tables_in_".$dbname]."` VALUES ".$exsql.";\n";
				$exsql = '';
			}
		}
		if ($exsql)
		{
			echo "INSERT INTO `".$row["Tables_in_".$dbname]."` VALUES ".$exsql.";\n";
		}
	}
}

echo "\n-- diafan.CMS dump end\n";
exit;