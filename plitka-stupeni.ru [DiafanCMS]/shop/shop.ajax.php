<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
 session_start();
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

function first_letter_up($string, $coding='utf-8') {
  if (function_exists('mb_strtoupper') && function_exists('mb_substr') && !empty($string)) {
    preg_match('#(.)#us', mb_strtoupper(mb_strtolower($string, $coding), $coding), $matches);
    $string = $matches[1] . mb_substr($string, 1, mb_strlen($string, $coding), $coding);
  }
  else {
    $string = ucfirst($string);
  }
  return $string;
}

/**
 * Shop_ajax
 *
 * Обработка запроса при добавлении товара в корзину
 */

class Shop_ajax extends Ajax
{

	/**
	 * Обрабатывает полученные данные из формы
	 * 
	 * @return boolean
	 */
	public function ajax_request()
	{
		if (empty($_POST['module']) || $_POST['module'] != 'shop' || empty($_POST['action']))
		{
			return false;
		}
	
		switch ($_POST['action'])
		{
			case 'filter':
			return $this->filter();

			case 'buy':
			return $this->buy();
	
			case 'wish':
			return $this->wish();
	
			case 'wait':
			return $this->wait();
	
			case 'add_coupon':
			return $this->add_coupon();
	
			case 'compare_goods':
			return $this->compare_goods();
	
			case 'compare_delete_goods':
			return $this->compare_delete_goods();
		}
		return false;
	}
	public function get_price_and_size($rows)
	{
		foreach ($rows as &$row)
		{
			$ges = DB::fetch_array(DB::query('SELECT * FROM {shop_param_element} WHERE element_id = "'.$row['id'].'" AND param_id = "8"'));
			if(!$ges)
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
					if(empty($price['price'])){
						$price = DB::fetch_array(DB::query('SELECT MIN(sp.price) AS price FROM {shop_rel} sr
																			LEFT JOIN {shop_price} sp ON sp.good_id = sr.rel_element_id
																		WHERE sr.element_id = "'.$row['id'].'"'));
						$size = 'руб/м2';
					}
				} else $size = 'руб/м2';
			} else {
				$price['price'] = $ges['value1'];
				$ges = DB::fetch_array(DB::query('SELECT * FROM {shop_param_element} WHERE element_id = "'.$row['id'].'" AND param_id = "9"'));
				$size = 'руб/'.$ges['value1'];
			}
			$row['price'] = round($price['price']).' '.$size;
		}
		return $rows;
	}		
	public  function sort_by_price($arr)
	{
		function sort_prc($a, $b)
		{
			return strnatcmp($a['price'], $b['price']);
		}
		usort($arr, 'sort_prc'); 
	return $arr;
	}
	public function filter()
	{
		$data = json_decode($_POST['data']);
		//print_r($data);
		// 1 - отбираем по price и size
		// sub-элементы, если они есть, тогда даем из них id коллекции,
		// которые потом сортируем по стране и остальным параметрам.

		$leftJoinSize = '';
		$querySize = '';
		$data->size=array();
		if($data->sizes_ot!="" && $data->sizes_ot!=""){
		//$data->size=$data->sizes_ot."x".$data->sizes_do;
		if($data->porp==0){
			$data->size[]=$data->sizes_ot."x".$data->sizes_do." см";
			$data->size[]=$data->sizes_do."x".$data->sizes_ot." см";
		}else{
			for($i=($data->sizes_ot/1-$data->porp/1);$i<=($data->sizes_ot/1+$data->porp/1);$i++){
					for($is=($data->sizes_do/1-$data->porp/1);$is<=($data->sizes_do/1+$data->porp/1);$is++){
						//echo $is; 
						$data->size[]=$i."x".$is." см";
						$data->size[]=$is."x".$i." см";
						for($q=1;$q<=9;$q++){
							for($qs=1;$qs<=9;$qs++){
								$data->size[]=$i.",".$q."x".$is.",".$qs." см";
								$data->size[]=$is.",".$q."x".$i.",".$qs." см";
							}
							
						}
					}
			}
		}
		}
		//print_r($data);
		
		
		if(!empty($data->size))
		{
			$tr = $data->size;
			if(count($tr) > 0){
				$query = DB::query('SELECT [value] FROM {shop_param_element} WHERE param_id = "4" AND trash = "0" ORDER BY [value] ASC');
				$count = DB::num_rows($query);
				if($count > 0)
				{
					$tmpArr = array(); unset($i); $i = 1;
					while($size = DB::fetch_array($query))
					{
						if(!in_array($size['value'], $tmpArr) && $size['value'] != ' ' && $size['value'] != '- см' && $size['value'] != 'см' && $size['value'] != ' см'){
							if(in_array($size['value'], $data->size)){
								$tmpArr[] = $size['value'];
							
							}
						}
					}
				}

				$leftJoinSize = ' LEFT JOIN diafan_shop_param_element spe3 ON spe3.element_id = s.id AND spe3.param_id = "4"';
				$querySize = ' AND spe3.value1 IN (';

				foreach($tmpArr as $key => $val) $querySize .= '"'.$tmpArr[intval($key)].'", ';

				$querySize = mb_substr($querySize, 0, mb_strlen($querySize) - 2);

				$querySize .= ')';
			}
			//
		}
//echo $querySize.'-----------------';
//print_r($data);
		$leftJoinMaterial = '';
		$queryMaterial = '';
		if(isset($data->materials)){
		if(!is_object($data->materials)){
			$prope=explode(',',$data->materials);
			$arrsa=array();
			foreach($prope as $k => $v){$arrsa[$v]='1';	}
			$data->materials=$arrsa;
		}
		if(!empty($data->materials))
		{
			if(!is_object($data->materials)){
				$tr=$data->materials;
			}else{
				$tr = get_object_vars($data->materials);
			}
			//print_r($tr);
			if(count($tr) > 0){
				$leftJoinMaterial = ' LEFT JOIN diafan_shop_param_element spe2 ON spe2.element_id = s.id AND spe2.param_id = "3"';
				$queryMaterial = ' AND spe2.value1 IN (';

				foreach($tr as $key => $val) $queryMaterial .= intval($key).', ';

				$queryMaterial = mb_substr($queryMaterial, 0, mb_strlen($queryMaterial) - 2);

				$queryMaterial .= ')';
			}
		}}
//echo $leftJoinMaterial;
//echo $data->maxpr."---------";
		if($data->maxp == 9999 || $data->maxp > 9999) $data->maxp = 99999;
//echo $data->maxpr."---------";
//foreach($data as $k =>$v){echo $k.' =>'.$v.'<br>'; }

/*		$firstQuery = 'SELECT sp.price, s.id, sr.element_id FROM diafan_shop s
						LEFT JOIN diafan_shop_price sp ON sp.good_id = s.id
						'.$leftJoinSize.'
						'.$leftJoinMaterial.'
						LEFT JOIN diafan_shop_rel sr ON sr.rel_element_id = s.id
					WHERE s.act1 = "1" AND s.trash = "0" AND ((sp.price >= "'.intval($data->minp).'" AND sp.price <= "'.intval($data->maxp).'") OR  (sp.price = "'.intval($data->minp).'" AND sp.price = "'.intval($data->maxp).'"))'.$querySize.$queryMaterial;
*/					

		$firstQuery = 'SELECT sp.price, s.id, sr.element_id FROM diafan_shop s
						LEFT JOIN diafan_shop_price sp ON sp.good_id = s.id
						'.$leftJoinSize.'
						'.$leftJoinMaterial.'
						LEFT JOIN diafan_shop_rel sr ON sr.rel_element_id = s.id
					WHERE s.act1 = "1" AND s.trash = "0" AND ((sp.price >= "0" AND sp.price <= "99999999999") OR  (sp.price = "0" AND sp.price = "99999999999"))'.$querySize.$queryMaterial;
			
			
			
/*			
			SELECT U.*, S.*
FROM `user` AS U
LEFT JOIN stats AS S 
  ON S.id = (
    SELECT id
    FROM stats AS S2 
    WHERE S2.user_id = U.id
    ORDER BY id DESC
    LIMIT 1
  )		
*/				
					
					
//echo $firstQuery;
		$query = DB::query($firstQuery);
		$count = DB::num_rows($query);
		$arrIDs = array();
		if($count > 0){
			while($elem = DB::fetch_array($query))
			{
				if(!in_array($elem['element_id'], $arrIDs)) $arrIDs[] = $elem['element_id'];
			}
		} 
		
		$queryCountrys = '';
	if(!empty($data->countries))
		{	
	if(!is_object($data->countries)){
			$prope=explode(',',$data->countries);
			$arrsa=array();
			foreach($prope as $k => $v){$arrsa[$v]='1';	}
			$data->countries=$arrsa;
		}	
		
		
		
			//$tr = get_object_vars($data->countries);
			if(!is_object($data->countries)){
				$tr=$data->countries;
			}else{
				$tr = get_object_vars($data->countries);
			}
			
			
			
			if(count($tr) > 0){
				$queryCountrys = ' AND s.cat_id IN (';

				foreach($tr as $key => $val)
				{
					/*
					$res = DB::query('SELECT id FROM {shop_category} WHERE parent_id = "'.intval($key).'"');
					$count = DB::num_rows($res);
					if($count > 0)
					{
						while($elem = DB::fetch_array($res))
						{
					*/
							$queryCountrys .= intval($key).', ';
					/*
						}
					}
					*/
				}

				$queryCountrys = mb_substr($queryCountrys, 0, mb_strlen($queryCountrys) - 2);

				$queryCountrys .= ')';
			}
		}

		$leftJoinUsefor = '';
		$queryUsefor = '';
		if(!empty($data->usefor))
		{
			if(!is_object($data->usefor)){
			$prope=explode(',',$data->usefor);
			$arrsa=array();
			foreach($prope as $k => $v){$arrsa[$v]='1';	}
			$data->usefor=$arrsa;
		}
			
			
			//$tr = get_object_vars($data->usefor);
			if(!is_object($data->usefor)){
				$tr=$data->usefor;
			}else{
				$tr = get_object_vars($data->usefor);
			}
			if(count($tr) > 0){
				$leftJoinUsefor = ' LEFT JOIN diafan_shop_param_element spe1 ON spe1.element_id = s.id AND spe1.param_id = "2"';
				$queryUsefor = ' AND spe1.value1 IN (';

				foreach($tr as $key => $val) $queryUsefor .= intval($key).', ';

				$queryUsefor = mb_substr($queryUsefor, 0, mb_strlen($queryUsefor) - 2);

				$queryUsefor .= ')';
			}
		}

		// last

		//ob_start();

			$queryNewAction = '';
			$leftJoinDiscount = '';
			
			// hit new action sale
			if($data->hit == 1 || $data->new == 1 || $data->action == 1 || $data->sale == 1){
				$queryNewAction .= ' AND ';
				
				if($data->sale == 1) $leftJoinDiscount = ' LEFT JOIN diafan_shop_discount_object d ON d.good_id = s.id';

				if($data->hit == 1 && $data->new != 1 && $data->action != 1 && $data->sale != 1) $queryNewAction .= 's.hit = "1"';
				if($data->hit != 1 && $data->new == 1 && $data->action != 1 && $data->sale != 1) $queryNewAction .= 's.new = "1"';
				if($data->hit != 1 && $data->new != 1 && $data->action == 1 && $data->sale != 1) $queryNewAction .= 's.action = "1"';
				if($data->hit != 1 && $data->new != 1 && $data->action != 1 && $data->sale == 1) $queryNewAction .= 'd.discount_id > 0';

				if($data->hit == 1 && $data->new == 1 && $data->action != 1 && $data->sale != 1) $queryNewAction .= '(s.hit = "1" OR s.new = "1")';
				if($data->hit == 1 && $data->new != 1 && $data->action == 1 && $data->sale != 1) $queryNewAction .= '(s.hit = "1" OR s.action = "1")';
				if($data->hit == 1 && $data->new != 1 && $data->action != 1 && $data->sale == 1) $queryNewAction .= '(s.hit = "1" OR d.discount_id > 0)';

				if($data->hit != 1 && $data->new == 1 && $data->action == 1 && $data->sale != 1) $queryNewAction .= '(s.new = "1" OR s.action = "1")';
				if($data->hit != 1 && $data->new == 1 && $data->action != 1 && $data->sale == 1) $queryNewAction .= '(s.new = "1" OR d.discount_id > 0)';

				if($data->hit != 1 && $data->new != 1 && $data->action == 1 && $data->sale == 1) $queryNewAction .= '(s.action = "1" OR d.discount_id > 0)';
				
				if($data->hit == 1 && $data->new == 1 && $data->action == 1 && $data->sale != 1) $queryNewAction .= '(s.hit = "1" OR s.new = "1" OR s.action = "1")';
				if($data->hit == 1 && $data->new == 1 && $data->action != 1 && $data->sale == 1) $queryNewAction .= '(s.hit = "1" OR s.new = "1" OR d.discount_id > 0)';
				if($data->hit == 1 && $data->new != 1 && $data->action == 1 && $data->sale == 1) $queryNewAction .= '(s.hit = "1" OR s.action = "1" OR d.discount_id > 0)';
				if($data->hit != 1 && $data->new == 1 && $data->action == 1 && $data->sale == 1) $queryNewAction .= '(s.new = "1" OR s.action = "1" OR d.discount_id > 0)';

				if($data->hit == 1 && $data->new == 1 && $data->action == 1 && $data->sale == 1) $queryNewAction .= '(s.hit = "1" OR s.new = "1" OR s.action = "1" OR d.discount_id > 0)';
			}
			$order_str = '';
			if($_POST['sort_by']=='alphabet'){
				$order_str = 's.name1 ASC,';
			}

			$query1 = 'SELECT s.* FROM diafan_shop s
								'.$leftJoinUsefor.'
								'.$leftJoinDiscount.'
								LEFT JOIN {images} i ON i.module_name = "shop" AND i.element_id = s.id
							WHERE s.act1 = "1" AND s.trash = "0" AND s.id IN ('.implode(',', $arrIDs).')'.$queryNewAction.$queryCountrys.$queryUsefor
							. ' GROUP BY s.id'
							. ' ORDER BY '.$order_str.' s.sort ASC, IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC';
			//print_r($query1);
		
			$query = DB::query($query1);
			$count = DB::num_rows($query);
			
	
			if($count > 0){
				$texts.= '<div class="text_zag">Коллекции<div class="text_zag_sort">';
				if(!isset($_POST['sort_by'])){
					$sort_html = '
								Отсортировано по: 
								<a class="active" href="javascript:void(0);" id="sort_by_popular">популярности</a>
								<a style="color:#84b2da" id="sort_by_price" href="javascript:void(0);">цене</a>
								<a style="color:#84b2da" id="sort_by_alphabet" href="javascript:void(0);">алфавиту</a>
								';
				}
				if($_POST['sort_by']=='alphabet'){
					$sort_html = '
								Отсортировано по: 
								<a style="color:#84b2da" href="javascript:void(0);" id="sort_by_popular">популярности</a>
								<a style="color:#84b2da" id="sort_by_price" href="javascript:void(0);">цене</a>
								<a class="active" id="sort_by_alphabet" href="javascript:void(0);">алфавиту</a>
								';
				}
				if($_POST['sort_by']=='price'){
					$sort_html = '
								Отсортировано по: 
								<a style="color:#84b2da" href="javascript:void(0);" id="sort_by_popular">популярности</a>
								<a class="active" id="sort_by_price" href="javascript:void(0);">цене</a>
								<a style="color:#84b2da" id="sort_by_alphabet" href="javascript:void(0);">алфавиту</a>
								';
				}
				$texts.= $sort_html;
				$texts.= '</div></div>';
				
				 //$texts.= $query1;

				unset($i); $i = 0; $page = 1;
				$rows =  array();
				while($row = DB::fetch_array($query))
				{
					$rows[] = $row ;
				}
				$rows = $this->get_price_and_size($rows);
				if($_POST['sort_by']=='price'){
					$rows = $this->sort_by_price($rows);
				}
				
				foreach($rows as $row)
				{
					
					$m_tmp=explode(" ",$row['price']);
					$tmp_price=ceil($m_tmp[0]);
					//$texts.="=".$tmp_price."-".intval($data->minp)."-".intval($data->maxp)."=";
					if( ($tmp_price >= intval($data->minp)) && ($tmp_price <= intval($data->maxp)) ){
						
					}else if( (0 == intval($data->minp)) && (0 == intval($data->maxp)) ){
							
					}else{
						continue;		
					}
					
					
					if($i == 0) $texts.= '<div class="fp_page fp_active" id="filter-page-'.$page.'">';
					if($i != 0 && $i % 10 == 0)
					{
						//$_POST['data']['page']=$page;
						//print_r($_POST['data']);
						$page++;
						$texts.= '</div><div class="fp_page" id="filter-page-'.$page.'">';
					}
					$link = DB::fetch_array(DB::query('SELECT rewrite FROM {rewrite} WHERE module_name = "shop" AND element_id = "'.$row['id'].'"'));
					$row['link'] = $link['rewrite'];
					$row['name'] = $row['name1'];

					$texts.= '<div class="slider2">';
						$texts.= '<div class="photo_on_main_full">';
							$images = $this->diafan->_images->get("cl-265", $row['id'], "shop", $row['site_id'], $row['name'], false);
							$check_product = DB::fetch_array(DB::query('SELECT discount_id,s.action,s.new,s.hit FROM {shop} s
										LEFT JOIN {shop_discount_object} d ON d.good_id = s.id
									WHERE (d.discount_id > 0 OR s.action = "1" OR s.new = "1" OR s.hit = "1") AND s.[act] = "1" AND s.trash = "0" AND s.cat_id != "8" AND s.id="'.$row['id'].'"'));
							$attr = '';
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
							# print_r($images);
							$texts.= '<div class="photoslider'.$i.' ps-full" style="width: 260px;">';
								if(!empty($images))
								{
									$texts.= '<ul>';
									foreach($images as $image)
									{
										$texts.= '<li>';
										$texts.= '<div class="slider'.$i.'_img" style="position:relative">';
										$texts.= $attr;
										$texts.= '<a href="' . BASE_PATH_HREF . $row["link"] . '?filter=true&data='.urlencode($_POST['data']).'&page='.$page.(isset($_POST['sort_by'])? '&sort='.$_POST['sort_by'] : '').'"><img src="'.$image['src'].'" alt="'.$image['alt'].'" /></a>';
										$texts.= '</div>';
										$texts.= '</li>';
									}
									$texts.= '</ul>';
								}
							$texts.= '</div>';
							if(!empty($images))
							{
								$texts.= '<div><a href="#" class="prev'.$i.'" id="prevall">&nbsp;</a></div>';
								$texts.= '<div><a href="#" class="next'.$i.'" id="nextall">&nbsp;</a></div>';
							}
						$texts.= '</div>';
						$m_tmp=explode(" ",$row['price']);
						if(ceil($m_tmp[0])=='99999999999'){
							$texts.= '<div class="slider1_img_money2 tmp1">Снято с продажи</div>';
						}else{
							$texts.= '<div class="slider1_img_money2 tmp1">от '.ceil($m_tmp[0]).' '.$m_tmp[1].'</div>';
						}
						$texts.= '<div class="slider1_t">';
							$categorys = DB::fetch_array(DB::query('SELECT c1.name1 AS factory, c2.name1 AS country, r1.rewrite AS factory_url, r2.rewrite AS country_url FROM {shop_category} c1
																LEFT JOIN {shop_category} c2 ON c2.id = c1.parent_id
																LEFT JOIN {rewrite} r1 ON r1.module_name = "shop" AND r1.cat_id = c1.id
																LEFT JOIN {rewrite} r2 ON r2.module_name = "shop" AND r2.cat_id = c2.id
															WHERE c1.id = "'.$row['cat_id'].'"'));
							# print_r($categorys);
							$texts.= '<a href="' . BASE_PATH_HREF . $row["link"] . '?filter=true&data='.urlencode($_POST['data']) .'&page='.$page. (isset($_POST['sort_by'])? '&sort='.$_POST['sort_by'] : '') . '">' . first_letter_up(mb_strtolower ($row["name"],'UTF-8')) . '</a>';
							$texts.= '<span class="slider1_span1 tmp1">'.first_letter_up(mb_strtolower ($categorys['factory'],'UTF-8')).'</span>';
							$texts.= '<span class="slider1_span2">('.$categorys['country'].')</span>';
						$texts.= '</div>';
					$texts.= '</div>';

					$i++;
				}
				
				$texts.= '</div>';
				$texts.= '<div class="text_zag_sort_2">'.$sort_html.'</div>';
				if($page > 1)
				{
					$texts.= '<div class="paginator filter-paginator">';
					$texts.= '<a href="javascript:void(0)" id="fp_to_first_1" class="fp_to_first" style="display: none;">Первая</a>';
					for($i = 1; $i <= $page; $i++)
					{
						if($i == 1) $texts.= '<span>'.$i.'</span>';
						else {
							if($i>11)
								$texts.= '<a href="javascript:void(0)" style="display:none" id="fp_to_'.$i.'" class="fp_to">'.$i.'</a>';
							else
								$texts.= '<a href="javascript:void(0)" style="display:inline-block" id="fp_to_'.$i.'" class="fp_to">'.$i.'</a>';
						}
					}
					$texts.= '<a href="javascript:void(0)" id="fp_to_last_'.$page.'" class="fp_to_last">Последняя('.$page.')</a>';
					$texts.= '<div class="next-prev-buttons-2">
							<a class="prev-fp" style="display:none;" href="javascript:void(0)">
								< предыдущая</a>
							<a class="next-fp" href="javascript:void(0)">
							следующая ></a></div>';
					$texts.= '</div>';
				}
			}
	if(isset($_SESSION['page']) && $_SESSION['page']!=""){
		$texts.='<script>
		$(document).ready(function(){
			$("#fp_to_'.$_SESSION['page'].'").click();
		});
		</script>';
	}
	unset($_SESSION["page"]);
		//<b>страница - '.$_SESSION['page']."</b>"; fp_to_8
		$content =$texts;
		//ob_end_clean();
	
		# print_r($query1);
		# print_r($count);
		# print_r($content);
		//print_r($this->result);
		$this->result['print_result'] = '1';
		$this->result['data'] = $content;
		// print_r($this->result['data']);
		//return $this->result;
//print_r($rows);
		return $this->send_errors();
	}
	/**
	 * Добавляет товар в корзину
	 * 
	 * @return boolean
	 */
	private function buy()
	{
		if (empty($_POST['good_id']) || $this->diafan->configmodules('security_user') && ! $this->diafan->_user->id)
		{
			return false;
		}
		$good_id = $this->diafan->get_param($_POST, 'good_id', 0, 2);
		$this->tag = 'shop'.$good_id;

		$row = DB::fetch_array(DB::query("SELECT id, is_file FROM {shop} WHERE id=%d AND trash='0' AND [act]='1' LIMIT 1", $good_id));

		if (empty($row['id']))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		$params = array();

		$result = DB::query(
				"SELECT p.[name], p.id FROM {shop_param} AS p"
				." INNER JOIN {shop_param_element} AS e ON e.element_id=%d AND e.param_id=p.id"
				." WHERE p.`type`='multiple' AND p.required='1' GROUP BY p.id",
				$good_id
			);
		while ($row_param = DB::fetch_array($result))
		{
			if (empty($_POST["param".$row_param["id"]]))
			{
				$this->result["errors"][0] = $this->diafan->_('Пожалуйста, выберите', false).' '.$row_param["name"];
				$this->send_errors();
				return true;
			}
			$params[$row_param["id"]] = $this->diafan->get_param($_POST, "param".$row_param["id"], 0, 2);
		}

		$count = $this->diafan->get_param($_POST, "count", null, null);
		$count = $count > 0 ? $count : 1;
		
		$count_good = $this->diafan->_cart->get($good_id, $params, "count");
		$count_good += $count;
		
		$cart = array(
				"count" => $count,
				"is_file" => $row['is_file'],
			);

		if($err = $this->diafan->_cart->set($cart, $good_id, $params))
		{
			$this->result["errors"][0] = $err;
			return $this->send_errors();	
		}
		$this->diafan->_cart->recalc();
		$this->diafan->_cart->write();

		DB::query("UPDATE {shop} SET counter_buy=counter_buy+1 WHERE id='%d'", $good_id);

		$this->result["errors"][0] = $this->diafan->_('В <a href="%s">корзине</a> '.$count_good.' шт.', false, BASE_PATH_HREF.$this->diafan->_route->module("cart", true));
		Customization::inc('modules/cart/cart.model.php');
		$cart_model = new Cart_model($this->diafan);
		$cart_tpl = $cart_model->show_block();
		$this->result["target"] = "#show_cart";
		$this->result["data"] = $this->diafan->_tpl->get('info', 'cart', $cart_tpl);

		return $this->send_errors();
	}

	/**
	 * Добавляет товар в список пожеланий
	 * 
	 * @return boolean
	 */
	private function wish()
	{
		if (empty($_POST['good_id']) || $this->diafan->configmodules('security_user') && ! $this->diafan->_user->id)
		{
			return false;
		}
		$good_id = $this->diafan->get_param($_POST, 'good_id', 0, 2);

		$row = DB::fetch_array(DB::query("SELECT id, is_file FROM {shop} WHERE id=%d AND trash='0' AND [act]='1' LIMIT 1", $good_id));

		if (empty($row['id']))
		{
			$this->result["errors"][0] = 'ERROR';
			return $this->send_errors();
		}

		$params = array();

		$result = DB::query(
				"SELECT p.[name], p.id FROM {shop_param} AS p"
				." INNER JOIN {shop_param_element} AS e ON e.element_id=%d AND e.param_id=p.id"
				." WHERE p.`type`='multiple' AND p.required='1' GROUP BY p.id",
				$good_id
			);
		while ($row_param = DB::fetch_array($result))
		{
			if (empty($_POST["param".$row_param["id"]]))
			{
				$this->result["errors"][0] = $this->diafan->_('Пожалуйста, выберите', false).' '.$row_param["name"];
				$this->send_errors();
				return true;
			}
			$params[$row_param["id"]] = $this->diafan->get_param($_POST, "param".$row_param["id"], 0, 2);
		}

		$count = $this->diafan->get_param($_POST, "count", 1, 2);
		$count = $count > 0 ? $count : 1;

		$count_good = $this->diafan->_wishlist->get($good_id, $params, "count");
		$count_good += $count;

		$wishlist = array(
				"count" => $count_good,
				"is_file" => $row['is_file'],
			);
		if($err = $this->diafan->_wishlist->set($wishlist, $good_id, $params))
		{
			$this->result["errors"][0] = $err;
			return $this->send_errors();	
		}
		$this->diafan->_wishlist->write();


		$this->result["errors"][0] = $this->diafan->_('Товар добавлен в <a href="%s">отложенные</a>', false, BASE_PATH_HREF.$this->diafan->_route->module("wishlist", true));

		return $this->send_errors();
	}

	/**
	 * Добавляет товар в список ожиданий
	 * 
	 * @return boolean
	 */
	private function wait()
	{
		if (empty($_POST['good_id']) || $this->diafan->configmodules('security_user') && ! $this->diafan->_user->id)
		{
			return false;
		}
		$good_id = $this->diafan->get_param($_POST, 'good_id', 0, 2);

		$row = DB::fetch_array(DB::query("SELECT id FROM {shop} WHERE id=%d AND trash='0' AND [act]='1' LIMIT 1", $good_id));

		if (empty($row['id']))
		{
			$this->result["errors"]["waitlist"] = 'ERROR';
			return $this->send_errors();
		}
		if(empty($_POST["mail"]))
		{
			$this->result["errors"]["waitlist"] = $this->diafan->_('Пожалуйста, выберите', false).' '.$row_param["name"];
			$this->send_errors();
			return true;
		}
		Customization::inc('includes/validate.php');
		$mes = Validate::mail($_POST["mail"]);
		if ($mes)
		{
			$this->result["errors"]["waitlist"] = $this->diafan->_($mes);
			$this->send_errors();
			return true;
		}

		$params = array();

		$result = DB::query(
				"SELECT p.[name], p.id, e.value".$this->diafan->language_base_site." AS value FROM {shop_param} AS p"
				." INNER JOIN {shop_param_element} AS e ON e.element_id=%d AND e.param_id=p.id"
				." WHERE p.`type`='multiple' AND p.required='1' GROUP BY p.id",
				$good_id
			);
		while ($row_param = DB::fetch_array($result))
		{
			if (empty($_POST["param".$row_param["id"]]))
			{
				$this->result["errors"]["waitlist"] = $this->diafan->_('Пожалуйста, выберите', false).' '.$row_param["name"];
				$this->send_errors();
				return true;
			}
			if($row_param["value"])
			{
				$params[$row_param["id"]] = $this->diafan->get_param($_POST, "param".$row_param["id"], 0, 2);
			}
		}
		asort($params);
		$params = serialize($params);
		if($id = DB::query_result("SELECT id FROM {shop_waitlist} WHERE trash='0' AND good_id=%d AND mail='%h' AND param='%s' LIMIT 1", $good_id, $_POST["mail"], $params))
		{
			DB::query("UPDATE {shop_waitlist} SET created=%d WHERE id=%d", time(), $id);
		}
		else
		{
			DB::query("INSERT INTO {shop_waitlist} (good_id, mail, param, created, user_id, lang_id) VALUES (%d,  '%h', '%s', %d, %d, %d)", $good_id, $_POST["mail"], $params, time(), $this->diafan->_user->id, _LANG);
		}

		$this->result["errors"]["waitlist"] = $this->diafan->_('Спасибо! Мы уведомим Вас когда товар поступит на склад.', false);

		return $this->send_errors();
	}

	/**
	 * Активирует купон
	 * 
	 * @return boolean
	 */
	private function add_coupon()
	{
		if (!$this->diafan->_user->id)
		{
			return false;
		}
		if (empty($_POST["coupon"]))
		{
			$this->result["errors"][0] = $this->diafan->_('Вы ввели ошибочный код купона', false);
			return $this->send_errors();
		}
		$discount_id = DB::query_result("SELECT id FROM {shop_discount} WHERE coupon='%h' AND user_id=0 AND trash='0' AND act='1' LIMIT 1", $_POST["coupon"]);
		if (!$discount_id)
		{
			$this->result["errors"][0] = $this->diafan->_('Вы ввели ошибочный код купона', false);
		}
		else
		{
			DB::query("UPDATE {shop_discount} SET user_id=%d WHERE id=%d", $this->diafan->_user->id, $discount_id);
			$this->diafan->_shop->price_calc(0, $discount_id);
			$this->result["redirect"] = $_SERVER['HTTP_REFERER'];
		}
		return $this->send_errors();
	}

	/**
	 * Добавляет/удаляет товар для сравнения
	 * 
	 * @return boolean
	 */
	private function compare_goods()
	{
		if (empty($_POST['shop_compare_id']))
		{
			return false;
		}
		$id = $this->diafan->get_param($_POST, "shop_compare_id", 0, 2);
		$site_id = $this->diafan->cid;
	
		if (empty($_POST['shop_compare_add']))
		{
			if (isset($_SESSION['compare_list'][$site_id][$id]))
			{
				unset($_SESSION['compare_list'][$site_id][$id]);
			}
		}
		else
		{
			$_SESSION['compare_list'][$site_id][$id] = 1;
			$this->result['shop_compare_add'] = 1;
		}
		$this->result['shop_compare_id'] = $id;
		$this->result['shop_compare_input'] = '<input type="hidden" name="ids[]" value="'.$id.'" class="shop_compared_goods_'.$id.'">';
		if (!empty($_POST["ajax"]))
		{
			include_once ABSOLUTE_PATH.'plugins/json.php';
			echo to_json($this->result);
		}
		else
		{
			$this->diafan->redirect($_SERVER['HTTP_REFERER']);
		}
		return true;
	}

	/**
	 * Очищает список сравнения
	 * 
	 * @return boolean
	 */
	private function compare_delete_goods()
	{
		if (isset($_SESSION['compare_list'][$this->diafan->cid]))
		{
			unset($_SESSION['compare_list'][$this->diafan->cid]);
		}
		$this->result['redirect'] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->cid).'?action=compare';
		if (!empty($_POST["ajax"]))
		{
			include_once ABSOLUTE_PATH.'plugins/json.php';
			echo to_json($this->result);
		}
		else
		{
			$this->diafan->redirect($this->result['redirect']);
		}
		return true;
	}
}