<?php 

include('../db.php'); 


$id=$_POST['id'];



//echo"==".$id."==";



$rs = $mysqli->query("INSERT INTO `active_reg_access_closed` SET id_group='".$id."'");

if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}





echo "Регистрация в группе успешно запрещена";



?>