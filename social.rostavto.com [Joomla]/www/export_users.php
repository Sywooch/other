<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Set flag that this is a parent file.

header('Content-type: text/html; charset=utf-8');

$db1=mysql_connect("localhost","root","") or die ("Невозможно соединиться с сервером.");

mysql_select_db("c5597_rost", $db1) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'", $db1);
			mysql_query("SET NAMES utf8", $db1);
			
mysql_query ("SET COLLATION_CONNECTION=utf8", $db1);
mysql_query("SET CHARACTER_SET_CLIENT=utf8", $db1);
mysql_query("SET CHARACTER_SET_RESULTS=utf8", $db1);	

$query="SELECT * FROM c5597_rost.boc9w_users";

$res=mysql_query($query, $db1);
					if($res==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$db2=mysql_connect("localhost","root","") or die ("Невозможно соединиться с сервером.");

mysql_select_db("db_avtoportal", $db2) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'", $db2);
			mysql_query("SET NAMES utf8", $db2);
			
mysql_query ("SET COLLATION_CONNECTION=utf8", $db2);
mysql_query("SET CHARACTER_SET_CLIENT=utf8", $db2);
mysql_query("SET CHARACTER_SET_RESULTS=utf8", $db2);	




while($row=mysql_fetch_array($res)){

$name=$row['name'];
$username=$row['username'];
$email=$row['email'];
$password=$row['password'];
$usertype=$row['usertype'];
$block=$row['block'];
$sendEmail=$row['sendEmail'];
$registerDate=$row['registerDate'];
$lastvisitDate=$row['lastvisitDate'];
$activation=$row['activation'];
$params=$row['params'];
$lastResetTime=$row['lastResetTime'];
$resetCount=$row['resetCount'];

$query2="SELECT * FROM c5597_rost.boc9w_user_usergroup_map WHERE user_id='".$row['id']."' ";
$res2=mysql_query($query2, $db1);
					if($res2==false){
	    			echo"Ошибка выполнения запроса.ffgfgfg</br>";
					echo mysql_error();
					exit; }
$row2=mysql_fetch_array($res2);

$group_id=$row2['group_id'];


echo" ".$group_id."<br>";




$query3="SELECT * FROM c5597_rost.boc9w_kunena_users WHERE userid='".$row['id']."' ";

$res3=mysql_query($query3, $db1);
					if($res3==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }
$row3=mysql_fetch_array($res3);

$gender=$row3['gender'];
$birthdate=$row3['birthdate'];
$location=$row3['location'];

echo" ".$group_id.":".$birthdate.":".$location."<br>";




echo" ".$name." : ".$username." : ".$email." : ".$password." : ".$usertype." : ".$block." : ".$sendEmail." : ".$registerDate." : ".$lastvisitDate." : ".$activation." : ".$params." : ".$lastResetTime." : ".$resetCount."<br>";

echo"<br>=================================================================================<br>";



$query2_name="SELECT * FROM avto_users WHERE username='".$username."'";


$res2_name=mysql_query($query2_name, $db2);
					if($res2_name==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


$i_tmp=0;

while($row2_name=mysql_fetch_array($res2_name)){

$i_tmp++;
}

if ($i_tmp==0){


$query3_user="INSERT INTO avto_users (name, username, email, password, block, sendEmail, registerDate, lastvisitDate, activation, params, lastResetTime, resetCount) 
VALUES ('".$name."','".$username."','".$email."','".$password."','".$block."','".$sendEmail."','".$registerDate."','".$lastvisitDate."','".$activation."','".$params."','".$lastResetTime."','".$resetCount."')";
$res3_user=mysql_query($query3_user, $db2);
					if($res3_user==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


$query2_name_2="SELECT * FROM avto_users WHERE username='".$username."'";

$res2_name_2=mysql_query($query2_name_2, $db2);
					if($res2_name_2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

$row2_name_2=mysql_fetch_array($res2_name_2);

$avto_user_id=$row2_name_2['id'];


$query3_user_2="INSERT INTO avto_user_usergroup_map (user_id, group_id) 
VALUES ('".$avto_user_id."','".$group_id."')";
$res3_user_2=mysql_query($query3_user_2, $db2);
					if($res3_user_2==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


if($gender=='2'){$gender="Жен.";}
else{ $gender="Муж."; }


$query3_user_3="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_user_id."','2','".$gender."')";
$res3_user_3=mysql_query($query3_user_3, $db2);
					if($res3_user_3==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }



$query3_user_4="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_user_id."','3','".$birthdate."')";
$res3_user_4=mysql_query($query3_user_4, $db2);
					if($res3_user_4==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }


$query3_user_5="INSERT INTO avto_community_fields_values (user_id, field_id, value) 
VALUES ('".$avto_user_id."','10','".$location."')";
$res3_user_5=mysql_query($query3_user_5, $db2);
					if($res3_user_5==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }



}










}





?>