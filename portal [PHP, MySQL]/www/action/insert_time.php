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
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//скрипт добавления времени в тайм-ленту радио. 
//может выполняться только по команде пользователя с привилегиями admin
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

//проверка привилегий пользователя, запустившего этот скрипт
$user0=$_SESSION['user'];//имя пользователя

$dbh0=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");

//поиск имени в базе и определение уровня привилегий
$query0 = "SELECT * FROM users WHERE name='".$user0."'";

$res0=mysql_query($query0);
	    

					if($res0==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row0=mysql_fetch_array($res0);

$privilege0=$row0['privilege'];


if($privilege0!='admin'){

header("Refresh: 2; URL=../index.php");
echo"Вы не имеете привилегий для выполнения операции.";	 	


}









$radio_id=$_GET['radio_id'];


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");


$time=$_POST['time'];//добавляемое время
$time=$time.":00:00";


//генерация идентификатора для добавляемого времени
$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday'];
$date_gen=$today_date;//дата
$time_gen=$today['hours']."".$today['minutes']."".$today['seconds'];//время

$random=rand();
$id=$date_gen.$time_gen.$random;

//добавление в таблицу list_time_radio[$radio_id]
$query="INSERT INTO list_time_radio".$radio_id." (id, time) VALUES ('".$id."','".$time."')";

 $res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					



$query=	"SELECT * FROM list_radio WHERE id=".$radio_id."";	
	$res=mysql_query($query);
$row=mysql_fetch_array($res);

$radio=$row['name_eng'];	
 
	

header("Refresh: 2; URL=../create_news.php?step=2&radio=".$radio."");
	echo"Время успешно добавлено.";	
				
mysql_close($dbh);  
      
 
 ?>