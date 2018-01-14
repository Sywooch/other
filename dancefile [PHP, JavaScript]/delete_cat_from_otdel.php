<?php 

include('../db.php'); 


$id_cat=$_POST['id_cat'];//идентификатор категории, которую надо удалить
$id_otdel=$_POST['id_otdel'];//идентификатор отделения, из которого надо удалить категорию

$rs_3 = $mysqli->query("SELECT * FROM active_turnir WHERE id='".$id_otdel."'");
while ($row_3 = $rs_3->fetch_assoc()){

	$groups=$row_3['groups'];

}


$groups_m=explode(";",$groups);

$groups="";


for($i=0;$i<count($groups_m);$i++){

if($groups_m[$i]==""){ continue; }

	if(	$groups_m[$i]==$id_cat ){   }else{
		$groups=$groups.$groups_m[$i].";";
			
	}
	
}



$rs_3 = $mysqli->query("UPDATE active_turnir SET groups='".$groups."' WHERE id='".$id_otdel."'");
if ($rs_3===false) {
				printf("Ошибка #3: %s\n", $mysqli->error);
			}


echo "Категория из отделения успешно удалена.";	


?>