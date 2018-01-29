<?php

$name=$_POST["call_order_name"];//имя
$phone=$_POST["call_order_phone"];//телефон
$mail=$_POST["call_order_mail"];//e-mail

//отправка e-mail администратору

$date_pay=date("Y-m-d");
$time_pay=date("H:i:s");

$html='<hr size="1">
		<p>'.$date_pay.' - '.$time_pay.'</p>
		<p>Имя: '.$name.'</p>
		<p>Телефон: '.$phone.'</p>
		<p>E-mail: '.$mail.'</p>';
		
		

mail("gsu1234@mail.ru", "Новая заявка на обратный звонок", $html, "Content-type: text/html; charset=utf-8");


header("Refresh: 2; URL=/");
echo'Ваша заявка успешно отправлена. Сейчас Вы будете перенаправлены на главную...';

?>