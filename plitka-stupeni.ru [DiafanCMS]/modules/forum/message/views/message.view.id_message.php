<?php
/**
 * Сообщение
 *
 * Шаблон сообщения
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

$text = '<form method="POST" class="ajax">
	<a name="'.$result["id"].'"></a>
	<input type="hidden" name="action" value="">
	<input type="hidden" name="ajax" value="">
	<input type="hidden" name="module" value="forum">
	<input type="hidden" name="check_hash_user" value="'.$result["hash"].'">
	<input type="hidden" name="id" value="'.$result["id"].'">';
if ($result["del"])
{
	$text .= '<span class="forum_blocked">';
	if ($result["access_edit_delete"])
	{
		$text .= $this->diafan->_('Модератор %s удалил сообщение «%s»', true, $this->get('author', 'forum', $result["user_update"]), $result["text"]);
	}
	else
	{
		$text .= $this->diafan->_('Сообщение удалено');
	}
	$text .= '</span>
	</form>';
}
else
{
	$text .=
	'<div class="forum_actions">
	<span>
	<a href="#'.$result["id"].'"><img src="'.BASE_PATH.'modules/forum/img/link.gif" title="'.$this->diafan->_('Ссылка', false).'" alt="'.$this->diafan->_('Ссылка', false).'"></a> ';
	if ($result["access_edit_delete"])
	{
		// удалить сообщение
		$text .= '<a href="javascript:void(0)" action="delete_message" title="'.$this->diafan->_('Вы действительно хотите удалить запись?', false).'">'
		.'<img src="'.BASE_PATH.'modules/forum/img/delete.gif" width="15" height="15"'
		.' title="'.$this->diafan->_('Удалить', false).'" alt="'.$this->diafan->_('Удалить', false).'">'
		.'</a>';

		// редактировать сообщение
		$text .= ' <a href="javascript:void(0)" action="edit_message">'
		.'<img src="'.BASE_PATH.'modules/forum/img/edit.gif" title="'.$this->diafan->_('Редактировать', false).'" alt="'.$this->diafan->_('Редактировать', false).'"></a>';
	}
	if ($result["access_block"])
	{
		$text .= ' <a href="javascript:void(0)" action="block_message">'
		.'<img src="'.BASE_PATH.'modules/forum/img/'.($result["act"] ? 'block' : 'unblock').'.gif"
		title="'.(! $result["act"] ? $this->diafan->_('Разблокировать', false) : $this->diafan->_('FORUM_BLOCK', false)).'"
		alt="'.(! $result["act"] ? $this->diafan->_('Разблокировать', false) : $this->diafan->_('FORUM_BLOCK', false)).'"></a>';
	}
	$text .= '</span></div>';

	if (! $result["act"])
	{
		$text .= '<span class="forum_blocked">'.$this->diafan->_('Заблокировано')
					.($result["access_edit_delete"] ? ': '.$result["text"] : '').'</span>
		</form>';
	}
	else
	{
		$text .= '<span class="forum_author">'.$this->get('author', 'forum_message', $result["author"]).'</span>, <span class="forum_date">'.$result['created'];
		if(! empty($result["date_update"]))
		{
			$text .= ', '.$this->diafan->_('редакция').($result["user_update"] ? ': '.$this->get('author', 'forum', $result["user_update"]).',' : '').' '.$result["date_update"];
		}
		$text .= '</span>
		<div class="forum_text">'.$result['text'].'</div>
		<div class="errors error" style="display:none"></div>
		'.$this->get('get_attachments', 'forum_message', $result["attachments"]).'
		</form>';
	}
}
return $text;