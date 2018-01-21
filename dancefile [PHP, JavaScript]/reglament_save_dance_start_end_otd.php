<?php 

include('../db.php'); 


$id_otd=$_POST['id_otd'];//идентификатор отделения
$start_otd=$_POST['start_otd'];//время начала отделения

$log=0;
//$rs=$mysqli->query("SELECT * FROM active_reglament_form_current_otd WHERE id_otd='".$id_otd."' AND id_group='".$id_group."' AND id_turnir='".$id_turnir."' ");
$rs=$mysqli->query("SELECT * FROM active_reglament_form_current_otd WHERE id_otd='".$id_otd."' ");

while ($row = $rs->fetch_assoc()){

$log=1;

}


if($log==0){
//вставка	
//	$rs=$mysqli->query("INSERT INTO active_reglament_form_current_otd (id_otd,id_group,id_turnir,pred_tur,fun_tur) VALUES ('".$id_otd."','".$id_group."','".$id_turnir."','".$pred_tur."','".$fun_tur."')");
		$rs=$mysqli->query("INSERT INTO active_reglament_form_current_otd (id_otd,start_otd) VALUES ('".$id_otd."','".$start_otd."')");

	
	
	
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
	
}else{
//обновление
	
	//$rs=$mysqli->query("UPDATE active_reglament_form_current_otd SET pred_tur='".$pred_tur."', fun_tur='".$fun_tur."' WHERE id_otd='".$id_otd."' AND id_group='".$id_group."' AND id_turnir='".$id_turnir."' ");
	$rs=$mysqli->query("UPDATE active_reglament_form_current_otd SET start_otd='".$start_otd."' WHERE id_otd='".$id_otd."' ");
	
	
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
	
}






//корректировка времени в таблице  и  времени окончания
//$id_otd
//$start_otd

$rs=$mysqli->query('SELECT * FROM `active_reglament_form_current_otd` WHERE id_otd="'.$id_otd.'"');
while ($row = $rs->fetch_assoc()){
	$pred_tur=$row['pred_tur'];
	$fun_tur=$row['fun_tur'];
	//$start_otd=$row['start_otd'];//время начала отделения
}

$fun_tur_m=explode(":",$fun_tur);
$fun_h=$fun_tur_m[0];
$fun_m=$fun_tur_m[1];



$result = date('H:i',strtotime($pred_tur.' + '.$fun_h.' hours')); 
$result = date('H:i',strtotime($result.' + '.$fun_m.' min')); 


$dance_duration = $result;//подолжительность часы/минуты


//////////////////////////////////////////////////////

$rs2=$mysqli->query('SELECT * FROM `active_reglament_form_current_table` WHERE id_otd="'.$id_otd.'" ORDER BY number LIMIT 1');
while ($row2 = $rs2->fetch_assoc()){

$time_old=$row2['start'];//время, которое нужно скорректировать



}

//echo $time_old." -- ";
//вычислить разницу между старым временем и новым
$n_time_old=strtotime($time_old); // echo "[ ".$n_time_old." ]";
$n_start_otd=strtotime($start_otd);//  echo "[ ".$n_start_otd." ]";

if($n_time_old > $n_start_otd){
//сдвиг на более ранне время	
$def=$n_time_old - $n_start_otd;
	
}else{
//сдвиг на более позднее время	
$def=$n_start_otd - $n_time_old;
	
}

//echo "= ".$def." =";

unset($times);

$rs2=$mysqli->query('SELECT * FROM `active_reglament_form_current_table` WHERE id_otd="'.$id_otd.'" ORDER BY number');
while ($row2 = $rs2->fetch_assoc()){

$time_old=$row2['start'];
$id=$row2['id'];

	if($n_time_old > $n_start_otd){
		//сдвиг на более ранне врем	
		$time_old=strtotime($time_old)-$def;
		$time_old=date('H:i',$time_old);
		$rs3=$mysqli->query('UPDATE `active_reglament_form_current_table` SET start="'.$time_old.'" WHERE id="'.$id.'"');
		if ($rs3===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		$last_time=$time_old;
		$times[]=$last_time;
	}else{
		//сдвиг на более позднее вре
	
		$time_old=strtotime($time_old)+$def;
		$time_old=date('H:i',$time_old);
		$rs3=$mysqli->query('UPDATE `active_reglament_form_current_table` SET start="'.$time_old.'" WHERE id="'.$id.'"');
		if ($rs3===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		$last_time=$time_old;
		$times[]=$last_time;
	}
	
}



//корректировка времени окончания
$rs_end=$mysqli->query("UPDATE active_reglament_form_current_otd SET end_otd='".$last_time."' WHERE id_otd='".$id_otd."'");
		if ($rs_end===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);	
		}



////////////////////////////////////////////////////////////////////////










echo json_encode($times); 



?>