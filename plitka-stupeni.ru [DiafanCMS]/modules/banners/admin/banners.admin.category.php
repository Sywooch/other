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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Banners_admin_category
 *
 * Редактирование категорий статей
 */
class Banners_admin_category extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'banners_category';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Название',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
			),
			'number' => array(
				'type' => 'function',
				'name' => 'Номер',
				'help' => 'Номер элемента в БД. (для разработчиков)',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'act', // показать/скрыть
		'del', // удалить
		'category', // часть модуля - категории
		'trash', // использовать корзину
	);

	/**
	 * Выводит список категорий
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить категорию');
		$this->diafan->list_row();
	}
}