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

/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
//скрипт осуществляет удаление новостного выпуска
//скрипт имеет право запускать только пользователь с привилегиями
// admin
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////


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

if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор новостного выпуска, 
который нужно удалить."; exit; };

$id=$_GET['id'];//идентификатор новостного выпуска, который нужно удалить.

//вычисление идентификатора буфера, который нужно будет удалить.
$query="SELECT * FROM news_releases WHERE id='".$id."'";
  $res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$row=mysqli_fetch_array($res);
$buffer_id=$row['id_buffer'];//идентификатор буфера
//будет удалениа таблица вида buffer_[идентификатор буфера]




//получение даты для перенаправления
//$date_refresh
$query="SELECT * FROM news_releases WHERE id='".$id."'";
  $res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$row=mysqli_fetch_array($res);
$date_refresh=$row['date'];//идентификатор буфера





//удаление записи из таблицы news_releases
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("DELETE FROM news_releases WHERE id='".$id."'"); 

$mysqli->close(); 

	


				
					
//проверка существования буфера (таблица вида вида buffer_[идентификатор буфера] 
//buffer_id - идентификатор буфера
if (!mysqli_query($dbh,"SELECT * FROM buffer_".$buffer_id."")){////несуществует
      
    }//несуществует
	else{
	//существует
	
//удаление буфера
$query = "DROP TABLE buffer_".$buffer_id."";
$res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса. ";
					echo mysql_error();
					exit; }
					

	
	}



//////////////////////////////////////////////////////////////////////////////////////////
//удаление устаревших аудиофайлов
//////////////////////////////////////////////////////////////////////////////////////////
include("delete_audio_file.php");
//////////////////////////////////////////////////////////////////////////////////////////






header("Refresh: 2; URL=../frames_index_buffer/frame2.php?date=".$date_refresh."");
	echo"Новостной выпуск успешно удалён.";	
				
mysqli_close($dbh);  
 
 
 ?>