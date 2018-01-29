<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_categories
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

require_once RPATH_SITE.'/components/com_content/helpers/route.php';
jimport('retina.application.categories');

abstract class modArticlesCategoriesHelper
{
	public static function getList(&$params)
	{
		$categories = JCategories::getInstance('Content');
		$category = $categories->get($params->get('parent', 'root'));
		$elements = $category->getChildren();
		if($params->get('count', 0) > 0 && count($elements) > $params->get('count', 0))
		{
			$elements = array_slice($elements, 0, $params->get('count', 0));
		}
		return $elements;
	}

}
