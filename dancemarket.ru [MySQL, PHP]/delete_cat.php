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

$id_cat=$_POST['id_cat'];




$rs3 = $mysqli->query("DELETE FROM `category` WHERE id='".$id_cat."'");
	if ($rs3===false) {
		printf("Ошибка #2: %s\n", $mysqli->error);
	}
	




echo "Категория удалена.";

?>