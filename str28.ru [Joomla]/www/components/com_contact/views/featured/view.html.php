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
 * Frontpage View class
 *
 * @package		Retina.Site
 * @subpackage	com_contact
 * @since		1.6
 */
class ContactViewFeatured extends JView
{
	protected $state;
	protected $elements;
	protected $category;
	protected $categories;
	protected $pagination;

	/**
	 * Display the view
	 *
	 * @return	mixed	False on error, null otherwise.
	 */
	function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$params		= $app->getParams();

		// Get some data from the models
		$state		= $this->get('State');
		$elements		= $this->get('elements');
		$category	= $this->get('Category');
		$children	= $this->get('Children');
		$parent 	= $this->get('Parent');
		$pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));
			return false;
		}

		// Check whether category access level allows access.
		$user	= JFactory::getUser();
		$groups	= $user->getAuthorisedViewLevels();

		// Prepare the data.
		// Compute the contact slug.
		for ($i = 0, $n = count($elements); $i < $n; $i++)
		{
			$element		= &$elements[$i];
			$element->slug	= $element->alias ? ($element->id.':'.$element->alias) : $element->id;
			$temp		= new JRegistry();
			$temp->loadString($element->params);
			$element->params = clone($params);
			$element->params->merge($temp);
			if ($element->params->get('show_email', 0) == 1) {
				$element->email_to = trim($element->email_to);
				if (!empty($element->email_to) && JMailHelper::isEmailAddress($element->email_to)) {
					$element->email_to = JHtml::_('email.cloak', $element->email_to);
				} else {
					$element->email_to = '';
				}
			}
		}

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));
		$maxLevel = $params->get('maxLevel', -1);
		$this->assignRef('maxLevel',	$maxLevel);
		$this->assignRef('state',		$state);
		$this->assignRef('elements',		$elements);
		$this->assignRef('category',	$category);
		$this->assignRef('children',	$children);
		$this->assignRef('params',		$params);
		$this->assignRef('parent',		$parent);
		$this->assignRef('pagination',	$pagination);

		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title 		= null;

		// Because the application sets a default page title,
		// we need to get it from the menu element itself
		$menu = $menus->getActive();
		if($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', RText::_('COM_CONTACT_DEFAULT_PAGE_TITLE'));
		}
		$id = (int) @$menu->query['id'];

		$title = $this->params->get('page_title', '');
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
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
