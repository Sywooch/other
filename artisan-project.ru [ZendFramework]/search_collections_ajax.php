<?php
session_start();
//$this->app->session->start();
//echo $_SESSION['start_collection']."--";
//echo "<pre>";
//print_r($_COOKIE);
//echo "</pre>";


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

//echo $_SESSION['start_collection']."=";
//if($_SESSION['start_collection']!=0){
//	$_SESSION['start_collection']=$_SESSION['start_collection']+1;
//}
		
$price_min=$_POST['price_min'];
$price_max=$_POST['price_max'];
$factories=$_POST['factories'];
$based_sizes=$_POST['based_sizes'];
$purposes=$_POST['purposes'];
$materials=$_POST['materials'];
$surfaces=$_POST['surfaces'];
$styles=$_POST['styles'];
$colors=$_POST['colors'];


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

//if($this->app->session->get('start_collection')!=0){
//	$tmp_s=$this->app->session->get('start_collection');
//	$tmp_s--;
//	$this->app->session->set('start_collection', $tmp_s);
	//$_SESSION['start_collection']=$_SESSION['start_collection']-1;
		
//};
//echo $this->app->session->get('start_collection')."--";

$start_number2=($start_number-1)*30;
//echo $start_number."+".$start_number2."+";
		$search_collections="";
		unset($search_collections_m);
		//echo str_replace(":",",",$_POST['factories'])."-----";
		
		$request_uri=$_POST['url'];
		//echo $request_uri."-";
		
		if(strpos($request_uri, "cat/sale")!=false){
			if($_POST['factories']==""){
				$res=red("SELECT * FROM ad_collections WHERE sale='yes' AND hidden='no' ORDER BY title LIMIT ".($_SESSION['start_collection']).", 200 ");				
			}else{
				$res=red("SELECT * FROM ad_collections WHERE sale='yes' AND hidden='no' AND factory_id IN (".rtrim(str_replace(":",",",$_POST['factories']),",").") ORDER BY title LIMIT ".($_SESSION['start_collection']).", 200 ");
			}
		}else if(strpos($request_uri, "cat/novice")!=false){
			if($_POST['factories']==""){
				$res=red("SELECT * FROM ad_collections WHERE novice='yes' AND hidden='no' ORDER BY title LIMIT ".($_SESSION['start_collection']).", 200 ");
			}else{
				$res=red("SELECT * FROM ad_collections WHERE novice='yes' AND hidden='no' AND factory_id IN (".rtrim(str_replace(":",",",$_POST['factories']),",").") ORDER BY title LIMIT ".($_SESSION['start_collection']).", 200 ");
			}
		}else if(strpos($request_uri, "cat/action")!=false){
			if($_POST['factories']==""){
				$res=red("SELECT * FROM ad_collections WHERE action='yes' AND hidden='no' ORDER BY title LIMIT ".($_SESSION['start_collection']).", 200 ");
			}else{
				$res=red("SELECT * FROM ad_collections WHERE action='yes' AND hidden='no' AND factory_id IN (".rtrim(str_replace(":",",",$_POST['factories']),",").") ORDER BY title LIMIT ".($_SESSION['start_collection']).",200 ");
			}
		}else if(strpos($request_uri, "cat/type")!=false){
			if($_POST['factories']==""){
				$res=red("SELECT * FROM ad_collections WHERE hidden='no' ORDER BY title LIMIT ".($_SESSION['start_collection']).", 1000 ");
			}else{		
				$res=red("SELECT * FROM ad_collections WHERE hidden='no' AND factory_id IN (".rtrim(str_replace(":",",",$_POST['factories']),",").") ORDER BY title LIMIT ".($_SESSION['start_collection']).", 1000 ");
			}
		//echo "+++";
		}else{
			if($_POST['factories']==""){
				$res=red("SELECT * FROM ad_collections WHERE hidden='no' ORDER BY title LIMIT ".($_SESSION['start_collection']).", 200 ");
			}else{			
				$res=red("SELECT * FROM ad_collections WHERE hidden='no' AND factory_id IN (".rtrim(str_replace(":",",",$_POST['factories']),",").") ORDER BY title LIMIT ".($_SESSION['start_collection']).", 200 ");
			}
		}
		
		//echo count($res)."=";
		//".$_SESSION['start_collection']."
		
		//".str_replace(":",",",$_POST['factories'])."
		// LIMIT ".($start_number2).",1000
		//ORDER BY title='ASC'
		
		//echo count($res);
		$i_global=1;
		$i_global2=$_SESSION['start_collection'];
		$_SESSION['start_collection_prev']=$_SESSION['start_collection'];
		foreach($res as $r) {	
		//echo "=";		
			
		//print_r($based_sizes_collection);			
		//foreach($tmp as $value) {
			
			//echo "++".print_r($based_sizes_collection)."++<br>";
			//echo "-".$value["id"]."-";
			
			$factory_id=$r['factory_id'];//идентификатор фабрики
			//echo "=factory=".$factory_id."=";
			
			//получить наименование фабрики и ссылку на неё
			$res2=red("SELECT * FROM ad_factories WHERE id='".$factory_id."' ");
			$factory_name=$res2[0]['title'];
			$factory_url=$res2[0]['url'];
			$country_id=$res2[0]['country_id'];
			
			//получить наименование страны и ссылку на неё
			$res2=red("SELECT * FROM ad_countries WHERE id='".$country_id."' ");
			$country_name=$res2[0]['import_title'];
			$country_url=$res2[0]['url'];
			
			
			
			$res2=red("SELECT * FROM ad_goods WHERE hidden='no' AND collection_id='".$r['id']."' ORDER BY id='DESC'");
			unset($tmp_prices);
			foreach($res2 as $r2) {
				$res3=red("SELECT * FROM ad_prices2goods WHERE good_id='".$r2["id"]."' AND price_id=1");
				foreach($res3 as $r3) {
					$tmp_prices[]=$r3['price'];
					
				}
			}
			
			//foreach($tmp_prices as $v){
			//	echo $v."|";			
			//}
		
			//сортировка по возрастанию цены
			sort($tmp_prices);
			$price="".$tmp_prices[0].""; //цена коллекции
			//$price="\u041E\u0442 ";
			
			unset($based_size);
			$res2=red("SELECT * FROM ad_based_sizes2collections WHERE collection_id='".$r['id']."'");
			//$based_size=$res2[0]['based_size_id']; //идентфикатор базового размера
			foreach($res2 as $v){
				$based_size[]=$v['based_size_id']; //идентфикатор базового размера
			}
			


			unset($purpose);
			$res2=red("SELECT * FROM ad_collections2purposes WHERE collection_id='".$r['id']."'");
			foreach($res2 as $v){
				$purpose[]=$v['purpose_id']; //идентфикатор назначения
			}
			
			unset($material);
			$res2=red("SELECT * FROM ad_collections2materials WHERE collection_id='".$r['id']."'");
			foreach($res2 as $v){
				$material[]=$v['material_id']; //идентфикатор материала
			}
			
			unset($surface);
			$res2=red("SELECT * FROM ad_collections2surfaces WHERE collection_id='".$r['id']."'");
			foreach($res2 as $v){
				$surface[]=$v['surface_id']; //идентфикатор поверхности
			}
			
			unset($style);
			$res2=red("SELECT * FROM ad_collections2styles WHERE collection_id='".$r['id']."'");
			foreach($res2 as $v){
				$style[]=$v['style_id']; //идентфикатор стиля
			}
			
			unset($color);
			$res2=red("SELECT * FROM ad_collections2colors WHERE collection_id='".$r['id']."'");
			foreach($res2 as $v){
				$color[]=$v['color_id']; //идентфикатор цвета
			}
			

			
			
			
			//$log1=1;
			$log2=1; $log3=1; $log4=1; $log5=1; $log6=1; $log7=1; $log8=1;
			/*if($_POST['factories']!=""){
				$factories_m=explode(":",$_POST['factories']);
				$log_tmp=0;
				for($i=0;$i<count($factories_m);$i++){
					if($factory_id==$factories_m[$i]){
						$log1=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log1=0; }
				
			}
			*/
			
			
			
			if(($price>=$_POST['price_min'])&&($price<=$_POST['price_max'])){
				$log2=1;
			}else{
				$log2=0;	
			}
			
			
			if($_POST['based_sizes']!=""){
				$based_sizes_m=explode(":",$_POST['based_sizes']);
				$log_tmp=0;
				for($i=0;$i<count($based_sizes_m);$i++){
					//if($based_size==$based_sizes_m[$i]){
					if(in_array($based_sizes_m[$i],$based_size)){
						$log3=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log3=0; }
				
			}
			
			
			
			
			
			
			
			if($_POST['purposes']!=""){
				$purposes_m=explode(":",$_POST['purposes']);
				$log_tmp=0;
				for($i=0;$i<count($purposes_m);$i++){
					//if($purpose==$purposes_m[$i]){
					if(in_array($purposes_m[$i],$purpose)){
						$log4=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log4=0; }
				
			}
			
			
			if($_POST['materials']!=""){
				$materials_m=explode(":",$_POST['materials']);
				$log_tmp=0;
				for($i=0;$i<count($materials_m);$i++){
					//if($material==$materials_m[$i]){
					if(in_array($materials_m[$i],$material)){
						$log5=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log5=0; }
				
			}
			
			if($_POST['surfaces']!=""){
				$surfaces_m=explode(":",$_POST['surfaces']);
				$log_tmp=0;
				for($i=0;$i<count($surfaces_m);$i++){
					//if($surface==$surfaces_m[$i]){
					if(in_array($surfaces_m[$i],$surface)){	
						$log6=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log6=0; }
				
			}
			
			if($_POST['styles']!=""){
				$styles_m=explode(":",$_POST['styles']);
				$log_tmp=0;
				for($i=0;$i<count($styles_m);$i++){
					//if($style==$styles_m[$i]){
					if(in_array($styles_m[$i],$style)){		
						$log7=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log7=0; }
				
			}
			
			
			if($_POST['colors']!=""){
				$colors_m=explode(":",$_POST['colors']);
				$log_tmp=0;
				for($i=0;$i<count($colors_m);$i++){
					//if($color==$colors_m[$i]){
					  if(in_array($colors_m[$i],$color)){		
						$log8=1; $log_tmp=1; break;	
					}
				}
				if($log_tmp==0){ $log8=0; }
				
			}
			
			
			
			
			
			
			
			
			
			
			//($log1==1)&&
			if(($log2==1)&&($log3==1)&&($log4==1)&&($log5==1)&&($log6==1)&&($log7==1)&&($log8==1)){
				//echo "--".$country_name;
				$search_collections_m[$i_global-1]='
				
				<div class="col-sm-6 col-md-4">
                    <div class="catalog_item">
                        <a href="/cat/id/'.$r['id'].'">
                           <div class="catalog_image">
                               <img src="'.str_replace("[dir]","original",$r['image']).'">
                           </div>
                           <div class="catalog_item_name">'.$r['title'].'</div>
                        </a>

                        <div class="catalog_item_manuf">
                             <a href="/cat/'.$factory_url.'">'.$factory_name.'</a> / 
                             <a href="/cat/country/'.$country_url.'"> '.$country_name.'</a>
                        </div>
                        <div class="catalog_item_price">
                             <span>'.$price.'</span>
                             <i></i>
                        </div>
                    </div>
                 </div>
						';
						
					
				if(($i_global%3==0)&&($i_global!=0)||($i_global==3)){ 
					
				$search_collections_m[$i_global-1]=$search_collections_m[$i_global-1].'
                <div style="clear:both;"></div>';
						
                }
				if($i_global>=30){ $_SESSION['start_collection']=$i_global2; break; }; 
				$i_global++;
				
				//if($i_global>($start_number2+30)){ break; } 		
			}
			
			
		//}
		
		$i_global2++;
		}
		
		
		//for($i=$start_number2;$i<($start_number2+30);$i++){
		foreach($search_collections_m as $val){	
			$search_collections=$search_collections.$val;	
			
		}
		
		
		if($_SESSION['start_collection_prev'] == $_SESSION['start_collection']){
			$search_collections=$search_collections.'<style type="text/css">.moreBtns{ display:none; }</style>';	
			
		}
		
		
		
		echo $search_collections;
		//echo convert_encoding($search_collections, 'cp1251', detect_encoding($search_collections));
		
	
?>