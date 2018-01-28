<?php
/**
 * Установка модуля "Опросы"
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

$title = "Опросы";

$db = array(
	"tables" => array(
		array(
			"name" => "votes",
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
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count_votes",
					"type" => "INT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "sort",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY cat_id (cat_id)",
			),
		),
		array(
			"name" => "votes_category",
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
					"name" => "no_result",
					"type" => "enum('0','1') NOT NULL",
				),
				array(
					"name" => "userversion",
					"type" => "enum('0','1') NOT NULL",
				),
				array(
					"name" => "sort",
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
			"name" => "votes_category_site_rel",
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
			"name" => "votes_userversion",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "cat_id",
					"type" => "int(10) unsigned NOT NULL",
				),
				array(
					"name" => "text",
					"type" => "varchar(200) NOT NULL",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY cat_id (cat_id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "votes",
			"module_name" => "votes",
			"admin" => true,
			"site" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Опросы",
			"rewrite" => "votes",
			"group_id" => "2",
			"sort" => "4",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/oprosy/",
			"children" => array(
				array(
					"name" => "Опросы",
					"rewrite" => "votes",
					"sort" => "98",
					"act" => true,
				),
				array(
					"name" => "Варианты пользователей",
					"rewrite" => "votes/userversion",
					"sort" => "99",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "votes/config",
					"sort" => "29",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "security",
			"value" => "4",
		),
	),
);

$example = array(
	"INSERT INTO {votes_category} (id,".multilang(" nameLANG,").multilang(" actLANG,")." sort) VALUES (
		1,
		".multilang("'Нравится ли Вам наш зоопарк?',", "'Whether our zoo is pleasant to you?',", "'',")."
		".multilang("'1',")."
		1
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG, actLANG,")." cat_id, count_votes, sort) VALUES (
		1,
		".multilang("'Да, очень!',", "'Yes, very much!',", "'',")."
		".multilang("'1',")."
		1,
		1,
		1
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		2,
		".multilang("'Сойдет',", "'Descend',", "'',")."
		".multilang("'1',")."
		1,
		2
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		3,
		".multilang("'Мне нейтрально',", "'To me it is neutral',", "'',")."
		".multilang("'1',")."
		1,
		3
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		4,
		".multilang("'Так себе',", "'So-so',", "'',")."
		".multilang("'1',")."
		1,
		4
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		5,
		".multilang("'Не нравится',", "'It is not pleasant',", "'',")."
		".multilang("'1',")."
		1,
		5
	);",

	"INSERT INTO {votes_category} (id,".multilang(" nameLANG,").multilang(" actLANG,")." sort, userversion) VALUES (
		7,
		".multilang("'Каких животных Вы предпочитаете?',", "'You prefer what animals?',", "'',")."
		".multilang("'1',")."
		7,
		'1'
	);",

	"INSERT INTO {votes_userversion} (cat_id, text) VALUES ('7','Птицы');",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, count_votes, sort) VALUES (
		8,
		".multilang("'Травоядных',", "'Herbivorous',", "'',")."
		".multilang("'1',")."
		7,
		1,
		8
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		9,
		".multilang("'Хищников',", "'Predator',", "'',")."
		".multilang("'1',")."
		7,
		9
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		10,
		".multilang("'Не люблю животных',", "'I do not love animals',", "'',")."
		".multilang("'1',")."
		7,
		10
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, count_votes, sort) VALUES (
		11,
		".multilang("'Всех',", "'All',", "'',")."
		".multilang("'1',")."
		7,
		1,
		11
	);",

	"INSERT INTO {votes_category} (id,".multilang(" nameLANG,").multilang(" actLANG,")." sort) VALUES (
		13,
		".multilang("'Посещаете ли Вы со своим питомцем ветеринарные клиники?',", "'Whether you with the pupil visit veterinary clinics?',", "'',")."
		".multilang("'1',")."
		13
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		14,
		".multilang("'Постоянно',", "'Regularly',", "'',")."
		".multilang("'1',")."
		13,
		14
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		15,
		".multilang("'В крайних случаях',", "'In extreme cases',", "'',")."
		".multilang("'1',")."
		13,
		15
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		16,
		".multilang("'Никогда',", "'Never',", "'',")."
		".multilang("'1',")."
		13,
		16
	);",

	"INSERT INTO {votes_category} (id,".multilang(" nameLANG,").multilang(" actLANG,")." sort) VALUES (
		18,
		".multilang("'Сколько денег Вы тратите в месяц на своего домашнего питомца?',", "'How many money you spend in a month for the house pupil?',", "'',")."
		".multilang("'1',")."
		18
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		19,
		".multilang("'до 100 руб.',", "'To 100 rbl.',", "'',")."
		".multilang("'1',")."
		18,
		19
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		20,
		".multilang("'от 100 руб. до 450 руб.',", "'From 100 rbl. to 450 rbl.',", "'',")."
		".multilang("'1',")."
		18,
		20
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		21,
		".multilang("'более 500 руб.',", "'More than 500 rbl.',", "'',")."
		".multilang("'1',")."
		18,
		21
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		22,
		".multilang("'Вообще не трачу денег',", "'At all I do not spend money',", "'',")."
		".multilang("'1',")."
		18,
		22
	);",

	"INSERT INTO {votes_category} (id,".multilang(" nameLANG,").multilang(" actLANG,")." sort) VALUES (
		23,
		".multilang("'Нужны ли бумажные зоопарки?',", "'Whether paper zoos are necessary?',", "'',")."
		".multilang("'1',")."
		23
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, count_votes, sort) VALUES (
		24,
		".multilang("'Кому-то нечем заняться',", "'Someone has nothing to be engaged',", "'',")."
		".multilang("'1',")."
		23,
		1,
		24
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		25,
		".multilang("'Да. Это очень интересно',", "'Yes. It is very interesting',", "'',")."
		".multilang("'1',")."
		23,
		25
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		26,
		".multilang("'Бумажные зоопарки никому не нужны',", "'Paper zoos are necessary to nobody',", "'',")."
		".multilang("'1',")."
		23,
		26
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		27,
		".multilang("'Такие зоопарки поднимают настроение',", "'Such zoos cheer up',", "'',")."
		".multilang("'1',")."
		23,
		27
	);",

	"INSERT INTO {votes_category} (id,".multilang(" nameLANG,").multilang(" actLANG,")." sort) VALUES (
		28,
		".multilang("'Купили бы Вы бумажную таксу?',", "'You would buy the paper turnspit?',", "'',")."
		".multilang("'1',")."
		28
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		29,
		".multilang("'Нет, пустая трата денег',", "'No, waste of money',", "'',")."
		".multilang("'1',")."
		28,
		29
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		30,
		".multilang("'Да, она украсила бы мою комнату',", "'Yes, it would decorate my room',", "'',")."
		".multilang("'1',")."
		28,
		30
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		31,
		".multilang("'Конечно, оригинальный подарок',", "'Certainly, an original gift',", "'',")."
		".multilang("'1',")."
		28,
		31
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		32,
		".multilang("'С удовольствием, хоть поговорить будет с кем',", "'With pleasure though will talk to whom',", "'',")."
		".multilang("'1',")."
		28,
		32
	);",

	"INSERT INTO {votes_category} (id,".multilang(" nameLANG,").multilang(" actLANG,")." sort) VALUES (
		33,
		".multilang("'Часто ли коты греются в Вашем подъезде?',", "'Whether often cats are heated at your entrance?',", "'',")."
		".multilang("'1',")."
		33
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		34,
		".multilang("'Постоянно',", "'Regularly',", "'',")."
		".multilang("'1',")."
		33,
		34
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		35,
		".multilang("'У меня нет подъезда',", "'I do not have entrance',", "'',")."
		".multilang("'1',")."
		33,
		35
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, count_votes, sort) VALUES (
		36,
		".multilang("'Да, но мне не жалко, пусть греются',", "'Yes, but it is not a pity to me, let are heated',", "'',")."
		".multilang("'1',")."
		33,
		1,
		36
	);",

	"INSERT INTO {votes} (id, ".multilang("nameLANG,").multilang(" actLANG,")." cat_id, count_votes, sort) VALUES (
		37,
		".multilang("'Теперь нет. Мы всем подъездом их выгнали',", "'Now is not present. All of us an entrance have expelled them',", "'',")."
		".multilang("'1',")."
		33,
		1,
		37
	);",

	"INSERT INTO {votes_category} (id,".multilang(" nameLANG,").multilang(" actLANG,")." sort) VALUES (
		38,
		".multilang("'Кажется ли Вам, что животные следят за Вами?',", "'Whether it seems to you, what animals watch you?',", "'',")."
		".multilang("'1',")."
		38
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		39,
		".multilang("'Мне постоянно кажется это',", "'It constantly seems to me',", "'',")."
		".multilang("'1',")."
		38,
		39
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		40,
		".multilang("'Нет, за мной следят только люди',", "'No, I am watched only by people',", "'',")."
		".multilang("'1',")."
		38,
		40
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		41,
		".multilang("'Да, а вы откуда знаете это?',", "'Yes, and you whence know it?',", "'',")."
		".multilang("'1',")."
		38,
		41
	);",

	"INSERT INTO {votes} (id,".multilang(" nameLANG,").multilang(" actLANG,")." cat_id, sort) VALUES (
		42,
		".multilang("'Мне уже ничего не кажется',", "'Already it seems nothing to me',", "'',")."
		".multilang("'1',")."
		38,
		42
	);",

	"INSERT INTO {votes_category_site_rel} (element_id, site_id) VALUES (1, 0), (7, 0), (13, 0), (18, 0), (23, 0), (28, 0), (33, 0), (38, 0)",
);