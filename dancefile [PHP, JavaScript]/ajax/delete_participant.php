<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор зарегистрированного участника




$rs = $mysqli->query("DELETE FROM `active_participants` WHERE id='".$id."'");
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}





echo "Участник успешно удалён";

?>