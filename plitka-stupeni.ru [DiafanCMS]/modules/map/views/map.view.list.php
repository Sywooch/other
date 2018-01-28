<?php
/**
 * Карта сайта
 *
 * Шаблон списка страниц
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

if ($result)
{
	foreach ($result as $row)
	{
		echo '<p style="margin-left:'.$row["margin"].'px;"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></p>';
	}
}