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
 * Работа с платежной системой Liqpay
 */
 
if (!empty($_POST['operation_xml']) && !empty($_POST['signature']))
{
	$xml_decoded = base64_decode($_POST['operation_xml']);

	$xml = simplexml_load_string($xml_decoded);
	
	$values = unserialize(DB::query_result("SELECT m.params FROM {shop_payment} AS m, {shop_order} AS p WHERE p.id='%d' AND m.id = p.payment_id", $xml->order_id));	
	
	$sign = base64_encode(sha1($values['signature'].$xml_decoded.$values['signature'],1));
	
	if($_POST['signature'] != $sign)
	{
		include ABSOLUTE_PATH."includes/404.php";
	}
	
	//если платеж прошел успешно
	if($xml->status == 'success')
	{
		$this->diafan->_shop->order_pay($xml->order_id);
		$cart_rew = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND site_id IN"
	                              ." (SELECT id FROM {site} WHERE addmodule='cart' AND [act]='1' AND trash='0' AND block='0')");
		$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step3/');
		exit;
	}
	
	//если платеж не прошел или находится на проверке
	if($xml->status == 'failure' || $xml->status == 'wait_secure')
	{
		$cart_rew = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND site_id IN"
                              ." (SELECT id FROM {site} WHERE addmodule='cart' AND [act]='1' AND trash='0' AND block='0')");
		$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step4/');
		exit;
	}
}

include ABSOLUTE_PATH."includes/404.php";