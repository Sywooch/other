<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор зарегистрированного участника
$group_id=$_POST['group_id'];//идентификатор новой группы



$rs = $mysqli->query("UPDATE `active_participants` SET id_group='".$group_id."' WHERE id='".$id."'");
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}





echo "Успешно";

?>