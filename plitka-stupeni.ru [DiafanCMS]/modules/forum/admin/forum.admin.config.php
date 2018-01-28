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
 * Forum_admin_config
 *
 * Настройки модуля "Форум"
 */
class Forum_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'nastr' => array(
				'type' => 'numtext',
				'name' => 'Количество тем на странице',
			),
			'format_date' => array(
				'type' => 'select',
				'name' => 'Формат даты',
			),
			'count_level' => array(
				'type' => 'numtext',
				'name' => 'Максимальная вложенность',
			),
			'max_count' => array(
				'type' => 'numtext',
				'name' => 'Максимальное количество сообщений на странице',
			),
			'news_count_days' => array(
				'type' => 'numtext',
				'name' => 'Сколько дней хранить «новые» сообщения',
				'help' => 'Нагружает БД. При большом количестве пользователей рекомендуется устанавливать не более трех дней',
			),
			'hr1' => 'hr',
			'captcha' => array(
				'type' => 'checkbox',
				'name' => 'Использовать защитный код (каптчу)',
			),
			'only_user' => array(
				'type' => 'checkbox',
				'name' => 'Только для зарегистрированных пользователей',
			),
			'premoderation_theme' => array(
				'type' => 'checkbox',
				'name' => 'Предмодерация темы для обсуждения',
			),
			'premoderation_message' => array(
				'type' => 'checkbox',
				'name' => 'Предмодерация сообщений',
			),
			'hr2' => 'hr',
			'attachments' => array(
				'type' => 'module',
				'name' => 'Разрешить добавление файлов',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'config', // файл настроек модуля
	);

	/**
	 * @var array значения списков
	 */
	public $select_arr = array(
		'format_date' => array(
			0 => '1.05.2009',
			1 => '1 мая 2008 г.',
			2 => '1 мая',
			3 => '1 мая 2008, понедельник',
			5 => 'вчера 15:30',
			4 => 'не отображать',
		),
	);
}