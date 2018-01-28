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
//скрипт добавляет пустой блок в редактируемый выпуск новостей
////данный скрипт могут запускать пользователи с привилегиями editor и admin
//так-же скрипт может также запустить пользователь с привилегиями correspondent, который
//который осуществляет добавление пустого
// новостного блока в собственный выпуск новостей.
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
//в таблице news_releases эти две переменные должны находиться в одной 
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
$query0="SELECT * FROM news_releases WHERE id_buffer='".$id_buffer0."'";
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

//дата (используется при работе второго фрейма)
$date_get=$_GET['date'];




					$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
	
	
//генерация идентификатора
$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday'];
$date_gen=$today_date;//дата

$time_gen=$today['hours']."".$today['minutes']."".$today['seconds'];//время

$random=rand();
$id=$date_gen.$time_gen.$random;
	
	
//дата создания
$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];
$date=$today_date;//дата


//время создания
$time=$today['hours'].":".$today['minutes'].":".$today['seconds'];//время


//заголовок
$head="";


//автор
$author=$_SESSION['user'];//пользователь (автор)

//текст
$text="";

//теги 
$tags="";

	
//определение количества записей в таблице buffer_(идентификатор буффера)
$query="SELECT COUNT(*) FROM buffer_".$id_buffer." ";
$res=mysql_query($query);

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

  $res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
mysql_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index_buffer/frame3.php?id_buffer=".$id_buffer."&date=".$date_get." ");
        
 
 ?>