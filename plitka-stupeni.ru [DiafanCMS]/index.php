<?php
/**
 * @package    Diafan.CMS
 * Bootstrap
 *
 * ВНИМАНИЕ, не надо править этот файл, закачивайте HTML-шаблон в /themes/site.php!
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

define('DIAFAN', 1);
define('ABSOLUTE_PATH', dirname(__FILE__).'/');
$periuds=@file_get_contents($_SERVER['DOCUMENT_ROOT']."/modules/presto/admin/periuds.1");
$add_time=0;
if($periuds=="none"){$add_time=0;}
if($periuds=="day"){$add_time=86400;}
if($periuds=="wiack"){$add_time=604800;}
if($periuds=="2wiack"){$add_time=1209600;}
if($periuds=="monf"){$add_time=2419200;}


if (isset($_COOKIE['podcazka'])){
	define("PODSKAZKA_VID", "NO");
}else{
	define("PODSKAZKA_VID", "NO");
	setcookie('podcazka', "ok",mktime()+$add_time);
}

if (empty($_GET["rewrite"]))
{
	$_GET["rewrite"] = '';
}

if (file_exists(ABSOLUTE_PATH.'installation/install.php'))
{
	include ABSOLUTE_PATH.'installation/install.php';
}

include ABSOLUTE_PATH.'config.php';

if (!TIMEZONE || @!date_default_timezone_set(TIMEZONE))
{
	@date_default_timezone_set('Europe/Moscow');
}

include_once ABSOLUTE_PATH.'includes/customization.php';

Customization::inc('includes/developer.php');

$dev = new Dev();
$dev->set_error();
try
{
	Customization::inc('includes/diafan.php');

	if (preg_match('/^'.ADMIN_FOLDER.'(\/|$)/', $_GET["rewrite"]))
	{
		include_once(ABSOLUTE_PATH.'adm/index.php');
	}
	session_start();
	define('IS_ADMIN', 0);
	define('BASE_PATH', "http://".$_SERVER["HTTP_HOST"]."/".(REVATIVE_PATH ? REVATIVE_PATH.'/' : ''));

	Customization::inc('includes/core.php');
	Customization::inc('includes/init.php');

	$diafan = new Init();
	$diafan->start();

}
catch (Exception $e)
{
	$dev->exception($e);
}

exit;