<?php
/**
 * Данные, доступные для редактирования
 *
 * Шаблон вывода данных, доступных для редактирования с помощью панели быстрого редактирования
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

$text = '<span class="useradmin_contener tmp1" href="'
.($result["module_name"] == "languages" ? BASE_PATH_HREF : BASE_PATH)
.'useradmin/edit/?module_name='.$result["module_name"]
.'&amp;name='.urlencode($result["name"])
.'&amp;element_id='.$result["element_id"]
.'&amp;lang_id='.$result["lang_id"]
.'&amp;type='.$result["type"]
.'&amp;rand='.rand(0, 999);

if($result["is_lang"])
{
	$text .= '&amp;is_lang=true&amp;lang_module_name='.$result["lang_module_name"];
}
$text .= '&amp;iframe=true&amp;';

switch($result["type"])
{
	case 'editor':
	case 'textarea':
		$text .= 'width=800&amp;height=600';
		break;
	case 'date':
		$text .= 'width=300&amp;height=250';
		break;
	case 'text':
	case 'numtext':
		$text .= 'width=600&amp;height=120';
		break;
}
$text .= '">'.$result["text"].'</span>';
return $text;