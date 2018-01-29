<?php
/**
 * @package		Retina.Site
 * @subpackage	com_search
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.controller');

/**
 * Search Component Controller
 *
 * @package		Retina.Site
 * @subpackage	com_search
 * @since 1.5
 */
class SearchController extends JController
{
	/**
	 * Method to display a view.
	 *
	 * @param	boolean			If true, the view output will be cached
	 * @param	array			An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return	JController		This object to support chaining.
	 * @since	1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
		JRequest::setVar('view', 'search'); // force it to be the search view

		return parent::display($cachable, $urlparams);
	}

	function search()
	{
		// slashes cause errors, <> get stripped anyway later on. # causes problems.
		$badchars = array('#', '>', '<', '\\');
		$searchword = trim(str_replace($badchars, '', JRequest::getString('searchword', null, 'post')));
		// if searchword enclosed in double quotes, strip quotes and do exact match
		if (substr($searchword, 0, 1) == '"' && substr($searchword, -1) == '"') {
			$post['searchword'] = substr($searchword, 1, -1);
			JRequest::setVar('searchphrase', 'exact');
		}
		else {
			$post['searchword'] = $searchword;
		}
		$post['ordering']	= JRequest::getWord('ordering', null, 'post');
		$post['searchphrase']	= JRequest::getWord('searchphrase', 'all', 'post');
		$post['limit']  = JRequest::getInt('limit', null, 'post');
		if ($post['limit'] === null) unset($post['limit']);

		$areas = JRequest::getVar('areas', null, 'post', 'array');
		if ($areas) {
			foreach($areas as $area)
			{
				$post['areas'][] = JFilterInput::getInstance()->clean($area, 'cmd');
			}
		}

				// set elementid id for links from menu
		$app	= JFactory::getApplication();
		$menu	= $app->getMenu();
		$elements	= $menu->getelements('link', 'index.php?option=com_search&view=search');

		if(isset($elements[0])) {
			$post['elementid'] = $elements[0]->id;
		} elseif (JRequest::getInt('elementid') > 0) { //use elementid from requesting page only if there is no existing menu
			$post['elementid'] = JRequest::getInt('elementid');
		}

		unset($post['task']);
		unset($post['submit']);

		$uri = JURI::getInstance();
		$uri->setQuery($post);
		$uri->setVar('option', 'com_search');


		$this->setRedirect(JRoute::_('index.php'.$uri->toString(array('query', 'fragment')), false));
	}
}
