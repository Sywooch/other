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
//скрипт, осуществляющий удаление новости из корзины
//скрипт имеют право запускать все пользователи.
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

//идентификатор новости, которую нужно удалить из корзины
$id=$_GET['id'];


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

//удаление из таблицы новости с идентификатором id
$query2="DELETE FROM ".$buffer_user." WHERE id='".$id."' ";
$res2=mysql_query($query2);

if($res2==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }

break;
}//буфер пользователя найден
      }//конец цикла
		
mysql_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../edit_user_buffer.php");
        echo"Новость успешно удалена из корзины";

/*
					$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");

//удаление новости с идентификатором id из таблицы buffer_(идентификатор).
$query="DELETE FROM buffer_".$id_buffer." WHERE id='".$id."'";
	  $res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

//собрать все идентификаторы
$query="SELECT num FROM buffer_".$id_buffer." ORDER BY num ";
	  $res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
$i=0;
while($row=mysql_fetch_array($res)){
$mas[$i]=$row['num'];
$i++;
}


for($i2=0;$i2<$i;$i2++){
$mas2[$i2]=$i2;

$query="UPDATE buffer_".$id_buffer." SET num='".$mas2[$i2]."' WHERE num='".$mas[$i2]."'";
$res=mysql_query($query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

}	



				

 */
 ?>