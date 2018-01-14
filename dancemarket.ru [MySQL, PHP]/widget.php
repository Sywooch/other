<?php

ini_set('display_errors',1);
error_reporting(E_ALL);


include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 




$rs3 = $mysqli->query("SELECT * FROM `special` ORDER BY RAND(NOW()) LIMIT 3");	
while ($row3 = mysqli_fetch_assoc($rs3)){
	$id_tovar=$row3['id_tovar'];
	$rs_img = $mysqli->query("SELECT * FROM `tovar_images` WHERE id_tovar='".$id_tovar."'");
	while ($row_img = mysqli_fetch_assoc($rs_img)){
		$url=$row_img['url'];
	}
	
	$rs_name = $mysqli->query("SELECT * FROM `tovar` WHERE id='".$id_tovar."'");
	while ($row_name = mysqli_fetch_assoc($rs_name)){
		
		$name=$row_name['name'];
		$price=$row_name['price'];
		$id_brand=$row_name['brand'];
		$id_category=$row_name['category'];
	}
	$url_tovar="http://www.dancemarket.info/?item=".$id_tovar;
	
	$rs_brand = $mysqli->query("SELECT * FROM `brand` WHERE id='".$id_brand."'");
	while ($row_brand = mysqli_fetch_assoc($rs_brand)){
		$brand=$row_brand['name'];
	}
	
	$rs_cat = $mysqli->query("SELECT * FROM `category` WHERE id='".$id_category."'");
	while ($row_cat = mysqli_fetch_assoc($rs_cat)){
		$cat=$row_cat['name'];
	}
	
	$url_cat="http://www.dancemarket.info/?id=".$id_category;
	
	
	$m[]=$url."-!-".$name."-!-".$url_tovar."-!-".$price."-!-".$brand."-!-".$cat."-!-".$url_cat;
	

}

echo $m[0]."=!=".$m[1]."=!=".$m[2];

?>