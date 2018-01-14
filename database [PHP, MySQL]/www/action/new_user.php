<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
 
if($_SESSION['user']!='admin'){
echo'Доступ к странице запрещён. Вы не имеете достаточных привилегий.';
exit;
}

if((!isset($_POST['new_user']))||($_POST['new_user']==NULL)||($_POST['new_user']=="")||(!isset($_POST['new_pass']))||($_POST['new_pass']==NULL)||($_POST['new_pass']=="")){
echo'Ошибка! Некоррекный ввод.';die();
}


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");

$query="INSERT INTO users VALUES('".$_POST['new_user']."', '".md5($_POST['new_pass'])."')";

$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса. Не удалось добавить пользователя";
					echo mysql_error();
					exit; }


echo'Пользователь '.$_POST['new_user'].' успешно добавлен. </br>
<a href="../users.php"><input type="button" value="На главную" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>';


?>