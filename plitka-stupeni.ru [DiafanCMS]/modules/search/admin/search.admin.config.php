<?php
/**
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

/**
 * Search_admin_config
 *
 * Настройки поиска
 */
class Search_admin_config extends Frame_admin
{
	/**
	 * @var array поля в базе данных для редактирования
	 */
	public $variables = array (
		'config'       => array (
			'nastr' => array(
				'type' => 'numtext',
				'name' => 'Количество результатов на странице',
			),
			'count_history' => array(
				'type' => 'numtext',
				'name' => 'Количество последних запросов в истории поиска',
			),
			'search_all_word' => array(
				'type' => 'checkbox',
				'name' => 'Искать все слова сразу',
				'help' => 'Если не отмечено, ищет хотя бы одно слово.',
			),
		),
	);

	/**
	 * @var array настройки модуля
	 */
	public $config = array (
		'config', // файл настроек модуля
	);
}