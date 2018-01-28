<?php 
session_start();
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


header('Content-type: text/html; charset=utf-8');


if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){
exit;
};


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


if(!isset($_GET['id'])){exit;};
if(!isset($_POST['text'])){exit;};
if(!isset($_POST['head'])){exit;};
if(!isset($_POST['tags'])){exit;};

$id=$_GET['id'];//идентификатор новости
$text=$_POST['text'];//текст новости
$head=$_POST['head'];//заголовок новости
$tags=$_POST['tags'];//теги




$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;//дата

$time=$today['hours'].":".$today['minutes'].":".$today['seconds'];//время


$author=$_SESSION['user'];//пользователь (автор)




$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("INSERT INTO news (id,date,time,head,author,text,tags,edit,edited) VALUES ('".$id."','".$date."','".$time."','".$head."','".$author."','".$text."','".$tags."','0','0')"); 

$mysqli->close(); 


	
////////////////////////////////////////////////////////

//	echo "".$row['head']."";
	mysqli_close($dbh);  
 
 
 //	echo "".$_REQUEST['head']."";
 ?>