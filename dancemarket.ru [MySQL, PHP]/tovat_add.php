<? 
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 

//include('../../db.php'); 
//print_r($_POST);



//$shop
 
if($_SESSION['admin_name']=="admin"){
	$shop=$_POST['tovar_shop'];
}else{
	$rs  = $mysqli->query('SELECT * FROM  `administrators` WHERE id="'.$_SESSION['admin_id'].'"' );
	while ($row = $rs->fetch_assoc()){
		$shop=$row['shopId'];
	
	}
}

if(!isset($_POST['tovar_price'])){ echo"Ошибка! Не указана цена."; exit; }
if(!isset($_POST['tovar_name'])){ echo"Ошибка! Не указано имя."; exit; }
if(!isset($_POST['tovar_text'])){ $_POST['tovar_text']=""; }
if(!isset($_POST['tovar_brend'])){ echo"Ошибка! Не выбран бренд."; exit; }
if(!isset($_POST['tovar_art'])){ $_POST['tovar_art']=""; }
if(!isset($_POST['currency'])){ echo"Ошибка! Не указана валюта."; exit; }

$rs_insert=$mysqli->query('INSERT INTO `gb_shop_d`.`tovar`(`category`,`price`,`currency`,`name`,`text`,`brand`,`artikul`,`shop`) VALUES('.$_POST['category'].',"'.$_POST['tovar_price'].'","'.$_POST['currency'].'","'.htmlspecialchars($_POST['tovar_name']).'","'.htmlspecialchars($_POST['tovar_text']).'",'.$_POST['tovar_brend'].',"'.$_POST['tovar_art'].'","'.$shop.'")');
if ($rs_insert===false) {
	printf("Ошибка: %s\n", $mysqli->error);
}

//$id=mysql_insert_id();

$id=$mysqli->insert_id;

//echo "---".$id."---";


foreach ($_POST as $key=>$val){
switch(substr($key,0,10)) {
case 'tovarcolor': $mysqli->query('INSERT INTO `gb_shop_d`.`tovar_color`(`tovar`,`color`) VALUES('.$id.','.substr($key,10).');'); break;
case 'tovar_size': $mysqli->query('INSERT INTO `gb_shop_d`.`tovar_size`(`tovar`,`size`) VALUES('.$id.','.substr($key,10).');'); break;
};	
 };
 
 

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
		$mysqli->query('INSERT INTO `gb_shop_d`.`tovar_images`(`id_tovar`,`url`) VALUES ('.$id.',"http://www.dancemarket.info/img/shop/'.basename($_FILES['userfile']['name'][$i]).'");');
	}
	
}

//echo $_FILES['userfile']['name'][0]; 
 
 
 
 
 
 //echo '<br>'.md5(md5('paash1122')).'<br>';
 if (!is_dir('../../img/shop/'.$id)) {mkdir('../../img/shop/'.$id, 0770);};
echo 'Товар добавлен!<br><a href="?a=mag&id='.$_POST['category'].'">Обновить страницу.</a><br><a href="?a=mag&item='.$id.'">Добавленный товар</a>';
?>