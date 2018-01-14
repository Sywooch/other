<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';

if((!isset($_SESSION['user']))||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
}

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
<span>Управление учётными записями пользователей</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt">

<table style="padding:5px">
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3637ea"><span style="font-size:12pt">Имя пользователя</span></td>
<td style="width:300px; height:60px; padding:5px; background-color:#3637ea"></td>
</tr>
<?php

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
$query="SELECT * FROM users WHERE name<>'admin'";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
 while($row=mysql_fetch_array($res)){
 
echo'
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3637ea"><span style="font-size:12pt">'.$row['name'].'</span></td>
<td style="width:300px; height:60px; padding:5px; background-color:#3637ea">
<a href="action/delete_user.php?name='.$row['name'].'" alt="" style="color:yellow; font-size:12pt">Удалить пользователя</a></br>
<a href="new_user_password.php?name='.$row['name'].'" alt="" style="color:yellow; font-size:12pt">Сменить пароль</a></br>
<a href="new_user_name.php?name='.$row['name'].'" alt="" style="color:yellow; font-size:12pt">Сменить имя</a></br>

</td>
</tr>
';


}



?>
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3637ea; text-align:center" colspan="2">
<a href="new_user.php?name='.$row['name'].'" alt="" style="color:yellow; font-size:12pt">Добавить пользователя</a>
</td>
</tr>

</table>

</div>




</div>
</div>
</body>

</html>
