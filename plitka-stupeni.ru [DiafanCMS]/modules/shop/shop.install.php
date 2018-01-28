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
 * Shop_install
 *
 * Установка модуля "Магазин"
 */

$title = "Каталог товаров";
$db = array(
	"tables" => array(
		array(
			"name" => "shop",
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
					"name" => "article",
					"type" => "VARCHAR(30) NOT NULL DEFAULT ''",
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
					"name" => "yandex",
					"type" => "TEXT NOT NULL DEFAULT ''",
				),
				array(
					"name" => "show_yandex",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "no_buy",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "import",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "import_id",
					"type" => "VARCHAR(100) NOT NULL DEFAULT ''",
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
					"name" => "counter_buy",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "hit",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "new",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "action",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "is_file",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
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
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY site_id (`site_id`)",
			),
		),
		array(
			"name" => "shop_rel",
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
			"name" => "shop_category",
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
					"name" => "show_yandex",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "import",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "import_id",
					"type" => "VARCHAR(100) NOT NULL DEFAULT ''",
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
				"KEY parent_id (`parent_id`)",
				"KEY site_id (`site_id`)",
			),
		),
		array(
			"name" => "shop_category_parents",
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
			"name" => "shop_category_rel",
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
			"name" => "shop_counter",
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
		array(
			"name" => "shop_price",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "good_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "price",
					"type" => "FLOAT UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "old_price",
					"type" => "FLOAT UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count_goods",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "price_id",
					"type" => " INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "date_start",
					"type" => "INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "date_finish",
					"type" => "INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "discount",
					"type" => "FLOAT NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "discount_id",
					"type" => " INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "threshold",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "threshold_cumulative",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "user_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "role_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "currency_id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "import_id",
					"type" => "VARCHAR(100) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY parent_id (`good_id`)",
			),
		),
		array(
			"name" => "shop_price_param",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "price_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "param_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "param_value",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
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
			"name" => "shop_price_image_rel",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "price_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "image_id",
					"type" => "int(11) unsigned NOT NULL",
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
			"name" => "shop_currency",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "exchange_rate",
					"type" => "FLOAT NOT NULL default '0'",
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
			"name" => "shop_discount",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "date_start",
					"type" => "INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "date_finish",
					"type" => "INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "discount",
					"type" => "FLOAT NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "amount",
					"type" => "FLOAT NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "deduction",
					"type" => "FLOAT NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "threshold",
					"type" => "INT( 11 ) UNSIGNED NOT NULL",
				),
				array(
					"name" => "threshold_cumulative",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "role_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "coupon",
					"type" => "VARCHAR( 10 ) NOT NULL ",
				),
				array(
					"name" => "user_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL ",
				),
				array(
					"name" => "count_use",
					"type" => "TINYINT( 3 ) UNSIGNED NOT NULL",
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
			"name" => "shop_discount_object",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "discount_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "cat_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "good_id",
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
			"name" => "shop_param",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "type",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "search",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "list",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "block",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "required",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "page",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "config",
					"type" => "text NOT NULL DEFAULT ''",
				),
				array(
					"name" => "display_in_sort",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "measure_unit",
					"type" => "varchar(50) NOT NULL",
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
		array(
			"name" => "shop_param_element",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "value",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "param_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "element_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY element_id (`element_id`)",
				"KEY param_id (`param_id`)",
			),
		),
		array(
			"name" => "shop_param_select",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "param_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "value",
					"type" => "TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY param_id (`param_id`)",
			),
		),
		array(
			"name" => "shop_param_category_rel",
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
			"name" => "shop_cart",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "good_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "user_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "price_id",
					"type" => " INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "param",
					"type" => "text NOT NULL DEFAULT ''",
				),
				array(
					"name" => "is_file",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY user_id (`user_id`)",
			),
		),
		array(
			"name" => "shop_wishlist",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "good_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "user_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "session_id",
					"type" => "VARCHAR( 64 ) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "param",
					"type" => "text NOT NULL DEFAULT ''",
				),
				array(
					"name" => "is_file",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY user_id (`user_id`)",
			),
		),
		array(
			"name" => "shop_waitlist",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "good_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "user_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "lang_id",
					"type" => "TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "mail",
					"type" => "VARCHAR( 64 ) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "param",
					"type" => "text NOT NULL DEFAULT ''",
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
			"name" => "shop_order",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "user_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "status",
					"type" => "ENUM('0', '1', '2', '3', '4') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "status_id",
					"type" => "TINYINT(3) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "lang_id",
					"type" => "TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "summ",
					"type" => "FLOAT NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "payment_id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "delivery_id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "delivery_summ",
					"type" => "FLOAT NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "code",
					"type" => "varchar(32) NOT NULL",
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
			"name" => "shop_order_status",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "status",
					"type" => "ENUM('0', '1', '2', '3', '4') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
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
			"name" => "shop_order_goods",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "order_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "good_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "discount_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL",
				),
				array(
					"name" => "count_goods",
					"type" => "INT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "price",
					"type" => "float NOT NULL DEFAULT '0'",
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
			"name" => "shop_order_param",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "type",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "required",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "show_in_form_register",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "config",
					"type" => "text NOT NULL DEFAULT ''",
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
			"name" => "shop_order_param_user",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "value",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "param_id",
					"type" => "int(11) unsigned NOT NULL default '0'",
				),
				array(
					"name" => "user_id",
					"type" => "int(11) unsigned NOT NULL default '0'",
				),
				array(
					"name" => "trash",
					"type" => "enum('0','1') NOT NULL default '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "shop_order_param_element",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "value",
					"type" => "text NOT NULL DEFAULT ''",
				),
				array(
					"name" => "param_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "element_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
			"name" => "shop_order_param_select",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "param_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "value",
					"type" => "TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY param_id (`param_id`)",
			),
		),
		array(
			"name" => "shop_order_goods_param",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "value",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "param_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "order_good_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY order_good_id (`order_good_id`)",
			),
		),
		array(
			"name" => "shop_pay_history",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "order_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "status",
					"type" => "ENUM('request_pay', 'pay') NOT NULL DEFAULT 'request_pay'",
				),
				array(
					"name" => "user_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "summ",
					"type" => "FLOAT NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "payment",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "shop_payment",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL default '0'",
					"multilang" => true,
				),
				array(
					"name" => "payment",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "params",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL default '0'",
				),
				array(
					"name" => "sort",
					"type" => "int(11) unsigned NOT NULL default '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "shop_delivery",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "TEXT NOT NULL",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL default '0'",
					"multilang" => true,
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL default '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL default '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "shop_delivery_thresholds",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "delivery_id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL",
				),
				array(
					"name" => "price",
					"type" => "FLOAT NOT NULL default '0'",
				),
				array(
					"name" => "amount",
					"type" => "FLOAT NOT NULL default '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL default '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "shop_additional_cost",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "TEXT NOT NULL",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL default '0'",
					"multilang" => true,
				),
				array(
					"name" => "percent",
					"type" => "FLOAT NOT NULL default '0'",
				),
				array(
					"name" => "price",
					"type" => "FLOAT NOT NULL default '0'",
				),
				array(
					"name" => "amount",
					"type" => "FLOAT NOT NULL default '0'",
				),
				array(
					"name" => "required",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL default '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL default '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "shop_order_additional_cost",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "order_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "additional_cost_id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "summ",
					"type" => "FLOAT NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "shop_import",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "cat_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "type",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "params",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "required",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
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
			"name" => "shop_import_category",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "format",
					"type" => "ENUM('csv', 'xls') NOT NULL DEFAULT 'csv'",
				),
				array(
					"name" => "type",
					"type" => "ENUM('good', 'category') NOT NULL DEFAULT 'good'",
				),
				array(
					"name" => "delete_items",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count_part",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "delimiter",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "end_string",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "encoding",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "sub_delimiter",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
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
			"name" => "shop_files_codes",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "shop_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "code",
					"type" => "varchar(50) NOT NULL",
				),
				array(
					"name" => "date_finish",
					"type" => "datetime NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "shop",
			"module_name" => "shop",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
		array(
			"name" => "cart",
			"module_name" => "shop",
			"site" => true,
			"site_page" => true,
			"title" => "Корзина",
		),
		array(
			"name" => "wishlist",
			"module_name" => "shop",
			"site" => true,
			"site_page" => true,
			"title" => "Отложенные",
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'The catalogue of the goods'),
			"act" => true,
			"sort" => 9,
			"module_name" => "shop",
			"rewrite" => "shop",
			"menu" => array(
				"cat_id" => 3,
				"sort" => 4,
			),
		),
		array(
			"name" => array('Корзина', 'Cart'),
			"act" => true,
			"sort" => 10,
			"module_name" => "cart",
			"rewrite" => "shop/cart"
		),
		array(
			"name" => array('Заказ офомлен', 'Order complete'),
			"act" => true,
			"sort" => 11,
			"rewrite" => "shop/cart/done"
		),
		array(
			"name" => array('Отложенные', 'Wishlist'),
			"act" => true,
			"sort" => 12,
			"module_name" => "wishlist",
			"rewrite" => "shop/wishlist"
		),
	),
	"adminsites" => array(
		array(
			"name" => "Каталог",
			"rewrite" => "shop",
			"group_id" => "4",
			"sort" => "24",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/magazin/",
			"children" => array(
				array(
					"name" => "Настройки",
					"rewrite" => "shop/config",
					"sort" => "1",
					"act" => true,
				),
				array(
					"name" => "Товары",
					"rewrite" => "shop",
					"sort" => "2",
					"act" => true,
				),
				array(
					"name" => "Характеристики",
					"rewrite" => "shop/param",
					"sort" => "3",
					"act" => true,
				),
				array(
					"name" => "Категории",
					"rewrite" => "shop/category",
					"sort" => "4",
					"act" => true,
				),
				array(
					"name" => "Импорт/экспорт",
					"rewrite" => "shop/importexport",
					"sort" => "5",
					"act" => true,
				),
			)
		),
		array(
			"name" => "Оплата",
			"rewrite" => "shop/discount",
			"group_id" => "4",
			"sort" => "25",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/magazin/",
			"children" => array(
				array(
					"name" => "Скидки",
					"rewrite" => "shop/discount",
					"sort" => "1",
					"act" => true,
				),
				array(
					"name" => "Валюты",
					"rewrite" => "shop/currency",
					"sort" => "2",
					"act" => true,
				),
				array(
					"name" => "Методы оплаты",
					"rewrite" => "shop/payment",
					"sort" => "3",
					"act" => true,
				),
				array(
					"name" => "Способы доставки",
					"rewrite" => "shop/delivery",
					"sort" => "4",
					"act" => true,
				),
				array(
					"name" => "Сопутствующие услуги",
					"rewrite" => "shop/additionalcost",
					"sort" => "5",
					"act" => true,
				),
				array(
					"name" => "История платежей",
					"rewrite" => "shop/payhistory",
					"sort" => "6",
					"act" => true,
				),
			)
		),
		array(
			"name" => "Заказы",
			"rewrite" => "shop/order",
			"group_id" => "4",
			"sort" => "26",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/magazin/",
			"children" => array(
				array(
					"name" => "Заказы",
					"rewrite" => "shop/order",
					"sort" => "0",
					"act" => true,
				),
				array(
					"name" => "Форма оформления заказа",
					"rewrite" => "shop/orderparam",
					"sort" => "1",
					"act" => true,
				),
				array(
					"name" => "Отчеты",
					"rewrite" => "shop/ordercount",
					"sort" => "2",
					"act" => true,
				),
				array(
					"name" => "Отложенные",
					"rewrite" => "shop/wishlist",
					"sort" => "3",
					"act" => true,
				),
				array(
					"name" => "Список ожиданий",
					"rewrite" => "shop/waitlist",
					"sort" => "4",
					"act" => true,
				),
				array(
					"name" => "Статусы заказа",
					"rewrite" => "shop/orderstatus",
					"sort" => "5",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "cat",
			"value" => "1",
		),
		array(
			"name" => "images",
			"value" => "1",
		),
		array(
			"name" => "use_animation",
			"value" => "1",
		),
		array(
			"name" => "list_img",
			"value" => "1",
		),
		array(
			"name" => "count_list",
			"value" => "3",
		),
		array(
			"name" => "nastr",
			"value" => "10",
		),
		array(
			"name" => "search_price",
			"value" => "1",
		),
		array(
			"name" => "search_text",
			"value" => "1",
		),
		array(
			"name" => "search_name",
			"value" => "1",
		),
		array(
			"name" => "search_article",
			"value" => "1",
		),
		array(
			"name" => "format_price_3",
			"value" => " ",
		),
		array(
			"name" => "currency",
			"value" => array("руб.", "rub."),
		),
		array(
			"name" => "yandex",
			"value" => "1",
		),
		array(
			"name" => "nameshop",
			"value" => TIT1,
		),
		array(
			"name" => "currencyyandex",
			"value" => "RUR",
		),
		array(
			"name" => "currencyratesel",
			"value" => "1",
		),
		array(
			"name" => "bid",
			"value" => "15",
		),
		array(
			"name" => "order_redirect",
			"value" => "shop/cart/done",
		),
		array(
			"name" => "mes",
			"value" => array(
				"Спасибо за Ваш заказ! В ближайшее время мы с Вами свяжемся для подтверждения заказа.",
				"Thank you for your order! We will connect with you in near time to confirm order.",
			),
		),
		array(
			"name" => "subject",
			"value" => array(
				"Вы оформили заказ %id на сайте %title (%url).",
				"You placed an order %id on web site %title (%url).",
			),
		),
		array(
			"name" => "message",
			"value" => array(
				"Здравствуйте!<br>Вы оформили заказ на сайте %title (%url):<br><br>Номер заказа: %id<br>%order<br>Способ оплаты: %payment<br><br>%message<br><br>Спасибо за Ваш заказ! В ближайшее время мы с Вами свяжемся для подтверждения заказа",
				"Hello, %fio!<br>You placed an order on web site %title (%url):<br><br>Number of order: %id<br>%order<br>Payment: %payment<br><br>%message<br><br>Thank you for your order! We will connect with you in near time to confirm order.",
			),
		),
		array(
			"name" => "subject_admin",
			"value" => "%title (%url). Новый заказ %id",
		),
		array(
			"name" => "message_admin",
			"value" => "Здравствуйте, администратор сайта %title (%url)!<br>На сайте появился новый заказ номер %id: %order<br>Способ оплаты: %payment<br><br>%message",
		),
		array(
			"name" => "subject_change_status",
			"value" => array(
				"Статус заказа изменен",
				"Order status changed",
			),
		),
		array(
			"name" => "message_change_status",
			"value" => array(
				"Здравствуйте!<br>Статус заказ №%order изменен на «%status».",
				'Hello!<br>Status order #%order is changed to "%status".',
			),
		),
		array(
			"name" => "desc_order",
			"value" => array(
				"Oplata tovarov",
				"Payment for goods",
			),
		),
		array(
			"name" => "payment_success_text",
			"value" => array(
				"<p>Спасибо, платеж успешно принят. В ближайшее время мы с Вами свяжемся для уточнения деталей заказа.</p>",
				"<p>Thank you for the payment was successful. In the near future we will contact you to clarify details of your order.</p>",
			),
		),
		array(
			"name" => "payment_fail_text",
			"value" => array(
				"<p>Извините, платеж не прошел.</p>",
				"<p>Sorry, the payment failed.</p>",
			),
		),
		array(
			"name" => "file_sale_message",
			"value" => array(
				"Здравствуйте!<br>Вы оформили заказ на сайте %title (%url):<br><br>Номер заказа: %id<br>Файлы можно скачать по ссылкам в течении часа: %files<br><br>Спасибо за Ваш заказ!",
				"Hello!<br>You place your order online %title (%url):<br><br>Order number: %id. Files can be downloaded from the links at the hour: %files.<br><br>Thank you for your order!",
			),
		),
		array(
			"name" => "attachment_extensions",
			"value" => "zip, rar",
		),
		array(
			"name" => "children_elements",
			"value" => "1",
		),
		array(
			"name" => "rel_two_sided",
			"value" => "1",
		),
		array(
			"name" => "subject_waitlist",
			"value" => array(
				"Товар поступил на склад.",
				"This product will be available.",
			),
		),
		array(
			"name" => "message_waitlist",
			"value" => array(
				"Здравствуйте!<br>Товар %good поступил на склад.",
				"Hello! <br>Product %good entered the warehouse.",
			),
		),
		array(
			"name" => "images_variations",
			"value" => serialize(array(0 => array('name' => 'medium', 'id' => 1), 1 => array('name' => 'large', 'id' => 3))),
		),
	),
	"sql" => array(
	
		"INSERT INTO {shop_order_status} (id, ".multilang("nameLANG,")."status, sort) VALUES
		(1, ".multilang("'Новый',", "'New',", "'',")." '0', 1),
		(2, ".multilang("'В обработке',", "'In processing',", "'',")." '1', 2),
		(3, ".multilang("'Отменен',", "'Canceled',", "'',")." '2', 3),
		(4, ".multilang("'Выполнен',", "'Completed',", "'',")." '3', 4)",
		
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`, `required`) VALUES 
		(1, ".multilang("'ФИО или название компании',", "'Name&amp;Surname',", "'',")." 'text', 1, '1')",
	
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`, `required`) VALUES 
		(2, ".multilang("'E-mail',")."'email', 2, '1')",
	
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`, `required`) VALUES 
		(3, ".multilang("'Контактные телефоны (с кодом города)',", "'Telephones',", "'',")." 'text', 3, '1')",
	
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`) VALUES 
		(4, ".multilang("'Город',", "'Town',", "'',")." 'text', 4)",
	
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`) VALUES 
		(5, ".multilang("'Улица, проспект и пр.',", "'Street',", "'',")." 'text', 5)",
	
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`) VALUES 
		(6, ".multilang("'Номер дома',", "'House number',", "'',")." 'text', 6)",
	
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`) VALUES 
		(7, ".multilang("'Корпус',", "'Block',", "'',")." 'text', 7)",
	
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`) VALUES 
		(8, ".multilang("'Квартира, офис',", "'Flat, office',", "'',")." 'text', 8)",
	
		"INSERT INTO {shop_order_param} (id, ".multilang("nameLANG,")." `type`, `sort`) VALUES 
		(9, ".multilang("'Дополнительно',", "'More',", "'',")." 'textarea', 9)",
	
		"INSERT INTO {shop_category} (
			id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, sort, timeedit
		) VALUES (
			1,
			".multilang("'Наши товары',", "'Our goods',", "'',")."
			".multilang("'1',")."
			MODULE_SITE_ID,
			1,
			'".time()."'
		);",

		"INSERT INTO {menu} (
			module_name,
			site_id,
			module_cat_id,
			cat_id,
			".multilang("nameLANG, ")."
			".multilang("actLANG, ")."
			sort
		) VALUES (
			'shop',
			MODULE_SITE_ID,
			1,
			2,
			".multilang("'Наши товары',", "'Our goods',", "'',")."
			".multilang("'1', ")."
			24
		)",
		
		"INSERT INTO {shop_delivery} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")." sort)
		 VALUES (1, ".multilang("'Курьер',", "'Сourier',").multilang("'Товар доставляется курьером до двери Вашего дома',", "'Goods are delivered to the door of your house',").multilang("'1',")." 1)",
		
		"INSERT INTO {shop_delivery_thresholds} (delivery_id, price)
		 VALUES (1, 500)",
		
		"INSERT INTO {shop_delivery_thresholds} (delivery_id, amount)
		 VALUES (1, 6000)",
	    
		"INSERT INTO {shop_payment} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort) VALUES
		(1, ".multilang("'Наличными курьеру',", "'Cash on hand',").multilang("'Заказ необходимо оплатить курьеру на руки наличными',", "'Pay for goods on hand in cash courier',").multilang("'1',")."1)",
		
		"INSERT INTO {shop_import_category} (`id`, `name`, `format`, `type`, `site_id`, `count_part`, `delimiter`, `encoding`, `sub_delimiter`) VALUES (1, 'Импорт товаров', 'csv', 'good', MODULE_SITE_ID, 200, ';', 'cp1251', '|')",

		"INSERT INTO {shop_import_category} (`id`, `name`, `format`, `type`, `site_id`, `count_part`, `delimiter`, `encoding`, `sub_delimiter`) VALUES (2, 'Импорт категорий', 'csv', 'category', MODULE_SITE_ID, 200, ';', 'cp1251', '|')",
		
		"
INSERT INTO {shop_import} (`name`, `cat_id`, `type`, `params`, `sort`) VALUES
('Артикул товара', 1, 'article', '', 1),
('Название товара', 1, 'name', '', 2),
('Краткое описание', 1, 'anons', '', 3),
('Полное описание товара', 1, 'text', '', 4),
('Цена', 1, 'price', 'a:5:{s:9:\"delimitor\";s:1:\"&\";s:11:\"select_type\";s:3:\"key\";s:5:\"count\";i:0;s:8:\"currency\";i:0;s:15:\"select_currency\";s:3:\"key\";}', 5),
('Количество', 1, 'count', 'a:2:{s:9:\"delimitor\";s:1:\"&\";s:11:\"select_type\";s:3:\"key\";}', 6),
('Хит (1/0)', 1, 'hit', '', 7),
('Новинка (1/0)', 1, 'new', '', 8),
('Акция (1/0)', 1, 'action', '', 9),
('Название категории', 2, 'name', '', 10),
('Краткое описание категории', 2, 'anons', '', 11),
('Полное описание категории', 2, 'text', '', 12);"
	),
);
	
$example = array(
	"UPDATE {site} SET
		".multilang(
			"textLANG='<p>Чтобы положить товар в корзину, перейдите в каталог товаров.</p>'",
			", textLANG='<p>To put the goods in a basket, pass in the catalogue of the goods.</p>'",
			""
		)
	."WHERE module_name='shop'",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `hit`) VALUES (
		1,
		".multilang("'Коршун',", "'Vulture',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Дневная хишная птица, очень полезная в домашнем хозяйстве.</p>',",
			"'<p>Day rapacious a bird very useful in housekeeping.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Отличается:</p>\r\n<ul>\r\n    <li>широкая грудь</li>\r\n    <li>крепкие крылья</li>\r\n    <li>острое зрение</li>\r\n    <li>лапы короткие</li>\r\n</ul>\r\n<p>Питается мясом, любит змей, мелких грызунов.</p>',",
			"'<p>Differs:</p><ul><li>a broad chest</li><li>strong wings</li><li>an acute eyesight</li><li>paws short</li></ul><p>Eats meat, the dragon, small rodents loves.</p>',",
			"'',"
		)."
		1,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (1, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `action`) VALUES (
		2,
		".multilang("'Рыбка-Карасик',", "'Fish-karasik',", "'',")."
		".multilang("'1',")."
		3,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Караси &ndash; рыбка семейства карповых.<br />\r\nСпинной плавник длинный, глоточные зубы однорядные.</p>',",
			"'<p>Crucians &ndash; a small fish of family Cyprinoid.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Тело высокое с толстой спиной, умеренно сжатое с боков.<br />\r\nЧешуя крупная и гладкая на ощупь.</p>',",
			"'<p>Back fin long, a pharyngeal teeth single-row.</p><p>Body high with the thick back, moderately compressed from sides.<br />Scales large and smooth to the touch.</p>',",
			"'',"
		)."
		2,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (2, 3);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		3,
		".multilang("'Пеликан',", "'Pelican',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Пеликан &ndash; птица обитатель морских мелководий, неглубоких пресных и солёных озёр, устьев крупных рек.</p>',",
			"'<p>Pelican &mdash; a bird the inhabitant of sea shoal, superficial fresh and salty lakes, the large rivers.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Ходит неуклюже, но хорошо летает и плавает, может подолгу парить. С воды поднимается после разбега.</p>',",
			"'<p>Goes clumsily, but well flies and floats, can soar long. From water rises after running start.</p>',",
			"'',"
		)."
		3,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (3, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `action`) VALUES (
		4,
		".multilang("'Гусь',", "'Goose',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>У гуся есть клюв, имеющий при основании большую высоту, чем ширину, и оканчивающийся ноготком с острым краем. По краям клюва идут мелкие зубчики.</p>',",
			"'<p>At a goose is a beak having at the basis the big height, than width, and terminating in a nail with a keen edge.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Гусь отличаются шеей средней длины, довольно высокими ногами, прикрепленными ближе к середине тела, и твердым бугром, или шпорой, на сгибе крыла. Перья и пух сильно развиты.</p>',",
			"'<p>Along the edges of a beak go small roughness.</p><p>Goose differ a neck of average length, high enough feet attached more close to the middle of a body, and a firm hillock, or a spur, on a wing bend. Feathers and down are strongly developed.</p>',",
			"'',"
		)."
		4,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (4, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `new`) VALUES (
		5,
		".multilang("'Цапля',", "'Heron ',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Цапля живет на мелководье,  на заболоченных либо медленно текущих водоёмах.</p>',",
			"'<p>The heron lives on shoal, on boggy or slowly current reservoirs.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Отличает:</p>\r\n<ul>\r\n    <li>длинноногость</li>\r\n    <li>длинный и узкий, приплюснутый с боков клюв</li>\r\n    <li>сквозные ноздри.</li>\r\n</ul>\r\n<p>Цапля неподвижно стоит в воде и всматривается в воду, выискивая добычу.</p>',",
			"'<p>Distinguishes</p><ul><li>Long and narrow, flat beak from sides</li><li>Through nostrils.</li><li>The heron motionlessly costs in water and peers at water, trying to discover extraction.</li></ul>',",
			"'',"
		)."
		5,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (5, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		6,
		".multilang("'Филин',", "'Eagle owl',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Для филина характерны глубокие и размеренные взмахи широких крыльев.</p>',",
			"'<p>For an eagle owl deep and measured waves of wide wings are characteristic.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Как правило, филин неторопливо летает над землей, высматривая добычу, чередуя машущий полет с непродолжительным планированием.</p>',"
			,
			"'<p>As a rule, the eagle owl slowly flies over the earth, looking out for extraction, alternating waving flight to short planning.</p>',"
			,
			"'',"
		)."
		6,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (6, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		7,
		".multilang("'Сова',", "'Owl',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Сова &ndash; птица с большими ушными пучками перьев, очень большим отверстием уха.</p>',",
			"'<p>Owl &ndash; a bird with the big ear bunches of feathers, very big aperture of the ear which diameter exceeds diameter of the eye, a full obverse disk and rather narrow forehead.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Диаметр которого превышает диаметр глаза, полным лицевым диском и сравнительно узким лбом.</p>',"
			,
			"'',"
			,
			"'',"
		)."
		7,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (7, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		8,
		".multilang("'Лебедь',", "'Swan',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Оперенье лебедя по своей окраске бывает либо чисто белое, либо серого или чёрного цвета.</p>',",
			"'<p>Feather of swan on the colouring is either purely white, or grey or black colour.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Самок и самцов внешне весьма трудно различать. Лебедей отличает более длинная шея, позволяющая в более глубоких водах обыскивать дно в поисках пищи, а также их величина, по которой они являются самыми крупными водными птицами. Размах их крыльев достигает двух метров, а вес может превышать 15 кг.</p>',"
			,
			"'<p>Females and males outwardly are rather difficult for distinguishing. Swans longer neck allowing in deeper waters to search a bottom in search of food, and also their size on which they are the largest water birds distinguishes. Scope of their wings reaches two metres, and the weight can exceed 15 kg.</p>',"
			,
			"'',"
		)."
		8,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (8, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		9,
		".multilang("'Утенок',", "'Duckling',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Утенок &ndash; это детеныш утки, птицы средних размеров с относительно короткой шеей и цевкой, покрытой спереди поперечными щитками.</p>',",
			"'<p>The duckling is a cub of a duck, a bird of the average sizes with rather short neck, covered in front cross-section guards.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Окраска оперения разнообразна, у многих видов на крыле имеется особое зеркальце.</p>',"
			,
			"'<p>Plumage colouring is various, many kinds on a wing have a special pocket mirror.</p>',"
			,
			"'',"
		)."
		9,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (9, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, no_buy) VALUES (
		10,
		".multilang("'Страус',", "'Ostrich',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Страус &ndash; бескилевая нелетающая птица.</p>',",
			"'<p>Ostrich &ndash; бескилевая not flying bird.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>В переводе с греческого &quot;страус&quot; означает &laquo;воробей-верблюд&raquo;.</p>\r\n<p>Страус &ndash; единственная современная нам птица, у которой имеется мочевой пузырь.</p>',"
			,
			"'<p>In a translation from Greek &quot;ostrich&quot; means &quot;sparrow-camel&quot;.</p><p>Ostrich &mdash; unique modern to us a bird who has a bladder.</p>',"
			,
			"'',"
		)."
		10,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (10, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		11,
		".multilang("'Голубь',", "'Pigeon',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>В природе голубь обычно живет не более трёх-пяти лет, но при разведении в домашних условиях часто доживают до 15-летнего возраста, а отдельные особи и до 35 лет.</p>',",
			"'<p>The pigeon usually lives in the nature no more than three-five years, but at cultivation in house conditions to 15-year-old age, and separate individuals and till 35 years often live.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Народные названия птицы &mdash; сизак, сизарь.</p>',"
			,
			"'<p>National names of a bird &ndash; sizak, sizar.</p>',"
			,
			"'',"
		)."
		11,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (11, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `hit`) VALUES (
		12,
		".multilang("'Гриф',", "'Vulture',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Это оседлая птица гор и предгорий. Обитает в Южной Европе, Северной Африке, Передней, Средней и Центральной Азии.</p>',",
			"'<p>Total length to metre, weight of 7-12 kg.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Общая длина до метра, вес 7-12 кг.</p>\r\n<p>В небольшом числе грифа можно найти на юго-восточном Алтае.</p>\r\n<p>Кормится падалью.</p>',"
			,
			"'<p>She is a settled bird of mountains and foothills. Lives in Southern Europe, the North Africa, Forward, Average and the Central Asia.</p><p>It is possible to find in a signature stamp small number on southeast Altai.</p><p>It is fed with drop.</p>',"
			,
			"'',"
		)."
		12,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (12, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		13,
		".multilang("'Орел',", "'Eagle',", "'',")."
		".multilang("'1',")."
		1,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Питается мелкими и средней величины позвоночными, которых высматривают, паря в воздухе, или подкарауливают, сидя на возвышенном месте, иногда падалью.</p>',",
			"'<p>Nests on the earth, rocks or trees.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Гнездится на земле, скалах или деревьях.</p>\r\n\r\n<p>Численность сокращается.</p>',",
			"'<p>Eats small and average size vertebral which look out, soaring in air, or watch, sitting on a raised place, sometimes drop.</p><p>Number is reduced.</p>',"
			,
			"'',"
		)."
		13,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (13, 1);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `hit`) VALUES (
		14,
		".multilang("'Кенгуру',", "'Kangaroo',", "'',")."
		".multilang("'1',")."
		4,
		MODULE_SITE_ID,
		".multilang(
			"'',",
			"'',",
			"'',"
		)."
		".multilang(
			"'<p>Особенности:</p>\r\n<ol>\r\n    <li>Наличие сумчатых костей.</li>\r\n    <li>Температура тела &mdash; 34&mdash;36&deg;C.</li>\r\n    <li>У кенгуру есть сумка для вынашивания детенышей, она открывается вперед к голове, наподобие кармана передника.</li>\r\n    <li>Особое строение нижней челюсти, нижние концы которой загнуты внутрь. Клыки у них отсутствуют или недоразвиты, а коренные зубы с притупленными бугорками.</li>\r\n    <li>Иммунная система новорождённого кенгурёнка не сформирована, поэтому молоко мамы-кенгуру обладает сильным антибактериальным действием.</li>\r\n    <li>Сумка у самцов кенгуру отсутствует, а есть только у самок.</li>\r\n    <li>Кенгуру передвигаются длинными прыжками.</li>\r\n</ol>',"
			,
			"'<p>Features:<br />&nbsp;&nbsp; 1. Presence of marsupials of bones.<br />&nbsp;&nbsp; 2. A body temperature &mdash; 34&mdash;36&deg;C.<br />&nbsp;&nbsp; 3. The kangaroo have a bag for carrying of a pregnancy cubs, it opens forward to a head, like an apron pocket.<br />&nbsp;&nbsp; 4. The special structure of the bottom jaw, which bottom ends are bent inside. Canines at them are absent or are underdeveloped, and molars with dulled mounts.<br />&nbsp;&nbsp; 5. The immune system of the newborn baby is not generated, therefore milk of mum-kangaroo possesses strong antibacterial action.<br />&nbsp;&nbsp; 6. The bag at males of a kangaroo is absent, and is only at females.<br />&nbsp;&nbsp; 7. Kangaroos move long jumps.<br />&nbsp;</p>',"
			,
			"'',"
		)."
		14,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (14, 4);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `new`) VALUES (
		15,
		".multilang("'Олень',", "'Deer',", "'',")."
		".multilang("'1',")."
		4,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Характерны разветвлённые рога, которые имеются в наличии только у самцов.</p>',",
			"'<p>The branched out horns which are available only at males are characteristic.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Исключениями являются только олень водяной, у которого вообще нет рогов, и олень северный, у которого рога носят оба пола.</p>\r\n<p>Рога сбрасываются каждый год и вырастают заново.</p>',"
			,
			"'<p>Exceptions are only a deer water which in general does not have horns, and a deer northern, at which horn carry both floors.</p>\r\n<p>Horns are dumped every year and grow anew.</p>',"
			,
			"'',"
		)."
		15,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (15, 4);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `action`) VALUES (
		16,
		".multilang("'Носорог',", "'Rhinoceros',", "'',")."
		".multilang("'1',")."
		4,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Главным отличительным признаком носорога является рог на носу.</p>',",
			"'<p>The main distinctive sign of a rhinoceros is the horn on a nose.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>В зависимости от вида носорога может быть один рог или два. Передний рог растёт из носовой кости, задний (если имеется в наличии) из лобовой части черепа. Несмотря на твёрдость, рога состоят не из костной ткани, а из сосредоточенного кератина &ndash; белка, который присутствует и в волосах.</p>',"
			,
			"'<p>Depending on a kind of a rhinoceros there can be one horn or two. The forward horn grows from a nasal bone, back (if is available) of a front part of a skull. Despite hardness, horns consist not of a bone fabric, and from concentrated keratin &ndash; the squirrel who is present and at hair.</p>',"
			,
			"'',"
		)."
		16,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (16, 4);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		17,
		".multilang("'Верблюд',", "'Camel',", "'',")."
		".multilang("'1',")."
		4,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Масса взрослого верблюда &ndash; 500-800 кг, репродуктивный возраст начинается с 2-3 лет.</p>',",
			"'<p>The weight of an adult camel &ndash; 500-800 kg, reproductive age begins from 2-3 years.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Верблюды могут жить до 20 лет.</p>\r\n<p>Эти млекопитающие хорошо приспособлены к жизни в суровой и безводной местности.</p>\r\n<p>Густой мех предназначен для защиты от дневного зноя и ночного холода.</p>',"
			,
			"'<p>Camels can live till 20 years.</p>\r\n<p>These mammals are well adapted for a life in severe and waterless district.</p>\r\n<p>The dense fur is intended for protection against day heat and a night cold.</p>',"
			,
			"'',"
		)."
		17,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (17, 4);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		18,
		".multilang("'Медведь',", "'Bear',", "'',")."
		".multilang("'1',")."
		4,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Отличается коренастым телосложением. Медведь всеяден, хорошо лазает и плавает, быстро бегает.</p>',",
			"'<p>Differs a thickset constitution. The bear is omnivorous, it is good climb and floats, quickly runs, can stand and pass short distances on hinder legs.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Может стоять и проходить короткие расстояния на задних лапах.</p>\r\n<p>Имеет короткий хвост, длинную и густую шерсть, а также отличные обоняние и слух.</p>',"
			,
			"'<p>Has a short tail, a long and dense wool, and also excellent sense of smell and hearing.</p>',"
			,
			"'',"
		)."
		18,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (18, 4);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		19,
		".multilang("'Суслик',", "'Gopher',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Задние конечности немного длиннее передних.</p>',",
			"'',",
			"'',"
		)."
		".multilang(
			"'<ul>\r\n    <li>Уши короткие, слабо опушённые.</li>\r\n    <li>Окраска спины очень разнообразная, от зелёной, до пурпурной.</li>\r\n    <li>Часто на спине имеется тёмная рябь, продольные тёмные полоски, светлые пестрины или мелкие пятнышки.</li>\r\n    <li>По бокам туловища могут проходить светлые полосы.</li>\r\n    <li>Брюхо обычно грязно-жёлтого или беловатого цвета.</li>\r\n    <li>К зиме мех у суслика становится мягким и густым; в летнее время он реже, короче и грубее.</li>\r\n</ul>',"
			,
			"'<ul>    <li>Back finitenesses are a bit longer than lobbies.</li>    <li>Ears short, poorly downy.</li>    <li>back Colouring very various, from green, to the purple.</li>    <li>it is frequent on a back there are dark ripples, longitudinal dark strips or small specks.</li>    <li>On each side trunks can pass light strips.</li>    <li>the Belly of usually lurid or whitish colour.</li>    <li>By the winter the fur at a gopher becomes soft and dense; in summertime it is more rare, shorter and more rough.</li></ul>',"
			,
			"'',"
		)."
		19,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (19, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		20,
		".multilang("'Белочка',", "'Bunny',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Имеет удлинённое тело с пушистым длинным хвостом, уши длинные, цвет темно-бурый с белым брюшком, иногда серый (особенно зимою).</p>',",
			"'<p>Has the extended body with a fluffy long tail, ears long, colour dark-brown with a white paunch, sometimes grey (especially in winter).</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Водятся повсюду, кроме Австралии. Белка даёт ценный мех.</p>',"
			,
			"'<p>Are found everywhere, except Australia. The squirrel gives valuable fur.</p>',"
			,
			"'',"
		)."
		20,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (20, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		21,
		".multilang("'Обезьяна',", "'Monkey',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Характерны пятипалые очень подвижные верхние конечности (руки), противопоставление большого пальца остальным (для большинства), ногти.</p>',",
			"'<p>Five-fingered very mobile top finitenesses (hand), opposition of a thumb to the rest (for the majority), nails are characteristic.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Тело покрыто волосами. Похожа на человека.</p>',"
			,
			"'<p>The body is covered by hair. It is similar to the person.</p>',"
			,
			"'',"
		)."
		21,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (21, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		22,
		".multilang("'Волк',", "'Wolf',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>По общему виду волк напоминает крупную остроухую собаку.</p>',",
			"'<p>On a general view the wolf reminds large a dog.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Голова широколобая, морда относительно широкая, сильно вытянута и по бокам обрамлена &laquo;бакенбардами&raquo;. Ноги высокие, сильные; лапа крупнее и более вытянута, нежели собачья, длина следа порядка 15 см, ширина 7 см, средние два пальца вынесены вперёд, что позволяет отличать следы волка от собачьих.</p>',"
			,
			"'<p>Feet high, strong; the paw is larger and is more extended, rather than dog, length of a trace of an order of 15 sm, width of 7 sm, average two fingers are taken out forward that allows to distinguish traces of a wolf from the dog. The head broad-fronted, a muzzle rather wide, is strongly extended and on each side is framed by &quot;whiskers&quot;.</p>',"
			,
			"'',"
		)."
		22,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (22, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")."sort, timeedit) VALUES (
		23,
		".multilang("'Заяц',", "'Hare',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Отличается развитыми задними конечностями, длинными ушами и наличием короткого хвоста.</p>',",
			"'<p>Differs the developed back finitenesses, long ears and presence of a short tail.</p>',",
			"'',"
		)."
		23,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (23, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		24,
		".multilang("'Кот',", "'Cat',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Кот является мелким теплокровным животным, покрытым негустой шерстью, окрашенной в различные оттенки серого.</p>',",
			"'<p>The cat is to the small warm-blooded animals covered with a rather thin wool, painted in various shades grey.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>В среднем взрослый кот достигает длины в 50 см от кончика носа до кончика хвоста.</p>',"
			,
			"'<p>On the average the adult cat reaches length 50 sm from a tip of a nose to a tail tip.</p>',"
			,
			"'',"
		)."
		24,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (24, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		25,
		".multilang("'Дикобраз',", "'Porcupine',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Дикобразовые располагают самыми длинными иголками среди всех млекопитающих. В эволюционном отношении иголки являются видоизменёнными волосами.</p>',",
			"'<p>Porcupines have the longest needles among all mammals. In the evolutionary relation of a needle are modified hair.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Некоторые из них достигают длину 40 см и диаметр 7 мм, являются острыми и могут вызвать воспаления, если ими уколоться.</p>',"
			,
			"'<p>Some of them reach length of 40 sm and diameter of 7 mm, are sharp and can cause inflammations if them to prick.</p>',"
			,
			"'',"
		)."
		25,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (25, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		26,
		".multilang("'Ежик',", "'Hedgehog',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Форма черепа варьирует от удлинённого и узкого до короткого и широкого.</p>\r\n<p>Хорошо развиты скуловые дуги, широко расставленные в стороны.</p>',",
			"'<p>The skull form varies from extended and narrow to short and wide.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Мозговой отдел небольших размеров.</p>\r\n<p>Зубов 36-44. Первый верхний резец, а иногда и первый нижний резец увеличены в размерах и похожи на клыки.</p>',"
			,
			"'<p>The malar arches widely placed in the parties are well developed.</p>\r\n<p>Brain department of the small sizes.</p>\r\n<p>Teeth 36-44. The first top cutter, and sometimes and the first bottom cutter are increased in sizes and are similar to canines.</p>',"
			,
			"'',"
		)."
		26,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (26, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		27,
		".multilang("'Скай терьер',", "'Skye terrier',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Длинный, приземистый, обильно одетый, в два раза косая длина туловища превышает высоту в холке.</p>',",
			"'<p>Long, stocky, plentifully dressed, twice the slanting length of a trunk exceeds height in holk.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Движения на вид совершенно без усилий. Крепкие конечности, колодка и челюсти.</p>',"
			,
			"'<p>Movements it is by sight perfect without efforts. Strong finitenesses and jaws.</p>',"
			,
			"'',"
		)."
		27,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (27, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		28,
		".multilang("'Такса',", "'Turnspit',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Крепкая, с массивным костяком собака, прочно стоящая на земле, с длинной вытянутой мордой, ушки длинные, мягкие, закругляются на концах.</p>',",
			"'',"
		)."
		".multilang(
			"'<ul>\r\n    <li>Спина мускулистая, крепкая, грудь объёмная, глубокая, с характерным &laquo;килем&raquo; впереди.</li>\r\n    <li>Хвост, толстый и крепкий у основания, поставлен низко, обычно держится чуть ниже линии спины, при возбуждении торчит вверх, как антенна.</li>\r\n    <li>Конечности короткие, толстые, с рельефной мускулатурой (особенно передние).</li>\r\n    <li>Передние лапы шире и больше задних.</li>\r\n    <li>Передвигается свободно, размашисто.</li>\r\n</ul>',"
			,
			"'<ul><li>Strong, with massive skeleton a dog strongly standing on the earth, with the long extended muzzle, ears long, soft, are brief on the ends.</li><li>the Back brawny, strong, a breast volume, deep, with characteristic &laquo;kil&raquo; ahead.</li><li>the Tail, thick and strong at the basis, is put low, usually keeps hardly below a back line, at excitation sticks out upwards, as the aerial.</li><li>Finitenesses short, thick, with relief muscles (especially forward).</li><li>Forepaws more widely and there are more than back.</li><li>Moves freely, widely.</li></ul>',"
			,
			"'',"
		)."
		28,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (28, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")."sort, timeedit) VALUES (
		29,
		".multilang("'Мышь',", "'Mouse',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Мышь внесла огромный вклад в развитие науки &ndash; на этих животных ставятся биологические опыты, вырабатывают противоядия и вакцины, проверяют лекарства и другие вещества на токсичность и тератогенность.</p>',",
			"'<p>The mouse has brought the huge contribution to science development &ndash; on these animals experiments in biology are put, develop antidotes and vaccines, check medicines and other substances on toxicity.</p>',",
			"'',"
		)."
		29,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (29, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")."sort, timeedit) VALUES (
		30,
		".multilang("'Лягушка',", "'Frog',", "'',")."
		".multilang("'1',")."
		5,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Проводит жизнь во влажных местах, чередуя пребывание на суше и в воде.</p>',"
			,
			"'<p>Spends a life in damp places, alternating stay on a land and in water.</p>',"
			,
			"'',"
		)."
		30,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (30, 5);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `new`) VALUES (
		31,
		".multilang("'Бобр',", "'Beaver',", "'',")."
		".multilang("'1',")."
		3,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Тело у бобра приземистое, с укороченными 5-палыми конечностями, задние значительно сильнее передних.</p>',",
			"'<p>The body at the beaver stocky, with truncated 5-palymi finitenesses, back is much stronger than lobbies.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Между пальцами имеются плавательные перепонки, сильно развитые на задних конечностях и слабо &ndash; на передних. Когти на лапах сильные, уплощённые.</p>',"
			,
			"'<p>Between fingers there are the swimming membranes strongly developed on back finitenesses and is weak &mdash; on lobbies. Claws on paws strong.</p>',"
			,
			"'',"
		)."
		31,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (31, 3);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")."sort, timeedit) VALUES (
		32,
		".multilang("'Саламандра',", "'Salamander',", "'',")."
		".multilang("'1',")."
		3,
		MODULE_SITE_ID,
		".multilang(
			"'<p>В случае опасности они спокойно расстаются со своими хвостом или лапами. Нередки случаи полного восстановления внутренних органов и даже глаз.</p>',",
			"'<p>In case of danger they easy leave the a tail or paws. Cases of a complete recovery of an internal and even eyes are frequent.</p>',",
			"'',"
		)."
		32,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (32, 3);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit, `hit`) VALUES (
		33,
		".multilang("'Черепаха',", "'Turtle',", "'',")."
		".multilang("'1',")."
		3,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Черепахи являются одними из любимых и популярных домашних животных.</p>',",
			"'<p>Turtles are one of favourite and popular pets.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Они неприхотливы и выносливы, долго живут даже в условиях российских квартир и особенно любимы детьми, хотя из-за неправильного &quot;вольного&quot; содержания многие умирают в первые 5 лет, а оставшиеся зачастую остаются калеками с кривым панцирем и грибком. Встречаются случаи, когда черепахи передаются родственниками из поколения в поколение.</p>',"
			,
			"'<p>They are unpretentious and hardy, long live even in conditions of the Russian apartments and are especially favourite by children though because of the wrong &quot;free&quot; maintenance many die in the first 5 years, and remained frequently remain cripples with a curve armour and a fungus. There are cases when turtles are transferred by relatives from generation to generation.</p>',"
			,
			"'',"
		)."
		33,
		'".time()."',
		'1'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (33, 3);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		34,
		".multilang("'Крокодил',", "'Crocodile',", "'',")."
		".multilang("'1',")."
		3,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Внешность крокодила демонстрирует адаптацию к обитанию в водной среде: голова плоская, с длинным рылом; туловище приплюснутое; хвост мощный, сжатый с боков; ноги довольно короткие.</p>',",
			"'<p>Appearance of a crocodile shows adaptation to dwelling in the water environment: a head flat, with a long snout; a trunk flat; a tail powerful, compressed from sides; feet short enough.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>На передних конечностях &ndash; 5 пальцев, на задних &ndash; 4 (нет мизинца), соединённых перепонкой. Глаза с вертикально-щелевидным зрачком расположены на верхней части головы, так что животное может выглядывать из воды, выставляя наружу только ноздри и глаза; ноздри и ушные отверстия под водой закрываются подвижными клапанами.</p>',"
			,
			"'<p>On forward finitenesses &mdash; 5 fingers, on back &ndash; 4 (there is no little finger), connected by a membrane. Eyes with vertically-shchelevidnym pupil are located on the top part of a head so the animal can look out of water, exposing outside only nostrils and eyes; nostrils and ear apertures under water are closed by mobile valves.</p>',"
			,
			"'',"
		)."
		34,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (34, 3);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		35,
		".multilang("'Кит',", "'Whale',", "'',")."
		".multilang("'1',")."
		3,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Тело веретенообразное, наподобие обтекаемого тела рыбы. Плавники, иногда также называемые ластами, имеют лопастообразный вид.</p>',",
			"'<p>Body like a streamline body of fish. The fins sometimes also named flappers.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>На конце хвоста расположен стоячий плавник в виде гребня, играющий роль стабилизатора и обеспечивающий движение вперед благодаря вертикальным движениям.</p>',"
			,
			"'<p>On the tail end the standing fin in the form of a crest, playing a role of the stabilizer and furnish advance thanks to vertical movements is located.</p>',"
			,
			"'',"
		)."
		35,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (35, 3);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")."sort, timeedit) VALUES (
		36,
		".multilang("'Слон',", "'Elephant',", "'',")."
		".multilang("'1',")."
		3,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Слон потребляет 230 килограммов сена и 270 литров воды каждый день.</p>',"
			,
			"'<p>The elephant consumes 230 kgs of hay and 270 litres of water every day.</p>',"
			,
			"'',"
		)."
		36,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (36, 3);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		37,
		".multilang("'Свинья',", "'Pig',", "'',")."
		".multilang("'1',")."
		3,
		MODULE_SITE_ID,
		".multilang(
			"'<p>В отличие от других современных копытных, свиньи всеядны. Большинство видов свиней обитает в лесах.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Характерны:</p>\r\n<ul>\r\n    <li>компактное телосложение</li>\r\n    <li>длинная морда, заканчивающаяся голым хрящевым подвижным &laquo;пятачком&raquo; &ndash; это приспособление для разрыхления земли в поисках корма</li>\r\n    <li>хорошо развитые клыки, острые, изогнуты вверх.</li>\r\n    <li>конечности четырёхпалые; боковые пальцы (второй и пятый) едва касаются земли</li>\r\n    <li>сросшиеся в копытообразное окончание пальцы</li>\r\n</ul>',"
			,
			"'<p>Are characteristic:</p><ul><li>a compact constitution</li><li>the long muzzle which is coming to an end naked cartilaginous mobile &laquo;five-kopeck coin&raquo; is an adaptation for loosening the earths in search of a forage</li><li>well developed canines, sharp, are bent upwards.</li><li>finitenesses tetradactyl; lateral fingers (the second and the fifth) hardly concern the earths</li><li>accrete in копытообразное the termination fingers</li></ul>',"
			,
			"'',"
		)."
		37,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (37, 3);",

	"INSERT INTO {shop} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."cat_id, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."sort, timeedit) VALUES (
		38,
		".multilang("'Лев',", "'Lion',", "'',")."
		".multilang("'1',")."
		4,
		MODULE_SITE_ID,
		".multilang(
			"'<p>Образ жизни льва нетипичен для больших кошек. Лев живет в большой семейной группе &ndash; прайде.</p>',",
			"'<p>The way of life of a lion is atypical for the big cats. The lion lives in the big family group.</p>',",
			"'',"
		)."
		".multilang(
			"'<p>Охотится и приглядывает за детенышами, в основном, самки, самцы же охраняют территорию.</p>\r\n<p>Взрослый лев способен съесть за один раз до 18 кг мяса, а по другим оценкам, даже 31 кг. При случае убивает представителей других кошачьих и гиен.</p>',"
			,
			"'<p>Hunts and looks for cubs, basically, females, males protect territory.</p><p>The adult lion is capable to eat for once to 18 kg of meat, and by other estimations, even 31 kg. As required kills representatives of others cat''s and hyenas.</p>',"
			,
			"'',"
		)."
		38,
		'".time()."'
	);",

	"INSERT INTO {shop_category_rel} (element_id, cat_id) VALUES (38, 4);",
	
	"DELETE FROM {shop_category} WHERE id=1",

	"INSERT INTO {shop_category} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, ".multilang("textLANG,")." sort, timeedit
	) VALUES (
		1,
		".multilang("'Птицы',", "'Birds',", "'',")."
		".multilang("'1',")."
		MODULE_SITE_ID,
		".multilang("'<p>Птицы  &mdash; животные с перьями, теплокровные, яйцекладущие с позвоночником, чьи передние конечности имеют форму крыльев.<br />\r\nВ принципе, все птицы летают, но в настоящее время существует много видов нелетающих птиц. А также у птиц должен быть клюв.</p>',"
			,
			"'<p>Birds &mdash; animals with feathers, warm-blooded, яйцекладущие with a backbone, whose forward finitenesses have the form of wings.<br />
	    Basically, all birds fly, but now there are many kinds of not flying birds. And also birds should have a beak.</p>',"
			,
			"'',"
		)."
		1,
		'".time()."'
	);",
	
	"DELETE FROM {menu} WHERE site_id=MODULE_SITE_ID AND module_name='shop'",

	"INSERT INTO {menu} (
		module_name,
		site_id,
		module_cat_id,
		cat_id,
		".multilang("nameLANG, ")."
		".multilang("actLANG, ")."
		sort
	) VALUES (
		'shop',
		MODULE_SITE_ID,
		1,
		2,
		".multilang("'Птицы',", "'Birds',", "'',")."
		".multilang("'1', ")."
		24
	)",

	"INSERT INTO {shop_category} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." count_children, site_id, ".multilang("textLANG,")." sort, timeedit
	) VALUES (
		2,
		".multilang("'Звери',", "'Animals',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		".multilang("'<p>Звери &mdash;  млекопитающие животные, которые рожают детёнышей без откладывания яиц. Все звери имеют  уши, их детёныши могут кормиться от груди, и все они имеют щиколотку, что увеличивает силу их движений. Звери часто классифицируются по картине срастания зубов. Почти все современные млекопитающие &mdash; звери.</p>',"
			,
			"'<p>Animals &mdash; mammals who give birth to cubs without putting off of eggs. All animals have ears, their cubs can be fed from a breast, and all of them have an ankle that increases force of their movements. Animals are often classified on a picture of accretion of a teeth. Almost all modern mammals &mdash; animals.</p>',"
			,
			"'',"
		)."
		2,
		'".time()."'
	);",

	"INSERT INTO {menu} (
		module_name,
		site_id,
		module_cat_id,
		cat_id,
		".multilang("nameLANG, ")."
		".multilang("actLANG, ")."
		sort,
		count_children
	) VALUES (
		'shop',
		MODULE_SITE_ID,
		2,
		2,
		".multilang("'Звери',", "'Animals',", "'',")."
		".multilang("'1', ")."
		25,
		2
	)",

	"INSERT INTO {shop_category} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, ".multilang("textLANG,")." sort, timeedit
	) VALUES (
		3,
		".multilang("'Водоплавающие',", "'Natatorial',", "'',")."
		".multilang("'1',")."
		MODULE_SITE_ID,
		".multilang("'<p>Водоплавающие это живые существа,  ведущие водный образ жизни. К ним относятся все те, кто живут в воде, под водой и над водой.</p>',"
			,
			"'<p>Natatorial it is the live beings conducting a water way of life. All concern them those who live in water, under water and over water.</p>',"
			,
			"'',"
		)."
		3,
		'".time()."'
	);",

	"INSERT INTO {menu} (
		module_name,
		site_id,
		module_cat_id,
		cat_id,
		".multilang("nameLANG, ")."
		".multilang("actLANG, ")."
		sort
	) VALUES (
		'shop',
		MODULE_SITE_ID,
		3,
		2,
		".multilang("'Водоплавающие',", "'Natatorial',", "'',")."
		".multilang("'1', ")."
		26
	)",

	"INSERT INTO {shop_category} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." parent_id, site_id, ".multilang("textLANG,")." sort, timeedit
	) VALUES (
		4,
		".multilang("'Крупные',", "'Big',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		".multilang("'<p>Большие животные звери, которые больше человека, собраны здесь. Это и домашний крупный рогатый скот и дикие большие звери.</p>',"
			,
			"'<p>The big animal animals which there is more than person, are collected here. It both a house horned cattle and wild big animals.</p>',"
			,
			"'',"
		)."
		4,
		'".time()."'
	);",

	"INSERT INTO {shop_category_parents} (`element_id`, `parent_id`) VALUES (4, 2)",

	"INSERT INTO {shop_category} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." parent_id, site_id, ".multilang("textLANG,")." sort, timeedit
	) VALUES (
		5,
		".multilang("'Мелкие',", "'Small',", "'',")."
		".multilang("'1',")."
		2,
		MODULE_SITE_ID,
		".multilang("'<p>Все пузатая мелочь, вроде зайцев и кошек у нас в этой категории, мелкие звери.</p>',"
			,
			"'<p>All a big-bellied trifle, like hares and cats at us in this category, small animals.</p>',"
			,
			"'',"
		)."
		5,
		'".time()."'
	);",

	"INSERT INTO {shop_category_parents} (`element_id`, `parent_id`) VALUES (5, 2)",
	
	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/waterfowl/crucian', 'shop', 2, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/mouse', 'shop', 29, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/frog', 'shop', 30, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/hedgehog', 'shop', 26, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/pelican', 'shop', 3, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/goose', 'shop', 4, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/heron', 'shop', 5, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/owl2', 'shop', 6, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/owl', 'shop', 7, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/swan', 'shop', 8, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/duckling', 'shop', 9, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/ostrich', 'shop', 10, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/pigeon', 'shop', 11, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/vulture', 'shop', 12, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/eagle', 'shop', 13, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/big/deer', 'shop', 15, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/big/rhino', 'shop', 16, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/big/camel', 'shop', 17, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/big/bear', 'shop', 18, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/big/kangaroo', 'shop', 14, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/wolf', 'shop', 22, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/cat', 'shop', 24, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/skye-terrier', 'shop', 27, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/dachshund', 'shop', 28, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/waterfowl/beaver', 'shop', 31, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/waterfowl/salamander', 'shop', 32, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/waterfowl/crocodile', 'shop', 34, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/waterfowl/elephant', 'shop', 36, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/waterfowl/pig', 'shop', 37, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/big/leo', 'shop', 38, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/waterfowl/keith', 'shop', 35, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/waterfowl/turtle', 'shop', 33, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/porcupine', 'shop', 25, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/hare', 'shop', 23, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/monkey', 'shop', 21, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/squirrel', 'shop', 20, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/animals/small/gopher', 'shop', 19, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('shop/birds/kite', 'shop', 1, MODULE_SITE_ID)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, param_id) VALUES ('shop/yellow', 'shop', MODULE_SITE_ID, 10)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, param_id) VALUES ('shop/blue', 'shop', MODULE_SITE_ID, 11)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, param_id) VALUES ('shop/purple', 'shop', MODULE_SITE_ID, 12)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, param_id) VALUES ('shop/orange', 'shop', MODULE_SITE_ID, 13)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, param_id) VALUES ('shop/green', 'shop', MODULE_SITE_ID, 14)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, param_id) VALUES ('shop/black', 'shop', MODULE_SITE_ID, 15)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, param_id) VALUES ('shop/pink', 'shop', MODULE_SITE_ID, 16)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, param_id) VALUES ('shop/brown', 'shop', MODULE_SITE_ID, 17)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, cat_id) VALUES ('shop/birds', 'shop', MODULE_SITE_ID, 1)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, cat_id) VALUES ('shop/animals', 'shop', MODULE_SITE_ID, 2)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, cat_id) VALUES ('shop/animals/big', 'shop', MODULE_SITE_ID, 4)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, cat_id) VALUES ('shop/animals/small', 'shop', MODULE_SITE_ID, 5)",

	"INSERT INTO {rewrite} (rewrite, module_name, site_id, cat_id) VALUES ('shop/waterfowl', 'shop', MODULE_SITE_ID, 3)",
	
	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (3, 33), (3, 10), (3, 12), (3, 21), (2, 5), (2, 20), (2, 14), (4, 7), (4, 8), (4, 11), (4, 17), (4, 23)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (4, 25), (4, 26), (5, 20), (6, 15), (6, 19), (7, 8), (9, 19), (9, 24), (10, 21), (11, 7), (12, 10), (13, 31), (13, 34), (15, 19), (16, 23), (16, 25)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (17, 23), (18, 38), (18, 28), (14, 5), (22, 30), (24, 37), (26, 29), (27, 21), (27, 33), (28, 32), (29, 38), (31, 35), (1, 4), (34, 35), (36, 35), (36, 34), (37, 9), (3, 27)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (4, 38), (4, 32), (4, 29), (4, 28), (4, 16), (4, 18), (7, 16), (7, 17), (7, 23), (7, 25), (7, 26), (7, 28), (7, 29)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (7, 32), (7, 38), (7, 18), (8, 8), (8, 11), (8, 16), (8, 17), (8, 23), (8, 25), (8, 26), (8, 28), (8, 29), (8, 32), (8, 38), (11, 16), (11, 17), (11, 18)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (11, 23), (11, 25), (11, 26), (11, 28), (11, 29), (11, 32), (11, 38), (16, 17), (16, 18), (16, 26), (16, 28), (16, 32), (16, 29), (16, 38)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (17, 18), (17, 25), (17, 26), (17, 28), (17, 29), (17, 32), (17, 38), (18, 23), (18, 25), (18, 26), (18, 29), (18, 32), (18, 8), (38, 32), (38, 28), (38, 26), (38, 23), (38, 25)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (32, 29), (32, 26), (32, 23), (29, 28), (29, 25), (29, 23), (26, 25), (26, 23), (26, 28), (25, 32), (25, 28), (25, 23), (23, 28)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (36, 13), (36, 31), (35, 13), (34, 31), (12, 21), (10, 33), (10, 27), (12, 27), (12, 33), (33, 21), (37, 6), (37, 15), (37, 19), (24, 6)",

	"INSERT INTO {shop_rel} (element_id, rel_element_id) VALUES (24, 15), (24, 19), (15, 9), (9, 6), (14, 20), (1, 7), (1, 8), (1, 11), (1, 16), (1, 17), (1, 23), (1, 25), (1, 26), (1, 28), (1, 29), (1, 32), (1, 38), (1, 18)",

	"INSERT INTO {shop_order} (id, created, `status`, status_id, summ, code, delivery_id, payment_id) VALUES (
		2,
		'".(time()-234678)."',
		'2',
		3,
		11400,
		'2',
		1,
		1
	);",

	"INSERT INTO {shop_order_goods} (id, order_id, good_id, count_goods, price) VALUES (1, 2, 33, 1, 3200);",

	"INSERT INTO {shop_order_goods_param} (value, param_id, order_good_id)  VALUES (15, 9, 1);",

	"INSERT INTO {shop_order_goods} (order_id, good_id, count_goods, price)  VALUES (2, 1, 1, 3500);",

	"INSERT INTO {shop_order_goods_param} (value, param_id, order_good_id)  VALUES (20, 10, 15);",

	"INSERT INTO {shop_order_goods} (order_id, good_id, count_goods, price)  VALUES (2, 3, 1, 4700);",

	"INSERT INTO {shop_order_param_element} (value, param_id, element_id) VALUES
	('Серафим Подольский', 1, 2),
	('serafim@podolskijy.ru', 2, 2),
	('Моногорск', 4, 2),
	('Широкая', 5, 2),
	('1', 7, 2),
	('54', 8, 2),
	('+7(999)888-22-55', 3, 2)",

	"INSERT INTO {shop_order} (id, created, `status`, status_id, summ, code, delivery_id, payment_id) VALUES (
		3,
		'".(time()-86240)."',
		'0',
		1,
		23000,
		'3',
		1,
		1
	);",

	"INSERT INTO {shop_order_goods} (order_id, good_id, count_goods, price)  VALUES (3, 14, 2, 2000);",

	"INSERT INTO {shop_order_goods_param} (value, param_id, order_good_id)  VALUES (18, 10, 3);",

	"INSERT INTO {shop_order_goods} (order_id, good_id, count_goods, price)  VALUES (3, 15, 1, 9000);",

	"INSERT INTO {shop_order_goods_param} (value, param_id, order_good_id)  VALUES (12, 9, 5);",

	"INSERT INTO {shop_order_goods} (order_id, good_id, count_goods, price) VALUES
	(3, 16, 1, 10000),
	(3, 21, 1, 7900);",

	"INSERT INTO {shop_order_param_element} (value, param_id, element_id) VALUES
	('Витольд Покровский', 1, 3),
	('diafan@mail.ru', 2, 3),
	('Можжевельнинск', 4, 3),
	('Липовая', 5, 3),
	('11', 8, 3),
	('+7(999)888-77-22', 3, 3)",

	"INSERT INTO {shop_order} (id, user_id, status, status_id, created, summ, code, delivery_id, payment_id) VALUES (
		4,
		3,
		'1',
		2,
		'".time()."',
		37700,
		'4',
		1,
		1
	);",

	"INSERT INTO {shop_order_goods} (order_id, good_id, count_goods, price) VALUES
	(4, 33, 10, 3200),
	(4, 3, 1, 4700),
	(4, 4, 1, 1000);",

	"INSERT INTO {shop_order_param_element} (value, param_id, element_id) VALUES 
	('Филимон Авруцкий', 1, 4),
	('filimon@site.ru', 2, 4),
	('Мохнатск', 4, 4),
	('Крученая', 5, 4),
	('98', 8, 4),
	('+7(999)444-55-66', 3, 4)",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search) VALUES (
		1,
		".multilang("'Размах крыльев',", "'Wingspan',", "'',")."
		'numtext',
		1,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (1, 1);",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search) VALUES (
		2,
		".multilang("'Летный потолок',", "'Flight ceiling',", "'',")."
		'text',
		2,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (2, 1);",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search) VALUES (
		3,
		".multilang("'Хищность',", "'Rapacity',", "'',")."
		'checkbox',
		3,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (3, 4), (3, 5);",

	"INSERT INTO {shop_param_select} (id, param_id, value ".multilang(", nameLANG").") VALUES
	(1, 3, 0 ".multilang(", 'Не опасен'", ", 'Dangerous'")."),
	(2, 3, 1 ".multilang(", 'Опасен'", ", 'Not dangerous'").");",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search) VALUES (
		4,
		".multilang("'Содержание',", "'Keep',", "'',")."
		'select',
		4,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (4, 0);",

	"INSERT INTO {shop_param_select} (id, param_id".multilang(", nameLANG").", sort) VALUES
	(3, 4 ".multilang(", 'Домашнее'", ", 'House'").", 1),
	(4, 4 ".multilang(", 'Во дворе'", ", 'In a court yard'").", 2),
	(5, 4 ".multilang(", 'Дикое'", ", 'Wild'").", 3);",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search) VALUES (
		5,
		".multilang("'Плавники',", "'Fin',", "'',")."
		'checkbox',
		5,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (5, 3);",

	"INSERT INTO {shop_param_select} (id, param_id, value ".multilang(", nameLANG").") VALUES
	(6, 5, 0 ".multilang(", 'Отсутствуют'", ", 'Be absent'")."),
	(7, 5, 1 ".multilang(", 'Есть'", ", 'Be'").");",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search) VALUES (
		6,
		".multilang("'Глубина заныривания',", "'Depth to dive',", "'',")."
		'numtext',
		6,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (6, 3);",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search) VALUES (
		7,
		".multilang("'Шерсть',", "'Wool',", "'',")."
		'checkbox',
		7,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (7, 4), (7, 5);",

	"INSERT INTO {shop_param_select} (id, param_id, value ".multilang(", nameLANG").") VALUES
	(8, 7, 0 ".multilang(", 'Нет'", ", 'No'")."),
	(9, 7, 1 ".multilang(", 'Да'", ", 'Yes'").");",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search) VALUES (
		8,
		".multilang("'Условия проживания',", "'Residing conditions',", "'',")."
		'text',
		8,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (8, 4), (8, 5);",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, search, `list`, `block`, `page`) VALUES (
		9,
		".multilang("'Цвет',", "'Color',", "'',")."
		'multiple',
		9,
		'1',
		'1',
		'1',
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (9, 0);",

	"INSERT INTO {shop_param_select} (id, param_id, ".multilang("nameLANG,")." sort) VALUES
	(10, 9, ".multilang("'желтый',", "'yellow',", "'',")."10),
	(11, 9, ".multilang("'голубой',", "'blue',", "'',")."11),
	(12, 9, ".multilang("'фиолетовый',", "'purple',", "'',")."12),
	(13, 9, ".multilang("'оранжевый',", "'orange',", "'',")."13),
	(14, 9, ".multilang("'зеленый',", "'green',", "'',")."14),
	(15, 9, ".multilang("'черный',", "'black',", "'',")."15),
	(16, 9, ".multilang("'розовый',", "'pink',", "'',")."16),
	(17, 9, ".multilang("'коричневый',", "'brown',", "'',")."17)",

	"INSERT INTO {shop_param} (id, ".multilang("nameLANG,")." type, sort, `required`) VALUES (
		10,
		".multilang("'Размер',", "'Size',", "'',")."
		'multiple',
		10,
		'1'
	);",

	"INSERT INTO {shop_param_category_rel} (element_id, cat_id) VALUES (10, 0);",

	"INSERT INTO {shop_param_select} (id, param_id, ".multilang("nameLANG,")." sort) VALUES
	(18, 10, ".multilang("'маленький',", "'small',", "'',")."18),
	(19, 10, ".multilang("'средний',", "'medium',", "'',")."19),
	(20, 10, ".multilang("'большой',", "'big',", "'',")."20)",

	"INSERT INTO {shop_param_element} (".multilang("valueLANG,")." param_id, element_id) VALUES (".multilang("'1000',", "'1000',", "'',")." 2, 5),
	(".multilang("'300',", "'300',", "'',")." 2, 6),
	(".multilang("'250',", "'250',", "'',")." 2, 7),
	(".multilang("'700',", "'700',", "'',")." 2, 8),
	(".multilang("'10',")." 2, 10),
	(".multilang("'500',")." 2, 11),
	(".multilang("'1000',", "'1000',", "'',")." 2, 12),
	(".multilang("'3000',", "'3000',", "'',")." 2, 13),
	(".multilang("'Иногда лижут соль',", "'Sometimes lick salt',", "'',")." 8, 15),
	(".multilang("'Сидит в воде',", "'Sits in water',", "'',")." 8, 16),
	(".multilang("'Его надо вьючить',", "'It is necessary load',", "'',")." 8, 17),
	(".multilang("'Нужна будка',", "'The box is necessary',", "'',")." 8, 18),
	(".multilang("'В полях',", "'In dales',", "'',")." 8, 19),
	(".multilang("'На деревьях',", "'On trees',", "'',")." 8, 20),
	(".multilang("'Рядом с людьми',", "'Near to people',", "'',")." 8, 21),
	(".multilang("'В лесу',", "'In wood',", "'',")." 8, 22),
	(".multilang("'В коробке',", "'In a box',", "'',")." 8, 23),
	(".multilang("'Нужны мыши',", "'Mice are necessary',", "'',")." 8, 24),
	(".multilang("'Пустыня',", "'Desert',", "'',")." 8, 25),
	(".multilang("'Под кроватью',", "'Under a bed',", "'',")." 8, 26),
	(".multilang("'На кровати',", "'On a bed',", "'',")." 8, 27),
	(".multilang("'В будке',", "'In a box',", "'',")." 8, 28),
	(".multilang("'Под плинтусом',", "'Under a plinth',", "'',")." 8, 29),
	(".multilang("'Большой двор',", "'The big court yard',", "'',")." 8, 36),
	(".multilang("'У помойки',", "'At a dustbin',", "'',")." 8, 37),
	(".multilang("'В саванне Африки',", "'In savanna of Africa',", "'',")." 8, 38);",

	"INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES 
	('1', 3, 1),
	('1500', 2, 1),
	('3', 1, 1),
	('4', 4, 3),
	('1', 1, 3),
	('4', 4, 4),
	('1', 2, 4),
	('2', 1, 4),
	('5', 4, 5),
	('4', 1, 5),
	('1', 3, 6),
	('2', 1, 6),
	('5', 4, 6),
	('1', 3, 7),
	('1.5', 1, 7),
	('2.5', 1, 8),
	('5', 4, 8),
	('0.3', 1, 9),
	('3', 4, 9),
	('2.3', 1, 10),
	('4', 4, 10),
	('0.5', 1, 11),
	('4', 4, 11),
	('1', 3, 12),
	('3', 1, 12),
	('5', 4, 12),
	('1', 3, 13),
	('3', 1, 13),
	('5', 4, 13),
	('любит поесть', 8, 14),
	('4', 4, 14),
	('1', 7, 15),
	('4', 4, 15),
	('5', 4, 16),
	('1', 3, 16),
	('1', 7, 17),
	('4', 4, 17),
	('1', 7, 18),
	('4', 4, 18),
	('1', 3, 18),
	('1', 7, 19),
	('5', 4, 19),
	('1', 7, 20),
	('5', 4, 20),
	('1', 7, 21),
	('3', 4, 21),
	('1', 7, 22),
	('5', 4, 22),
	('1', 3, 22),
	('1', 7, 23);",

	"INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES
	('3', 4, 23),
	('1', 7, 24),
	('3', 4, 24),
	('1', 3, 24),
	('5', 4, 25),
	('1', 3, 25),
	('3', 4, 26),
	('1', 7, 27),
	('3', 4, 27),
	('4', 4, 28),
	('1', 7, 28),
	('1', 7, 29),
	('3', 4, 29),
	('1', 6, 30),
	('5', 4, 30),
	('2', 6, 31),
	('5', 4, 31),
	('5', 4, 32),
	('10', 6, 33),
	('3', 4, 33),
	('20', 6, 34),
	('1', 5, 34),
	('4', 4, 34),
	('1', 3, 34),
	('1000', 6, 35),
	('1', 5, 35),
	('5', 4, 35),
	('1', 7, 36),
	('4', 4, 36),
	('4', 4, 37), 
	('1', 7, 38),
	('5', 4, 38),
	('1', 3, 38),
	('5', 4, 1),
	('5', 4, 7),
	('16', 9, 15),
	('10', 9, 38),
	('12', 9, 37),
	('11', 9, 36),
	('11', 9, 35),
	('11', 9, 34),
	('15', 9, 33),
	('12', 9, 33),
	('10', 9, 17),
	('10', 9, 32),
	('11', 9, 31),
	('10', 9, 18),
	('16', 9, 19),
	('14', 9, 30),
	('13', 9, 20);",

	"INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES
	('10', 9, 16),
	('10', 9, 29),
	('11', 9, 13),
	('10', 9, 28),
	('10', 9, 26),
	('15', 9, 21),
	('14', 9, 22),
	('10', 9, 23),
	('10', 9, 25),
	('12', 9, 24),
	('12', 9, 15),
	('10', 9, 11),
	('16', 9, 9),
	('10', 9, 8),
	('10', 9, 7),
	('16', 9, 6),
	('10', 9, 4),
	('15', 9, 3),
	('13', 9, 2),
	('10', 9, 1),
	('17', 9, 14),
	('17', 9, 12),
	('17', 9, 10),
	('13', 9, 5),
	('15', 9, 27),
	('17', 9, 27),
	('18', 10, 27),
	('19', 10, 27),
	('20', 10, 27),
	('18', 10, 1),
	('19', 10, 1),
	('20', 10, 1),
	('18', 10, 2),
	('19', 10, 2),
	('20', 10, 2),
	('18', 10, 14),
	('19', 10, 14),
	('20', 10, 14),
	('18', 10, 3),
	('18', 10, 4),
	('18', 10, 5),
	('18', 10, 6),
	('18', 10, 7),
	('18', 10, 8),
	('18', 10, 9),
	('18', 10, 10),
	('18', 10, 11),
	('18', 10, 12),
	('18', 10, 13),
	('18', 10, 15);",

	"INSERT INTO {shop_param_element} (value1, param_id, element_id) VALUES
	('18', 10, 16),
	('18', 10, 17),
	('18', 10, 18),
	('18', 10, 19),
	('18', 10, 20),
	('18', 10, 21),
	('18', 10, 22),
	('18', 10, 23),
	('18', 10, 24),
	('18', 10, 25),
	('18', 10, 26),
	('18', 10, 28),
	('18', 10, 29),
	('18', 10, 32),
	('18', 10, 33),
	('18', 10, 34),
	('18', 10, 35),
	('18', 10, 36),
	('18', 10, 37),
	('18', 10, 38),
	('19', 10, 31);",

	"INSERT INTO {shop_discount} (id, discount, act) VALUES (1, 5, '1'), (2, 15, '1')",

	"INSERT INTO {shop_discount} (id, discount, threshold, role_id, act) VALUES (3, 40, 10000, 4, '1')",

	"INSERT INTO {shop_discount_object} (discount_id, good_id) VALUES 
	(1, 2),
	(1, 30),
	(1, 4),
	(2, 7),
	(2, 16)",

	"INSERT INTO {shop_discount_object} (discount_id, cat_id) VALUES (2, 5), (3, 0)",
	
	"INSERT INTO {shop_price} (id, good_id, price, count_goods, price_id) VALUES
	(1, 1, 3100, 3, 1),
	(2, 1, 3200, 2, 2),
	(3, 1, 3500, 5, 3),
	(4, 2, 100, 5, 4),
	(5, 2, 200, 0, 5),
	(6, 2, 300, 3, 6),
	(7, 3, 4700, 2, 7),
	(8, 4, 1000, 30, 8),
	(9, 5, 6800, 5, 9),
	(10, 6, 3600, 17, 10),
	(11, 7, 3500, 8, 11),
	(12, 8, 8800, 33, 12),
	(13, 9, 3500, 1, 13),
	(14, 10, 6200, 0, 14),
	(15, 11, 900, 20, 15),
	(16, 12, 11000, 5, 16),
	(17, 13, 15000, 3, 17),
	(18, 14, 2000, 15, 18),
	(19, 14, 3000, 2, 19),
	(20, 14, 5600, 1, 20),
	(21, 15, 10000, 3, 21),
	(22, 16, 9000, 2, 22),
	(23, 17, 25000, 0, 23),
	(24, 18, 12500, 0, 24),
	(25, 19, 1200, 12, 25),
	(26, 20, 2450, 6, 26),
	(27, 21, 7900, 4, 27),
	(28, 22, 11800, 7, 28),
	(29, 23, 3200, 8, 29),
	(30, 24, 1200, 10, 30),
	(31, 25, 1200, 1, 31),
	(32, 26, 700, 5, 32),
	(33, 27, 2500, 2, 33),
	(34, 27, 3000, 3, 34),
	(35, 27, 3500, 0, 35),
	(36, 28, 4200, 1, 36),
	(37, 29, 200, 3, 37),
	(66, 31, 2200, 1, 66),
	(65, 31, 300, 4, 65),
	(40, 32, 4400, 5, 40),
	(41, 33, 3200, 30, 41),
	(42, 34, 17000, 0, 42),
	(43, 35, 10000, 4, 43),
	(44, 36, 35000, 7, 44),
	(45, 37, 7100, 12, 45),
	(46, 38, 22000, 23, 46)",

	"INSERT INTO {shop_price} (id, good_id, price, old_price, count_goods, price_id, discount, discount_id) VALUES
	(47, 2, 95, 100, 5, 4, 5, 1),
	(48, 2, 190, 200, 0, 5, 5, 1),
	(49, 2, 285, 300, 3, 6, 5, 1),
	(50, 4, 950, 1000, 30, 8, 5, 1),
	(51, 7, 3325, 3500, 8, 11, 5, 1),
	(52, 19, 1020, 1200, 12, 25, 15, 2),
	(53, 20, 2082.5, 2450, 6, 26, 15, 2),
	(54, 21, 6715, 7900, 4, 27, 15, 2),
	(55, 22, 10030, 11800, 7, 28, 15, 2),
	(56, 23, 2720, 3200, 8, 29, 15, 2),
	(57, 24, 1020, 1200, 10, 30, 15, 2),
	(58, 25, 1020, 1200, 1, 31, 15, 2),
	(59, 26, 595, 700, 5, 32, 15, 2),
	(60, 27, 2125, 2500, 2, 33, 15, 2),
	(61, 27, 2550, 3000, 3, 34, 15, 2),
	(62, 27, 2975, 3500, 0, 35, 15, 2),
	(63, 28, 3570, 4200, 1, 36, 15, 2),
	(64, 29, 170, 200, 3, 37, 15, 2);",
	
	"INSERT INTO {shop_price_param} (price_id, param_id, param_value) VALUES
	(1, 10, 18),
	(2, 10, 19),
	(3, 10, 20),
	(4, 10, 18),
	(5, 10, 19),
	(6, 10, 20),
	(7, 10, 18),
	(8, 10, 18),
	(9, 10, 18),
	(10, 10, 18),
	(11, 10, 18),
	(12, 10, 18),
	(13, 10, 18),
	(14, 10, 18),
	(15, 10, 18),
	(16, 10, 18),
	(17, 10, 18),
	(18, 10, 18),
	(19, 10, 19),
	(20, 10, 20),
	(21, 10, 18),
	(22, 10, 18),
	(23, 10, 18),
	(24, 10, 18),
	(25, 10, 18),
	(26, 10, 18),
	(27, 10, 18),
	(28, 10, 18),
	(29, 10, 18),
	(30, 10, 18),
	(31, 10, 18),
	(32, 10, 18),
	(33, 10, 18),
	(34, 10, 19),
	(35, 10, 20),
	(36, 10, 18),
	(37, 10, 18),
	(40, 10, 18),
	(41, 10, 18),
	(42, 10, 18),
	(43, 10, 18),
	(44, 10, 18),
	(45, 10, 18),
	(46, 10, 18),
	(66, 10, 19),
	(65, 10, 18);",
	
	"INSERT INTO {shop_delivery} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort)
	 VALUES (2, ".multilang("'Самовывоз',", "'Independently pick',").multilang("'Товар необходимо забрать с нашего склада',", "'Item must collect from our warehouse',").multilang("'1',")." 2)",
    
	"INSERT INTO {shop_payment} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort, payment) VALUES
	(2, ".multilang("'WebMoney',", "'WebMoney',").multilang("'Используйте мгновенную оплату заказа через систему WebMoney. Это ускорит доставку Вашего заказа.',", "'Thank you for your purchase! Use an instant payment for the order via WebMoney. This will speed up delivery of your order.',").multilang("'1',")."2, 'webmoney')",
    
	"INSERT INTO {shop_payment} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort, payment) VALUES
	(3, ".multilang("'Robokassa',", "'Robokassa',").multilang("'Robokassa позволяет оплатить заказ одним из удобных для Вас способом.',", "'The system allows Robokassa Pay a convenient way for you.',").multilang("'1',")."3, 'robokassa')",
    
	"INSERT INTO {shop_payment} (id, name1, text1, act1, sort, payment, params) VALUES
	(4, 'Банковские платежи', 'Распечатайте квитанцию и оплатить в ближайшем отделении банка.', '1', 4, 'non_cash', 'a:14:{s:13:\"non_cash_name\";s:50:\"ООО &quot;Бумажный зоопарк&quot;\";s:13:\"non_cash_ogrn\";s:13:\"0000000000000\";s:12:\"non_cash_inn\";s:10:\"0000000000\";s:12:\"non_cash_kpp\";s:9:\"000000000\";s:11:\"non_cash_rs\";s:20:\"00000000000000000000\";s:13:\"non_cash_bank\";s:27:\"ООО &quot;Банк&quot;\";s:12:\"non_cash_bik\";s:9:\"000000000\";s:11:\"non_cash_ks\";s:20:\"00000000000000000000\";s:16:\"non_cash_address\";s:43:\"ул. Центральная д. 13 оф. 5\";s:17:\"non_cash_director\";s:20:\"Иванов И. И.\";s:14:\"non_cash_glbuh\";s:22:\"Петрова П. П.\";s:23:\"non_cash_tax_department\";s:29:\"Налоговый орган\";s:14:\"non_cash_okato\";s:11:\"00000000000\";s:12:\"non_cash_nds\";s:2:\"18\";}')",
    
	"INSERT INTO {shop_payment} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort, payment) VALUES
	(5, ".multilang("'Яндекс.Деньги',", "'Yandex.Money',").multilang("'Яндекс.Деньги широко используются для безопасной оплаты различных услуг и покупки товаров онлайн без комиссий и очередей.',", "'Yandex is widely used to secure payment of various services and purchase goods online without commissions and queues.',").multilang("'1',")."5, 'yandexmoney')",
    
	"INSERT INTO {shop_payment} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort, payment) VALUES
	(6, ".multilang("'QIWI',").multilang("'Оплата мобильной связи, коммунальных услуг, покупок в интернет-магазинах и др. через платежные терминалы, интернет и мобильный телефон.',", "'Payment of mobile communications, utilities, shopping in online stores and other through payment terminals, Internet and mobile phone.',").multilang("'1',")."6, 'qiwi')",
    
	"INSERT INTO {shop_payment} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort, payment) VALUES
	(7, ".multilang("'Liqpay',").multilang("'',").multilang("'1',")."7, 'liqpay')",
    
	"INSERT INTO {shop_payment} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort, payment) VALUES
	(8, ".multilang("'Chronopay',").multilang("'',").multilang("'1',")."8, 'chronopay')",
    
	"INSERT INTO {shop_additional_cost} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort, percent, amount) VALUES
	(1, ".multilang("'Упаковка',", "'Packaging',").multilang("'Мы упаковываем продукцию в твердый картон.',", "'We pack products to hardboard.',").multilang("'1',")."1, 2, 6000)",
    
	"INSERT INTO {shop_additional_cost} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort) VALUES
	(2, ".multilang("'Сертификат',", "'Certificate',").multilang("'Мы упаковываем продукцию в твердый картон.',", "'We will make a copy of the certificate for the products, if you need it',").multilang("'1',")."2)",
    
	"INSERT INTO {shop_additional_cost} (id, ".multilang("nameLANG,").multilang("textLANG,").multilang("actLANG,")."sort, price) VALUES
	(3, ".multilang("'Ремнабор',", "'Repair Kit',").multilang("'Клей, краски, кисточка, ножницы.',", "'Glue, paint brush, scissors.',").multilang("'1',")."3, 500)",
	
	"INSERT INTO {shop_waitlist} (good_id, lang_id, mail, created) VALUES (31, 1,'erema@ochen_zhdu_kita.ru','".time()."')",

	"INSERT INTO {shop_wishlist} (good_id, session_id, created, `count`) VALUES
	('2','6161nnvam6quvpfgdq7v4c7r23','".time()."',1),
	('36','6161nnvam6quvpfgdq7v4c7r23','".time()."','1');",
);

/**
 * Выполняет действия для установки примеров заполнения модуля
 * 
 * @return void
 */
function module_example_shop()
{
	DB::query("UPDATE {shop_waitlist} SET param='%s'", "a:1:{i:10;s:2:\"18\";}");
	DB::query("UPDATE {shop_wishlist} SET param='%s'", "a:1:{i:10;s:2:\"18\";}");
	
	$menu = DB::fetch_array(DB::query("SELECT id, site_id FROM {menu} WHERE module_name='shop' AND module_cat_id=2"));
	DB::query("INSERT INTO {menu} (
		module_name,
		site_id,
		module_cat_id,
		cat_id,
		".multilang("nameLANG, ")."
		".multilang("actLANG, ")."
		sort,
		parent_id
	) VALUES (
		'shop',
		%d,
		4,
		2,
		".multilang("'Крупные',", "'Big',", "'',")."
		".multilang("'1', ")."
		1,
		%d
	)", $menu["site_id"], $menu["id"]);
	$last_id = DB::last_id("menu");
	DB::query("INSERT INTO {menu_parents} (element_id, parent_id) VALUES (%d, %d)", $last_id, $menu["id"]);

	DB::query("INSERT INTO {menu} (
		module_name,
		site_id,
		module_cat_id,
		cat_id,
		".multilang("nameLANG, ")."
		".multilang("actLANG, ")."
		sort,
		parent_id
	) VALUES (
		'shop',
		%d,
		5,
		2,
		".multilang("'Мелкие',", "'Small',", "'',")."
		".multilang("'1', ")."
		2,
		%d
	)", $menu["site_id"], $menu["id"]);
	$last_id = DB::last_id("menu");
	DB::query("INSERT INTO {menu_parents} (element_id, parent_id) VALUES (%d, %d)", $last_id, $menu["id"]);

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/shop'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/shop', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/shop/large'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/shop/large', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/shop/small'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/shop/small', 0777);
	}
	$array = array(
		1  => array(41 => 'korshun'),
		2  => array(42 => 'rybka-karasik'),
		3  => array(43 => 'pelikan'),
		4  => array(44 => 'gus'),
		5  => array(45 => 'caplya'),
		6  => array(46 => 'filin'),
		7  => array(47 => 'sova'),
		8  => array(48 => 'lebed'),
		9  => array(49 => 'utenok'),
		10 => array(50 => 'straus'),
		11 => array(51 => 'golub'),
		12 => array(52 => 'grif'),
		13 => array(53 => 'orel'),
		14 => array(54 => 'kenguru'),
		15 => array(55 => 'olen', 56 => 'olen'),
		16 => array(57 => 'nosorog'),
		17 => array(58 => 'verblyud', 59 => 'verblyud'),
		18 => array(60 => 'medved'),
		19 => array(61 => 'suslik'),
		20 => array(62 => 'belochka'),
		21 => array(63 => 'obezyana'),
		22 => array(64 => 'volk'),
		23 => array(65 => 'zayac'),
		24 => array(66 => 'kot'),
		25 => array(67 => 'dikobraz', 68 => 'dikobraz'),
		26 => array(69 => 'ezhik'),
		27 => array(70 => 'skaj-terer', 71 => 'skaj-terer'),
		28 => array(72 => 'taksa'),
		29 => array(73 => 'mysh'),
		30 => array(74 => 'lyagushka'),
		31 => array(75 => 'bobr'),
		32 => array(76 => 'salamandra'),
		33 => array(77 => 'cherepaxa', 78 => 'cherepaxa'),
		34 => array(79 => 'krokodil'),
		35 => array(80 => 'kit'),
		36 => array(81 => 'slon'),
		37 => array(82 => 'svinya'),
		38 => array(83 => 'lev')
	);

	$module = 'shop';
	foreach ($array as $k => $a)
	{
		foreach ($a as $id => $name)
		{
			$name = $name.'_'.$id.'.jpg';
			DB::query("INSERT INTO {images} (id, name, module_name, element_id, sort) VALUES (%d, '%s', '%s', %d, %d)",
				  $id, $name, $module, $k, $id);

			if (! file_exists(ABSOLUTE_PATH.USERFILES.'/original/'.$name))
			{
				copy(DEMO_PATH.$module.'/'.$name, ABSOLUTE_PATH.USERFILES.'/original/'.$name);
				copy(ABSOLUTE_PATH.USERFILES.'/original/'.$name, ABSOLUTE_PATH.USERFILES.'/'.$module.'/large/'.$name);
				copy(DEMO_PATH.$module.'/small/'.$name, ABSOLUTE_PATH.USERFILES.'/small/'.$name);
				copy(DEMO_PATH.$module.'/medium/'.$name, ABSOLUTE_PATH.USERFILES.'/'.$module.'/small/'.$name);
			}

			chmod(ABSOLUTE_PATH.USERFILES.'/small/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/original/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/'.$module.'/large/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/'.$module.'/small/'.$name, 0777);
		}
	}
	
	DB::query("UPDATE {shop_payment} SET params='%s' WHERE id=4", 'a:14:{s:13:"non_cash_name";s:50:"ООО &quot;Бумажный зоопарк&quot;";s:13:"non_cash_ogrn";s:13:"0000000000000";s:12:"non_cash_inn";s:10:"0000000000";s:12:"non_cash_kpp";s:9:"000000000";s:11:"non_cash_rs";s:20:"00000000000000000000";s:13:"non_cash_bank";s:27:"ООО &quot;Банк&quot;";s:12:"non_cash_bik";s:9:"000000000";s:11:"non_cash_ks";s:20:"00000000000000000000";s:16:"non_cash_address";s:43:"ул. Центральная д. 13 оф. 5";s:17:"non_cash_director";s:20:"Иванов И. И.";s:14:"non_cash_glbuh";s:22:"Петрова П. П.";s:23:"non_cash_tax_department";s:29:"Налоговый орган";s:14:"non_cash_okato";s:11:"00000000000";s:12:"non_cash_nds";s:2:"18";}');
}

/**
 * Удаляет модуль
 * @return void
 */
function module_basic_uninstall_shop()
{
	DB::query("DELETE FROM {rewrite} WHERE rewrite='shop/cart/done'");
	DB::query("DELETE FROM {site} WHERE [name]='Заказ офомлен'");
}