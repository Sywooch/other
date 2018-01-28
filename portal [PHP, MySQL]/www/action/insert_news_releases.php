<?php 
session_start();

require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-type: text/html; charset=utf-8');

if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=../login.php");
};


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//скрипт добавления новостного выпуска
//может запускаться любым пользователем
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


if((!isset($_POST['new']))||(!isset($_POST['time']))){
header("Refresh: 2; URL=../create_news.php?step=1");
echo"Ошибка! Некорректный ввод.</br>";
if(!isset($_POST['new'])){echo"Не выбрана радиостанция.</br>"; };
if(!isset($_POST['time'])){echo"Не выбрано время.</br>"; };
exit;
};



					$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
					
$new=$_POST['new'];//
$time=$_POST['time'];//

$time="".$time.":"."00".":"."00";


//генерация идентификатора новостного выпуска.
$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday'];
$date_gen=$today_date;//дата

$time_gen=$today['hours']."".$today['minutes']."".$today['seconds'];//время

$random=rand();
$id=$date_gen.$time_gen.$random;

//генерация идентификатора корзины
$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday'];
$date_gen=$today_date;//дата

$time_gen=$today['hours']."".$today['minutes']."".$today['seconds'];//время

$random=rand();
$id_buffer=$date_gen.$time_gen.$random;

//получение времени нажатия кнопки ОК
$today=getdate();
$time_ok=$today['hours'].":".$today['minutes'].":".$today['seconds'];

$author=$_SESSION['user'];
//обновление 

$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;

$query = "INSERT INTO news_releases (id,radio,time,id_buffer,time_ok,author,date) 
VALUES ('".$id."','".$new."','".$time."','".$id_buffer."','".$time_ok."','".$author."','".$date."')"; 
//новость добавляется в базу как отредактированная.

	    $res=mysql_query($query);
	    

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

						mysql_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 1; URL=../index_create_news_releases.php?id_buffer=".$id_buffer." ");
 	
        
 
 ?>