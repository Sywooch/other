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

$dbh0 = mysqli_init();
mysqli_options($dbh0, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh0, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
mysqli_real_connect($dbh0, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

					mysqli_query($dbh0,"SET NAMES utf8");
					mysqli_query ($dbh0,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh0,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh0,"SET CHARACTER_SET_RESULTS=utf8");	
	
					mysqli_select_db($dbh0, DB_BASE);
			
					
					//поиск имени в базе и определение уровня привилегий
$query0 = "SELECT * FROM users WHERE name='".$user0."'";

$res0=mysqli_query($dbh0,$query0);
	    

					if($res0==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					

$row0=mysqli_fetch_array($res0);

$privilege0=$row0['privilege'];

if(($privilege0!='admin')||($privilege0!='editor')){

}else if($privilege0!='correspondent'){
//$user0 - имя пользователя
//$id_buffer0 - идентификатор буфера
//в таблице news_releases эти две переменные должны находиться в одной 
//строке. В противном случае Корреспондент пытается удалить новость 
//из "чужого" выпуска новостей.

if(!isset($_GET['id_buffer'])){echo"Ошибка! Не задан идентификатор буфера."; exit; };

$id_buffer0=$_GET['id_buffer'];

$dbh0 = mysqli_init();
mysqli_options($dbh0, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh0, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
mysqli_real_connect($dbh0, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

					mysqli_query($dbh0,"SET NAMES utf8");
					mysqli_query ($dbh0,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh0,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh0,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh0, DB_BASE);
	
//запрос к news_releases и извлечение строки
$query0="SELECT * FROM news_releases WHERE id_buffer='".$id_buffer0."'";
	  $res0=mysqli_query($dbh0, $query);

					if($res0==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
	$row0=mysqli_fetch_array($res0);					
		
		$author_base=$row0['author'];
		
		if($author_base==$user0){
		
		
		}else{
		
		header("Refresh: 2; URL=../index.php");
		echo"Вы не имеете привилегий для выполнения операции.";	 	

		
		}

}










if(!isset($_GET['id_buffer'])){echo"Ошибка! Не задан идентификатор буфера."; exit; };
//идентификатор буфера
$id_buffer=$_GET['id_buffer'];


if(!isset($_GET['date'])){echo"Ошибка! Не задана дата."; exit; };
//дата (используется при работе второго фрейма)
$date_get=$_GET['date'];




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
$res=mysqli_query($dbh, $query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
 $row = mysqli_fetch_row($res);
 $total = $row[0];
 $count=$total+1;
 

//добавление новости в таблицу buffer_(идентификатор буфера)
//num - номер добавленной новости
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("INSERT INTO buffer_".$id_buffer." (id,date,time,head,author,text,tags,num) VALUES ('".$id."','".$date."','".$time."','".$head."','".$author."','".$text."','".$tags."','".$count."')"); 

$mysqli->close(); 




					
mysqli_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index_buffer/frame3.php?id_buffer=".$id_buffer."&date=".$date_get." ");
        
 
 ?>