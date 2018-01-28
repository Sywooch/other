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
 * Подключение модуля "Магазин" для работы с ценами
 */
class Shop_inc_price extends Diafan
{
	/**
	 * @var boolean false|integer сумма всех покупок текущего пользователя
	 */
	public $order_summ = false;

	/**
	 * @var boolean false|integer стоимость товаров в корзине без учета скидок
	 */
	public $cart_summ = false;

	/**
	 * Получает цену товара с указанными параметрами для пользователя
	 * 
	 * @param integer $good_id номер товара
	 * @param array $params параметры, влияющие на цену
	 * @param integer $user_id номер пользователя
	 * @param boolean $threshold учитывать скидки, зависящие от объема покупки
	 * @param boolean $without_discount выбрать основную цену (без скидки)
	 * @return array
	 */
	public function get($good_id, $params, $user_id, $threshold = true, $without_discount = false)
	{
		$where = array();
		foreach($params as $id => $value)
		{
			$where[] = "s.param_id=".intval($id)." AND (s.param_value=".intval($value)." OR s.param_value=0)";
		}
		$role_id = 0;
		$order_summ = 0;
		if($user_id == $this->diafan->_user->id)
		{
			$role_id = $this->diafan->_user->role_id;
		}
		elseif($user_id)
		{
			$user = DB::fetch_array(DB::query("SELECT role_id FROM {users} WHERE id=%d LIMIT 1", $user_id));
			$role_id = $user["role_id"];
		}
		if($threshold)
		{
			$cart_summ = $this->get_cart_summ();
			$order_summ = $this->get_order_summ($user_id);
		}
		else
		{
			$cart_summ = 0;
			$order_summ = 0;
		}
		$price = DB::fetch_array(DB::query("SELECT id, price_id, count_goods, price, old_price, discount_id FROM {shop_price} AS p WHERE good_id=%d"
			.($where ? " AND (SELECT COUNT(*) FROM {shop_price_param} AS s WHERE p.price_id=s.price_id AND (".implode(" OR ", $where).")) = ".count($params) : "")
			." AND currency_id=0"
			." AND role_id".($role_id ? " IN (0,".$role_id.")" : "=0")
			." AND threshold <= %d"
			." AND threshold_cumulative <= %d"
			." AND user_id".($user_id ? " IN (0,".$user_id.")" : "=0")
			." AND date_start<=%d AND (date_finish=0 OR date_finish>=%d)"
			.($without_discount ? " AND id=price_id": "")
			." AND trash='0' ORDER BY price LIMIT 1",
			$good_id, $cart_summ, $order_summ, time(), time()));
		
		return $price;
	}

	/**
	 * Получает все цены товара для пользователя
	 * 
	 * @param integer $good_id номер товара
	 * @param integer $user_id номер пользователя
	 * @param boolean $threshold учитывать скидки, зависящие от объема покупки
	 * @return array
	 */
	public function get_all($good_id, $user_id, $threshold = true)
	{
		$rows = array();
		$role_id = 0;
		$price_ids = array();
		$pr1 = ! empty($_GET["pr1"]) ? intval($_GET["pr1"]) : 0;
		$pr2 = ! empty($_GET["pr2"]) ? intval($_GET["pr2"]) : 0;
		if($user_id == $this->diafan->_user->id)
		{
			$role_id = $this->diafan->_user->role_id;
		}
		elseif($user_id)
		{
			$user = DB::fetch_array(DB::query("SELECT role_id FROM {users} WHERE id=%d LIMIT 1", $user_id));
			$role_id = $user["role_id"];
		}
		if($threshold)
		{
			$cart_summ = $this->get_cart_summ();
			$order_summ = $this->get_order_summ($user_id);
		}
		else
		{
			$cart_summ = 0;
			$order_summ = 0;
		}
		// выбирает все цены товара, доступные текущиму типу пользователю, действующие в текущий период времени
		// если действует несколько скидок , выбирает самую выгодную цену
		$result_price = DB::query(
				"SELECT id, price, old_price, count_goods, price_id, discount, date_finish FROM {shop_price}"
				." WHERE good_id=%d AND trash='0'"
				." AND currency_id=0"
				." AND role_id".($role_id ? " IN (0,".$role_id.")" : "=0")
				." AND threshold <= %d"
				." AND threshold_cumulative <= %d"
				." AND user_id".($user_id ? " IN (0,".$user_id.")" : "=0")
				." AND date_start<=%d AND (date_finish=0 OR date_finish>=%d)"
				." ORDER BY price ASC", $good_id, $cart_summ, $order_summ, time(), time());
		while ($row_price = DB::fetch_array($result_price))
		{
			if(! in_array($row_price["price_id"], $price_ids))
			{
				$price_ids[] = $row_price["price_id"];
				if($pr1 && $row_price["price"] < $pr1)
				{
					continue;
				}
				if($pr2 && $row_price["price"] > $pr2)
				{
					continue;
				}
				$rows[] = $row_price;
			}
		}
		return $rows;
	}

	/**
	 * Получает основы для цен на товар (указываемые в панеле администрирования)
	 * 
	 * @param integer $good_id номер товара
	 * @return array
	 */
	public function get_base($good_id)
	{
		$result = DB::query("SELECT id, price_id, price, currency_id, count_goods FROM {shop_price} WHERE good_id =%d AND trash = '0' AND (currency_id>0 OR price_id=id) ORDER BY currency_id DESC, price ASC", $good_id);

		$prices = array();
		$rows = array();
		while ($row = DB::fetch_array($result))
		{
			if(in_array($row["price_id"], $prices))
				continue;
			$prices[] = $row["price_id"];

			$row['currency_name'] = $this->get_currency_name($row['currency_id']);

			$row["param"] = array();
			$result_param = DB::query("SELECT param_id, param_value FROM {shop_price_param} WHERE price_id=%d", $row["price_id"]);
			while ($row_param = DB::fetch_array($result_param))
			{
				$row["param"][$row_param["param_id"]] = $row_param["param_value"];
			}
			$rows[] = $row;
		}
		
		return $rows;
	}

	private function get_currency_name($id)
	{
		static $currency = array();

		if(empty($currency[$id]))
		{
			if($id > 0)
			{
				$currency[$id] = DB::query_result("SELECT name FROM {shop_currency} WHERE id=%d LIMIT 1",$id);
			}
			else
			{
				$currency[0] = $this->diafan->configmodules("currency");
			}
		}
		return $currency[$id];
	}

	/**
	 * Рассчитывает все возможные вариации цен и записывает их в базу данных
	 * 
	 * @param integer $good_id номер товара, если не задан, цены рассчитываются для всех товаров
	 * @param integer $discount_id номер скидки
	 * @param integer $currency_id номер валюты, если нужно изменить цены, указанные в валюте
	 * @return void
	 */
	public function calc($good_id, $discount_id = 0, $currency_id = 0)
	{
		// пересчитывает цены в основную валюту, если редактируем товар или валюту
		if($currency_id || $good_id)
		{
			// валюты
			$currency = array();
			$result = DB::query("SELECT * FROM {shop_currency} WHERE trash='0'".($currency_id ? " AND id=%d" : ""), $currency_id);
			while($row = DB::fetch_array($result))
			{
				$currency[] = $row;
			}

			foreach($currency as $c)
			{
				$result = DB::query("SELECT * FROM {shop_price} WHERE trash='0'".($good_id ? " AND good_id=".$good_id : '')." AND currency_id=%d", $c["id"]);
				while($row = DB::fetch_array($result))
				{
					// удаляет все цены, для которых есть цена в валюте
					DB::query("DELETE FROM {shop_price} WHERE currency_id=0".($good_id ? " AND good_id=".$good_id : '')." AND price_id=%d", $row["price_id"]);
					$new_price = $c["exchange_rate"] * $row["price"];
					DB::query("INSERT INTO {shop_price} (good_id, price, count_goods) VALUES (%d, %f, %d)", $row["good_id"], $new_price, $row["count_goods"]);
					$price_id = DB::last_id("shop_price");
					DB::query("UPDATE {shop_price_param} SET price_id=%d WHERE price_id=%d OR price_id=%d", $price_id, $row["price_id"], $row["id"]);
					DB::query("UPDATE {shop_price} SET price_id=%d WHERE id=%d OR price_id=%d", $price_id, $price_id, $row["price_id"]);
				}
			}
		}
		// удаляет все цены, сформированные с учетом скидки
		DB::query("DELETE FROM {shop_price} WHERE price_id<>id AND currency_id=0".($good_id ? " AND good_id=".$good_id : '').($discount_id ? " AND discount_id=".$discount_id : ''));

		// скидки
		$discounts = array();
		$result = DB::query("SELECT * FROM {shop_discount} WHERE act='1' AND trash='0'".($discount_id ? " AND id=".$discount_id : '')." AND (coupon='' OR user_id>0)");
		while($row = DB::fetch_array($result))
		{
			if($row["date_finish"] && $row["date_finish"] < time())
			{
				continue;
			}
			$row["objects"] = array();
			$result_object = DB::query("SELECT * FROM {shop_discount_object} WHERE discount_id=%d", $row["id"]);
			while($row_object = DB::fetch_array($result_object))
			{
				$row["objects"][] = $row_object;
			}
			$discounts[] = $row;
		}

		// пересчитывает цены с учетом скидки
		if($discounts)
		{
			$result = DB::query("SELECT p.*, s.cat_id FROM {shop_price} AS p INNER JOIN {shop} AS s ON p.good_id=s.id WHERE p.trash='0'".($good_id ? " AND p.good_id=".$good_id : '')." AND p.price_id=p.id");
			while($row = DB::fetch_array($result))
			{
				// категории текущего товара
				$cats = array();
				$result_cat = DB::query("SELECT cat_id FROM {shop_category_rel} WHERE element_id=%d", $row["good_id"]);
				while($row_cat = DB::fetch_array($result_cat))
				{
					$cats[] = $row_cat["cat_id"];
				}
				foreach($discounts as $d)
				{
					$in_discount = false;
					if(empty($d["objects"][0]) || empty($d["objects"][0]["cat_id"]) && empty($d["objects"][0]["good_id"]))
					{
						$in_discount = true;
					}
					else
					{
						foreach($d["objects"] as $d_o)
						{
							if($d_o["cat_id"] && in_array($d_o["cat_id"], $cats) || $d_o["good_id"] == $row["good_id"])
							{
								$in_discount = true;
								break;
							}
						}
					}
					if($in_discount)
					{
						$price = $row['price'];
						// скидка действует от суммы
						if (empty($d['amount']) || $price > $d['amount'])
						{
							// фиксированная сумма к вычету
							if ( ! empty($d['deduction']))
							{
								$price -= $d['deduction'];
							}
							else
							{
								$price = $price * (100 - $d['discount']) / 100;
							}
						}
						if($price != $row["price"])
						{
							DB::query("INSERT INTO {shop_price} (good_id, price, old_price, count_goods, price_id, date_start, date_finish, discount, discount_id, threshold, threshold_cumulative, user_id, role_id) VALUES (%d, %f, %f, %d, %d, %d, %d, %f, %d, %d, %d, %d, %d)", $row["good_id"], $price, $row["price"], $row["count_goods"], $row["id"], $d["date_start"], $d["date_finish"], $d["discount"], $d["id"], $d["threshold"], $d["threshold_cumulative"], $d["user_id"], $d["role_id"]);
						}
					}
				}
			}
		}
	}

	/**
	 * Добавляет базовую цену для товара
	 * 
	 * @param integer $good_id номер товара
	 * @param float $price цена
	 * @param integer $count количество товара
	 * @param integer $params
	 * @param integer $currency_id номер валюты
	 * @param integer $import_id ид цены для импорта
	 * @return void
	 */
	public function insert($good_id, $price, $count, $params = array(), $currency_id = 0, $import_id = '', $image_id = 0)
	{
		if($import_id)
		{
			$id = DB::query_result("SELECT id FROM {shop_price} WHERE import_id='%h' AND good_id=%d LIMIT 1", $import_id, $good_id);
			if($id)
			{
				DB::query("UPDATE {shop_price} SET price=%f, currency_id=%d, count_goods=%d WHERE id=%d", $price, $currency_id, $count, $id);
				DB::query("DELETE FROM {shop_price_param} WHERE price_id=%d", $id);
				foreach($params as $param_id => $param_value)
				{
					DB::query("INSERT INTO {shop_price_param} (price_id, param_id, param_value) VALUES (%d, %d, %d)", $id, $param_id, $param_value);
				}
				return;
			}
		}
		DB::query("INSERT INTO {shop_price} (price, currency_id, count_goods, good_id, import_id) VALUES (%f, %d, %d, %d, '%h')", str_replace(',', '.', $price), $currency_id, $count, $good_id, $import_id);
		$price_id = DB::last_id('shop_price');
		DB::query("UPDATE {shop_price} SET price_id=id WHERE id=%d", $price_id);
		if($image_id)
		{
			DB::query("INSERT INTO {shop_price_image_rel} (price_id, image_id) VALUES (%d, %d)", $price_id, $image_id);
		}

		foreach ($params as $id => $value)
		{
			if($value)
			{
				if(! $count = DB::query_result("SELECT COUNT(*) FROM {shop_param_element} WHERE value".$this->diafan->language_base_site."=%d AND param_id=%d AND element_id=%d", $value, $id, $good_id))
				{
					DB::query("INSERT INTO {shop_param_element} (value".$this->diafan->language_base_site.", param_id, element_id) 
						VALUES ('%s', %d, %d)", $value, $id, $good_id);
				}
				elseif($count > 1)
				{
					DB::query("DELETE FROM {shop_param_element} WHERE value".$this->diafan->language_base_site."=%d AND param_id=%d AND element_id=%d LIMIT ".($count - 1), $value, $id, $good_id);
				}
			}

			DB::query("INSERT INTO {shop_price_param} (price_id, param_id, param_value)
				VALUES (%d, %d, %d)", $price_id, $id, $value);
		}
	}

	/**
	 * Устанавливает значения стоимости товаров в корзине
	 * @return integer
	 */
	public function get_cart_summ()
	{
		if(! isset($_SESSION["cart_summ"]))
		{
			$this->cart_summ = 0;
			$this->diafan->_cart->init();
		}
		$this->cart_summ = ! empty($_SESSION["cart_summ"]) ? $_SESSION["cart_summ"] : 0;
		return $this->cart_summ ? $this->cart_summ : 0;
	}

	/**
	 * Устанавливает значения суммы всех покупок пользователя
	 * 
	 * @param integer $user_id номер пользователя
	 * @return integer
	 */
	public function get_order_summ($user_id)
	{
		if($this->order_summ === false)
		{
			$this->order_summ = DB::query_result("SELECT SUM(summ) FROM {shop_order} WHERE user_id=%d AND (status='1' OR status='3')", $user_id);
		}
		return $this->order_summ ? $this->order_summ : 0;
	}

	/**
	 * Форматирует цену согласно настройкам модуля
	 * 
	 * @param float $price цена
	 * @return string
	 */
	public function format($price)
	{
		return number_format(
			$price,
			($this->diafan->configmodules("format_price_1", "shop") ? $this->diafan->configmodules("format_price_1", "shop") : 0),
			$this->diafan->configmodules("format_price_2", "shop"),
			($this->diafan->configmodules("format_price_3", "shop") ? $this->diafan->configmodules("format_price_3", "shop") : "")
		);
	}
}