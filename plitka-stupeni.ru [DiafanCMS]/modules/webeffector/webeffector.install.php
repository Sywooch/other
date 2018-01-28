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

$title = "WebEffector";

$db = array(
	"modules" => array(
		array(
			"name" => "webeffector",
			"module_name" => "webeffector",
			"admin" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "WebEffector",
			"rewrite" => "webeffector",
			"group_id" => "3",
			"sort" => "1",
			"act" => true,
		),
	),
);