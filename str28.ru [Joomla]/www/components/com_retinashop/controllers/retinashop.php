<?php
/**
*
* Base controller Frontend
*
* @package		retinashop
* @subpackage
* @author Max Milbers
* @link http://www.retinashop.net
* @copyright Copyright (c) 2011 retinashop Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: retinashop.php 5310 2012-01-23 21:34:19Z Milbo $
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
class retinashopControllerretinashop extends JController
{

	function __construct() {
		parent::__construct();
		if (rsConfig::get('shop_is_offline') == '1') {
		    JRequest::setVar( 'layout', 'off_line' );
	    }
	    else {
		    JRequest::setVar( 'layout', 'default' );
	    }
	}

	function retinashop() {

		$view = $this->getView(JRequest::getWord('view', 'retinashop'), 'html');

		// Display it all
		$safeurlparams = array('retinashop_category_id'=>'INT','retinashop_currency_id'=>'INT','return'=>'BASE64','lang'=>'CMD');
		parent::display(true, $safeurlparams);//$view->display();
	}
}
 //pure php no closing tag
