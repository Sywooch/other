<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор зарегистрированного участника
$group_id=$_POST['group_id'];//идентификатор новой группы















	
	

	
	
	










$rs = $mysqli->query("INSERT INTO active_participants (number, surname_m, name_m, date_m, kst_m, kla_m, kmn_m, surname_j, name_j, date_j, kst_j, kla_j, kmn_j, ctk1_name, ctk1_city, ctk1_country, ctk2_name, ctk2_city, ctk2_country, st1, st2, st3, la1, la2, la3, id_group, type) SELECT number, surname_m, name_m, date_m, kst_m, kla_m, kmn_m, surname_j, name_j, date_j, kst_j, kla_j, kmn_j, ctk1_name, ctk1_city, ctk1_country, ctk2_name, ctk2_city, ctk2_country, st1, st2, st3, la1, la2, la3, id_group, type FROM active_participants WHERE id='".$id."'");

if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}




$id_last = $mysqli->insert_id;

$rs = $mysqli->query("UPDATE active_participants SET id_group='".$group_id."' WHERE id='".$id_last."' "); 

if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}


echo "Успешно";

?>