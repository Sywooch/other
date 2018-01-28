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
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

/**
 * Rating_install
 *
 * Установка модуля "Рейтинг"
 */

$title = "Рейтинг";
$db = array(
	"tables" => array(
		array(
			"name" => "rating",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(17) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "rating",
					"type" => "float NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count_votes",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY element_id (element_id)",
				"KEY module_name (module_name(2))",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "rating",
			"module_name" => "rating",
			"admin" => true,
			"site" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Рейтинг",
			"rewrite" => "rating",
			"group_id" => "2",
			"sort" => "5",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/rejtingi/",
			"children" => array(
				array(
					"name" => "Настройки",
					"rewrite" => "rating/config",
					"sort" => "33",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "security",
			"value" => "4",
		),
		array(
			"name" => "security",
			"module_name" => "ads",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "security",
			"module_name" => "clauses",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "security",
			"module_name" => "files",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "security",
			"module_name" => "news",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "security",
			"module_name" => "photo",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "security",
			"module_name" => "shop",
			"value" => "1",
			"check_module" => true,
		),
	),
);

if (! empty($_POST["news"]))
{
	$example[] = "INSERT INTO {rating} (id, element_id, module_name, rating, count_votes, created) VALUES (
		1,
		1,
		'news',
		'5',
		2,
		".time()."
	);";

	$example[] = "INSERT INTO {rating} (id, element_id, module_name, rating, count_votes, created) VALUES (
		2,
		3,
		'news',
		'5',
		1,
		".time()."
	);";

	$example[] = "INSERT INTO {rating} (id, element_id, module_name, rating, count_votes, created) VALUES (
		3,
		4,
		'news',
		'5',
		1,
		".time()."
	);";
}

if (! empty($_POST["photo"]))
{
	$example[] = "INSERT INTO {rating} (id, element_id, module_name, rating, count_votes, created) VALUES (
		4,
		2,
		'photo',
		'5',
		1,
		".time()."
	);";
}

if (! empty($_POST["files"]))
{
	$example[] = "INSERT INTO {rating} (id, element_id, module_name, rating, count_votes, created) VALUES (
		5,
		4,
		'files',
		'3',
		1,
		".time()."
	);";
}