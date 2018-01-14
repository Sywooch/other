<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';

if(($_POST['name']==NULL)||($_POST['name']=="")||($_POST['pass']==NULL)||($_POST['pass']=="")){
echo'Ошибка! Некорректный ввод.'; die();
}
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
$query="SELECT * FROM users ORDER BY name";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
 while($row=mysql_fetch_array($res)){


if($_POST['name']==$row['name']){
 if((md5($_POST['pass']))==$row['password']){//успешная авторизация
 $_SESSION['user']=$_POST['name'];
 header("Refresh: 1; URL=../index.php");
echo'Авторизация прошла успешно. Перенаправление...';
exit;
 }
 }




}
echo'Ошибка! Неверное имя пользователя или пароль.';
?>
