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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Shop_admin_currency
 *
 * Валюты
 */
class Shop_admin_currency extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_currency';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'exchange_rate' => array(
				'type' => 'floattext',
				'name' => 'Курс к основной валюте',
				'help' => 'Все товары на сайте показываются только в основной валюте! Сохраняя в дальнейшем товар в данной валюте, его стоимость будет пересчитываться на сайте по указанному курсу.',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'trash', // использовать корзину
	);

	/**
	 * Выводит список заказов
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить валюту');
		$this->diafan->list_row();
	}

	/**
	 * Сохранение поля "Курс валюты"
	 * @return void
	 */
	public function save_variable_exchange_rate()
	{
		DB::query("UPDATE {shop_currency} SET exchange_rate='%f' WHERE id=%d", $_POST["exchange_rate"], $this->diafan->save);
		$this->diafan->_shop->price_calc(0, 0, $this->diafan->save);
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("shop_price", "currency_id=".$del_id, $trash_id);
	}
}