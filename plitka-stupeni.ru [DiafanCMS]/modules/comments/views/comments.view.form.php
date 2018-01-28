<?php
/**
 * Форма добавление комментария
 *
 * Шаблон формы добавления комментария
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

$text = '
<div class="comments_form">
<form method="POST" action="" id="comments'.($result["parent_id"] ? $result["parent_id"].'_result' : '').'" class="ajax">
<input type="hidden" name="module" value="comments">
<input type="hidden" name="parent_id" value="'.$result["parent_id"].'">
<input type="hidden" name="ajax" value="0" class="ajax">';

if(! $result["parent_id"])
{
	$text .= '<div class="block_header">'.$this->diafan->_('Оставьте комментарий').'</div>';
}

if (! empty($result["params"]))
{
	foreach ($result["params"] as $row)
	{
		$text .= '<div class="comments_form_param'.$row["id"].'">';

		switch ($row["type"])
		{
			case 'title':
				$text .= '<div class="infoform">'.$row["name"].':</div>';
				break;

			case 'text':
			case "email":
				$text .= '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<input type="text" name="p'.$row["id"].'" size="40" value="" class="inptext">';
				break;

			case 'textarea':
				$text .= '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<textarea name="p'.$row["id"].'" class="inptext" rows="10" cols="30"></textarea>';
				break;

			case 'date':
			case 'datetime':
				$timecalendar  = true;
				$text .= '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
					<input type="text" name="p'.$row["id"].'" size="20" value="" class="inptext timecalendar" showTime="'
					.($row["type"] == 'datetime'? 'true' : 'false').'">';
				break;

			case 'numtext':
				$text .= '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<input type="text" name="p'.$row["id"].'" size="5" value="" class="inpnum">';
				break;

			case 'checkbox':
				$text .= '<div class="infofield"><input type="checkbox" name="p'.$row["id"].'" value="1" class="inpcheckbox">
				'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').'</div>';
				break;

			case 'select':
				$text .= '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<select name="p'.$row["id"].'" class="inpselect">
					<option value="">-</option>';
				foreach ($row["select_array"] as $select)
				{
					$text .= '<option value="'.$select["id"].'">'.$select["name"].'</option>';
				}
				$text .= '</select>';
				break;

			case 'multiple':
				$text .= '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				foreach ($row["select_array"] as $select)
				{
					$text .= '<br><input name="p'.$row["id"].'[]" value="'.$select["id"].'" type="checkbox" class="inpcheckbox"> '.$select["name"];
				}
				break;

			case "attachments":
				$text .= '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				$text .= '<div class="inpattachment"><input type="file" name="attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				$text .= '<div class="inpattachment" style="display:none"><input type="file" name="hide_attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				if ($row["attachment_extensions"])
				{
					$text .= '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$row["attachment_extensions"].')</div>';
				}
				break;

			case "images":
				$text .= '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				$text .= '<input type="file" name="images'.$row["id"].'" class="inpfiles">';
				break;
		}
		if($row["text"])
		{
			$text .= '<div class="comments_form_param_text">'.$row["text"].'</div>';
		}
		$text .= '</div>';
		$text .= '<div class="errors error_p'.$row["id"].'"'.($result["error_p".$row["id"]] ? '>'.$result["error_p".$row["id"]] : ' style="display:none">').'</div>';
	}
}

if($result["bbcode"])
{
	$text .= $this->get('get', 'bbcode', array("name" => "comment", "tag" => "comments".$result["parent_id"], "value" => ""));
}
else
{
	$text .= '<textarea name="comment" class="inptextarea"></textarea>';
}
$text .= '<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>';
$text .= '<br>';

//Защитный код
$text .= $result["captcha"];

//Кнопка Отправить
$text .= '<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить', false).'" class="button"></span>

<div class="required_field"><font color="red">*</font> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>

</form>
</div>';

return $text;
