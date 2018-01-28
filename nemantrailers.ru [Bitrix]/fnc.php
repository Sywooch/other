<?php
  function pr($a){?><pre><?print_r($a)?></pre><?}
  function ph($a){?><!-- ph <?print_r($a)?> --><?}
  function GetEl($id){CModule::IncludeModule('iblock');$r=CIBlockElement::GetByID($id);if($ar=$r->GetNext())return $ar;else return false;}
  function GetIb($id){CModule::IncludeModule('iblock');$r=CIBlock::GetByID($id);if($a=$r->Fetch())return $a;else return false;}
  function GetSect($id){CModule::IncludeModule('iblock');$r=CIBlockSection::GetByID($id);if($a=$r->GetNext())return $a;else return false;}
  function GetSectEx($id,$ib_id){CModule::IncludeModule('iblock');$ar_filter=array('IBLOCK_SECTION_ID'=>$id,'IBLOCK_ID'=>$ib_id);$r=CIBlockSection::GetList(array(),$ar_filter,true,array('UF_*'));if($ar=$r->GetNext()){return $ar;}return false;}
  function GetElEx($id){CModule::IncludeModule('iblock');$r=CIBlockElement::GetByID($id);if($ob=$r->GetNextElement()){$ar=$ob->GetFields();$pr=$ob->GetProperties();$ar['pr']=$pr;return $ar;}else return false;}
  function GetElListEx($o=false,$f=false,$m=1000){CModule::IncludeModule('iblock');$r=CIBlockElement::GetList($o,$f,false,array("nPageSize"=>$m),array());$ar=array();while($ob=$r->GetNextElement()){$a=$ob->GetFields();$a['pr']=$ob->GetProperties();$ar[]=$a;}return $ar;}
  if (!function_exists('mb_ucfirst') && function_exists('mb_substr')){function mb_ucfirst($string){$string = mb_ereg_replace("^[\ ]+","", $string);$string = mb_strtoupper(mb_substr($string, 0, 1, "UTF-8"), "UTF-8").mb_substr($string, 1, mb_strlen($string), "UTF-8" );return $string;}  }
  function br2nl($t){$t=str_replace("<br />","",$t);$t=str_replace("<br>","",$t);return $t;}
  function GetUs($id){$r=CUser::GetByID($id);return $r->Fetch();}
  function GetUsEm($e){$r=CUser::GetList(($by="timestamp_x"),($order="DESC"),Array('EMAIL'=>strtolower(trim($e))));if($a=$r->Fetch()) return $a;else return false;}
  function ins($file){global $APPLICATION; $APPLICATION->IncludeComponent("bitrix:main.include", ".default", array("AREA_FILE_SHOW" => "file","PATH" => SITE_DIR.$file,"EDIT_TEMPLATE" => ""),false);}
  function GetSectList($f,$s=array()){CModule::IncludeModule('iblock');$r=CIBlockSection::GetList($s,$f,false);$e=array();while($a=$r->GetNext()){$e[]=$a;}return $e;}
  function GetFormatPrice($p){$p=$p?$p:0;$d=intval($p%1000);while(strlen($d)<3)$d='0'.$d;return '<span>'.intval($p/1000).'</span>'.$d;}
  function TimeWork(){global $start_time;if($start_time){echo "-=";printf('%f',microtime(true)-$start_time);echo"=-";}$start_time=microtime(true);}
  function GetMaterials($ib_id,$max=99,$sort=Array('created'=>'DESC'),$add_filter=array(),$arSelect=array()){
    CModule::IncludeModule('iblock');
    $arFilter = Array("IBLOCK_ID"=>$ib_id,"ACTIVE_DATE"=>"Y",'ACTIVE'=>'Y');
    $arFilter = array_merge($add_filter,$arFilter);
    if($user_id) $arFilter['CREATED_BY']=$user_id;
    $res = CIBlockElement::GetList($sort,$arFilter,false,array("nPageSize"=>$max), $arSelect);
    $arr=array();
    while($ob=$res->GetNextElement()){
      $ar=$ob->GetFields();
      $ar['pr']=$ob->GetProperties();
      $arr[]=$ar;
    }
    return array('a'=>$arr,'r'=>$res);
  }

function get_main_bg(){
		  $text='';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(1,10,$sort,$add_filter); 
for($i=0;$i<count($arr['a']);$i++){
	$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"1921",'height'=>"956",'full'=>'y','mode'=>'mm');
	$img_small=GetImgByParam($param);
	
	
	$text.='<div style="background-image: url('.$img_small.')" class="slide"></div>';
	 }
	 $text.='';
	 return $text;
		
	}

	function get_servis(){
		  $text='<ol class="marker BG BG_blue -js">';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(5,20,$sort,$add_filter); 
for($i=0;$i<count($arr['a']);$i++){
	$text.=' <li class="-hide marker-'.($i+1).'">
              <div class="ins"><strong class="TL">'.$arr['a'][$i]['NAME'].'</strong>
                <div class="text">'.$arr['a'][$i]['PREVIEW_TEXT'].'</div>
              </div>
            </li>';
	 }
	 $text.='</ol>';
	 return $text;
		
	}
	
	
function get_map($id){
	$sort=Array('SORT'=>"ASC");
	$add_filter=array('ID'=>$id);
	$arr=GetMaterials(8,1,$sort,$add_filter); 
	return htmlspecialchars_decode($arr['a']['0']['pr']['shem']['VALUE']);
}	
	
	
	

function get_conts(){
	 $text='<div class="W W_accordion">
				<div class="header-acord">
					<strong class="TL">Представительства:</strong>
					<div class="contacts">
						<p>Бесплатно по всей России</p>
						<div class="phone"> 8 800 333 55 39</div>
					</div>
				</div>';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(8,10,$sort,$add_filter); 
for($i=0;$i<count($arr['a']);$i++){
	$text.='<div class="B accordeon-item '.$arr['a'][$i]['CODE'].'">
					<div class="acord-item">
						<strong class="_right">'.$arr['a'][$i]['pr']['phone']['VALUE'].' <span class="arrow-flag accordeon-trigger trigger-'.($i+1).'"></span></strong><strong class="TL BTN accordeon-trigger trigger-'.($i+1).'">'.$arr['a'][$i]['NAME'].'</strong><span class="adrres">'.$arr['a'][$i]['pr']['dress']['VALUE'].'</span>
					</div>
					<div class="text">
						<div class="_right">
							<a href="/map.php?id='.$arr['a'][$i]['ID'].'" class="ICN"><img src="/bitrix/templates/neman/img/icons/pin.png">схема проезда</a><a href="#" class="ICN"><img src="/bitrix/templates/neman/img/icons/print.png">распечатать</a>
						</div>
						 '.$arr['a'][$i]['pr']['times_w']['VALUE'].'
					</div>
			</div>';
	 }
	 $text.='</div>';
	 return $text;
		
	}
	
function get_prim(){
		  $text='<ol class="marker BG BG_blue -js ">';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(2,20,$sort,$add_filter); 
for($i=0;$i<count($arr['a']);$i++){
	//$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"1921",'height'=>"956",'full'=>'y','mode'=>'mm');
	//$img_small=GetImgByParam($param);
	
	
	$text.=' <li class="-hide marker-'.($i+1).'">
              <div class="ins"><strong class="TL">'.$arr['a'][$i]['NAME'].'</strong>
                <div class="text">'.$arr['a'][$i]['PREVIEW_TEXT'].'</div>
              </div>
            </li>';
	 }
	 $text.='</ol>';
	 return $text;
		
	}	
 function get_klient(){
		  $text='<div class="W wrapper-slider ">
              <div class="slide-klientfirst">';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(3,20,$sort,$add_filter); 
for($i=0;$i<count($arr['a']);$i++){
	$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"368",'height'=>"248",'full'=>'y','mode'=>'mm');
	$img_small=GetImgByParam($param);
	$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"800",'height'=>"",'full'=>'y','mode'=>'mm');
	$big_small=GetImgByParam($param);
	
	$text.='<div>
                     <a href="'.$big_small.'" class="grouped_elements" rel="group" >
                          <img src="'.$img_small.'"/>
                     </a>
                  </div>';
	 }
	 $text.='</div>
               <div class="controllers">
                    <span class="prev"> 
                        <img src="/bitrix/templates/neman/img/icons/arrow-left.png" alt="">
                    </span>
                    <span class="next">
                        <img src="/bitrix/templates/neman/img/icons/arrow-right.png" alt="">
                    </span>
                </div>	              
          </div>';
	 return $text;
		
	}  
	    
 function get_rev(){
		  $text='<div class="W wrapper-slider-next ">
                <div class="slide-klientsecond">';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(4,20,$sort,$add_filter); 
for($i=0;$i<count($arr['a']);$i++){
	$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"220",'height'=>"313",'full'=>'y','mode'=>'mm');
	$img_small=GetImgByParam($param);
	$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"800",'height'=>"",'full'=>'y','mode'=>'mm');
	$big_small=GetImgByParam($param);
	
	$text.='  <div>
                     <a href="'.$big_small.'" class="grouped_elements" rel="group1" >
                          <img src="'.$img_small.'"/>
                     </a>
                     <div class="title-slide">
                         '.$arr['a'][$i]['NAME'].'
                     </div>
                  </div>  
				  
				  ';
	 }
	 $text.='</div>
               <div class="controllers">
                    <span class="prev"> 
                        <img src="/bitrix/templates/neman/img/icons/arrow-left.png" alt="">
                    </span>
                    <span class="next">
                        <img src="/bitrix/templates/neman/img/icons/arrow-right.png" alt="">
                    </span>
                </div>
         </div>';
	 return $text;
		
	}  


	function get_product_menus(){
	$text='<ul>';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(6,10,$sort,$add_filter); 
	for($i=0;$i<count($arr['a']);$i++){
		if($i==0){$ss='ss';}else{$ss='';}
		$text.='<li data-menuanchor="products/'.$i.'"><a href="#products/'.$i.'" id="ddd'.$i.'" class="toggle-link-prod '.$ss.'">'.$arr['a'][$i]['pr']['name2']['VALUE'].'</a></li>';
	}
	 $text.='</ul>';
	 return $text;
		
	}		
			
	
function get_product_gl(){
	$text='<div class="wrap">
          <ul class="list">';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(6,10,$sort,$add_filter); 
	for($i=0;$i<count($arr['a']);$i++){
		$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"101",'height'=>"67",'full'=>'y','mode'=>'mm');
		$img_small=GetImgByParam($param);
		$text.='<li class="animated bounceInLeft b2-anim-'.($i+1).' "><a class="sss" ids="'.$i.'" href="#products/'.$i.'"><span>'.$arr['a'][$i]['pr']['name2']['VALUE'].'</span><img src="'.$img_small.'"/></a></li>';
	}
	 $text.='</ul>
        </div>';
	 return $text;
		
	}
	
 function get_product(){
		  $text='<section id="idProducts" class="section productslide">';
	$sort=Array('SORT'=>"ASC");
	$add_filter=array();
	$arr=GetMaterials(6,20,$sort,$add_filter); 
	
for($i=0;$i<count($arr['a']);$i++){
	/*$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"220",'height'=>"313",'full'=>'y','mode'=>'mm');
	$img_small=GetImgByParam($param);
	$param=array('file'=>CFile::GetPath($arr['a'][$i]['PREVIEW_PICTURE']),'width'=>"800",'height'=>"",'full'=>'y','mode'=>'mm');
	$big_small=GetImgByParam($param);*/
	
	$text.='<section style=" " class="slide slide-'.($i+1).'">
				<div class="display"  >
					<img src="/bitrix/templates/neman/img/content/products/slider/1.jpg" alt="">
                    
				</div>
				 ';
				 
	/*if($i==0){			 
          $text.='<div class="wrap-list-product animated bounceInUp b2-anim-3"><div class="wplist">
            <div class="list-product-min">';
			//print_r($arr['a'][$i]['pr']['imgs']);
			for($s=0;$s<count($arr['a'][$i]['pr']['imgs']['VALUE']);$s++){
				$param=array('file'=>CFile::GetPath($arr['a'][$i]['pr']['imgs']['VALUE'][$s]),'width'=>"1921",'height'=>"956",'full'=>'y','mode'=>'mm');
				$img_small=GetImgByParam($param);
				
                $text.='<div class="product_item">
                    <a href="" class="product_pic">
                        <img src="'.$img_small.'" alt="">
                    </a>
                </div>';
			}                                                            
            $text.=' </div>
               <div class="controllers">
                    <span class="prev"> 
                        <img src="/bitrix/templates/neman/img/icons/arrow-left.png" alt="">
                    </span>
                    <span class="next">
                        <img src="/bitrix/templates/neman/img/icons/arrow-right.png" alt="">
                    </span>
                </div>	            
            </div>
          </div>';
	}else{*/
		   $text.='<div class="wrap-list-product">
            <ul class="list-product-min">';
			//print_r($arr['a'][$i]['pr']['imgs']);
			for($s=0;$s<count($arr['a'][$i]['pr']['imgs']['VALUE']);$s++){
				$param=array('file'=>CFile::GetPath($arr['a'][$i]['pr']['imgs']['VALUE'][$s]),'width'=>"1921",'height'=>"956",'full'=>'y','mode'=>'mm');
				$img_small=GetImgByParam($param);
				
                $text.='<li class="product_item '.(($s==0)?"actives":"").'"> 
                    <a href="" class="'.(($i==0)?'product_pic':'product_pic_'.($i+1)).'">
                        <img src="'.$img_small.'" alt="">
                    </a>
                </li>';
			}                                                            
            $text.='</ul>
          </div> ';
		
		
		
		
		
	//}  
		  
			
   $text.=' <div class="intro">
          <div class="wrap">
            <div class="BG BG_wide  ">
              <h1> '.$arr['a'][$i]['NAME'].'
                <div class="B B_hide">
                  <header><strong class="TL">Характеристики</strong> <img src="/bitrix/templates/neman/img/content/products/arrow.png" alt=""></header>
                  <div class="text">
                    <p><strong>Технические характеристики:</strong></p>
                    <p>'.$arr['a'][$i]['PREVIEW_TEXT'].'</p>
                    <a href="'.CFile::GetPath($arr['a'][$i]['pr']['file']['VALUE']).'" target="_blank">скачать спецификацию <img src="/bitrix/templates/neman/img/content/products/pdf.png" alt=""></a>
                  </div>
                </div>
              </h1>
            </div>
            <h2 class="animate-cost  "><strong>'.$arr['a'][$i]['pr']['prise']['VALUE'].'</strong>рублей</h2>
          </div>
 
        </div>
		
			<div class="fp-controlArrow2 pref_pic animated bounceInLeft b2-anim-7"></div>	
			<div class="fp-controlArrow2 next_pic animated bounceInRight b2-anim-8"></div>	
				
				
				
				
			</section>';
	 }
	 $text.='</section>';
	 return $text;
		
	}  
	

        
 ?>