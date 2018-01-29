<?php
/**
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * Frontpage View class
 *
 * @package		Retina.Site
 * @subpackage	com_content
 * @since		1.5
 */
class ContentViewFeatured extends JView
{
	function display($tpl = null)
	{
		// parameters
		$app		= JFactory::getApplication();
		$db			= JFactory::getDbo();
		$document	= JFactory::getDocument();
		$params		= $app->getParams();
		$feedEmail	= (@$app->getCfg('feed_email')) ? $app->getCfg('feed_email') : 'author';
		$siteEmail	= $app->getCfg('mailfrom');
		$document->link = JRoute::_('index.php?option=com_content&view=featured');

		// Get some data from the model
		JRequest::setVar('limit', $app->getCfg('feed_limit'));
		$categories = JCategories::getInstance('Content');
		$rows		= $this->get('elements');
		foreach ($rows as $row)
		{
			// strip html from feed element title
			$title = $this->escape($row->title);
			$title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');

			// Compute the article slug
			$row->slug = $row->alias ? ($row->id . ':' . $row->alias) : $row->id;

			// url link to article
			$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catid));


			// strip html from feed element description text
			// TODO: Only pull fulltext if necessary (actually, just get the necessary fields).
			$description	= ($params->get('feed_summary', 0) ? $row->introtext/*.$row->fulltext*/ : $row->introtext);
			$author			= $row->created_by_alias ? $row->created_by_alias : $row->author;

			// load individual element creator class
			$element = new JFeedelement();
			$element->title		= $title;
			$element->link			= $link;
			$element->description	= $description;
			$element->date			= $row->created;

			$element_category		= $categories->get($row->catid);
			$element->category		= array();
			$element->category[]	= RText::_('JFEATURED'); // All featured articles are categorized as "Featured"
			for ($element_category = $categories->get($row->catid); $element_category !== null; $element_category = $element_category->getParent()) {
				if ($element_category->id > 1) { // Only add non-root categories
					$element->category[] = $element_category->title;
				}
			}

			$element->author		= $author;
			if ($feedEmail == 'site') {
				$element->authorEmail = $siteEmail;
			}
			else {
				$element->authorEmail = $row->author_email;
			}
			// loads element info into rss array
			$document->addelement($element);
		}
	}
}
?>
