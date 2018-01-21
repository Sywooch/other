<?php 

include('../db.php'); 


$id=$_POST['id'];
$text=$_POST['text'];






$rs_insert = $mysqli->query("UPDATE `active_turnir` SET groups='".$text."' WHERE id='".$id."'");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}



echo "Сохранено.";



?>