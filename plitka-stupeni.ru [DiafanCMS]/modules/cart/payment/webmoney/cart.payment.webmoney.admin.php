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
 * Настройки платежной системы "WebMoney" для административного интерфейса
 */
class Cart_payment_webmoney_admin
{
	public $config;

	public function __construct()
	{
		$this->config = array(
			"name" => 'Webmoney',
			"params" => array(
				'wm_target' => 'Webmoney: секретный ключ',
				'wm_secret' => 'Webmoney: кошелек',
			)
		);
	}
}