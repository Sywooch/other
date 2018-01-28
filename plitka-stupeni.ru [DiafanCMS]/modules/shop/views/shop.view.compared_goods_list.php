<?php
/**
 * Кнопка «Сравнить выбранные товары»
 *
 * Шаблон вывода кнопки «Сравнить выбранные товары»
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

echo '
<form action="'.BASE_PATH_HREF.$result["shop_link"].'" method="GET" class="shop_compared_goods_list">
<input type="hidden" name="action" value="compare">';
if (isset($_SESSION['compare_list'][$result["site_id"]]))
{
	foreach ($_SESSION['compare_list'][$result["site_id"]] as $id => $dummy)
	{
		echo '<input type="hidden" name="ids[]" value="'.$id.'" class="shop_compared_goods_'.$id.'">';
	}
}
echo '
<span class="button_wrap">
<input type="submit" value="'.$this->diafan->_('Сравнить выбранные товары', false).'"   class="shop_compare_all_button button">
</span>
</span>
</form>';