<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2013 www.rsjoomla.com
* @license GPL, http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin');

class plgContentRSEventspro extends JPlugin
{
	public function plgContentRSComments(&$subject, $config) {
		parent::__construct($subject, $config);
	}
	
	/**
	 * Plugin that loads RSEvents!Pro events within content
	 *
	 * @param   string	The context of the content being passed to the plugin.
	 * @param   object	The article object.  Note $article->text is also available
	 * @param   object	The article params
	 * @param   integer  The 'page' number
	 */
	public function onContentPrepare($context, &$article, &$params, $page = 0) {
		
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer') {
			return true;
		}
		
		// simple performance check to determine whether bot should process further
		if (strpos($article->text, '{rseventspro') === false) {
			return true;
		}
		
		// Can we run the plugin
		if (!$this->canRun()) {
			return true;
		}
		
		$itemid = $this->params->get('itemid',0);
		
		// expression to search for (positions)
		$regex		= '#{rseventspro\s+id=["|\']([0-9]+)["|\']}#is';
		
		// Find all instances of plugin and put in $matches for events
		// $matches[0] is full pattern match, $matches[1] is the event id
		preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);
		
		// No matches, skip this
		if ($matches) {
			JFactory::getLanguage()->load('com_rseventspro', JPATH_SITE);
			JFactory::getLanguage()->load('com_rseventspro.dates', JPATH_SITE);
			foreach ($matches as $match) {
				$id = $match[1];
				
				$output = rseventsproHelper::event($id, $itemid);
				// Replace placeholders
				$article->text = preg_replace("|$match[0]|", addcslashes($output, '\\$'), $article->text);
			}
		}
	}
	
	protected function canRun() {
		if (file_exists(JPATH_SITE.'/components/com_rseventspro/rseventspro.php')) {
			require_once JPATH_SITE.'/components/com_rseventspro/helpers/rseventspro.php';
			
			return true;
		}
		
		return false;
	}
}