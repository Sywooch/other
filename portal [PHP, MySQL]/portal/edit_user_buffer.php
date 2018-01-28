<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);



if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=login.php");
exit;
};


$user=$_SESSION['user'];//имя пользователя
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Фабрика новостей - Корзина</title>
<script type="text/javascript" src="jquery/jquery.js"></script>
</head>
<body align="center" style="background-color:white; margin:0; padding:0; border:0;">

<?php


//вычисление названия таблицы-буфера пользователя.

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

				
//запрос к таблице users, извлечение идентификатора пользователя по имени
$query="SELECT * FROM users WHERE name='$user'";

$res=mysqli_query($dbh, $query);

if($res==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }
$row=mysqli_fetch_array($res);

$id_user=$row['id'];


//получение списка всех таблиц в базе.
//поиск таблицы user_[идентификатор пользователя]_buffer_[идентификатор буфера]
$t_list=mysqli_query($dbh,'SHOW TABLES');
 
 
 
 while($row = mysqli_fetch_array($t_list)) {

//разбиение строки на части , разделитель - _

$mas_name_table=explode("_",$row[0]);

if(($mas_name_table[0]=="user")&&($mas_name_table[1]==$id_user)){//буфер пользователя найден

$buffer_user=$row[0];//наименование буфера пользователя, таблица типа user_[идентификатор пользователя]_buffer_[идентификатор буфера]

$query2="SELECT * FROM ".$buffer_user." ORDER BY date, time";

$res2=mysqli_query($dbh,$query2);

if($res2==false){
					echo"Ошибка выполнения запроса";
					echo mysql_error();
					exit; }

//вывод содержимого корзины
 while($row2 = mysqli_fetch_array($res2)) {
 echo'<div align="left" style="width:100%; height:310px;  background-color:transparent; ">';
 
 echo'
 <div align="right" style="width:25%; height:310px; float:left; background-color:transparent;">
 <div style="width:100%; height:140px; "></div>
 <span style="margin-right:5px;">
 <a href="action/delete_news_from_user_buffer.php?id='.$row2['id'].'" title="Удалить новость из Корзины">Удалить</a></span>
 
 </div>
  ';
 
echo'<div align="left" style="width:50%; height:310px; background-color:transparent; float:left;">';
  echo'<div style="width:95%; height:310px; border-bottom:2px black solid; background-color:transparent; 
  border-left:2px black solid; border-right:2px black solid; border-top:2px black solid;">';
 
 
echo'<!--заголовок и время создания/редактирования-->
<div style="width:100%; height:50px; border-bottom:1px black solid; background-color:transparent;">
<div align="left" style="padding-top:5px; padding-bottom:5px; height:40px; float:left; width:80%; background-color:transparent;
font-size:16pt !important; font-weigh:bold !important">
<div style="float:left; width:10px; height:50px;"></div>
<span style="color:black; font-size:12pt; margin-left:0px; ">
<strong>'.$row2['head'].'</strong></span>
</div>

<div align="left" style=" height:50px; float:left; width:20%; background-color:transparent;
padding">
<div align="right" style="height:50px; float:left; width:90%;background-color:transparent;">
<div style="width:100%; height:5px; "></div>
<span style="color:black; font-size:14pt;">'.$row2['time'].'</span>

</div>

<div style="height:50px; float:left; width:10%; background-color:transparent;"></div>

</div>

</div>


<!---->
<div align="left" style="width:100%; height:259px; background-color:transparent;">
<div style="width:90%; height:259px; float:left; background-color:transparent;">

<div style="width:90%; height:30px; background-color:transparent;">
<span style="margin-left:10px;color:black;" >'.$row2['author'].'</span></div>
<div align="center" style="width:100%; height:180px; background-color:transparent;  padding-top:5px; padding-bottom:15px; overflow:hidden; ">';
echo'
<div align="left" style="width:90%; height:180px; overflow:hidden; background-color:transparent;">';

//замена ../mp3/ на /mp3/

$row2['text']=str_replace('../mp3/','mp3/',$row2['text']);


echo'
<span style="color:black; font-size:10pt !important;" >'.$row2['text'].'</span>
';

echo'
</div>';

echo'
</div>
<div style="width:90%; height:30px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" >'.$row2['tags'].'</span>
</div>

</div>
<div style="width:10%; height:259px; float:left; background-color:transparent;">
<!--метка - статус редактирования новости-->
<div style="width:100%; height:30px; background-color:transparent;">


<div ';

echo' style="width:30px; height:30px;';
  
 echo'
 "></div>
</div>

</div>

</div>
</div>

</div>
';

echo'</div>';


echo'</div>'; 
 }
//вывод содержимого корзины


break;
}//буфер пользователя найден
      }//конец цикла
		



?>



<div align="right" style="width:100%; height:50px; position:fixed !important; top:0 !important;
 margin-top:0 !important;">
<div align="right" style="width:300px; height:30px; margin-top:5px; margin-right:5px;">
<a href="#" onclick="window.close();">ЗАКРЫТЬ</a>
</div>
</div>



</body>
</html>
