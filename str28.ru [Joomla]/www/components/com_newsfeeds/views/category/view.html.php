<?php
/**
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * 
 * 
 */

// Check to ensure this file is included in Retina
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML View class for the Newsfeeds component
 *
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * @since		1.0
 */
class NewsfeedsViewCategory extends JView
{
	protected $state;
	protected $elements;
	protected $category;
	protected $categories;
	protected $pagination;

	function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
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
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		if ($category == false) {
			return JError::raiseError(404, RText::_('RGLOBAL_CATEGORY_NOT_FOUND'));
		}

		if ($parent == false) {
			return JError::raiseError(404, RText::_('RGLOBAL_CATEGORY_NOT_FOUND'));
		}

		// Check whether category access level allows access.
		$groups	= $user->getAuthorisedViewLevels();
		if (!in_array($category->access, $groups)) {
			return JError::raiseError(403, RText::_('RERROR_ALERTNOAUTHOR'));
		}

		// Prepare the data.
		// Compute the newsfeed slug.
		for ($i = 0, $n = count($elements); $i < $n; $i++)
		{
			$element		= &$elements[$i];
			$element->slug	= $element->alias ? ($element->id.':'.$element->alias) : $element->id;
			$temp		= new JRegistry();
			$temp->loadString($element->params);
			$element->params = clone($params);
			$element->params->merge($temp);
		}

		// Setup the category parameters.
		$cparams = $category->getParams();
		$category->params = clone($params);
		$category->params->merge($cparams);

		$children = array($category->id => $children);

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

		// Check for layout override only if this is not the active menu element
		// If it is the active menu element, then the view and category id will match
		$active	= $app->getMenu()->getActive();
		if ((!$active) || ((strpos($active->link, 'view=category') === false) || (strpos($active->link, '&id=' . (string) $this->category->id) === false))) {
			if ($layout = $category->params->get('category_layout')) {
			$this->setLayout($layout);
			}
		}
		elseif (isset($active->query['layout'])) {
			// We need to set the layout in case this is an alternative menu element (with an alternative layout)
			$this->setLayout($active->query['layout']);
		}

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

		if ($menu) {
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else {
			$this->params->def('page_heading', RText::_('COM_NEWSFEEDS_DEFAULT_PAGE_TITLE'));
		}

		$id = (int) @$menu->query['id'];

		if ($menu && ($menu->query['option'] != 'com_newsfeeds' || $menu->query['view'] == 'newsfeed' || $id != $this->category->id)) {
			$path = array(array('title' => $this->category->title, 'link' => ''));
			$category = $this->category->getParent();

			while (($menu->query['option'] != 'com_newsfeeds' || $menu->query['view'] == 'newsfeed' || $id != $category->id) && $category->id > 1)
			{
				$path[] = array('title' => $category->title, 'link' => NewsfeedsHelperRoute::getCategoryRoute($category->id));
				$category = $category->getParent();
			}

			$path = array_reverse($path);

			foreach($path as $element)
			{
				$pathway->addelement($element['title'], $element['link']);
			}
		}

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

		if ($this->category->metadesc)
		{
			$this->document->setDescription($this->category->metadesc);
		}
		elseif (!$this->category->metadesc && $this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->category->metakey)
		{
			$this->document->setMetadata('keywords', $this->category->metakey);
		}
		elseif (!$this->category->metakey && $this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}

		if ($app->getCfg('MetaAuthor') == '1') {
			$this->document->setMetaData('author', $this->category->getMetadata()->get('author'));
		}

		$mdata = $this->category->getMetadata()->toArray();

		foreach ($mdata as $k => $v)
		{
			if ($v) {
				$this->document->setMetadata($k, $v);
			}
		}
	}
}
