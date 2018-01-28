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
//так-же скрипт может также запустить пользователь с привилегиями correspondent, который
//который осуществляет удаление новостного блока из собственного выпуска новостей.
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

if($privilege0!='admin')||($privilege0!='editor'){

}else if($privilege0!='correspondent'){
//$user0 - имя пользователя
//$id_buffer0 - идентификатор буфера
//в таблице news_releases ети две переменные должны находиться в одной 
//строке. В противном случае Корреспондент пытается удалить новость 
//из "чужого" выпуска новостей.
$id_buffer0=$_GET['id_buffer'];

					$dbh0=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");

//запрос к news_releases и извлечение строки
$query0="SELECT * FROM news_releases WHERE i0d_buffer='".$id_buffer0."'";
	  $res0=mysql_query($query);

					if($res0==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
	$row0=mysql_fetch_array($res0);					
		
		$author_base=$row0['author'];
		
		if($author_base==$user0){
		
		
		}else{
		
		header("Refresh: 2; URL=../index.php");
		echo"Вы не имеете привилегий для выполнения операции.";	 	

		
		}

}





//идентификатор буфера
$id_buffer=$_GET['id_buffer'];

//идентификатор новости
$id=$_GET['id'];

//дата (используется для работы 2-го фрейма)
$date_get=$_GET['date'];



					$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");

//удаление новости с идентификатором id из таблицы buffer_(идентификатор).
$query="DELETE FROM buffer_".$id_buffer." WHERE id='".$id."'";
	  $res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

//собрать все идентификаторы
$query="SELECT num FROM buffer_".$id_buffer." ORDER BY num ";
	  $res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
$i=0;
while($row=mysql_fetch_array($res)){
$mas[$i]=$row['num'];
$i++;
}


for($i2=0;$i2<$i;$i2++){
$mas2[$i2]=$i2;

$query="UPDATE buffer_".$id_buffer." SET num='".$mas2[$i2]."' WHERE num='".$mas[$i2]."'";
$res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

}	



				
mysql_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index_buffer/frame3.php?id_buffer=".$id_buffer."&date=".$date_get." ");
        
 
 ?>