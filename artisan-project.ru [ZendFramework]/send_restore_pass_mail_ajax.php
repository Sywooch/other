<?php


		
$email=$_POST['email'];


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


$res=red("SELECT * FROM ad_dealers WHERE mail='".$email."'");
echo count($res);


/*
function gel_elements($id){
	$res=red("SELECT * FROM ad_svyaz WHERE id_element='".$id."'");
	if(count($res)) {
	$end_result = '';
        foreach($res as $r) {
			$rss=red("SELECT * FROM ad_goods WHERE id = '".$r['data']."' LIMIT 1");
			$end_result.='<div ids="'.$r['data'].'" class="clasd">'.$rss[0]['title'].' ('.$rss[0]['art'].')<a class="del" href="javascript:void(0);"></a></div>';
		}
	}
	return $end_result;
}

if(isset($_POST['id']) && $_POST['id']!="" && isset($_POST['ellem']) && $_POST['ellem']!="" && isset($_POST['add']) && $_POST['add']=="add"){
	query("INSERT INTO ad_svyaz VALUES ('' , '".$_POST['id']."', '".$_POST['ellem']."')");
}	
if(isset($_POST['id']) && $_POST['id']!="" && isset($_POST['ellem']) && $_POST['ellem']!="" && isset($_POST['delet']) && $_POST['delet']=="delet"){
	query("DELETE FROM ad_svyaz WHERE id_element = '".$_POST['id']."' AND data='".$_POST['ellem']."'");
}




if(isset($_POST['search']) && $_POST['search']!=""){
header("Content-type: text/html; charset=windows-1251");
$row=red("SELECT * FROM ad_goods WHERE ftitle LIKE '%".trim(iconv("UTF-8", "windows-1251",$_POST['search']))."%' LIMIT 10");
//echo "SELECT * FROM ad_goods WHERE ftitle LIKE '%".trim($_POST['search'])."%'";
//print_r($row);
if(count($row)) {
        $end_result = '';
        foreach($row as $r) {
            $result         = $r['title'];
            $bold           = '<span class="found">' . $word . '</span>';
            $end_result     .= '<li class="userts" ids="'.$r['id'].'">' . $result . ' ('.$r['art'].')</li>';
        }
        echo $end_result;
    } else {
        echo '<li>�� ������ ������� ������ �� �������</li>';
    }

}else{
	
*/
	
?>