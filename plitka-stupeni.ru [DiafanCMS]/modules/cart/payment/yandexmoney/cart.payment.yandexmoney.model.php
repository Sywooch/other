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
 * Формирует данные для формы платежной системы "YandexMoney"
 */
class Cart_payment_yandexmoney_model
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
     * Формирует данные для формы платежной системы "YandexMoney"
     * 
     * @return void
     */
	public function get($params)
	{
		$result["summ"]      = $params["summ"];
		$result["order_id"]  = $params["order_id"];
		$result["text"]      = $params["text"];
		$result["desc"]      = $params["desc_order"];
		$result["scid"]      = $params["scid"];
		$result["shopid"]    = $params["shopid"];
		$result["test"]      = $params["test"];

		return $result;
	}
}