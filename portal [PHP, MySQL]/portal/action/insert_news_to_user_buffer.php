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



if(!isset($_GET['id'])){ echo"Ошибка! Не задан идентификатор новости."; exit;};
//идентификатор новости из таблицы news, которую нужно добавить в буфер
$id=$_GET['id'];



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
		
	
//проверка, существует ли уже новость с данным идентификатором в корзине

//имя пользователя
$user=$_SESSION['user'];

//получение идентификатора пользователя из таблицы users
$query="SELECT * FROM users WHERE name='".$user."'";	
					
 $res=mysqli_query($dbh, $query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
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

//запрос на выборку
$query1="SELECT * FROM ".$buffer_user."";				
 $res1=mysqli_query($dbh,$query1);
if($res1==false){
					echo"Ошибка выполнения запроса. ";
					echo mysql_error();
					exit; }

while($row1=mysqli_fetch_array($res1)){

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
					
 $res=mysqli_query($dbh, $query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row=mysqli_fetch_array($res);

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
					
 $res=mysqli_query($dbh, $query);

					if($res==false){
					echo"Ошибка выполнения запроса.";
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

//запрос на добавление новости в буфер пользователя
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("INSERT INTO ".$buffer_user." (id,date,time,head,author,text,tags) VALUES ('".$id."','".$date."','".$time."','".$head."','".$author."','".$text."','".$tags."')"); 

$mysqli->close(); 




break;
}//буфер пользователя найден



//    echo '' . $row[0] . '';



      }//конец цикла
	  
	  
					
mysqli_close($dbh);  


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../frames_index/frame3.php?id=".$id." ");
 echo"Новость успешно добавлена в корзину.";
 
 ?>