<?php
/**
 * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML View class for the Contact component
 *
 * @package		Retina.Site
 * @subpackage	com_contact
 * @since 1.5
 */
class ContactViewCategory extends JView
{
	function display()
	{
		// Get some data from the models
		$category	= $this->get('Category');
		$rows		= $this->get('elements');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$app = JFactory::getApplication();

		$doc	= JFactory::getDocument();
		$params = $app->getParams();

		$doc->link = JRoute::_(ContactHelperRoute::getCategoryRoute($category->id));

		foreach ($rows as $row)
		{
			// strip html from feed element title
			$title = $this->escape($row->name);
			$title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');

			// Compute the contact slug
			$row->slug = $row->alias ? ($row->id . ':' . $row->alias) : $row->id;

			// url link to article
			$link = JRoute::_(ContactHelperRoute::getContactRoute($row->slug, $row->catid));

			$description	= $row->introtext;
			$author			= $row->created_by_alias ? $row->created_by_alias : $row->author;
			@$date			= ($row->created ? date('r', strtotime($row->created)) : '');

			// load individual element creator class
			$element = new JFeedelement();
			$element->title		= $title;
			$element->link			= $link;
			$element->description	= $description;
			$element->date			= $date;
			$element->category		= $row->category;

			// loads element info into rss array
			$doc->addelement($element);
		}
	}
}
