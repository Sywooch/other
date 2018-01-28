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
 * Shop_admin_orderparam
 *
 * Редактирование дополнительных характеристик товаров
 */
class Shop_admin_orderparam extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'shop_order_param';

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
			'required' => array(
				'type' => 'checkbox',
				'name' => 'Обязательно для заполнения',
			),
			'show_in_form_register' => array(
				'type' => 'checkbox',
				'name' => 'Позволять редактировать из личного кабинета',
				'help' => 'Пользователь сможет установить значение по умолчанию для данного поля из личного кабинета',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'type' => array(
				'type' => 'select',
				'name' => 'Тип',
			),
			'param_select' => array(
				'type' => 'function',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'order', // сортируется
		'trash', // использовать корзину
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'type' => array(
			'text' => 'строка',
			'numtext' => 'число',
			'date' => 'дата',
			'datetime' => 'дата и время',
			'textarea' => 'текстовое поле',
			'checkbox' => 'галочка',
			'select' => 'выпадающий список',
			'multiple' => 'список с выбором нескольких значений',
			'email' => 'электронный ящик',
			'title' => 'заголовок группы характеристик',
			'attachments' => 'файлы',
			'images' => 'изображения',
		),
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'type' => array('type' => 'select', 'class' => 'param_type'),
	);

	/**
	 * Выводит список дополнительных характеристик товара
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить поле');
		$this->diafan->list_row();
	}

	/**
	 * Редактирование поля "Параметры"
	 * @return void
	 */
	public function edit_variable_param_select()
	{
		echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/shop/admin/shop.admin.orderparam.js"></script>';
		parent::__call('edit_variable_param_select', array());
	}

	/**
	 * Сохранение поля "Позволять редактировать из личного кабинета"
	 * @return void
	 */
	public function save_show_in_form_register_number()
	{
		$this->diafan->set_query("show_in_form_register='%s'");
		if(! empty($_POST["show_in_form_register"]) && $_POST["type"] == "attachments")
		{
			$this->diafan->set_value(0);
		}
		else
		{
			$this->diafan->set_value(! empty($_POST["show_in_form_register"]) ? 1 : 0);
		}
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("shop_order_param_user", "param_id=".$del_id.")", $trash_id);
	}
}
