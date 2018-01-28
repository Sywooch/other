<?php
/**
 * Установка модуля "Объявления"
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

$title = "Объявления";

$db = array(
	"tables" => array(
		array(
			"name" => "ads",
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
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
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
					"name" => "prior",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
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
					"name" => "user_id",
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
			"name" => "ads_category",
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
			"name" => "ads_category_parents",
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
			"name" => "ads_category_rel",
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
			"name" => "ads_counter",
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
			"name" => "ads_param",
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
			"name" => "ads_param_category_rel",
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
			"name" => "ads_param_element",
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
			"name" => "ads_param_select",
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
			"name" => "ads_rel",
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
	),
	"modules" => array(
		array(
			"name" => "ads",
			"module_name" => "ads",
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array (
			'name' => 'Объявления',
			'rewrite' => 'ads',
			'group_id' => 1,
			'sort' => 9,
			'act' => true,
			'children' => array (
				array (
					'name' => 'Объявления',
					'rewrite' => 'ads',
					'sort' => 1,
					'act' => 1,
				),
				array (
					'name' => 'Характеристики',
					'rewrite' => 'ads/param',
					'sort' => 2,
					'act' => 1,
				),
				array (
					'name' => 'Категории',
					'rewrite' => 'ads/category',
					'sort' => 3,
					'act' => 1,
				),
				array (
					'name' => 'Настройки',
					'rewrite' => 'ads/config',
					'sort' => 4,
					'act' => 1,
				),
			),
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Ads'),
			"act" => true,
			"sort" => 7,
			"module_name" => "ads",
			"rewrite" => "ads",
			"menu" => array(
				"cat_id" => 3,
				"sort" => 7,
			),
		),
	),
	"config" => array(
		array(
			"name" => "images",
			"value" => 1,
		),
		array(
			"name" => "cat",
			"value" => 1,
		),
		array(
			"name" => "use_animation",
			"value" => 1,
		),
		array(
			"name" => "list_img",
			"value" => 1,
		),
		array(
			"name" => "count_list",
			"value" => "3",
		),
		array(
			"name" => "nastr",
			"value" => 10,
		),
		array(
			"name" => "search_text",
			"value" => 1,
		),
		array(
			"name" => "search_name",
			"value" => 1,
		),
		array(
			"name" => "children_elements",
			"value" => 1,
		),
		array(
			"name" => "rel_two_sided",
			"value" => 1,
		),
		array(
			"name" => "add_message",
			"value" => array(
				"Объявление успешно добавлено.",
				"Ad successfully added."
			),
		),
		array(
			"name" => "subject_admin",
			"value" => "Новое объявление на сайте %title (%url)",
		),
		array(
			"name" => "message_admin",
			"value" => "Здравствуйте, администратор сайта %title (%url)!<br>В рубрике Объявления появилось новое объявление:<br>%message",
		),
		array(
			"name" => "images_variations",
			"value" => serialize(array(0 => array('name' => 'medium', 'id' => 1), 1 => array('name' => 'large', 'id' => 3))),
		),
	),
);

$example = array(
	"INSERT INTO {ads_category} (`id`, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, sort, timeedit) VALUES (
	1,
	".multilang("'Продажа бумажных животных',", "'Sale',", "'',")."
	".multilang("'1',")."
	MODULE_SITE_ID,
	1,
	".time().")",

	"INSERT INTO {ads_category} (`id`, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, sort, timeedit) VALUES (
	2,
	".multilang("'Покупка животных',", "'Buy',", "'',")."
	".multilang("'1',")."
	MODULE_SITE_ID,
	2,
	".time().")",

	"INSERT INTO {ads_category} (`id`, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, sort, timeedit) VALUES (
	3,
	".multilang("'Аксессуары',", "'Aksessuars',", "'',")."
	".multilang("'1',")."
	MODULE_SITE_ID,
	3,
	".time().")",
	
	"INSERT INTO {ads_category_rel} (element_id, cat_id) VALUES
	(1,1),(2,2),(3,3),(4,1),(5,1);",

	"INSERT INTO {ads} (`id`, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." created, timeedit) VALUES (
	1,
	".multilang("'Продам таксу',", "'LongDog sale',", "'',")."
	".multilang("'1',")."
	MODULE_SITE_ID,
	1,
	".multilang("'<p>Хорошая такса</p>',", "'',")."
	".multilang("'<p>Есть не просит, выгуливать не надо, можно повесить на стену</p>',", "'',")."
	".(time()-86400*4).",
	".(time()-86400*4).")",

	"INSERT INTO {ads} (`id`, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." created, timeedit) VALUES (
	2,
	".multilang("'Срочно куплю Болонку',", "'',")."
	".multilang("'1',","'0',")."
	MODULE_SITE_ID,
	2,
	".multilang("'Болонка белая, любые деньги',", "'',")."
	".multilang("'Приеду сам, болонку вывезу, деньги с собой.',", "'',")."
	".(time()-86400*3).",
	".(time()-86400*3).")",

	"INSERT INTO {ads} (`id`, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." created, timeedit) VALUES (
	3,
	".multilang("'Продаю бумажную стружку',", "'',")."
	".multilang("'1',","'0',")."
	MODULE_SITE_ID,
	3,
	".multilang("'Разноцветная.',", "'',")."
	".multilang("'Стружку можно сыпать в клетки бумажным животным, они любят там валяться. Возможен опт.',", "'',")."
	".(time()-86400*2).",
	".(time()-86400*2).")",

	"INSERT INTO {ads} (`id`, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." created, timeedit) VALUES (
	4,
	".multilang("'Мартышка из картона',", "'',")."
	".multilang("'1',","'0',")."
	MODULE_SITE_ID,
	1,
	".multilang("'Коричневая',", "'',")."
	".multilang("'В боку застряла скрепка, но мартышка в целом добротная. Сантиметров 15. Смешно дрыгается на сквозняке. Торг.',", "'',")."
	".(time()-86400).",
	".(time()-86400).")",

	"INSERT INTO {ads} (`id`, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." created, timeedit) VALUES (
	5,
	".multilang("'Суслик',", "'',")."
	".multilang("'1',","'0',")."
	MODULE_SITE_ID,
	1,
	".multilang("'<p>Почти новый, розовый</p>',", "'',")."
	".multilang("'<p>Брал тут в магазине, новый. Еще есть гарантия. Смотрите фото</p>',", "'',")."
	".time().",
	".time().")",
	
	"INSERT INTO {ads_param} (id, ".multilang("nameLANG,")." type, sort, required) VALUES
	('1',".multilang("'Имя',", "'Name',", "'',")."'text',5,'1'),
	('2',".multilang("'e-mail',")."'text',6,'1')",
	
	"INSERT INTO {ads_param} (id, ".multilang("nameLANG,")." type, sort, required) VALUES
	('3',".multilang("'Город',", "'Town',", "'',")."'text','1','1','1','1','1','0','','','','','','','0')",
	
	"INSERT INTO {ads_param} (id, ".multilang("nameLANG,")." type, sort, `search`, `list`, ".multilang("measure_unitLANG,")." `block`) VALUES
	('4',".multilang("'Цена',", "'Price',", "'',")."'numtext','2','1','1',".multilang("'руб.',", "'rub.',")."'1')",
	
	"INSERT INTO {ads_param} (id, ".multilang("nameLANG,")." type, sort, `list`) VALUES
	(5,".multilang("'Фотография',", "'Photo',", "'',")."'images',3,'1')",
	
	"INSERT INTO {ads_param} (id, ".multilang("nameLANG,")." type, sort) VALUES
	(6,".multilang("'Продавец',", "'About',", "'',")."'title',4);",
	
	"INSERT INTO {ads_param_category_rel} (element_id, cat_id) VALUES (1,0),(2,0),(3,0),(4,0),(5,0),(6,0)",
	
	"INSERT INTO {ads_param_element} (".multilang("valueLANG,")."param_id, element_id) VALUES
	(".multilang("'prodamtaksu@muil.ru',", "'',")."2,1),
	(".multilang("'1500',", "'',")."4,1),
	(".multilang("'Москва',", "'Moscow',", "'',")."3,1),
	(".multilang("'Воронеж',", "'',")."3,2),
	(".multilang("'2000',", "'',")."4,2),
	(".multilang("'Сергей',", "'',")."1,2),
	(".multilang("'serg@ishubolonku.ru',", "'',")."2,2),
	(".multilang("'Россия',", "'',")."3,3),
	(".multilang("'135',", "'',")."4,3),
	(".multilang("'Антон Павлович',", "'',")."1,3),
	(".multilang("'antpavl@strugkaizbumagi.ru',", "'',")."2,3),
	(".multilang("'Коломна',", "'',")."3,4),
	(".multilang("'2300',", "'',")."4,4),
	(".multilang("'Виолетта',", "'',")."1,4),
	(".multilang("'viola@prodammartishku.ru',", "'',")."2,4),
	(".multilang("'Максим',", "'',")."1,5),
	(".multilang("'900',", "'',")."4,5),
	(".multilang("'Салехард',", "'',")."3,5),
	(".multilang("'Ипполит',", "'',")."1,1),
	(".multilang("'maks@suslikvprodage.ru',", "'',")."2,5);",

	"INSERT INTO {rewrite} VALUES (rewrite, module_name, element_id, site_id) VALUES
	('ads/longdog-sale','ads', 1, MODULE_SITE_ID),
	('ads/pokupka-zhivotnykh','ads', 2, MODULE_SITE_ID),
	('ads/suslik','ads', 5, MODULE_SITE_ID)"
);

/**
 * Выполняет действия для установки примеров заполнения модуля
 * 
 * @return void
 */
function module_example_ads()
{
	DB::query("UPDATE {ads_param} SET `config`='%s' WHERE id=5", "a:1:{i:0;a:2:{s:4:\"name\";s:5:\"large\";s:2:\"id\";s:1:\"1\";}}");
}