<?php 

include('../db.php'); 


$name_turnir=$_POST['name_turnir'];
$date_start_turnir=$_POST['date_start_turnir'];
$count_days=$_POST['count_days'];



$name=$_POST['name'];
$class_min=$_POST['class_min'];
$class_max=$_POST['class_max'];
$years_min=$_POST['years_min'];
$years_max=$_POST['years_max'];
$text_otd2=$_POST['text_otd2'];

//вставить новые группы
$group_name=explode(":",$name);
$group_class_min=explode(":",$class_min);
$group_class_max=explode(":",$class_max);
$group_years_min=explode(":",$years_min);
$group_years_max=explode(":",$years_max);



//echo $text_otd2;

$group_text_otd2=explode(":",$text_otd2);

$result = count($group_name);



//вставка сведений о новом турнире
//формирование таблицы со списком отделений


$rs_3 = $mysqli->query("SELECT * FROM active_turnir ORDER BY id_turnir DESC LIMIT 1");

while ($row_3 = $rs_3->fetch_assoc()){
 $id_turnir=$row_3["id_turnir"];
}

$id_turnir++;


//$name_turnir=$name_turnir;//наименование турнира
$start=$date_start_turnir;//стартовая дата
//$count_days



//$d = new DateTime($start);
//$d->modify("+".$count_days." day");
//$end=$d->format("Y-m-d");



if($count_days=='1'){
	$end=$start;
}else{

	$end=date('Y-m-d', strtotime($start) + 60 * 60 * 24 * $count_days);

}







//$groups = substr($groups,0,-1);











if($start==$end){
	
//турнир проходит всего один день




$groups="";
for($i=0;$i<$result;$i++){

if(($group_name[$i]=="")||($group_name[$i]==NULL)){ continue; }


	$rs=$mysqli->query("SELECT * FROM active_categorii WHERE name='".$group_name[$i]."'");
	if(mysqli_num_rows($rs)){
	//если категория существует, по получить её идентификатор
		while ($row = $rs->fetch_assoc()){
			$id_cat=$row['id'];
		}
		
		
	}else{
	//категория не существует, вставить категорию и получить её идентификатор
		$rs3=$mysqli->query('INSERT INTO `active_categorii` (name,class_min,class_max,years_min,years_max,id_info) VALUES ("'.$group_name[$i].'","'.$group_class_min[$i].'","'.$group_class_max[$i].'","'.$group_years_min[$i].'","'.$group_years_max[$i].'","0")');
		if ($rs3===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$id_cat=$mysqli->insert_id;
		
		
	}
	
	//$group_text_otd2[0]; - отделения, в которых участвует первая группа
	//в данный момент находимся в первом отделении
	
	//если число 1 присутствует в массиве $group_text_otd2[$i] то делаем склеивание 
	$mas_tmp=explode(";",$group_text_otd2[$i]);
	
	
	
	if(in_array('1',$mas_tmp)){
		$groups=$groups.$id_cat.";";
	}
	
	
	
}

	

	
		$rs_insert = $mysqli->query("INSERT INTO `active_turnir` (id_turnir,id_otd,date,groups,name_turnir) VALUES ('".$id_turnir."','1','".$start."','".$groups."','".$name_turnir."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}


	

	
}else{
//турнир занимает несколько дней

$count=1;
	
	
	while(true){
		
		
		
		
			

$groups="";
for($i=0;$i<$result;$i++){

if(($group_name[$i]=="")||($group_name[$i]==NULL)){ continue; }


	$rs=$mysqli->query("SELECT * FROM active_categorii WHERE name='".$group_name[$i]."'");
	if(mysqli_num_rows($rs)){
	//если категория существует, по получить её идентификатор
		while ($row = $rs->fetch_assoc()){
			$id_cat=$row['id'];
		}
		
		
	}else{
	//категория не существует, вставить категорию и получить её идентификатор
		$rs3=$mysqli->query('INSERT INTO `active_categorii` (name,class_min,class_max,years_min,years_max,id_info) VALUES ("'.$group_name[$i].'","'.$group_class_min[$i].'","'.$group_class_max[$i].'","'.$group_years_min[$i].'","'.$group_years_max[$i].'","0")');
		if ($rs3===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		$id_cat=$mysqli->insert_id;
		
		
	}
	
	
	
	
	//$group_text_otd2[0]; - отделения, в которых участвует первая группа
	//в данный момент находимся в первом отделении
	
	//если число 1 присутствует в массиве $group_text_otd2[$i] то делаем склеивание 
	$mas_tmp=explode(";",$group_text_otd2[$i]);
	
	
	
	if(in_array(($count),$mas_tmp)){
		$groups=$groups.$id_cat.";";
	}
	
	
	
}

	
		
		
		
		

	
			$rs_insert = $mysqli->query("INSERT INTO `active_turnir` (id_turnir,id_otd,date,groups,name_turnir) VALUES ('".$id_turnir."','".$count."','".$start."','".$groups."','".$name_turnir."')");
			if ($rs_insert===false) {
				printf("Ошибка #2: %s\n", $mysqli->error);
			}
			$count++;


		

	
	
	
	
	//увеличить дату на один день
	$start=date('Y-m-d', strtotime($start) + 60 * 60 * 24);
	
	if($start==$end){break;};
	
	
	
	
	}


	
	


}




echo "Сохранено.";	


?>