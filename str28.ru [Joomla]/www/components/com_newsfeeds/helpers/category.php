<?php
/**
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Component Helper
jimport('retina.application.component.helper');
jimport('retina.application.categories');

/**
 * Content Component Category Tree
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * @since 1.6
 */
class NewsfeedsCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__newsfeeds';
		$options['extension'] = 'com_newsfeeds';
		$options['statefield'] = 'published';
		parent::__construct($options);
	}
}
