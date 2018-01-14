<?php 

include('../db.php'); 


$id=$_POST['id'];


$number=$_POST['number'];

$surname_m=$_POST['surname_m'];
$name_m=$_POST['name_m'];
$date_m=$_POST['date_m'];
$kst_m=$_POST['kst_m'];
$kla_m=$_POST['kla_m'];
$kmn_m=$_POST['kmn_m'];

$ctk1_name=$_POST['ctk1_name'];
$ctk1_city=$_POST['ctk1_city'];
$ctk1_country=$_POST['ctk1_country'];
$surname_j=$_POST['surname_j'];
$name_j=$_POST['name_j'];
$date_j=$_POST['date_j'];

$kst_j=$_POST['kst_j'];
$kla_j=$_POST['kla_j'];
$kmn_j=$_POST['kmn_j'];

$ctk2_name=$_POST['ctk2_name'];
$ctk2_city=$_POST['ctk2_city'];
$ctk2_country=$_POST['ctk2_country'];

$st1=$_POST['st1'];
$st2=$_POST['st2'];
$st3=$_POST['st3'];
$curgroup=$_POST['curgroup'];
$curgroup_otd=$_POST['curgroup_otd'];



$rs = $mysqli->query("UPDATE `active_participants` SET number='".$number."',surname_m='".$surname_m."',name_m='".$name_m."',date_m='".$date_m."',kst_m='".$kst_m."',kla_m='".$kla_m."',kmn_m='".$kmn_m."',ctk1_name='".$ctk1_name."',ctk1_city='".$ctk1_city."',ctk1_country='".$ctk1_country."',surname_j='".$surname_j."',name_j='".$name_j."',date_j='".$date_j."',kst_j='".$kst_j."',kla_j='".$kla_j."',kmn_j='".$kmn_j."',ctk2_name='".$ctk2_name."',ctk2_city='".$ctk2_city."',ctk2_country='".$ctk2_country."',st1='".$st1."',st2='".$st2."',st3='".$st3."',id_group='".$curgroup."' WHERE id='".$id."'");
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}

$rs = $mysqli->query("UPDATE `active_turnir_participants` SET id_otdelenie='".$curgroup_otd."' WHERE id_participant='".$id."'");
if ($rs===false) {
	printf("Ошибка #3: %s\n", $mysqli->error);
}




echo "Cохранено";

?>