<?php 

include('../db.php'); 


$name_group=$_POST['name_group'];//наименование группы
$turnir=$_POST['turnir'];//идентификатор турнира
$par=$_POST['par'];//количество пар
$sud=$_POST['sud'];//количество судей





$rs=$mysqli->query("INSERT INTO active_reglament_groups (name,id_turnir,pair,judges) VALUES ('".$name_group."','".$turnir."','".$par."','".$sud."')"); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	




echo "Группа успешно добавлена.";	


?>