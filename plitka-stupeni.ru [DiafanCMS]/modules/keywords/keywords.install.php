<?php
/**
 * Установка модуля "Перелинковка"
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

$title = "Перелинковка";
$db = array(
	"tables" => array(
		array(
			"name" => "keywords",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "text",
					"type" => "TEXT NOT NULL",
				),
				array(
					"name" => "link",
					"type" => "TEXT NOT NULL",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "keywords",
			"module_name" => "keywords",
			"admin" => true,
			"site" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Перелинковка",
			"rewrite" => "keywords",
			"group_id" => "3",
			"sort" => "2",
			"act" => true,
			"children" => array(
				array(
					"name" => "Ключевые слова",
					"rewrite" => "keywords",
					"sort" => "1",
					"act" => true,
				),
				array(
					"name" => "Импорт/экспорт",
					"rewrite" => "keywords/importexport",
					"sort" => "2",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "keywords/config",
					"sort" => "3",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "keywords",
			"module_name" => "site",
			"value" => "1",
		),
		array(
			"name" => "keywords",
			"module_name" => "ads",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "keywords",
			"module_name" => "clauses",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "keywords",
			"module_name" => "faq",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "keywords",
			"module_name" => "files",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "keywords",
			"module_name" => "news",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "keywords",
			"module_name" => "photo",
			"value" => "1",
			"check_module" => true,
		),
		array(
			"name" => "keywords",
			"module_name" => "shop",
			"value" => "1",
			"check_module" => true,
		),
	),
);

$example = array(
	"INSERT INTO {keywords} (text,link".multilang(",actLANG").") VALUES
	('бумажные животные','/'".multilang(",'1'",",'0'")."),
	('кенгуру','/shop/animals/big/kangaroo/'".multilang(",'1'",",'0'").")",
);