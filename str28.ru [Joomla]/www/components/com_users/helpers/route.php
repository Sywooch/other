<?php
/**
 * @package		Retina.Site
 * @subpackage	com_users
 * 
 * 
 */

defined('_REXEC') or die;

/**
 * Users Route Helper
 *
 * @package		Retina.Site
 * @subpackage	com_users
 * @since		1.6
 */
class UsersHelperRoute
{
	/**
	 * Method to get the menu elements for the component.
	 *
	 * @return	array		An array of menu elements.
	 * @since	1.6
	 */
	public static function &getelements()
	{
		static $elements;

		// Get the menu elements for this component.
		if (!isset($elements)) {
			// Include the site app in case we are loading this from the admin.
			require_once RPATH_SITE.'/includes/application.php';

			$app	= JFactory::getApplication();
			$menu	= $app->getMenu();
			$com	= JComponentHelper::getComponent('com_users');
			$elements	= $menu->getelements('component_id', $com->id);

			// If no elements found, set to empty array.
			if (!$elements) {
				$elements = array();
			}
		}

		return $elements;
	}

	/**
	 * Method to get a route configuration for the login view.
	 *
	 * @return	mixed		Integer menu id on success, null on failure.
	 * @since	1.6
	 * @static
	 */
	public static function getLoginRoute()
	{
		// Get the elements.
		$elements	= self::getelements();
		$elementid	= null;

		// Search for a suitable menu id.
		foreach ($elements as $element) {
			if (isset($element->query['view']) && $element->query['view'] === 'login') {
				$elementid = $element->id;
				break;
			}
		}

		return $elementid;
	}

	/**
	 * Method to get a route configuration for the profile view.
	 *
	 * @return	mixed		Integer menu id on success, null on failure.
	 * @since	1.6
	 */
	public static function getProfileRoute()
	{
		// Get the elements.
		$elements	= self::getelements();
		$elementid	= null;

		// Search for a suitable menu id.
		//Menu link can only go to users own profile.

		foreach ($elements as $element) {
			if (isset($element->query['view']) && $element->query['view'] === 'profile') {
				$elementid = $element->id;
				break;
			}

		}
		return $elementid;
	}

	/**
	 * Method to get a route configuration for the registration view.
	 *
	 * @return	mixed		Integer menu id on success, null on failure.
	 * @since	1.6
	 */
	public static function getRegistrationRoute()
	{
		// Get the elements.
		$elements	= self::getelements();
		$elementid	= null;

		// Search for a suitable menu id.
		foreach ($elements as $element) {
			if (isset($element->query['view']) && $element->query['view'] === 'registration') {
				$elementid = $element->id;
				break;
			}
		}

		return $elementid;
	}

	/**
	 * Method to get a route configuration for the remind view.
	 *
	 * @return	mixed		Integer menu id on success, null on failure.
	 * @since	1.6
	 */
	public static function getRemindRoute()
	{
		// Get the elements.
		$elements	= self::getelements();
		$elementid	= null;

		// Search for a suitable menu id.
		foreach ($elements as $element) {
			if (isset($element->query['view']) && $element->query['view'] === 'remind') {
				$elementid = $element->id;
				break;
			}
		}

		return $elementid;
	}

	/**
	 * Method to get a route configuration for the resend view.
	 *
	 * @return	mixed		Integer menu id on success, null on failure.
	 * @since	1.6
	 */
	public static function getResendRoute()
	{
		// Get the elements.
		$elements	= self::getelements();
		$elementid	= null;

		// Search for a suitable menu id.
		foreach ($elements as $element) {
			if (isset($element->query['view']) && $element->query['view'] === 'resend') {
				$elementid = $element->id;
				break;
			}
		}

		return $elementid;
	}

	/**
	 * Method to get a route configuration for the reset view.
	 *
	 * @return	mixed		Integer menu id on success, null on failure.
	 * @since	1.6
	 */
	function getResetRoute()
	{
		// Get the elements.
		$elements	= self::getelements();
		$elementid	= null;

		// Search for a suitable menu id.
		foreach ($elements as $element) {
			if (isset($element->query['view']) && $element->query['view'] === 'reset') {
				$elementid = $element->id;
				break;
			}
		}

		return $elementid;
	}
}
