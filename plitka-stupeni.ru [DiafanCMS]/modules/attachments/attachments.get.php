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
	include dirname(dirname(__FILE__)).'/includes/404.php';
}

/**
 * Вывод прикрепленных файлов, записанных в таблице attachments
 */

$filename = explode("/", $_GET["rewrite"]);

if (empty($filename[count($filename) - 2]))
{
	include ABSOLUTE_PATH.'includes/404.php';
}

if (! $row = DB::fetch_array(DB::query("SELECT * FROM {attachments} WHERE id=%d AND name='%h' AND is_image<>'1' LIMIT 1", $filename[count($filename)-2], $filename[count($filename)-1])))
{
	include ABSOLUTE_PATH.'includes/404.php';
}
if($row["access_admin"] && ! $this->diafan->_user->roles("init", $row["module_name"]))
{
	include ABSOLUTE_PATH.'includes/404.php';
}
header("Cache-Control: public, must-revalidate");
header('Cache-Control: pre-check=0, post-check=0, max-age=0');
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Description: File Transfer");
header("Expires: Sat, 30 Dec 1990 07:07:07 GMT");
header("Accept-Ranges: bytes");

// HTTP Range - see RFC2616 for more informations (http://www.ietf.org/rfc/rfc2616.txt)
$http_range = 0;
$file_size = ($row["size"] > 0 ? $row["size"] : 1);
$new_file_size = $file_size - 1;
// значение по-умолчанию. Ниже может быть переопределено
$result_lenght = (string) $file_size;
$result_range = "0-".$new_file_size;
// Если есть заголовок HTTP_RANGE, то обрабатывает его и отправляем часть файла, иначе отправляем весь файл
if(isset($_SERVER['HTTP_RANGE']) && preg_match('%^bytes=\d*\-\d*$%', $_SERVER['HTTP_RANGE']))
{
	list($a, $http_range) = explode('=', $_SERVER['HTTP_RANGE']);
	$http_range = explode('-', $http_range);
	if(!empty($http_range[0]) || !empty($http_range[1]))
	{
		// переопределяет размер файла...
		$result_lenght = $file_size - $http_range[0] - $http_range[1];
		// и отдает 206 статус
		header("HTTP/1.1 206 Partial Content");
		// переопределяет диапазон
		if(empty($http_range[0]))
		{
			$result_range = $result_lenght.'-'.$new_file_size;
		}
		elseif(empty($http_range[1]))
		{
			$result_range = $http_range[0].'-'.$new_file_size;
		}
		else
		{
			$result_range = $http_range[0] . '-' . $http_range[1];
		}
		//header("Content-Range: bytes ".$http_range . $new_file_size .'/'. $file_size);
	}
}
header("Content-Length: ".$result_lenght);
header("Content-Range: bytes ".$result_range.'/'.$file_size);

if ($row["extension"])
{
	header("Content-Type: ".$row["extension"]);
}
header('Content-Disposition: attachment; filename="'.$row["name"].'"');
header("Content-Transfer-Encoding: binary\n"); 

$file_path = ABSOLUTE_PATH.USERFILES."/".$row["module_name"]."/files/".$row["id"];

@set_time_limit(0);
$fp = @fopen($file_path, 'rb');
if ($fp !== false)
{
	while (!feof($fp))
	{
		echo fread($fp, 8192);
	}
	fclose($fp);
}
else
{
	@readfile($file_path);
}
flush();
exit;