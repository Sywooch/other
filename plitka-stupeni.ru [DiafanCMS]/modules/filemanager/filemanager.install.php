<?php
/**
 * Установка модуля "Файловый менеджер"
 * 
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

$title = "Файловый менеджер";

$db = array(
	"modules" => array(
		array(
			"name" => "filemanager",
			"module_name" => "filemanager",
			"admin" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Файловый менеджер",
			"rewrite" => "filemanager",
			"group_id" => "3",
			"sort" => "3",
			"act" => true,
		),
	),
);