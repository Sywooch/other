<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Banners_model
 *
 * Модель модуля "Баннеры"
 */
class Banners_model extends Model
{
	/**
	 * Генерирует данные для шаблонной функции: блок баннера
	 *
	 * @param integer $id идентификатор баннера
	 * @param integer $count количество баннеров
	 * @param integer $cat_id категория
	 * @return array
	 */
	public function show_block($id, $count, $sort, $cat_id)
	{
		$time = mktime(date("H"), date("m"), 0);
		$this->result["rows"] = array();
		if (!empty($id))
		{
			$result = DB::query("SELECT e.id, e.type, e.file, e.html, e.link, e.check_number, e.show_number, e.check_user, e.show_user, e.check_click, e.show_click, e.count_view, e.width, e.height, e.[alt], e.[title], e.target_blank"
			." FROM {banners} AS e"
			." INNER JOIN {banners_site_rel} AS r ON r.element_id=e.id AND (r.site_id=%d OR r.site_id=0)"
			." WHERE e.[act]='1' AND e.trash='0'"
			." AND e.id=%d AND (e.date_start<=%d OR e.date_start=0) AND (e.date_finish>=%d OR e.date_finish=0) LIMIT 1",
			$this->diafan->cid,
			$id, $time, $time);

			$this->result["rows"] = $this->get_elements($result);
		}
		else
		{
			$cat_id = $this->diafan->configmodules("cat", "banners") ? $cat_id : 0;

			$result = DB::query(
					"SELECT DISTINCT e.id, e.type, e.file, e.html, e.link, e.check_number,"
					." e.show_number, e.check_user, e.show_user, e.check_click, e.show_click, e.count_view, e.width, e.height, e.[alt], e.[title], e.target_blank"
					." FROM {banners} as e"
					." INNER JOIN {banners_site_rel} AS r ON r.element_id=e.id AND (r.site_id=%d OR r.site_id=0)"
					." WHERE e.[act]='1' AND e.trash='0'"
					." AND (e.date_start<=%d OR e.date_start=0) AND (e.date_finish>=%d OR e.date_finish=0)"
					.($cat_id ? " AND e.cat_id=%d" : '')
					." ORDER BY created ASC",
					$this->diafan->cid, $time, $time, $cat_id
				);

			$rows = $this->get_elements($result);
			$max_count = count($rows);

			if($count === "all" || ($count >= $max_count && $sort === 'date'))
			{
				$this->result["rows"] = $rows;
			}
			elseif($count < $max_count && $sort === 'date')
			{
			    $this->result["rows"] = array_slice($rows, 0, $count);
			}    
			else
			{
				if (!empty($rows))
				{
					$rands = array();
					while($count)
					{
						$rand = mt_rand(0, $max_count - 1);
						if(! in_array($rand, $rands))
						{
							$rands[] = $rand;
							$this->result["rows"][] = $rows[$rand];
							$count--;
						}
					}
				}
			}
		}
		foreach($this->result["rows"] as $i => $row)
		{			
			$row['count_view'] = $row['count_view'] + 1;			
			DB::query("UPDATE {banners} SET count_view=%d WHERE id=%d", $row['count_view'], $row['id']);

			if ($row['check_number'])
			{
				$row['show_number'] = $row['show_number'] - 1;
				DB::query("UPDATE {banners} SET show_number=%d WHERE id=%d", $row['show_number'], $row['id']);
			}			
		}

		return $this->result["rows"];
	}

	/**
	 * Форматирует данные об объявлении для списка баннеров
	 *
	 * @param resource $result результат выполнения SQL-запроса
	 * @return array
	 */
	private function get_elements($result)
	{
		$time = time(); 
		$rows = array();		
		while ($row = DB::fetch_array($result))
		{
			$show_number = true;
			$show_click = true;
			
			if ($row['type'] == 0)
			{
				break;
			}

			if ($row['type'] == 1)
			{
				$row['image'] = $row['file'];
				unset ($row['html']);
				unset ($row['file']);
			}

			if ($row['type'] == 2)
			{
				$row['swf'] = $row['file'];
				unset ($row['html']);
				unset ($row['file']);
			}

			if ($row['type'] == 3)
			{
				unset ($row['file']); 
			}

			if (!empty($row['check_user']))
			{
				if(!isset($_COOKIE['show_banner_'.$row['id']]) || !isset($_COOKIE['end_show_banner_'.$row['id']]))
				{
					setcookie('show_banner_'.$row['id'], 1, $time+86400, '/');
					setcookie('end_show_banner_'.$row['id'], $time+86400, $time+86400, '/');
				}
				elseif($_COOKIE['show_banner_'.$row['id']] <= $row['show_user'] && $_COOKIE['end_show_banner_'.$row['id']] > $time)
				{
					$new_cookie_value = $_COOKIE['show_banner_'.$row['id']] + 1;
					setcookie('show_banner_'.$row['id'], $new_cookie_value, $time+86400, '/');
				}
				elseif($_COOKIE['end_show_banner_'.$row['id']] < $time)
				{
					setcookie('show_banner_'.$row['id'], 1, $time+86400, '/');
					setcookie('end_show_banner_'.$row['id'], $time+86400, $time+86400, '/');
				}
				else
				{
					break;
				}
			}
			
			if(!empty($row['check_number']))
			{
				if($row['show_number'] == 0 )
				{
					$show_number = false;
				}				
			}
			
			if(!empty($row['check_click']))
			{
				if($row['show_click'] == 0 )
				{
					$show_click = false;
				}				
			}
			
			if(!empty($show_number) && !empty($show_click))
			{
			    $rows[] = $row;
			}
		}
		return $rows;
	}
}