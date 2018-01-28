<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (!defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

/**
 * Menu_admin_config
 *
 * Настройки модуля "Меню"
 */
class Menu_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config' => array (
			'js' => array(
				'type' => 'function',
				'disabled' => true,
			),
			'images' => array(
				'type' => 'module',
				'name' => 'Использовать изображения',
				'count_variation' => 1,
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
	 * Редактирование поля "JS"
	 *
	 * @return void
	 */
	public function edit_config_variable_js()
	{
		echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/menu/admin/menu.admin.config.js"></script>';
	}
}