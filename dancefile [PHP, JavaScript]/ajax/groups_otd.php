<?php 

include('../db.php'); 


$id=$_POST['id'];



//echo"==".$id."==";



$rs = $mysqli->query("SELECT * FROM `active_turnir` WHERE id='".$id."'");

while ($row = mysqli_fetch_assoc($rs)){
	$groups=$row['groups'];
}

$groups_mas=explode(";",$groups);
$groups="";

foreach($groups_mas as $value){
	//$value - идентификатор группы
	
	if($value==""){ continue; }
	
	//получить наименование группы
	$rs2 = $mysqli->query("SELECT * FROM `active_categorii` WHERE id='".$value."'");
	while ($row2 = mysqli_fetch_assoc($rs2)){
		$name_group=$row2['name'];
		break;
	}
	
	
	$groups=$groups.'<option value="'.$value.'">'.$name_group.'</option>';	
	
	
	
}


echo $groups;



?>