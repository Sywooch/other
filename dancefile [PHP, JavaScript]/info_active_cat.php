<?php 

include('../db.php'); 


$id=$_POST['id'];

$rs = $mysqli->query("SELECT * FROM `active_categorii` WHERE id='".$id."'");

while ($row = mysqli_fetch_assoc($rs)){

	$name=$row['name'];
	$class_min=$row['class_min'];
	$class_max=$row['class_max'];
	$years_min=$row['years_min'];
	$years_max=$row['years_max'];
	
	
	
	
}

$s[]=$name;
$s[]=$class_min;
$s[]=$class_max;
$s[]=$years_min;
$s[]=$years_max;




echo json_encode($s); 	


?>