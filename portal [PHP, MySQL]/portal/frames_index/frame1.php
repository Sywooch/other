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

<script type="text/javascript">

function update_2_3()
{
parent.frame3.location = "frame3.php";
}

</script>
<script type="text/javascript" src="../jquery/jquery.js"></script>

</head>

<body style="background-color:black; margin:0 !important; padding:0 !important; border:0 !important;" 
>


<div id="div_frame1" name="div_frame1" style="padding:0; border:0; margin:0; width:100%; height:100%; position:fixed; 
background-color:white; opacity: 0.7;  filter: alpha(Opacity=70);   
display:none; z-index:99999999999;">
</div>

<?php

/*

$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");	

					mysqli_select_db($dbh, DB_BASE);
					
					
//получение текущей даты
$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];		

			
					
$query = "SELECT * FROM news GROUP BY date DESC ";
$res=mysqli_query($dbh, $query);


if(!isset($_GET['date'])){//дата не задана (вход на главную после авторизации).


//получение текущей даты
$today2=getdate();
$today_date2=$today2['year']."-".$today2['mon']."-".$today2['mday'];		

//проверка : если месяц или день представляют собой однозначные числа,
//то добавить слева ноль.
$date_mas=explode("-",$today_date2);
if((strlen($date_mas[1]))<2){ $date_mas[1]="0".$date_mas[1]; };
if((strlen($date_mas[2]))<2){ $date_mas[2]="0".$date_mas[2]; };
$date_color=$date_mas[0]."-".$date_mas[1]."-".$date_mas[2];


$count_scroll=0;
$count_scroll2=0;

$count_yellow=0;

while($row=mysqli_fetch_array($res)){

//получение даты из базы
$tmp=$row['date'];
$date1=$tmp;
$date2=$today_date;

$arr1=explode('-',$date1);
$arr2=explode('-',$date2);

//текущее время
$time111="00".":"."00".":"."00";

//время из базы
$time222=$row['time'];

$time22=explode(':',$time111);
$time11=explode(':',$time222);

$time1=mktime($time11[0],$time11[1],$time11[2],$arr1[1],$arr1[2],$arr1[0]);
$time2=mktime($time22[0],$time22[1],$time22[2],$arr2[1],$arr2[2],$arr2[0]);

$dif=($time2-$time1);


if($dif<=(30*24*60*60)){

echo'<div align="center" 
style="width:100%; height:40px;';
if($date_color==$row['date']){
 echo' background-color:yellow;';
 
 
 $count_scroll2=$count_scroll;
}else{
 echo' background-color:white;';
};
echo' border-bottom:1px black solid; border-top:1px black solid;">
<div style="width:100%; height:10px;"></div>
<a id="id1" name="id1" onclick="update_2_3()" target="frame2" href="frame2.php?date='.$row['date'].'" 
style="color:white; text-decoration:none; cursor:pointer;">
<span style="color:black; text-decoration:none; cursor:pointer;">'.$row["date"].'</span></a></div>';
 
 
 

};

$count_scroll++;



}//конец цикла


}else{



if(!isset($_GET['date'])){echo"Ошибка! Не задана дата."; exit; };
$date_color=$_GET['date'];

//проверка : если месяц или день представляют собой однозначные числа,
//то добавить слева ноль.
$date_mas=explode("-",$date_color);
if((strlen($date_mas[1]))<2){ $date_mas[1]="0".$date_mas[1]; };
if((strlen($date_mas[2]))<2){ $date_mas[2]="0".$date_mas[2]; };
$date_color=$date_mas[0]."-".$date_mas[1]."-".$date_mas[2];


$count_scroll=0;
$count_scroll2=0;

while($row=mysqli_fetch_array($res)){

//получение даты из базы
$tmp=$row['date'];
$date1=$tmp;
$date2=$today_date;

$arr1=explode('-',$date1);
$arr2=explode('-',$date2);

//текущее время
$time111="00".":"."00".":"."00";

//время из базы
$time222=$row['time'];

$time22=explode(':',$time111);
$time11=explode(':',$time222);

$time1=mktime($time11[0],$time11[1],$time11[2],$arr1[1],$arr1[2],$arr1[0]);
$time2=mktime($time22[0],$time22[1],$time22[2],$arr2[1],$arr2[2],$arr2[0]);

$dif=($time2-$time1);


if($dif<=(30*24*60*60)){

echo'<div align="center" 
style="width:100%; height:40px;';
if($date_color==$row['date']){
 echo' background-color:yellow;';
 $count_scroll2=$count_scroll;
}else{
 echo' background-color:white;';
};
echo' border-bottom:1px black solid; border-top:1px black solid;">
<div style="width:100%; height:10px;"></div>
<a onclick="update_2_3()" target="frame2" href="frame2.php?date='.$row['date'].'" style="color:white; text-decoration:none; cursor:pointer;">
<span style="color:black; text-decoration:none; cursor:pointer;">'.$row["date"].'</span></a></div>';
};

$count_scroll++;

}//конец цикла

$height_scroll=$count_scroll2*41;
echo'
<script type="text/javascript">

   window.scrollBy(0,'.$height_scroll.');
</script>';



}

*/



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

if(!isset($_GET['date'])){//попадаем сюда сразу после авторизации

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
$date_color2=explode("-",$date_color );
$date_color2_1=$date_color2[1];
$date_color2_2=$date_color2[2];
if($date_color2_1[0]=='0'){ $date_color2_1=$date_color2_1[1]; };
if($date_color2_2[0]=='0'){ $date_color2_2=$date_color2_2[1]; };
$date_color=$date_color2[0]."-".$date_color2_1."-".$date_color2_2;




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

</body>

</html>
