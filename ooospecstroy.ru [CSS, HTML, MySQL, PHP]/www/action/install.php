<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
mysql_query("set character_set_results='utf8'");
$dbh=mysql_connect('localhost','root','') or die ("Невозможно соединиться с сервером.");
//$query = "CREATE database responses";
//					$res=mysql_query($query);
//					if($res==false){
//					echo"Ошибка выполнения запроса. Невозможно создать базу.";
//					echo mysql_error();
//					exit; }
//echo'База данных успешно создана.'
//echo '<hr size="1">';
//mysql_select_db('responses') or die ("Невозможно подключиться к базе.");
//$query="CREATE TABLE response_table(name TEXT, text TEXT, date_time TEXT)";
//$res=mysql_query($query);
//					if($res==false){
//					echo"Ошибка выполнения запроса. Невозможно создать таблицу.";
//					echo mysql_error();
//					exit; }
//echo'Таблица -response_table- успешно создана.'

//echo '<hr size="1">';

mysql_select_db('responses') or die ("Невозможно подключиться к базе.");
//$query="CREATE TABLE admin(password TEXT)";
//$res=mysql_query($query);
//				if($res==false){
//					echo"Ошибка выполнения запроса. Невозможно создать таблицу.";
//					echo mysql_error();
//					exit; }
//echo'Таблица -admin- успешно создана.'

					
$query="INSERT INTO admin(password) VALUES('".md5('123')."')"; 					
$res=mysql_query($query);
				if($res==false){
					echo"Ошибка выполнения запроса. Невозможно выполнить запрос на вставку данных.";
					echo mysql_error();
					exit; }					
					












?>