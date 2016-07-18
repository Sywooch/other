<?php 

include('../db.php'); 


$id_otd=$_POST['id_otd'];//идентификатор отделения
//$id_group=$_POST['id_group'];//идентификатор группы
//$id_turnir=$_POST['id_turnir'];//идентификатор турнира
$pred_tur=$_POST['pred_tur'];//длительность предварительного тура
$fun_tur=$_POST['fun_tur'];//длительность финального тура

$log=0;
//$rs=$mysqli->query("SELECT * FROM active_reglament_form_current_otd WHERE id_otd='".$id_otd."' AND id_group='".$id_group."' AND id_turnir='".$id_turnir."' ");
$rs=$mysqli->query("SELECT * FROM active_reglament_form_current_otd WHERE id_otd='".$id_otd."' ");

while ($row = $rs->fetch_assoc()){

$log=1;

}


if($log==0){
//вставка	
//	$rs=$mysqli->query("INSERT INTO active_reglament_form_current_otd (id_otd,id_group,id_turnir,pred_tur,fun_tur) VALUES ('".$id_otd."','".$id_group."','".$id_turnir."','".$pred_tur."','".$fun_tur."')");
		$rs=$mysqli->query("INSERT INTO active_reglament_form_current_otd (id_otd,pred_tur,fun_tur) VALUES ('".$id_otd."','".$pred_tur."','".$fun_tur."')");

	
	
	
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
	
}else{
//обновление
	
	//$rs=$mysqli->query("UPDATE active_reglament_form_current_otd SET pred_tur='".$pred_tur."', fun_tur='".$fun_tur."' WHERE id_otd='".$id_otd."' AND id_group='".$id_group."' AND id_turnir='".$id_turnir."' ");
	$rs=$mysqli->query("UPDATE active_reglament_form_current_otd SET pred_tur='".$pred_tur."', fun_tur='".$fun_tur."' WHERE id_otd='".$id_otd."' ");
	
	
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
	
}




//корректировка значений времени в таблице
//получить новое значение времени


$rs=$mysqli->query('SELECT * FROM `active_reglament_form_current_otd` WHERE id_otd="'.$id_otd.'"');
while ($row = $rs->fetch_assoc()){
	$pred_tur=$row['pred_tur'];
	$fun_tur=$row['fun_tur'];
	//$start_otd=$row['start_otd'];
}

$fun_tur_m=explode(":",$fun_tur);
$fun_h=$fun_tur_m[0];
$fun_m=$fun_tur_m[1];



$result = date('H:i',strtotime($pred_tur.' + '.$fun_h.' hours')); 
$result = date('H:i',strtotime($result.' + '.$fun_m.' min')); 


$dance_duration = $result;//подолжительность часы/минуты
$dance_duration_m=explode(":",$dance_duration);


//echo $dance_duration." ";



//////////////////////////////////////////////////////
$next_time=0;
$count3=0;
$rs2=$mysqli->query('SELECT * FROM `active_reglament_form_current_table` WHERE id_otd="'.$id_otd.'" ORDER BY number');
while ($row2 = $rs2->fetch_assoc()){

	
	
	if($count3==0){
		$time_old=$row2['start'];//
		
		$times[]=$time_old;
		
		//$n_time_old=strtotime($time_old);
		
		//$n_dance_duration=strtotime($dance_duration);
		$id=$row2['id'];
		//$next_time=$n_time_old+$n_dance_duration;
		
		
		$result = date('H:i',strtotime($time_old.' + '.$dance_duration_m[0].' hours')); 
		$next_time = date('H:i',strtotime($result.' + '.$dance_duration_m[1].' min')); 
		
		//$next_time= date('H:i',$next_time);
		//echo "=".$next_time."=";
		
	}else{
		$id=$row2['id'];
		$rs_end=$mysqli->query("UPDATE active_reglament_form_current_table SET start='".$next_time."' WHERE id='".$id."'");
		if ($rs_end===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);	
		}	
		$next_time_old=$next_time;
		$last_time=$next_time_old;
		$times[]=$last_time;
		//$n_next_time_old=strtotime($next_time_old);
		//$n_dance_duration=strtotime($dance_duration);
		
		
		if($row2['group1']=="Награждение победителей"){
			//echo"-------";
			$result = date('H:i',strtotime($next_time_old.' + 00 hours')); 
			$next_time = date('H:i',strtotime($result.' + 15 min')); 
		}else{
		
			$result = date('H:i',strtotime($next_time_old.' + '.$dance_duration_m[0].' hours')); 
			$next_time = date('H:i',strtotime($result.' + '.$dance_duration_m[1].' min')); 
		}
		
		//$next_time=$n_next_time_old+$n_dance_duration;
		//$next_time= date('H:i',$next_time);
		
		//echo "-".$next_time."-";
		
	}

	$count3++;
}







//корректировка времени окончания
$rs_end=$mysqli->query("UPDATE active_reglament_form_current_otd SET end_otd='".$last_time."' WHERE id_otd='".$id_otd."'");
		if ($rs_end===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);	
		}



//корректировка продолжительности
$rs_end=$mysqli->query("UPDATE active_reglament_form_current_table SET time='".$dance_duration."' WHERE id_otd='".$id_otd."' AND group1<>'Награждение победителей' AND group1<>'Окончание'");
		if ($rs_end===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);	
		}
////////////////////////////////////////////////////////////////////////

$times[]=$dance_duration;

echo json_encode($times); 




//echo "Сохранено.";	


?>