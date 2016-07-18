<?php
//ini_set ("session.use_trans_sid", true);
session_start();

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

session_id($_POST['session_id']);
//$_COOKIE['PHPSESSID']=$_POST['session_id'];
$_SESSION["n"]=1;
//echo $_SESSION["n"]." -- ".session_id()." -- ".$_COOKIE['PHPSESSID'];

$good_id=$_POST['good_id'];
$count=$_POST['count'];

$id_session=$_POST['session_id'];
$good_m[]=$good_id;
$count_m[]=$count;


$res=red("SELECT * FROM ad_basket_goods WHERE session_id='".$id_session."'");
if(count($res)==0){
	//echo"0";
	$res=query("INSERT INTO ad_basket_goods (session_id,goods,counts) VALUES ('".$id_session."','".serialize($good_m)."','".serialize($count_m)."')");	
}else{
	//echo"1";
	$goods=$res[0]['goods'];
	$counts=$res[0]['counts'];
	
	$goods=unserialize($goods);
	$counts=unserialize($counts);
	//var_dump($collections);
	
	if(is_array($goods)){
		$goods[]=$good_id;
		$counts[]=$count;
		
	}else{
		$goods2[]=$goods;
		$counts2[]=$counts;
		
		$goods2[]=$good_id;
		$counts2[]=$count;
		
		$goods=$goods2;
		$counts=$counts2;
		
	}
	
	//var_dump($collections);
   // echo $collections[1];
//	$collections[]=$id_collection;


	$goods=serialize($goods);
	$counts=serialize($counts);
	
	$res=query("UPDATE ad_basket_goods SET goods='".$goods."', counts='".$counts."' WHERE session_id='".$id_session."' ");
};



$res=red("SELECT * FROM ad_basket_goods WHERE session_id='".$id_session."'");
//var_dump($res);
$goods=$res[0]['goods'];
//var_dump($collections);

$goods=unserialize($goods);
$count_goods=count($goods);

$res=red("SELECT * FROM ad_basket WHERE session_id='".$id_session."'");
//var_dump($res);
$collections=$res[0]['collections'];
//var_dump($collections);

$collections=unserialize($collections);

$count_collections=count($collections);


echo $count_goods + $count_collections;


session_write_close();
?>