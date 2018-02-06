<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$req = json_decode( file_get_contents('php://input'), true );

$mail=$req["email"];
$phone=$req["phone"];


$key_size =  strlen($key);
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
//$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
$iv = $AES_IV;
$mail = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $mail, MCRYPT_MODE_CBC, $iv);
$phone = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $phone, MCRYPT_MODE_CBC, $iv);
$mail = $iv . $mail;
$phone = $iv . $phone;
$mail = base64_encode($mail);
$phone = base64_encode($phone);


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к БД.");
mysql_query("set character_set_results='utf8'");
mysql_query("SET NAMES utf8");
mysql_query("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query = mysql_query("SELECT id FROM `users` WHERE `mail`='".$mail."'");

$count = mysql_num_rows($query); 




if($count>0){ echo "Ошибка. Данный e-mail уже существует."; exit; };

$query="INSERT INTO users VALUES ('','".$mail."','".$phone."')";
$res=mysql_query($query);
if($res==false){
	echo"Ошибка выполнения запроса.";
	echo mysql_error();
	exit; 
}

echo "Данные отправлены успешно.";

?>