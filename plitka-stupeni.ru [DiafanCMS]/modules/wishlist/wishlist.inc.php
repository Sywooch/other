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
 * Подключение модуля "Список желаний"
 */
class Wishlist_inc extends Diafan
{
	/*
	 * @var array информация, записанная в список желаний
	 */
	private $wishlist = 'no_check';

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
	 * Возвращает информацию из списка желаний
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
			return $this->wishlist;
		}
		if(empty($this->wishlist[$id]))
		{
			return false;
		}
		if($param === false)
		{
			if($name_info == "count")
			{
				$count = 0;
				foreach ($this->wishlist[$id] as $row)
				{
					$count += $row["count"];
				}
				return $count;
			}
			return $this->wishlist[$id];
		}

		if(is_array($param))
		{
			asort($param);
			$param = serialize($param);
		}

		if(empty($this->wishlist[$id][$param]))
		{
			return false;
		}
		if(! $name_info)
		{
			return $this->wishlist[$id][$param];
		}
		if(empty($this->wishlist[$id][$param][$name_info]))
		{
			return false;
		}
		return $this->wishlist[$id][$param][$name_info];
	}

	/**
	 * Записывает данные в список желаний
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
			$this->wishlist = $value;
			return;
		}

		if($param === false)
		{
			if($value)
			{
				$this->wishlist[$id] = $value;
			}
			else
			{
				unset($this->wishlist[$id]);
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
				unset($this->wishlist[$id][$param]);
				if(! $this->wishlist[$id])
				{
					unset($this->wishlist[$id]);
				}
				return;
			}
			else
			{
				$this->wishlist[$id][$param]["is_file"] = $value["is_file"] ? true : false;
				$name_info = "count";
				$value = $value["count"];
			}
		}
		if($name_info == "count")
		{
			$value = intval($value);
			if($value <= 0)
			{
				unset($this->wishlist[$id][$param]);
				if(! $this->wishlist[$id])
				{
					unset($this->wishlist[$id]);
				}
				return;
			}
			//товар-файл => можно купить только 1 товар
			if($this->wishlist[$id][$param]["is_file"] && $value > 1)
			{
				$value = 1;
			}
		}
		$this->wishlist[$id][$param][$name_info] = $value;
	}

	/**
	 * Записывает информацию о корзине в хранилище
	 * 
	 * @return void
	 */
	public function write()
	{
		$old_wishlist = array();
		$result = DB::query("SELECT * FROM {shop_wishlist} WHERE ".($this->diafan->_user->id ? "user_id=".$this->diafan->_user->id : "session_id='".session_id()."'")." AND trash='0'");
		while($row = DB::fetch_array($result))
		{
			$old_wishlist[$row["good_id"]][$row["param"]] = $row;
		}
		foreach($this->wishlist as $id => $rows)
		{
			foreach($rows as $param => $row)
			{
				if(! empty($old_wishlist[$id][$param]))
				{
					if($row["count"] != $old_wishlist[$id][$param]["count"])
					{
						DB::query("UPDATE {shop_wishlist} SET created=%d, count=%d WHERE id=%d", time(), $row["count"], $old_wishlist[$id][$param]["id"]);
					}
					unset($old_wishlist[$id][$param]);
				}
				else
				{
					DB::query("INSERT INTO {shop_wishlist} (good_id, created, count, param, is_file, ".($this->diafan->_user->id ? "user_id" : "session_id").") VALUES (%d, %d, %d, '%s', '%d', ".($this->diafan->_user->id ? $this->diafan->_user->id : "'".session_id()."'").")", $id, time(), $row["count"], $param, $row["is_file"]);
				}
			}
		}
		foreach($old_wishlist as $id => $rows)
		{
			foreach($rows as $row)
			{
				DB::query("DELETE FROM {shop_wishlist} WHERE id=%d", $row["id"]);
			}
		}
	}

	/**
	 * Инициализация корзины
	 * 
	 * @return void
	 */
	private function init()
	{
		if($this->wishlist === 'no_check')
		{
			$wishlist = array();
			$result = DB::query("SELECT * FROM {shop_wishlist} WHERE session_id='%h' AND trash='0'", session_id());
			while($row = DB::fetch_array($result))
			{
				$wishlist[$row["good_id"]][$row["param"]]["count"] = $row["count"];
				$wishlist[$row["good_id"]][$row["param"]]["is_file"] = $row["is_file"];
			}
			$this->wishlist = array();
			if($this->diafan->_user->id)
			{
				$result = DB::query("SELECT * FROM {shop_wishlist} WHERE user_id=%d AND trash='0'", $this->diafan->_user->id);
				while($row = DB::fetch_array($result))
				{
					$this->wishlist[$row["good_id"]][$row["param"]]["count"] = $row["count"];
					$this->wishlist[$row["good_id"]][$row["param"]]["is_file"] = $row["is_file"];
				}
				if($wishlist)
				{
					foreach($wishlist as $id => $rows)
					{
						foreach($rows as $param => $row)
						{
							$this->set($row, $id, $param);
						}
					}
					$this->write();
					DB::query("DELETE FROM {shop_wishlist} WHERE session_id='%h' AND trash='0'");
				}
			}
			else
			{
				$this->wishlist = $wishlist;
			}
		}
	}
}