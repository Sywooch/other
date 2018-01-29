<?php
/**
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML Article View class for the Content component
 *
 * @package		Retina.Site
 * @subpackage	com_content
 * @since		1.5
 */
class ContentViewArticle extends JView
{
	protected $element;
	protected $params;
	protected $print;
	protected $state;
	protected $user;

	function display($tpl = null)
	{
		// Initialise variables.
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$dispatcher	= JDispatcher::getInstance();

		$this->element		= $this->get('element');
		$this->print	= JRequest::getBool('print');
		$this->state	= $this->get('State');
		$this->user		= $user;

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}

		// Create a shortcut for $element.
		$element = &$this->element;

		// Add router helpers.
		$element->slug			= $element->alias ? ($element->id.':'.$element->alias) : $element->id;
		$element->catslug		= $element->category_alias ? ($element->catid.':'.$element->category_alias) : $element->catid;
		$element->parent_slug	= $element->category_alias ? ($element->parent_id.':'.$element->parent_alias) : $element->parent_id;

		// TODO: Change based on shownoauth
		$element->readmore_link = JRoute::_(ContentHelperRoute::getArticleRoute($element->slug, $element->catslug));

		// Merge article params. If this is single-article view, menu params override article params
		// Otherwise, article params override menu element params
		$this->params	= $this->state->get('params');
		$active	= $app->getMenu()->getActive();
		$temp	= clone ($this->params);

		// Check to see which parameters should take priority
		if ($active) {
			$currentLink = $active->link;
			// If the current view is the active element and an article view for this article, then the menu element params take priority
			if (strpos($currentLink, 'view=article') && (strpos($currentLink, '&id='.(string) $element->id))) {
				// $element->params are the article params, $temp are the menu element params
				// Merge so that the menu element params take priority
				$element->params->merge($temp);
				// Load layout from active query (in case it is an alternative menu element)
				if (isset($active->query['layout'])) {
					$this->setLayout($active->query['layout']);
				}
			}
			else {
				// Current view is not a single article, so the article params take priority here
				// Merge the menu element params with the article params so that the article params take priority
				$temp->merge($element->params);
				$element->params = $temp;

				// Check for alternative layouts (since we are not in a single-article menu element)
				// Single-article menu element layout takes priority over alt layout for an article
				if ($layout = $element->params->get('article_layout')) {
					$this->setLayout($layout);
				}
			}
		}
		else {
			// Merge so that article params take priority
			$temp->merge($element->params);
			$element->params = $temp;
			// Check for alternative layouts (since we are not in a single-article menu element)
			// Single-article menu element layout takes priority over alt layout for an article
			if ($layout = $element->params->get('article_layout')) {
				$this->setLayout($layout);
			}
		}

		$offset = $this->state->get('list.offset');

		// Check the view access to the article (the model has already computed the values).
		if ($element->params->get('access-view') != true && (($element->params->get('show_noauth') != true &&  $user->get('guest') ))) {

						JError::raiseWarning(403, RText::_('RERROR_ALERTNOAUTHOR'));

				return;

		}

		if ($element->params->get('show_intro', '1')=='1') {
			$element->text = $element->introtext.' '.$element->fulltext;
		}
		elseif ($element->fulltext) {
			$element->text = $element->fulltext;
		}
		else  {
			$element->text = $element->introtext;
		}

		//
		// Process the content plugins.
		//
		JPluginHelper::importPlugin('content');
		$results = $dispatcher->trigger('onContentPrepare', array ('com_content.article', &$element, &$this->params, $offset));

		$element->event = new stdClass();
		$results = $dispatcher->trigger('onContentAfterTitle', array('com_content.article', &$element, &$this->params, $offset));
		$element->event->afterDisplayTitle = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentBeforeDisplay', array('com_content.article', &$element, &$this->params, $offset));
		$element->event->beforeDisplayContent = trim(implode("\n", $results));

		$results = $dispatcher->trigger('onContentAfterDisplay', array('com_content.article', &$element, &$this->params, $offset));
		$element->event->afterDisplayContent = trim(implode("\n", $results));

		// Increment the hit counter of the article.
		if (!$this->params->get('intro_only') && $offset == 0) {
			$model = $this->getModel();
			$model->hit();
		}

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($this->element->params->get('pageclass_sfx'));

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
		$pathway = $app->getPathway();
		$title = null;

		// Because the application sets a default page title,
		// we need to get it from the menu element itself
		$menu = $menus->getActive();
		if ($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else
		{
			$this->params->def('page_heading', RText::_('RGLOBAL_ARTICLES'));
		}

		$title = $this->params->get('page_title', '');

		$id = (int) @$menu->query['id'];

		// if the menu element does not concern this article
		if ($menu && ($menu->query['option'] != 'com_content' || $menu->query['view'] != 'article' || $id != $this->element->id))
		{
			// If this is not a single article menu element, set the page title to the article title
			if ($this->element->title) {
				$title = $this->element->title;
			}
			$path = array(array('title' => $this->element->title, 'link' => ''));
			$category = JCategories::getInstance('Content')->get($this->element->catid);
			while ($category && ($menu->query['option'] != 'com_content' || $menu->query['view'] == 'article' || $id != $category->id) && $category->id > 1)
			{
				$path[] = array('title' => $category->title, 'link' => ContentHelperRoute::getCategoryRoute($category->id));
				$category = $category->getParent();
			}
			$path = array_reverse($path);
			foreach($path as $element)
			{
				$pathway->addelement($element['title'], $element['link']);
			}
		}

		// Check for empty title and add site name if param is set
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
			$title = $this->element->title;
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

		if ($app->getCfg('MetaAuthor') == '1')
		{
			$this->document->setMetaData('author', $this->element->author);
		}

		$mdata = $this->element->metadata->toArray();
		foreach ($mdata as $k => $v)
		{
			if ($v)
			{
				$this->document->setMetadata($k, $v);
			}
		}

		// If there is a pagebreak heading or title, add it to the page title
		if (!empty($this->element->page_title))
		{
			$this->element->title = $this->element->title . ' - ' . $this->element->page_title;
			$this->document->setTitle($this->element->page_title . ' - ' . RText::sprintf('PLG_CONTENT_PAGEBREAK_PAGE_NUM', $this->state->get('list.offset') + 1));
		}

		if ($this->print)
		{
			$this->document->setMetaData('robots', 'noindex, nofollow');
		}
	}
}
