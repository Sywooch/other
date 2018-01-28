<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


if(!isset($_POST['login'])){echo"Ошибка! Не задан логин."; exit;};
if(!isset($_POST['password'])){echo"Ошибка! Не задан пароль."; exit;};

//имя пользователя и пароль
if(!isset($_POST['login'])){echo"Ошибка! Не задан логин."; exit; };
$login=$_POST['login'];

if(!isset($_POST['password'])){echo"Ошибка! Не задан пароль."; exit; };
$password=$_POST['password'];



//поиск имени пользователя в базе, извлечение идентификатора и строки с хешированным паролем.

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




$query = "SELECT * FROM users ORDER BY name";

 $res=mysqli_query($dbh, $query);

$log=0;

while($row=mysqli_fetch_array($res)){

if($row['name']==$login){$log=1;};

}//конец цикла


if($log==0){

header("Refresh: 2; URL=../login.php");
					echo"Ошибка! Неверное имя пользователя или пароль.";
					
					exit; }






$query = "SELECT * FROM users WHERE name='$login'";

 $res=mysqli_query($dbh, $query);

$row=mysqli_fetch_array($res);

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



//проверка, существует ли буфер пользователя. 
//если не существует, то буфер будет создан.
$log_buffer=0; //0-буфер пользователя не найден
//1-буфер пользователя найден.



//имя пользователя
$user2=$_SESSION['user'];

//получение идентификатора пользователя из таблицы users
$query2="SELECT * FROM users WHERE name='".$user2."'";	

 $res2=mysqli_query($dbh, $query2);

					if($res2==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row2=mysqli_fetch_array($res2);
$id_user2=$row2['id'];

//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list=mysqli_query($dbh,'SHOW TABLES');
 
 
 
 while($row = mysqli_fetch_array($t_list)) {

//разбиение строки на части , разделитель - _

$mas_name_table=explode("_",$row[0]);

if(($mas_name_table[0]=="user")&&($mas_name_table[1]==$id_user2)){//буфер пользователя найден

$log_buffer=1;

break;
}//буфер пользователя найден



//    echo '' . $row[0] . '';



      }//конец цикла
	  



if($log_buffer==0){//если буфер пользователя не найден, то создаётся новый буфер.




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

$query="CREATE TABLE ".$name_buffer." 
( id TEXT, date DATE, time TIME, head TEXT, author TEXT, text TEXT, tags TEXT, id2 INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(id2)  )";


 $res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }




}//если буфер пользователя не найден, то создаётся новый буфер.





header("Refresh: 2; URL=../index.php");//авторизация успешна.
echo'Авторизация успешна.';





}else{//авторизация неудачна
header("Refresh: 2; URL=../login.php");//ошибка.
echo'Ошибка! Неверное имя пользователя или пароль.';

}



?>

