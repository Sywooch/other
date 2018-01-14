<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';

if($_SESSION['user']!='admin'){
echo'Доступ к странице запрещён. Вы не имеете достаточных привилегий.';
exit;
}



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
<span>Добавление нового пользователя</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt">
<form id="uploadForm" action="action/new_user.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<table style="padding:5px">
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3637ea"><span style="font-size:12pt">Имя пользователя</span></td>
<td style="width:300px; height:60px; padding:5px; background-color:#3637ea"><input type="text" name="new_user" id="new_user" style="width:160px"/></td>
</tr>
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right; background-color:#3637ea"><span style="font-size:12pt">Пароль</span></td>
<td style="width:300px; height:60px; padding:5px; background-color:#3637ea"><input type="text" name="new_pass" id="new_pass" style="width:160px"/></td>
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
