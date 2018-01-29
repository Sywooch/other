<?php
/**
*
* Handle the category view
*
* @package	Magazin
* @subpackage
* @author Max Milbers
* @link http://www.retinashop.net
* @copyright Copyright (c) 2011 retinashop Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: view.html.php 2703 2011-02-11 22:06:12Z Milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

/**
* Handle the category view
*
* @package retinashop
* @author Max Milbers
* @todo add full path to breadcrumb
*/
class retinashopViewCategories extends rsView {

	public function display($tpl = null) {

		$document = JFactory::getDocument();

		$mainframe = JFactory::getApplication();
		$pathway = $mainframe->getPathway();

		/* Set the helper path */
		$this->addHelperPath(RPATH_rs_admin.DS.'helpers');

		//Load helpers
		$this->loadHelper('image');
		$vendorId = JRequest::getInt('vendorid', 1);

		$vendorModel = rsModel::getModel('vendor');

		$vendorModel->setId(1);
		$vendor = $vendorModel->getVendor();
		//$this->assignRef('vendor',$vendor);

		$categoryModel = rsModel::getModel('category');
	    $categoryId = JRequest::getInt('retinashop_category_id', 0);
		$this->assignRef('categoryModel', $categoryModel);
//		$categoryId = 0;	//The idea is that you can choose a parent catgory, this value should come from the retina view parameter stuff
		$category = $categoryModel->getCategory($categoryId);
		//if($category->children)	$categoryModel->addImages($category->children);
		$cache = JFactory::getCache('com_retinashop','callback');
		$category->children = $cache->call( array( 'retinashopModelCategory', 'getChildCategoryList' ),$vendorId, $categoryId );
		//$category->children = $categoryModel->getChildCategoryList($vendorId, $categoryId);
		$categoryModel->addImages($category->children,1);

	   //Add the category name to the pathway
// 		$pathway->addelement(strip_tags($category->category_name)); //Todo what should be shown up?
		// Add the category name to the pathway
		if ($category->parents) {
			foreach ($category->parents as $c){
				$pathway->addelement(strip_tags($c->category_name),JRoute::_('index.php?option=com_retinashop&view=categories&retinashop_category_id='.$c->retinashop_category_id));
			}
		} else {
			if(!empty($category->category_name)){
				$pathway->addelement(strip_tags($category->category_name,JRoute::_('index.php?option=com_retinashop&view=categories&retinashop_category_id='.$category->retinashop_category_id)));
			} else {
				$pathway->addelement(strip_tags(RText::_('COM_RETINASHOP_CATEGORY_TOP_LEVEL'),JRoute::_('index.php?option=com_retinashop&view=categories&retinashop_category_id='.$category->retinashop_category_id)));
			}

		}

	   $this->assignRef('category', $category);

	    /* Set the titles */

		if ($category->category_name) $document->setTitle($category->category_name); //Todo same here, what should be shown up?
		else {
			$menus = &JSite::getMenu();
			$menu  = $menus->getActive();
			if(!empty($menu)){
				if (!class_exists('JParameter')) require(RPATH_rs_LIBRARIES . DS . 'retina' . DS . 'html' . DS . 'parameter.php' );
				$menu_params = new JParameter( $menu->params );
			}

			if (empty($menu) || !$menu_params->get( 'page_title')) {
				$document->setTitle($vendor->vendor_store_name);
				$category->category_name = $vendor->vendor_store_name ;
			} else $category->category_name = $menu_params->get( 'page_title');
		}
		//Todo think about which metatags should be shown in the categories view
	    if ($category->metadesc) {
			$document->setDescription( $category->metadesc );
		} else $document->setDescription( $category->category_description );
		if ($category->metakey) {
			$document->setMetaData('keywords', $category->metakey);
		}
		if ($category->metarobot) {
			$document->setMetaData('robots', $category->metarobot);
		}

		//if ($mainframe->getCfg('MetaTitle') == '1') {
			$document->setMetaData('title', strip_tags($category->category_name));  //Maybe better category_name
		//}
		if ($mainframe->getCfg('MetaAuthor') == '1') {
			$document->setMetaData('author', $category->metaauthor);
		}

		if ($category->customtitle) {
			$title = strip_tags($category->customtitle);
		} else {
			$title = strip_tags($category->category_name);
		}

		 if(empty($category->category_template)){
	    	$category->category_template = rsConfig::get('categorytemplate');
	    }

	    shopFunctionsF::setrsTemplate($this,$category->category_template,0,$category->category_layout);

		parent::display($tpl);
	}
}


//no closing tag