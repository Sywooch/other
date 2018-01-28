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
 * Подключение модуля "Магазин" для работы с заказами
 */
class Shop_inc_order extends Diafan
{
	/**
	 * Оплата заказ (смена статуса на "В обработке")
	 * 
	 * @param integer $order_id номер заказа
	 * @return void
	 */
	public function pay($order_id)
	{
		if ($this->diafan->configmodules("use_non_material_goods", "shop"))
		{
			//отправить ссылки на купленные файлы, если они есть 
			$this->buy_file($order_id);
		}

		// меняем статус заказа на "В обработке"
		DB::query("UPDATE {shop_pay_history} SET status='pay', created=%d WHERE order_id='%d'", time(), $order_id);

		$status_id = DB::query_result("SELECT id FROM {shop_order_status} WHERE status='1' LIMIT 1");

		DB::query("UPDATE {shop_order} SET status='1', status_id=%d WHERE id=%d", $status_id, $order_id);

		$this->send_mail_change_status($order_id, $status_id);

		if ($this->diafan->configmodules("use_count_goods", "shop"))
		{
			$result = DB::query("SELECT * FROM {shop_order_goods} WHERE order_id=%d", $order_id); 
			while ($row = DB::fetch_array($result))
			{
				if ($row["count_goods"])
				{
					$params = array();
					$result_param = DB::query("SELECT * FROM {shop_order_goods_param} WHERE order_good_id=%d", $row["id"]); 
					while ($row_param = DB::fetch_array($result_param))
					{
						$params[$row_param["param_id"]] = $row_param["value"];
					}
					$row_price = $this->diafan->_shop->price_get($row["good_id"], $params, 0);
					$count = $row_price['count_goods'] > $row["count_goods"] ? $row_price['count_goods'] - $row["count_goods"] : 0;
					// уменьшаем количество товаров на складе
					DB::query("UPDATE {shop_price} SET count_goods=%d WHERE price_id=%d", $count, $row_price["price_id"]);
				}
			}
		}
	}

	/**
	 * Отправляет уведомления об изменении статуса заказа
	 * @return void
	 */
	public function send_mail_change_status($order_id, $status)
	{
		include_once ABSOLUTE_PATH.'includes/mail.php';
		$email = ($this->diafan->configmodules("emailconf", 'shop')
				   && $this->diafan->configmodules("email", 'shop')
				   ? $this->diafan->configmodules("email", 'shop') : '' );

		$result = DB::query("SELECT * FROM {shop_order} WHERE id=%d AND trash='0'", $order_id);
		if($row = DB::fetch_array($result))
		{
			$user_mail = DB::query_result(
					"SELECT value FROM {shop_order_param_element} AS e"
					." INNER JOIN {shop_order_param} AS p ON p.id=e.param_id AND p.type='email'"
					." WHERE e.element_id=%d", $order_id
				);

			$status = DB::query_result("SELECT name".$row["lang_id"]." FROM {shop_order_status} WHERE id=%d LIMIT 1", $status);

			$subject = str_replace(array ( '%title', '%url' ), array ( TITLE, BASE_URL ), $this->diafan->configmodules('subject_change_status', 'shop', 0, $row["lang_id"]));

			$message = str_replace(array ( '%title', '%url', '%order', '%status' ), array ( TITLE, BASE_URL, $order_id, $status), $this->diafan->configmodules('message_change_status', 'shop', 0, $row["lang_id"]));
			
			send_mail($user_mail, $subject, $message,  $email);
		}
	}

	/**
	 * Отправляет ссылки на купленные файлы
	 * 
	 * @param integer $order_id номер заказа
	 * @return boolean
	 */
	private function buy_file($order_id)
	{
		if (empty($order_id))
		{
			return false;
		}

		$shop_ids = array(); //id товаров из данного заказа

		$result = DB::query("SELECT * FROM {shop_order_goods} WHERE order_id=%d", $order_id);
		while ($row = DB::fetch_array($result))
		{
			$shop_ids[] = $row["good_id"];
		}

		if ( ! empty($shop_ids) && ! $this->shop_file_already_sold($order_id))
		{
			//выполнить необходимые операции, с нематериальными товарами
			$this->shop_file_sale($this->diafan->save, $shop_ids);
		}

		return true;
	}

	/**
	 * Проверяет отправлено ли письмо со ссылками на купленные товары
	 * 
	 * @param integer $order_id номер заказа
	 * @return boolean
	 */
	private function shop_file_already_sold($order_id)
	{
		if (empty($order_id))
		{
			return false;
		}

		$id = DB::query_result("SELECT id FROM  {shop_order_count_goods} WHERE order_id=%d LIMIT 1", $order_id);

		if (empty($id))
		{

			return false;
		}

		return true;
	}

	/**
	 * Выполнение необходимых операций с нематериальными товарами
	 * 
	 * @param integer $order_id номер заказа
	 * @param array $shop_ids массив всех товаров в заказе (не обязательно нематериальные)
	 * 
	 * @return boolean true
	 */
	private function shop_file_sale($order_id, $shop_ids = array())
	{
		$new_shop_ids = array(); //id нематериальных товаров
		$codes = array(); //коды для подтверждения покупки товара
		//время действие ссылки на  купленные  нематериальные товары - текущее время +1 день
		$timestamp_finish = mktime(date('H'), date('i'), 0, date('m'), date('d') + 1, date('Y'));
		$date_finish = date('Y-m-d H:i', $timestamp_finish);

		$result = DB::query("SELECT id FROM {shop} WHERE id IN (%s) AND is_file='1' AND trash='0'", implode(',', $shop_ids));
		while ($row = DB::fetch_array($result))
		{
			$new_shop_ids[] = $row['id'];
		}

		if (empty($new_shop_ids))//если нет нематериальных товаров
		{
			return false;
		}

		foreach ($new_shop_ids as $shop_id)
		{
			$code = md5($date_finish . $shop_id . 'file_sale');

			DB::query("INSERT INTO {shop_files_codes} (shop_id, code, date_finish) VALUES(%d, '%s', '%s')", $shop_id, $code, $date_finish);

			$codes[$shop_id] = $code;
		}

		$files_list = $this->get_files_list($new_shop_ids, $codes); //список файлов  со ссылками
		$this->send_mail($order_id, $files_list);

		return true;
	}

	/**
	 * Формирование таблицы со ссылками на куленные товары
	 * 
	 * @param array $shop_ids массив всех товаров в заказе (не обязательно нематериальные)
	 * @param array $codes массив кодов для скачивания
	 * @return string
	 */
	private function get_files_list($shop_ids, $codes)
	{
		$text = '<table>
			<tr>
				<th>' . $this->diafan->_('Наименование товара', false) . '</th>
				<th>' . $this->diafan->_('Ссылка на товар', false) . '</th>
			</tr>';


		$result = DB::query("SELECT id, [name], cat_id, site_id FROM {shop} WHERE id IN (%s)", implode(',', $shop_ids));

		while ($row = DB::fetch_array($result))
		{
			$good_rewrite = $this->diafan->_route->link($row["site_id"], "shop", $row["cat_id"], $row["id"]);
			$shop_rewrite = $this->diafan->_route->link($row["site_id"], "shop") . '?action=file&code=';

			$text .= '
				<tr>
					<td> <a href="' . BASE_PATH . $good_rewrite . '">' . $row["name"] . '</a></td>
					<td>' . BASE_PATH . $shop_rewrite . $codes[$row["id"]] . '</td>
				</tr>';
		}

		$text .= '</table>';

		return $text;
	}

	/**
	 * Отправляет письмо пользователю, купившему нематериальные товары
	 * 
	 * @param integer $order_id номер заказа
	 * @param string $files_list таблицы со ссылками на куленные товары
	 * @return boolean
	 */
	private function send_mail($order_id, $files_list)
	{
		if (! $order_id || ! $files_list)
		{
			return false;
		}

		if (! $mail = $this->get_email($order_id))
		{
			return false;
		}

		require_once (ABSOLUTE_PATH . 'includes/mail.php');

		$subject = str_replace(
				array('%title', '%url'), array(TITLE, BASE_URL), $this->diafan->configmodules('subject', 'shop')
		);

		$message = str_replace(
			array('%title', '%url', '%id', '%files'), array(
				TITLE,
				BASE_URL,
				$order_id,
				$files_list
			), $this->diafan->configmodules('file_sale_message', 'shop')
		);

		send_mail(
				$mail, $subject, $message, $this->diafan->configmodules("emailconf", 'shop') ?
						$this->diafan->configmodules("email", 'shop') : ''
		);
		return true;
	}

	/**
	 * Получает e-mail пользователя, оформившего заказ
	 * 
	 * @param  integer $order_id
	 * @return string
	 */
	private function get_email($order_id)
	{
		$mail = DB::query_result("SELECT e.value FROM {shop_order_param_element} AS e INNER JOIN 
			{shop_order_param} AS p ON e.param_id=p.id AND p.trash='0' AND e.trash='0' 
			WHERE p.type='email' AND e.element_id=%d", $order_id);

		if (! $mail && $user_id = DB::query_result("SELECT user_id FROM {shop_order} WHERE id=%d AND trash='0' LIMIT 1", $order_id))
		{
			$mail = DB::query_result("SELECT mail FROM {users} WHERE id=%d  AND trash='0' LIMIT 1", $user_id);
		}

		return $mail;
	}
}