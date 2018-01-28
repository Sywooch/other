<?php
/**
 * Установка модуля "WebEffectorr"
 * 
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

$title = "Подсказка по скидкам";

$db = array(
	"modules" => array(
		array(
			"name" => "presto",
			"module_name" => "presto",
			"admin" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Подсказка по скидкам",
			"rewrite" => "presto",
			"group_id" => "3",
			"sort" => "1",
			"act" => true,
		),
	),
);