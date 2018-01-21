<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }

 $id=$_GET['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

<script type="text/javascript" src="js/jquery.min.js"></script>




</head>

<body style="background-color:blue">

<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:700px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:670px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Клиенты - Добавление контакта</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt">
<?php echo'<form id="responsesForm" action="input_action_contact.php?id='.$id.'" enctype="multipart/form-data" method="post" accept-charset="utf-8">';?>

<table style="padding:5px">

<tr style="border:1px white solid; background-color:#3366FF">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Контактное лицо*</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Contact" id="Contact"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px" 
title="ФИО контактного лица" placeholder="ФИО контактного лица"></textarea></td>
</tr>

<tr style="border:1px white solid; background-color:#3366FF">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Должность</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Title" id="Title"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px" 
title="Должность контактного лица" placeholder="Должность контактного лица"></textarea></td>
</tr>

<tr style="border:1px white solid; background-color:#3366FF">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Город</span></td>
<td style="width:300px; height:40px; padding:5px"><input type="text" name="City" id="City" style="width:160px"/></td>
</tr>

<tr style="border:1px white solid; background-color:#3366FF">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Сотовый телефон</span></td>
<td style="width:300px; height:40px; padding:5px"><input type="text" name="Phone2" id="Phone2" style="width:160px"/></td>
</tr>

<tr style="border:1px white solid; background-color:#3366FF">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Рабочий телефон</span></td>
<td style="width:300px; height:40px; padding:5px"><input type="text" name="WorkPhone" id="WorkPhone" style="width:160px"/></td>
</tr>

<tr style="border:1px white solid; background-color:#3366FF">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">E-mail</span></td>
<td style="width:300px; height:40px; padding:5px"><input type="text" name="Email2" id="Email2" style="width:160px"/></td>
</tr>

<tr style="border:1px white solid; background-color:blue" align="center">
<td style="width:600px; height:40px; padding:5px; text-align:right" align="center" colspan="2">
<div style="width:600px" align="center">
<input type="submit" value="Готово" style="height:50px; width:100px"/>
</div></td>
</tr>

</table>
</form>
</div>




</div>
</div>
</body>


</html>
