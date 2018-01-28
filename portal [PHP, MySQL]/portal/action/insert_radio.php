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
//скрипт добавления радио 
//может выполняться только по команде пользователя с привилегиями admin
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
mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

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


if($privilege0!='admin'){

header("Refresh: 2; URL=../index.php");
echo"Вы не имеете привилегий для выполнения операции.";	 	


}









if(!isset($_POST['text'])){echo"Ошибка! Не задано наименование радио."; exit;};

$name=$_POST['text'];//наименование добавляемого радио
  

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

//генерация идентификатора для радио
$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday'];
$date_gen=$today_date;//дата

$time_gen=$today['hours']."".$today['minutes']."".$today['seconds'];//время

$random=rand();
$id=$date_gen.$time_gen.$random;


//получение англоязычного наименования для радио
$tr = array(
        "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
        "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
        "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
        "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
        "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
        "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
        "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
        "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
        "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
        "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
        "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
        "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
        "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"
    );

$name_eng=strtr($name,$tr);


//добавление в таблицу list_radio
$query="INSERT INTO list_radio (id, name, name_eng) VALUES ('".$id."','".$name."','".$name_eng."')";
 $res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
					


					
//создание таблицы list_time_radio[$id--идентификатор добавляемого радио]
$query="CREATE TABLE list_time_radio".$id." ( id TEXT, time TIME, id2 INT(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY(id2) )";

 $res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

	

header("Refresh: 2; URL=../create_news.php?step=1");
	echo"Радио успешно добавлено.";	
				
mysqli_close($dbh);  
        
 
 ?>