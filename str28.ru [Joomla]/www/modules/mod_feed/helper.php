<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_feed
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

class modFeedHelper
{
	static function getFeed($params)
	{
		// module params
		$rssurl	= $params->get('rssurl', '');

		//  get RSS parsed object
		$options = array();
		$options['rssUrl']		= $rssurl;
		if ($params->get('cache')) {
			$options['cache_time']  = $params->get('cache_time', 15) ;
			$options['cache_time']	*= 60;
		} else {
			$options['cache_time'] = null;
		}

		$rssDoc = JFactory::getXMLParser('RSS', $options);

		$feed = new stdclass();

		if ($rssDoc != false)
		{
			// channel header and link
			$feed->title = $rssDoc->get_title();
			$feed->link = $rssDoc->get_link();
			$feed->description = $rssDoc->get_description();

			// channel image if exists
			$feed->image->url = $rssDoc->get_image_url();
			$feed->image->title = $rssDoc->get_image_title();

			// elements
			$elements = $rssDoc->get_elements();

			// feed elements
			$feed->elements = array_slice($elements, 0, $params->get('rsselements', 5));
		} else {
			$feed = false;
		}

		return $feed;
	}
}
