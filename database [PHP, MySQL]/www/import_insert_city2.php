<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
  if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }
 


 $file_str=implode($file_array);
 $mas=explode(";", $file_str);
 $count=sizeof($mas);
 
  $i=0;
 $i2=0;
 $dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
 


  $query="UPDATE big_table SET City='Благовещенск' ";
$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
 echo"<hr size=\"1\"/>";

 
 
echo"Импорт прошел успешно.";




 
?>
