<?php 
session_start();
header('Content-type: text/html; charset=utf-8');
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }
//$_SESSION['id']=$_GET['id'];//идентификатор организации.
require 'config/config.php';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

</head>

<body style="background-color:blue; color:white">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:700px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:670px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Добавление организации в список клиентов</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt">
<?php

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query="SELECT * FROM big_table WHERE ID='".$_GET['id']."' ";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса (error1).</br>";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);					
$ID=$_GET['id'];//echo"$ID=".$ID."</br>";
$A=$row['A'];//echo"$A=".$A."</br>";
$B=$row['B'];//echo"$B=".$B."</br>";
$C=$row['C'];//echo"$C=".$C."</br>";
$D=$row['D'];//echo"$D=".$D."</br>";
$E=$row['E'];//echo"$E=".$E."</br>";
$F=$row['F'];//echo"$F=".$F."</br>";
$G=$row['G'];//echo"$G=".$G."</br>";

$query2="INSERT INTO qdfmain VALUES('".$ID."','".$A."','".$B."','Теплый','".$C."','".$D."',' ','".$E."','".$F."','".$G."','','','".$_SESSION['user']."')";
$res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса (error2).</br>";
					echo mysql_error();
					exit; }

$query3="UPDATE big_table SET User='".$_SESSION['user']."' WHERE ID='".$ID."'";//чьим клиентом является организация.
$res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса (error3).</br>";
					echo mysql_error();
					exit; }


echo'Запись успешна.</br>';






echo'Что сделать дальше?</br>';
echo'<div align="center" style="width:100%; margin-top:20px">
<div style="width:400px; border: 1px white solid; padding:10px">

<p style="color:white; text-decoration:underline"><a href="organisations.php" style="color:white; text-decoration:none">Посмотреть ещё раз список организаций</a></p>

<p style="color:white; text-decoration:underline"><a href="index.php" style="color:white; text-decoration:none">Перейти на главную</a></p>

</div>
</div>
';

mysql_close();



?>

</div>




</div>
</div>
</body>

</html>
