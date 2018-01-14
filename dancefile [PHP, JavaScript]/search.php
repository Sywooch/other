<?php 

$term=$_POST['term'];

//получить список фамилий с идентификаторами


include('../db.php'); 

//$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE LOCATE('".$term."', sname)"); 
$rs=$mysqli->query("SELECT * FROM info_dancer_m WHERE sname LIKE '".$term."%' ORDER BY sname"); 


$col=0;
while ($row = $rs->fetch_assoc()){
	//вычислить пару танцора
	$id_m=$row['id'];
	$rs2=$mysqli->query("SELECT * FROM info_couple WHERE id_m='".$id_m."'");
	while ($row2 = $rs2->fetch_assoc()){
		
		
		$id_para=$row2['id'];
		
		
		$name_club_text="";
		
		$rs4=$mysqli->query("SELECT * FROM info_couple_club WHERE couple='".$id_para."'");
		$cnt2=0;
		while ($row4 = $rs4->fetch_assoc()){
			$club_id=$row4['club'];
			
			$rs5=$mysqli->query("SELECT * FROM info_club WHERE id='".$club_id."'");
			while ($row5 = $rs5->fetch_assoc()){
				$name_club=$row5['name'];
			}
			if($cnt2==0){
				$name_club_text=$name_club_text."".$name_club."";
			}else{
				$name_club_text=$name_club_text." | ".$name_club."";
			}
			$cnt2++;
			
		}
		
		
		
		$id_w=$row2['id_w'];
		
		$rs3=$mysqli->query("SELECT * FROM info_dancer_w WHERE id='".$id_w."'");
		
		while ($row3 = $rs3->fetch_assoc()){
			$w_sname=$row3['sname'];
			$w_name=$row3['name'];
			$w_date=$row3['date'];
		}
		$s[]=$row['id']."-!-".$row['sname']." ".$row['name']." ".$row['date']."-!-".$w_sname." ".$w_name." ".$w_date."-!-".$id_w."-!-".$name_club_text;	
	
		
		
	}
	
//	$col++;
					
}
					


//$s=["1-!-finded_1", "2-!-finded_2", "3-!-finded_3=".$term.""];

echo json_encode($s); 


?>