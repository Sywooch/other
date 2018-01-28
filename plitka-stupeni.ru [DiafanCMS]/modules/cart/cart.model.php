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
 * Cart_model
 *
 * Модель модуля "Корзина товаров, офрмление заказа"
 */
class Cart_model extends Model
{
	/**
	 * Генерирует данные для формы редактирования товаров
	 * 
	 * @return array
	 */
	public function form()
	{
		$this->result["error"] = $this->get_error("cart");
		$this->result["error_table"] = $this->get_error("cart", "table");

		$this->form_table();
		$this->form_registration();
		$this->form_param();
		$this->form_payments();

		return $this->result;
	}

	/**
	 * Генерирует таблицу купленных товаров
	 * 
	 * @return boolean true
	 */
	public function form_table()
	{
		// корзина
		$this->result["currency"] = $this->diafan->configmodules("currency", "shop");
		$this->result["summ"] = 0;
		$this->result["count"] = 0;
		$this->result["discount"] = false;
		$cart = $this->diafan->_cart->get();
		if ($cart)
		{
			$k = 0;
			foreach ($cart as $good_id => $array)
			{
				$units = $this->get_good_units($good_id);
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
					if($row["cat_id"])
					{
						if (empty($select_cats[$row["cat_id"]]))
						{
							$select_cats[$row["cat_id"]] = array(
									"name" => DB::query_result("SELECT [name] FROM {shop_category} WHERE id=%d LIMIT 1", $row["cat_id"]),
									"link" => $this->diafan->_route->link($row["site_id"], "shop", $row["cat_id"])
								);
						}
						$this->result["rows"][$k]["cat"]["name"] = $select_cats[$row["cat_id"]]["name"];
						$this->result["rows"][$k]["cat"]["link"] = $select_cats[$row["cat_id"]]["link"];
					}
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
					$row_price = $this->diafan->_shop->price_get($good_id, $params, $this->diafan->_user->id, true);
					$price =  round($row_price["price"]);

					$this->result["rows"][$k]["link"] .= !empty($query) ? '?'.implode('&', $query) : '';
					if($units!="м2")
					{
						$this->result["rows"][$k]["count"] = round($c["count"],3);
					}
					else
					{
						$this->result["rows"][$k]["count"] = $c["count"];
					}
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
					else
					{
						$this->result["rows"][$k]["img"]["src"]  = 'http://plitka-stupeni.ru/userfiles/shop/collection_element/'.(DB::query_result("SELECT i.name FROM {images} AS i
																LEFT JOIN {shop_price_image_rel} AS r ON r.image_id=i.id AND r.price_id=%d
																WHERE i.element_id=%d AND i.module_name='shop' AND i.trash='0'
																ORDER BY r.image_id DESC LIMIT 1",
																$row_price["price_id"], $good_id));
					}
					$this->result["rows"][$k]["id"] = $row["id"].'_'.str_replace(array('{',':',';','}',' ','"',"'"), '', $param);
					$this->result["rows"][$k]["price"] = $this->diafan->_shop->price_format($price);
					$this->result["rows"][$k]["old_price"] = $this->diafan->_shop->price_format($row_price["old_price"]);
					if($units!="м2")
					{
						$this->result["rows"][$k]["summ"] = $this->diafan->_shop->price_format($price * round($c["count"],3));
					}
					else
					{
						$this->result["rows"][$k]["summ"] = $this->diafan->_shop->price_format($price * $c["count"]);
					}
					$this->result["rows"][$k]["discount"] = 0;
					if($row_price["discount_id"])
					{
						if(! isset($cache["discount"][$row_price["discount_id"]]))
						{
							$cache["discount"][$row_price["discount_id"]] = DB::query_result("SELECT discount FROM {shop_discount} WHERE id=%d LIMIT 1", $row_price["discount_id"]);
						}
						$this->result["discount"] = true;
						$this->result["rows"][$k]["discount"] = $cache["discount"][$row_price["discount_id"]];
						$this->result["rows"][$k]["discount_summ"] = $this->diafan->_shop->price_format($row_price["price"] / (100 - $this->result["rows"][$k]["discount"])*$this->result["rows"][$k]["discount"]);
					}
					if($units!="м2")
					{
						$this->result["summ"] += $price * round($c["count"],3);
					}
					else
					{
						$this->result["summ"] += $price * $c["count"];
					}
					$this->result["rows"][$k]["units"] = $units;
					$this->result["count"] += $c["count"];
					$k++;
				}
			}
			if(! $this->result["count"])
			{
				return $this->result;
			}
			$this->result["summ_goods"] = $this->result["summ"];

			// дополнительно
			$this->result["additional_cost"] = array();
			$this->result["cart_additional_cost"] = ! empty($_SESSION["cart_additional_cost"]) ? $_SESSION["cart_additional_cost"] : array();
			$result = DB::query("SELECT id, [name], price, percent, [text], amount, required FROM {shop_additional_cost} WHERE [act]='1' AND trash='0' ORDER by sort ASC");
			while ($row = DB::fetch_array($result))
			{
				$row["summ"] = $row['price'];
				if($row['percent'])
				{
					$row["summ"] = $this->result["summ_goods"] * $row['percent'] / 100;
				}
				if (! empty($row['amount']))
				{
					if ($row['amount'] < $this->result["summ_goods"])
					{
						$row["summ"] = 0;
					}
				}
				if (in_array($row["id"], $this->result["cart_additional_cost"]) || $row["required"])
				{
					$this->result["summ"] += $row['summ'];
				}
				$this->result["additional_cost"][] = $row;
			}
		}

		// способы доставки
		$this->result["delivery"] = array();
		$result = DB::query("SELECT id, [name], [text] FROM {shop_delivery} WHERE [act]='1' AND trash='0' ORDER by sort ASC");
		while ($row = DB::fetch_array($result))
		{
			$row['price'] = 0;
			$row["thresholds"] = array();
			$result2 = DB::query("SELECT price, amount FROM {shop_delivery_thresholds} WHERE delivery_id=%d ORDER BY price DESC", $row["id"]);
			while ($row2 = DB::fetch_array($result2))
			{
				if($row2['amount'] <= $this->result["summ"])
				{
					$row['price'] = $row2["price"];
				}
				$row["thresholds"][] = $row2;
			}

			if (empty($_SESSION["cart_delivery"]) && empty($this->result["delivery"]))
			{
				$_SESSION["cart_delivery"] = $row['id'];
			}
			if (! empty($_SESSION["cart_delivery"]) && $row['id'] == $_SESSION["cart_delivery"])
			{
				$this->result["summ"] += $row['price'];
			}
			$this->result["delivery"][] = $row;
		}
		$this->result["cart_delivery"] = ! empty($_SESSION["cart_delivery"]) ? $_SESSION["cart_delivery"] : 0;

		$this->result["summ"] = $this->diafan->_shop->price_format($this->result["summ"]);
		$this->result["summ_goods"] = ! empty($this->result["summ_goods"]) ? $this->diafan->_shop->price_format($this->result["summ_goods"]) : 0;

		return $this->result;
	}

	/**
	 * Генерирует форму регистрации и авторизации
	 * 
	 * @return boolean true
	 */
	private function form_registration()
	{
		$this->result["show_auth"] = true;
		if ($this->diafan->_user->id || ! DB::query_result("SELECT id FROM {site} WHERE module_name='registration' AND [act]='1' AND trash='0' AND block='0' LIMIT 1"))
		{
			$this->result["show_auth"] = false;
		}
		else
		{
			Customization::inc('modules/registration/registration.model.php');
			$reg = new Registration_model($this->diafan);
			$this->result["registration"] = $reg->form();
			$this->result["registration"]["action"] = BASE_PATH_HREF . $this->diafan->_route->module("registration", true);
			$show_login = array("error" => $this->diafan->_user->errauth ? $this->diafan->_('Неверный логин или пароль.', false) : '', "action" => '', "user" => '', 'hide' => true);

			$this->result["show_login"] = $show_login;
		}
		return true;
	}

	/**
	 * Генерирует поля формы, созданные в конструкторе
	 * 
	 * @return boolean true
	 */
	private function form_param()
	{
		$this->result["rows_param"] = $this->get_params(array("module" => "shop", "table" => "shop_order"));

		$multiple = array();
		foreach ($this->result["rows_param"] as $row)
		{
			$this->result['error_p'.$row["id"]] = $this->get_error("cart", 'p'.$row["id"]);
			if ($row["type"] == "multiple")
			{
				$multiple[] = $row["id"];
			}
		}

		// данные о пользователе
		if ($this->diafan->_user->id)
		{
			$result = DB::query("SELECT param_id, value FROM {shop_order_param_user} WHERE trash='0' AND user_id=%d", $this->diafan->_user->id);
			while($row = DB::fetch_array($result))
			{
				if (in_array($row["param_id"], $multiple))
				{
					$this->result["user"]['p'.$row["param_id"]][] = $row["value"];
				}
				else
				{
					$this->result["user"]['p'.$row["param_id"]] = $row["value"];
				}
			}
			$max_order_id = DB::query_result("SELECT MAX(id) FROM {shop_order} WHERE user_id=%d AND trash='0'", $this->diafan->_user->id);
			$result = DB::query("SELECT value, param_id FROM {shop_order_param_element} WHERE trash='0' AND element_id=%d", $max_order_id);
			while ($row = DB::fetch_array($result))
			{
				if(! empty($this->result["user"]['p'.$row["param_id"]]))
					continue;

				if (in_array($row["param_id"], $multiple))
				{
					$this->result["user"]['p'.$row["param_id"]][] = $row["value"];
				}
				else
				{
					$this->result["user"]['p'.$row["param_id"]] = $row["value"];
				}
			}
		}
		
		if($this->diafan->configmodules('subscribe_in_order', 'subscribtion') && empty($this->diafan->_user->id))
		{
			$this->result['subscribe_in_order'] = true;
		}
		return true;
	}

	/**
	 * Генерирует список методов оплаты
	 * 
	 * @return boolean true
	 */
	private function form_payments()
	{
		$result = DB::query("SELECT id, [name], [text] FROM {shop_payment} WHERE [act]='1' AND trash='0' ORDER BY sort ASC");
		while($row = DB::fetch_array($result))
		{
			$this->result["payments"][] = $row;
		}
		return true;
	}

	/**
	 * Генерирует данные для втого шага в оформлении заказа: оплата
	 * 
	 * @return array|boolean
	 */
	public function payment()
	{
		$row = DB::fetch_array(DB::query("SELECT payment_id, summ FROM {shop_order} WHERE id=%d LIMIT 1", $this->diafan->show));
		
		$method = DB::fetch_array(DB::query("SELECT payment, [text], params FROM {shop_payment} WHERE id=%d LIMIT 1",$row['payment_id']));
		if($method["payment"])
		{
			if(! DB::query_result("SELECT id FROM {shop_pay_history} WHERE order_id=%d LIMIT 1", $this->diafan->show))
			{
				DB::query("INSERT INTO {shop_pay_history} (created, status, order_id, payment, summ, user_id) VALUES (%d, 'request_pay', %d, '%s', %f, %d)", time(), $this->diafan->show, $method["payment"], $row["summ"], $this->diafan->_user->id);
			}
			$params = unserialize($method["params"]);
			$params["text"] = $this->diafan->configmodules('mes', 'shop').'<br><br>'.$method["text"];
			$params["summ"] = $row['summ'];
			$params["user_id"] = $this->diafan->_user->id;
			$params["order_id"] = $this->diafan->show;
			$params["desc_order"] = str_replace('%order', $params["order_id"], $this->diafan->configmodules("desc_order", "shop"));
			Customization::inc('modules/cart/payment/'.$method["payment"].'/cart.payment.'.$method["payment"].'.model.php');
			$class = 'Cart_payment_'.$method["payment"].'_model';
			$payment_class = new $class($this->diafan);
			$this->result = $payment_class->get($params);
			$this->result["method"] = $method["payment"];
		}
		else
		{
			return $this->diafan->configmodules('mes', 'shop').'<br><br>'.$method["text"];
		}

		return $this->result;
	}

	/**
	 * Генерирует данные для третьего шага в офрмлении заказа: результат оплаты
	 * 
	 * @return array
	 */
	public function result()
	{
		if ($this->diafan->step == 3)
		{
			if($this->diafan->configmodules('order_redirect', 'shop'))
			{
				if(preg_match("/^[0-9]+$/", $this->diafan->configmodules('order_redirect', 'shop')))
				{
				$this->result["redirect"] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->configmodules('order_redirect', 'shop'));
				}
				else
				{
				$this->result["redirect"] = BASE_PATH_HREF.$this->diafan->configmodules('order_redirect', 'shop');
				}
			}
			$this->result["text"] = $this->diafan->configmodules("payment_success_text", "shop");
		}
		else
		{
			$this->result["text"] = $this->diafan->configmodules("payment_fail_text", "shop");
		}
		return $this->result["text"];
	}

	/**
	 * Генерирует данные для шаблонной функции: выводит информацию о заказанных товарах
	 * 
	 * @return array
	 */
	public function show_block()
	{
		$this->diafan->_cart->recalc();

		$result["summ"] = $this->diafan->_cart->get_summ_discount();
		$result["count"] = $this->diafan->_cart->get_count();
		$result["count_goods_in_cart"] = $this->diafan->_cart->get_count_goods_in_cart();
		$result["link"] = BASE_PATH_HREF.$this->diafan->_route->module("cart", true);
		$result["summ"] = $this->diafan->_shop->price_format($result["summ"]);
		$result["currency"] = $this->diafan->configmodules("currency", "shop");

		$result["wishlist_link"] = BASE_PATH_HREF.$this->diafan->_route->module("wishlist", true);
		return $result;
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