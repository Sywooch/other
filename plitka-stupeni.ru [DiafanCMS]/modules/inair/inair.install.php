<?php
/**
 * Установка модуля "Карта сайта"
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (!defined('DIAFAN')) {
	include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

$title = "Последнии просмотренные товары";

$db = array(
	"modules" => array(
		array(
			"name" => "inair",
			"module_name" => "inair",
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Site map'),
			"act" => true,
			"sort" => 22,
			"theme" => "inair.php",
			"module_name" => "inair",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
			"rewrite" => "inair",
		),
	),
);
