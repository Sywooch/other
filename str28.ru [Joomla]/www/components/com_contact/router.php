<?php
/**
 * @package		Retina.Site
 * 
 * 
 */

defined('_REXEC') or die;

jimport('retina.application.categories');

/**
 * Build the route for the com_contact component
 *
 * @param	array	An array of URL arguments
 *
 * @return	array	The URL arguments to use to assemble the subsequent URL.
 */
function ContactBuildRoute(&$query){
	$segments = array();

	// get a menu element based on elementid or currently active
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$params	= JComponentHelper::getParams('com_contact');
	$advanced = $params->get('sef_advanced_link', 0);

	if (empty($query['elementid'])) {
		$menuelement = $menu->getActive();
	} else {
		$menuelement = $menu->getelement($query['elementid']);
	}
	$mView	= (empty($menuelement->query['view'])) ? null : $menuelement->query['view'];
	$mCatid	= (empty($menuelement->query['catid'])) ? null : $menuelement->query['catid'];
	$mId	= (empty($menuelement->query['id'])) ? null : $menuelement->query['id'];

	if (isset($query['view']))
	{
		$view = $query['view'];
		if (empty($query['elementid'])) {
			$segments[] = $query['view'];
		}
		unset($query['view']);
	};

	// are we dealing with a contact that is attached to a menu element?
	if (isset($view) && ($mView == $view) and (isset($query['id'])) and ($mId == intval($query['id']))) {
		unset($query['view']);
		unset($query['catid']);
		unset($query['id']);
		return $segments;
	}

	if (isset($view) and ($view == 'category' or $view == 'contact')) {
		if ($mId != intval($query['id']) || $mView != $view) {
			if($view == 'contact' && isset($query['catid']))
			{
				$catid = $query['catid'];
			} elseif(isset($query['id'])) {
				$catid = $query['id'];
			}
			$menuCatid = $mId;
			$categories = JCategories::getInstance('Contact');
			$category = $categories->get($catid);
			if($category)
			{
				//TODO Throw error that the category either not exists or is unpublished
				$path = array_reverse($category->getPath());

				$array = array();
				foreach($path as $id)
				{
					if((int) $id == (int)$menuCatid)
					{
						break;
					}
					if($advanced)
					{
						list($tmp, $id) = explode(':', $id, 2);
					}
					$array[] = $id;
				}
				$segments = array_merge($segments, array_reverse($array));
			}
			if($view == 'contact')
			{
				if($advanced)
				{
					list($tmp, $id) = explode(':', $query['id'], 2);
				} else {
					$id = $query['id'];
				}
				$segments[] = $id;
			}
		}
		unset($query['id']);
		unset($query['catid']);
	}

	if (isset($query['layout']))
	{
		if (!empty($query['elementid']) && isset($menuelement->query['layout']))
		{
			if ($query['layout'] == $menuelement->query['layout']) {

				unset($query['layout']);
			}
		}
		else
		{
			if ($query['layout'] == 'default') {
				unset($query['layout']);
			}
		}
	};

	return $segments;
}
/**
 * Parse the segments of a URL.
 *
 * @param	array	The segments of the URL to parse.
 *
 * @return	array	The URL attributes to be used by the application.
 */
function ContactParseRoute($segments)
{
	$vars = array();

	//Get the active menu element.
	$app	= JFactory::getApplication();
	$menu	= $app->getMenu();
	$element	= $menu->getActive();
	$params = JComponentHelper::getParams('com_contact');
	$advanced = $params->get('sef_advanced_link', 0);

	// Count route segments
	$count = count($segments);

	// Standard routing for newsfeeds.
	if (!isset($element))
	{
		$vars['view']	= $segments[0];
		$vars['id']		= $segments[$count - 1];
		return $vars;
	}

	// From the categories view, we can only jump to a category.
	$id = (isset($element->query['id']) && $element->query['id'] > 1) ? $element->query['id'] : 'root';
	$categories = JCategories::getInstance('Contact')->get($id)->getChildren();
	$vars['catid'] = $id;
	$vars['id'] = $id;
	$found = 0;
	foreach($segments as $segment)
	{
		$segment = $advanced ? str_replace(':', '-', $segment) : $segment;
		foreach($categories as $category)
		{
			if ($category->slug == $segment || $category->alias == $segment)
			{
				$vars['id'] = $category->id;
				$vars['catid'] = $category->id;
				$vars['view'] = 'category';
				$categories = $category->getChildren();
				$found = 1;
				break;
			}
		}
		if ($found == 0)
		{
			if($advanced)
			{
				$db = JFactory::getDBO();
				$query = 'SELECT id FROM #__contact_details WHERE catid = '.$vars['catid'].' AND alias = '.$db->Quote($segment);
				$db->setQuery($query);
				$nid = $db->loadResult();
			} else {
				$nid = $segment;
			}
			$vars['id'] = $nid;
			$vars['view'] = 'contact';
		}
		$found = 0;
	}
	return $vars;
}
