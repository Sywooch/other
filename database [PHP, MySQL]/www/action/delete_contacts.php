<?php
session_start();
require '../config/config.php';
header('Content-type: text/html; charset=utf-8');
if(($_GET['id']==NULL)||($_GET['id']=="")||($_GET['id']==NULL)||($_GET['id']=="")){
echo'Ошибка! Некорректный ввод.'; die();
}



$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
$query="DELETE FROM tblcontacts WHERE ID='".$_GET['id']."'";


$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


header("Refresh: 1; URL=../contacts.php");
echo'Операция прошла успешно. Перенаправление...';
exit;

?>
