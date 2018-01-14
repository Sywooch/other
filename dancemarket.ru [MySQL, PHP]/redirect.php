<?php 
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 

$rs2 = $mysqli->query("SELECT * FROM `shops`");	
	if ($rs2===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}

while ($row2 = mysqli_fetch_assoc($rs2)){
	$url=$row2['url'];
	$rs3 = $mysqli->query("SELECT * FROM `counter_redirect` WHERE link='".$url."'");
	if ($rs3===false) {
		printf("Ошибка #1: %s\n", $mysqli->error);
	}
	if(mysqli_num_rows($rs3)){
		
	}else{
		
		$rs_insert = $mysqli->query("INSERT INTO `counter_redirect` (link,count) VALUES ('".$url."','0')");
		if ($rs_insert===false) {
			printf("Ошибка #3: %s\n", $mysqli->error);
		}
		
			
	}
	
	
	
}


$link=$_GET['link'];


$rs_link = $mysqli->query("UPDATE `counter_redirect` SET count = count + 1 WHERE link='".$link."'");
		if ($rs_link===false) {
			printf("Ошибка #3: %s\n", $mysqli->error);
		}


header("Location: ".$link."");










?>
