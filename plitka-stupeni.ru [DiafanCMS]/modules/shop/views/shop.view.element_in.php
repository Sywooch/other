<?php
/**
 * [магазин] Страница товара коллекции
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

$collection = DB::fetch_array(DB::query('SELECT s.id, s.name1 AS collection, r1.rewrite AS coll_url,sc.parent_id as parent_fabric_id,sc.name1 AS fabric, r2.rewrite AS fabric_url FROM {shop_rel} sr
												LEFT JOIN {shop} s ON s.id = sr.element_id AND s.[act] = "1" AND s.trash = "0"
												LEFT JOIN {rewrite} r1 ON r1.module_name = "shop" AND r1.element_id = s.id
												LEFT JOIN {shop_category} sc ON sc.id = s.cat_id AND sc.[act] = "1" AND sc.trash = "0"
												LEFT JOIN {rewrite} r2 ON r2.module_name = "shop" AND r2.cat_id = sc.id
											WHERE sr.rel_element_id = "'.$result['id'].'"'));
$country  = DB::fetch_array(DB::query('SELECT c.name_rus1 as country, r.rewrite as country_url  
									   FROM {shop_category} c
									   LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.cat_id = c.id
									   WHERE c.id = "'.$collection['parent_fabric_id'].'"'));

echo '<div class="text">';
	# print_r($collection);
	echo '<div class="cart-box-full-container">';
		// скрытое описание элемента
		echo '<div class="cart-box-full-in" id="cart-box-full-'.$result['id'].'">';
		# echo '<div class="text_zag">'.$result['name'].' <span>('.$result['size'].')</span></div>';
		echo '<div class="elem-img">';
		$images = $this->diafan->_images->get("el-220", $result['id'], "shop", 29, $result['name'], false);
		if(!empty($images[0]))
		{
			$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
			echo '<img class="goods_img" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
		}
		echo '</div>';
		echo '<div class="rdescr">Название: <span class="name">'.$result['name'].'</span></div>';
		echo '<div class="clear4"></div>';
		echo '<div class="rdescr">Тип: <span class="base">'.$result['ids_param'][7]['value'].'</span></div>';
		echo '<div class="clear4"></div>';
		echo '<div class="rdescr">Цена: <span class="price">'.$result['price'].' руб/'.$result['ids_param'][5]['value'].'</span></div>';
		echo '<div class="clear4"></div>';
		echo '<div class="rdescr">Единица измерения: <span class="base">'.$result['ids_param'][5]['value'].'</span></div>';
		echo '<div class="clear4"></div>';
		echo '<div class="rdescr">Размер: <span class="base">'.$result['ids_param'][4]['value'].'</span></div>';
		echo '<div class="clear4"></div>';
	echo '<div class="rdescr">Материал: <span class="base">'.$result['ids_param'][3]['value'].'</span></div>';
		echo '<div class="clear4"></div>';
		echo '<div class="rdescr">Коллекция: <span class="name"><a href="'.BASE_PATH_HREF.$collection['coll_url'].'/">'.$collection['collection'].'</a></span></div>';
		echo '<div class="clear4"></div>';
		echo '<div class="rdescr">Фабрика: <span class="name"><a href="'.BASE_PATH_HREF.$collection['fabric_url'].'/">'.$collection['fabric'].'</a></span></div>';
		echo '<div class="clear4"></div>';
		echo '<div class="rdescr">Cтрана: <span class="name"><a href="'.BASE_PATH_HREF.$country['country_url'].'/">'.$country['country'].'</a></span></div>';
		echo '<div class="count-cart">';
			echo '<div class="price-background">';
			echo '<input type="text" id="cc2-'.$result['id'].'" name="cc2-'.$result['id'].'" value="0" data-type="'.$result['ids_param'][5]['value'].'" class="cb-cc"><span>'.$result['ids_param'][5]['value'].'</span>';
			echo '</div>';
			echo '<div class="price-button-background">';
			echo '<span class="add-to-cart"><a href="javascript:void(0)" rel="'.$result['id'].'">Добавить в корзину</a></span>';
			echo '</div>';
		//echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
		echo '</div>';
		echo '</div>';
		// ------------------------------------------
	echo '</div>';
	
	echo '<div class="clear3"></div>';

	echo '<div class="text_zag" style="font-size:20px;">Все элементы коллекции <a href="'.BASE_PATH_HREF.$collection['coll_url'].'/">'.$collection['collection'].'</a></div>';

			$isDiscount = DB::fetch_array(DB::query('SELECT do.discount_id, d.discount FROM {shop_discount_object} do
																				LEFT JOIN {shop_discount} d ON d.id = do.discount_id
																			WHERE do.good_id = "'.$collection['id'].'" AND d.trash = "0" AND d.date_finish < "'.time().'"'));
			
			$query = DB::query('SELECT s.id, s.[name], r.rewrite FROM {shop_rel} sr
									LEFT JOIN {shop} s ON s.id = sr.rel_element_id AND s.[act] = "1" AND s.trash = "0"
									LEFT JOIN {rewrite} r ON r.module_name = "shop" AND r.element_id = s.id
								WHERE s.[act] = "1" AND s.trash = "0" AND sr.element_id = "'.$collection['id'].'" AND sr.trash = "0" AND s.id  AND s.cat_id = "8"');
			$count = DB::num_rows($query);
			$elements = array();
			if($count > 0)
			{
				$sm = new Shop_model($this->diafan);
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

					$pr = $this->diafan->_shop->price_get_all($selm['id'], $this->diafan->_user->id);
					$price = $pr[0]['price'];

					$elements[$plitka_type][] = array(
									'id'			=> $selm['id'],
									'name'			=> $selm['name'],
									'url'			=> BASE_PATH_HREF.$selm['rewrite'].'/',
									'price'			=> $price,
									'size_type'		=> $size_type,
									'size'			=> $size,
									'material'		=> $material,
									'plitka_type'	=> $plitka_type,
									'ptype'			=> $ptype
						);
				}
			}

			if(isset($elements['Настенная плитка']) && count($elements['Настенная плитка']) > 0)
			{
				 echo '<div class="text_zag">Настенная плитка</div>';
				
				echo '<div class="elem-coll-container">';
				foreach($elements['Настенная плитка'] as $element)
				{
					echo '<div class="element-coll elem-'.$element['id'].' '.(($element['id']==$result['id'])?"ramcas":"").'">';
					
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
						echo '<div class="elem-img">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';
						echo '<div class="dfgddf">';
						//echo '<div class="rdescr">Название: <span class="name"><a href="'.$element['url'].'">'.$element['name'].'</a></span></div>';
						//echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Тип: <span class="base">'.$element['ptype'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Единица измерения: <span class="base">'.$element['size_type'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Размер: <span class="base">'.$element['size'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Материал: <span class="base">'.$element['material'].'</span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Коллекция: <span class="name"><a href="'.BASE_PATH_HREF.$collection['coll_url'].'/">'.$collection['collection'].'</a></span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Фабрика: <span class="name"><a href="'.BASE_PATH_HREF.$collection['fabric_url'].'/">'.$collection['fabric'].'</a></span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Cтрана: <span class="name"><a href="'.BASE_PATH_HREF.$country['country_url'].'/">'.$country['country'].'</a></span></div>';
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span class="add-to-cart"><a href="javascript:void(0)" rel="'.$element['id'].'">Добавить в корзину</a></span></div>';
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Наличие образца в зале</a>';
						echo '</div>';
						// ------------------------------------------
					echo '</div>';
echo '</div>';
					echo '<div class="elem-size">'.$element['size'].'</div>';
					echo '<div class="elem-ptype">'.$element['ptype'].'</div>';

					echo '<div class="elem-price-cart">';
					echo round($element['price']).' руб/'.$element['size_type'];
					echo '<div class="cart-button" rel="'.$element['id'].'"></div>';
						// скрытая корзина
						echo '<div class="cart-box" id="cart-box-'.$element['id'].'">';
						echo '<div class="count-cart"><input type="text" id="cc-'.$element['id'].'" name="cc-'.$element['id'].'" value="0"  data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span></div>';
						echo '<div class="link-to-cart"><a href="javascript:void(0)" rel="'.$element['id'].'">Добавить в корзину</a></div>';
						echo '</div>';
						// ------------------------------------------
					echo '</div>';

					echo '</div>';
				}
				echo '</div>';
			}
			if(isset($elements['Напольная плитка']) && count($elements['Напольная плитка']) > 0)
			{
				 echo '<div class="text_zag">Напольная плитка</div>';

				echo '<div class="elem-coll-container">';
				foreach($elements['Напольная плитка'] as $element)
				{
					echo '<div class="element-coll elem-'.$element['id'].' '.(($element['id']==$result['id'])?"ramcas":"").'" >';
					
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
						echo '<div class="elem-img">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';echo '<div class="dfgddf">';
						//echo '<div class="rdescr">Название: <span class="name"><a href="'.$element['url'].'">'.$element['name'].'</a></span></div>';
						//echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Тип: <span class="base">'.$element['ptype'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						//echo '<div class="rdescr">Единица измерения: <span class="base">'.$element['size_type'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Размер: <span class="base">'.$element['size'].'</span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Материал: <span class="base">'.$element['material'].'</span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Коллекция: <span class="name"><a href="'.BASE_PATH_HREF.$collection['coll_url'].'/">'.$collection['collection'].'</a></span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Фабрика: <span class="name"><a href="'.BASE_PATH_HREF.$collection['fabric_url'].'/">'.$collection['fabric'].'</a></span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Cтрана: <span class="name"><a href="'.BASE_PATH_HREF.$country['country_url'].'/">'.$country['country'].'</a></span></div>';
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span class="add-to-cart"><a href="javascript:void(0)" rel="'.$element['id'].'">Добавить в корзину</a></span></div>';
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Наличие образца в зале</a>';
						echo '</div>';
						echo '</div>';
						
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
						echo '<div class="link-to-cart"><a href="javascript:void(0)" rel="'.$element['id'].'">Добавить в корзину</a></div>';
						echo '</div>';
						// ------------------------------------------
					echo '</div>';

					echo '</div>';
				}
				echo '</div>';
			}
			if(isset($elements['Декоративные элементы']) && count($elements['Декоративные элементы']) > 0)
			{
				 echo '<div class="text_zag">Декоративные элементы</div>';

				echo '<div class="elem-coll-container">';
				foreach($elements['Декоративные элементы'] as $element)
				{
					echo '<div class="element-coll elem-'.$element['id'].' '.(($element['id']==$result['id'])?"ramcas":"").'">';
					
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
						echo '<div class="elem-img">';
						if(!empty($images[0]))
						{
							$img_link = BASE_PATH_HREF.USERFILES."/original/".substr($images[0]['src'],strrpos($images[0]['src'],'/')+1,strlen($images[0]['src']));
							echo '<img class="goods_img2" src="'.$img_link.'" alt="'.strip_tags($result['name']).'">';
						}
						echo '</div>';
						echo '<div class="dfgddf">';
						//echo '<div class="rdescr">Название: <span class="name"><a href="'.$element['url'].'">'.$element['name'].'</a></span></div>';
						//echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Тип: <span class="base">'.$element['ptype'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Цена: <span class="price">'.round($element['price']).' руб/'.$element['size_type'].'</span></div>';
					//	echo '<div class="clear4"></div>';
					//	echo '<div class="rdescr">Еденица измерения: <span class="base">'.$element['size_type'].'</span></div>';
					//	echo '<div class="clear4"></div>';
						echo '<div class="rdescr">Размер: <span class="base">'.$element['size'].'</span></div>';
				//		echo '<div class="clear4"></div>';
				//		echo '<div class="rdescr">Материал: <span class="base">'.$element['material'].'</span></div>';
				//		echo '<div class="clear4"></div>';
				//		echo '<div class="rdescr">Коллекция: <span class="name"><a href="'.BASE_PATH_HREF.$collection['coll_url'].'/">'.$collection['collection'].'</a></span></div>';
				//		echo '<div class="clear4"></div>';
				//		echo '<div class="rdescr">Фабрика: <span class="name"><a href="'.BASE_PATH_HREF.$collection['fabric_url'].'/">'.$collection['fabric'].'</a></span></div>';
				//		echo '<div class="clear4"></div>';
				//		echo '<div class="rdescr">Cтрана: <span class="name"><a href="'.BASE_PATH_HREF.$country['country_url'].'/">'.$country['country'].'</a></span></div>';
						echo '<div class="count-cart aaaaaa"><input type="text" id="cc2-'.$element['id'].'" name="cc2-'.$element['id'].'" value="0" data-type="'.$element['size_type'].'" class="cb-cc"><span>'.$element['size_type'].'</span><span class="add-to-cart"><a href="javascript:void(0)" rel="'.$element['id'].'">Добавить в корзину</a></span></div>';
						echo '<a href="'.$element['url'].'" class="butts">Все параметры</a>';
						echo '<a href="#hovers" class="icons_cfyc" namess="'.$element['name'].'">Наличие образца в зале</a>';
						echo '</div>';
						echo '</div>';
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
						echo '<div class="link-to-cart"><a href="javascript:void(0)" rel="'.$element['id'].'">Добавить в корзину</a></div>';
						echo '</div>';
						// ------------------------------------------
					echo '</div>';

					echo '</div>';
				}
				echo '</div>';
			}

echo '</div>';
?>
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
	<!--<a class="back-button" style="margin-left: 0px;margin-top: 25px;display: inline-block;" href="javascript:window.history.back();">Назад к списку коллекций</a>
	<div class="next-prev-col-buttons" style="display: inline;margin-left: 15px;">
		<a href="javascript:void(0);" id="prev2">&lt; предыдущая коллекция</a>
		<a href="javascript:void(0);" id="next2">следующая коллекция &gt;</a>
	</div>-->
	<script type="text/javascript">
	$(document).ready(function(){
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
		$("#phones").mask("+7 (999) 999-9999");

		
		$('.icons_cfyc').fancybox({
			'afterLoad': function() {
				$('#namess').val($(this.element).attr('namess'));
				$('.sdsfgss').html($(this.element).attr('namess'));
				
			}
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
		
		$('.cb-cc').keyup(function(){
			var data = $(this).val();
			var type = $(this).data('type');
			$(this).val(input_check(data,type));
		});
		
		$('.cb-cc').click(function(){
			$(this).val('');
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
				$('#cc2-' + id).focus().select();
			}
			else $('#cart-box-full-' + id).css('display', 'none');
		}

		$('.link-to-cart > a').click(function(){
			var id = $(this).attr('rel');
			var price = $('.elem-' + id + ' > .elem-price-cart > span').html();
			var count = $('#cc-' + id).val();
			
			if(count > 0) addToCart(id, count, price);
		});

		$('.add-to-cart > a').click(function(){
			var id = $(this).attr('rel');
			var price = $('.elem-' + id + ' > .elem-price-cart > span').html();
			var count = $('#cc2-' + id).val();
			count = count.split(',').join('.');

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