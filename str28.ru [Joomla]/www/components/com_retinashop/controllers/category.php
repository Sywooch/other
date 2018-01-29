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
* @version $Id: category.php 5333 2012-01-28 23:57:11Z Milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the controller framework
jimport('retina.application.component.controller');

/**
* Class Description
*
* @package retinashop
* @author RolandD
*/
class retinashopControllerCategory extends JController {

    /**
    * Method Description
    *
    * @access public
    * @author RolandD
    */
    public function __construct() {
     	 parent::__construct();

     	 $this->registerTask('browse','category');
   	}

	/**
	* Function Description
	*
	* @author RolandD
	* @author George
	* @access public
	*/
	public function display() {

		if (JRequest::getvar('search')) {
			$view = $this->getView('category', 'html');
			$view->display();
		} else {
			// Display it all
			$safeurlparams = array('retinashop_category_id'=>'INT','retinashop_manufacturer_id'=>'INT','retinashop_currency_id'=>'INT','return'=>'BASE64','lang'=>'CMD','orderby'=>'CMD','limitstart'=>'CMD','order'=>'CMD','limit'=>'CMD');
			parent::display(true, $safeurlparams);
		}
	}
}
// pure php no closing tag
