<?php 

include('../db.php'); 


$id_tour=$_POST['id_tour'];//идентификатор тура
$rotation=$_POST['rotation'];

if($rotation=="no_rotation"){
	$rotation=1;
}else if($rotation=="rotation"){
	$rotation=2;	
}else{
	$rotation=3;	
}








$rs_end=$mysqli->query("UPDATE active_reglament_tours SET z_rotation='".$rotation."' WHERE id='".$id_tour."' ");
if ($rs_end===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}








//echo "Сохранено";


?>