<?php 
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////





					$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
$id=0;
$res = mysql_query("SELECT COUNT(*) FROM audio");
 $row = mysql_fetch_row($res);
 $total = $row[0]; // всего записей
 $id=$total+1;


	    $query = "INSERT INTO audio(id, text)
		 VALUES('".$id."','".$_POST['elm1']."')";
	    $res=mysql_query($query);
	    

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

						mysql_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


header("Refresh: 1; URL=../index.php");
	
      
		
        
 
 ?>