<?php
/**
 * Блок вывода формы подписки на рассылки
 * 
 * Шаблон
 * шаблонного тега <insert name="show_form" module="subscribtion" [template="шаблон"]>:
 * блок вывода формы подписки на рассылки
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
<div class="subscribtion_form">
<h2>'.$this->diafan->_('Подписаться на рассылку').'</h2>
<form method="POST" enctype="multipart/form-data" action="" class="ajax">
<input type="hidden" name="module" value="subscribtion">
<input type="hidden" name="action" value="add">
<input type="hidden" name="ajax" value="0">
<input type="text" name="mail">
<span class="button_wrap">
<input type="submit" class="button" value="'.$this->diafan->_('Ок', false).'">
</span>
<div class="errors error_mail" style="display:none"></div>
</form>
<div class="errors error" style="display:none"></div>
</div>';


