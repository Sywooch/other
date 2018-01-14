<?php 

$id=$_POST['id'];
$id2=$_POST['id2'];//идентификатор партнёра

include('../db.php'); 

$rs=$mysqli->query("SELECT * FROM info_dancer_w WHERE id='".$id."'"); 
while ($row = $rs->fetch_assoc()){
$name=$row['name'];
$sname=$row['sname'];
$date=$row['date'];
$kst_m=$row['kst'];
$kla_m=$row['kla'];
$kmn_m=$row['kmn'];

}


//получить идентификатор пары
$rs=$mysqli->query("SELECT * FROM info_couple WHERE id_w='".$id."' AND id_m='".$id2."' "); 
while ($row = $rs->fetch_assoc()){	
$id_para=$row['id'];
}



$club_text="";
$city_text="";
$club_id_text="";
$cnt1=0;

$rs=$mysqli->query("SELECT * FROM info_couple_club WHERE couple='".$id_para."'"); 
while ($row = $rs->fetch_assoc()){
	
	$id_club=$row['club'];


	
	$rs2=$mysqli->query("SELECT * FROM info_club WHERE id='".$id_club."'"); 
	while ($row2 = $rs2->fetch_assoc()){				
		$club=$row2['name'];
		$city_id=$row2['city'];

	}
	
	if($cnt1==0){
		$club_text=$club_text."".$club."";
		$club_id_text=$club_id_text."".$id_club;
	}else{
		$club_text=$club_text." | ".$club."";
		$club_id_text=$club_id_text." | ".$id_club;
	}
	
	
	$rs2=$mysqli->query("SELECT * FROM info_city WHERE id='".$city_id."'"); 
	while ($row2 = $rs2->fetch_assoc()){	
		$city=$row2['name'];
	}

	if($cnt1==0){
		$city_text=$city_text."".$city."";
	}else{
		$city_text=$city_text." | ".$city."";
	}
	
	
	$cnt1++;
	
}




$trener="";

//получить идентификатор тренера
$rs=$mysqli->query("SELECT * FROM info_couple_trener WHERE couple='".$id_para."'"); 
while ($row = $rs->fetch_assoc()){	

	$id_trener=$row['trener'];
	
	//получить имя тренера
	$rs=$mysqli->query("SELECT * FROM info_trener WHERE id='".$id_trener."'"); 
	while ($row = $rs->fetch_assoc()){	
		
		$trener=$trener.$row['sname']." ".$row['name']."-!-";
	}


}






$s[]=$name;
$s[]=$sname;
$s[]=$date;
//$s[]=$club;
//$s[]=$city;
$s[]=$club_text;
$s[]=$city_text;
$s[]=$trener;





//получить параметры партнёра

//получить идентификатор партнёра
//$rs=$mysqli->query("SELECT * FROM info_couple WHERE id_w='".$id."'"); 
//while ($row = $rs->fetch_assoc()){	
//	$id_m=$row['id_m'];
//	
//}
$id_m=$id2;


/////////////////////////////////////////////////////////////////



$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE id='".$id_m."'"); 
while ($row = $rs->fetch_assoc()){
$name2=$row['name'];
$sname2=$row['sname'];
$date2=$row['date'];
$kst_w=$row['kst'];
$kla_w=$row['kla'];
$kmn_w=$row['kmn'];


}

$club_text2="";
$city_text2="";
$club_id_text2="";
$cnt2=0;



$rs=$mysqli->query("SELECT * FROM info_couple_club WHERE couple='".$id_para."'"); 
while ($row = $rs->fetch_assoc()){
	$id_club=$row['club'];
	
	$rs2=$mysqli->query("SELECT * FROM info_club WHERE id='".$id_club."'"); 
	while ($row2 = $rs2->fetch_assoc()){				
		$club2=$row2['name'];
		$city_id=$row2['city'];

	}
	
	if($cnt2==0){
		$club_text2=$club_text2."".$club2."";
		$club_id_text2=$club_id_text2."".$id_club;
	}else{
		$club_text2=$club_text2." | ".$club2."";
		$club_id_text2=$club_id_text2." | ".$id_club;
	}

	$rs2=$mysqli->query("SELECT * FROM info_city WHERE id='".$city_id."'"); 
	while ($row2 = $rs2->fetch_assoc()){	
		$city2=$row2['name'];
	}

	if($cnt2==0){
		$city_text2=$city_text2."".$city2."";
	}else{
		$city_text2=$city_text2." | ".$city2."";
	}
	$cnt2++;
	
	
}





//получить идентификатор пары
$rs=$mysqli->query("SELECT * FROM info_couple WHERE id_w='".$id_w."' AND id_m='".$id."' "); 
while ($row = $rs->fetch_assoc()){	
$id_para=$row['id'];
}

$trener2="";

//получить идентификатор тренера
$rs=$mysqli->query("SELECT * FROM info_couple_trener WHERE couple='".$id_para."'"); 
while ($row = $rs->fetch_assoc()){	

	$id_trener=$row['trener'];
	
	//получить имя тренера
	$rs=$mysqli->query("SELECT * FROM info_trener WHERE id='".$id_trener."'"); 
	while ($row = $rs->fetch_assoc()){	
		
		$trener2=$trener2.$row['sname']." ".$row['name']."-!-";
	}


}


$s[]=$name2;
$s[]=$sname2;
$s[]=$date2;
//$s[]=$club2;
//$s[]=$city2;
$s[]=$club_text2;
$s[]=$city_text2;

$s[]=$trener2;


$s[]=$kst_m;
$s[]=$kla_m;
$s[]=$kmn_m;

$s[]=$kst_w;
$s[]=$kla_w;
$s[]=$kmn_w;





$rs=$mysqli->query("SELECT * FROM info_k WHERE id='".$kst_m."'"); 
while ($row = $rs->fetch_assoc()){	
$name_kst_m=$row['name'];
}

$rs=$mysqli->query("SELECT * FROM info_k WHERE id='".$kla_m."'"); 
while ($row = $rs->fetch_assoc()){	
$name_kla_m=$row['name'];
}

$rs=$mysqli->query("SELECT * FROM info_k WHERE id='".$kmn_m."'"); 
while ($row = $rs->fetch_assoc()){	
$name_kmn_m=$row['name'];
}


$rs=$mysqli->query("SELECT * FROM info_k WHERE id='".$kst_w."'"); 
while ($row = $rs->fetch_assoc()){	
$name_kst_w=$row['name'];
}

$rs=$mysqli->query("SELECT * FROM info_k WHERE id='".$kla_w."'"); 
while ($row = $rs->fetch_assoc()){	
$name_kla_w=$row['name'];
}

$rs=$mysqli->query("SELECT * FROM info_k WHERE id='".$kmn_w."'"); 
while ($row = $rs->fetch_assoc()){	
$name_kmn_w=$row['name'];
}

/////////////////////////////////////////////////////////////////


$s[]=$name_kst_m;
$s[]=$name_kla_m;
$s[]=$name_kmn_m;

$s[]=$name_kst_w;
$s[]=$name_kla_w;
$s[]=$name_kmn_w;
$s[]=$id_m;



//получить класс участника
$rs=$mysqli->query("SELECT * FROM info_class_dancer_w WHERE id_dancer='".$id."'"); 
while ($row = $rs->fetch_assoc()){	
$id_class=$row['id_class'];
}
$s[]=$id_class;//25

$s[]=$club_id_text;
$s[]=$club_id_text2;


echo json_encode($s); 


?>