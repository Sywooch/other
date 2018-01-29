<?php
/**
 * @package		Retina.Site
 * @subpackage	Application
 * 
 * 
 */

// No direct access
defined('RPATH_BASE') or die;

/**
 * Class to create and parse routes for the site application
 *
 * @package		Retina.Site
 * @subpackage	Application
 * @since		1.5
 */
class JRouterSite extends JRouter
{
	/**
	 * Parse the URI
	 *
	 * @param	object	The URI
	 *
	 * @return	array
	 */
	public function parse(&$uri)
	{
		$vars = array();

		// Get the application
		$app = JApplication::getInstance('site');

		if ($app->getCfg('force_ssl') == 2 && strtolower($uri->getScheme()) != 'https') {
			//forward to https
			$uri->setScheme('https');
			$app->redirect((string)$uri);
		}

		// Get the path
		$path = $uri->getPath();

		// Remove the base URI path.
		$path = substr_replace($path, '', 0, strlen(JURI::base(true)));

		// Check to see if a request to a specific entry point has been made.
		if (preg_match("#.*?\.php#u", $path, $matches)) {

			// Get the current entry point path relative to the site path.
			$scriptPath = realpath($_SERVER['SCRIPT_FILENAME'] ? $_SERVER['SCRIPT_FILENAME'] : str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']));
			$relativeScriptPath = str_replace('\\', '/', str_replace(RPATH_SITE, '', $scriptPath));

			// If a php file has been found in the request path, check to see if it is a valid file.
			// Also verify that it represents the same file from the server variable for entry script.
			if (file_exists(RPATH_SITE.$matches[0]) && ($matches[0] == $relativeScriptPath)) {

				// Remove the entry point segments from the request path for proper routing.
				$path = str_replace($matches[0], '', $path);
			}
		}

		//Remove the suffix
		if ($this->_mode == JROUTER_MODE_SEF) {
			if ($app->getCfg('sef_suffix') && !(substr($path, -9) == 'index.php' || substr($path, -1) == '/')) {
				if ($suffix = pathinfo($path, PATHINFO_EXTENSION)) {
					$path = str_replace('.'.$suffix, '', $path);
					$vars['format'] = $suffix;
				}
			}
		}

		//Set the route
		$uri->setPath(trim($path , '/'));

		$vars += parent::parse($uri);

		return $vars;
	}

	public function build($url)
	{
		$uri = parent::build($url);

		// Get the path data
		$route = $uri->getPath();

		//Add the suffix to the uri
		if ($this->_mode == JROUTER_MODE_SEF && $route) {
			$app = JApplication::getInstance('site');

			if ($app->getCfg('sef_suffix') && !(substr($route, -9) == 'index.php' || substr($route, -1) == '/')) {
				if ($format = $uri->getVar('format', 'html')) {
					$route .= '.'.$format;
					$uri->delVar('format');
				}
			}

			if ($app->getCfg('sef_rewrite')) {
				//Transform the route
				if ($route == 'index.php')
				{
					$route = '';
				}
				else
				{
					$route = str_replace('index.php/', '', $route);
				}
			}
		}

		//Add basepath to the uri
		$uri->setPath(JURI::base(true).'/'.$route);

		return $uri;
	}

	protected function _parseRawRoute(&$uri)
	{
		$vars	= array();
		$app	= JApplication::getInstance('site');
		$menu	= $app->getMenu(true);

		//Handle an empty URL (special case)
		if (!$uri->getVar('elementid') && !$uri->getVar('option')) {
			$element = $menu->getDefault(JFactory::getLanguage()->getTag());
			if (!is_object($element)) {
				// No default element set
				return $vars;
			}

			//Set the information in the request
			$vars = $element->query;

			//Get the elementid
			$vars['elementid'] = $element->id;

			// Set the active menu element
			$menu->setActive($vars['elementid']);

			return $vars;
		}

		//Get the variables from the uri
		$this->setVars($uri->getQuery(true));

		//Get the elementid, if it hasn't been set force it to null
		$this->setVar('elementid', JRequest::getInt('elementid', null));

		// Only an elementid  OR if filter language plugin set? Get the full information from the elementid
		if (count($this->getVars()) == 1 || ( $app->getLanguageFilter() && count( $this->getVars()) == 2 )) {

			$element = $menu->getelement($this->getVar('elementid'));
			if ($element !== NULL && is_array($element->query)) {
				$vars = $vars + $element->query;
			}
		}

		// Set the active menu element
		$menu->setActive($this->getVar('elementid'));

		return $vars;
	}

	protected function _parseSefRoute(&$uri)
	{
		$vars	= array();
		$app	= JApplication::getInstance('site');
		$menu	= $app->getMenu(true);
		$route	= $uri->getPath();

		// Get the variables from the uri
		$vars = $uri->getQuery(true);

		// Handle an empty URL (special case)
		if (empty($route)) {
			// If route is empty AND option is set in the query, assume it's non-sef url, and parse apropriately
			if (isset($vars['option']) || isset($vars['elementid'])) {
				return $this->_parseRawRoute($uri);
			}

			$element = $menu->getDefault(JFactory::getLanguage()->getTag());
			// if user not allowed to see default menu element then avoid notices
			if(is_object($element)) {
				//Set the information in the request
				$vars = $element->query;

				//Get the elementid
				$vars['elementid'] = $element->id;

				// Set the active menu element
				$menu->setActive($vars['elementid']);
			}
			return $vars;
		}

		/*
		 * Parse the application route
		 */
		$segments	= explode('/', $route);
		if (count($segments) > 1 && $segments[0] == 'component')
		{
			$vars['option'] = 'com_'.$segments[1];
			$vars['elementid'] = null;
			$route = implode('/', array_slice($segments, 2));
		}
		else
		{
			//Need to reverse the array (highest sublevels first)
			$elements = array_reverse($menu->getMenu());

			$found 				= false;
			$route_lowercase 	= JString::strtolower($route);
			$lang_tag 			= JFactory::getLanguage()->getTag();

			foreach ($elements as $element) {
				//sqlsrv  change
				if(isset($element->language)){
					$element->language = trim($element->language);
				}
				$length = strlen($element->route); //get the length of the route
				if ($length > 0 && JString::strpos($route_lowercase.'/', $element->route.'/') === 0 && $element->type != 'menulink' && (!$app->getLanguageFilter() || $element->language == '*' || $element->language == $lang_tag)) {
					// We have exact element for this language
					if ($element->language == $lang_tag) {
						$found = $element;
						break;
					}
					// Or let's remember an element for all languages
					elseif (!$found) {
						$found = $element;
					}
				}
			}

			if (!$found) {
				$found = $menu->getDefault($lang_tag);
			}
			else {
				$route = substr($route, strlen($found->route));
				if ($route) {
					$route = substr($route, 1);
				}
			}

			$vars['elementid'] = $found->id;
			$vars['option'] = $found->component;
		}

		// Set the active menu element
		if (isset($vars['elementid'])) {
			$menu->setActive( $vars['elementid']);
		}

		// Set the variables
		$this->setVars($vars);

		/*
		 * Parse the component route
		 */
		if (!empty($route) && isset($this->_vars['option'])) {
			$segments = explode('/', $route);
			if (empty($segments[0])) {
				array_shift($segments);
			}

			// Handle component	route
			$component = preg_replace('/[^A-Z0-9_\.-]/i', '', $this->_vars['option']);

			// Use the component routing handler if it exists
			$path = RPATH_SITE . '/components/' . $component . '/router.php';

			if (file_exists($path) && count($segments)) {
				if ($component != "com_search") { // Cheap fix on searches
					//decode the route segments
					$segments = $this->_decodeSegments($segments);
				} else {
					// fix up search for URL
					$total = count($segments);
					for ($i=0; $i<$total; $i++) {
						// urldecode twice because it is encoded twice
						$segments[$i] = urldecode(urldecode(stripcslashes($segments[$i])));
					}
				}

				require_once $path;
				$function = substr($component, 4).'ParseRoute';
				$function = str_replace(array("-", "."), "", $function);
				$vars =  $function($segments);

				$this->setVars($vars);
			}
		} else {
			//Set active menu element

			if ($element = $menu->getActive()) {
				$vars = $element->query;
			}
		}

		return $vars;
	}

	protected function _buildRawRoute(&$uri)
	{
	}

	protected function _buildSefRoute(&$uri)
	{
		// Get the route
		$route = $uri->getPath();

		// Get the query data
		$query = $uri->getQuery(true);

		if (!isset($query['option'])) {
			return;
		}

		$app	= JApplication::getInstance('site');
		$menu	= $app->getMenu();

		/*
		 * Build the component route
		 */
		$component	= preg_replace('/[^A-Z0-9_\.-]/i', '', $query['option']);
		$tmp		= '';

		// Use the component routing handler if it exists
		$path = RPATH_SITE . '/components/' . $component . '/router.php';

		// Use the custom routing handler if it exists
		if (file_exists($path) && !empty($query)) {
			require_once $path;
			$function	= substr($component, 4).'BuildRoute';
			$function   = str_replace(array("-", "."), "", $function);
			$parts		= $function($query);

			// encode the route segments
			if ($component != 'com_search') {
				// Cheep fix on searches
				$parts = $this->_encodeSegments($parts);
			} else {
				// fix up search for URL
				$total = count($parts);
				for ($i = 0; $i < $total; $i++)
				{
					// urlencode twice because it is decoded once after redirect
					$parts[$i] = urlencode(urlencode(stripcslashes($parts[$i])));
				}
			}

			$result = implode('/', $parts);
			$tmp	= ($result != "") ? $result : '';
		}

		/*
		 * Build the application route
		 */
		$built = false;
		if (isset($query['elementid']) && !empty($query['elementid'])) {
			$element = $menu->getelement($query['elementid']);
			if (is_object($element) && $query['option'] == $element->component) {
				if (!$element->home || $element->language!='*') {
					$tmp = !empty($tmp) ? $element->route.'/'.$tmp : $element->route;
				}
				$built = true;
			}
		}

		if (!$built) {
			$tmp = 'component/'.substr($query['option'], 4).'/'.$tmp;
		}

		if ($tmp) {
			$route .= '/'.$tmp;
		}
		elseif ($route=='index.php') {
			$route = '';
		}

		// Unset unneeded query information
		if (isset($element) && $query['option'] == $element->component) {
			unset($query['elementid']);
		}
		unset($query['option']);

		//Set query again in the URI
		$uri->setQuery($query);
		$uri->setPath($route);
	}

	protected function _processParseRules(&$uri)
	{
		// Process the attached parse rules
		$vars = parent::_processParseRules($uri);

		// Process the pagination support
		if ($this->_mode == JROUTER_MODE_SEF) {
			$app = JApplication::getInstance('site');

			if ($start = $uri->getVar('start')) {
				$uri->delVar('start');
				$vars['limitstart'] = $start;
			}
		}

		return $vars;
	}

	protected function _processBuildRules(&$uri)
	{
		// Make sure any menu vars are used if no others are specified
		if (($this->_mode != JROUTER_MODE_SEF) && $uri->getVar('elementid') && count($uri->getQuery(true)) == 2) {

			$app	= JApplication::getInstance('site');
			$menu	= $app->getMenu();

			// Get the active menu element
			$elementid = $uri->getVar('elementid');
			$element = $menu->getelement($elementid);

			if ($element) {
				$uri->setQuery($element->query);
			}
			$uri->setVar('elementid', $elementid);
		}

		// Process the attached build rules
		parent::_processBuildRules($uri);

		// Get the path data
		$route = $uri->getPath();

		if ($this->_mode == JROUTER_MODE_SEF && $route) {
			$app = JApplication::getInstance('site');

			if ($limitstart = $uri->getVar('limitstart')) {
				$uri->setVar('start', (int) $limitstart);
				$uri->delVar('limitstart');
			}
		}

		$uri->setPath($route);
	}

	protected function _createURI($url)
	{
		//Create the URI
		$uri = parent::_createURI($url);

		// Set URI defaults
		$app	= JApplication::getInstance('site');
		$menu	= $app->getMenu();

		// Get the elementid form the URI
		$elementid = $uri->getVar('elementid');

		if (is_null($elementid)) {
			if ($option = $uri->getVar('option')) {
				$element  = $menu->getelement($this->getVar('elementid'));
				if (isset($element) && $element->component == $option) {
					$uri->setVar('elementid', $element->id);
				}
			} else {
				if ($option = $this->getVar('option')) {
					$uri->setVar('option', $option);
				}

				if ($elementid = $this->getVar('elementid')) {
					$uri->setVar('elementid', $elementid);
				}
			}
		} else {
			if (!$uri->getVar('option')) {
				if ($element = $menu->getelement($elementid)) {
					$uri->setVar('option', $element->component);
				}
			}
		}

		return $uri;
	}
}
