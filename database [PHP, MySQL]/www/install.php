<?php 
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';
echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Учёт клиентов</title>';
echo'</head>';
echo'<body style="background-color:#3637ea; color:white">';


$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
echo'Соединение с сервером успешно.</br>';
//$query = "CREATE database db_clients";
//					$res=mysql_query($query);
//					if($res==false){
//					echo"Ошибка выполнения запроса. Невозможно создать базу.</br>";
//					echo mysql_error();
//					exit; }
//echo'База данных db_clients успешно создана.</br>';

//создание таблиц в базе

//echo '<hr size="1">';
//mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
//echo'Подключение к базе db_clients успешно.</br>';
//$query="CREATE TABLE qdfMain(ID text, Client text, Industry text, Loyalty text, Phone text, Email text, Contacts text, ID_Contacts text)";
//$res=mysql_query($query);
//					if($res==false){
//					echo"Ошибка выполнения запроса. Невозможно создать таблицу qdfMain.";
//					echo mysql_error();
//					exit; }
//echo'Таблица qdfMain успешно создана.';

//echo '<hr size="1">';

//mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
//$query="CREATE TABLE tblContacts(ID text, Title text, City text, Phone text, WorkPhone text, Email text, UserName text, AddTime datetime, ClientTD text)";
//$res=mysql_query($query);
//					if($res==false){
//					echo"Ошибка выполнения запроса. Невозможно создать таблицу tblContacts.";
//					echo mysql_error();
//					exit; }
//echo'Таблица tblContacts успешно создана.';

//echo '<hr size="1">';

mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");

$query="INSERT INTO users VALUES('admin', '".md5('123')."')";
 $res=mysql_query($query);
if($res==false){
echo"Ошибка выполнения запроса. Невозможно выполнить запись.</br>";
echo mysql_error();
exit; }
echo'Запись в таблицу users успешно выполнена.';

//$query="CREATE TABLE 
//tblActions(ID text, ActionType text, ActionTitle text, StartTime datetime, Priority text, ActionStatus text, Note text, Manager text, Date datetime, ClientID text)";
//$res=mysql_query($query);
	//				if($res==false){
	//				echo"Ошибка выполнения запроса. Невозможно создать таблицу db_clients.";
	//				echo mysql_error();
	//				exit; }
//echo'Таблица db_clients успешно создана.';

echo '<hr size="1">';

//mysql_select_db('qdfMain') or die ("Невозможно подключиться к базе.");
//$query="ALTER TABLE qdfMain ADD PRIMARY KEY (ID)";
//$res=mysql_query($query);
//				if($res==false){
//					echo"Ошибка выполнения запроса. ";
//					echo mysql_error();
//					exit; }

//mysql_select_db('tblContacts') or die ("Невозможно подключиться к базе.");
//$query="ALTER TABLE tblContacts ADD PRIMARY KEY (ID)";
//$res=mysql_query($query);
//				if($res==false){
//					echo"Ошибка выполнения запроса. ";
//					echo mysql_error();
//					exit; }


//mysql_select_db('tblAction') or die ("Невозможно подключиться к базе.");
//$query="ALTER TABLE tdlAction ADD PRIMARY KEY (ID)";
//$res=mysql_query($query);
///				if($res==false){
//					echo"Ошибка выполнения запроса. ";
//					echo mysql_error();
//					exit; }




mysql_close();

echo'</body>
</html>';

?>
 