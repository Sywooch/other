<?php
/**
 * Поля из конструктора формы
 *
 * Шаблон вывода дополнительных полей в форме регистрации / редактирования данных
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

$name = $result["name"];
$prefix = $result["prefix"];

if (!empty($result[$name]))
{
	foreach ($result[$name] as $row)
	{
		$value = !empty($result["user"]['p' . $row["id"]]) ? $result["user"]['p' . $row["id"]] : '';

		if (empty($value) && !empty($row['value']))
			$value = $row['value'];
		echo '<div class="param' . $prefix . $row["id"];
		if(! empty($result["param_role_rels"][$row["id"]]))
		{
		    echo ' param_role_rels param_role_'.implode(' param_role_', $result["param_role_rels"][$row["id"]]);
		}
		echo '">';

		switch ($row["type"])
		{
			case 'title':
				echo '<div class="infoform">'.$row["name"].':</div>';
				break;

			case 'text':
			case "email":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<input type="text" name="'.$prefix.'p'.$row["id"].'" size="40" value="'.$value.'" class="inptext">';
				break;

			case 'textarea':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<textarea name="'.$prefix.'p'.$row["id"].'" class="inptext" rows="10" cols="30">'.$value.'</textarea>';
				break;

			case 'date':
			case 'datetime':
				$timecalendar  = true;
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
					<input type="text" name="'.$prefix.'p'.$row["id"].'" size="20" value="'.$value.'" class="inptext timecalendar" showTime="'
					.($row["type"] == 'datetime'? 'true' : 'false').'">';
				break;

			case 'numtext':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<input type="text" name="'.$prefix.'p'.$row["id"].'" size="5" value="'.$value.'" class="inpnum">';
				break;

			case 'checkbox':
				echo '<div class="infofield"><input type="checkbox" name="'.$prefix.'p'.$row["id"].'" value="1" class="inpcheckbox"'.($value ? ' checked' : '').'>
				'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').'</div>';
				break;

			case 'select':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>
				<select name="'.$prefix.'p'.$row["id"].'" class="inpselect">
					<option value="">-</option>';
				foreach ($row["select_array"] as $select)
				{
					echo '<option value="'.$select["id"].'"'.($value == $select["id"] ? ' selected' : '').'>'.$select["name"].'</option>';
				}
				echo '</select>';
				break;

			case 'multiple':
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				foreach ($row["select_array"] as $select)
				{
					echo '<br><input name="'.$prefix.'p'.$row["id"].'[]" value="'.$select["id"].'" type="checkbox" class="inpcheckbox"'.($value && in_array($select["id"], $value) ? ' checked' : '').'> '.$select["name"];
				}
				break;

			case "attachments":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				if(! empty($result[$prefix.'attachments'][$row["id"]]))
				{
					echo $this->get('attachments', 'registration', array("rows" => $result[$prefix.'attachments'][$row["id"]], "prefix" => $prefix, "param_id" => $row["id"], "use_animation" => $row["use_animation"]));
				}
				if(empty($result[$prefix.'attachments'][$row["id"]]) || count($result[$prefix.'attachments'][$row["id"]]) < $row["max_count_attachments"])
				{
					echo '<div class="inpattachment"><input type="file" name="'.$prefix.'attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				}

				echo '<div class="inpattachment" style="display:none"><input type="file" name="hide_'.$prefix.'attachments'.$row["id"].'[]" class="inpfiles" max="'.$row["max_count_attachments"].'"></div>';
				if ($row["attachment_extensions"])
				{
					echo '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$row["attachment_extensions"].')</div>';
				}
		
				break;

			case "images":
				echo '<div class="infofield">'.$row["name"].($row["required"] ? '<font color="red">*</font>' : '').':</div>';
				if(! empty($result[$prefix.'images'][$row["id"]]))
				{
					echo $this->get('images', 'registration', array("rows" => $result[$prefix.'images'][$row["id"]], "prefix" => $prefix, "param_id" => $row["id"]));
				}
				echo '<input type="file" name="'.$prefix.'images'.$row["id"].'" class="inpfiles">';
				break;
		}

		echo '<div class="registration_form_param_text">' . $row["text"] . '</div>
		<div class="errors error_' . $prefix . 'p' . $row["id"] . '"' . ($result["error_" . $prefix . "p" . $row["id"]] ? '>' . $result["error_" . $prefix . "p" . $row["id"]] : ' style="display:none">') . '</div>
		</div>';
	}
}