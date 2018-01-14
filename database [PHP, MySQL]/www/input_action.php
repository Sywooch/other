<?php //добавление данных в таблицы Клиенты и Контакты
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }
 
if(($_POST['Client']==NULL)||(!isset($_POST['Client']))||($_POST['Client']=="")){
header("Refresh: 1; URL=input.php");
echo'Ошибка! Необходимо заполнить поле "Клиент". Перенаправление...';
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

echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";



//подготовка переменных
$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday']."".$today['hours']."".$today['minutes']."".$today['seconds'];

$ID=$today_date;
$Client=$_POST['Client'];
$Industry=$_POST['Industry'];
$Loyalty=$_POST['Loyalty'];
if($Loyalty==1){$Loyalty="Наш клиент";};
if($Loyalty==2){$Loyalty="Горячий";};
if($Loyalty==3){$Loyalty="Теплый";};
if($Loyalty==4){$Loyalty="Холодный";};
if($Loyalty==5){$Loyalty="Отказ";};
$Phone=$_POST['Phone'];
$Site=$_POST['Site'];
$Note=$_POST['Note'];
$Email=$_POST['Email'];
$Adress=$_POST['Adress'];
$Categories=$_POST['Categories'];

sleep(1);
$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday']."".$today['hours']."".$today['minutes']."".$today['seconds'];


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

$query="INSERT INTO qdfmain VALUES ('".$ID."','".$Client."','".$Industry."','".$Loyalty."','".$Phone."',
'".$Site."','".$Note."','".$Email."','".$Adress."','".$Categories."','".$Contact."','".$ID_Contact."','".$User."') ";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

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

<p style="color:white; text-decoration:underline"><a href="input.php" style="color:white; text-decoration:none">Сделать ещё одну запись</a></p>

<p style="color:white; text-decoration:underline"><a href="index.php" style="color:white; text-decoration:none">Перейти на главную</a></p>

</div>
</div>
';

mysql_close();
echo'</body>
</html>';

?>
 