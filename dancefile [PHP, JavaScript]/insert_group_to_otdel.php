<?php 

include('../db.php'); 


$id_otd=$_POST['id_otd'];
$class_min_insert=$_POST['class_min_insert'];
$class_max_insert=$_POST['class_max_insert'];
$years_min_insert=$_POST['years_min_insert'];
$years_max_insert=$_POST['years_max_insert'];
$name_insert=$_POST['name_insert'];





	$rs=$mysqli->query("SELECT * FROM active_categorii WHERE name='".$name_insert."'");
	if(mysqli_num_rows($rs)){
	//если категория существует, по получить её идентификатор
		while ($row = $rs->fetch_assoc()){
			$id_cat=$row['id'];
		}
		
		
	}else{
	//категория не существует, вставить категорию и получить её идентификатор
		$rs3=$mysqli->query('INSERT INTO `active_categorii` (name,class_min,class_max,years_min,years_max,id_info) VALUES ("'.$name_insert.'","'.$class_min_insert.'","'.$class_max_insert.'","'.$years_min_insert.'","'.$years_max_insert.'","0")');
		if ($rs3===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$id_cat=$mysqli->insert_id;
		
		
	}
	

//привязка категории к отделению
$rs=$mysqli->query("SELECT * FROM active_turnir WHERE id='".$id_otd."'");
while ($row = $rs->fetch_assoc()){
	$groups=$row['groups'];
}


$groups=$groups.$id_cat.";";

$rs=$mysqli->query("UPDATE active_turnir SET groups='".$groups."' WHERE id='".$id_otd."'");
if ($rs===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}





echo "Категория успешно добавлена к отделению.";	


?>