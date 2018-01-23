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


//if($name==""){ echo 'Ошибка! Не заполнено поле "Имя"'; exit;}
if($phone==""){

	if($mail==""){ echo 'Ошибка! Не заполнено поле "E-mail"'; exit;}

}else{
	
	
	
}



if(!email_check($mail)){ echo 'Ошибка! Неправильно заполнено поле "E-mail"'; exit; }


$message="Имя: ".$name."\n"."Телефон: ".$phone."\n"."email: ".$mail."\n"."Сообщение: ".$message;





if(mail("gsu1234@mail.ru", $subject, $message, "From: form1@libelle.dance")){
echo "OK";
}else{
echo "Ошибка отправки сообщения.";
};


//if(mail("gsu1234@mail.ru","test","Hello")) echo "отправлено!";



//  $host = "ssl://smtp.gmail.com";
//        $port = "465";
//        $username = "<www2libelle@gmail.com>";
//        $password = "fhl6gRd47";
		
/*
require_once "SendMailSmtpClass.php";
 
$mailSMTP = new SendMailSmtpClass('gsu4306@gmail.com', 'gMz7iQ1KX0O1', 'ssl://smtp.gmail.com', 'libelle', 465);
  
// заголовок письма
$headers= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n"; 	// кодировка письма
$headers .= "From: ".$name." <".$mail.">\r\n";   			// от кого письмо
$result =  $mailSMTP->send('gsu1234@mail.ru', 'gmail', 'Текст письма', $headers); // отправляем письмо
if($result === true)
{
    echo "Письмо успешно отправлено";
}
else
{
    echo "Ошибка отправки##: " . $result;
}



*/
	

?>