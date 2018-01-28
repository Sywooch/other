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
 * Subscribtion_install
 *
 * Установка модуля "Рассылка"
 */

$title = "Рассылки";
$db = array(
	"tables" => array(
		array(
			"name" => "subscribtion",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "send",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
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
			"name" => "subscribtion_category",
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
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
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
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY parent_id (`parent_id`)",
			),
		),
		array(
			"name" => "subscribtion_category_parents",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT",
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
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "subscribtion_category_rel",
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
			"name" => "subscribtion_emails",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "created",
					"type" => "int(12) unsigned NOT NULL",
				),
				array(
					"name" => "mail",
					"type" => "varchar(64) NOT NULL",
				),
				array(
					"name" => "code",
					"type" => "varchar(32) NOT NULL",
				),
				array(
					"name" => "act",
					"type" => "enum('0','1') NOT NULL DEFAULT '0'",
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
			"name" => "subscribtion_emails_cat_unrel",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "element_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "cat_id",
					"type" => "int(11) unsigned NOT NULL",
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
			"name" => "subscribtion_phones",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "created",
					"type" => "int(12) unsigned NOT NULL",
				),
				array(
					"name" => "phone",
					"type" => "varchar(64) NOT NULL",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
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
			"name" => "subscribtion_sms",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "send",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "text",
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
	),
	"modules" => array(
		array(
			"name" => "subscribtion",
			"module_name" => "subscribtion",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Рассылки",
			"rewrite" => "subscribtion",
			"group_id" => "2",
			"sort" => "6",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/rassylki/",
			"children" => array(
				array(
					"name" => "Рассылки",
					"rewrite" => "subscribtion",
					"sort" => "25",
					"act" => true,
				),
				array(
					"name" => "Категории",
					"rewrite" => "subscribtion/category",
					"sort" => "26",
					"act" => true,
				),
				array(
					"name" => "Подписчики",
					"rewrite" => "subscribtion/emails",
					"sort" => "27",
					"act" => true,
				),
				array(
					"name" => "SMS-рассылки",
					"rewrite" => "subscribtion/sms",
					"sort" => "28",
					"act" => true,
				),
				array(
					"name" => "Номера телефонов",
					"rewrite" => "subscribtion/phones",
					"sort" => "29",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "subscribtion/config",
					"sort" => "30",
					"act" => true,
				),
			)
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Subscribtion'),
			"act" => true,
			"sort" => 26,
			"module_name" => "subscribtion",
			"rewrite" => "subscribtion",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
		),
	),
	"config" => array(
		array(
			"name" => "subject",
			"value" => array(
				"Рассылка сайта %title (%url). %subject",
				"Subscription of web site %title (%url). %subject",
			),
		),
		array(
			"name" => "add_mail",
			"value" => "E-mail успешно добавлен. Вам отправлено уведомление.",
		),
		array(
			"name" => "subject_user",
			"value" => "Подписка на рассылку с  сайта %title (%url)",
		),
		array(
			"name" => "message_user",
			"value" => "Здравствуйте! Вы подписались на рассылку с сайта %title (%url).<br>
Для изменения списка категорий рассылок пройдите по ссылке %link.<br>
Если Вы хотите отписаться от рассылки, пройдите по ссылке %actlink.",
		),
	),
);

$example = array(	
	"INSERT INTO {config} (`module_name`, `name`, `value`) VALUES ('subscribtion', 'cat', '1')",

	"INSERT INTO {subscribtion_category} (id, ".multilang("nameLANG,")." act, sort) VALUES (
		1,
		".multilang("'Новости сайта',", "'News of site',", "'',")."
		'1',
		1
	);",

	"INSERT INTO {subscribtion_category} (id, ".multilang("nameLANG,")." act, sort) VALUES (
		2,
		".multilang("'Новые поступления',", "'New goods',", "'',")."
		'1',
		2
	);",

	"INSERT INTO {subscribtion_category} (id, ".multilang("nameLANG,")." act, sort, count_children) VALUES (
		3,
		".multilang("'для СМИ',", "'For mass medium',", "'',")."
		'1',
		3,
		2
	);",

	"INSERT INTO {subscribtion_category} (id, ".multilang("nameLANG,")." act, sort, parent_id) VALUES (
		4,
		".multilang("'Газеты',", "'Newspapers',", "'',")."
		'1',
		4,
		3
	);",

	"INSERT INTO {subscribtion_category_parents} (`element_id`, `parent_id`) VALUES (4, 3)",

	"INSERT INTO {subscribtion_category} (id, ".multilang("nameLANG,")." act, sort, parent_id) VALUES (
		5,
		".multilang("'ТВ',", "'TV',", "'',")."
		'1',
		5,
		3
	);",

	"INSERT INTO {subscribtion_category_parents} (`element_id`, `parent_id`) VALUES (5, 3)",
	
	"INSERT INTO {subscribtion} (id, created, cat_id, name, text) VALUES
	('1','".(time()-86400)."',1,'Сезон скидок!','<p>Друзья! В нашем магазине сезон скидок!</p>\r\n<p>Ждем вас на нашем сайте!</p>'),
	('2','".time()."',5,'ТВ-ролик','<p>Здравствуйте!</p>\r\n<p>С удовольствием информируем Вас о том, что видео-рилоик для ТВ увидел свет!</p>');",

	"INSERT INTO {subscribtion_category_rel} (element_id, cat_id) VALUES (1,1),(2,5);"
);