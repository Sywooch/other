<?php
/**
 * Шаблон каптчи
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

$text = '';

$codeint = rand(1111, 9999);
if (! $result["update"])
{
	$text .= '<div class="captcha">';
}
$text .= '<div class="captcha_enter">'.$this->diafan->_('Введите защитный код').'</div>
<img src="'.BASE_PATH.(IS_ADMIN ? ADMIN_FOLDER.'/' : '').'captcha/get/'.$result["modules"].$codeint.'" width="120" height="60" class="code_img"><br>
<input type="hidden" name="captchaint" value="'.$codeint.'">
<input type="hidden" name="update" value="">

<div class="captcha_update"><a href="javascript:void(0)">'.$this->diafan->_('Обновить защитный код').'</a></div>
<div class="captcha_input"><input type="text" name="captcha" value="" autocomplete="off"></div>

<div class="errors error_captcha"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>';
if (! $result["update"])
{
	$text .= '</div>';
}
return $text;