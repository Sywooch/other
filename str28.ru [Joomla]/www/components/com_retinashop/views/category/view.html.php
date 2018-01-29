<?php
/**
*
* Handle the category view
*
* @package	Magazin
* @subpackage
* @author RolandD
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: view.html.php 5803 2012-04-04 17:22:15Z Milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

/**
* Handle the category view
*
* @package retinashop
* @author RolandD
* @todo set meta data
* @todo add full path to breadcrumb
*/
class retinashopViewCategory extends rsView {

	public function display($tpl = null) {


		$show_prices  = rsConfig::get('show_prices',1);
		if($show_prices == '1'){
			if(!class_exists('calculationHelper')) require(RPATH_rs_admin.DS.'helpers'.DS.'calculationh.php');
		}
		$this->assignRef('show_prices', $show_prices);

		$document = JFactory::getDocument();
		// add javascript for price and cart
		rsJsApi::jPrice();

		$app = JFactory::getApplication();
		$pathway = $app->getPathway();

		/* Set the helper path */
		$this->addHelperPath(RPATH_rs_admin.DS.'helpers');

		//Load helpers
		$this->loadHelper('image');
		$categoryModel = rsModel::getModel('category');
		$productModel = rsModel::getModel('product');


		$categoryId = JRequest::getInt('retinashop_category_id', false);
		$vendorId = 1;

		$category = $categoryModel->getCategory($categoryId);
		$categoryModel->addImages($category,1);
		$perRow = empty($category->products_per_row)? rsConfig::get('products_per_row',3):$category->products_per_row;
// 		$categoryModel->setPerRow($perRow);
		$this->assignRef('perRow', $perRow);


		//No redirect here, category id = 0 means show ALL categories! note by Max Milbers
/*		if(empty($category->retinashop_vendor_id) && $search == null ) {
	    	$app -> enqueueMessage(RText::_('COM_RETINASHOP_CATEGORY_NOT_FOUND'));
	    	$app -> redirect( 'index.php');
	    }*/

	    // Add the category name to the pathway
		if ($category->parents) {
			foreach ($category->parents as $c){
				$pathway->addelement(strip_tags($c->category_name),JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id='.$c->retinashop_category_id));
			}
		}
// 		static $counter = 0;
// 		static $counter2 = 0;
		//if($category->children)	$categoryModel->addImages($category->children);
		$categoryModel->addImages($category,1);
		$cache = JFactory::getCache('com_retinashop','callback');
		$category->children = $cache->call( array( 'retinashopModelCategory', 'getChildCategoryList' ),$vendorId, $categoryId );
		// self::$categoryTree = self::categoryListTreeLoop($selectedCategories, $cid, $level, $disabledFields);
// 		rsTime('end loop categoryListTree '.$counter);

		$categoryModel->addImages($category->children,1);

	   $this->assignRef('category', $category);

		// Set Canonic link
		$document->addHeadLink( JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id='.$categoryId) , 'canonical', 'rel', '' );

	    // Set the titles
		if ($category->customtitle) {
        	 $title = strip_tags($category->customtitle);
     	} elseif ($category->category_name) {
     		 $title = strip_tags($category->category_name);
     		 }
		else {
			$menus	= $app->getMenu();
			$menu = $menus->getActive();
			if ($menu) $title = $menu->title;
			// $title = $this->params->get('page_title', '');
			// Check for empty title and add site name if param is set
			if (empty($title)) {
				$title = $app->getCfg('sitename');
			}
			elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
				$title = RText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
			}
			elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
				$title = RText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
			}
		}

	  	if(JRequest::getInt('error')){
			$title .=' '.RText::_('COM_RETINASHOP_PRODUCT_NOT_FOUND');
		}

		// set search and keyword
		if ($keyword = rsRequest::uword('keyword', '', ' ')) {
			$pathway->addelement($keyword);
			$title .=' ('.$keyword.')';
		}
		$search = JRequest::getvar('keyword', null);
		if ($search !==null) {
			$searchcustom = $this->getSearchCustom();
		}
		$this->assignRef('keyword', $keyword);
		$this->assignRef('search', $search);

	    // Load the products in the given category
	    $products = $productModel->getProductsInCategory($categoryId);
	    $productModel->addImages($products,1);
	    $this->assignRef('products', $products);

		foreach($products as $product){
			$product->stock = $productModel->getStockIndicator($product);
		}

		$ratingModel = rsModel::getModel('ratings');
		$showRating = $ratingModel->showRating();
		$this->assignRef('showRating', $showRating);

		if (JRequest::getInt('retinashop_manufacturer_id' ) and !empty($products[0])) $title .=' '.$products[0]->mf_name ;
		$document->setTitle( $title );

	    $pagination = $productModel->getPagination($perRow);
	    $this->assignRef('rsPagination', $pagination);

	    $orderByList = $productModel->getOrderByList($categoryId);
	    $this->assignRef('orderByList', $orderByList);

// 	    $productRelatedManufacturerList = $productModel->getProductRelatedManufacturerList($categoryId);
// 	    $this->assignRef('productRelatedManufacturerList', $productRelatedManufacturerList);

		//$sortOrderButton = $productModel->getsortOrderButton();
		//$this->assignRef('sortOrder', $sortOrderButton);

	   if ($category->metadesc) {
			$document->setDescription( $category->metadesc );
		}
		if ($category->metakey) {
			$document->setMetaData('keywords', $category->metakey);
		}
		if ($category->metarobot) {
			$document->setMetaData('robots', $category->metarobot);
		}

		if ($app->getCfg('MetaTitle') == '1') {
			$document->setMetaData('title',  $title);

		}
		if ($app->getCfg('MetaAuthor') == '1') {
			$document->setMetaData('author', $category->metaauthor);
		}
		if ($products) {
		$currency = CurrencyDisplay::getInstance( );
		$this->assignRef('currency', $currency);
		}

		if(!class_exists('Permissions')) require(RPATH_rs_admin.DS.'helpers'.DS.'permissions.php');
		$showBasePrice = Permissions::getInstance()->check('admin'); //todo add config settings
		$this->assignRef('showBasePrice', $showBasePrice);

		//set this after the $categoryId definition
		$paginationAction=JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id='.$categoryId );
		$this->assignRef('paginationAction', $paginationAction);

	    shopFunctionsF::setLastVisitedCategoryId($categoryId);

	    if(empty($category->category_template)){
	    	$category->category_template = rsConfig::get('categorytemplate');
	    }

	    shopFunctionsF::setrsTemplate($this,$category->category_template,0,$category->category_layout);

		parent::display($tpl);
	}
	/*
	 * generate custom fields list to display as search in FE
	 */
	public function getSearchCustom() {

		$emptyOption  = array('retinashop_custom_id' =>0, 'custom_title' => RText::_('COM_RETINASHOP_LIST_EMPTY_OPTION'));
		$this->_db =JFactory::getDBO();
		$this->_db->setQuery('SELECT `retinashop_custom_id`, `custom_title` FROM `#__retinashop_customs` WHERE `field_type` ="P"');
		$this->options = $this->_db->loadAssocList();

		if ($this->custom_parent_id = JRequest::getInt('custom_parent_id', 0)) {
			$this->_db->setQuery('SELECT `retinashop_custom_id`, `custom_title` FROM `#__retinashop_customs` WHERE custom_parent_id='.$this->custom_parent_id);
			$this->selected = $this->_db->loadObjectList();
			$this->searchCustomValues ='';
			foreach ($this->selected as $selected) {
				$this->_db->setQuery('SELECT `custom_value` as retinashop_custom_id,`custom_value` as custom_title FROM `#__retinashop_product_customfields` WHERE retinashop_custom_id='.$selected->retinashop_custom_id);
				 $valueOptions= $this->_db->loadAssocList();
				 $valueOptions = array_merge(array($emptyOption), $valueOptions);
				$this->searchCustomValues .= RText::_($selected->custom_title).' '.JHTML::_('select.genericlist', $valueOptions, 'customfields['.$selected->retinashop_custom_id.']', 'class="inputbox"', 'retinashop_custom_id', 'custom_title', 0);
			}
		}


		// add search for declared plugins
		JPluginHelper::importPlugin('rscustom');
		$dispatcher = JDispatcher::getInstance();
		$plgDisplay = $dispatcher->trigger('plgrsSelectSearchableCustom',array( &$this->options,&$this->searchCustomValues,$this->custom_parent_id ) );


		$this->options = array_merge(array($emptyOption), $this->options);
		// render List of available groups
		$this->searchCustomList = RText::_('COM_RETINASHOP_SET_PRODUCT_TYPE').' '.JHTML::_('select.genericlist',$this->options, 'custom_parent_id', 'class="inputbox"', 'retinashop_custom_id', 'custom_title', $this->custom_parent_id);
		$this->assignRef('searchcustom', $this->searchCustomList);
		$this->assignRef('searchcustomvalues', $this->searchCustomValues);
	}
}


//no closing tag