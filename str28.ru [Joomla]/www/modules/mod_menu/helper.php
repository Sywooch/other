<?php
/**
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

/**
 * @package		Retina.Site
 * @subpackage	mod_menu
 * @since		1.5
 */
class modMenuHelper
{
	/**
	 * Get a list of the menu elements.
	 *
	 * @param	JRegistry	$params	The module options.
	 *
	 * @return	array
	 * @since	1.5
	 */
	static function getList(&$params)
	{
		$app = JFactory::getApplication();
		$menu = $app->getMenu();

		// If no active menu, use default
		$active = ($menu->getActive()) ? $menu->getActive() : $menu->getDefault();

		$user = JFactory::getUser();
		$levels = $user->getAuthorisedViewLevels();
		asort($levels);
		$key = 'menu_elements'.$params.implode(',', $levels).'.'.$active->id;
		$cache = JFactory::getCache('mod_menu', '');
		if (!($elements = $cache->get($key)))
		{
			// Initialise variables.
			$list		= array();
			$db			= JFactory::getDbo();

			$path		= $active->tree;
			$start		= (int) $params->get('startLevel');
			$end		= (int) $params->get('endLevel');
			$showAll	= $params->get('showAllChildren');
			$elements 		= $menu->getelements('menutype', $params->get('menutype'));

			$lastelement	= 0;

			if ($elements) {
				foreach($elements as $i => $element)
				{
					if (($start && $start > $element->level)
						|| ($end && $element->level > $end)
						|| (!$showAll && $element->level > 1 && !in_array($element->parent_id, $path))
						|| ($start > 1 && !in_array($element->tree[$start-2], $path))
					) {
						unset($elements[$i]);
						continue;
					}

					$element->deeper = false;
					$element->shallower = false;
					$element->level_diff = 0;

					if (isset($elements[$lastelement])) {
						$elements[$lastelement]->deeper		= ($element->level > $elements[$lastelement]->level);
						$elements[$lastelement]->shallower	= ($element->level < $elements[$lastelement]->level);
						$elements[$lastelement]->level_diff	= ($elements[$lastelement]->level - $element->level);
					}

					$element->parent = (boolean) $menu->getelements('parent_id', (int) $element->id, true);

					$lastelement			= $i;
					$element->active		= false;
					$element->flink = $element->link;

					switch ($element->type)
					{
						case 'separator':
							// No further action needed.
							continue;

						case 'url':
							if ((strpos($element->link, 'index.php?') === 0) && (strpos($element->link, 'elementid=') === false)) {
								// If this is an internal retina link, ensure the elementid is set.
								$element->flink = $element->link.'&elementid='.$element->id;
							}
							break;

						case 'alias':
							// If this is an alias use the element id stored in the parameters to make the link.
							$element->flink = 'index.php?elementid='.$element->params->get('aliasoptions');
							break;

						default:
							$router = JSite::getRouter();
							if ($router->getMode() == JROUTER_MODE_SEF) {
								$element->flink = 'index.php?elementid='.$element->id;
							}
							else {
								$element->flink .= '&elementid='.$element->id;
							}
							break;
					}

					if (strcasecmp(substr($element->flink, 0, 4), 'http') && (strpos($element->flink, 'index.php?') !== false)) {
						$element->flink = JRoute::_($element->flink, true, $element->params->get('secure'));
					}
					else {
						$element->flink = JRoute::_($element->flink);
					}

					$element->title = htmlspecialchars($element->title);
					$element->anchor_css = htmlspecialchars($element->params->get('menu-anchor_css', ''));
					$element->anchor_title = htmlspecialchars($element->params->get('menu-anchor_title', ''));
					$element->menu_image = $element->params->get('menu_image', '') ? htmlspecialchars($element->params->get('menu_image', '')) : '';
				}

				if (isset($elements[$lastelement])) {
					$elements[$lastelement]->deeper		= (($start?$start:1) > $elements[$lastelement]->level);
					$elements[$lastelement]->shallower	= (($start?$start:1) < $elements[$lastelement]->level);
					$elements[$lastelement]->level_diff	= ($elements[$lastelement]->level - ($start?$start:1));
				}
			}

			$cache->store($elements, $key);
		}
		return $elements;
	}
}
