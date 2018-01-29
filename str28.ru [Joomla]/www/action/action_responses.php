<?php
//echo"".$_POST['title']."</br>";
//echo"".$_POST['comment']."</br>";
session_start();
header('Content-type: text/html; charset=utf-8');

//с какой страницы пришёл вызов????
$str=$_GET['str'];

$pacth="";
if($str==='1'){
$pacth="/";
}
else if($str==='2'){
$pacth="/index.php/news";
}
else if($str==='3'){
$pacth="/index.php/about";
}
else if($str==='4'){
$pacth="/index.php/gallery";
}
else if($str==='5'){
$pacth="/index.php/documentation";
}
else{
$pacth="/index.php/kontakty";

}





if ( !isset($_POST['theme'] )||($_POST['theme']=="") ) { 
    header("Refresh: 2; URL=".$pacth.""); //перенаправление на страницу, с которой произошёл вызов этого скрипта
echo'Ошибка: Вы не указали тему сообщения. Перенаправление...';  
  die();//прекращение выполнения функции. 
  } 


 if ( !isset( $_POST['title'] )||($_POST['title']=="") ) { 
    header("Refresh: 2; URL=".$pacth.""); //перенаправление на страницу, с которой произошёл вызов этого скрипта
	echo'Ошибка: Вы не указали свой e-mail. Перенаправление...'; 
    die();//прекращение выполнения функции. 
  } 
  if ( !isset( $_POST['comment'] )||($_POST['comment']=="") ) { 
    header("Refresh: 2; URL=".$pacth.""); //перенаправление на страницу, с которой произошёл вызов этого скрипта
    echo'Ошибка: Вы не написали текст. Перенаправление...';
	die();//прекращение выполнения функции. 
  } 
  
 if(!isset($_POST['bot'])||($_POST['bot']=="")){  
 header("Refresh: 2; URL=".$pacth.""); //перенаправление на страницу, с которой произошёл вызов этого скрипта
      echo'2. Перенаправление...';
	die();//прекращение выполнения функции. 
	}
  
 if(!isset($_GET['sum'])||($_GET['sum']=="")){  
 header("Refresh: 2; URL=".$pacth.""); //перенаправление на страницу, с которой произошёл вызов этого скрипта
 echo'3. Перенаправление...';
    die();//прекращение выполнения функции. 
	}
  
  
 if($_GET['sum']!=md5($_POST['bot'])){ 
    header("Refresh: 2; URL=".$pacth."");
echo'Ошибка: Вы неверно ввели число с картинки. Перенаправление...';
	
	
	die();//прекращение выполнения функции. 
	}
  
 //получить текущие дату и время
$today = getdate();
$year=$today['year'];
$mon=$today['mon'];
$day=$today['mday'];
$weekday=$today['weekday'];
$hours=$today['hours'];
$minutes=$today['minutes'];
$seconds=$today['seconds'];


$date="".$year."-".$mon."-".$day."";
$time="".$hours.":".$minutes.":".$seconds."";

$result_today="".$year."-".$mon."-".$day.", ".$weekday.", ".$hours.":".$minutes.":".$seconds."";

//отправка сообщения на почту.
//перевод на русский язык названий дней недели.
		$week_rus=array("Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье");		
		$week_eng=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
		$result_today2 = str_replace( $week_eng, $week_rus, $result_today );
	
$html='<p>E-mail адрес автора : '.$_POST['title']."</p>
<hr size=\"1\">
 <p>Дата/Время : ".$result_today2."</p>
 <hr size=\"1\">
 <p>Текст : ".$_POST['comment'].'</p>
		<hr size="1">';
		
$theme=$_POST['theme'];		
		
//echo $theme."</br>";
//echo $html;		

$log=mail("770870@str28.ru", $theme, $html, "Content-type: text/html; charset=utf-8");

header( "Refresh: 2; URL=".$pacth."" ); 
echo'Сообщение отправлено успешно. Перенаправление...';

		











?>