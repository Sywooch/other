<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
mysql_query("set character_set_results='utf8'");
$dbh=mysql_connect('localhost','root','') or die ("���������� ����������� � ��������.");
//$query = "CREATE database responses";
//					$res=mysql_query($query);
//					if($res==false){
//					echo"������ ���������� �������. ���������� ������� ����.";
//					echo mysql_error();
//					exit; }
//echo'���� ������ ������� �������.'
//echo '<hr size="1">';
//mysql_select_db('responses') or die ("���������� ������������ � ����.");
//$query="CREATE TABLE response_table(name TEXT, text TEXT, date_time TEXT)";
//$res=mysql_query($query);
//					if($res==false){
//					echo"������ ���������� �������. ���������� ������� �������.";
//					echo mysql_error();
//					exit; }
//echo'������� -response_table- ������� �������.'

//echo '<hr size="1">';

mysql_select_db('responses') or die ("���������� ������������ � ����.");
//$query="CREATE TABLE admin(password TEXT)";
//$res=mysql_query($query);
//				if($res==false){
//					echo"������ ���������� �������. ���������� ������� �������.";
//					echo mysql_error();
//					exit; }
//echo'������� -admin- ������� �������.'

					
$query="INSERT INTO admin(password) VALUES('".md5('123')."')"; 					
$res=mysql_query($query);
				if($res==false){
					echo"������ ���������� �������. ���������� ��������� ������ �� ������� ������.";
					echo mysql_error();
					exit; }					
					












?>