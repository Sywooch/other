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


$id=$_GET['id'];//идентификатор новостного блока, который нужно удалить.

//вычисление даты по идентификатору, необходимо для перенаправления,
//чтобы во втором фрейме открылся список блоков с той-же датой что и дата удаляемого блока.
$query="SELECT * FROM news WHERE id='".$id."'";
	  $res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$row=mysql_fetch_array($res);

$date_refresh=$row['date'];



//удаление новостного блока.
$query="DELETE FROM news WHERE id='".$id."'";
	  $res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }


header("Refresh: 2; URL=../frames_index/frame2.php?date=".$date_refresh."");
	echo"Блок успешно удалён.";	
				
mysql_close($dbh);  


//

					

/*
//удаление радиостанции из таблицы list_radio
//id - идентификатор радиостанции.   

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");

$query="DELETE FROM list_radio WHERE id='".$id."'";
	  $res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
					
	



//удаление связанной таблицы со списком времени
//проверка существования таблицы list_time_radio[идентификатор радио]
$query1 = mysql_query("SELECT * FROM list_time_radio".$id."");
if (!$result = mysql_fetch_array($query1)){
//несуществует


}else{
//существует



//удаление таблицы list_time_radio[идентификатор радио]
$query = "DROP TABLE list_time_radio".$id."";

$res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
}

	


        
 */
 
 
 ?>