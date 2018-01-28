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
//скрипт осуществляет обновление новости в копилке
//
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////



if((!isset($_POST['head']))||(!isset($_POST['tags']))||(!isset($_GET['id']))){
header("Refresh: 2; URL=../frames_index/frame3.php?id=".$_GET['id']."");
echo"Ошибка! Некорректный ввод.</br>"; 
if(!isset($_POST['head'])){echo"Не определён заголовок новости.</br>"; };
if(!isset($_POST['tags'])){echo"Не определены теги новости.</br>"; };
if(!isset($_GET['id'])){echo"Не определён идентификатор новости.</br>"; };

exit;
};



$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}
mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh, DB_BASE);

if(!isset($_POST['head'])){echo"Ошибка! Не задан заголовок."; exit; };					
$head=$_POST['head'];//заголовок

if(!isset($_POST['tags'])){echo"Ошибка! Не заданы теги."; exit; };
$tags=$_POST['tags'];//теги

if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор."; exit; };
$id=$_GET['id'];//идентификатор

$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;//дата

$time=$today['hours'].":".$today['minutes'].":".$today['seconds'];//время

$author=$_SESSION['user'];//пользователь (автор)

$user=$_SESSION['user'];//имя пользователя.

//определение полномочий пользователя.
 //вычисление уровня привилегий
$query2 = "SELECT * FROM users WHERE name='$user' ";					
	$res2=mysqli_query($dbh,$query2);				
	$row2=mysqli_fetch_array($res2);
				
 
 $privilege=$row2['privilege'];//привилегии пользователя.


//обновление 


if(($privilege=='admin')||($privilege=='editor')){



$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("UPDATE news SET date='".$date."' , time='".$time."' , head='".$head."' , author='".$author."' , 
tags='".$tags."', edit='0', edited='".$user."' 
WHERE id=".$id.""); 

$mysqli->close(); 



}else if($privilege=='correspondent'){


$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("UPDATE news SET date='".$date."' , time='".$time."' , head='".$head."' , author='".$author."' , tags='".$tags."', edit='0' 
WHERE id=".$id.""); 

$mysqli->close();

}
//после нажатия кнопки Готово новость приобретает статус отредактированной.
	   
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index/frame3.php?ok=1");
echo"Новость успешно отредактирована.";	 	
        
 
 ?>