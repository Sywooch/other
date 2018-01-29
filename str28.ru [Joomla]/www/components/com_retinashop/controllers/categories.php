<?php
/**
*
* Description
*
* @package	Magazin
* @subpackage
* @author Max Milbers
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: category.php 2641 2010-11-09 19:25:13Z milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the controller framework
jimport('retina.application.component.controller');

/**
* Class Description
*
* @package retinashop
* @author Max Milbers
*/
class retinashopControllerCategories extends JController {


	public function display(){
		$safeurlparams = array('retinashop_category_id'=>'INT','return'=>'BASE64','lang'=>'CMD');
		parent::display(true, $safeurlparams);
	}

	public function json(){


		$view = $this->getView('categories', 'json');

		$layoutName = JRequest::getWord('layout', 'default');
		$view->setLayout($layoutName);

		// Display it all
		$view->display();

	}
}
// pure php no closing tag
