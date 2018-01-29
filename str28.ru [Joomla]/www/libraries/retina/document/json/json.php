<?php
/**
 * @package     retina.Platform
 * @subpackage  Document
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * JDocumentJSON class, provides an easy interface to parse and display JSON output
 *
 * @package     retina.Platform
 * @subpackage  Document
 * @see         http://www.json.org/
 * @since       11.1
 */
class JDocumentJSON extends JDocument
{
	/**
	 * Document name
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $_name = 'retina';

	/**
	 * Class constructor
	 *
	 * @param   array  $options  Associative array of options
	 *
	 * @since  11.1
	 */
	public function __construct($options = array())
	{
		parent::__construct($options);

		//set mime type
		$this->_mime = 'application/json';

		//set document type
		$this->_type = 'json';
	}

	/**
	 * Render the document.
	 *
	 * @param   boolean  $cache   If true, cache the output
	 * @param   array    $params  Associative array of attributes
	 *
	 * @return  The rendered data
	 *
	 * @since  11.1
	 */
	public function render($cache = false, $params = array())
	{
		JResponse::allowCache(false);
		JResponse::setHeader('Content-disposition', 'attachment; filename="' . $this->getName() . '.json"', true);

		parent::render();

		return $this->getBuffer();
	}

	/**
	 * Returns the document name
	 *
	 * @return  string
	 *
	 * @since  11.1
	 */
	public function getName()
	{
		return $this->_name;
	}

	/**
	 * Sets the document name
	 *
	 * @param   string  $name  Document name
	 *
	 * @return  JDocumentJSON instance of $this to allow chaining
	 *
	 * @since   11.1
	 */
	public function setName($name = 'retina')
	{
		$this->_name = $name;

		return $this;
	}
}
