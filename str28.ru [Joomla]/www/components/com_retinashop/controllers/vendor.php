<?php
/**
*
* Controller for the front end Manufacturerviews
*
* @package	Magazin
* @subpackage User
* @author Oscar van Eijk
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: manufacturer.php 2420 2010-06-01 21:12:57Z oscar $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the controller framework
jimport('retina.application.component.controller');

/**
 * retinashop Component Controller
 *
 * @package		retinashop
 */
class retinashopControllerVendor extends JController
{

	/**
	* Send the ask question email.
	* @author Kohl Patrick, Christopher Roussel
	*/
	public function mailAskquestion () {

		JRequest::checkToken() or jexit( 'Invalid Token' );

		if(!class_exists('shopFunctionsF')) require(RPATH_rs_SITE.DS.'helpers'.DS.'shopfunctionsf.php');
		$this->addModelPath(RPATH_rs_admin.DS.'models');
		$model = rsModel::getModel('vendor');
		$mainframe = JFactory::getApplication();
		$vars = array();
		$min = rsConfig::get('rs_asks_minimum_comment_length', 50)+1;
		$max = rsConfig::get('rs_asks_maximum_comment_length', 2000)-1 ;
		$commentSize = mb_strlen( JRequest::getString('comment') );
		$validMail = filter_var(JRequest::getVar('email'), FILTER_VALIDATE_EMAIL);

		$retinashop_vendor_id = JRequest::getInt('retinashop_vendor_id');

		$userId = $model->getUserIdByVendorId($retinashop_vendor_id);

		$vendorUser = JFactory::getUser($userId);

		if ( $commentSize<$min || $commentSize>$max || !$validMail ) {
			$this->setRedirect(JRoute::_ ( 'index.php?option=com_retinashop&view=vendor&task=contact&retinashop_vendor_id=' . $retinashop_vendor_id ),RText::_('COM_RETINASHOP_COMMENT_NOT_VALID_JS'));
			return ;
		}

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

		$VendorEmail = $model->getVendorEmail($retinashop_vendor_id);
		$vars['vendor'] = array('vendor_store_name' => $fromName );

		if (shopFunctionsF::renderMail('vendor', $VendorEmail, $vars,'vendor')) {
			$string = 'COM_RETINASHOP_MAIL_SEND_SUCCESSFULLY';
		}
		else {
			$string = 'COM_RETINASHOP_MAIL_NOT_SEND_SUCCESSFULLY';
		}
		$mainframe->enqueueMessage(RText::_($string));

		// Display it all
		$view = $this->getView('vendor', 'html');

		$view->setLayout('mail_confirmed');
		$view->display();
	}

}

// No closing tag
