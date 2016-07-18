<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор строки таблицы

//получение идентификатора отделения
$rs_end=$mysqli->query("SELECT * FROM active_reglament_form_current_table WHERE id='".$id."'");
while ($row_end = $rs_end->fetch_assoc()){
$id_otd=$row_end['id_otd'];	
}



$rs_end=$mysqli->query("DELETE FROM active_reglament_form_current_table WHERE id='".$id."'");
if ($rs_end===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}


//пересчёт номеров
$number=1;
$rs_end=$mysqli->query("SELECT * FROM active_reglament_form_current_table WHERE id_otd='".$id_otd."' ORDER BY number"); 
while ($row_end = $rs_end->fetch_assoc()){
	
	$rs_end2=$mysqli->query("UPDATE active_reglament_form_current_table SET number='".$number."' WHERE id='".$row_end['id']."' ");
	if ($rs_end2===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);	
	}
	
	$number++;	
}


//пересчёт времени начала
$cnt=0;
$rs_end=$mysqli->query("SELECT * FROM active_reglament_form_current_table WHERE id_otd='".$id_otd."' ORDER BY number");
while ($row_end = $rs_end->fetch_assoc()){

	if($cnt==0){
		$start_old=$row_end['start'];
		$time_old=$row_end['time'];
		$id=$row_end['id'];
		$m[]=$start_old;
		
	}else{
		
		
		$fun_tur_m=explode(":",$time_old);
		$fun_h=$fun_tur_m[0];
		$fun_m=$fun_tur_m[1];

		$result = date('H:i',strtotime($start_old.' + '.$fun_h.' hours')); 
		$result = date('H:i',strtotime($result.' + '.$fun_m.' min')); 

		$start=$result;
		$time1=$start;
		
		$m[]=$start;
		
		$id=$row_end['id'];
		$rs_end2=$mysqli->query("UPDATE active_reglament_form_current_table SET start='".$start."' WHERE id='".$id."' ");
		if ($rs_end2===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);	
		}
		
		$start_old=$start;
		$time_old=$row_end['time'];
		
		
		
	}
	
	$cnt++;

}


$rs_end=$mysqli->query("UPDATE active_reglament_form_current_otd SET end_otd='".$time1."' WHERE id_otd='".$id_otd."'");
		if ($rs_end===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);	
		}



$m[]=$id_otd;
$m[]=$time1;

echo json_encode($m);




/*
$rs_end=$mysqli->query("UPDATE active_reglament_form_current_table SET number='".$number."',group1='".$group."',tour='".$tour."',program='".$program."',pairs='".$pairs."',count_dances='".$count_dances."',dances='".$dances."',zahod='".$zahod."',vybor='".$vybor."' WHERE id='".$id."'");
if ($rs_end===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}
*/		
		

//echo "Сохранено";


?>