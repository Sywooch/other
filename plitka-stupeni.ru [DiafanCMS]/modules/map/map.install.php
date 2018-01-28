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

$title = "Карта сайта";

$db = array(
	"modules" => array(
		array(
			"name" => "map",
			"module_name" => "map",
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
			"theme" => "sitemap.php",
			"module_name" => "map",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
			"rewrite" => "map",
		),
	),
);
