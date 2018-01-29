<?php
header('Content-type: text/html; charset=utf-8');
require '../../config/config.php';
session_start();

if((!isset($_SESSION["price_user"]))||($_SESSION["price_user"]=="")||($_SESSION["price_user"]==NULL))
{
echo'
<script type="text/javascript">
window.location.href="/admin/login.php";
</script>
';
exit;
}

$number=$_POST["number"];

$number=addslashes($number);
$number = strip_tags($number);
$number = htmlspecialchars($number);
$number = mysql_escape_string($number);

$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("Невозможно соединиться с MySQL сервером!");
mysql_query("set character_set_results='utf8'");
mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");  
mysql_select_db(DB_BASE)or die("Невозможно подключиться к базе!");
mysql_query("SET NAMES utf8");

$query="SELECT * FROM price_content WHERE number='".$number."'";
$res = mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row=mysql_fetch_array($res);

$text_result=$row['text'];

if($row['type']=="head"){
$text_result=str_replace("h1_".$number, "h1_".($number-1), $text_result);
}else{
$text_result=str_replace("p_".$number, "p_".($number-1), $text_result);
$text_result=str_replace("span_".$number, "span_".($number-1), $text_result);
}

$id1=$row['id'];


$query_2="SELECT * FROM price_content WHERE number='".($number-1)."'";
$res_2 = mysql_query($query_2);

if($res_2==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
$row_2=mysql_fetch_array($res_2);
$id2=$row_2['id'];



$query="UPDATE price_content SET number='".($number-1)."', text='".$text_result."' WHERE id='".$id1."'";
$res = mysql_query($query);
if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }


$query3="SELECT * FROM price_content WHERE id='".($id2)."'";
$res3 = mysql_query($query3);

if($res3==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row3=mysql_fetch_array($res3);

$text_result2=$row3['text'];

if($row3['type']=="head"){
$text_result2=str_replace("h1_".($number-1), "h1_".($number), $text_result2);
}else{
$text_result2=str_replace("p_".($number-1), "p_".($number), $text_result2);
$text_result2=str_replace("span_".($number-1), "span_".($number), $text_result2);
}

$query3="UPDATE price_content SET number='".($number)."', text='".$text_result2."' WHERE id='".$id2."'";
$res3 = mysql_query($query3);
if($res3==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }




$query_final="SELECT * FROM price_content ORDER BY number ASC";
$res_final = mysql_query($query_final);

if($res_final==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$text_final="";
while($row_final=mysql_fetch_array($res_final)){
$number_final=$row_final['number'];
if($row_final['type']=="head"){ $buttons_text_final='<input type="button" value="Изменить заголовок" onclick="edit_h1(\''.$number_final.'\');">
<input type="button" value="Выше" onclick="move_up(\''.$number_final.'\');">
<input type="button" value="Ниже" onclick="move_down(\''.$number_final.'\');">
<input type="button" value="Удалить" onclick="delete_1(\''.$number_final.'\');">
  '; }
else{ $buttons_text_final='<input type="button" value="Изменить надпись" onclick="edit_p(\''.$number_final.'\');">
<input type="button" value="Изменить цену" onclick="edit_span(\''.$number_final.'\');">
<input type="button" value="Выше" onclick="move_up(\''.$number_final.'\');">
<input type="button" value="Ниже" onclick="move_down(\''.$number_final.'\');">
<input type="button" value="Удалить" onclick="delete_1(\''.$number_final.'\');">
  '; }


$text_final=$text_final.'<div style="padding:3px; border:1px #269acd solid;">'.$row_final['text'].$buttons_text_final.'</div>';

}


echo $text_final;

/*
$query="UPDATE price_content SET number='".($number-1)."', text='".$text_result."' WHERE number='".$number."'";
$res = mysql_query($query);
if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
*/



/*
$query="UPDATE price_content SET number='".($number)."' WHERE number='".($number-1)."'";
$res = mysql_query($query);
if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
*/




//echo $insert_text."{total}".($total+1); 


//echo $insert_text;

/*
$query="SELECT * FROM price_content WHERE number='".$n."'";
$res = mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row=mysql_fetch_array($res);

$new_text_result=$row['text'];

//echo $new_text_result;

$new_text_result=preg_replace("#\">(.+?)</h1>#is", "\">".$new_text."</h1>",$new_text_result); 

$query="UPDATE price_content SET text='".$new_text_result."'  WHERE number='".$n."'";
$res = mysql_query($query);
if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

echo $new_text; 

//$new_text_result=str_replace("",,$new_text_result);
*/


?>

