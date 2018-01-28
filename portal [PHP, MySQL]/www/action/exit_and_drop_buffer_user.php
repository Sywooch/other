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
//скрипт осуществляет обнуление сессии пользователя и уничтожение корзины 
//пользователя.
//запускаться может любым пользователем. 
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////






$name_user=$_SESSION['user'];//получение имени авторизованного пользователя

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
					
					
//запрос к таблице users, извлечение идентификатора пользователя по имени
$query="SELECT * FROM users WHERE name='$name_user'";

$res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.1";
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

//удаление буфера
$query2="DROP TABLE ".$buffer_user."";

$res2=mysql_query($query2);

if($res2==false){
					echo"Ошибка выполнения запроса.2";
					echo mysql_error();
					exit; }



break;
}//буфер пользователя найден



//    echo '' . $row[0] . '';



      }//конец цикла
	  

//уничтожение переменной сессии
unset($_SESSION['user']);




header("Refresh: 2; URL=../login.php");
      
 mysql_close($dbh); 
 ?>
 