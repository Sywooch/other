<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Wishlist_model
 *
 * Модель модуля "Список желаний"
 */
class Wishlist_model extends Model
{
	/**
	 * Генерирует данные для формы редактирования товаров
	 * 
	 * @return array
	 */
	public function form()
	{
	$this->result["error"] = $this->get_error("wishlist");
	$this->result["currency"] = $this->diafan->configmodules("currency", "shop");
	$this->result["summ"] = 0;
	$this->result["count"] = 0;
	$wishlist = $this->diafan->_wishlist->get();
	if ($wishlist)
	{
		$k = 0;
		foreach ($wishlist as $good_id => $array)
		{
				if (!$row = DB::fetch_array(DB::query("SELECT id, [name], article, cat_id, site_id FROM {shop} WHERE [act]='1' AND id = %d AND trash='0' LIMIT 1", $good_id)))
				{
					continue;
				}
				$link = $this->diafan->_route->link($row["site_id"], "shop", $row["cat_id"], $row["id"]);
				$img = $this->diafan->_images->get('medium', $good_id, 'shop', $row["site_id"], $row["name"]);
				foreach ($array as $param => $c)
				{
					$this->result["rows"][$k]["name"] = $row["name"];
					$this->result["rows"][$k]["article"] = $row["article"];
					$this->result["rows"][$k]["link"] = $link;
					$query = array();
					$params = unserialize($param);
					foreach ($params as $id => $value)
					{
						$query[] = 'p'.$id.'='.$value;
						if (empty($param_names[$id]))
						{
							$param_names[$id] = DB::query_result("SELECT [name] FROM {shop_param} WHERE id=%d LIMIT 1", $id);
						}
						if (empty($select_names[$id][$value]))
						{
							$select_names[$id][$value] =
								DB::query_result("SELECT [name] FROM {shop_param_select} WHERE param_id=%d AND id=%d LIMIT 1", $id, $value);
						}

						$this->result["rows"][$k]["name"] .= ', '.$param_names[$id].': '.$select_names[$id][$value];
					}
					$row_price = $this->diafan->_shop->price_get($good_id, $params, $this->diafan->_user->id);

					$price = $row_price["price"];

					$this->result["rows"][$k]["link"] .= !empty($query) ? '?'.implode('&', $query) : '';
					$this->result["rows"][$k]["count"] = $c["count"];
					if ($img)
					{
						if($price_image_rel = DB::query_result("SELECT image_id FROM {shop_price_image_rel} WHERE price_id=%d LIMIT 1", $row_price["price_id"]))
						{
							foreach($img as $i)
							{
								if($i["id"] == $price_image_rel)
								{
									$this->result["rows"][$k]["img"] = $i;
								}
							}
						}
						if(empty($this->result["rows"][$k]["img"]))
						{
							$this->result["rows"][$k]["img"] = $img[0];
						}
					}
					$this->result["rows"][$k]["id"] = $row["id"].'_'.str_replace(array('{',':',';','}',' ','"',"'"), '', $param);
					$this->result["rows"][$k]["price"] = $this->diafan->_shop->price_format($price);
					$this->result["rows"][$k]["summ"] = $this->diafan->_shop->price_format($price * $c["count"]);

					$this->result["summ"] += $price * $c["count"];
					$this->result["count"] += $c["count"];
					$k++;
				}
		}
	}
	$this->result["summ"] = $this->diafan->_shop->price_format($this->result["summ"]);

		return $this->result;
	}
}