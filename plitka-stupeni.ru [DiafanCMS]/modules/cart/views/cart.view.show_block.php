<?php
/**
 * Блок корзины
 *
 * Шаблон
 * шаблонного тега <insert name="show_block" module="cart" [template="шаблон"]>:
 * выводит информацию о заказанных товарах
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

echo '<img src="/img/ico_cart.png" />';
echo '<a class="crt" href="' . $result["link"] . '" rel="nofollow">' . $this->diafan->_('Корзина:') . '</a>';

echo '<span id="show_cart">'.$this->get('info', 'cart', $result).'</span>';