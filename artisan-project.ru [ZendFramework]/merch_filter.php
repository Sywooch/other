<?php

session_start();

if(isset($_POST['unset_session'])&&($_POST['unset_session']=='1')){
unset($_SESSION['start_collection']);	
exit;
}

if($_POST['number1']=='1'){
unset($_SESSION['start_collection']);	
}

if(!isset($_SESSION['start_collection'])){
	$_SESSION['start_collection']=$_POST['start_number'];
};

$start_number=$_POST['start_number'];




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


$type=$_POST['type'];
$factory=$_POST['factory'];
$collection=$_POST['collection'];

//echo $type." - ".$factory." - ".$collection;
$start_number2=($start_number-1)*30;

$html='<div style="margin-top:20px;" class="merch_items__container"><div class="row">';


$res=red("SELECT * FROM ad_merchandising_elements WHERE hidden='no' LIMIT ".($_SESSION['start_collection']).", 1000  ");
$i_global=1;
$i_global2=$_SESSION['start_collection'];
$log_final=1;
foreach($res as $v){
	
	
	$log1=1; $log2=1; $log3=1;
	
	if($type != 'null'){
		
		$res1=red("SELECT * FROM ad_merchandising_elements2merchandising_types WHERE merchandising_element_id='".$v['id']."' AND merchandising_type_id='".$type."' ");
		
		if(count($res1)>0){ $log1=1; }else{ $log1=0; };
	}

	if($factory != 'null'){
	
		
		$res1=red("SELECT * FROM ad_merchandising_elements2factories WHERE merchandising_element_id='".$v['id']."' AND factory_id='".$factory."' ");
		if(count($res1)>0){ $log2=1; }else{ $log2=0; };
	
		
	}

	if($collection != 'null'){
	
		
		$res1=red("SELECT * FROM ad_merchandising_elements2collections WHERE merchandising_element_id='".$v['id']."' AND collection_id='".$collection."' ");
		if(count($res1)>0){ $log3=1; }else{ $log3=0; };
	
	
	}

	

	if(($log1==1) && ($log2==1) && ($log3==1)){
		
		$res0=red("SELECT * FROM ad_merchandising_elements2merchandising_types WHERE merchandising_element_id='".$v['id']."' ");
		//$type_id=$res0[0]['purpose_id'];
		//unset($type);
		$type_tmp="";
		$cnt=0;
		foreach($res0 as $v0){
			
			$tmp=red("SELECT * FROM ad_merchandising_types WHERE id='".$v0['merchandising_type_id']."' ");
			if($cnt==0){
				$type_tmp=$type_tmp.$tmp[0]['title'];
			}else{
				$type_tmp=$type_tmp.", ".$tmp[0]['title'];	
			}
			$cnt++;	
		}
		
		
		$type_name=iconv("windows-1251", "UTF-8", $type_tmp);
		$title=iconv("windows-1251", "UTF-8", $v['title']);
		$desc=iconv("windows-1251", "UTF-8", $v['desc']);
		
		
		$html=$html.'
		
		<div class="col-xs-6 col-sm-6 col-md-4">
                            <div class="merch_item__container">
                                <div class="merch_item_image">
                                    <a href="#">
                                        <img src="'.str_replace('[dir]','original',$v['image']).'">
                                    </a>
                                </div>
                                <div class="merch_item_1" style="height: 98px;">
                                    <span><b>Тип:</b> '.$type_name.'</span>
                                    <div>'.$title.'</div>
                                </div>
                                <div class="merch_item_2">
                                                 '.$desc.'                   </div>

                                <div class="merch_item__links clearfix">
                                    <a href="'.$v['file'].'" class="pdf_link">Cкачать</a>
                                    <a href="#"
									onclick="var m=window.open(\''.$v['file'].'\'); m.print(); return false;"
									 class="print_link">Распечатать</a>
                                </div>
                            </div>
                        </div>';
						//'.$v['file'].'  '.$v['desc'].' '.$v['title'].'  '.$type_name.'
						
						
	if($i_global>=30){ $_SESSION['start_collection']=$i_global2;  break; }; 
	$i_global++;	
	$log_final++;
	}


$i_global2++;

}



$html=$html."</div></div>";

if($log_final<30){
	$html=$html.'<style type="text/css">.innermerch_content_continer .pagination{ display:none; }</style>';	
	
}


echo iconv("UTF-8", "windows-1251", $html);



?>