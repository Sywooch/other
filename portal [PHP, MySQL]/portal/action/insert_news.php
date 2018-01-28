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
//скрипт, осуществляющий добавление новости в копилку
//может быть вызван любым пользователем
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

if((!isset($_POST['head']))||(!isset($_POST['tags']))||(!isset($_GET['id']))){
header("Refresh: 2; URL=../frames_index/frame3.php?id=".$_GET['id']."");
echo"Ошибка! Некорректный ввод.</br>";
if(!isset($_POST['head'])){echo"Не определён заголовок новости.</br>"; };
if(!isset($_POST['tags'])){echo"Не определены теги новости.</br>"; };
if(!isset($_GET['id'])){echo"Не определён идентификатор новости.</br>"; };
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

					
$head=$_POST['head'];//заголовок
$tags=$_POST['tags'];//теги
$id=$_GET['id'];//идентификатор



$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;//дата

$time=$today['hours'].":".$today['minutes'].":".$today['seconds'];//время

$author=$_SESSION['user'];//пользователь (автор)



//проверка, существует ли новостной блок с заданным идентификатором id
$query1 = mysqli_query($dbh,"SELECT * FROM news WHERE id=".$id." ");
if (!$result = mysqli_fetch_array($query1)){
//несуществует
//вставка



$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("INSERT INTO news (id,date,time,head,author,text,tags,edit) VALUES ('".$id."','".$date."','".$time."','".$head."','".$author."','','".$tags."','0')"); 

$mysqli->close(); 

				
}
else
{
//существует
//обновление 


$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("UPDATE news SET date='$date' , time='$time' , head='$head' , author='$author' , tags='$tags', edit='0' WHERE id='$id'"); 

$mysqli->close(); 




          
}




						mysqli_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index/frame3.php?ok=1");
echo"Новость успешно добавлена.";	 	
        
 
 ?>