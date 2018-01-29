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
 * @version $Id: default_showprices.php 5834 2012-04-09 12:05:33Z Milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

?>
<div class="product-price" id="productPrice<?php echo $this->product->retinashop_product_id ?>">
    <?php
    if ($this->product->product_unit && rsConfig::get('price_show_packaging_pricelabel')) {
	echo "<strong>" . RText::_('COM_RETINASHOP_CART_PRICE_PER_UNIT') . ' (' . $this->product->product_unit . "):</strong>";
    } else {
	echo "<strong>" . RText::_('COM_RETINASHOP_CART_PRICE') . "</strong>";
    }

    if (empty($this->product->prices) and rsConfig::get('askprice', 1)) {
	?>
        <a class="ask-a-question bold" href="<?php echo $url ?>" ><?php echo RText::_('COM_RETINASHOP_PRODUCT_ASKPRICE') ?></a>
    <?php
    }
    if ($this->showBasePrice) {
	echo $this->currency->createPriceDiv('basePrice', 'COM_RETINASHOP_PRODUCT_BASEPRICE', $this->product->prices);
	echo $this->currency->createPriceDiv('basePriceVariant', 'COM_RETINASHOP_PRODUCT_BASEPRICE_VARIANT', $this->product->prices);
    }

    echo $this->currency->createPriceDiv('variantModification', 'COM_RETINASHOP_PRODUCT_VARIANT_MOD', $this->product->prices);
    echo $this->currency->createPriceDiv('basePriceWithTax', 'COM_RETINASHOP_PRODUCT_BASEPRICE_WITHTAX', $this->product->prices);
    echo $this->currency->createPriceDiv('discountedPriceWithoutTax', 'COM_RETINASHOP_PRODUCT_DISCOUNTED_PRICE', $this->product->prices);
    echo $this->currency->createPriceDiv('salesPriceWithDiscount', 'COM_RETINASHOP_PRODUCT_SALESPRICE_WITH_DISCOUNT', $this->product->prices);
    echo $this->currency->createPriceDiv('salesPrice', 'COM_RETINASHOP_PRODUCT_SALESPRICE', $this->product->prices);
    echo $this->currency->createPriceDiv('priceWithoutTax', 'COM_RETINASHOP_PRODUCT_SALESPRICE_WITHOUT_TAX', $this->product->prices);
    echo $this->currency->createPriceDiv('discountAmount', 'COM_RETINASHOP_PRODUCT_DISCOUNT_AMOUNT', $this->product->prices);
    echo $this->currency->createPriceDiv('taxAmount', 'COM_RETINASHOP_PRODUCT_TAX_AMOUNT', $this->product->prices);
    ?>
</div>