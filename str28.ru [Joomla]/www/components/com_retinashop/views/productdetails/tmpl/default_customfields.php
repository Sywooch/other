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
 * @version $Id: default_customfields.php 5699 2012-03-22 08:26:48Z ondrejspilka $
 */

// Check to ensure this file is included in Retina
defined ( '_REXEC' ) or die ( 'Restricted access' );
?>
<div class="product-fields">
	    <?php
	    $custom_title = null;
	    foreach ($this->product->customfieldsSorted[$this->position] as $field) {
	    	if ( $field->is_hidden ) //OSP http://forum.retinashop.net/index.php?topic=99320.0
	    		continue;
			if ($field->display) {
	    ?><div class="product-field product-field-type-<?php echo $field->field_type ?>">
		    <?php if ($field->custom_title != $custom_title) { ?>
			    <span class="product-fields-title" ><?php echo RText::_($field->custom_title); ?></span>
			    <?php
			    if ($field->custom_tip)
				echo JHTML::tooltip($field->custom_tip, RText::_($field->custom_title), 'tooltip.png');
			}
			?>
	    	    <span class="product-field-display"><?php echo $field->display ?></span>
	    	    <span class="product-field-desc"><?php echo jText::_($field->custom_field_desc) ?></span>
	    	</div>
		    <?php
		    $custom_title = $field->custom_title;
			}
	    }
	    ?>
        </div>
