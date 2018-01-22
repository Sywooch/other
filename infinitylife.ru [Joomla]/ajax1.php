<?php
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
    header('Access-Control-Allow-Headers: X-Requested-With'); 

$name=$_POST['name'];
$phone=$_POST['phone'];
echo $name." = ".$phone;
$message="Имя: ".$name."<br>Телефон: ".$phone;



if(($name!="")&&($phone!="")){

mail("gsu1234@mail.ru", "MGL - Заказ создания индивидуального ландшафта [ajax1]", $message, 
     "From: null@mygardenland.ru \r\n"
	."Content-type: text/html; charset=utf-8 \r\n"  
    ."X-Mailer: PHP/" . phpversion()); 
	
mail("alana@3topolya.ru", "MGL - Заказ создания индивидуального ландшафта [ajax1]", $message, 
     "From: null@mygardenland.ru \r\n"
	."Content-type: text/html; charset=utf-8 \r\n"  
    ."X-Mailer: PHP/" . phpversion()); 	
	
mail("form@3topolya.ru", "MGL - Заказ звонка [ajax1]", $message, 
     "From: null@mygardenland.ru \r\n"
	."Content-type: text/html; charset=utf-8 \r\n"  
    ."X-Mailer: PHP/" . phpversion()); 	
	
mail("89206562268@mail.ru", "MGL - Заказ звонка [ajax1]", $message, 
     "From: null@mygardenland.ru \r\n"
	."Content-type: text/html; charset=utf-8 \r\n"  
    ."X-Mailer: PHP/" . phpversion()); 		
	
}
	
?>