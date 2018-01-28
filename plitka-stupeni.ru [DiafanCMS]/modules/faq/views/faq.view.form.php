<?php
/**
 * Форма добавления вопроса
 *
 * Шаблон формы добавления вопроса
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

echo '<div class="faq_form">
<form method="POST" action="" enctype="multipart/form-data" class="ajax">
<input type="hidden" name="module" value="faq">
<input type="hidden" name="site_id" value="'.$result["site_id"].'">
<input type="hidden" name="cat_id" value="'.$result["cat_id"].'">
<input type="hidden" name="ajax" value="0">';

//заголовок блока
echo '<div class="block_header">'.$this->diafan->_('Задайте Ваш вопрос').'</div>';

//имя
echo '<div class="infofield">'.$this->diafan->_('Ваше имя').'<font color="red">*</font>:</div>
<input type = "text" maxLength="70" name="name" size="40" class="inptext" value=""><br>
<div class="errors error_name"'.($result["error_name"] ? '>'.$result["error_name"] : ' style="display:none">').'</div>';

//вопрос
echo '<div class="infofield">'.$this->diafan->_('Ваш вопрос').'<font color="red">*</font>:</div>
<textarea rows="10" name="question" cols="30" class="inptext"></textarea><br>
<div class="errors error_question"'.($result["error_question"] ? '>'.$result["error_question"] : ' style="display:none">').'</div>';

//e-mail
echo '<div class="infofield">'.$this->diafan->_('Ваш e-mail для ответа').':</div>
<input type = "text" maxLength="70" name="email" size="40" class="inptext" value=""><br>
<div class="errors error_email"'.($result["error_email"] ? '>'.$result["error_email"] : ' style="display:none">').'</div>';

//прикрепляемые файлы
if ($result["attachments"])
{
	echo '<div class="infofield">'.$this->diafan->_('Прикрепляемый файл').':</div>
	<div class="inpattachment"><input type="file" name="attachments[]" class="inpfiles" max="'.$result["max_count_attachments"].'"></div>
	<div class="inpattachment" style="display:none"><input type="file" name="hide_attachments[]" class="inpfiles" max="'.$result["max_count_attachments"].'"></div>';
	if ($result["attachment_extensions"])
	{
		echo '<div class="attachment_extensions">('.$this->diafan->_('Доступные типы файлов').': '.$result["attachment_extensions"].')</div>';
	}
	echo '<div class="errors error_attachments"'.($result["error_attachments"] ? '>'.$result["error_attachments"] : ' style="display:none">').'</div><br>';
}

//защитный код
echo $result["captcha"];

//кнопка "Отправить"
echo '<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить', false).'" class="button" name="button"></span>

<div class="required_field"><font color="red">*</font> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>

</form>';
echo '<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>
</div>';
