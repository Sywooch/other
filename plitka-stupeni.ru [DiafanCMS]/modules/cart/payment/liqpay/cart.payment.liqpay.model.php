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
 * Формирует данные для формы платежной системы "Liqpay"
 */
class Cart_payment_liqpay_model extends Diafan
{
	/**
     * Формирует данные для формы платежной системы "Liqpay"
     * 
     * @return void
     */
	public function get($params)
	{
		$result["summ"]      		= $params["summ"];
		$result["order_id"]  		= $params["order_id"];
		$result["text"]      		= $params["text"];
		$result["desc"]      		= $params["desc_order"];
		$result["merchant_id"]      = $params["merchant_id"];
		$result["signature"]    	= $params["signature"];
		$result["result_url"]    	= $params["result_url"];
		$result["server_url"]    	= $params["server_url"];
		$result["method"]    		= $params["method"];
		$result["currency"]   		= $params["currency"];

		return $result;
	}
}