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
 * Votes_admin_element
 *
 * Редактирование ответов для голосования
 */
class Votes_admin_element extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'votes';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Ответ',
				'multilang' => true,
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
			'count_votes' => array(
				'type' => 'numtext',
				'name' => 'Количество ответов',
				'help' => 'Количество выбравших данный ответ',
			),
			'cat_id' => array(
				'type' => 'function',
				'name' => 'Вопрос',
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
		'act', // показать/скрыть
		'trash', // использовать корзину
		'order', // сортируется
		'element', // используются группы
		'category_flat', // категори не содержат вложенности
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'count_votes' => 'string',
	);

	/**
	 * Выводит списко ответов
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить вариант ответа');
		
		$this->diafan->list_row($this->diafan->cat);
	}
}