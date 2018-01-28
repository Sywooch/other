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
 * Forum_install
 *
 * Установка модуля "Форум"
 */

$title = "Форум";
$db = array(
	"tables" => array(
		array(
			"name" => "forum",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(20) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "author",
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
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "date_update",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "user_update",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
				),
				array(
					"name" => "del",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
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
				"KEY `parent_id` (`parent_id`)",
				"KEY `element_id` (`cat_id`)",
				"KEY `author` (`author`)",
			),
		),
		array(
			"name" => "forum_parents",
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
			"name" => "forum_category",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "author",
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
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "name",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "date_update",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "user_update",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "message_update",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "counter_view",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "del",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "prior",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "close",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY `author` (`author`)",
			),
		),
		array(
			"name" => "forum_category_parents",
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
			"name" => "forum_show",
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
					"name" => "user_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "table_name",
					"type" => "ENUM('forum','forum_category') NOT NULL DEFAULT 'forum'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY `element_id` (`element_id`,`table_name`)",
				"KEY `user_id` (`user_id`)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "forum",
			"module_name" => "forum",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Forum'),
			"act" => true,
			"sort" => 15,
			"module_name" => "forum",
			"rewrite" => "forum",
			"menu" => array(
				"cat_id" => 3,
				"sort" => 10,
			),
		),
	),
	"adminsites" => array(
		array(
			"name" => "Форум",
			"rewrite" => "forum",
			"group_id" => "2",
			"sort" => "8",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/forum/",
			"children" => array(
				array(
					"name" => "Настройки",
					"rewrite" => "forum/config",
					"sort" => "41",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "news_count_days",
			"value" => "3",
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
			"name" => "format_date",
			"value" => "5",
		),
		array(
			"name" => "nastr",
			"value" => "30",
		),
		array(
			"name" => "attachments",
			"value" => "1",
		),
		array(
			"name" => "max_count_attachments",
			"value" => "5",
		),
		array(
			"name" => "attachment_extensions",
			"value" => "doc, gif, jpg, jpeg, mpg, pdf, png, txt, zip",
		),
		array(
			"name" => "recognize_image",
			"value" => "1",
		),
		array(
			"name" => "attach_big_width",
			"value" => "1000",
		),
		array(
			"name" => "attach_big_height",
			"value" => "1000",
		),
		array(
			"name" => "attach_big_quality",
			"value" => "90",
		),
		array(
			"name" => "attach_medium_width",
			"value" => "1000",
		),
		array(
			"name" => "attach_medium_height",
			"value" => "1000",
		),
		array(
			"name" => "attach_medium_quality",
			"value" => "80",
		),
		array(
			"name" => "use_animation",
			"value" => "1",
		),
	),
	"sql" => array(
	
		"INSERT INTO {forum_category} (`id`, `count_children`, `created`, `name`, `act`) VALUES (1, 1, ".time().", 'Главная категория форума', '1')",
	
		"INSERT INTO {forum_category} (`id`, `parent_id`, `created`, `name`, `act`) VALUES (2, 1, ".time().", 'Общий раздел', '1')",
	
		"INSERT INTO {forum_category_parents} (`element_id`, `parent_id`) VALUES (2, 1);"
	),
);

$example = array(
	"INSERT INTO {forum} (id, author, count_children, created, cat_id, text, act) VALUES (1, 3, 8, ".(time() - 5000).", 12, 'Мы привезли 3 новых желтых птицы из европейских бумажных зоопарков: коршуна, лебедя и голубя.\r<br><img src=http://cms.diafan.ru/files4.2/shop/medium/golub_51.jpg> <img src=http://cms.diafan.ru/files4.2/shop/medium/korshun_41.jpg> <img src=http://cms.diafan.ru/files4.2/shop/medium/lebed_48.jpg>', '1')",
	
	"INSERT INTO {forum} (id, author, parent_id, count_children, created, cat_id, text, act) VALUES (2, 2, 1, 5, ".(time() - 4000).", 12, 'А ценовой разброс какой? В магазине они еще не появились ((', '1')",
	
	"INSERT INTO {forum} (id, author, parent_id, count_children, created, cat_id, text, act) VALUES (3, 3, 2, 4, ".(time() - 3500).", 12, 'У коршуна 3 цены в зависимости от размера: 3 100, 3 200 и 3 500 руб. Голубь 900 руб. стоит, а вот лебедь 8 800 руб.', '1')",
	
	"INSERT INTO {forum} (id, author, parent_id, count_children, created, cat_id, text, act) VALUES (4, 2, 3, 3, ".(time() - 3000).", 12, 'Жалко, что лебедь такой дорогой. Мне он очень понравился, изящный такой.', '1')",
	
	"INSERT INTO {forum} (id, author, parent_id, count_children, created, cat_id, text, act) VALUES (5, 3, 4, 1, ".(time() - 2700).", 12, 'А Вы цаплю не рассматривали? Они по характеру похожи  и расцветочка тоже светлая. Мы рекомендуем как хорошую альтернативу', '1')",
	
	"INSERT INTO {forum} (id, author, parent_id, created, cat_id, text, act) VALUES (6, 2, 5, ".(time() - 1800).", 12, 'Спасибо! хорошая альтернатива!', '1')",
	
	"INSERT INTO {forum} (id, name, parent_id, created, cat_id, text, act) VALUES (7, 'Игорь', 4, ".(time() - 1500).", 12, 'Лебедь и правда красив, но слишком гордый. Очень радует, что голубя привезли. Мы его уже 3 месяца ждем.', '1')",
	
	"INSERT INTO {forum} (id, name, parent_id, count_children, created, cat_id, text, act) VALUES (8, 'Виктор', 1, 1, ".(time() - 1200).", 12, 'Завоз синих птиц не планируете? А то у Вас на сайте пока только орел. А мне хочется птичку подобрее.', '1')",
	
	"INSERT INTO {forum} (id, author, parent_id, created, cat_id, text, act) VALUES (9, 3, 8, ".(time() - 900).", 12, 'В следующем месяце ожидаем большой завоз птиц синего и коричневого цвета.', '1')",
	
	"INSERT INTO {forum} (id, author, count_children, created, cat_id, text, act) VALUES (10, 3, 2, ".(time() - 600).", 13, 'Заметили, что хищные птицы не особенно охотно покупаются. Если нужны, делайте заказ индивидуально на форуме, завезем.', '1')",
	
	"INSERT INTO {forum} (id, name, parent_id, created,cat_id, text, act) VALUES (11, 'Ольга', 10, ".(time() - 300).",  13, 'Привезите, пожалуйста, большого белого грифа, хочу подарить мужу на день рожденье.', '1')",
	
	"INSERT INTO {forum} (id, name, parent_id, created, cat_id, text, act) VALUES (12, 'Ислам', 10, ".time().", 13, 'А я мечтаю о соколе коричневого цвета. Очень буду благодарен, если привезете.', '1')",

	"UPDATE {forum_category} SET count_children=5, created=".time().", name='Разговоры о товарах' WHERE id=1",

	"UPDATE {forum_category} SET count_children=2, created=".(time() - 300).", name='Птицы' WHERE id=2",

	"INSERT INTO {forum_category} (id, count_children, created, name, act) VALUES (3, 2, ".(time() - 600).", 'Консультации', '1')",

	"INSERT INTO {forum_category} (id, count_children, created, name, act) VALUES (4, 3, ".(time() - 900).", 'Правила форума', '1')",

	"INSERT INTO {forum_category} (id, parent_id, created, name, act) VALUES (5, 1, ".(time() - 1200).", 'Звери', '1')",

	"INSERT INTO {forum_category} (id, parent_id, created, name, act) VALUES (6, 1, ".(time() - 1500).", 'Водоплавающие', '1')",

	"INSERT INTO {forum_category} (id, parent_id, created, name, act) VALUES (7, 3, ".(time() - 1800).", 'Ухода за животными', '1')",

	"INSERT INTO {forum_category} (id, parent_id, created, name, act) VALUES (8, 3, ".(time() - 2100).", 'Покупки', '1')",

	"INSERT INTO {forum_category} (id, parent_id, created, name, act) VALUES (9, 4, ".(time() - 2300).", 'О форуме', '1')",

	"INSERT INTO {forum_category} (id, parent_id, created, name, act) VALUES (10, 4, ".(time() - 2500).", 'О магазине', '1')",

	"INSERT INTO {forum_category} (id, parent_id, created, name, act) VALUES (11, 4, ".(time() - 3000).", 'Обо всём', '1')",

	"INSERT INTO {forum_category} (id, author, parent_id, created, name, message_update, act) VALUES (12, 2, 2, ".(time() - 5000).", 'Новое поступление желтых птиц', ".(time() - 1200).", '1')",

	"INSERT INTO {forum_category} (id, author, parent_id, created, name, message_update, act) VALUES (13, 2, 2, ".(time() - 600).", 'Хищные птицы', ".time().", '1')",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (5, 1)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (6, 1)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (7, 3)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (8, 3)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (9, 4)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (10, 4)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (11, 4)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (12, 1)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (12, 2)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (13, 1)",

	"INSERT INTO {forum_category_parents} (element_id, parent_id) VALUES (13, 2)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (2, 1)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (3, 1)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (3, 2)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (4, 2)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (4, 1)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (4, 3)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (5, 3)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (5, 1)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (5, 2)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (5, 4)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (6, 4)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (6, 2)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (6, 1)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (6, 3)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (6, 5)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (7, 3)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (7, 1)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (7, 2)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (7, 4)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (8, 1)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (9, 1)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (9, 8)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (11, 10)",

	"INSERT INTO {forum_parents} (element_id, parent_id) VALUES (12, 10)"

);