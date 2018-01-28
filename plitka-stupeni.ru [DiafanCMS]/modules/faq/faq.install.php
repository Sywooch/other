<?php
/**
 * Установка модуля "Вопрос-Ответ"
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

$title = "Вопрос-Ответ";

$db = array(
	"tables" => array(
		array(
			"name" => "faq",
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
					"name" => "mail",
					"type" => "VARCHAR(40) NOT NULL DEFAULT ''",
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
					"name" => "often",
					"type" => "CHAR(1) NOT NULL DEFAULT ''",
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
					"name" => "user_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
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
			"name" => "faq_rel",
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
			"name" => "faq_category",
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
			"name" => "faq_category_parents",
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
			"name" => "faq_category_rel",
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
			"name" => "faq_counter",
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
			"name" => "faq",
			"module_name" => "faq",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Вопрос-Ответ",
			"rewrite" => "faq",
			"group_id" => "2",
			"sort" => "2",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/vopros-otvet/",
			"children" => array(
				array(
					"name" => "Вопросы",
					"rewrite" => "faq",
					"sort" => "34",
					"act" => true,
				),
				array(
					"name" => "Категории",
					"rewrite" => "faq/category",
					"sort" => "35",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "faq/config",
					"sort" => "36",
					"act" => true,
				),
			)
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Question/Answer'),
			"act" => true,
			"sort" => 9,
			"module_name" => "faq",
			"rewrite" => "faq",
			"menu" => array(
				"cat_id" => 3,
				"sort" => 5,
			),
		),
	),
	"config" => array(
		array(
			"name" => "security",
			"value" => "2",
		),
		array(
			"name" => "format_date",
			"value" => "1",
		),
		array(
			"name" => "nastr",
			"value" => "10",
		),
		array(
			"name" => "count_list",
			"value" => "3",
		),
		array(
			"name" => "attachments",
			"value" => "1",
		),
		array(
			"name" => "max_count_attachments",
			"value" => "10",
		),
		array(
			"name" => "attachment_extensions",
			"value" => "doc, gif, jpg, jpeg, mpg, pdf, png, txt, zip",
		),
		array(
			"name" => "sendmailadmin",
			"value" => "1",
		),
		array(
			"name" => "add_message",
			"value" => array(
				'<div align="center"><b>Спасибо за ваше сообщение!</b><br>Наш консультант подберет необходимую информацию, после чего ваш вопрос и ответ на него будут опубликованы на этой странице.</div>',
				'<div align="center"><b>Thank you for your message!</b><br>Our consultant will select necessary information and your question and answer to this question will publish on this page.</div>',
			),
		),
		array(
			"name" => "error_insert_message",
			"value" => array(
				"Ваше сообщение уже имеется в базе.",
				"Your message is already in data base.",
			),
		),
		array(
			"name" => "subject",
			"value" => array(
				"%title (%url). Вопрос-Ответ",
				"%title (%url). Question / Answer",
			),
		),
		array(
			"name" => "message",
			"value" => array(
				"Здравствуйте, %name!<br>Вы задали вопрос на сайте %title (%url).<br><b>Вопрос:</b> %question <br><b>Ответ:</b> %answer",
				"Hello, %name!<br>You asked the question on our web site %title (%url).<br><b>Question:</b> %question<br><b>Answer:</b> %answer",
			),
		),
		array(
			"name" => "subject_admin",
			"value" => "%title (%url). Новый вопрос в рубрике Вопрос-Ответ",
		),
		array(
			"name" => "message_admin",
			"value" => "Здравствуйте, администратор сайта %title (%url)!<br>В рубрике Вопрос-Ответ появился новый вопрос:<br>%question.<br>%name<br>%email<br>Прикреленные файлы: %files",
		),
		array(
			"name" => "rel_two_sided",
			"value" => "1",
		),
	),
);

$example = array(
	"UPDATE {site} SET
		".multilang(
			"text1='<p>Здесь любой наш посетитель может задать нам свой вопрос, а мы на него ответим.</p>'",

			", text2='<p>Here any our visitor can ask us the question, and we will answer it.</p>'",

			""
		)."
	WHERE module_name='faq'",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."timeedit) VALUES (
		1,
		".multilang("'Элеонора',", "'Eleonora',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*10)."',
		MODULE_SITE_ID,
		".multilang(
			"'Скажите, а вы мучаете бумажных животных?',",
	
			"'Tell, you torment paper animals?',",
	
			"'',"
		)."
		".multilang(
			"'<p>Безусловно нет!!! Не считая случаев самоубийства бумажной жар-птицы, севшей на свечку...</p>',",
	
			"'<p>Certainly is not present!!! Without considering cases of suicide of the paper firebird who have sat down on a candle...</p>',",
	
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit) VALUES (
		2,
		".multilang("'Мясоед',", "'Myasoed',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*9)."',
		MODULE_SITE_ID,
		".multilang(
			"'А ваши животные съедобные?',",

			"'And your animals edible?',",

			"'',"
		)."
		".multilang(
			"'<p>Конечно, кетчуп &quot;Помидоркино&quot; все может сделать едой, но нашим животным не нравится, когда их едят.</p>',",

			"'<p>Certainly, ketchup &quot;Pomidorkino&quot; can make all meal, but it is not pleasant to our animals, when them eat.</p>',",

			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."timeedit) VALUES (
		3,
		".multilang("'Гена',", "'Gena',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*8)."',
		MODULE_SITE_ID,
		".multilang(
			"'А клетки в вашем зоопарке железные?',",

			"'And cages in your zoo the iron?',",

			"'',"
		)."
		".multilang(
			"'<p>Мы называем их &quot;вольерами&quot; - они из хлебных мякишей с веточками ольхи внутри.</p>',",

			"'<p>We name their &quot;open-air cages&quot; - they from grain crumbs with alder branches inside.</p>',",

			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."often, timeedit) VALUES (
		4,
		".multilang("'Валя',", "'Valya',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*7)."',
		MODULE_SITE_ID,
		".multilang(
			"'Что такое Бумажный зоопарк?',",

			"'What is the Paper zoo?',",

			"'',"
		)."
		".multilang(
			"'<p>Бумажный зоопарк, он же Картонная скотобаза, он же Макулатура в фигурках, он же Плоскоцеллюлозный зверинец - наше чудесное творение, где мы ждем вас и днем и ночью!</p>',",

			"'<p>Paper zoo, it Paper for recycling in figures, it Ploskotselljuloznyj a menagerie - our wonderful creation where we wait for you and day and night!</p>',",

			"'',"
		)."
		'1',
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."often, timeedit) VALUES (
		5,
		".multilang("'Миша',", "'Misha',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*6)."',
		MODULE_SITE_ID,
		".multilang(
			"'Сколько животных в вашем зоопарке?',",

			"'How many animals in your zoo?',",

			"'',"
		)."
		".multilang(
			"'<p>По подсчетам Иваныча, сторожа, более 100, однако по документам бухгалтерии не более 50.</p>',",

			"'<p>By estimates of Ivanycha, the watchman, more than 100, however under documents of accounts department no more than 50.</p>',",

			"'',"
		)."
		'1',
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."often, timeedit) VALUES (
		6,
		".multilang("'Витя',", "'Vitya',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*5)."',
		MODULE_SITE_ID,
		".multilang(
			"'Можно ли у вас купить животное?',",

			"'Whether it is possible to buy from you an animal?',",

			"'',"
		)."
		".multilang(
			"'<p>Конечно, заходите в каталог товаров на нашем сайте - все животные как на витрине - и слон и кот!</p>',",

			"'<p>Certainly, come into the catalogue of the goods on our site - all animals as on a show_window - both an elephant and a cat!</p>',",

			"'',"
		)."
		'1',
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."often, timeedit) VALUES (
		7,
		".multilang("'Боец',", "'Boec',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*4)."',
		MODULE_SITE_ID,
		".multilang(
			"'Как стать вашим представителем в регионе?',",

			"'How to become your representative in region?',",

			"'',"
		)."
		".multilang(
			"'<p>Вам необходимо арендовать центральный парк в вашем городе и отловить там всех муравьев.</p>',",

			"'<p>It is necessary for you to rent the central park in your city and to catch there all ants.</p>',",

			"'',"
		)."
		'1',
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."often, timeedit) VALUES (
		8,
		".multilang("'Костик',", "'Kostik',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*3)."',
		MODULE_SITE_ID,
		".multilang(
			"'У меня есть несколько бумажных животных. Можно они будут дружить с вашими?',",

			"'I have some paper animals. It will be possible to be on friendly terms they with yours?',",

			"'',"
		)."
		".multilang(
			"'<p>Дружить - можно. А к нам на содержание - не положено.</p>',",

			"'<p>To be on friendly terms - it is possible. And to us on the maintenance - it is not necessary.</p>',",

			"'',"
		)."
		'1',
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."timeedit) VALUES (
		9,
		".multilang("'Карапуз',", "'Karapuz',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*2)."',
		MODULE_SITE_ID,
		".multilang(
			"'Как можно попасть в ваш Зоопарк?',",

			"'How it is possible to get to your Zoo?',",

			"'',"
		)."
		".multilang(
			"'<p>Приезжайте по контактному адресу, обращайтесь к сторожу.</p>',",

			"'<p>Come to the contact address, address to the watchman.</p>',",

			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")."timeedit) VALUES (
		10,
		".multilang("'Пожарный',", "'Fireman',", "'',")."
		".multilang("'1',")."
		'".(time()-86400*1)."',
		MODULE_SITE_ID,
		".multilang(
			"'Выпускаете ли вы своих животных в привычную среду? В лес, например.',",

			"'Whether you let out the animals in the habitual environment? In wood, for example.',",

			"'',"
		)."
		".multilang(
			"'<p>Мы их выпускаем на макулатурную свалку - там им хорошо!</p>',",

			"'<p>We let out them on a dump - there it well!</p>',",

			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {faq} (id, ".multilang("nameLANG,")." created, site_id, ".multilang("anonsLANG,")." timeedit) VALUES (
		11,
		".multilang("'Борис',", "'Boris',", "'',")."
		'".time()."',
		MODULE_SITE_ID,
		".multilang(
			"'Требуются ли вам сотрудники для ухода за больными бумажными зверями?',",

			"'Whether employees for care of sick paper animals are required to you?',",

			"'',"
		)."
		'".time()."'
	);",

	"INSERT INTO {faq_rel} (element_id, rel_element_id) VALUES (6, 7), (6, 5), (7, 5), (1, 2), (1, 3), (2, 3), (11, 10), (10, 8), (11, 8)",
);