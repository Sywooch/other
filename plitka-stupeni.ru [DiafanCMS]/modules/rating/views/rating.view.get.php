<?php
/**
 * Рейтинг
 *
 * Шаблон рейтинга элемента
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

$text = '<span class="rating_votes" module_name="'.$result["module_name"].'" element_id="'.$result["element_id"].'"'
.($result["disabled"] ? ' disabled="disabled"' : '').'>';
for ($i = 0; $i < $result["rating"]; $i++)
{
	$text .= '<img src="'.BASE_PATH.'modules/rating/img/rplus.png" alt="+" width="16" height="16">';
}
for ($i = 0; $i < 5 - $result["rating"]; $i++)
{
	$text .= '<img src="'.BASE_PATH.'modules/rating/img/rminus.png" alt="-" width="16" height="16">';
}
$text .= '</span>';

if(empty($GLOBALS["include_rating_js"]))
{
	$GLOBALS["include_rating_js"] = true;
	$text .= '<script type="text/javascript" src="' . BASE_PATH .'modules/rating/rating.js"></script>';
}

return $text;