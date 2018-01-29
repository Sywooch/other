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
 * DocumentRAW class, provides an easy interface to parse and display raw output
 *
 * @package     retina.Platform
 * @subpackage  Document
 * @since       11.1
 */
class JDocumentRaw extends JDocument
{
	/**
	 * Class constructor
	 *
	 * @param   array  $options  Associative array of options
	 *
	 * @since   11.1
	 */
	public function __construct($options = array())
	{
		parent::__construct($options);

		//set mime type
		$this->_mime = 'text/html';

		//set document type
		$this->_type = 'raw';
	}

	/**
	 * Render the document.
	 *
	 * @param   boolean  $cache   If true, cache the output
	 * @param   array    $params  Associative array of attributes
	 *
	 * @return  The rendered data
	 *
	 * @since   11.1
	 */
	public function render($cache = false, $params = array())
	{
		parent::render();
		return $this->getBuffer();
	}
}
