<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_syndicate
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

class modSyndicateHelper
{
	static function getLink(&$params)
	{
		$document = JFactory::getDocument();

		foreach($document->_links as $link => $value)
		{
			$value = JArrayHelper::toString($value);
			if (strpos($value, 'application/'.$params->get('format').'+xml')) {
				return $link;
			}
		}

	}
}
