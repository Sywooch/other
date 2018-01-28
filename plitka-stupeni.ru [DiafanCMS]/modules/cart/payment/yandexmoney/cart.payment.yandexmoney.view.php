<?php
/**
 * @package    Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/includes/404.php';
}

/**
 * Шаблон платежа через систему YandexMoney
 */

echo $this->result["text"];
?>
<form id="pay" name="pay" method="POST" action="<?php echo $this->result["test"] ? 'http://demomoney.yandex.ru/eshop.xml' : 'https://money.yandex.ru/eshop.xml'; ?>">
	<input class="wide" name="scid" value="<?php echo $this->result["scid"]; ?>" type="hidden">
	<input type="hidden" name="ShopID" value="<?php echo $this->result["shopid"]; ?>">
	<input type="hidden" name="Sum" value="<?php echo $this->result["summ"]; ?>">
	<input type="hidden" name="LMI_PAYMENT_DESC" value=" <?php echo $this->result["desc"]; ?>">
	<input type="hidden" name="orderNumber" value="<?php echo $this->result["order_id"]; ?>">
	<p><input type="submit" value="<?php echo $this->diafan->_('Оплатить', false);?>"></p>
</form>