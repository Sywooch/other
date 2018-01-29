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
 * @version $Id: view.html.php 5887 2012-04-14 13:16:20Z electrocity $
 */
// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if (!class_exists('rsView'))
    require(RPATH_rs_SITE . DS . 'helpers' . DS . 'rsview.php');

/**
 * Product details
 *
 * @package retinashop
 * @author RolandD
 * @author Max Milbers
 */
class retinashopViewProductdetails extends rsView {

    /**
     * Collect all data to show on the template
     *
     * @author RolandD, Max Milbers
     */
    function display($tpl = null) {

	//TODO get plugins running
//		$dispatcher	= JDispatcher::getInstance();
//		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');

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

	/* Set the helper path */
	$this->addHelperPath(RPATH_rs_admin . DS . 'helpers');

	//Load helpers
	$this->loadHelper('image');


	/* Load the product */
//		$product = $this->get('product');	//Why it is sensefull to use this construction? Imho it makes it just harder
	$product_model = rsModel::getModel('product');

	$retinashop_product_idArray = JRequest::getInt('retinashop_product_id', 0);
	if (is_array($retinashop_product_idArray)) {
	    $retinashop_product_id = $retinashop_product_idArray[0];
	} else {
	    $retinashop_product_id = $retinashop_product_idArray;
	}

	$product = $product_model->getProduct($retinashop_product_id);

// 		rsSetStartTime('customs');
// 		for($k=0;$k<count($product->customfields);$k++){
// 			$custom = $product->customfields[$k];
	if (!empty($product->customfields)) {
	    foreach ($product->customfields as $k => $custom) {
		if (!empty($custom->layout_pos)) {
		    $product->customfieldsSorted[$custom->layout_pos][] = $custom;
		    unset($product->customfields[$k]);
		}
	    }
	    $product->customfieldsSorted['normal'] = $product->customfields;
	    unset($product->customfields);
	}

// 		rsTime('Customs','customs');
// 		rsdebug('my second $product->customfields',$product->customfields);

	if (empty($product->slug)) {

	    //Todo this should be redesigned to fit better for SEO
	    $mainframe->enqueueMessage(RText::_('COM_RETINASHOP_PRODUCT_NOT_FOUND'));
	    $retinashop_category_id = shopFunctionsF::getLastVisitedCategoryId();
	    $categoryLink = '';
	    if (!$retinashop_category_id) {
		$retinashop_category_id = JRequest::getInt('retinashop_category_id', false);
	    }
	    if ($retinashop_category_id) {
		$categoryLink = '&retinashop_category_id=' . $retinashop_category_id;
	    }

	    $mainframe->redirect(JRoute::_('index.php?option=com_retinashop&view=category' . $categoryLink . '&error=404'));

	    return;
	}

	$product->event = new stdClass();
	$product->event->afterDisplayTitle = '';
	$product->event->beforeDisplayContent = '';
	$product->event->afterDisplayContent = '';
	if (rsConfig::get('enable_content_plugin', 0)) {
	   // add content plugin //
	   $dispatcher = & JDispatcher::getInstance();
	   JPluginHelper::importPlugin('content');
	   $product->text = $product->product_desc;
		jimport( 'retina.html.parameter' );
		$params = new JParameter('');

 		if(Jrs_VERSION === 2 ) {
			$results = $dispatcher->trigger('onContentPrepare', array('com_retinashop.productdetails', &$product, &$params, 0));
			// More events for 3rd party content plugins
			// This do not disturb actual plugins, because we don't modify $product->text
			$res = $dispatcher->trigger('onContentAfterTitle', array('com_retinashop.productdetails', &$product, &$params, 0));
			$product->event->afterDisplayTitle = trim(implode("\n", $res));

			$res = $dispatcher->trigger('onContentBeforeDisplay', array('com_retinashop.productdetails', &$product, &$params, 0));
			$product->event->beforeDisplayContent = trim(implode("\n", $res));

			$res = $dispatcher->trigger('onContentAfterDisplay', array('com_retinashop.productdetails', &$product, &$params, 0));
			$product->event->afterDisplayContent = trim(implode("\n", $res));
		} else {
			$results = $dispatcher->trigger('onPrepareContent', array(& $product, & $params, 0));
		}
		$product->product_desc = $product->text;
	}

	$product_model->addImages($product);
	$this->assignRef('product', $product);
	if (isset($product->min_order_level) && (int) $product->min_order_level > 0) {
	    $min_order_level = $product->min_order_level;
	} else {
	    $min_order_level = 1;
	}
	$this->assignRef('min_order_level', $min_order_level);
	// Load the neighbours
	$product->neighbours = $product_model->getNeighborProducts($product);
//		if(!empty($product->neighbours) && is_array($product->neighbours) && !empty($product->neighbours[0]))$product_model->addImages($product->neighbours);
//		$product->related = $product_model->getRelatedProducts($retinashop_product_id);
//		if(!empty($product->related) && is_array($product->related) && !empty($product->related[0]))$product_model->addImages($product->related);
	// Load the category
	$category_model = rsModel::getModel('category');

	// Get the category ID
	$retinashop_category_id = JRequest::getInt('retinashop_category_id');
	if ($retinashop_category_id == 0 && !empty($product)) {
	    if (array_key_exists('0', $product->categories))
		$retinashop_category_id = $product->categories[0];
	}

	shopFunctionsF::setLastVisitedCategoryId($retinashop_category_id);

	if ($category_model) {
	    $category = $category_model->getCategory($retinashop_category_id);

	    $category_model->addImages($category, 1);
	    $this->assignRef('category', $category);

	    if ($category->parents) {
		foreach ($category->parents as $c) {
		    $pathway->addelement(strip_tags($c->category_name), JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id=' . $c->retinashop_category_id));
		}
	    }

	    $vendorId = 1;
	    $category->children = $category_model->getChildCategoryList($vendorId, $retinashop_category_id);
	    $category_model->addImages($category->children, 1);
	}
	$format = JRequest::getCmd('format', 'html');
	if (!empty($tpl)) {
	    $format = $tpl;
	} else {
	    $format = JRequest::getWord('format', 'html');
	}
	if ($format == 'html') {
	    // Set Canonic link
	    $document->addHeadLink(JRoute::_($product->canonical, true, -1), 'canonical', 'rel', '');
	}

	$uri = JURI::getInstance();
	//$pathway->addelement(RText::_('COM_RETINASHOP_PRODUCT_DETAILS'), $uri->toString(array('path', 'query', 'fragment')));
	$pathway->addelement(strip_tags($product->product_name));
	// Set the titles
	// $document->setTitle should be after the addelement pathway
	if ($product->customtitle) {
	    $document->setTitle(strip_tags($product->customtitle));
	} else {
	    $document->setTitle(strip_tags(($category->category_name ? ($category->category_name . ' : ') : '') . $product->product_name));
	}
	$ratingModel = rsModel::getModel('ratings');
	$allowReview = $ratingModel->allowReview($product->retinashop_product_id);
	$this->assignRef('allowReview', $allowReview);

	$showReview = $ratingModel->showReview($product->retinashop_product_id);
	$this->assignRef('showReview', $showReview);

	if ($showReview) {

	    $review = $ratingModel->getReviewByProduct($product->retinashop_product_id);
	    $this->assignRef('review', $review);

	    $rating_reviews = $ratingModel->getReviews($product->retinashop_product_id);
	    $this->assignRef('rating_reviews', $rating_reviews);
	}

	$showRating = $ratingModel->showRating($product->retinashop_product_id);
	$this->assignRef('showRating', $showRating);

	if ($showRating) {
	    $vote = $ratingModel->getVoteByProduct($product->retinashop_product_id);
	    $this->assignRef('vote', $vote);

	    $rating = $ratingModel->getRatingByProduct($product->retinashop_product_id);
	    $this->assignRef('rating', $rating);
	}

	$allowRating = $ratingModel->allowRating($product->retinashop_product_id);
	$this->assignRef('allowRating', $allowRating);

	// Check for editing access
	// @todo build edit page
	if (!class_exists('Permissions'))
	    require(RPATH_rs_admin . DS . 'helpers' . DS . 'permissions.php');
	if (Permissions::getInstance()->check("admin,storeadmin")) {
	    $edit_link = JURI::root() . 'index.php?option=com_retinashop&tmpl=component&view=product&task=edit&retinashop_product_id=' . $product->retinashop_product_id;
	    $edit_link = $this->linkIcon($edit_link, 'COM_RETINASHOP_PRODUCT_FORM_EDIT_PRODUCT', 'edit', false, false);
	} else {
	    $edit_link = "";
	}
	$this->assignRef('edit_link', $edit_link);

	// Load the user details
	$this->assignRef('user', JFactory::getUser());

	// More reviews link
	$uri = JURI::getInstance();
	$uri->setVar('showall', 1);
	$this->assignRef('more_reviews', $uri->toString());

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
	    $document->setMetaData('title', $product->product_name);  //Maybe better product_name
	}
	if ($mainframe->getCfg('MetaAuthor') == '1') {
	    $document->setMetaData('author', $product->metaauthor);
	}


	$showBasePrice = Permissions::getInstance()->check('admin'); //todo add config settings
	$this->assignRef('showBasePrice', $showBasePrice);

	$productDisplayShipments = array();
	$productDisplayPayments = array();

	if (!class_exists('rsPSPlugin'))
	    require(RPATH_rs_PLUGINS . DS . 'rspsplugin.php');
	JPluginHelper::importPlugin('rsshipment');
	JPluginHelper::importPlugin('rspayment');
	$dispatcher = JDispatcher::getInstance();
	$returnValues = $dispatcher->trigger('plgrsOnProductDisplayShipment', array($product, &$productDisplayShipments));
	$returnValues = $dispatcher->trigger('plgrsOnProductDisplayPayment', array($product, &$productDisplayPayments));

	$this->assignRef('productDisplayPayments', $productDisplayPayments);
	$this->assignRef('productDisplayShipments', $productDisplayShipments);

	if (empty($category->category_template)) {
	    $category->category_template = rsConfig::get('categorytemplate');
	}

	shopFunctionsF::setrsTemplate($this, $category->category_template, $product->product_template, $category->category_layout, $product->layout);

	shopFunctionsF::addProductToRecent($retinashop_product_id);

	$currency = CurrencyDisplay::getInstance();
	$this->assignRef('currency', $currency);
	
	if(JRequest::getCmd( 'layout', 'default' )=='notify') $this->setLayout('notify'); //Added by Seyi Awofadeju to catch notify layout


	parent::display($tpl);
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