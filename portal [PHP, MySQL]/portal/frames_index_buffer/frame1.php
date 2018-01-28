<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);




if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header(" Refresh: 1; URL=login.php");
};
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

</head>

<body style="background-color:black; margin:0 !important; padding:0 !important; border:0 !important;">

<div id="div_frame1" name="div_frame1" style="padding:0; border:0; margin:0; width:100%; height:100%; position:fixed; 
background-color:white; opacity: 0.7;  filter: alpha(Opacity=70);   
display:none; z-index:99999999999;">
</div>

<?php

//вывод списка дат: от сегодняшней до (сегодняшняя дата - 30 дней).

				
//получение текущей даты
$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];		
$arr1=explode('-',$today_date);


$today_time="00".":"."00".":"."00";//текущее время
$time11=explode(':',$today_time);

$time1=mktime($time11[0],$time11[1],$time11[2],$arr1[1],$arr1[2],$arr1[0]);//время в секундах, прошедшее с 1 января 1970 00:00
//до сегодняшнего дня

$time30=$time1-(30*24*60*60);//время в секундах, прошедшее с 1 января 1970 00:00 до (сегоднящняя дата - 30 дней)


//текущая дата - 30 дней
$today_date_min30=date("Y-n-j", $time30);


$start = $time30;
$stop = $time1;

if(!isset($_GET['date'])){

for($temp=$stop; $temp >= $start; $temp -= 86400){
echo'<div align="center" 
style="width:100%; height:40px; ';
echo" background-color:white; ";
echo'
border-bottom:1px black solid; border-top:1px black solid;">
<div style="width:100%; height:10px;"></div>
<a onclick="update_2_3()" target="frame2" href="frame2.php?date='.date('Y-n-j',$temp).'" 
style="color:white; text-decoration:none; cursor:pointer;">
<span style="color:black; text-decoration:none; cursor:pointer;">'.date('Y-n-j',$temp).'</span></a></div>';
	

}//конец цикла


}else{
$date_color=$_GET['date'];
$count_scroll=0;
$count_scroll2=0;

for($temp=$stop; $temp >= $start; $temp -= 86400){
echo'<div align="center" 
style="width:100%; height:40px; ';

if($date_color==date('Y-n-j',$temp)){
echo" background-color:yellow; ";
 $count_scroll2=$count_scroll;
}else{
echo" background-color:white; ";
}
echo'
border-bottom:1px black solid; border-top:1px black solid;">
<div style="width:100%; height:10px;"></div>
<a onclick="update_2_3()" target="frame2" href="frame2.php?date='.date('Y-n-j',$temp).'" 
style="color:white; text-decoration:none; cursor:pointer;">
<span style="color:black; text-decoration:none; cursor:pointer;">'.date('Y-n-j',$temp).'</span></a></div>';
	
$count_scroll++;

}//конец цикла

$height_scroll=$count_scroll2*41;
echo'
<script type="text/javascript">

   window.scrollBy(0,'.$height_scroll.');
</script>';

}



?>

<script type="text/javascript">
function update_2_3(){

parent.frame3.location = "frame3.php";

}
</script>

</body>

</html>
