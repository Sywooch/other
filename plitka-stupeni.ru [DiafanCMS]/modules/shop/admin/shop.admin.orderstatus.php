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
 * Shop_admin_orderstatus
 *
 * Статусы заказа
 */
class Shop_admin_orderstatus extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_order_status';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
				'multilang' => true,
			),
			'status' => array(
				'type' => 'select',
				'name' => 'Действие',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'trash', // использовать корзину
		'order', // сортируется
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'status' => array(
			4 => 'нет',
			0 => 'поступление заказа',
			1 => 'оплата, уменьшение количества на складе',
			2 => 'отмена заказа',
			3 => 'выполнение',
		),
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'status' => array('type' => 'select', 'class' => 'width_40_pr')
	);

	/**
	 * Выводит список статусов заказа
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить статус');
		$this->diafan->list_row();
	}

	/**
	 * Сохранение поля "Действие"
	 * 
	 * @return void
	 */
	public function save_variable_status()
	{
		if($this->diafan->addnew || $this->diafan->oldrow["status"] != $_POST["status"])
		{
			if($_POST["status"] != 4)
			{
				DB::query("UPDATE {shop_order_status} SET status='4' WHERE status='%d'", $_POST["status"]);
			}

			$this->diafan->set_query("status='%d'");
			$this->diafan->set_value($_POST["status"]);
		}
	}
}