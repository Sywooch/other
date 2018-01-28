<?php
/**
 * Информация о товарах в корзине
 *
 * Шаблон вывода информации о товарах в корзине
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */
if (! defined('DIAFAN'))
{
    include dirname(dirname(dirname(__FILE__))) . '/includes/404.php';
}

$text = '<a href="'.$result["link"].'" class="colichestvo">' . $result["count_goods_in_cart"] . '</a>
<span class="text_cart_box">товаров  на ' . $result["summ"] . ' ' . $result["currency"] . '</span>';


/*
$text = $this->diafan->_('товаров %s на %s', true, ' <span class="cart_count">' . $result["count"] . '</span> ', ' <span class="cart_summ">' . $result["summ"] . '</span>&nbsp;' . $result["currency"]
);  
*/