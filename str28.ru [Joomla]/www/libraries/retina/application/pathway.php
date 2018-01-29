<?php
/**
 * @package     retina.Platform
 * @subpackage  Application
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Class to maintain a pathway.
 *
 * The user's navigated path within the application.
 *
 * @package     retina.Platform
 * @subpackage  Application
 * @since       11.1
 */
class JPathway extends JObject
{
	/**
	 * @var    array  Array to hold the pathway element objects
	 * @since  11.1
	 */
	protected $pathway = null;

	/**
	 * @var    array  Array to hold the pathway element objects
	 * @since  11.1
	 * @deprecated use $pathway declare as private
	 */
	protected $_pathway = null;

	/**
	 * @var    integer  Integer number of elements in the pathway
	 * @since  11.1
	 */
	protected $count = 0;

	/**
	 * @var    integer  Integer number of elements in the pathway
	 * @since  11.1
	 * @deprecated use $count declare as private
	 */
	protected $_count = 0;

	/**
	 * @var    array  JPathway instances container.
	 * @since  11.3
	 */
	protected static $instances = array();

	/**
	 * Class constructor
	 *
	 * @param   array  $options  The class options.
	 *
	 * @since   11.1
	 */
	public function __construct($options = array())
	{
		//Initialise the array
		$this->_pathway = array();
	}

	/**
	 * Returns a JPathway object
	 *
	 * @param   string  $client   The name of the client
	 * @param   array   $options  An associative array of options
	 *
	 * @return  JPathway  A JPathway object.
	 *
	 * @since   11.1
	 */
	public static function getInstance($client, $options = array())
	{
		if (empty(self::$instances[$client]))
		{
			//Load the router object
			$info = JApplicationHelper::getClientInfo($client, true);

			$path = $info->path . '/includes/pathway.php';
			if (file_exists($path))
			{
				include_once $path;

				// Create a JPathway object
				$classname = 'JPathway' . ucfirst($client);
				$instance = new $classname($options);
			}
			else
			{
				$error = JError::raiseError(500, RText::sprintf('RLIB_APPLICATION_ERROR_PATHWAY_LOAD', $client));
				return $error;
			}

			self::$instances[$client] = & $instance;
		}

		return self::$instances[$client];
	}

	/**
	 * Return the JPathWay elements array
	 *
	 * @return  array  Array of pathway elements
	 *
	 * @since   11.1
	 */
	public function getPathway()
	{
		$pw = $this->_pathway;

		// Use array_values to reset the array keys numerically
		return array_values($pw);
	}

	/**
	 * Set the JPathway elements array.
	 *
	 * @param   array  $pathway  An array of pathway objects.
	 *
	 * @return  array  The previous pathway data.
	 *
	 * @since   11.1
	 */
	public function setPathway($pathway)
	{
		$oldPathway = $this->_pathway;
		$pathway = (array) $pathway;

		// Set the new pathway.
		$this->_pathway = array_values($pathway);

		return array_values($oldPathway);
	}

	/**
	 * Create and return an array of the pathway names.
	 *
	 * @return  array  Array of names of pathway elements
	 *
	 * @since   11.1
	 */
	public function getPathwayNames()
	{
		// Initialise variables.
		$names = array(null);

		// Build the names array using just the names of each pathway element
		foreach ($this->_pathway as $element)
		{
			$names[] = $element->name;
		}

		//Use array_values to reset the array keys numerically
		return array_values($names);
	}

	/**
	 * Create and add an element to the pathway.
	 *
	 * @param   string  $name  The name of the element.
	 * @param   string  $link  The link to the element.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 */
	public function addelement($name, $link = '')
	{
		// Initialize variables
		$ret = false;

		if ($this->_pathway[] = $this->_makeelement($name, $link))
		{
			$ret = true;
			$this->_count++;
		}

		return $ret;
	}

	/**
	 * Set element name.
	 *
	 * @param   integer  $id    The id of the element on which to set the name.
	 * @param   string   $name  The name to set.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 */
	public function setelementName($id, $name)
	{
		// Initialize variables
		$ret = false;

		if (isset($this->_pathway[$id]))
		{
			$this->_pathway[$id]->name = $name;
			$ret = true;
		}

		return $ret;
	}

	/**
	 * Create and return a new pathway object.
	 *
	 * @param   string  $name  Name of the element
	 * @param   string  $link  Link to the element
	 *
	 * @return  JPathway  Pathway element object
	 *
	 * @since   11.1
	 */
	protected function _makeelement($name, $link)
	{
		$element = new stdClass;
		$element->name = html_entity_decode($name, ENT_COMPAT, 'UTF-8');
		$element->link = $link;

		return $element;
	}
}
