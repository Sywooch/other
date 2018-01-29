<?php
/**
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML Article View class for the Weblinks component
 *
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * @since		1.5
 */
class WeblinksViewForm extends JView
{
	protected $form;
	protected $element;
	protected $return_page;
	protected $state;

	public function display($tpl = null)
	{
		// Initialise variables.
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();

		// Get model data.
		$this->state		= $this->get('State');
		$this->element			= $this->get('element');
		$this->form			= $this->get('Form');
		$this->return_page	= $this->get('ReturnPage');

		if (empty($this->element->id)) {
			$authorised = ($user->authorise('core.create', 'com_weblinks') || (count($user->getAuthorisedCategories('com_weblinks', 'core.create'))));
		}
		else {
			$authorised = $user->authorise('core.edit', 'com_weblinks.weblink.'.$this->element->id);
		}

		if ($authorised !== true) {
			JError::raiseError(403, RText::_('RERROR_ALERTNOAUTHOR'));
			return false;
		}

		if (!empty($this->element)) {
			$this->form->bind($this->element);
		}

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		// Create a shortcut to the parameters.
		$params	= &$this->state->params;

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->params	= $params;
		$this->user		= $user;

		$this->_prepareDocument();
		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app	= JFactory::getApplication();
		$menus	= $app->getMenu();
		$title	= null;

		// Because the application sets a default page title,
		// we need to get it from the menu element itself
		$menu = $menus->getActive();

		if (empty($this->element->id)) {
		$head = RText::_('COM_WEBLINKS_FORM_SUBMIT_WEBLINK');
		}
		else {
		$head = RText::_('COM_WEBLINKS_FORM_EDIT_WEBLINK');
		}

		if ($menu) {
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', $head);
		}

		$title = $this->params->def('page_title', $head);
		if ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = RText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = RText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

			if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}
}
