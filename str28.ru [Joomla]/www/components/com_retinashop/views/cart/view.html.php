<?php

/**
 *
 * View for the shopping cart
 *
 * @package	Magazin
 * @subpackage
 * @author Max Milbers
 * @author Oscar van Eijk
 * @author RolandD
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 5653 2012-03-12 19:29:15Z Milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

/**
 * View for the shopping cart
 * @package retinashop
 * @author Max Milbers
 * @author Patrick Kohl
 */
class retinashopViewCart extends rsView {

	public function display($tpl = null) {
		$mainframe = JFactory::getApplication();
		$pathway = $mainframe->getPathway();
		$document = JFactory::getDocument();

		$layoutName = $this->getLayout();
		if (!$layoutName)
		$layoutName = JRequest::getWord('layout', 'default');
		$this->assignRef('layoutName', $layoutName);
		$format = JRequest::getWord('format');

		if (!class_exists('retinashopCart'))
		require(RPATH_rs_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = retinashopCart::getCart();
		$this->assignRef('cart', $cart);

		//Why is this here, when we have view.raw.php
		if ($format == 'raw') {
			$cart->prepareCartViewData();
			JRequest::setVar('layout', 'mini_cart');
			$this->setLayout('mini_cart');
			$this->prepareContinueLink();
		}
		/*
	  if($layoutName=='edit_coupon'){

		$cart->prepareCartViewData();
		$this->lSelectCoupon();
		$pathway->addelement(RText::_('COM_RETINASHOP_CART_OVERVIEW'),JRoute::_('index.php?option=com_retinashop&view=cart'));
		$pathway->addelement(RText::_('COM_RETINASHOP_CART_SELECTCOUPON'));
		$document->setTitle(RText::_('COM_RETINASHOP_CART_SELECTCOUPON'));

		} else */
		if ($layoutName == 'select_shipment') {
			if (!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');
			JPluginHelper::importPlugin('rsshipment');
			$this->lSelectShipment();

			$pathway->addelement(RText::_('COM_RETINASHOP_CART_OVERVIEW'), JRoute::_('index.php?option=com_retinashop&view=cart'));
			$pathway->addelement(RText::_('COM_RETINASHOP_CART_SELECTSHIPMENT'));
			$document->setTitle(RText::_('COM_RETINASHOP_CART_SELECTSHIPMENT'));
		} else if ($layoutName == 'select_payment') {

			/* Load the cart helper */
			//			$cartModel = rsModel::getModel('cart');

			$this->lSelectPayment();

			$pathway->addelement(RText::_('COM_RETINASHOP_CART_OVERVIEW'), JRoute::_('index.php?option=com_retinashop&view=cart'));
			$pathway->addelement(RText::_('COM_RETINASHOP_CART_SELECTPAYMENT'));
			$document->setTitle(RText::_('COM_RETINASHOP_CART_SELECTPAYMENT'));
		} else if ($layoutName == 'order_done') {

			$this->lOrderDone();

			$pathway->addelement(RText::_('COM_RETINASHOP_CART_THANKYOU'));
			$document->setTitle(RText::_('COM_RETINASHOP_CART_THANKYOU'));
		} else if ($layoutName == 'default') {

			$cart->prepareCartViewData();

			$cart->prepareAddressRadioSelection();

			$this->prepareContinueLink();
			$this->lSelectCoupon();

			$currencyDisplay = CurrencyDisplay::getInstance($this->cart->pricesCurrency);
			$this->assignRef('currencyDisplay',$currencyDisplay);

			$totalInPaymentCurrency =$this->getTotalInPaymentCurrency();

			if ($cart && !rsConfig::get('use_as_catalog', 0)) {
				$cart->checkout(false);
			}

			if ($cart->getDataValidated()) {
				$pathway->addelement(RText::_('COM_RETINASHOP_ORDER_CONFIRM_MNU'));
				$document->setTitle(RText::_('COM_RETINASHOP_ORDER_CONFIRM_MNU'));
				$text = RText::_('COM_RETINASHOP_ORDER_CONFIRM_MNU');
				$checkout_task = 'confirm';
			} else {
				$pathway->addelement(RText::_('COM_RETINASHOP_CART_OVERVIEW'));
				$document->setTitle(RText::_('COM_RETINASHOP_CART_OVERVIEW'));
				$text = RText::_('COM_RETINASHOP_CHECKOUT_TITLE');
				$checkout_task = 'checkout';
			}
			$this->assignRef('checkout_task', $checkout_task);
			$this->checkPaymentMethodsConfigured();
			$this->checkShipmentMethodsConfigured();
			if ($cart->retinashop_shipmentmethod_id) {
				$this->assignRef('select_shipment_text', RText::_('COM_RETINASHOP_CART_CHANGE_SHIPPING'));
			} else {
				$this->assignRef('select_shipment_text', RText::_('COM_RETINASHOP_CART_EDIT_SHIPPING'));
			}
			if ($cart->retinashop_paymentmethod_id) {
				$this->assignRef('select_payment_text', RText::_('COM_RETINASHOP_CART_CHANGE_PAYMENT'));
			} else {
				$this->assignRef('select_payment_text', RText::_('COM_RETINASHOP_CART_EDIT_PAYMENT'));
			}

			if (!rsConfig::get('use_as_catalog')) {
				$checkout_link_html = '<a class="rs-button-correct" href="javascript:document.checkoutForm.submit();" ><span>' . $text . '</span></a>';
			} else {
				$checkout_link_html = '';
			}
			$this->assignRef('checkout_link_html', $checkout_link_html);
		}
		//dump ($cart,'cart');
		$useSSL = rsConfig::get('useSSL', 0);
		$useXHTML = true;
		$this->assignRef('useSSL', $useSSL);
		$this->assignRef('useXHTML', $useXHTML);
		$this->assignRef('totalInPaymentCurrency', $totalInPaymentCurrency);

		// @max: quicknirty
		$cart->setCartIntoSession();
		shopFunctionsF::setrsTemplate($this, 0, 0, $layoutName);

// 		rsdebug('my cart ',$cart);
		parent::display($tpl);
	}



	private function prepareContinueLink() {
		// Get a continue link */
		$retinashop_category_id = shopFunctionsF::getLastVisitedCategoryId();
		$categoryLink = '';
		if ($retinashop_category_id) {
			$categoryLink = '&retinashop_category_id=' . $retinashop_category_id;
		}
		$continue_link = JRoute::_('index.php?option=com_retinashop&view=category' . $categoryLink);

		$continue_link_html = '<a class="continue_link" href="' . $continue_link . '" >' . RText::_('COM_RETINASHOP_CONTINUE_SHOPPING') . '</a>';
		$this->assignRef('continue_link_html', $continue_link_html);
		$this->assignRef('continue_link', $continue_link);
	}

	private function lSelectCoupon() {

		$this->couponCode = (isset($this->cart->couponCode) ? $this->cart->couponCode : '');
		$coupon_text = $this->cart->couponCode ? RText::_('COM_RETINASHOP_COUPON_CODE_CHANGE') : RText::_('COM_RETINASHOP_COUPON_CODE_ENTER');
		$this->assignRef('coupon_text', $coupon_text);
	}

	/*
	 * lSelectShipment
	* find al shipment rates available for this cart
	*
	* @author Valerie Isaksen
	*/

	private function lSelectShipment() {
		$found_shipment_method=false;
		$shipment_not_found_text = RText::_('COM_RETINASHOP_CART_NO_SHIPPING_METHOD_PUBLIC');
		$this->assignRef('shipment_not_found_text', $shipment_not_found_text);
		$this->assignRef('found_shipment_method', $found_shipment_method);

		$shipments_shipment_rates=array();
		if (!$this->checkShipmentMethodsConfigured()) {
			$this->assignRef('shipments_shipment_rates',$shipments_shipment_rates);
			return;
		}
		$selectedShipment = (empty($this->cart->retinashop_shipmentmethod_id) ? 0 : $this->cart->retinashop_shipmentmethod_id);

		$shipments_shipment_rates = array();
		if (!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');
		JPluginHelper::importPlugin('rsshipment');
		$dispatcher = JDispatcher::getInstance();
		$returnValues = $dispatcher->trigger('plgrsDisplayListFEShipment', array( $this->cart, $selectedShipment, &$shipments_shipment_rates));
		// if no shipment rate defined
		$found_shipment_method =count($shipments_shipment_rates);
		$shipment_not_found_text = RText::_('COM_RETINASHOP_CART_NO_SHIPPING_METHOD_PUBLIC');
		$this->assignRef('shipment_not_found_text', $shipment_not_found_text);
		$this->assignRef('shipments_shipment_rates', $shipments_shipment_rates);
		$this->assignRef('found_shipment_method', $found_shipment_method);
		return;
	}

	/*
	 * lSelectPayment
	* find al payment available for this cart
	*
	* @author Valerie Isaksen
	*/

	private function lSelectPayment() {

		$payment_not_found_text='';
		$payments_payment_rates=array();
		if (!$this->checkPaymentMethodsConfigured()) {
			$this->assignRef('paymentplugins_payments', $payments_payment_rates);
			$this->assignRef('found_payment_method', $found_payment_method);
		}

		$selectedPayment = empty($this->cart->retinashop_paymentmethod_id) ? 0 : $this->cart->retinashop_paymentmethod_id;

		$paymentplugins_payments = array();
		if(!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS.DS.'rspsplugin.php');
		JPluginHelper::importPlugin('rspayment');
		$dispatcher = JDispatcher::getInstance();
		$returnValues = $dispatcher->trigger('plgrsDisplayListFEPayment', array($this->cart, $selectedPayment, &$paymentplugins_payments));
		// if no payment defined
		$found_payment_method =count($paymentplugins_payments);

		if (!$found_payment_method) {
			$link=''; // todo
			$payment_not_found_text = RText::sprintf('COM_RETINASHOP_CART_NO_PAYMENT_METHOD_PUBLIC', '<a href="'.$link.'">'.$link.'</a>');
		}

		$this->assignRef('payment_not_found_text', $payment_not_found_text);
		$this->assignRef('paymentplugins_payments', $paymentplugins_payments);
		$this->assignRef('found_payment_method', $found_payment_method);
	}

	private function getTotalInPaymentCurrency() {

		if (empty($this->cart->retinashop_paymentmethod_id)) {
			return null;
		}

		if (!$this->cart->paymentCurrency or ($this->cart->paymentCurrency==$this->cart->pricesCurrency)) {
			return null;
		}

		$paymentCurrency = CurrencyDisplay::getInstance($this->cart->paymentCurrency);

		$totalInPaymentCurrency = $paymentCurrency->priceDisplay( $this->cart->pricesUnformatted['billTotal'],$this->cart->paymentCurrency) ;

		$currencyDisplay = CurrencyDisplay::getInstance($this->cart->pricesCurrency);
// 		$this->assignRef('currencyDisplay',$currencyDisplay);

		return $totalInPaymentCurrency;
	}

	private function lOrderDone() {
		$html = JRequest::getVar('html', RText::_('COM_RETINASHOP_ORDER_PROCESSED'), 'default', 'STRING', JREQUEST_ALLOWRAW);
		$this->assignRef('html', $html);

		//Show Thank you page or error due payment plugins like paypal express
	}

	private function checkPaymentMethodsConfigured() {

		//For the selection of the payment method we need the total amount to pay.
		$paymentModel = rsModel::getModel('Paymentmethod');
		$payments = $paymentModel->getPayments(true, false);
		if (empty($payments)) {

			$text = '';
			if (!class_exists('Permissions'))
			require(RPATH_rs_admin . DS . 'helpers' . DS . 'permissions.php');
			if (Permissions::getInstance()->check("admin,storeadmin")) {
				$uri = JFactory::getURI();
				$link = $uri->root() . 'admin/index.php?option=com_retinashop&view=paymentmethod';
				$text = RText::sprintf('COM_RETINASHOP_NO_PAYMENT_METHODS_CONFIGURED_LINK', '<a href="' . $link . '">' . $link . '</a>');
			}

			rsInfo('COM_RETINASHOP_NO_PAYMENT_METHODS_CONFIGURED', $text);

			$tmp = 0;
			$this->assignRef('found_payment_method', $tmp);

			return false;
		}
		return true;
	}

	private function checkShipmentMethodsConfigured() {

		//For the selection of the shipment method we need the total amount to pay.
		$shipmentModel = rsModel::getModel('Shipmentmethod');
		$shipments = $shipmentModel->getShipments();
		if (empty($shipments)) {

			$text = '';
			if (!class_exists('Permissions'))
			require(RPATH_rs_admin . DS . 'helpers' . DS . 'permissions.php');
			if (Permissions::getInstance()->check("admin,storeadmin")) {
				$uri = JFactory::getURI();
				$link = $uri->root() . 'admin/index.php?option=com_retinashop&view=shipmentmethod';
				$text = RText::sprintf('COM_RETINASHOP_NO_SHIPPING_METHODS_CONFIGURED_LINK', '<a href="' . $link . '">' . $link . '</a>');
			}

			rsInfo('COM_RETINASHOP_NO_SHIPPING_METHODS_CONFIGURED', $text);

			$tmp = 0;
			$this->assignRef('found_shipment_method', $tmp);

			return false;
		}
		return true;
	}

}

//no closing tag
