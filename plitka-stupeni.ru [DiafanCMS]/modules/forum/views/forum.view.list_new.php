<?php
/**
 * Список новых сообщений
 *
 * Шаблон страницы новых сообщений
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

echo '<script type="text/javascript" src="'.BASE_PATH.'modules/forum/forum.js"></script>';

if ($result["rows"])
{
	foreach ($result["rows"] as $row)
	{
	echo '
			<div class="forum_message">
				<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["theme"].'</a>
				<br>
				<span class="forum_author">'.$row["author"].'</span>, <span class="forum_date">'.$row['created'].'</span>
				<br>
				'.$row['text'].'
			</div>';
	}
}
echo (!empty($result["paginator"]) ? $result["paginator"] : '');

// форма поиска по темам и сообщениям
$this->get('form_search', 'forum', array("action" => $result["action"]));