<?php
/**
 * @package		Retina.Site
 * @subpackage	com_banners
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Component Helper
jimport('retina.application.component.helper');
jimport('retina.application.categories');

/**
 * Banners Component Category Tree
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_banners
 * @since 1.6
 */
class BannersCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__banners';
		$options['extension'] = 'com_banners';
		parent::__construct($options);
	}
}
