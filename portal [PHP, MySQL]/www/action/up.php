<?php 
header('Content-type: text/html; charset=utf-8');
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
					//удаление файла
					//   $file_name=$row['PACTH_TO_FILE'].$row['FILE_NAME'];
					// if(!unlink($file_name)){echo"Не удалось удалить файл";exit;}
					
					
		 
 
 
//      copy($_FILES['userfile']['tmp_name'],"uploads/doc/".basename($_FILES['userfile']['name']));
	



		  
	 echo"<h3>Файл успешно загружен на сервер</h3>";
	  
      echo "<h3>Информация о загруженном на сервер файле: </h3>";
      echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['userfile']['name']."</b></p>";
      echo "<p><b>Mime-тип загруженного файла: ".$_FILES['userfile']['type']."</b></p>";
      echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['userfile']['size']."</b></p>";
      echo "<p><b>Временное имя файла: ".$_FILES['userfile']['tmp_name']."</b></p>";
      
?>	  