<?php
/**
 * Подключение модуля «Корзина товаров, оформление заказа»
 * 
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    5.4
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2015 OOO «Диафан» (http://www.diafan.ru/)
 */
if ( ! defined('DIAFAN'))
{
    $path = __FILE__; $i = 0;
	while(! file_exists($path.'/includes/404.php'))
	{
		if($i == 10) exit; $i++;
		$path = dirname($path);
	}
	include $path.'/includes/404.php';
}

/**
 * Cart_inc
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
	 * @var integer общее количество товаров, находящихся в корзине
	 */
	private $count;

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
				return $count;
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
			foreach ($this->cart[$id] as $p => $row)
			{
				if($param == $row["price_id"] || $param == $p)
				{
					$count += $row["count"];
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

		$price = $this->diafan->_shop->price_get($id, $params);
		if (! $price && ! $this->diafan->configmodules('buy_empty_price', "shop"))
		{
			unset($this->cart[$id][$param]);
			if(! $this->cart[$id])
			{
				unset($this->cart[$id]);
			}
			return $this->diafan->_('Товара с заданными параметрами не существует.');
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
			$value = preg_replace('/[^0-9\.]+/', '', $value);
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
				return $this->diafan->_('Файл уже добавлен в корзину.');
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
	private function recalc()
	{
		$summ = 0;
		$summ_discount = 0;
		$count = 0;
		foreach ($this->cart as $good_id => $array)
		{
			foreach ($array as $param => $c)
			{
				$params = unserialize($param);
				$price = $this->diafan->_shop->price_get($good_id, $params);
				if(! $price && ! $this->diafan->configmodules('buy_empty_price', "shop"))
				{
					unset($this->cart[$good_id][$param]);
					if(! $this->cart[$good_id])
					{
						unset($this->cart[$good_id]);
					}
					continue;
				}
				$summ += $price["price"] * $c["count"];
				$this->cart[$good_id][$param]["price_id"] = $price["price_id"];
				$count += $c["count"];
			}
		}
		$this->count = $count;
		$this->summ = $summ;
		$_SESSION["cart_summ"] = $this->summ;
		$_SESSION["cart_count"] = $this->count;
	}

	/**
	 * Записывает информацию о корзине в хранилище
	 * 
	 * @return void
	 */
	public function write()
	{
		$this->recalc();
		if($this->diafan->_users->id)
		{
			$old_cart = array();
			$rows = DB::query_fetch_all("SELECT * FROM {shop_cart} WHERE user_id=%d AND trash='0'", $this->diafan->_users->id);
			foreach ($rows as $row)
			{
				$old_cart[$row["good_id"]][$row["param"]] = $row;
			}
			foreach ($this->cart as $id => $rows)
			{
				foreach ($rows as $param => $row)
				{
					if(! empty($old_cart[$id][$param]))
					{
						if($row["count"] != $old_cart[$id][$param]["count"])
						{
							DB::query("UPDATE {shop_cart} SET created=%d, `count`=%f WHERE id=%d", time(), $row["count"], $old_cart[$id][$param]["id"]);
						}
						unset($old_cart[$id][$param]);
					}
					else
					{
						DB::query("INSERT INTO {shop_cart} (good_id, created, count, param, is_file, user_id, price_id) VALUES (%d, %d, %f, '%s', '%d', %d, %d)", $id, time(), $row["count"], $param, $row["is_file"], $this->diafan->_users->id, $row["price_id"]);
					}
				}
			}
			foreach ($old_cart as $id => $rows)
			{
				foreach ($rows as $row)
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
	private function init()
	{
		$captcha_cart = $this->diafan->_captcha->get("cart", '');
		if($this->cart === 'no_check')
		{
			$this->cart = array();
			if($this->diafan->_users->id)
			{
				$rows = DB::query_fetch_all("SELECT * FROM {shop_cart} WHERE user_id=%d AND trash='0'", $this->diafan->_users->id);
				foreach ($rows as $row)
				{
					$this->cart[$row["good_id"]][$row["param"]]["price_id"] = $row["price_id"];
					$this->cart[$row["good_id"]][$row["param"]]["count"] = $row["count"];
					$this->cart[$row["good_id"]][$row["param"]]["is_file"] = $row["is_file"];
				}
				if(! isset($_SESSION["cart_summ"]) && ! isset($_SESSION["cart_count"]))
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
						foreach ($_SESSION["cart"] as $id => $rows)
						{
							foreach ($rows as $param => $row)
							{
								$this->set($row, $id, $param);
							}
						}
						$this->write();
						unset($_SESSION["cart"]);
					}
					else
					{
						$this->summ = $_SESSION["cart_summ"];
						$this->count = $_SESSION["cart_count"];
					}
				}
			}
			else
			{
				$this->cart = ! empty($_SESSION["cart"]) ? $_SESSION["cart"] : array();
				$this->summ = ! empty($_SESSION["cart_summ"]) ? $_SESSION["cart_summ"] : 0;
				$this->count = ! empty($_SESSION["cart_count"]) ? $_SESSION["cart_count"] : 0;
			}
		}
	}
}