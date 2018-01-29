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

$new_text_head=$_POST["new_text_head"];
$new_text_price=$_POST["new_text_price"];

$new_text_head=addslashes($new_text_head);
$new_text_head = strip_tags($new_text_head);
$new_text_head = htmlspecialchars($new_text_head);
$new_text_head = mysql_escape_string($new_text_head);
$new_text_price=addslashes($new_text_price);
$new_text_price = strip_tags($new_text_price);
$new_text_price = htmlspecialchars($new_text_price);
$new_text_price = mysql_escape_string($new_text_price);



$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("Невозможно соединиться с MySQL сервером!");
mysql_query("set character_set_results='utf8'");
mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");  
mysql_select_db(DB_BASE)or die("Невозможно подключиться к базе!");
mysql_query("SET NAMES utf8");

$res = mysql_query("SELECT COUNT(*) FROM price_content");
$row = mysql_fetch_row($res);
$total = $row[0];

$res2 = mysql_query("SELECT COUNT(*) FROM price_content WHERE type='input'");
$row2 = mysql_fetch_row($res2);
$total2 = $row2[0];

$insert_text='<p><span id="p_'.($total+1).'">'.$new_text_head.':</span> <input type="checkbox" id="r'.($total2+1).'" value="'.$new_text_price.'" onchange="summa();"/><span id="span_'.($total+1).'" class="price">'.$new_text_price.'</span></p>';


$query="INSERT INTO price_content (text, number, type) VALUES ('".$insert_text."','".($total+1)."', 'input')";
$res = mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }


echo $insert_text."{total}".($total+1); 


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

