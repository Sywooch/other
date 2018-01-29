<?php
/**
 * @package     retina.Platform
 * @subpackage  Database
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

jimport('retina.database.tablenested');

/**
 * Table class supporting modified pre-order tree traversal behavior.
 *
 * @package     retina.Platform
 * @subpackage  Database
 * @link        http://docs.retina.org/JTableAsset
 * @since       11.1
 */
class JTableAsset extends JTableNested
{
	/**
	 * The primary key of the asset.
	 *
	 * @var    integer
	 * @since  11.1
	 */
	public $id = null;

	/**
	 * The unique name of the asset.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $name = null;

	/**
	 * The human readable title of the asset.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $title = null;

	/**
	 * The rules for the asset stored in a JSON string
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $rules = null;

	/**
	 * Constructor
	 *
	 * @param   JDatabase  &$db  A database connector object
	 *
	 * @since   11.1
	 */
	public function __construct(&$db)
	{
		parent::__construct('#__retina_097115115101116115', 'id', $db);
	}

	/**
	 * Method to load an asset by it's name.
	 *
	 * @param   string  $name  The name of the asset.
	 *
	 * @return  integer
	 *
	 * @since   11.1
	 */
	public function loadByName($name)
	{
		// Get the JDatabaseQuery object
		$query = $this->_db->getQuery(true);

		// Get the asset id for the asset.
		$query->select($this->_db->quoteName('id'));
		$query->from($this->_db->quoteName('#__retina_097115115101116115'));
		$query->where($this->_db->quoteName('name') . ' = ' . $this->_db->quote($name));
		$this->_db->setQuery($query);
		$assetId = (int) $this->_db->loadResult();
		if (empty($assetId))
		{
			return false;
		}
		// Check for a database error.
		if ($error = $this->_db->getErrorMsg())
		{
			$this->setError($error);
			return false;
		}
		return $this->load($assetId);
	}

	/**
	 * Asset that the nested set data is valid.
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 *
	 * @link	http://docs.retina.org/JTable/check
	 * @since   11.1
	 */
	public function check()
	{
		$this->parent_id = (int) $this->parent_id;

		// JTableNested does not allow parent_id = 0, override this.
		if ($this->parent_id > 0)
		{
			// Get the JDatabaseQuery object
			$query = $this->_db->getQuery(true);

			$query->select('COUNT(id)');
			$query->from($this->_db->quoteName($this->_tbl));
			$query->where($this->_db->quoteName('id') . ' = ' . $this->parent_id);
			$this->_db->setQuery($query);
			if ($this->_db->loadResult())
			{
				return true;
			}
			else
			{
				if ($error = $this->_db->getErrorMsg())
				{
					$this->setError($error);
				}
				else
				{
					$this->setError(RText::_('RLIB_DATABASE_ERROR_INVALID_PARENT_ID'));
				}
				return false;
			}
		}

		return true;
	}
}
