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
//скрипт добавления новости в корзину
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////




//идентификатор новости из таблицы news, которую нужно добавить в буфер
$id=$_GET['id'];

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
	
//проверка, существует ли уже новость с данным идентификатором в корзине

//имя пользователя
$user=$_SESSION['user'];

//получение идентификатора пользователя из таблицы users
$query="SELECT * FROM users WHERE name='".$user."'";	
					
 $res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
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

//запрос на выборку
$query1="SELECT * FROM ".$buffer_user."";				
 $res1=mysql_query($query1);
if($res1==false){
					echo"Ошибка выполнения запроса. ";
					echo mysql_error();
					exit; }

while($row1=mysql_fetch_array($res1)){

$temp_news=$row1['id'];
if($temp_news==$id){//найдено совпадение. Новость уже есть в корзине.

header("Refresh: 2; URL=../frames_index/frame3.php?id=".$id." ");
 echo"Новость уже существует в корзине.";
 exit;

}//найдено совпадение. Новость уже есть в корзине.


}


break;
}//буфер пользователя найден



//    echo '' . $row[0] . '';



      }//конец цикла
	  







				
		//запрос к таблице news , выборка новости с идентификатором id
$query="SELECT * FROM news WHERE id='".$id."'";				
					
 $res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row=mysql_fetch_array($res);

$date=$row['date'];//дата создания-редактирования новости в копилке
$time=$row['time'];//время окончания создания - редактирования новости в копилке
$head=$row['head'];//заголовок новости
$author=$row['author'];//автор, добавивший новость в копилку
$text=$row['text'];//текст новости
$tags=$row['tags'];//теги



//имя пользователя
$user=$_SESSION['user'];

//получение идентификатора пользователя из таблицы users
$query="SELECT * FROM users WHERE name='".$user."'";	
					
 $res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
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

//запрос на добавление новости в буфер пользователя
$query2="INSERT INTO ".$buffer_user." (id,date,time,head,author,text,tags) 
VALUES ('".$id."','".$date."','".$time."','".$head."','".$author."','".$text."','".$tags."')";	
 $res2=mysql_query($query2);

					if($res2==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

break;
}//буфер пользователя найден



//    echo '' . $row[0] . '';



      }//конец цикла
	  
	  
					
mysql_close($dbh);  


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index/frame3.php?id=".$id." ");
 echo"Новость успешно добавлена в корзину.";
 
 ?>