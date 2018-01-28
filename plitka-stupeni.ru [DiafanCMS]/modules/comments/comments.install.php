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
 * Comments_install
 *
 * Установка модуля "Комментарии"
 */

$title = "Комментарии";
$db = array(
	"tables" => array(
		array(
			"name" => "comments",
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
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "module_name",
					"type" => "VARCHAR(17) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
				"KEY element_id (element_id)",
				"KEY module_name (module_name(2))",
			),
		),
		array(
			"name" => "comments_parents",
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
			"name" => "comments_param",
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
					"name" => "module_name",
					"type" => "VARCHAR(17) NOT NULL DEFAULT ''",
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
					"name" => "show_in_list",
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
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
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
			"name" => "comments_param_element",
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
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY element_id (element_id)",
				"KEY param_id (param_id)",
				"KEY value (value(5))",
			),
		),
		array(
			"name" => "comments_param_select",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "param_id",
					"type" => "int(11) unsigned NOT NULL default '0'",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "value",
					"type" => "VARCHAR(1) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "sort",
					"type" => "int(11) unsigned NOT NULL default '0'",
				),
				array(
					"name" => "trash",
					"type" => "enum('0','1') NOT NULL default '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY param_id (param_id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "comments",
			"module_name" => "comments",
			"admin" => true,
			"site" => true,
			"title" => $title,
		),
	),
	"config" => array(
		array(
			"name" => "captcha",
			"value" => "1",
		),
		array(
			"name" => "format_date",
			"value" => "5",
		),
		array(
			"name" => "user_name",
			"value" => "1",
		),
		array(
			"name" => "error_insert_message",
			"value" => array(
				"Ваше сообщение уже имеется в базе.",
				"Your message is already in data base.",
			),
		),
		array(
			"name" => "add_message",
			"value" => array(
				"Спасибо! Ваш комментарий будет проверен в ближайшее время и появиться на сайте.",
				"Thank you! Your comment will check in near time and will publish on this page.",
			),
		),
		array(
			"name" => "count_level",
			"value" => "7",
		),
		array(
			"name" => "max_count",
			"value" => "50",
		),
		array(
			"name" => "sendmailadmin",
			"value" => "1",
		),
		array(
			"name" => "subject_admin",
			"value" => "%title (%url). Новый комментарий",
		),
		array(
			"name" => "message_admin",
			"value" => "Здравствуйте, администратор сайта %title (%url)!
На странице %urlpage появился новый комментарий:
%message",
		),
		array(
			"name" => "comments",
			"module_name" => "ads",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "comments",
			"module_name" => "clauses",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "comments",
			"module_name" => "faq",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "comments",
			"module_name" => "files",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "comments",
			"module_name" => "news",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "comments",
			"module_name" => "photo",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "comments_cat",
			"module_name" => "photo",
			"value" => 1,
			"check_module" => true,
		),
		array(
			"name" => "comments",
			"module_name" => "shop",
			"value" => 1,
			"check_module" => true,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Комментарии",
			"rewrite" => "comments",
			"group_id" => "2",
			"sort" => "7",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/kommentarii/",
			"children" => array(
				array(
					"name" => "Комментарии",
					"rewrite" => "comments",
					"sort" => "0",
					"act" => true,
				),
				array(
					"name" => "Конструктор формы",
					"rewrite" => "comments/param",
					"sort" => "1",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "comments/config",
					"sort" => "2",
					"act" => true,
				),
			)
		),
	),
	"sql" => array(
		"INSERT INTO {comments_param} (".multilang("nameLANG,")." type, sort, required, show_in_list, show_in_form_no_auth) VALUES
(".multilang("'Имя',", "'Name',")." 'text', 1, '1', '1', '1')"
	),
);

$example = array();

if (! empty($_POST["photo"]))
{
	$example[] = "INSERT INTO {comments} (id, text, act, created, module_name, element_id, user_id) VALUES (
		3,
		'Лошадь просто супер. Сынишка в восторге. Спасибо!',
		'1',
		'".(time()-86400*5)."',
		'photo',
		'2',
		1
	)";
	$example[] = "INSERT INTO {comments} (id, text, act, created, module_name, element_id, user_id) VALUES (
		8,
		'Вау, какая изворотливая!',
		'1',
		'".time()."',
		'photo',
		'9',
		2
	);";
}

if (! empty($_POST["shop"]))
{
	$example[] = "INSERT INTO {comments} (id, text, act, created, module_name, element_id, user_id) VALUES (
		1,
		'Хороший коршун, я купил себе три на дачу.',
		'1',
		'".(time()-86400*6)."',
		'shop',
		'1',
		1
	)";
	$example[] = "INSERT INTO {comments} (id, text, act, created, module_name, element_id, user_id) VALUES (
		4,
		'Отличный пеликан. Купил и не нарадуюсь.',
		'1',
		'".(time()-86400*4)."',
		'shop',
		'3',
		2
	)";
	$example[] = "INSERT INTO {comments} (id, text, act, created, module_name, element_id, user_id) VALUES (
		5,
		'Очень хочется познакомиться с вашим создателем.',
		'1',
		'".(time()-86400*3)."',
		'shop',
		'30',
		1
	)";
	$example[] = "INSERT INTO {comments} (id, text, act, created, module_name, element_id, user_id) VALUES (
		6,
		'Красавец',
		'1',
		'".(time()-86400*2)."',
		'shop',
		'19',
		2
	)";
}

if (! empty($_POST["clauses"]))
{
	$example[] = "INSERT INTO {comments} (id, text, act, created, module_name, element_id, user_id) VALUES (
		7,
		'Отличная статья. Я в восторге. Автор.',
		'1',
		'".(time()-86400)."',
		'clauses',
		'1',
		1
	)";
}

if (! empty($_POST["news"]))
{
	$example[] = "INSERT INTO {comments} (id, user_id, text, act, created, module_name, element_id, count_children) VALUES (
		9,
		1,
		'Ура! Весна! Мы так рады!',
		'1',
		'".(time()-86400)."',
		'news',
		8,
		1
	)";
	$example[] = "INSERT INTO {comments} (id, text, act, created, module_name, element_id, parent_id) VALUES (
		10,
		'Мы тоже радуемся вслед за Вами!',
		'1',
		'".(time())."',
		'news',
		8,
		9
	)";
	$example[] = "INSERT INTO {comments_param_element} (value, param_id, element_id) VALUES ('Жакартий',1,10)";
	$example[] = "INSERT INTO {comments_parents} (element_id, parent_id) VALUES (10,9)";
}

/**
 * Выполняет действия для основной установки модуля
 * 
 * @return void
 */
function module_basic_comments()
{
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/comments'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/comments', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/comments/files'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/comments/files', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/comments/imgs'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/comments/imgs', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/comments/imgs/small'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/comments/imgs/small', 0777);
	}

	$text = 'Options -Indexes

<files *>
deny from all
</files>';

	$fp = fopen(ABSOLUTE_PATH.USERFILES.'/comments/files/.htaccess', "w");
	fwrite($fp, $text);
	fclose($fp);
}
