<?php
/**
 *
 * Handle the orders view
 *
 * @package	Magazin
 * @subpackage Orders
 * @author Oscar van Eijk
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 5432 2012-02-14 02:20:35Z Milbo $
 */

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

// Set to '0' to use tabs i.s.o. sliders
// Might be a config option later on, now just here for testing.
define ('__rs_ORDER_USE_SLIDERS', 0);

/**
 * Handle the orders view
 */
class retinashopViewInvoice extends rsView {

	var $format = 'html';
	var $doVendor = false;
	var $uselayout	= '';
	var $orderDetails = 0;
	var $invoiceNumber =0;

	public function display($tpl = null)
	{

		$document = JFactory::getDocument();

		if(empty($this->uselayout)){
			$layout = JRequest::getWord('layout','mail');
		} else {
			$layout = $this->uselayout;
		}
		if($layout == 'mail'){
			if (rsConfig::get('order_mail_html')) {
				$layout = 'mail_html';
			} else {
				$layout = 'mail_raw';
			}
		}
		$this->setLayout($layout);

		$tmpl = JRequest::getWord('tmpl');
		$print = false;
		if($tmpl){
			$print = true;
		}
		$this->assignRef('print', $print);

		$this->format = JRequest::getWord('format','html');

		if($layout == 'invoice'){
			$document->setTitle( RText::_('COM_RETINASHOP_INVOICE') );
		}

		$orderModel = rsModel::getModel('orders');

		$orderDetails = $this->orderDetails;

		if($orderDetails==0){

			// If the user is not logged in, we will check the order number and order pass
			if ($orderPass = JRequest::getString('order_pass',false) and $orderNumber = JRequest::getString('order_number',false)){
				$orderId = $orderModel->getOrderIdByOrderPass($orderNumber,$orderPass);
				if(empty($orderId)){
					echo 'Invalid order_number/password '.RText::_('COM_RETINASHOP_RESTRICTED_ACCESS');
					return 0;
				}
				$orderDetails = $orderModel->getOrder($orderId);
			}

			if($orderDetails==0){

				$_currentUser = JFactory::getUser();
				$cuid = $_currentUser->get('id');

				// If the user is logged in, we will check if the order belongs to him
				$retinashop_order_id = JRequest::getInt('retinashop_order_id',0) ;
				if (!$retinashop_order_id) {
					$retinashop_order_id = $orderModel->getOrderIdByOrderNumber(JRequest::getString('order_number'));
				}
				$orderDetails = $orderModel->getOrder($retinashop_order_id);

				if(!class_exists('Permissions')) require(RPATH_rs_admin.DS.'helpers'.DS.'permissions.php');
				if(!Permissions::getInstance()->check("admin")) {
					if(!empty($orderDetails['details']['BT']->retinashop_user_id)){
						if ($orderDetails['details']['BT']->retinashop_user_id != $cuid) {
							echo 'view '.RText::_('COM_RETINASHOP_RESTRICTED_ACCESS');
							return 0;
						}
					}
				}
			}

		}

		if(empty($orderDetails['details'])){
			echo RText::_('COM_RETINASHOP_ORDER_NOTFOUND');
			return;
		}
		$this->assignRef('orderDetails', $orderDetails);

		if(empty($this->invoiceNumber)){
			$invoiceNumberDate = $orderModel->createInvoiceNumber($orderDetails['details']['BT']);

			$this->invoiceNumber = $invoiceNumberDate[0];
			$this->invoiceDate = $invoiceNumberDate[1];

			if(!$this->invoiceNumber or empty($this->invoiceNumber)){
				rsError('Cant create pdf, createInvoiceNumber failed');;
				return 0;
			}
		}

		$shopperName =  $orderDetails['details']['BT']->title.' '.$orderDetails['details']['BT']->first_name.' '.$orderDetails['details']['BT']->last_name;
		$this->assignRef('shopperName', $shopperName);

		//Todo multix
		$vendorId=1;
		if(!class_exists('CurrencyDisplay')) require(RPATH_rs_admin.DS.'helpers'.DS.'currencydisplay.php');
		$currency = CurrencyDisplay::getInstance('',$vendorId);
		$this->assignRef('currency', $currency);

		//Create BT address fields
		$userFieldsModel = rsModel::getModel('userfields');
		$_userFields = $userFieldsModel->getUserFields(
				 'account'
				, array('captcha' => true, 'delimiters' => true) // Ignore these types
				, array('delimiter_userinfo','user_is_vendor' ,'username','password', 'password2', 'agreed', 'address_type') // Skips
		);

		$userfields = $userFieldsModel->getUserFieldsFilled( $_userFields ,$orderDetails['details']['BT']);
		$this->assignRef('userfields', $userfields);


		//Create ST address fields
		$orderst = (array_key_exists('ST', $orderDetails['details'])) ? $orderDetails['details']['ST'] : $orderDetails['details']['BT'];

		$shipmentFieldset = $userFieldsModel->getUserFields(
				 'shipment'
				, array() // Default switches
				, array('delimiter_userinfo', 'username', 'email', 'password', 'password2', 'agreed', 'address_type') // Skips
		);

		$shipmentfields = $userFieldsModel->getUserFieldsFilled( $shipmentFieldset ,$orderst );
		$this->assignRef('shipmentfields', $shipmentfields);


		// Create an array to allow orderlinestatuses to be translated
		// We'll probably want to put this somewhere in ShopFunctions..
		$orderStatusModel = rsModel::getModel('orderstatus');
		$_orderstatuses = $orderStatusModel->getOrderStatusList();
		$orderstatuses = array();
		foreach ($_orderstatuses as $_ordstat) {
			$orderstatuses[$_ordstat->order_status_code] = RText::_($_ordstat->order_status_name);
		}
		$this->assignRef('orderstatuslist', $orderstatuses);
		$this->assignRef('orderstatuses', $orderstatuses);

		$_elementStatusUpdateFields = array();
		$_elementAttributesUpdateFields = array();
		foreach($orderDetails['elements'] as $_element) {
// 			$_elementStatusUpdateFields[$_element->retinashop_order_element_id] = JHTML::_('select.genericlist', $orderstatuses, "element_id[".$_element->retinashop_order_element_id."][order_status]", 'class="selectelementStatusCode"', 'order_status_code', 'order_status_name', $_element->order_status, 'order_element_status'.$_element->retinashop_order_element_id,true);
			$_elementStatusUpdateFields[$_element->retinashop_order_element_id] =  $_element->order_status;

		}

		if (empty($orderDetails['shipmentName']) ) {
		    if (!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');
		    JPluginHelper::importPlugin('rsshipment');
		    $dispatcher = JDispatcher::getInstance();
		    $returnValues = $dispatcher->trigger('plgrsOnShowOrderFEShipment',array(  $orderDetails['details']['BT']->retinashop_order_id, $orderDetails['details']['BT']->retinashop_shipmentmethod_id, &$orderDetails['shipmentName']));
		}

		if (empty($orderDetails['paymentName']) ) {
		    if(!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS.DS.'rspsplugin.php');
		    JPluginHelper::importPlugin('rspayment');
		    $dispatcher = JDispatcher::getInstance();
		    $returnValues = $dispatcher->trigger('plgrsOnShowOrderFEPayment',array( $orderDetails['details']['BT']->retinashop_order_id, $orderDetails['details']['BT']->retinashop_paymentmethod_id,  &$orderDetails['paymentName']));
		 }

		$retinashop_vendor_id=1;
		$vendorModel = rsModel::getModel('vendor');
		$vendor = $vendorModel->getVendor($retinashop_vendor_id);
		$vendorModel->addImages($vendor);
		$this->assignRef('vendor', $vendor);

// 		rsdebug('vendor', $vendor);
		$task = JRequest::getWord('task',0);
		if($task == 'checkStoreInvoice'){
			$headFooter = false;
		} else {
			$headFooter = true;
		}
		$this->assignRef('headFooter', $headFooter);

		$userId = $vendorModel->getUserIdByVendorId($retinashop_vendor_id);

		$usermodel = rsModel::getModel('user');
		$retinashop_userinfo_id = $usermodel->getBTuserinfo_id($userId);
		$vendorFieldsArray = $usermodel->getUserInfoInUserFields($layout, 'BT', $retinashop_userinfo_id, false,true);
		$vendorFields = $vendorFieldsArray[$retinashop_userinfo_id];
		$vendorAddress='';
		 foreach ($vendorFields['fields'] as $field) {
		    if (!empty($field['value'])) {
			     $vendorAddress.= $field['value'];
			    if ($field['name'] != 'title' and $field['name'] != 'first_name' and $field['name'] != 'middle_name' and $field['name'] != 'zip') {
			    	if($headFooter){
			    		$vendorAddress.= "<br />";
			    	} else {
			    		$vendorAddress.= "\n";
			    	}

			    } else {
				$vendorAddress.=' ';
			    }
			}
		}
		$this->assignRef('vendorAddress', $vendorAddress);

		$vendorEmail = $vendorModel->getVendorEmail($retinashop_vendor_id);
		$vars['vendorEmail'] = $vendorEmail;

		if(!class_exists('ShopFunctions')) require(RPATH_rs_admin.DS.'helpers'.DS.'shopfunctions.php');

		// this is no setting in BE to change the layout !
		//shopFunctionsF::setrsTemplate($this,0,0,$layoutName);

		//rsdebug('renderMailLayout invoice '.date('H:i:s'),$this->order);
		if (strpos($layout,'mail') !== false) {
		    if ($this->doVendor) {
		    	 //Old text key COM_RETINASHOP_MAIL_SUBJ_VENDOR_C
			    $this->subject = RText::sprintf('COM_RETINASHOP_MAIL_SUBJ_VENDOR_'.$orderDetails['details']['BT']->order_status, $this->shopperName, strip_tags($currency->priceDisplay($orderDetails['details']['BT']->order_total)), $orderDetails['details']['BT']->order_number);
			    $recipient = 'vendor';
		    } else {
			    $this->subject = RText::sprintf('COM_RETINASHOP_MAIL_SUBJ_SHOPPER_'.$orderDetails['details']['BT']->order_status, $vendor->vendor_store_name, strip_tags($currency->priceDisplay($orderDetails['details']['BT']->order_total)), $orderDetails['details']['BT']->order_number, $orderDetails['details']['BT']->order_pass );
			    $recipient = 'shopper';
		    }
		    $this->assignRef('recipient', $recipient);
		}

		$tpl = null;

// 		rsdebug('my view data',$this->getLayout(),$layout);
// 		ob_start();
// 		echo '<pre>';
// 		echo debug_print_backtrace();
// 		echo '</pre>';
// 		$dumptrace = ob_get_contents();
// 		ob_end_clean();
// 		return false;

		parent::display($tpl);
	}

	// FE public function renderMailLayout($doVendor=false)
	function renderMailLayout ($doVendor, $recipient) {

		$this->doVendor=$doVendor;
		$this->fromPdf=false;
		$this->uselayout = 'mail';
		$this->display();

	}


}
