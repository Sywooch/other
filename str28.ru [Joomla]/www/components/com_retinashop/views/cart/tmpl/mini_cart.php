<?php
/**
*
* Layout for the shopping cart
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
* @version $Id: cart.php 2551 2010-09-30 18:52:40Z milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

?>
	<a href="<?php echo $this->continue_link; ?>"><?php echo RText::_('COM_RETINASHOP_CONTINUE_SHOPPING') ?></a>
	<a style ="float:right;" href="<?php echo JRoute::_('index.php?option=com_retinashop&view=cart'); ?>"><?php echo RText::_('COM_RETINASHOP_CART_SHOW') ?></a>
<br style="clear:both">
