<?php

/**
 *
 * Category model for the cart
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
 * @version $Id: cart.php 5844 2012-04-09 17:53:14Z Milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');


/**
 * Model class for the cart
 * Very important, use ALWAYS the getCart function, to get the cart from the session
 * @package	Magazin
 * @subpackage Cart
 * @author RolandD
 * @author Max Milbers
 */
class retinashopCart {

	//	var $productIds = array();
	var $products = array();
	var $_inCheckOut = false;
	var $_dataValidated = false;
	var $_confirmDone = false;
	var $_lastError = null; // Used to pass errmsg to the cart using addJS()
	//todo multivendor stuff must be set in the add function, first product determins ownership of cart, or a fixed vendor is used
	var $vendorId = 1;
	var $lastVisitedCategoryId = 0;
	var $retinashop_shipmentmethod_id = 0;
	var $retinashop_paymentmethod_id = 0;
	var $automaticSelectedShipment = false;
	var $automaticSelectedPayment  = false;
	var $BT = 0;
	var $ST = 0;
	var $tosAccepted = null;
	var $customer_comment = '';
	var $couponCode = '';
	var $cartData = null;
	var $lists = null;
	// 	var $user = null;
// 	var $prices = null;
	var $pricesUnformatted = null;
	var $pricesCurrency = null;
	var $paymentCurrency = null;
	var $STsameAsBT = 0;

	private static $_cart = null;
	private static $_triesValidateCoupon;
	var $useSSL = 1;
	// 	static $first = true;

	private function __construct() {
		$this->useSSL = rsConfig::get('useSSL',0);
		$this->useXHTML = true;
		self::$_triesValidateCoupon=0;
	}

	/**
	 * Get the cart from the session
	 *
	 * @author Max Milbers
	 * @access public
	 * @param array $cart the cart to store in the session
	 */
	public static function getCart($setCart=true, $options = array()) {

		//What does this here? for json stuff?
		if (!class_exists('JTable')
		)require(RPATH_rs_LIBRARIES . DS . 'retina' . DS . 'database' . DS . 'table.php');
// 		JTable::addIncludePath(RPATH_rs_admin . DS . 'tables');

		if(empty(self::$_cart)){
			$session = JFactory::getSession($options);
			$cartSession = $session->get('rscart', 0, 'rs');

			if (!empty($cartSession)) {
				$sessionCart = unserialize( $cartSession );

				self::$_cart = new retinashopCart;

				self::$_cart->products = $sessionCart->products;
				self::$_cart->vendorId	 							= $sessionCart->vendorId;
				self::$_cart->lastVisitedCategoryId	 			= $sessionCart->lastVisitedCategoryId;
				self::$_cart->retinashop_shipmentmethod_id	= $sessionCart->retinashop_shipmentmethod_id;
				self::$_cart->retinashop_paymentmethod_id 	= $sessionCart->retinashop_paymentmethod_id;
				self::$_cart->automaticSelectedShipment 		= $sessionCart->automaticSelectedShipment;
				self::$_cart->automaticSelectedPayment 		= $sessionCart->automaticSelectedPayment;
				self::$_cart->BT 										= $sessionCart->BT;
				self::$_cart->ST 										= $sessionCart->ST;
				self::$_cart->tosAccepted 							= $sessionCart->tosAccepted;
				self::$_cart->customer_comment 					= base64_decode($sessionCart->customer_comment);
				self::$_cart->couponCode 							= $sessionCart->couponCode;
				self::$_cart->cartData 								= $sessionCart->cartData;

// 				if(!class_exists('calculationHelper')) require(RPATH_rs_admin.DS.'helpers'.DS.'calculationh.php');
// 				$calculator = calculationHelper::getInstance();
// 				self::$_cart->cartData								= $calculator->getCartData();
				self::$_cart->lists 									= $sessionCart->lists;
				// 				self::$_cart->user 									= $sessionCart->user;
// 				self::$_cart->prices 								= $sessionCart->prices;
				self::$_cart->pricesUnformatted					= $sessionCart->pricesUnformatted;
				self::$_cart->pricesCurrency						= $sessionCart->pricesCurrency;
				self::$_cart->paymentCurrency						= $sessionCart->paymentCurrency;

				self::$_cart->_inCheckOut 							= $sessionCart->_inCheckOut;
				self::$_cart->_dataValidated						= $sessionCart->_dataValidated;
				self::$_cart->_confirmDone							= $sessionCart->_confirmDone;
				self::$_cart->STsameAsBT							= $sessionCart->STsameAsBT;

			}

		}

		if(empty(self::$_cart)){
			self::$_cart = new retinashopCart;
		}

		if ( $setCart == true ) {
			self::$_cart->setPreferred();
			self::$_cart->setCartIntoSession();
		}

		return self::$_cart;
	}

	/*
	 * Set non product info in object
	*/
	public function setPreferred() {

		$usermodel = rsModel::getModel('user');
		$user = $usermodel->getUser();

		if (empty($this->BT) || (!empty($this->BT) && count($this->BT) <=1) ) {
			foreach ($user->userInfo as $address) {
				if ($address->address_type == 'BT') {
					$this->saveAddressInCart((array) $address, $address->address_type,false);
				}
			}
		}

		if (empty($this->retinashop_shipmentmethod_id) && !empty($user->retinashop_shipmentmethod_id)) {
			$this->retinashop_shipmentmethod_id = $user->retinashop_shipmentmethod_id;
		}

		if (empty($this->retinashop_paymentmethod_id) && !empty($user->retinashop_paymentmethod_id)) {
			$this->retinashop_paymentmethod_id = $user->retinashop_paymentmethod_id;
		}

		//$this->tosAccepted is due session stuff always set to 0, so testing for null does not work
		if((!empty($user->agreed) || !empty($this->BT['agreed'])) && !rsConfig::get('agree_to_tos_onorder',0) ){
				$this->tosAccepted = 1;
		}
	}

	/**
	 * Set the cart in the session
	 *
	 * @author RolandD
	 *
	 * @access public
	 * @param array $cart the cart to store in the session
	 */
	public function setCartIntoSession() {

		$session = JFactory::getSession();

		$sessionCart = new stdClass();
		// 		rsdebug('setCartIntoSession ids',$this);

		$products = array();
		if ($this->products) {
			foreach($this->products as $key =>$product){

				//Important DO NOT UNSET product_price
				//unset($product->product_price);
// 				rsdebug('$product',$product);
				unset($product->prices);
				unset($product->pricesUnformatted);
				unset($product->mf_name);
				unset($product->mf_desc);
				unset($product->mf_url);

				unset($product->salesPrice);
				unset($product->basePriceWithTax);
				unset($product->subtotal);
				unset($product->subtotal_with_tax);
				unset($product->subtotal_tax_amount);
				unset($product->subtotal_discount);

				unset($product->product_price_vdate);
				unset($product->product_price_edate);
			}
		}
		// 		$sessionCart->products = $products;
		$sessionCart->products = $this->products;
		// 		echo '<pre>'.print_r($products,1).'</pre>';die;
		$sessionCart->vendorId	 							= $this->vendorId;
		$sessionCart->lastVisitedCategoryId	 			= $this->lastVisitedCategoryId;
		$sessionCart->retinashop_shipmentmethod_id	= $this->retinashop_shipmentmethod_id;
		$sessionCart->retinashop_paymentmethod_id 	= $this->retinashop_paymentmethod_id;
		$sessionCart->automaticSelectedShipment 		= $this->automaticSelectedShipment;
		$sessionCart->automaticSelectedPayment 		= $this->automaticSelectedPayment;
		$sessionCart->BT 										= $this->BT;
		$sessionCart->ST 										= $this->ST;
		$sessionCart->tosAccepted 							= $this->tosAccepted;
		$sessionCart->customer_comment 					= base64_encode($this->customer_comment);
		$sessionCart->couponCode 							= $this->couponCode;
		$sessionCart->cartData 								= $this->cartData;
		$sessionCart->lists 									= $this->lists;
		// 		$sessionCart->user 									= $this->user;
// 		$sessionCart->prices 								= $this->prices;
		$sessionCart->pricesUnformatted					= $this->pricesUnformatted;
		$sessionCart->pricesCurrency						= $this->pricesCurrency;
		$sessionCart->paymentCurrency						= $this->paymentCurrency;

		//private variables
		$sessionCart->_inCheckOut 							= $this->_inCheckOut;
		$sessionCart->_dataValidated						= $this->_dataValidated;
		$sessionCart->_confirmDone							= $this->_confirmDone;
		$sessionCart->STsameAsBT							= $this->STsameAsBT;

		if(!empty($sessionCart->pricesUnformatted)){
			foreach($sessionCart->pricesUnformatted as &$prices){
				if(is_array($prices)){
					foreach($prices as &$price){
						$price = (string)$price;
					}
				} else {
					$prices = (string)$prices;
				}
			}
		}

// 		$pr = serialize($sessionCart->pricesUnformatted);
// 		rsdebug('$sessionCart',$sessionCart);
		$session->set('rscart', serialize($sessionCart),'rs');

	}

	/**
	 * Remove the cart from the session
	 *
	 * @author Max Milbers
	 * @access public
	 */
	public function removeCartFromSession() {
		$session = JFactory::getSession();
		$session->set('rscart', 0, 'rs');
	}

	public function setDataValidation($valid=false) {
		$this->_dataValidated = $valid;
		// 		$this->setCartIntoSession();
	}

	public function getDataValidated() {
		return $this->_dataValidated;
	}

	public function getInCheckOut() {
		return $this->_inCheckOut;
	}

	/**
	 * Set the last error that occured.
	 * This is used on error to pass back to the cart when addJS() is invoked.
	 * @param string $txt Error message
	 * @author Oscar van Eijk
	 */
	private function setError($txt) {
		$this->_lastError = $txt;
	}

	/**
	 * Retrieve the last error message
	 * @return string The last error message that occured
	 * @author Oscar van Eijk
	 */
	public function getError() {
		return ($this->_lastError);
	}

	/**
	 * Add a product to the cart
	 *
	 * @author RolandD
	 * @author Max Milbers
	 * @access public
	 */
	public function add($retinashop_product_ids=null,&$errorMsg='') {
		$mainframe = JFactory::getApplication();
		$success = false;
		$post = JRequest::get('default');

		if(empty($retinashop_product_ids)){
			$retinashop_product_ids = JRequest::getVar('retinashop_product_id', array(), 'default', 'array'); //is sanitized then
		}

		if (empty($retinashop_product_ids)) {
			$mainframe->enqueueMessage(RText::_('COM_RETINASHOP_CART_ERROR_NO_PRODUCT_IDS', false));
			return false;
		}

		//Iterate through the prod_id's and perform an add to cart for each one
		foreach ($retinashop_product_ids as $p_key => $retinashop_product_id) {

			$tmpProduct = $this->getProduct((int) $retinashop_product_id);
			//			dump($tmpProduct,'my product add to cart before');
			// trying to save some space in the session table
			$product = new stdClass();
			$product -> retinashop_manufacturer_id = $tmpProduct -> retinashop_manufacturer_id;
// 			$product -> mf_name = $tmpProduct -> mf_name;
			$product -> slug = $tmpProduct -> slug;
// 			$product -> mf_desc = $tmpProduct -> mf_desc;
// 			$product -> mf_url = $tmpProduct -> mf_url;
			$product -> published = $tmpProduct -> published;

			$product -> retinashop_product_price_id = $tmpProduct -> retinashop_product_price_id;
			$product -> retinashop_product_id = $tmpProduct -> retinashop_product_id;
			$product -> retinashop_shoppergroup_id = $tmpProduct -> retinashop_shoppergroup_id;
			$product -> product_price = $tmpProduct -> product_price;
			$product -> override = $tmpProduct -> override;
			$product -> product_override_price = $tmpProduct -> product_override_price;

			$product -> product_tax_id = $tmpProduct -> product_tax_id;
			$product -> product_discount_id = $tmpProduct -> product_discount_id;
			$product -> product_currency = $tmpProduct -> product_currency;
// 			$product -> product_price_vdate = $tmpProduct -> product_price_vdate;
// 			$product -> product_price_edate = $tmpProduct -> product_price_edate;
			$product -> retinashop_vendor_id = $tmpProduct -> retinashop_vendor_id;
			$product -> product_parent_id = $tmpProduct -> product_parent_id;
			$product -> product_sku = $tmpProduct -> product_sku;
			$product -> product_name = $tmpProduct -> product_name;
			$product -> product_s_desc = $tmpProduct -> product_s_desc;

			$product -> product_weight = $tmpProduct -> product_weight;
			$product -> product_weight_uom = $tmpProduct -> product_weight_uom;
			$product -> product_length = $tmpProduct -> product_length;
			$product -> product_width = $tmpProduct -> product_width;
			$product -> product_height = $tmpProduct -> product_height;
			$product -> product_lwh_uom = $tmpProduct -> product_lwh_uom;

			$product -> product_in_stock = $tmpProduct -> product_in_stock;
			$product -> product_ordered = $tmpProduct -> product_ordered;

			$product -> product_sales = $tmpProduct -> product_sales;
			$product -> product_unit = $tmpProduct -> product_unit;
			$product -> product_packaging = $tmpProduct -> product_packaging;
			$product -> min_order_level = $tmpProduct -> min_order_level;
			$product -> max_order_level = $tmpProduct -> max_order_level;
			$product -> retinashop_media_id = $tmpProduct -> retinashop_media_id;

			if(!empty($tmpProduct ->images)) $product->image =  $tmpProduct -> images[0];

			$product -> categories = $tmpProduct -> categories;
			$product -> retinashop_category_id = $tmpProduct -> retinashop_category_id;
			$product -> category_name = $tmpProduct -> category_name;

			$product -> link = $tmpProduct -> link;
			$product -> packaging = $tmpProduct -> packaging;
			//$product -> customfields = empty($tmpProduct -> customfields)? array():$tmpProduct -> customfields ;
			//$product -> customfieldsCart = empty($tmpProduct -> customfieldsCart)? array(): $tmpProduct -> customfieldsCart;
			if (!empty($tmpProduct -> customfieldsCart) ) $product -> customfieldsCart = true;
			//$product -> customsChilds = empty($tmpProduct -> customsChilds)? array(): $tmpProduct -> customsChilds;

			//			rsdebug('my product add to cart after',$product);
			//Why reloading the product wiht same name $product ?
			// passed all from $tmpProduct and relaoding it second time ????
			// $tmpProduct = $this->getProduct((int) $retinashop_product_id); seee before !!!
			// $product = $this->getProduct((int) $retinashop_product_id);
			// Who ever noted that, yes that is exactly right that way, before we have a full object, with all functions
			// of all its parents, we only need the data of the product, so we create a dummy class which contains only the data
			// This is extremly important for performance reasons, else the sessions becomes too big.
			// Check if we have a product
			if ($product) {
				$quantityPost = (int) $post['quantity'][$p_key];

				if(!empty( $post['retinashop_category_id'][$p_key])){
					$retinashop_category_idPost = (int) $post['retinashop_category_id'][$p_key];
					$product->retinashop_category_id = $retinashop_category_idPost;
				}

				$productKey = $product->retinashop_product_id;
				// INDEX NOT FOUND IN JSON HERE
				// changed name field you know exactly was this is
				if (isset($post['customPrice'])) {
					$product->customPrices = $post['customPrice'];
					if (isset($post['customPlugin'])) $product->customPlugin = json_encode($post['customPlugin']);


					$productKey .= '::';
					foreach ($product->customPrices as $customPrice) {
						foreach ($customPrice as $customId => $custom_fieldId) {

							if ( is_array($custom_fieldId) ) {
								foreach ($custom_fieldId as $userfieldId => $userfield) {
									$productKey .= $customId . ':' . $userfieldId . ';';
									$product->userfield[$customId . '-' . $userfieldId] = $userfield;
								}
							} else {
								$productKey .= $customId . ':' . $custom_fieldId . ';';
							}

						}
					}

				}

				if(!class_exists('rsCustomPlugin')) require(RPATH_rs_PLUGINS.DS.'rscustomplugin.php');
				JPluginHelper::importPlugin('rscustom');
				$dispatcher = JDispatcher::getInstance();
				// on returning false the product have not to be added to cart
				if ( $dispatcher->trigger('plgrsOnAddToCart',array(&$product)) === false )
					continue;


				if (array_key_exists($productKey, $this->products) && (empty($product->customPlugin)) ) {

					$errorMsg = RText::_('COM_RETINASHOP_CART_PRODUCT_UPDATED');
					$totalQuantity = $this->products[$productKey]->quantity+ $quantityPost;
					if ($this->checkForQuantities($product,$totalQuantity ,$errorMsg)) {
						$this->products[$productKey]->quantity = $totalQuantity;

					} else {

						continue;
					}
				}  else {
					if ( !empty($product->customPlugin)) {
						$productKey .= count($this->products);

					}
					if ($this->checkForQuantities($product, $quantityPost,$errorMsg)) {
						$this->products[$productKey] = $product;
						$product->quantity = $quantityPost;
						//$mainframe->enqueueMessage(RText::_('COM_RETINASHOP_CART_PRODUCT_ADDED'));
					} else {
						// $errorMsg = RText::_('COM_RETINASHOP_CART_PRODUCT_OUT_OF_STOCK');
						continue;
					}
				}
				$success = true;
			} else {
				$mainframe->enqueueMessage(RText::_('COM_RETINASHOP_PRODUCT_NOT_FOUND', false));
				return false;
			}
		}
		if ($success== false) return false ;
		// End Iteration through Prod id's
		$this->setCartIntoSession();
		return true;
	}

	/**
	 * Remove a product from the cart
	 *
	 * @author RolandD
	 * @param array $cart_id the cart IDs to remove from the cart
	 * @access public
	 */
	public function removeProductCart($prod_id=0) {
		/* Check for cart IDs */
		if (empty($prod_id))
		$prod_id = JRequest::getVar('cart_retinashop_product_id');
		unset($this->products[$prod_id]);

		$this->setCartIntoSession();
		return true;
	}

	/**
	 * Update a product in the cart
	 *
	 * @author Max Milbers
	 * @param array $cart_id the cart IDs to remove from the cart
	 * @access public
	 */
	public function updateProductCart($cart_retinashop_product_id=0) {

		if (empty($cart_retinashop_product_id))
		$cart_retinashop_product_id = JRequest::getString('cart_retinashop_product_id');
		if (empty($quantity))
		$quantity = JRequest::getInt('quantity');

		//		foreach($cart_retinashop_product_ids as $cart_retinashop_product_id){
		$updated = false;
		if (array_key_exists($cart_retinashop_product_id, $this->products)) {
			if (!empty($quantity)) {
				if ($this->checkForQuantities($this->products[$cart_retinashop_product_id], $quantity)) {
					$this->products[$cart_retinashop_product_id]->quantity = $quantity;
					$updated = true;
				}
			} else {
				//Todo when quantity is 0,  the product should be removed, maybe necessary to gather in array and execute delete func
				unset($this->products[$cart_retinashop_product_id]);
				$updated = true;
			}
		}
		//		}

		/* Save the cart */
		$this->setCartIntoSession();
		if ($updated)
		return true;
		else
		return false;
	}


	/**
	 * Function Description
	 *
	 * @author Max Milbers
	 * @access public
	 * @param array $cart the cart to get the products for
	 * @return array of product objects
	 */
// 	$this->pricesUnformatted = $product_prices;

	public function getCartPrices($checkAutomaticSelected=true) {

		if(!class_exists('calculationHelper')) require(RPATH_rs_admin.DS.'helpers'.DS.'calculationh.php');
		$calculator = calculationHelper::getInstance();

		$this->pricesUnformatted = $calculator->getCheckoutPrices($this, $checkAutomaticSelected);
// 		rsdebug('Calling getCartPrices',$this->pricesUnformatted);

		return $this->pricesUnformatted;
	}

	/**
	 * Proxy function for getting a product object
	 *
	 * @author Max Milbers
	 * @todo Find out if the include path belongs here? For now it works.
	 * @param int $retinashop_product_id The product ID to get the object for
	 * @return object The product details object
	 */
	private function getProduct($retinashop_product_id) {
		JModel::addIncludePath(RPATH_rs_admin . DS . 'models');
		$model = JModel::getInstance('Product', 'retinashopModel');
		$product = $model->getProduct($retinashop_product_id, true, false);

		if ( rsConfig::get('oncheckout_show_images')){
			$model->addImages($product,1);

		}
		return $product;
	}


	/**
	* Get the category ID from a product ID
	*
	* @author RolandD, Patrick Kohl
	* @access public
	* @return mixed if found the category ID else null
	*/
	public function getCardCategoryId($retinashop_product_id) {
		$db = JFactory::getDBO();
		$q = 'SELECT `retinashop_category_id` FROM `#__retinashop_product_categories` WHERE `retinashop_product_id` = ' . (int) $retinashop_product_id . ' LIMIT 1';
		$db->setQuery($q);
		return $db->loadResult();
	}

	/** Checks if the quantity is correct
	 *
	 * @author Max Milbers
	 */
	private function checkForQuantities($product, &$quantity=0,&$errorMsg ='') {

		$stockhandle = rsConfig::get('stockhandle','none');
		$mainframe = JFactory::getApplication();
		// Check for a valid quantity
		if (!is_numeric( $quantity)) {
			$errorMsg = RText::_('COM_RETINASHOP_CART_ERROR_NO_VALID_QUANTITY', false);
			//			$this->_error[] = 'Quantity was not a number';
			$this->setError($errorMsg);
			rsInfo($errorMsg,$product->product_name);
			return false;
		}
		// Check for negative quantity
		if ($quantity < 1) {
			//			$this->_error[] = 'Quantity under zero';
			$errorMsg = RText::_('COM_RETINASHOP_CART_ERROR_NO_VALID_QUANTITY', false);
			$this->setError($errorMsg);
			rsInfo($errorMsg,$product->product_name);
			return false;
		}

		// Check to see if checking stock quantity
		if ($stockhandle!='none' && $stockhandle!='risetime') {

			$productsleft = $product->product_in_stock - $product->product_ordered;
			// TODO $productsleft = $product->product_in_stock - $product->product_ordered - $quantityincart ;
			if ($quantity > $productsleft ){
				if($productsleft>0 and $stockhandle='disableadd'){
					$quantity = $productsleft;
					$errorMsg = RText::sprintf('COM_RETINASHOP_CART_PRODUCT_OUT_OF_QUANTITY',$quantity);
					$this->setError($errorMsg);
					rsInfo($errorMsg,$product->product_name);
					// $mainframe->enqueueMessage($errorMsg);
				} else {
					$errorMsg = RText::_('COM_RETINASHOP_CART_PRODUCT_OUT_OF_STOCK');
					$this->setError($errorMsg); // Private error retrieved with getError is used only by addJS, so only the latest is fine
					rsInfo($errorMsg,$product->product_name,$productsleft);
					// $mainframe->enqueueMessage($errorMsg);
					return false;
				}
			}
		}

		// Check for the minimum and maximum quantities
		$min = $product->min_order_level;
		$max = $product->max_order_level;
		if ($min != 0 && $quantity < $min) {
			//			$this->_error[] = 'Quantity reached not minimum';
			$errorMsg = RText::sprintf('COM_RETINASHOP_CART_MIN_ORDER', $min);
			$this->setError($errorMsg);
			rsInfo($errorMsg,$product->product_name);
			return false;
		}
		if ($max != 0 && $quantity > $max) {
			//			$this->_error[] = 'Quantity reached over maximum';
			$errorMsg = RText::sprintf('COM_RETINASHOP_CART_MAX_ORDER', $max);
			$this->setError($errorMsg);
			rsInfo($errorMsg,$product->product_name);
			return false;
		}

		return true;
	}


	/**
	 * Validate the coupon code. If ok,. set it in the cart
	 * @param string $coupon_code Coupon code as entered by the user
	 * @author Oscar van Eijk
	 * TODO Change the coupon total/used in DB ?
	 * @access public
	 * @return string On error the message text, otherwise an empty string
	 */
	public function setCouponCode($coupon_code) {
		if (!class_exists('CouponHelper')) {
			require(RPATH_rs_SITE . DS . 'helpers' . DS . 'coupon.php');
		}
		$prices = $this->getCartPrices();
		$msg = CouponHelper::ValidateCouponCode($coupon_code, $prices['salesPrice']);
		if (!empty($msg)) {
			$this->couponCode = '';
			$this->setCartIntoSession();
			return $msg;
		}
		$this->couponCode = $coupon_code;
		$this->setCartIntoSession();
		return '';
	}

	/**
	 * Check the selected shipment data and store the info in the cart
	 * @param integer $shipment_id Shipment ID taken from the form data
	 * @author Oscar van Eijk
	 */
	public function setShipment($shipment_id) {

	    $this->retinashop_shipmentmethod_id = $shipment_id;
	    $this->setCartIntoSession();

	}

	public function setPaymentMethod($retinashop_paymentmethod_id) {
		$this->retinashop_paymentmethod_id = $retinashop_paymentmethod_id;
		$this->setCartIntoSession();
	}

	function confirmDone() {

		$this->checkoutData();
		if ($this->_dataValidated) {
			$this->_confirmDone = true;
			$this->confirmedOrder();
		} else {
			$mainframe = JFactory::getApplication();
			$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart'), RText::_('COM_RETINASHOP_CART_CHECKOUT_DATA_NOT_VALID'));
		}
	}

	function checkout($redirect=true) {

		$this->checkoutData($redirect);
		if ($this->_dataValidated && $redirect) {
			$mainframe = JFactory::getApplication();
			$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart'), RText::_('COM_RETINASHOP_CART_CHECKOUT_DONE_CONFIRM_ORDER'));
		}
	}

	private function redirecter($relUrl,$redirectMsg){

		$this->_dataValidated = false;
		$app = JFactory::getApplication();
		if($this->_redirect ){
			$this->setCartIntoSession();
			$app->redirect(JRoute::_($relUrl,$this->useXHTML,$this->useSSL), $redirectMsg);
		} else {
			$this->setCartIntoSession();
			return false;
		}
	}

	private function checkoutData($redirect = true) {

		$this->_redirect = $redirect;
		$this->_inCheckOut = true;

		$this->tosAccepted = JRequest::getInt('tosAccepted', $this->tosAccepted);

		$this->customer_comment = JRequest::getVar('customer_comment', $this->customer_comment);

		// no HTML TAGS but permit all alphabet
		$value =	preg_replace('@<[\/\!]*?[^<>]*?>@si','',$this->customer_comment);//remove all html tags
		$value =	(string)preg_replace('#on[a-z](.+?)\)#si','',$value);//replace start of script onclick() onload()...
		$value = trim(str_replace('"', ' ', $value),"'") ;
		$this->customer_comment=	(string)preg_replace('#^\'#si','',$value);//replace ' at start

		if (($this->selected_shipto = JRequest::getVar('shipto', null)) !== null) {
			JModel::addIncludePath(RPATH_rs_admin . DS . 'models');
			$userModel = JModel::getInstance('user', 'retinashopModel');
			$stData = $userModel->getUserAddressList(0, 'ST', $this->selected_shipto);
			$this->validateUserData('ST', $stData[0]);
		}

		$this->setCartIntoSession();

		$mainframe = JFactory::getApplication();
		if (count($this->products) == 0) {
			return $this->redirecter('index.php?option=com_retinashop', RText::_('COM_RETINASHOP_CART_NO_PRODUCT'));
		} else {
			foreach ($this->products as $product) {
				$redirectMsg = $this->checkForQuantities($product, $product->quantity);
				if (!$redirectMsg) {
					return $this->redirecter('index.php?option=com_retinashop&view=cart', $redirectMsg);
				}
			}
		}

		// Check if a minimun purchase value is set
		if (($redirectMsg = $this->checkPurchaseValue()) != null) {
			return $this->redirecter('index.php?option=com_retinashop&view=cart' , $redirectMsg);
		}

		//But we check the data again to be sure
		if (empty($this->BT)) {
			$redirectMsg = '';
			return $this->redirecter('index.php?option=com_retinashop&view=user&task=editaddresscheckout&addrtype=BT' , $redirectMsg);
		} else {
			$redirectMsg = self::validateUserData();
			if ($redirectMsg) {
				return $this->redirecter('index.php?option=com_retinashop&view=user&task=editaddresscheckout&addrtype=BT' , $redirectMsg);
			}
		}

		if($this->STsameAsBT!==0){
			$this->ST = $this->BT;
		} else {
			//Only when there is an ST data, test if all necessary fields are filled
			if (!empty($this->ST)) {
				$redirectMsg = self::validateUserData('ST');
				if ($redirectMsg) {
					return $this->redirecter('index.php?option=com_retinashop&view=user&task=editaddresscheckout&addrtype=ST' , $redirectMsg);
				}
			}
		}



		// Test Coupon
		if (!empty($this->couponCode)) {
			$prices = $this->getCartPrices();
			if (!class_exists('CouponHelper')) {
				require(RPATH_rs_SITE . DS . 'helpers' . DS . 'coupon.php');
			}
			if(self::$_triesValidateCoupon<8){
				$redirectMsg = CouponHelper::ValidateCouponCode($this->couponCode, $prices['salesPrice']);
			} else{
				$redirectMsg = RText::_('COM_RETINASHOP_CART_COUPON_TOO_MANY_TRIES');
			}
			self::$_triesValidateCoupon++;// = self::$_triesValidateCoupon + 1;
			if (!empty($redirectMsg)) {

				$this->couponCode = '';
				return $this->redirecter('index.php?option=com_retinashop&view=cart&task=edit_coupon' , $redirectMsg);
// 				$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=edit_coupon',$this->useXHTML,$this->useSSL), $redirectMsg);
			}
		}

		//Test Shipment and show shipment plugin
		if (empty($this->retinashop_shipmentmethod_id)) {
// 			$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=edit_shipment',$this->useXHTML,$this->useSSL), $redirectMsg);
			return $this->redirecter('index.php?option=com_retinashop&view=cart&task=edit_shipment' , $redirectMsg);
		} else {
			if (!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');
			JPluginHelper::importPlugin('rsshipment');
			//Add a hook here for other shipment methods, checking the data of the choosed plugin
			$dispatcher = JDispatcher::getInstance();
			$retValues = $dispatcher->trigger('plgrsOnCheckoutCheckDataShipment', array(  $this));

			foreach ($retValues as $retVal) {
				if ($retVal === true) {
					break; // Plugin completed succesful; nothing else to do
				} elseif ($retVal === false) {
					// Missing data, ask for it (again)
					return $this->redirecter('index.php?option=com_retinashop&view=cart&task=edit_shipment' , $redirectMsg);
// 					$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=edit_shipment',$this->useXHTML,$this->useSSL), $redirectMsg);
					// 	NOTE: inactive plugins will always return null, so that value cannot be used for anything else!
				}
			}
		}
		//echo 'hier ';
		//Test Payment and show payment plugin
		if (empty($this->retinashop_paymentmethod_id)) {
// 			$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=editpayment',$this->useXHTML,$this->useSSL), $redirectMsg);
			return $this->redirecter('index.php?option=com_retinashop&view=cart&task=editpayment' , $redirectMsg);
		} else {
			if(!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS.DS.'rspsplugin.php');
			JPluginHelper::importPlugin('rspayment');
			//Add a hook here for other payment methods, checking the data of the choosed plugin
			$dispatcher = JDispatcher::getInstance();
			$retValues = $dispatcher->trigger('plgrsOnCheckoutCheckDataPayment', array( $this));

			foreach ($retValues as $retVal) {
				if ($retVal === true) {
					break; // Plugin completed succesful; nothing else to do
				} elseif ($retVal === false) {
					// Missing data, ask for it (again)
					return $this->redirecter('index.php?option=com_retinashop&view=cart&task=editpayment' , $redirectMsg);
// 					$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart&task=editpayment',$this->useXHTML,$this->useSSL), $redirectMsg);
					// 	NOTE: inactive plugins will always return null, so that value cannot be used for anything else!
				}
			}
		}


		if (empty($this->tosAccepted)) {

			$userFieldsModel = rsModel::getModel('Userfields');

			$required = $userFieldsModel->getIfRequired('agreed');
			if(!empty($required)){
				$redirectMsg = RText::_('COM_RETINASHOP_CART_PLEASE_ACCEPT_TOS');
				return $this->redirecter('index.php?option=com_retinashop&view=cart' , $redirectMsg);
			}
		}

		if(rsConfig::get('oncheckout_only_registered',0)) {
			$currentUser = JFactory::getUser();
			if(empty($currentUser->id)){
				$redirectMsg = RText::_('COM_RETINASHOP_CART_ONLY_REGISTERED');
				return $this->redirecter('index.php?option=com_retinashop&view=user&task=editaddresscheckout&addrtype=BT' , $redirectMsg);
			}
		 }

		//Show cart and checkout data overview
		$this->_inCheckOut = false;
		$this->_dataValidated = true;

		$this->setCartIntoSession();

		return true;
	}

	/**
	 * Check if a minimum purchase value for this order has been set, and if so, if the current
	 * value is equal or hight than that value.
	 * @author Oscar van Eijk
	 * @return An error message when a minimum value was set that was not eached, null otherwise
	 */
	private function checkPurchaseValue() {

		$vendor = rsModel::getModel('vendor');
		$vendor->setId($this->vendorId);
		$store = $vendor->getVendor();
		if ($store->vendor_min_pov > 0) {
			$prices = $this->getCartPrices();
			if ($prices['salesPrice'] < $store->vendor_min_pov) {
				if (!class_exists('CurrencyDisplay'))
				require(RPATH_rs_admin . DS . 'helpers' . DS . 'currencydisplay.php');
				$currency = CurrencyDisplay::getInstance();
				$minValue = $currency->priceDisplay($min);
				return RText::sprintf('COM_RETINASHOP_CART_MIN_PURCHASE', $currency->priceDisplay($store->vendor_min_pov));
			}
		}
		return null;
	}

	/**
	 * Test userdata if valid
	 *
	 * @author Max Milbers
	 * @param String if BT or ST
	 * @param Object If given, an object with data address data that must be formatted to an array
	 * @return redirectMsg, if there is a redirectMsg, the redirect should be executed after
	 */
	private function validateUserData($type='BT', $obj = null) {

		if (!class_exists('retinashopModelUserfields'))
		require(RPATH_rs_admin . DS . 'models' . DS . 'userfields.php');
		$userFieldsModel = rsModel::getModel('userfields');

		if ($type == 'BT')
		$fieldtype = 'account'; else
		$fieldtype = 'shipment';

		$neededFields = $userFieldsModel->getUserFields(
		$fieldtype
		, array('required' => true, 'delimiters' => true, 'captcha' => true, 'main' => false)
		, array('delimiter_userinfo', 'name','username', 'password', 'password2', 'address_type_name', 'address_type', 'user_is_vendor', 'agreed'));

		$redirectMsg = false;

		$i = 0 ;

		foreach ($neededFields as $field) {

			if($field->required && empty($this->{$type}[$field->name]) && $field->name != 'retinashop_state_id'){
				$redirectMsg = RText::sprintf('COM_RETINASHOP_MISSING_VALUE_FOR_FIELD',RText::_($field->title) );
				$i++;
				//more than four fields missing, this is not a normal error (should be catche by js anyway, so show the address again.
				if($i>2 && $type=='BT'){
					$redirectMsg = RText::_('COM_RETINASHOP_CHECKOUT_PLEASE_ENTER_ADDRESS');
				}
			}

			if ($obj !== null && is_array($this->{$type})) {
				$this->{$type}[$field->name] = $obj->{$field->name};
			}

			//This is a special test for the retinashop_state_id. There is the speciality that the retinashop_state_id could be 0 but is valid.
			if ($field->name == 'retinashop_state_id') {
				if (!class_exists('retinashopModelState')) require(RPATH_rs_admin . DS . 'models' . DS . 'state.php');
				if(!empty($this->{$type}['retinashop_country_id']) && !empty($this->{$type}['retinashop_state_id']) ){
					if (!$msg = retinashopModelState::testStateCountry($this->{$type}['retinashop_country_id'], $this->{$type}['retinashop_state_id'])) {
						$redirectMsg = $msg;
					}
				}

			}
		}

		return $redirectMsg;
	}

	/**
	 * This function is called, when the order is confirmed by the shopper.
	 *
	 * Here are the last checks done by payment plugins.
	 * The mails are created and send to vendor and shopper
	 * will show the orderdone page (thank you page)
	 *
	 */
	private function confirmedOrder() {

		//Just to prevent direct call
		if ($this->_dataValidated && $this->_confirmDone) {

			$orderModel = rsModel::getModel('orders');

			if (($orderID = $orderModel->createOrderFromCart($this)) === false) {
				$mainframe = JFactory::getApplication();
				JError::raiseWarning(500, 'No order created '.$orderModel->getError());
				$mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=cart') );
			}
			$this->retinashop_order_id = $orderID;
			$order= $orderModel->getOrder($orderID);

			$dispatcher = JDispatcher::getInstance();

			JPluginHelper::importPlugin('rsshipment');
			JPluginHelper::importPlugin('rscustom');
			JPluginHelper::importPlugin('rspayment');
			$returnValues = $dispatcher->trigger('plgrsConfirmedOrder', array($this, $order));
			// may be redirect is done by the payment plugin (eg: paypal)
			// if payment plugin echos a form, false = nothing happen, true= echo form ,
			// 1 = cart should be emptied, 0 cart should not be emptied

		}


	}

	/**
	 * emptyCart: Used for payment handling.
	 *
	 * @author Valerie Cartan Isaksen
	 *
	 */
	public function emptyCart(){

		//We delete the old stuff
		$this->products = array();
		$this->_inCheckOut = false;
		$this->_dataValidated = false;
		$this->_confirmDone = false;
		$this->customer_comment = '';
		$this->couponCode = '';
		$this->tosAccepted = null;
		$this->retinashop_shipmentmethod_id = 0; //OSP 2012-03-14
		$this->retinashop_paymentmethod_id = 0;

		$this->setCartIntoSession();
	}


	/**
	 * prepare display of cart
	 *
	 * @author RolandD
	 * @author Max Milbers
	 * @access public
	 */
	public function prepareCartData($checkAutomaticSelected=true){

		// Get the products for the cart
// 		$prices = array();
		$product_prices = $this->getCartPrices($checkAutomaticSelected);

		if (empty($product_prices)) return;
		if(!class_exists('CurrencyDisplay')) require(RPATH_rs_admin.DS.'helpers'.DS.'currencydisplay.php');
		$currency = CurrencyDisplay::getInstance();


		if(!class_exists('calculationHelper')) require(RPATH_rs_admin.DS.'helpers'.DS.'calculationh.php');
		$calculator = calculationHelper::getInstance();

// 		$this->prices = $prices;

		$this->pricesCurrency = $currency->getCurrencyForDisplay();

		if(!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS.DS.'rspsplugin.php');
		JPluginHelper::importPlugin('rspayment');
		$dispatcher = JDispatcher::getInstance();
		$returnValues = $dispatcher->trigger('plgrsgetPaymentCurrency', array( $this->retinashop_paymentmethod_id, &$this->paymentCurrency));
		$cartData = $calculator->getCartData();

// 		$this->setCartIntoSession();
		return $cartData ;
	}

	function saveAddressInCart($data, $type, $putIntoSession = true) {

		// retinashopModelUserfields::getUserFields() won't work
		if(!class_exists('retinashopModelUserfields')) require(RPATH_rs_admin.DS.'models'.DS.'userfields.php' );
		$userFieldsModel = rsModel::getModel('userfields');
		$prefix = '';

		$prepareUserFields = $userFieldsModel->getUserFieldsFor('cart',$type);

		//STaddress may be obsolete
		if ($type == 'STaddress' || $type =='ST') {
			$prefix = 'shipto_';

		} else { // BT
			if(!empty($data['agreed'])){
				$this->tosAccepted = $data['agreed'];
			} else if (!empty($data->agreed)){
				$this->tosAccepted = $data->agreed;
			}

			if(empty($data['email'])){
				$address->email = JFactory::getUser()->email;
			}
		}

		$address = array();

		if(is_array($data)){
			foreach ($prepareUserFields as $fld) {
				if(!empty($fld->name)){
					$name = $fld->name;
					if(!empty($data[$prefix.$name])) $address[$name] = $data[$prefix.$name];
				}
			}

		} else {
			foreach ($prepareUserFields as $fld) {
				if(!empty($fld->name)){
					$name = $fld->name;
					if(!empty($data->{$prefix.$name})) $address[$name] = $data->{$prefix.$name};
				}
			}

		}

		//dont store passwords in the session
		unset($address['password']);
		unset($address['password2']);

		$this->{$type} = $address;


		if($putIntoSession){
			$this->setCartIntoSession();
		}

	}
	/*
	 * CheckAutomaticSelectedShipment
	* If only one shipment is available for this amount, then automatically select it
	*
	* @author Valérie Isaksen
	*/
	function CheckAutomaticSelectedShipment($cart_prices, $checkAutomaticSelected ) {

		$nbShipment = 0;
		$retinashop_shipmentmethod_id=0;
		if (!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');

		JPluginHelper::importPlugin('rsshipment');
		if (rsConfig::get('automatic_shipment',1) && $checkAutomaticSelected) {
		    $shipCounter=0;
			$dispatcher = JDispatcher::getInstance();
			$returnValues = $dispatcher->trigger('plgrsOnCheckAutomaticSelectedShipment', array(  $this,$cart_prices, &$shipCounter));
			foreach ($returnValues as $returnValue) {
				 if ( !is_null($returnValue )) {
					$nbShipment ++;
					if ($returnValue) $retinashop_shipmentmethod_id = $returnValue;
				}
			}
			if ($nbShipment==1 && $retinashop_shipmentmethod_id) {
				$this->retinashop_shipmentmethod_id = $retinashop_shipmentmethod_id;
				$this->automaticSelectedShipment=true;
				$this->setCartIntoSession();
				return true;
			} else {
				$this->automaticSelectedShipment=false;
				$this->setCartIntoSession();
				return false;
			}
		} else {
			return false;
		}


	}

	/*
	 * CheckAutomaticSelectedPayment
	* If only one payment is available for this amount, then automatically select it
	*
	* @author Valérie Isaksen
	*/
	function CheckAutomaticSelectedPayment($cart_prices,  $checkAutomaticSelected=true) {

		$nbPayment = 0;
		$retinashop_paymentmethod_id=0;
		if(!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS.DS.'rspsplugin.php');
		JPluginHelper::importPlugin('rspayment');
		if (rsConfig::get('automatic_payment',1) && $checkAutomaticSelected ) {
			$dispatcher = JDispatcher::getInstance();
			$paymentCounter=0;
			$returnValues = $dispatcher->trigger('plgrsOnCheckAutomaticSelectedPayment', array( $this, $cart_prices, &$paymentCounter));
			    foreach ($returnValues as $returnValue) {
				     if ( !is_null($returnValue )) {
					 $nbPayment++;
					    if($returnValue) $retinashop_paymentmethod_id = $returnValue;
				     }
			    }

			if ($nbPayment==1 && $retinashop_paymentmethod_id) {
				$this->retinashop_paymentmethod_id = $retinashop_paymentmethod_id;
				$cart->automaticSelectedPayment=true;
				$this->setCartIntoSession();
				return true;
			} else {
				$cart->automaticSelectedPayment=false;
				$this->setCartIntoSession();
				return false;
			}
		} else {
			return false;
		}

	}

	/*
	 * CheckShipmentIsValid:
	* check if the selected shipment is still valid for this new cart
	*
	* @author Valerie Isaksen
	*/
	function CheckShipmentIsValid() {
		if ($this->retinashop_shipmentmethod_id===0)
		return;
		$shipmentValid = false;
		if (!class_exists('rsPSPlugin')) require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');

		JPluginHelper::importPlugin('rsshipment');
		$dispatcher = JDispatcher::getInstance();
		$returnValues = $dispatcher->trigger('plgrsOnCheckShipmentIsValid', array( $this));
		foreach ($returnValues as $returnValue) {
			$shipmentValid += $returnValue;
		}
		if (!$shipmentValid) {
			$this->retinashop_shipmentmethod_id = 0;
			$this->setCartIntoSession();
		}
	}



	/*
	 * Prepare the datas for cart/mail views
	* set product, price, user, adress and vendor as Object
	* @author Patrick Kohl
	* @author Valerie Isaksen
	*/
	function prepareCartViewData(){
		$data = new stdClass();
		/* Get the products for the cart */
		$this->cartData = $this->prepareCartData();

// 		$this->prepareCartPrice( $this->prices ) ;
		$this->prepareCartPrice( $this->pricesUnformatted ) ;

		$this->prepareAddressDataInCart();
		$this->prepareVendor();

	}

	private function prepareCartPrice( $prices ){

		foreach ($this->products as $cart_element_id=>&$product){
			$product->retinashop_category_id = $this->getCardCategoryId($product->retinashop_product_id);
			// No full link because Mail want absolute path and in shop is better relative path
			$product->url = JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$product->retinashop_product_id.'&retinashop_category_id='.$product->retinashop_category_id);//JHTML::link($url, $product->product_name);
			if(!empty($product->customfieldsCart)){
				if(!class_exists('retinashopModelCustomfields'))require(RPATH_rs_admin.DS.'models'.DS.'customfields.php');
				$product->customfields = retinashopModelCustomfields::CustomsFieldCartDisplay($cart_element_id,$product);
			} else {
				$product->customfields ='';
			}
// 			$product->salesPrice = empty($prices[$cart_element_id]['salesPrice'])? 0:$prices[$cart_element_id]['salesPrice'];
// 			$product->basePriceWithTax = empty($prices[$cart_element_id]['salesPrice'])? 0:$prices[$cart_element_id]['basePriceWithTax'];
// 			$product->basePriceWithTax = $prices[$cart_element_id]['basePriceWithTax'];
// 			$product->subtotal = $prices[$cart_element_id]['subtotal'];
// 			$product->subtotal_tax_amount = $prices[$cart_element_id]['subtotal_tax_amount'];
// 			$product->subtotal_discount = $prices[$cart_element_id]['subtotal_discount'];
// 			$product->subtotal_with_tax = $prices[$cart_element_id]['subtotal_with_tax'];
			$product->cart_element_id = $cart_element_id ;
		}
	}

	function prepareAddressDataInCart($type='BT',$new = false){

		$userFieldsModel =rsModel::getModel('Userfields');

		if($new){
			$data = null;
		} else {
			$data = (object)$this->$type;
		}

		if($type=='ST'){
			$preFix = 'shipto_';
		} else {
			$preFix = '';
		}

		$addresstype = $type.'address';
		$userFieldsBT = $userFieldsModel->getUserFieldsFor('cart',$type);
		$this->$addresstype = $userFieldsModel->getUserFieldsFilled(
		$userFieldsBT
		,$data
		,$preFix
		);

		if(!empty($this->ST) && $type!=='ST'){
			$data = (object)$this->ST;
			if($new){
				$data = null;
			}
			$userFieldsST = $userFieldsModel->getUserFieldsFor('cart','ST');
			$this->STaddress = $userFieldsModel->getUserFieldsFilled(
			$userFieldsST
			,$data
			,$preFix
			);
		}

	}

	function prepareAddressRadioSelection(){

		//Just in case
		$this->user = rsModel::getModel('user');

		$this->userDetails = $this->user->getUser();

		// Shipment address(es)
		if($this->user){
			$_addressBT = $this->user->getUserAddressList($this->userDetails->JUser->get('id') , 'BT');

			// Overwrite the address name for display purposes
			$_addressBT[0]->address_type_name = RText::_('COM_RETINASHOP_ACC_BILL_DEF');

			$_addressST = $this->user->getUserAddressList($this->userDetails->JUser->get('id') , 'ST');

		} else {
			$_addressBT[0]->address_type_name = '<a href="index.php'
			.'?option=com_retinashop'
			.'&view=user'
			.'&task=editaddresscart'
			.'&addrtype=BT'
			. '">'.RText::_('COM_RETINASHOP_ACC_BILL_DEF').'</a>'.'<br />';
			$_addressST = array();
		}

		$addressList = array_merge(
		array($_addressBT[0])// More BT addresses can exist for shopowners :-(
		, $_addressST );

		if($this->user){
			for ($_i = 0; $_i < count($addressList); $_i++) {
				$addressList[$_i]->address_type_name = '<a href="index.php'
				.'?option=com_retinashop'
				.'&view=user'
				.'&task=editaddresscart'
				.'&addrtype='.(($_i == 0) ? 'BT' : 'ST')
				.'&retinashop_userinfo_id='.(empty($addressList[$_i]->retinashop_userinfo_id)? 0 : $addressList[$_i]->retinashop_userinfo_id)
				. '">'.$addressList[$_i]->address_type_name.'</a>'.'<br />';
			}

			if(!empty($addressList[0]->retinashop_userinfo_id)){
				$_selectedAddress = (
				empty($this->_cart->selected_shipto)
				? $addressList[0]->retinashop_userinfo_id // Defaults to 1st BillTo
				: $this->_cart->selected_shipto
				);
				$this->lists['shipTo'] = JHTML::_('select.radiolist', $addressList, 'shipto', null, 'retinashop_userinfo_id', 'address_type_name', $_selectedAddress);
			}else{
				$_selectedAddress = 0;
				$this->lists['shipTo'] = '';
			}


		} else {
			$_selectedAddress = 0;
			$this->lists['shipTo'] = '';
		}

		$this->lists['billTo'] = empty($addressList[0]->retinashop_userinfo_id)? 0 : $addressList[0]->retinashop_userinfo_id;

	}
	/**
	 * moved to shopfunctionf
	 * @deprecated
	 */
	function prepareMailData(){

		if(empty($this->vendor)) $this->prepareVendor();
		//TODO add orders, for the orderId
		//TODO add registering userdata
		// In general we need for every mail the shopperdata (with group), the vendor data, shopperemail, shopperusername, and so on
	}
/**
	 * moved to shopfunctionf
	 * @deprecated
	 */
	// add vendor for cart
	function prepareVendor(){

		$vendorModel = rsModel::getModel('vendor');
		$this->vendor = & $vendorModel->getVendor();
		$vendorModel->addImages($this->vendor,1);
		return $this->vendor;
	}

	// Render the code for Ajax Cart
	function prepareAjaxData(){
		// Added for the zone shipment module
		//$vars["zone_qty"] = 0;
		$this->prepareCartData(false);
		$weight_total = 0;
		$weight_subtotal = 0;

		//of course, some may argue that the $this->data->products should be generated in the view.html.php, but
		//
		$this->data->products = array();
		$this->data->totalProduct = 0;
		$i=0;
		//OSP when prices removed needed to format billTotal for AJAX
		if (!class_exists('CurrencyDisplay'))
			require(RPATH_rs_admin . DS . 'helpers' . DS . 'currencydisplay.php');
		$currency = CurrencyDisplay::getInstance();

		foreach ($this->products as $priceKey=>$product){

			//$vars["zone_qty"] += $product["quantity"];
			$category_id = $this->getCardCategoryId($product->retinashop_product_id);
			//Create product URL
			$url = JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$product->retinashop_product_id.'&retinashop_category_id='.$category_id);

			// @todo Add variants
			$this->data->products[$i]['product_name'] = JHTML::link($url, $product->product_name);

			// Add the variants
			if (!is_numeric($priceKey)) {
				if(!class_exists('retinashopModelCustomfields'))require(RPATH_rs_admin.DS.'models'.DS.'customfields.php');
				//  custom product fields display for cart
				$this->data->products[$i]['product_attributes'] = retinashopModelCustomfields::CustomsFieldCartModDisplay($priceKey,$product);

			}
			$this->data->products[$i]['product_sku'] = $product->product_sku;

			//** @todo WEIGHT CALCULATION
			//$weight_subtotal = rsShipmentMethod::get_weight($product["retinashop_product_id"]) * $product->quantity'];
			//$weight_total += $weight_subtotal;


			// product Price total for ajax cart
// 			$this->data->products[$i]['prices'] = $this->prices[$priceKey]['subtotal_with_tax'];
			$this->data->products[$i]['pricesUnformatted'] = $this->pricesUnformatted[$priceKey]['subtotal_with_tax'];
			$this->data->products[$i]['prices'] = $currency->priceDisplay( $this->pricesUnformatted[$priceKey]['subtotal_with_tax'] );

			// other possible option to use for display
			$this->data->products[$i]['subtotal'] = $this->pricesUnformatted[$priceKey]['subtotal'];
			$this->data->products[$i]['subtotal_tax_amount'] = $this->pricesUnformatted[$priceKey]['subtotal_tax_amount'];
			$this->data->products[$i]['subtotal_discount'] = $this->pricesUnformatted[$priceKey]['subtotal_discount'];
			$this->data->products[$i]['subtotal_with_tax'] = $this->pricesUnformatted[$priceKey]['subtotal_with_tax'];

			// UPDATE CART / DELETE FROM CART
			$this->data->products[$i]['quantity'] = $product->quantity;
			$this->data->totalProduct += $product->quantity ;

			$i++;
		}
		$this->data->billTotal = $currency->priceDisplay( $this->pricesUnformatted['billTotal'] );
		$this->data->dataValidated = $this->_dataValidated ;
		return $this->data ;
	}
}
