<?php 

include('../db.php'); 


$id_m=$_POST['id_m'];
$id_w=$_POST['id_w'];
$kst=$_POST['kst'];
$kla=$_POST['kla'];
$kmn=$_POST['kmn'];

//echo $id_m;
//echo $kst." = ".$kla." = ".$kmn;



$rs=$mysqli->query("UPDATE info_dancer_m SET kst='".$kst."', kla='".$kla."', kmn='".$kmn."' WHERE id='".$id_m."' "); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	



$rs=$mysqli->query("UPDATE info_dancer_w SET kst='".$kst."', kla='".$kla."', kmn='".$kmn."' WHERE id='".$id_w."' "); 
		
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}	




echo "Сохранено.";	


?>