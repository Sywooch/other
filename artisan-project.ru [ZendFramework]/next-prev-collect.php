<?php
	//next and prev collections by param
	if(isset($_GET['param']))
	{
		$param        = $_GET['param'];
		$di_param     = $_GET['di_param'];
		$sort_type    = $_GET['sort_type'];
		$page         = $_GET['page'];
		if(!$page)
			$page = 1;
		$urls             = get_collection_url($sort_type,$param,$di_param,$page,$result['id'],false,&$sm);
		$get_param_string = '?param='.$param.'&di_param='.$di_param.'&sort_type='.$sort_type;
		if(!empty($urls['prev']))
		{
			$urls['prev'] = $urls['prev'].$get_param_string.'&page='.$page;
		}
		else
		{
			$urls_more    = get_collection_url($sort_type,$param,$di_param,$page-1,$result['id'],'last',&$sm);
			if($urls_more['prev']!='')
			{
				$urls['prev'] = $urls_more['prev'].$get_param_string.'&page='.($page-1);
			}
			else
			{
				$urls['prev'] = '';
			}
		}
		if(!empty($urls['next']))
		{
			$urls['next'] = $urls['next'].$get_param_string.'&page='.$page;
		}
		else
		{
			$urls_more    = get_collection_url($sort_type,$param,$di_param,$page+1,$result['id'],'first',&$sm);
			if($urls_more['next']!='')
			{		
				$urls['next'] = $urls_more['next'].$get_param_string.'&page='.($page+1);
			}
			else
			{
				$urls['next'] = '';
			}
		}
	}
	//next prev collections by cat
	if(isset($_GET['cat_ids']))
	{
		$cat_ids      = urldecode($_GET['cat_ids']);
		$sort_type    = $_GET['sort_type'];
		$page         = $_GET['page'];
		if(!$page)
			$page = 1;
		$urls             = get_collection_url_cat($cat_ids,$sort_type,$page,$result['id'],false,&$sm);
		$get_param_string =  '?cat_ids='.urlencode($cat_ids).'&sort_type='.$sort_type;
		if(!empty($urls['prev']))
		{
			$urls['prev'] = $urls['prev'].$get_param_string.'&page='.$page;
		}
		else
		{
			$urls_more    = get_collection_url_cat($cat_ids,$sort_type,$page-1,$result['id'],'last',&$sm);
			if($urls_more['prev']!='')
			{
				$urls['prev'] = $urls_more['prev'].$get_param_string.'&page='.($page-1);
			}
			else
			{
				$urls['prev'] = '';
			}
		}
		if(!empty($urls['next']))
		{
			$urls['next'] = $urls['next'].$get_param_string.'&page='.$page;
		}
		else
		{
			$urls_more    = get_collection_url_cat($cat_ids,$sort_type,($page+1),$result['id'],'first',&$sm);
			if($urls_more['next']!='')
			{		
				$urls['next'] = $urls_more['next'].$get_param_string.'&page='.($page+1);
			}
			else
			{
				$urls['next'] = '';
			}
		}
	}
	
	if(isset($_GET['filter']))
	{
		$data = json_decode(urldecode($_GET['data']));
		$sort_by = $_GET['sort'];
		$urls = get_next_prev_urls_filter($data,$sort_by,$result['id']);
		$get_param_string = '?filter=true&data='.urldecode(json_encode($data)).(isset($_GET['sort'])?'&sort='.$_GET['sort'] : '');
		if(!empty($urls['next']))
			$urls['next'] = $urls['next'].$get_param_string;
		if(!empty($urls['prev']))
			$urls['prev'] = $urls['prev'].$get_param_string;
	}
	
	if(!isset($_GET['param']) && !isset($_GET['cat_ids']) && !isset($_GET['filter']))
	{
		if(isset($_GET['page']))
			$page = $_GET['page'];
		else
		{
			$page = get_page_by_id($result['cat_id'],$result['id']);
			if($page==0)
				$page = 1;
		}
		
		$urls             = get_collection_url_cat($result['cat_id'],'',$page,$result['id'],false,&$sm);
		$get_param_string =  '?cat_id='.urlencode($result['cat_id']);
		if(!empty($urls['prev']))
		{
			$urls['prev'] = $urls['prev'].$get_param_string.'&page='.$page;
		}
		else
		{
			$urls_more    = get_collection_url_cat($result['cat_id'],'',$page-1,$result['id'],'last',&$sm);
			if($urls_more['prev']!='')
			{
				$urls['prev'] = $urls_more['prev'].$get_param_string.'&page='.($page-1);
			}
			else
			{
				$urls['prev'] = '';
			}
		}
		if(!empty($urls['next']))
		{
			$urls['next'] = $urls['next'].$get_param_string.'&page='.$page;
		}
		else
		{
			$urls_more    = get_collection_url_cat($result['cat_id'],'',$page+1,$result['id'],'first',&$sm);
			if($urls_more['next']!='')
			{		
				$urls['next'] = $urls_more['next'].$get_param_string.'&page='.($page+1);
			}
			else
			{
				$urls['next'] = '';
			}
		}
	}
	/*
	| get_collection_url - return coll url by params array
	| string $sort_type  - sort type
	| int $param         - category param
	| string $di_param   - diafan param
	| string $page       - page
	| int $good_id       - good id  
	| string $flag       - flag first or last
	| object $sm         - shop object
	| @return array url
	*/
	function get_collection_url($sort_type,$param,$di_param,$page,$good_id,$flag,$sm)
	{
		$time = time();
		$skip_amount = (int)($page-1)*10;
		switch($sort_type)
		{
			case 'sort1':
				if($param!=3)
				{
					$result = DB::query("
											SELECT spe.value1, 
													s.id, 
													s.name1 AS name,
													s.timeedit, 
													s.anons1 AS anons, 
													s.cat_id, 
													s.site_id, 
													s.no_buy, 
													s.article, 
													s.is_file, 
													i.id AS img_id
											FROM `diafan_shop_param_element` AS spe
											LEFT JOIN `diafan_shop` AS s ON s.id = spe.element_id
											LEFT JOIN `diafan_images` i ON i.module_name = 'shop'
											AND i.element_id = s.id
											WHERE spe.param_id = '8'
											AND spe.element_id
											IN (
												SELECT s.id
												FROM `diafan_shop` AS s
												INNER JOIN `diafan_shop_param_element` AS e ON e.element_id = s.id
												WHERE s.act1 = '1'
												AND s.trash = '0'
												AND e.param_id = '".$param."'
												AND e.value1 = '".$di_param."'
												AND s.date_start <= '".$time."'
												AND (
													s.date_finish =0
													OR s.date_finish >= '".$time."'
													)
												AND (
													s.access = '0'
													)
												GROUP BY s.id
												)
											GROUP BY s.id
											ORDER BY CAST( `spe`.`value1` AS SIGNED ) ASC
											LIMIT ".$skip_amount.",10
										");
				}
				else
				{
					$result = DB::query('
											 SELECT spe.value1, 
													s.id, 
													s.name1 AS name, 
													s.timeedit, 
													s.anons1 AS anons, 
													s.cat_id, 
													s.site_id, 
													s.no_buy, 
													s.article, 
													s.is_file 
													FROM `diafan_shop` s 
													LEFT JOIN `diafan_shop_param_element` AS spe ON s.id = spe.element_id 
													LEFT JOIN `diafan_shop_rel` AS sr ON sr.rel_element_id = spe.element_id 
													LEFT JOIN `diafan_images` i ON i.module_name = "shop" AND i.element_id = s.id 
													WHERE spe.param_id = "8" 
														AND spe.element_id IN 
														(
															SELECT s.id 
															FROM `diafan_shop_param_element` spe 
															LEFT JOIN `diafan_shop_rel` AS sr ON sr.rel_element_id = spe.element_id 
															LEFT JOIN `diafan_shop` AS s ON s.id = sr.element_id 
															WHERE spe.param_id = "'.$param.'" 
																  AND spe.value1 = "'.$di_param.'" 
																  AND s.act1 = "1" 
																  AND s.trash = "0" GROUP BY s.id) 
															GROUP BY s.id 
															ORDER BY CAST(`spe`.`value1` AS SIGNED) ASC,
																IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC 
															LIMIT '.$skip_amount.',10
										');
				}
			$result_with_params       = get_result_with_params($result,&$sm);
			$result_with_price        = get_price_and_size($result_with_params);
			$result_with_sorted_price = sort_by_price($result_with_price);
			$urls = get_next_prev_urls_price($result_with_sorted_price,$good_id,$flag);
			break;
			case 'sort2':
				if($param!=3)
				{
					$result = DB::query("
										SELECT s.id, 
											   s.name1 AS name, 
											   s.timeedit, 
											   s.anons1 AS anons, 
											   s.cat_id, 
											   s.site_id, 
											   s.no_buy, 
											   s.article, 
											   s.is_file, 
											   i.id AS img_id 
										FROM `diafan_shop` AS s 
										LEFT JOIN `diafan_images` i ON i.module_name = 'shop' AND i.element_id = s.id 
										INNER JOIN `diafan_shop_param_element` as e ON e.element_id=s.id 
										WHERE s.act1='1' 
											AND s.trash='0' 
											AND e.param_id='".$param."' 
											AND e.value1='".$di_param."'
											AND s.date_start<='".$time."' 
											AND (s.date_finish=0 OR s.date_finish>='".$time."') 
											AND (s.access='0') 
										GROUP BY s.id 
										ORDER BY s.name1 ASC, IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC, s.no_buy ASC, s.sort ASC, s.id ASC 
										LIMIT ".$skip_amount.",10
										");
				}
				else
				{
					$result = DB::query('
										SELECT s.id, 
											   s.name1 AS name, 
											   s.timeedit, 
											   s.anons1 AS anons, 
											   s.cat_id, 
											   s.site_id, 
											   s.no_buy, 
											   s.article, 
											   s.is_file FROM `diafan_shop_param_element` spe 
											   LEFT JOIN diafan_shop_rel AS sr ON sr.rel_element_id = spe.element_id 
											   LEFT JOIN diafan_shop AS s ON s.id = sr.element_id 
											   LEFT JOIN `diafan_images` i ON i.module_name = "shop" AND i.element_id = s.id 
											   WHERE spe.param_id = "'.$param.'" 
													AND spe.value1 = "'.$di_param.'" 
													AND s.act1 = "1" 
													AND s.trash = "0" 
											   GROUP BY s.id 
											   ORDER BY s.name1 ASC,IF(LENGTH(i.id) > 0, 1, 0) DESC, 
											   s.order_ex ASC 
											   LIMIT '.$skip_amount.',10
										');
				}
				$urls = get_next_prev_urls($result,$good_id,$flag);		
			break;
			default:
				if($param!=3)
				{
					$result = DB::query("
									SELECT s.id, 
										   s.name1 AS name, 
										   s.timeedit, 
										   s.anons1 AS anons, 
										   s.cat_id, 
										   s.site_id, 
										   s.no_buy, 
										   s.article, 
										   s.is_file, 
										   i.id AS img_id 
									FROM `diafan_shop` AS s 
									LEFT JOIN `diafan_images` i ON i.module_name = 'shop' AND i.element_id = s.id 
									INNER JOIN `diafan_shop_param_element` as e ON e.element_id=s.id 
									WHERE s.act1='1' 
										AND s.trash='0' 
										AND e.param_id=".$param." 
										AND e.value1='".$di_param."'
										AND s.date_start<=".$time." 
										AND (s.date_finish=0 OR s.date_finish>=".$time.") 
										AND (s.access='0') 
									GROUP BY s.id 
									ORDER BY IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC, s.no_buy ASC, s.sort ASC, s.id ASC 
									LIMIT ".$skip_amount.",10
									");
				}
				else
				{
					$result = DB::query('
										SELECT s.id, 
											   s.name1 AS name, 
											   s.timeedit, 
											   s.anons1 AS anons, 
											   s.cat_id, 
											   s.site_id, 
											   s.no_buy, 
											   s.article, 
											   s.is_file FROM `diafan_shop_param_element` spe 
											   LEFT JOIN diafan_shop_rel AS sr ON sr.rel_element_id = spe.element_id 
											   LEFT JOIN diafan_shop AS s ON s.id = sr.element_id 
											   LEFT JOIN `diafan_images` i ON i.module_name = "shop" AND i.element_id = s.id 
											   WHERE spe.param_id = "'.$param.'" 
													AND spe.value1 = "'.$di_param.'" 
													AND s.act1 = "1" 
													AND s.trash = "0" 
											   GROUP BY s.id 
											   ORDER BY IF(LENGTH(i.id) > 0, 1, 0) 
											   DESC, 
											   s.order_ex ASC 
											   LIMIT '.$skip_amount.',10
										');
				}
				$urls = get_next_prev_urls($result,$good_id,$flag);
			break;
		}
		return $urls;
	}

	
	/*
	| get_collection_url_cat - return coll url by cat ids
	| string $sort_type  - sort type
	| int $param         - category param
	| string $di_param   - diafan param
	| string $page       - page
	| int $good_id       - good id  
	| string $flag       - flag first or last
	| object $sm         - shop object
	| @return string url
	*/
	function get_collection_url_cat($cat_ids,$sort_type,$page,$good_id,$flag,$sm)
	{
		$time = time();
		$skip_amount = (int)($page-1)*10;
		switch($sort_type)
		{
			case 'sort1':
				$result = DB::query("
									SELECT spe.value1, 
										s.id, 
										s.name1 AS name, 
										s.cat_id, 
										s.timeedit, 
										s.anons1 AS anons, 
										s.site_id, 
										s.no_buy, 
										s.article, 
										s.hit, 
										s.new, 
										s.action, 
										s.is_file FROM `diafan_shop` AS s 
										LEFT JOIN `diafan_images` i ON i.module_name = 'shop' AND i.element_id = s.id 
										LEFT JOIN `diafan_shop_param_element` AS spe ON spe.element_id=s.id AND spe.trash='0' AND spe.param_id='8' 
										INNER JOIN `diafan_shop_category_rel` AS r ON s.id=r.element_id AND r.cat_id IN (".$cat_ids.") 
										WHERE s.act1='1' 
											AND s.trash='0' 
											AND s.cat_id != '8' 
											AND s.date_start<=".$time." 
											AND (s.date_finish=0 OR s.date_finish>=".$time.") 
											AND (s.access='0') 
										GROUP BY s.id 
										ORDER BY CAST(`spe`.`value1` AS SIGNED) ASC, 
											IF(LENGTH(i.id) > 0, 1, 0) DESC, 
											s.order_ex ASC, 
											s.no_buy ASC, 
											s.sort ASC, 
											s.id ASC  
										LIMIT ".$skip_amount.",10
										");
			$result_with_params       = get_result_with_params($result,&$sm);
			$result_with_price        = get_price_and_size($result_with_params);
			$result_with_sorted_price = sort_by_price($result_with_price);
			$urls = get_next_prev_urls_price($result_with_sorted_price,$good_id,$flag);
			break;
			case 'sort2':
				$result = DB::query("
									SELECT s.id, 
										s.name1 AS name, 
										s.cat_id, 
										s.timeedit, 
										s.anons1 AS anons, 
										s.site_id, 
										s.no_buy, 
										s.article, 
										s.hit, 
										s.new, s.action, 
										s.is_file FROM `diafan_shop` AS s 
									LEFT JOIN `diafan_images` i ON i.module_name = 'shop' AND i.element_id = s.id 
									INNER JOIN `diafan_shop_category_rel` AS r ON s.id=r.element_id AND r.cat_id IN (".$cat_ids.") 
									WHERE s.act1='1' 
										AND s.trash='0' 
										AND s.cat_id != '8' 
										AND s.date_start<=".$time." 
										AND (s.date_finish=0 OR s.date_finish>=".$time.") 
										AND (s.access='0') 
									GROUP BY s.id 
									ORDER BY s.name1 ASC, 
									IF(LENGTH(i.id) > 0, 1, 0) 
									DESC, s.order_ex ASC, s.no_buy ASC, s.sort ASC, s.id ASC 
									LIMIT ".$skip_amount.",10
									");
				$urls = get_next_prev_urls($result,$good_id,$flag);		
			break;
			default:
				$result = DB::query("
								SELECT s.id, 
									s.name1 AS name, 
									s.cat_id, 
									s.timeedit, 
									s.anons1 AS anons,
									s.site_id, s.no_buy, 
									s.article, s.hit, 
									s.new, 
									s.action, 
									s.is_file 
								FROM `diafan_shop` AS s 
								LEFT JOIN `diafan_images` i ON i.module_name = 'shop' AND i.element_id = s.id 
								INNER JOIN `diafan_shop_category_rel` AS r ON s.id=r.element_id AND r.cat_id IN (".$cat_ids.") 
								WHERE s.act1='1' 
									AND s.trash='0' 
									AND s.cat_id != '8' 
									AND s.date_start<=".$time." 
									AND (s.date_finish=0 OR s.date_finish>=".$time.") 
									AND (s.access='0') 
								GROUP BY s.id ORDER BY IF(LENGTH(i.id) > 0, 1, 0) 
								DESC, s.order_ex ASC, s.no_buy ASC, s.sort ASC, s.id ASC 
								LIMIT ".$skip_amount.",10
								");
				$urls = get_next_prev_urls($result,$good_id,$flag);
			break;
		}
		return $urls;
	}
	
	function get_result_with_params($result,$sm)
	{
		$rows = array();
		while ($row = DB::fetch_array($result))
		{
			$params = $sm->get_param($row['id'], 29);
			$row['param']  = $params;
			$rows[] = $row;
		}
		return $rows;
	}

	function get_next_prev_urls($result,$id,$flag)
	{
		$prev = '';
		$next = '';
		while ($row = DB::fetch_array($result))
		{
			if($flag=='first')
			{
				$next = $row;
				break;
			}
			if($row['id']==$id && !$flag)
			{
				$next = DB::fetch_array($result);
				break;
			}
			$prev = $row;
		}
		$route = new Route();
		return	array(
						'prev'=>$route->link($prev["site_id"], "shop",$prev["cat_id"], $prev["id"]),
						'next'=>$route->link($next["site_id"], "shop",$next["cat_id"], $next["id"])
					);
	}

	function get_next_prev_urls_price($result,$id,$flag)
	{
		$prev = '';
		$next = '';
		for($i = 0; $i<count($result); $i++)
		{
			if($flag=='first')
			{
				$next = $result[$i];
				break;
			}
			if($result[$i]['id']==$id && !$flag && $result[$i+1]['id']>count($result))
			{
				$next = $result[$i+1];
				break;
			}
			$prev = $result[$i];
		}
		$route = new Route();
		return	array(
						'prev'=>$route->link($prev["site_id"], "shop",$prev["cat_id"], $prev["id"]),
						'next'=>$route->link($next["site_id"], "shop",$next["cat_id"], $next["id"])
					);
	}

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
			$row['price'] = (!empty($excelPrise) ? $excelPrise : intval($price['price'])).' '.$size;
		}
		return $rows;
	}

	function sort_by_price($arr)
	{
		usort($arr, 'sort_prc'); 
		return $arr;
	}

	function sort_prc($a, $b)
	{
		return strnatcmp($a['price'], $b['price']);
	}
	
	function get_page_by_id($cat_id,$id)
	{
		$time = time();
		$result = DB::query("
									SELECT spe.value1, 
										s.id, 
										s.name1 AS name, 
										s.cat_id, 
										s.timeedit, 
										s.anons1 AS anons, 
										s.site_id, 
										s.no_buy, 
										s.article, 
										s.hit, 
										s.new, 
										s.action, 
										s.is_file FROM `diafan_shop` AS s 
										LEFT JOIN `diafan_images` i ON i.module_name = 'shop' AND i.element_id = s.id 
										LEFT JOIN `diafan_shop_param_element` AS spe ON spe.element_id=s.id AND spe.trash='0' AND spe.param_id='8' 
										INNER JOIN `diafan_shop_category_rel` AS r ON s.id=r.element_id AND r.cat_id IN (".$cat_id.") 
										WHERE s.act1='1' 
											AND s.trash='0' 
											AND s.cat_id != '8' 
											AND s.date_start<=".$time." 
											AND (s.date_finish=0 OR s.date_finish>=".$time.") 
											AND (s.access='0') 
										GROUP BY s.id 
										ORDER BY CAST(`spe`.`value1` AS SIGNED) ASC, 
											IF(LENGTH(i.id) > 0, 1, 0) DESC, 
											s.order_ex ASC, 
											s.no_buy ASC, 
											s.sort ASC, 
											s.id ASC
								");
		$count = 0;
		while($row = DB::fetch_array($result))
		{
			if($row['id']==$id)
			{
				break;
			}
			else
			{
				$count ++;
			}
		}
		return ceil($count/10);
	}
	
	function get_next_prev_urls_filter($data,$sort_by,$id)
	{
		$leftJoinSize = '';
		$querySize = '';
		if(!empty($data->size))
		{
			$tr = get_object_vars($data->size);
			if(count($tr) > 0){
				$query = DB::query('SELECT [value] FROM {shop_param_element} WHERE param_id = "4" AND trash = "0" ORDER BY [value] ASC');
				$count = DB::num_rows($query);
				if($count > 0)
				{
					$tmpArr = array(); unset($i); $i = 1;
					while($size = DB::fetch_array($query))
					{
						if(!in_array($size['value'], $tmpArr) && $size['value'] != ' ' && $size['value'] != '- см' && $size['value'] != 'см' && $size['value'] != ' см'){
							$tmpArr[$i] = $size['value'];
							$i++;
						}
					}
				}

				$leftJoinSize = ' LEFT JOIN diafan_shop_param_element spe3 ON spe3.element_id = s.id AND spe3.param_id = "4"';
				$querySize = ' AND spe3.value1 IN (';

				foreach($tr as $key => $val) $querySize .= '"'.$tmpArr[intval($key)].'", ';

				$querySize = mb_substr($querySize, 0, mb_strlen($querySize) - 2);

				$querySize .= ')';
			}
		}

		$leftJoinMaterial = '';
		$queryMaterial = '';
		if(!empty($data->materials))
		{
			$tr = get_object_vars($data->materials);
			
			if(count($tr) > 0){
				$leftJoinMaterial = ' LEFT JOIN diafan_shop_param_element spe2 ON spe2.element_id = s.id AND spe2.param_id = "3"';
				$queryMaterial = ' AND spe2.value1 IN (';

				foreach($tr as $key => $val) $queryMaterial .= intval($key).', ';

				$queryMaterial = mb_substr($queryMaterial, 0, mb_strlen($queryMaterial) - 2);

				$queryMaterial .= ')';
			}
		}

		if($data->maxp == 9999 || $data->maxp > 9999) $data->maxp = 99999;

		$firstQuery = 'SELECT sp.price, s.id, sr.element_id FROM diafan_shop s
						LEFT JOIN diafan_shop_price sp ON sp.good_id = s.id
						'.$leftJoinSize.'
						'.$leftJoinMaterial.'
						LEFT JOIN diafan_shop_rel sr ON sr.rel_element_id = s.id
					WHERE s.act1 = "1" AND s.trash = "0" AND sp.price > "'.intval($data->minp).'" AND sp.price < "'.intval($data->maxp).'"'.$querySize.$queryMaterial;

		$query = DB::query($firstQuery);
		$count = DB::num_rows($query);
		$arrIDs = array();
		if($count > 0){
			while($elem = DB::fetch_array($query))
			{
				if(!in_array($elem['element_id'], $arrIDs)) $arrIDs[] = $elem['element_id'];
			}
		} else { return $this->send_errors(); }
		
		$queryCountrys = '';
		if(!empty($data->countries))
		{
			$tr = get_object_vars($data->countries);
			
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
			$tr = get_object_vars($data->usefor);
			
			if(count($tr) > 0){
				$leftJoinUsefor = ' LEFT JOIN diafan_shop_param_element spe1 ON spe1.element_id = s.id AND spe1.param_id = "2"';
				$queryUsefor = ' AND spe1.value1 IN (';

				foreach($tr as $key => $val) $queryUsefor .= intval($key).', ';

				$queryUsefor = mb_substr($queryUsefor, 0, mb_strlen($queryUsefor) - 2);

				$queryUsefor .= ')';
			}
		}

		// last

		ob_start();

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
			if($sort_by=='alphabet'){
				$order_str = 's.name1 ASC,';
			}

			$query1 = 'SELECT s.* FROM diafan_shop s
								'.$leftJoinUsefor.'
								'.$leftJoinDiscount.'
								LEFT JOIN {images} i ON i.module_name = "shop" AND i.element_id = s.id
							WHERE s.act1 = "1" AND s.trash = "0" AND s.id IN ('.implode(',', $arrIDs).')'.$queryNewAction.$queryCountrys.$queryUsefor
							. ' GROUP BY s.id'
							. ' ORDER BY '.$order_str.' IF(LENGTH(i.id) > 0, 1, 0) DESC, s.order_ex ASC';
			# print_r($query1);
			$query = DB::query($query1);
			$count = DB::num_rows($query);
			if($count > 0){
				unset($i); $i = 0; $page = 1;
				$rows =  array();
				while($row = DB::fetch_array($query))
				{
					$rows[] = $row ;
				}
				$rows = get_price_and_size_filter($rows);
				if($sort_by=='price'){
					$rows = sort_by_price($rows);
				}
			}
			$prev = '';
			$next = '';
			for($i = 0; $i<count($rows); $i++)
			{
				if($rows[$i]['id']==$id && $i==0)
				{
					$next = $rows[$i+1];
					break;
				}
				if($rows[$i]['id']==$id && $i+1<count($rows) && $i-1>=0)
				{
					$next = $rows[$i+1];
					$prev = $rows[$i-1];
					break;
				}
				if($rows[$i]['id']==$id && $i+1==count($rows))
				{
					$prev = $rows[$i-1];
				}
			}
			$route = new Route();
			return	array(
							'prev'=>$route->link($prev["site_id"], "shop",$prev["cat_id"], $prev["id"]),
							'next'=>$route->link($next["site_id"], "shop",$next["cat_id"], $next["id"])
						);
	}
	
	function get_price_and_size_filter($rows)
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
			$row['price'] = $price['price'].' '.$size;
		}
		return $rows;
	}	
?>