<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once ( dirname(__FILE__) .'/helper.php' );

//CFactory::load( 'helpers' , 'string' );

$modActiveGroupsHelper =  new modActiveGroupsHelper();
$groups	= $modActiveGroupsHelper->getGroupsData( $params );

require(JModuleHelper::getLayoutPath('mod_activegroups'));

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root(true).'/components/com_community/assets/modules/module.css');
