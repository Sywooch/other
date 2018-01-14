<?php 

include('../db.php'); 
include('program_dance.php');

$groups=$_POST['groups'];//список идентификаторов групп
$id_turnir=$_POST['id_turnir'];//идентификатор турнира
$id_otd=$_POST['id_otd'];//идентфикатор отделения


//получить сведения об общей длительности танца
$rs=$mysqli->query('SELECT * FROM `active_turnir` WHERE id_turnir="'.$id_turnir.'" AND id_otd="'.$id_otd.'" ');
while ($row = $rs->fetch_assoc()){
$tmp_2=$row['id']; //идентификатор id из таблицы active_turnir
}



//удалить старую версию таблицы
$rs_d=$mysqli->query("DELETE FROM active_reglament_form_current_table WHERE id_otd='".$tmp_2."'");
if ($rs_d===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}




$rs=$mysqli->query('SELECT * FROM `active_reglament_form_current_otd` WHERE id_otd="'.$tmp_2.'"');
while ($row = $rs->fetch_assoc()){
	$pred_tur=$row['pred_tur'];
	$fun_tur=$row['fun_tur'];
	$start_otd=$row['start_otd'];
}

$fun_tur_m=explode(":",$fun_tur);
$fun_h=$fun_tur_m[0];
$fun_m=$fun_tur_m[1];



$result = date('H:i',strtotime($pred_tur.' + '.$fun_h.' hours')); 
$result = date('H:i',strtotime($result.' + '.$fun_m.' min')); 


$dance_duration = $result;//подолжительность часы/минуты








//echo $pred_tur." == ".$fun_tur."=";


//формирование таблицы
//active_reglament_form_current_table

//получить список групп текущего отделения
$groups_m=explode(";",$groups);
$count = count($groups_m);
$time1=$start_otd;
$dance_duration_m=explode(":",$dance_duration);
$global_count=1;


for ($i=0; $i<$count; $i++)
{
	
	
	if($groups_m[$i]==""){ continue; }
	
	$rs_group_table=$mysqli->query('SELECT * FROM `active_categorii` WHERE id="'.$groups_m[$i].'"');
	while ($row_group_table = $rs_group_table->fetch_assoc()){
		$table_id_group=$row_group_table['id'];
		$table_name_group=$row_group_table['name'];
	
	
	}
	
	
	$id_tmp=-1;
	
	$rs_tmp=$mysqli->query("SELECT * FROM active_reglament_groups WHERE id_turnir='".$id_turnir."' AND id_otd='".$id_otd."' AND id_group='".$table_id_group."' "); 
	while ($row_tmp = $rs_tmp->fetch_assoc()){
		$id_tmp=$row_tmp['id'];		
		$count_pairs=$row_tmp['pair'];	
	}
		
	$rs_tours=$mysqli->query("SELECT * FROM active_reglament_tours WHERE id_group='".$id_tmp."' ORDER BY number"); 
	while ($row_tours = $rs_tours->fetch_assoc()){
		
		
		
		echo $time1; 
		
		echo" | ";
		
		echo $global_count;
		

		echo" | ";
		echo $table_name_group; echo" | ";
		echo $row_tours['value'];
		$tmp_dances=$row_tours['dances'];
		//echo $tmp_dances;
		$count_st=0;
		$count_la=0;
		$tmp_dances_m=explode(";",$tmp_dances);
		for($i2=0;$i2<count($tmp_dances_m);$i2++){
			if(program_dance($tmp_dances_m[$i2])=='St'){
				$count_st++;
			}else{
				$count_la++;	
			}
			
		}
		if(($count_st!=0)&&($count_la!=0)){
			$program="Двоеборье";	
		}else if(($count_st==0)&&($count_la!=0)){
			$program="Латина";
		}else if(($count_st!=0)&&($count_la==0)){
			$program="Стандарт";
		}
		echo" | ";
		echo $program;
		echo" | ";
		echo $count_pairs;
		echo" | ";
		
		$dances_m=explode(";",$row_tours['dances']);
		$count_dances=0;
		for($i3=0;$i3<count($dances_m);$i3++){
			if($dances_m[$i3]==""){ continue; }
			$count_dances++;
		}
		echo $count_dances;
		echo" | ";
		$rest = substr($row_tours['dances'], -1);
		if($rest==";"){
			$d = substr($row_tours['dances'],0,-1);
			echo $d;
		}else{
			
			echo $row_tours['dances'];
			$d=$row_tours['dances'];		
		}
		echo" | ";
		echo $row_tours['zahod'];
		echo" | ";
		echo $row_tours['vybr'];
		echo" | ";
		
		echo $dance_duration;
		
		
		///////
		$rs_insert=$mysqli->query("INSERT INTO active_reglament_form_current_table (id_otd,start,number,group1,tour,program,pairs,count_dances,dances,zahod,vybor,time) VALUES ('".$tmp_2."','".$time1."','".$global_count."','".$table_name_group."','".$row_tours['value']."','".$program."','".$count_pairs."','".$count_dances."','".$d."','".$row_tours['zahod']."','".$row_tours['vybr']."','".$dance_duration."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		
		$result = date('H:i',strtotime($time1.' + '.$dance_duration_m[0].' hours')); 
		$result = date('H:i',strtotime($result.' + '.$dance_duration_m[1].' min')); 
		$time1=$result;
		
		$global_count++;
		
		
		
		
		
		
		
	 echo"<br>";
	}
	
	
	
	
echo "<br>";	
}

		echo $time1; 
		
		echo" | ";
		
		echo $global_count;
		

		echo" | ";
		echo "Награждение победителей"; echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo "00:15";
		
		$rs_insert=$mysqli->query("INSERT INTO active_reglament_form_current_table (id_otd,start,number,group1,tour,program,pairs,count_dances,dances,zahod,vybor,time) VALUES ('".$tmp_2."','".$time1."','".$global_count."','Награждение победителей',' ',' ',' ',' ',' ',' ',' ','00:15')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
		
		
$result = date('H:i',strtotime($time1.' + 0 hours')); 
		$result = date('H:i',strtotime($result.' + 15 min')); 
		$time1=$result;
		
		$global_count++;

echo "<br>";



		echo $time1; 
		
		//записать время окончания
		
		$rs_end=$mysqli->query("UPDATE active_reglament_form_current_otd SET end_otd='".$time1."' WHERE id_otd='".$tmp_2."'");
		if ($rs_end===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);	
		}
		
		
		
		echo" | ";
		
		echo $global_count;
		

		echo" | ";
		echo "Окончание"; echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		echo" | ";
		echo " ";
		
		
$rs_insert=$mysqli->query("INSERT INTO active_reglament_form_current_table (id_otd,start,number,group1,tour,program,pairs,count_dances,dances,zahod,vybor,time) VALUES ('".$tmp_2."','".$time1."','".$global_count."','Окончание',' ',' ',' ',' ',' ',' ',' ',' ')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}

$result = date('H:i',strtotime($time1.' + '.$dance_duration_m[0].' hours')); 
		$result = date('H:i',strtotime($result.' + '.$dance_duration_m[1].' min')); 
		$time1=$result;
		
$global_count++;

echo "";	


?>