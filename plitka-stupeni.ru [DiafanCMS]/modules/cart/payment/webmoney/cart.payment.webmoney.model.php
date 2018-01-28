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
 * Формирует данные для формы платежной системы "WebMoney"
 */
class Cart_payment_webmoney_model
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
     * Формирует данные для формы платежной системы "WebMoney"
     * 
     * @return void
     */
	public function get($params)
	{
		$result["text"]      = $params["text"];
		$result["desc"]      = $params["desc_order"];
		$result["wm_target"] = $params["wm_target"];
		
		$result["summ"]      = $params["summ"];
		$result["order_id"]  = $params["order_id"];

		$result["rnd"]       = strtoupper(substr(md5(uniqid(microtime(), 1)).getmypid(), 1, 8));

		// режим тестирования:
		//  0 или не отсутствует: Для всех тестовых платежей сервис будет имитировать успешное выполнение;
		//  1: Для всех тестовых платежей сервис будет имитировать выполнение с ошибкой (платеж не выполнен);
		//  2: Около 80% запросов на платеж будут выполнены успешно, а 20% - не выполнены.
		//$result["LMI_SIM_MODE"] = 2;
		return $result;
	}
}