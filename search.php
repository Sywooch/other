<?php 

$term=$_POST['term'];

//получить список фамилий с идентификаторами


include('../db.php'); 

$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE LOCATE('".$term."', sname)"); 
$col=0;
while ($row = $rs->fetch_assoc()){
//	$col++;
	$s[]=$row['id']."-!-".$row['sname']." ".$row['name']." ".$row['date'];	
					
}
					


//$s=["1-!-finded_1", "2-!-finded_2", "3-!-finded_3=".$term.""];

echo json_encode($s); 


?>