<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
 
if($_SESSION['user']!='admin'){
echo'Доступ к странице запрещён. Вы не имеете достаточных привилегий.';
exit;
}

if((!isset($_GET['id']))||($_GET['id']==NULL)||($_GET['id']=="")||(!isset($_POST['user']))||($_POST['user']==NULL)||($_POST['user']=="")){
echo'Ошибка! Некорректный параметр.';die();
}

$id=$_GET['id'];//идентификатор передаваемого клиента
$user=$_POST['user'];//кому передаётся клиент

echo"id ".$id."</br>";
echo"user ".$user."</br>";

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");


$query="UPDATE big_table SET User='".$user."' WHERE ID='".$id."'";//обновление таблицы с организациями

$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса (1).";
					echo mysql_error();
					exit; }

$query2="UPDATE qdfmain SET User='".$user."' WHERE ID='".$id."'";//обновление таблицы с клиентами
$res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса (2).";
					echo mysql_error();
					exit; }

$query3="UPDATE tblactions SET Manager='".$user."' WHERE ClientID='".$id."'";
$res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса (3).";
					echo mysql_error();
					exit; }

$query4="UPDATE tblcontacts SET UserName='".$user."' WHERE ClientTD='".$id."'";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса (4).";
					echo mysql_error();
					exit; }


echo'Клиент успешно перемещён. </br>
<a href="../my_clients.php"><input type="button" value="На главную" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>';


?>