<?php

/**
 *
 * List/add/edit/remove Users
 *
 * @package	Magazin
 * @subpackage User
 * @author Oscar van Eijk
 * @author Max Milbers
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 5566 2012-02-27 15:06:48Z Milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if (!class_exists('rsView'))
    require(RPATH_rs_SITE . DS . 'helpers' . DS . 'rsview.php');

// Set to '0' to use tabs i.s.o. sliders
// Might be a config option later on, now just here for testing.
define('__rs_USER_USE_SLIDERS', 0);

/**
 * HTML View class for maintaining the list of users
 *
 * @package	Magazin
 * @subpackage User
 * @author Oscar van Eijk
 * @author Max Milbers
 */
class retinashopViewUser extends rsView {

    private $_model;
    private $_currentUser = 0;
    private $_cuid = 0;
    private $_userDetails = 0;
    private $_userFieldsModel = 0;
    private $_userInfoID = 0;
    private $_list = 0;
    private $_orderList = 0;
    private $_openTab = 0;

    /**
     * Displays the view, collects needed data for the different layouts
     *
     * Okey I try now a completly new idea.
     * We make a function for every tab and the display is getting the right tabs by an own function
     * putting that in an array and after that we call the preparedataforlayoutBlub
     *
     * @author Oscar van Eijk
     * @author Max Milbers
     */
    function display($tpl = null) {

	$useSSL = rsConfig::get('useSSL', 0);
	$useXHTML = true;
	$this->assignRef('useSSL', $useSSL);
	$this->assignRef('useXHTML', $useXHTML);
	$document = JFactory::getDocument();
	$mainframe = JFactory::getApplication();
	$pathway = $mainframe->getPathway();
	$layoutName = $this->getLayout();
	// 	rsdebug('layout by view '.$layoutName);
	if (empty($layoutName) or $layoutName == 'default') {
	    $layoutName = JRequest::getWord('layout', 'edit');
	    $this->setLayout($layoutName);
	    // 	    rsdebug('layout by post '.$layoutName);
	}

	if (empty($this->fTask)) {
	    $ftask = 'saveUser';
	    $this->assignRef('fTask', $ftask);
	}


	if (!class_exists('ShopFunctions'))
	    require(RPATH_rs_admin . DS . 'helpers' . DS . 'shopfunctions.php');

	// 	rsdebug('my layoutname',$layoutName);
	if ($layoutName == 'login') {
	    // 		$true = true;
	    // 		$this->assignRef('anonymous',$true);
	    parent::display($tpl);
	    return;
	}

	if (!class_exists('retinashopModelUser'))
	    require(RPATH_rs_admin . DS . 'models' . DS . 'user.php');
	$this->_model = new retinashopModelUser();

	//$this->_model = rsModel::getModel('user', 'retinashopModel');
	//		$this->_model->setCurrent(); //without this, the admin can edit users in the FE, permission is handled in the usermodel, but maybe unsecure?
	$editor = JFactory::getEditor();

	//the cuid is the id of the current user
	$this->_currentUser = JFactory::getUser();
	$this->_cuid = $this->_lists['current_id'] = $this->_currentUser->get('id');
	$this->assignRef('userId', $this->_cuid);

	if (empty($this->_cuid)) {
	    // 		$layout = 'default';
	    // 		$this->setLayout('default');
	}

	$this->_userDetails = $this->_model->getUser();

	$this->assignRef('userDetails', $this->_userDetails);

	$address_type = JRequest::getWord('addrtype', 'BT');
	$this->assignRef('address_type', $address_type);

	$new = false;
	if (JRequest::getInt('new', '0') === 1) {
	    $new = true;
	}


	if ($new) {
	    $retinashop_userinfo_id = 0;
	} else {
	    $retinashop_userinfo_id = JRequest::getString('retinashop_userinfo_id', '0', '');
	}

	$this->assignRef('retinashop_userinfo_id', $retinashop_userinfo_id);

	$userFields = null;
	if ((strpos($this->fTask, 'cart') || strpos($this->fTask, 'checkout')) && empty($retinashop_userinfo_id)) {

	    //New Address is filled here with the data of the cart (we are in the cart)
	    if (!class_exists('retinashopCart'))
		require(RPATH_rs_SITE . DS . 'helpers' . DS . 'cart.php');
	    $cart = retinashopCart::getCart();

	    $fieldtype = $address_type . 'address';
	    $cart->prepareAddressDataInCart($address_type, $new);

	    $userFields = $cart->$fieldtype;

	    $task = JRequest::getWord('task', '');
	} else {
	    $userFields = $this->_model->getUserInfoInUserFields($layoutName, $address_type, $retinashop_userinfo_id);
	    if (!$new && empty($userFields[$retinashop_userinfo_id])) {
		$retinashop_userinfo_id = $this->_model->getBTuserinfo_id();
		rsdebug('Try to get $retinashop_userinfo_id by type BT', $retinashop_userinfo_id);
	    }
	    $userFields = $userFields[$retinashop_userinfo_id];
	    $task = 'editAddressSt';
	}

	$this->assignRef('userFields', $userFields);

	if ($layoutName == 'edit') {

	    if ($this->_model->getId() == 0 && $this->_cuid == 0) {
		$button_lbl = RText::_('COM_RETINASHOP_REGISTER');
	    } else {
		$button_lbl = RText::_('COM_RETINASHOP_SAVE');
	    }

	    $this->assignRef('button_lbl', $button_lbl);
	    $this->lUser();
	    $this->shopper($userFields);

	    $this->payment();
	    $this->lOrderlist();
	    $this->lVendor();
	}


	$this->_lists['shipTo'] = ShopFunctions::generateStAddressList($this->_model, $task);


	if ($this->_openTab < 0) {
	    $_paneOffset = array();
	} else {
	    if (__rs_USER_USE_SLIDERS) {
		$_paneOffset = array('startOffset' => $this->_openTab, 'startTransition' => 1, 'allowAllClose' => true);
	    } else {
		$_paneOffset = array('startOffset' => $this->_openTab);
	    }
	}

	// Implement the retina panels. If we need a ShipTo tab, make it the active one.
	// In tmpl/edit.php, this is the 4th tab (0-based, so set to 3 above)
	jimport('retina.html.pane');
	$pane = JPane::getInstance((__rs_USER_USE_SLIDERS ? 'Sliders' : 'Tabs'), $_paneOffset);

	$this->assignRef('lists', $this->_lists);

	$this->assignRef('editor', $editor);
	$this->assignRef('pane', $pane);

	if ($layoutName == 'mailregisteruser') {
	    $vendorModel = rsModel::getModel('vendor');
	    //			$vendorModel->setId($this->_userDetails->retinashop_vendor_id);
	    $vendor = $vendorModel->getVendor();
	    $this->assignRef('vendor', $vendor);
	}
	if ($layoutName == 'editaddress') {
	    $layoutName = 'edit_address';
	    $this->setLayout($layoutName);
	}

	if (!$this->userDetails->JUser->get('id')) {
	    $corefield_title = RText::_('COM_RETINASHOP_USER_CART_INFO_CREATE_ACCOUNT');
	} else {
	    $corefield_title = RText::_('COM_RETINASHOP_YOUR_ACCOUNT_DETAILS');
	}
	if ((strpos($this->fTask, 'cart') || strpos($this->fTask, 'checkout'))) {
	    $pathway->addelement(RText::_('COM_RETINASHOP_CART_OVERVIEW'), JRoute::_('index.php?option=com_retinashop&view=cart'));
	} else {
	    //$pathway->addelement(RText::_('COM_RETINASHOP_YOUR_ACCOUNT_DETAILS'), JRoute::_('index.php?option=com_retinashop&view=user&&layout=edit'));
	}
	$pathway_text = RText::_('COM_RETINASHOP_YOUR_ACCOUNT_DETAILS');
	if (!$this->userDetails->JUser->get('id')) {
	    if ((strpos($this->fTask, 'cart') || strpos($this->fTask, 'checkout'))) {
		if ($address_type == 'BT') {
		    $rsfield_title = RText::_('COM_RETINASHOP_USER_FORM_EDIT_BILLTO_LBL');
		} else {
		    $rsfield_title = RText::_('COM_RETINASHOP_USER_FORM_ADD_SHIPTO_LBL');
		}
	    } else {
		if ($address_type == 'BT') {
		    $rsfield_title = RText::_('COM_RETINASHOP_USER_FORM_EDIT_BILLTO_LBL');
		    $title = RText::_('COM_RETINASHOP_REGISTER');
		} else {
		    $rsfield_title = RText::_('COM_RETINASHOP_USER_FORM_ADD_SHIPTO_LBL');
		}
	    }
	} else {

	    if ($address_type == 'BT') {
		$rsfield_title = RText::_('COM_RETINASHOP_USER_FORM_BILLTO_INFORMATION');
	    } else {

		$rsfield_title = RText::_('COM_RETINASHOP_USER_FORM_ADD_SHIPTO_LBL');
	    }
	}

	$document->setTitle($pathway_text);
	$pathway->addelement($pathway_text);
	$this->assignRef('page_title', $pathway_text);
	$this->assignRef('corefield_title', $corefield_title);
	$this->assignRef('rsfield_title', $rsfield_title);
	shopFunctionsF::setrsTemplate($this, 0, 0, $layoutName);

	parent::display($tpl);
    }

    function payment() {

    }

    function lOrderlist() {
	// Check for existing orders for this user
	$orders = rsModel::getModel('orders');

	if ($this->_model->getId() == 0) {
	    // getOrdersList() returns all orders when no userID is set (admin function),
	    // so explicetly define an empty array when not logged in.
	    $this->_orderList = array();
	} else {
	    $this->_orderList = $orders->getOrdersList($this->_model->getId(), true);

	    if (empty($this->currency)) {
		if (!class_exists('CurrencyDisplay'))
		    require(RPATH_rs_admin . DS . 'helpers' . DS . 'currencydisplay.php');

		$currency = CurrencyDisplay::getInstance();
		$this->assignRef('currency', $currency);
	    }
	}
	$this->assignRef('orderlist', $this->_orderList);
    }

    function shopper($userFields) {

	$this->loadHelper('permissions');
	$this->loadHelper('shoppergroup');

	// Shopper info
	if (!class_exists('retinashopModelShopperGroup'))
	    require(RPATH_rs_admin . DS . 'models' . DS . 'shoppergroup.php');

	$_shoppergroup = retinashopModelShopperGroup::getShoppergroupById($this->_model->getId());

	if (!class_exists('Permissions'))
	    require(RPATH_rs_admin . DS . 'helpers' . DS . 'permissions.php');

	if (Permissions::getInstance()->check('admin,storeadmin')) {
	    $this->_lists['shoppergroups'] = ShopFunctions::renderShopperGroupList($_shoppergroup['retinashop_shoppergroup_id']);
	    $this->_lists['vendors'] = ShopFunctions::renderVendorList($this->_userDetails->retinashop_vendor_id);
	} else {
	    $this->_lists['shoppergroups'] = $_shoppergroup['shopper_group_name'];

	    //I dont think that makes sense anymore
	    // 			if(empty($this->_lists['shoppergroups'])){
	    // 				$this->_lists['shoppergroups']='unregistered';
	    // 			} else {
	    $this->_lists['shoppergroups'] .= '<input type="hidden" name="retinashop_shoppergroup_id" value = "' . $_shoppergroup['retinashop_shoppergroup_id'] . '" />';
	    // 			}

	    if (!empty($this->_userDetails->retinashop_vendor_id)) {
		$this->_lists['vendors'] = $this->_userDetails->retinashop_vendor_id;
	    }

	    if (empty($this->_lists['vendors'])) {
		$this->_lists['vendors'] = RText::_('COM_RETINASHOP_USER_NOT_A_VENDOR'); // . $_setVendor;
	    }
	}

	//todo here is something broken we use $_userDetailsList->perms and $this->_userDetailsList->perms and perms seems not longer to exist
	if (Permissions::getInstance()->check("admin,storeadmin")) {
	    $this->_lists['perms'] = JHTML::_('select.genericlist', Permissions::getUserGroups(), 'perms', '', 'group_name', 'group_name', $this->_userDetails->perms);
	} else {
	    if (!empty($this->_userDetails->perms)) {
		$this->_lists['perms'] = $this->_userDetails->perms;

		/* This now done in the model, so it is unnecessary here, notice by Max Milbers
		  if(empty($this->_lists['perms'])){
		  $this->_lists['perms'] = 'shopper'; // TODO Make this default configurable
		  }
		 */
		$_hiddenInfo = '<input type="hidden" name="perms" value = "' . $this->_lists['perms'] . '" />';
		$this->_lists['perms'] .= $_hiddenInfo;
	    }
	}

	// Load the required scripts
	if (count($userFields['scripts']) > 0) {
	    foreach ($userFields['scripts'] as $_script => $_path) {
		JHTML::script($_script, $_path);
	    }
	}
	// Load the required styresheets
	if (count($userFields['links']) > 0) {
	    foreach ($userFields['links'] as $_link => $_path) {
		JHTML::stylesheet($_link, $_path);
	    }
	}
    }

    function lUser() {

	$_groupList = $this->_model->getGroupList();

	if (!is_array($_groupList)) {
	    $this->_lists['gid'] = '<input type="hidden" name="gid" value="' . $this->_userDetails->JUser->get('gid') . '" /><strong>' . RText::_($_groupList) . '</strong>';
	} else {
	    $this->_lists['gid'] = JHTML::_('select.genericlist', $_groupList, 'gid', 'size="10"', 'value', 'text', $this->_userDetails->JUser->get('gid'));
	}

	if (!class_exists('shopFunctionsF'))
	    require(RPATH_rs_SITE . DS . 'helpers' . DS . 'shopfunctionsf.php');
	$comUserOption = shopfunctionsF::getComUserOption();

	$this->_lists['canBlock'] = ($this->_currentUser->authorize($comUserOption, 'block user')
		&& ($this->_model->getId() != $this->_cuid)); // Can't block myself TODO I broke that, please retest if it is working again
	$this->_lists['canSetMailopt'] = $this->_currentUser->authorize('workflow', 'email_events');
	$this->_lists['block'] = JHTML::_('select.booleanlist', 'block', 'class="inputbox"', $this->_userDetails->JUser->get('block'), 'COM_RETINASHOP_YES', 'COM_RETINASHOP_NO');
	$this->_lists['sendEmail'] = JHTML::_('select.booleanlist', 'sendEmail', 'class="inputbox"', $this->_userDetails->JUser->get('sendEmail'), 'COM_RETINASHOP_YES', 'COM_RETINASHOP_NO');

	$this->_lists['params'] = $this->_userDetails->JUser->getParameters(true);

	$this->_lists['custnumber'] = $this->_model->getCustomerNumberById($this->_model->getId());

	//TODO I do not understand for what we have that by Max.
	if ($this->_model->getId() < 1) {
	    $this->_lists['register_new'] = 1;
	} else {
	    $this->_lists['register_new'] = 0;
	}
    }

    function lVendor() {

	// If the current user is a vendor, load the store data
	if ($this->_userDetails->user_is_vendor) {

	    $currencymodel = rsModel::getModel('currency', 'retinashopModel');
	    $currencies = $currencymodel->getCurrencies();
	    $this->assignRef('currencies', $currencies);

	    if (!$this->_orderList) {
		$this->lOrderlist();
	    }

	    $vendorModel = rsModel::getModel('vendor');

	    if (rsconfig::get('multix', 'none') === 'none') {
		$vendorModel->setId(1);
	    } else {
		$vendorModel->setId($this->_userDetails->retinashop_vendor_id);
	    }
	    $vendor = $vendorModel->getVendor();
	    $vendorModel->addImages($vendor);
	    $this->assignRef('vendor', $vendor);
	}
    }

    /*
     * renderMailLayout
     *
     * @author Max Milbers
     * @author Valerie Isaksen
     */

    public function renderMailLayout($vendor=false) {

	$useSSL = rsConfig::get('useSSL', 0);
	$useXHTML = true;
	$this->assignRef('useSSL', $useSSL);
	$this->assignRef('useXHTML', $useXHTML);
	$userFieldsModel = rsModel::getModel('UserFields');
	$userFields = $userFieldsModel->getUserFields();
	$this->userFields = $userFieldsModel->getUserFieldsFilled($userFields, $this->user);
	$vendorModel = rsModel::getModel('vendor');
	$this->vendor = $vendorModel->getVendor();
	if (rsConfig::get('order_mail_html')) {
	    $mailFormat = 'html';
	} else {
	    $mailFormat = 'raw';
	}
	if (!$vendor) {
	    $this->subject = RText::sprintf('COM_RETINASHOP_NEW_SHOPPER_SUBJECT', $this->user->username, $this->vendor->vendor_store_name);
	    $tpl = 'mail_' . $mailFormat . '_reguser';
	} else {
	    $this->subject = RText::sprintf('COM_RETINASHOP_VENDOR_NEW_SHOPPER_SUBJECT', $this->user->username, $this->vendor->vendor_store_name);
	    $tpl = 'mail_' . $mailFormat . '_regvendor';
	}

	$this->assignRef('recipient', $recipient);
	$this->vendorEmail = $vendorModel->getVendorEmail($this->vendor->retinashop_vendor_id);
	$this->layoutName = $tpl;
	$this->setLayout($tpl);
	parent::display();
    }

}

//No Closing Tag
