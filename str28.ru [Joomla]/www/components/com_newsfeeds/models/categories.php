<?php
/**
 * 
 * 
 */

// Check to ensure this file is included in Retina
defined('_REXEC') or die;

jimport('retina.application.component.model');

/**
 * This models supports retrieving lists of newsfeed categories.
 *
 * @package		Retina.Site
 * @subpackage	com_newsfeeds
 * @since		1.6
 */
class NewsfeedsModelCategories extends JModel
{
	/**
	 * Model context string.
	 *
	 * @var		string
	 */
	public $_context = 'com_newsfeeds.categories';

	/**
	 * The category context (allows other extensions to derived from this model).
	 *
	 * @var		string
	 */
	protected $_extension = 'com_newsfeeds';

	private $_parent = null;

	private $_elements = null;

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since	1.6
	 */
	protected function populateState()
	{
		$app = JFactory::getApplication();
		$this->setState('filter.extension', $this->_extension);

		// Get the parent id if defined.
		$parentId = JRequest::getInt('id');
		$this->setState('filter.parentId', $parentId);

		$params = $app->getParams();
		$this->setState('params', $params);

		$this->setState('filter.published',	1);
		$this->setState('filter.access',	true);
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param	string		$id	A prefix for the store id.
	 *
	 * @return	string		A store id.
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id	.= ':'.$this->getState('filter.extension');
		$id	.= ':'.$this->getState('filter.published');
		$id	.= ':'.$this->getState('filter.access');
		$id	.= ':'.$this->getState('filter.parentId');

		return parent::getStoreId($id);
	}

	/**
	 * redefine the function an add some properties to make the styling more easy
	 *
	 * @return mixed An array of data elements on success, false on failure.
	 */
	public function getelements()
	{
		if(!count($this->_elements))
		{
			$app = JFactory::getApplication();
			$menu = $app->getMenu();
			$active = $menu->getActive();
			$params = new JRegistry();
			if($active)
			{
				$params->loadString($active->params);
			}
			$options = array();
			$options['countelements'] = $params->get('show_cat_elements_cat', 1) || !$params->get('show_empty_categories_cat', 0);
			$categories = JCategories::getInstance('Newsfeeds', $options);
			$this->_parent = $categories->get($this->getState('filter.parentId', 'root'));
			if(is_object($this->_parent))
			{
				$this->_elements = $this->_parent->getChildren();
			} else {
				$this->_elements = false;
			}
		}

		return $this->_elements;
	}

	public function getParent()
	{
		if(!is_object($this->_parent))
		{
			$this->getelements();
		}
		return $this->_parent;
	}
}
