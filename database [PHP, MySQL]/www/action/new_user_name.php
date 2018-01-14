<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
 
if($_SESSION['user']!='admin'){
echo'Доступ к странице запрещён. Вы не имеете достаточных привилегий.';
exit;
}

if((!isset($_POST['new_name']))||($_POST['new_name']==NULL)||($_POST['new_name']=="")||
header("Refresh: 1; URL=../new_user_name.php");
echo'Ошибка. Некорректный ввод. Перенаправление...';
exit;
}

if(!isset($_GET['name'])||($_GET['name']==NULL)||($_GET['name']=="")){
header("Refresh: 1; URL=../new_user_name.php");
echo'Ошибка. Не передан параметр. Перенаправление...';
exit;
}

$name=$_GET['name'];
$new_name=$_POST['new_name'];


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");


$query2="UPDATE users SET name='".$new_name."' WHERE name='".$name."' ";
$res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }


$query3="UPDATE big_table SET User='".$new_name."' WHERE User='".$name."' ";
$res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$query4="UPDATE qdfmain SET User='".$new_name."' WHERE User='".$name."' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$query5="UPDATE tblactions SET Manager='".$new_name."' WHERE Manager='".$name."' ";
$res5=mysql_query($query5);
					if($res5==false){
	    			echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$query6="UPDATE tblcontacts SET UserName='".$new_name."' WHERE UserName='".$name."' ";
$res6=mysql_query($query6);
					if($res6==false){
	    			echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					




echo'<p>Имя успешно изменено.</p>


<a href="../users.php"><input type="button" value="Назад" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>';


?>