<?php
/**
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Component Helper
jimport('retina.application.component.helper');
jimport('retina.application.categories');

/**
 * Weblinks Component Category Tree
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * @since 1.6
 */
class WeblinksCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__weblinks';
		$options['extension'] = 'com_weblinks';
		parent::__construct($options);
	}
}
