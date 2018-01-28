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
							echo '<a href="'.$image['src'].'" class="big_img_show" big-img="'.$images_big['src'].'"><img src="'.$image['src'].'" alt="'.strip_tags($image['alt']).'" /></a>';
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
		<div class="text_zag2">Коллекция <?=$result['name'].', '.$categorys['factory'].' ('.$categorys['country_rus'].')'?></div>
		<div class="clear2"></div>
		<div class="text_zag3">Фабрика <span class="mf"><a href="<?=BASE_PATH_HREF.$categorys['factory_url']?>/"><?=$categorys['factory']?></a></span> <span class="cn">(<?=$categorys['country']?>)</span></div>
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
			$query = DB::query('SELECT s.id, s.[name], s.sort,s.view, r.rewrite FROM {shop_rel} sr
									LEFT JOIN {shop} s ON s.id = sr.rel_element_id
									LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.element_id = s.id
								WHERE s.[act] = "1" AND s.trash = "0" AND sr.element_id = "'.$result['id'].'" AND sr.trash = "0" AND s.cat_id = "8" ORDER BY s.sort ASC');
								
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
									'view'			=> $selm['view']
						);
				}
			}
			//print_r(json_decode($_GET['data']));
			asort($arr_prises);
			$smotr_colection['prise']=$arr_prises[0];
			if(isset($elements['Настенная плитка']) && count($elements['Настенная плитка']) > 0)
			{
				echo '<div class="text_zag"><h2>Настенная плитка<h2></div>';
				
				echo '<div class="elem-coll-container">';
				foreach($elements['Настенная плитка'] as $element)
				{
					echo '<div class="element-coll elem-'.$element['id'].'">';
					
					echo '<div class="elem-img" rel="'.$element['id'].'">';
					$images = $this->diafan->_images->get("el-220", $element['id'], "shop", 29, $element['name'], false);
					// картинка элемента
					if(!empty($images[0]))
						
					{
						$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
						echo '<img class="goods_img" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
					}
					echo '</div>';
					
					echo '<div class="cart-box-full-container">';
					echo '<div class="elem-name" rel="'.$element['id'].'">'.$element['name'].'</div>';
						// скрытое описание элемента
						echo '<div class="cart-box-full" id="cart-box-full-'.$element['id'].'">';
						echo '<div class="cart-box-full-close" rel="'.$element['id'].'"></div>';
						echo '<div class="text_zag"><a href="'.$element['url'].'">'.$element['name'].' <span>('.$element['size'].')</span></a></div>';
						echo '<div class="elem-img2">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" imds="'.$images[0]['src'].'" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';
						echo '<div class="dfgddf">';
						//<div class="rdescr">Название: <span class="name"><a href="'.$element['url'].'">'.$element['name'].'</a> </span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Тип: <span class="base">'.$element['ptype'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Единица измерения: <span class="base">'.$element['size_type'].'</span></div>';
						//echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Размер: <span class="base">'.$element['size'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Материал: <span class="base">'.$element['material'].'</span></div>';
						///echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Коллекция: <span class="name">'.$result['name'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Фабрика: <span class="name"><a href="'.BASE_PATH_HREF.$categorys['factory_url'].'/">'.$categorys['factory'].'</a></span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Cтрана: <span class="name"><a href="'.BASE_PATH_HREF.$categorys['country_url'].'/">'.$categorys['country_rus'].'</a></span></div>';
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">Добавить в корзину</a></span></div>';
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Наличие образца в зале</a>';
						echo '</div></div>';
						// ------------------------------------------
					echo '</div>';

					echo '<div class="elem-size">'.$element['size'].'</div>';
					echo '<div class="elem-ptype">'.$element['ptype'].'</div>';

					echo '<div class="elem-price-cart">';
					echo round($element['price']).' руб/'.$element['size_type'];
					echo '<div class="cart-button" rel="'.$element['id'].'"></div>';
						// скрытая корзина
						echo '<div class="cart-box" id="cart-box-'.$element['id'].'">';
						echo '<div class="count-cart"><input type="text" id="cc-'.$element['id'].'" data-type="'.$element['size_type'].'" name="cc-'.$element['id'].'" value="0" class="cb-cc"><span>'.$element['size_type'].'</span></div>';
						echo '<div class="link-to-cart"><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">Добавить в корзину</a></div>';
						echo '</div>';
						// ------------------------------------------
					echo '</div>';

					echo '</div>';
					if($element['view']=="br"){echo "<div style='clear:both;'></div>";}
				}
				echo '</div>';
			}
			if(isset($elements['Напольная плитка']) && count($elements['Напольная плитка']) > 0)
			{
				echo '<div class="text_zag"><h2>Напольная плитка</h2></div>';

				echo '<div class="elem-coll-container">';
				foreach($elements['Напольная плитка'] as $element)
				{
					echo '<div class="element-coll elem-'.$element['id'].'">';
					
					echo '<div class="elem-img" rel="'.$element['id'].'">';
					$images = $this->diafan->_images->get("el-220", $element['id'], "shop", 29, $element['name'], false);
					// картинка элемента
					if(!empty($images[0]))
					{
						echo '<img class="goods_img" src="'.$images[0]['src'].'" alt="'.$element['name'].'">';
					}
					echo '</div>';
					
					echo '<div class="cart-box-full-container">';
					echo '<div class="elem-name" rel="'.$element['id'].'">'.$element['name'].'</div>';
						// скрытое описание элемента
						echo '<div class="cart-box-full" id="cart-box-full-'.$element['id'].'">';
						echo '<div class="cart-box-full-close" rel="'.$element['id'].'"></div>';
						echo '<div class="text_zag"><a href="'.$element['url'].'">'.$element['name'].' <span>('.$element['size'].')</span></a></div>';
						echo '<div class="elem-img2">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" imds="'.$images[0]['src'].'" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';
						echo '<div class="dfgddf">';
						//<div class="rdescr">Название: <span class="name"><a href="'.$element['url'].'">'.$element['name'].'</a></span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Тип: <span class="base">'.$element['ptype'].'</span></div>';
						//echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Единица измерения: <span class="base">'.$element['size_type'].'</span></div>';
						//echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Размер: <span class="base">'.$element['size'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Материал: <span class="base">'.$element['material'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Коллекция: <span class="name">'.$result['name'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Фабрика: <span class="name"><a href="'.BASE_PATH_HREF.$categorys['factory_url'].'/">'.$categorys['factory'].'</a></span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Cтрана: <span class="name"><a href="'.BASE_PATH_HREF.$categorys['country_url'].'/">'.$categorys['country_rus'].'</a></span></div>';
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span><a href="javascript:void(0)"  class="add-to-cart" rel="'.$element['id'].'">Добавить в корзину</a></span></div>';
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Наличие образца в зале</a>';
						echo '</div></div>';
						// ------------------------------------------
					echo '</div>';

					echo '<div class="elem-size">'.$element['size'].'</div>';
					echo '<div class="elem-ptype">'.$element['ptype'].'</div>';

					echo '<div class="elem-price-cart">';
					echo round($element['price']).' руб/'.$element['size_type'];
					echo '<div class="cart-button" rel="'.$element['id'].'"></div>';
						// скрытая корзина
						echo '<div class="cart-box" id="cart-box-'.$element['id'].'">';
						echo '<div class="count-cart"><input type="text" id="cc-'.$element['id'].'" name="cc-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span></div>';
						echo '<div class="link-to-cart"><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">Добавить в корзину</a></div>';
						
						
						echo '</div>';
						// ------------------------------------------
					echo '</div>';

					echo '</div>';
					if($element['view']=="br"){echo "<div style='clear:both;'></div>";}
				}
				echo '</div>';
			}
			if(isset($elements['Декоративные элементы']) && count($elements['Декоративные элементы']) > 0)
			{
				echo '<div class="text_zag"><h2>Декоративные элементы</h2></div>';

				echo '<div class="elem-coll-container">';
				foreach($elements['Декоративные элементы'] as $element)
				{
					echo '<div class="element-coll elem-'.$element['id'].'">';
					
					echo '<div class="elem-img" rel="'.$element['id'].'">';
					$images = $this->diafan->_images->get("el-220", $element['id'], "shop", 29, $element['name'], false);
					// картинка элемента
					if(!empty($images[0]))
					{
						echo '<img class="goods_img" src="'.$images[0]['src'].'" alt="'.$element['name'].'">';
					}
					echo '</div>';
					
					echo '<div class="cart-box-full-container">';
					echo '<div class="elem-name" rel="'.$element['id'].'">'.$element['name'].'</div>';
						// скрытое описание элемента
						echo '<div class="cart-box-full" id="cart-box-full-'.$element['id'].'">';
						echo '<div class="cart-box-full-close" rel="'.$element['id'].'"></div>';
						echo '<div class="text_zag"><a href="'.$element['url'].'">'.$element['name'].' <span>('.$element['size'].')</span></a></div>';
						echo '<div class="elem-img2">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" imds="'.$images[0]['src'].'" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';
						echo '<div class="dfgddf">';
						//<div class="rdescr">Название: <span class="name"><a href="'.$element['url'].'">'.$element['name'].'</a></span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Тип: <span class="base">'.$element['ptype'].'</span></div>';
						//echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Единица измерения: <span class="base">'.$element['size_type'].'</span></div>';
						//echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Размер: <span class="base">'.$element['size'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Материал: <span class="base">'.$element['material'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Коллекция: <span class="name">'.$result['name'].'</span></div>';
						//echo '<div class="clear4"></div>';
						//e//cho '<div class="rdescr">Фабрика: <span class="name"><a href="'.BASE_PATH_HREF.$categorys['factory_url'].'/">'.$categorys['factory'].'</a></span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Cтрана: <span class="name"><a href="'.BASE_PATH_HREF.$categorys['country_url'].'/">'.$categorys['country_rus'].'</a></span></div>';
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">Добавить в корзину</a></span></div>';
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Наличие образца в зале</a>';
						echo '</div></div>';
						// ------------------------------------------
					echo '</div>';

					echo '<div class="elem-size">'.$element['size'].'</div>';
					echo '<div class="elem-ptype">'.$element['ptype'].'</div>';

					echo '<div class="elem-price-cart">';
					echo round($element['price']).' руб/'.$element['size_type'];
					echo '<div class="cart-button" rel="'.$element['id'].'"></div>';
						// скрытая корзина
						echo '<div class="cart-box" id="cart-box-'.$element['id'].'">';
						echo '<div class="count-cart"><input type="text" id="cc-'.$element['id'].'" name="cc-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span></div>';
						echo '<div class="link-to-cart"><a href="javascript:void(0)" class="add-to-cart" rel="'.$element['id'].'">Добавить в корзину</a></div>';
						echo '</div>';
						// ------------------------------------------
					echo '</div>';

					echo '</div>';
					if($element['view']=="br"){echo "<div style='clear:both;'></div>";}
					
				}
				echo '</div>';
			}
		?>
	</div>
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
	
	<a class="back-button" style="margin-left: 0px;margin-top: 25px;display: inline-block;" href="javascript:window.history.back();">Назад</a>
	<div class="next-prev-col-buttons" style="display: inline;margin-left: 15px;">
		<?if($urls['prev']){?>
			<a href='<?=BASE_PATH_HREF.$urls['prev']?>'>&lt; предыдущая коллекция</a>
		<?}?>
		<?if($urls['next']){?>
			<a href='<?=BASE_PATH_HREF.$urls['next']?>'>следующая коллекция &gt;</a>
		<?}?>
	</div>
	<script type="text/javascript">
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
				$('#cc-' + id).focus().select();
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
							$('#hovers').html("<div style='font-size:18px;color:#fff;'><h3>Ваш запрос отправлен!<h3><br>с вами связжется наш менеджер.</div>");
						 }else{
							 alert('Не известная ошибка, попробуйте позже');
							 
						 }
						});
				
			}
			
		});
		
		
		
		$('.cb-cc').mouseover(function(){
			this.select();
		});
		
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
			alert("1");
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
				$('#cc2-' + id).focus().select();
			}
			else $('#cart-box-full-' + id).css('display', 'none');
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