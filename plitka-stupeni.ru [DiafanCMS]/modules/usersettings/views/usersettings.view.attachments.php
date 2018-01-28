<?php
/**
 * Прикрепленные файлы
 *
 * Шаблон вывода прикрепленных файлов в настройках аккаунта
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
foreach($result["rows"] as $a)
{
	$text .= '<div class="attachment" name="'.$result["prefix"].'attachments'.$result["param_id"].'[]"><input type="hidden" name="hide_attachment_delete[]" value="'.$a["id"].'">';
	if ($a["is_image"])
	{
		if($result["use_animation"])
		{
			$text .= ' <a href="'.$a["link"].'" rel="prettyPhoto[gallery'.$result["param_id"].'registration]"><img src="'.$a["link_preview"].'"></a> <a href="'.$a["link"].'" rel="prettyPhoto[gallery'.$result["param_id"].'registration_link]">'.$a["name"].'</a>';
		}
		else
		{
			$text .= ' <a href="'.$a["link"].'"><img src="'.$a["link_preview"].'"></a> <a href="'.$a["link"].'">'.$a["name"].'</a>';
		}
	}
	else
	{
		$text .= '<a href="'.$a["link"].'">'.$a["name"].'</a>';
	}
	$text .= ' <a href="#" class="attachment_delete">x</a> </div>';
}
return $text;