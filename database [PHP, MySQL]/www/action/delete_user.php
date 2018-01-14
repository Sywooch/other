<?php
session_start();
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
 
if($_SESSION['user']!='admin'){
echo'Доступ к странице запрещён. Вы не имеете достаточных привилегий.';
exit;
}
if(!isset($_GET['name'])||($_GET['name']==NULL)||($_GET['name']=="")){
echo'Ошибка. Не задан параметр.';
exit;

}


$name=$_GET['name'];

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
$query="DELETE FROM users WHERE name='".$name."'";


$res=mysql_query($query);
					if($res==false){
	    			echo"Ошибка выполнения запроса. Не удалось удалить пользователя";
					echo mysql_error();
					exit; }


echo'Пользователь '.$name.' успешно удалён. </br>
<a href="../users.php"><input type="button" value="Назад" style="height:40px; width:100px; cursor:pointer; margin-top:20px" /></a>';


?>