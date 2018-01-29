<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_popular
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

require_once RPATH_SITE.'/components/com_content/helpers/route.php';

jimport('retina.application.component.model');

JModel::addIncludePath(RPATH_SITE.'/components/com_content/models', 'ContentModel');

abstract class modArticlesPopularHelper
{
	public static function getList(&$params)
	{
		// Get an instance of the generic articles model
		$model = JModel::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		// Set application parameters in model
		$app = JFactory::getApplication();
		$appParams = $app->getParams();
		$model->setState('params', $appParams);

		// Set the filters based on the module params
		$model->setState('list.start', 0);
		$model->setState('list.limit', (int) $params->get('count', 5));
		$model->setState('filter.published', 1);

		// Access filter
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$model->setState('filter.access', $access);

		// Category filter
		$model->setState('filter.category_id', $params->get('catid', array()));

		// Filter by language
		$model->setState('filter.language', $app->getLanguageFilter());

		// Ordering
		$model->setState('list.ordering', 'a.hits');
		$model->setState('list.direction', 'DESC');

		$elements = $model->getelements();

		foreach ($elements as &$element) {
			$element->slug = $element->id.':'.$element->alias;
			$element->catslug = $element->catid.':'.$element->category_alias;

			if ($access || in_array($element->access, $authorised)) {
				// We know that user has the privilege to view the article
				$element->link = JRoute::_(ContentHelperRoute::getArticleRoute($element->slug, $element->catslug));
			} else {
				$element->link = JRoute::_('index.php?option=com_users&view=login');
			}
		}

		return $elements;
	}
}
