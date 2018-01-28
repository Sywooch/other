<?php
/**
 * Первая страница модуля
 *
 * Шаблон первой страницы форума
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

if (!empty($result["new_message"]))
{
	echo '<div class="forum_new_messages"><a href="?new=1">'.$this->diafan->_('Непрочитанные сообщения').' ('.$result["new_message"].')</a></div>';
}

echo '<table class="forum_list">
		<tr><th>'.$this->diafan->_('Разделы').'</th><th>'.$this->diafan->_('Тем').'</th><th>'.$this->diafan->_('Последнее сообщение').'</th></tr>';
// категории тем. первый уровень
foreach ($result["cats"] as $cat)
{
	echo '<tr><td class="forum_title" colspan="3">'.$cat["name"].'</td></tr>';
	// категории тем. второй уровень
	foreach ($cat["rows"] as $row)
	{
	echo '
			<tr>
				<td class="forum_category_name';
	// в теме есть новые сообщения
	if ($row["theme_news"])
	{
		echo ' forum_news';
	}
	echo '">
					<a href="'.BASE_PATH_HREF.$row["link"].'">'.$row["name"].'</a>
				</td>
				<td  class="forum_count">'
	// количество тем в категории
	.$row["count_caregory"].'
				</td>
				<td class="forum_last_theme">';
	// последняя обсуждаемая тема в категории
	if ($row["last_theme"])
	{
		// название последней темы
		echo '<a href="'.BASE_PATH_HREF.$row["last_theme"]["link"].'">'.$row["last_theme"]["name"].'</a>';
		if ($row["last_theme"]["message_update"])
		{
		// дата последней темы
		echo '<br><span class="forum_date">'.$row["last_theme"]["message_update"].'</span>';
		}
	}
	echo '
				</td>
			</tr>';
	$themes = true;
	}
}
echo '
	</table>';
if (empty($themes))
{
	echo '<div class="errors">'.$this->diafan->_('Обязательно создайте главные категории форума!').'</div>';
}

// форма поиска по темам и сообщениям
$this->get('form_search', 'forum', array("action" => $result["action"]));