<?php
/**
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML View class for the WebLinks component
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * @since 1.0
 */
class WeblinksViewCategory extends JView
{
	function display($tpl = null)
	{
		$app	= JFactory::getApplication();
		$document = JFactory::getDocument();

		$document->link = JRoute::_(WeblinksHelperRoute::getCategoryRoute(JRequest::getVar('id', null, '', 'int')));

		JRequest::setVar('limit', $app->getCfg('feed_limit'));
		$siteEmail = $app->getCfg('mailfrom');
		$fromName = $app->getCfg('fromname');
		$document->editor = $fromName;
		$document->editorEmail = $siteEmail;

		// Get some data from the model
		$elements		= $this->get('elements');
		$category	= $this->get('Category');

		foreach ($elements as $element)
		{
			// strip html from feed element title
			$title = $this->escape($element->title);
			$title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');

			// url link to article
			$link = JRoute::_(WeblinksHelperRoute::getWeblinkRoute($element->slug, $element->catid));

			// strip html from feed element description text
			$description = $element->description;
			$date = ($element->date ? date('r', strtotime($element->date)) : '');

			// load individual element creator class
			$feedelement = new JFeedelement();
			$feedelement->title		= $title;
			$feedelement->link			= $link;
			$feedelement->description	= $description;
			$feedelement->date			= $date;
			$feedelement->category		= 'Weblinks';

			// loads element info into rss array
			$document->addelement($feedelement);
		}
	}
}
?>
