<?php
/**
 * Изображения к странице сайта
 *
 * Шаблон
 * шаблонного тега <insert name="show_images" module="site" [template="шаблон"]>:
 * выводит изображения, прикрепленные к старинце сайта
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

if (empty($result["images"]))
{
	return;
}
foreach ($result["images"] as $img)
{
	switch($img["type"])
	{
		case 'animation':
			echo '<a href="'.BASE_PATH.$img["link"].'" rel="prettyPhoto[gallery'.$result["id"].'site]">';
			break;
		case 'big_image':
			echo '<a href="'.BASE_PATH.$img["link"].'" rel="big_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
			break;
		default:
			echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
			break;
	}
	echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">'
	.'</a> ';
}
