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
 * Формирует данные для формы платежной системы "QIWI"
 */
class Cart_payment_qiwi_model
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
     * Формирует данные для формы платежной системы "QIWI"
     * 
     * @return void
     */
	public function get($params)
	{
		if (! empty($_GET["order"]) && $_GET["order"] == 1)
		{
			$result["from_qiwi"] = true;
		}
		$result["text"]     = $params['text'];
		$result["summ"]     = $params['summ'];
		$result["desc"]     = $params["desc_order"];
		$result["order_id"] = $params["order_id"];
		$result["qiwi_id"]  = $params["qiwi_id"];
		return $result;
	}
}