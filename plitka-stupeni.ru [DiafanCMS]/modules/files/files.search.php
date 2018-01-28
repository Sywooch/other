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
 * Files_search_config
 *
 * Настройки для поисковой индексации
 */
class Files_search_config
{
	public $config = array(
		'files' => array(
			'fields' => array('name', 'anons', 'text'),
			'name_field' => 'name',
			'snippet_fields' => array('anons', 'text'),
			'snippet_length' => 100,
			'rating' => 6
		),
		'files_category' => array(
			'fields' => array('name', 'anons', 'text'),
			'name_field' => 'name',
			'snippet_fields' => array('anons', 'text'),
			'snippet_length' => 100,
			'rating' => 6
		)
	);
}