<?php
/**
 * Редактирование рейтигов
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

class Keywords_admin extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'keywords';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'text' => array(
				'type' => 'text',
				'name' => 'Ключевое слово',
				'help' => 'Укажите ключевое слово. Модуль найдет все слова на Вашем сайте и превратит их в ссылки на страницу, адрес которой нужно указать ниже.',
			),
			'link' => array(
				'type' => 'text',
				'name' => 'URL',
				'help' => 'URL-адрес страницы, куда будет вести ссылка с ключевого слова',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Показывать на сайте',
				'default' => true,
				'multilang' => true,
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'act', // показать/скрыть
		'del', // удалить
		'trash', // использовать корзину
	); 

	/**
	 * @var array поля для быстрого редактирования в списке
	 */
	public $fast_edit_rows = array (
		'text' => 'text',
		'link' => 'text',
	);

	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'id'
	);

	/**
	 * Выводит список ключевиков
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить ссылку');
		$this->diafan->list_row();
	}
}