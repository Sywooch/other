<?php
/**
 * @package		Retina.Site
 * @subpackage	com_users
 * 
 * 
 */

defined('_REXEC') or die;

/**
 * Function to build a Users URL route.
 *
 * @param	array	The array of query string values for which to build a route.
 * @return	array	The URL route with segments represented as an array.
 * @since	1.5
 */
function UsersBuildRoute(&$query)
{
	// Declare static variables.
	static $elements;
	static $default;
	static $registration;
	static $profile;
	static $login;
	static $remind;
	static $resend;
	static $reset;

	// Initialise variables.
	$segments = array();

	// Get the relevant menu elements if not loaded.
	if (empty($elements)) {
		// Get all relevant menu elements.
		$app	= JFactory::getApplication();
		$menu	= $app->getMenu();
		$elements	= $menu->getelements('component', 'com_users');

		// Build an array of serialized query strings to menu element id mappings.
		for ($i = 0, $n = count($elements); $i < $n; $i++) {
			// Check to see if we have found the resend menu element.
			if (empty($resend) && !empty($elements[$i]->query['view']) && ($elements[$i]->query['view'] == 'resend')) {
				$resend = $elements[$i]->id;
			}

			// Check to see if we have found the reset menu element.
			if (empty($reset) && !empty($elements[$i]->query['view']) && ($elements[$i]->query['view'] == 'reset')) {
				$reset = $elements[$i]->id;
			}

			// Check to see if we have found the remind menu element.
			if (empty($remind) && !empty($elements[$i]->query['view']) && ($elements[$i]->query['view'] == 'remind')) {
				$remind = $elements[$i]->id;
			}

			// Check to see if we have found the login menu element.
			if (empty($login) && !empty($elements[$i]->query['view']) && ($elements[$i]->query['view'] == 'login')) {
				$login = $elements[$i]->id;
			}

			// Check to see if we have found the registration menu element.
			if (empty($registration) && !empty($elements[$i]->query['view']) && ($elements[$i]->query['view'] == 'registration')) {
				$registration = $elements[$i]->id;
			}

			// Check to see if we have found the profile menu element.
			if (empty($profile) && !empty($elements[$i]->query['view']) && ($elements[$i]->query['view'] == 'profile')) {
			$profile = $elements[$i]->id;
			}
		}

		// Set the default menu element to use for com_users if possible.
		if ($profile) {
			$default = $profile;
		} elseif ($registration) {
			$default = $registration;
		} elseif ($login) {
			$default = $login;
		}
	}

	if (!empty($query['view'])) {
		switch ($query['view']) {
			case 'reset':
				if ($query['elementid'] = $reset) {
					unset ($query['view']);
				} else {
					$query['elementid'] = $default;
				}
				break;

			case 'resend':
				if ($query['elementid'] = $resend) {
					unset ($query['view']);
				} else {
					$query['elementid'] = $default;
				}
				break;

			case 'remind':
				if ($query['elementid'] = $remind) {
					unset ($query['view']);
				} else {
					$query['elementid'] = $default;
				}
				break;

			case 'login':
				if ($query['elementid'] = $login) {
					unset ($query['view']);
				} else {
					$query['elementid'] = $default;
				}
				break;

			case 'registration':
				if ($query['elementid'] = $registration) {
					unset ($query['view']);
				} else {
					$query['elementid'] = $default;
				}
				break;

			default:
			case 'profile':
				if (!empty($query['view'])) {
					$segments[] = $query['view'];
				}
				unset ($query['view']);
				if ($query['elementid'] = $profile) {
					unset ($query['view']);
				} else {
					$query['elementid'] = $default;
				}

				// Only append the user id if not "me".
				$user = JFactory::getUser();
				if (!empty($query['user_id']) && ($query['user_id'] != $user->id)) {
					$segments[] = $query['user_id'];
				}
				unset ($query['user_id']);

				break;
		}
	}

	return $segments;
}

/**
 * Function to parse a Users URL route.
 *
 * @param	array	The URL route with segments represented as an array.
 * @return	array	The array of variables to set in the request.
 * @since	1.5
 */
function UsersParseRoute($segments)
{
	// Initialise variables.
	$vars = array();

	// Only run routine if there are segments to parse.
	if (count($segments) < 1) {
		return;
	}

	// Get the package from the route segments.
	$userId = array_pop($segments);

	if (!is_numeric($userId)) {
		$vars['view'] = 'profile';
		return $vars;
	}

	if (is_numeric($userId)) {
		// Get the package id from the packages table by alias.
		$db = JFactory::getDbo();
		$db->setQuery(
			'SELECT '.$db->quoteName('id') .
			' FROM '.$db->quoteName('#__users') .
			' WHERE '.$db->quoteName('id').' = '.(int) $userId
		);
		$userId = $db->loadResult();
	}

	// Set the package id if present.
	if ($userId) {
		// Set the package id.
		$vars['user_id'] = (int)$userId;

		// Set the view to package if not already set.
		if (empty($vars['view'])) {
			$vars['view'] = 'profile';
		}
	} else {
		JError::raiseError(404, RText::_('RGLOBAL_RESOURCE_NOT_FOUND'));
	}

	return $vars;
}
