<?php
// no direct access
defined('_JEXEC') or die;

// Component Helper
jimport('joomla.application.component.helper');

class faqlsHelperRoute
{
	function getCategoryRoute($catid)
	{
		$needles = array(
			'category' => (int) $catid,
		);

		//Create the link
		$link = 'index.php?option=com_faql&view=category&id='.$catid;

		if($item = faqlsHelperRoute::_findItem($needles)) {
			$link .= '&Itemid='.$item->id;
		} else {
			return $link;
		}

		return $link;
	}

	function _findItem($needles)
	{
		$component =& JComponentHelper::getComponent('com_faql');
		$menus	= JApplication::getMenu('site', array());
		$items	= $menus->getItems('component_id', $component->id);

		$match = null;
		foreach($needles as $needle => $id)
		{
			foreach($items as $item)
			{
				if ((@$item->query['view'] == $needle) && (@$item->query['id'] == $id)) {
					$match = $item;
					break;
				}
			}
			if(isset($match)) {
				break;
			}
		}

		return $match;
	}
}
?>
