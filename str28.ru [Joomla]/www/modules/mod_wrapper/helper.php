<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_wrapper
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

class modWrapperHelper
{
	static function getParams(&$params)
	{
		$params->def('url', '');
		$params->def('scrolling', 'auto');
		$params->def('height', '200');
		$params->def('height_auto', '0');
		$params->def('width', '100%');
		$params->def('add', '1');
		$params->def('name', 'wrapper');

		$url = $params->get('url');

		if ($params->get('add'))
		{
			// adds 'http://' if none is set
			if (substr($url, 0, 1) == '/') {
				// relative url in component. use server http_host.
				$url = 'http://'.$_SERVER['HTTP_HOST'].$url;
			}
			elseif (!strstr($url, 'http') && !strstr($url, 'https')) {
				$url = 'http://'.$url;
			}
			else {
				$url = $url;
			}
		}

		// auto height control
		if ($params->def('height_auto')) {
			$load = 'onload="iFrameHeight()"';
		}
		else {
			$load = '';
		}

		$params->set('load', $load);
		$params->set('url', $url);

		return $params;
	}
}
