<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['bool_admin'])||($_SESSION['bool_admin']==NULL)){
header("Refresh: 1; URL=authorisation.php?x=0");
echo'Перенаправление...';
exit;
}




//поля пустые?
if($_POST['password_old']==NULL or $_POST['password_new']==NULL or $_POST['password_new2']==NULL){

header("Refresh: 1; URL=admin_new_password.php");
echo'Ошибка! Необходимо заполнить все поля. Перенаправление...';

exit;
}



//проверка правильности старого пароля.

$dbh2=mysql_connect('localhost','root','fiexitheitheivae')or die("Невозможно соединиться с сервером.");
mysql_select_db('db_specstroy')or die("Невозможно подключиться к базе.");
$query2 = "SELECT * FROM admin";
 $res2=mysql_query($query2);
 if($res2==false){
 echo"Ошибка выполнения запроса.";
 echo mysql_error();
 exit; }

 $row2=mysql_fetch_array($res2);
 $password=$_POST['password_old'];
 $hash_password=md5($password);
 
 if($row2['password']!=$hash_password){

header("Refresh: 1; URL=admin_new_password.php");
echo'Ошибка! Старый пароль введён неверно. Перенаправление...';

exit;
 }
 
 
 
//проверка совпадения содержимого 2й и 3й строк (новый пароль и старый пароль).
if($_POST['password_new']!=$_POST['password_new2']){

header("Refresh: 1; URL=admin_new_password.php");
echo'Ошибка! Неверно введено подтверждение пароля. Перенаправление...';

exit;
}


$query2 = "UPDATE admin SET password='".md5($_POST['password_new'])."' WHERE password='".md5($_POST['password_old'])."'";//запрос на обновление
 $res2=mysql_query($query2);
 if($res2==false){
 echo"Ошибка выполнения запроса.";
 echo mysql_error();
 exit; }




$_POST['password_old']=NULL;
$_POST['password_new']=NULL;
$_POST['password_new2']=NULL;

header("Refresh: 1; URL=admin.php");
echo"Пароль успешно изменён. Перенаправление...";

exit;

?>
