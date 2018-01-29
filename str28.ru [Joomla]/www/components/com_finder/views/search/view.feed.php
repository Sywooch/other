<?php
/**
 * @package     Retina.Site
 * @subpackage  com_finder
 *
 * @copyright   
 * @license     
 */

defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * Search feed view class for the Finder package.
 *
 * @package     Retina.Site
 * @subpackage  com_finder
 * @since       2.5
 */
class FinderViewSearch extends JView
{
	/**
	 * Method to display the view.
	 *
	 * @param   string  $tpl  A template file to load. [optional]
	 *
	 * @return  mixed  JError object on failure, void on success.
	 *
	 * @since   2.5
	 */
	public function display($tpl = null)
	{
		// Get the application
		$app = JFactory::getApplication();
		// Adjust the list limit to the feed limit.
		$app->input->set('limit', $app->getCfg('feed_limit'));

		// Get view data.
		$state = $this->get('State');
		$params = $state->get('params');
		$query = $this->get('Query');
		$results = $this->get('Results');

		// Push out the query data.
		JHtml::addIncludePath(RPATH_COMPONENT . '/helpers/html');
		$suggested = JHtml::_('query.suggested', $query);
		$explained = JHtml::_('query.explained', $query);

		// Set the document title.
		$title = $this->params->get('page_title', '');

		if (empty($title))
		{
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1)
		{
			$title = RText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2)
		{
			$title = RText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}

		$this->document->setTitle($title);

		// Configure the document description.
		if (!empty($explained))
		{
			$this->document->setDescription(html_entity_decode(strip_tags($explained), ENT_QUOTES, 'UTF-8'));
		}

		// Set the document link.
		$this->document->link = JRoute::_($query->toURI());

		// Convert the results to feed entries.
		foreach ($results as $result)
		{
			// Convert the result to a feed entry.
			$element = new JFeedelement;
			$element->title = $result->title;
			$element->link = JRoute::_($result->route);
			$element->description = $result->description;
			$element->date = intval($result->start_date) ? JHtml::date($result->start_date, '%A %d %B %Y') : $result->indexdate;

			// Get the taxonomy data.
			$taxonomy = $result->getTaxonomy();

			// Add the category to the feed if available.
			if (isset($taxonomy['Category']))
			{
				$node = array_pop($taxonomy['Category']);
				$element->category = $node->title;
			}

			// loads element info into rss array
			$this->document->addelement($element);
		}
	}
}
