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
 * Шаблон платежа через систему QIWI
 */

if(! empty($this->result["from_qiwi"]))
{
	echo '<p>'.$this->diafan->_('Подтвердить оплату', false).':</p>';
	echo '<form id="rpay'.$this->result["order_id"].'" name="pay'.$this->result["order_id"].'" method="POST" action="">
	<input type="hidden" name="qiwi_id" value="'.$this->result["order_id"].'"> 
	<input type="submit" name="Submit" value="'.$this->diafan->_('Оплатить', false).'">
	</form>';
}
else
{
	echo $this->result["text"];
	?>
	<form name="pay" method="POST" target="_blank" action="http://w.qiwi.ru/setInetBill_utf.do">
		<?php echo $this->diafan->_('Введите номер Вашего телефона, зарегистрированного в системе Qiwi, без 8, 10 цифр, например, 9061231212', false);?>:<br>
		<input type="text" name="to" value="" size="30">  &nbsp; 
		<input type="hidden" name="summ" value="<?php echo $this->result["summ"]; ?>">
		<input type="hidden" name="com" value=" <?php echo $this->result["desc"]; ?>">
		<input type="hidden" name="txn_id" value="<?php echo $this->result["order_id"]; ?>">
		<input type="hidden" name="from" value="<?php echo $this->result["qiwi_id"];?>">
		<p><input type="submit" value="<?php echo $this->diafan->_('Оплатить', false);?>"></p>
	</form>
	<?php
}