<?php 

include('../db.php'); 


$id_tour=$_POST['id_tour'];//идентификатор тура
$html=$_POST['html'];//код таблицы, которую нужно сохранить (таблица для участника)
$html2=$_POST['html2'];//код таблицы, которую нужно сохранить (таблица для ведущего)


$cnt=0;
$rs_end=$mysqli->query("SELECT * FROM active_reglament_save_tables_tour WHERE id_tour='".$id_tour."' ");
while ($row_end = $rs_end->fetch_assoc()){	
$cnt=1;
}


if($cnt==0){
//вставка
$rs_end2=$mysqli->query("INSERT active_reglament_save_tables_tour (id_tour,html,html2) VALUES ('".$id_tour."','".$html."','".$html2."') ");
if ($rs_end2===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}	

	
}else{
//обновление	
	



$rs_end2=$mysqli->query("UPDATE active_reglament_save_tables_tour SET html='".$html."', html2='".$html2."' WHERE id_tour='".$id_tour."' ");
if ($rs_end2===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);	
}


}





echo "Таблица успешно сохранена";


?>