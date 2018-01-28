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
//скрипт добавления пользователя. 
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






if(!isset($_POST['name'])){echo"Ошибка! Не задано имя пользователя."; exit;};
if(!isset($_POST['password'])){echo"Ошибка! Не задан пароль."; exit;};
if(!isset($_POST['privilege'])){echo"Ошибка! Не заданы привилегии."; exit;};

$name=$_POST['name'];//введённое имя пользователя
$password=$_POST['password'];//введённый пароль
$privilege=$_POST['privilege'];//привилегии

if($privilege=='1'){$privilege='correspondent'; }
else if($privilege=='2'){$privilege='editor';}
else if($privilege=='3'){$privilege='admin';}


//хеширование пароля
//генерация соли
$length = 32;//длина строки
$repeat = false;//повторение символов запрещено
$UpperCase = true;//использование больших символов
$LowerCase = true;//использование малых символов
$Symbols = true;//использование символов
$SymbolsList__ = '0123456789';//символы
$UpperCaseList = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';//большие буквы 
$LowerCaseList = 'abcdefghijklmnopqrstuvwxyz';//малые буквы

$UpperCase = $UpperCaseList;
$LowerCase = $LowerCaseList;  
$Symbols = $SymbolsList__;

unset ($UpperCaseList, $LowerCaseList, $SymbolsList__);


 /* Объединяет большие и маленькие буквы с символами в одну строку, случайно определяя очерёдность их в ней. */
  switch (rand(0, 5)) {
       
                case 0: $All = $UpperCase. $LowerCase . $Symbols;
                case 1: $All = $UpperCase. $Symbols . $LowerCase;
                case 2: $All = $Symbols . $LowerCase .$UpperCase;
                case 3: $All = $Symbols . $UpperCase . $LowerCase;
                case 4: $All = $LowerCase .$Symbols . $UpperCase;
                case 5: $All = $LowerCase . $UpperCase . $Symbols;
                       
        }
		
unset ($UpperCase, $LowerCase, $Symbols);

$totalLength = strlen($All) - 1;

 if (!$repeat) {
       
                $totalLength++;
       
                if($length > $totalLength) {
               
              //  echo "Error while generating the string: the maximum length is exceeded ($length 
			  //instead of $totalLength characters)";
                    
 
                }
               
                $totalLength--;
				
				$i=0;
				$string="";
                while ($i++ < $length) {
               
                        $Current = $All{rand(0, $totalLength--)};
                        $All = str_replace($Current, '', $All);
                        $string .= $Current;
                       
                }
               
        } else {
		
		$i=0;
		 while ($i++ < $length) {
               
                        $string .= $All{rand(0, $totalLength)};
                       
                }
                    }


 unset ($All, $i, $length, $totalLength, $repeat);



//$string - результирующая строка


//хеширование пароля
$plaintext=$password;//незашифрованный пароль
$salt=$string;//соль
$encrypted=md5($plaintext.$salt);//хешированный пароль


$encrypted_base=$encrypted.":".$salt;



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


$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];//текущая дата
$today_time=$today['hours'].":".$today['minutes'].":".$today['seconds'];//текущее время


$today2="";
//идентификатор пользователя
$today2=getdate();
$today_date2=$today2['year']."".$today2['mon']."".$today2['mday'];
$today_time2=$today2['hours']."".$today2['minutes']."".$today2['seconds'];
$random2=rand();



$id=$today_date2.$today_time2.$random2;//идентификатор пользователя


$id2=$id;


//добавление пользователя в таблицу users
$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_BASE); 
$mysqli->set_charset("utf8");
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$mysqli->query("INSERT INTO users (id, name, password, privilege, date, time, lost_date, lost_time) VALUES ('".$id2."','".$name."','".$encrypted_base."','".$privilege."','".$today_date."','".$today_time."','0000-00-00','00:00:00')"); 

$mysqli->close(); 



header("Refresh: 2; URL=../management_users.php");
	echo"Пользователь успешно добавлен.";	
				
mysqli_close($dbh);  


 ?>