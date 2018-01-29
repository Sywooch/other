<?php
/**
 *
 * Show Notify page
 *
 * @package	Magazin
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_reviews.php 5428 2012-02-12 04:41:22Z electrocity $
 */

// Check to ensure this file is included in Retina
defined ( '_REXEC' ) or die ( 'Restricted access' );
?>


<form method="post" action="<?php echo JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$this->product->retinashop_product_id.'&retinashop_category_id='.$this->product->retinashop_category_id) ; ?>" name="notifyform" id="notifyform">
	<h4><?php echo RText::_('COM_RETINASHOP_CART_NOTIFY') ?></h4>

	<div class="list-reviews">
		<?php echo RText::sprintf('COM_RETINASHOP_CART_NOTIFY_DESC', $this->product->product_name); ?>
		<br /><br />
	<div class="clear"></div>
	</div>
	
	<div><span class="floatleft"><input type="text" name="notify_email" value="<?php echo $this->user->email; ?>" /></span>
		 <span class="addtocart-button"><input type="submit" name="notifycustomer"  class="notify-button" value="<?php echo RText::_('COM_RETINASHOP_CART_NOTIFY') ?>" title="<?php echo RText::_('COM_RETINASHOP_CART_NOTIFY') ?>" /></span>
	</div>

	<input type="hidden" name="retinashop_product_id" value="<?php echo $this->product->retinashop_product_id; ?>" />
	<input type="hidden" name="option" value="com_retinashop" />
	<input type="hidden" name="retinashop_category_id" value="<?php echo JRequest::getInt('retinashop_category_id'); ?>" />
	<input type="hidden" name="retinashop_user_id" value="<?php echo $this->user->id; ?>" />
	<input type="hidden" name="task" value="notifycustomer" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<br />
<br />
<br />

