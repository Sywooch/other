<?php

if(isset($_GET["download"]) && ($_GET["download"]!="")){
	//file_force_download("/".$_GET["download"]);
	if(!empty($_SERVER['HTTP_REFERER'])){
		$source=$_SERVER['HTTP_REFERER'];
	}else{
		$source=$_SERVER['HTTP_HOST'];	
	}
	$source=parse_url($source);
	setcookie ("referrer", $source["host"]);
	//header('Location: /?download2='.$_GET["download"]);
	header( 'Refresh: 1; url=/?download2='.$_GET["download"] );
	exit;
}
if(isset($_GET["download2"]) && ($_GET["download2"]!="")){
	file_force_download("/".$_GET["download2"]);
}


function file_force_download($file) {
	$file=$_SERVER['DOCUMENT_ROOT'].$file;
	

	
	
	//$_COOKIE['referrer']=$source;	
	
	
	//echo "-----".$_COOKIE['referrer'];
	//echo "source = ".$source."";
	//echo "++++".$_COOKIE['referrer'];
	//echo $_SERVER['DOCUMENT_ROOT'].$file."++";	
  	if (file_exists($file)) {
		  //echo "---";
		// сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
		// если этого не сделать, файл будет читаться в память полностью
		if (ob_get_level()) {
		  ob_end_clean();
		}
		
		//echo $file."===";
		//header( 'Refresh: 5; url=/' );
		
		// заставляем браузер показать окно сохранения файла
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($file));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		
		// читаем файл и отправляем его пользователю
		readfile($file);
		
		
		//sleep(5);
		//header('Location: /');
		
		exit;
  }
}





?>

