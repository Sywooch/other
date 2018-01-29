<?php
/**
 *
 * Modify user form view, User info
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
 * @version $Id: edit_rsshopper.php 5401 2012-02-09 08:48:52Z alatak $
 */

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

?>

<fieldset>
	<legend>
		<?php echo RText::_('COM_RETINASHOP_SHOPPER_FORM_LBL') ?>
	</legend>
	<table class="adminform user-details">
<?php	if(rsconfig::get('multix','none')!=='none'){ ?>

		<tr>
			<td class="key">
				<label for="retinashop_vendor_id">
					<?php echo RText::_('COM_RETINASHOP_PRODUCT_FORM_VENDOR') ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists['vendors']; ?>
			</td>
		</tr>
<?php } ?>

		<tr>
			<td class="key">
				<label for="perms">
					<?php echo RText::_('COM_RETINASHOP_USER_FORM_PERMS') ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists['perms']; ?>
			</td>
		</tr>

		<tr>
			<td class="key">
				<label for="customer_number">
					<?php echo RText::_('COM_RETINASHOP_USER_FORM_CUSTOMER_NUMBER') ?>:
				</label>
			</td>
			<td>
			 <?php if(Permissions::getInstance()->check('admin')) { ?>
				<input type="text" class="inputbox" name="customer_number" size="40" value="<?php echo  $this->lists['custnumber']; ?>" />
			<?php } else {
				echo $this->lists['custnumber'];
			} ?>
			</td>
		</tr>
		 <?php if($this->lists['shoppergroups']) { ?>
		<tr>
			<td class="key">
				<label for="retinashop_shoppergroup_id">
					<?php echo RText::_('COM_RETINASHOP_SHOPPER_FORM_GROUP') ?>:
				</label>
			</td>
			<td>
				<?php echo $this->lists['shoppergroups']; ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</fieldset>
