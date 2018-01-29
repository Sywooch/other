<?php
/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.application.categories');

/**
 * Content Component Category Tree
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_content
 * @since 1.6
 */
class ContentCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__content';
		$options['extension'] = 'com_content';
		parent::__construct($options);
	}
}
