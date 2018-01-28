<?php
/**
 * Форма активации купона
 * 
 * Шаблон
 * шаблонного тега <insert name="show_add_coupon" module="shop" [template="шаблон"]>:
 * форма активации купона
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

echo '
<div class="shop_block_coupon">
<form method="post" action="" class="shop_form ajax">
<input type="hidden" name="action" value="add_coupon">
<input type="hidden" name="module" value="shop">
<input type="hidden" name="ajax" value="">
'.$this->diafan->_('Код купона на скидку').'
<input type="text" class="inptext" value="" name="coupon" size="20">
<span class="button_wrap"><input type="submit" class="button" value="'.$this->diafan->_('Активировать', false).'"></span>
<div class="errors error"' . ($result["error"] ? '>' . $result["error"] : ' style="display:none">') . '</div>
</form>
</div>';