<?
if($_POST['phone']!="" && $_POST['coll']!="" && $_POST['name']!=""){
			
	mail("catolog@yandex.ru", "Запрос остатка с сайта", "Пользователеь запросил остаток по ".$_POST['name']."  в количестве ".$_POST['coll']." его телефон ".$_POST['phone']."");


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
//DB::connect("mysqli://u266638_site:LesSli.Er73E.Y@u266638.mysql.masterhost.ru/u266638_test");
//добавление записи в список заказов
/*$id = DB::query("INSERT INTO {shop_order} (user_id, created, status, status_id, lang_id, summ, payment_id, delivery_id, delivery_summ, code, trash) VALUES ('0', '".time()."', '0', '1', '1', '', '0', '0', '0', '', '0')");
//$id = DB::insert_id();

$result = DB::query("SELECT * FROM {shop_order} ORDER BY id DESC LIMIT 1");
while ($row = DB::fetch_object($result))
{
 $id1=$row->id;
}


DB::query("INSERT INTO {shop_order_param_element} (value, param_id, element_id, trash) VALUES ('".$_POST['phone']."', '3', '".$id1."', '0')");
DB::query("INSERT INTO {shop_order_param_element} (value, param_id, element_id, trash) VALUES ('<b>Запрос наличия товара.</b> Товар:".$_POST['name'].", Количество: ".$_POST['coll']."', '9', '".$id1."', '0')");
*/


DB::query("INSERT INTO {requests_count} (product, phone, count, status) VALUES ('".$_POST['name']."', '".$_POST['phone']."', '".$_POST['coll']."', '0')");


	echo 0;

	}else{
	
	echo 2;
	}
	
	
	
	

?>