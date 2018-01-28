<?php
/**
 * Установка ядра
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(__FILE__)).'/includes/404.php');
}

$db = array(
	"tables" => array(
		array(
			"name" => "adminsite",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT",
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
					"name" => "group_id",
					"type" => "ENUM( '1', '2', '3', '4', '5') NOT NULL DEFAULT '1'",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(100) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "rewrite",
					"type" => "VARCHAR(30) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "numrow",
					"type" => "INT(6) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "docs",
					"type" => "VARCHAR( 255 ) NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY parent_id (parent_id)",
			),
		),
		array(
			"name" => "modules",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(30) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(30) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "site",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "site_page",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "admin",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "title",
					"type" => "VARCHAR( 100 ) NOT NULL DEFAULT ''",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "adminsite_parents",
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
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "site",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
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
					"name" => "name",
					"type" => "VARCHAR(100) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "title",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "title_meta",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
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
					"name" => "text",
					"type" => "longtext NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
				),
				array(
					"name" => "access",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
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
					"name" => "admin_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "title_no_show",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "map_no_show",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
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
					"name" => "noindex",
					"type" => "ENUM('0','1') NOT NULL",
				),
				array(
					"name" => "search_no_show",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "block",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "timeedit",
					"type" => "INT(12) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "theme",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(30) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "js",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "is_menu",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY parent_id (parent_id)",
			),
		),
		array(
			"name" => "site_parents",
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
			"name" => "site_block_rel",
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
					"name" => "site_id",
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
			"name" => "rewrite",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "rewrite",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(8) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
					"name" => "param_id",
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
			"name" => "redirect",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "redirect",
					"type" => "VARCHAR(255) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "code",
					"type" => "SMALLINT( 5 ) UNSIGNED NOT NULL",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(8) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
					"name" => "param_id",
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
			"name" => "menu_category",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(100) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "show_title",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "show_all_level",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "hide_parent_link",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
				),
				array(
					"name" => "access",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "current_link",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "only_image",
					"type" => "ENUM('0','1') NOT NULL",
				),
				array(
					"name" => "menu_template",
					"type" => "varchar(100) NOT NULL",
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
			"name" => "menu",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(100) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR( 13 ) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "site_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "element_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "module_cat_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "cat_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "parent_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count_children",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "othurl",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "access",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
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
					"name" => "sort",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
				),
				array(
					"name" => "trash",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY parent_id (parent_id)",
			),
		),
		array(
			"name" => "menu_category_site_rel",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "element_id",
					"type" => "int(11) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "site_id",
					"type" => "int(11) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "menu_parents",
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
			"name" => "access",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "element_id",
					"type" => "int(11) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "cat_id",
					"type" => "int(11) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "module_name",
					"type" => "varchar(25) NOT NULL",
				),
				array(
					"name" => "role_id",
					"type" => "int(3) unsigned NOT NULL DEFAULT '0'",
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
			"name" => "users",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "varchar(60) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "password",
					"type" => "varchar(32) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "mail",
					"type" => "varchar(64) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "created",
					"type" => "int(12) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "fio",
					"type" => "varchar(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "role_id",
					"type" => "int(11) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "act",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "htmleditor",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "lang_id",
					"type" => "tinyint(2) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "background",
					"type" => "varchar(255) NOT NULL DEFAULT 'metall.jpg'",
				),
				array(
					"name" => "admin_nastr",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL",
				),
				array(
					"name" => "identity",
					"type" => "varchar(255) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "trash",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY `name` (`name`(1))",
			),
		),
		array(
			"name" => "users_role",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(64) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "registration",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "only_self",
					"type" => " ENUM('0', '1') NOT NULL DEFAULT '0'",
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
			"name" => "users_role_perm",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "role_id",
					"type" => "SMALLINT(5) unsigned NOT NULL",
				),
				array(
					"name" => "perm",
					"type" => "text CHARACTER SET utf8 NOT NULL",
				),
				array(
					"name" => "rewrite",
					"type" => "text CHARACTER SET utf8 NOT NULL",
				),
				array(
					"name" => "type",
					"type" => "enum('site','admin') CHARACTER SET utf8 NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "users_param",
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
					"type" => "text NOT NULL",
					"multilang" => true,
				),
				array(
					"name" => "type",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "show_in_page",
					"type" => "ENUM( '0', '1' ) NOT NULL",
				),
				array(
					"name" => "show_in_form_auth",
					"type" => "ENUM( '0', '1' ) NOT NULL",
				),
				array(
					"name" => "show_in_form_no_auth",
					"type" => "ENUM( '0', '1' ) NOT NULL",
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
			"name" => "users_param_element",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "value",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "param_id",
					"type" => "int(11) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "element_id",
					"type" => "int(11) unsigned NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "users_param_select",
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
			"name" => "users_param_role_rel",
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
					"name" => "role_id",
					"type" => "TINYINT(3) UNSIGNED NOT NULL DEFAULT '0'",
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
			"name" => "sessions",
			"fields" => array(
				array(
					"name" => "user_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "session_id",
					"type" => "VARCHAR(64) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "hostname",
					"type" => "VARCHAR(128) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "user_agent",
					"type" => "VARCHAR(255) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "timestamp",
					"type" => "VARCHAR(20) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "session",
					"type" => "text NOT NULL DEFAULT ''",
				),
			),
			"keys" => array(
				"PRIMARY KEY (session_id)",
				"KEY user_id (user_id)",
			),
		),
		array(
			"name" => "sessions_hash",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "user_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "hash",
					"type" => "CHAR( 32 ) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "created",
					"type" => "INT(12) UNSIGNED NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "log",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "ip",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '1'",
				),
				array(
					"name" => "info",
					"type" => "text NOT NULL DEFAULT ''",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY ip (ip(4))",
			),
		),
		array(
			"name" => "log_note",
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
					"name" => "note",
					"type" => "INT(7) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "ip",
					"type" => "VARCHAR(62) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "session_id",
					"type" => "VARCHAR(64) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "include_name",
					"type" => "VARCHAR(10) NOT NULL DEFAULT ''",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY element_id (element_id)",
				"KEY session_id (session_id(2))",
				"KEY include_name (include_name(2))",
				"KEY module_name (module_name(2))",
			),
		),
		array(
			"name" => "config",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(12) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "name",
					"type" => "varchar(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "lang_id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "value",
					"type" => "TEXT NOT NULL DEFAULT ''",
				),
				array(
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "languages",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(100) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "shortname",
					"type" => "VARCHAR(10) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "base_admin",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "base_site",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "languages_translate",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "text",
					"type" => "TEXT NOT NULL DEFAULT ''",
				),
				array(
					"name" => "text_translate",
					"type" => "TEXT NOT NULL DEFAULT ''",
				),
				array(
					"name" => "lang_id",
					"type" => "TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "type",
					"type" => "ENUM('admin', 'site') NOT NULL DEFAULT 'admin'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "trash",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "table_name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(13) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
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
					"name" => "user_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY module_name (module_name(2))",
				"KEY parent_id (parent_id)",
				"KEY table_name (table_name(2))",
				"KEY element_id (element_id)",
			),
		),
		array(
			"name" => "trash_parents",
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
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "images",
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
					"name" => "module_name",
					"type" => "VARCHAR(10) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "alt",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "title",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "param_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "size",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "tmpcode",
					"type" => "VARCHAR(32) NOT NULL DEFAULT ''",
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
				"KEY module_name (module_name(2))",
				"KEY element_id (element_id)",
			),
		),
		array(
			"name" => "images_variations",
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
					"name" => "folder",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "quality",
					"type" => "TINYINT( 2 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "param",
					"type" => "TEXT NOT NULL DEFAULT ''",
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
			"name" => "images_editor_folders",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "parent_id",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "attachments",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
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
					"name" => "param_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "extension",
					"type" => "VARCHAR(255) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "size",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "is_image",
					"type" => "ENUM('0','1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "access_admin",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY `element_id` (`element_id`)",
				"KEY `module_name` (`module_name`(2))",
			),
		),
		array(
			"name" => "update",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "TINYINT( 3 ) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "user_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "name",
					"type" => "TEXT NOT NULL DEFAULT ''",
				),
				array(
					"name" => "text",
					"type" => "TEXT NOT NULL DEFAULT ''",
				),
				array(
					"name" => "created",
					"type" => "INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "adminsite",
			"module_name" => "core",
			"admin" => true,
			"title" => "Страницы админки",
		),
		array(
			"name" => "attachments",
			"module_name" => "core",
			"admin" => true,
			"site" => true,
			"title" => "Прикрепленные файлы",
		),
		array(
			"name" => "bbcode",
			"module_name" => "core",
			"site" => true,
			"title" => "Bbcode",
		),
		array(
			"name" => "captcha",
			"module_name" => "core",
			"site" => true,
			"title" => "Защитный код",
		),
		array(
			"name" => "config",
			"module_name" => "core",
			"admin" => true,
			"title" => "Параметры сайта",
		),
		array(
			"name" => "images",
			"module_name" => "core",
			"admin" => true,
			"site" => true,
			"title" => "Изображения",
		),
		array(
			"name" => "languages",
			"module_name" => "core",
			"admin" => true,
			"site" => true,
			"title" => "Языки сайта",
		),
		array(
			"name" => "menu",
			"module_name" => "core",
			"admin" => true,
			"site" => true,
			"title" => "Меню",
		),
		array(
			"name" => "paginator",
			"module_name" => "core",
			"admin" => true,
			"site" => true,
			"title" => "Постраничная навигация",
		),
		array(
			"name" => "site",
			"module_name" => "core",
			"admin" => true,
			"site" => true,
			"title" => "Страницы сайта",
		),
		array(
			"name" => "trash",
			"module_name" => "core",
			"admin" => true,
			"title" => "Корзина",
		),
		array(
			"name" => "update",
			"module_name" => "core",
			"admin" => true,
			"title" => "Обновление",
		),
		array(
			"name" => "useradmin",
			"module_name" => "core",
			"admin" => true,
			"site" => true,
			"title" => "Редактирование из пользовательской части",
		),
	),
	"adminsites" => array(
		array(
			"name" => "Страницы сайта",
			"rewrite" => "site",
			"group_id" => "1",
			"sort" => "1",
			"act" => true,
			"children" => array(
				array(
					"name" => "Настройки",
					"rewrite" => "site/config",
					"sort" => "2",
					"act" => true,
				),
			)
		),
		array(
			"name" => "Меню на сайте",
			"rewrite" => "menu",
			"group_id" => "1",
			"sort" => "2",
			"act" => true,
			"children" => array(
				array(
					"name" => "Пункты меню",
					"rewrite" => "menu",
					"sort" => "66",
					"act" => true,
				),
				array(
					"name" => "Меню",
					"rewrite" => "menu/category",
					"sort" => "67",
					"act" => true,
				),
				array(
					"name" => "Настройка",
					"rewrite" => "menu/config",
					"sort" => "68",
					"act" => true,
				),
			)
		),
		array(
			"name" => "Страницы админки",
			"rewrite" => "adminsite",
			"group_id" => "1",
			"sort" => "27",
			"act" => false,
		),
		array(
			"name" => "Пользователи сайта",
			"rewrite" => "users",
			"group_id" => "2",
			"sort" => "1",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/polzovateli/",
			"children" => array(
				array(
					"name" => "Пользователи",
					"rewrite" => "users",
					"sort" => "42",
					"act" => true,
				),
				array(
					"name" => "Права доступа",
					"rewrite" => "users/role",
					"sort" => "43",
					"act" => true,
				),
				array(
					"name" => "Конструктор формы регистрации",
					"rewrite" => "users/param",
					"sort" => "73",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "users/config",
					"sort" => "74",
					"act" => true,
				),
			)
		),
		array(
			"name" => "Параметры сайта",
			"rewrite" => "config",
			"group_id" => "5",
			"sort" => "1",
			"act" => true,
		),
		array(
			"name" => "Обработка изображений",
			"rewrite" => "images",
			"group_id" => "5",
			"sort" => "3",
			"act" => true,
		),
		array(
			"name" => "Языки сайта",
			"rewrite" => "languages",
			"group_id" => "5",
			"sort" => "4",
			"act" => true,
			"children" => array(
				array(
					"name" => "Языки сайта",
					"rewrite" => "languages",
					"sort" => "1",
					"act" => true,
				),
				array(
					"name" => "Перевод интерфейса",
					"rewrite" => "languages/translate",
					"sort" => "2",
					"act" => true,
				),
			)
		),
		array(
			"name" => "Корзина",
			"rewrite" => "trash",
			"group_id" => "5",
			"sort" => "5",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/korzina/",
		),
		array(
			"name" => "Обновление CMS",
			"rewrite" => "update",
			"group_id" => "3",
			"sort" => "4",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/obnovleniya/",
			"children" => array(
				array(
					"name" => "Автообновление",
					"rewrite" => "update",
					"sort" => "47",
					"act" => true,
				),
				array(
					"name" => "Список закрытых для обновления файлов",
					"rewrite" => "update/list",
					"sort" => "53",
					"act" => true,
				),
			)
		),
		array(
			"name" => "Модули и БД",
			"rewrite" => "update/install",
			"group_id" => "5",
			"sort" => "2",
			"act" => true,
			"children" => array(
				array(
					"name" => "Установка модулей",
					"rewrite" => "update/install",
					"sort" => "48",
					"act" => true,
				),
				array(
					"name" => "Восстановление БД",
					"rewrite" => "update/repair",
					"sort" => "54",
					"act" => true,
				),
				array(
					"name" => "Экспорт/импорт БД",
					"rewrite" => "update/importexport",
					"sort" => "55",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "trial",
			"module_name" => "core",
			"value" => "".(time() + 86400 * 20)."",
		),
		array(
			"name" => "use_animation",
			"module_name" => "site",
			"value" => "1",
		),
		array(
			"name" => "method",
			"module_name" => "route",
			"value" => "1",
		),
		array(
			"name" => "translit_array",
			"module_name" => "route",
			"value" => " |а|б|в|г|д|е|ё|ж|з|и|й|к|л|м|н|о|п|р|с|т|у|ф|х|ц|ч|ш|щ|ы|э|ю|я|А|Б|В|Г|Д|Е|Ё|Ж|З|И|Й|К|Л|М|Н|О|П|Р|С|Т|У|Ф|Х|Ц|Ч|Ш|Щ|Ы|Э|Ю|Я````-|a|b|v|g|d|e|yo|zh|z|i|y|k|l|m|n|o|p|r|s|t|u|f|kh|ts|ch|sh|sch|y|e|yu|ya|A|B|V|G|D|E|YO|ZH|Z|I|Y|K|L|M|N|O|P|R|S|T|U|F|KH|TS|CH|SH|SCH|Y|E|YU|YA",
		),
		array(
			"name" => "images_variations",
			"module_name" => "site",
			"value" => serialize(array(0 => array('name' => 'medium', 'id' => 1), 1 => array('name' => 'large', 'id' => 3))),
		),
		array(
			"name" => "images_variations",
			"module_name" => "editor",
			"value" => serialize(array(0 => array('id' => 2), 1 => array('id' => 3))),
		),
	),
	"sql" => array(
		"INSERT INTO {site} (id, ".multilang("nameLANG,")." title_meta1, ".multilang("textLANG,")." ".multilang("actLANG,")." sort, timeedit, title_no_show) VALUES (
			1,
			".multilang("'Главная страница',", "'Home',", "'',")."
			'".TIT1."',
			".multilang("'<p><strong>Добро пожаловать на наш новый сайт!</strong></p>
		<p>Здесь можно найти много чего интересного:</p>
		<ul>
		<li>каталог товаров (интернет-магазин)</li>
		<li>вопрос-ответ</li>
		<li>новости</li>
		<li>файловый архив</li>
		<li>фотогалерея</li>
		</ul>
		<p>и много-многое другое!</p>',", "'<p><strong>Welcome to our new site!</strong></p>
		<p>Here you can find more-more nice informations:</p>
		<ul>
		<li>catalog of goods (e-shop)</li>
		<li>FAQ</li>
		<li>news</li>
		<li>files</li>
		<li>photos</li>
		</ul>
		<p>and more-more else!</p>',")."
			".multilang("'1',")."
			1,
			".time().",
			'1'
		);",
		
		"INSERT INTO {rewrite} (id, rewrite, module_name, site_id) VALUES (1, '', 'site', 1)",
		
		"INSERT INTO {menu_category} (id, show_all_level, name1".multilang(", actLANG").", current_link) VALUES (1, '1', 'Меню верхнее'".multilang(", '1'").", '1')",
		
		"INSERT INTO {menu_category} (id, name1".multilang(", actLANG").") VALUES (2, 'Меню каталог товаров'".multilang(", '1'").")",
		
		"INSERT INTO {menu_category} (id, name1".multilang(", actLANG").") VALUES (3, 'Меню слева'".multilang(", '1'").")",
		    
		
		"INSERT INTO {users_role} (id, name1, registration) VALUES (1, 'Пользователь', '1');",
		
		"INSERT INTO {users_role} (id, name1) VALUES (2, 'Модератор');",
		
		"INSERT INTO {users_role} (id, name1) VALUES (3, 'Администратор');",
		    
		    
		"INSERT INTO {users_role_perm} (rewrite, perm, role_id, type) VALUES ('all', 'all', 3, 'admin');",
			
		"INSERT INTO {users_role_perm} (rewrite, perm, role_id, type) VALUES ('useradmin', 'edit', 3, 'site');",
			
		"INSERT INTO {users_role_perm} (rewrite, perm, role_id, type) VALUES ('forum', 'moderator', 3, 'site');",

		"INSERT INTO {languages} (id, name, shortname, base_site, base_admin) VALUES (1, 'ru', 'ru', '1', '1');",   
	),
);

if (! empty($_POST["lang_yes"]))
{
	$db["sql"][] = "INSERT INTO {languages} (id, name, shortname) VALUES (2, 'eng', 'eng');";
}
global $name_admin, $pass_admin, $fio_admin;
if (! empty($name_admin))
{
	$db["sql"][] = "INSERT INTO {users} (id, name, password, mail, created, fio, role_id, act, htmleditor) VALUES (
		1,
		'".$name_admin."',
		'".encrypt($pass_admin)."',
		'".EMAIL_CONFIG."',
		'".time()."',
		'".$fio_admin."',
		3,
		'1',
		'1'
	);";
}

$example = array(
"UPDATE {site} SET
	".multilang(
	"textLANG='<p>Наш зоопарк находится на территории бывшего зверепарка, который был основан Михаил Потапычем, бумажным медведем-предпринимателем. Сегодня у нас несколько десятков видов бумажных животных!</p>\r\n<p>Приходите к нам, мы работаем ежедневно:<br />\r\nЗоопарк: c 09:00 до 20:00<br />\r\nВыставка бумажного крупного рогатого скота с 11:00 до 19:00<br />\r\nВыставка бумажных птиц с 12:00 до 18:00<br />\r\nКассы закрываются на час раньше.</p>\r\n<insert often=\"1\" count=\"3\" module=\"faq\" name=\"show_block\"></insert>\r\n<h2>Наш опрос</h2>\r\n<insert name=\"show_block\" module=\"votes\"></insert>\r\n<p><insert count=\"3\" sort=\"price\" module=\"shop\" name=\"show_block\" images=\"1\"></insert></p>'",
	
	", textLANG='<p>Our zoo is in territory former park which has been based Michael Potapych, a paper bear-businessman. Today at us it is some tens kinds of paper animals!</p><p>Come to us, we work daily: <br />Zoopark: from 09:00 till 20:00 <br />Vystavka a paper horned cattle from 11:00 till 19:00 <br />Vystavka paper birds from 12:00 till 18:00<br />Pay-box is closed on an hour earlier.</p><p><insert name=\"show_block\" module=\"faq\" count=\"3\" often=\"1\"></insert></p><p><insert name=\"show_block\" module=\"votes\"></insert></p><h2>The Best offers from shop</h2><p><insert name=\"show_block\" module=\"shop\" sort=\"price\" count=\"3\" images=\"1\"></insert></p>'",
	
	"")."
	WHERE id=1",

"INSERT INTO {site} (id,
	".multilang("nameLANG,")."
	".multilang("textLANG,")."
	".multilang("actLANG,")."
	sort, timeedit, count_children) VALUES (
	2,
	".multilang("'О нас',", "'About us',")."
	".multilang(
	"'<p><strong>Бумажный зоопарк</strong><br />\r\n<br />\r\n<em><strong>Основан</strong></em>:&nbsp;давно<br />\r\n<br />\r\n<em><strong>Обитатели:&nbsp;</strong></em>бумажные животные<br />\r\n<br />\r\n<em><strong>Руководитель:&nbsp;</strong></em>Директор<br />\r\n<br />\r\n<em><strong>Служащие:</strong></em></p>\r\n<p><strong>Егорыч</strong> - главный врач по склеиванию бумажных зверят<br />\r\n<br />\r\n<strong>Клавдия Никитишна</strong> - завхоз по бумажным вопросам<br />\r\n<br />\r\n<strong>Еремил</strong> - смотрящий за мелкими животными<br />\r\n<br />\r\n<strong>Бартоломей</strong> - главный идеолог<br />\r\n<br />\r\n<strong>Симка,&nbsp;Фимка,&nbsp;Глашка,&nbsp;Думка</strong> - разнорабочие</p>',",
	
	"'<p><strong>Paper zoo</strong></p><p><em><strong>It is based:</strong></em> for a long time</p><p><strong><em>Inhabitants: </em></strong>paper animals</p><p><strong><em>The head:</em></strong> the director</p><p><em><strong>Employees:</strong></em></p><p><strong>Egorych</strong> - the head physician on pasting of paper animals</p><p><strong>Claudia Nikitishna</strong> - the supply manager on paper questions</p><p><strong>Ermil</strong> - looking for small animals</p><p><strong>Barmoley</strong> - the main ideologist</p><p><strong>Simca, Fimka, Glashka, Dumka</strong> - handymens</p>',"
	)."
	".multilang("'1',")."
	2,
	'".time()."',
	3
)",

"INSERT INTO {rewrite} (id, rewrite, module_name, element_id, site_id, cat_id, trash) VALUES (2, 'about-us', 'site', 0, 2, 0, '0')",

"DELETE FROM {menu} WHERE id=2",

"INSERT INTO {menu} (
	id,
	module_name,
	site_id,
	cat_id,
	".multilang("nameLANG, ")."
	".multilang("actLANG, ")."
	count_children,
	sort
) VALUES (
	2,
	'site',
	2,
	'1',
	".multilang("'О нас',", "'About us',")."
	".multilang("'1', ")."
	3,
	2
)",

"INSERT INTO {site} (id,
	".multilang("nameLANG,")."
	".multilang("textLANG,")."
	".multilang("actLANG,")."
	sort, timeedit) VALUES (
	16,
	".multilang("'Контакты',", "'Contacts',")."
	".multilang(
	"'<p>Найти наш зоопарк очень просто. Возьмите лист бумаги,&nbsp;порвите его на тоненькие полосочки,&nbsp;склейте их,&nbsp;смотайте в клубок и положите клубок на землю. Разматываясь самостоятельно,&nbsp;он приведет вас прямо к воротам нашего зоопарка.<br />\r\n<br />\r\nЕсли вы захотите позвонить нам. Возьмите лист бумаги,&nbsp;нарисуйте на ней телефон,&nbsp;вырежьте его и снимите трубку. Все мы на связи.</p>\r\n<p>Если хотите отправить нам факс. Возьмите лист бумаги,&nbsp;напишите сообщение,&nbsp;сделайте из листа самолет и пустите его в окно. Через некоторое время мы получим ваше соощение.</p>\r\n<p>Приходите в бумажный зоопарк!</p>',",
	
	"'<p>To find our zoo very simply. Take a sheet of paper, tear it on thin streaks, stick together them, wind in a ball and put a ball on the earth. Being unwound independently, it will lead you directly to collars of our zoo.</p><p>If you want to call us. Take a sheet of paper, draw on it phone, cut out it and lift the receiver. We are on communication.</p><p>If wish to send us a fax. Take a sheet of paper, write the message, make of sheet the plane and start up it in a window. After a while we will receive yours message.</p><p>Come to a paper zoo!</p>',"
	)."
	".multilang("'1',")."
	16,
	'".time()."'
)",

"INSERT INTO {rewrite} (id, rewrite, module_name, element_id, site_id, cat_id, trash) VALUES (16, 'contacts', 'site', 0, 16, 0, '0')",

"INSERT INTO {menu} (
	id,
	module_name,
	site_id,
	cat_id,
	".multilang("nameLANG, ")."
	".multilang("actLANG, ")."
	sort
) VALUES (
	16,
	'site',
	16,
	'1',
	".multilang("'Контакты',", "'Contacts',")."
	".multilang("'1', ")."
	16
)",

"INSERT INTO {site} (id,
	".multilang("nameLANG,")."
	".multilang("textLANG,")."
	".multilang("actLANG,")."
	sort, timeedit, parent_id) VALUES (
	18,
	".multilang("'Животные',", "'Animals',")."
	".multilang(
	"'<p>Разрешите представить самых ярких обитателей нашего зоопарка:</p>\r\n<p>Орел Егорка - первый питомец, появившийся в нашем зоопарке. Назван в честь нашего директора,&nbsp;самого поразительного человека на земле. Орел любит летать,&nbsp;кушать бумагу (предпочитает тетради в линеечку) и забавляет всех своими рассказами о мире (как он его видит).</p>\r\n<p>Суслик Гумпик - самый забавный из сусликов. Он любит тяжелый рок,&nbsp;посещает все концерты групп нашего города,&nbsp;часто сидит в интернете,&nbsp;черпая оттуда байки,&nbsp;которые с успехом рассказывает всем посетителям зоопарка.</p>\r\n<p>Крокодил Генадий - герой наших анекдотов и былей. Генадий ярый сторонник позитива в этой жизни,&nbsp;поэтому он частенько перекрашивает себя из зеленого в разные цвета. Сложились приметы:&nbsp;если Генадий покрашен в синий цвет - быть скандалу в зоопарке,&nbsp;если в черный - пора вызывать пожарных,&nbsp;если в красный - намечается революция.</p>\r\n<p>Страус Ахмед - получил свое имя при загадочных обстоятельствах. Проснувшись как то утром, все увидели на страусе выбритую надпись:&nbsp;Здесь был Ахмед. С тех пор его так и зовут.</p>',",
	
	"'<p>Allow to present the brightest inhabitants of our zoo:<br /><br />Eagle of Egorka - the first pupil who has appeared in our zoo. It is named in honour of our director, the most amazing person on the earth. The eagle likes to fly, eat a paper (prefers writing-books in линеечку) and amuses all with the stories about the world (as he it sees).<br /><br />Gopher of Gumpik - most amusing of gophers. He loves a heavy rock, visits all concerts of groups of our city, often sits on the Internet, scooping therefrom байки which with success tells to all visitors of a zoo.<br /><br />Crocodile of Genady - the hero of our jokes and былей. Генадий the ardent supporter of a positive in this life, therefore it quite often recolours itself(himself) from green in different colours. There were signs: if Genady is painted dark blue colour - to be to scandal in a zoo if in black - it is time to cause firemen if in red - revolution is planned.<br /><br />The ostrich Ahmed - has received the name under mysterious circumstances. Having woken up as that in the morning, all have seen the shaved inscription on an ostrich: Here there was Ahmed. Since then him and call.</p>',"
	)."
	".multilang("'1',")."
	18,
	'".time()."',
	2
)",

"INSERT INTO {site_parents} (`element_id`, `parent_id`) VALUES (18, 2)",

"INSERT INTO {rewrite} (id, rewrite, module_name, element_id, site_id, cat_id, trash) VALUES (18, 'about-us/animals', 'site', 0, 18, 0, '0')",

"INSERT INTO {menu} (
	id,
	module_name,
	site_id,
	cat_id,
	parent_id,
	".multilang("nameLANG, ")."
	".multilang("actLANG, ")."
	sort
) VALUES (
	18,
	'site',
	18,
	1,
	2,
	".multilang("'Животные',", "'Animals',")."
	".multilang("'1', ")."
	18
)",

"INSERT INTO {menu_parents} (`element_id`, `parent_id`) VALUES (18, 2)",

"INSERT INTO {site} (id,
	".multilang("nameLANG,")."
	".multilang("textLANG,")."
	".multilang("actLANG,")."
	sort, timeedit, parent_id) VALUES (
	19,
	".multilang("'Миссия',", "'Mission',")."
	".multilang(
	"'<p>Наша Миссия - нести добро в сердце каждого. Когда вам грустно,&nbsp;когда кажется что что-то пошло не так,&nbsp;когда вы веселитесь,&nbsp;когда хотите дарить добро и счастье посещайте наш зоопарк и делитесь своими настроениями. Благодаря позитиву в нашем зоопарке складывается аура,&nbsp;способствующая росту обитателей и зоопитомцев.<br />\r\n<br />\r\nЕсли каждый наш посетитель расскажет о нашей идее,&nbsp;то в мире будет больше интересного. Присоединяйтесь к нам!!!</p>',",
	
	"'<p>Our mission - to bear good in heart of everyone. When to you it is sad, when something seems that tritely not so when you have fun when wish to give good and happiness visit our zoo and share the moods. Thanks to a positive in our zoo there is an aura promoting growth of inhabitants and zoopupils.<br /><br />If each our visitor tells about our idea in the world will be more interesting. Join us!!!</p>',"
	)."
	".multilang("'1',")."
	19,
	'".time()."',
	2
)",

"INSERT INTO {site_parents} (`element_id`, `parent_id`) VALUES (19, 2)",

"INSERT INTO {rewrite} (id, rewrite, module_name, element_id, site_id, cat_id, trash) VALUES (19, 'about-us/mission', 'site', 0, 19, 0, '0')",

"INSERT INTO {menu} (
	id,
	module_name,
	site_id,
	cat_id,
	parent_id,
	".multilang("nameLANG, ")."
	".multilang("actLANG, ")."
	sort
) VALUES (
	19,
	'site',
	19,
	1,
	2,
	".multilang("'Миссия',", "'Mission',")."
	".multilang("'1', ")."
	19
)",

"INSERT INTO {menu_parents} (`element_id`, `parent_id`) VALUES (19, 2)",

"INSERT INTO {site} (id,
	".multilang("nameLANG,")."
	".multilang("textLANG,")."
	".multilang("actLANG,")."
	sort, timeedit, parent_id) VALUES (
	20,
	".multilang("'История',", "'History',")."
	".multilang(
	"'<p>Идея создания Бумажного зоопарка пришла,&nbsp;как и все гениальное в этом мире,&nbsp;случайно. Наш директор Егор Петрович,&nbsp;тогда еще просто Егорка,&nbsp;сидя на крыльце своего дома что-то вырезал из бумаги. В итоге получилась птичка. От дуновения легкого ветерка,&nbsp;того ветерка,&nbsp;который чуть дотрагивается до кожи,&nbsp;оставляя приятный прохладный след&nbsp;и тут же исчезает в пучине жестокой реальности нашего бытия,&nbsp;птичка,&nbsp;казалось,&nbsp;взмыла в воздух и полетела,&nbsp;как настоящая живая гордая птица. Этот момент и является минутой рождения нашего зоопарка.<br />\r\n<br />\r\nЧерез месяц животных было уже столько,&nbsp;что обычная коробка из-под конфет,&nbsp;которые так любил Егор Петрович,&nbsp;не могла вмещать новые экземпляры животного мира. Нужно было расширять свое дело,&nbsp;и Наш Зоопарк переехал в центральный парк,&nbsp;тогда это была просто неогороженная территория за последними домами нашего города. <br />\r\n<br />\r\nШтат сотрудников начал расти,&nbsp;потому что очень многие хотели внести свою лепту в развитие столь чудесного направления человеческой активности. <br />\r\n<br />\r\nПосле случая кражи бесценных экземляров животных,&nbsp;у нас в штате появился сторож,&nbsp;который отлично знает все повадки животных и всегда стоит на страже,&nbsp;готовясь отразить любую атаку извне.<br />\r\n<br />\r\nСегодня наш Зоопарк настолько велик и популярен,&nbsp;что люди занимают очередь,&nbsp;чтобы попасть внутрь задолго до открытия. И главное:&nbsp;в нашем зоопарке запрещен огонь. Огонь - это самое большое зло для наших питомцев.<br />\r\n<br />\r\nМы всегда рады посетителям. Приходите!!!</p>',",
	
	"'<p>The idea of creation of the Paper zoo has come, as well as all ingenious in this world, casually. Our director Egor Petrovich, then Egorka, sitting on a porch of the house something cut out from a paper. The birdie as a result has turned out. From whiff of the easy breeze, that breeze which hardly touches a skin, leaving a pleasant cool trace and there and then disappears in abyss of a severe reality of our life, the birdie, appear, has soared up in air and has departed, as the present live proud bird. This moment also is minute of a birth of our zoo.</p>
    <p>In a month of animals was already so many that the usual box from under sweets which so were loved by Egor Petrovich, could not contain new copies of fauna. It was necessary to expand the business, and Our Zoo has moved to the central park then it there was simply unenclosed territory behind last houses of our city.</p><p>The staff has started to grow, because very many wished to bring the mite in development of so wonderful direction of human activity.</p><p>After a case of theft invaluable exemplar of animals, we in staff had a watchman who perfectly knows all habits of animals and always is on guard, going to reflect any attack from the outside.</p><p>Today our Zoo is so great and popular that people occupy turn to get inside long before opening. And the main thing: in our zoo fire is forbidden. Fire is the biggest harm for our pupils.</p><p>We are always glad to visitors. Come!!!</p>',"
	)."
	".multilang("'1',")."
	20,
	'".time()."',
	2
)",

"INSERT INTO {rewrite} (id, rewrite, module_name, element_id, site_id, cat_id, trash) VALUES (20, 'about-us/history', 'site', 0, 20, 0, '0')",

"INSERT INTO {site_parents} (`element_id`, `parent_id`) VALUES (20, 2)",

"INSERT INTO {menu} (
	id,
	module_name,
	site_id,
	cat_id,
	parent_id,
	".multilang("nameLANG, ")."
	".multilang("actLANG, ")."
	sort
) VALUES (
	20,
	'site',
	20,
	1,
	2,
	".multilang("'История',", "'History',")."
	".multilang("'1', ")."
	20
)",

"INSERT INTO {menu_parents} (`element_id`, `parent_id`) VALUES (20, 2)"
);

function module_basic_core()
{
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/images'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/images', 0777);
	}
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/ufiles'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/ufiles', 0777);
	}
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/users'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/users', 0777);
	}
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/original'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/original', 0777);
	}
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/small'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/small', 0777);
	}

	$text = 'Options -Indexes

<files *>
deny from all
</files>';

	$fp = fopen(ABSOLUTE_PATH.USERFILES.'/original/.htaccess', "w");
	fwrite($fp, $text);
	fclose($fp);
	
	DB::query("INSERT INTO {images_variations} (id, name, folder, param, quality) VALUES (1, 'Маленькое изображение (превью)', 'small', '%s', '90')", serialize(array(0 => array('name' => 'resize', 'width' => 150, 'height' => 150, 'max' => 0))));
	
	DB::query("INSERT INTO {images_variations} (id, name, folder, param, quality) VALUES (2, 'Среднее изображение', 'medium', '%s', '90')", serialize(array(0 => array('name' => 'resize', 'width' => 300, 'height' => 300, 'max' => 0))));
	
	DB::query("INSERT INTO {images_variations} (id, name, folder, param, quality) VALUES (3, 'Большое изображение (полная версия)', 'large', '%s', '90')", serialize(array(0 => array('name' => 'resize', 'width' => 1200, 'height' => 1200, 'max' => 0))));
}