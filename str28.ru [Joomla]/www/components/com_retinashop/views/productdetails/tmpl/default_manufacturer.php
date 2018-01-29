<?php
/**
 *
 * Show the product details page
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
 * @version $Id: default_manufacturer.php 5409 2012-02-09 13:52:54Z alatak $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
?>
<div class="manufacturer">
    <?php
    $link = JRoute::_('index.php?option=com_retinashop&view=manufacturer&retinashop_manufacturer_id=' . $this->product->retinashop_manufacturer_id . '&tmpl=component');
    $text = $this->product->mf_name;

    /* Avoid JavaScript on PDF Output */
    if (strtolower(JRequest::getWord('output')) == "pdf") {
	echo JHTML::_('link', $link, $text);
    } else {
	?>
        <span class="bold"><?php echo RText::_('COM_RETINASHOP_PRODUCT_DETAILS_MANUFACTURER_LBL') ?></span><a class="modal" rel="{handler: 'iframe', size: {x: 700, y: 550}}" href="<?php echo $link ?>"><?php echo $text ?></a>
    <?PHP } ?>
</div>