<?php 

include('../db.php'); 


$otdel=$_POST['otdel'];//идентификатор отдела
$group=$_POST['group'];//идентификатор группы










//вычислить номер последнего отдела турнира
$rs=$mysqli->query("SELECT * FROM active_participants WHERE id_group='".$group."' ORDER BY id DESC ");
while ($row = $rs->fetch_assoc()){
	$id=$row['id'];//идентификатор участника
	$rs2=$mysqli->query("SELECT * FROM active_turnir_participants WHERE id_participant='".$id."' AND id_otdelenie='".$otdel."' ");
	if(mysqli_num_rows($rs2)){
		
		
		//получить данные участника
		$rs3=$mysqli->query("SELECT * FROM active_participants WHERE id='".$id."' ");
		while ($row3 = $rs3->fetch_assoc()){
			$number=$row3['number'];
			$surname_m=$row3['surname_m'];
			$name_m=$row3['name_m'];
			$date_m=$row3['date_m'];
			$kst_m=$row3['kst_m'];
			$kla_m=$row3['kla_m'];
			$kmn_m=$row3['kmn_m'];
			$surname_j=$row3['surname_j'];
			$name_j=$row3['name_j'];
			$date_j=$row3['date_j'];
			$kst_j=$row3['kst_j'];
			$kla_j=$row3['kla_j'];
			$kmn_j=$row3['kmn_j'];
			$ctk1_name=$row3['ctk1_name'];
			$ctk1_city=$row3['ctk1_city'];
			$ctk1_country=$row3['ctk1_country'];
			$ctk2_name=$row3['ctk2_name'];
			$ctk2_city=$row3['ctk2_city'];
			$ctk2_country=$row3['ctk2_country'];
			$st1=$row3['st1'];
			$st2=$row3['st2'];
			$st3=$row3['st3'];
			$la1=$row3['la1'];
			$la2=$row3['la2'];
			$la3=$row3['la3'];
			$type=$row3['type'];
			
			$html=$number.":".$surname_m.":".$name_m.":".$date_m.":".$kst_m.":".$kla_m.":".$kmn_m.":".$surname_j.":".$name_j.":".$date_j.":".$kst_j.":".$kla_j.":".$kmn_j.":".$ctk1_name.":".$ctk1_city.":".$ctk1_country.":".$ctk2_name.":".$ctk2_city.":".$ctk2_country.":".$st1.":".$st2.":".$st3.":".$la1.":".$la2.":".$la3.":".$type."";
			
			$s[]=$html;
			
			
			
		}
		
		
		
	}
	
}



echo json_encode($s); 	


?>