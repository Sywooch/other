<?php 
session_start();
header('Content-type: text/html; charset=utf-8');
 if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
$x="login";
header('Location: '.$x.".php");//перенаправление на форму авторизации.
 }
$_SESSION['id']=$_GET['id'];//идентификатор клиента, с которым нужно встретиться.
require 'config/config.php';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

</head>

<body style="background-color:blue; color:white">
<?php
echo"<span style=\"position:absolute; background-color:black\">Вы вошли как: <strong>".$_SESSION['user']."</strong></span>";


?>
<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:700px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:670px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Ввод события</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt">
<form id="uploadForm" action="input_action2.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<table style="padding:5px">
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right"><span style="font-size:12pt">Тип события</span></td>
<td style="width:300px; height:60px; padding:5px"><textarea name="Type" id="Type"      
style="background-color:white; height:50px; width:280px; max-height:50px; max-width:280px; " 
title="Тип события" placeholder="Встреча, звонок и т.д."></textarea></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Тема</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Theme" id="Theme"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px"
title="Тема"  placeholder="Что обсудить и пр."></textarea></td>
</tr>


<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Начало</span></td>
<td style="width:300px; height:40px; padding:5px"><input type="date" name="Begin" id="Begin"/></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Приоритет</span></td>
<td style="width:300px; height:40px; padding:5px">
<select name="Priority" id="Priority" size=1>
<option value=1>Высокий</option>
<option value=2 selected>Средний</option>
<option value=3>Низкий</option>
</select></td>
</tr>

<tr style="border:1px white solid">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Примечание</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Note" id="Note"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px"></textarea></td>
</tr>

<tr style="border:1px white solid">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Менеджер</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Manager" id="Manager"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px" 
title="Кто ответственен за встречу" placeholder="Кто ответственен за встречу"></textarea></td>
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
