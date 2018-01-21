<?php



####��������� ��������� ���� ������######
$config_locale['HOST']="u305676.mysql.masterhost.ru";
$config_locale['DB']="u305676_apt";
$config_locale['USER']="u305676_aptest";
$config_locale['PASS']="6in_A5eddEn-";
#############################
define('DB_HOST', $config_locale['HOST']);
define('DB_NAME', $config_locale['DB']);
define('DB_USER', $config_locale['USER']);
define('DB_PASS', $config_locale['PASS']);
global $hide_file,$hide_base;
## ����������� � �����################
mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);
//mysql_query("SET CHARACTER SET 'utf8'");
###������� ��� ���������� ������ �������##
function query($query){$result = mysql_query($query);}
function red($query){$result = mysql_query($query);	mysql_error();	$c=array();for($i=0;$i<mysql_num_fields($result);$i++) { $param=mysql_fetch_field($result);  $c['mas'][$i]= "$param->name";}$cats=array();$results = mysql_query($query);$cs=0;while ($row = mysql_fetch_assoc($results)) {	for($d=0;$d<count($c['mas']);$d++){	$cats[$cs][$c["mas"][$d]]= $row[$c['mas'][$d]];}$cs++;}return $cats;}
############################################




$name=$_POST['name'];
$phone=$_POST['phone'];
$message=$_POST['message'];
$session=$_POST['session'];
$html=$_POST['html'];


$html=str_replace('class="cart-product_num"','class="cart-product_num" disabled',$html);
$html=str_replace('input type="text"','input type="text" disabled',$html);

$text="
Имя: ".$name."<br>
Телефон: ".$phone."<br>
Сообщение: ".$message."<br>
Детали заказа: 
<br>
".$html."
";

mail("gsu1234@mail.ru", "Новый заказ", $text, 
    'Content-type: text/html;' . "\r\n"."From: null@test.taki.su \r\n" 
    ."X-Mailer: PHP/" . phpversion());	
	
$res=query("DELETE FROM ad_basket WHERE session_id='".$session."'");	
$res=query("DELETE FROM ad_basket_goods WHERE session_id='".$session."'");	
	
echo "Ваш заказ принят. С вами свяжутся в ближайшее время.";
	
?>