<?php
/**
 * Облако тегов
 *
 * Шаблон
 * шаблонного тега <insert name="show_block" module="tags" [template="шаблон"]>:
 * облако тегов
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

if (! $result["rows"])
	return false;

echo '<div class="tags_block">';

if (! $result["title_no_show"])
{
	echo '<div class="block_header">'.$this->diafan->_('Теги').'</div>';
}

foreach ($result["rows"] as $row)
{
	if (! $row["selected"])
	{
		echo '
		<a href="'.BASE_PATH_HREF.$row["link"].'" style="font-size: '.$row["size"].'em;">'.$row["name"].'</a> ';
	}
	else
	{
		echo '
		<span style="font-size: '.$row["size"].'em;">'.$row["name"].'</span> ';
	}
}

echo '</div>';