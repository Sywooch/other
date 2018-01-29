<?php
/**
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * 
 * 
 *
 */

// Check to ensure this file is included in Retina
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML View class for the Newsfeeds component
 *
 * @static
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * @since 1.0
 */
class NewsfeedsViewNewsfeed extends JView
{
	/**
	 * @var		object
	 * @since	1.6
	 */
	protected $state;

	/**
	 * @var		object
	 * @since	1.6
	 */
	protected $element;

	/**
	 * @var		boolean
	 * @since	1.6
	 */
	protected $print;

	/**
	 * @since	1.6
	 */
	function display($tpl = null)
	{
		// Initialise variables.
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$dispatcher	= JDispatcher::getInstance();

		// Get view related request variables.
		$print = JRequest::getBool('print');

		// Get model data.
		$state = $this->get('State');
		$element = $this->get('element');

		if ($element) {
		// Get Category Model data
		$categoryModel = JModel::getInstance('Category', 'NewsfeedsModel', array('ignore_request' => true));
		$categoryModel->setState('category.id', $element->catid);
		$categoryModel->setState('list.ordering', 'a.name');
		$categoryModel->setState('list.direction', 'asc');
		$elements = $categoryModel->getelements();
		}

		// Check for errors.
		// @TODO Maybe this could go into JComponentHelper::raiseErrors($this->get('Errors'))
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}

		// Add router helpers.
		$element->slug = $element->alias ? ($element->id . ':' . $element->alias) : $element->id;
		$element->catslug = $element->category_alias ? ($element->catid . ':' . $element->category_alias) : $element->catid;
		$element->parent_slug = $element->category_alias ? ($element->parent_id . ':' . $element->parent_alias) : $element->parent_id;

		// check if cache directory is writeable
		$cacheDir = RPATH_CACHE . '/';

		if (!is_writable($cacheDir)) {
			JError::raiseNotice('0', RText::_('COM_NEWSFEEDS_CACHE_DIRECTORY_UNWRITABLE'));
			return;
		}

		// Merge newsfeed params. If this is single-newsfeed view, menu params override newsfeed params
		// Otherwise, newsfeed params override menu element params
		$params = $state->get('params');
		$newsfeed_params = clone $element->params;
		$active = $app->getMenu()->getActive();
		$temp = clone ($params);

		// Check to see which parameters should take priority
		if ($active)
		{
			$currentLink = $active->link;
			// If the current view is the active element and an newsfeed view for this feed, then the menu element params take priority
			if (strpos($currentLink, 'view=newsfeed') && (strpos($currentLink, '&id='.(string) $element->id)))
			{
				// $element->params are the newsfeed params, $temp are the menu element params
				// Merge so that the menu element params take priority
				$newsfeed_params->merge($temp);
				$element->params = $newsfeed_params;
				// Load layout from active query (in case it is an alternative menu element)
				if (isset($active->query['layout']))
				{
					$this->setLayout($active->query['layout']);
				}
			}
			else
			{
				// Current view is not a single newsfeed, so the newsfeed params take priority here
				// Merge the menu element params with the newsfeed params so that the newsfeed params take priority
				$temp->merge($newsfeed_params);
				$element->params = $temp;
				// Check for alternative layouts (since we are not in a single-newsfeed menu element)
				if ($layout = $element->params->get('newsfeed_layout'))
				{
					$this->setLayout($layout);
				}
			}
		}
		else
		{
			// Merge so that newsfeed params take priority
			$temp->merge($newsfeed_params);
			$element->params = $temp;
			// Check for alternative layouts (since we are not in a single-newsfeed menu element)
			if ($layout = $element->params->get('newsfeed_layout'))
			{
				$this->setLayout($layout);
			}
		}

		$offset = $state->get('list.offset');

		// Check the access to the newsfeed
		$levels = $user->getAuthorisedViewLevels();

		if (!in_array($element->access, $levels) or ((in_array($element->access, $levels) and (!in_array($element->category_access, $levels))))) {
			JError::raiseWarning(403, RText::_('RERROR_ALERTNOAUTHOR'));
			return;
		}

		// Get the current menu element
		$menus	= $app->getMenu();
		$menu	= $menus->getActive();
		$params	= $app->getParams();

		// Get the newsfeed
		$newsfeed = $element;

		$temp = new JRegistry();
		$temp->loadString($element->params);
		$params->merge($temp);

		//  get RSS parsed object
		$options = array();
		$options['rssUrl']		= $newsfeed->link;
		$options['cache_time']	= $newsfeed->cache_time;

		$rssDoc = JFactory::getXMLParser('RSS', $options);

		if ($rssDoc == false) {
			$msg = RText::_('COM_NEWSFEEDS_ERRORS_FEED_NOT_RETRIEVED');
			$app->redirect(NewsFeedsHelperRoute::getCategoryRoute($newsfeed->catslug), $msg);
			return;
		}
		$lists = array();

		// channel header and link
		$newsfeed->channel['title']			= $rssDoc->get_title();
		$newsfeed->channel['link']			= $rssDoc->get_link();
		$newsfeed->channel['description']	= $rssDoc->get_description();
		$newsfeed->channel['language']		= $rssDoc->get_language();

		// channel image if exists
		$newsfeed->image['url']		= $rssDoc->get_image_url();
		$newsfeed->image['title']	= $rssDoc->get_image_title();
		$newsfeed->image['link']	= $rssDoc->get_image_link();
		$newsfeed->image['height']	= $rssDoc->get_image_height();
		$newsfeed->image['width']	= $rssDoc->get_image_width();

		// elements
		$newsfeed->elements = $rssDoc->get_elements();

		// feed elements
		$newsfeed->elements = array_slice($newsfeed->elements, 0, $newsfeed->numarticles);

		// feed display order
		$feed_display_order = $params->get('feed_display_order', 'des');
		if ($feed_display_order == 'asc') {
			$newsfeed->elements = array_reverse($newsfeed->elements);
		}

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->assignRef('params'  , $params  );
		$this->assignRef('newsfeed', $newsfeed);
		$this->assignRef('state', $state);
		$this->assignRef('element', $element);
		$this->assignRef('user', $user);
		$this->assign('print', $print);

		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 *
	 * @return	void
	 * @since	1.6
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
			$this->params->def('page_heading', RText::_('COM_NEWSFEEDS_DEFAULT_PAGE_TITLE'));
		}

		$title = $this->params->get('page_title', '');

		$id = (int) @$menu->query['id'];

		// if the menu element does not concern this newsfeed
		if ($menu && ($menu->query['option'] != 'com_newsfeeds' || $menu->query['view'] != 'newsfeed' || $id != $this->element->id))
		{
			// If this is not a single newsfeed menu element, set the page title to the newsfeed title
			if ($this->element->name) {
				$title = $this->element->name;
			}

			$path = array(array('title' => $this->element->name, 'link' => ''));
			$category = JCategories::getInstance('Newsfeeds')->get($this->element->catid);
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

		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = RText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = RText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		if (empty($title)) {
			$title = $this->element->name;
		}
		$this->document->setTitle($title);

		if ($this->element->metadesc)
		{
			$this->document->setDescription($this->element->metadesc);
		}
		elseif (!$this->element->metadesc && $this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->element->metakey)
		{
			$this->document->setMetadata('keywords', $this->element->metakey);
		}
		elseif (!$this->element->metakey && $this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}

		if ($app->getCfg('MetaTitle') == '1') {
			$this->document->setMetaData('title', $this->element->name);
		}

		if ($app->getCfg('MetaAuthor') == '1') {
			$this->document->setMetaData('author', $this->element->author);
		}

		$mdata = $this->element->metadata->toArray();
		foreach ($mdata as $k => $v)
		{
			if ($v) {
				$this->document->setMetadata($k, $v);
			}
		}
	}
}
