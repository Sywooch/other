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









$table_buffer=$_GET['table_buffer'];//наименование таблицы - буфера, в которую нужно
//записать новости из корзины (таблица вида buffer_[идентификатор])


$date_get=$_GET['date'];//дата (необхолима для работы 2-го фрейма)

//вычисление названия буфера пользователя(таблица вида user_[идентификатор ])
$buffer_user="";

$user=$_SESSION['user'];//имя пользователя

//вычисление названия таблицы-буфера пользователя.
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
				
//запрос к таблице users, извлечение идентификатора пользователя по имени
$query="SELECT * FROM users WHERE name='$user'";

$res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);

$id_user=$row['id'];


//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list=mysql_query('SHOW TABLES') or die("Invalid query: " . mysql_error());
 
 
 
 while($row = mysql_fetch_array($t_list)) {

//разбиение строки на части , разделитель - _

$mas_name_table=explode("_",$row[0]);

if(($mas_name_table[0]=="user")&&($mas_name_table[1]==$id_user)){//буфер пользователя найден

$buffer_user=$row[0];//наименование буфера пользователя, таблица типа user_[идентификатор пользователя]_buffer_[идентификатор буфера]


break;
}//буфер пользователя найден
      }//конец цикла
		




$chb=$_POST['chb'];

foreach($chb as $index => $go)
{

//$go - идентификатор новости из корзины
//извлечение новости из корзины
$query="SELECT * FROM ".$buffer_user." WHERE id='$go'";
$res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);


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
$res3=mysql_query($query);

					if($res3==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
					
					
if(mysql_num_rows($res3)>1){

 $row3 = mysql_fetch_row($res3);

 $total = $row3[0];
 
 $count=$total+1;

}else{
$count=1;

}
					

$query = "INSERT INTO ".$table_buffer." (id,date,time,head,author,text,tags,num) 
VALUES ('".$go."','".$date."','".$time."','".$head."','".$author."','".$text."','".$tags."','".$count."')"; 

  $res=mysql_query($query);
				if($res==false){
				echo"Ошибка выполнения запроса.";
				echo mysql_error();
				exit; }
					


};



						mysql_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
$id_buffer="";
$id_buffer=str_replace('buffer_','',$table_buffer);




header("Refresh: 2; URL=../frames_index_buffer/frame3.php?id_buffer=".$id_buffer."&date=".$date_get."");
echo"Новость успешно добавлена.";	 	

 
 ?>