<?php

/**
 *
 * Controller for the Payement Response
 *
 * @package	Magazin
 * @subpackage paymentResponse
 * @author Valérie Isaksen
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 3388 2011-05-27 13:50:18Z alatak $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the controller framework
jimport('retina.application.component.controller');

/**
 * Controller for the payment response view
 *
 * @package retinashop
 * @subpackage paymentResponse
 * @author Valérie Isaksen
 *
 */
class retinashopControllerPluginresponse extends JController {

    /**
     * Construct the cart
     *
     * @access public
     */
    public function __construct() {
	parent::__construct();
    }

    /**
     * ResponseReceived()
     * From the plugin page, the user returns to the shop. The order email is sent, and the cart emptied.
     *
     * @author Valerie Isaksen
     *
     */
    function pluginResponseReceived() {

	$this->PaymentResponseReceived();
	$this->ShipmentResponseReceived();
    }

    /**
     * ResponseReceived()
     * From the payment page, the user returns to the shop. The order email is sent, and the cart emptied.
     *
     * @author Valerie Isaksen
     *
     */
    function PaymentResponseReceived() {

	if (!class_exists('rsPSPlugin'))
	    require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php'); JPluginHelper::importPlugin('rspayment');

	$return_context = "";
	$dispatcher = JDispatcher::getInstance();
	$html = "";
	$paymentResponse = Jtext::_('COM_RETINASHOP_CART_THANKYOU');
	$returnValues = $dispatcher->trigger('plgrsOnPaymentResponseReceived', array( 'html' => &$html,&$paymentResponse));

// 	JRequest::setVar('paymentResponse', Jtext::_('COM_RETINASHOP_CART_THANKYOU'));
// 	JRequest::setVar('paymentResponseHtml', $html);
	$view = $this->getView('pluginresponse', 'html');
	$layoutName = JRequest::getVar('layout', 'default');
	$view->setLayout($layoutName);

	$view->assignRef('paymentResponse', $paymentResponse);
   $view->assignRef('paymentResponseHtml', $html);

	// Display it all
	$view->display();
    }

    function ShipmentResponseReceived() {

    }

    /**
     * PaymentUserCancel()
     * From the payment page, the user has cancelled the order. The order previousy created is deleted.
     * The cart is not emptied, so the user can reorder if necessary.
     * then delete the order
     * @author Valerie Isaksen
     *
     */
    function pluginUserPaymentCancel() {

	if (!class_exists('rsPSPlugin'))
	    require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');

	if (!class_exists('retinashopCart'))
	    require(RPATH_rs_SITE . DS . 'helpers' . DS . 'cart.php');

	JPluginHelper::importPlugin('rspayment');
	$dispatcher = JDispatcher::getInstance();
	$returnValues = $dispatcher->trigger('plgrsOnUserPaymentCancel', array());

	// return to cart view
	$view = $this->getView('cart', 'html');
	$layoutName = JRequest::getWord('layout', 'default');
	$view->setLayout($layoutName);

	// Display it all
	$view->display();
    }

    /**
     * Attention this is the function which processs the response of the payment plugin
     *
     * @author Valerie Isaksen
     * @return success of update
     */
    function pluginNotification() {

	if (!class_exists('rsPSPlugin'))
	    require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');

	if (!class_exists('retinashopCart'))
	    require(RPATH_rs_SITE . DS . 'helpers' . DS . 'cart.php');

	if (!class_exists('retinashopModelOrders'))
	    require( RPATH_rs_admin . DS . 'models' . DS . 'orders.php' );

	JPluginHelper::importPlugin('rspayment');

	$dispatcher = JDispatcher::getInstance();
	$returnValues = $dispatcher->trigger('plgrsOnPaymentNotification', array());

    }

}

//pure php no Tag
