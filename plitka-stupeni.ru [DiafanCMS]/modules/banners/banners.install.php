<?php
/**
 * Установка модуля "Баннеры"
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

$title = "Баннеры";

$db = array(
	"tables" => array(
		array(
			"name" => "banners",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "name",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "alt",
					"type" => "varchar(250) NOT NULL",
					"multilang" => true,
				),
				array(
					"name" => "title",
					"type" => "varchar(250) NOT NULL",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
				),
				array(
					"name" => "type",
					"type" => "enum('1','2','3') NOT NULL",
				),
				array(
					"name" => "file",
					"type" => "varchar(250) NOT NULL",
				),
				array(
					"name" => "html",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "link",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "cat_id",
					"type" => "int(11) NOT NULL",
				),
				array(
					"name" => "check_number",
					"type" => "enum('0','1') NOT NULL",
				),
				array(
					"name" => "check_click",
					"type" => "enum('0','1') NOT NULL",
				),
				array(
					"name" => "show_click",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "date_start",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "date_finish",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "show_number",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "click",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "width",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "height",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "check_user",
					"type" => "enum('0','1') NOT NULL",
				),
				array(
					"name" => "show_user",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "count_view",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "target_blank",
					"type" => "enum('0','1') NOT NULL",
				),
				array(
					"name" => "trash",
					"type" => "enum('0','1') NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "banners_category",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "name",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "act",
					"type" => "enum('0','1') NOT NULL",
				),
				array(
					"name" => "trash",
					"type" => "enum('0','1') NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "banners_site_rel",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "element_id",
					"type" => "int(11) NOT NULL",
				),
				array(
					"name" => "site_id",
					"type" => "int(11) NOT NULL",
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
			"name" => "banners",
			"module_name" => "banners",
			"admin" => true,
			"site" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Баннеры",
			"rewrite" => "banners",
			"group_id" => "1",
			"sort" => "6",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/bannery/",
			"children" => array(
				array(
					"name" => "Баннеры",
					"rewrite" => "banners",
					"sort" => "1",
					"act" => true,
				),
				array(
					"name" => "Категории",
					"rewrite" => "banners/category",
					"sort" => "2",
					"act" => true,
				),
				array(
					"name" => "Настройка",
					"rewrite" => "banners/config",
					"sort" => "3",
					"act" => true,
				),
			)
		),
	),
);

$example = array(
	"INSERT INTO {banners} (id, name, ".multilang("altLANG,")." ".multilang("titleLANG,")."
	".multilang("actLANG,")."type, file, link, created, check_user, show_user, target_blank) VALUES (
	1,
	'Реклама на главной',
	".multilang("'Один из лучших отобанков со зверятами',", "'',")."
	".multilang("'Один из лучших отобанков со зверятами',", "'',")."
	".multilang("'1',")."
	'1',
	'banner_1.jpg',
	'http://www.yandex.ru/',
	".time().",
	'1','5','1')",

	"INSERT INTO {banners} (id, name, ".multilang("actLANG,")."type, html, created) VALUES
	(2, 'Баннер сквозной о вакансии',".multilang("'1',")."'3','<div style=\"width: 500px; height: 70px; padding: 10px; background: #ffface\"; text-align:center; margin:10px;><h1>Требуется сторож! Обращаться по телефону!</h1>На правах рекламы</div>',".time().");",
	
	"INSERT INTO {banners_site_rel} (element_id, site_id) VALUES (1,1),(2,0);",
);

/**
 * Выполняет действия по установке модуля
 * 
 * @return void
 */
function module_basic_banners()
{
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/banners'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/banners', 0777);
	}
}

/**
 * Выполняет действия для установки примеров заполнения модуля
 * 
 * @return void
 */
function module_example_banners()
{
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/banners'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/banners', 0777);
	}

	if (! file_exists(ABSOLUTE_PATH.USERFILES.'/banners/banner_1.jpg'))
	{
		copy(DEMO_PATH.'banners/banner_1.jpg',
		     ABSOLUTE_PATH.USERFILES.'/banners/banner_1.jpg');
	}
}