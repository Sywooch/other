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
//скрипт осуществляет смену привилегий пользователя.
//запускать скрипт имеет право только пользователь с привилегиями admin

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


if($privilege0!='admin'){

header("Refresh: 2; URL=../index.php");
echo"Вы не имеете привилегий для выполнения операции.";	 	


}






//проверка существования входных параметров
//если хотя бы одног из входных параметров не существует, то скрипт
//останавливает свою работу.
if(!isset($_GET['id'])){ echo"Ошибка! Не задан идентификатор пользователя."; exit; };
if(!isset($_POST['privilege'])){ echo"Ошибка! Не заданы новые привилегии."; exit; };

$id=$_GET['id'];//идентификатор пользователя, чьи привилегии нужно сменить

$new_privilege=$_POST['privilege'];//новые привилегии



if($new_privilege=='1'){ $new_privilege='correspondent'; }
else if($new_privilege=='2'){ $new_privilege='editor'; }
else if($new_privilege=='3'){ $new_privilege='admin'; }


$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

					
		
mysqli_select_db($dbh, DB_BASE);					


//обновление привилегии в базе


$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("UPDATE users SET privilege='".$new_privilege."' WHERE id='".$id."'"); 

$mysqli->close(); 


						

 
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
header("Refresh: 2; URL=../management_users.php");
echo"Привилегии успешно изменены.";	 	
    	

		mysqli_close($dbh);   
 
 ?>