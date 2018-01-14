<?php 

include('../db.php'); 


$id_f=$_POST['id_f'];

$rs = $mysqli->query("SELECT * FROM `info_class_dancer_w` WHERE id_dancer='".$id_f."'");

while ($row = mysqli_fetch_assoc($rs)){
	$info_class_dancer_w=$row['id_class'];
	
	
}



echo $info_class_dancer_w;	


?>