<?php 

include('../db.php'); 


$id_turnir=$_POST['id_turnir'];
$name_turnir=$_POST['name_turnir'];
$date_start_turnir=$_POST['date_start_turnir'];

//проверить имя, если оно было изменено, то обновить
$rs_3 = $mysqli->query("SELECT * FROM active_turnir WHERE id_turnir='".$id_turnir."' AND name_turnir='".$name_turnir."'");
if(mysqli_num_rows($rs_3)){
	
}else{
	$rs_4 = $mysqli->query("UPDATE active_turnir SET name_turnir='".$name_turnir."' WHERE id_turnir='".$id_turnir."' ");
	if ($rs_4===false) {
		printf("Ошибка #3: %s\n", $mysqli->error);
	}	
	
}


//если дата была изменена, то посчитать разницу и осуществить сдвиг
$rs_3 = $mysqli->query("SELECT * FROM active_turnir WHERE id_turnir='".$id_turnir."' AND id_otd='1' AND date='".$date_start_turnir."'");
if(mysqli_num_rows($rs_3)){
	
}else{
	
	//получить старую дату начала
	$rs_5 = $mysqli->query("SELECT * FROM active_turnir WHERE id_turnir='".$id_turnir."' AND id_otd='1'");
	while ($row_5 = mysqli_fetch_assoc($rs_5)){
		$old_date=$row_5['date'];
		
	}
	//$date_start_turnir - новая дата. вычислить разницу
	
	if($date_start_turnir>$old_date){
	//дата увеличивается	
		$diff=((strtotime($date_start_turnir) - strtotime($old_date)) / 86400 );//разница в днях
		//увеличить дату каждого отделения на один день
		$rs_date = $mysqli->query("SELECT * FROM active_turnir WHERE id_turnir='".$id_turnir."' ");
		while ($row_date = mysqli_fetch_assoc($rs_date)){
			$id=$row_date['id'];
			$date=$row_date['date'];
			$date=date('Y-m-d', strtotime($date) + 60 * 60 * 24 * $diff);//увеличение даты
			$rs_date2 = $mysqli->query("UPDATE active_turnir SET date='".$date."' WHERE id='".$id."' ");
			if ($rs_date2===false) {
				printf("Ошибка #3: %s\n", $mysqli->error);
			}	
			
			
		}
		
	}else{
	//дата уменьшается
		$diff=((strtotime($old_date) - strtotime($date_start_turnir)) / 86400 );//разница в днях
		//увеличить дату каждого отделения на один день
		$rs_date = $mysqli->query("SELECT * FROM active_turnir WHERE id_turnir='".$id_turnir."' ");
		while ($row_date = mysqli_fetch_assoc($rs_date)){
			$id=$row_date['id'];
			$date=$row_date['date'];
			$date=date('Y-m-d', strtotime($date) - 60 * 60 * 24 * $diff);//уменьшение даты
			$rs_date2 = $mysqli->query("UPDATE active_turnir SET date='".$date."' WHERE id='".$id."' ");
			if ($rs_date2===false) {
				printf("Ошибка #3: %s\n", $mysqli->error);
			}	
			
			
		}
		
		
	}
	
	
	
	

	
	
	
	
}










echo "Сохранено.";	


?>