<?php 
session_start();
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-type: text/html; charset=utf-8');

if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){
exit;
};



$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");



$id=$_GET['id'];//идентификатор новости
$text=$_REQUEST['text'];//текст новости
		
$user=$_SESSION['user'];//имя пользователя.

//определение полномочий пользователя.
 //вычисление уровня привилегий
$query2 = "SELECT * FROM users WHERE name='$user' ";					
	$res2=mysql_query($query2);				
	$row2=mysql_fetch_array($res2);
				
 
 $privilege=$row2['privilege'];//привилегии пользователя.


if(($privilege=='admin')||($privilege=='editor')){		
	$query = "UPDATE news SET text='$text' WHERE id='$id'";				
	 $res=mysql_query($query);
	$query = "UPDATE news SET edited='$privilege' WHERE id='$id'";				
	 $res=mysql_query($query);
	 
}
else if($privilege=='correspondent'){
	$query = "UPDATE news SET text='$text' WHERE id='$id'";				
	 $res=mysql_query($query);

}


	    

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
////////////////////////////////////////////////////////

//	echo "".$row['head']."";
	mysql_close($dbh);  
 
 
 //	echo "".$_REQUEST['head']."";
 ?>