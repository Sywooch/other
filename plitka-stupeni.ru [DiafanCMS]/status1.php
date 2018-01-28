<?
$n=$_POST['n'];

echo $n;

error_reporting(E_ALL);
ini_set('display_errors',true);
ini_set('html_errors',true);
ini_set('error_reporting',E_ALL ^ E_NOTICE);
define('DIAFAN', 1);
define('ABSOLUTE_PATH', dirname(__FILE__).'/');
include_once(ABSOLUTE_PATH."config.php");
include_once ABSOLUTE_PATH.'includes/customization.php';
include_once(ABSOLUTE_PATH.'includes/developer.php');
include_once(ABSOLUTE_PATH.'includes/diafan.php');
include_once(ABSOLUTE_PATH.'includes/files.php');
$dev = new Dev();
$dev->set_error();
include_once ABSOLUTE_PATH.'includes/function.php';
include_once(ABSOLUTE_PATH.'includes/core.php');
include_once(ABSOLUTE_PATH.'includes/database.php');
DB::connect();
include_once ABSOLUTE_PATH.'includes/init.php';
$diafan = new Init();



DB::connect();

DB::query("UPDATE {requests_count} SET status='1' WHERE id='".$n."' ");


	
	
	

?>