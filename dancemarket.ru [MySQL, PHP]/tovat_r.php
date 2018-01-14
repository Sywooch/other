<? 
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 


//print_r($_POST);


$tovar_name=$_POST['tovar_name'];//наименование товара
$tovar_id=$_POST['tovar_id'];//идентификатор товара
$tovar_price=$_POST['tovar_price'];//цена
$tovar_text=$_POST['tovar_text'];//описание
$tovar_brend=$_POST['tovar_brend'];//бренд
$currency=$_POST['currency'];//валюта
$tovar_art=$_POST['tovar_art'];//артикул


//echo $tovar_name." = ".$tovar_id." = ".$tovar_price." = ".$tovar_text." = ".$tovar_brend." = ".$currency." = ".$tovar_art;

//exit;

$rs = $mysqli->query("UPDATE `tovar` SET price='".$tovar_price."', currency='".$currency."', name='".$tovar_name."', text='".$tovar_text."', brand='".$tovar_brend."', artikul='".$tovar_art."' WHERE id='".$tovar_id."' ");
if ($rs===false) {
	printf("Ошибка #25: %s\n", $mysqli->error);
}



//изменение цвета

$rs2  = $mysqli->query('SELECT * FROM `color`');
while ($row2 = $rs2->fetch_assoc()){
	if(isset($_POST['tovarcolor'.$row2['id'].''])){
		//echo "Y=".$row2['id']."<br>";
		//добавить идентификатор цвета в таблицу
		$rs3  = $mysqli->query("SELECT * FROM `tovar_color` WHERE tovar='".$tovar_id."' AND color='".$row2['id']."'");
		if(mysqli_num_rows($rs3)){
			//если уже существует, то не добавлять
		}else{
			//добавить
			$rs_insert = $mysqli->query("INSERT INTO `tovar_color` (tovar,color) VALUES ('".$tovar_id."','".$row2['id']."')");
			if ($rs_insert===false) {
				printf("Ошибка #31: %s\n", $mysqli->error);
			}	
		}
		
	}else{
		//если цвет существует в таблице, то убрать его
		//echo "N=".$row2['id']."<br>";
		$rs3  = $mysqli->query("SELECT * FROM `tovar_color` WHERE tovar='".$tovar_id."' AND color='".$row2['id']."'");
		if(mysqli_num_rows($rs3)){
			//убрать цвет из таблицы
			$rs_del = $mysqli->query("DELETE FROM tovar_color WHERE tovar='".$tovar_id."' AND color='".$row2['id']."'");
			if ($rs_del===false) {
				printf("Ошибка #32: %s\n", $mysqli->error);
			}
			
		}
	}
}



//print_r($_POST);


//изменение размера

$rs2  = $mysqli->query('SELECT * FROM `size`');
while ($row2 = $rs2->fetch_assoc()){
	if(isset($_POST['tovar_size'.$row2['id'].''])){
		//echo "Y=".$row2['id']."<br>";
		//добавить идентификатор размера в таблицу
		$rs3  = $mysqli->query("SELECT * FROM `tovar_size` WHERE tovar='".$tovar_id."' AND size='".$row2['id']."'");
		if(mysqli_num_rows($rs3)){
			//если уже существует, то не добавлять
		}else{
			//добавить
			$rs_insert = $mysqli->query("INSERT INTO `tovar_size` (tovar,size) VALUES ('".$tovar_id."','".$row2['id']."')");
			if ($rs_insert===false) {
				printf("Ошибка #31: %s\n", $mysqli->error);
			}	
		}
		
	}else{
		//если размер существует в таблице, то убрать его
		//echo "N=".$row2['id']."<br>";
		$rs3  = $mysqli->query("SELECT * FROM `tovar_size` WHERE tovar='".$tovar_id."' AND size='".$row2['id']."'");
		if(mysqli_num_rows($rs3)){
			//убрать размер из таблицы
			$rs_del = $mysqli->query("DELETE FROM tovar_size WHERE tovar='".$tovar_id."' AND size='".$row2['id']."'");
			if ($rs_del===false) {
				printf("Ошибка #32: %s\n", $mysqli->error);
			}
			
		}
	}
}



//вставка картинок
$count_files=count($_FILES['userfile']['name']);
//echo $count_files;



for($i=0;$i<$count_files;$i++){
	
	if(($_FILES['userfile']['name'][$i]!=NULL)&&($_FILES['userfile']['name'][$i]!="")){
		$file=$_FILES['userfile']['name'][$i];	
		$ext=pathinfo($file,PATHINFO_EXTENSION);//получение расширения файла
		if(($ext!="jpg")&&($ext!="png")&&($ext!="gif")&&($ext!="jpeg")){
  			echo "Ошибка 1. Недопустимое расширение файла."; exit;
		}
		//echo $_FILES['userfile']['type'][$i];
		if(($_FILES['userfile']['type'][$i]!="image/jpeg")&&($_FILES['userfile']['type'][$i]!="image/gif")&&($_FILES['userfile']['type'][$i]!="image/png")){
			echo "Ошибка 2. Недопустимое расширение файла."; exit;
		}
		$tmp=rand();
		$_FILES['userfile']['name'][$i]=$tmp.$_FILES['userfile']['name'][$i];
		//echo $_FILES['userfile']['tmp_name'][$i]."<br>";
		copy($_FILES['userfile']['tmp_name'][$i],"/home/virtwww/w_dancemarket_231f1fe5/http/img/shop/".basename($_FILES['userfile']['name'][$i]));
	
	
		//запись в базу
		// $id
		$mysqli->query('INSERT INTO `tovar_images`(`id_tovar`,`url`) VALUES ('.$tovar_id.',"http://www.dancemarket.info/img/shop/'.basename($_FILES['userfile']['name'][$i]).'");');
	}
	
}






echo "Сохранено.";



