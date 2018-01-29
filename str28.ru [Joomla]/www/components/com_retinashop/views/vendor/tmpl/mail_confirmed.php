<?php
/**
 *
 * Show the product details page
 *
 * @package	Magazin
 * @subpackage
 * @author KOHL Patrick
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
* @version $Id: default.php 2810 2011-03-02 19:08:24Z Milbo $
 */

// Check to ensure this file is included in Retina
defined ( '_REXEC' ) or die ( 'Restricted access' );
/* thank you for the ask question mail  */


 ?>

<div class="productdetails-view">
	<div><?php echo RText::_('COM_RETINASHOP_ASK_QUESTION_THANK_YOU'); ?></div><br />
	<div><a class="general-bg" href="<?php echo JRoute::_('index.php?option=com_retinashop') ?>" /><?php echo RText::_('COM_RETINASHOP_CONTINUE_SHOPPING') ?></a></div>
</div>
