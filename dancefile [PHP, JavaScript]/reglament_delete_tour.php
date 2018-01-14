<?php 

include('../db.php'); 
include('program_dance.php'); 

$id=$_POST['id'];//идентификатор удаляемого тура





//получить идентификатор группы
$rs=$mysqli->query("SELECT * FROM active_reglament_tours WHERE id='".$id."'");
while ($row = $rs->fetch_assoc()){
	$id_group=$row['id_group'];
}

$rs=$mysqli->query("DELETE FROM active_reglament_tours WHERE id='".$id."'"); 
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	


//произвести пересчёт номеров туров для группы id_group
$rs=$mysqli->query("SELECT * FROM active_reglament_tours WHERE id_group='".$id_group."' ORDER BY number");
while ($row = $rs->fetch_assoc()){

$numbers[]=$row['id'];

}


for($i=0;$i<count($numbers);$i++){
	
	$rs=$mysqli->query("UPDATE active_reglament_tours SET number='".($i+1)."' WHERE id='".$numbers[$i]."'");
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}	
	
}







	$rs=$mysqli->query("DELETE FROM active_reglament_dances_order WHERE id_tour='".$id."'");
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}




echo "Тур успешно удалён.";	


?>