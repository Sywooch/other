<?php
/**
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.modelelement');

/**
 * Weblinks Component Model for a Weblink record
 *
 * @package		Retina.Site
 * @subpackage	com_weblinks
 * @since		1.5
 */
class WeblinksModelWeblink extends JModelelement
{
	/**
	 * Model context string.
	 *
	 * @access	protected
	 * @var		string
	 */
	protected $_context = 'com_weblinks.weblink';

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
		$params	= $app->getParams();

		// Load the object state.
		$id	= JRequest::getInt('id');
		$this->setState('weblink.id', $id);

		// Load the parameters.
		$this->setState('params', $params);
	}

	/**
	 * Method to get an ojbect.
	 *
	 * @param	integer	The id of the object to get.
	 *
	 * @return	mixed	Object on success, false on failure.
	 */
	public function &getelement($id = null)
	{
		if ($this->_element === null)
		{
			$this->_element = false;

			if (empty($id)) {
				$id = $this->getState('weblink.id');
			}

			// Get a level row instance.
			$table = JTable::getInstance('Weblink', 'WeblinksTable');

			// Attempt to load the row.
			if ($table->load($id))
			{
				// Check published state.
				if ($published = $this->getState('filter.published'))
				{
					if ($table->state != $published) {
						return $this->_element;
					}
				}

				// Convert the JTable to a clean JObject.
				$properties = $table->getProperties(1);
				$this->_element = JArrayHelper::toObject($properties, 'JObject');
			}
			elseif ($error = $table->getError()) {
				$this->setError($error);
			}
		}

		return $this->_element;
	}

	/**
	 * Method to increment the hit counter for the weblink
	 *
	 * @param	int		Optional ID of the weblink.
	 * @return	boolean	True on success
	 * @since	1.5
	 */
	public function hit($id = null)
	{
		if (empty($id)) {
			$id = $this->getState('weblink.id');
		}

		$weblink = $this->getTable('Weblink', 'WeblinksTable');
		return $weblink->hit($id);
	}
}
