<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 
if((!isset($_SESSION['user']))||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
}

if($_SESSION['user']!='admin'){
$x="index";
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
echo"<span style=\"position:absolute; background-color:black; margin-top:20px\">
<a href=\"exit.php\" style=\"color:white\">Выйти из учётной записи</a></span>";

?>

<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:700px; min-height:100px; padding:10px; border:2px white solid">



<div align="center" style="width:670px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Управление клиентами</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt; padding-top:20px; padding-bottom:20px">

<?php
//получение списка пользователей

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
echo'<a href="clients_of_user.php?name='.$row['name'].'" alt="" style="color:yellow; font-size:12pt">Посмотреть клиентов пользователя '.$row['name'].'</a></br>';

}


?>


</div>
</div>
</div>
</body>

</html>
