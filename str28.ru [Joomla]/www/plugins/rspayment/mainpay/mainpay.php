<?php

#####################################################################################################
#
#					Module pour la plateforme de paiement mainpay
#						Version : 1.2 (révision 33398)
#									########################
#					Développé pour retinashop
#						Version : 2.0.0
#						Compatibilité plateforme : V2
#									########################
#					Développé par Lyra Network
#						http://www.lyra-network.com/
#						20/02/2012
#						Contact : supportvad@lyra-network.com
#
#####################################################################################################

defined('_REXEC') or die('Direct Access to ' . basename(__FILE__) . ' is not allowed.');

if (!class_exists('rsPSPlugin'))
    require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');
if (Jrs_VERSION === 2) {
    define('RPATH_rsPAYMENTPLUGIN_PAYZEN', RPATH_ROOT . DS . 'plugins' . DS . 'rspayment' . DS . 'payzen');
} else {
    define('RPATH_rsPAYMENTPLUGIN_PAYZEN', RPATH_ROOT . DS . 'plugins' . DS . 'rspayment');
}
if (!class_exists('plgrsPaymentPayzen'))
    require(RPATH_rsPAYMENTPLUGIN_PAYZEN . DS . 'payzen.php');
class plgrsPaymentmainpay extends plgrsPaymentPayzen {

    // instance of class
    public static $_this = false;

    function __construct(& $subject, $config) {
	//if (self::$_this)
	//   return self::$_this;
	parent::__construct($subject, $config);

    }

function getTableSQLFields() {



	$SQLfields = array(
	    'id' => 'int(11) UNSIGNED NOT NULL AUTO_INCREMENT',
	    'retinashop_order_id' => 'int(1) UNSIGNED',
	    'order_number' => ' char(64)',
	    'retinashop_paymentmethod_id' => 'mediumint(1) UNSIGNED',
	    'payment_name' => 'varchar(5000)',
	    'payment_order_total' => 'decimal(15,5) NOT NULL DEFAULT \'0.00000\'',
	    'payment_currency' => 'char(3)',
	    'cost_per_transaction' => 'decimal(10,2)',
	    'cost_percent_total' => 'decimal(10,2)',
	    'tax_id' => 'smallint(1)',
	    'mainpay_custom' => 'varchar(255)',
	    'mainpay_response_payment_amount' => 'char(15)',
	    'mainpay_response_auth_number' => 'char(10)',
	    'mainpay_response_payment_currency' => 'char(3)',
	    'mainpay_response_auth_number' => 'char(10)',
	    'mainpay_response_payment_mean' => 'char(255)',
	    'mainpay_response_payment_date' => 'char(20)',
	    'mainpay_response_payment_status' => 'char(3)',
	    'mainpay_response_payment_message' => 'char(255)',
	    'mainpay_response_card_number' => 'char(50)',
	    'mainpay_response_trans_id' => 'char(6)',
	    'mainpay_response_expiry_month' => 'char(2)',
	    'mainpay_response_expiry_year' => 'char(4)',
	);

	return $SQLfields;
    }
    /**
     * Prepare data and redirect to mainpay payment platform
     * @param string $order_number
     * @param object $orderData
     * @param string $return_context the session id
     * @param string $html the form to display
     * @param bool $new_status false if it should not be changed, otherwise new staus
     * @return NULL
     */
    function plgrsConfirmedOrder($cart, $order) {

	return parent::plgrsConfirmedOrder($cart, $order);
    }

    /**
     * Check mainpay response, save order if not done by server call and redirect to response page
     *  when client comes back from payment platform.
     * @param int $retinashop_order_id retinashop order primary key concerned by payment
     * @param string $html message to show as result
     * @return
     */
    function plgrsOnPaymentResponseReceived(&$html) {
	return parent::plgrsOnPaymentResponseReceived($html);
    }

    /**
     * Process a mainpay payment cancellation.
     * @param int $retinashop_order_id retinashop order primary key concerned by payment
     * @return
     */
    function plgrsOnPaymentUserCancel(&$retinashop_order_id) {
	return parent::plgrsOnPaymentUserCancel($retinashop_order_id);
    }

    /**
     * Check mainpay response, save order and empty cart (if payment success) when server notification is received from payment platform.
     * @param string $return_context session id
     * @param int $retinashop_order_id retinashop order primary key concerned by payment
     * @param string $new_status new order status
     * @return
     */
    function plgrsOnPaymentNotification() {
	return parent::plgrsOnPaymentNotification();
    }

    /**
     * Display stored payment data for an order
     * @see components/com_retinashop/helpers/rsPaymentPlugin::plgrsOnShowOrderPaymentBE()
     */
    function plgrsOnShowOrderBEPayment($retinashop_order_id, $payment_method_id) {
	return parent::plgrsOnShowOrderBEPayment($retinashop_order_id, $payment_method_id);
    }

    /**
     * We must reimplement this triggers for retina 1.7
     */

    /**
     * Create the table for this plugin if it does not yet exist.
     * This functions checks if the called plugin is active one.
     * When yes it is calling the standard method to create the tables
     * @author Valérie Isaksen
     *
     */
    function plgrsOnStoreInstallPaymentPluginTable($jplugin_id) {

	return parent::onStoreInstallPluginTable($jplugin_id);
    }

    /**
     * This event is fired after the payment method has been selected. It can be used to store
     * additional payment info in the cart.
     *
     * @author Max Milbers
     * @author Valérie isaksen
     *
     * @param retinashopCart $cart: the actual cart
     * @return null if the payment was not selected, true if the data is valid, error message if the data is not vlaid
     *
     */
    public function plgrsOnSelectCheckPayment(retinashopCart $cart) {
	return parent::OnSelectCheck($cart);
    }

    /**
     * plgrsDisplayListFEPayment
     * This event is fired to display the pluginmethods in the cart (edit shipment/payment) for exampel
     *
     * @param object $cart Cart object
     * @param integer $selected ID of the method selected
     * @return boolean True on succes, false on failures, null when this plugin was not selected.
     * On errors, JError::raiseWarning (or JError::raiseError) must be used to set a message.
     *
     * @author Valerie Isaksen
     * @author Max Milbers
     */
    public function plgrsDisplayListFEPayment(retinashopCart $cart, $selected = 0, &$htmlIn) {
	return parent::displayListFE($cart, $selected, $htmlIn);
    }

    /*
     * plgrsonSelectedCalculatePricePayment
     * Calculate the price (value, tax_id) of the selected method
     * It is called by the calculator
     * This function does NOT to be reimplemented. If not reimplemented, then the default values from this function are taken.
     * @author Valerie Isaksen
     * @cart: retinashopCart the current cart
     * @cart_prices: array the new cart prices
     * @return null if the method was not selected, false if the shiiping rate is not valid any more, true otherwise
     *
     *
     */

    public function plgrsonSelectedCalculatePricePayment(retinashopCart $cart, array &$cart_prices, &$cart_prices_name) {
	return parent::onSelectedCalculatePrice($cart, $cart_prices, $cart_prices_name);
    }

    /**
     * plgrsOnCheckAutomaticSelectedPayment
     * Checks how many plugins are available. If only one, the user will not have the choice. Enter edit_xxx page
     * The plugin must check first if it is the correct type
     * @author Valerie Isaksen
     * @param retinashopCart cart: the cart object
     * @return null if no plugin was found, 0 if more then one plugin was found,  retinashop_xxx_id if only one plugin is found
     *
     */
    function plgrsOnCheckAutomaticSelectedPayment(retinashopCart $cart, array $cart_prices = array(),   &$paymentCounter) {
	return parent::onCheckAutomaticSelected($cart, $cart_prices, $paymentCounter);
    }

    /**
     * This method is fired when showing the order details in the frontend.
     * It displays the method-specific data.
     *
     * @param integer $order_id The order ID
     * @return mixed Null for methods that aren't active, text (HTML) otherwise
     * @author Max Milbers
     * @author Valerie Isaksen
     */
    public function plgrsOnShowOrderFEPayment($retinashop_order_id, $retinashop_paymentmethod_id, &$payment_name) {
	parent::onShowOrderFE($retinashop_order_id, $retinashop_paymentmethod_id, $payment_name);
    }

    /**
     * This event is fired during the checkout process. It can be used to validate the
     * method data as entered by the user.
     *
     * @return boolean True when the data was valid, false otherwise. If the plugin is not activated, it should return null.
     * @author Max Milbers

      public function plgrsOnCheckoutCheckDataPayment($psType, retinashopCart $cart) {
      return null;
      }
     */

    /**
     * This method is fired when showing when priting an Order
     * It displays the the payment method-specific data.
     *
     * @param integer $_retinashop_order_id The order ID
     * @param integer $method_id  method used for this order
     * @return mixed Null when for payment methods that were not selected, text (HTML) otherwise
     * @author Valerie Isaksen
     */
    function plgrsonShowOrderPrintPayment($order_number, $method_id) {
	return parent::onShowOrderPrint($order_number, $method_id);
    }

    /**
     * Save updated order data to the method specific table
     *
     * @param array $_formData Form data
     * @return mixed, True on success, false on failures (the rest of the save-process will be
     * skipped!), or null when this method is not actived.
     * @author Oscar van Eijk

      public function plgrsOnUpdateOrderPayment(  $_formData) {
      return null;
      }
     */
    /**
     * Save updated orderline data to the method specific table
     *
     * @param array $_formData Form data
     * @return mixed, True on success, false on failures (the rest of the save-process will be
     * skipped!), or null when this method is not actived.
     * @author Oscar van Eijk

      public function plgrsOnUpdateOrderLine(  $_formData) {
      return null;
      }
     */
    /**
     * plgrsOnEditOrderLineBE
     * This method is fired when editing the order line details in the backend.
     * It can be used to add line specific package codes
     *
     * @param integer $_orderId The order ID
     * @param integer $_lineId
     * @return mixed Null for method that aren't active, text (HTML) otherwise
     * @author Oscar van Eijk

      public function plgrsOnEditOrderLineBE(  $_orderId, $_lineId) {
      return null;
      }
     */

    /**
     * This method is fired when showing the order details in the frontend, for every orderline.
     * It can be used to display line specific package codes, e.g. with a link to external tracking and
     * tracing mains
     *
     * @param integer $_orderId The order ID
     * @param integer $_lineId
     * @return mixed Null for method that aren't active, text (HTML) otherwise
     * @author Oscar van Eijk

      public function plgrsOnShowOrderLineFE(  $_orderId, $_lineId) {
      return null;
      }
     */
    function plgrsDeclarePluginParamsPayment($name, $id, &$data) {
	return parent::declarePluginParams('payment', $name, $id, $data);
    }

    function plgrsSetOnTablePluginParamsPayment($name, $id, &$table) {
	return $this->setOnTablePluginParams($name, $id, $table);
    }

}

// No closing tag