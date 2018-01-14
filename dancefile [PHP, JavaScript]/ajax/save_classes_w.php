<?php 

include('../db.php'); 



$id_w=$_POST['id_w'];
$kst=$_POST['kst'];
$kla=$_POST['kla'];
$kmn=$_POST['kmn'];






$rs=$mysqli->query("UPDATE info_dancer_w SET kst='".$kst."', kla='".$kla."', kmn='".$kmn."' WHERE id='".$id_w."' "); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	





echo "Сохранено.";	


?>