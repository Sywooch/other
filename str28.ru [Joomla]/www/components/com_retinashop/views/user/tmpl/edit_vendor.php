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
* @version $Id: edit_vendor.php 5595 2012-03-03 22:10:09Z electrocity $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access'); ?>


<fieldset class="adminform">
	<legend>
		<?php echo RText::_('COM_RETINASHOP_VENDOR_FORM_INFO_LBL') ?>
	</legend>
	<table class="admintable width100">
		<tr>
			<td class="key">
				<?php echo RText::_('COM_RETINASHOP_STORE_FORM_STORE_NAME'); ?>
			</td>
			<td>
				<input class="inputbox" type="text" name="vendor_store_name" id="vendor_store_name" size="50" value="<?php echo $this->vendor->vendor_store_name; ?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo RText::_('COM_RETINASHOP_STORE_FORM_COMPANY_NAME'); ?>
			</td>
			<td>
				<input class="inputbox" type="text" name="vendor_name" id="vendor_name" size="50" value="<?php echo $this->vendor->vendor_name; ?>" />
			</td>
		</tr>		<tr>
			<td class="key">
				<?php echo RText::_('COM_RETINASHOP_SHOPPER_FORM_PHONE'); ?>
			</td>
			<td>
				<input class="inputbox" type="text" name="vendor_phone" id="vendor_phone" size="50" value="<?php echo $this->vendor->vendor_phone; ?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo RText::_('COM_RETINASHOP_URL'); ?>
			</td>
			<td>
				<input class="inputbox" type="text" name="vendor_url" id="vendor_url" size="50" value="<?php echo $this->vendor->vendor_url; ?>" />
			</td>
		</tr>
		<tr>
			<td class="key">
				<?php echo RText::_('COM_RETINASHOP_STORE_FORM_MPOV'); ?>
			</td>
			<td>
				<input class="inputbox" type="text" name="vendor_min_pov" id="vendor_min_pov" size="10" value="<?php echo $this->vendor->vendor_min_pov; ?>" />
			</td>
		</tr>

		<tr>

		</tr>
	</table>
</fieldset>


<fieldset class="adminform">
	<legend>
		<?php echo RText::_('COM_RETINASHOP_CURRENCY_DISPLAY') ?>
	</legend>
	<table class="admintable width100">
		<tr>
			<td class="key">
				<?php echo RText::_('COM_RETINASHOP_STORE_FORM_CURRENCY'); ?>
			</td>
			<td>
				<?php echo JHTML::_('Select.genericlist', $this->currencies, 'vendor_currency', '', 'retinashop_currency_id', 'currency_name', $this->vendor->vendor_currency); ?>
			</td>
		</tr><?php /*
	<tr>
		<td class="key">
			<?php echo RText::_('COM_RETINASHOP_CURRENCY_SYMBOL'); ?>
		</td>
		<td>
			<input class="inputbox" type="text" name="currency_symbol" id="currency_symbol" size="20" value="<?php echo $this->currency->currency_symbol; ?>" />
		</td>
	</tr>
	<tr>
		<td class="key">
			<?php echo RText::_('COM_RETINASHOP_CURRENCY_DECIMALS'); ?>
		</td>
		<td>
			<input class="inputbox" type="text" name="currency_decimal_place" id="currency_decimal_place" size="20" value="<?php echo $this->currency->currency_decimal_place; ?>" />
		</td>
	</tr>
	<tr>
		<td class="key">
			<?php echo RText::_('COM_RETINASHOP_CURRENCY_DECIMALSYMBOL'); ?>
		</td>
		<td>
			<input class="inputbox" type="text" name="currency_decimal_symbol" id="currency_decimal_symbol" size="10" value="<?php echo $this->currency->currency_decimal_symbol; ?>" />
		</td>
	</tr>
	<tr>
		<td class="key">
			<?php echo RText::_('COM_RETINASHOP_CURRENCY_THOUSANDS'); ?>
		</td>
		<td>
			<input class="inputbox" type="text" name="currency_thousands" id="currency_thousands" size="10" value="<?php echo $this->currency->currency_thousands; ?>" />
		</td>
	</tr>
	<tr>
		<td class="key">
			<?php echo RText::_('COM_RETINASHOP_CURRENCY_POSITIVE_DISPLAY'); ?>
		</td>
		<td >
			<input class="inputbox" type="text" name="currency_positive_style" id="currency_positive_style" size="50" value="<?php echo $this->currency->currency_positive_style; ?>" />
		</td>
	</tr>
	<tr>
		<td class="key">
			<?php echo RText::_('COM_RETINASHOP_CURRENCY_NEGATIVE_DISPLAY'); ?>
		</td>
		<td>
			<input class="inputbox" type="text" name="currency_negative_style" id="currency_negative_style" size="50" value="<?php echo $this->currency->currency_negative_style; ?>" />
		</td>
	</tr>
<tr>
	<?php echo RText::_('COM_RETINASHOP_CURRENCY_DISPLAY_EXPL'); ?>
</tr> */ ?>
		<tr>
			<td class="key">
				<?php echo RText::_('COM_RETINASHOP_STORE_FORM_ACCEPTED_CURRENCIES'); ?>
			</td>
			<td><br />
				<?php echo JHTML::_('Select.genericlist', $this->currencies, 'vendor_accepted_currencies[]', 'size=20 multiple', 'retinashop_currency_id', 'currency_name', $this->vendor->vendor_accepted_currencies); ?>
			</td>
		</tr>
	</table>
</fieldset>

<fieldset class="adminform">
	<legend>
		<?php echo RText::_('COM_RETINASHOP_VENDOR_FORM_MEDIA') ?>
	</legend>

	<?php
		echo $this->vendor->images[0]->displayFileHandler();
	?>
</fieldset>

<fieldset>
	<legend>
		<?php echo RText::_('COM_RETINASHOP_STORE_FORM_DESCRIPTION');?>
	</legend>
	<?php echo $this->editor->display('vendor_store_desc', $this->vendor->vendor_store_desc, '100%', 220, 70, 15)?>
</fieldset>

<fieldset>
	<legend>
		<?php echo RText::_('COM_RETINASHOP_STORE_FORM_TOS');?>
	</legend>
	<?php echo $this->editor->display('vendor_terms_of_service', $this->vendor->vendor_terms_of_service, '100%', 220, 70, 15)?>
</fieldset>

<input type="hidden" name="user_is_vendor" value="1" />
<input type="hidden" name="retinashop_vendor_id" value="<?php echo $this->vendor->retinashop_vendor_id; ?>" />
