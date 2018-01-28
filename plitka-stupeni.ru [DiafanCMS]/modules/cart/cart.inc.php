<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if ( ! defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Подключение модуля "Корзина"
 */
class Cart_inc extends Diafan
{
	/*
	 * @var array информация, записанная в корзину
	 */
	private $cart = 'no_check';

	/*
	 * @var integer общая стоимость товаров, находящихся в корзине
	 */
	private $summ;

	/*
	 * @var integer общая стоимость товаров, находящихся в корзине, с учетом скидки
	 */
	private $summ_discount;

	/*
	 * @var integer общее количество товаров, находящихся в корзине
	 */
	private $count;

	private $count_goods_in_cart;
	
	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct(&$diafan)
	{
		$this->diafan = &$diafan;
		$this->init();
	}

	/**
	 * Возвращает информацию из корзины
	 *
	 * @param integer $id номер товра
	 * @param mixed $param характеристики товара, учитываемые в заказе
	 * @param string $name_info тип информации (count - количество, is_file - это товар-файл)
	 * @return mixed
	 */
	public function get($id = 0, $param = false, $name_info = '')
	{
		if(! $id)
		{
			return $this->cart;
		}
		if(empty($this->cart[$id]))
		{
			return false;
		}
		if($param === false)
		{
			if($name_info == "count")
			{
				$count = 0;
				foreach ($this->cart[$id] as $row)
				{
					$count += $row["count"];
				}
				return $this->cart[$id];;
			}
			return $this->cart[$id];
		}

		if(is_array($param))
		{
			asort($param);
			$param = serialize($param);
		}
		if($name_info == 'count')
		{
			$count = 0;
			foreach($this->cart[$id] as $p => $row)
			{
				if($param == $row["price_id"] || $param == $p)
				{
					$count ++;
				}
			}
			return $count;
		}

		if(empty($this->cart[$id][$param]))
		{
			return false;
		}
		if(! $name_info)
		{
			return $this->cart[$id][$param];
		}
		if(empty($this->cart[$id][$param][$name_info]))
		{
			return false;
		}
		return $this->cart[$id][$param][$name_info];
	}

	/**
	 * Возвращает количество товаров в корзине
	 * 
	 * @return integer
	 */
	public function get_count()
	{
		return $this->count;
	}

	public function get_count_goods_in_cart()
	{
		return $this->count_goods_in_cart;
	}
	
	/**
	 * Возвращает общую стоимость товаров в корзине
	 * 
	 * @return float
	 */
	public function get_summ()
	{
		return $this->summ;
	}

	/**
	 * Возвращает общую стоимость товаров в корзине с учетом скидки
	 * 
	 * @return float
	 */
	public function get_summ_discount()
	{
		return $this->summ_discount;
	}

	/**
	 * Записывает данные в корзину
	 * 
	 * @param mixed $value данные
	 * @param integer $id номер товра
	 * @param mixed $param характеристики товара, учитываемые в заказе
	 * @param string $name_info тип информации (count - количество, is_file - это товар-файл)
	 * @return void
	 */
	public function set($value = array(), $id = 0, $param = false, $name_info = '')
	{
		if(! $id)
		{
			$this->cart = $value;
			return;
		}

		if($param === false)
		{
			if($value)
			{
				$this->cart[$id] = $value;
			}
			else
			{
				unset($this->cart[$id]);
			}
			return;
		}

		if(is_array($param))
		{
			$params = $param;
			asort($param);
			$param = serialize($param);
		}
		else
		{
			$params = unserialize($param);
		}

		$price = $this->diafan->_shop->price_get($id, $params, $this->diafan->_user->id, false);
		if (! $price)
		{
			return $this->diafan->_('Товара с заданными параметрами не существует');
		}

		if(! $name_info)
		{
			if(! $value)
			{
				unset($this->cart[$id][$param]);
				if(! $this->cart[$id])
				{
					unset($this->cart[$id]);
				}
				return;
			}
			else
			{
				$this->cart[$id][$param]["is_file"] = $value["is_file"] ? true : false;
				$name_info = "count";
				$value = $value["count"];
			}
		}
		if($name_info == "count")
		{
			$value = round($value, 3); 
			if($value <= 0)
			{
				unset($this->cart[$id][$param]);
				if(! $this->cart[$id])
				{
					unset($this->cart[$id]);
				}
				return;
			}
			//товар-файл => можно купить только 1 товар
			if($this->cart[$id][$param]["is_file"] && $value > 1)
			{
				return $this->diafan->_('Файл уже добавлен в корзину');
			}
			if($this->diafan->configmodules('use_count_goods', 'shop'))
			{
				$count_price_id = 0;
				foreach ($this->cart as $check_id => $check_array)
				{
					foreach ($check_array as $check_param => $check_row)
					{
						if($param != $check_param && $price["price_id"] == $check_row["price_id"])
						{
							$count_price_id += $check_row["count"];
						}
					}
				}
				if ($count_price_id + $value > $price["count_goods"])
				{
					return $this->diafan->_('Извините, Вы запросили больше товара, чем имеется на складе.', false);
				}
			}
		}
		$this->cart[$id][$param][$name_info] = $value;
	}

	/**
	 * Пересчитывает количество товаров в корзине, общую стоимость и стоимость с учетом скидки 
	 * 
	 * @return void
	 */
	public function recalc()
	{
		$summ = 0;
		$summ_discount = 0;
		$count = 0;
		foreach ($this->cart as $good_id => $array)
		{
			foreach ($array as $param => $c)
			{
				$params = unserialize($param);
				$price = $this->diafan->_shop->price_get($good_id, $params, $this->diafan->_user->id, false);
				$price["price"] = round($price["price"]);
				$good_units = $this->get_good_units($good_id);
				if($good_units!='м2')
				{
					$summ +=  $price["price"] * round($c["count"]);
				}
				else
				{
					$summ += $price["price"] * $c["count"];
				}
				$this->cart[$good_id][$param]["price_id"] = $price["price_id"];
				$count += $c["count"];
			}
			$count_goods_in_cart++;
		}
		$this->count = $count;
		$this->summ = $summ;
		$this->count_goods_in_cart = $count_goods_in_cart;
		$_SESSION["cart_summ"] = $this->summ;
		$_SESSION["cart_count"] = $this->count;
		$_SESSION['count_goods_in_cart'] = $this->count_goods_in_cart;
		
		
		foreach ($this->cart as $good_id => $array)
		{
			foreach ($array as $param => $c)
			{
				$params = unserialize($param);
				$price_discount = $this->diafan->_shop->price_get($good_id, $params, $this->diafan->_user->id);
				if($good_units=='шт')
				{
					$summ_discount += $price_discount["price"] * round($c["count"]);
				}
				else
				{
					$summ_discount += $price_discount["price"] * $c["count"];
				}
			}
		}
		$this->summ_discount = $summ_discount;
		$_SESSION["cart_summ_discount"] = $this->summ_discount;
	}

	/**
	 * Записывает информацию о корзине в хранилище
	 * 
	 * @return void
	 */
	public function write()
	{
		if($this->diafan->_user->id)
		{
			$old_cart = array();
			$result = DB::query("SELECT * FROM {shop_cart} WHERE user_id=%d AND trash='0'", $this->diafan->_user->id);
			while($row = DB::fetch_array($result))
			{
				$old_cart[$row["good_id"]][$row["param"]] = $row;
			}
			foreach($this->cart as $id => $rows)
			{
				foreach($rows as $param => $row)
				{
					if(! empty($old_cart[$id][$param]))
					{
						if($row["count"] != $old_cart[$id][$param]["count"])
						{
							DB::query("UPDATE {shop_cart} SET created=%d, count=%d WHERE id=%d", time(), $row["count"], $old_cart[$id][$param]["id"]);
						}
						unset($old_cart[$id][$param]);
					}
					else
					{
						DB::query("INSERT INTO {shop_cart} (good_id, created, count, param, is_file, user_id, price_id) VALUES (%d, %d, %d, '%s', '%d', %d, %d)", $id, time(), $row["count"], $param, $row["is_file"], $this->diafan->_user->id, $row["price_id"]);
					}
				}
			}
			foreach($old_cart as $id => $rows)
			{
				foreach($rows as $row)
				{
					DB::query("DELETE FROM {shop_cart} WHERE id=%d", $row["id"]);
				}
			}
		}
		else
		{
			$_SESSION["cart"] = $this->cart;
		}
	}

	/**
	 * Инициализация корзины
	 * 
	 * @return void
	 */
	public function init()
	{
		if($this->cart === 'no_check')
		{
			$this->cart = array();
			if($this->diafan->_user->id)
			{
				$result = DB::query("SELECT * FROM {shop_cart} WHERE user_id=%d AND trash='0'", $this->diafan->_user->id);
				while($row = DB::fetch_array($result))
				{
					$this->cart[$row["good_id"]][$row["param"]]["price_id"] = $row["price_id"];
					$this->cart[$row["good_id"]][$row["param"]]["count"] = $row["count"];
					$this->cart[$row["good_id"]][$row["param"]]["is_file"] = $row["is_file"];
				}
				if(! isset($_SESSION["cart_summ"]) && ! isset($_SESSION["cart_summ_discount"]) && ! isset($_SESSION["cart_count"]))
				{
					$this->recalc();
				}
				else
				{
					if($this->cart && empty($_SESSION["cart_count"]))
					{
						$this->recalc();
					}
					if(! empty($_SESSION["cart"]))
					{
						foreach($_SESSION["cart"] as $id => $rows)
						{
							foreach($rows as $param => $row)
							{
								$this->set($row, $id, $param);
							}
						}
						$this->recalc();
						$this->write();
						unset($_SESSION["cart"]);
					}
					else
					{
						$this->summ = $_SESSION["cart_summ"];
						$this->summ_discount = $_SESSION["cart_summ_discount"];
						$this->count = $_SESSION["cart_count"];
						$this->count_goods_in_cart = $_SESSION['count_goods_in_cart'];
					}
				}
			}
			else
			{
				$this->cart = ! empty($_SESSION["cart"]) ? $_SESSION["cart"] : array();
				$this->summ = ! empty($_SESSION["cart_summ"]) ? $_SESSION["cart_summ"] : 0;
				$this->summ_discount = ! empty($_SESSION["cart_summ_discount"]) ? $_SESSION["cart_summ_discount"] : 0;
				$this->count = ! empty($_SESSION["cart_count"]) ? $_SESSION["cart_count"] : 0;
				$this->count_goods_in_cart = ! empty($_SESSION["count_goods_in_cart"]) ? $_SESSION["count_goods_in_cart"] : 0;
			}
		}
	}
	
	public function get_good_units($good_id)
	{
		$params = $this->get_param($good_id, 29);
		foreach($params as $param)
		{
			if($param['id'] == 5) $size_type	= $param['value'];
		}
		return $size_type;
	}
	
	/**
	 * Получает дополнительные характеристики товара
	 * 
	 * @param integer $id номер товара
	 * @param integer $site_id номер страницы, к которой прикреплен товар
	 * @param string $function функция, для которой выбираются параметры
	 * @return array
	 */
	public function get_param($id, $site_id, $function = "id")
	{
		global $param_select, $param_select_page;
		$values = array();
		$rvalues = array();
		$result_el = DB::query("SELECT e.value".$this->diafan->language_base_site." as rvalue, e.[value], e.param_id, e.id FROM {shop_param_element} as e"
		. " LEFT JOIN {shop_param_select} as s ON e.param_id=s.param_id AND e.param_id=s.id"
		. " WHERE e.element_id=%d GROUP BY e.id ORDER BY s.sort ASC", $id);
		while ($row_el = DB::fetch_array($result_el))
		{
			$values[$row_el["param_id"]][] = $row_el;
		}
		$result = DB::query("SELECT p.id, p.[name], p.type, p.page, p.[measure_unit], p.config FROM {shop_param} as p "
		. ($this->diafan->configmodules("cat", "shop", $site_id) ? " INNER JOIN {shop_category_rel} as c ON c.element_id=".$id : "")
		. " INNER JOIN {shop_param_category_rel} as cp ON cp.element_id=p.id "
		. ($this->diafan->configmodules("cat", "shop", $site_id) ?
				" AND (cp.cat_id=c.cat_id OR cp.cat_id=0) " : "")
		. " WHERE p.trash='0' "
		. ($function == "block" ? " AND p.block='1'" : '')
		. ($function == "list" ? " AND p.list='1'" : '')
		. " GROUP BY p.id ORDER BY p.sort ASC"
		);

		$param = array();
		while ($row = DB::fetch_array($result))
		{
			switch ($row["type"])
			{
				case "text":
				case "textarea":
				case "editor":
					if ( ! empty($values[$row["id"]][0]["value"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["value"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "date":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $this->diafan->formate_from_date($values[$row["id"]][0]["rvalue"]),
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "datetime":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $this->diafan->formate_from_datetime($values[$row["id"]][0]["rvalue"]),
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
				case "select":
					$value = ! empty($values[$row["id"]][0]["rvalue"]) ? $values[$row["id"]][0]["rvalue"] : '';
					if ($value)
					{
						if (empty($param_select[$row["id"]][$value]))
						{
							$param_select[$row["id"]][$value] = DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $values[$row["id"]][0]["rvalue"], $row["id"]);
						}
						if ($row["page"])
						{
							if (empty($param_select_page[$row["id"]][$value]))
							{
								$param_select_page[$row["id"]][$value] = $this->diafan->_route->link($site_id, "shop", 0, 0, $value);
							}
							$link = $param_select_page[$row["id"]][$value];
							$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value], "link" => $link);
						}
						else
						{
							$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value]);
						}
					}
					break;
				case "multiple":
					if ( ! empty($values[$row["id"]]))
					{
						$value = array();
						foreach ($values[$row["id"]] as $val)
						{
							if (empty($param_select[$row["id"]][$val["rvalue"]]))
							{
								$param_select[$row["id"]][$val["rvalue"]] =
										DB::query_result("SELECT [name] FROM {shop_param_select} WHERE id=%d AND param_id=%d LIMIT 1", $val["rvalue"], $row["id"]);
							}
							if ($row["page"])
							{
								if ($this->diafan->module == 'shop' && $this->diafan->param == $val["rvalue"])
								{
									$link = '';
								}
								else
								{
									if (empty($param_select_page[$row["id"]][$val["rvalue"]]))
									{
										$param_select_page[$row["id"]][$val["rvalue"]] = $this->diafan->_route->link($site_id, "shop", 0, 0, $val["rvalue"]);
									}
									$link = $param_select_page[$row["id"]][$val["rvalue"]];
								}
								$value[] = array("id" => $row["id"], "name" => $param_select[$row["id"]][$val["rvalue"]], "link" => $link);
							}
							else
							{
								$value[] = $param_select[$row["id"]][$val["rvalue"]];
							}
						}
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $value);
					}
					break;
				case "checkbox":
					$value = ! empty($values[$row["id"]][0]["rvalue"]) ? 1 : 0;
					if ( ! isset($param_select[$row["id"]][$value]))
					{
						$param_select[$row["id"]][$value] =
								DB::query_result("SELECT [name] FROM {shop_param_select} WHERE value=%d AND param_id=%d LIMIT 1", $value, $row["id"]);
					}
					if ( ! $param_select[$row["id"]][$value] && $value == 1)
					{
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => '');
					}
					else
					{
						$param[] = array("id" => $row["id"], "name" => $row["name"], "type" => $row["type"], "value" => $param_select[$row["id"]][$value]);
					}
					break;
				case "title":
					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => ''
					);
					break;
				case "numtext":
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["rvalue"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"],
							"measure_unit" => $row["measure_unit"]
						);
					}
					break;
				case "images":
					$value = $this->diafan->_images->get('large', $id, "shop", 0, '', $row["id"]);
					if(! $value)
						continue 2;

					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => $value
					);
					break;
				case "attachments":
					$config = unserialize($row["config"]);
					if($config["attachments_access_admin"])
						continue 2;

					$value = $this->diafan->_attachments->get($id, "shop", 0, $row["id"]);
					if(! $value)
						continue 2;

					$param[] = array(
						"id" => $row["id"],
						"name" => $row["name"],
						"type" => $row["type"],
						"value" => $value,
						"use_animation" => ! empty($config["use_animation"]) ? true : false
					);
					break;
				default:
					if ( ! empty($values[$row["id"]][0]["rvalue"]))
					{
						$param[] = array(
							"id" => $row["id"],
							"name" => $row["name"],
							"value" => $values[$row["id"]][0]["rvalue"],
							"value_id" => $values[$row["id"]][0]["id"],
							"type" => $row["type"]
						);
					}
					break;
			}
		}
		return $param;
	}
}