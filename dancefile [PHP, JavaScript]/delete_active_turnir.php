<?php 

include('../db.php'); 


$id_turnir=$_POST['id_turnir'];

$rs_3 = $mysqli->query("DELETE FROM active_turnir WHERE id_turnir='".$id_turnir."'");
if ($rs_3===false) {
				printf("Ошибка #3: %s\n", $mysqli->error);
			}



echo "Турнир успешно удалён.";	


?>