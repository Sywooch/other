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
 * Subscribtion_admin_phones
 *
 * База номеров телефонов для SMS рассылки
 */
class Subscribtion_admin_phones extends Frame_admin
{
	/**
	 * @var string таблица в базе данных
	 */
	public $table = 'subscribtion_phones';
	
	/**
	 * @var string категории рассылок
	 */
	public $subscribtion = '';

	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'main' => array (
			'phone' => array(
				'type' => 'text',
				'name' => 'Номер телефона в федеральном формате',
			),
			'created' => array(
				'type' => 'date',
				'name' => 'Дата добавления',
				'help' => 'Вводится в формате дд.мм.гггг чч:мм',
			),
			'act' => array(
				'type' => 'checkbox',
				'name' => 'Получает рассылку',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'del', // удалить
		'trash', // удалить в корзину
		'act', // показать/скрыть
	);
	
	/**
	 * @var array текст для ссылки на редактирование в списке
	 */
	public $text_for_base_link = array(
		'variable' => 'phone'
	);

	/**
	 * Выводит список рассылок
	 * @return void
	 */
	public function show()
	{
		$this->diafan->addnew_init('Добавить номер телефона');
		$this->diafan->list_row();
	}
}