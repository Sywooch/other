<?php
/**
 *
 * Template for the shipment selection
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
 * @version $Id: cart.php 2400 2010-05-11 19:30:47Z milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

?>

<?php
if (rsConfig::get('oncheckout_show_steps', 1)) {
    echo '<div class="checkoutStep" id="checkoutStep2">' . RText::_('COM_RETINASHOP_USER_FORM_CART_STEP2') . '</div>';
}
?>
<form method="post" id="userForm" name="chooseShipmentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
<?php

	echo "<h1>".RText::_('COM_RETINASHOP_CART_SELECT_SHIPMENT')."</h1>";
	if($this->cart->getInCheckOut()){
		$buttonclass = 'button rs-button-correct';
	} else {
		$buttonclass = 'default';
	}
	?>
	<div class="buttonBar-right">

	        <button class="<?php echo $buttonclass ?>" type="submit" ><?php echo RText::_('COM_RETINASHOP_SAVE'); ?></button>  &nbsp;
	<button class="<?php echo $buttonclass ?>" type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_retinashop&view=cart'); ?>'" ><?php echo RText::_('COM_RETINASHOP_CANCEL'); ?></button>
	</div>
<?php
    if ($this->found_shipment_method) {


	   echo "<fieldset>\n";
	// if only one Shipment , should be checked by default
	    foreach ($this->shipments_shipment_rates as $shipment_shipment_rates) {
		if (is_array($shipment_shipment_rates)) {
		    foreach ($shipment_shipment_rates as $shipment_shipment_rate) {
			echo $shipment_shipment_rate."<br />\n";
		    }
		}
	    }
	    echo "</fieldset>\n";
    } else {
	 echo "<h1>".$this->shipment_not_found_text."</h1>";
    }

    ?>

    <input type="hidden" name="option" value="com_retinashop" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="setshipment" />
    <input type="hidden" name="controller" value="cart" />
</form>
