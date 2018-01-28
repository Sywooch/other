<?php
/**
 * Форма добавления сообщения
 *
 * Шаблон формы добавления сообщения
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

$text = '<form method="POST" action="" class="forum_message_form ajax" id="forum_messages'.($result["parent_id"] ? $result["parent_id"].'_result' : '').'">';
	if ($result["premoderation"])
	{
		$text .= '<p>'.$this->diafan->_('Сообщение будет активировано на сайте после проверки модератором').'</p>';
	}
	$text .= '
	<input type="hidden" name="module" value="forum">
	<input type="hidden" name="action" value="upload_message">
	<input type="hidden" name="ajax" value="">
	<input type="hidden" name="check_hash_user" value="'.$result["hash"].'">
	<input type="hidden" name="parent_id" value="'.$result["parent_id"].'">';

// Имя
if ($result["field_name"])
{
	$text .= '<div class="infofield">'.$this->diafan->_('Ваше имя').'<font color="red">*</font>:</div>
	<input type = "text" maxLength="70" name="name" size="40" class="inptext" value=""><br>
	<div class="errors error_name"'.($result["error_name"] ? '>'.$result["error_name"] : ' style="display:none">').'</div>';
}
	$text .= $this->get('get', 'bbcode', array("name" => "message", "tag" => "message_".$result["parent_id"], "value" => ""));

// Прикрепляемые файлы
if ($result["add_attachments"])
{
	$text .= '
	<div class="infofield">'.$this->diafan->_('Прикрепляемый файл').':</div>
	<div class="inpattachment"><input type="file" name="attachments[]" class="inpfiles" max="'.$result["max_count_attachments"].'"></div>
	<div class="inpattachment" style="display:none"><input type="file" name="hide_attachments[]" class="inpfiles" max="'.$result["max_count_attachments"].'"></div>';
	if ($result["attachment_extensions"])
	{
		$text .= '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$result["attachment_extensions"].')</div>';
	}
	$text .= '<div class="errors error_attachments"'.(! empty($result["error_attachments"]) ? '>'.$result["error_attachments"] : ' style="display:none">').'</div>';
}

//Защитный код
$text .= $result["captcha"];

//Кнопка Отправить

	$text .= '<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить',  false).'" class="button"></span>';

	$text .= '<div class="errors error"'.(! empty($result["error"]) ? '>'.$result["error"] : ' style="display:none">').'</div>
</form>';

return $text;