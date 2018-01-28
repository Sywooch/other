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
 * Referals_install
 *
 * Установка модуля "Коды РК"
 */
$title = 'Коды РК';
$db = array(
	"tables" => array(
		array(
			"name" => "referals",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "created",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "referer",
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
			"name" => "referals",
			"module_name" => "referals",
			"admin" => true,
			"site" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Коды РК",
			"rewrite" => "referals",
			"group_id" => "2",
			"sort" => "23",
			"act" => true,
		),
	),
	"sql" => array(
		"INSERT INTO {referals} (id, referer, created) VALUE (1, '', ".time().");"
	),
);