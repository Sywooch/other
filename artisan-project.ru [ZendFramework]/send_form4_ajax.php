<?php


$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$message=$_POST['message'];

$text="
Имя: ".$name."
E-mail: ".$email."
Телефон: ".$phone."
Сообщение: ".$message."
";

mail("gsu1234@mail.ru", "Сообщение с формы обратной связи", $text, 
     "From: null@test.taki.su \r\n" 
    ."X-Mailer: PHP/" . phpversion());	
	
?>