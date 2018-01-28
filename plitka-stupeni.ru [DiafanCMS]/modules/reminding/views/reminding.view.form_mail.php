<?php
/**
 * Форма восстановления доступа
 *
 * Шаблон формы восстановления доступа
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
<form method="POST" action="" class="reminding_form ajax">
<input type="hidden" name="ajax" value="">
<input type="hidden" name="action" value="mail">
<input type="hidden" name="module" value="reminding">
'.$result["action"].'

<div class="infofield">'.$this->diafan->_('Введите ваш e-mail').'<font color="red">*</font>:</div>
<input type = "text" maxLength="70" name="mail" size="40" class="inptext" value=""><br>
<div class="errors error_mail"'.($result["error_mail"] ? '>'.$result["error_mail"] : ' style="display:none">').'</div>

'.$result["captcha"].'

<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить', false).'" class="button"></span>

<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>

<div class="required_field"><font color="red">*</font> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>

</form>';