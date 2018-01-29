<?php
/**
 *
 * Enter address data for the cart, when anonymous users checkout
 *
 * @package	Magazin
 * @subpackage User
 * @author Max Milbers
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: edit_address_addshipto.php 5912 2012-04-16 14:39:11Z alatak $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
?>


<fieldset>
    <legend>
	<?php echo '<span class="userfields_info">' .RText::_('COM_RETINASHOP_USER_FORM_SHIPTO_LBL').'</span>'; ?>
    </legend>
    <?php echo $this->lists['shipTo']; ?>

</fieldset>

