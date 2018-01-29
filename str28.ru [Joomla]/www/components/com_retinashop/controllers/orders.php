<?php
/**
 *
 * Controller for the front end Orderviews
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
 * @version $Id: orders.php 5444 2012-02-15 15:31:35Z Milbo $
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
class retinashopControllerOrders extends JController
{

	/**
	 * Todo do we need that anylonger? that way.
	 * @see JController::display()
	 */
	public function display() {

		$format = JRequest::getWord('format','html');
		if  ($format == 'pdf') $viewName= 'pdf';
		else $viewName='orders';
		$view = $this->getView($viewName, $format);

		$this->addModelPath(RPATH_admin.DS.'components'.DS.'com_retinashop' . DS . 'models');

		// Display it all
		$view->display();
	}

}

// No closing tag
