<?php
/**
 * @package		Retina.Site
 * @subpackage	com_content
 * 
 * 
 */

// Check to ensure this file is included in Retina
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
	protected $state;
	protected $elements;
	protected $category;
	protected $children;
	protected $pagination;

	protected $lead_elements = array();
	protected $intro_elements = array();
	protected $link_elements = array();
	protected $columns = 1;

	function display($tpl = null)
	{
		$app	= JFactory::getApplication();
		$user	= JFactory::getUser();

		// Get some data from the models
		$state		= $this->get('State');
		$params		= $state->params;
		$elements		= $this->get('elements');
		$category	= $this->get('Category');
		$children	= $this->get('Children');
		$parent		= $this->get('Parent');
		$pagination = $this->get('Pagination');

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

		// Setup the category parameters.
		$cparams = $category->getParams();
		$category->params = clone($params);
		$category->params->merge($cparams);

		// Check whether category access level allows access.
		$user	= JFactory::getUser();
		$groups	= $user->getAuthorisedViewLevels();
		if (!in_array($category->access, $groups)) {
			return JError::raiseError(403, RText::_('RERROR_ALERTNOAUTHOR'));
		}

		// PREPARE THE DATA
		// Get the metrics for the structural page layout.
		$numLeading	= $params->def('num_leading_articles', 1);
		$numIntro	= $params->def('num_intro_articles', 4);
		$numLinks	= $params->def('num_links', 4);

		// Compute the article slugs and prepare introtext (runs content plugins).
		for ($i = 0, $n = count($elements); $i < $n; $i++)
		{
			$element = &$elements[$i];
			$element->slug = $element->alias ? ($element->id . ':' . $element->alias) : $element->id;

			// No link for ROOT category
			if ($element->parent_alias == 'root') {
				$element->parent_slug = null;
			}

			$element->event = new stdClass();

			$dispatcher = JDispatcher::getInstance();

			// Ignore content plugins on links.
			if ($i < $numLeading + $numIntro) {
				$element->introtext = JHtml::_('content.prepare', $element->introtext, '', 'com_content.category');

				$results = $dispatcher->trigger('onContentAfterTitle', array('com_content.article', &$element, &$element->params, 0));
				$element->event->afterDisplayTitle = trim(implode("\n", $results));

				$results = $dispatcher->trigger('onContentBeforeDisplay', array('com_content.article', &$element, &$element->params, 0));
				$element->event->beforeDisplayContent = trim(implode("\n", $results));

				$results = $dispatcher->trigger('onContentAfterDisplay', array('com_content.article', &$element, &$element->params, 0));
				$element->event->afterDisplayContent = trim(implode("\n", $results));
			}
		}

		// Check for layout override only if this is not the active menu element
		// If it is the active menu element, then the view and category id will match
		$active	= $app->getMenu()->getActive();
		if ((!$active) || ((strpos($active->link, 'view=category') === false) || (strpos($active->link, '&id=' . (string) $category->id) === false))) {
			// Get the layout from the merged category params
			if ($layout = $category->params->get('category_layout')) {
				$this->setLayout($layout);
			}
		}
		// At this point, we are in a menu element, so we don't override the layout
		elseif (isset($active->query['layout'])) {
			// We need to set the layout from the query in case this is an alternative menu element (with an alternative layout)
			$this->setLayout($active->query['layout']);
		}

		// For blog layouts, preprocess the breakdown of leading, intro and linked articles.
		// This makes it much easier for the designer to just interrogate the arrays.
		if (($params->get('layout_type') == 'blog') || ($this->getLayout() == 'blog')) {
			$max = count($elements);

			// The first group is the leading articles.
			$limit = $numLeading;
			for ($i = 0; $i < $limit && $i < $max; $i++) {
				$this->lead_elements[$i] = &$elements[$i];
			}

			// The second group is the intro articles.
			$limit = $numLeading + $numIntro;
			// Order articles across, then down (or single column mode)
			for ($i = $numLeading; $i < $limit && $i < $max; $i++) {
				$this->intro_elements[$i] = &$elements[$i];
			}

			$this->columns = max(1, $params->def('num_columns', 1));
			$order = $params->def('multi_column_order', 1);

			if ($order == 0 && $this->columns > 1) {
				// call order down helper
				$this->intro_elements = ContentHelperQuery::orderDownColumns($this->intro_elements, $this->columns);
			}

			$limit = $numLeading + $numIntro + $numLinks;
			// The remainder are the links.
			for ($i = $numLeading + $numIntro; $i < $limit && $i < $max;$i++)
			{
					$this->link_elements[$i] = &$elements[$i];
			}
		}

		$children = array($category->id => $children);

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->assign('maxLevel', $params->get('maxLevel', -1));
		$this->assignRef('state', $state);
		$this->assignRef('elements', $elements);
		$this->assignRef('category', $category);
		$this->assignRef('children', $children);
		$this->assignRef('params', $params);
		$this->assignRef('parent', $parent);
		$this->assignRef('pagination', $pagination);
		$this->assignRef('user', $user);

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
		$title		= null;

		// Because the application sets a default page title,
		// we need to get it from the menu element itself
		$menu = $menus->getActive();

		if ($menu) {
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else {
			$this->params->def('page_heading', RText::_('RGLOBAL_ARTICLES'));
		}

		$id = (int) @$menu->query['id'];

		if ($menu && ($menu->query['option'] != 'com_content' || $menu->query['view'] == 'article' || $id != $this->category->id)) {
			$path = array(array('title' => $this->category->title, 'link' => ''));
			$category = $this->category->getParent();

			while (($menu->query['option'] != 'com_content' || $menu->query['view'] == 'article' || $id != $category->id) && $category->id > 1)
			{
				$path[] = array('title' => $category->title, 'link' => ContentHelperRoute::getCategoryRoute($category->id));
				$category = $category->getParent();
			}

			$path = array_reverse($path);

			foreach ($path as $element)
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

		// Add feed links
		if ($this->params->get('show_feed_link', 1)) {
			$link = '&format=feed&limitstart=';
			$attribs = array('type' => 'application/rss+xml', 'title' => 'RSS 2.0');
			$this->document->addHeadLink(JRoute::_($link . '&type=rss'), 'alternate', 'rel', $attribs);
			$attribs = array('type' => 'application/atom+xml', 'title' => 'Atom 1.0');
			$this->document->addHeadLink(JRoute::_($link . '&type=atom'), 'alternate', 'rel', $attribs);
		}
	}
}
