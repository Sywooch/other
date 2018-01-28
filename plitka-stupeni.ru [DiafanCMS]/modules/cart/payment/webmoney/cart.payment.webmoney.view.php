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
 * Шаблон платежа через систему WebMoney
 */
echo $this->result["text"];
echo '<form id="pay" name="pay" method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp">
<b>'.$this->diafan->_('Платеж на %d WMR', false, $this->result["summ"]).'</b> &nbsp;
<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="'.$this->result['summ'].'">
<input type="hidden" name="LMI_PAYMENT_DESC" value="'.$this->result['desc'].'">
<input type="hidden" name="LMI_PAYMENT_NO" value="'.$this->result["order_id"].'">
<input type="hidden" name="LMI_PAYEE_PURSE" value="'.$this->result["wm_target"].'">';
if (isset($this->result["LMI_SIM_MODE"]))
{
	echo '<input type="hidden" name="LMI_SIM_MODE" value="'.$this->result["LMI_SIM_MODE"].'">';
}
echo '<input type="hidden" name="RND" value="'.$this->result["rnd"].'">
<p><input type="submit" value="'.$this->diafan->_('Оплатить', false).'"></p>
</form>';