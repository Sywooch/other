<?php

/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN')) {
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Shop_admin_additional_cost
 *
 * Дополнительная стоимость
 */
class Shop_admin_additionalcost extends Frame_admin
{
    /**
     * @var string таблица в базе данных
     */
    public $table = 'shop_additional_cost';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Наименование услуг',
				'help' => 'Добавляются в корзину при оформлении заказа. Например, "Праздничная упаковка товара" или "Расширенная гарантия на товары"',
				'multilang' => true,
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'price' => array(
				'type' => 'floattext',
				'name' => 'Фиксированная стоимость',
			),
			'percent' => array(
				'type' => 'floattext',
				'name' => 'Процент от суммы заказа',
			),
			'amount' => array(
				'type' => 'floattext',
				'name' => 'Бесплатно от суммы заказа',
			),
			'required' => array(
				'type' => 'checkbox',
				'name' => 'Всегда включено в стоимость заказа',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'text' => array(
				'type' => 'textarea',
				'name' => 'Описание',
				'multilang' => true,
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'act', // показать/скрыть
		'trash', // использовать корзину
		'order', // сортируется
	);

    /**
     * Выводит список дополнительных затрат
     * @return void
     */
    public function show() {

        $this->diafan->addnew_init('Добавить');
        $this->diafan->list_row();
    }

}