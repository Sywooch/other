<?php
/**
 * [магазин] Страница товара
 *
 * Шаблон страницы отдельного товара
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}
if(isset($_GET['page']) && $_GET['page']!=""){$_SESSION['page']=$_GET['page'];}
$smotr_colection=array();
$sm = new Shop_model($this->diafan);

require($_SERVER['DOCUMENT_ROOT'].'/modules/shop/inc/next-prev-collect.php');
//print_r($result);
$check_product = DB::fetch_array(DB::query('SELECT discount_id,s.action,s.new,s.hit FROM {shop} s
										LEFT JOIN {shop_discount_object} d ON d.good_id = s.id
									WHERE (d.discount_id > 0 OR s.action = "1" OR s.new = "1" OR s.hit = "1") AND s.[act] = "1" AND s.trash = "0" AND s.cat_id != "8" AND s.id="'.$result['id'].'"'));
if($check_product['discount_id'])
{
	$isDiscount = DB::fetch_array(DB::query('SELECT discount FROM {shop_discount} WHERE id="'.$check_product['discount_id'].'" AND date_finish < "'.time().'"'));
	if($isDiscount['discount'])
	{
		$attr = '<div class="slider1_img_sale2">-'.$isDiscount['discount'].'%</div>';
	}
	else
	{
		$attr = '';
	}
		
}
if($check_product['action'])
	$attr = '<div class="slider1_img_best_price"></div>';
if($check_product['new'])
	$attr = '<div class="slider1_img_sale">NEW</div>';
if($check_product['hit'])
	$attr = '<div class="slider1_img_hit"></div>';
	
$log=0;	
	
?>

	<div class="text">
		<div class="coll-main-img">
			<div class="photo_coll_main_full">
				<div class="coll-main-slider">
				<?
				$smotr_colection['id']=$result['id'];
				$smotr_colection['name']=$result['name'];
				$smotr_colection['img']=array();
				$smotr_colection['factory_url']=$_SERVER['REQUEST_URI'];
					
					//print_r($_SERVER);
					$images = $this->diafan->_images->get("cl-446", $result['id'], "shop", 29, $result['name'], false);
					$images_big = $this->diafan->_images->get("large", $result['id'], "shop", 29, $result['name'], false);
					
					if(!empty($images))
					{
						echo '<ul>';
						unset($i); $i = 0;
						foreach($images as $image)
						{
							echo '<li>';
							echo '<div class="slider_img img'.$i.'">';
							echo $attr;
							
							//$images_big['src']=str_replace("collection","large",$images_big['src']);
							echo "".$images_big['src']."";
							
							echo '<a href="'.str_replace('shop/collection','original',$image['src']).'" rel="gallery1" class="big_img_show"><img src="'.$image['src'].'" alt="'.strip_tags($image['alt']).'" /></a>';
							echo '</div>';
							echo '</li>';
							$i++;
							$smotr_colection['img'][]=$image['src'];
						}
						echo '</ul>';
					}
					
					
					
				?>
				</div>
				<div><a href="#" class="prev" id="prevall">&nbsp;</a></div>
				<div><a href="#" class="next" id="nextall">&nbsp;</a></div>
			</div>
			<div class="cont-mini">
			<?
				if(!empty($images))
				{
					unset($j); $j = 0;
					foreach($images as $image)
					{
						echo '<img src="'.$image['src'].'" alt='.strip_tags($image['alt']).'" id="mini-'.$j.'"'.($j == 0 ? ' class="cm-selected"' : '').' />';
						$j++;

						if($j % 4 == 0) echo '</div><div class="cont-mini">';
					}
				}
			?>
			</div>
			<div class="next-prev-col-buttons">
				<?if($urls['prev']){?>
				<a href='<?=BASE_PATH_HREF.$urls['prev']?>'>&lt; предыдущая коллекция</a>
				<?}?>
				<?if($urls['next']){?>
				<a href='<?=BASE_PATH_HREF.$urls['next']?>'>следующая коллекция &gt;</a>
				<?}?>
			</div>
		</div>
		<?
			$categorys = DB::fetch_array(DB::query('SELECT c1.name1 AS factory, c2.name1 AS country, c2.name_rus1 AS country_rus, r1.rewrite AS factory_url, r2.rewrite AS country_url FROM {shop_category} c1
													LEFT JOIN {shop_category} c2 ON c2.id = c1.parent_id
													LEFT JOIN {rewrite} r1 ON r1.module_name = "shop" AND r1.cat_id = c1.id
													LEFT JOIN {rewrite} r2 ON r2.module_name = "shop" AND r2.cat_id = c2.id
												WHERE c1.id = "'.$result['cat_id'].'"'));
		?>
        
        <?php
		
		//echo $_GET['filter'];
		//echo "<br>";
		//echo $_GET['data'];
		//echo "<br>";
		
		
		$json_data=json_decode($_GET['data']);
		
		//echo"----------------<br>";
		
		$appointment_m=explode(",",(json_encode($json_data->usefor)));
		//echo count($appointment_m);
		$appointment_mas=array();
		unset($appointment_mas);
		for($i=0;$i<count($appointment_m);$i++){
			$appointment_m2=explode('"',$appointment_m[$i]);
			$appointment_mas[]=$appointment_m2[1];	
		}
		
		$materials_m=explode(",",(json_encode($json_data->materials)));
		$materials_mas=array();
		unset($materials_mas);
		for($i=0;$i<count($materials_m);$i++){
			$materials_m2=explode('"',$materials_m[$i]);
			$materials_mas[]=$materials_m2[1];	
			
		}
		
		
		if((json_encode($json_data->countries))!="null"){
		//	echo "111";
		$countries_m=explode(",",(json_encode($json_data->countries)));
		$countries_mas=array();
		unset($countries_mas);
		for($i=0;$i<count($countries_m);$i++){
			$countries_m2=explode('"',$countries_m[$i]);
			$countries_mas[]=$countries_m2[1];	
			
		}
		}
		
		$minp=$json_data->minp;
		$maxp=$json_data->maxp;
		
	//	echo "<br>"; echo $minp;echo "-----";
	//	echo "<br>"; echo $maxp;echo "-----";
		
		
		
		$sizes_ot=$json_data->sizes_ot;
		$sizes_do=$json_data->sizes_do;
		$porp=$json_data->porp;
		
		$hit=$json_data->hit;
		$new=$json_data->new;
		$sale=$json_data->sale;
		$action=$json_data->action;
		
		
		
		unset($appointment_as);
		$appointment_as["базовая плитка"]="21";
		$appointment_as["фронтальная ступень"]="19";
		$appointment_as["угловая ступень"]="19";
		$appointment_as["подступенок"]="19";
		$appointment_as["вставка керамическая"]="22,23";
		$appointment_as["вставка металлическая"]="22,23";
		$appointment_as["декор керамический"]="22,23";
		$appointment_as["поручень керамический"]="9";
		$appointment_as["бордюр керамический"]="9";
		$appointment_as["малдинг керамический"]="9";
		$appointment_as["плинтус"]="9";
		$appointment_as["боковина правая"]="22,23";
		$appointment_as["боковина левая"]="22,23";
		$appointment_as["угол внешний"]="5,9";
		$appointment_as["напольный керамогранит"]="21";
		$appointment_as["настенная плитка"]="22,23";
		$appointment_as["напольная плитка"]="21";
		$appointment_as["борт бассейна"]="5";
		$appointment_as["цоколь"]="9";
		$appointment_as["мозаика керамическая"]="5";
		
		
		
		
		
		
		
		?>
        
        
        
		<div class="text_zag2 tmp1">Коллекция <?=mb_strtolower($result['name'],'UTF-8').', '.mb_strtolower($categorys['factory'],'UTF-8').' ('.$categorys['country_rus'].')'?></div>
		<div class="clear2"></div>
		<div class="text_zag3">Фабрика <span class="mf"><a href="<?=BASE_PATH_HREF.$categorys['factory_url']?>/"><?=mb_strtolower($categorys['factory'],'UTF-8')?></a></span> <span class="cn">(<?=$categorys['country']?>)</span></div>
		<div class="clear2"></div>
		<p><? $this->htmleditor($result['text']); ?></p>
		<?
		
		
		
		$smotr_colection['factory']=$categorys['factory'];
		$smotr_colection['country_rus']=$categorys['country_rus'];
		//$smotr_colection['img']
		$arr_prises=array();
		?>
		<div class="clear3"></div>
		
		<? $this->get('buy_form', 'shop', array("row" => $result, "result" => $result)); ?>

		<?
			$query = DB::query('SELECT s.id, s.[name], s.shit, s.sort,s.view, r.rewrite FROM {shop_rel} sr
									LEFT JOIN {shop} s ON s.id = sr.rel_element_id
									LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.element_id = s.id
								WHERE s.[act] = "1" AND s.trash = "0" AND sr.element_id = "'.$result['id'].'" AND sr.trash = "0" AND s.cat_id = "8" ORDER BY s.sort ASC,s.id ASC');
								
			/*echo 	'SELECT s.id, s.[name], r.rewrite FROM {shop_rel} sr
									LEFT JOIN {shop} s ON s.id = sr.rel_element_id
									LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.element_id = s.id
								WHERE s.[act] = "1" AND s.trash = "0" AND sr.element_id = "'.$result['id'].'" AND sr.trash = "0" AND s.cat_id = "8"';*/
								
			$count = DB::num_rows($query);
			$elements = array();
			if($count > 0)
			{
				while($selm = DB::fetch_array($query))
				{
					$params = $sm->get_param($selm['id'], 29);

					$material		= '';
					$size			= '';
					$size_type		= '';
					$plitka_type	= '';
					$ptype			= '';

					if(!empty($params))
					{
						foreach($params as $param)
						{
							if($param['id'] == 3) $material		= $param['value'];
							if($param['id'] == 4) $size			= $param['value'];
							if($param['id'] == 5) $size_type	= $param['value'];
							if($param['id'] == 6) $plitka_type	= $param['value'];
							if($param['id'] == 7) $ptype		= $param['value'];
						}
					}

					if(empty($plitka_type)) $plitka_type = 'Декоративные элементы';
					if(empty($size_type)) $size_type = 'м2';

					$pr = $this->diafan->_shop->price_get_all($selm['id'], $this->diafan->_user->id);
					$price = $pr[0]['price'];
					$arr_prises[]=$pr[0]['price'];
					$elements[$plitka_type][] = array(
									'id'			=> $selm['id'],
									'name'			=> $selm['name'],
									'sort'			=> $selm['sort'],
									'url'			=> BASE_PATH_HREF.$selm['rewrite'].'/',
									'price'			=> $price,
									'size_type'		=> $size_type,
									'size'			=> $size,
									'material'		=> $material,
									'plitka_type'	=> $plitka_type,
									'ptype'			=> $ptype,
									'shit'			=> $selm['shit'],
									'view'			=> $selm['view']
						);
						//print_r($selm);
				}
			}
			
			//print_r(json_decode($_GET['data']));
			asort($arr_prises);
			$smotr_colection['prise']=$arr_prises[0];
			if(isset($elements['Настенная плитка']) && count($elements['Настенная плитка']) > 0)
			{
				echo '<div class="text_zag"><h2>Настенная плитка<h2></div>';
				
				echo '<div class="elem-coll-container tmp1">';
				$xs=0;
				foreach($elements['Настенная плитка'] as $element)
				{
					
					
					//echo'<pre>';
					//print_r($_GET['data']);
					//echo'</pre>';
					
					
					
					if((isset($_GET['filter']))&&($_GET['filter']=="true")){
						
						
					//параметры для фильтрации, взятые из командной строки
					if($maxp<9999){
					//задана фильтрация по цене
						$log_param_price=1;
					}else{
					//фильтрация по цене не задана	
						$log_param_price=0;
					}
					
					
					if($sizes_ot==""){
					//фильтрация по размеру не задана	
						$log_param_size=0;
					}else{
					//задана фильтрация по размеру
						$log_param_size=1;	
					}
					
					
					if($hit==0){
						$log_param_hit=0;
					}else{
						$log_param_hit=1;
					}
					
					if($sale==0){
						$log_param_sale=0;
					}else{
						$log_param_sale=1;
					}
					
					if($new==0){
						$log_param_new=0;
					}else{
						$log_param_new=1;
					}
					
					if($action==0){
						$log_param_action=0;
					}else{
						$log_param_action=1;
					}
					
					if(isset($json_data->usefor)){
						$log_param_usefor=1;
					}else{
						$log_param_usefor=0;
					}
					
					if(isset($json_data->materials)){
						$log_param_materials=1;
					}else{
						$log_param_materials=0;
					}
					
					if(isset($json_data->countries)){
						$log_param_countries=1;
					}else{
						$log_param_countries=0;
					}
					
					
				
					
					
					
					
					
						
						
					$log=0;
					$log_price=0;
					$log_size=0;
					$log_hit=0;
					$log_sale=0;
					$log_new=0;
					$log_action=0;
					$log_usefor=0;
					$log_materials=0;
					$log_countries=0;
					
					$temp_m=explode(",",$appointment_as[$element['ptype']]);
					
					for($i=0;$i<count($temp_m);$i++){
						for($i2=0;$i2<count($appointment_mas);$i2++){
							if($temp_m[$i]==$appointment_mas[$i2]){  /*echo 'style="color:#991802;"';*/ /*$log=1;*/ $log_usefor=1; break; }	
						}
					}
					
					
					
					
					//назначение
					/*
					for($i=0;$i<count($appointment_mas);$i++){
						echo "==".$appointment_mas[$i]."==";
						$result_appointment = DB::query("SELECT * FROM {shop_param_element} WHERE param_id='2' AND element_id='".$element['id']."' AND value1='".$appointment_mas[$i]."' ");
						//echo"++".DB::num_rows($result_material)."++";
						if( (DB::num_rows($result_appointment))>0 ){ $log=1; break; };
					
					}
					*/
					
					
					
					
					//материал
					for($i=0;$i<count($materials_mas);$i++){
					//	echo "==".$element['id']."==";
						$result_material = DB::query("SELECT * FROM {shop_param_element} WHERE param_id='3' AND element_id='".$element['id']."' AND value1='".$materials_mas[$i]."' ");
						//echo"++".DB::num_rows($result_material)."++";
						if( (DB::num_rows($result_material))>0 ){ /*$log=1;*/ $log_materials=1; break; };
					
					}
					
					
					
					//страна и производитель
					//echo "---".count($countries_mas)."---";
					if(count($countries_mas)>0){
						/*$log=1;*/
						$log_countries=1; 
						
					}
					
					
					//цена
					if($maxp<9999){
					if( ($minp<=round($element['price']))&&($maxp>=round($element['price'])) ){
						/*$log=1;*/
						$log_price=1; 
							
					}
					}
					
					
					
					//размеры
					$size_m=explode("x",$element['size']);
					$size_tmp=$size_m[0];
					$size_tmp2=$size_m[1];
					$size_tmp2=$size_m[1];
					$size_tmp2=str_replace(" см","",$size_tmp2);
					
					//echo "--".($sizes_ot+$porp)."<br>";
					//echo "++".$size_tmp." --(".$sizes_ot.")-(".$porp.") ".($sizes_ot-$porp)."<br>";
					//echo "++".$size_tmp2."<br>";
					//if((($sizes_ot-$porp)<=$size_tmp)){echo "1";}else{ echo "0"; };
					//if((($sizes_ot+$porp)>=$size_tmp)){echo "1";}else{ echo "0"; };
					//if((($sizes_do-$porp)<=$size_tmp2)){echo "1";}else{ echo "0"; };
					//if((($sizes_do+$porp)>=$size_tmp2)){echo "1";}else{ echo "0"; };
					
					//if( (($sizes_ot-$porp)<=$size_tmp)&&(($sizes_ot+$porp)>=$size_tmp) && (($sizes_do-$porp)<=$size_tmp2)&&(($sizes_do+$porp)>=$size_tmp2)   ){	
					if( (($sizes_ot-$porp)<=$size_tmp) && (($sizes_ot+$porp)>=$size_tmp) && (($sizes_do-$porp)<=$size_tmp2)&& (($sizes_do+$porp)>=$size_tmp2)  ){		
						/*$log=1;*/
						$log_size=1; 
							
					}
					if( (($sizes_do-$porp)<=$size_tmp) && (($sizes_do+$porp)>=$size_tmp) && (($sizes_ot-$porp)<=$size_tmp2)&& (($sizes_ot+$porp)>=$size_tmp2)  ){		
						/*$log=1;*/
						$log_size=1; 
							
					}
					//хит, акция, новый, скидка
					if($hit==1){
						/*$log=1;*/
						$log_hit=1;
						
					}
					if($new==1){
						/*$log=1;*/
						$log_new=1;
					}
					if($sale==1){
						/*$log=1;*/
						$log_sale=1;
						
					}
					if($action==1){
						/*$log=1;*/
						$log_action=1;
					}
					
					
					$log=1;
					if(($log_param_price==1)&&($log_price==0)){$log=0; }
					if(($log_param_size==1)&&($log_size==0)){$log=0; }
					if(($log_param_hit==1)&&($log_hit==0)){$log=0; }
					if(($log_param_sale==1)&&($log_sale==0)){$log=0; }
					if(($log_param_new==1)&&($log_new==0)){$log=0; }
					if(($log_param_action==1)&&($log_action==0)){$log=0; }
					//if(($log_param_usefor==1)&&($log_usefor==0)){$log=0; }
					if(($log_param_materials==1)&&($log_materials==0)){$log=0; }
					if(($log_param_countries==1)&&($log_countries==0)){$log=0; }
					
					
						
						
					}
					
					
					echo '<div class="element-coll ';  if($log==1){ echo "scroll-to-parent tmp5 ramcas"; }  echo' elem-'.$element['id'].'">';
					
					echo '<div class="elem-img" rel="'.$element['id'].'">';
					$images = $this->diafan->_images->get("el-220", $element['id'], "shop", 29, $element['name'], false);
					$images22 = $this->diafan->_images->get("cl-446", $element['id'], "shop", 29, $element['name'], false);
					//print_r($images22);
					// картинка элемента
					if(!empty($images[0]))
						
					{
						//$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
						echo '<img class="goods_img" src="'.$images[0]['src'].'" alt="'.strip_tags($result['name']).'">';
					}
					echo '</div>';
					
					echo '<div class="cart-box-full-container">';
					echo '<div ';
					if((isset($_GET['filter']))&&($_GET['filter']=="true")){
					
					
					
					//if($log==1){ echo' style="color:#991802;text-shadow: #ffd7ba 1px 0px, #ffd7ba 1px 1px, #ffd7ba 0px 1px, #ffd7ba -1px 1px, #ffd7ba -1px 0px, #ffd7ba -1px -1px, #ffd7ba 0px -1px, #ffd7ba 1px -1px;text-decoration: none;" '; }
					
					
					}
					//$appointment_as[$element['ptype']].' = '.$element['ptype'] 
					
					echo' class="elem-name '; if($log==1){ echo"scroll-to"; }  echo'" rel="'.$element['id'].'">'.mb_strtolower($element['name'],'UTF-8').'</div>';
						// скрытое описание элемента
						echo '<div class="cart-box-full" id="cart-box-full-'.$element['id'].'">';
						echo '<div class="cart-box-full-close" rel="'.$element['id'].'"></div>';
						echo '<div class="text_zag"><a href="'.$element['url'].'">'.mb_strtolower($element['name'],'UTF-8').' <span>('.$element['size'].')</span></a></div>';
						echo '<div class="elem-img2">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" imds="'.$images22[0]['src'].'" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';
						echo '<div class="dfgddf">';
						if(round($element['price'])=='100000000000' || $result['names_param']['Цена от']['value']=='99999999999'
		){
							echo '<div class="rdescr tmp2"><span class="price">Снято с продажи</span></div>';
						}else{
						echo '<div class="rdescr tmp1">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
						}
						echo '<div class="rdescr tmp1">Размер: <span class="base">'.$element['size'].'</span></div>';
						if(round($element['price'])!='100000000000'){
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">В корзину</a></span></div>';
						}
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Уточнить остаток</a>';
						echo '</div></div>';
						// ------------------------------------------
					echo '</div>';

					echo '<div class="elem-size">'.$element['size'].'</div>';
					echo '<div class="elem-ptype tmp2">'.$element['ptype'].'</div>';
if($element['shit']==1){echo '<div class="elem-size">Представлен в магазине : Да</div>';}else{echo '<div class="elem-size">Представлен в магазине : Нет</div>';}
					echo '<div class="elem-price-cart">';
					if(ceil($element['price'])=="100000000000" || $result['names_param']['Цена от']['value']=='99999999999'
		){
						echo 'Снято с продажи';
					}else{
					echo ceil($element['price']).' руб/'.$element['size_type'];
					echo '<div class="cart-button" rel="'.$element['id'].'"></div>';
						// скрытая корзина
						echo '<div class="cart-box" id="cart-box-'.$element['id'].'">';
						echo '<div class="count-cart"><input type="text" id="cc-'.$element['id'].'" data-type="'.$element['size_type'].'" name="cc-'.$element['id'].'" value="0" class="cb-cc"><span>'.$element['size_type'].'</span></div>';
						echo '<div class="link-to-cart"><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">В корзину</a></div>';
						echo '</div>';
					}
						// ------------------------------------------
					echo '</div>';
				
					echo '</div>';
					if($element['view']=='br'){echo "<div style='clear:both;'></div>";$xs=0;}else{if($xs==2){echo "<div style='clear:both;'></div>";$xs=0;}else{$xs++;}}
				}
				echo '</div>';
			}
			if(isset($elements['Напольная плитка']) && count($elements['Напольная плитка']) > 0)
			{
				echo '<div class="text_zag"><h2>Напольная плитка</h2></div>';

				echo '<div class="elem-coll-container tmp2">';
				$xs=0;
				foreach($elements['Напольная плитка'] as $element)
				{
					
					
					
					if((isset($_GET['filter']))&&($_GET['filter']=="true")){
						
						
					//параметры для фильтрации, взятые из командной строки
					if($maxp<9999){
					//задана фильтрация по цене
						$log_param_price=1;
					}else{
					//фильтрация по цене не задана	
						$log_param_price=0;
					}
					
					
					if($sizes_ot==""){
					//фильтрация по размеру не задана	
						$log_param_size=0;
					}else{
					//задана фильтрация по размеру
						$log_param_size=1;	
					}
					
					
					if($hit==0){
						$log_param_hit=0;
					}else{
						$log_param_hit=1;
					}
					
					if($sale==0){
						$log_param_sale=0;
					}else{
						$log_param_sale=1;
					}
					
					if($new==0){
						$log_param_new=0;
					}else{
						$log_param_new=1;
					}
					
					if($action==0){
						$log_param_action=0;
					}else{
						$log_param_action=1;
					}
					
					if(isset($json_data->usefor)){
						$log_param_usefor=1;
					}else{
						$log_param_usefor=0;
					}
					
					if(isset($json_data->materials)){
						$log_param_materials=1;
					}else{
						$log_param_materials=0;
					}
					
					if(isset($json_data->countries)){
						$log_param_countries=1;
					}else{
						$log_param_countries=0;
					}
					
					
				
					
					
					
					
					
						
						
					$log=0;
					$log_price=0;
					$log_size=0;
					$log_hit=0;
					$log_sale=0;
					$log_new=0;
					$log_action=0;
					$log_usefor=0;
					$log_materials=0;
					$log_countries=0;
					
					$temp_m=explode(",",$appointment_as[$element['ptype']]);
					
					for($i=0;$i<count($temp_m);$i++){
						for($i2=0;$i2<count($appointment_mas);$i2++){
							if($temp_m[$i]==$appointment_mas[$i2]){  /*echo 'style="color:#991802;"';*/ /*$log=1;*/ $log_usefor=1; break; }	
						}
					}
					
					
					
					
					//назначение
					/*
					for($i=0;$i<count($appointment_mas);$i++){
						echo "==".$appointment_mas[$i]."==";
						$result_appointment = DB::query("SELECT * FROM {shop_param_element} WHERE param_id='2' AND element_id='".$element['id']."' AND value1='".$appointment_mas[$i]."' ");
						//echo"++".DB::num_rows($result_material)."++";
						if( (DB::num_rows($result_appointment))>0 ){ $log=1; break; };
					
					}
					*/
					
					
					
					
					//материал
					for($i=0;$i<count($materials_mas);$i++){
					//	echo "==".$element['id']."==";
						$result_material = DB::query("SELECT * FROM {shop_param_element} WHERE param_id='3' AND element_id='".$element['id']."' AND value1='".$materials_mas[$i]."' ");
						//echo"++".DB::num_rows($result_material)."++";
						if( (DB::num_rows($result_material))>0 ){ /*$log=1;*/ $log_materials=1; break; };
					
					}
					
					
					
					//страна и производитель
					//echo "---".count($countries_mas)."---";
					if(count($countries_mas)>0){
						/*$log=1;*/
						$log_countries=1; 
						
					}
					
					
					//цена
					if($maxp<9999){
					if( ($minp<=round($element['price']))&&($maxp>=round($element['price'])) ){
						/*$log=1;*/
						$log_price=1; 
							
					}
					}
					
					
					
					//размеры
					$size_m=explode("x",$element['size']);
					$size_tmp=$size_m[0];
					$size_tmp2=$size_m[1];
					$size_tmp2=$size_m[1];
					$size_tmp2=str_replace(" см","",$size_tmp2);
					
					//echo "--".($sizes_ot+$porp)."<br>";
					//echo "++".$size_tmp." --(".$sizes_ot.")-(".$porp.") ".($sizes_ot-$porp)."<br>";
					//echo "++".$size_tmp2."<br>";
					//if((($sizes_ot-$porp)<=$size_tmp)){echo "1";}else{ echo "0"; };
					//if((($sizes_ot+$porp)>=$size_tmp)){echo "1";}else{ echo "0"; };
					//if((($sizes_do-$porp)<=$size_tmp2)){echo "1";}else{ echo "0"; };
					//if((($sizes_do+$porp)>=$size_tmp2)){echo "1";}else{ echo "0"; };
					
					//if( (($sizes_ot-$porp)<=$size_tmp)&&(($sizes_ot+$porp)>=$size_tmp) && (($sizes_do-$porp)<=$size_tmp2)&&(($sizes_do+$porp)>=$size_tmp2)   ){	
					if( (($sizes_ot-$porp)<=$size_tmp) && (($sizes_ot+$porp)>=$size_tmp) && (($sizes_do-$porp)<=$size_tmp2)&& (($sizes_do+$porp)>=$size_tmp2)  ){		
						/*$log=1;*/
						$log_size=1; 
							
					}
					if( (($sizes_do-$porp)<=$size_tmp) && (($sizes_do+$porp)>=$size_tmp) && (($sizes_ot-$porp)<=$size_tmp2)&& (($sizes_ot+$porp)>=$size_tmp2)  ){		
						/*$log=1;*/
						$log_size=1; 
							
					}
					//хит, акция, новый, скидка
					if($hit==1){
						/*$log=1;*/
						$log_hit=1;
						
					}
					if($new==1){
						/*$log=1;*/
						$log_new=1;
					}
					if($sale==1){
						/*$log=1;*/
						$log_sale=1;
						
					}
					if($action==1){
						/*$log=1;*/
						$log_action=1;
					}
					
					
					$log=1;
					if(($log_param_price==1)&&($log_price==0)){$log=0; }
					if(($log_param_size==1)&&($log_size==0)){$log=0; }
					if(($log_param_hit==1)&&($log_hit==0)){$log=0; }
					if(($log_param_sale==1)&&($log_sale==0)){$log=0; }
					if(($log_param_new==1)&&($log_new==0)){$log=0; }
					if(($log_param_action==1)&&($log_action==0)){$log=0; }
					//if(($log_param_usefor==1)&&($log_usefor==0)){$log=0; }
					if(($log_param_materials==1)&&($log_materials==0)){$log=0; }
					if(($log_param_countries==1)&&($log_countries==0)){$log=0; }
					
					
						
						
					}
					
					
						
					echo '<div class="element-coll ';  if($log==1){ echo "scroll-to-parent tmp6 ramcas"; }  echo' elem-'.$element['id'].'">';
					
					echo '<div class="elem-img" rel="'.$element['id'].'">';
					$images = $this->diafan->_images->get("el-220", $element['id'], "shop", 29, $element['name'], false);
					// картинка элемента
					if(!empty($images[0]))
					{
						echo '<img class="goods_img" src="'.$images[0]['src'].'" alt="'.$element['name'].'">';
					}
					echo '</div>';
					
					echo '<div class="cart-box-full-container">';
					echo '<div ';
					if((isset($_GET['filter']))&&($_GET['filter']=="true")){
					
					
					//if($log==1){ echo' style="color:#991802;text-shadow: #ffd7ba 1px 0px, #ffd7ba 1px 1px, #ffd7ba 0px 1px, #ffd7ba -1px 1px, #ffd7ba -1px 0px, #ffd7ba -1px -1px, #ffd7ba 0px -1px, #ffd7ba 1px -1px;text-decoration: none;" '; }
					
					
					
					
					}
					//$appointment_as[$element['ptype']].' = '.$element['ptype'] 
					
					echo' class="elem-name '; if($log==1){ echo"scroll-to"; }  echo'" rel="'.$element['id'].'">'.mb_strtolower($element['name'],'UTF-8').'</div>';//echo DB::num_rows($result_material);
						// скрытое описание элемента
						echo '<div class="cart-box-full" id="cart-box-full-'.$element['id'].'">';
						echo '<div class="cart-box-full-close" rel="'.$element['id'].'"></div>';
						echo '<div class="text_zag"><a href="'.$element['url'].'">'.mb_strtolower($element['name'],'UTF-8').' <span>('.$element['size'].')</span></a></div>';
						echo '<div class="elem-img2">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" imds="'.$images[0]['src'].'" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';
					echo '<div class="dfgddf">';
						if(round($element['price'])=='100000000000' || $result['names_param']['Цена от']['value']=='99999999999'
		){
							echo '<div class="rdescr tmp2"><span class="price">Снято с продажи</span></div>';
						}else{
						echo '<div class="rdescr tmp1">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
						}
						echo '<div class="rdescr tmp1">Размер: <span class="base">'.$element['size'].'</span></div>';
						if(round($element['price'])!='100000000000'){
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">В корзину</a></span></div>';
						}
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Уточнить остаток</a>';
						echo '</div></div>';
						// ------------------------------------------
					echo '</div>';

					echo '<div class="elem-size">'.$element['size'].'</div>';
					echo '<div class="elem-ptype tmp3">'.$element['ptype'].'</div>';
					if($element['shit']==1){echo '<div class="elem-size">Представлен в магазине : Да</div>';}else{echo '<div class="elem-size">Представлен в магазине : Нет</div>';}
					echo '<div class="elem-price-cart">';
					if(ceil($element['price'])=="100000000000" || $result['names_param']['Цена от']['value']=='99999999999'
		){
						echo 'Снято с продажи';
					}else{
					echo ceil($element['price']).' руб/'.$element['size_type'];
					echo '<div class="cart-button" rel="'.$element['id'].'"></div>';
						// скрытая корзина
						echo '<div class="cart-box" id="cart-box-'.$element['id'].'">';
						echo '<div class="count-cart"><input type="text" id="cc-'.$element['id'].'" name="cc-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span></div>';
						echo '<div class="link-to-cart"><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">В корзину</a></div>';
						
						
						echo '</div>';
					}
						// ------------------------------------------
					echo '</div>';

					echo '</div>';
					if($element['view']=='br'){echo "<div style='clear:both;'></div>";$xs=0;}else{if($xs==2){echo "<div style='clear:both;'></div>";$xs=0;}else{$xs++;}}
				}
				echo '</div>';
			}
			if(isset($elements['Декоративные элементы']) && count($elements['Декоративные элементы']) > 0)
			{
				echo '<div class="text_zag"><h2>Декоративные элементы</h2></div>';

				echo '<div class="elem-coll-container tmp3">';
				$xs=0;
				foreach($elements['Декоративные элементы'] as $element)
				{
					
					
					
					if((isset($_GET['filter']))&&($_GET['filter']=="true")){
						
						
					//параметры для фильтрации, взятые из командной строки
					if($maxp<9999){
					//задана фильтрация по цене
						$log_param_price=1;
					}else{
					//фильтрация по цене не задана	
						$log_param_price=0;
					}
					
					
					if($sizes_ot==""){
					//фильтрация по размеру не задана	
						$log_param_size=0;
					}else{
					//задана фильтрация по размеру
						$log_param_size=1;	
					}
					
					
					if($hit==0){
						$log_param_hit=0;
					}else{
						$log_param_hit=1;
					}
					
					if($sale==0){
						$log_param_sale=0;
					}else{
						$log_param_sale=1;
					}
					
					if($new==0){
						$log_param_new=0;
					}else{
						$log_param_new=1;
					}
					
					if($action==0){
						$log_param_action=0;
					}else{
						$log_param_action=1;
					}
					
					if(isset($json_data->usefor)){
						$log_param_usefor=1;
					}else{
						$log_param_usefor=0;
					}
					
					if(isset($json_data->materials)){
						$log_param_materials=1;
					}else{
						$log_param_materials=0;
					}
					
					if(isset($json_data->countries)){
						$log_param_countries=1;
					}else{
						$log_param_countries=0;
					}
					
					
				
					
					
					
					
					
						
						
					$log=0;
					$log_price=0;
					$log_size=0;
					$log_hit=0;
					$log_sale=0;
					$log_new=0;
					$log_action=0;
					$log_usefor=0;
					$log_materials=0;
					$log_countries=0;
					
					$temp_m=explode(",",$appointment_as[$element['ptype']]);
					
					for($i=0;$i<count($temp_m);$i++){
						for($i2=0;$i2<count($appointment_mas);$i2++){
							if($temp_m[$i]==$appointment_mas[$i2]){  /*echo 'style="color:#991802;"';*/ /*$log=1;*/ $log_usefor=1; break; }	
						}
					}
					
					
					
					
					//назначение
					/*
					for($i=0;$i<count($appointment_mas);$i++){
						echo "==".$appointment_mas[$i]."==";
						$result_appointment = DB::query("SELECT * FROM {shop_param_element} WHERE param_id='2' AND element_id='".$element['id']."' AND value1='".$appointment_mas[$i]."' ");
						//echo"++".DB::num_rows($result_material)."++";
						if( (DB::num_rows($result_appointment))>0 ){ $log=1; break; };
					
					}
					*/
					
					
					
					
					//материал
					for($i=0;$i<count($materials_mas);$i++){
					//	echo "==".$element['id']."==";
						$result_material = DB::query("SELECT * FROM {shop_param_element} WHERE param_id='3' AND element_id='".$element['id']."' AND value1='".$materials_mas[$i]."' ");
						//echo"++".DB::num_rows($result_material)."++";
						if( (DB::num_rows($result_material))>0 ){ /*$log=1;*/ $log_materials=1; break; };
					
					}
					
					
					
					//страна и производитель
					//echo "---".count($countries_mas)."---";
					if(count($countries_mas)>0){
						/*$log=1;*/
						$log_countries=1; 
						
					}
					
					
					//цена
					if($maxp<9999){
					if( ($minp<=round($element['price']))&&($maxp>=round($element['price'])) ){
						/*$log=1;*/
						$log_price=1; 
							
					}
					}
					
					
					
					//размеры
					$size_m=explode("x",$element['size']);
					$size_tmp=$size_m[0];
					$size_tmp2=$size_m[1];
					$size_tmp2=$size_m[1];
					$size_tmp2=str_replace(" см","",$size_tmp2);
					
					//echo "--".($sizes_ot+$porp)."<br>";
					//echo "++".$size_tmp." --(".$sizes_ot.")-(".$porp.") ".($sizes_ot-$porp)."<br>";
					//echo "++".$size_tmp2."<br>";
					//if((($sizes_ot-$porp)<=$size_tmp)){echo "1";}else{ echo "0"; };
					//if((($sizes_ot+$porp)>=$size_tmp)){echo "1";}else{ echo "0"; };
					//if((($sizes_do-$porp)<=$size_tmp2)){echo "1";}else{ echo "0"; };
					//if((($sizes_do+$porp)>=$size_tmp2)){echo "1";}else{ echo "0"; };
					
					//if( (($sizes_ot-$porp)<=$size_tmp)&&(($sizes_ot+$porp)>=$size_tmp) && (($sizes_do-$porp)<=$size_tmp2)&&(($sizes_do+$porp)>=$size_tmp2)   ){	
					if( (($sizes_ot-$porp)<=$size_tmp) && (($sizes_ot+$porp)>=$size_tmp) && (($sizes_do-$porp)<=$size_tmp2)&& (($sizes_do+$porp)>=$size_tmp2)  ){		
						/*$log=1;*/
						$log_size=1; 
							
					}
					if( (($sizes_do-$porp)<=$size_tmp) && (($sizes_do+$porp)>=$size_tmp) && (($sizes_ot-$porp)<=$size_tmp2)&& (($sizes_ot+$porp)>=$size_tmp2)  ){		
						/*$log=1;*/
						$log_size=1; 
							
					}
					//хит, акция, новый, скидка
					if($hit==1){
						/*$log=1;*/
						$log_hit=1;
						
					}
					if($new==1){
						/*$log=1;*/
						$log_new=1;
					}
					if($sale==1){
						/*$log=1;*/
						$log_sale=1;
						
					}
					if($action==1){
						/*$log=1;*/
						$log_action=1;
					}
					
					
					$log=1;
					if(($log_param_price==1)&&($log_price==0)){$log=0; }
					if(($log_param_size==1)&&($log_size==0)){$log=0; }
					if(($log_param_hit==1)&&($log_hit==0)){$log=0; }
					if(($log_param_sale==1)&&($log_sale==0)){$log=0; }
					if(($log_param_new==1)&&($log_new==0)){$log=0; }
					if(($log_param_action==1)&&($log_action==0)){$log=0; }
				//	if(($log_param_usefor==1)&&($log_usefor==0)){$log=0; }
					if(($log_param_materials==1)&&($log_materials==0)){$log=0; }
					if(($log_param_countries==1)&&($log_countries==0)){$log=0; }
					
					
						
						
					}
					
					
					echo '<div class="element-coll ';  if($log==1){ echo "scroll-to-parent tmp7 ramcas"; }  echo' elem-'.$element['id'].'">';
					
					echo '<div class="elem-img" rel="'.$element['id'].'">';
					$images = $this->diafan->_images->get("el-220", $element['id'], "shop", 29, $element['name'], false);
					// картинка элемента
					if(!empty($images[0]))
					{
						echo '<img class="goods_img" src="'.$images[0]['src'].'" alt="'.$element['name'].'">';
					}
					echo '</div>';
					
					echo '<div class="cart-box-full-container">';
					echo '<div ';
					if((isset($_GET['filter']))&&($_GET['filter']=="true")){
					
					
					//if($log==1){ echo' style="color:#991802;text-shadow: #ffd7ba 1px 0px, #ffd7ba 1px 1px, #ffd7ba 0px 1px, #ffd7ba -1px 1px, #ffd7ba -1px 0px, #ffd7ba -1px -1px, #ffd7ba 0px -1px, #ffd7ba 1px -1px;text-decoration: none;" '; }
					
					
					
					
					
					
					}
					//$appointment_as[$element['ptype']].' = '.$element['ptype'] 
					
					echo' class="elem-name '; if($log==1){ echo"scroll-to"; }  echo'"  rel="'.$element['id'].'">'.mb_strtolower($element['name'],'UTF-8').'</div>';//echo "--";
					//echo $element['id']; echo DB::num_rows($result_material);
						// скрытое описание элемента
						echo '<div class="cart-box-full" id="cart-box-full-'.$element['id'].'">';
						echo '<div class="cart-box-full-close" rel="'.$element['id'].'"></div>';
						echo '<div class="text_zag"><a href="'.$element['url'].'">'.mb_strtolower($element['name'],'UTF-8').' <span>('.$element['size'].')</span></a></div>';
						echo '<div class="elem-img2">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" imds="'.$images[0]['src'].'" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';
					echo '<div class="dfgddf">';
						if(round($element['price'])=='100000000000' || $result['names_param']['Цена от']['value']=='99999999999'
		){
							echo '<div class="rdescr tmp2"><span class="price">Снято с продажи</span></div>';
						}else{
						echo '<div class="rdescr tmp1">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
						}
						echo '<div class="rdescr tmp1">Размер: <span class="base">'.$element['size'].'</span></div>';
						if(round($element['price'])!='100000000000'){
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">В корзину</a></span></div>';
						}
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Уточнить остаток</a>';
						echo '</div></div>';
						// ------------------------------------------
					echo '</div>';

					echo '<div class="elem-size">'.$element['size'].'</div>';
					echo '<div class="elem-ptype tmp4">'.$element['ptype'].'</div>';
					if($element['shit']==1){echo '<div class="elem-size">Представлен в магазине : Да</div>';}else{echo '<div class="elem-size">Представлен в магазине : Нет</div>';}
					echo '<div class="elem-price-cart">';
					
					
					if(ceil($element['price'])=="100000000000" || $result['names_param']['Цена от']['value']=='99999999999'
		){
						echo 'Снято с продажи';
					}else{
						echo ceil($element['price']).' руб/'.$element['size_type'];
						echo '<div class="cart-button" rel="'.$element['id'].'"></div>';
						// скрытая корзина
						echo '<div class="cart-box" id="cart-box-'.$element['id'].'">';
						echo '<div class="count-cart"><input type="text" id="cc-'.$element['id'].'" name="cc-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span></div>';
						echo '<div class="link-to-cart"><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">В корзину</a></div>';
						echo '</div>';
						// ------------------------------------------
						}
					echo '</div>';
					
					echo '</div>';
					if($element['view']=='br'){echo "<div style='clear:both;'></div>";$xs=0;}else{if($xs==2){echo "<div style='clear:both;'></div>";$xs=0;}else{$xs++;}}
					
				}
				echo '</div>';
			}
		?>
	</div>
    
    
    <script type="text/javascript">
   	$(window).load(function () {
		
		
 		/*
		
        	
			var main_img_width = $(this).width();
    		var main_img_height = $(this).height();
			
			alert(main_img_width+" - "+main_img_height);
					
    	
		*/
		
		
 		$('.cart-box-full').each(function(){
			
				var main_img_width=$(this).find('.elem-img2 .goods_img2').width();
				var main_img_height=$(this).find('.elem-img2 .goods_img2').height();
				//alert(main_img_width+" - "+main_img_height);
			
				if((main_img_width+100)<main_img_height){
				//вертикальная картинка	
				//alert("v"); 
				//$(this).removeClass('horizontal'); 
				//$(this).addClass('vertical'); 
				
				}else{
				//горизонтальная или квадратная картинка
				//alert("h");
				//$(this).removeClass('vertical'); 
				//$(this).addClass('horizontal'); 
				
				
				if(main_img_width<550){ main_img_width=550; }	
				if(main_img_height>350){ main_img_height=350; }	
				
				$(this).find(' .elem-img2').css("width","auto");
				$(this).find(' .elem-img2').css('height','auto');
				$(this).find(' .dfgddf').css("width","100%");
				$(this).find(' .dfgddf').css("max-width","100%");
				$(this).find(' .dfgddf .rdescr').css("width","auto");
				$(this).find(' .count-cart.aaaaaa').css("clear","none");
				$(this).find(' .dfgddf .rdescr').css("margin-top","17px");
				$(this).find(' .butts').css("clear","none");
				$(this).find(' .butts').css("float","right");
				$(this).find(' .butts').css("display","inline-block");
				$(this).find(' .butts').css("margin-top","10px");
				$(this).find(' .count-cart.aaaaaa').css("margin-bottom","0px");
				$(this ).css("width",main_img_width+"px");
				$(this).find(' .goods_img2').css("height","auto");
				$(this).find(' .goods_img2').css("max-height","500px");
				$(this).css('height','auto');
				
				//alert(main_img_height);
				if(main_img_height==350){
					$(this).find(' .elem-img2').css("width","auto");	
					$(this).find(' .goods_img2').css("width","auto");	
					$(this).find(' .goods_img2').css("max-height",main_img_height+"px");
					$(this).find(' .goods_img2').css("height",main_img_height+"px");
				}
				
				}
			
		
		});
		
		
		
		/*
		if((main_img_width+100)<main_img_height){
			$('.cart-box-full-in .elem-img').css("width","200px");
			$('.cart-box-full-in .elem-img').css("float","left");
			$('.cart-box-full-in .parameters_left').css("float","left");
			$('.cart-box-full-in .parameters_right').css("float","left");
			$('.cart-box-full-in .parameters_left').css("padding-left","20px");
			$('.cart-box-full-in .parameters_left').css("width","calc(50% - 120px)");
			$('.cart-box-full-in .parameters_right').css("width","calc(50% - 100px)");
			$('.cart-box-full-in .count-cart').css("float","left");
			$('.cart-box-full-in .count-cart').css("margin-left","20px");
			
		}
		*/
		
	});
    </script>

    
    
    
	<script src="/js/jquery.maskedinput.js" type="text/javascript"></script>
	<div style="display: none;">
		<form method="post" action="" class="shop_form ajax">
			<input type="hidden" name="good_id" value="">
			<input type="hidden" name="module" value="shop">
			<input type="hidden" name="action" value="buy">
			<input type="hidden" name="ajax" value="">

			<input type="text" class="inpnum" value="1" name="count" size="1">
			<input type="button" class="button" value="" action="buy">
		</form>
	</div>
	<div style="display: none;" id="hovers">
	<h1>Уточнить наличие <b class="sdsfgss"></b></h1>
		<form method="post" action="" class="shop_form ajax">
			<div><b>Телефон:</b> <input type="text" name="phones" id="phones" value=""></div>
			<div><b>Количество:</b> <input type="text" name="kolls" id="kolls" value=""></div>
			<input type="hidden" style="width:30px;" name="namess" id="namess" value="">
			<input type="button" class="button" id="safdsgds" value="Запросить">
		</form>
	</div>
	
	<a class="back-button tmp5" style="margin-left: 0px;margin-top: 25px;display: inline-block;" href="javascript:window.history.back();">Назад</a>
	<div class="next-prev-col-buttons" style="display: inline;margin-left: 15px;">
		<?if($urls['prev']){?>
			<a href='<?=BASE_PATH_HREF.$urls['prev']?>'>&lt; предыдущая коллекция</a>
		<?}?>
		<?if($urls['next']){?>
			<a href='<?=BASE_PATH_HREF.$urls['next']?>'>следующая коллекция &gt;</a>
		<?}?>
	</div>
	<script type="text/javascript">
	
	$(window).load(function () {
		
		 $('html, body').stop().animate({scrollLeft: 0, scrollTop:$('.scroll-to-parent').offset().top}, 2000);
		 
		 
		
		 
		
	});
	
	
	
	
	
	$(document).ready(function(){
		
		
		
		
		
		
		
		
		var scrollTop = $('.text_zag2').offset().top;
		$(document).scrollTop(scrollTop);
		 $("#phones").mask("+7 (999) 999-9999");

		
		$('.icons_cfyc').fancybox({
			'afterLoad': function() {
				$('#namess').val($(this.element).attr('namess'));
				$('.sdsfgss').html($(this.element).attr('namess'));
				
			}
		});
		
		$('.cart-button').click(function(){
			var id = $(this).attr('rel');
			var status = $('#cart-box-' + id).css('display');
			$('.cart-box').each(function(){ $(this).css('display', 'none'); });
			if(status == 'none'){ 
				$('#cart-box-' + id).css('display', 'block');
				//$('#cc-' + id).focus().select();
			}
			else $('#cart-box-' + id).css('display', 'none');
		});

		$('#safdsgds').click(function(){
			var err=0;
			if($('#phones').val()==""){alert('Заполните телефон');err=1;}
			if($('#kolls').val()==""){alert('Укажите количество');err=1;}
			if(err==0){
				$.post("/mail_post.php", { phone: $('#phones').val(), coll: $('#kolls').val(), name:$('#namess').val() },function(data) {
						 if(data==0){
							 
							$('#hovers').html("<div style='font-size:18px;color:#fff;'><h3>Ваш запрос отправлен!<h3><br>Наш менеджер свяжется с вами в ближайшее время.</div>");
							setTimeout("location.reload()", 2000);

							
						 }else{
							 //alert(data);
							 alert('Не известная ошибка, попробуйте позже');
							 
						 }
						});
				
			}
			
		});
		
		
		
		/*$('.cb-cc').mouseover(function(){
			this.select();
		});*/
		
		$(document).keyup(function (e) {
			if (e.keyCode === 13) {
				$('.cb-cc').each(function(){
					var parent = $(this).parent().parent();
					if(parent.is(':visible')){
						parent.find('a').click();
					}
				});
			}
			if (e.keyCode === 27) {
				$('.cb-cc').each(function(){
					var parent = $(this).parent().parent();
					if(parent.is(':visible')){
						parent.hide();
					}
				});
			}
		});
		
		$('.cb-cc').click(function(){
			$(this).val('');
		});
		
		$('.cb-cc').keyup(function(){
			var data = $(this).val();
			var type = $(this).data('type');
			$(this).val(input_check(data,type));
		});
		
		$('.elem-name, .elem-img').click(function(){
			var id = $(this).attr('rel');
			openCloseFull(id);
			 
		});
		$('.cart-box-full-close').click(function(){
			var id = $(this).attr('rel');
			$('#cart-box-full-' + id).css('display', 'none');
			//openCloseFull(id);
		});

		function openCloseFull(id)
		{	
			
			var status = $('#cart-box-full-' + id).css('display');

			$('.cart-box-full').each(function(){ $(this).css('display', 'none'); });

			if(status == 'none'){
				$('#cart-box-full-' + id).css('display', 'block');
				//$('#cc2-' + id).focus().select();
			}
			else $('#cart-box-full-' + id).css('display', 'none');
			
			
			
 				
				var main_img_width=$('#cart-box-full-' + id +' .elem-img2 .goods_img2').width();
				var main_img_height=$('#cart-box-full-' + id +' .elem-img2 .goods_img2').height();
			
				if((main_img_width+100)<main_img_height){
				//вертикальная картинка	
				
				
				var w_tmp=$('#cart-box-full-' + id +' .elem-img2').width();
				w_tmp=parseInt(w_tmp)+250;
				
				$('#cart-box-full-' + id +'').css("width",w_tmp+"px");
				$('#cart-box-full-' + id +' .dfgddf').css("width","200px");
				$('#cart-box-full-' + id +' .dfgddf .rdescr').css("width","100%");
				$('#cart-box-full-' + id +' .butts').css("float","left");
				$('#cart-box-full-' + id +' .butts').css("margin-top","20px");
				
				$('#cart-box-full-' + id +'').removeClass('horizontal');
				$('#cart-box-full-' + id +'').addClass('vertical');
				$('#cart-box-full-' + id +'').removeClass('h_min');
				$('#cart-box-full-' + id +'').removeClass('h_max');
				
				var of=$('#cart-box-full-' + id +' .elem-img2 .goods_img2').offset().top - $(window).scrollTop();
				var h=$('#cart-box-full-' + id +' .elem-img2 .goods_img2').height();
				
				h=parseInt(h)+30;
				h=parseInt(h)+parseInt(of);
				
				w_h=getPageSize();
				
				console.log(w_h);
				
				
				if(w_h[3] < h){
					$('#cart-box-full-' + id +'').addClass('h_min');
				}else{
					$('#cart-box-full-' + id +'').addClass('h_max');	
				}
				
				
				
				
				}else{
				//горизонтальная или квадратная картинка
				
				
				if(main_img_width<550){ main_img_width=550; }	
				if(main_img_height>350){ main_img_height=350; }	
				
				$('#cart-box-full-' + id +' .elem-img2').css("width","auto");
				$('#cart-box-full-' + id +' .dfgddf').css("width","100%");
				$('#cart-box-full-' + id +' .dfgddf').css("max-width","100%");
				$('#cart-box-full-' + id +' .dfgddf .rdescr').css("width","auto");
				$('#cart-box-full-' + id +' .count-cart.aaaaaa').css("clear","none");
				$('#cart-box-full-' + id +' .dfgddf .rdescr').css("margin-top","17px");
				$('#cart-box-full-' + id +' .butts').css("clear","none");
				$('#cart-box-full-' + id +' .butts').css("float","right");
				$('#cart-box-full-' + id +' .butts').css("display","inline-block");
				$('#cart-box-full-' + id +' .butts').css("margin-top","10px");
				$('#cart-box-full-' + id +' .count-cart.aaaaaa').css("margin-bottom","0px");
				$('#cart-box-full-' + id +'').css("width",main_img_width+"px");
				$('#cart-box-full-' + id +' .goods_img2').css("height","auto");
				$('#cart-box-full-' + id +' .goods_img2').css("max-height","500px");
				$('#cart-box-full-' + id +'').css('height','auto');
				//alert(main_img_height);
				if(main_img_height==350){
					$('#cart-box-full-' + id +' .elem-img2').css("width","auto");	
					$('#cart-box-full-' + id +' .goods_img2').css("width","auto");	
					$('#cart-box-full-' + id +' .goods_img2').css("max-height",main_img_height+"px");
					$('#cart-box-full-' + id +' .goods_img2').css("height",main_img_height+"px");
				}
				
				 
				$('#cart-box-full-' + id +'').removeClass('vertical');
				$('#cart-box-full-' + id +'').addClass('horizontal');
				
				
				}
			
		
			
			
			
		}

		$('.link-to-cart > a').click(function(){
			var id = $(this).attr('rel');
			var price = $('.elem-' + id + ' > .elem-price-cart > span').html();
			var count = $('#cc-' + id).val();
			count = count.split(',').join('.');

			if(count > 0) addToCart(id, count, price);
		});

		$('.add-to-cart').click(function(){
			var id = $(this).attr('rel');
			var price = $('.elem-' + id + ' > .elem-price-cart > span').html();
			var count = $('#cc2-' + id).val();
			if(count > 0) addToCart(id, count, price);
		});

		function addToCart(id, count, price)
		{
			console.log(id + ' / ' + count + ' / ' + price);
			$('.shop_form input[name="good_id"]').val(id);
			$('.shop_form .inpnum').val(count);
			$('.shop_form').submit();

			$('.cart-box').each(function(){ $(this).css('display', 'none'); });
			$('.cart-box-full').each(function(){ $(this).css('display', 'none'); });

			alert('Товар отправлен в корзину');
		}


		function getPageSize(){
			var xScroll, yScroll;
			if (window.innerHeight && window.scrollMaxY) {
			xScroll = document.body.scrollWidth;
			yScroll = window.innerHeight + window.scrollMaxY;
			} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
			xScroll = document.body.scrollWidth;
			yScroll = document.body.scrollHeight;
			} else if (document.documentElement && document.documentElement.scrollHeight > document.documentElement.offsetHeight){ // Explorer 6 strict mode
			xScroll = document.documentElement.scrollWidth;
			yScroll = document.documentElement.scrollHeight;
			} else { // Explorer Mac...would also work in Mozilla and Safari
			xScroll = document.body.offsetWidth;
			yScroll = document.body.offsetHeight;
			}
			var windowWidth, windowHeight;
			if (self.innerHeight) { // all except Explorer
			windowWidth = self.innerWidth;
			windowHeight = self.innerHeight;
			} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
			windowWidth = document.documentElement.clientWidth;
			windowHeight = document.documentElement.clientHeight;
			} else if (document.body) { // other Explorers
			windowWidth = document.body.clientWidth;
			windowHeight = document.body.clientHeight;
			}
			// for small pages with total height less then height of the viewport
			if(yScroll < windowHeight){
			pageHeight = windowHeight;
			} else {
			pageHeight = yScroll;
			}
			// for small pages with total width less then width of the viewport
			if(xScroll < windowWidth){
			pageWidth = windowWidth;
			} else {
			pageWidth = xScroll;
			}
			return [pageWidth,pageHeight,windowWidth,windowHeight];
		}


		$(document).mouseup(function (e)
		{
			var container1 = $('.cart-button');
			if (typeof container1 !== 'undefined' && !container1.is(e.target) // if the target of the click isn't the container...
					&& $(e.target).attr('class') != 'cb-cc' 
					&& $(e.target).attr('class') != 'cart-button' 
					&& $(e.target).attr('class') != 'cart-box'
					&& $(e.target).attr('class') != 'add-to-cart') 
			{	
				$('.cart-box').css('display', 'none');
			}

			var container2 = $('.elem-name');
			if (typeof container2 !== 'undefined' && !container2.is(e.target) // if the target of the click isn't the container...
					&& $(e.target).attr('class') != 'elem-name' 
					&& $(e.target).attr('class') != 'cb-cc'
					&& $(e.target).attr('class') != 'cart-box-full'
					&& $(e.target).attr('class') != 'goods_img'
					&& $(e.target).attr('class') != 'add-to-cart') // ... nor a descendant of the container
			{	
				$('.cart-box-full').css('display', 'none');
			}
		});
		$('.elem-name, .elem-img').click(function (e)
		{
			var id = $(this).attr('rel');
			if($(window).height()<$('#cart-box-full-'+id).height()+e.clientY+$(this).height()){
				$('html, body').animate({
					scrollTop: $('#cart-box-full-'+id).offset().top
				}, 500);
			}
		});
	});
	</script>
	<?
	$_SESSION['mania'][]=$smotr_colection;
	?>