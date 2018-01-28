<?php
/**
 * [магазин] Список элементов по характеристике
 *
 * Шаблон вывода списка товаров 
 * в группе товаров, в результатах поиска или если группировка не используется
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}
//print_r($result);
function get_price_and_size($rows)
{
	foreach ($rows as &$row)
	{
		$excelPrise = '';
		foreach($row['param'] as $param)
		{	
			if($param['id'] == 8 && strip_tags($param['value']) > 0)
			{
				$excelPrise = strip_tags($param['value']);
			}
			if($param['id'] == 9)
			{
				$size = 'руб/'.strip_tags($param['value']);
			}
		}
		if(empty($size)) $size = 'руб/м2';

		if(empty($excelPrise))
		{
			$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
														LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
														LEFT JOIN {shop_param_element} spe ON spe.element_id = sr.rel_element_id AND spe.param_id = "5"
													WHERE spe.value1 = "м2" AND sr.element_id = "'.$row['id'].'"'));
			if(empty($price['price'])){
				$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
													LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
													LEFT JOIN {shop_param_element} spe ON spe.element_id = sr.rel_element_id AND spe.param_id = "5"
												WHERE spe.value1 = "шт" AND sr.element_id = "'.$row['id'].'"'));
				$size = 'руб/шт';
				if(empty($price['price']))
				{
					$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
													LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
												WHERE sr.element_id = "'.$row['id'].'"'));
					$size = 'руб/м2';
				}
			} else $size = 'руб/м2';
		}
		//print_r($row);
		//echo $excelPrise;
		if($excelPrise=="99999999999"){
			$row['price'] = "Снято с продажи";
		}else{
			$row['price'] = 'от '.(!empty($excelPrise) ? $excelPrise : intval($price['price'])).' '.$size;
		}
	}
	return $rows;
}
function sort_prc($a, $b)
	{
		return strnatcmp($a['price'], $b['price']);
	}

function sort_by_price($arr)
{
	//print_r($arr);
	usort($arr, 'sort_prc'); 
	return $arr;
}
function find_param($array,$param)
{
	foreach($array as $item)
	{
		if(strpos($item,$param)!==false)
			return $item;
	}
	return '';
}
$param = DB::fetch_array(DB::query('SELECT param_id, [name] FROM {shop_param_select} WHERE id = "'.$this->diafan->param.'"'));
$descriptions = DB::fetch_array(DB::query('SELECT [anons], [text] FROM {news} WHERE [name] = "'.$param['name'].'" AND site_id = "53"'));
function check_bonus($id)
{
	$attr = '';
	$check_product = DB::fetch_array(DB::query('SELECT discount_id,s.action,s.new,s.hit FROM {shop} s
										LEFT JOIN {shop_discount_object} d ON d.good_id = s.id
									WHERE (d.discount_id > 0 OR s.action = "1" OR s.new = "1" OR s.hit = "1") AND s.[act] = "1" AND s.trash = "0" AND s.cat_id != "8" AND s.id="'.$id.'"'));
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
	return $attr;
}
?>
<div class="text">
	<!-- <div class="text_zag"><?=$shop_h1?></div> -->
	<?
			echo '<div class="text_t">';
			if($descriptions && !empty($descriptions['anons']) && (empty($this->diafan->page) || $this->diafan->page == 1) && !isset($_GET['view']))
			{
				$this->htmleditor('<index>'.$descriptions['anons'].'</index>');
			}
			else if ($descriptions && !empty($descriptions['anons']) && !isset($_GET['view']))
			{
				$this->htmleditor('<noindex>'.$descriptions['anons'].'</noindex>');
			}
			echo '</div>';
			//print_r($result);
	?>
	<? # if($shop_decription1 && $shop_page == 1) echo '<div class="text_t">'.$shop_decription1.'</div>'; ?>
	<div class="text_zag">
		Коллекции
		<?
			//вывод сортировки товаров
			/*if(! empty($result["link_sort"]))
			{
				$this->get('sort_block', 'shop', $result);
			}*/
			//print_r($result["link_sort"]);
		?>
		<noindex><div class="text_zag_sort">
			Отсортировано по: 
			 <?php if(strpos($_SERVER['REQUEST_URI'],'sort')>0){?>
				<a href="<?= BASE_PATH_HREF .substr($_SERVER['REQUEST_URI'],1,(strpos($_SERVER['REQUEST_URI'],'sort'))-1).
				($_GET['view']=="all" ? '?view=all' : '')?>" style="color:#84b2da" rel="nofollow">популярности</a>		
			<?}else{?>
				<a href="#" class="active">популярности</a>
			<?php } if(strlen($result["link_sort"][1])>0){?>
				<a href="<?= BASE_PATH_HREF .$result["link_sort"][1];?>" style="color:#84b2da" rel="nofollow">цене</a>  
			<?}else{?>
				<a href="#" class="active">цене</a>
			<?php } if(strlen($result["link_sort"][2])>0){?>
			<a href="<?= BASE_PATH_HREF .$result["link_sort"][2];?>" style="color:#84b2da" rel="nofollow">алфавиту</a>
			<?}else{?>
				<a href="#" class="active" rel="nofollow">алфавиту</a>
			<?}?>	
		</div></noindex>
	</div>
<?
	if (!empty($result["rows"]))
	{	
		//print_r($result["rows"]);
		$result["rows"] = get_price_and_size($result["rows"]);
		if(strlen($result["link_sort"][1])==0)
			$result["rows"] = sort_by_price($result["rows"]);
		unset($i); $i = 0;
		$url_params_array = explode('/',$_SERVER['REQUEST_URI']);
		$page             = str_replace('page','',find_param($url_params_array,'page'));
		$sort_type        = find_param($url_params_array,'sort');
		$get_param_string = '?param='.$result["param_id"].'&di_param='.$result["di_param"].'&sort_type='.$sort_type.'&page='.$page;
		foreach ($result["rows"] as $row)
		{	
			# print_r($row['img']);
			echo '<div class="slider2">';
				echo '<div class="photo_on_main_full">';
					$images = $this->diafan->_images->get("cl-265", $row['id'], "shop", $row['site_id'], $row['name'], false);
					# print_r($images);
					$attr = check_bonus($row['id']);
					echo '<div class="photoslider'.$i.' ps-full">';
						if(!empty($images))
						{
							echo '<ul>';
							foreach($images as $image)
							{
								echo '<li>';
								echo '<div class="slider'.$i.'_img" style="position:relative">';
								echo $attr;
								echo '<a href="' . BASE_PATH_HREF . $row["link"] .$get_param_string. '"><img src="'.$image['src'].'" alt="'.strip_tags($image['alt']).'" /></a>';
								echo '</div>';
								echo '</li>';
							}
							echo '</ul>';
						}
					echo '</div>';
					if(!empty($images))
					{
						echo '<div><a href="#" class="prev'.$i.'" id="prevall">&nbsp;</a></div>';
						echo '<div><a href="#" class="next'.$i.'" id="nextall">&nbsp;</a></div>';
					}
				echo '</div>';
				// {PRICE}
				// генерируем из под товаров, берем минимальную цену
				/*
				$isDiscount = DB::fetch_array(DB::query('SELECT do.discount_id, d.discount FROM {shop_discount_object} do
																				LEFT JOIN {shop_discount} d ON d.id = do.discount_id
																			WHERE do.good_id = "'.$row['id'].'" AND d.trash = "0" AND d.date_finish < "'.time().'"'));
				*/
				//$m_tmp=explode(" ",$row['price']);
				echo '<div class="slider1_img_money2 tmp3">'.$row['price'].'</div>';
				echo '<div class="slider1_t tmp1">';
					$categorys = DB::fetch_array(DB::query('SELECT c1.name1 AS factory, c2.name1 AS country, r1.rewrite AS factory_url, r2.rewrite AS country_url FROM {shop_category} c1
														LEFT JOIN {shop_category} c2 ON c2.id = c1.parent_id
														LEFT JOIN {rewrite} r1 ON r1.module_name = "shop" AND r1.cat_id = c1.id
														LEFT JOIN {rewrite} r2 ON r2.module_name = "shop" AND r2.cat_id = c2.id
													WHERE c1.id = "'.$row['cat_id'].'"'));
					# print_r($categorys);
					//setlocale(LC_ALL, "ru_RU.UTF8"); //strtolower strtolower
					//setlocale(LC_ALL, "ru_RU.UTF8");
					echo '<a href="' . BASE_PATH_HREF . $row["link"] .$get_param_string. '">' .''. mb_strtolower($row["name"],'UTF-8') .''. '</a>';
					echo '<span class="slider1_span1"><a href="'.BASE_PATH_HREF.$categorys['factory_url'].'/">'.mb_strtolower($categorys['factory'],'UTF-8').'</a></span>';
					echo '<span class="slider1_span2">('.$categorys['country'].')</span>';
				echo '</div>';
			echo '</div>';

			$i++;
		}
	}
?>
<noindex><div class="text_zag_sort_2">
			Отсортировано по: 
			 <?php if(strpos($_SERVER['REQUEST_URI'],'sort')>0){?>
				<a href="<?= BASE_PATH_HREF .substr($_SERVER['REQUEST_URI'],1,(strpos($_SERVER['REQUEST_URI'],'sort'))-1).
				($_GET['view']=="all" ? '?view=all' : '')?>" style="color:#84b2da" rel="nofollow">популярности</a>		
			<?}else{?>
				<a href="#" class="active">популярности</a>
			<?php } if(strlen($result["link_sort"][1])>0){?>
				<a href="<?= BASE_PATH_HREF .$result["link_sort"][1];?>" style="color:#84b2da" rel="nofollow">цене</a>  
			<?}else{?>
				<a href="#" class="active">цене</a>
			<?php } if(strlen($result["link_sort"][2])>0){?>
			<a href="<?= BASE_PATH_HREF .$result["link_sort"][2];?>" style="color:#84b2da" rel="nofollow">алфавиту</a>
			<?}else{?>
				<a href="#" class="active" rel="nofollow">алфавиту</a>
			<?}?>	
		</div></noidex>
<?//постраничная навигация
if (!empty($result["paginator"]))
{
	echo $result["paginator"];
}

if($descriptions && !empty($descriptions['text']) && (empty($this->diafan->page) || $this->diafan->page == 1) && !isset($_GET['view']))
{
	echo '<div class="text_t">';
	$this->htmleditor($descriptions['text']);
	echo '</div>';
}
?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	if($('.text > .text_t:nth-child(1)').height() != 0)
	{
		var w = $('.text > .text_t:nth-child(1)').height() + 39 + 25 - 105;
		if(w > 0) $('.wrapp_right_box > .menu_right_bg').css('margin-top', (w + 6) + 'px');
	} else $('.text > .text_t:nth-child(1)').height(39 + 25);
});
</script>