<?php
/**
*
* Order detail view
*
* @package	Magazin
* @subpackage Orders
* @author Oscar van Eijk, Valerie Isaksen
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: details.php 5825 2012-04-07 20:06:06Z electrocity $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
JHTML::stylesheet('rspanels.css', JURI::root().'components/com_retinashop/retina_097115115101116115/css/');
if($this->print){
	?>

		<body onload="javascript:print();">
		<div><img src="<?php  echo JURI::root() . $this-> vendor->images[0]->file_url ?>"></div>
		<h2><?php  echo $this->vendor->vendor_store_name; ?></h2>
		<?php  $this->vendor->vendor_name .' - '.$this->vendor->vendor_phone ?>
		<h1><?php echo RText::_('COM_RETINASHOP_ACC_ORDER_INFO'); ?></h1>
		<div class='spaceStyle'>
		<?php
		echo $this->loadTemplate('order');
		?>
		</div>

		<div class='spaceStyle'>
		<?php
		echo $this->loadTemplate('elements');
		?>
		</div>
		<?php	echo $this->vendor->vendor_legal_info; ?>
		</body>
		<?php
} else {

	?>
	<h1><?php echo RText::_('COM_RETINASHOP_ACC_ORDER_INFO'); ?>

	<?php

	/* Print view URL */
	$details_url = juri::root().'index.php?option=com_retinashop&view=orders&layout=details&tmpl=component&retinashop_order_id=' . $this->orderdetails['details']['BT']->retinashop_order_id;
	$details_link = "<a href=\"javascript:void window.open('$details_url', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');\"  >";
	//$details_link .= '<span class="hasTip print_32" title="' . RText::_('COM_RETINASHOP_PRINT') . '">&nbsp;</span></a>';
	$button = (Jrs_VERSION==1) ? '/images/M_images/printButton.png' : 'main/printButton.png';
	$details_link .= JHtml::_('image',$button, RText::_('COM_RETINASHOP_PRINT'), NULL, true);
	$details_link  .=  '</a>';
	echo $details_link; ?>
</h1>
<?php if($this->order_list_link){ ?>
	<div class='spaceStyle'>
	    <div class="floatright">
		<a href="<?php echo $this->order_list_link ?>"><?php echo RText::_('COM_RETINASHOP_ORDERS_VIEW_DEFAULT_TITLE'); ?></a>
	    </div>
	    <div class="clear"></div>
	</div>
<?php }?>
<div class='spaceStyle'>
	<?php
	echo $this->loadTemplate('order');
	?>
	</div>

	<div class='spaceStyle'>
	<?php

	$tabarray = array();

	$tabarray['elements'] = 'COM_RETINASHOP_ORDER_element';
	$tabarray['history'] = 'COM_RETINASHOP_ORDER_HISTORY';

	shopFunctionsF::buildTabs ($tabarray); ?>
	 </div>
	    <br clear="all"/><br/>
	<?php
}

?>






