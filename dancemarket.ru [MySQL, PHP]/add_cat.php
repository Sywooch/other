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

$cat=$_POST['cat'];
$name=$_POST['name'];



$rs3 = $mysqli->query("SELECT * FROM `category` WHERE name='".$name."'");
if(mysqli_num_rows($rs3)){
	echo "Ошибка. Категория с заданным именем уже существует."; exit;				
}else{
	$rs_insert = $mysqli->query("INSERT INTO `category` (parent,name) VALUES ('".($cat)."','".$name."')");
	if ($rs_insert===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
	
}




echo "Категория добавлена.";

?>