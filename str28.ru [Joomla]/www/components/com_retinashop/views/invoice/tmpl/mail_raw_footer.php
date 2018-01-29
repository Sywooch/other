<?php
/**
*
* Layout for the shopping cart, look in mailshopper for more details
*
* @package	Magazin
* @subpackage Cart
* @author Max Milbers, Valerie Isaksen
*
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');
/* TODO Chnage the footer place in helper or retina_097115115101116115 ???*/
if (empty($this->vendor)) {
		$vendorModel = rsModel::getModel('vendor');
		$this->vendor = $vendorModel->getVendor();
}

// $uri    = JURI::getInstance();
// $prefix = $uri->toString(array('scheme', 'host', 'port'));
$link = JRoute::_ ( 'index.php?option=com_retinashop',true,-1);

echo "\n\n";
$link= JHTML::_('link', $link, $this->vendor->vendor_name) ;

//	echo RText::_('COM_RETINASHOP_MAIL_VENDOR_TITLE').$this->vendor->vendor_name.'<br/>';
/* GENERAL FOOTER FOR ALL MAILS */
	echo RText::_('COM_RETINASHOP_MAIL_FOOTER' ) . $link;
        echo "\n";
	echo $this->vendor->vendor_name ."\n".$this->vendor->vendor_phone .' '.$this->vendor->vendor_store_name ."\n".strip_tags($this->vendor->vendor_store_desc)."\n".str_replace('<br />',"\n",$this->vendor->vendor_legal_info);

	?>