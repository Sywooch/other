<?php
/**
*
* State controller
*
* @package	Magazin
* @subpackage State
* @author jseros, RickG, Max Milbers
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: state.php 5399 2012-02-08 19:29:45Z Milbo $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

// Load the controller framework
jimport('retina.application.component.controller');

if(!class_exists('retinashopModelState')) require( RPATH_rs_admin.DS.'models'.DS.'state.php' );

class retinashopControllerState extends JController
{
    /**
	 * Method to display the view
	 *
	 * @access	public
	 * @author RickG, Max Milbers
	 */
	public function __construct() {
		parent::__construct();

		$stateModel = rsModel::getModel('state');
		$states = array();

		//retrieving countries id
		$countries = JRequest::getString('retinashop_country_id');
		$countries = explode(',', $countries);

		foreach($countries as $country){
			$states[$country] = $stateModel->getStates( JFilterInput::clean($country, 'INTEGER'),true );
		}
		echo json_encode($states);

		jExit();
	}

}