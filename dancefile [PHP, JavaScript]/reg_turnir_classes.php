<?php 

include('../db.php'); 


$id_class=$_POST['id_class'];

$rs = $mysqli->query("SELECT * FROM `active_categorii` WHERE id='".$id_class."'");

while ($row = mysqli_fetch_assoc($rs)){
	$class_min=$row['class_min'];
	$class_max=$row['class_max'];
	
}



echo $class_min.":".$class_max;	


?>