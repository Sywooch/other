<?php

/**
 *
 * List/add/edit/remove Vendors
 *
 * @package	Magazin
 * @subpackage User
 * @author Max Milbers
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 5133 2011-12-19 12:02:41Z Milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

// Set to '0' to use tabs i.s.o. sliders
// Might be a config option later on, now just here for testing.
define('__rs_USER_USE_SLIDERS', 0);

/**
 * HTML View class for maintaining the list of users
 *
 * @package	Magazin
 * @subpackage Vendor
 * @author Max Milbers
 */
class retinashopViewVendor extends rsView {

	/**
	 * Displays the view, collects needed data for the different layouts
	 *
	 * Okey I try now a completly new idea.
	 * We make a function for every tab and the display is getting the right tabs by an own function
	 * putting that in an array and after that we call the preparedataforlayoutBlub
	 *
	 * @author Max Milbers
	 */
	function display($tpl = null) {

		$document = JFactory::getDocument();
		$mainframe = JFactory::getApplication();
		$pathway = $mainframe->getPathway();
		$layoutName = $this->getLayout();

		$model = rsModel::getModel();

		$retinashop_vendor_id = JRequest::getInt('retinashop_vendor_id');

// 		if ($layoutName=='default') {
		if (empty($retinashop_vendor_id)) {
			$document->setTitle( RText::_('COM_RETINASHOP_VENDOR_LIST') );
			$pathway->addelement(RText::_('COM_RETINASHOP_VENDOR_LIST'));

			$vendors = $model->getVendors();
			$model->addImages($vendors);

			$this->assignRef('vendors', $vendors);

		} else {

			$vendor = $model->getVendor($retinashop_vendor_id);
			$model->addImages($vendor);

			$this->assignRef('vendor', $vendor);

			$userId = $model->getUserIdByVendorId($retinashop_vendor_id);

			$usermodel = rsModel::getModel('user');

			$retinashop_userinfo_id = $usermodel->getBTuserinfo_id($userId);
			$userFields = $usermodel->getUserInfoInUserFields($layoutName, 'BT', $retinashop_userinfo_id,true,true);
			$this->assignRef('userFields', $userFields);

			if ($layoutName=='tos') {
				$document->setTitle( RText::_('COM_RETINASHOP_VENDOR_TOS') );
				$pathway->addelement(RText::_('COM_RETINASHOP_VENDOR_TOS'));
			}
			elseif ($layoutName=='contact') {
				$user = JFactory::getUser();
				$document->setTitle( RText::_('COM_RETINASHOP_VENDOR_CONTACT') );
				$pathway->addelement(RText::_('COM_RETINASHOP_VENDOR_CONTACT'));
				$this->assignRef('user', $user);

			} else {
				$document->setTitle( RText::_('COM_RETINASHOP_VENDOR_DETAILS') );
				$pathway->addelement(RText::_('COM_RETINASHOP_VENDOR_DETAILS'));
				$this->setLayout('details');
			}

			$linkdetails = '<a href="'.JRoute::_('index.php?option=com_retinashop&view=vendor&retinashop_vendor_id=' . $this->vendor->retinashop_vendor_id).'">'.RText::_('COM_RETINASHOP_VENDOR_DETAILS').'</a>';
			$linkcontact = '<a href="'.JRoute::_('index.php?option=com_retinashop&view=vendor&layout=contact&retinashop_vendor_id=' . $this->vendor->retinashop_vendor_id).'">'.RText::_('COM_RETINASHOP_VENDOR_CONTACT').'</a>';
			$linktos = '<a href="'.JRoute::_('index.php?option=com_retinashop&view=vendor&layout=tos&retinashop_vendor_id=' . $this->vendor->retinashop_vendor_id).'">'.RText::_('COM_RETINASHOP_VENDOR_TOS').'</a>';

			$this->assignRef('linkdetails', $linkdetails);
			$this->assignRef('linkcontact', $linkcontact);
			$this->assignRef('linktos', $linktos);
		}

		parent::display($tpl);

	}


	function renderMailLayout() {
		$this->setLayout('mail_html_question');
		$this->comment = JRequest::getString('comment');
		$retinashop_vendor_id = JRequest::getInt('retinashop_vendor_id');

		$vendorModel = rsModel::getModel('vendor');
		$this->vendor = $vendorModel->getVendor($retinashop_vendor_id);

		$this->subject = RText::_('COM_RETINASHOP_VENDOR_CONTACT') .' '.$this->user['name'];
		$this->vendorEmail= $this->user['email'];
		//$this->vendorName= $this->user['email'];
		if (rsConfig::get('order_mail_html')) {
			$tpl = 'mail_html_question';
		} else {
			$tpl = 'mail_raw_question';
		}
		$this->setLayout($tpl);
		parent::display( );
	}

}

//No Closing Tag
