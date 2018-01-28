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
 * Настройки платежной системы "ChronoPay" для административного интерфейса
 */
class Cart_payment_chronopay_admin
{
	public $config = array(
		"name" => 'ChronoPay',
		"params" => array(
			'shared_sec' => 'SharedSec',
			'product_id' => 'Product_ID'
		)
	);
}