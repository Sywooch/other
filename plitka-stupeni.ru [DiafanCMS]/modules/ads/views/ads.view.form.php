<?php
/**
 * Форма добавления объявления
 *
 * Шаблон формы добавления объявления
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
echo '<div class="ads_form">';
echo '<h2>'.$this->diafan->_('Подать объявление').'</h2>';

echo '<form method="POST" enctype="multipart/form-data" action="" class="ajax">
<input type="hidden" name="module" value="ads">
<input type="hidden" name="ajax" value="0">';

echo '<div class="infofield">'.$this->diafan->_('Название объявления').'<font color="red">*</font>:</div>
<input type="text" name="name" size="40" value="" class="inptext">
<div class="errors error_name"'.($result["error_name"] ? '>'.$result["error_name"] : ' style="display:none">').'</div>';


/*echo '<div class="infofield">'.$this->diafan->_('Показывать на сайте до').'<font color="red">*</font>:</div>
<input type="text" name="date_finish" size="40" value="" class="inptext timecalendar" showTime="false">
<div class="errors error_date_finish"'.($result["error_date_finish"] ? '>'.$result["error_date_finish"] : ' style="display:none">').'</div>';*/

echo '<div class="infofield">'.$this->diafan->_('Краткий анонс').'<font color="red">*</font>:</div>
<textarea name="anons" class="inptext" rows="10" cols="30"></textarea>
<div class="errors error_anons"'.($result["error_anons"] ? '>'.$result["error_anons"] : ' style="display:none">').'</div>';

echo '<div class="infofield">'.$this->diafan->_('Описание объявления').'<font color="red">*</font>:</div>
<textarea name="text" class="inptext" rows="10" cols="30"></textarea>
<div class="errors error_text"'.($result["error_text"] ? '>'.$result["error_text"] : ' style="display:none">').'</div>';


if (count($result["site_ids"]) > 1)
{
	echo '<div class="ads_form_site_ids">
	<span class="infofield">'.$this->diafan->_('Раздел').':</span>
	<select>';
	foreach($result["site_ids"] as $row)
	{
		echo '<option value="'.$row["id"].'" path="'.BASE_PATH_HREF.$row["path"].'"';
		if($result["site_id"] == $row["id"])
		{
			echo ' selected';
		}
		echo '>'.$row["name"].'</option>';
	}
	echo '</select>';
	echo '</div>';
}
else
{
    echo '<input name="site_id" type="hidden" value="'.$result["site_id"].'">';
}

if (count($result["cat_ids"]) > 1)
{
	echo '<div class="ads_form_cat_ids">
	<span class="infofield">'.$this->diafan->_('Категория').':</span>
	<select name="cat_id">';
	foreach($result["cat_ids"] as $row)
	{
		echo '<option value="'.$row["id"].'" site_id="'.$row["site_id"].'"';
		if($result["cat_id"] == $row["id"])
		{
			echo ' selected';
		}
		echo '>';
		if($row["level"])
		{
			echo str_repeat('- ', $row["level"]);
		}
		echo $row["name"].'</option>';
	}
	echo '</select>';
	echo '</div>';
}
else
{
    echo '<input name="cat_id" type="hidden" value="'.$result["cat_id"].'">';
}

if (! empty($result["rows"]))
{
	foreach ($result["rows"] as $row) //вывод полей из конструктора форм
	{
		echo '<div class="ads_form_param ads_form_param'.$row["id"].'" cat_ids="'.$row["cat_ids"].'">';

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

		echo '<div class="ads_form_param_text">'.$row["text"].'</div>';

		if($row["type"] != 'title')
		{
			echo '<div class="errors error_p'.$row["id"].'"'.($result["error_p".$row["id"]] ? '>'.$result["error_p".$row["id"]] : ' style="display:none">').'</div>';
		}
		echo '</div>';
	}
}



//Защитный код
echo $result["captcha"];

//Кнопка Отправить
echo '<div style="margin-top:20px;"><span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить', false).'" class="button" name="button"></span></div>

<div class="required_field"><font color="red">*</font> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>

</form>';
echo '<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>';

if(empty($GLOBALS["include_ads_form_js"]))
{
	$GLOBALS["include_ads_form_js"] = true;
	echo '<script type="text/javascript" src="'.BASE_PATH.'modules/ads/js/ads.form.js"></script>';
}
echo '</div>';