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


//
$res=red("SELECT * FROM ad_goods WHERE id='".$_POST['good_id']."'");
$type=$res[0]['type'];
$ves=$res[0]['weight'];
$count=round($res[0]['packCntByCount']);

$res=red("SELECT * FROM ad_goods2colors WHERE good_id='".$_POST['good_id']."'");
$color_id=$res[0]['color_id'];
$res=red("SELECT * FROM ad_colors WHERE id='".$color_id."'");
$color=$res[0]['title'];

$res=red("SELECT * FROM ad_goods2styles WHERE good_id='".$_POST['good_id']."'");
$style_id=$res[0]['style_id'];
$res=red("SELECT * FROM ad_styles WHERE id='".$style_id."'");
$style=$res[0]['title'];




unset($mas);
$mas[0]=iconv("windows-1251", "UTF-8", $type);
//$mas[0]=$type;

$mas[1]=iconv("windows-1251", "UTF-8", $color);
//$mas[1]=$color;

$mas[2]=iconv("windows-1251", "UTF-8", $style);
//$mas[2]=$style;

$mas[3]=iconv("windows-1251", "UTF-8", $ves);
//$mas[3]=$ves;

$mas[4]=iconv("windows-1251", "UTF-8", $count);
//$mas[4]=$count;

echo json_encode($mas);


?>