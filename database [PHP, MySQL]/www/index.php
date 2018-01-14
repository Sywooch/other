<?php
session_start();
require 'config/config.php';
header('Content-type: text/html; charset=utf-8');
 
//if((!isset($_SESSION['user']))||($_SESSION['user']==NULL)||($_SESSION['user']=="")){
//$x="login";
//header('Location: '.$x.".php");//перенаправление на форму авторизации.
//}
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
echo"<span style=\"position:absolute; background-color:black; margin-top:20px\">
<a href=\"exit.php\" style=\"color:white\">Выйти из учётной записи</a></span>";

?>

<div align="center" style="width:100%; color:white; font-family:Arial, Helvetica, sans-serif">
<div align="center" style="width:700px; min-height:100px; padding:10px; border:2px white solid">



<div align="center" style="width:670px; height:40px; padding:5px; border:1px white solid; font-size:15pt">
<span>Главная</span>
</div>
<div align="center" style="width:680px;  border:1px white solid; border-top:0px; font-size:15pt; padding-top:20px; padding-bottom:20px">
 
<a href="clients.php"><input type="button" value="Все клиенты" style="height:40px; width:120px; cursor:pointer; margin-bottom:10px" /></a>
<a href="my_clients.php"><input type="button" value="Мои клиенты" style="height:40px; width:120px; cursor:pointer; margin-bottom:10px" /></a>
<a href="my_actions.php"><input type="button" value="Мои cобытия" style="height:40px; width:120px; cursor:pointer; margin-bottom:10px"/></a>
<a href="my_contacts.php"><input type="button" value="Мои контакты" style="height:40px; width:120px; cursor:pointer; margin-bottom:10px"/></a>
<a href="organisations.php"><input type="button" value="Все организации" style="height:40px; width:230px; cursor:pointer; margin-bottom:10px"/></a>

<?php
if($_SESSION['user']=='admin'){
echo'

<a href="contacts.php"><input type="button" value="Все контакты" style="height:40px; width:120px; cursor:pointer"/></a>
<a href="actions.php"><input type="button" value="Все cобытия" style="height:40px; width:120px; cursor:pointer"/></a>
<a href="management_of_clients.php"><input type="button" value="Управление клиентами" style="height:40px; width:170px; cursor:pointer"/></a>
';
}
?>


</div>

<a href="input.php"><input type="button" value="Добавить нового клиента" 
style="height:40px; width:200px; cursor:pointer; margin-top:10px"/></a>

<?php
if($_SESSION['user']=='admin'){
echo'
<a href="users.php"><input type="button" value="Управление учётными записями пользователей" 
style="height:40px; width:340px; cursor:pointer; margin-top:10px"/></a>';

}
?>
</div>
</div>
</body>

</html>
