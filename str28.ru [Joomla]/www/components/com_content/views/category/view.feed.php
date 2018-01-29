<?php
/**
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML View class for the Content component
 *
 * @package		Retina.Site
 * @subpackage	com_content
 * @since 1.5
 */
class ContentViewCategory extends JView
{
	function display()
	{
		$app = JFactory::getApplication();

		$doc	= JFactory::getDocument();
		$params = $app->getParams();
		$feedEmail	= (@$app->getCfg('feed_email')) ? $app->getCfg('feed_email') : 'author';
		$siteEmail	= $app->getCfg('mailfrom');
		// Get some data from the model
		JRequest::setVar('limit', $app->getCfg('feed_limit'));
		$category	= $this->get('Category');
		$rows		= $this->get('elements');

		$doc->link = JRoute::_(ContentHelperRoute::getCategoryRoute($category->id));

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
			@$date			= ($row->created ? date('r', strtotime($row->created)) : '');

			// load individual element creator class
			$element = new JFeedelement();
			$element->title		= $title;
			$element->link			= $link;
			$element->description	= $description;
			$element->date			= $date;
			$element->category		= $row->category;

			$element->author		= $author;
			if ($feedEmail == 'site') {
				$element->authorEmail = $siteEmail;
			}
			else {
				$element->authorEmail = $row->author_email;
			}

			// loads element info into rss array
			$doc->addelement($element);
		}
	}
}
