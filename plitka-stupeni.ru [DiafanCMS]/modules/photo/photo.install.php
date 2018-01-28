<?php
/**
 * Установка модуля "Фотогалерея"
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

$title = "Фотогалерея";

$db = array(
	"tables" => array(
		array(
			"name" => "photo",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "TEXT NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
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
					"name" => "map_no_show",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "changefreq",
					"type" => "ENUM( 'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never' ) NOT NULL",
				),
				array(
					"name" => "priority",
					"type" => "VARCHAR( 3 ) NOT NULL",
				),
				array(
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "keywords",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "descr",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "title_meta",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "anons",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "timeedit",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "access",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "admin_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "theme",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "view",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY site_id (site_id)",
			),
		),
		array(
			"name" => "photo_rel",
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
					"name" => "rel_element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
		array(
			"name" => "photo_category",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "TEXT NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
				),
				array(
					"name" => "map_no_show",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "changefreq",
					"type" => "ENUM( 'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never' ) NOT NULL",
				),
				array(
					"name" => "priority",
					"type" => "VARCHAR( 3 ) NOT NULL",
				),
				array(
					"name" => "parent_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count_children",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "keywords",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "descr",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "title_meta",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "anons",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "timeedit",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "access",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "admin_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "theme",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "view",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "view_element",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY parent_id (parent_id)",
				"KEY site_id (site_id)",
			),
		),
		array(
			"name" => "photo_category_parents",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ",
				),
				array(
					"name" => "element_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "parent_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "photo_category_rel",
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
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY cat_id (`cat_id`)",
			),
		),
		array(
			"name" => "photo_counter",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL",
				),
				array(
					"name" => "count_view",
					"type" => "SMALLINT(11) UNSIGNED NOT NULL",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY element_id (`element_id`)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "photo",
			"module_name" => "photo",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Photogallery'),
			"act" => true,
			"sort" => 3,
			"module_name" => "photo",
			"rewrite" => "photo",
			"menu" => array(
				"cat_id" => 3,
				"sort" => 9,
			),
		),
	),
	"adminsites" => array(
		array(
			"name" => "Фотогалерея",
			"rewrite" => "photo",
			"group_id" => "1",
			"sort" => "4",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/fotogalereya/",
			"children" => array(
				array(
					"name" => "Фотографии",
					"rewrite" => "photo",
					"sort" => "11",
					"act" => true,
				),
				array(
					"name" => "Альбомы",
					"rewrite" => "photo/category",
					"sort" => "12",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "photo/config",
					"sort" => "13",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "images",
			"value" => "1",
		),
		array(
			"name" => "page_show",
			"value" => "1",
		),
		array(
			"name" => "use_animation",
			"value" => "1",
		),
		array(
			"name" => "count_list",
			"value" => "1",
		),
		array(
			"name" => "nastr",
			"value" => "10",
		),
		array(
			"name" => "images_variations",
			"value" => serialize(array(0 => array('name' => 'medium', 'id' => 2), 1 => array('name' => 'large', 'id' => 3))),
		),
	),
);

$example = array(
	"INSERT INTO {config} (`module_name`, `name`, `value`) VALUES ('photo', 'cat', '1')",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		1,
		".multilang("'Коршун Маркус',", "'Kite Markus',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		1,
		'".time()."'
	);",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (1, 1);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		2,
		".multilang("'Лошадь Ксения',", "'Horse Xenia',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		2,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (2, 1);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		3,
		".multilang("'Козел Вова',", "'Goat Vova',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		3,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (3, 1);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		4,
		".multilang("'Слон Антон',", "'Elephant Anton',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		4,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (4, 1);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		5,
		".multilang("'Крокодил Геннадий',", "'Crocodile Genady',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		2,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (5, 1);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		6,
		".multilang("'Жираф Инокентий',", "'Giraffe Inokenty',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		6,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (6, 1);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		7,
		".multilang("'Корова Варя',", "'Cow Varya',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		7,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (7, 1);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		8,
		".multilang("'Страус Ахмед',", "'Ostrich Ahmed',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		8,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (8, 1);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		9,
		".multilang("'Кобра Жанна',", "'Cobra Jeanne',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		9,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (9, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		10,
		".multilang("'Цапля Денис',", "'Heron Denis',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		10,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (10, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		11,
		".multilang("'Черепаха Коля',", "'Turtle Kohlya',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		11,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (11, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		12,
		".multilang("'Заяц Кирилл',", "'Hare Cyril',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		12,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (12, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		13,
		".multilang("'Рыба Валентина',", "'Fish Valentine',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		13,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (13, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		14,
		".multilang("'Утенок Магкряк',", "'Duckling Magkrjak',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		14,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (14, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		15,
		".multilang("'Орел Егорка',", "'Eagle Egorka',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		15,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (15, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		16,
		".multilang("'Мышь Пика',", "'Mouse Peaka',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		16,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (16, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		17,
		".multilang("'Лиса Лия',", "'Fox Lija',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		17,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (17, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		18,
		".multilang("'Гриф Вазген',", "'Vulture Vazgen',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		18,
		'".time()."'
	)",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (18, 2);",

	"INSERT INTO {photo} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." cat_id, site_id, sort, timeedit) VALUES (
		19,
		".multilang("'Суслик Миша',", "'Gopher Misha',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		19,
		'".time()."'
	);",

	"INSERT INTO {photo_category_rel} (element_id, cat_id) VALUES (19, 2);",

	"DELETE FROM {photo_category} WHERE id=1",
	
	"INSERT INTO {photo_category} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, sort, timeedit) VALUES (
		1,
		".multilang("'Экстраверты',", "'Extraverts',", "'',")."
		".multilang("'1',")."
		MODULE_SITE_ID,
		1,
		'".time()."'
	)",

	"INSERT INTO {menu} (
		id,
		module_name,
		site_id,
		module_cat_id,
		cat_id,
		parent_id,
		".multilang("nameLANG, ")."
		".multilang("actLANG, ")."
		sort
	) VALUES (
		31,
		'photo',
		MODULE_SITE_ID,
		1,
		3,
		6,
		".multilang("'Экстраверты',", "'Extraverts',", "'',")."
		".multilang("'1', ")."
		4
	)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, cat_id) VALUES ('photo/extroverts', 'photo', MODULE_SITE_ID, 1)",

	"INSERT INTO {menu_parents} (`element_id`, `parent_id`) VALUES (31, 6)",

	"INSERT INTO {photo_category} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, sort, timeedit) VALUES (
		2,
		".multilang("'Интроверты',", "'Introverts',", "'',")."
		".multilang("'1',")."
		MODULE_SITE_ID,
		2,
		'".time()."'
	);",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, cat_id) VALUES ('photo/introverts', 'photo', MODULE_SITE_ID, 2)",

	"INSERT INTO {menu} (
		id,
		module_name,
		site_id,
		module_cat_id,
		cat_id,
		parent_id,
		".multilang("nameLANG, ")."
		".multilang("actLANG, ")."
		sort
	) VALUES (
		32,
		'photo',
		MODULE_SITE_ID,
		2,
		3,
		6,
		".multilang("'Интроверты',", "'Introverts',", "'',")."
		".multilang("'1', ")."
		5
	)",

	"INSERT INTO {menu_parents} (`element_id`, `parent_id`) VALUES (32, 6)"
);

/**
 * Выполняет действия для установки примеров заполнения модуля
 * 
 * @return void
 */
function module_example_photo()
{	
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/photo'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/photo', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/photo/large'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/photo/large', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/photo/medium'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/photo/medium', 0777);
	}
	$array = array(
			19 => array(23 => 'suslik-misha'),
			14 => array(24 => 'utenok'),
			6  => array(25 => 'zhirav'),
			15 => array(26 => 'orel'),
			13 => array(27 => 'ryba'),
			4  => array(28 => 'slon'),
			8  => array(29 => 'straus'),
			2  => array(30 => 'loshad'),
			12 => array(31 => 'zayac'),
			16 => array(32 => 'mysh-pika'),
			3  => array(33 => 'kozel'),
			5  => array(34 => 'krokodil'),
			17 => array(35 => 'lisa-liya'),
			11 => array(36 => 'cherepaxa'),
			9  => array(37 => 'kobra'),
			7  => array(38 => 'korova'),
			1  => array(39 => 'korshun'),
			18 => array(40 => 'grif'),
			10 => array(84 => 'caplya')
		);

	$module = 'photo';
	foreach ($array as $k => $a)
	{
		foreach ($a as $id => $name)
		{
			$name = $name.'_'.$id.'.jpg';

			if (! file_exists(ABSOLUTE_PATH.USERFILES.'/original/'.$name))
			{
				copy(DEMO_PATH.$module.'/'.$name, ABSOLUTE_PATH.USERFILES.'/original/'.$name);
				copy(ABSOLUTE_PATH.USERFILES.'/original/'.$name, ABSOLUTE_PATH.USERFILES.'/'.$module.'/large/'.$name);
				copy(DEMO_PATH.$module.'/small/'.$name, ABSOLUTE_PATH.USERFILES.'/small/'.$name);
				copy(DEMO_PATH.$module.'/medium/'.$name, ABSOLUTE_PATH.USERFILES.'/'.$module.'/medium/'.$name);
			}

			chmod(ABSOLUTE_PATH.USERFILES.'/small/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/original/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/'.$module.'/large/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/'.$module.'/medium/'.$name, 0777);

			DB::query("INSERT INTO {images} (id, name, module_name, element_id, sort) VALUES ('%d', '%s', '%s', '%d', '%d')",
				  $id, $name, $module, $k, $id);
		}
	}
}