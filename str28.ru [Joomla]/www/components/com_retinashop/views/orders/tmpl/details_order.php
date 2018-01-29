<?php
/**
 *
 * Order detail view
 *
 * @package	Magazin
 * @subpackage Orders
 * @author Oscar van Eijk, Valerie Isaksen
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: details_order.php 5341 2012-01-31 07:43:24Z alatak $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

?>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
	<td   class="orders-key"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PO_NUMBER') ?></td>
	<td class="orders-key" align="left">
	    <?php echo $this->orderdetails['details']['BT']->order_number; ?>
	</td>
    </tr>
    <tr>
	<td class=""><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PO_DATE') ?></td>
	<td align="left"><?php echo rsJsApi::date($this->orderdetails['details']['BT']->created_on, 'LC4', true); ?></td>
    </tr>
    <tr>
	<td class=""><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PO_STATUS') ?></td>
	<td align="left"><?php echo $this->orderstatuses[$this->orderdetails['details']['BT']->order_status]; ?></td>
    </tr>
    <tr>
	<td class=""><?php echo RText::_('COM_RETINASHOP_LAST_UPDATED') ?></td>
	<td align="left"><?php echo rsJsApi::date($this->orderdetails['details']['BT']->modified_on, 'LC4', true); ?></td>
    </tr>
    <tr>
	<td class=""><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_SHIPMENT_LBL') ?></td>
	<td align="left"><?php
	    echo $this->shipment_name;
	    ?></td>
    </tr>
    <tr>
	<td class=""><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_PAYMENT_LBL') ?></td>
	<td align="left"><?php echo $this->payment_name; ?>
	</td>
    </tr>

	 <tr>
    <td><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_CUSTOMER_NOTE') ?></td>
    <td valign="top" align="left" width="50%"><?php echo $this->orderdetails['details']['BT']->customer_note; ?></td>
</tr>

     <tr>
	<td class="orders-key"><?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_TOTAL') ?></td>
	<td class="orders-key" align="left"><?php echo $this->currency->priceDisplay($this->orderdetails['details']['BT']->order_total); ?></td>
    </tr>

    <tr>
	<td colspan="2"> &nbsp;</td>
    </tr>
    <tr>
	<td valign="top"><strong>
	    <?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_BILL_TO_LBL') ?></strong> <br/>
	    <table border="0"><?php
	    foreach ($this->userfields['fields'] as $field) {
		if (!empty($field['value'])) {
		    echo '<tr><td class="key">' . $field['title'] . '</td>'
		    . '<td>' . $field['value'] . '</td></tr>';
		}
	    }
	    ?></table>
	</td>
	<td valign="top" ><strong>
	    <?php echo RText::_('COM_RETINASHOP_ORDER_PRINT_SHIP_TO_LBL') ?></strong><br/>
	    <table border="0"><?php
	    foreach ($this->shipmentfields['fields'] as $field) {
		if (!empty($field['value'])) {
		    echo '<tr><td class="key">' . $field['title'] . '</td>'
		    . '<td>' . $field['value'] . '</td></tr>';
		}
	    }
	    ?></table>
	</td>
    </tr>
</table>
