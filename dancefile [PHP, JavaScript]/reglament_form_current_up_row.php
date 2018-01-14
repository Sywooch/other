<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор строки таблицы



//получение номера
$rs_end=$mysqli->query("SELECT * FROM active_reglament_form_current_table WHERE id='".$id."'");
while ($row_end = $rs_end->fetch_assoc()){
$number1=$row_end['number'];	
$id_otd=$row_end['id_otd'];

}

if($number1==1){ exit; }

$rs_end=$mysqli->query("SELECT * FROM active_reglament_form_current_table WHERE id_otd='".$id_otd."' AND number='".($number1-1)."' ");
while ($row_end = $rs_end->fetch_assoc()){
//$number2=$row_end['number'];
$id2=$row_end['id'];
}


$rs_end2=$mysqli->query("UPDATE active_reglament_form_current_table SET number='".($number1-1)."' WHERE id='".$id."' ");
if ($rs_end2===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}

$rs_end2=$mysqli->query("UPDATE active_reglament_form_current_table SET number='".($number1)."' WHERE id='".$id2."' ");
if ($rs_end2===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}





//пересчёт времени начала

$cnt=0;
$rs_end=$mysqli->query("SELECT * FROM active_reglament_form_current_table WHERE id_otd='".$id_otd."' ORDER BY number");
while ($row_end = $rs_end->fetch_assoc()){

	if($cnt==0){
		
		$rs_end3=$mysqli->query("SELECT * FROM active_reglament_form_current_otd WHERE id_otd='".$id_otd."'");
		while ($row_end3 = $rs_end3->fetch_assoc()){
			$start_old=$row_end3['start_otd'];
			
		}
		
		$rs_end2=$mysqli->query("UPDATE active_reglament_form_current_table SET start='".$start_old."' WHERE id_otd='".$id_otd."' AND number='1' ");
		if ($rs_end2===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);	
		}
		
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



$m[]=$id_otd;


echo json_encode($m);




/*
$rs_end=$mysqli->query("UPDATE active_reglament_form_current_table SET number='".$number."',group1='".$group."',tour='".$tour."',program='".$program."',pairs='".$pairs."',count_dances='".$count_dances."',dances='".$dances."',zahod='".$zahod."',vybor='".$vybor."' WHERE id='".$id."'");
if ($rs_end===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}
*/		
		

//echo "Сохранено";


?>