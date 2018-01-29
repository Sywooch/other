<?php
/**
*
* Description
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
* @version $Id: productdetails.php 5815 2012-04-06 11:34:27Z Milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the controller framework
jimport('retina.application.component.controller');

/**
* retinashop Component Controller
*
* @package retinashop
* @author RolandD
*/
class retinashopControllerProductdetails extends JController {

	public function __construct() {
		parent::__construct();
		$this->registerTask( 'recommend','MailForm' );
		$this->registerTask( 'askquestion','MailForm' );
	}

	public function display() {

		$format = JRequest::getWord('format','html');
		if ($format=='pdf') {
			$viewName='Pdf';
		}
		else $viewName='Productdetails';

		$view = $this->getView($viewName, $format);

		$view->display();
	}

	/**
	 * Send the ask question email.
	 * @author Kohl Patrick, Christopher Roussel
	 */
	public function mailAskquestion () {

		JRequest::checkToken() or jexit( 'Invalid Token' );
		if(!class_exists('shopFunctionsF')) require(RPATH_rs_SITE.DS.'helpers'.DS.'shopfunctionsf.php');
		$mainframe = JFactory::getApplication();
		$vars = array();
		$min = rsConfig::get('rs_asks_minimum_comment_length', 50)+1;
		$max = rsConfig::get('rs_asks_maximum_comment_length', 2000)-1 ;
		$commentSize = mb_strlen( JRequest::getString('comment') );
		$validMail = filter_var(JRequest::getVar('email'), FILTER_VALIDATE_EMAIL);
		if ( $commentSize<$min || $commentSize>$max || !$validMail ) {
				$this->setRedirect(JRoute::_ ( 'index.php?option=com_retinashop&tmpl=component&view=productdetails&task=askquestion&retinashop_product_id='.JRequest::getInt('retinashop_product_id',0) ),RText::_('COM_RETINASHOP_COMMENT_NOT_VALID_JS'));
				return ;
		}

		$retinashop_product_idArray = JRequest::getInt('retinashop_product_id',0);
		if(is_array($retinashop_product_idArray)){
			$retinashop_product_id=(int)$retinashop_product_idArray[0];
		} else {
			$retinashop_product_id=(int)$retinashop_product_idArray;
		}
		$productModel = rsModel::getModel('product');

		$vars['product'] = $productModel->getProduct($retinashop_product_id);

		$user = JFactory::getUser();
		if (empty($user->id)) {
			$fromMail = JRequest::getVar('email');	//is sanitized then
			$fromName = JRequest::getVar('name','');//is sanitized then
			$fromMail = str_replace(array('\'','"',',','%','*','/','\\','?','^','`','{','}','|','~'),array(''),$fromMail);
			$fromName = str_replace(array('\'','"',',','%','*','/','\\','?','^','`','{','}','|','~'),array(''),$fromName);
		}
		else {
			$fromMail = $user->email;
			$fromName = $user->name;
	 	}
	 	$vars['user'] = array('name' => $fromName, 'email' => $fromMail);

	 	$vendorModel = rsModel::getModel('vendor');
		$VendorEmail = $vendorModel->getVendorEmail($vars['product']->retinashop_vendor_id);
		$vars['vendor'] = array('vendor_store_name' => $fromName );

		if (shopFunctionsF::renderMail('askquestion', $VendorEmail, $vars,'productdetails')) {
			$string = 'COM_RETINASHOP_MAIL_SEND_SUCCESSFULLY';
		}
		else {
			$string = 'COM_RETINASHOP_MAIL_NOT_SEND_SUCCESSFULLY';
		}
		$mainframe->enqueueMessage(RText::_($string));

		// Display it all
		$view = $this->getView('askquestion', 'html');
		$view->setLayout('mail_confirmed');
		$view->display();
	}

	/**
	 * Send the Recommend to a friend email.
	 * @author Kohl Patrick,
	 */
	public function mailRecommend () {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		if(!class_exists('shopFunctionsF')) require(RPATH_rs_SITE.DS.'helpers'.DS.'shopfunctionsf.php');
		$mainframe = JFactory::getApplication();
		$vars = array();

		$retinashop_product_idArray = JRequest::getInt('retinashop_product_id',0);
		if(is_array($retinashop_product_idArray)){
			$retinashop_product_id=(int)$retinashop_product_idArray[0];
		} else {
			$retinashop_product_id=(int)$retinashop_product_idArray;
		}
		$productModel = rsModel::getModel('product');

		$vars['product'] = $productModel->getProduct($retinashop_product_id);

		$user = JFactory::getUser();
		$fromMail = $user->email;
		$fromName = $user->name;
		$vars['user'] = array('name' => $fromName, 'email' => $fromMail);

	 	$vendorModel = rsModel::getModel('vendor');
		$VendorEmail = $vendorModel->getVendorEmail($vars['product']->retinashop_vendor_id);
		$vars['vendor'] = array('vendor_store_name' => $fromName );

		$TOMail = JRequest::getVar('email');	//is sanitized then
		$TOMail = str_replace(array('\'','"',',','%','*','/','\\','?','^','`','{','}','|','~'),array(''),$TOMail);
		if (shopFunctionsF::renderMail('recommend', $TOMail, $vars,'productdetails',true)) {
			$string = 'COM_RETINASHOP_MAIL_SEND_SUCCESSFULLY';
		}
		else {
			$string = 'COM_RETINASHOP_MAIL_NOT_SEND_SUCCESSFULLY';
		}
		$mainframe->enqueueMessage(RText::_($string));

// 		rsdebug('my email vars ',$vars,$TOMail);
		// Display it all
		$view = $this->getView('recommend', 'html');

		$view->setLayout('mail_confirmed');
		$view->display();
	}

	/**
	 *  Ask Question form
	 * Recommend form for Mail
	 */
	public function MailForm(){

		if (JRequest::getCmd('task') == 'recommend' ) {

			/*OSP 2012-03-14 ...Track #375; allowed by setting */
			if (rsConfig::get('recommend_unauth', 0) == '0')
			{
				$user = JFactory::getUser();
				if (empty($user->id))
				{
					rsInfo(RText::_('YOU MUST LOGIN FIRST'));
					return ;
				}
			}
			$view = $this->getView('recommend', 'html');
		} else {
			$view = $this->getView('askquestion', 'html');
		}

		/* Set the layout */
		$view->setLayout('form');

		// Display it all
		$view->display();
	}

	/* Add or edit a review
	 TODO  control and update in database the review */
	public function review(){

		$data = JRequest::get('post');

		$model = rsModel::getModel('ratings');
		$model->saveRating($data);
		$errors = $model->getErrors();
		if(empty($errors)) $msg = RText::sprintf('COM_RETINASHOP_STRING_SAVED',RText::_('COM_RETINASHOP_REVIEW') );
		foreach($errors as $error){
			$msg = ($error).'<br />';
		}

		$this->setRedirect(JRoute::_ ( 'index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.(int)$data['retinashop_product_id']), $msg);

	}

	/**
	 * Json task for recalculation of prices
	 *
	 * @author Max Milbers
	 * @author Patrick Kohl
	 *
	 */
	public function recalculate(){

		//$post = JRequest::get('request');

//		echo '<pre>'.print_r($post,1).'</pre>';
		jimport( 'retina.utilities.arrayhelper' );
		$retinashop_product_idArray = JRequest::getVar('retinashop_product_id',array());	//is sanitized then
		JArrayHelper::toInteger($retinashop_product_idArray);
		$retinashop_product_id = $retinashop_product_idArray[0];
		$customPrices = array();
		$customVariants = JRequest::getVar('customPrice',array());	//is sanitized then
		foreach($customVariants as $customVariant){
			foreach($customVariant as $priceVariant=>$selected){
				//Important! sanitize array to int
				//JArrayHelper::toInteger($priceVariant);
				$customPrices[$priceVariant]=$selected;
			}
		}
		jimport( 'retina.utilities.arrayhelper' );
		$quantityArray = JRequest::getVar('quantity',array());	//is sanitized then
		JArrayHelper::toInteger($quantityArray);

		$quantity = 1;
		if(!empty($quantityArray[0])){
			$quantity = $quantityArray[0];
		}

		$product_model = rsModel::getModel('product');

		$prices = $product_model->getPrice($retinashop_product_id,$customPrices,$quantity);

		$priceFormated = array();
		if (!class_exists('CurrencyDisplay')) require(RPATH_rs_admin.DS.'helpers'.DS.'currencydisplay.php');
		$currency = CurrencyDisplay::getInstance();
		foreach ( $prices as $name => $product_price  ){
// 		echo 'Price is '.print_r($name,1).'<br />';
			if($name != 'costPrice'){
				$priceFormated[$name] = $currency->createPriceDiv($name,'',$prices,true);
			}
		}

		// Get the document object.
		$document = JFactory::getDocument();
		$document->setName('recalculate');
		JResponse::setHeader('Cache-Control','no-cache, must-revalidate');
		JResponse::setHeader('Expires','Mon, 6 Jul 2000 10:00:00 GMT');
		// Set the MIME type for JSON output.
		$document->setMimeEncoding( 'application/json' );
				JResponse::setHeader('Content-Disposition','attachment;filename="recalculate.json"', true);
				JResponse::sendHeaders();
		echo json_encode ($priceFormated);
		jexit();
	}

	public function getJsonChild() {

	$view = $this->getView('productdetails', 'json');

		$view->display(null);
	}

	/**
	 * Notify customer
	 *
	 * @author Seyi Awofadeju
	 *
	 */
	public function notifycustomer(){
		$data = JRequest::get('post');

		$model = rsModel::getModel('waitinglist');
		if(!$model->adduser($data)) {
			$errors = $model->getErrors();
			foreach($errors as $error){
				$msg = ($error).'<br />';
			}
			$this->setRedirect(JRoute::_ ( 'index.php?option=com_retinashop&view=productdetails&layout=notify&retinashop_product_id='.$data['retinashop_product_id']), $msg);
		} else {
			$msg = RText::sprintf('COM_RETINASHOP_STRING_SAVED',RText::_('COM_RETINASHOP_CART_NOTIFY') );
			$this->setRedirect(JRoute::_ ( 'index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$data['retinashop_product_id']), $msg);
		}


	}

}
// pure php no closing tag
