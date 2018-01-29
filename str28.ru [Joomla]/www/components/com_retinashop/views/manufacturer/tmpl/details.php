<?php
/**
*
* Description
*
* @package	Magazin
* @subpackage Manufacturer
* @author Kohl Patrick, Eugen Stranz
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 2701 2011-02-11 15:16:49Z impleri $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
?>

<div class="manufacturer-details-view">
	<h1><?php echo $this->manufacturer->mf_name; ?></h1>

	<div class="spacer">

	<?php // Manufacturer Image
	if (!empty($manufacturerImage)) { ?>
		<div class="manufacturer-image">
		<?php echo $this->manufacturerImage; ?>
		</div>
	<?php } ?>

	<?php // Manufacturer Email
	if(!empty($this->manufacturer->mf_email)) { ?>
		<div class="manufacturer-email">
		<?php // TO DO Make The Email Visible Within The Lightbox
		echo JHtml::_('email.cloak', $this->manufacturer->mf_email,true,RText::_('COM_RETINASHOP_EMAIL'),false) ?>
		</div>
	<?php } ?>

	<?php // Manufacturer URL
	if(!empty($this->manufacturer->mf_url)) { ?>
		<div class="manufacturer-url">
			<a target="_blank" href="<?php echo $this->manufacturer->mf_url ?>"><?php echo RText::_('COM_RETINASHOP_MANUFACTURER_PAGE') ?></a>
		</div>
	<?php } ?>

	<?php // Manufacturer Description
	if(!empty($this->manufacturer->mf_desc)) { ?>
		<div class="manufacturer-description">
			<?php echo $this->manufacturer->mf_desc ?>
		</div>
	<?php } ?>

	<?php // Manufacturer Product Link
	$manufacturerProductsURL = JRoute::_('index.php?option=com_retinashop&view=category&retinashop_manufacturer_id=' . $this->manufacturer->retinashop_manufacturer_id);

	if(!empty($this->manufacturer->retinashop_manufacturer_id)) { ?>
		<div class="manufacturer-product-link">
			<a target="_top" href="<?php echo $manufacturerProductsURL; ?>"><?php echo RText::sprintf('COM_RETINASHOP_PRODUCT_FROM_MF',$this->manufacturer->mf_name); ?></a>
		</div>
	<?php } ?>

	<div class="clear"></div>
	</div>
</div>