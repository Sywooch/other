<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор отделения
$group=$_POST['group'];
$tour=$_POST['tour'];
$program=$_POST['program'];
$pairs=$_POST['pairs'];
$count_dances=$_POST['count_dances'];
$dances=$_POST['dances'];
$zahod=$_POST['zahod'];
$vybor=$_POST['vybor'];
$time=$_POST['time'];


//получение идентификатора отделения

$last_time="";

$rs_end=$mysqli->query("SELECT * FROM active_reglament_form_current_table WHERE id_otd='".$id."' ORDER BY number DESC LIMIT 1");
while ($row_end = $rs_end->fetch_assoc()){
	
	$last_number=$row_end['number'];
	$last_start=$row_end['start'];
	$last_time=$row_end['time'];
	
}


if(($last_time=="")||($last_time==NULL)||($last_time==" ")){ $last_time="00:00"; }

//echo "=".$last_time."=";





$insert_number=$last_number+1;

$fun_tur_m=explode(":",$last_time);
		$fun_h=$fun_tur_m[0];
		$fun_m=$fun_tur_m[1];

		$result = date('H:i',strtotime($last_start.' + '.$fun_h.' hours')); 
		$result = date('H:i',strtotime($result.' + '.$fun_m.' min')); 
		

$insert_start=$result;





$rs_end=$mysqli->query("INSERT INTO active_reglament_form_current_table (id_otd,start,number,group1,tour,program,pairs,count_dances,dances,zahod,vybor,time) VALUES ('".$id."','".$insert_start."','".$insert_number."','".$group."','".$tour."','".$program."','".$pairs."','".$count_dances."','".$dances."','".$zahod."','".$vybor."','".$time."')");
if ($rs_end===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}








/*
$rs_end=$mysqli->query("UPDATE active_reglament_form_current_table SET number='".$number."',group1='".$group."',tour='".$tour."',program='".$program."',pairs='".$pairs."',count_dances='".$count_dances."',dances='".$dances."',zahod='".$zahod."',vybor='".$vybor."' WHERE id='".$id."'");
if ($rs_end===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}
*/		
		

//echo "Сохранено";


?>