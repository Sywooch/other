<?php 
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php'); 



$xml_url=$_POST['url'];


//echo "==".$_FILES['userfile']['name'];

/*


if(($_FILES['userfile']['name']!=NULL)&&($_FILES['userfile']['name']!="")){
	$file=$_FILES['userfile']['name'];	
	$ext=pathinfo($file,PATHINFO_EXTENSION);//получение расширения файла
	if(($ext!="xml")){
  			echo "Ошибка 1. Недопустимое расширение файла."; exit;
	}
	
	//echo $_FILES['userfile']['type'];
	
	if(($_FILES['userfile']['type']!="text/xml")){
		echo "Ошибка 2. Недопустимое расширение файла."; exit;
	}
	
	$tmp=rand();
	$_FILES['userfile']['name']=$tmp.$_FILES['userfile']['name'];
	copy($_FILES['userfile']['tmp_name'],"/home/virtwww/w_dancemarket_231f1fe5/http/upload_xml/".basename($_FILES['userfile']['name']));
	
	$file_xml="http://www.dancemarket.info/upload_xml/".basename($_FILES['userfile']['name']);
	
	//echo $file_xml;
	
	
	
	
	
}


*/




if($_SESSION['admin_name']=="admin"){
	if(!isset($_POST['tovar_shop3'])){  echo "Ошибка. Не выбран магазин."; }
	$shop=$_POST['tovar_shop3'];
}else{
	$rs  = $mysqli->query('SELECT * FROM  `administrators` WHERE id="'.$_SESSION['admin_id'].'"' );
	while ($row = $rs->fetch_assoc()){
		$shop=$row['shopId'];
	
	}
}














//$rs1 = $mysqli->query("SELECT * FROM `shops` WHERE id='1'");
//while ($row1 = mysqli_fetch_assoc($rs1)){
//	$url_xml=$row1['url'];
//}
$url_xml=$xml_url;


include('/home/virtwww/w_dancemarket_231f1fe5/http/action/import_include.php'); 








//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////


?>
