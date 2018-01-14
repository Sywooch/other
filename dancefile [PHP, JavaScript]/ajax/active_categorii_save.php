<?php 

include('../db.php'); 


$id=$_POST['id'];
$name=$_POST['name'];
$class_min=$_POST['class_min'];
$class_max=$_POST['class_max'];
$years_min=$_POST['years_min'];
$years_max=$_POST['years_max'];




$rs=$mysqli->query("UPDATE active_categorii SET name='".$name."', class_min='".$class_min."', class_max='".$class_max."', years_min='".$years_min."', years_max='".$years_max."' WHERE id='".$id."' "); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	




echo "Сохранено.";	


?>