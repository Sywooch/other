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

/*
 * Работа с платежной системой Яндекс.Деньги
 */

if(! empty($_POST['orderNumber']))
{
	$values = unserialize(DB::query_result("SELECT m.params FROM {shop_payment} AS m, {shop_order} AS p WHERE p.id='%d' AND m.id = p.payment_id", $_POST['orderNumber']));
}
else
{
	include ABSOLUTE_PATH."includes/404.php";
}

//если это проверка заказа и номер магазина - наш
if($_POST['action'] == 'checkOrder' && !empty($values['scid']) && $_POST['scid'] == $values['scid']) 
{
	$result = DB::query("SELECT o.id, o.summ FROM {shop_order} AS o"
			." INNER JOIN {shop_pay_history} AS p ON p.order_id=o.id"
			." WHERE o.id=%d AND p.payment='yandexmoney' AND p.status='request_pay'", $_POST['orderNumber']);
	if($pay = DB::fetch_array($result))
	{
		if ($pay["summ"] == $_POST['orderSumAmount'])
		{
			echo '<?xml version="1.0" encoding="UTF-8"?>
			<checkOrderResponse performedDatetime ="'.$_POST['orderCreatedDatetime'].'"
			code="0" invoiceId="'.$_POST['invoiceId'].'" 
			shopId="'.$_POST['shopId'].'"/>';
			exit;
		}
	}
}

//если это подтверждение оплаты и номер магазина - наш
if($_POST['action'] == 'paymentAviso' && !empty($values['scid']) && $_POST['scid'] == $values['scid'])
{
	$result = DB::query("SELECT o.id, o.summ FROM {shop_order} AS o"
			." INNER JOIN {shop_pay_history} AS p ON p.order_id=o.id"
			." WHERE o.id=%d AND p.payment='yandexmoney' AND p.status='request_pay'", $_POST['orderNumber']);
	if($pay = DB::fetch_array($result))
	{
		$out_summ = $_POST['orderSumAmount'];

		$chkstring = 
		$_POST['action'].';'
		.$_POST['orderSumAmount'].';'
		.$_POST['orderSumCurrencyPaycash'].';'
		.$_POST['orderSumBankPaycash'].';'
		.$values['shopcid'].';' //номер магазина в Яндекс.деньгах
		.$_POST['invoiceId'].';'
		.$_POST['customerNumber'].';'
		.$values['password'] //shopPassword из анкеты магазина в Яндекс.Деньгах
		;

		if($_POST['md5'] == strtoupper(md5($chkstring)))
		{
			$this->diafan->_shop->order_pay($_POST['orderNumber']);

			echo '<?xml version="1.0" encoding="UTF-8"?>
			<paymentAvisoResponse
			performedDatetime ="'.$_POST['orderCreatedDatetime'].'"
			code="0" invoiceId="'.$_POST['invoiceId'].'" 
			shopId="'.$_POST['shopId'].'"/>';
			exit;
		}
	}
}

include ABSOLUTE_PATH."includes/404.php";