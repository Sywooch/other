<?php
/**
 * @package		Retina.Site
 * @subpackage	com_banners
 * 
 * 
 */

defined('_REXEC') or die;

/**
 * @package		Retina.Site
 * @subpackage	com_banners
 */
abstract class BannerHelper
{
	/**
	 * Checks if a URL is an image
	 *
	 * @param string
	 * @return URL
	 */
	public static function isImage($url)
	{
		$result = preg_match('#\.(?:bmp|gif|jpe?g|png)$#i', $url);
		return $result;
	}

	/**
	 * Checks if a URL is a Flash file
	 *
	 * @param string
	 * @return URL
	 */
	public static function isFlash($url)
	{
		$result = preg_match('#\.swf$#i', $url);
		return $result;
	}
}
