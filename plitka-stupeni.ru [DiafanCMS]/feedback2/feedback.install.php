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
 * Feedback_install
 *
 * Установка модуля "Обратная связь"
 */

$title = "Обратная связь";
$db = array(
	"tables" => array(
		array(
			"name" => "feedback",
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
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "lang_id",
					"type" => "TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "text",
					"type" => "TEXT NOT NULL DEFAULT ''",
				),
				array(
					"name" => "user_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "admin_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
			"name" => "feedback_param",
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
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
					"name" => "text",
					"type" => "TEXT NOT NULL DEFAULT ''",
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
			"name" => "feedback_param_element",
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
				"KEY element_id (element_id)",
				"KEY param_id (param_id)",
				"KEY value (value(5))",
			),
		),
		array(
			"name" => "feedback_param_select",
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
				"KEY param_id (param_id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "feedback",
			"module_name" => "feedback",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Feedback'),
			"act" => true,
			"sort" => 14,
			"module_name" => "feedback",
			"rewrite" => "feedback",
			"menu" => array(
				"cat_id" => 1,
				"sort" => 2,
			),
		),
	),
	"adminsites" => array(
		array(
			"name" => "Обратная связь",
			"rewrite" => "feedback",
			"group_id" => "2",
			"sort" => "3",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/obratnaya_svyaz/",
			"children" => array(
				array(
					"name" => "Сообщения",
					"rewrite" => "feedback",
					"sort" => "37",
					"act" => true,
				),
				array(
					"name" => "Конструктор формы",
					"rewrite" => "feedback/param",
					"sort" => "38",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "feedback/config",
					"sort" => "39",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "security",
			"value" => "2",
		),
		array(
			"name" => "sendmailadmin",
			"value" => "1",
		),
		array(
			"name" => "add_message",
			"value" => array(
				'<div align="center"><b>Спасибо за ваше сообщение!</b></div>',
				'<div align="center"><b>Thank you for your message!</b></div>',
			),
		),
		array(
			"name" => "subject",
			"value" =>  array(
				"%title (%url). Обратная связь",
				"%title (%url). Feedback",
			),
		),
		array(
			"name" => "message",
			"value" =>  array(
				"Здравствуйте!<br>Вы оставили сообщение в форме обратной связи на сайте %title (%url).<br><b>Сообщение:</b> %message <br><b>Ответ:</b> %answer",
				"Hello!<br>You added message on the web site %title (%url).<br><b>Message:</b> %message<br><b>Answer:</b> %answer",
			),
		),
		array(
			"name" => "subject_admin",
			"value" => "%title (%url). Новое сообщение в рубрике Обратная связь",
		),
		array(
			"name" => "message_admin",
			"value" => "Здравствуйте, администратор сайта %title (%url)!<br>В рубрике Обратная связь появилось новое сообщение:<br>%message",
		),
	),
	"sql" => array(
		"INSERT INTO {feedback_param} (id, ".multilang("nameLANG,")." type, site_id, sort, required) VALUES (
			1,
			".multilang("'Ваше имя',", "'Your name',", "'',")."
			'text',
			MODULE_SITE_ID,
			9,
			'1'
		);",
	
		"INSERT INTO {feedback_param} (id, ".multilang("nameLANG,")." type, site_id, sort, required) VALUES (
			2,
			".multilang("'Ваш e-mail',", "'Your e-mail',", "'',")."
			'email',
			MODULE_SITE_ID,
			10,
			'1'
		);",
	
		"INSERT INTO {feedback_param} (id, ".multilang("nameLANG,")." type, site_id, sort, required) VALUES (
			3,
			".multilang("'Ваше сообщение',", "'Your message',", "'',")."
			'textarea',
			MODULE_SITE_ID,
			11,
			'1'
		);"
	),
);

$example = array(
	"UPDATE {site} SET
		".multilang(
			"textLANG='<p>Наш зоопарк гордится тем, что у нас одна из лучших систем обратной связи с нашими посетителями!</p>\r\n<p>Вы можете звонить по нашим телефонам, или отправьте сообщение из формы ниже, указав правильный почтовый ящик - и мы обязательно вам ответим!</p>'",
	
			", textLANG='<p>Our zoo is proud of that at us one of the best systems of a feedback with our visitors!<br /><br />You can call by our phones, or send the message from the form more low, having specified a correct mail box - and we necessarily will answer you!</p>'",
	
			""
		)."
	WHERE module_name='feedback'",

	"INSERT INTO {feedback} (id, created, site_id) VALUES (
		1,
		'".(time()-86400*2)."',
		MODULE_SITE_ID
	);",

	"INSERT INTO {feedback} (id, created, site_id) VALUES (
		2,
		'".(time()-86400)."',
		MODULE_SITE_ID
	);",

	"INSERT INTO {feedback} (id, created, site_id) VALUES (
		3,
		'".time()."',
		MODULE_SITE_ID
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		1,
		'Георгий',
		1,
		1
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		2,
		'Георг',
		1,
		2
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		3,
		'Виолетта',
		1,
		3
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		4,
		'',
		2,
		1
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		5,
		'',
		2,
		2
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		6,
		'',
		2,
		3
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		10,
		'Спасибо, что вы есть!',
		3,
		1
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		11,
		'Были у вас на прошлой неделе. Все понравилось, только кролик нам на ногу наступил...',
		3,
		2
	);",

	"INSERT INTO {feedback_param_element} (id, value, param_id, element_id) VALUES (
		12,
		'Надо мной посмеялась ваша ехидна, не поползу к вам больше, пока она не извинится!',
		3,
		3
	);"
);