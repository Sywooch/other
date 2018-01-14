<? 
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 


//print_r($_POST);


$id_tovar=$_POST['id_tovar'];//наименование товара
$url=$_POST['url'];//идентификатор товара




$rs_del = $mysqli->query("DELETE FROM tovar_images WHERE id_tovar='".$id_tovar."' AND url='".$url."'");
			if ($rs_del===false) {
				printf("Ошибка #32: %s\n", $mysqli->error);
			}



