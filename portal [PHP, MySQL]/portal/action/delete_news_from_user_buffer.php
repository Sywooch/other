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

if(!isset($_GET['id'])){echo"Ошибка! Не задан идентификатор новости, которую нужно удалить из корзины."; 
exit;};

//идентификатор новости, которую нужно удалить из корзины
$id=$_GET['id'];



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

//удаление из таблицы новости с идентификатором id
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("DELETE FROM ".$buffer_user." WHERE id='".$id."' "); 

$mysqli->close(); 


break;
}//буфер пользователя найден
      }//конец цикла
		
mysqli_close($dbh);  
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../edit_user_buffer.php");
        echo"Новость успешно удалена из корзины";

 ?>