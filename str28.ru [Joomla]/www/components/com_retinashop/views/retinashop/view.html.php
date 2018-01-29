<?php
/**
 *
 * Description
 *
 * @package	Magazin
 * @subpackage
 * @author
 * @link http://www.retinashop.net
 * @copyright Copyright (c) 2004 - 2011 Magazin Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: view.html.php 5671 2012-03-15 13:06:26Z Milbo $
 */

# Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

# Load the view framework
if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

/**
 * Default HTML View class for the retinashop Component
 * @todo Find out how to use the front-end models instead of the backend models
 */
class retinashopViewretinashop extends rsView {

	public function display($tpl = null) {

		/* MULTI-X
		 * $this->loadHelper('vendorHelper');
		* $vendorModel = new Vendor;
		* $vendor = $vendorModel->getVendor();
		* $this->assignRef('vendor',	$vendor);
		*/

		$vendorId = JRequest::getInt('vendorid', 1);

		$vendorModel = rsModel::getModel('vendor');

		$vendorModel->setId(1);
		$vendor = $vendorModel->getVendor();
		$this->assignRef('vendor',$vendor);

		if(!rsConfig::get('shop_is_offline',0)){

			$categoryModel = rsModel::getModel('category');
			$productModel = rsModel::getModel('product');
			$products = array();
			$categoryId = JRequest::getInt('catid', 0);
			$cache = JFactory::getCache('com_retinashop','callback');

			$categoryChildren = $cache->call( array( 'retinashopModelCategory', 'getChildCategoryList' ),$vendorId, $categoryId );
			// self::$categoryTree = self::categoryListTreeLoop($selectedCategories, $cid, $level, $disabledFields);

			//$categoryChildren = $categoryModel->getChildCategoryList($vendorId, $categoryId);

			//$categoryChildren = $categoryModel->getChildCategoryList($vendorId, $categoryId);
			$categoryModel->addImages($categoryChildren,1);

			$this->assignRef('categories',	$categoryChildren);

			if(!class_exists('CurrencyDisplay'))require(RPATH_rs_admin.DS.'helpers'.DS.'currencydisplay.php');
			$currency = CurrencyDisplay::getInstance( );
			$this->assignRef('currency', $currency);

			if (rsConfig::get('show_featured', 1)) {
				$products['featured'] = $productModel->getProductListing('featured', 5);
				$productModel->addImages($products['featured'],1);
			}

			if (rsConfig::get('show_latest', 1)) {
				$products['latest']= $productModel->getProductListing('latest', 5);
				$productModel->addImages($products['latest'],1);
			}

			if (rsConfig::get('show_topTen', 1)) {
				$products['topten']= $productModel->getProductListing('topten', 5);
				$productModel->addImages($products['topten'],1);
			}
			$this->assignRef('products', $products);

			if(!class_exists('Permissions')) require(RPATH_rs_admin.DS.'helpers'.DS.'permissions.php');
			$showBasePrice = Permissions::getInstance()->check('admin'); //todo add config settings
			$this->assignRef('showBasePrice', $showBasePrice);

			//		$layoutName = rsConfig::get('rslayout','default');

			$layout = rsConfig::get('rslayout','default');
			$this->setLayout($layout);

		} else {
			$this->setLayout('off_line');
		}

		# Set the titles
		$document = JFactory::getDocument();

		$error = JRequest::getInt('error',0);

		//Todo this may not work everytime as expected, because the error must be set in the redirect links.
		if(!empty($error)){
			/*			$head = $document->getHeadData();
			 $head['title'] = RText::_('COM_RETINASHOP_PRODUCT_NOT_FOUND');
			$document->setHeadData($head);*/
			$document->setTitle(RText::_('COM_RETINASHOP_PRODUCT_NOT_FOUND').RText::sprintf('COM_RETINASHOP_HOME',$vendor->vendor_store_name));
		} else {
			$document->setTitle(RText::sprintf('COM_RETINASHOP_HOME',$vendor->vendor_store_name));
		}

		$template = rsConfig::get('rstemplate','default');
		if (is_dir(RPATH_THEMES.DS.$template)) {
			$mainframe = JFactory::getApplication();
			$mainframe->set('setTemplate', $template);
		}



		parent::display($tpl);

	}
}
# pure php no closing tag