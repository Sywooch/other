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
 * Формирует данные для страницы оплаты безналичным платежем
 */
class Cart_payment_non_cash_model
{
	/**
	 * @var object основной объект системы
	 */
	private $diafan;

	/**
	 * Конструктор класса
	 * 
	 * @return void
	 */
	public function __construct(Core &$diafan)
	{
		$this->diafan = &$diafan;
	}

	/**
	 * Формирует данные для страницы оплаты безналичным платежем
	 * 
	 * @return void
	 */
	public function get($params)
	{
		$result["type"]     = "non_cash";
		$result["text"]     = $params['text'];
		$result["order_id"] = $params["order_id"];
		$result["code"]     = DB::query_result("SELECT `code` FROM {shop_order} WHERE id=%d", $params["order_id"]);
		return $result;
	}
}