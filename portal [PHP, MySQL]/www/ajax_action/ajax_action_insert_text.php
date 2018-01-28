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
$text=$_POST['text'];//текст новости
$head=$_POST['head'];//заголовок новости
$tags=$_POST['tags'];//теги




$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;//дата

$time=$today['hours'].":".$today['minutes'].":".$today['seconds'];//время


$author=$_SESSION['user'];//пользователь (автор)


$query = "INSERT INTO news (id,date,time,head,author,text,tags,edit,edited) 
VALUES ('".$id."','".$date."','".$time."','".$head."','".$author."','".$text."','".$tags."','0','0')"; 


	    $res=mysql_query($query);
	    

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

	
////////////////////////////////////////////////////////

//	echo "".$row['head']."";
	mysql_close($dbh);  
 
 
 //	echo "".$_REQUEST['head']."";
 ?>