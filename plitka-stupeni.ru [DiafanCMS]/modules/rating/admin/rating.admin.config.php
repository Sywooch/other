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
 * Rating_admin_config
 *
 * Настройки модуля "Рейтинг"
 */
class Rating_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'only_user' => array(
				'type' => 'checkbox',
				'name' => 'Только для зарегистрированных пользователей',
			),
			'security' => array(
				'type' => 'select',
				'name' => 'Защита от накруток',
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
		'security' => array(
			0 => 'нет',
			3 => 'вести лог голосовавших',
			4 => 'запрещать голосовать повторно',
		),
	);
}