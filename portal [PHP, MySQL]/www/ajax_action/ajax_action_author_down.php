<?php 
session_start();
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-type: text/html; charset=utf-8');


if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован,
//скрипт прекращает свою работу
exit;
};







$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");



$id=$_GET['id'];

		
		
	
////////////////////////////////////////////////////////
	$query = "SELECT * FROM news WHERE id='$id'";				
	 $res=mysql_query($query);
	    

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$res=mysql_query($query);
$row=mysql_fetch_array($res);


	
					
	echo "".$row['author']."";
	mysql_close($dbh);  
 
 
 //	echo "".$_REQUEST['head']."";
 ?>