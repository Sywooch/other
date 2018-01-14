<?php 

$id=$_POST['id'];


include('../db.php'); 

$rs=$mysqli->query("SELECT * FROM info_club WHERE id='".$id."'"); 
while ($row = $rs->fetch_assoc()){
$name=$row['name'];
$city_id=$row['city'];


}

$rs=$mysqli->query("SELECT * FROM info_city WHERE id='".$city_id."'"); 
while ($row = $rs->fetch_assoc()){
$city=$row['name'];



}

$s[]=$name;
$s[]=$city;


echo json_encode($s); 


?>