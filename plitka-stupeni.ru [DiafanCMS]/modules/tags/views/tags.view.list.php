<?php
/**
 * Список элементов, к которым прикреплен тег
 *
 * Шаблон списка элементов, к которым прикреплен тег
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

if (empty($result["rows"]))
	return false;

foreach ($result["rows"] as $row)
{
	if (! empty($row["class"]))
	{
		$this->get($row["func"], $row["class"], $row["result"]);
	}
	else
	{
		echo '
		<div class="tags_list">
			<div class="tag_name"><a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a></div>
			<div class="tag_text">'.$row["snippet"].'</div>
		</div>';
	}
}
echo (! empty($result["paginator"]) ? $result["paginator"] : '');