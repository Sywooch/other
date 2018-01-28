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
 * Обработка данных, полученных от системы WebMoney
 */

// проверка валидности запроса
if ($_GET["rewrite"] == "webmoney/result")
{
	if (! isset($_POST['LMI_PREREQUEST']) || $_POST['LMI_PREREQUEST'] != 1)
	{
	
		if (! isset($_POST['LMI_PAYMENT_NO']) || preg_match('/^\d+$/', $_POST['LMI_PAYMENT_NO']) != 1 || ! isset($_POST['RND'])
		   || preg_match('/^[A-Z0-9]{8}$/', $_POST['RND'], $match) != 1)
		{
			include ABSOLUTE_PATH."includes/404.php";
		}
		$pay = DB::fetch_array(DB::query("SELECT o.id, o.summ FROM {shop_order} AS o"
				." INNER JOIN {shop_pay_history} AS p ON p.order_id=o.id"
				." WHERE o.id=%d AND p.payment='yandexmoney' AND p.status='request_pay' AND o.summ='%f' LIMIT 1",
				$_POST['LMI_PAYMENT_NO'], $_POST['LMI_PAYMENT_AMOUNT']));
		if (! $pay)
		{
			include ABSOLUTE_PATH."includes/404.php";
		}
		echo 'YES';
	}
	else
	{

		if (! isset($_POST['LMI_PAYMENT_NO'])
		   || preg_match('/^\d+$/', $_POST['LMI_PAYMENT_NO']) != 1
		   || !isset($_POST['RND']) || preg_match('/^[A-Z0-9]{8}$/', $_POST['RND'], $match) != 1)
		{
			include ABSOLUTE_PATH."includes/404.php";
		}
		$pay = DB::fetch_array(DB::query("SELECT o.id, o.summ FROM {shop_order} AS o"
				." INNER JOIN {shop_pay_history} AS p ON p.order_id=o.id"
				." WHERE o.id=%d AND p.payment='yandexmoney' AND p.status='request_pay' AND o.summ='%f' LIMIT 1",
				$_POST['LMI_PAYMENT_NO'], $_POST['LMI_PAYMENT_AMOUNT']));
		if (! $pay)
		{
			include ABSOLUTE_PATH."includes/404.php";
		}
		
	$values = unserialize(DB::query_result("SELECT m.params FROM {shop_payment} AS m INNER JOIN {shop_order}AS p ON m.id = p.payment_id WHERE p.id=%d", $_POST['LMI_PAYMENT_NO']));
		
		$chkstring = $values['wm_target']
			.$pay['summ']
			.$pay['id']
			.$_POST['LMI_MODE']
			.$_POST['LMI_SYS_INVS_NO']
			.$_POST['LMI_SYS_TRANS_NO']
			.$_POST['LMI_SYS_TRANS_DATE']
			.$values['wm_secret']
			.$_POST['LMI_PAYER_PURSE']
			.$_POST['LMI_PAYER_WM'];
		$md5sum = strtoupper(md5($chkstring));

		if ($_POST['LMI_PAYEE_PURSE'] != $values['wm_target'] || $_POST['LMI_HASH'] != $md5sum)
		{
			include ABSOLUTE_PATH."includes/404.php";
		}
	}
	exit;
}

// оплата прошла успешно
if ($_GET["rewrite"] == "webmoney/success")
{
	if (!isset($_POST['LMI_PAYMENT_NO']) || preg_match('/^\d+$/', $_POST['LMI_PAYMENT_NO']) != 1)
	{
		include ABSOLUTE_PATH."includes/404.php";
	}
	$pay = DB::fetch_array(DB::query("SELECT o.id, o.summ FROM {shop_order} AS o"
			." INNER JOIN {shop_pay_history} AS p ON p.order_id=o.id"
			." WHERE o.id=%d AND p.payment='webmoney' AND p.status='request_pay' LIMIT 1",
			$_POST['LMI_PAYMENT_NO']));
	if (! $pay)
	{
		include ABSOLUTE_PATH."includes/404.php";
	}

	$this->diafan->_shop->order_pay($_POST['LMI_PAYMENT_NO']);

	$cart_rew = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND site_id IN"
	                              ." (SELECT id FROM {site} WHERE module_name='cart' AND [act]='1' AND trash='0' AND block='0')");
	$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step3/');
	exit;
}

// оплата отменена
if ($_GET["rewrite"] == "webmoney/fail")
{
	$cart_rew = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND site_id IN"
				      ." (SELECT id FROM {site} WHERE module_name='cart' AND [act]='1' AND trash='0' AND block='0')");
	$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step4/');
	exit;
}

include ABSOLUTE_PATH."includes/404.php";