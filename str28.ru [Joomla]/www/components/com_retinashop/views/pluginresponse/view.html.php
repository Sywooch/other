<?php
/**
*
* View for the PluginResponse
*
* @package	Magazin
* @subpackage
* @author Valérie Isaksen
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: view.html.php 3386 2011-05-27 12:34:11Z alatak $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the view framework
if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

/**
* View for the shopping cart
* @package retinashop
* @author Valérie Isaksen
*/
class retinashopViewPluginresponse extends rsView {



	public function display($tpl = null) {
		$mainframe = JFactory::getApplication();
		$pathway = $mainframe->getPathway();
		$document = JFactory::getDocument();
//       $paymentResponse = JRequest::getVar('paymentResponse', '');

      //Why do you we allow raw here?
//       $paymentResponseHtml = JRequest::getVar('paymentResponseHtml','','default','STRING',JREQUEST_ALLOWRAW);
		$layoutName = $this->getLayout();



		parent::display($tpl);
	}


}

//no closing tag