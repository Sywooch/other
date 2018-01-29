<?php

/**
 *
 * Product details view
 *
 * @package retinashop
 * @subpackage
 * @author RolandD
 * @link http://www.retinashop.net
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 2796 2011-03-01 11:29:16Z Milbo $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

/**
 * Product details
 *
 * @package retinashop
 * @author RolandD
 * @author Max Milbers
 */
class retinashopViewAskquestion extends rsView {

    /**
     * Collect all data to show on the template
     *
     * @author RolandD, Max Milbers
     */
    function display($tpl = null) {

	$show_prices = rsConfig::get('show_prices', 1);
	if ($show_prices == '1') {
	    if (!class_exists('calculationHelper'))
		require(RPATH_rs_admin . DS . 'helpers' . DS . 'calculationh.php');
	}
	$this->assignRef('show_prices', $show_prices);
	$document = JFactory::getDocument();

	/* add javascript for price and cart */
	rsJsApi::jPrice();

	$mainframe = JFactory::getApplication();
	$pathway = $mainframe->getPathway();
	$task = JRequest::getCmd('task');

	// Set the helper path
	$this->addHelperPath(RPATH_rs_admin . DS . 'helpers');


	$this->loadHelper('image');
	$this->loadHelper('addtocart');


	// Load the product
	$product_model = rsModel::getModel('product');
	$category_model = rsModel::getModel('Category');

	$retinashop_product_idArray = JRequest::getInt('retinashop_product_id', 0);
	if (is_array($retinashop_product_idArray)) {
	    $retinashop_product_id = $retinashop_product_idArray[0];
	} else {
	    $retinashop_product_id = $retinashop_product_idArray;
	}

	if (empty($retinashop_product_id)) {
	    self::showLastCategory($tpl);
	    return;
	}

	if (!class_exists('retinashopModelVendor'))
	    require(RPATH_rs_admin . DS . 'models' . DS . 'vendor.php');
	$product = $product_model->getProduct($retinashop_product_id);
	// Set Canonic link
	$document->addHeadLink($product->link, 'canonical', 'rel', '');

	// Set the titles
	$document->setTitle(RText::sprintf('COM_RETINASHOP_PRODUCT_DETAILS_TITLE', $product->product_name . ' - ' . RText::_('COM_RETINASHOP_PRODUCT_ASK_QUESTION')));
	$uri = JURI::getInstance();

	$this->assignRef('product', $product);

	if (empty($product)) {
	    self::showLastCategory($tpl);
	    return;
	}

	$product_model->addImages($product,1);


	/* Get the category ID */
	$retinashop_category_id = JRequest::getInt('retinashop_category_id');
	if ($retinashop_category_id == 0 && !empty($product)) {
	    if (array_key_exists('0', $product->categories))
		$retinashop_category_id = $product->categories[0];
	}

	shopFunctionsF::setLastVisitedCategoryId($retinashop_category_id);

	if ($category_model) {
	    $category = $category_model->getCategory($retinashop_category_id);
	    $this->assignRef('category', $category);
	    $pathway->addelement($category->category_name, JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id=' . $retinashop_category_id));
	}

	//$pathway->addelement(RText::_('COM_RETINASHOP_PRODUCT_DETAILS'), $uri->toString(array('path', 'query', 'fragment')));
	$pathway->addelement($product->product_name, JRoute::_('index.php?option=com_retinashop&view=productdetails&retinashop_category_id=' . $retinashop_category_id . '&retinashop_product_id=' . $product->retinashop_product_id));

	// for askquestion
	$pathway->addelement(RText::_('COM_RETINASHOP_PRODUCT_ASK_QUESTION'));

	$this->assignRef('user', JFactory::getUser());

	if ($product->metadesc) {
	    $document->setDescription($product->metadesc);
	}
	if ($product->metakey) {
	    $document->setMetaData('keywords', $product->metakey);
	}

	if ($product->metarobot) {
	    $document->setMetaData('robots', $product->metarobot);
	}

	if ($mainframe->getCfg('MetaTitle') == '1') {
	    $document->setMetaData('title', $product->product_s_desc);  //Maybe better product_name
	}
	if ($mainframe->getCfg('MetaAuthor') == '1') {
	    $document->setMetaData('author', $product->metaauthor);
	}

	parent::display($tpl);
    }

    function renderMailLayout() {
	$this->setLayout('mail_html_question');
	$this->comment = JRequest::getString('comment');

	$vendorModel = rsModel::getModel('vendor');
	$this->vendor = $vendorModel->getVendor();

	$this->subject = Jtext::_('COM_RETINASHOP_QUESTION_ABOUT') . $this->product->product_name;
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

    private function showLastCategory($tpl) {
	$retinashop_category_id = shopFunctionsF::getLastVisitedCategoryId();
	$categoryLink = '';
	if ($retinashop_category_id) {
	    $categoryLink = '&retinashop_category_id=' . $retinashop_category_id;
	}
	$continue_link = JRoute::_('index.php?option=com_retinashop&view=category' . $categoryLink);

	$continue_link_html = '<a href="' . $continue_link . '" />' . RText::_('COM_RETINASHOP_CONTINUE_SHOPPING') . '</a>';
	$this->assignRef('continue_link_html', $continue_link_html);
	// Display it all
	parent::display($tpl);
    }

}

// pure php no closing tag