<? 
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);



include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 

//include('../../db.php'); 
//print_r($_POST);

$id=$_POST['id'];



$rs_insert = $mysqli->query("INSERT INTO `special` (id_tovar) VALUES ('".$id."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}





echo "Товар добавлен в спецразмещение.";

?>