<?php
/**
 * Кнопка «Сравнить»
 *
 * Шаблон вывода кнопки «Сравнить» для товаров
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

$checked = empty($_SESSION['compare_list'][$result["site_id"]][$result["id"]]) ? false : true;
echo '
<form method="post" action="" method="POST">
<input type="hidden" name="action" value="compare_goods">
<input type="hidden" name="shop_compare_id" value="' . $result["id"] . '">
<input type="hidden" name="shop_compare_site_id" value="' . $result["site_id"] . '">
<input type="hidden" name="module" value="shop">
<input type="hidden" name="ajax" value="0">
<span class="shop_compare_contaner ' . ($checked ? ' shop_compare_checked ' : '') . '">
<input type="hidden" name="shop_compare_add" value="' . ($checked ? '1' : '0') . '">
<input type="button" class="shop_compare_button" value="' . $this->diafan->_('Сравнить', false) . '">
</span>
</form>';

if(empty($GLOBALS["include_shop_js"]))
{
	$GLOBALS["include_shop_js"] = true;
	echo '<script type="text/javascript" src="'.BASE_PATH.'modules/shop/shop.js"></script>';
}