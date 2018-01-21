<?php
session_start();
require '../config/config.php';
header('Content-type: text/html; charset=utf-8');
if(($_GET['id']==NULL)||($_GET['id']=="")||($_GET['id']==NULL)||($_GET['id']=="")){
echo'Ошибка! Некорректный ввод.'; die();
}



$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query="UPDATE tblcontacts SET Contact='".$_POST['Contact']."', Title='".$_POST['Title']."', City='".$_POST['City']."',
Phone='".$_POST['Phone2']."', WorkPhone='".$_POST['WorkPhone']."', Email='".$_POST['Email2']."' WHERE ID='".$_GET['id']."'  ";


$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
//$row=mysql_fetch_array($res);


 header("Refresh: 1; URL=../contacts.php");
echo'Операция прошла успешно. Перенаправление...';
exit;

?>
