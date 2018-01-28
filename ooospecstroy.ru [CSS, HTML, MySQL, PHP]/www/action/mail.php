<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
	$week_rus=array("Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье");		
	$week_eng=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
	$row['date_time'] = str_replace( $week_eng, $week_rus, $row['date_time'] );
	
$html="<p class=\"myriad_pro12\">
	   <span class=\"myriad_pro12_strong\"><strong>"
	    .$row['name']." / ".$row['date_time']."
		</strong></span></br>".$row['text']."</p>
		<hr size=\"1\">";
		


if(mail("gsu1234@mail.ru", "Спецстрой. Появился новый отзыв.", "Текст: \"".$html."\"")==TRUE){echo'Почта успешно принята для доставки.';}
else{echo'Почта не принята для доставки.';};




?>