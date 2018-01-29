<?php
if( !defined( '_REXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: retinashop.php 5906 2012-04-16 10:25:00Z Milbo $
* @package retinashop
* @subpackage core
* @author Max Milbers
* @copyright Copyright (C) 2009-11 by the authors of the retinashop Team listed at /admin/com_retinashop/copyright.php - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /admin/components/com_retinashop/COPYRIGHT.php for copyright notices and details.
*
* http://retinashop.net
*/

/* Require the config */

//Console::logSpeed('retinashop start');

if (!class_exists( 'rsConfig' )) require(RPATH_admin . DS . 'components' . DS . 'com_retinashop'.DS.'helpers'.DS.'config.php');
rsConfig::loadConfig();

rsRam('Start');
// rsSetStartTime();
rsSetStartTime('Start');

if(rsConfig::get('enableEnglish', 1)){
    $jlang =JFactory::getLanguage();
    $jlang->load('com_retinashop', RPATH_SITE, 'en-GB', true);
    $jlang->load('com_retinashop', RPATH_SITE, $jlang->getDefault(), true);
    $jlang->load('com_retinashop', RPATH_SITE, null, true);
}
if(rsConfig::get('shop_is_offline',0)){
	$_controller = 'retinashop';
	require (RPATH_rs_SITE.DS.'controllers'.DS.'retinashop.php');
	JRequest::setVar('view', 'retinashop');
	$task='';
} else {

	//Lets load first englisch, then retina default standard, then user language.
	 $jlang =JFactory::getLanguage();
	 $jlang->load('com_retinashop', RPATH_SITE, 'en-GB', true);
	 $jlang->load('com_retinashop', RPATH_SITE, $jlang->getDefault(), true);
	 $jlang->load('com_retinashop', RPATH_SITE, null, true);

	/* Front-end helpers */
	if(!class_exists('rsImage')) require(RPATH_rs_admin.DS.'helpers'.DS.'image.php'); //dont remove that file it is actually in every view except the state view
	if(!class_exists('shopFunctionsF'))require(RPATH_rs_SITE.DS.'helpers'.DS.'shopfunctionsf.php'); //dont remove that file it is actually in every view
	if (!class_exists( 'rsModel' )) require(RPATH_rs_admin.DS.'helpers'.DS.'rsmodel.php');


	/* Loading jQuery and rs scripts. */
	rsJsApi::jQuery();
	rsJsApi::jSite();
	rsJsApi::cssSite();
	$_controller = JRequest::getWord('view', JRequest::getWord('controller', 'retinashop')) ;
// 	$task = JRequest::getWord('task',JRequest::getWord('layout',$_controller) );		$this makes trouble!
	$task = JRequest::getWord('task') ;

	if (($_controller == 'product' || $_controller == 'category') && ($task == 'save' || $task == 'edit') ) {
		$app = JFactory::getApplication();

		if ($task == 'save') $app->redirect('index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.JRequest::getInt('retinashop_product_id') );
		else {
			if(!class_exists('Permissions')) require(RPATH_rs_admin.DS.'helpers'.DS.'permissions.php');
			if	(Permissions::getInstance()->check("admin,storeadmin")) {
				 $jlang->load('com_retinashop', RPATH_admin, null, true);
				require (RPATH_rs_admin.DS.'controllers'.DS.$_controller.'.php');
				//require(RPATH_rs_admin.DS.'helpers'.DS.'shopfunctions.php');

			} else {
				$app->redirect('index.php?option=com_retinashop', jText::_('COM_RETINASHOP_RESTRICTED_ACCESS') );
			}
		}


	/* Require specific controller if requested */
	} elseif($_controller) {
		if (file_exists(RPATH_rs_SITE.DS.'controllers'.DS.$_controller.'.php')) {
			// Only if the file exists, since it might be a retina view we're requesting...
			require (RPATH_rs_SITE.DS.'controllers'.DS.$_controller.'.php');
		}
		else {
			// try plugins
			JPluginHelper::importPlugin('rsextended');
			$dispatcher = JDispatcher::getInstance();
			$dispatcher->trigger('onrsSiteController', $_controller);
		}
	}

}

/* Create the controller */
$_class = 'retinashopController'.ucfirst($_controller);
if (class_exists($_class)) {
    $controller = new $_class();

    /* Perform the Request task */
    $controller->execute($task);

    //Console::logSpeed('retinashop start');
    rsTime($_class.' Finished task '.$task,'Start');
    rsRam('End');
    rsRamPeak('Peak');
    /* Redirect if set by the controller */
    $controller->redirect();
} else {
    rsDebug('retinashop controller not found: '. $_class);
    $mainframe = Jfactory::getApplication();
    $mainframe->redirect('index.php?option=com_retinashop');
}
