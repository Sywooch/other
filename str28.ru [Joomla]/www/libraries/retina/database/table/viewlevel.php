<?php
/**
 * @package     retina.Platform
 * @subpackage  Database
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

jimport('retina.database.table');

/**
 * Viewlevels table class.
 *
 * @package     retina.Platform
 * @subpackage  Database
 * @since       11.1
 */
class JTableViewlevel extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabase  &$db  Database object.
	 *
	 * @since   11.1
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__viewlevels', 'id', $db);
	}

	/**
	 * Method to bind the data.
	 *
	 * @param   array  $array   The data to bind.
	 * @param   mixed  $ignore  An array or space separated list of fields to ignore.
	 *
	 * @return  boolean  True on success, false on failure.
	 *
	 * @since   11.1
	 */
	public function bind($array, $ignore = '')
	{
		// Bind the rules as appropriate.
		if (isset($array['rules']))
		{
			if (is_array($array['rules']))
			{
				$array['rules'] = json_encode($array['rules']);
			}
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * Method to check the current record to save
	 *
	 * @return  boolean  True on success
	 *
	 * @since   11.1
	 */
	public function check()
	{
		// Validate the title.
		if ((trim($this->title)) == '')
		{
			$this->setError(RText::_('RLIB_DATABASE_ERROR_VIEWLEVEL'));
			return false;
		}

		return true;
	}
}
