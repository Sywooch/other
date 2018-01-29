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

class retinashopViewPdf extends rsView
{

	function __construct( $config = array() ) {

		$config['base_path'] = RPATH_COMPONENT_SITE;

		parent::__construct( $config );

	}


	function display($tpl = 'pdf'){

		if(!file_exists(RPATH_rs_LIBRARIES.DS.'tcpdf'.DS.'tcpdf.php')){
			rsError('View pdf: For the pdf invoice, you must install the tcpdf library at '.RPATH_rs_LIBRARIES.DS.'tcpdf');
		} else {
			$viewName = jRequest::getWord('view','productdetails');
			$class= 'retinashopView'.ucfirst($viewName);
			if(!class_exists($class)) require(RPATH_rs_SITE.DS.'views'.DS.$viewName.DS.'view.html.php');
			$view = new $class ;

			$view->display($tpl);
		}

	}

}
