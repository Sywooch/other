<?php 

include('../db.php'); 


$id_m=$_POST['id_m'];//идентификатор одного из партнёров

//получить идентификатор пары


$rs = $mysqli->query("SELECT * FROM `info_couple` WHERE id_m='".$id_m."'");
while ($row = mysqli_fetch_assoc($rs)){
	$id_para=$row['id'];
	
	
}


//проверить участие пары в турнире, найти последнее участие по дате, вернуть дату последнего участия

$rs = $mysqli->query("SELECT * FROM `info_action` WHERE id_с='".$id_para."' ORDER BY data");
if(mysqli_num_rows($rs)){
	
	while ($row = mysqli_fetch_assoc($rs)){
		$data=$row['data'];
			
	}
	
	
	
	
}else{
	
	echo"ok";
	exit;	
	
}







//echo "";	


?>