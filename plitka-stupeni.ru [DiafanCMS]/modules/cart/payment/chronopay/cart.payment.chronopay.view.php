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
 * Шаблон платежа через систему ChronoPay
 */

echo $this->result["text"];
?>

<form action="https://payments.chronopay.com/" method="POST">
<input type="hidden" name="product_id" value="<?php echo $this->result["product_id"]; ?>" />
<input type="hidden" name="product_price" value="<?php echo $this->result["summ"]; ?>" />
<input type="hidden" name="order_id" value="<?php echo $this->result["order_id"]; ?>" />
<input type="hidden" name="cb_url" value="<?php echo $this->result['link'];?>" />
<input type="hidden" name="cb_type" value="P" />
<input type="hidden" name="success_url" value="<?php echo $this->result['link'].'success/';?>" />
<input type="hidden" name="decline_url" value="<?php echo $this->result['link'].'fail/';?>" />
<input type="hidden" name="sign" value="<?php echo $this->result['shared_sec']?>" />
<input type="submit" value="<?php echo $this->diafan->_('Оплатить', false);?>" />
</form>