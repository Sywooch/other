<?php 

include('../db.php'); 
include('program_dance.php');

$id=$_POST['id'];//идентификатор тура
$value=$_POST['value'];//значение тура
$list_1=$_POST['list_1'];//список танцев
$in_next_tour=$_POST['in_next_tour'];//в следующий тур
$zahod=$_POST['zahod'];//заходов
$area=$_POST['area'];//площадка
$z_rotation=$_POST['z_rotation'];//ротация заходов


//получить последний номер тура


//$list_1=substr($list_1,0,-1);



//проверить, изменился ли набор танцев
$rs2=$mysqli->query("SELECT * FROM active_reglament_tours WHERE id='".$id."'");
while ($row2 = mysqli_fetch_assoc($rs2)){
	$list_old=$row2['dances'];	
}


if($list_old==$list_1){
	
	
}else{



$list_1_m=explode(";",$list_1);


	$rs=$mysqli->query("DELETE FROM active_reglament_dances_order WHERE id_tour='".$id."'");
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}



for($i=1;$i<=count($list_1_m);$i++){
	
	

	$rs=$mysqli->query("INSERT INTO active_reglament_dances_order (id_tour,number,dance,program) VALUES ('".$id."','".$i."','".$list_1_m[$i-1]."','".program_dance($list_1_m[$i-1])."')");
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
		
}




}








$rs=$mysqli->query("UPDATE active_reglament_tours SET value='".$value."',dances='".$list_1."',in_next_tour='".$in_next_tour."',zahod='".$zahod."',area='".$area."',z_rotation='".$z_rotation."' WHERE id='".$id."' "); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	



echo "Параметры тура успешно сохранены.";	


?>