<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';

if((!isset($_SESSION['user']))||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
}

if((!isset($_GET['user']))||($_GET['user']==NULL)||($_GET['user']=="")){
$x="users";
header('Location: '.$x.".php");
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

$name=$_GET['name'];

?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:700px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:670px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Управление учётными записями пользователей - Смена имени</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt">

<?php
echo'
<form id="uploadForm" action="action/new_user_name.php?name='.$name.' " enctype="multipart/form-data" method="post" accept-charset="utf-8">
';
?>
<table style="padding:5px">

<?php
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
$query="SELECT * FROM users WHERE name='".$name."'";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
 $row=mysql_fetch_array($res);
 
echo'

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3637ea"><span style="font-size:12pt">Имя пользователя</span></td>
<td style="width:300px; height:60px; padding:5px; background-color:#3637ea">'.$name.'</td>
</tr>
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3637ea"><span style="font-size:12pt">Новое имя</span></td>
<td style="width:300px; height:60px; padding:5px; background-color:#3637ea"><input type="text" name="new_name" id="new_name" style="width:200px"/></td>
</tr>


';


?>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:center; background-color:#3637ea" colspan="2">
<input type="submit" value="Готово" style="width:100px; height:40px"/>
<input type="reset" value="Сброс" style="width:100px; height:40px"/>
</td>
</tr>

</table>
</form>
</div>




</div>
</div>
</body>

</html>
