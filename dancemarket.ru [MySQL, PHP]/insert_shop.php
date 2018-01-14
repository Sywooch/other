<?php 

include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 


$name=$_POST['name'];
$phone=$_POST['phone'];
$url=$_POST['url'];
$description=$_POST['description'];


//добавление нового магазина

$rs_shop = $mysqli->query('INSERT INTO `shops` (name,url,tel,comm) VALUES ("'.$name.'","'.$url.'","'.$phone.'","'.$description.'")');
if ($rs_shop===false) {
	printf("Ошибка #2: %s\n", $mysqli->error);
}




echo "Магазин был успешно добавлен.";

?>