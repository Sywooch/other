<?php
/**
*
* Contains shop functions for the front-end
*
* @package	Magazin
* @subpackage Helpers
*
* @author RolandD
* @author Max Milbers
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: shopfunctionsf.php 5905 2012-04-15 22:17:57Z electrocity $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');


class shopFunctionsF {

	/**
	 *
	 */

	public function getLoginForm($cart=false,$order=false){


		if(!class_exists('retinashopViewUser')) require(RPATH_rs_SITE . DS . 'views' . DS . 'user' .DS. 'view.html.php');
		$view = new retinashopViewUser();
		$view -> setLayout('login');

		$show=true;
		if($cart){
			$show = rsConfig::get('oncheckout_show_register', 1);
// 			$user = $cart->userDetails->JUser;	//Makes not really sense, because this information in not updated in the cart
		}

		$user = JFactory::getUser();
		$view->assignRef('JUser',$user);

		$view->assignRef('show',$show);

		$view->assignRef('order',$order);
		$view->assignRef('from_cart',$cart);
		ob_start();
		$view->display();
		$body = ob_get_contents();
		ob_end_clean();

		return $body;
	}

	/**
	 * @author Max Milbers
	 */
	public function getLastVisitedCategoryId(){

		$session = JFactory::getSession();
		return $session->get('rslastvisitedcategoryid', 0, 'rs');

	}

	/**
	 * @author Max Milbers
	 */
	public function setLastVisitedCategoryId($categoryId){
		$session = JFactory::getSession();
		return $session->set('rslastvisitedcategoryid', (int) $categoryId, 'rs');

	}

	/**
	 *
	 * @author Max Milbers
	 */
	public function addProductToRecent($productId){
		$session = JFactory::getSession();
		$products_ids = $session->get('rslastvisitedproductids', array(), 'rs');
		$key = array_search($productId,$products_ids);
		if($key!==FALSE){
			unset($products_ids[$key]);
		}
		array_unshift($products_ids,$productId);
		$products_ids = array_unique($products_ids);

		$maxSize = rsConfig::get('max_recent_products',3);
		if(count($products_ids)>$maxSize){
			array_splice($products_ids,$maxSize);
		}

		return $session->set('rslastvisitedproductids', $products_ids, 'rs');
	}

	/**
	 * Gives ids the recently by the shopper visited products
	 *
	 * @author Max Milbers
	 */
	public function getRecentProductIds(){
		$session = JFactory::getSession();
		return $session->get('rslastvisitedproductids', array(), 'rs');
	}


	/**
	* function to create a hyperlink
	*
	* @author RolandD
	* @param string $link
	* @param string $text
	* @param string $target
	* @param string $title
	* @param array $attributes
	* @return string
	*/
	public function hyperLink( $link, $text, $target='', $title='', $attributes='' ) {
		$options = array();
		if( $target ) {
			$options['target'] = $target;
		}
		if( $title ) {
			$options['title'] = $title;
		}
		if( $attributes ) {
			$options = array_merge($options, $attributes);
		}
		return JHTML::_('link', $link, $text, $options);
	}

	/**
	* A function to create a XHTML compliant and JS-disabled-safe pop-up link
	*
	* @author RolandD
	* @param string $link The HREF attribute
	* @param string $text The link text
	* @param int $popupWidth
	* @param int $popupHeight
	* @param string $target The value of the target attribute
	* @param string $title
	* @param string $windowAttributes
	* @return string
	*/
	public function rsPopupLink( $link, $text, $popupWidth=640, $popupHeight=480, $target='_blank', $title='', $windowAttributes='' ) {
		if( $windowAttributes ) {
			$windowAttributes = ','.$windowAttributes;
		}
		return self::hyperLink( $link, $text, '', $title, array("onclick" => "void window.open('$link', '$target', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=$popupWidth,height=$popupHeight,directories=no,location=no".$windowAttributes."');return false;" ));

	}


	/**
	 * Prepares a view for rendering email, then renders and sends
	 *
	 * @param object $controller
	 * @param string $viewName View which will render the email
	 * @param string $recipient shopper@whatever.com
	 * @param array $vars variables to assign to the view
	 */
	public function renderMail ($viewName, $recipient, $vars=array(),$controllerName = null,$noVendorMail = false) {
		if(!class_exists('retinashopControllerretinashop')) require(RPATH_rs_SITE.DS.'controllers'.DS.'retinashop.php');
// 		$format = (rsConfig::get('order_html_email',1)) ? 'html' : 'raw';

		$controller = new retinashopControllerretinashop();
		//Todo, do we need that? refering to http://forum.retinashop.net/index.php?topic=96318.msg317277#msg317277
		$controller->addViewPath(RPATH_rs_SITE.DS.'views');

		$view = $controller->getView($viewName, 'html');
		if (!$controllerName) $controllerName = $viewName;
		$controllerClassName = 'retinashopController'.ucfirst ($controllerName) ;
		if (!class_exists($controllerClassName)) require(RPATH_rs_SITE.DS.'controllers'.DS.$controllerName.'.php');

		//Todo, do we need that? refering to http://forum.retinashop.net/index.php?topic=96318.msg317277#msg317277
		$view->addTemplatePath(RPATH_rs_SITE.'/views/'.$viewName.'/tmpl');

		$rstemplate = rsConfig::get('rstemplate','default');
		if($rstemplate=='default'){
			$app = JFactory::getApplication('site');
			if(Jrs_VERSION == 2){
				$q = 'SELECT `template` FROM `#__template_styles` WHERE `client_id`="0" AND `home`="1"';
			} else {
				$q = 'SELECT `template` FROM `#__design1_menu` WHERE `client_id`="0" AND `menuid`="0"';
			}

			$db = JFactory::getDbo();
			$db->setQuery($q);
			$template = $db->loadResult();
		} else {
			$template = $rstemplate;
		}

		if($template){
			$view->addTemplatePath(RPATH_ROOT.DS.'design1'.DS.$template.DS.'html'.DS.'com_retinashop'.DS.$viewName);
		} else {
			if(isset($db)){
				$err = $db->getErrorMsg() ;
			} else {
				$err = 'The selected rstemplate is not existing';
			}
			if($err) rsError('renderMail get Template failed: '.$err);
		}

		//rsdebug('renderMail my $view for the view',$view);
		foreach ($vars as $key => $val) {
			$view->$key = $val;
		}
		$user= self::sendrsMail($view, $recipient,$noVendorMail);
		if (isset($view->doVendor) && !$noVendorMail) {
			self::sendrsMail($view, $view->vendorEmail, true);
		}
		return $user ;

	}


	/**
	 * With this function you can use a view to sent it by email.
	 * Just use a task in a controller todo the rendering of the email.
	 *
	 * @param string $view for example user, cart
	 * @param string $recipient shopper@whatever.com
	 * @param bool $vendor true for notifying vendor of user action (e.g. registration)
	 */
	private function sendrsMail (&$view, $recipient, $vendor=false) {
		$jlang =JFactory::getLanguage();
		$jlang->load('com_retinashop', RPATH_SITE, 'en-GB', true);
		$jlang->load('com_retinashop', RPATH_SITE, $jlang->getDefault(), true);
		$jlang->load('com_retinashop', RPATH_SITE, null, true);

		ob_start();
		$view->renderMailLayout($vendor, $recipient);
		$body = ob_get_contents();
		ob_end_clean();

		$subject = (isset($view->subject)) ? $view->subject : RText::_('COM_RETINASHOP_DEFAULT_MESSAGE_SUBJECT');
		$mailer = JFactory::getMailer();
		$mailer->addRecipient($recipient);
		$mailer->setSubject($subject);
		$mailer->isHTML(rsConfig::get('order_mail_html',true));
		$mailer->setBody($body);

		if(!$vendor){
			$replyto[0]=$view->vendorEmail;
			$replyto[1]= $view->vendor->vendor_name;
			$mailer->addReplyTo($replyto);
		}
// 		if (isset($view->replyTo)) {
// 			$mailer->addReplyTo($view->replyTo);
// 		}

		if (isset($view->mediaToSend)) {
			foreach ((array)$view->mediaToSend as $media) {
				//Todo test and such things.
				$mailer->addAttachment($media);
			}
		}

		return $mailer->Send();
	}


	/**
	 * This function sets the right template on the view
	 * @author Max Milbers
	 */
	function setrsTemplate($view,$catTpl=0,$prodTpl=0,$catLayout=0,$prodLayout=0){

		//Lets get here the template set in the shopconfig, if there is nothing set, get the retina standard
		$template = rsConfig::get('rstemplate','default');
		$db = JFactory::getDBO();
		//Set specific category template
		if(!empty($catTpl) && empty($prodTpl)){
			if(is_Int($catTpl)){
				$q = 'SELECT `category_template` FROM `#__retinashop_categories` WHERE `retinashop_category_id` = "'.(int)$catTpl.'" ';
				$db->setQuery($q);
				$temp = $db->loadResult();
				if (!empty($temp)) $template = $temp;
			} else {
				$template = $catTpl;
			}
		}

		//Set specific product template
		if(!empty($prodTpl)){
			if(is_Int($prodTpl)){
				$q = 'SELECT `product_template` FROM `#__retinashop_products` WHERE `retinashop_product_id` = "'.(int)$prodTpl.'" ';
				$db->setQuery($q);
				$temp = $db->loadResult();
				if (!empty($temp)) $template = $temp;
			} else {
				$template = $prodTpl;
			}
		}

		shopFunctionsF::setTemplate($template);

		//Lets get here the layout set in the shopconfig, if there is nothing set, get the retina standard
		if(JRequest::getWord('view')=='retinashop'){
			$layout = rsConfig::get('rslayout','default');
			$view->setLayout(strtolower($layout));
		} else {
			//Set specific category layout
			if(!empty($catLayout) && empty($prodLayout)){
				if(is_Int($catLayout)){
					$q = 'SELECT `layout` FROM `#__retinashop_categories` WHERE `retinashop_category_id` = "'.(int)$catLayout.'" ';
					$db->setQuery($q);
					$temp = $db->loadResult();
					if (!empty($temp)) $layout = $temp;
				} else {
					$layout = $catLayout;
				}
			}

			//Set specific product layout
			if(!empty($prodLayout)){
				if(is_Int($prodLayout)){
					$q = 'SELECT `layout` FROM `#__retinashop_products` WHERE `retinashop_product_id` = "'.(int)$prodLayout.'" ';
					$db->setQuery($q);
					$temp = $db->loadResult();
					if (!empty($temp)) $layout = $temp;
				} else {
					$layout = $prodLayout;
				}
			}
		}

		if(!empty($layout)){
			$view->setLayout(strtolower($layout));
		}


	}

	/**
	 * Final setting of template
	 *
	 * @author Max Milbers
	 */
	function setTemplate( $template ){

		if(!empty($template) && $template!='default'){
			if (is_dir(RPATH_THEMES.DS.$template)) {
				//$this->addTemplatePath(RPATH_THEMES.DS.$template);
				$mainframe = JFactory::getApplication('site');
				$mainframe->set('setTemplate', $template);
			} else{
				JError::raiseWarning(412,'The choosen template couldnt found on the filemain: '.$template);
			}
		} else{
				//JError::raiseWarning('No template set : '.$template);
		}
	}

	/**
	 *
	 * Enter description here ...
	 * @author Max Milbers
	 * @author Iysov
	 * @param string $string
	 * @param int $maxlength
	 * @param string $suffix
	 */
	public function limitStringByWord($string, $maxlength, $suffix=''){
		if(function_exists('mb_strlen')) {
			/* use multibyte functions by Iysov*/
			if(mb_strlen($string)<=$maxlength) return $string;
			$string = mb_substr($string,0,$maxlength);
			$index = mb_strrpos($string, ' ');
			if($index===FALSE) {
				return $string;
			} else {
				return mb_substr($string,0,$index).$suffix;
			}
		} else { /* original code here */
			if(strlen($string)<=$maxlength) return $string;
			$string = substr($string,0,$maxlength);
			$index = strrpos($string, ' ');
			if($index===FALSE) {
				return $string;
			} else {
				return substr($string,0,$index).$suffix;
			}
		}
	}

	/**
	 * Admin UI Tabs
	 * Gives A Tab Based Navigation Back And Loads The design1 With A Nice Design
	 * @param $load_template = a key => value array. key = template name, value = Language File contraction
	 * @example 'shop' => 'COM_RETINASHOP_ADMIN_CFG_SHOPTAB'
	 */
	function buildTabs($load_template = array()) {
		$document = JFactory::getDocument ();
		$document->addScript ( JURI::base () . 'components/com_retinashop/retina_097115115101116115/js/tabs.js' );

		$html = '<div id="ui-tabs">';
		$i = 1;
		foreach ( $load_template as $tab_content => $tab_title ) {
			$html .= '<div id="tab-' . $i . '" class="tabs" title="' . RText::_ ( $tab_title ) . '">';
			$html .= $this->loadTemplate ( $tab_content );
			$html .= '<div class="clear"></div>
			    </div>';
			$i ++;
		}
		$html .= '</div>';
		echo $html;
	}
	/**
	 * Align in plain text the strings
	 * $string text to resize
	 * $size, number of char
	 * $toUpper uppercase Y/N ?
	 * @author kohl patrick
	 */
	function tabPrint( $size, $string,$header = false){
		if ($header) $string = strtoupper (RText::_($string ) );
		sprintf("%".$size.".".$size."s",$string ) ;

	}
	function toupper($strings) {
		foreach ($strings as &$string) {
			$string = strtoupper (RText::_($string ) );
		}
		return $strings;

	}


	function getComUserOption() {
	 if ( Jrs_VERSION===1 ) {
		return 'com_user';
	    } else {
		return 'com_users';
	    }
	}

	/**
	 * Checks if retina language keys exist and combines it according to existing keys.
	 * @string $pkey : primary string to search for Language key (must have %s in the string to work)
	 * @string $skey : secondary string to search for Language key
	 * @return string
	 * @author Max Milbers
	 * @author Patrick Kohl
	 */
	function translateTwoLangKeys($pkey,$skey){
		$upper = strtoupper($pkey).'_2STRINGS';
		if( RText::_($upper) !== $upper ) {
			return RText::sprintf($upper,RText::_($skey));
		} else {
			return RText::_($pkey).' '.RText::_($skey);
		}
	}

	/**
	* Writes a PDF icon
	* @author Patrick Kohl
	* @param string $link
	* @param boolean $use_icon
	* @deprecated
	*/
	function PdfIcon( $link, $use_icon=true,$modal=true ) {

		return rsView::linkIcon($link,'COM_RETINASHOP_PDF','pdf_button','pdf_button_enable',$modal,$use_icon);

	}

	/**
	 * Writes an Email icon
	 * @author Patrick Kohl
	 * @param string $link
	 * @param boolean $use_icon
	 * @deprecated
	 */
	function EmailIcon( $retinashop_product_id, $use_icon,$modal ) {
		if ($retinashop_product_id > 0  ) {
			$link = 'index.php?option=com_retinashop&view=productdetails&task=recommend&retinashop_product_id='.$retinashop_product_id.'&tmpl=component' ;
			return rsView::linkIcon($link,'COM_RETINASHOP_EMAIL','emailButton','show_emailfriend',$modal ,$use_icon);
		}
	}

	/**
	 * @author RolandD, Christopher Roussel
	 *
	 * @deprecated
	 */
	function PrintIcon( $link='', $use_icon=true, $add_text='' ) {

		if (rsConfig::get('show_printicon', 1) == '1') {

			$folder = (rsConfig::isJ15()) ? '/images/M_images/' : '/media/main/images/';

			// checks template image directory for image, if non found default are loaded
			if ( $use_icon ) {
				$filter = JFilterInput::getInstance();
				$text = JHtml::_('image.site', 'printButton.png', $folder, null, null, RText::_('COM_RETINASHOP_PRINT'));
				$text .= $filter->clean($add_text);
			} else {
				$text = '|&nbsp;'. RText::_('COM_RETINASHOP_PRINT'). '&nbsp;|';
			}
			$isPopup = JRequest::getVar( 'pop' );
			if ( $isPopup ) {
				// Print Preview button - used when viewing page
				$html = '<span class="rsNoPrint">
					<a href="javascript:void(0)" onclick="javascript:window.print(); return false;" title="'. RText::_('COM_RETINASHOP_PRINT').'">
					'. $text .'
					</a></span>';
				return $html;
			} else {
				// Print Button - used in pop-up window
				return self::rsPopupLink($link, $text, 640, 480, '_blank', RText::_('COM_RETINASHOP_PRINT'));
			}
		}

	}
}