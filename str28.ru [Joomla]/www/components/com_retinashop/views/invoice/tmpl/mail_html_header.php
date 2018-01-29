<?php
/**
 *
 * Define here the Header for order mail success !
 *
 * @package	Magazin
 * @subpackage Cart
 * @author Kohl Patrick
 * @author Valérie Isaksen
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
/* TODO Change the header place in helper or retina_097115115101116115 ??? */
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="html-email">
    <tr>
    <td colspan="3">
	<img src="<?php  echo JURI::root() . $this-> vendor->images[0]->file_url ?>">
	<br/>
	<strong><?php echo RText::sprintf('COM_RETINASHOP_MAIL_SHOPPER_NAME', $this->orderDetails['details']['BT']->title.' '.$this->orderDetails['details']['BT']->first_name.' '.$this->orderDetails['details']['BT']->last_name); ?></strong><br/>
    </td>
 </tr>
</table>
