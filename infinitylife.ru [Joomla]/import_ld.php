<?php 

if (file_exists("../tmp/long_desc.csv")){
//удаление предыдущего файла
unlink("../tmp/long_desc.csv");

}

if(($_FILES['importfile']==NULL)||($_FILES['importfile']==undefined)){
echo"Ошибка. Файл отсутствует.";	
echo'<script type="text/javascript"> 
  window.location.href = "/administrator/index.php?option=com_virtuemart"
</script>';	
}

$file=$_FILES['importfile']['name'];
$ext=pathinfo($file,PATHINFO_EXTENSION);//получение расширения файла
 
if($ext!="csv"){
  echo"<h3>Ошибка. Недопустимое расширение файла.</h3>";
echo'<script type="text/javascript"> 
  window.location.href = "/administrator/index.php?option=com_virtuemart"
</script>';	
}
  
copy($_FILES['importfile']['tmp_name'],"../tmp/long_desc.csv");
  
$file_array=file("../tmp/long_desc.csv");

define ( "DB_SERVER", "localhost" ); 
define ( "DB_BASE", "ru3topolya_mgl2" ); 
define ( "DB_USER", "ru3topolya_mgl2" ); 
define ( "DB_PASS", "raEI6VcuHz"); 

$file_str=implode($file_array);
$mas=explode("\n", $file_str);
 
$count=sizeof($mas);

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");
 
 $i=0;
 $i2=0; 
 
while($i<$count){
$mas2=explode("_", $mas[$i]);
	
$name=$mas2[0]; //echo $name." = ";
$long_desc=$mas2[1]; //echo $long_desc."<br>";

//echo"0";

//'.$_SERVER['DOCUMENT_ROOT'].'
//include "/home/r/ru3topolya/domains/mygardenland/public_html/libraries/joomla/factory.php";

//echo"1";

//$database	= & JFactory::getDBO();

//$database->setQuery("SELECT * FROM #__virtuemart_products_ru_ru WHERE product_name='$name'");
		
//echo"2";
				
//$list = $database->loadObjectList();
//foreach($list as $user) {
//$id_item=$user->virtuemart_product_id; echo $id_item."<br>";
//break;
//}

$query="SELECT * FROM jos_virtuemart_products_ru_ru WHERE product_name='$name'";
$res=mysql_query($query);
while($row=mysql_fetch_array($res)){
$id_item=$row['virtuemart_product_id'];	 
break;	 
}



//echo"3";

//$database2	= & JFactory::getDBO();
//$database2->setQuery("UPDATE #__virtuemart_product_customfields SET custom_value='$long_desc' WHERE //virtuemart_product_id='$id_item' AND virtuemart_custom_id='47'");
//if(!$database2->query()) {
// echo __LINE__.$database3->stderr();
//}


$query="UPDATE jos_virtuemart_product_customfields SET custom_value='$long_desc' WHERE virtuemart_product_id='$id_item' AND virtuemart_custom_id='47'";
$res=mysql_query($query);



 $i++;
$i2++;

}

echo'<script type="text/javascript"> 
  window.location.href = "/administrator/index.php?option=com_virtuemart"
</script>';



					
?>
 