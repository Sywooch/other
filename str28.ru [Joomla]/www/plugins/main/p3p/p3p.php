<?php
/**
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

/**
 * Retina P3P Header Plugin
 *
 * @package		retina.Plugin
 * @subpackage	main.p3p
 */
class plgmainP3p extends JPlugin
{
	function onAfterInitialise()
	{
		// Get the header
		$header = $this->params->get('header', 'NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM');
		$header = trim($header);
		// Bail out on empty header (why would anyone do that?!)
		if( empty($header) )
		{
			return;
		}
		// Replace any existing P3P headers in the response
		JResponse::setHeader('P3P', 'CP="'.$header.'"', true);
	}
}
