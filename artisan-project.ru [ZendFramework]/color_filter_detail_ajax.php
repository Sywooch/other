<?php

session_start();

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


$purpose_id=$_POST['purpose_id'];
$collection_id=$_POST['collection_id'];
$param_colors=$_POST['param_colors'];

$param_colors=trim($param_colors,":");

if($param_colors==""){
	
exit;	
};


//получить наименование назначения
$res1=red("SELECT * FROM ad_purposes WHERE id='".$purpose_id."' ");
$purpose_name=$res1[0]["detail_title"];

$param_colors=str_replace(":",",",$param_colors);
$cnt=1;
$html='<div class="row row_catalog_front">';
$res=red("SELECT * FROM ad_goods WHERE collection_id='".$collection_id."' ");
foreach($res as $v){

	$res2=red("SELECT * FROM ad_goods2purposes WHERE purpose_id='".$purpose_id."' AND good_id='".$v['id']."' ");
	if(count($res2)==0){
		continue;	
	}
	
	$res2=red("SELECT * FROM ad_goods2colors WHERE color_id IN (".$param_colors.") AND good_id='".$v['id']."' ");
	if(count($res2)==0){
		continue;	
	}
	
	//
	//echo "<pre>";
	//print_r($v);
	//echo "</pre>";
	
	
	//получение ценника
	$res2=red("SELECT * FROM ad_prices2goods WHERE good_id='".$v['id']."' AND price_id='1' ");
	$price=$res2[0]['price'];
	
	
	
	
	
	//получить наименование назначения
	$purpose_name="";

	$res1=red("SELECT * FROM ad_goods2purposes WHERE good_id='".$v['id']."' ");
	$cnt2=0;
	foreach($res1 as $v2){
	
		$res2=red("SELECT * FROM ad_purposes WHERE id='".$v2['purpose_id']."' ");
		if($res2[0]['detail_title']==""){ continue; };
		$name=$res2[0]['detail_title'];
		if($cnt2==0){
			$purpose_name=$purpose_name."".'<a href="/cat/type/purpose/'.$v2['purpose_id'].'">'.$name.'</a>';
		}else{
			$purpose_name=$purpose_name.", ".'<a href="/cat/type/purpose/'.$v2['purpose_id'].'">'.$name.'</a>';
		}
		$cnt2++;
	}

	
	
	
	
	$html=$html.'
	<div class="col-sm-6 col-md-3">
                                    <div class="catalog_item" data-id="'.$v['id'].'">
                                        <a href="#plitka1_img_zoom" class="fancybox">
                                            <div class="catalog_image">
                                               <img src="'.str_replace("[dir]","original",$v['photo']).'">
                                            </div>
                                        </a>

                                        <div class="product_item_articul">Артикул: '.$v['art'].'</div>
                                        
                                        <div class="catalog_item_name"><a href="#">'.iconv("windows-1251", "UTF-8", $v['title']).'</a></div>

                                        <div class="produc_item_dop">
                                            '.$v['size'].' /<br> 
                                            <a href="#">'.iconv("windows-1251", "UTF-8", $purpose_name).'</a>
                                        </div>

                                        <div class="catalog_item_price">
                                            <span>От '.$price.' Р</span>
                                            <i></i>
                                        </div>

                                        <div class="product_sell">';
    									
										$cart_tmp=0;
										$res3=red("SELECT * FROM ad_basket_goods WHERE session_id='".$_POST['session_id']."' ");
                                        $session=unserialize($res3[0]['goods']);
										
										    foreach($session as $val2){
                                            	if($val2==$v['id']){ $cart_tmp=1; break; }
                                            }
                                            
                                            if($cart_tmp==1){
                                            
                                            $html=$html.'<span class="blue underline">В корзине</span>';
                                            
											}else{
                                            
                                            $html=$html.'<div class="get_order dropdown">
                                                <button type="button" class="close-sm"></button>
                                                <div class="form row">
                                                    <div class="col-xs-8 get_order-num_wrapp"><input type="text" class="get_order-num"></div>
                                                    <div class="col-xs-4 get_order-num_type">шт.</div>
                                                </div>
                                                <a href="#plitka1" class="get_order-btn">Заказать</a>
                                            </div>';
                                        	
											}
                                            	
											                                        
                                        
                                        $html=$html.'</div>
                                    </div>
                                </div>
	';
	if(($cnt%4==0) && ($cnt!=0)){
    
		$html=$html.'</div>
             <div class="row row_catalog_front">
             ';
			 
    }
	
	$cnt++;
	
	
	
}


$html=$html.'</div>
<div class="catalog_meta_container">
                                <div class="row">
                                    <div class="col-xs-12 text-left">
                                        <span class="reccomend">На товарах указаны рекомендованные розничные цены</span>
                                    </div>
                                </div>
                            </div>
';


echo iconv("UTF-8", "windows-1251", $html);


?>