<?php
/**
 * Прикрепленные файлы
 *
 * Шаблон вывода прикрепленных к сообщению файлов
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(__FILE__)))).'/includes/404.php';
}

$text = '';
if(empty($result["rows"]))
{
	return;
}
foreach ($result["rows"] as $row)
{
	if ($row["is_image"])
	{
		if ($result["use_animation"])
		{
			$a_href  = '<a href="'.$row["link"].'" rel="prettyPhoto[gallery'.$row["element_id"].$row["module_name"].'_1]">';
			$a_href2 = '<a href="'.$row["link"].'" rel="prettyPhoto[gallery'.$row["element_id"].$row["module_name"].'_2]">';
		}
		else
		{
			$a_href .= '<a href="'.$row["link"].'" rel="large_image" width="'.$row["width"].'" height="'.$row["height"].'">';
			$a_href2 = $a_href;
		}
		$text .=
		'<p id="attachment'.$row["id"].'">'
			.$a_href.$row["name"].'</a>'
			.' ('.$row["size"].')'
			.' '.$a_href2.'<img src="'.$row["link_preview"].'"></a>'
			.($result["access"] ? ' <a href="javascript:void(0)" class="delete_attachment" del_id="'.$row["id"].'" title="'.$this->diafan->_('Вы действительно хотите удалить запись?', false).'">x</a>' : '')
		.'</p>';
	}
	else
	{
		$text .= '<p id="attachment'.$row["id"].'"><a href="'.$row["link"].'">'.$row["name"].'</a> ('.$row["size"].')'
		.($result["access"] ? ' <a href="javascript:void(0)" class="delete_attachment" del_id="'.$row["id"].'" title="'.$this->diafan->_('Вы действительно хотите удалить запись?', false).'">x</a>' : '')
		.'</p>
		';
	}
}
return $text;