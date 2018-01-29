<?php
/**
 * @package		Retina.Site
 * 
 * 
 */

defined('_REXEC') or die;

/**
 * @param	array
 * @return	array
 */
function SearchBuildRoute(&$query)
{
	$segments = array();

	if (isset($query['view'])) {
		unset($query['view']);
	}
	return $segments;
}

/**
 * @param	array
 * @return	array
 */
function SearchParseRoute($segments)
{
	$vars = array();

	$searchword	= array_shift($segments);
	$vars['searchword'] = $searchword;
	$vars['view'] = 'search';

	return $vars;
}
