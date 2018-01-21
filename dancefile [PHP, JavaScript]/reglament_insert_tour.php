<?php 

include('../db.php'); 
include('program_dance.php'); 

$id_group=$_POST['id_group'];//идентификатор группы
$id_turnir=$_POST['id_turnir'];//идентификатор турнира
$id_otd=$_POST['id_otd'];//идентификатор отделения


$value_tur=$_POST['value_tur'];//значение тура
$list_1=$_POST['list_1'];//список танцев
$next_tour=$_POST['next_tour'];//в следующий тур
$zahod=$_POST['zahod'];//заходов
$area=$_POST['area'];//площадка
$z_rotation=$_POST['z_rotation'];//ротация заходов


$list_1=substr($list_1,0,-1);


//echo "id_group= ".$id_group."";
//echo "id_turnir= ".$id_turnir."";
//echo "id_otd= ".$id_otd."";


//вычислить идентификатор из таблицы active_reglament_groups
$rs=$mysqli->query("SELECT * FROM active_reglament_groups WHERE id_group='".$id_group."' AND id_otd='".$id_otd."' AND id_turnir='".$id_turnir."'"); 
while ($row = $rs->fetch_assoc()){
$id_tmp=$row['id'];
}

//получить последний номер тура

$rs=$mysqli->query("SELECT * FROM active_reglament_tours WHERE id_group='".$id_tmp."' ORDER BY number DESC LIMIT 1"); 
while ($row = $rs->fetch_assoc()){
	$last_number_tour=$row['number'];
	
	
}

$last_number_tour=$last_number_tour+1;




$rs=$mysqli->query("INSERT INTO active_reglament_tours (number,value,dances,in_next_tour,zahod,area,id_group,z_rotation) VALUES ('".$last_number_tour."','".$value_tur."','".$list_1."','".$next_tour."','".$zahod."','".$area."','".$id_tmp."','".$z_rotation."')"); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	

//получить идентификатор только-что вставленного тура
$id_tour=$mysqli->insert_id;

$list_1_m=explode(";",$list_1);

for($i=1;$i<=count($list_1_m);$i++){

	$rs=$mysqli->query("INSERT INTO active_reglament_dances_order (id_tour,number,dance,program) VALUES ('".$id_tour."','".$i."','".$list_1_m[$i-1]."','".program_dance($list_1_m[$i-1])."')");
	if ($rs===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
		
}

//$list_1
//




echo "Тур успешно добавлен к группе.";	


?>