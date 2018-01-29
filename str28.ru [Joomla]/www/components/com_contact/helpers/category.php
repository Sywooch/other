<?php
/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Component Helper
jimport('retina.application.component.helper');
jimport('retina.application.categories');

/**
 * Contact Component Category Tree
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_contact
 * @since 1.6
 */
class ContactCategories extends JCategories
{
	public function __construct($options = array())
	{
		$options['table'] = '#__contact_details';
		$options['extension'] = 'com_contact';
		$options['statefield'] = 'published';
		parent::__construct($options);
	}
}
