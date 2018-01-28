<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


//имя пользователя и пароль
$login=$_POST['login'];
$password=$_POST['password'];


//поиск имени пользователя в базе, извлечение идентификатора и строки с хешированным паролем.
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");//соединение
mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                    mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");



$query = "SELECT * FROM users ORDER BY name";

 $res=mysql_query($query);

$log=0;

while($row=mysql_fetch_array($res)){

if($row['name']==$login){$log=1;};

}//конец цикла


if($log==0){

header("Refresh: 2; URL=../login.php");
					echo"Ошибка! Неверное имя пользователя или пароль.";
					
					exit; }






$query = "SELECT * FROM users WHERE name='$login'";

 $res=mysql_query($query);

$row=mysql_fetch_array($res);

$id=$row['id'];//идентификатор пользователя

$password_hesh=$row['password'];//хешированный пароль, (хеш-пароля:соль)

//извлечение соли из строки $password_hesh
$mas_tmp=explode(':',$password_hesh);


//хешированный пароль
$password_base_hesh=$mas_tmp[0];

//соль
$salt=$mas_tmp[1];

//хеширование пароля, введённого пользователем
$plaintext=$password;
$encrypted=md5($plaintext.$salt);//хешированный пароль


//сверка введённого хешированного пароля с хешированным паролем, извлечённым из базы.

if($encrypted==$password_base_hesh){//авторизация успешна

$_SESSION['user']=$login;

//создание буфера. таблица - user_[идентификатор пользователя]_buffer_[идентификатор буфера, случайно сгенерированное 
//число]
//генерация идентификатора буфера
$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday'];
$date_gen=$today_date;//дата

$time_gen=$today['hours']."".$today['minutes']."".$today['seconds'];//время

$random=rand();
$id_gen=$date_gen.$time_gen.$random;//идентификатор буфера


$name_buffer="user_".$id."_buffer_".$id_gen."";


//создание таблицы


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
					mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                   mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
$query="CREATE TABLE ".$name_buffer." ( id TEXT, date DATE, time TIME, head TEXT, author TEXT, text TEXT, tags TEXT, id2 INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(id) )";


 $res=mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

header("Refresh: 2; URL=../index.php");//авторизация успешна.
echo'Авторизация успешна.';





}else{//авторизация неудачна
header("Refresh: 2; URL=../login.php");//ошибка.
echo'Ошибка! Неверное имя пользователя или пароль.';

}



?>

