<?php
header('Access-Control-Allow-Methods: POST, GET, OPTIONS'); 
    header('Access-Control-Allow-Headers: X-Requested-With'); 
$pole=$_POST['pole'];
$area=$_POST['area'];
$dem=$_POST['dem'];
$desc=$_POST['desc'];
$name=$_POST['name'];
$phone=$_POST['phone'];

$message="Имя :".$name."<br>Телефон:".$phone."<br>Площадь участка:".$pole."<br>Место/Направление:".$area."<br>Необходим ли демонтаж:".$dem."<br>Краткое описание:".$desc;




if(($name!="")&&($phone!="")){
	
mail("gsu1234@mail.ru", "MGL - Заказ звонка [ajax2]", $message, 
     "From: null@mygardenland.ru \r\n"
	."Content-type: text/html; charset=utf-8 \r\n" 
    ."X-Mailer: PHP/" . phpversion()); 
	
mail("alana@3topolya.ru", "MGL - Заказ звонка [ajax2]", $message, 
     "From: null@mygardenland.ru \r\n"
	."Content-type: text/html; charset=utf-8 \r\n"  
    ."X-Mailer: PHP/" . phpversion()); 	
	
mail("form@3topolya.ru", "MGL - Заказ звонка [ajax2]", $message, 
     "From: null@mygardenland.ru \r\n"
	."Content-type: text/html; charset=utf-8 \r\n"  
    ."X-Mailer: PHP/" . phpversion()); 	

mail("89206562268@mail.ru", "MGL - Заказ звонка [ajax2]", $message, 
     "From: null@mygardenland.ru \r\n"
	."Content-type: text/html; charset=utf-8 \r\n"  
    ."X-Mailer: PHP/" . phpversion()); 	

}
?>