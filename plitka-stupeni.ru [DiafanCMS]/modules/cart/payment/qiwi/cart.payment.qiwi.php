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
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/includes/404.php';
}

/**
 * Обработка данных, полученных от системы Qiwi
 */
if ($_GET["rewrite"] == "qiwi/success")
{
	$_POST["qiwi_id"] = 26;
	// запрос на подтверждение счета
	if (!empty($_POST["qiwi_id"]) OR (! empty($_GET["order"]) AND $_GET["order"] <> 1)) 
	{
		$cart_rew = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND site_id IN"
									." (SELECT id FROM {site} WHERE module_name='cart' AND [act]='1' AND trash='0' AND block='0')");
		$order_id = $_POST["qiwi_id"]; //номер счет, статус которого интересует

		if (! empty($_GET["order"]) AND $_GET["order"] <> 1)
		{
			//номер счета, который пришел с киви
			$order_id = $_GET["order"];
		}

		//запрашиваем сумму счета, который хочет подтвердить пользователь, заодно выясняем, есть ли вообще такой неоплаченный счет в системе
		$pay = DB::fetch_array(DB::query("SELECT o.id, o.summ FROM {shop_order} AS o"
				." INNER JOIN {shop_pay_history} AS p ON p.order_id=o.id"
				." WHERE o.id=%d AND p.payment='qiwi' AND p.status='request_pay' LIMIT 1",
				$order_id));

		// если неоплаченный счет есть, начинаем спрашивать на сайте киви его статус
		if ($pay["summ"] > 0)
		{
			$params = unserialize(DB::query_result("SELECT m.params FROM {shop_payment} AS m, {shop_order} AS p WHERE p.id='%d' AND m.id = p.payment_id", $order_id));
			//сформировали запрос XML
			$xml='<?xml version="1.0" encoding="utf-8"?>
<request>
<protocol-version>4.00</protocol-version>
<request-type>33</request-type>
<extra name="password">'.$params["qiwi_password"].'</extra>
<terminal-id>'.$params["qiwi_id"].'</terminal-id>
<bills-list>
<bill txn-id="'.$order_id.'"/>
</bills-list>
</request>';
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, "http://ishop.qiwi.ru/xml");
			curl_setopt($ch, CURLOPT_HEADER, 0); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
			curl_setopt($ch, CURLOPT_POST,1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); 
			//ответ от киви
			$answer = curl_exec($ch);
			//если есть строка со статусом 60 (т.е. счет оплачен), и сумма равна выставленной изначально, то зачисляем деньги пользователю
			if (strpos($answer, 'status ="60"') AND strpos($answer, 'sum="'.$pay["summ"]))
			{
				$this->diafan->_shop->order_pay($order_id);
				$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step3/');
				exit;
			}
		}
		$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step4/');
		exit;
	}
}

$cart_rew = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND site_id IN"
                              ." (SELECT id FROM {site} WHERE module_name='cart' AND [act]='1' AND trash='0' AND block='0')");
$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step4/');
