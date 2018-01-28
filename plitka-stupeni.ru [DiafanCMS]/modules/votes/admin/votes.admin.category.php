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
 * Votes_admin_category
 *
 * Редактирование вопросов для голосования
 */
class Votes_admin_category extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'votes_category';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Вопрос',
				'multilang' => true,
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'no_result' => array(
				'type' => 'checkbox',
				'name' => 'Запретить показывать результаты голосования на сайте',
			),
			'userversion' => array(
				'type' => 'checkbox',
				'name' => 'Пользователи могут дать свой вариант ответа',
				'help' => 'Пользователь может указать свой вариант ответа',
			),
			'sort' => array(
				'type' => 'function',
				'name' => 'Сортировка: установить перед',
			),
			'site_ids' => array(
				'type' => 'function',
				'name' => 'Раздел сайта',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'act', // показать/скрыть
		'category', // часть модуля - категории
		'link_to_element', //основная ссылка ведет к списку элементов, принадлежащих категории
		'order', // сортируется
		'trash', // использовать корзину
	);

	/**
	 * @var array локальный кэш файла
	 */
	private $cache;

	/**
	 * Выводит список вопросов
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить опрос');
		
		$this->diafan->list_row();
	}

	/**
	 * Сопутствующие действия при удалении элемента модуля
	 * @return void
	 */
	public function delete($del_id, $trash_id)
	{
		$this->diafan->del_or_trash_where("votes_category_site_rel", "element_id=".$del_id, $trash_id);
	}
}