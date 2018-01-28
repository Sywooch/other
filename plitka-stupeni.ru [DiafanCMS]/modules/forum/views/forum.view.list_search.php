<?php
/**
 * Список найденных сообщений
 * 
 * Шаблон вывода результатов поиска сообщений
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

echo '
	<div class="forum_search_result">
		'.$this->diafan->_('Всего найдено').": <b>".$result["value"].": ".$result["count"]."</b>
		<br>
		".$this->diafan->_('Документы: <strong>%d—%d</strong> из %d найденных', true, $result["count"] ? 1 : 0, $result["count-page"], $result["count"]).'
	</div>';

if ($result["rows"])
{
	foreach ($result["rows"] as $row)
	{
	if ($row["type"] == "message")
	{
		echo '
				<div class="forum_message">
					<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["theme"].'</a>
					<br>
					<span class="forum_author">'.$this->get('author', 'forum', $row["author"]).'</span>, <span class="forum_date">'.$row['created'].'</span>
					<br>
					'.$row['text'].'
				</div>';
	}
	else
	{
		echo '
				<div class="forum_category">
					<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["theme"].'</a>
					<br>
					<span class="forum_author">'.$this->get('author', 'forum', $row["author"]).'</span>, <span class="forum_date">'.$row['created'].'</span>
				</div>';
	}
	}
}
echo (!empty($result["paginator"]) ? $result["paginator"] : '');

// форма поиска по темам и сообщениям
$this->get('form_search', 'forum', array("action" => $result["action"], "value" => $result["value"]));