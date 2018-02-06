<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

$req = json_decode( file_get_contents('php://input'), true );

$mail=$req["email"];

$key_size =  strlen($key);
$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
//$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
$iv = $AES_IV;
$mail = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $mail, MCRYPT_MODE_CBC, $iv);
$mail = $iv . $mail;
$mail = base64_encode($mail);


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к БД.");
mysql_query("set character_set_results='utf8'");
mysql_query("SET NAMES utf8");
mysql_query("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query = mysql_query("SELECT `phone` FROM `users` WHERE `mail`='".$mail."' LIMIT 1");
if($query==false){
	echo"Ошибка выполнения запроса.";
	echo mysql_error();
	exit; 
}

$count = mysql_num_rows($query); 


if($count==0){ echo "Ошибка. Данный e-mail не найден."; exit; };

$phone=mysql_result($query,0);
$ciphertext_dec = base64_decode($phone);
$iv_dec = substr($ciphertext_dec, 0, $iv_size);
$ciphertext_dec = substr($ciphertext_dec, $iv_size);
$plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
$phone=$plaintext_dec;


//отправка письма пользователю
$to  = "<".$mail.">";

$subject = "Письмо"; 

$message = '<span>Ваш номер телефона:</span> <b>'.$phone.'</b>';

$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
$headers .= "From: <null@auslogics.test>\r\n"; 


mail($to, $subject, $message, $headers); 




echo "Данные отправлены успешно.";


?>