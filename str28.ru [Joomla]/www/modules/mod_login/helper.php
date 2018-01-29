<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_login
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

class modLoginHelper
{
	static function getReturnURL($params, $type)
	{
		$app	= JFactory::getApplication();
		$router = $app->getRouter();
		$url = null;
		if ($elementid =  $params->get($type))
		{
			$db		= JFactory::getDbo();
			$query	= $db->getQuery(true);

			$query->select($db->quoteName('link'));
			$query->from($db->quoteName('#__menu'));
			$query->where($db->quoteName('published') . '=1');
			$query->where($db->quoteName('id') . '=' . $db->quote($elementid));

			$db->setQuery($query);
			if ($link = $db->loadResult()) {
				if ($router->getMode() == JROUTER_MODE_SEF) {
					$url = 'index.php?elementid='.$elementid;
				}
				else {
					$url = $link.'&elementid='.$elementid;
				}
			}
		}
		if (!$url)
		{
			// stay on the same page
			$uri = clone JFactory::getURI();
			$vars = $router->parse($uri);
			unset($vars['lang']);
			if ($router->getMode() == JROUTER_MODE_SEF)
			{
				if (isset($vars['elementid']))
				{
					$elementid = $vars['elementid'];
					$menu = $app->getMenu();
					$element = $menu->getelement($elementid);
					unset($vars['elementid']);
					if (isset($element) && $vars == $element->query) {
						$url = 'index.php?elementid='.$elementid;
					}
					else {
						$url = 'index.php?'.JURI::buildQuery($vars).'&elementid='.$elementid;
					}
				}
				else
				{
					$url = 'index.php?'.JURI::buildQuery($vars);
				}
			}
			else
			{
				$url = 'index.php?'.JURI::buildQuery($vars);
			}
		}

		return base64_encode($url);
	}

	static function getType()
	{
		$user = JFactory::getUser();
		return (!$user->get('guest')) ? 'logout' : 'login';
	}
}
