<?php
/**
 * Ошибка на сайте
 * 
 * Шаблон
 * шаблонного тега <insert name="show_block" module="mistakes">
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

echo '<script type="text/javascript" src="' . BASE_PATH . 'modules/mistakes/mistakes.js"></script>';
echo '<div class="mistakes">'.$this->diafan->_('Если Вы заметили ошибку на сайте, выделите ее и нажмите Ctrl+Enter.').'</div>';
echo '<div id="mistakes_comment" style="display:none">
<form method="post" class="mistakes_form ajax">
<input type="hidden" name="ajax" value="0">
<input type="hidden" name="module" value="mistakes">
<input type="hidden" name="url" value="">
<input type="hidden" name="selected_text" value="">
'.$this->diafan->_('Ваш комментарий').':<br>
<textarea name="comment" class="inptext"></textarea>
<br>
<span class="button_wrap"><input type="button" value="'.$this->diafan->_('Отправить', false).'" class="button"></span>
</form>
</div>';