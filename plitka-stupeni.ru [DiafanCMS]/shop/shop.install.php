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
				"This 