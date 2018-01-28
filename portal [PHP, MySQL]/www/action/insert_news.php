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





					$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
					
$head=$_POST['head'];//заголовок
$tags=$_POST['tags'];//теги
$id=$_GET['id'];//идентификатор



$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;//дата

$time=$today['hours'].":".$today['minutes'].":".$today['seconds'];//время

$author=$_SESSION['user'];//пользователь (автор)



//проверка, существует ли новостной блок с заданным идентификатором id
$query1 = mysql_query("SELECT * FROM news WHERE id=".$id." ");
if (!$result = mysql_fetch_array($query1)){
//несуществует
//вставка
$query = "INSERT INTO news (id,date,time,head,author,text,tags,edit) 
VALUES ('".$id."','".$date."','".$time."','".$head."','".$author."','','".$tags."','0')"; 


	    $res=mysql_query($query);
	    

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
}
else
{
//существует
//обновление 



$query = "UPDATE news SET date='$date' , time='$time' , head='$head' , author='$author' , tags='$tags', edit='0' 
WHERE id='$id'";

	    $res=mysql_query($query);
	    

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }



          
}




						mysql_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index/frame3.php?ok=1");
echo"Новость успешно добавлена.";	 	
        
 
 ?>