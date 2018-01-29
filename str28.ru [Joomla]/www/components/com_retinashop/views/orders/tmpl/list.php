<?php
/**
*
* Orderlist
* NOTE: This is a copy of the edit_orderlist template from the user-view (which in turn is a slighly
*       modified copy from the backend)
*
* @package	Magazin
* @subpackage Orders
* @author Oscar van Eijk
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: list.php 5434 2012-02-14 07:59:10Z electrocity $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
?>
<h1><?php echo RText::_('COM_RETINASHOP_ORDERS_VIEW_DEFAULT_TITLE'); ?></h1>
<?php
if (count($this->orderlist) == 0) {
	//echo RText::_('COM_RETINASHOP_ACC_NO_ORDER');
	 echo shopFunctionsF::getLoginForm(false,true);
} else {
 ?>
<div id="editcell">
	<table class="adminlist" width="80%">
	<thead>
	<tr>
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_ORDER_NUMBER'); ?>
		</th>
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_CDATE'); ?>
		</th>
		<!--th>
			<?php //echo RText::_('COM_RETINASHOP_ORDER_LIST_MDATE'); ?>
		</th -->
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_STATUS'); ?>
		</th>
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_TOTAL'); ?>
		</th>
	</thead>
	<?php
		$k = 0;
		foreach ($this->orderlist as $row) {
			$editlink = JRoute::_('index.php?option=com_retinashop&view=orders&layout=details&order_number=' . $row->order_number);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->order_number; ?></a>
				</td>
				<td align="left">
					<?php echo rsJsApi::date($row->created_on,'LC4',true); ?>
				</td>
				<!--td align="left">
					<?php //echo rsJsApi::date($row->modified_on,'LC3',true); ?>
				</td -->
				<td align="left">
					<?php echo ShopFunctions::getOrderStatusName($row->order_status); ?>
				</td>
				<td align="left">
					<?php echo $this->currency->priceDisplay($row->order_total); ?>
				</td>
			</tr>
	<?php
			$k = 1 - $k;
		}
	?>
	</table>
</div>
<?php } ?>
