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
//скрипт осуществляет вставку новости из корзины в какой-либо выпуск новостей
////данный скрипт могут запускать пользователи с привилегиями editor и admin
//так-же скрипт может также запустить пользователь с привилегиями correspondent, который
//который осуществляет добавление 
// новостного блока из корзины в собственный выпуск новостей.
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

					mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh0, DB_BASE);


//запрос к news_releases и извлечение строки
$query0="SELECT * FROM news_releases WHERE id_buffer='".$id_buffer0."'";
	  $res0=mysqli_query($dbh, $query);

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







if(!isset($_GET['table_buffer'])){echo"Ошибка! Не задано наименование буфера."; exit; };

$table_buffer=$_GET['table_buffer'];//наименование таблицы - буфера, в которую нужно
//записать новости из корзины (таблица вида buffer_[идентификатор])

if(!isset($_GET['date'])){echo"Ошибка! Не задана дата."; exit; };
$date_get=$_GET['date'];//дата (необхолима для работы 2-го фрейма)

//вычисление названия буфера пользователя(таблица вида user_[идентификатор ])
$buffer_user="";

$user=$_SESSION['user'];//имя пользователя

//вычисление названия таблицы-буфера пользователя.

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

				
//запрос к таблице users, извлечение идентификатора пользователя по имени
$query="SELECT * FROM users WHERE name='$user'";

$res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }
$row=mysqli_fetch_array($res);

$id_user=$row['id'];


//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list=mysqli_query($dbh,'SHOW TABLES');
 
 
 
 while($row = mysqli_fetch_array($t_list)) {

//разбиение строки на части , разделитель - _

$mas_name_table=explode("_",$row[0]);

if(($mas_name_table[0]=="user")&&($mas_name_table[1]==$id_user)){//буфер пользователя найден

$buffer_user=$row[0];//наименование буфера пользователя, таблица типа user_[идентификатор пользователя]_buffer_[идентификатор буфера]


break;
}//буфер пользователя найден
      }//конец цикла
		


if(!isset($_POST['chb'])){exit; };

$chb=$_POST['chb'];

foreach($chb as $index => $go)
{

//$go - идентификатор новости из корзины
//извлечение новости из корзины
$query="SELECT * FROM ".$buffer_user." WHERE id='$go'";
$res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }
$row=mysqli_fetch_array($res);


$date=$row['date']; //echo"".$date."</br>";
$time=$row['time']; //echo"".$time."</br>";
$head=$row['head']; //echo"".$head."</br>";
$author=$row['author']; //echo"".$author."</br>";
$text=$row['text']; //echo"".$text."</br>";
$tags=$row['tags']; //echo"".$tags."</br>";

//вставка новости в таблицу $table_buffer

//определение количества записей в таблице buffer_(идентификатор буффера)
//echo" table_buffer -".$table_buffer."</br>";
$query3="SELECT COUNT(*) FROM ".$table_buffer." ";
$res3=mysqli_query($dbh, $query);

					if($res3==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
					
					
if(mysqli_num_rows($res3)>1){

 $row3 = mysqli_fetch_row($res3);

 $total = $row3[0];
 
 $count=$total+1;

}else{
$count=1;

}
					

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("INSERT INTO ".$table_buffer." (id,date,time,head,author,text,tags,num) VALUES ('".$go."','".$date."','".$time."','".$head."','".$author."','".$text."','".$tags."','".$count."')"); 

$mysqli->close(); 


};



						mysqli_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
$id_buffer="";
$id_buffer=str_replace('buffer_','',$table_buffer);




header("Refresh: 2; URL=../frames_index_buffer/frame3.php?id_buffer=".$id_buffer."&date=".$date_get."");
echo"Новость успешно добавлена.";	 	

 
 ?>