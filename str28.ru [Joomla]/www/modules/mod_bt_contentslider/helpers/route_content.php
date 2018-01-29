<?php
/**
 * Modified from route.php of com_content
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.application.component.helper');
jimport('retina.application.categories');

abstract class BTContentSliderRoute
{
	protected static $lookup;

	/**
	 * @param	int	The route of the content element
	 */
	public static function getArticleRoute($id, $catid = 0, $elementid = 999)
	{
		$needles = array('article' => array((int) $id));
		//Create the link
		$link = 'index.php?option=com_content&view=article&id=' . $id;
		if ((int) $catid > 1)
		{
			$categories = JCategories::getInstance('Content');
			$category = $categories->get((int) $catid);
			if ($category)
			{
				$needles['category'] = array_reverse($category->getPath());
				$needles['categories'] = $needles['category'];
				$link .= '&catid=' . $catid;
			}
		}

		if ($element = self::_findelement($needles))
		{
			$link .= '&elementid=' . $element;
		}
		else
		{
			$link .= '&elementid=' . $elementid;
		}

		return $link;
	}

	public static function getCategoryRoute($catid, $elementid = 0)
	{
		if ($catid instanceof JCategoryNode)
		{
			$id = $catid->id;
			$category = $catid;
		}
		else
		{
			$id = (int) $catid;
			$category = JCategories::getInstance('Content')->get($id);
		}

		if ($id < 1)
		{
			$link = '';
		}
		else
		{
			$needles = array('category' => array($id));

			if ($element = self::_findelement($needles))
			{
				$link = 'index.php?elementid=' . $element;
			}
			else
			{
				//Create the link
				$link = 'index.php?option=com_content&view=category&id=' . $id;
				if ($category)
				{
					$catids = array_reverse($category->getPath());
					$needles = array('category' => $catids, 'categories' => $catids);
					if ($element = self::_findelement($needles))
					{
						$link .= '&elementid=' . $element;
					}
					else
					{
						$link .= '&elementid=' . $elementid;
					}
				}
			}
		}

		return $link;
	}

	public static function getFormRoute($id)
	{
		//Create the link
		if ($id)
		{
			$link = 'index.php?option=com_content&task=article.edit&a_id=' . $id;
		}
		else
		{
			$link = 'index.php?option=com_content&task=article.edit&a_id=0';
		}

		return $link;
	}

	protected static function _findelement($needles = null)
	{
		$app = JFactory::getApplication();
		$menus = $app->getMenu('site');

		// Prepare the reverse lookup array.
		if (self::$lookup === null)
		{
			self::$lookup = array();

			$component = JComponentHelper::getComponent('com_content');
			$elements = $menus->getelements('component_id', $component->id);
			foreach ($elements as $element)
			{
				if (isset($element->query) && isset($element->query['view']))
				{
					$view = $element->query['view'];
					if (!isset(self::$lookup[$view]))
					{
						self::$lookup[$view] = array();
					}
					if (isset($element->query['id']))
					{
						self::$lookup[$view][$element->query['id']] = $element->id;
					}
				}
			}
		}

		if ($needles)
		{
			foreach ($needles as $view => $ids)
			{
				if (isset(self::$lookup[$view]))
				{
					foreach ($ids as $id)
					{
						if (isset(self::$lookup[$view][(int) $id]))
						{
							return self::$lookup[$view][(int) $id];
						}
					}
				}
			}
		}
		else
		{
			$active = $menus->getActive();
			if ($active && $active->component == 'com_content')
			{
				return $active->id;
			}
		}

		return null;
	}
}
