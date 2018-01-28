<?php
/**
 * Установка модуля "Ошибки на сайте"
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

$title = "Ошибки на сайте";

$db = array(
	"tables" => array(
		array(
			"name" => "mistakes",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "url",
					"type" => "varchar(255) NOT NULL",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "selected_text",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "comment",
					"type" => "text NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "mistakes",
			"module_name" => "mistakes",
			"admin" => true,
			"site" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Ошибки на сайте",
			"rewrite" => "mistakes",
			"group_id" => "2",
			"sort" => "10",
			"act" => true,
		),
	),
);

$example = array(
	"INSERT INTO {mistakes} (`url`, `created`, `selected_text`, `comment`) VALUES
	('/shop/waterfowl/beaver/',
	".time().",
	' 5-палыми',
	'Пятипалыми пишется &quot;пятипалыми&quot;, а не &quot;5-палыми&quot;')"
);