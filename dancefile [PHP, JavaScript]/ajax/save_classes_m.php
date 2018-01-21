<?php 

include('../db.php'); 


$id_m=$_POST['id_m'];
$kst=$_POST['kst'];
$kla=$_POST['kla'];
$kmn=$_POST['kmn'];






$rs=$mysqli->query("UPDATE info_dancer_m SET kst='".$kst."', kla='".$kla."', kmn='".$kmn."' WHERE id='".$id_m."' "); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	




echo "Сохранено.";	


?>