<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор группы
//$name_group=$_POST['name_group'];//наименование группы
$turnir=$_POST['turnir'];//идентификатор турнира
$par=$_POST['par'];//количество пар
$sud=$_POST['sud'];//количество судей
$id_otd=$_POST['id_otd'];//идентификатор отделения

$cnt=0;
$rs=$mysqli->query("SELECT * FROM active_reglament_groups WHERE id_group='".$id."' AND id_turnir='".$turnir."' AND id_otd='".$id_otd."' ");
while ($row = $rs->fetch_assoc()){
	$cnt=1;
}

if($cnt==1){

	$rs=$mysqli->query("UPDATE active_reglament_groups SET pair='".$par."',judges='".$sud."' WHERE id_group='".$id."' AND id_turnir='".$turnir."' AND id_otd='".$id_otd."'  "); 
		
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}	

}else{
	$rs=$mysqli->query("INSERT INTO active_reglament_groups (id_turnir,pair,judges,id_group,id_otd) VALUES ('".$turnir."','".$par."','".$sud."','".$id."','".$id_otd."') "); 
		
	if ($rs===false) {
		printf("Ошибка #3: %s\n", $mysqli->error);
	}	
	
	
}


echo "Парамерты группы успешно сохранены.";	


?>