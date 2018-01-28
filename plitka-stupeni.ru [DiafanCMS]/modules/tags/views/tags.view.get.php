<?php
/**
 * Список тегов
 *
 * Шаблон списка прикрепленных к элементу тегов
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

$text = '';
if (! empty($result))
{
	$k = 0;
	$text .= '
	<div class="tags"><span class="tags_header">'.$this->diafan->_('Теги').':</span> ';
	foreach ($result as $row)
	{
		$text .= ($k ? ', ' : '').'<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a>
		';
		$k++;
	}
	$text .= '</div>';
}
return $text;