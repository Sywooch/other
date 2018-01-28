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

</head>

<body style="background-color:black; margin:0 !important; padding:0 !important; border:0 !important;">

<div id="div_frame1" name="div_frame1" style="padding:0; border:0; margin:0; width:100%; height:100%; position:fixed; 
background-color:white; opacity: 0.7;  filter: alpha(Opacity=70);   
display:none; z-index:99999999999;">
</div>

<?php

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");//соединение
mysql_query("SET NAMES utf8");
					mysql_query ("SET COLLATION_CONNECTION=utf8");
                    mysql_query("SET CHARACTER_SET_CLIENT=utf8");
					mysql_query("SET CHARACTER_SET_RESULTS=utf8");
					mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
					mysql_query("SET NAMES utf8");
					
//получение текущей даты
$today=getdate();
$today_date=$today['year']."-".$today['mon']."-".$today['mday'];		

			
					
$query = "SELECT * FROM news GROUP BY date DESC ";
$res=mysql_query($query);


if(!isset($_GET['date'])){

while($row=mysql_fetch_array($res)){

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
style="width:100%; height:40px; background-color:white; border-bottom:1px black solid; border-top:1px black solid;">
<div style="width:100%; height:10px;"></div>
<a onclick="update_2_3()" target="frame2" href="frame2.php?date='.$row['date'].'" style="color:white; text-decoration:none; cursor:pointer;">
<span style="color:black; text-decoration:none; cursor:pointer;">'.$row["date"].'</span></a></div>';
};

}//конец цикла
}else{

$date_color=$_GET['date'];

$count_scroll=0;
$count_scroll2=0;

while($row=mysql_fetch_array($res)){

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




?>

</body>

</html>
