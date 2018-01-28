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


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");

$query="SELECT * FROM users WHERE name='".$user."'";
	  $res=mysql_query($query);
	  
if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
	$row=mysql_fetch_array($res);

$privilege=$row['privilege'];	

if($privilege=='admin'){


}else{//пользователь не имеет привилегий Администратора, и будет перенаправлен на главную 
//страницу.

header("Refresh: 1; URL=../index.php");
exit;


}			
					

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


$id=$_GET['id'];//идентификатор новостного выпуска, который нужно удалить.

//вычисление идентификатора буфера, который нужно будет удалить.
$query="SELECT * FROM news_releases WHERE id='".$id."'";
  $res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$row=mysql_fetch_array($res);
$buffer_id=$row['id_buffer'];//идентификатор буфера
//будет удалениа таблица вида buffer_[идентификатор буфера]




//получение даты для перенаправления
//$date_refresh
$query="SELECT * FROM news_releases WHERE id='".$id."'";
  $res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$row=mysql_fetch_array($res);
$date_refresh=$row['date'];//идентификатор буфера





//удаление записи из таблицы news_releases
$query="DELETE FROM news_releases WHERE id='".$id."'";
	  $res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
					
					
//проверка существования буфера (таблица вида вида buffer_[идентификатор буфера] 
//buffer_id - идентификатор буфера
if (!mysql_query("SELECT * FROM buffer_".$buffer_id."")){////несуществует
      
    }//несуществует
	else{
	//существует
	
//удаление буфера
$query = "DROP TABLE buffer_".$buffer_id."";
$res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса. ";
					echo mysql_error();
					exit; }
					

	
	}



header("Refresh: 2; URL=../frames_index_buffer/frame2.php?date=".$date_refresh."");
	echo"Новостной выпуск успешно удалён.";	
				
mysql_close($dbh);  
 
 
 ?>