<?php
/**
 * Сообщение и кнопка «Ответить»
 *
 * Шаблон сообщения с формой ответа на него и списком ответов
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

$text = '<div class="forum_message forum_message'.$result["id"].'">';
$text .= $this->get('id_message', 'forum_message', $result);
$text .= '</div>';

if($result["form"])
{
	$text .= '
	<a href="javascript:void(0)" class="forum_message_show_form">'.$this->diafan->_('Ответить').'</a>
	<div style="display:none;" class="forum_message_block_form forum_message'.$result["id"].'_block_form">';
	$text .= $this->get('form', 'forum_message', $result["form"]);
	$text .= '</div>';
}

if ($result["children"])
{
	$text .= '<div class="forum_message_level forum_messages'.$result["id"].'_result">'.$this->get('list', 'forum_message', $result["children"]).'</div>';
}
else
{
	$text .= '<div class="forum_message_level forum_messages'.$result["id"].'_result" style="display:none;"></div>';
}
return $text;