<?php


$name=$_POST['name'];
$phone=$_POST['phone'];
$message=$_POST['message'];

$text="
Имя: ".$name."
Телефон: ".$phone."
Комментарий: ".$message."
";

mail("gsu1234@mail.ru", "Новая заявка", $text, 
     "From: null@test.taki.su \r\n" 
    ."X-Mailer: PHP/" . phpversion());	
	
?>