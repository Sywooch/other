<?php 

include('../db.php'); 
include('program_dance.php'); 

$radio=$_POST['radio'];//количество пар в заходе


$count=0;
$rs=$mysqli->query("SELECT * FROM active_reglament_parameters");
while ($row = mysqli_fetch_assoc($rs)){
$count=1;

}





if($count==0){

	$rs=$mysqli->query("INSERT INTO active_reglament_parameters (pairs_in_zahod) VALUES ('".$radio."')");
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}

	
	
}else{


	$rs=$mysqli->query("UPDATE active_reglament_parameters SET pairs_in_zahod='".$radio."' ");
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}

	
}


//обновить параметр "заходы"  $radio

$rs=$mysqli->query("SELECT * FROM active_reglament_groups");
while ($row = mysqli_fetch_assoc($rs)){
	
	$id_group=$row["id"];//идентификатор группы
	$pair=$row["pair"];//количество пар
	
	$zahod=ceil($pair/$radio);//количество заходов
	
	$rs2=$mysqli->query("UPDATE active_reglament_tours SET zahod='".$zahod."' WHERE id_group='".$id_group."' ");
	if ($rs2===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
	
	
	
	
	
}











?>