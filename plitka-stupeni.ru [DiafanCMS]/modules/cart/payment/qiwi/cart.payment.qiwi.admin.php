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
 * Настройки платежной системы "QIWI" для административного интерфейса
 */
class Cart_payment_qiwi_admin
{
	public $config;

	public function __construct()
	{
		$this->config = array(
			"name" => 'QIWI',
			"params" => array(
                'qiwi_id' => 'Номер терминала',
				'qiwi_password' =>  'Пароль'
			)
		);
	}
}