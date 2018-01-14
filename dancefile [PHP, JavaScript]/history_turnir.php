<?php 

include('../db.php'); 


$id_m=$_POST['id_m'];//идентификатор одного из партнёров
$info_class_dancer_r=$_POST['info_class_dancer_r'];//идентификатор класса участника


//получить идентификатор пары


$rs = $mysqli->query("SELECT * FROM `info_couple` WHERE id_m='".$id_m."'");
while ($row = mysqli_fetch_assoc($rs)){
	$id_para=$row['id'];
	
	
}


//echo " id_para = ".$id_para;


//проверить участие пары в турнире, найти последнее участие по дате, получить идентификатор группы и вычислить идентификатор минимального класса группы

$rs = $mysqli->query("SELECT * FROM `info_action` WHERE id_с='".$id_para."' ORDER BY data");
if(mysqli_num_rows($rs)){
	
	while ($row = mysqli_fetch_assoc($rs)){
		$id_group=$row['id_cat'];
			
	}
	
//	echo " id_group = ".$id_group;
	
	
	$rs2 = $mysqli->query("SELECT * FROM `active_categorii` WHERE id_info='".$id_group."'");
	while ($row2 = mysqli_fetch_assoc($rs2)){
		
		$class_min=$row2['class_min'];
	}
	
//	echo " class_min = ".$class_min;
	
	
	if($info_class_dancer_r<$class_min){ echo "warning"; }else{ echo"ok"; }
	
	
	
}else{
	
	echo"ok";
	exit;	
	
}







echo "";	


?>