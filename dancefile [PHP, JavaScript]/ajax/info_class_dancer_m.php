<?php 

include('../db.php'); 


$id_m=$_POST['id_m'];

$rs = $mysqli->query("SELECT * FROM `info_class_dancer_m` WHERE id_dancer='".$id_m."'");

while ($row = mysqli_fetch_assoc($rs)){
	$info_class_dancer_m=$row['id_class'];
	
	
}



echo $info_class_dancer_m;	


?>