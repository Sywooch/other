<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport( 'joomla.application.component.view');
require_once(JPATH_COMPONENT.DS.'helpers'.DS.'route.php');
class faqlsViewCategories extends JView
{
	function display( $tpl = null )
	{
		$app = JFactory::getApplication();

		$document =& JFactory::getDocument();
		$baseurl = JURI::base();
		$document->addStyleSheet($baseurl . "components/com_faql/css/faql.css");

		$categories	= $this->get('Items'); // Get categories
		// Check for errors.
		if ($categories == false) {
			return false;
		}
		
		$total = $this->get('total'); // Quantity of questions and answers
		// Check for errors.
		if ($total == false) {
			return false;
		}
		
		// Get the page/component configuration
		$params = $app->getParams();

		// Define image tag attributes
		$image = null;
		if ($params->get('image') != -1)
		{
			if($params->get('image_align')!="")
				$attribs['align'] = $params->get('image_align');
			else
				$attribs['align'] = '';

			// Use the static HTML library to build the image tag
			$image = JHTML::_('image', 'media/com_faql/images/'.$params->get('image'), JText::_('faql'), $attribs);
		}

		for($i = 0; $i < count($categories); $i++)
		{
			$category = $categories[$i];
			$category->link = JRoute::_(faqlsHelperRoute::getCategoryRoute($category->id));

			// Prepare category description
			$category->description = JHTML::_('content.prepare', $category->description);
		}

		$this->image = $image;
		$this->params = $params;
		$this->categories = $categories;
		$this->total = $total;

		parent::display($tpl);
	}
}
