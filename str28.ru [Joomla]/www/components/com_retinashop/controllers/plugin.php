<?php defined('_REXEC') or die('Restricted access');
/**
*
* plugin controller
*
* @package	Magazin
* @subpackage Core
* @author Max Milbers
* @link http://www.retinashop.net
* @copyright Copyright (c) 2011 retinashop Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: plugin.php 2641 2010-11-09 19:25:13Z milbo $
*/

jimport('retina.application.component.controller');


/**
 * retinashop default admin controller
 *
 * @package		retinashop
 */
class retinashopControllerPlugin extends JController
{
	/**
	 * Method to render the plugin datas
	 * this is an entry point to plugin to easy renders json or html
	 *
	 *
	 * @access	public
	 */
	function display()
	{


		if (!$type =JRequest::getWord('rstype',null) )
			$type = JRequest::getWord('type', 'rscustom');
		$typeWhiteList = array('rscustom','rscalculation','rsuserfield', 'rspayment', 'rsshipment');
		if(!in_array($type,$typeWhiteList)) return false;

// 		if(!$name = JRequest::getCmd('name', null) ) return $name;

		$name = JRequest::getCmd('name', 'none');

		$nameBlackList = array('plgrsValidateCouponCode','plgrsRemoveCoupon','none');
		if(in_array($name,$nameBlackList)){
			echo 'You got logged';
			return false;
		}

		JPluginHelper::importPlugin($type, $name);
		$dispatcher = JDispatcher::getInstance();
		// if you want only one render simple in the plugin use jExit();
		// or $render is an array of code to echo as html or json Objects!
		$render = null ;
		$dispatcher->trigger('plgrsOnSelfCallFE',array($type, $name, &$render));
		if ( $render ) {
			// Get the document object.
			$document =JFactory::getDocument();
			if (JRequest::getWord('cache') == 'no') {
				JResponse::setHeader('Cache-Control','no-cache, must-revalidate');
				JResponse::setHeader('Expires','Mon, 6 Jul 2000 10:00:00 GMT');
			}
			$format = JRequest::getWord('format', 'json');
			if ($format == 'json') {
				$document->setMimeEncoding('application/json');
				// Change the suggested filename.

				JResponse::setHeader('Content-Disposition','attachment;filename="'.$type.'".json"');
				echo json_encode($render);
			}
			else echo $render;
		}
	}
}
