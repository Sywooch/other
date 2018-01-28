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
 * Tags_install
 *
 * Установка модуля "Теги"
 */

$title = "Теги";

$db = array(
	"tables" => array(
		array(
			"name" => "tags",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(10) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "tags_name_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
				"KEY element_id (element_id)",
				"KEY module_name (module_name(2))",
				"KEY tags_name_id (tags_name_id)",
			),
		),
		array(
			"name" => "tags_name",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(70) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "map_no_show",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
			"name" => "tags",
			"module_name" => "tags",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Теги",
			"rewrite" => "tags",
			"group_id" => "1",
			"sort" => "8",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/tegi/",
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Tags'),
			"act" => true,
			"sort" => 6,
			"module_name" => "tags",
			"rewrite" => "tags",
		),
	),
	"config" => array(
		array(
			"name" => "tags",
			"module_name" => "ads",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "tags",
			"module_name" => "clauses",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "tags",
			"module_name" => "faq",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "tags",
			"module_name" => "files",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "tags",
			"module_name" => "news",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "tags",
			"module_name" => "photo",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "tags",
			"module_name" => "shop",
			"value" => 1,
			"check_module" => true,
		),
	),
);

$example = array(
	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (1, ".multilang("'Орел',", "'Eagle',", "'',")." 1);",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/eagle', 'tags', 1, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (2, ".multilang("'Птица',", "'Bird',", "'',")." 2)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/bird', 'tags', 2, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (3, ".multilang("'Желтый',", "'Yellow',", "'',")." 3)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/yellow', 'tags', 3, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (4, ".multilang("'Мышь',", "'Mouse',", "'',")." 4)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/mouse', 'tags', 4, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (5, ".multilang("'Пингвин',", "'Penguin',", "'',")." 5)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/penguin', 'tags', 5, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (6, ".multilang("'Весна',", "'Spring',", "'',")." 6)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/spring', 'tags', 6, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (7, ".multilang("'Бобер',", "'Beaver',", "'',")." 7)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/beaver', 'tags', 7, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (8, ".multilang("'Фиолетовый',", "'Purple',", "'',")." 8)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/purple', 'tags', 8, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (9, ".multilang("'Слон',", "'Elephant',", "'',")." 9)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/elephant', 'tags', 9, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (10, ".multilang("'Бабочка',", "'Butterfly',", "'',")." 10)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/butterfly', 'tags', 10, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (11, ".multilang("'Летит',", "'Fly',", "'',")." 11)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/fly', 'tags', 11, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (12, ".multilang("'Большой',", "'Big',", "'',")." 12)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/big', 'tags', 12, MODULE_SITE_ID)",

	"INSERT INTO {tags_name} (id, ".multilang("nameLANG,")." sort) VALUES (13, ".multilang("'Ползает',", "'Crawl',", "'',")." 13)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('tags/crawl', 'tags', 13, MODULE_SITE_ID)"
);



if (! empty($_POST["news"]))
{
	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'6',
		'news',
		'11',
		1
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'7',
		'news',
		'11',
		2
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'8',
		'news',
		'11',
		3
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'9',
		'news',
		'10',
		4
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'10',
		'news',
		'10',
		3
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'11',
		'news',
		'8',
		3
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'12',
		'news',
		'8',
		6
		".multilang(",'1'")."
	)";
}

if (! empty($_POST["clauses"]))
{
	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'3',
		'clauses',
		'2',
		7
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'4',
		'clauses',
		'2',
		5
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'13',
		'clauses',
		'2',
		8
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'14',
		'clauses',
		'1',
		3
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'15',
		'clauses',
		'1',
		10
		".multilang(",'1'")."
	)";
}

if (! empty($_POST["shop"]))
{
	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'16',
		'shop',
		'1',
		2
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'17',
		'shop',
		'1',
		3
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'18',
		'shop',
		'1',
		11
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'19',
		'shop',
		'32',
		3
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'20',
		'shop',
		'32',
		13
		".multilang(",'1'")."
	)";
}

if (! empty($_POST["photo"]))
{
	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'21',
		'photo',
		'4',
		9
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'22',
		'photo',
		'4',
		3
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'23',
		'photo',
		'4',
		12
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'24',
		'photo',
		'5',
		3
		".multilang(",'1'")."
	)";

	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'25',
		'photo',
		'5',
		13
		".multilang(",'1'")."
	)";
}

if (! empty($_POST["faq"]))
{
	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'26',
		'faq',
		'11',
		3
		".multilang(",'1'")."
	)";
}

if (! empty($_POST["files"]))
{
	$example[] = "INSERT INTO {tags} (id, module_name, element_id, tags_name_id".multilang(", actLANG").") VALUES (
		'27',
		'files',
		'3',
		3
		".multilang(",'1'")."
	)";
}