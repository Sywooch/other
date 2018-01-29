<?php
/**
 *
 * Layout for the payment selection
 *
 * @package	Magazin
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: select_payment.php 5451 2012-02-15 22:40:08Z alatak $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

?>

<?php
if (rsConfig::get('oncheckout_show_steps', 1)) {
    echo '<div class="checkoutStep" id="checkoutStep3">' . RText::_('COM_RETINASHOP_USER_FORM_CART_STEP3') . '</div>';
}
?>
<form method="post" id="paymentForm" name="choosePaymentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
<?php
	echo "<h1>".RText::_('COM_RETINASHOP_CART_SELECT_PAYMENT')."</h1>";
	if($this->cart->getInCheckOut()){
		$buttonclass = 'button rs-button-correct';
	} else {
		$buttonclass = 'default';
	}
?>
<div class="buttonBar-right">
<button class="<?php echo $buttonclass ?>" type="submit"><?php echo RText::_('COM_RETINASHOP_SAVE'); ?></button>
     &nbsp;
<button class="<?php echo $buttonclass ?>" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_retinashop&view=cart'); ?>'" ><?php echo RText::_('COM_RETINASHOP_CANCEL'); ?></button>
    </div>
<?php
     if ($this->found_payment_method) {


    echo "<fieldset>";
		foreach ($this->paymentplugins_payments as $paymentplugin_payments) {
		    if (is_array($paymentplugin_payments)) {
			foreach ($paymentplugin_payments as $paymentplugin_payment) {
			    echo $paymentplugin_payment.'<br />';
			}
		    }
		}
    echo "</fieldset>";

    } else {
	 echo "<h1>".$this->payment_not_found_text."</h1>";
    }


    ?>

    <input type="hidden" name="option" value="com_retinashop" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="setpayment" />
    <input type="hidden" name="controller" value="cart" />
</form>