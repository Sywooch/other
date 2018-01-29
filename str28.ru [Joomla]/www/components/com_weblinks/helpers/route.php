<?php
/**
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

// Component Helper
jimport('retina.application.component.helper');
jimport('retina.application.categories');

/**
 * Weblinks Component Route Helper
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * @since 1.5
 */
abstract class WeblinksHelperRoute
{
	protected static $lookup;

	/**
	 * @param	int	The route of the weblink
	 */
	public static function getWeblinkRoute($id, $catid)
	{
		$needles = array(
			'weblink'  => array((int) $id)
		);

		//Create the link
		$link = 'index.php?option=com_weblinks&view=weblink&id='. $id;
		if ($catid > 1) {
			$categories = JCategories::getInstance('Weblinks');
			$category = $categories->get($catid);

			if($category) {
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid='.$catid;
			}
		}

		if ($element = self::_findelement($needles)) {
			$link .= '&elementid='.$element;
		}
		elseif ($element = self::_findelement()) {
			$link .= '&elementid='.$element;
		}

		return $link;
	}

	/**
	 * @param	int		$id		The id of the weblink.
	 * @param	string	$return	The return page variable.
	 */
	public static function getFormRoute($id, $return = null)
	{
		// Create the link.
		if ($id) {
			$link = 'index.php?option=com_weblinks&task=weblink.edit&w_id='. $id;
		}
		else {
			$link = 'index.php?option=com_weblinks&task=weblink.add&w_id=0';
		}

		if ($return) {
			$link .= '&return='.$return;
		}

		return $link;
	}

	public static function getCategoryRoute($catid)
	{
		if ($catid instanceof JCategoryNode) {
			$id = $catid->id;
			$category = $catid;
		}
		else {
			$id = (int) $catid;
			$category = JCategories::getInstance('Weblinks')->get($id);
		}

		if ($id < 1) {
			$link = '';
		}
		else {
			$needles = array(
				'category' => array($id)
			);

			if ($element = self::_findelement($needles)) {
				$link = 'index.php?elementid='.$element;
			}
			else {
				//Create the link
				$link = 'index.php?option=com_weblinks&view=category&id='.$id;

				if ($category) {
					$catids = array_reverse($category->getPath());
					$needles = array(
						'category' => $catids,
						'categories' => $catids
					);

					if ($element = self::_findelement($needles)) {
						$link .= '&elementid='.$element;
					}
					elseif ($element = self::_findelement()) {
						$link .= '&elementid='.$element;
					}
				}
			}
		}

		return $link;
	}

	protected static function _findelement($needles = null)
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu('site');

		// Prepare the reverse lookup array.
		if (self::$lookup === null) {
			self::$lookup = array();

			$component	= JComponentHelper::getComponent('com_weblinks');
			$elements		= $menus->getelements('component_id', $component->id);

			if ($elements) {
				foreach ($elements as $element)
				{
					if (isset($element->query) && isset($element->query['view'])) {
						$view = $element->query['view'];

						if (!isset(self::$lookup[$view])) {
							self::$lookup[$view] = array();
						}

						if (isset($element->query['id'])) {
							self::$lookup[$view][$element->query['id']] = $element->id;
						}
					}
				}
			}
		}

		if ($needles) {
			foreach ($needles as $view => $ids)
			{
				if (isset(self::$lookup[$view])) {
					foreach($ids as $id)
					{
						if (isset(self::$lookup[$view][(int)$id])) {
							return self::$lookup[$view][(int)$id];
						}
					}
				}
			}
		}
		else {
			$active = $menus->getActive();
			if ($active) {
				return $active->id;
			}
		}

		return null;
	}
}
