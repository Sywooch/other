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

$new_text=$_POST["new_text"];

$new_text=addslashes($new_text);
$new_text = strip_tags($new_text);
$new_text = htmlspecialchars($new_text);
$new_text = mysql_escape_string($new_text);


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
//echo $total;

$insert_text='<h1 id="h1_'.($total+1).'">'.$new_text.'</h1>';

$query="INSERT INTO price_content (text, number, type) VALUES ('".$insert_text."','".($total+1)."', 'head')";
$res = mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }


echo $insert_text."{total}".($total+1); 

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

