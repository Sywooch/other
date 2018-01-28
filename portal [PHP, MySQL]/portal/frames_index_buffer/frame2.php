<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);



if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=login.php");
};



//вычисление уровня привилегий

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
					
	$user=$_SESSION['user'];				
$query = "SELECT * FROM users WHERE name='$user' ";					
	$res=mysqli_query($dbh, $query);				
	$row=mysqli_fetch_array($res);

$privilege=$row['privilege'];//привилегии пользователя

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>


<!--ajax-->
<script type="text/javascript" src="../jquery/jquery.js"></script>
<!--ajax-->



</head>

<body  style="background-color:white; margin:0 !important; padding:0 !important; border:0 !important;">
<?php

if((!isset($_GET['date']))&&(!isset($_GET['id_buffer']))){//дата не передана. Срабатывает в случае, если страница загружена в первый раз.

//получение текущей даты
$today3=getdate();
$today_date3=$today3['year']."-".$today3['mon']."-".$today3['mday'];	
		
$date3=$today_date3;//дата


///перезагрузка первого фрейма 
//выделение выбранной даты.
echo'
<script type="text/javascript">
parent.frame1.location = "frame1.php?date='.$date3.'";
</script>';

$date=$date3;
//во второй фрейм выводятся новостные выпуски, созданные именно для этой даты.




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
					

//запрос к таблице news_releases и выборка всех новостных выпусков с заданной датой.

	$query = "SELECT * FROM news_releases WHERE date='".$date."' ORDER BY time_ok DESC";
	$res=mysqli_query($dbh, $query);

$count_news_releases=0;

$count_scroll=0;
$count_scroll2=0;


while($row=mysqli_fetch_array($res)){
$radio=$row['radio'];//радио, для которого создавался выпуск
$time_ok=$row['time_ok'];//время создания выпуска
$time=$row['time'];//время, на которое назначен выход новостного выпуска
$author=$row['author'];//пользователь, создавший новостной выпуск

$id_buffer=$row['id_buffer'];//идентификатор буфера, будет использоваться в работе 3-го фрейма




if($privilege=='admin'){//только Администратор может удалять новостные выпуски
////////кнопка удаления новостного выпуска
echo'<div id="delete_news_block'.$row['id'].'" name="delete_news_block'.$row['id'].'"
 style="width:100%; height:20px; margin-top:10px; border-bottom:2px black solid; display:block;" >';

echo'
					<!--кнопка Удалить Новостной выпуск -->
							<div align="center" style="width:95px; height:18px; border:1px black solid; 
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;
							float:left; border-left:0px black solid;" 
							onclick="button_delete'.$row['id'].'();">
							<span style="font-size:10pt !important;">Удалить</span>
							</div>
							<!--кнопка Удалить Новостной выпуск  -->';
							
							
							
							
					echo'		<script type="text/javascript">
							function button_delete'.$row['id'].'(){
							var show = confirm("Вы действительно хотите удалить новостной выпуск ?");
							
							if(show==true){
							document.location.href = "../action/delete_news_release_block.php?id='.$row['id'].'";
							}else{
							
							
							}
							
							
							}
							</script>';
							
							
	echo'</div>';	
////////////////кнопка удаления новостного выпуска
};//только Администратор может удалять новостные выпуски





echo'
<a href="frame3.php?id_buffer='.$id_buffer.'&date='.$date.'" target="frame3" >
<div id="color_div" name="color_div" 
style="width:100%; height:200px;'; 
if(!isset($_GET['id_buffer_color'])){
echo' background-color:transparent; ';
}else{
if($id_buffer==$_GET['id_buffer_color']){
echo' background-color:yellow; ';
 $count_scroll2=$count_scroll;
}else{
echo' background-color:transparent; ';

}

}

echo'
border-bottom:2px black solid;">';
echo'
<!--заголовок и время нажатия кнопки ОК на форме создания новостного выпуска-->
<div style="width:100%; height:40px; border-bottom:1px black solid; background-color:transparent;">
<div align="left" style="padding-top:5px; padding-bottom:5px; height:30px; float:left; width:85%; background-color:transparent;">';
echo'
<span style="color:black; font-size:14pt; margin-left:10px;"  id="head" name="head">
<strong>'.$radio.'</strong></span>

</div>
<div align="left" style=" height:35px; padding-top:5px; float:left; width:15%; background-color:transparent;">

<span style="color:black; font-size:14pt;">'.$time_ok.'</span>';

echo'
</div>
</div>

<!--заголовок и время нажатия кнопки ОК на форме создания новостного выпуска-->



<!---->
<div style="width:100%; height:150px; background-color:transparent;">

<!--2-->
<div style="width:90%; height:150px; float:left; background-color:transparent;">

<div style="width:90%; height:10px; background-color:transparent;">

</div>

<div style="width:90%; height:110px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" id="time" name="time" >'.$time.'</span>
</div>

<div style="width:90%; height:30px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" id="author" name="author" >'.$author.'</span>
</div>

</div>
<!--2-->


<!--1-->
<div style="width:10%; height:150px; float:left; background-color:transparent;">
<!--метка - статус редактирования новости-->
<div style="width:100%; height:30px; background-color:transparent;">
<div id="edit1" name="edit1"  style="width:30px; height:30px; "></div>
</div>
</div>
<!--1-->


</div>
<!---->';


echo'
</div><!--<div style="width:100%;  background-color:transparent;">-->
</a>


';
$count_news_releases++;
$count_scroll++;

}
	
if($privilege=='admin'){

$height_scroll=$count_scroll2*222;
}else{

$height_scroll=$count_scroll2*300;

}

echo'
<script type="text/javascript">
 

$(document).ready(function(){
   window.scrollBy(0,'.$height_scroll.');
});
</script>';



if($count_news_releases==0){

echo'
<div align="center" style="width:100%; height:40px; ">
<span style="font-size:14pt;">Для данной даты не создано новостных выпусков</span>
</div>
';

}



}else if(!isset($_GET['id_buffer'])){//Во второй фрейм передана дата. Срабатывает в случае, если вызов пришёл из 
//первого фрейма при нажатии на блок с датой. 

if(!isset($_GET['date'])){echo"Ошибка! Не задана дата."; exit; };
$date=$_GET['date'];//дата
//во второй фрейм выводятся новостные выпуски, созданные именно для этой даты.


echo'
<script type="text/javascript">
parent.frame1.location = "frame1.php?date='.$date.'";
</script>';




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
					

//запрос к таблице news_releases и выборка всех новостных выпусков с заданной датой.

	$query = "SELECT * FROM news_releases WHERE date='".$date."' ORDER BY time_ok DESC";
	$res=mysqli_query($dbh, $query);

$count_news_releases=0;

$count_scroll=0;
$count_scroll2=0;


while($row=mysqli_fetch_array($res)){
$radio=$row['radio'];//радио, для которого создавался выпуск
$time_ok=$row['time_ok'];//время создания выпуска
$time=$row['time'];//время, на которое назначен выход новостного выпуска
$author=$row['author'];//пользователь, создавший новостной выпуск

$id_buffer=$row['id_buffer'];//идентификатор буфера, будет использоваться в работе 3-го фрейма




if($privilege=='admin'){//только Администратор может удалять новостные выпуски
////////кнопка удаления новостного выпуска
echo'<div id="delete_news_block'.$row['id'].'" name="delete_news_block'.$row['id'].'"
 style="width:100%; height:20px; margin-top:10px; border-bottom:2px black solid; display:block;" >';

echo'
					<!--кнопка Удалить Новостной выпуск -->
							<div align="center" style="width:95px; height:18px; border:1px black solid; 
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;
							float:left; border-left:0px black solid;" 
							onclick="button_delete'.$row['id'].'();">
							<span style="font-size:10pt !important;">Удалить</span>
							</div>
							<!--кнопка Удалить Новостной выпуск  -->';
							
							
							
							
					echo'		<script type="text/javascript">
							function button_delete'.$row['id'].'(){
							var show = confirm("Вы действительно хотите удалить новостной выпуск ?");
							
							if(show==true){
							document.location.href = "../action/delete_news_release_block.php?id='.$row['id'].'";
							}else{
							
							
							}
							
							
							}
							</script>';
							
							
	echo'</div>';	
////////////////кнопка удаления новостного выпуска
};//только Администратор может удалять новостные выпуски





echo'
<a href="frame3.php?id_buffer='.$id_buffer.'&date='.$date.'" target="frame3" >
<div id="color_div" name="color_div" 
style="width:100%; height:200px;'; 
if(!isset($_GET['id_buffer_color'])){
echo' background-color:transparent; ';
}else{
if($id_buffer==$_GET['id_buffer_color']){
echo' background-color:yellow; ';
 $count_scroll2=$count_scroll;
}else{
echo' background-color:transparent; ';

}

}

echo'
border-bottom:2px black solid;">';
echo'
<!--заголовок и время нажатия кнопки ОК на форме создания новостного выпуска-->
<div style="width:100%; height:40px; border-bottom:1px black solid; background-color:transparent;">
<div align="left" style="padding-top:5px; padding-bottom:5px; height:30px; float:left; width:85%; background-color:transparent;">';
echo'
<span style="color:black; font-size:14pt; margin-left:10px;"  id="head" name="head">
<strong>'.$radio.'</strong></span>

</div>
<div align="left" style=" height:35px; padding-top:5px; float:left; width:15%; background-color:transparent;">

<span style="color:black; font-size:14pt;">'.$time_ok.'</span>';

echo'
</div>
</div>

<!--заголовок и время нажатия кнопки ОК на форме создания новостного выпуска-->



<!---->
<div style="width:100%; height:150px; background-color:transparent;">

<!--2-->
<div style="width:90%; height:150px; float:left; background-color:transparent;">

<div style="width:90%; height:10px; background-color:transparent;">

</div>

<div style="width:90%; height:110px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" id="time" name="time" >'.$time.'</span>
</div>

<div style="width:90%; height:30px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" id="author" name="author" >'.$author.'</span>
</div>

</div>
<!--2-->


<!--1-->
<div style="width:10%; height:150px; float:left; background-color:transparent;">
<!--метка - статус редактирования новости-->
<div style="width:100%; height:30px; background-color:transparent;">
<div id="edit1" name="edit1"  style="width:30px; height:30px; "></div>
</div>
</div>
<!--1-->


</div>
<!---->';


echo'
</div><!--<div style="width:100%;  background-color:transparent;">-->
</a>


';
$count_news_releases++;
$count_scroll++;

}
	
if($privilege=='admin'){

$height_scroll=$count_scroll2*222;
}else{

$height_scroll=$count_scroll2*300;

}

echo'
<script type="text/javascript">
 

$(document).ready(function(){
   window.scrollBy(0,'.$height_scroll.');
});
</script>';



if($count_news_releases==0){

echo'
<div align="center" style="width:100%; height:40px; ">
<span style="font-size:14pt;">Для данной даты не создано новостных выпусков</span>
</div>
';

}

}////Во второй фрейм передана дата. Срабатывает в случае, если вызов пришёл из 
//первого фрейма при нажатии на блок с датой. 


if(!isset($_GET['id_buffer'])){

}else{//Ситуация, при которой вызов приходит со страницы создания новостного выпуска.
if(!isset($_GET['id_buffer'])){echo"Ошибка! Не задан идентификатор буфера."; exit; };
$id_buffer=$_GET['id_buffer'];//идентификатор буфера, будет использоваться при создании таблицы (buffer_[идентификатор буфера])
//и при выводе списка новостных выпусков, дата которых совпадает с датой создания данного новостного выпуска.

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


$query = "SELECT * FROM news_releases WHERE id_buffer='".$id_buffer."' ORDER BY time_ok DESC";
$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);

$date=$row['date'];//дата создания новостного выпуска.



//получение текущей даты
$today3=getdate();
$today_date3=$today3['year']."-".$today3['mon']."-".$today3['mday'];	
		
$date3=$today_date3;//дата

///перезагрузка первого фрейма 
//выделение выбранной даты.
//echo'
//<script type="text/javascript">
//parent.frame1.location = "frame1.php?date='.$date3.'";
//</script>';

//$date=$date3;
//во второй фрейм выводятся новостные выпуски, созданные именно для этой даты.



//$id_buffer-идентификатор буфера
$query_1 = "SELECT * FROM news_releases WHERE id_buffer='".$id_buffer."' ORDER BY time_ok DESC";
	$res_1=mysqli_query($dbh, $query_1);
$row_1=mysqli_fetch_array($res_1);
$id_yellow_1=$row_1['id'];//идентификатор новостного выпуска, который нужно выделить.

echo'
<script type="text/javascript">
parent.frame1.location = "frame1.php?date='.$date3.'";
</script>';



//запрос к таблице news_releases и выборка всех новостных выпусков с заданной датой.

	$query = "SELECT * FROM news_releases WHERE date='".$date."' ORDER BY date, time_ok DESC";
	$res=mysqli_query($dbh, $query);

while($row=mysqli_fetch_array($res)){
$radio=$row['radio'];//радио, для которого создавался выпуск
$time_ok=$row['time_ok'];//время создания выпуска
$time=$row['time'];//время, на которое назначен выход новостного выпуска
$author=$row['author'];//пользователь, создавший новостной выпуск

$id_buffer=$row['id_buffer'];//идентификатор буфера, будет использоваться в работе 3-го фрейма


if($privilege=='admin'){//только Администратор может удалять новостные выпуски
////////кнопка удаления новостного выпуска
echo'<div id="delete_news_block'.$row['id'].'" name="delete_news_block'.$row['id'].'"
 style="width:100%; height:20px; margin-top:10px; border-bottom:2px black solid; display:block;" >';

echo'
					<!--кнопка Удалить Новостной выпуск -->
							<div align="center" style="width:95px; height:18px; border:1px black solid; 
							padding:0 !important; cursor:pointer; background-color:transparent; 
							position:relative !important; z-index:9 !important;
							float:left; border-left:0px black solid;" 
							onclick="button_delete'.$row['id'].'();">
							<span style="font-size:10pt !important;">Удалить</span>
							</div>
							<!--кнопка Удалить Новостной выпуск  -->';
							
							
					echo'		<script type="text/javascript">
							function button_delete'.$row['id'].'(){
							var show = confirm("Вы действительно хотите удалить новостной выпуск ?");
							
							if(show==true){
							document.location.href = "../action/delete_news_release_block.php?id='.$row['id'].'";
							}else{
							
							
							}
							
							
							}
							</script>';
							
							
	echo'</div>';	
////////////////кнопка удаления новостного выпуска
};//только Администратор может удалять новостные выпуски


echo'
<a href="frame3.php?id_buffer='.$id_buffer.'&date='.$date.'" target="frame3">
<div style="width:100%; height:200px;'; 
if($id_yellow_1==$row['id']){
echo' background-color:yellow; '; 
}else{
echo' background-color:transparent; '; 
}
echo'
border-bottom:2px black solid;">';
echo'
<!--заголовок и время нажатия кнопки ОК на форме создания новостного выпуска-->
<div style="width:100%; height:40px; border-bottom:1px black solid; background-color:transparent;">
<div align="left" style="padding-top:5px; padding-bottom:5px; height:30px; float:left; width:85%; background-color:transparent;">';
echo'
<span style="color:black; font-size:14pt; margin-left:10px;"  id="head" name="head">
<strong>'.$radio.'</strong></span>

</div>
<div align="left" style=" height:35px; padding-top:5px; float:left; width:15%; background-color:transparent;">

<span style="color:black; font-size:14pt;">'.$time_ok.'</span>';

echo'
</div>
</div>

<!--заголовок и время нажатия кнопки ОК на форме создания новостного выпуска-->



<!---->
<div style="width:100%; height:150px; background-color:transparent;">

<!--2-->
<div style="width:90%; height:150px; float:left; background-color:transparent;">

<div style="width:90%; height:10px; background-color:transparent;">

</div>

<div style="width:90%; height:110px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" id="time" name="time" >'.$time.'</span>
</div>

<div style="width:90%; height:30px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" id="author" name="author" >'.$author.'</span>
</div>

</div>
<!--2-->


<!--1-->
<div style="width:10%; height:150px; float:left; background-color:transparent;">
<!--метка - статус редактирования новости-->
<div style="width:100%; height:30px; background-color:transparent;">
<div id="edit1" name="edit1"  style="width:30px; height:30px; "></div>
</div>
</div>
<!--1-->


</div>
<!---->';


echo'
</div><!--<div style="width:100%;  background-color:transparent;">-->
</a>
';

}
	






}//Ситуация, при которой вызов приходит со страницы создания новостного выпуска.



?>
</html>
