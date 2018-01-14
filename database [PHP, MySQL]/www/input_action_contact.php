<?php //добавление данных в таблицы Клиенты и Контакты
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }

if(($_GET['id']==NULL)||(!isset($_GET['id']))||($_GET['id']=="")){
header("Refresh: 1; URL=input_contact_form.php");
echo'Перенаправление...';
exit;
};
$id=$_GET['id'];

if(($_POST['Contact']==NULL)||(!isset($_POST['Contact']))||($_POST['Contact']=="")){
header("Refresh: 1; URL=input_contact_form.php?id=$id");
echo'Ошибка! Не заполнено поле "Контактное лицо". Перенаправление...';
exit;
};



echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>';
echo'</head>';
echo'<body style="background-color:#3637ea; color:white; text-align:center">';

echo"<span style=\"position:absolute; background-color:black; float:left\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";



//подготовка переменных

$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday']."".$today['hours']."".$today['minutes']."".$today['seconds'];

$ID=$_GET['id'];

$ID_Contact=$today_date;

$Contact=$_POST['Contact'];
$Title=$_POST['Title'];
$City=$_POST['City'];
$Phone2=$_POST['Phone2'];
$WorkPhone=$_POST['WorkPhone'];
$Email2=$_POST['Email2'];

$today = getdate();
$year=$today['year'];
$mon=$today['mon'];
$day=$today['mday'];
$weekday=$today['weekday'];
$hours=$today['hours'];
$minutes=$today['minutes'];
$seconds=$today['seconds'];


$date="".$year."-".$mon."-".$day."";
$time="".$hours.":".$minutes.":".$seconds."";

$result_today="".$year."-".$mon."-".$day." ".$hours.":".$minutes.":".$seconds."";

$AddTime=$result_today;

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");

$User=$_SESSION['user'];
echo '<hr size="1">';
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query="INSERT INTO tblcontacts VALUES ('".$ID_Contact."','".$Contact."','".$Title."','".$City."','".$Phone2."','".$WorkPhone."','".$Email2."','".$User."','".$AddTime."','".$ID."') ";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


echo'Запись успешна.</br>';






echo'Что сделать дальше?</br>';
echo'<div align="center" style="width:100%; margin-top:20px">
<div style="width:400px; border: 1px white solid; padding:10px">

<p style="color:white; text-decoration:underline"><a href="input_contact_form.php" style="color:white; text-decoration:none">Сделать ещё одну запись</a></p>

<p style="color:white; text-decoration:underline"><a href="index.php" style="color:white; text-decoration:none">Перейти на главную</a></p>

</div>
</div>
';

mysql_close();
echo'</body>
</html>';

?>
 