<?php
/**
*
* User details, Orderlist
*
* @package	Magazin
* @subpackage User
* @author Oscar van Eijk
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: edit_orderlist.php 5351 2012-02-01 13:40:13Z alatak $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access'); ?>

<div id="editcell">
	<table class="adminlist">
	<thead>
	<tr>
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_ORDER_NUMBER'); ?>
		</th>
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_CDATE'); ?>
		</th>
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_MDATE'); ?>
		</th>
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_STATUS'); ?>
		</th>
		<th>
			<?php echo RText::_('COM_RETINASHOP_ORDER_LIST_TOTAL'); ?>
		</th>
	</thead>
	<?php
		$k = 0;
		foreach ($this->orderlist as $i => $row) {
			$editlink = JRoute::_('index.php?option=com_retinashop&view=orders&layout=details&order_number=' . $row->order_number);
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="left">
					<a href="<?php echo $editlink; ?>"><?php echo $row->order_number; ?></a>
				</td>
				<td align="left">
					<?php echo JHTML::_('date', $row->created_on); ?>
				</td>
				<td align="left">
					<?php echo JHTML::_('date', $row->modified_on); ?>
				</td>
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
