<?php
/**
 * @package		EasyBlog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filesystem.file' );

$path	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php';

if( !JFile::exists( $path ) )
{
	return;
}

require_once( $path );
require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'router.php');
require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'date.php');

EasyBlogHelper::loadHeaders();
EasyBlogHelper::loadModuleCss();

// @task: Load component's language file.
JFactory::getLanguage()->load( 'com_easyblog' , JPATH_ROOT );

$model 	= EasyBlogHelper::getModel( 'Archive' );
$year	= $model->getArchiveMinMaxYear();
$catid	= '?';

if( !$year )
{
	return;
}

$currentMonth	= (int) EasyBlogHelper::getDate()->toFormat( '%m' );
$currentYear	= (int) EasyBlogHelper::getDate()->toFormat( '%Y' );

// @task: Get the count from the module parameters.
$count			= $params->get( 'count' , 0 );

if(!empty($count))
{
	if(($year['maxyear'] - $year['minyear']) > $count)
	{
		$year['minyear'] = $year['maxyear'] - $count;
	}
}

//set default year
$defaultYear	= JRequest::getVar( 'archiveyear' , $year['maxyear'] , 'REQUEST' );

//set default month
$defaultMonth	= JRequest::getVar( 'archivemonth' , 0 , 'REQUEST' );


$menuitemid	= $params->get( 'menuitemid', '');
$menuitemid	= (! empty($menuitemid)) ? '&Itemid='.$menuitemid : '';

//@task: Get the parameter
$showEmptyPost	= $params->get( 'showempty' , 1 );

// @task: Get excluded categories
$excludeCats	= $params->get( 'excatid', array() );
$includeCats	= EasyBlogHelper::getCategoryInclusion( $params->get( 'catid', array() ) );

foreach ($includeCats as $includeCat) {
	$catid .= 'modCid[]=' . $includeCat . '&';
}

//get post count for a particular year
$postCounts		= $model->getArchivePostCounts( $year['minyear'] , $year['maxyear'], $excludeCats, $includeCats );

require( JModuleHelper::getLayoutPath('mod_easyblogarchive') );
