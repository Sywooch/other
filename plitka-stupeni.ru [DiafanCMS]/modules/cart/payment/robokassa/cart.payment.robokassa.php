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
 * Обработка данных, полученных от системы Robokassa
 */
if ($_GET["rewrite"] == "robokassa/result")
{
	if (empty($_REQUEST["InvId"]))
	{
		include ABSOLUTE_PATH."includes/404.php";
	}
	
	$inv_id = $_REQUEST["InvId"];
	$values = unserialize(DB::query_result("SELECT m.params FROM {shop_payment} AS m, {shop_order} AS p WHERE p.id='%d' AND m.id = p.payment_id", $inv_id));

	$mrh_pass2 = $values['robokassa_pass_2'];
	
	$out_summ = $_REQUEST["OutSum"];
	
	$crc = $_REQUEST["SignatureValue"];
	
	$crc = strtoupper($crc);
	$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));
		
	if (strtoupper($my_crc) != strtoupper($crc))
	{
		echo "bad sign\n";
		exit;
	}

	echo "OK$inv_id\n";
	exit;
}

if ($_GET["rewrite"] == "robokassa/success")
{
	if (empty($_REQUEST["InvId"]))
	{
		include ABSOLUTE_PATH."includes/404.php";
	}
	$inv_id = $_REQUEST["InvId"];
	$values = unserialize(DB::query_result("SELECT m.params FROM {shop_payment} AS m, {shop_order} AS p WHERE p.id='%d' AND m.id = p.payment_id", $inv_id));
	$mrh_pass1 = $values['robokassa_pass_1'];

	
	$crc = $_REQUEST["SignatureValue"];
	$crc = strtoupper($crc);

	$pay = DB::fetch_array(DB::query("SELECT o.id, o.summ FROM {shop_order} AS o"
			." INNER JOIN {shop_pay_history} AS p ON p.order_id=o.id"
			." WHERE o.id=%d AND p.payment='robokassa' AND p.status='request_pay' LIMIT 1", $inv_id));
	if (! $pay)
	{
		include ABSOLUTE_PATH."includes/404.php";
	}

	$out_summ = $_REQUEST["OutSum"];

	$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1"));
	if (strtoupper($my_crc) != strtoupper($crc))
	{
		include ABSOLUTE_PATH."includes/404.php";
	}
	$this->diafan->_shop->order_pay($inv_id);
	
	$cart_rew = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND site_id IN"
	                              ." (SELECT id FROM {site} WHERE module_name='cart' AND [act]='1' AND trash='0' AND block='0')");
	$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step3/');
	exit;
}

$cart_rew = DB::query_result("SELECT rewrite FROM {rewrite} WHERE module_name='site' AND trash='0' AND site_id IN"
                              ." (SELECT id FROM {site} WHERE module_name='cart' AND [act]='1' AND trash='0' AND block='0')");
$this->diafan->redirect('http://'.$_SERVER["HTTP_HOST"].'/'.(REVATIVE_PATH ? REVATIVE_PATH.'/' : '').$cart_rew.'/step4/');
