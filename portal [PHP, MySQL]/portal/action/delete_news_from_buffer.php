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
//скрипт, удаляющий новостной блок из какого-либо выпуска новостей
//данный скрипт могут запускать пользователи с привилегиями editor и admin
//так-же скрипт может также запустить пользователь с привилегиями correspondent, 
//который осуществляет удаление новостного блока из собственного выпуска новостей.
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


//проверка привилегий пользователя, запустившего этот скрипт
$user0=$_SESSION['user'];//имя пользователя

$dbh0 = mysqli_init();
mysqli_options($dbh0, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh0, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
mysqli_real_connect($dbh0, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

				mysqli_query($dbh0,"SET NAMES utf8");
					mysqli_query ($dbh0,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh0,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh0,"SET CHARACTER_SET_RESULTS=utf8");	
					mysqli_select_db($dbh0, DB_BASE);
			
					
					//поиск имени в базе и определение уровня привилегий
$query0 = "SELECT * FROM users WHERE name='".$user0."'";

$res0=mysqli_query($dbh0,$query0);
	    

					if($res0==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					

$row0=mysqli_fetch_array($res0);

$privilege0=$row0['privilege'];

if(($privilege0!='admin')||($privilege0!='editor')){

}else if($privilege0!='correspondent'){
//$user0 - имя пользователя
//$id_buffer0 - идентификатор буфера
//в таблице news_releases ети две переменные должны находиться в одной 
//строке. В противном случае Корреспондент пытается удалить новость 
//из "чужого" выпуска новостей.

if(!isset($_GET['id_buffer'])){ echo"Ошибка! Не задан идентификатор буфера."; exit;  };

$id_buffer0=$_GET['id_buffer'];




$dbh0 = mysqli_init();
mysqli_options($dbh0, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh0, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
mysqli_real_connect($dbh0, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

					mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	
		
					mysqli_select_db($dbh0, DB_BASE);
	

//запрос к news_releases и извлечение строки
$query0="SELECT * FROM news_releases WHERE i0d_buffer='".$id_buffer0."'";
	  $res0=mysqli_query($dbh, $query);

					if($res0==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
	$row0=mysqli_fetch_array($res0);					
		
		$author_base=$row0['author'];
		
		if($author_base==$user0){
		
		
		}else{
		
		header("Refresh: 2; URL=../index.php");
		echo"Вы не имеете привилегий для выполнения операции.";	 	

		
		}

}



if(!isset($_GET['id_buffer'])){echo"Ошибка! Не задан идентификатор буфера."; exit; };

//идентификатор буфера
$id_buffer=$_GET['id_buffer'];

if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор новости."; exit; };

//идентификатор новости
$id=$_GET['id'];

if(!isset($_GET['date'])){echo"Ошибка! Не задана дата."; exit; };

//дата (используется для работы 2-го фрейма)
$date_get=$_GET['date'];



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
				

//удаление новости с идентификатором id из таблицы buffer_(идентификатор).



$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("DELETE FROM buffer_".$id_buffer." WHERE id='".$id."'"); 

$mysqli->close(); 




//собрать все идентификаторы
$query="SELECT num FROM buffer_".$id_buffer." ORDER BY num ";
	  $res=mysqli_query($dbh, $query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
$i=0;
while($row=mysqli_fetch_array($res)){
$mas[$i]=$row['num'];
$i++;
}


for($i2=0;$i2<$i;$i2++){
$mas2[$i2]=$i2+1;





$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("UPDATE buffer_".$id_buffer." SET num='".$mas2[$i2]."' WHERE num='".$mas[$i2]."'"); 

$mysqli->close(); 





}	

//////////////////////////////////////////////////////////////////////////////////////////
//удаление устаревших аудиофайлов
//////////////////////////////////////////////////////////////////////////////////////////
include("delete_audio_file.php");
//////////////////////////////////////////////////////////////////////////////////////////


				
mysqli_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index_buffer/frame3.php?id_buffer=".$id_buffer."&date=".$date_get." ");
        
 
 ?>