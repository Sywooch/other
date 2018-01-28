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
 * Работа с платежной системой ChronoPay
 * callback
 */

if(!empty($_POST) && $_SERVER['REMOTE_ADDR'] == '207.97.254.211')
{
	$params = unserialize(DB::query_result("SELECT m.params FROM {shop_payment} AS m, {shop_order} AS p WHERE p.id='%d' AND m.id = p.payment_id LIMIT 1", $_POST['order_id']));
	if(array_key_exists('shared_sec', $params))
	{
		$sign = md5($params['shared_sec'].$_POST['customer_id'].$_POST['transaction_id'].$_POST['transaction_type'].$_POST['total']);

		if($sign == $_POST['sign'])
		{
			$this->diafan->_shop->order_pay($_POST['order_id']);
		}
	}
}

if(array_key_exists('rewrite', $_GET))
{
	switch($_GET['rewrite'])
	{
		case 'chronopay/fail':
			$url = 'step4/';
			break;

		case 'chronopay/success':
			$url = 'step3/';
			break;

		default: 
			include ABSOLUTE_PATH."includes/404.php";
			break;
	}

	$url = $this->diafan->_route->module('cart').$url;
	$this->diafan->redirect($url);
}