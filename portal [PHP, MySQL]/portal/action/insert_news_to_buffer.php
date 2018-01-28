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
//скрипт добавления новости в выпуск новостей
//
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


if(!isset($_GET['id_buffer'])){echo"Ошибка! Не задан идентификатор буфера."; exit; };

//идентификатор буфера
$id_buffer=$_GET['id_buffer'];

if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор новости."; exit; };

//идентификатор новости
$id=$_GET['id'];


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
					
	
	
	//запрос к таблице news , выборка новости с идентификатором id
$query="SELECT * FROM news WHERE id='".$id."'";

  $res=mysqli_query($dbh, $query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row=mysqli_fetch_array($res);

$date=$row['date'];//дата создания-редактирования новости в копилке
$time=$row['time'];//время окончания создания - редактирования новости в копилке
$head=$row['head'];//заголовок новости
$author=$row['author'];//автор, добавивший новость в копилку
$text=$row['text'];//текст новости
$tags=$row['tags'];//теги
$edit=$row['edit'];//статус редактирования (в данный момент редактируется или нет)

//определение количества записей в таблице buffer_(идентификатор буффера)
$query="SELECT COUNT(*) FROM buffer_".$id_buffer." ";
$res=mysqli_query($dbh, $query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
 $row = mysql_fetch_row($res);
 $total = $row[0];
 $count=$total+1;
 

//добавление новости в таблицу buffer_(идентификатор буфера)
//num - номер добавленной новости
$query = "INSERT INTO buffer_".$id_buffer." (id,date,time,head,author,text,tags,num) 
VALUES ('".$id."','".$date."','".$time."','".$head."','".$author."','".$text."','".$tags."','".$count."')"; 

  $res=mysqli_query($dbh, $query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
mysqli_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index_buffer/frame3.php?id_buffer=".$id_buffer." ");
        
 
 ?>