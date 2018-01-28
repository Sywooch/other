<?php
/**
 * Редактирование
 *
 * Шаблон формы редактирования данных
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

echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>'.$this->diafan->_('Редактирование', false).'</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="'.BASE_PATH.'modules/useradmin/useradmin.edit.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="http://yandex.st/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://yandex.st/jquery/form/2.83/jquery.form.min.js"></script>
	<script type="text/javascript" src="'.BASE_PATH.'modules/useradmin/useradmin.edit.js"></script>
	<script type="text/javascript" src="'.BASE_PATH.'adm/htmleditor/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="'.BASE_PATH.'adm/htmleditor/tiny_mce/plugins/images/images_init.php"></script>
	<script type="text/javascript" src="'.BASE_PATH.'adm/htmleditor/tiny_mce/config.js"></script>
</head>
<body>
	<form method="POST" action="'.BASE_PATH.ADMIN_FOLDER.'/" class="useradmin_form">
	<input type="hidden" name="module" value="useradmin">
	<input type="hidden" name="action" value="save">
	<input type="hidden" name="name" value="'.$result["name"].'">
	<input type="hidden" name="element_id" value="'.$result["element_id"].'">
	<input type="hidden" name="module_name" value="'.$result["module_name"].'">
	<input type="hidden" name="lang_module_name" value="'.$result["lang_module_name"].'">
	<input type="hidden" name="check_hash_user" value="'.$result["hash"].'">
	<input type="hidden" name="lang_id" value="'.$result["lang_id"].'">
	'.($result["is_lang"] ? '<input type="hidden" name="is_lang" value="true">' : '').'
	<input type="hidden" name="type" value="'.$result["type"].'">';
	switch($result["type"])
	{
		case 'textarea':
			echo '<textarea name="value" style="width:100%; height:310px">'.$result["text"].'</textarea><br>';
			break;
		case 'editor':
			echo '<input type="checkbox" name="typograf" value="1"> '.$this->diafan->_('Типограф', false).'<textarea name="value"'.($this->diafan->_user->htmleditor ? ' class="htmleditor"' : '').' style="width:400px; height:300px">'.$result["text"].'</textarea>';
			break;
		case 'date':
			if (! $result["text"])
			{
				$result["text"] = time();
			}
			echo '<input name="value" type="text" value="'.date("d.m.Y H:i", $result["text"]).'" size="20" class="timecalendar">';
			break;
		case 'text':
			echo '<input name="value" type="text" value="'.$result["text"].'" size="60">';
			break;
		case 'numtext':
			echo '<input name="value" type="text" value="'.$result["text"].'" size="20" class="inpnum">';
			break;
	}
	if ($result["error"])
	{
		echo '<div class="errors">'.$result["error"].'</div>';
	}
	echo '
	<input style="margin-top:5px;" type="submit" value="'.$this->diafan->_('Сохранить', false).'" class="useradmin_button">
	</form>
</body>
</html>';