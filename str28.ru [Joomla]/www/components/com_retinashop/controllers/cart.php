<?php

/**
 *
 * Controller for the cart
 *
 * @package	Magazin
 * @subpackage Cart
 * @author RolandD
 * @author Max Milbers
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 5699 2012-03-22 08:26:48Z ondrejspilka $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the controller framework
jimport('retina.application.component.controller');

/**
 * Controller for the cart view
 *
 * @package retinashop
 * @subpackage Cart
 * @author RolandD
 * @author Max Milbers
 */
class retinashopControllerCart extends JController {

	/**
	 * Construct the cart
	 *
	 * @access public
	 * @author Max Milbers
	 */
	public function __construct() {
		parent::__construct();
		if (rsConfig::get('use_as_catalog', 0)) {
			$app = JFactory::getApplication();
			$app->redirect('index.php');
		} else {
			if (!class_exists('retinashopCart'))
			require(RPATH_rs_SITE . DS . 'helpers' . DS . 'cart.php');
			if (!class_exists('calculationHelper'))
			require(RPATH_rs_admin . DS . 'helpers' . DS . 'calculationh.php');
		}
		$this->useSSL = rsConfig::get('useSSL', 0);
		$this->useXHTML = true;
	}


	/**
	 * Add the product to the cart
	 *
	 * @author RolandD
	 * @author Max Milbers
	 * @access public
	 */
	public function add() {
		$mainframe = JFactory::getApplication();
		if (rsConfig::get('use_as_catalog', 0)) {
			$msg = RText::_('COM_RETINASHOP_PRODUCT_NOT_ADDED_SUCCESSFULLY');
			$type = 'error';
			$mainframe->redirect('index.php', $msg, $type);
		}
		$cart = retinashopCart::getCart();
		if ($cart) {
			$retinashop_product_ids = JRequest::getVar('retinashop_product_id', array(), 'default', 'array');
			$success = true;
			if ($cart->add($retinashop_product_ids,$success)) {
				$msg = RText::_('COM_RETINASHOP_PRODUCT_ADDED_SUCCESSFULLY');
				$mainframe->enqueueMessage($msg);
				$type = '';
			} else {
				$msg = RText::_('COM_RETINASHOP_PRODUCT_NOT_ADDED_SUCCESSFULLY');
				$type = 'error';
			}
			//			if (JRequest::getWord('format','') =='raw' ) {
			//				JRequest::setVar('layout','minicart','POST');
			//				$this->cart();
			//				//$view->display();
			//				return ;
			//			} else {
			$mainframe->enqueueMessage($msg, $type);
			$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart'));
			//			}
		} else {
			$mainframe->enqueueMessage('Cart does not exist?', 'error');
		}
	}

	/**
	 * Add the product to the cart, with JS
	 *
	 * @author Max Milbers
	 * @access public
	 */
	public function addJS() {

		//maybe we should use $mainframe->close(); or jexit();instead of die;
		/* Load the cart helper */
		//require_once(RPATH_rs_SITE.DS.'helpers'.DS.'cart.php');
		$this->json = null;
		$cart = retinashopCart::getCart(false);
		if ($cart) {
			// Get a continue link */
			$retinashop_category_id = shopFunctionsF::getLastVisitedCategoryId();
			if ($retinashop_category_id) {
				$categoryLink = '&view=category&retinashop_category_id=' . $retinashop_category_id;
			} else
			$categoryLink = '';
			$continue_link = JRoute::_('index.php?option=com_retinashop' . $categoryLink);
			$retinashop_product_ids = JRequest::getVar('retinashop_product_id', array(), 'default', 'array');
			$errorMsg = RText::_('COM_RETINASHOP_CART_PRODUCT_ADDED');
			if ($cart->add($retinashop_product_ids, $errorMsg )) {

				$this->json->msg = '<a class="continue" href="' . $continue_link . '" >' . RText::_('COM_RETINASHOP_CONTINUE_SHOPPING') . '</a>';
				$this->json->msg .= '<a class="showcart floatright" href="' . JRoute::_("index.php?option=com_retinashop&view=cart") . '">' . RText::_('COM_RETINASHOP_CART_SHOW_MODAL') . '</a>';
				if ($errorMsg) $this->json->msg .= '<div>'.$errorMsg.'</div>';
				$this->json->stat = '1';
			} else {
				// $this->json->msg = '<p>' . $cart->getError() . '</p>';
				$this->json->msg = '<a class="continue" href="' . $continue_link . '" >' . RText::_('COM_RETINASHOP_CONTINUE_SHOPPING') . '</a>';
				$this->json->msg .= '<div>'.$errorMsg.'</div>';
				$this->json->stat = '2';
			}
		} else {
			$this->json->msg = '<a href="' . JRoute::_('index.php?option=com_retinashop') . '" >' . RText::_('COM_RETINASHOP_CONTINUE_SHOPPING') . '</a>';
			$this->json->msg .= '<p>' . RText::_('COM_RETINASHOP_MINICART_ERROR') . '</p>';
			$this->json->stat = '0';
		}
		echo json_encode($this->json);
		jExit();
	}

	/**
	 * Add the product to the cart, with JS
	 *
	 * @author Max Milbers
	 * @access public
	 */
	public function viewJS() {

		if (!class_exists('retinashopCart'))
		require(RPATH_rs_SITE . DS . 'helpers' . DS . 'cart.php');
		$cart = retinashopCart::getCart(false);
		$this->data = $cart->prepareAjaxData();
		$lang = JFactory::getLanguage();
		$extension = 'com_retinashop';
		$lang->load($extension); //  when AJAX it needs to be loaded manually here >> in case you are outside retinashop !!!
		if ($this->data->totalProduct > 1)
		$this->data->totalProductTxt = RText::sprintf('COM_RETINASHOP_CART_X_PRODUCTS', $this->data->totalProduct);
		else if ($this->data->totalProduct == 1)
		$this->data->totalProductTxt = RText::_('COM_RETINASHOP_CART_ONE_PRODUCT');
		else
		$this->data->totalProductTxt = RText::_('COM_RETINASHOP_EMPTY_CART');
		if ($this->data->dataValidated == true) {
			$taskRoute = '&task=confirm';
			$linkName = RText::_('COM_RETINASHOP_CART_CONFIRM');
		} else {
			$taskRoute = '';
			$linkName = RText::_('COM_RETINASHOP_CART_SHOW');
		}
		$this->data->cart_show = '<a class="floatright" href="' . JRoute::_("index.php?option=com_retinashop&view=cart" . $taskRoute, $this->useXHTML, $this->useSSL) . '">' . $linkName . '</a>';
		$this->data->billTotal = $lang->_('COM_RETINASHOP_CART_TOTAL') . ' : <strong>' . $this->data->billTotal . '</strong>';
		echo json_encode($this->data);
		Jexit();
	}

	/**
	 * For selecting couponcode to use, opens a new layout
	 *
	 * @author Max Milbers
	 */
	public function edit_coupon() {

		$view = $this->getView('cart', 'html');
		$view->setLayout('edit_coupon');

		// Display it all
		$view->display();
	}

	/**
	 * Store the coupon code in the cart
	 * @author Oscar van Eijk
	 */
	public function setcoupon() {
		$mainframe = JFactory::getApplication();
		/* Get the coupon_code of the cart */
		$coupon_code = JRequest::getVar('coupon_code', ''); //TODO VAR OR INT OR WORD?
		if ($coupon_code) {

			$cart = retinashopCart::getCart();
			if ($cart) {
				$msg = $cart->setCouponCode($coupon_code);
				if (!empty($msg)) {
					$mainframe->enqueueMessage($msg, 'error');
				}
				//				$cart->setDataValidation(); //Not needed already done in the getCart function
				if ($cart->getInCheckOut()) {
					$mainframe = JFactory::getApplication();
					$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=checkout'));
				}
			}
		}
		parent::display();
		// 	self::Cart();
	}

	/**
	 * For selecting shipment, opens a new layout
	 *
	 * @author Max Milbers
	 */
	public function edit_shipment() {


		$view = $this->getView('cart', 'html');
		$view->setLayout('select_shipment');

		// Display it all
		$view->display();
	}

	/**
	 * Sets a selected shipment to the cart
	 *
	 * @author Max Milbers
	 */
	public function setshipment() {

		/* Get the shipment ID from the cart */
		$retinashop_shipmentmethod_id = JRequest::getInt('retinashop_shipmentmethod_id', '0');
		//rsdebug('setshipment',$retinashop_shipmentmethod_id);
		$cart = retinashopCart::getCart();
		if ($cart) {
			//Now set the shipment ID into the cart
			if (!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');
			JPluginHelper::importPlugin('rsshipment');
			$cart->setShipment($retinashop_shipmentmethod_id);
			//Add a hook here for other payment methods, checking the data of the choosed plugin
			$_dispatcher = JDispatcher::getInstance();
			$_retValues = $_dispatcher->trigger('plgrsOnSelectCheckShipment', array(   &$cart));
			$dataValid = true;
			foreach ($_retValues as $_retVal) {
				if ($_retVal === true ) {
					// Plugin completed succesfull; nothing else to do
					$cart->setCartIntoSession();
					break;
				} else if ($_retVal === false ) {
					$mainframe = JFactory::getApplication();
					$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=editshipment',$this->useXHTML,$this->useSSL), $_retVal);
					break;
				}
			}

			if ($cart->getInCheckOut()) {
				$mainframe = JFactory::getApplication();
				$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=checkout') );
			}
		}
		// 	self::Cart();
		parent::display();
	}

	/**
	 * To select a payment method
	 *
	 * @author Max Milbers
	 */
	public function editpayment() {

		$view = $this->getView('cart', 'html');
		$view->setLayout('select_payment');

		// Display it all
		$view->display();
	}

	/**
	 * To set a payment method
	 *
	 * @author Max Milbers
	 * @author Oscar van Eijk
	 * @author Valerie Isaksen
	 */
	function setpayment() {

		/* Get the payment id of the cart */
		//Now set the payment rate into the cart
		$cart = retinashopCart::getCart();
		if ($cart) {
			if(!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS.DS.'rspsplugin.php');
			JPluginHelper::importPlugin('rspayment');
			//Some Paymentmethods needs extra Information like
			$retinashop_paymentmethod_id = JRequest::getInt('retinashop_paymentmethod_id', '0');
			$cart->setPaymentMethod($retinashop_paymentmethod_id);

			//Add a hook here for other payment methods, checking the data of the choosed plugin
			$_dispatcher = JDispatcher::getInstance();
			$_retValues = $_dispatcher->trigger('plgrsOnSelectCheckPayment', array( $cart));
			$dataValid = true;
			foreach ($_retValues as $_retVal) {
				if ($_retVal === true ) {
					// Plugin completed succesfull; nothing else to do
					$cart->setCartIntoSession();
					break;
				} else if ($_retVal === false ) {
		   $mainframe = JFactory::getApplication();
		   $mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=editpayment',$this->useXHTML,$this->useSSL), $_retVal);
		   break;
				}
			}
			//			$cart->setDataValidation();	//Not needed already done in the getCart function

			if ($cart->getInCheckOut()) {
				$mainframe = JFactory::getApplication();
				$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=checkout'), $msg);
			}
		}
		// 	self::Cart();
		parent::display();
	}

	/**
	 * Delete a product from the cart
	 *
	 * @author RolandD
	 * @access public
	 */
	public function delete() {
		$mainframe = JFactory::getApplication();
		/* Load the cart helper */
		$cart = retinashopCart::getCart();
		if ($cart->removeProductCart())
		$mainframe->enqueueMessage(RText::_('COM_RETINASHOP_PRODUCT_REMOVED_SUCCESSFULLY'));
		else
		$mainframe->enqueueMessage(RText::_('COM_RETINASHOP_PRODUCT_NOT_REMOVED_SUCCESSFULLY'), 'error');

		$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart'));
	}

	/**
	 * Delete a product from the cart
	 *
	 * @author RolandD
	 * @access public
	 */
	public function update() {
		$mainframe = JFactory::getApplication();
		/* Load the cart helper */
		$cartModel = retinashopCart::getCart();
		if ($cartModel->updateProductCart())
		$mainframe->enqueueMessage(RText::_('COM_RETINASHOP_PRODUCT_UPDATED_SUCCESSFULLY'));
		else
		$mainframe->enqueueMessage(RText::_('COM_RETINASHOP_PRODUCT_NOT_UPDATED_SUCCESSFULLY'), 'error');

		$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart'));
	}

	/**
	 * Checks for the data that is needed to process the order
	 *
	 * @author Max Milbers
	 *
	 *
	 */
	public function checkout() {
		//Tests step for step for the necessary data, redirects to it, when something is lacking

		$cart = retinashopCart::getCart();
		if ($cart && !rsConfig::get('use_as_catalog', 0)) {
			$cart->checkout();
		}
	}

	/**
	 * Executes the confirmDone task,
	 * cart object checks itself, if the data is valid
	 *
	 * @author Max Milbers
	 *
	 *
	 */
	public function confirm() {

		//Use false to prevent valid boolean to get deleted
		$cart = retinashopCart::getCart();
		if ($cart) {
			$cart->confirmDone();
			$view = $this->getView('cart', 'html');
			$view->setLayout('order_done');
			// Display it all
			$view->display();
		} else {
			$mainframe = JFactory::getApplication();
			$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart'), RText::_('COM_RETINASHOP_CART_DATA_NOT_VALID'));
		}
	}

	function cancel() {
		$mainframe = JFactory::getApplication();
		$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart'), 'Cancelled');
	}

}

//pure php no Tag
