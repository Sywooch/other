<? 
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);


if($_SESSION['admin_name']!='admin'){
exit;	
}


include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 

//include('../../db.php'); 
//print_r($_POST);

$cat_main=$_POST['cat_main'];//идентификатор основной категории
$cat_del=$_POST['cat_del'];//идентификатор удаляемой категории
$name_cat=$_POST['name_cat'];//наименование основной категории


//echo $cat_main." == ".$cat_del." == ".$name_cat;


//имеются ли товары у удаляемой категории?
$rs = $mysqli->query("SELECT * FROM `tovar` WHERE category='".$cat_del."'");
if(mysqli_num_rows($rs)){
	//удаляемая категория содержит товары, переместить их в основную категорию
	$rs1 = $mysqli->query("UPDATE `tovar` SET category='".$cat_main."' WHERE category='".$cat_del."'");
	if ($rs1===false) {
		printf("Ошибка #5: %s\n", $mysqli->error);
	}	

}

//содержит ли удаляемая категория подкатегории
$rs = $mysqli->query("SELECT * FROM `category` WHERE parent='".$cat_del."'");
if(mysqli_num_rows($rs)){
//удаляемая категория содержит подкатегории
//переключить все категории на основную
	$rs1 = $mysqli->query("UPDATE `category` SET parent='".$cat_main."' WHERE parent='".$cat_del."'");
	if ($rs1===false) {
		printf("Ошибка #5: %s\n", $mysqli->error);
	}	

	
	
}


//переименовать основную категорию
$rs1 = $mysqli->query("UPDATE `category` SET name='".$name_cat."' WHERE id='".$cat_main."'");
if ($rs1===false) {
	printf("Ошибка #5: %s\n", $mysqli->error);
}


//удалить удаляемую категорию
$rs1 = $mysqli->query("DELETE FROM `category` WHERE id='".$cat_del."'");
if ($rs1===false) {
	printf("Ошибка #5: %s\n", $mysqli->error);
}



echo "Категории объединены.";

?>