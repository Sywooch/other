<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['bool_admin'])||($_SESSION['bool_admin']==NULL)){
header("Refresh: 1; URL=authorisation.php?x=0");
echo'Перенаправление...';
exit;
}

$dbh2=mysql_connect('localhost','root','fiexitheitheivae')or die("Невозможно соединиться с сервером.");
mysql_select_db('db_specstroy')or die("Невозможно подключиться к базе.");
$name=$_GET['name'];
$comment=$_GET['comment'];
$date_time=$_GET['date_time'];


$query2 = "DELETE FROM response_table WHERE name='$name' AND text='$comment' AND date_time='$date_time'";//запрос на удаление.
 $res2=mysql_query($query2);
 if($res2==false){
 echo"Ошибка выполнения запроса.";
 echo mysql_error();
 exit; }

header("Refresh: 1; URL=admin.php");

?>