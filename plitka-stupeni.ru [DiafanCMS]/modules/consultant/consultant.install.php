<?php
/**
 * Установка модуля "On-line консультант"
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

$title = "On-line консультант";

$db = array(
	"modules" => array(
		array(
			"name" => "consultant",
			"module_name" => "consultant",
			"admin" => true,
			"site" => true,
			"title" => $title,
		),
	),

	"adminsites" => array(
		array(
			"name" => "On-line консультант",
			"rewrite" => "consultant",
			"group_id" => "2",
			"sort" => "9",
			"act" => true,
		),
	),
	"config" => array(
		array(
			"name" => "color",
			"value" => "#aacc66",
		),
		array(
			"name" => "chatX",
			"value" => "30",
		),
		array(
			"name" => "chatY",
			"value" => "50",
		),
		array(
			"name" => "header",
			"value" => "Наша компания",
		),
		array(
			"name" => "topText",
			"value" => "Лучшие товары",
		),
		array(
			"name" => "welcome",
			"value" => "Вам чем-нибудь помочь?",
		),
		array(
			"name" => "inviteTime",
			"value" => "20",
		),
		array(
			"name" => "chatWidth",
			"value" => "200",
		),
		array(
			"name" => "chatHeight",
			"value" => "300",
		),
	),
);