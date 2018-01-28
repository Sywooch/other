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
 * Subscribtion_admin_category
 *
 * Редактирование категорий рассылки
 */
class Subscribtion_admin_category extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'subscribtion_category';

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
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'parent_id' => array(
				'type' => 'select',
				'name' => 'Вложенность: принадлежит',
			),
			'text' => array(
				'type' => 'editor',
				'name' => 'Описание',
				'multilang' => true,
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'parent', // содержит вложенности
		'order', // сортируется
		'act', // показать/скрыть
		'del', // удалить
		'category', // часть модуля - категории
		'category_rel', // работают вместе с таблицей {module_category_rel}
		'trash', // использовать корзину
	);

	/**
	 * @var integer количество строк, выводимых на странице
	 */
	public $nastr = 100;

	/**
	 * Выводит список категорий
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить категорию');
		$this->diafan->list_row();
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("subscribtion_emails_cat_unrel", "cat_id=".$del_id, $trash_id);
	}
}