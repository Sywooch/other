<?php
/**
 * Отдельная тема в списке категорий
 *
 * Шаблон вывода отдельной темы в категории
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

$row = $result["row"];
$text = '<td class="forum_theme_name';
// в теме есть новые сообщения
if ($row["messages_new"] || $row["theme_news"])
{
	$text .= ' forum_news';
}
$text .= '">';
// тема удалена
if ($row["del"])
{
	$text .= '<span class="forum_blocked">'.$this->diafan->_('Модератор %s удалил тему «%s»', true, $this->get('author', 'forum', $row["user_update"]), '<span class="forum_name">'.$row["name"].'</span>').'</span>';
}
// тема заблокирована
elseif (!$row["act"])
{
	$text .= '<span class="forum_blocked">'.$this->diafan->_('Заблокировано').': '.$row["name"].'</span>';
}
// тема активна
else
{
	$text .= '<a href="'.BASE_PATH_HREF.$row["link"].'" class="forum_name">'.$row["name"].'</a>';
}
$text .= '
	</td>
	<td class="forum_count_message">'
	// ответов новых/всего
	.($row["messages_new"] ? '<span class="forum_active">'.$row["messages_new"].'</span>/' : '').$row["messages"].'
	</td>

	<td class="forum_author_date">';
// автор темы
if ($row["author"])
{
	$text .= '<span class="forum_author">'.$this->get('author', 'forum', $row["author"]).'</span><br>';
}
// дата создания, редакции темы
$text .= '<span class="forum_date">'.$row["created"];
if($row["date_update"])
{
	$text .= ', '.$this->diafan->_('редакция').($row["user_update"] ? ': '.$this->get('author', 'forum', $row["user_update"]).',' : '').' '.$row["date_update"];
}
$text .= '</span>
	</td>
	<td class="forum_last_user">';
// автор и дата последнего сообщения в теме
if ($row["last_user"])
{
	$text .= '<span class="forum_author">'.$this->get('author', 'forum', $row["last_user"]["author"]).'</span><br>
			<span class="forum_date">'.$row["last_user"]["created"].'</span>';
}
$text .= '
	</td>
	<td>';
if ($row["access_edit_delete"] || $row["access_block"])
{
	$text .= '
		<div class="forum_actions">
		<form method="POST" action="" class="ajax">
		<input type="hidden" name="action" value="">
		<input type="hidden" name="ajax" value="">
		<input type="hidden" name="module" value="forum">
		<input type="hidden" name="check_hash_user" value="'.$result["hash"].'">
		<input type="hidden" name="id" value="'.$row["id"].'">
			<span>';
	if ($row["access_edit_delete"])
	{
	// удалить тему
	$text .= '<a href="javascript:void(0)" title="'.$this->diafan->_('Вы действительно хотите удалить запись?', false).'" action="delete-category">'
		.'<img src="'.BASE_PATH.'modules/forum/img/delete.gif" width="15" height="15"'
		.' title="'.$this->diafan->_('Удалить', false).'" alt="'.$this->diafan->_('Удалить', false).'">'
		.'</a>'

		// редактировать тему
		.'<a href="'.BASE_PATH_HREF.$row["link_edit"].'">'
		.'<img src="'.BASE_PATH.'modules/forum/img/edit.gif" width="12" height="14"'
		.' title="'.$this->diafan->_('Редактировать', false).'" alt="'.$this->diafan->_('Редактировать', false).'">'
		.'</a>';
	}
	if ($row["access_block"])
	{
		if ($row["act"])
		{
			// блокировать тему
			$text .= '<a href="javascript:void(0)" action="block-category">'
				.'<img src="'.BASE_PATH.'modules/forum/img/block.gif" width="12" height="18"'
				.' title="'.$this->diafan->_('Заблокировать', false).'" alt="'.$this->diafan->_('Заблокировать', false).'">'
				.'</a>';
		}
		else
		{
			// разблокировать тему
			$text .= '<a href="javascript:void(0)" action="unblock-category">'
				.'<img src="'.BASE_PATH.'modules/forum/img/unblock.gif" width="12" height="18"'
				.' title="'.$this->diafan->_('Разблокировать', false).'" alt="'.$this->diafan->_('Разблокировать', false).'">'
				.'</a>';
		}
		if ($row["close"])
		{
			// открыть тему
			$text .= '<a href="javascript:void(0)" action="open-category">'
				.'<img src="'.BASE_PATH.'modules/forum/img/lock.png" width="16" height="16"'
				.' title="'.$this->diafan->_('Открыть тему', false).'" alt="'.$this->diafan->_('Открыть тему', false).'">'
				.'</a>';
		}
		else
		{
			// закрыть тему
			$text .= '<a href="javascript:void(0)" action="close-category">'
				.'<img src="'.BASE_PATH.'modules/forum/img/lock_off.png" width="16" height="16"'
				.' title="'.$this->diafan->_('Закрыть тему', false).'" alt="'.$this->diafan->_('Закрыть тему', false).'">'
				.'</a>';
		}

		if ($row["prior"])
		{
			// открепить тему
			$text .= '<a href="javascript:void(0)" action="unprior-category">'
				.'<img src="'.BASE_PATH.'modules/forum/img/down.gif" width="14" height="16"'
				.' title="'.$this->diafan->_('Открепить тему', false).'" alt="'.$this->diafan->_('Открепить тему', false).'">'
				.'</a>';
		}
		else
		{
			// закрепить тему
			$text .= '<a href="javascript:void(0)" action="prior-category">'
				.'<img src="'.BASE_PATH.'modules/forum/img/up.gif" width="14" height="16"'
				.' title="'.$this->diafan->_('FORUM_PRIOR', false).'" alt="'.$this->diafan->_('FORUM_PRIOR', false).'">'
				.'</a>';
		}
	}
	$text .= '</span>
			</form>
		</div>';
}
$text .= '</td>';
return $text;