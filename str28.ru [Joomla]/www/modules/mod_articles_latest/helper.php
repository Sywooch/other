<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_latest
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

require_once RPATH_SITE.'/components/com_content/helpers/route.php';

jimport('retina.application.component.model');

JModel::addIncludePath(RPATH_SITE.'/components/com_content/models', 'ContentModel');

abstract class modArticlesLatestHelper
{
	public static function getList(&$params)
	{
		// Get the dbo
		$db = JFactory::getDbo();

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

		// User filter
		$userId = JFactory::getUser()->get('id');
		switch ($params->get('user_id'))
		{
			case 'by_me':
				$model->setState('filter.author_id', (int) $userId);
				break;
			case 'not_me':
				$model->setState('filter.author_id', $userId);
				$model->setState('filter.author_id.include', false);
				break;

			case '0':
				break;

			default:
				$model->setState('filter.author_id', (int) $params->get('user_id'));
				break;
		}

		// Filter by language
		$model->setState('filter.language', $app->getLanguageFilter());

		//  Featured switch
		switch ($params->get('show_featured'))
		{
			case '1':
				$model->setState('filter.featured', 'only');
				break;
			case '0':
				$model->setState('filter.featured', 'hide');
				break;
			default:
				$model->setState('filter.featured', 'show');
				break;
		}

		// Set ordering
		$order_map = array(
			'm_dsc' => 'a.modified DESC, a.created',
			'mc_dsc' => 'CASE WHEN (a.modified = '.$db->quote($db->getNullDate()).') THEN a.created ELSE a.modified END',
			'c_dsc' => 'a.created',
			'p_dsc' => 'a.publish_up',
		);
		$ordering = JArrayHelper::getValue($order_map, $params->get('ordering'), 'a.publish_up');
		$dir = 'DESC';

		$model->setState('list.ordering', $ordering);
		$model->setState('list.direction', $dir);

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
