<?php
/**
 * Форма редактирования сообщения
 *
 * Шаблон формы редактирования сообщения
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

if (! $result["access_add"])
	return;

$text = '<form method="POST" action="" class="forum_message_form ajax">';
if ($result["premoderation"])
{
	$text .= '<p>'.$this->diafan->_('Сообщение будет активировано на сайте после проверки модератором').'</p>';
}
$text .= '<input type="hidden" name="module" value="forum">
<input type="hidden" name="action" value="save_message">
<input type="hidden" name="ajax" value="">
<input type="hidden" name="check_hash_user" value="'.$result["hash"].'">
<input type="hidden" name="save_id" value="'.$result["id"].'">';

// Имя
if ($result["field_name"])
{
	$text .= '<div class="infofield">'.$this->diafan->_('Ваше имя').'<font color="red">*</font>:</div>
	<input type = "text" maxLength="70" name="name" size="40" class="inptext" value="'.$result["name"].'"><br>
	<div class="errors error_name" style="display:none"></div>';
}
$text .= $this->get('get', 'bbcode', array("name" => "message", "tag" => "message".$result["id"], "value" => $result["text"]));

//Прикрепляемые файлы
if (! empty($result["attachments"]["access"]))
{
	$text .= '<div class="infofield">'.$this->diafan->_('Прикрепляемый файл').':</div>
	<div class="inpattachment"><input type="file" name="attachments[]" class="inpfiles" max="'.$result["attachments"]["max_count_attachments"].'"></div>
	<div class="inpattachment" style="display:none"><input type="file" name="hide_attachments[]" class="inpfiles" max="'.$result["attachments"]["max_count_attachments"].'"></div>
	<div class="errors error_attachments" style="display:none"></div>';
	if ($result["attachments"]["attachment_extensions"])
	{
		$text .= '<span class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$result["attachments"]["attachment_extensions"].')</span>';
	}
	$text .= $this->get('get_attachments', 'forum_message', $result["attachments"]);
}
$text .= '<br><br>

<div class="errors error" style="display:none"></div>';
$text .= '<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить', false).'" class="button"></span>';
$text .= '</form>';
return $text;
