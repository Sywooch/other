<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_search
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

/**
 * @package		Retina.Site
 * @subpackage	mod_search
 * @since		1.5
 */
class modSearchHelper
{
	/**
	 * Display the search button as an image.
	 *
	 * @param	string	$button_text	The alt text for the button.
	 *
	 * @return	string	The HTML for the image.
	 * @since	1.5
	 */
	public static function getSearchImage($button_text)
	{
		$img = JHtml::_('image', 'searchButton.gif', $button_text, NULL, true, true);
		return $img;
	}
}
