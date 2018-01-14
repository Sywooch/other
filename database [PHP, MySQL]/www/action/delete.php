<?php
session_start();
require '../config/config.php';
header('Content-type: text/html; charset=utf-8');
if(($_GET['id']==NULL)||($_GET['id']=="")){//идентификатор клиента, который удаляется из записей пользователя.
echo'Ошибка! Некорректный ввод.'; die();
}



$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
$query="SELECT * FROM qdfmain WHERE ID='".$_GET['id']."'";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса (error1).</br>";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);
//$ID_Contacts=$row['ID_Contacts'];//идентификатор контакта. Нужен для удаления записи из таблицы Контакты

$query2="DELETE FROM qdfmain WHERE ID='".$_GET['id']."'";//удаление записи из таблицы Клиенты
$res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса (error2).</br>";
					echo mysql_error();
					exit; }

$query3="DELETE FROM tblcontacts WHERE ClientTD='".$_GET['id']."'";//удаление записи из таблицы Контакты
$res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса (error3).</br>";
					echo mysql_error();
					exit; }

$query4="DELETE FROM tblactions WHERE ClientID='".$_GET['id']."'";//удаление записи из таблицы События
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса (error4).</br>";
					echo mysql_error();
					exit; }

$query5="UPDATE big_table SET User='' WHERE ID='".$_GET['id']."'";//обновление записи в таблице Все организации.
$res5=mysql_query($query5);
					if($res5==false){
	    			echo"Ошибка выполнения запроса (error5).</br>";
					echo mysql_error();
					exit; }




 header("Refresh: 1; URL=../clients.php");
echo'Операция прошла успешно. Перенаправление...';
exit;

?>
