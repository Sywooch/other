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
 * Referals_admin
 *
 * Редактирование рефералов
 */
class Referals_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'referals';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'id' => array(
				'type' => 'numtext',
				'name' => 'Код поситителя',
				'disabled' => true,
			),
			'created' => array(
				'type' => 'datetime',
				'name' => 'Дата',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'referer' => array(
				'type' => 'textarea',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'date', // показывать дату в списке, сортировать по дате
	);

	/**
	 * @var array выводить в списке содержание полей:
	 */
	public $config_other_row = array (
		'referer' => 'text',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'id',
		'text' => 'Код посетителя: %d'
	);

	/**
	 * Выводит список переходов на сайт
	 * @return void
	 */
	public function show()
	{
        $this->diafan->list_row();
	}
}