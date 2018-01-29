<?php
/**
 * @package		Retina.Site
 * @subpackage	com_banners
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.model');
jimport('retina.application.component.helper');

JTable::addIncludePath(RPATH_COMPONENT_admin . '/tables');

/**
 * Banner model for the retina Banners component.
 *
 * @package		Retina.Site
 * @subpackage	com_banners
 */
class BannersModelBanner extends JModel
{
	protected $_element;

	/**
	 * Clicks the URL, incrementing the counter
	 *
	 * @return	void
	 */
	function click()
	{
		$id = $this->getState('banner.id');

		// update click count
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->update('#__banners');
		$query->set('clicks = (clicks + 1)');
		$query->where('id = ' . (int) $id);

		$db->setQuery((string) $query);

		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
		}

		// track clicks

		$element =  $this->getelement();

		$trackClicks = $element->track_clicks;

		if ($trackClicks < 0 && $element->cid) {
			$trackClicks = $element->client_track_clicks;
		}

		if ($trackClicks < 0) {
			$config = JComponentHelper::getParams('com_banners');
			$trackClicks = $config->get('track_clicks');
		}

		if ($trackClicks > 0) {
			$trackDate = JFactory::getDate()->format('Y-m-d H');

			$query->clear();
			$query->select($db->quoteName('count'));
			$query->from('#__banner_tracks');
			$query->where('track_type=2');
			$query->where('banner_id='.(int)$id);
			$query->where('track_date='.$db->Quote($trackDate));

			$db->setQuery((string) $query);

			if (!$db->query()) {
				JError::raiseError(500, $db->getErrorMsg());
			}

			$count = $db->loadResult();

			$query->clear();

			if ($count) {
				// update count
				$query->update('#__banner_tracks');
				$query->set($db->quoteName('count').' = ('.$db->quoteName('count') . ' + 1)');
				$query->where('track_type=2');
				$query->where('banner_id='.(int)$id);
				$query->where('track_date='.$db->Quote($trackDate));
			}
			else {
				// insert new count
				//sqlsrv change
				$query->insert('#__banner_tracks');
				$query->columns(array($db->quoteName('count'), $db->quoteName('track_type'),
								$db->quoteName('banner_id') , $db->quoteName('track_date')));
				$query->values( '1, 2,' . (int)$id . ',' . $db->Quote($trackDate));
			}

			$db->setQuery((string) $query);

			if (!$db->query()) {
				JError::raiseError(500, $db->getErrorMsg());
			}
		}
	}

	/**
	 * Get the data for a banner.
	 *
	 * @return	object
	 */
	function &getelement()
	{
		if (!isset($this->_element))
		{
			$cache = JFactory::getCache('com_banners', '');

			$id = $this->getState('banner.id');

			$this->_element =  $cache->get($id);

			if ($this->_element === false) {
				// redirect to banner url
				$db		= $this->getDbo();
				$query	= $db->getQuery(true);
				$query->select(
					'a.clickurl as clickurl,'.
					'a.cid as cid,'.
					'a.track_clicks as track_clicks'
					);
				$query->from('#__banners as a');
				$query->where('a.id = ' . (int) $id);

				$query->join('LEFT', '#__banner_clients AS cl ON cl.id = a.cid');
				$query->select('cl.track_clicks as client_track_clicks');

				$db->setQuery((string) $query);

				if (!$db->query()) {
					JError::raiseError(500, $db->getErrorMsg());
				}

				$this->_element = $db->loadObject();
				$cache->store($this->_element, $id);
			}
		}

		return $this->_element;
	}

	/**
	 * Get the URL for a banner
	 *
	 * @return	string
	 */
	function getUrl()
	{
		$element = $this->getelement();
		$url = $element->clickurl;

		// check for links
		if (!preg_match('#http[s]?://|index[2]?\.php#', $url)) {
			$url = "http://$url";
		}

		return $url;
	}
}
