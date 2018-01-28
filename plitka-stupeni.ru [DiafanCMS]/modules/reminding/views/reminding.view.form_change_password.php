<?php
/**
 * Форма смены пароля
 *
 * Шаблон формы смены пароля
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

switch($result["result"])
{
    case "incorrect":
	echo '<p>'.$this->diafan->_('Извините, вы не можете воспользоваться этой ссылкой.').'</p>';
	break;

    case "block":
	echo '<p>'.$this->diafan->_('Пользователь заблокирован.').'</p>';
	break;

    case "old":
	echo '<p>'.$this->diafan->_('Извините, время действия ссылки закончилось.').'</p>';
	break;

    case "success":
	echo '
	<form method="POST" action="" class="reminding_form ajax">
	<input type="hidden" name="ajax" value="">
	<input type="hidden" name="action" value="change_password">
	<input type="hidden" name="module" value="reminding">
	'.$result["action"].'
	<input type="hidden" name="code" value="'.$result["code"].'">
	<input type="hidden" name="user_id" value="'.$result["user_id"].'">
	
	<div class="infofield">'.$this->diafan->_('Введите новый пароль').'<font color="red">*</font>:</div>
	<input type="password" maxLength="70" name="password" size="40" class="inptext" value="">
	<div class="errors error_password"'.($result["error_password"] ? '>'.$result["error_password"] : ' style="display:none">').'</div>
	
	<div class="infofield">' . $this->diafan->_('Повторите пароль').'<font color="red">*</font>:</div>
	<input type="password" maxLength="70" name="password2" size="40" class="inptext">

	<br>
	<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить', false).'" class="button"></span>

	<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>

	<div class="required_field"><font color="red">*</font> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>

	</form>';
	break;
}