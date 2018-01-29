<?php
header('Content-type: text/html; charset=utf-8');
require '../../config/config.php';
session_start();

$backend_email=$_POST["backend_email"];
$backend_password=$_POST["backend_password"];

//echo $backend_email."<br>";
//echo $backend_password;


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("Невозможно соединиться с MySQL сервером!");
mysql_query("set character_set_results='utf8'");
mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");  
mysql_select_db(DB_BASE)or die("Невозможно подключиться к базе!");
mysql_query("SET NAMES utf8");




if( (!isset($backend_email))||($backend_email=="")||($backend_email==NULL)||(!isset($backend_password))||($backend_password=="")||($backend_password==NULL) ){
echo"Ошибка! Пустое имя пользователя или пароль.";
echo'
<script type="text/javascript">
//window.location.href="/admin/login.php";
</script>
';


exit;

}


//запрос к таблице users и извлечение имени пользователя и пароля
//$query="SELECT * FROM users WHERE email='".$backend_email."'";


$y = mysql_query("SELECT * FROM `users` WHERE `email` = '".$backend_email."' AND `password` = '".md5($backend_password)."'");
$t = mysql_num_rows($y);
if($t == 1){

$_SESSION["price_user"]=$backend_email;
	echo'
	<script type="text/javascript">
	window.location.href="/admin/index.php";
	</script>
	ok';
	
}else{

echo"Ошибка! Неверное имя пользователя или пароль.";
	echo'
	<script type="text/javascript">
	window.location.href="/admin/login.php";
	</script>
	error';
	exit;

}

/*

$query="SELECT * FROM users WHERE email='".$backend_email."'";


//$t = mysql_num_rows($query);
$t=1;

if($t == 1){
//логин найден
//извлечение логина и хешированного пароля
$res = mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
$row=mysql_fetch_array($res);


	if(($row["active"]!="Y")||($row["deleted"]!="N")){
	echo"Ошибка! Логин не найден.";
	echo'
	<script type="text/javascript">
	//window.location.href="/admin/login.php";
	</script>
	';
	exit;
	}


$base_login=$row["email"];
$base_pass=$row["password"];

	if(($base_login==$backend_email)&&($base_pass==md5($backend_password))){
	$_SESSION["price_user"]=$backend_email;
	echo'
	<script type="text/javascript">
	//window.location.href="/admin/index.php";
	</script>
	';
	
	exit;
	
	}else{
	echo"Ошибка! Неверное имя пользователя или пароль.";
	echo'
	<script type="text/javascript">
	//window.location.href="/admin/login.php";
	</script>
	';
	exit;

	
	}

}else{
echo"Ошибка! Логин не найден.";
echo'
<script type="text/javascript">
//window.location.href="/admin/login.php";
</script>
';
exit;
}

*/


?>

