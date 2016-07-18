<?php 

include('../db.php'); 
include('program_dance.php'); 

$id_tour=$_POST['id_tour'];//идетнификатор тура
$top_program=$_POST['top_program'];//программа, которая должна будет оказаться наверху.


//echo " top_program ".$top_program." ";


//получить список St

//узнать, какая программа сидит наверху
$rs=$mysqli->query("SELECT * FROM active_reglament_dances_order WHERE id_tour='".$id_tour."' ORDER BY number LIMIT 1");
while ($row = mysqli_fetch_assoc($rs)){
	$old_top_program=$row['program'];
	
}





if($old_top_program==$top_program){
	
}else{

//echo"====";


//получить массив st
unset($st);
$rs=$mysqli->query("SELECT * FROM active_reglament_dances_order WHERE id_tour='".$id_tour."' AND program='St' ORDER BY number");
while ($row = mysqli_fetch_assoc($rs)){
	$st[]=$row['dance'];
}

//получить массив la
unset($la);
$rs=$mysqli->query("SELECT * FROM active_reglament_dances_order WHERE id_tour='".$id_tour."' AND program='La' ORDER BY number");
while ($row = mysqli_fetch_assoc($rs)){
	$la[]=$row['dance'];
}




$rs=$mysqli->query("DELETE FROM active_reglament_dances_order WHERE id_tour='".$id_tour."'");
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	


if($top_program=="St"){




	for($i=0;$i<count($st);$i++){
		$rs=$mysqli->query("INSERT INTO active_reglament_dances_order (id_tour,number,dance,program) VALUES ('".$id_tour."','".($i+1)."','".$st[$i]."','St')");
		if ($rs===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}		
		$i2=$i;		
	}
	
	$i2=$i2+2;
	
	for($i=0;$i<count($la);$i++){
		$rs=$mysqli->query("INSERT INTO active_reglament_dances_order (id_tour,number,dance,program) VALUES ('".$id_tour."','".($i2)."','".$la[$i]."','La')");
		if ($rs===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}	
		$i2++;
			
	}

	
	
	
	
	
}else{
	
	

	for($i=0;$i<count($la);$i++){
		$rs=$mysqli->query("INSERT INTO active_reglament_dances_order (id_tour,number,dance,program) VALUES ('".$id_tour."','".($i+1)."','".$la[$i]."','La')");
		if ($rs===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}		
		$i2=$i;		
	}
	
	$i2=$i2+2;
	
	for($i=0;$i<count($st);$i++){
		$rs=$mysqli->query("INSERT INTO active_reglament_dances_order (id_tour,number,dance,program) VALUES ('".$id_tour."','".($i2)."','".$st[$i]."','St')");
		if ($rs===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}	
		$i2++;
			
	}
	

	
		
	
	
}





	
	
}






$rs=$mysqli->query("SELECT * FROM active_reglament_dances_order WHERE id_tour='".$id_tour."' ORDER BY number");
while ($row = mysqli_fetch_assoc($rs)){
	$html=$html.'<div class="body_number">'.$row['number'].'</div><div class="body_dance">'.$row['dance'].' ('.$row['program'].')</div>';
}



echo $html;	


?>