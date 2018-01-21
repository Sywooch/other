<?php 

include('../db.php'); 


$id=$_POST['id'];
$select1=$_POST['select1'];




$rs=$mysqli->query("UPDATE active_categorii_dancer_para SET id_active_cat='".$select1."' WHERE id='".$id."' "); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	




echo "Сохранено.";	


?>