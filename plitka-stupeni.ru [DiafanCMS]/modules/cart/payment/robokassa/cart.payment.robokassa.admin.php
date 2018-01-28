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
 * Настройки платежной системы "Robokassa" для административного интерфейса
 */
class Cart_payment_robokassa_admin
{
	public $config;

	public function __construct()
	{
		$this->config = array(
			"name" => 'Robokassa',
			"params" => array(
                'robokassa_login' => 'Robokassa: логин',
                'robokassa_pass_1' => 'Robokassa: пароль 1',
                'robokassa_pass_2' => 'Robokassa: пароль 2',
			)
		);
	}
}