<?php
/**
 * Установка модуля "Файловый архив"
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

$title = "Файловый архив";

$db = array(
	"tables" => array(
		array(
			"name" => "files",
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
					"name" => "link",
					"type" => "VARCHAR( 255 ) NOT NULL DEFAULT ''",
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
			"name" => "files_rel",
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
			"name" => "files_category",
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
			"name" => "files_category_parents",
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
			"name" => "files_category_rel",
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
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY cat_id (cat_id)",
			),
		),
		array(
			"name" => "files_counter",
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
			"name" => "files",
			"module_name" => "files",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Файловый архив",
			"rewrite" => "files",
			"group_id" => "1",
			"sort" => "7",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/fajlovyj_arxiv/",
			"children" => array(
				array(
					"name" => "Файлы",
					"rewrite" => "files",
					"sort" => "14",
					"act" => true,
				),
				array(
					"name" => "Категории",
					"rewrite" => "files/category",
					"sort" => "15",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "files/config",
					"sort" => "16",
					"act" => true,
				),
			)
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Files'),
			"act" => true,
			"sort" => 5,
			"module_name" => "files",
			"rewrite" => "files",
			"menu" => array(
				"cat_id" => 3,
				"sort" => 8,
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
			"name" => "nastr",
			"value" => "20",
		),
		array(
			"name" => "count_list",
			"value" => "3",
		),
		array(
			"name" => "attachment_extensions",
			"value" => "doc, gif, jpg, jpeg, mpg, pdf, png, txt, zip",
		),
		array(
			"name" => "images_variations",
			"value" => serialize(array(0 => array('name' => 'medium', 'id' => 1), 1 => array('name' => 'large', 'id' => 3))),
		),
	),
);

$example = array(
	"UPDATE {site} SET
		".multilang("nameLANG='Жизнь зоопарка'", ", nameLANG='Zoo life'", "")."
		".multilang(", titleLANG='Материалы зоопарка'", ", titleLANG='Zoo life'", "")."
		".multilang(
			", textLANG='<p>В этой рубрике можно найти всякие секретные материалы нашего зоопарка. Это и архивы, и тексты, и картинки. Все доступно для скачивания на локальный компьютер, имеет расширенные описания и картинки.</p>'",
	
			", textLANG='<p>It is possible to find any confidential materials of our zoo in this heading. It both archives, and texts, and pictures. All is accessible to downloading on the local computer, has the expanded descriptions and pictures.</p>'",
	
			""
		)."
	WHERE module_name='files'",

	"INSERT INTO {files} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, ".multilang("anonsLANG,")." sort, timeedit) VALUES (
		1,
		".multilang("'Кони Прежевалинского-Россомахина',", "'Przewalski-Rossomahin\\'s horses',", "'',")."
		".multilang("'1',")."
		MODULE_SITE_ID,
		".multilang(
			"'<p>Эти кони представлены несколькими особями в нашем зоопарке, от наиболее крупных, до мелких, но также весьма выносливых.</p>',",

			"'<p>These horses are presented by several individuals in our zoo, from the largest, to small, but also rather hardy.</p>',",

			"'',"
		)."
		1,
		'".time()."'
	);",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('files/przewalski-rossomahin', 'files', 1, MODULE_SITE_ID)",

	"INSERT INTO {files} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, ".multilang("anonsLANG,")." sort, timeedit) VALUES (
		2,
		".multilang("'Рогатые кони',", "'Horned horses',", "'',")."
		".multilang("'1',")."
		MODULE_SITE_ID,
		".multilang(
			"'<p>Очень интересный подвид коней - рогатые кони, т.е. кони с рогами! Качайте наш файл с материалами, знакомьтесь!</p>',",

			"'<p>Very interesting subspecies of horses - horned horses, i.e. horses with horns! Swing our file with materials, get acquainted!</p>',",

			"'',"
		)."
		2,
		'".time()."'
	);",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('files/horned', 'files', 2, MODULE_SITE_ID)",

	"INSERT INTO {files} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, ".multilang("anonsLANG,")." sort, timeedit) VALUES (
		3,
		".multilang("'Фотографии экстравертов',", "'Photos of extroverts',", "'',")."
		".multilang("'1',")."
		MODULE_SITE_ID,
		".multilang(
			"'<p>Все фотографии зверей в одном .zip-архиве! Качайте, сохраняйте!</p>',",

			"'<p>All photo of animals in one.zip-archive! Swing, keep!</p>',",

			"'',"
		)."
		3,
		'".time()."'
	);",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('files/photos-of-extroverts', 'files', 3, MODULE_SITE_ID)",

	"INSERT INTO {files} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." site_id, ".multilang("anonsLANG,")." sort, timeedit) VALUES (
		4,
		".multilang("'Компромат на медведя',", "'The compromising evidence on a bear',", "'',")."
		".multilang("'1',")."
		MODULE_SITE_ID,
		".multilang(
			"'<p>Медведь застукан на месте преступления!!! Сенсация. Качать всем.</p>',",

			"'<p>The bear is caught on a scene of crime!!! Sensation. To swing all.</p>',",

			"'',"
		)."
		4,
		'".time()."'
	);",

	"INSERT INTO {rewrite} (rewrite, module_name, element_id, site_id) VALUES ('files/bear', 'files', 4, MODULE_SITE_ID)",

	"INSERT INTO {attachments} (id, name, module_name, element_id, extension, size) VALUES (
		1,
		'koni-prezhevalinskogo-rossomaxina.txt',
		'files',
		'1',
		'text/plain',
		60
	)",

	"INSERT INTO {attachments} (id, name, module_name, element_id, extension, size) VALUES (
		2,
		'rogatye-koni.txt',
		'files',
		'2',
		'application/zip',
		1745
	)",

	"INSERT INTO {attachments} (id, name, module_name, element_id, extension, size) VALUES (
		6,
		'kompromat-na-medvedya.txt',
		'files',
		'4',
		'text/plain',
		97
	);"

);

/**
 * Выполняет действия для установки примеров заполнения модуля
 * 
 * @return void
 */
function module_example_files()
{
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/files'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/files', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/files/files'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/files/files', 0777);
	}

	$text = 'Options -Indexes

<files *>
deny from all
</files>';

	$fp = fopen(ABSOLUTE_PATH.USERFILES.'/files/files/.htaccess', "w");
	fwrite($fp, $text);
	fclose($fp);
	chmod(ABSOLUTE_PATH.USERFILES.'/files/files/.htaccess', 0777);

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/files/large'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/files/large', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/files/small'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/files/small', 0777);
	}

	$array = array(
		1 => 'Кони Пржеваниского-Россомахина - одни из самых лучших коней!',
		2 => 'Под "Рогатыми конями" скрываются просто олени и горные козлы.'
	);

	foreach ($array as $k => $a)
	{
		$fp = fopen(ABSOLUTE_PATH.USERFILES.'/files/files/'.$k, "w");
		fwrite($fp, $a);
		fclose($fp);
	}

	if (! file_exists(ABSOLUTE_PATH.USERFILES.'/files/files/fotografii-ekstravertov.zip'))
	{
		copy(DEMO_PATH.'files/files/fotografii-ekstravertov.zip',
		     ABSOLUTE_PATH.USERFILES.'/files/files/fotografii-ekstravertov.zip');
	}

	$array = array(
		1 => array(15 => 'koni-prezhevalinskogo-rossomaxina', 16 => 'koni-prezhevalinskogo-rossomaxina', 17 => 'koni-prezhevalinskogo-rossomaxina'),
		2 => array(18 => 'rogatye-koni', 19 => 'rogatye-koni'),
		3 => array(20 => 'fotografii-intravertov', 21 => 'fotografii-intravertov'),
		4 => array(22 => 'kompromat')
	);
	$module = 'files';
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