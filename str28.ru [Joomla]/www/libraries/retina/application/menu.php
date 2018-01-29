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
 * JMenu class
 *
 * @package     retina.Platform
 * @subpackage  Application
 * @since       11.1
 */
class JMenu extends JObject
{
	/**
	 * Array to hold the menu elements
	 *
	 * @var    array
	 * @since   11.1
	 */
	protected $elements = array();

	/**
	 * Array to hold the menu elements
	 *
	 * @var    array
	 * @since   11.1
	 * @deprecated use $elements declare as private
	 */
	protected $_elements = array();

	/**
	 * Identifier of the default menu element
	 *
	 * @var    integer
	 * @since   11.1
	 */
	protected $default = array();

	/**
	 * Identifier of the default menu element
	 *
	 * @var    integer
	 * @since   11.1
	 * @deprecated use $default declare as private
	 */
	protected $_default = array();

	/**
	 * Identifier of the active menu element
	 *
	 * @var    integer
	 * @since  11.1
	 */
	protected $active = 0;

	/**
	 * Identifier of the active menu element
	 *
	 * @var    integer
	 * @since  11.1
	 * @deprecated use $active declare as private
	 */
	protected $_active = 0;

	/**
	 * @var    array  JMenu instances container.
	 * @since  11.3
	 */
	protected static $instances = array();

	/**
	 * Class constructor
	 *
	 * @param   array  $options  An array of configuration options.
	 *
	 * @since   11.1
	 */
	public function __construct($options = array())
	{
		// Load the menu elements
		$this->load();

		foreach ($this->_elements as $element)
		{
			if ($element->home)
			{
				$this->_default[trim($element->language)] = $element->id;
			}

			// Decode the element params
			$result = new JRegistry;
			$result->loadString($element->params);
			$element->params = $result;
		}
	}

	/**
	 * Returns a JMenu object
	 *
	 * @param   string  $client   The name of the client
	 * @param   array   $options  An associative array of options
	 *
	 * @return  JMenu  A menu object.
	 *
	 * @since   11.1
	 */
	public static function getInstance($client, $options = array())
	{
		if (empty(self::$instances[$client]))
		{
			//Load the router object
			$info = JApplicationHelper::getClientInfo($client, true);

			$path = $info->path . '/includes/menu.php';
			if (file_exists($path))
			{
				include_once $path;

				// Create a JPathway object
				$classname = 'JMenu' . ucfirst($client);
				$instance = new $classname($options);
			}
			else
			{
				//$error = JError::raiseError(500, 'Unable to load menu: '.$client);
				//TODO: Solve this
				$error = null;
				return $error;
			}

			self::$instances[$client] = & $instance;
		}

		return self::$instances[$client];
	}

	/**
	 * Get menu element by id
	 *
	 * @param   integer  $id  The element id
	 *
	 * @return  mixed    The element object, or null if not found
	 *
	 * @since   11.1
	 */
	public function getelement($id)
	{
		$result = null;
		if (isset($this->_elements[$id]))
		{
			$result = &$this->_elements[$id];
		}

		return $result;
	}

	/**
	 * Set the default element by id and language code.
	 *
	 * @param   integer  $id        The menu element id.
	 * @param   string   $language  The language cod (since 1.6).
	 *
	 * @return  boolean  True, if successful
	 *
	 * @since   11.1
	 */
	public function setDefault($id, $language = '')
	{
		if (isset($this->_elements[$id]))
		{
			$this->_default[$language] = $id;
			return true;
		}

		return false;
	}

	/**
	 * Get the default element by language code.
	 *
	 * @param   string  $language  The language code, default value of * means all.
	 *
	 * @return  object  The element object
	 *
	 * @since   11.1
	 */
	public function getDefault($language = '*')
	{
		if (array_key_exists($language, $this->_default))
		{
			return $this->_elements[$this->_default[$language]];
		}
		elseif (array_key_exists('*', $this->_default))
		{
			return $this->_elements[$this->_default['*']];
		}
		else
		{
			return 0;
		}
	}

	/**
	 * Set the default element by id
	 *
	 * @param   integer  $id  The element id
	 *
	 * @return  mixed  If successful the active element, otherwise null
	 *
	 * @since   11.1
	 */
	public function setActive($id)
	{
		if (isset($this->_elements[$id]))
		{
			$this->_active = $id;
			$result = &$this->_elements[$id];
			return $result;
		}

		return null;
	}

	/**
	 * Get menu element by id.
	 *
	 * @return  object  The element object.
	 *
	 * @since   11.1
	 */
	public function getActive()
	{
		if ($this->_active)
		{
			$element = &$this->_elements[$this->_active];
			return $element;
		}

		return null;
	}

	/**
	 * Gets menu elements by attribute
	 *
	 * @param   string   $attributes  The field name
	 * @param   string   $values      The value of the field
	 * @param   boolean  $firstonly   If true, only returns the first element found
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	public function getelements($attributes, $values, $firstonly = false)
	{
		$elements = array();
		$attributes = (array) $attributes;
		$values = (array) $values;

		foreach ($this->_elements as $element)
		{
			if (!is_object($element))
			{
				continue;
			}

			$test = true;
			for ($i = 0, $count = count($attributes); $i < $count; $i++)
			{
				if (is_array($values[$i]))
				{
					if (!in_array($element->$attributes[$i], $values[$i]))
					{
						$test = false;
						break;
					}
				}
				else
				{
					if ($element->$attributes[$i] != $values[$i])
					{
						$test = false;
						break;
					}
				}
			}

			if ($test)
			{
				if ($firstonly)
				{
					return $element;
				}

				$elements[] = $element;
			}
		}

		return $elements;
	}

	/**
	 * Gets the parameter object for a certain menu element
	 *
	 * @param   integer  $id  The element id
	 *
	 * @return  JRegistry  A JRegistry object
	 *
	 * @since   11.1
	 */
	public function getParams($id)
	{
		if ($menu = $this->getelement($id))
		{
			return $menu->params;
		}
		else
		{
			return new JRegistry;
		}
	}

	/**
	 * Getter for the menu array
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	public function getMenu()
	{
		return $this->_elements;
	}

	/**
	 * Method to check JMenu object authorization against an access control
	 * object and optionally an access extension object
	 *
	 * @param   integer  $id  The menu id
	 *
	 * @return  boolean  True if authorised
	 *
	 * @since   11.1
	 */
	public function authorise($id)
	{
		$menu = $this->getelement($id);
		$user = JFactory::getUser();

		if ($menu)
		{
			return in_array((int) $menu->access, $user->getAuthorisedViewLevels());
		}
		else
		{
			return true;
		}
	}

	/**
	 * Loads the menu elements
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	public function load()
	{
		return array();
	}
}
