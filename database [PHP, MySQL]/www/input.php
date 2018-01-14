<?php
//форма ввода в таблицы Клиенты и Контакты
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');

if((!isset($_SESSION['user']))||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
echo'Ошибка! Вы не имеете достаточных привилегий.'; exit;
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>

</head>

<body style="background-color:blue">

<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:700px; min-height:100px; padding:10px; border:2px white solid">

<div align="center" style="width:670px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Ввод информации о клиенте</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt">
<form id="uploadForm" action="input_action.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<table style="padding:5px">
<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:60px; padding:5px; text-align:right"><span style="font-size:12pt">Клиент*</span></td>
<td style="width:300px; height:60px; padding:5px"><textarea name="Client" id="Client"      
style="background-color:white; height:50px; width:280px; max-height:50px; max-width:280px; " 
title="Наименование организации или имя частного лица" placeholder="Наименование организации или имя частного лица"></textarea></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Отрасль</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Industry" id="Industry"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px"
title="Чем занимается организация"  placeholder="Чем занимается организация"></textarea></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Лояльность</span></td>
<td style="width:300px; height:40px; padding:5px">
<select name="Loyalty" id="Loyalty" size=1>
<option value=1>Наш клиент</option>
<option value=2>Горячий</option>
<option value=3 selected>Тёплый</option>
<option value=4>Холодный</option>
<option value=5>Отказ</option>
</select></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Телефоны организации</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Phone" id="Phone"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px" 
title="можно перечислить несколько номеров через запятую" placeholder="можно перечислить несколько номеров через запятую"></textarea></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Сайт организации</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Site" id="Site"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px"></textarea></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Заметки</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Note" id="Note"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px"></textarea></td>
</tr>


<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">E-mail организации</span></td>
<td style="width:300px; height:40px; padding:5px"><input type="text" name="Email" id="Email" style="width:160px"/></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Адрес</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Adress" id="Adress"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px"></textarea></td>
</tr>

<tr style="border:1px white solid; border-bottom:0px">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Категории</span></td>
<td style="width:300px; height:40px; padding:5px"><textarea name="Categories" id="Categories"  
style="background-color:white; height:30px; width:280px; max-height:50px; max-width:280px"></textarea></td>
</tr>

<tr style="border:1px white solid; background-color:#3366FF">
<td style="width:300px; height:40px; padding:5px; text-align:right"><span style="font-size:12pt">Контактное лицо</span></td>
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
