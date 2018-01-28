<?php 
session_start();
require '../config/config.php';
ini_set('display_errors',1);
error_reporting(E_ALL);


header('Content-type: text/html; charset=utf-8');


if(!isset($_SESSION['user'])||($_SESSION['user']==NULL)){
exit;
};

$dbh = mysqli_init();
mysqli_options($dbh, MYSQLI_INIT_COMMAND, "SET AUTOCOMMIT=0");
mysqli_options($dbh, MYSQLI_OPT_CONNECT_TIMEOUT, 5);

mysqli_real_connect($dbh, DB_SERVER, DB_USER, DB_PASS);

if (mysqli_connect_errno()) {
    printf("Ошибка соединения: %s\n", mysqli_connect_error());
    exit();
}

mysqli_query($dbh,"SET NAMES utf8");
					mysqli_query ($dbh,"SET COLLATION_CONNECTION=utf8");
                   mysqli_query($dbh,"SET CHARACTER_SET_CLIENT=utf8");
					mysqli_query($dbh,"SET CHARACTER_SET_RESULTS=utf8");

					mysqli_select_db($dbh, DB_BASE);
					


if(!isset($_GET['id'])){exit;};
$id=$_GET['id'];

		
		

////////////////////////////////////////////////////////
	$query = "SELECT * FROM news WHERE id='$id'";				
	 $res=mysqli_query($dbh, $query);
	    

					if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$res=mysqli_query($dbh, $query);
$row=mysqli_fetch_array($res);



echo"".$row['text']."";	
				
///	echo "".$row['text']."";
	

	
	
	mysqli_close($dbh);  
 
 
 //	echo "".$_REQUEST['head']."";
 ?>