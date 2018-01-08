<?
####насторйки локальной базы данных######
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
## соеденяемся с базой################
mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);
mysql_query("SET CHARACTER SET 'utf8'");
###функция для выполнения любого запроса##
function query($query){$result = mysql_query($query);}
function red($query){$result = mysql_query($query);	mysql_error();	$c=array();for($i=0;$i<mysql_num_fields($result);$i++) { $param=mysql_fetch_field($result);  $c['mas'][$i]= "$param->name";}$cats=array();$results = mysql_query($query);$cs=0;while ($row = mysql_fetch_assoc($results)) {	for($d=0;$d<count($c['mas']);$d++){	$cats[$cs][$c["mas"][$d]]= $row[$c['mas'][$d]];}$cs++;}return $cats;}
############################################
function get_file(){
	$img_path = $_SERVER['DOCUMENT_ROOT'] . '/console/data/';
	foreach(glob($img_path . 'Nakl_****.csv') as $file) {$FileName[] = $file;}
	//print_r($FileName);
	return $FileName[(count($FileName)-1)];
}

$lines = file(get_file());
foreach ($lines as $line_num => $line) {
  if($line_num!=0){
	 $ss_arr=explode(";", str_replace('"',"",$line));
		$ss_arr['2']=iconv('CP1251','UTF-8',$ss_arr['2']);
		$ss_arr['6']=iconv('CP1251','UTF-8',$ss_arr['6']);
	 $sse=red("SELECT * FROM as_recuue WHERE PodrId='".$ss_arr['0']."' AND	NaklID='".$ss_arr['1']."' AND	NakNom='".$ss_arr['2']."' AND TovId='".$ss_arr['4']."'");
	 if(is_array($sse) && count($sse)>0){
		 
		 query("UPDATE as_recuue SET NakDT='".$ss_arr['3']."',  kod='".$ss_arr['5']."',  Tovar='".$ss_arr['6']."',  kolvo='".$ss_arr['7']."', 	cena='".$ss_arr['8']."', WHERE PodrId='".$ss_arr['0']."' AND	NaklID='".$ss_arr['1']."' AND	NakNom='".$ss_arr['2']."' AND TovId='".$ss_arr['4']."'");
	 }else{
		 query("INSERT INTO as_recuue VALUES ('".$ss_arr['0']."', '".$ss_arr['1']."', '".$ss_arr['2']."', '".$ss_arr['3']."', '".$ss_arr['4']."', '".$ss_arr['5']."', '".$ss_arr['6']."', '".$ss_arr['7']."', '".$ss_arr['8']."')");
		 
	 }
	  
  }
}
// query("INSERT INTO as_recuue VALUES ('1', '1', '1', '1', '1', '1', '1', '1', '1')");

?>
