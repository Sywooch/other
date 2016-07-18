<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор строки таблицы

$number=$_POST['number'];//
$group=$_POST['group'];//
$tour=$_POST['tour'];//
$program=$_POST['program'];//
$pairs=$_POST['pairs'];//
$count_dances=$_POST['count_dances'];//
$dances=$_POST['dances'];//
$zahod=$_POST['zahod'];//
$vybor=$_POST['vybor'];//




$rs_end=$mysqli->query("UPDATE active_reglament_form_current_table SET number='".$number."',group1='".$group."',tour='".$tour."',program='".$program."',pairs='".$pairs."',count_dances='".$count_dances."',dances='".$dances."',zahod='".$zahod."',vybor='".$vybor."' WHERE id='".$id."'");
if ($rs_end===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}
		
		

echo "Сохранено";


?>