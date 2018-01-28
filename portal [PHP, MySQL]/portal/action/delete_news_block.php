<?php 
session_start();

require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


header('Content-type: text/html; charset=utf-8');

if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=../login.php");
exit;
};

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//скрипт осушествяет удаление новостного блока из копилки
//запускать скрипт имеет право только пользователь с привилегиями admin
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//проверка наличия у пользователя привилегий Администратора
$user=$_SESSION['user'];


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
				

$query="SELECT * FROM users WHERE name='".$user."'";
	  $res=mysqli_query($dbh, $query);
	  
if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
	$row=mysqli_fetch_array($res);

$privilege=$row['privilege'];	

if($privilege=='admin'){


}else{//пользователь не имеет привилегий Администратора, и будет перенаправлен на главную 
//страницу.

header("Refresh: 1; URL=../index.php");
exit;


}			
					

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


if(!isset($_GET['id'])){ echo"Ошибка! Не задан идентификатор новостного блока."; exit;  };

$id=$_GET['id'];//идентификатор новостного блока, который нужно удалить.

//вычисление даты по идентификатору, необходимо для перенаправления,
//чтобы во втором фрейме открылся список блоков с той-же датой что и дата удаляемого блока.
$query="SELECT * FROM news WHERE id='".$id."'";
	  $res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$row=mysqli_fetch_array($res);

$date_refresh=$row['date'];



//удаление новостного блока.
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("DELETE FROM news WHERE id='".$id."'"); 

$mysqli->close(); 

//////////////////////////////////////////////////////////////////////////////////////////
//удаление устаревших аудиофайлов
//////////////////////////////////////////////////////////////////////////////////////////
include("delete_audio_file.php");
//////////////////////////////////////////////////////////////////////////////////////////



header("Refresh: 2; URL=../frames_index/frame2.php?date=".$date_refresh."");
	echo"Блок успешно удалён.";	
				
mysqli_close($dbh);  


//

					
 
 
 ?>