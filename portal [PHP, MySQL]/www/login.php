<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css"/>
<script type="text/javascript" src="js_login/jquery-1.8.2.js"></script>


<title>Фабрика новостей - Авторизация</title>


</head>


<body style="background-color: white; padding:0; margin:0; border:0;">

<div style="border:1px black solid; width:1160px; height:580px; position:absolute; top:50%; left:50%; 
margin-top:-290px; margin-left:-580px;">
<!-- login -->
<div align="center" style="float:left; width:580px; height:580px; background-color:transparent; ">
<div  align="center" style="width:400px; height:580px; background-color:transparent;">

<div align="center" style="width:400px; height:400px; background-color:transparent; margin-top:80px;">
<form action="action/login.php" id="loginForm" method="post" accept-charset="utf-8">
		<table>
		<tr>
		
		<td style="width: 400px; height: 30px">
		<input type="text" autocomplete="off" name="login" value="Имя" style="width: 398px" 
		onblur="if(this.value=='') this.value='Имя'" onfocus="this.value=''" >
		</td>
		</tr>
		<tr>
		
		<td style="width: 400px; height: 30px">
		<input type="password" name="password" style="width: 398px" value="Пароль"
		onblur="if(this.value=='') this.value='Пароль'" onfocus="this.value=''">
		</td> 
		</tr>
		<tr>
		<td style=" width: 400px; height:40px; ">
		</td>
		</tr>
		<tr>
		<td  align="center">
		<input type="submit" value="Вход" name="signup" style="width: 200px; height:100px; cursor:pointer;">
		
		
		</td>
		</tr>
		
		</table>
		
		</form>
</div>
		
</div>
</div>

<!-- foto -->
<div style="float:left; width:580px; height:580px; background-color:transparent;">
<div style="width:500px; height:500px; border:1px black solid; margin-left:39px; margin-top:39px; "> </div>
</div>


</div>


 
</body> 

</html>


