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
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

/**
 * Site_search_config
 *
 * Настройки для поисковой индексации
 */
class Site_search_config
{
	public $config = array(
		'site' => array(
			'fields' => array('name', 'text'),
			'name_field' => 'name',
			'snippet_fields' => array('text'),
			'snippet_length' => 100,
			'rating' => 5
		)
	);
}