<?php

function email_check($email) {
if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i",trim($email)))
{
	return false;
}
	else return true;
}



$name=$_POST['name'];
$mail=$_POST['mail'];
$phone=$_POST['phone'];
$subject=$_POST['subject'];
$message=$_POST['message'];


if($name==""){ echo 'Ошибка! Не заполнено поле "Имя"'; exit;}
if($mail==""){ echo 'Ошибка! Не заполнено поле "E-mail"'; exit;}
if($phone==""){ echo 'Ошибка! Не заполнено поле "Телефон"'; exit;}

if(!email_check($mail)){ echo 'Ошибка! Неправильно заполнено поле "E-mail"'; exit; }


$message="Имя: ".$name."\n"."Телефон: ".$phone."\n"."Сообщение: ".$message;





if(mail("gsu1234@mail.ru", $subject, $message, "From:".$mail)){
echo "Сообщение отправлено успешно.";
}else{
echo "Ошибка отправки сообщения.";
};





?>