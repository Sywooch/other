<?php
/**
 * Форма добавления сообщения
 *
 * Шаблон формы добавления личного сообщения
 *
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (!defined('DIAFAN'))
{
    include(dirname(dirname(dirname(__FILE__))).'/includes/404.php');
}

echo '<form method="POST" action="" id="messages" class="ajax messages_form">
<div class="block_header">'.$this->diafan->_('Добавить сообщение').'</div>
<input type="hidden" name="module" value="messages">
<input type="hidden" name="to" value="'.$result["to"].'">
<input type="hidden" name="redirect" value="'.(! empty($result["redirect"]) ? $result["redirect"] : '').'">
<input type="hidden" name="ajax" value="0" class="ajax">';

echo $this->get('get', 'bbcode', array("name" => "message", "tag" => "message", "value" => ""));

echo '<br>
<span class="button_wrap"><input type="submit" value="'.$this->diafan->_('Отправить', false).'" class="button"></span>
<div class="errors error"'.(!empty($result["error"]) ? '>'.$result["error"] : ' style="display:none">').'</div>
</form>';