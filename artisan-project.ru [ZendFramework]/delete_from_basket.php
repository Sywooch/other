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





$id=$_POST['id'];
$type=$_POST['type'];
$session=$_POST['session'];

if($type=="collection"){
	$res=red("SELECT * FROM ad_basket WHERE session_id='".$session."'");	
	$collections=$res[0]['collections'];
	$collections=unserialize($collections);
	
	
	if(($key = array_search($id,$collections)) !== false){
     unset($collections[$key]);
	}

	
	
	
	
	$collections=serialize($collections);
	$res=query("UPDATE ad_basket SET collections='".$collections."' WHERE session_id='".$session."'");
	
	
}else{

	$res=red("SELECT * FROM ad_basket_goods WHERE session_id='".$session."'");	
	$goods=$res[0]['goods'];
	$goods=unserialize($goods);

	

	if(($key = array_search($id,$goods)) !== false){
     unset($goods[$key]);
	}
	
	$goods=serialize($goods);
	$res=query("UPDATE ad_basket_goods SET goods='".$goods."' WHERE session_id='".$session."'");
	
	
	
}

?>