<?php

define ( "DB_SERVER", "localhost" ); 
define ( "DB_BASE", "ru3topolya_mgl2" ); 
define ( "DB_USER", "ru3topolya_mgl2" ); 
define ( "DB_PASS", "raEI6VcuHz"); 

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");



$query="SELECT * FROM p_goods WHERE moderation='2'";
$res=mysql_query($query);
while($row=mysql_fetch_array($res)){

$good_name=$row['good_name'];
$good_description=$row['good_description'];
$good_price=$row['good_price'];
$good_image1=$row['good_image1'];
$good_image2=$row['good_image2'];
$good_image3=$row['good_image3'];
$good_category=$row['good_category'];
$good_id=$row['good_id'];

//вставка наименования, описания и т.д.
$query_in="INSERT INTO jos_virtuemart_products_ru_ru (product_s_desc,product_desc,product_name) VALUES ('$good_description','$good_description','$good_name')";
$res_in=mysql_query($query_in);

if($res_in==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$last_id = mysql_result(mysql_query("SELECT MAX(id) FROM jos_virtuemart"),0);



//вставка ценника
$query_in2="INSERT INTO jos_virtuemart_product_prices (virtuemart_product_id,product_price) VALUES ('$last_id','$good_price')";
$res_in2=mysql_query($query_in2);

if($res_in2==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
//вставка категории
$query2="SELECT * FROM jos_virtuemart_categories_ru_ru WHERE category_name='$good_category'";
$res_2=mysql_query($query2);
$category_id=mysql_result($res_2,0);





$query_in3="INSERT INTO jos_virtuemart_product_categories (virtuemart_product_id,virtuemart_category_id) VALUES ('$last_id','$category_id')";
$res_in3=mysql_query($query_in3);

if($res_in3==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
									


//$good_image1=$row['good_image1'];
//$good_image2=$row['good_image2'];
//$good_image3=$row['good_image3'];

if($good_image1!=NULL){

$query_img1="INSERT INTO jos_virtuemart_product_medias (virtuemart_product_id) VALUES ('$last_id')";
$res_img1=mysql_query($query_img1);

if($res_img1==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$media1 = mysql_result(mysql_query("SELECT MAX(virtuemart_media_id) FROM jos_virtuemart_product_medias"),0);
			

$query_img1="INSERT INTO jos_virtuemart_medias (virtuemart_media_id, file_url) VALUES ('$media1','$good_image1')";
$res_img1=mysql_query($query_img1);

if($res_img1==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }




}
if($good_image2!=NULL){

$query_img2="INSERT INTO jos_virtuemart_product_medias (virtuemart_product_id) VALUES ('$last_id')";
$res_img2=mysql_query($query_img2);

if($res_img2==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$media2 = mysql_result(mysql_query("SELECT MAX(virtuemart_media_id) FROM jos_virtuemart_product_medias"),0);
			

$query_img2="INSERT INTO jos_virtuemart_medias (virtuemart_media_id, file_url) VALUES ('$media2','$good_image2')";
$res_img2=mysql_query($query_img2);

if($res_img2==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }




}

if($good_image3!=NULL){

$query_img3="INSERT INTO jos_virtuemart_product_medias (virtuemart_product_id) VALUES ('$last_id')";
$res_img3=mysql_query($query_img3);

if($res_img3==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
$media3 = mysql_result(mysql_query("SELECT MAX(virtuemart_media_id) FROM jos_virtuemart_product_medias"),0);
	
	
$query_img3="INSERT INTO jos_virtuemart_medias (virtuemart_media_id, file_url) VALUES ('$media3','$good_image3')";
$res_img3=mysql_query($query_img3);

if($res_img3==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

	
		


}








//установка moderation=3 в базе - доноре.
//good_id
$query_upd="UPDATE p_goods SET moderation='3' WHERE good_id='$good_id'";
$res_upd=mysql_query($query_upd);

if($res_upd==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }








}




$query3="SELECT * FROM p_goods WHERE moderation='4'";
$res3=mysql_query($query3);




while($row3=mysql_fetch_array($res3)){

$good_name=$row['good_name'];


$query4="SELECT * FROM jos_virtuemart_products_ru_ru WHERE product_name='$good_name'";
$res_4=mysql_query($query4);
//id продукта, который нужно удалить
$product_id=mysql_result($res_4,0);


$query_delete1="DELETE FROM jos_virtuemart_products_ru_ru WHERE virtuemart_product_id='$product_id'";
$res_delete1=mysql_query($query_delete1);

if($res_delete1==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
					
$query_delete2="DELETE FROM jos_virtuemart_product_categories WHERE virtuemart_product_id='$product_id'";
$res_delete2=mysql_query($query_delete2);

if($res_delete2==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }



$query_delete3="DELETE FROM jos_virtuemart_product_prices WHERE virtuemart_product_id='$product_id'";
$res_delete3=mysql_query($query_delete3);

if($res_delete3==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
					
									
					


	
}




?>