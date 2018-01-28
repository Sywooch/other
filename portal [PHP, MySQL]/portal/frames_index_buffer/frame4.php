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

<!--


<div id="div_frame2" name="div_frame2" style="padding:0; border:0; margin:0; width:100%; height:100%; position:absolute;
 background-color:white; 
display:none;  z-index:99999999999; opacity: 0.7;  filter: alpha(Opacity=70);  ">
</div>-->


<?php

if((!isset($_GET['date']))){
///попадаем сюда изначально

}else{
//попадаем сюда после выбора блока с датой в первом фрейме


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
					
if(!isset($_GET['date'])){echo"Ошибка! Не задана дата."; exit; };

$date=$_GET['date'];//дата

if(!isset($_GET['id_buffer'])){echo"Ошибка! Не задан идентификатор буфера."; exit; };
//идентификатор буфера
$id_buffer=$_GET['id_buffer'];

$query = "SELECT * FROM news WHERE date='".$date."' ORDER BY time DESC";
$res=mysqli_query($dbh, $query);

///////цикл
while($row=mysqli_fetch_array($res)){

echo'<div id="div'.$row['id'].'" name="div'.$row['id'].'" 
style="width:100%; height:300px; position:absolute; background-color:transparent; z-index:99999999999; 
display:none;"></div>';



echo'<a target="frame3" href="../action/insert_news_to_buffer.php?id_buffer='.$id_buffer.'&id='.$row['id'].'" > ';
  echo'<div style="width:100%; height:300px; border-bottom:2px black solid; cursor:pointer;">';

echo'<!--заголовок и время создания/редактирования-->
<div style="width:100%; height:40px; border-bottom:1px black solid;">
<div align="left" style="padding-top:5px; padding-bottom:5px; height:30px; float:left; width:70%; background-color:transparent;">
<span style="color:black; font-size:14pt; margin-left:10px;"  id="head" name="head">'.$row['head'].'</span>
</div>
<div align="right" style=" height:40px; float:left; width:30%; background-color:transparent;">
<span style="color:black; font-size:14pt;">'.$row['time'].'</span>
</div>

</div>


<!---->
<div style="width:100%; height:259px; background-color:transparent;">
<div style="width:90%; height:259px; float:left; background-color:transparent;">
<div style="width:90%; height:30px; background-color:transparent;">
<span style="margin-left:10px;color:black;" id="author" name="author">'.$row['author'].'</span></div>
<div style="width:90%; height:200px; background-color:transparent; overflow:hidden;">';


echo'
<span style="margin-left:10px; color:black;" id="text" name="text" >'.$row['text'].'</span>
';

echo'
</div>
<div style="width:90%; height:30px; background-color:transparent; overflow:hidden;">
<span style="margin-left:10px; color:black;" id="tags" name="tags" >'.$row['tags'].'</span>
</div>

</div>
<div style="width:10%; height:259px; float:left; background-color:transparent;">
<!--метка - статус редактирования новости-->
<div style="width:100%; height:30px; background-color:transparent;">
<div id="edit1" name="edit1" ';

 
echo' style="width:30px; height:30px;';
 
 echo'
 "></div>
</div>

</div>

</div>
</div>

</div>
';

echo'</a> ';
}
///////цикл

};


?>


</body>

</html>
