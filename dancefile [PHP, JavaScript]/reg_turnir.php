<?php 

include('../db.php'); 


$number=$_POST['number'];

$mfam=$_POST['mfam'];
$mnam=$_POST['mnam'];
$mbir=$_POST['mbir'];
$mkst=$_POST['mkst'];
$mkla=$_POST['mkla'];
$mkmn=$_POST['mkmn'];

$ffam=$_POST['ffam'];
$fnam=$_POST['fnam'];
$fbir=$_POST['fbir'];
$fkst=$_POST['fkst'];
$fkla=$_POST['fkla'];
$fkmn=$_POST['fkmn'];

$stk1=$_POST['stk1'];
$city1=$_POST['city1'];
$country1=$_POST['country1'];

$stk2=$_POST['stk2'];
$city2=$_POST['city2'];
$country2=$_POST['country2'];

$coach1=$_POST['coach1'];
$coach2=$_POST['coach2'];
$coach3=$_POST['coach3'];
$coach4=$_POST['coach4'];
$coach5=$_POST['coach5'];
$coach6=$_POST['coach6'];

$curgroup=$_POST['curgroup'];
$turnir_otd=$_POST['turnir_otd'];
$curgroup_type=$_POST['curgroup_type'];


//проверить правильность класса
/*
if($mkst!="-"){

$cnt=0;
$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE name='".$mnam."' AND sname='".$mfam."' AND date='".$mbir."' AND kst='".$mkst."'"); 
	while ($row = $rs->fetch_assoc()){	
		$cnt++;	
	}
	if($cnt==0){ echo "Ошибка. Неправильно выбран класс st"; exit; }
	
}


if($mkla!="-"){

$cnt=0;
$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE name='".$mnam."' AND sname='".$mfam."' AND date='".$mbir."' AND kla='".$mkla."'"); 
	while ($row = $rs->fetch_assoc()){	
		$cnt++;	
	}
	if($cnt==0){ echo "Ошибка. Неправильно выбран класс la"; exit; };
	
}


if($mkmn!="-"){

$cnt=0;
$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE name='".$mnam."' AND sname='".$mfam."' AND date='".$mbir."' AND kmn='".$mkmn."'"); 
	while ($row = $rs->fetch_assoc()){	
		$cnt++;	
	}
	if($cnt==0){ echo "Ошибка. Неправильно выбран класс mn"; exit; };
	
}









if($fkst!="-"){

$cnt=0;
$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE name='".$fnam."' AND sname='".$ffam."' AND date='".$fbir."' AND kst='".$fkst."'"); 
	while ($row = $rs->fetch_assoc()){	
		$cnt++;	
	}
	if($cnt==0){ echo "Ошибка. Неправильно выбран класс st"; exit; }
	
}


if($fkla!="-"){

$cnt=0;
$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE name='".$fnam."' AND sname='".$ffam."' AND date='".$fbir."' AND kla='".$fkla."'"); 
	while ($row = $rs->fetch_assoc()){	
		$cnt++;	
	}
	if($cnt==0){ echo "Ошибка. Неправильно выбран класс la"; exit; };
	
}


if($fkmn!="-"){

$cnt=0;
$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE name='".$fnam."' AND sname='".$ffam."' AND date='".$fbir."' AND kmn='".$fkmn."'"); 
	while ($row = $rs->fetch_assoc()){	
		$cnt++;	
	}
	if($cnt==0){ echo "Ошибка. Неправильно выбран класс mn"; exit; };
	
}

*/



//получить возрасты участников в годах
$today=date('Y');
$mbir2=$mbir[0].$mbir[1].$mbir[2].$mbir[3];
$year1=$today-$mbir2;//колчество лет партнёру


$today=date('Y');
$fbir2=$fbir[0].$fbir[1].$fbir[2].$fbir[3];
$year2=$today-$fbir2;//количество лет партнёрши




$rs=$mysqli->query("SELECT * FROM active_categorii WHERE id='".$curgroup."'"); 
	while ($row = $rs->fetch_assoc()){	
		
		$group_min=$row['years_min'];
		$group_max=$row['years_max'];
		
	}









/*


if(($year1>=$group_min)&&($year1<=$group_max)&&($year2>=$group_min)&&($year2<=$group_max)){
	





$rs_insert = $mysqli->query("INSERT INTO `active_participants` (number,surname_m,name_m,date_m,kst_m,kla_m,kmn_m,surname_j,name_j,date_j,kst_j,kla_j,kmn_j,ctk1_name,ctk1_city,ctk1_country,ctk2_name,ctk2_city,ctk2_country,st1,st2,st3,la1,la2,la3,id_group,type) VALUES ('".$number."','".$mfam."','".$mnam."','".$mbir."','".$mkst."','".$mkla."','".$mkmn."','".$ffam."','".$fnam."','".$fbir."','".$fkst."','".$fkla."','".$fkmn."','".$stk1."','".$city1."','".$country1."','".$stk2."','".$city2."','".$country2."','".$coach1."','".$coach2."','".$coach3."','".$coach4."','".$coach5."','".$coach6."','".$curgroup."','".$curgroup_type."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}

//получить идентификатор только что вставленной пары
$id_participant=$mysqli->insert_id;

$turnir_otd=$_POST['turnir_otd'];

$rs2_insert = $mysqli->query("INSERT INTO `active_turnir_participants` (id_otdelenie,id_participant) VALUES ('".$turnir_otd."','".$id_participant."')");
if ($rs2_insert===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}






echo "Регистрация для участия в тунире успешно завершена. #1";



}else if(($year1==($group_min-1))){
//если оба или хотя бы один из них моложе нижнего порога на один год

//если хотя бы у одного из них день рождения ранее 08-31
$date_p=date('Y-08-31');

$m1=explode('-',$mbir);
//$m2=explode('-',$fbir);

//m1[1]- месяц
//m1[2]- день
// || (($m2[1]<=8)&&($m2[2]<31))

if( (($m1[1]<=8)&&($m1[2]<31)) ){





$rs_insert = $mysqli->query("INSERT INTO `active_participants` (number,surname_m,name_m,date_m,kst_m,kla_m,kmn_m,surname_j,name_j,date_j,kst_j,kla_j,kmn_j,ctk1_name,ctk1_city,ctk1_country,ctk2_name,ctk2_city,ctk2_country,st1,st2,st3,la1,la2,la3,id_group,type) VALUES ('".$number."','".$mfam."','".$mnam."','".$mbir."','".$mkst."','".$mkla."','".$mkmn."','".$ffam."','".$fnam."','".$fbir."','".$fkst."','".$fkla."','".$fkmn."','".$stk1."','".$city1."','".$country1."','".$stk2."','".$city2."','".$country2."','".$coach1."','".$coach2."','".$coach3."','".$coach4."','".$coach5."','".$coach6."','".$curgroup."','".$curgroup_type."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}

//получить идентификатор только что вставленной пары
$id_participant=$mysqli->insert_id;

$turnir_otd=$_POST['turnir_otd'];
$rs2_insert = $mysqli->query("INSERT INTO `active_turnir_participants` (id_otdelenie,id_participant) VALUES ('".$turnir_otd."','".$id_participant."')");
if ($rs2_insert===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}

echo "Регистрация для участия в тунире успешно завершена. #2";





	
}



	
}else if(($year2==($group_min-1))){


	$date_p=date('Y-08-31');

	//$m1=explode('-',$mbir);
	$m2=explode('-',$fbir);

	//m1[1]- месяц
	//m1[2]- день
	// || (($m2[1]<=8)&&($m2[2]<31))

	if( (($m2[1]<=8)&&($m2[2]<31)) ){





		$rs_insert = $mysqli->query("INSERT INTO `active_participants` (number,surname_m,name_m,date_m,kst_m,kla_m,kmn_m,surname_j,name_j,date_j,kst_j,kla_j,kmn_j,ctk1_name,ctk1_city,ctk1_country,ctk2_name,ctk2_city,ctk2_country,st1,st2,st3,la1,la2,la3,id_group,type) VALUES ('".$number."','".$mfam."','".$mnam."','".$mbir."','".$mkst."','".$mkla."','".$mkmn."','".$ffam."','".$fnam."','".$fbir."','".$fkst."','".$fkla."','".$fkmn."','".$stk1."','".$city1."','".$country1."','".$stk2."','".$city2."','".$country2."','".$coach1."','".$coach2."','".$coach3."','".$coach4."','".$coach5."','".$coach6."','".$curgroup."','".$curgroup_type."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}


		//получить идентификатор только что вставленной пары
		$id_participant=$mysqli->insert_id;
		
		$turnir_otd=$_POST['turnir_otd'];
		$rs2_insert = $mysqli->query("INSERT INTO `active_turnir_participants` (id_otdelenie,id_participant) VALUES ('".$turnir_otd."','".$id_participant."')");
		if ($rs2_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}


		echo "Регистрация для участия в тунире успешно завершена. #2";

	}

}else{

echo "Регистрация невозможна. Возраст одного из участников не удовлетворяет требованиям группы.";	
}

*/



$rs_insert = $mysqli->query("INSERT INTO `active_participants` (number,surname_m,name_m,date_m,kst_m,kla_m,kmn_m,surname_j,name_j,date_j,kst_j,kla_j,kmn_j,ctk1_name,ctk1_city,ctk1_country,ctk2_name,ctk2_city,ctk2_country,st1,st2,st3,la1,la2,la3,id_group,type) VALUES ('".$number."','".$mfam."','".$mnam."','".$mbir."','".$mkst."','".$mkla."','".$mkmn."','".$ffam."','".$fnam."','".$fbir."','".$fkst."','".$fkla."','".$fkmn."','".$stk1."','".$city1."','".$country1."','".$stk2."','".$city2."','".$country2."','".$coach1."','".$coach2."','".$coach3."','".$coach4."','".$coach5."','".$coach6."','".$curgroup."','".$curgroup_type."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}

//получить идентификатор только что вставленной пары
$id_participant=$mysqli->insert_id;

$turnir_otd=$_POST['turnir_otd'];

$rs2_insert = $mysqli->query("INSERT INTO `active_turnir_participants` (id_otdelenie,id_participant) VALUES ('".$turnir_otd."','".$id_participant."')");
if ($rs2_insert===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}







echo "Регистрация для участия в тунире успешно завершена.";


?>