<?php



####��������� ��������� ���� ������######
include "db_conf.php";
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





$id_collection=$_POST['id_collection'];
$id_session=$_POST['id_session'];
$collection_m[]=$id_collection;

$res=red("SELECT * FROM ad_basket WHERE session_id='".$id_session."'");
if(count($res)==0){
	//echo"0";
	$res=query("INSERT INTO ad_basket (session_id,collections) VALUES ('".$id_session."','".serialize($collection_m)."')");	
}else{
	//echo"1";
	$collections=$res[0]['collections'];
	$collections=unserialize($collections);
	//var_dump($collections);
	
	if(is_array($collections)){
		$collections[]=$id_collection;
	}else{
		$collections2[]=$collections;
		$collections2[]=$id_collection;
		$collections=$collections2;
	}
	
	//var_dump($collections);
   // echo $collections[1];
//	$collections[]=$id_collection;


	$collections=serialize($collections);
	$res=query("UPDATE ad_basket SET collections='".$collections."' WHERE session_id='".$id_session."' ");
};



$res=red("SELECT * FROM ad_basket WHERE session_id='".$id_session."'");
//var_dump($res);
$collections=$res[0]['collections'];
//var_dump($collections);

$collections=unserialize($collections);
$count_collections=count($collections);



$res=red("SELECT * FROM ad_basket_goods WHERE session_id='".$id_session."'");
//var_dump($res);
$goods=$res[0]['goods'];
//var_dump($collections);

$goods=unserialize($goods);
$count_goods=count($goods);





echo $count_goods + $count_collections;

?>