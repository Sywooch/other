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
<div align="center" style="width:1220px; min-height:100px; padding:5px; border:2px white solid">



<div align="center" style="width:1200px; height:40px; padding:5px; border:1px white solid; font-size:15pt">

<?php
$name=$_GET['name'];
echo'<span>Управление клиентами - Клиенты пользователя '.$name.'</span>';
?>

</div>
<div align="center" style="  border:1px white solid; border-top:0px; font-size:15pt; padding-top:20px; padding-bottom:20px">
<table style="width:1100px; font-size:11pt">
<tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px"></td>
<td style="background-color:#3637ea; width:10px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:100px; padding:2px">Клиент</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Отрасль</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Лояльность</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Сайт</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Заметки</td>
<td style="background-color:#3637ea; width:130px; padding:2px">E-mail</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Адрес</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Категории</td>

</tr>
<?php
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
$query="SELECT * FROM qdfmain WHERE User='".$name."'";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
while($row=mysql_fetch_array($res)){
echo'
<tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px">


<a href="move_client_form_2.php?id='.$row['ID'].'&name='.$name.'" style="color:white">Передать клиента другому менеджеру</a>


</td>
<td style="background-color:#3637ea; width:10px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:90px; padding:2px">'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Site'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Note'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Adress'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Categories'].'</td>
</tr>';

}
?>
</table>

</div>
</div>
</div>
</body>

</html>
