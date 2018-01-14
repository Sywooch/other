<?php 

include('../db.php'); 


$id=$_POST['id'];



//echo"==".$id."==";



$rs = $mysqli->query("DELETE FROM `active_reg_access_closed` WHERE id_group='".$id."'");

if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}





echo "Регистрация в группе успешно разрешена";



?>