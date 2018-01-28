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
 * Настройки платежной системы "Liqpay" для административного интерфейса
 */
class Cart_payment_liqpay_admin
{
	public $config;

	public function __construct()
	{
		$this->config = array(
			"name" => 'Liqpay',
			"params" => array(
				'merchant_id' => 'merchant_id', //id мерчанта - выдается системой
				'signature' => 'signature', //сигнатура - выдается системой
				'result_url' => 'result_url', //http://site.ru/cart/payment/liqpay/
				'server_url' => 'server_url', //http://site.ru/cart/payment/liqpay/
				'method' => 'method', //метод оплаты - с карты, с телефона, наличными (card, liqpay, delayed)
				'currency' => 'currency'//валюта - RUR и т.д.
			)
		);
	}
}