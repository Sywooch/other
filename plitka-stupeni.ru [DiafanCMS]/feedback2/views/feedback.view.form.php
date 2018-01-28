<?php
/**
 * Форма добавления сообщения в обратной связи
 *
 * Шаблон формы добавления сообщения в обратной связи
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

echo '
<div class="feedback_form">
<form method="POST" enctype="multipart/form-data" action="" class="ajax">
<input type="hidden" name="module" value="feedback">
<input type="hidden" name="site_id" value="'.$result["site_id"].'">
<input type="hidden" name="ajax" value="0">';

if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row) //вывод полей из конструктора форм
	{
		echo '<div class="feedback_form_param'.$row["id"].'">';

		switch ($row["type"])
		{
			case 'title':
				echo '<div class="infoform">'.$row["name"].':</div>';
				break;

			case 'text':
			case "email":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<input type="text" name="p'.$row["id"].'" size="40" value="" class="inptext">';
				break;

			case 'textarea':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<textarea name="p'.$row["id"].'" class="inptext" rows="10" cols="30"></textarea>';
				break;

			case 'date':
			case 'datetime':
				$timecalendar  = true;
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
					<input type="text" name="p'.$row["id"].'" size="20" value="" class="inptext timecalendar" showTime="'
					.($row["type"] == 'datetime'? 'true' : 'false').'">';
				break;

			case 'numtext':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<input type="text" name="p'.$row["id"].'" size="5" value="" class="inpnum">';
				break;

			case 'checkbox':
				echo '<div class="infofield"><input type="checkbox" name="p'.$row["id"].'" value="1" class="inpcheckbox">
				'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').'</div>';
				break;

			case 'select':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<select name="p'.$row["id"].'" class="inpselect">
					<option value="">-</option>';
				foreach ($row["select_array"] as $select)
				{
					echo '<option value="'.$select["id"].'">'.$select["name"].'</option>';
				}
				echo '</select>';
				break;

			case 'multiple':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				foreach ($row["select_array"] as $select)
				{
					echo '<br><input name="p'.$row["id"].'[]" value="'.$select["id"].'" type="checkbox" class="inpcheckbox"> '.$select["name"];
				}
				break;

			case "attachments":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				echo '<div class="inpattachment"><input type="file" name="attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				echo '<div class="inpattachment" style="display:none"><input type="file" name="hide_attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				if ($row["attachment_extensions"])
				{
					echo '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$row["attachment_extensions"].')</div>';
				}
				break;

			case "images":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				echo '<input type="file" name="images'.$row["id"].'" class="inpfiles">';
				break;
		}

		echo '<div class="feedback_form_param_text">'.$row["text"].'</div>';

		echo '</div>';

		if($row["type"] != 'title')
		{
			echo '<div class="errors error_p'.$row["id"].'"'.($result["error_p".$row["id"]] ? '>'.$result["error_p".$row["id"]] : ' style="display:none">').'</div>';
		}
	}
}

//Защитный код
echo $result["captcha"];

//Кнопка Отправить
echo '<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить', false).'" class="button" name="button"></span>

<div class="required_field"><font color="red">*</font> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>

</form>';
echo '<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>
</div>';