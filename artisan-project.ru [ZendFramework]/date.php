<?php
session_start();
function vydiratel($text,$before,$after) 
{ 
         $text = @explode($before,$text); 
         $text = @explode($after,$text[1]); 
         $text = $text[0]; 
         return($text); 
} 

$date=$_POST['date'];


if(isset($_SESSION[$date])){
$data=$_SESSION[$date];
}else{

$data = @file_get_contents ('http://api2.vasha-ats.ru/daytype.php?date='.$date.'') or die('<br />');

$_SESSION[$date]=$data;
}

$data1 = vydiratel($data,"Date: "," ");

$data = vydiratel($data,"DayType: "," ");

$data=trim($data);

if(strftime("%a", strtotime($data1))=='Sat'){
$data=0;	
}


echo $data;


?>