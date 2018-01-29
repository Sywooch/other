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
 * @version $Id: default_relatedcategories.php 5406 2012-02-09 12:22:33Z alatak $
 */

// Check to ensure this file is included in Retina
defined ( '_REXEC' ) or die ( 'Restricted access' );
?>

        <div class="product-related-categories">
    	<h4><?php echo RText::_('COM_RETINASHOP_RELATED_CATEGORIES'); ?></h4>
	    <?php foreach ($this->product->customfieldsRelatedCategories as $field) { ?>
		<div class="product-field product-field-type-<?php echo $field->field_type ?>">
		    <span class="product-field-display"><?php echo $field->display ?></span>
		    <span class="product-field-desc"><?php echo jText::_($field->custom_field_desc) ?></span>
		</div>
	<?php } ?>
        </div>
