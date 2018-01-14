<?php 

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 



$xml_url=$_POST['url'];






if($_SESSION['admin_name']=="admin"){
	if(!isset($_POST['tovar_shop3'])){  echo "Ошибка. Не выбран магазин."; }
	$shop=$_POST['tovar_shop3'];
}else{
	$rs  = $mysqli->query('SELECT * FROM  `administrators` WHERE id="'.$_SESSION['admin_id'].'"' );
	while ($row = $rs->fetch_assoc()){
		$shop=$row['shopId'];
	
	}
}


$rs_insert = $mysqli->query("INSERT INTO `autoimport` (shop_id,url_xml) VALUES ('".$shop."','".$xml_url."')");
			if ($rs_insert===false) {
				printf("Ошибка: %s\n", $mysqli->error);
			}



?>