<?php
/**
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML View class for the WebLinks component
 *
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * @since		1.5
 */
class WeblinksViewWeblink extends JView
{
	protected $state;
	protected $element;

	function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$params		= $app->getParams();

		// Get some data from the models
		$state		= $this->get('State');
		$element		= $this->get('element');
		$category	= $this->get('Category');

		if ($this->getLayout() == 'edit') {
			$this->_displayEdit($tpl);
			return;
		}

		if ($element->url) {
			// redirects to url if matching id found
			$app->redirect($element->url);
		} else {
			//TODO create proper error handling
			$app->redirect(JRoute::_('index.php'), RText::_('COM_WEBLINKS_ERROR_WEBLINK_NOT_FOUND'), 'notice');
		}
	}
}
