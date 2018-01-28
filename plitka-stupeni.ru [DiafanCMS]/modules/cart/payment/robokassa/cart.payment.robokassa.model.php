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
 * Формирует данные для формы платежной системы "Robokassa"
 */
class Cart_payment_robokassa_model
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
     * Формирует данные для формы платежной системы "Robokassa"
     * 
     * @return void
     */
	public function get($params)
	{
		// регистрационная информация 
		$result["login"]    = $params['robokassa_login']; //логин 
		$mrh_pass1          = $params['robokassa_pass_1']; //пароль1
		$result["summ"]     = $params['summ'];
		$result["order_id"] = $params["order_id"];

		//описание покупки
		$result["desc"]     = $this->diafan->translit($params["desc_order"]);

		//формирование подписи
		$result["crc"]      = md5($result["login"].":".$params['summ'].":".$params["order_id"].":".$mrh_pass1);

		$link = "https://merchant.roboxchange.com/Index.aspx?MrchLogin=".$result["login"]."&OutSum="
		.$result["summ"]."&InvId=".$result["order_id"]."&Desc=".$result["desc"]."&SignatureValue=".$result["crc"];

		$this->diafan->redirect($link);
		exit;
	}
}