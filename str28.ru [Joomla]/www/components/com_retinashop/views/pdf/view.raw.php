<?php
/**
*
* Description
*
* @package	Magazin
* @subpackage
* @author P.Kohl 
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: view.pdf.php 5320 2012-01-25 14:28:40Z Electrocity $
 */
defined('_REXEC') or die;

if(!class_exists('rsView'))require(RPATH_rs_SITE.DS.'helpers'.DS.'rsview.php');

class retinashopViewRaw extends rsView
{

	function display($tpl = 'pdf')
	{
		$type='raw';
		$this->assignRef('type', $type);
		$viewName = jRequest::getWord('view','productdetails');
		$class= 'retinashopView'.ucfirst($viewName);
		if(!class_exists($class)) require(RPATH_rs_SITE.DS.'views'.DS.$viewName.DS.'view.html.php');
		$view = new $class ;
	
		$view->display($tpl);
	}

}
