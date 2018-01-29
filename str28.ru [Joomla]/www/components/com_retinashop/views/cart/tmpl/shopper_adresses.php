<?php
/**
*
* Layout for the shopping cart and the mail
* shows the choosen adresses of the shopper
* taken from the cart in the session
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
*
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
?>
<table width="100%">
  <tr>
    <td width="50%" bgcolor="#ccc">
		<?php echo RText::_('COM_RETINASHOP_USER_FORM_BILLTO_LBL'); ?>
	</td>
	<td width="50%" bgcolor="#ccc">
		<?php echo RText::_('COM_RETINASHOP_USER_FORM_SHIPTO_LBL'); ?>
	</td>
  </tr>
  <tr>
    <td width="50%">

		<?php 	foreach($this->BTaddress['fields'] as $element){
					if(!empty($element['value'])){
						echo $element['title'].': '.$this->escape($element['value']).'<br/>';
					}
				} ?>

	</td>
    <td width="50%">
			<?php
			if(!empty($this->STaddress['fields'])){
				foreach($this->STaddress['fields'] as $element){
					if(!empty($element['value'])){
						echo $element['title'].': '.$this->escape($element['value']).'<br/>';
					}
				}
			} else {
				foreach($this->BTaddress['fields'] as $element){
					if(!empty($element['value'])){
						echo $element['title'].': '.$this->escape($element['value']).'<br/>';
					}
				}
			} ?>
	</td>
  </tr>
</table>