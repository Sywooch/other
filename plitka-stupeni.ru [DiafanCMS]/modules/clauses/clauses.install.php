<?php
/**
 * Установка модуля "Статьи"
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

$title = "Статьи";

$db = array(
	"tables" => array(
		array(
			"name" => "clauses",
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
					"name" => "admin_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "access",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
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
				"KEY site_id (site_id)",
			),
		),
		array(
			"name" => "clauses_category",
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
					"name" => "admin_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "access",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
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
			"name" => "clauses_category_rel",
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
			"name" => "clauses_category_parents",
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
			"name" => "clauses_counter",
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
			"name" => "clauses_rel",
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
			"name" => "clauses",
			"module_name" => "clauses",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Статьи",
			"rewrite" => "clauses",
			"group_id" => "1",
			"sort" => "5",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/stati/",
			"children" => array(
				array(
					"name" => "Статьи",
					"rewrite" => "clauses",
					"sort" => "8",
					"act" => true,
				),
				array(
					"name" => "Категории",
					"rewrite" => "clauses/category",
					"sort" => "9",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "clauses/config",
					"sort" => "10",
					"act" => true,
				),
			)
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Article'),
			"act" => true,
			"sort" => 4,
			"module_name" => "clauses",
			"rewrite" => "clauses",
			"menu" => array(
				"cat_id" => 3,
				"sort" => 9,
			),
		),
	),
	"config" => array(
		array(
			"name" => "images",
			"value" => "1",
		),
		array(
			"name" => "list_img",
			"value" => "1",
		),
		array(
			"name" => "use_animation",
			"value" => "1",
		),
		array(
			"name" => "format_date",
			"value" => "2",
		),
		array(
			"name" => "nastr",
			"value" => "10",
		),
		array(
			"name" => "images_variations",
			"value" => serialize(array(0 => array('name' => 'medium', 'id' => 1), 1 => array('name' => 'large', 'id' => 3))),
		),
	),
);

$example = array(
	"UPDATE {site} SET
		".multilang(
			"text1='<p>Наш ведущий рубрики &quot;Статьи&quot; - сторож зоопарка, раз в неделю рассказывает здесь интересные истории, случающиеся с ним периодически.</p>'",

			", text2='<p>Our leader of a heading of &quot;Articles&quot; - the watchman of a zoo, once a week tells here the interesting stories happening with it periodically.</p>'",

			""
		)."
	WHERE module_name='clauses'",

	"INSERT INTO {clauses} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."created, sort, site_id,".multilang("anonsLANG,")." ".multilang("textLANG,")."timeedit) VALUES (
	1,
	".multilang("'Нашествие бабочек',", "'Invasion of butterflies',", "'',")."
	".multilang("'1',")."
	'".(time() - 86400)."',
	2,
	MODULE_SITE_ID,
	".multilang(
		"'Сразу после нового года ко входу в зоопарк прилетела стая желтых бабочек! Мы пытались их отогнать, но бабочки стояли на своем и пролетели в вольер ко льву.',",
		"'Right after new year to an input in a zoo the flight of yellow butterflies has arrived! We tried to drive away them, but butterflies held the ground and have flown by in an open-air cage to a lion.',",
		"'',"
	)."
	".multilang(
		"'<p>Непонятно,&nbsp;как они узнали,&nbsp;что наш лев больше всего на свете любит бабочек? Он с ними может играть с утра до вечера. Просит,&nbsp;чтобы бабочки садились ему на мокрый нос,&nbsp;а потом чихает. Потом опять просит. Бабочки сначала боялись льва,&nbsp;но вскоре привыкли к нему и уже не могут провести дня,&nbsp;не увидя льва. <br />\r\n<br />\r\nОднажды лев заболел. И в назначенное время не вышел играть с бабочками. Бабочки не на шутку испугались и полетели за врачом. Если бы врач пришел чуть позже,&nbsp;то льва бы уже вовсе не было с нами (у него размокла лапа и он не мог ходить). Доктор посушил лапку феном и лев снова смог играть с бабочками. <br />\r\n<br />\r\nА сколько львих он охмурил с помощью бабочек? Не сосчитать. На апоссумов уже стал заглядываться. План охмурения прост до наглости. Бабочка пролетая мимо львихи театрально падала на землю и стонала. Лев подбегал,&nbsp;нежно брал ее в лапы,&nbsp;дул на бабочку и та оживала на глазах изумленно львихи. Потом лев говрил,&nbsp;что от его поцелуя вообще исцеляются все болезни и проходят невзгоды. И все... львиха его. <br />\r\n<br />\r\nВот такая может быть дружба..</p>',",
		"'<p>Not clearly, how they have learnt, what our lion above all loves butterflies? He with them can play all day long. Asks, that butterflies sat down to it on a wet nose, and then sneezes. Then again asks. Butterflies at first were afraid of a lion, but have soon got used to it and cannot spend day any more, not see a lion.<br /><br />Once the lion was ill. And in due time did not leave to play with butterflies. Butterflies outright were frightened and have departed for the doctor. If the doctor has come a bit later the lion already at all would not be with us. The doctor desiccate a pad the hair dryer also is left again could to play with butterflies.<br /><br />And how many lions it deceive by means of butterflies? Not to count. On opossum already began to admire. The plan of deception is simple to impudence. The butterfly flying by by львихи theatrically fell to the ground and groaned. The lion ran up, gently took it in paws, barrels on the butterfly and that revived in the face of with amazement lions. It is Then left talk that all illnesses in general recover from its kiss and pass a hardship. And all... lions it.<br /><br />Here the such can be friendship.</p>',",
		"'',"
	)."
	'".time()."'
	);",

	"INSERT INTO {clauses} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")."created, sort, site_id,".multilang("anonsLANG,")." ".multilang("textLANG,")."timeedit) VALUES (
	2,
	".multilang("'Головоногий пингвин-бобёр',", "'Headfoot penguin-beaver',", "'',")."
	".multilang("'1',")."
	'".time()."',
	1,
	MODULE_SITE_ID,
	".multilang(
		"'Самка слона и ее друг крокодил родили на свет нового обитателя нашего зоопарка - головоногого пингвина-бобра!',",
		"'The female of an elephant and its friend a crocodile have given birth on light of the new inhabitant of our zoo - headfoot to a penguin-beaver!',",
		"'',"
	)."
	".multilang(
		"'<p>Стоит рассказать,&nbsp;как произошла роковая встреча Слонихи и Крокодила. Была черная ночь. Слонихе,&nbsp;как и всегда,&nbsp;нечего было делать и она решила выйти прогуляться по зоопарку. Проходя мимо&nbsp;клетки с крокодилом,&nbsp;она услышала дивную мелодию. Это пел крокодил. Он чистил зубы маленькой птичкой перед сном. Слонихе очень понравился крокодил,&nbsp;и на утро они вдвоем пошли к мастеру по новым животным и попросили сделать им плод их чувств. Мастер долго веретел лист бумаги и,&nbsp;наконец,&nbsp;принялся за работу. <br />\r\n<br />\r\nВ&nbsp;итоге получился зверек,&nbsp;которому впоследствии дали имя Крокослон и отнесли к виду Головоногого пингвина-бобра.</p>',",
		"'<p>It is necessary to tell, how there was a fatal meeting of the Elephant cow and the Crocodile. There was a black night. To an elephant cow, as well as always, there was nothing to do and she has decided to leave to walk on a zoo. Passing by a cage with a crocodile, she has heard a lovely tune. It was sung by a crocodile. It cleaned a teeth a small birdie before a dream. The elephant cow very much liked a crocodile, and for the morning two of them have gone to the master on new animals and have asked to make it a fruit of their feelings. The master long веретел a sheet of paper and, at last, was accepted to work.<br /><br />As a result the small animal to whom Krokoslon subsequently have named has turned out and have carried to a kind of Golovonogogo of a penguin-beaver.</p>',",
		"'',"
	)."
	'".time()."'
	);",
);

/**
 * Выполняет действия для установки примеров заполнения модуля
 * 
 * @return void
 */
function module_example_clauses()
{
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/clauses'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/clauses', 0777);
	}
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/clauses/large'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/clauses/large', 0777);
	}
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/clauses/small'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/clauses/small', 0777);
	}
	$array = array(
		1 => array(1 => 'nashestvie-babochek'),
		2 => array(2 => 'golovonogij-pingvin-bober')
	);
	$module = 'clauses';
	foreach ($array as $k => $a)
	{
		foreach ($a as $id => $name)
		{
			$name = $name.'_'.$id.'.jpg';
			DB::query("INSERT INTO {images} (id, name, module_name, element_id, sort) VALUES ('%d', '%s', '%s', '%d', '%d')", $id, $name, $module, $k, $id);

			if (! file_exists(ABSOLUTE_PATH.USERFILES.'/original/'.$name))
			{
				copy(DEMO_PATH.$module.'/'.$name, ABSOLUTE_PATH.USERFILES.'/original/'.$name);
				copy(ABSOLUTE_PATH.USERFILES.'/original/'.$name, ABSOLUTE_PATH.USERFILES.'/'.$module.'/large/'.$name);
				copy(DEMO_PATH.$module.'/small/'.$name, ABSOLUTE_PATH.USERFILES.'/small/'.$name);
				copy(DEMO_PATH.$module.'/medium/'.$name, ABSOLUTE_PATH.USERFILES.'/'.$module.'/small/'.$name);
			}

			chmod(ABSOLUTE_PATH.USERFILES.'/small/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/original/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/'.$module.'/large/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/'.$module.'/small/'.$name, 0777);
		}
	}
}