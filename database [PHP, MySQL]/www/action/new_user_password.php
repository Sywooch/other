<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
 
if($_SESSION['user']!='admin'){
echo'Доступ к странице запрещён. Вы не имеете достаточных привилегий.';
exit;
}

if((!isset($_POST['old_password']))||($_POST['old_password']==NULL)||($_POST['old_password']=="")||
(!isset($_POST['new_password']))||($_POST['new_password']==NULL)||($_POST['new_password']=="")){
 header("Refresh: 1; URL=../new_user_password.php");
echo'Ошибка. Некорректный ввод Перенаправление...';
exit;
}

if(!isset($_GET['name'])||($_GET['name']==NULL)||($_GET['name']=="")){
header("Refresh: 1; URL=../new_user_password.php");
echo'Ошибка. Не передан параметр. Перенаправление...';
exit;
}

$name=$_GET['name'];
$old_password=$_POST['old_password'];
$new_password=$_POST['new_password'];


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");

$query="SELECT * FROM users WHERE name='".$name."'";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);

if((md5($old_password))!=$row['password']){
header("Refresh: 1; URL=../new_user_password.php");
echo'Ошибка. Неверный старый пароль. Перенаправление...';
exit;
}



$query2="UPDATE users SET password='".md5($new_password)."' WHERE name='".$name."' ";

$res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

echo'<p>Пароль успешно изменён.</p>


<a href="../users.php"><input type="button" value="Назад" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>';


?>