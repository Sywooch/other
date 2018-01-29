<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_news
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

require_once RPATH_SITE.'/components/com_content/helpers/route.php';

jimport('retina.application.component.model');

JModel::addIncludePath(RPATH_SITE.'/components/com_content/models', 'ContentModel');

abstract class modArticlesNewsHelper
{
	public static function getList(&$params)
	{
		$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();

		// Get an instance of the generic articles model
		$model = JModel::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		// Set application parameters in model
		$appParams = JFactory::getApplication()->getParams();
		$model->setState('params', $appParams);

		// Set the filters based on the module params
		$model->setState('list.start', 0);
		$model->setState('list.limit', (int) $params->get('count', 5));

		$model->setState('filter.published', 1);

		$model->setState('list.select', 'a.fulltext, a.id, a.title, a.alias, a.title_alias, a.introtext, a.state, a.catid, a.created, a.created_by, a.created_by_alias,' .
			' a.modified, a.modified_by,a.publish_up, a.publish_down, a.attribs, a.metadata, a.metakey, a.metadesc, a.access,' .
			' a.hits, a.featured,' .
			' LENGTH(a.fulltext) AS readmore');
		// Access filter
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$model->setState('filter.access', $access);

		// Category filter
		$model->setState('filter.category_id', $params->get('catid', array()));

		// Filter by language
		$model->setState('filter.language', $app->getLanguageFilter());

		// Set ordering
		$ordering = $params->get('ordering', 'a.publish_up');
		$model->setState('list.ordering', $ordering);
		if (trim($ordering) == 'rand()') {
			$model->setState('list.direction', '');
		} else {
			$model->setState('list.direction', 'DESC');
		}

		//	Retrieve Content
		$elements = $model->getelements();

		foreach ($elements as &$element) {
			$element->readmore = (trim($element->fulltext) != '');
			$element->slug = $element->id.':'.$element->alias;
			$element->catslug = $element->catid.':'.$element->category_alias;

			if ($access || in_array($element->access, $authorised))
			{
				// We know that user has the privilege to view the article
				$element->link = JRoute::_(ContentHelperRoute::getArticleRoute($element->slug, $element->catid));
				$element->linkText = RText::_('MOD_ARTICLES_NEWS_READMORE');
			}
			else {
				$element->link = JRoute::_('index.php?option=com_users&view=login');
				$element->linkText = RText::_('MOD_ARTICLES_NEWS_READMORE_REGISTER');
			}

			$element->introtext = JHtml::_('content.prepare', $element->introtext, '', 'mod_articles_news.content');

			//new
			if (!$params->get('image')) {
				$element->introtext = preg_replace('/<img[^>]*>/', '', $element->introtext);
			}

			$results = $app->triggerEvent('onContentAfterDisplay', array('com_content.article', &$element, &$params, 1));
			$element->afterDisplayTitle = trim(implode("\n", $results));

			$results = $app->triggerEvent('onContentBeforeDisplay', array('com_content.article', &$element, &$params, 1));
			$element->beforeDisplayContent = trim(implode("\n", $results));
		}

		return $elements;
	}
}
