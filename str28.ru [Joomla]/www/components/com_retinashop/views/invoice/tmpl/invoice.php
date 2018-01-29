<?php
/**
*
* Order detail view
*
* @package	Magazin
* @subpackage Orders
* @author Max Milbers, Valerie Isaksen
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: details.php 5412 2012-02-09 19:27:55Z alatak $
*/
//index.php?option=com_retinashop&view=invoice&layout=invoice&format=pdf&tmpl=component&order_number=xx&order_pass=p_yy
//
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
JHTML::stylesheet('rspanels.css', JURI::root().'components/com_retinashop/retina_097115115101116115/css/');
if ($this->_layout=="invoice") {
$document = JFactory::getDocument();
$document->setTitle(RText::_('COM_RETINASHOP_ORDER_PRINT_PO_NUMBER').' '.$this->orderDetails['details']['BT']->order_number.' '.$this->vendor->vendor_store_name);
//$document->setName( RText::_('COM_RETINASHOP_ACC_ORDER_INFO').' '.$this->orderDetails['details']['BT']->order_number);
//$document->setDescription( RText::_('COM_RETINASHOP_ORDER_PRINT_PO_NUMBER').' '.$this->orderDetails['details']['BT']->order_number);
}

if($this->headFooter){ ?>
<div class="vendor-details-view">
<h1><?php echo $this->vendor->vendor_store_name;
if (!empty($this->vendor->images[0])) { ?>
		<div class="vendor-image">
		<?php echo $this->vendor->images[0]->displayMediaThumb('',false); ?>
		</div>
	<?php
	}
?>	</h1></div>

<div class="vendor-description">
<?php //echo $this->vendor->vendor_store_desc.'<br>';

echo $this->vendorAddress;
/*	foreach($this->vendorAddress as $userfields){

		foreach($userfields['fields'] as $element){
			if(!empty($element['value'])){
				if($element['name']==='agreed'){
					$element['value'] =  ($element['value']===0) ? RText::_('COM_RETINASHOP_USER_FORM_BILLTO_TOS_NO'):RText::_('COM_RETINASHOP_USER_FORM_BILLTO_TOS_YES');
				}
			?><!-- span class="titles"><?php echo $element['title'] ?></span -->
						<span class="values rs2<?php echo '-'.$element['name'] ?>" ><?php echo $this->escape($element['value']) ?></span>
					<?php if ($element['name'] != 'title' and $element['name'] != 'first_name' and $element['name'] != 'middle_name' and $element['name'] != 'zip') { ?>
						<br class="clear" />
					<?php
				}
			}
		}
	}*/
}
	?></div> <?php


if($this->print){
	?>

		<body onload="javascript:print();">

		<div class ='spaceStyle' >
		<?php
// 			echo require(__DIR__.'/mail_html_shopper.php');
			?>
		</div>
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
		<?php	//echo $this->vendor->vendor_legal_info; ?>
		</body>
		<?php
} else {

	?>

	<?php

	echo $this->loadTemplate('order');

	?>


	<div class='spaceStyle'>
	<?php

	$tabarray = array();

	$tabarray['elements'] = 'COM_RETINASHOP_ORDER_element';
	$tabarray['history'] = 'COM_RETINASHOP_ORDER_HISTORY';

	shopFunctionsF::buildTabs ($tabarray);
	echo '</div>
	    <br clear="all"/><br/>';
}

if($this->headFooter){
	echo $this->vendor->vendor_legal_info;
}

?>






