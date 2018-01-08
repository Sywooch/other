<?php


$email=$_POST['email'];

$text="E-mail: ".$email."";

mail("gsu1234@mail.ru", "Заявка на получение прайс-листа", $text, 
     "From: null@test.taki.su \r\n" 
    ."X-Mailer: PHP/" . phpversion());	
	
?>