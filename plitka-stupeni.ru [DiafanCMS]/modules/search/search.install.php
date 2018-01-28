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
 * Search_install
 *
 * Установка модуля "Поиск"
 */
$title = 'Поиск';
 $db = array(
	"tables" => array(
		array(
			"name" => "search_results",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "name",
					"type" => "varchar(255) NOT NULL",
				),
				array(
					"name" => "url",
					"type" => "varchar(255) NOT NULL",
				),
				array(
					"name" => "snippet",
					"type" => "varchar(255) NOT NULL",
				),
				array(
					"name" => "element_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "table_name",
					"type" => "varchar(50) NOT NULL",
				),
				array(
					"name" => "lang_id",
					"type" => "tinyint(2) unsigned NOT NULL",
				),
				array(
					"name" => "rating",
					"type" => "tinyint(2) unsigned NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "search_keywords",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "keyword",
					"type" => "varchar(255) NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY ( `keyword` ( 3 ) )",
			),
		),
		array(
			"name" => "search_index",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "keyword_id",
					"type" => "int(11) unsigned NOT NULL",
				),
				array(
					"name" => "result_id",
					"type" => "int(11) unsigned NOT NULL",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY keyword_id (`keyword_id`)",
			),
		),
		array(
			"name" => "search_history",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "int(11) unsigned NOT NULL auto_increment",
				),
				array(
					"name" => "created",
					"type" => "INT( 10 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "name",
					"type" => "text NOT NULL DEFAULT ''",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "search",
			"module_name" => "search",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'Search'),
			"act" => true,
			"sort" => 8,
			"module_name" => "search",
			"map_no_show" => true,
			"noindex" => true,
			"search_no_show" => true,
			"rewrite" => "search",
		),
	),
	"adminsites" => array(
		array(
			"name" => "Поиск по сайту",
			"rewrite" => "search",
			"group_id" => "1",
			"sort" => "10",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/poisk/",
			"children" => array(
				array(
					"name" => "Индексация",
					"rewrite" => "search",
					"sort" => "1",
					"act" => true,
				),
				array(
					"name" => "История поиска",
					"rewrite" => "search/history",
					"sort" => "2",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "search/config",
					"sort" => "3",
					"act" => true,
				),
			)
		),
	),
	"config" => array(
		array(
			"name" => "nastr",
			"value" => "10",
		),
		array(
			"name" => "count_history",
			"value" => "10",
		),
	),
);

/**
 * Выполняет действия по установке модуля
 * 
 * @return void
 */
function module_basic_search()
{
	/*
	$diafan = new stdClass();
	$modules = array();
	$dir = opendir(ABSOLUTE_PATH."modules");
	while (($file = readdir($dir)) !== false)
	{
		if (! $file != '.' && $file != '..' && file_exists(ABSOLUTE_PATH.'modules/'.$file.'/'.$file.'.search.php'))
		{
			$modules[] = $file;
		}
	}
	closedir($dir);

	if(empty($modules))
	{
		return; 
	}
	include_once ABSOLUTE_PATH.'modules/search/admin/search.admin.index.php';
	$search_admin_index = new Search_admin_index($diafan);
	foreach($modules as $module)
	{
		$search_admin_index->config = array(
			
		);
	}*/
}