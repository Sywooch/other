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
 * Формирует данные для формы платежной системы "ChronoPay"
 */
class Cart_payment_chronopay_model extends Diafan
{
	/**
     * Формирует данные для формы платежной системы "ChronoPay"
     *
     * @return void
     */
	public function get($params)
	{
	    // если контроль времени жизни order_id (договариваеться с тех поддержкой)

		$params['shared_sec'] = md5(implode('-', array($params['product_id'], $params['summ'], $params['order_id'], $params['shared_sec'])));
		$params['link'] = BASE_PATH.'cart/payment/chronopay/';
		return $params;
	}
}