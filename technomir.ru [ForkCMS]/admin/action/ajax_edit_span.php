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

$n=$_POST["n"];
$new_text=$_POST["new_text"];

$n=addslashes($n);
$n = strip_tags($n);
$n = htmlspecialchars($n);
$n = mysql_escape_string($n);
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
$query="SELECT * FROM price_content WHERE number='".$n."'";
$res = mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$row=mysql_fetch_array($res);

$new_text_result=$row['text'];


$new_text_result=preg_replace("#\" class=\"price\">(.+?)</span></p#is", "\" class=\"price\">".$new_text."</span></p",$new_text_result); 

$new_text_result=preg_replace("#\" value=\"(.+?)\" onchange=#is", "\" value=\"".$new_text."\" onchange=",$new_text_result); 


//echo $new_text_result;

$query="UPDATE price_content SET text='".$new_text_result."'  WHERE number='".$n."'";
$res = mysql_query($query);
if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

echo $new_text; 

//$new_text_result=str_replace("",,$new_text_result);

?>

