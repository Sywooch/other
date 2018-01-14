<?php 

include('../db.php'); 


$id_class=$_POST['id_class'];

$rs = $mysqli->query("SELECT * FROM `active_categorii` WHERE id='".$id_class."'");

while ($row = mysqli_fetch_assoc($rs)){
	$years_min=$row['years_min'];
	$years_max=$row['years_max'];
	
}



echo $years_min.":".$years_max;	


?>