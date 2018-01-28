<?php 
session_start();

require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


header('Content-type: text/html; charset=utf-8');

if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){//если пользователь незарегистрирован, то он выбрасывается 
//на страницу авторизации

header("Refresh: 1; URL=../login.php");
};


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////



//проверка расширения файла. (должно быть *.mp3)
//if($_FILES['userfile']['type'] != "audio/mpeg") {
//	echo"error1";
//	exit;
//}


//$info = getimagesize($_FILES['userfile']['tmp_name']);
//if($info['mime'] != 'audio/mpeg') {
//	echo"error2";
//	exit;
//}

$list2 = array(".mp3");
foreach ($list2 as $item) {
  if(preg_match("/$item\$/i", $_FILES['userfile']['name'])) {
  
   }else{
   
   echo "error3";
   exit;
   
   
   }
  }
//проверка расширения файла. (должно быть *.mp3)


//проверка размера файла (максимальный размер 100Мб)
$file_size=$_FILES['userfile']['size'];

if($file_size > (100*1024*1024)){
  echo "error5";
   exit;
 

}



if($_FILES['userfile']['error']==0){

}else if($_FILES['userfile']['error']==1){
 echo "error11";
   exit;
}else if($_FILES['userfile']['error']==2){
 echo "error22";
   exit;
}else if($_FILES['userfile']['error']==3){
 echo "error33";
   exit;
}else if($_FILES['userfile']['error']==4){
 echo "error44";
   exit;
}else if($_FILES['userfile']['error']==5){
 echo "error55";
   exit;
}else if($_FILES['userfile']['error']==6){
 echo "error66";
   exit;
}else if($_FILES['userfile']['error']==7){
 echo "error77";
   exit;
}else if($_FILES['userfile']['error']==8){
 echo "error88";
   exit;
}



//генерация имени файла .
//загружаемый файл будет переименован.

$today=getdate();
$today_date=$today['year']."".$today['mon']."".$today['mday'];
$date_gen=$today_date;//дата
$time_gen=$today['hours']."".$today['minutes']."".$today['seconds'];//время

$random=rand();
$id_file_name=$date_gen.$time_gen.$random;


$dirname=dirname(__FILE__);
//action заменить на mp3

$lenght_dirname=strlen($dirname);
$lenght_dirname=$lenght_dirname-6;
$dirname=substr($dirname, 0 , $lenght_dirname);
$dirname=$dirname."mp3\\";

//echo"".$dirname."";exit;

$uploaddir=$dirname;
//$uploaddir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'portal/mp3' . DIRECTORY_SEPARATOR;
//$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

$uploadfile = $uploaddir . $id_file_name . ".mp3";

//$name_audio=basename($_FILES['userfile']['name']);// имя файла.

$name_audio=$id_file_name . ".mp3";


if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

       // print "Загрузка успешна.";
		echo''.$name_audio.'';
		
} else {
       echo"error4";
}











 
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
//header("Refresh: 2; URL=../management_users.php");
	
    	
 ?>