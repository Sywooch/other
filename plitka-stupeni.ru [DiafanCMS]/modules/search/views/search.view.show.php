<?php
/**
 * Результаты поиска
 *
 * Шаблон вывода результатов поиска по сайту
 *
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/*

$this->htmleditor('<insert name="show_search" module="search" button="Найти">');

if (! empty($result["value"]))
{
	echo '<div class="search_result">'.$this->diafan->_('Всего найдено').": <b>".$result["value"].": ".$result["count"]."</b>
	<br>".$this->diafan->_('Документы: <strong>%d—%d</strong> из %d найденных', true, $result["count_start"], $result["count_finish"], $result["count"])
	. '</div>';

	if (!empty($result["rows"]))
	{
		$i = $result["count_start"];
		foreach ($result["rows"] as $row)
		{
			if($row['table_name'] == 'shop')
			{
				$res = DB::fetch_array(DB::query('SELECT element_id FROM {shop_rel} WHERE rel_element_id = "'.$row['element_id'].'"'));
				if($res)
				{
					$link = DB::fetch_array(DB::query('SELECT rewrite FROM {rewrite} WHERE module_name = "shop" AND element_id = "'.$res['element_id'].'"'));
					if($link)
					{
						$row["link"] = BASE_PATH_HREF.$link['rewrite'].'/';
					}
				}
			}
			echo '<div class="search_list">'.$i++.'. '
			.'<a href="'.$row["link"].'">'.$row["name"].'</a>'
			.'<br>'
			.$row["snippet"]
			.'<br>'
			.'<a href="'.$row["link"].'">'.$row["link"].'</a>'
			.'</div>';
		}
	}
	echo (!empty($result["paginator"]) ? $result["paginator"] : '');
}
else
{
	echo '<div class="search_result">'.$this->diafan->_('Извините, слово для поиска не задано.').'</div>';
}
*/

			echo '<h1>Результаты поиска по запросу «<span>'.(isset($_GET['searchword']) ? $_GET['searchword'] : '').'</span>»</h1>';
			
			$search_key = (isset($_GET['searchword']) ? htmlspecialchars(strip_tags($_GET['searchword'])) : '');
			$serach_key = trim($search_key);
			$search_key = strtoupper($search_key); // почему то маленькая d не восспринимаеться =/

			if(!empty($search_key) && mb_strlen($search_key) >= 3)
			{
				$data = array();

				$res = DB::query('SELECT * FROM {shop_category} WHERE parent_id != "0" AND act1 = "1" AND trash = "0" AND name1 LIKE "%'.$search_key.'%" LIMIT 0, 10');
				while($row = DB::fetch_array($res))
				{
					$images = $this->diafan->_images->get("medium", $row['id'], "shop", 29, $row['name'], true);
					$data[] = array(
											'name'	=> $row['name1'],
											'url'	=> '/'.$this->diafan->_route->link(29, 'shop', $row['id'], 0),
											'img'	=> $images[0],
								);
				}

				if(count($data) > 0)
				{
					echo '<h2>Фабрики:</h2>';

					foreach($data as $coll)
					{
						echo '<div class="search_res_coll">';
						echo '<img src="'.$coll['img']['src'].'" alt="'.$coll['img']['alt'].'">';
						echo '<div class="descr">';
						echo '<a class="name" href="'.$coll['url'].'">'.$coll['name'].'</a>';
						echo '</div>';
						echo '<div style="clear: both;"></div>';
						echo '</div>';
					}
				}
				
				$data = array();
				
				$res = DB::query('SELECT * FROM {shop} WHERE cat_id != "8" AND act1 = "1" AND trash = "0" AND name1 LIKE "%'.$search_key.'%" LIMIT 0, 10');
				while($row = DB::fetch_array($res))
				{
					$images = $this->diafan->_images->get("medium", $row['id'], "shop", 29, $row['name'], false);
					$ges = DB::fetch_array(DB::query('SELECT c1.id AS fid, c1.name1 AS fname, c2.id AS cid, c2.name1 AS cname FROM {shop_category} c1 LEFT JOIN {shop_category} c2 ON c2.id = c1.parent_id WHERE c1.id = "'.$row['cat_id'].'"'));
					$data[] = array(
											'name'		=> $row['name1'],
											'url'		=> '/'.$this->diafan->_route->link(29, 'shop', 0, $row['id']),
											'img'		=> $images[0],
											'fabric'	=> '<a class="fabric" href="/'.$this->diafan->_route->link(29, 'shop', $ges['fid'], 0).'">'.$ges['fname'].'</a>',
											'country'	=> '<span class="country">('.$ges['cname'].')</span>'
								);
				}

				if(count($data) > 0)
				{
					echo '<h2>Коллекции:</h2>';
					
					foreach($data as $coll)
					{
						echo '<div class="search_res_coll">';
						echo '<img src="'.$coll['img']['src'].'" alt="'.$coll['img']['alt'].'">';
						echo '<div class="descr">';
						echo '<a class="name" href="'.$coll['url'].'">'.$coll['name'].'</a>';
						echo '<div style="clear: both;"></div>';
						echo $coll['fabric'];
						echo '<div style="clear: both;"></div>';
						echo $coll['country'];
						echo '</div>';
						echo '<div style="clear: both;"></div>';
						echo '</div>';
					}
				}

				$data = array();

				$res = DB::query('SELECT * FROM {shop} WHERE cat_id = "8" AND act1 = "1" AND trash = "0" AND name1 LIKE "%'.$search_key.'%" LIMIT 0, 10');
				while($row = DB::fetch_array($res))
				{
					$images = $this->diafan->_images->get("medium", $row['id'], "shop", 29, $row['name'], false);
					$ges1 = DB::fetch_array(DB::query('SELECT value1 FROM {shop_param_element} WHERE element_id = "'.$row['id'].'" AND param_id = "4"'));
					$ges2 = DB::fetch_array(DB::query('SELECT value1 FROM {shop_param_element} WHERE element_id = "'.$row['id'].'" AND param_id = "7"'));
					$data[] = array(
											'name'	=> $row['name1'],
											'url'	=> '/'.$this->diafan->_route->link(29, 'shop', 0, $row['id']),
											'img'	=> $images[0],
											'size'	=> '<span class="size">'.$ges1['value1'].'</span>',
											'ptype'	=> '<span class="ptype">'.$ges2['value1'].'</span>'
								);
				}

				if(count($data) > 0)
				{
					echo '<h2>Элементы коллекций:</h2>';

					foreach($data as $coll)
					{
						echo '<div class="search_res_coll">';
						echo '<img src="'.$coll['img']['src'].'" alt="'.$coll['img']['alt'].'">';
						echo '<div class="descr">';
						echo '<a class="name" href="'.$coll['url'].'">'.$coll['name'].'</a>';
						echo '<div style="clear: both;"></div>';
						echo $coll['size'];
						echo '<div style="clear: both;"></div>';
						echo $coll['ptype'];
						echo '</div>';
						echo '<div style="clear: both;"></div>';
						echo '</div>';
					}
				}
			}