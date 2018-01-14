<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
  if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }

  if(!isset($_GET['id'])||($_GET['id']==NULL)||($_GET['id']=="")){
$x="my_clients";
header('Location: '.$x.".php");//перенаправление.
echo'Ошибка. Неверный параметр.'; 
 }

$id=$_GET['id'];//идентификатор передаваемого клиента
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

<script type="text/javascript" src="js/jquery.min.js"></script>

<script type="text/javascript">
function f_show(){
$("#f").show(2000);
}

function action(t){
var t2=("actions2.php?id_action="+t);

window.location.href=t2;

}
</script>


</head>

<body style="background-color:blue; color:white">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:1300px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:1200px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Мои клиенты - Передача клиента другому менеджеру</span>
</div>
<div align="center" style="width:1200px;  border:1px white solid; border-top:0px; font-size:15pt;  padding:5px">

<table style="width:1100px; font-size:11pt">
<tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px" colspan="12">
<span style="font-size:12pt">Информация о передаваемом клиенте</span>
</td>


</tr>
<tr style="font-size:10pt">

<td style="background-color:#3637ea; width:10px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:100px; padding:2px">Клиент</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Отрасль</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Лояльность</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Сайт</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Заметки</td>
<td style="background-color:#3637ea; width:130px; padding:2px">E-mail</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Адрес</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Категории</td>

</tr>

<?php

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$query="SELECT * FROM qdfmain WHERE ID='".$id."' ";

$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$row=mysql_fetch_array($res);


 
 echo'<tr style="font-size:8pt">
<td style="background-color:#3637ea; width:10px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:90px; padding:2px">'.$row['Client'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Industry'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Loyalty'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Site'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Note'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Adress'].'</td>
<td style="background-color:#3637ea; width:100px; padding:2px">'.$row['Categories'].'</td></tr>';

echo'
 <tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px; background-color:yellow" colspan="12">
</td>
</tr>
<tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px" colspan="12">
<span style="font-size:12pt">Информация о контактах</span>
</td>
</tr>';

$query2="SELECT * FROM tblcontacts WHERE ClientTD='".$id."' ";

$res2=mysql_query($query2);
					if($res2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
echo'
<tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px"></td>
<td style="background-color:#3637ea; width:20px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Контакт</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Должность</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Город</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Сотовый телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">Рабочий телефон</td>
<td style="background-color:#3637ea; width:130px; padding:2px">e-mail</td>
<td style="background-color:#3637ea; width:66px; padding:2px">Кто добавил запись</td>
<td style="background-color:#3637ea; width:60px; padding:2px">Дата добавления</td>
</tr>';

 while($row=mysql_fetch_array($res)){
 echo'<tr style="font-size:8pt">
 <td style="background-color:#3637ea; width:20px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Contact'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Title'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['City'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Phone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['WorkPhone'].'</td>
<td style="background-color:#3637ea; width:130px; padding:2px">'.$row['Email'].'</td>
<td style="background-color:#3637ea; width:66px; padding:2px">'.$row['UserName'].'</td>
<td style="background-color:#3637ea; width:60px; padding:2px">'.$row['AddTime'].'</td>
</tr>';
 
 }//конец цикла

echo'
 <tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px; background-color:yellow" colspan="12">
</td>
</tr>
<tr style="font-size:10pt">
<td style="background-color:#3637ea; width:200px; padding:2px" colspan="12">
<span style="font-size:12pt">Информация о событиях</span>
</td>
</tr>';

$query3="SELECT * FROM tblactions WHERE ClientID='".$id."' ";

$res3=mysql_query($query3);
					if($res3==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
echo'
<tr style="font-size:10pt">
<td style="background-color:#3637ea; width:15px; padding:2px">ID</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Тип</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Тема</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Начало</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Приоритет</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Статус</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Заметки</td>
<td style="background-color:#3637ea; width:118px; padding:2px">Добавлено</td>
</tr>';


 while($row=mysql_fetch_array($res)){
 echo'<tr style="font-size:8pt">
<td style="background-color:#3637ea; width:15px; padding:2px">'.$row['ID'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['ActionType'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['ActionTitle'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['StartTime'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['Priority'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['ActionStatus'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['Note'].'</td>
<td style="background-color:#3637ea; width:118px; padding:2px">'.$row['Date'].'</td>
</tr>';
 
 }//конец цикла


?>


</table>

<div align="center" style="width:1000px; height:20px; padding:5px; border:1px white solid; font-size:10pt; margin-top:40px">
<span>Кому передать клиента:</span>
</div>

<div align="center" style="width:1000px; padding:5px; border:1px white solid; border-top:0px; font-size:10pt; margin-top:0px">

<?php

$query4="SELECT * FROM users WHERE name<>'".$_SESSION['user']."' ";
$res4=mysql_query($query4);
					if($res4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }



echo'
<div style="width:1000px; height:100px">

<form id="responsesForm" action="action/move_client.php?id='.$id.'" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<select name="user" id="user" style="width:178px;margin-left:3px;background-color:#FFFF99" >';
$tmp=0;

while($row4=mysql_fetch_array($res4)){
echo'
<option value="'.$row4['name'].'"'; 

 echo'>'.$row4['name'].'</option>';
 
}

echo'
</select>

';

?>

<input type="submit" value="Готово" style="height:40px; width:100px; cursor:pointer"/>
</form>
</div>

</div>

</div>





<a href="my_clients.php"><input type="button" value="Назад" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>

</div>


</div>
</body>

</html>
