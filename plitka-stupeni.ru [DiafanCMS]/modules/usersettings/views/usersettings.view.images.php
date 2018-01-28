<?php
/**
 * Прикрепленные изображения
 *
 * Шаблон вывода прикрепленных изображений
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

$text = '';
foreach($result["rows"] as $img)
{
	$text .= '<div class="image" name="'.$result["prefix"].'images'.$result["param_id"].'[]"><input type="hidden" name="hide_image_delete[]" value="'.$img["id"].'">';
	$text .= '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'">';
	$text .= ' <a href="#" class="image_delete">x</a> </div>';
}
return $text;