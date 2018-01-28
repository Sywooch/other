<?php
//echo"".$_POST['title']."</br>";
//echo"".$_POST['comment']."</br>";
session_start();
header('Content-type: text/html; charset=utf-8');

 if ( !isset( $_POST['title'] )||($_POST['title']=="") ) { 
    header("Refresh: 2; URL=../responses.php"); //перенаправление на страницу, с которой произошёл вызов этого скрипта
    die();//прекращение выполнения функции. 
  } 
  if ( !isset( $_POST['comment'] )||($_POST['comment']=="") ) { 
    header("Refresh: 2; URL=../responses.php"); //перенаправление на страницу, с которой произошёл вызов этого скрипта
    die();//прекращение выполнения функции. 
  } 
  
 if(!isset($_POST['bot'])||($_POST['bot']=="")){  
 header("Refresh: 2; URL=../responses.php"); //перенаправление на страницу, с которой произошёл вызов этого скрипта
    die();//прекращение выполнения функции. 
	}
  
 if(!isset($_SESSION['sum'])||($_SESSION['sum']=="")){  
 header("Refresh: 2; URL=../responses.php"); //перенаправление на страницу, с которой произошёл вызов этого скрипта
    die();//прекращение выполнения функции. 
	}
  
  
 if($_SESSION['sum']!=$_POST['bot']){ 
    header("Refresh: 2; URL=../responses.php");
echo'Ошибка: Вы неверно ввели число с картинки. Перенаправление...';
	
	
	die();//прекращение выполнения функции. 
	}
  
  
ini_set('display_errors',1);
error_reporting(E_ALL);
mysql_query("set character_set_results='utf8'");
$dbh=mysql_connect('localhost','root','fiexitheitheivae') or die ("Невозможно соединиться с сервером.");
mysql_select_db('db_specstroy') or die ("Невозможно подключиться к базе.");
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

$query = "INSERT INTO response_table(name, text, date_time)
VALUES('".$_POST['title']."','".$_POST['comment']."','".$result_today."')";
 $res=mysql_query($query)or die("Ошибка выполнения запроса: " . mysql_error());
 mysql_close($dbh);	


//если мы оказались здесь, то запись в базу прошла успешно.
//отправка сообщения на почту.
//перевод на русский язык названий дней недели.
		$week_rus=array("Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье");		
		$week_eng=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
		$result_today2 = str_replace( $week_eng, $week_rus, $result_today );
	
$html=''.$_POST['title']." / ".$result_today2."/".$_POST['comment'].'
		<hr size="1">
		<p>Ссылка для удаления отзыва:</p>
		<a href="http://www.ooospecstroy.ru/action/delete.php?name='.$_POST['title'].'&comment='.$_POST['comment'].'&date_time='.$result_today.'">Удалить</a>';
		
		
		
mail("gsu1234@mail.ru", "Спецстрой. Появился новый отзыв.", $html, "Content-type: text/html; charset=utf-8");



$tmp="../responses.php";
header( 'Location: '.$tmp ); 













?>