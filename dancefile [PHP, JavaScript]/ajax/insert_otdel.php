<?php 

include('../db.php'); 


$id_turnir=$_POST['id_turnir'];//идентификатор турнира, к которому нужно добавить отдел

//вычислить номер последнего отдела турнира
$rs=$mysqli->query("SELECT * FROM active_turnir WHERE id_turnir='".$id_turnir."' ORDER BY id_otd DESC");
while ($row = $rs->fetch_assoc()){
	$id_otd=$row['id_otd'];
	$name_turnir=$row['name_turnir'];
	$date=$row['date'];
	break;
}

 //echo $id_otd." = ".$name_turnir." = ".$date;


$id_otd++;



$date=date('Y-m-d', strtotime($date) + 60 * 60 * 24);




$rs=$mysqli->query("INSERT INTO active_turnir (id_turnir,id_otd,date,groups,name_turnir) VALUES ('".$id_turnir."','".$id_otd."','".$date."','','".$name_turnir."')");
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}




echo "Отделение успешно добавлено к турниру.";	


?>