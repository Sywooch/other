<?php
if(  !defined( '_REXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @package retinashop
* @Author Kohl Patrick
* @subpackage router
* @copyright Copyright (C) 2010 Kohl Patrick - retinashop Team - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /admin/components/com_retinashop/COPYRIGHT.php for copyright notices and details.
*
* http://retinashop.net
*/


function retinashopBuildRoute(&$query) {

	$segments = array();

	$helper = rsrouterHelper::getInstance($query);
	/* simple route , no work , for very slow server or test purpose */
	if ($helper->router_disabled) {
		foreach ($query as $key => $value){
			if  ($key != 'option')  {
				if ($key != 'elementid') {
					$segments[]=$key.'/'.$value;
					unset($query[$key]);
				}
			}

		}
		return $segments;
	}

		if ($helper->edit) return $segments;

	/* Full route , heavy work*/
	// $lang = $helper->lang ;
	$view = '';

	$jmenu = $helper->menu ;

	if(isset($query['langswitch'])) unset($query['langswitch']);

	if(isset($query['view'])){
		$view = $query['view'];
		unset($query['view']);
	}
	switch ($view) {
		case 'retinashop';
			$query['elementid'] = $jmenu['retinashop'] ;
		break;
		/* Shop category or retinashop view
		 All ideas are wellcome to improve this
		 because is the biggest and more used */
		case 'category';
			$start = null;
			$limitstart = null;
			$limit = null;



			if ( isset($query['retinashop_manufacturer_id'])  ) {
				$segments[] = $helper->lang('manufacturer').'/'.$helper->getManufacturerName($query['retinashop_manufacturer_id']) ;
				unset($query['retinashop_manufacturer_id']);

			}
			if ( isset($query['search'])  ) {
				$segments[] = $helper->lang('search') ;
				unset($query['search']);
			}
			if ( isset($query['keyword'] )) {
				$segments[] = $query['keyword'];
				unset($query['keyword']);
			}
			if ( isset($query['retinashop_category_id']) ) {
				if (isset($jmenu['retinashop_category_id'][ $query['retinashop_category_id'] ] ) )
					$query['elementid'] = $jmenu['retinashop_category_id'][$query['retinashop_category_id']];
				else {
					$categoryRoute = $helper->getCategoryRoute($query['retinashop_category_id']);
					if ($categoryRoute->route) $segments[] = $categoryRoute->route;
					if ($categoryRoute->elementId) $query['elementid'] = $categoryRoute->elementId;
				}
				unset($query['retinashop_category_id']);
			}
			 if ( isset($jmenu['category']) ) $query['elementid'] = $jmenu['category'];


			if ( isset($query['order']) ) {
				if ($query['order'] =='DESC') $segments[] = $helper->lang('orderDesc') ;
				unset($query['order']);
			}

			if ( isset($query['orderby']) ) {
				$segments[] = $helper->lang('by').','.$helper->lang( $query['orderby']) ;
				unset($query['orderby']);
			}

			// retina replace before route limitstart by start but without SEF this is start !
			 if ( isset($query['limitstart'] ) ) {
				$limitstart = $query['limitstart'] ;
				unset($query['limitstart']);
			}
			if ( isset($query['start'] ) ) {
				$start = $query['start'] ;
				unset($query['start']);
			}
			if ( isset($query['limit'] ) ) {
				$limit = $query['limit'] ;
				unset($query['limit']);
			}
			if ($start !== null &&  $limitstart!== null ) {
				//$segments[] = $helper->lang('results') .',1-'.$start ;
			} else if ( $start>0 ) {
				// using general limit if $limit is not set
				if ($limit === null) $limit= rsrouterHelper::$limit ;

				//Pagination changed, maybe the +1 is wrong note by Max Milbers
					$segments[] = $helper->lang('results') .','. ($start+1).'-'.($start+$limit);
			} else if ($limit !== null && $limit != rsrouterHelper::$limit ) $segments[] = $helper->lang('results') .',1-'.$limit ;//limit change

			return $segments;
		break;
		/* Shop product details view  */
		case 'productdetails';
			$retinashop_product_id = false;
			if (isset($jmenu['retinashop_product_id'][ $query['retinashop_product_id'] ] ) ) {
				$query['elementid'] = $jmenu['retinashop_product_id'][$query['retinashop_product_id']];
			} else {
				if(isset($query['retinashop_product_id'])) {
					if ($helper->use_id) $segments[] = $query['retinashop_product_id'];
					$retinashop_product_id = $query['retinashop_product_id'];
					unset($query['retinashop_product_id']);
				}
				if(empty( $query['retinashop_category_id'])){
					$query['retinashop_category_id'] = $helper->getParentProductcategory($retinashop_product_id);
				}
				if(!empty( $query['retinashop_category_id'])){
					$categoryRoute = $helper->getCategoryRoute($query['retinashop_category_id']);
					if ($categoryRoute->route) $segments[] = $categoryRoute->route;
					if ($categoryRoute->elementId) $query['elementid'] = $categoryRoute->elementId;
					else $query['elementid'] = $jmenu['retinashop'];
				}
					unset($query['retinashop_category_id']);

				if($retinashop_product_id)
					$segments[] = $helper->getProductName($retinashop_product_id);
			}

			return $segments;
		break;
		case 'manufacturer';

			if(isset($query['retinashop_manufacturer_id'])) {
				if (isset($jmenu['retinashop_manufacturer_id'][ $query['retinashop_manufacturer_id'] ] ) ) {
					$query['elementid'] = $jmenu['retinashop_manufacturer_id'][$query['retinashop_manufacturer_id']];
				} else {
					$segments[] = $helper->lang('manufacturers').'/'.$helper->getManufacturerName($query['retinashop_manufacturer_id']) ;
					if ( isset($jmenu['manufacturer']) ) $query['elementid'] = $jmenu['manufacturer'];
					else $query['elementid'] = $jmenu['retinashop'];
				}
				unset($query['retinashop_manufacturer_id']);
			} else {
				if ( isset($jmenu['manufacturer']) ) $query['elementid'] = $jmenu['manufacturer'];
				else $query['elementid'] = $jmenu['retinashop'];
			}
		break;
		case 'user';
			if ( isset($jmenu['user']) ) $query['elementid'] = $jmenu['user'];
			else {
				$segments[] = $helper->lang('user') ;
				$query['elementid'] = $jmenu['retinashop'];
			}
			if (isset($query['task'])) {
				if ($query['addrtype'] == 'BT' && $query['task']='editaddresscart') $segments[] = $helper->lang('editaddresscartBT') ;
				elseif ($query['addrtype'] == 'ST' && $query['task']='editaddresscart') $segments[] = $helper->lang('editaddresscartST') ;
				else $segments[] = $query['task'] ;
				unset ($query['task'] , $query['addrtype']);
			}
		break;
		case 'vendor';
			if(isset($query['retinashop_vendor_id'])) {
				if (isset($jmenu['retinashop_vendor_id'][ $query['retinashop_vendor_id'] ] ) ) {
					$query['elementid'] = $jmenu['retinashop_vendor_id'][$query['retinashop_vendor_id']];
				} else {
					$retinashop_vendor_id = $query['retinashop_vendor_id'];
					if ( isset($jmenu['vendor']) ) {
						$query['elementid'] = $jmenu['vendor'];
					} else {
						$segments[] = $helper->lang('vendor') ;
						$query['elementid'] = $jmenu['retinashop'];
					}
				}
			} else if ( isset($jmenu['vendor']) ) {
				$query['elementid'] = $jmenu['vendor'];
			} else {
				$segments[] = $helper->lang('vendor') ;
				$query['elementid'] = $jmenu['retinashop'];
			}
			if (isset($retinashop_vendor_id)) {
				$segments[] = $retinashop_vendor_id;
				unset ($query['retinashop_vendor_id'] );
			}
		break;
		case 'cart';
			if ( isset($jmenu['cart']) ) $query['elementid'] = $jmenu['cart'];
			else {
				$segments[] = $helper->lang('cart') ;
				$query['elementid'] = $jmenu['retinashop'];
			}

		break;
		case 'orders';
			if ( isset($jmenu['orders']) ) $query['elementid'] = $jmenu['orders'];
			else {
				$segments[] = $helper->lang('orders') ;
				$query['elementid'] = $jmenu['retinashop'];
			}
			if ( isset($query['order_number']) ) {
				$segments[] = 'number/'.$query['order_number'];
				unset ($query['order_number'],$query['layout']);
			} else if ( isset($query['retinashop_order_id']) ) {
				$segments[] = 'id/'.$query['retinashop_order_id'];
				unset ($query['retinashop_order_id'],$query['layout']);
			}

			//else unset ($query['layout']);
		break;

		// sef only view
		default ;
		$segments[] = $view;


	}
	if (isset($query['task'])) {
		$segments[] = $helper->lang($query['task']);
		unset($query['task']);
	}
	if (isset($query['layout'])) {
		$segments[] = $helper->lang($query['layout']) ;
		unset($query['layout']);
	}
	// sef the slimbox View
	if (isset($query['tmpl'])) {
		if ( $query['tmpl'] = 'component') $segments[] = 'modal' ;
		unset($query['tmpl']);
	}
	return $segments;
}

/* This function can be slower because is used only one time  to find the real URL*/
function retinashopParseRoute($segments) {

	$vars = array();
	$helper = rsrouterHelper::getInstance();
	if ($helper->router_disabled) {
		$total = count($segments);
		for ($i = 0; $i < $total; $i=$i+2) {
		$vars[ $segments[$i] ] = $segments[$i+1];
		}
		return $vars;
	}
	if (empty($segments)) {
		return $vars;
	}
	//$lang = $helper->lang ;
	// revert '-' (retina change - to :) //
	foreach  ($segments as &$value) {
		$value = str_replace(':', '-', $value);
	}

	// $splitted = explode(',',$segments[0],2);
	$splitted = explode(',',end($segments),2);

	if ( $helper->compareKey($splitted[0] ,'results')){
		// array_shift($segments);
		array_pop($segments);
		$results = explode('-',$splitted[1],2);
		//Pagination has changed, removed the -1 note by Max Milbers NOTE: Works on j1.5, but NOT j1.7
		// limistart is swapped by retina to start ! See includes/route.php
			if ($start = $results[0]-1) $vars['limitstart'] = $start;
			else $vars['limitstart'] = 0 ;
			$vars['limit'] = $results[1]-$results[0]+1;

	} else {
		$vars['limitstart'] = 0 ;
		$vars['limit'] = rsrouterHelper::$limit;

	}
	if (empty($segments)) {
			$vars['view'] = 'category';
			$vars['retinashop_category_id'] = $helper->activeMenu->retinashop_category_id ;
			return $vars;
	}

	// $orderby = explode(',',$segments[0],2);
	$orderby = explode(',',end($segments),2);
	if (  $helper->compareKey($orderby[0] , 'by') ) {
		$vars['orderby'] =$helper->getOrderingKey($orderby[1]) ;
		// array_shift($segments);
		array_pop($segments);

		if (empty($segments)) {
			$vars['view'] = 'category';
			$vars['retinashop_category_id'] = $helper->activeMenu->retinashop_category_id ;
			return $vars;
		}
	}
	if (  $helper->compareKey(end($segments),'orderDesc') ){
		$vars['order'] ='DESC' ;
		array_pop($segments);
		if (empty($segments)) {
			$vars['view'] = 'category';
			$vars['retinashop_category_id'] = $helper->activeMenu->retinashop_category_id ;
			return $vars;
		}
	}

	if ( $segments[0] == 'product') {
		$vars['view'] = 'product';
		$vars['task'] = $segments[1];
		$vars['tmpl'] = 'component';
		return $vars;
		}

	if (  $helper->compareKey($segments[0] ,'manufacturer') ) {
		array_shift($segments);
		$vars['retinashop_manufacturer_id'] =  $helper->getManufacturerId($segments[0]);
		array_shift($segments);
		// OSP 2012-02-29 removed search malforms SEF path and search is performed
		// $vars['search'] = 'true';
		if (empty($segments)) {
			$vars['view'] = 'category';
			$vars['retinashop_category_id'] = $helper->activeMenu->retinashop_category_id ;
			return $vars;
		}

	}
	if ( $helper->compareKey($segments[0] ,'search') ) {
		$vars['search'] = 'true';
		array_shift($segments);
		if ( !empty ($segments) ) {
			$vars['keyword'] = array_shift($segments);

		}
		$vars['view'] = 'category';
		$vars['retinashop_category_id'] = $helper->activeMenu->retinashop_category_id ;
		if (empty($segments)) return $vars;
	}
	if (end($segments) == 'modal') {
		$vars['tmpl'] = 'component';
		array_pop($segments);

	}
	if ( $helper->compareKey(end($segments) ,'askquestion') ) {
		$vars['task'] = 'askquestion';
		array_pop($segments);

	} elseif ( $helper->compareKey(end($segments) ,'recommend') ) {
		$vars['task'] = 'recommend';
		array_pop($segments);

	}

	if (empty($segments)) return $vars ;

	// View is first segment now
	$view = $segments[0];
	if ( $helper->compareKey($view,'orders') || $helper->activeMenu->view == 'orders') {
		$vars['view'] = 'orders';
		if ( $helper->compareKey($view,'orders')){
			array_shift($segments);

		}
		if (empty($segments)) {
			$vars['layout'] = 'list';
		}
		 else if ($helper->compareKey($segments[0],'list') ) {
			$vars['layout'] = 'list';
			array_shift($segments);
		}
		if ( !empty($segments) ) {
			if ($segments[0] ='number')
			$vars['order_number'] = $segments[1] ;
			else $vars['retinashop_order_id'] = $segments[1] ;
			$vars['layout'] = 'details';
		}
		return $vars;
	}
	else if ( $helper->compareKey($view,'user') || $helper->activeMenu->view == 'user') {
		$vars['view'] = 'user';
		if ( $helper->compareKey($view,'user') ) {
			array_shift($segments);
		}

		if ( !empty($segments) ) {
			if (  $helper->compareKey($segments[0] ,'editaddresscartBT') ) {
				$vars['addrtype'] = 'BT' ;
				$vars['task'] = 'editaddresscart' ;
			}
			elseif (  $helper->compareKey($segments[0] ,'editaddresscartST') ) {
				$vars['addrtype'] = 'ST' ;
				$vars['task'] = 'editaddresscart' ;
				} else $vars['task'] = $segments[0] ;
		}
		return $vars;
	}
	else if ( $helper->compareKey($view,'vendor') || $helper->activeMenu->view == 'vendor') {
		$vars['view'] = 'vendor';
		if ( $helper->compareKey($view,'vendor') ) {
			array_shift($segments);
			if (empty($segments)) return $vars;
		}
		$vars['retinashop_vendor_id'] = array_shift($segments);
		if(!empty($segments)) {
		if ( $helper->compareKey($segments[0] ,'contact') ) $vars['layout'] = 'contact' ;
		elseif ( $helper->compareKey($segments[0] ,'tos') ) $vars['layout'] = 'tos' ;
		} else $vars['layout'] = 'details' ;

		return $vars;
	}
	else if ( $helper->compareKey($view,'cart') || $helper->activeMenu->view == 'cart') {
		$vars['view'] = 'cart';
		if ( $helper->compareKey($view,'cart') ) {
			array_shift($segments);
			if (empty($segments)) return $vars;
		}
		if ( $helper->compareKey($segments[0] ,'edit_shipment') ) $vars['task'] = 'edit_shipment' ;
		elseif ( $helper->compareKey($segments[0] ,'editpayment') ) $vars['task'] = 'editpayment' ;
		elseif ( $helper->compareKey($segments[0] ,'delete') ) $vars['task'] = 'delete' ;
		return $vars;
	}

	else if ( $helper->compareKey($view,'manufacturers') || $helper->activeMenu->view == 'manufacturer') {
		$vars['view'] = 'manufacturer';

		if ( $helper->compareKey($view,'manufacturers') ) {
			array_shift($segments);
		}

		if (!empty($segments) ) {
			$vars['retinashop_manufacturer_id'] =  $helper->getManufacturerId($segments[0]);
			array_shift($segments);
		}
		if ( isset($segments[0]) && $segments[0] == 'modal') {
			$vars['tmpl'] = 'component';
			array_shift($segments);
		}
		// if (isset($helper->activeMenu->retinashop_manufacturer_id))
			// $vars['retinashop_manufacturer_id'] = $helper->activeMenu->retinashop_manufacturer_id ;

		return $vars;
	}

	/*
	 * seo_sufix must never be used in category or router can't find it
	 * eg. suffix as "-suffix", a category with "name-suffix" get always a false return
	 * Trick : YOu can simply use "-p","-x","-" or ".htm" for better seo result if it's never in the product/category name !
	 */
	 if (substr(end($segments ), -(int)$helper->seo_sufix_size ) == $helper->seo_sufix ) {
		$vars['view'] = 'productdetails';
		if (!$helper->use_id ) {
			$product = $helper->getProductId($segments ,$helper->activeMenu->retinashop_category_id);
			$vars['retinashop_product_id'] = $product['retinashop_product_id'];
			$vars['retinashop_category_id'] = $product['retinashop_category_id'];
		}
		elseif (isset($segments[1]) ){
			$vars['retinashop_product_id'] = $segments[0];
			$vars['retinashop_category_id'] = $segments[1];
		} else {
			$vars['retinashop_product_id'] = $segments[0];
			$vars['retinashop_category_id'] = $helper->activeMenu->retinashop_category_id ;
		}


	} elseif (!$helper->use_id && ($helper->activeMenu->view == 'category' ) )  {
		$vars['retinashop_category_id'] = $helper->getCategoryId (end($segments) ,$helper->activeMenu->retinashop_category_id);
		$vars['view'] = 'category' ;


	} elseif (isset($segments[0]) && ctype_digit ($segments[0]) || $helper->activeMenu->retinashop_category_id>0 ) {
		$vars['retinashop_category_id'] = $segments[0];
		$vars['view'] = 'category';


	} elseif ($helper->activeMenu->retinashop_category_id >0 && $vars['view'] != 'productdetails') {
		$vars['retinashop_category_id'] = $helper->activeMenu->retinashop_category_id ;
		$vars['view'] = 'category';

	} elseif ($id = $helper->getCategoryId (end($segments) ,$helper->activeMenu->retinashop_category_id )) {

		// find corresponding category . If not, segment 0 must be a view
		$vars['retinashop_category_id'] = $id;
		$vars['view'] = 'category' ;
	} else {
		$vars['view'] = $segments[0] ;
		if ( isset($segments[1]) ) {
			$vars['task'] = $segments[1] ;
		}
	}



	return $vars;
}

class rsrouterHelper {

	/* language array */
	public $lang = null ;
	public $langTag = null ;
	public $query = array();
	/* retina menus ID object from com_retinashop */
	public $menu = null ;

	/* retina active menu( elementId ) object */
	public $activeMenu = null ;
	public $menurselements = null;
	/*
	  * $use_id type boolean
	  * Use the Id's of categorie and product or not
	  */
	public $use_id = false ;

	public $seo_translate = false ;
	private $orderings = null ;
	public static $limit = null ;
	/*
	  * $router_disabled type boolean
	  * true  = don't Use the router
	  */
	public $router_disabled = false ;

	/* instance of class */
	private static $_instances = array ();

	private static $_catRoute = array ();

	public $CategoryName = array();
	private $dbview = array('vendor' =>'vendor','category' =>'category','retinashop' =>'retinashop','productdetails' =>'product','cart' => 'cart','manufacturer' => 'manufacturer','user'=>'user');

	private function __construct($instanceKey,$query) {

		if (!$this->router_disabled = rsConfig::get('seo_disabled', false)) {

			$this->seo_translate = rsConfig::get('seo_translate', false);
			$this->setLangs($instanceKey);
			if ( Jrs_VERSION===1 ) $this->setMenuelementId();
			else $this->setMenuelementIdJ17();
			$this->setActiveMenu();
			$this->use_id = rsConfig::get('seo_use_id', false);
			$this->seo_sufix = rsConfig::get('seo_sufix', '-detail');
			$this->seo_sufix_size = strlen($this->seo_sufix) ;
			$this->edit = ('edit' == JRequest::getCmd('task') );
			// if language switcher we must know the $query
			$this->query = $query;
		}

	}

	public static function getInstance(&$query = null) {

		if (!class_exists( 'rsConfig' )) {
			require(RPATH_admin . DS . 'components' . DS . 'com_retinashop'.DS.'helpers'.DS.'config.php');
			rsConfig::loadConfig();
		}

		if (isset($query['langswitch']) ) {
			if ($query['langswitch'] != rsLANG ) $instanceKey = $query['langswitch'] ;
			unset ($query['langswitch']);

		} else $instanceKey = rsLANG ;
		if (! array_key_exists ($instanceKey, self::$_instances)){
			self::$_instances[$instanceKey] = new rsrouterHelper ($instanceKey,$query);

			if (self::$limit===null){
				$mainframe = Jfactory::getApplication(); ;
				self::$limit= $mainframe->getUserStateFromRequest('global.list.limit', 'limit', rsConfig::get('list_limit', 20), 'int');
			}
		}
		return self::$_instances[$instanceKey];
	}

	/* multi language routing ? */
	public function setLangs($instanceKey){
		$langs = rsConfig::get('active_languages',false);
		if(count($langs)> 1) {
			if(!in_array($instanceKey, $langs)) {
				$this->rslang = rsLANG ;
				$this->langTag = strtr(rsLANG,'_','-');
			} else {
				$this->rslang = strtolower(strtr($instanceKey,'-','_'));
				$this->langTag= $instanceKey;
			}
		} else $this->rslang = $this->langTag = rsLANG ;
		$this->setLang($instanceKey);
		$this->Jlang = JFactory::getLanguage();
	}

	public function getCategoryRoute($retinashop_category_id){

		$cache = JFactory::getCache('_retinashop','');
		$key = $retinashop_category_id. $this->rslang ; // internal cache key
		if (!($CategoryRoute = $cache->get($key))) {
			$CategoryRoute = $this->getCategoryRouteNocache($retinashop_category_id);
			$cache->store($CategoryRoute, $key);
		}
		return $CategoryRoute ;
	}
	/* Get retina menu element and the route for category */
	public function getCategoryRouteNocache($retinashop_category_id){
		if (! array_key_exists ($retinashop_category_id . $this->rslang, self::$_catRoute)){
			$category = new stdClass();
			$category->route = '';
			$category->elementId = 0;
			$menuCatid = 0 ;
			$ismenu = false ;

			// control if category is retina menu
			if (isset($this->menu['retinashop_category_id'])) {
				if (isset( $this->menu['retinashop_category_id'][$retinashop_category_id])) {
					$ismenu = true;
					$category->elementId = $this->menu['retinashop_category_id'][$retinashop_category_id] ;
				} else {
					$CatParentIds = $this->getCategoryRecurse($retinashop_category_id,0) ;
					/* control if parent categories are retina menu */
					foreach ($CatParentIds as $CatParentId) {
						// No ? then find the parent menu categorie !
						if (isset( $this->menu['retinashop_category_id'][$CatParentId]) ) {
							$category->elementId = $this->menu['retinashop_category_id'][$CatParentId] ;
							$menuCatid = $CatParentId;
							break;
						}
					}
				}
			}
			if ($ismenu==false) {
				if ( $this->use_id ) $category->route = $retinashop_category_id.'/';
				if (!isset ($this->CategoryName[$retinashop_category_id])) {
					$this->CategoryName[$retinashop_category_id] = $this->getCategoryNames($retinashop_category_id, $menuCatid );
				}
				$category->route .= $this->CategoryName[$retinashop_category_id] ;
				if ($menuCatid == 0  && $this->menu['retinashop']) $category->elementId = $this->menu['retinashop'] ;
			}
			self::$_catRoute[$retinashop_category_id . $this->rslang] = $category;
		}
		return self::$_catRoute[$retinashop_category_id . $this->rslang] ;
	}

	/*get url safe names of category and parents categories  */
	public function getCategoryNames($retinashop_category_id,$catMenuId=0){

		$strings = array();
		$db = JFactory::getDBO();
		$parents_id = array_reverse($this->getCategoryRecurse($retinashop_category_id,$catMenuId)) ;

		foreach ($parents_id as $id ) {
			$q = 'SELECT `slug` as name
					FROM  `#__retinashop_categories_'.$this->rslang.'`
					WHERE  `retinashop_category_id`='.(int)$id;

			$db->setQuery($q);
			$strings[] = $db->loadResult();
		}

		if(function_exists('mb_strtolower')){
			return mb_strtolower(implode ('/', $strings ) );
		} else {
			return strtolower(implode ('/', $strings ) );
		}


	}
	/* Get parents of category*/
	public function getCategoryRecurse($retinashop_category_id,$catMenuId,$first=true ) {
		static $idsArr = array();
		if ($first==true) $idsArr = array();

		$db			= JFactory::getDBO();
		$q = "SELECT `category_child_id` AS `child`, `category_parent_id` AS `parent`
				FROM  #__retinashop_category_categories AS `xref`
				WHERE `xref`.`category_child_id`= ".(int)$retinashop_category_id;
		$db->setQuery($q);
		$ids = $db->loadObject();
		if (isset ($ids->child)) {
			$idsArr[] = $ids->child;
			if($ids->parent != 0 and $catMenuId != $retinashop_category_id and $catMenuId != $ids->parent) {
				$this->getCategoryRecurse($ids->parent,$catMenuId,false);
			}
		}
		return $idsArr ;
	}
	/* return id of categories
	 * $names are segments
	 * $retinashop_category_ids is retina menu retinashop_category_id
	 */
	public function getCategoryId($slug,$retinashop_category_id ){
		$db = JFactory::getDBO();
			$q = "SELECT `retinashop_category_id`
				FROM  `#__retinashop_categories_".$this->rslang."`
				WHERE `slug` LIKE '".$db->getEscaped($slug)."' ";

			$db->setQuery($q);
			if (!$category_id = $db->loadResult()) {
				$category_id = $retinashop_category_id;
			}

		return $category_id ;
	}

	/* Get URL safe Product name */
	public function getProductName($id){
		$db = JFactory::getDBO();
		$query = 'SELECT `slug` FROM `#__retinashop_products_'.$this->rslang.'`  ' .
		' WHERE `retinashop_product_id` = ' . (int) $id;

		$db->setQuery($query);

		return $db->loadResult().$this->seo_sufix;
	}

	var $counter = 0;
	/* Get parent Product first found category ID */
	public function getParentProductcategory($id){

		$retinashop_category_id = 0;
		$db			= JFactory::getDBO();
		$query = 'SELECT `product_parent_id` FROM `#__retinashop_products`  ' .
			' WHERE `retinashop_product_id` = ' . (int) $id;
		$db->setQuery($query);
		/* If product is child then get parent category ID*/
		if ($parent_id = $db->loadResult()) {
			$query = 'SELECT `retinashop_category_id` FROM `#__retinashop_product_categories`  ' .
				' WHERE `retinashop_product_id` = ' . $parent_id;
			$db->setQuery($query);

			//When the child and parent id is the same, this creates a deadlock
			//add $counter, dont allow more then 10 levels
			if (!$retinashop_category_id = $db->loadResult()){
				$this->counter++;
				if($this->counter<10){
					$this->getParentProductcategory($parent_id) ;
				}
			}

		}
		$this->counter = 0;
		return $retinashop_category_id ;
	}


	/* get product and category ID */
	public function getProductId($names,$retinashop_category_id = NULL ){
		$productName = array_pop($names);
		$productName =  substr($productName, 0, -(int)$this->seo_sufix_size );
		$product = array();
		$categoryName = end($names);

		$product['retinashop_category_id'] = $this->getCategoryId($categoryName,$retinashop_category_id ) ;
		$db = JFactory::getDBO();
		$q = 'SELECT `p`.`retinashop_product_id`
			FROM `#__retinashop_products_'.$this->rslang.'` AS `p`
			LEFT JOIN `#__retinashop_product_categories` AS `xref` ON `p`.`retinashop_product_id` = `xref`.`retinashop_product_id`
			WHERE `p`.`slug` LIKE "'.$db->getEscaped($productName).'" ';
		//$q .= "	AND `xref`.`retinashop_category_id` = ".(int)$product['retinashop_category_id'];
		$db->setQuery($q);
		$product['retinashop_product_id'] = $db->loadResult();
		/* WARNING product name must be unique or you can't acces the product */

		return $product ;
	}

	/* Get URL safe Manufacturer name */
	public function getManufacturerName($retinashop_manufacturer_id ){
		$db = JFactory::getDBO();
		$query = 'SELECT `slug` FROM `#__retinashop_manufacturers_'.$this->rslang.'` WHERE retinashop_manufacturer_id='.(int)$retinashop_manufacturer_id;
		$db->setQuery($query);

		return $db->loadResult();

	}

	/* Get Manufacturer id */
	public function getManufacturerId($slug ){
		$db = JFactory::getDBO();
		$query = "SELECT `retinashop_manufacturer_id` FROM `#__retinashop_manufacturers_".$this->rslang."` WHERE `slug` LIKE '".$db->getEscaped($slug)."' ";
		$db->setQuery($query);

		return $db->loadResult();

	}

	/* Set $this-lang (Translator for language from retinashop string) to load only once*/
	private function setLang($instanceKey){

		if ( $this->seo_translate ) {
			/* use translator */
			$lang =JFactory::getLanguage();
			$extension = 'com_retinashop.sef';
			$base_dir = RPATH_SITE;
			$lang->load($extension, $base_dir);

		}
	}

	/* Set $this->menu with the element ID from retina Menus */
	private function setMenuelementIdJ17(){

		$home 	= false ;
		$component	= JComponentHelper::getComponent('com_retinashop');

		//else $elements = $menus->getelements('component_id', $component->id);
		//get all rs menus

		$db			= JFactory::getDBO();
		$query = 'SELECT * FROM `#__menu`  where `link` like "index.php?option=com_retinashop%" and client_id=0 and published=1 and (language="*" or language="'.$this->langTag.'")'  ;
		$db->setQuery($query);
// 		rsdebug('setMenuelementIdJ17 q',$query);
		$this->menurselements= $db->loadObjectList();
		$homeid =0;
		if(empty($this->menurselements)){
			rsWarn(RText::_('COM_RETINASHOP_ASSIGN_rs_TO_MENU'));
		} else {


			// Search  retinashop elementID in retina menu
			foreach ($this->menurselements as $element)	{
				$linkToSplit= explode ('&',$element->link);

				$link =array();
				foreach ($linkToSplit as $tosplit) {
					$splitpos = strpos($tosplit, '=');
					$link[ (substr($tosplit, 0, $splitpos) ) ] = substr($tosplit, $splitpos+1);
				}
				//rsDebug('menu view link',$link);

				//This is fix to prevent entries in the errorlog.
				if(!empty($link['view'])){
					$view = $link['view'] ;
					if (array_key_exists($view,$this->dbview) ){
						$dbKey = $this->dbview[$view];
					}
					else {
						$dbKey = false ;
					}

					if ( isset($link['retinashop_'.$dbKey.'_id']) && $dbKey ){
						$this->menu['retinashop_'.$dbKey.'_id'][ $link['retinashop_'.$dbKey.'_id'] ] = $element->id;
					}
					elseif ($home == $view ) continue;
					else $this->menu[$view]= $element->id ;

					if ($element->home === 1) {
						$home = $view;
						$homeid = $element->id;
					}
				} else {
					rsError('$link["view"] is empty');
				}

			}
		}



		// init unsetted views  to defaut front view or nothing(prevent duplicates routes)
		if ( !isset( $this->menu['retinashop']) ) {
			if (isset ($this->menu['retinashop_category_id'][0]) ) {
				$this->menu['retinashop'] = $this->menu['retinashop_category_id'][0] ;
			}else $this->menu['retinashop'] = $homeid;
		}
		// if ( !isset( $this->menu['manufacturer']) ) {
			// $this->menu['manufacturer'] = $this->menu['retinashop'] ;
		// }
		// if ( !isset( $this->menu['vendor']) ) {
			// $this->menu['manufacturer'] = $this->menu['retinashop'] ;
		// }

	}

	/* Set $this->menu with the element ID from retina Menus */
	private function setMenuelementId(){

		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');
		$component	= JComponentHelper::getComponent('com_retinashop');
		$elements = $menus->getelements('componentid', $component->id);

		if(empty($elements)){
			rsWarn(RText::_('COM_RETINASHOP_ASSIGN_rs_TO_MENU'));
		} else {
			// Search  retinashop elementID in retina menu
			foreach ($elements as $element)	{
				$view = $element->query['view'] ;
				if ($view=='retinashop') $this->menu['retinashop'] = $element->id;
				$dbKey = $this->dbview[$view];
				if ( isset($element->query['retinashop_'.$dbKey.'_id']) )
				$this->menu['retinashop_'.$dbKey.'_id'][ $element->query['retinashop_'.$dbKey.'_id'] ] = $element->id;
				else $this->menu[$view]= $element->id ;
			}
		}

		// init unsetted views  to defaut front view or nothing(prevent duplicates routes)
		if ( !isset( $this->menu['retinashop'][0]) ) {
			$this->menu['retinashop'][0] = null;
		}
		if ( !isset( $this->menu['manufacturer']) ) {
			$this->menu['manufacturer'] = $this->menu['retinashop'][0] ;
		}

	}
	/* Set $this->activeMenu to current element ID from retina Menus */
	private function setActiveMenu(){
		if ($this->activeMenu === null ) {
		$menu = JSite::getMenu();
		if ($elementid = JRequest::getInt('elementid',0) ) {
			$menuelement = $menu->getelement($elementid);
		} else {
			$menuelement = $menu->getActive();
		}

			$this->activeMenu = new stdClass();
			$this->activeMenu->view			= (empty($menuelement->query['view'])) ? null : $menuelement->query['view'];
			$this->activeMenu->retinashop_category_id	= (empty($menuelement->query['retinashop_category_id'])) ? 0 : $menuelement->query['retinashop_category_id'];
			$this->activeMenu->retinashop_product_id	= (empty($menuelement->query['retinashop_product_id'])) ? null : $menuelement->query['retinashop_product_id'];
			$this->activeMenu->retinashop_manufacturer_id	= (empty($menuelement->query['retinashop_manufacturer_id'])) ? null : $menuelement->query['retinashop_manufacturer_id'];
			$this->activeMenu->Component	= (empty($menuelement->component)) ? null : $menuelement->component;
		}

	}
	/*
	 * Get language key or use $key in route
	 */
	public function lang($key) {
		if ($this->seo_translate ) {
			$jtext = (strtoupper( $key ) );
			if ($this->Jlang->hasKey('COM_RETINASHOP_SEF_'.$jtext) )
				return RText::_('COM_RETINASHOP_SEF_'.$jtext);
		}
		//falldown
		return $key;
	}
	/*
	 * revert key or use $key in route
	 */
	public function getOrderingKey($key) {
		if ($this->seo_translate ) {
			if ($this->orderings == null) {
				$this->orderings = array(
					'p.retinashop_product_id'=> RText::_('COM_RETINASHOP_SEF_PRODUCT_ID'),
					'product_sku'		=> RText::_('COM_RETINASHOP_SEF_PRODUCT_SKU'),
					'product_price'		=> RText::_('COM_RETINASHOP_SEF_PRODUCT_PRICE'),
					'category_name'		=> RText::_('COM_RETINASHOP_SEF_CATEGORY_NAME'),
					'category_description'=> RText::_('COM_RETINASHOP_SEF_CATEGORY_DESCRIPTION'),
					'mf_name' 			=> RText::_('COM_RETINASHOP_SEF_MF_NAME'),
					'product_s_desc'	=> RText::_('COM_RETINASHOP_SEF_PRODUCT_S_DESC'),
					'product_desc'		=> RText::_('COM_RETINASHOP_SEF_PRODUCT_DESC'),
					'product_weight'	=> RText::_('COM_RETINASHOP_SEF_PRODUCT_WEIGHT'),
					'product_weight_uom'=> RText::_('COM_RETINASHOP_SEF_PRODUCT_WEIGHT_UOM'),
					'product_length'	=> RText::_('COM_RETINASHOP_SEF_PRODUCT_LENGTH'),
					'product_width'		=> RText::_('COM_RETINASHOP_SEF_PRODUCT_WIDTH'),
					'product_height'	=> RText::_('COM_RETINASHOP_SEF_PRODUCT_HEIGHT'),
					'product_lwh_uom'	=> RText::_('COM_RETINASHOP_SEF_PRODUCT_LWH_UOM'),
					'product_in_stock'	=> RText::_('COM_RETINASHOP_SEF_PRODUCT_IN_STOCK'),
					'low_stock_notification'=> RText::_('COM_RETINASHOP_SEF_LOW_STOCK_NOTIFICATION'),
					'product_available_date'=> RText::_('COM_RETINASHOP_SEF_PRODUCT_AVAILABLE_DATE'),
					'product_availability'  => RText::_('COM_RETINASHOP_SEF_PRODUCT_AVAILABILITY'),
					'product_special'	=> RText::_('COM_RETINASHOP_SEF_PRODUCT_SPECIAL'),
					'created_on' 		=> RText::_('COM_RETINASHOP_SEF_CREATED_ON'),
					// 'p.modified_on' 		=> RText::_('COM_RETINASHOP_SEF_MDATE'),
					'product_name'		=> RText::_('COM_RETINASHOP_SEF_PRODUCT_NAME'),
					'product_sales'		=> RText::_('COM_RETINASHOP_SEF_PRODUCT_SALES'),
					'product_unit'		=> RText::_('COM_RETINASHOP_SEF_PRODUCT_UNIT'),
					'product_packaging'	=> RText::_('COM_RETINASHOP_SEF_PRODUCT_PACKAGING'),
					'p.intnotes'			=> RText::_('COM_RETINASHOP_SEF_INTNOTES'),
					'ordering' => RText::_('COM_RETINASHOP_SEF_ORDERING')
				);
			}
			if ($result = array_search($key,$this->orderings )) {
				return $result;
			}
		}
		return $key;
	}
	/*
	 * revert string key or use $key in route
	 */
	public function compareKey($string, $key) {
		if ($this->seo_translate ) {
			if (RText::_('COM_RETINASHOP_SEF_'.$key) == $string )
			{
				return true;
			}

		}
		if ($string == $key) return true;
		return false;
	}
}

// pure php no closing tag