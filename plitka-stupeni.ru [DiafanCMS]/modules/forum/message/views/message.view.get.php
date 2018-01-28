<?php
/**
 * Список и форма добавления сообщения
 *
 * Шаблон списка и формы добавления сообщений модуля
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
if (! empty($result["close"]))
{
	$text .= '<div class="forum_active">'.$this->diafan->_('Тема закрыта').'</div>';
}
$text .= '<input type="hidden" name="check_hash_user" value="'.$result["hash"].'">';
$text .= '<div class="forum_messages"'.(empty($result["rows"]) ? ' style="display:none"' : '').'>';
if (! empty($result["rows"]))
{
	$text .= $this->get('list', 'forum_message', $result["rows"]);
}
$text .= '</div>';

if($result["form"])
{
	$text .= '<br><br>'.$this->get('form', 'forum_message', $result["form"]);
}

return $text;