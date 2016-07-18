<?php 

include('../db.php'); 
include('program_dance.php'); 

$id=$_POST['id'];//идетнификатор тура
$dance=$_POST['dance'];//добавляемый танец

//получить последний номер в списке танцев
$rs=$mysqli->query("SELECT * FROM active_reglament_dances_order WHERE id_tour='".$id."' ORDER BY number DESC LIMIT 1");
while ($row = mysqli_fetch_assoc($rs)){
	$last_number=$row['number'];
	
}

$last_number=$last_number+1;


$rs=$mysqli->query("INSERT INTO active_reglament_dances_order (id_tour,number,dance,program) VALUES ('".$id."','".$last_number."','".$dance."','".program_dance($last_number)."')"); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	

$html="";

$rs=$mysqli->query("SELECT * FROM active_reglament_dances_order WHERE id_tour='".$id."' ORDER BY number");
while ($row = mysqli_fetch_assoc($rs)){
	$html=$html.'<div class="body_number">'.$row['number'].'</div><div class="body_dance">'.$row['dance'].'</div>';
}



echo $html;	


?>