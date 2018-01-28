<?php
/**
 * Форма редактирования/добавления категории
 *
 * Шаблон редактировани/добавления категории
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

echo ($result["premoderation"] ? '<p>'.$this->diafan->_('Тема будет активирована на сайте после проверки модератором.').'</p>' : '').'

<form action="" method="POST" class="ajax forum_form">
<input type="hidden" name="ajax" value="0">
<input type="hidden" name="module" value="forum">
<input type="hidden" name="action" value="'.$result["action"].'">
<input type="hidden" name="id" value="'.$result["id"].'">
<input type="hidden" name="parent_id" value="'.$result["parent_id"].'">
<input type="hidden" name="check_hash_user" value="'.$result["hash"].'">

<div class="infofield">'.$this->diafan->_('Название').':</div>
<input type="text" name="name" size="40" value="'.$result["name"].'" class="inptext">
<div class="errors error_name"'.($result["error_name"] ? '>'.$result["error_name"] : ' style="display:none">').'</div>

'.($result["captcha"] ? $result["captcha"] : '').'

<span class="button_wrap"><input type="submit" value="'.(!$result["name"] ? $this->diafan->_('Создать', false) : $this->diafan->_('SAVE', false)).'" class="button"></span>
<div class="errors error"'.($result["error"] ? '>'.$result["error"] : ' style="display:none">').'</div>

</form>';