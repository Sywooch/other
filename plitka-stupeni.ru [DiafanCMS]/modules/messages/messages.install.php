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
 * Messages_install
 *
 * Установка модуля "Личные сообщения"
 */

$title = "Личные сообщения";
$db = array(
	"tables" => array(
		array(
			"name" => "messages",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "author",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "to_user",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL",
				),
				array(
					"name" => "created",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "readed",
					"type" => "enum('0','1') NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "messages_user",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "user_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "contact_user_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "date_update",
					"type" => "int(10) NOT NULL",
				),
				array(
					"name" => "readed",
					"type" => "enum('0','1') NOT NULL",
				),
				array(
					"name" => "count_message",
					"type" => "smallint(5) unsigned NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "messages",
			"module_name" => "messages",
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Messages'),
			"act" => true,
			"sort" => 25,
			"module_name" => "messages",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
			"rewrite" => "messages",
		),
	),
);