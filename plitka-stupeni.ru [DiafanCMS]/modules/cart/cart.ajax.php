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
include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Cart_ajax
 *
 * Обработка запросов
 */
class Cart_ajax extends Ajax 
{
/**
 * Обрабатывает полученные данные из формы
 * 
 * @return boolean
 */
public function ajax_request()
{
	if (! empty($_POST['module']) && $_POST['module'] == 'cart' && (! $this->diafan->configmodules('security_user', 'shop') || $this->diafan->_user->id) || empty($_POST["action"]))
	{
			switch($_POST["action"])
			{
				case 'recalc':
					return $this->recalc();
				case 'order':
					return $this->order();
				default :
					return false;
			}
		}
		return false;
	}

	/**
	 * Пересчет суммы заказа
	 * 
	 * @return boolean
	 */
	private function recalc()
	{
		$cart = $this->diafan->_cart->get();
		if ($cart)
		{
			foreach ($cart as $good_id => $array)
			{
				foreach ($array as $param => $c)
				{
					$index = $good_id.'_'.str_replace(array('{',':',';','}',' ','"',"'"), '', $param);
					if (! empty($_POST['del'.$index]))
					{
						$_POST['editshop'.$index] = 0;
					}
					if($err = $this->diafan->_cart->set($_POST['editshop'.$index], $good_id, $param, "count"))
					{
						$json["error"] = $err;
					}
				}
			}
		}

		if (empty($json["error"]))
		{
			$this->diafan->_cart->recalc();
			$this->diafan->_cart->write();

			$json["error"] = $this->diafan->_('Изменения сохранены!', false);
		}

		$_SESSION["cart_delivery"] = $this->diafan->get_param($_POST, 'delivery_id', 0, 2);

		$_SESSION["cart_additional_cost"] = array();
		if(! empty($_POST["additional_cost_ids"]))
		{
			foreach ($_POST["additional_cost_ids"] as $additional_cost_id)
			{
				$_SESSION["cart_additional_cost"][] = intval($additional_cost_id);
			}
		}

		if (!empty($_POST['ajax']))
		{
			Customization::inc('modules/cart/cart.model.php');
			$model  = new Cart_model($this->diafan);
			$result = $model->form_table();

			$json["table"] = $this->diafan->_tpl->get('table', 'cart', $result);
			if (! $this->diafan->_cart->get())
			{
				$json["empty"] = 1;
			}
			$json["target"]           = "#show_cart";
			$cart_tpl = $model->show_block();
			$json["data"]             = $this->diafan->_tpl->get('info', 'cart', $cart_tpl);

			include_once ABSOLUTE_PATH.'plugins/json.php';
			echo to_json($json);
		}
		else
		{
			$this->diafan->redirect($this->diafan->_route->current_link() . '?error=cart&mess-table=' . $json["error"]);
		}
		return true;
	}

	/**
	 * Оформление заказа
	 * 
	 * @return boolean
	 */
	private function order()
	{
		$this->module = 'shop';
		$this->tag = 'cart';
		$params = $this->get_params(array("module" => "shop", "table" => "shop_order"));

		$this->empty_required_field(array("params" => $params));

		if ($this->send_errors())
			return true;

		$summ = 0;
		$status_id = DB::query_result("SELECT id FROM {shop_order_status} WHERE status='0' LIMIT 1");

		DB::query("INSERT INTO {shop_order} (user_id, created, status, status_id, lang_id) VALUES (%d, %d, '0', %d, %d)",
			  $this->diafan->_user->id,
			  time(),
				  $status_id,
			  _LANG
			 );
		$order_id = DB::last_id("shop_order");

		$this->insert_values(array("id" => $order_id, "table" => "shop_order", "params" => $params));

		if ($this->send_errors())
			return true;

		// товары
		$goods_summ = 0;
		$cart = $this->diafan->_cart->get();
		foreach ($cart as $good_id => $array)
		{
			foreach ($array as $param => $c)
			{
				$price = 0;
				$select_depend = 0;
				$sparams = unserialize($param);

				DB::query("INSERT INTO {shop_order_goods} (order_id, good_id, count_goods) VALUES ('%d', '%d', '%f')", $order_id, $good_id, $c["count"]);
				$shop_good_id = DB::last_id("shop_order_goods");

				foreach ($sparams as $id => $value)
				{
					DB::query("INSERT INTO {shop_order_goods_param} (order_good_id, value, param_id) VALUES ('%d', '%d', '%d')", $shop_good_id, $value, $id);
				}	 
				$row = $this->diafan->_shop->price_get($good_id, $sparams, $this->diafan->_user->id);

				DB::query("UPDATE {shop_order_goods} SET price=%f, discount_id=%d WHERE id=%d", $row["price"], $row["discount_id"], $shop_good_id);
				$goods_summ += $row["price"] * $c["count"];
			}
		}
		$summ += $goods_summ;

		// дополнительная стоимость
		$cart_additional_cost = ! empty($_SESSION["cart_additional_cost"]) ? $_SESSION["cart_additional_cost"] : array();
		$result = DB::query("SELECT id, price, percent, amount, required FROM {shop_additional_cost} WHERE [act]='1' AND trash='0'");
		while ($row = DB::fetch_array($result))
		{
			if (in_array($row["id"], $cart_additional_cost) || $row["required"])
			{
				$row["summ"] = $row['price'];
				if($row['percent'])
				{
					$row["summ"] = $goods_summ * $row['percent'] / 100;
				}
				if (! empty($row['amount']))
				{
					if ($row['amount'] < $goods_summ)
					{
						$row["summ"] = 0;
					}
				}
				DB::query("INSERT INTO {shop_order_additional_cost} (order_id, additional_cost_id, summ) VALUES (%d, %d, %f)", 
						$order_id, $row["id"], $row["summ"]);
				$summ += $row['summ'];
			}
		}

		// доставка
		$delivery_summ = 0;
		$delivery_id = 0;
		if(! empty($_SESSION["cart_delivery"]))
		{
			$result = DB::query("SELECT id FROM {shop_delivery} WHERE [act]='1' AND trash='0'AND id=%d LIMIT 1", $_SESSION["cart_delivery"]);
			if ($row = DB::fetch_array($result))
			{
				$delivery_summ = DB::query_result("SELECT price FROM {shop_delivery_thresholds} WHERE delivery_id=%d AND amount<=%f ORDER BY price ASC LIMIT 1", $_SESSION["cart_delivery"], $summ);
				$delivery_id = $row["id"];
				$summ += $delivery_summ;
			}
			DB::query("UPDATE {shop_order} SET delivery_summ=%f, delivery_id=%d WHERE id=%d", $delivery_summ, $delivery_id, $order_id);
		}
		DB::query("UPDATE {shop_order} SET summ=%f WHERE id=%d", $summ, $order_id);
		
		$this->send_mails($order_id, $params);
		$this->send_sms();

		$_SESSION["order"][] = $order_id;

		$this->diafan->_cart->set();
		$this->diafan->_cart->recalc();
		$this->diafan->_cart->write();

		unset($_SESSION["cart_delivery"]);
		unset($_SESSION["cart_additional_cost"]);
		
		// если у пользователя купон на скидку с ограниченным действием, используем один раз купон
		$discount = DB::fetch_array(DB::query("SELECT id, count_use FROM {shop_discount} WHERE coupon<>'' AND user_id=%d AND trash='0' AND act='1' LIMIT 1", $this->diafan->_user->id));
		if($discount)
		{
			if($discount["count_use"] == 1)
			{
				DB::query("UPDATE {shop_discount} SET count_use=0, act='0' WHERE id=%d", $discount["id"]);
				$this->diafan->_shop->price_calc(0, $discount["id"]);
			}
			elseif($discount["count_use"])
			{
				DB::query("UPDATE {shop_discount} SET count_use=count_use-1 WHERE id=%d", $discount["id"]);
			}
		}
		if(empty($_POST["payment_id"]))
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
			else
			{
				$this->result["form_hide"] = true;
				$this->result["target_hide"] = '.cart_table_form';
				$this->result["form"] = $this->diafan->configmodules('mes', 'shop');
			}
		}
		else
		{
			DB::query("UPDATE {shop_order} SET payment_id=%d WHERE id=%d", $_POST["payment_id"], $order_id);
			$payment = DB::fetch_array(DB::query("SELECT payment, [text] FROM {shop_payment} WHERE id=%d LIMIT 1", $_POST["payment_id"]));
			
			if($payment["payment"])
			{
				$this->result["redirect"] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->cid, "cart").'step2/show'.$order_id.'/';
			}
			elseif($this->diafan->configmodules('order_redirect', 'shop'))
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
			else
			{
				Customization::inc('modules/cart/cart.model.php');
				$model  = new Cart_model($this->diafan);
				$cart_tpl = $model->show_block();
				$this->result["target"] = "#show_cart";
				$this->result["data"]   = $this->diafan->_tpl->get('info', 'cart', $cart_tpl);

				$this->result["target2"] = '.cart_order';
				$this->result["data2"] = $this->diafan->configmodules('mes', 'shop').$this->diafan->_tpl->get('result', 'cart', $payment);

				$this->result["redirect"] = BASE_PATH_HREF.$this->diafan->_route->link($this->diafan->cid, "cart").'#top';
			}
		}

		return $this->send_errors();
	}

	/**
	 * Отправляет письма администратору сайта и пользователю, сделавшему заказ
	 *
	 * @param integer $order_id номер заказа
	 * @param array $params поля формы, заполняемой пользователем
	 * @return boolean
	 */
	public function send_mails($order_id, $params)
	{
		require_once (ABSOLUTE_PATH.'includes/mail.php');

		Customization::inc('modules/cart/cart.model.php');

		$model = new Cart_model($this->diafan);
		$result_cart = $model->form();
		$result_cart["hide_form"] = true;
		$cart = $this->diafan->_tpl->get('table', 'cart', $result_cart);
		$payment_name = '';
		if(! empty($_POST["payment_id"]))
		{
			$payment = DB::fetch_array(DB::query("SELECT [name], payment FROM {shop_payment} WHERE id=%d LIMIT 1", $_POST["payment_id"]));
			$payment_name = $payment["name"];
			if($payment["payment"] == 'non_cash')
			{
				$payment_name .= ', <a href="'.BASE_PATH.'cart/payment/non_cash/ul/'.$order_id.'/'.$code.'/">'.$this->diafan->_('Счет для юридических лиц', false).'</a>,
				<a href="'.BASE_PATH.'cart/payment/non_cash/fl/'.$order_id.'/'.$code.'/">'.$this->diafan->_('Квитанция для физических лиц', false).'</a>';
			}
		}
		$code = md5(mt_rand(0, 999999999));
		DB::query("UPDATE {shop_order} SET `code`='%s' WHERE id=%d", $code, $order_id);

		//send mail admin
		$subject = str_replace(array('%title', '%url', '%id', '%message'),
				   array(TITLE, BASE_URL, $order_id, strip_tags($this->message_admin_param)),
				   $this->diafan->configmodules('subject_admin', 'shop')
				  );

		$message = str_replace(
			array('%title',
				'%url',
				'%id',
				'%message',
				'%order',
				'%payment'
			),
			array(
				TITLE,
				BASE_URL,
				$order_id,
				$this->message_admin_param,
				$cart,
				$payment_name
			),
			$this->diafan->configmodules('message_admin', 'shop'));

		send_mail(
				$this->diafan->configmodules("emailconfadmin", 'shop') ? $this->diafan->configmodules("email_admin", 'shop') : EMAIL_CONFIG,
				$subject,
				$message,
				$this->diafan->configmodules("emailconf", 'shop') ? $this->diafan->configmodules("email", 'shop') : ''
			);

		$user_email = $this->diafan->_user->mail;
		foreach($params as $param)
		{
			if ($param["type"] == "email")
			{
				$user_email = $_POST["p".$param["id"]];
			}
		}		

		//send mail user
		if (empty($user_email))
		{
			return false;
		}
		
		if(! empty($_POST['subscribe_in_order']))
		{
			$row_subscribtion = DB::fetch_array(DB::query("SELECT * FROM {subscribtion_emails} WHERE mail='%s' AND trash='0' LIMIT 1", $user_email));
			
			if(! empty($row_subscribtion))
			{
				DB::query("UPDATE {subscribtion_emails} SET act='1' WHERE id=%d", $row_subscribtion['id']);
			}
			else
			{
				$code = md5(rand(111, 99999));
				DB::query("INSERT INTO {subscribtion_emails} (created, mail, code, act) VALUES (%d, '%s', '%s', '1')", time(), $user_email, $code);
			}
		}
		
		$subject = str_replace(
				array('%title', '%url', '%id'),
				array(TITLE, BASE_URL, $order_id),
				$this->diafan->configmodules('subject', 'shop')
			);

		$message = str_replace(
				array('%title', '%url', '%id', '%message', '%order', '%payment'),
				array(
					TITLE,
					BASE_URL,
					$order_id,
					$this->message_param,
					$cart,
					$payment_name
				),
				$this->diafan->configmodules('message', 'shop')
			);

		send_mail(
				$user_email,
				$subject,
				$message,
				$this->diafan->configmodules("emailconf", 'shop') ? $this->diafan->configmodules("email", 'shop') : ''
			);
		return true;
	}

	/**
	 * Уведомляет администратора по SMS
	 * 
	 * @return void
	 */
	private function send_sms()
	{
		if (! $this->diafan->configmodules("sendsmsadmin", 'shop'))
			return false;
			
		$message = $this->diafan->configmodules("sms_message_admin", 'shop');

		$to   = $this->diafan->configmodules("sms_admin", 'shop');

		include_once ABSOLUTE_PATH.'includes/sms.php';
		Sms::send($message, $to);
	}
}