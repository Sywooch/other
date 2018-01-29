<?php
header('Content-type: text/html; charset=utf-8');
require 'config/config.php';
session_start();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/css/style_price.css" />
</head>

<body style="margin:0; padding:0; border:0;">

<div class="price_block_1" align="center">

<div class="price_block_2" align="left">

<!------------------------------------------------->
<?php
$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS)or die("Невозможно соединиться с MySQL сервером!");
mysql_query("set character_set_results='utf8'");
mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");  
mysql_select_db(DB_BASE)or die("Невозможно подключиться к базе!");
mysql_query("SET NAMES utf8");
$query="SELECT * FROM price_content ORDER BY number ASC";
$res = mysql_query($query);

if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }

$input_count=0; //количество полей input

					
while($row=mysql_fetch_array($res)){

echo $row["text"];

$pos = strpos($row["text"], "<input");
	if ($pos === false) {
		
	}else{
		$input_count++;
	}

}
?>
<!------------------------------------------------->
<div align="center" style="width:100%; height:50px;"><strong>Итого:</strong><span id="itogo"></span> руб.</div>

</div>



<script type="text/javascript">
function summa(){

	sum=0;
	
	for(i=1;i<<?php echo ($input_count+1); ?>;i++){
		var elem=document.getElementById("r"+i);
		if(elem.checked)sum=sum+parseInt(elem.value);
	}

document.getElementById('itogo').innerHTML=sum;
}
</script>

</div>

</body>
</html>