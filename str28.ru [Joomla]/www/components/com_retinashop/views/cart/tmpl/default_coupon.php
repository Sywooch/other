<?php
/**
 *
 * Layout for the edit coupon
 *
 * @package	Magazin
 * @subpackage Cart
 * @author Oscar van Eijk
 *
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 2458 2010-06-30 18:23:28Z milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
?>


<form method="post" id="userForm" name="enterCouponCode" action="<?php echo JRoute::_('index.php'); ?>">
    <input type="text" name="coupon_code" size="20" maxlength="50" class="coupon" alt="<?php echo $this->coupon_text ?>" value="<?php echo $this->coupon_text; ?>" onblur="if(this.value=='') this.value='<?php echo $this->coupon_text; ?>';" onfocus="if(this.value=='<?php echo $this->coupon_text; ?>') this.value='';" />
    <span class="details-button">
    <input class="details-button" type="submit" title="<?php echo RText::_('COM_RETINASHOP_SAVE'); ?>" value="<?php echo RText::_('COM_RETINASHOP_SAVE'); ?>"/>
    </span>
    <input type="hidden" name="option" value="com_retinashop" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="setcoupon" />
    <input type="hidden" name="controller" value="cart" />
</form>
