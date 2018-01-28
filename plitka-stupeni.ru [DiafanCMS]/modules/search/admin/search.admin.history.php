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
 * Search_admin_history
 *
 * История поиска
 */
class Search_admin_history extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'search_history';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'name' => array(
				'type' => 'text',
				'name' => 'Запрос',
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'datetime', // показывать дату и время в списке, сортировать по дате
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
		$this->diafan->list_row();
	}
}